<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karya;
use App\Models\Mapel;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\KaryaRequest;

class KaryaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax())
        {
            $query = Karya::with('mapel')->orderBy('id', 'desc');

            return Datatables::of($query)
                ->addColumn('mapel_name', function ($item) {
                    return $item->mapel ? $item->mapel->nama : '-'; // Menampilkan nama mapel jika ada
                })
                ->addColumn('action', function($item) {
                    return '
                        <a class="btn btn-warning d-inline" href="'. Route('karya.edit', $item->id) .'"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="'. route('karya.destroy', $item->id) .'" method="POST" class="d-inline">
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

        return view('pages.admin.karya.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mapels = Mapel::all();

        return view('pages.admin.karya.create', compact('mapels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Karya::create($data);

        return redirect()->route('karya.index')->with('success', 'Data Berhasil Diinputkan');
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
        $item = Karya::findOrFail($id);

        return view('pages.admin.karya.edit', compact('item', 'mapels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Karya::findOrFail($id);
        $data = $request->all();
        $item->update($data);

        return redirect()->route('karya.index')->with('success', 'Data Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Karya::findOrFail($id);
        $item->delete();

        return redirect()->route('karya.index')->with('success', 'Data Berhasil Dihapus');
    }
}