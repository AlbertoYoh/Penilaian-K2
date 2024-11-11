<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\User;
use App\Http\Requests\GuruRequest;
use Yajra\DataTables\Facades\DataTables;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax())
        {
            $query = Guru::with('mapel')->orderBy('id', 'desc');

            return Datatables::of($query)
                ->addColumn('mapel_name', function ($item) {
                    return $item->mapel ? $item->mapel->nama : '-'; // Menampilkan nama mapel jika ada
                })
                ->addColumn('action', function($item) {
                    return '
                        <a class="btn btn-warning d-inline" href="'. Route('guru.edit', $item->id) .'"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="'. route('guru.destroy', $item->id) .'" method="POST" class="d-inline">
                            '. method_field('delete') . csrf_field() .'
                            <button type="submit" class="btn btn-danger">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    ';
                })
                ->rawColumns(['action'])
                ->make();
        };

        return view('pages.admin.guru.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mapels = Mapel::all();

        return view('pages.admin.guru.create', compact('mapels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GuruRequest $request)
    {
        // Buat akun untuk guru di tabel user
        $user = new User();
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt('guru123**');
        $user->role = 'guru'; // Set role ke 'guru' sesuai permintaan
        $user->save();

        // Simpan data ke tabel guru
        $guru = new Guru();
        $guru->nama = $request->nama;
        $guru->email = $request->email;
        $guru->kelas = $request->kelas;
        $guru->mapel_id = $request->mapel_id;
        $guru->user_id = $user->id; // hubungkan guru dengan user_id dari tabel user
        $guru->save();

        return redirect()->route('guru.index')->with('success', 'Data Berhasil Diinputkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mapels = Mapel::all();
        $item = Guru::findOrFail($id);

        return view('pages.admin.guru.edit', compact('item', 'mapels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Guru::findOrFail($id);
        $user = User::findOrFail($item->user_id);

        // Update data guru
        $item->nama = $request->nama;
        $item->email = $request->email;
        $item->kelas = $request->kelas;
        $item->mapel_id = $request->mapel_id;
        $item->save();

        // Update data user terkait
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('guru.index')->with('success', 'Data Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Guru::findOrFail($id);
        $item->delete();

        return redirect()->route('guru.index')->with('success', 'Data Berhasil Dihapus');
    }
}
