<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Karya;
use App\Models\Ta;
use App\Models\Nilai;
use App\Models\Mapel;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class NilaiController extends Controller
{
    public function index()
    {
        $siswas = Siswa::all(); // Ambil semua siswa, atau bisa difilter lebih lanjut

        // Loop melalui siswa dan tambahkan properti 'nilai' untuk setiap siswa
        foreach ($siswas as $siswa) {
            // Cek jika siswa sudah memiliki nilai
            $nilai = Nilai::where('siswa_id', $siswa->id)->first(); // Ambil nilai pertama yang terkait
            $siswa->nilai = $nilai; // Menyimpan objek nilai untuk dipakai nanti
        }
    
        return view('pages.nilai.index', compact('siswas'));
    }

    public function tambahNilai($id)
    {
        $item = Siswa::findOrFail($id);
        $karyas = Karya::all();

        return view('pages.nilai.tambahNilai', compact('item', 'karyas'));
    }

    public function store(Request $request, $id)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'karya_id' => 'required|exists:karyas,id',
            'nilai' => 'required|integer|min:0|max:100',
            'deskripsi' => 'required|string',
            'hasil' => 'required|string',
        ]);

        // Tambahkan `siswa_id` dan `ta` (misal tahun ajaran)
        $validatedData['siswa_id'] = $id;
        $validatedData['ta'] = now()->format('Y'); // contoh: gunakan tahun saat ini

        // Simpan data ke tabel `nilais`
        Nilai::create($validatedData);

        return redirect()->route('nilai', $id)->with('success', 'Nilai berhasil disimpan!');
    }

    // Menampilkan halaman detail nilai
    public function detail($id)
    {
        // Cari siswa berdasarkan ID
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return redirect()->route('nilai.index')->with('error', 'Siswa tidak ditemukan');
        }

        // Ambil nilai siswa dengan karya terkait
        $nilai = Nilai::with('karya')->where('siswa_id', $id)->first();

        if (!$nilai) {
            return redirect()->route('nilai.index')->with('error', 'Nilai belum ditambahkan untuk siswa ini');
        }

        return view('pages.nilai.detail', compact('siswa', 'nilai'));
    }

    public function exportPdf($siswa_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);
        $guru = auth()->user()->guru;
        $nilai = Nilai::where('siswa_id', $siswa_id)->first();
    
        $tanggalSekarang = Carbon::now()->locale('id')->isoFormat('D MMMM YYYY');
    
        $data = [
            'siswa' => $siswa,
            'nilai' => $nilai,
            'guru' => $guru,
            'tanggal' => $tanggalSekarang
        ];
        
        Pdf::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf = PDF::loadView('pages.nilai.pdf_nilai', $data)->setPaper('a4', 'landscape');
        

        return $pdf->download('Detail_Nilai.pdf');
    }
}
