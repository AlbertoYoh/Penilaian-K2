<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mapel;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\MapelRequest;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax())
        {
            $query = Mapel::query()->orderBy('id', 'desc');

            return Datatables::of($query)
                ->addColumn('action', function($item) {
                    return '
                        <a class="btn btn-warning d-inline" href="'. Route('mapel.edit', $item->id) .'"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="'. route('mapel.destroy', $item->id) .'" method="POST" class="d-inline" data-confirm-delete="true">
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

        return view('pages.admin.mapel.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.mapel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MapelRequest $request)
    {
        $data = $request->all();
        Mapel::create($data);

        return redirect()->route('mapel.index')->with('success', 'Data Berhasil Diinputkan');
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
        $item = Mapel::findOrFail($id);

        return view('pages.admin.mapel.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Mapel::findOrFail($id);
        $data = $request->all();
        $item->update($data);

        return redirect()->route('mapel.index')->with('success', 'Data Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Mapel::findOrFail($id);
        $item->delete();

        return redirect()->route('mapel.index')->with('success', 'Data Berhasil Dihapus');
    }
}
