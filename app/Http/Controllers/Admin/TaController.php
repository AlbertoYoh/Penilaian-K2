<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ta;
use App\Http\Requests\TaRequest;
use Yajra\DataTables\Facades\DataTables;

class TaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax())
        {
            $query = Ta::query()->orderBy('id', 'desc');

            return Datatables::of($query)
                ->addColumn('action', function($item) {
                    return '
                        <a class="btn btn-warning d-inline" href="'. Route('ta.edit', $item->id) .'"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="'. route('ta.destroy', $item->id) .'" method="POST" class="d-inline">
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

        return view('pages.admin.ta.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.ta.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Buat akun untuk ta di tabel user
        $ta = new Ta();
        $ta->nama = $request->nama;
        $ta->status = $request->status;
        $ta->save();

        return redirect()->route('ta.index')->with('success', 'Data Berhasil Diinputkan');
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
        $item = Ta::findOrFail($id);

        return view('pages.admin.ta.edit', compact('item', 'mapels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Ta::findOrFail($id);
        $user = User::findOrFail($item->user_id);

        // Update data ta
        $item->nama = $request->nama;
        $item->email = $request->email;
        $item->kelas = $request->kelas;
        $item->mapel_id = $request->mapel_id;
        $item->save();

        // Update data user terkait
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('ta.index')->with('success', 'Data Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Ta::findOrFail($id);
        $item->delete();

        return redirect()->route('ta.index')->with('success', 'Data Berhasil Dihapus');
    }
}
