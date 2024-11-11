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

class NilaiController extends Controller
{
    public function index()
    {
        $siswas = Siswa::all();

        return view('pages.nilai.index', compact('siswas'));
    }

    public function tambahNilai($id)
    {
        $item = Siswa::findOrFail($id);
        $karyas = Karya::all();

        return view('pages.nilai.tambahNilai', compact('item', 'karyas'));
    }
}
