<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Mapel;
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax())
        {
            $query = Siswa::with('mapel')->orderBy('id', 'desc');

            return Datatables::of($query)
                ->addColumn('mapel_name', function ($item) {
                    return $item->mapel ? $item->mapel->nama : '-'; // Menampilkan nama mapel jika ada
                })
                ->addColumn('action', function($item) {
                    return '<a class="btn btn-warning d-inline" href="'. 
                        Route('siswa.edit', $item->id) .'">
                        <i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="'. route('siswa.destroy', $item->id) .'" method="POST" class="d-inline">
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

        return view('pages.admin.siswa.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mapels = Mapel::all();

        return view('pages.admin.siswa.create', compact('mapels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Siswa::create($data);

        return redirect()->route('siswa.index')->with('success', 'Data Berhasil Diinputkan');
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
        $item = Siswa::findOrFail($id);

        return view('pages.admin.siswa.edit', compact('item', 'mapels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Siswa::findOrFail($id);
        $data = $request->all();
        $item->update($data);

        return redirect()->route('siswa.index')->with('success', 'Data Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Siswa::findOrFail($id);
        $item->delete();

        return redirect()->route('siswa.index')->with('success', 'Data Berhasil Dihapus');
    }

    public function siswaImportExcel(Request $request)
    {
        Excel::import(new SiswaImport, request()->file('file'));

        return redirect()->route('siswa.index')->with('success', 'Data Berhasil Diupload');
    }
}
