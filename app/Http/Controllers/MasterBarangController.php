<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class MasterBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Master/Barang/Index', [
            'barang' => Barang::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Barang $barang)
    {
        $barang->create([
            ...$request->all(),
            ...$request->validate(['nama' => 'required'])
        ]);

        return back()->with('success', 'Barang baru berhasil ditambahkan');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $barang->update([
            ...$request->all(),
            ...$request->validate([
                'nama' => 'required'
            ])
        ]);

        return back()->with('success', $barang->nama . ' berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        try {
            $barang->delete();
            return back()->with('success', $barang->nama . ' berhasil dihapus');

        } catch (\Exception $e) {
            return back()->with('error', 'Barang gagal dihapus');
        }
    }
}
