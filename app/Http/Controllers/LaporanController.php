<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Laporan;
use App\Traits\GenerateLaporanNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    use GenerateLaporanNumber;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Laporan/Index', [
            'laporan' => Laporan::with('user')->orderBy('id', 'desc')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Laporan/Create', [
            'barang' => Barang::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'rencana_kerja' => 'required|string',
            'lokasi'        => 'required|string|max:255'
        ]);

        DB::beginTransaction();

        try {
            $no = $this->generateLaporanNumber();

            $validated = array_merge($validated, ['user_id' => Auth::id(), 'status' => 'on_progress', 'no' => $no]);

            $laporan = Laporan::create($validated);

            $laporan->barang()->attach($request->perlengkapan);

            DB::commit();

            return back()->with('success', 'Laporan berhasil di buat');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return inertia('Laporan/Show', [
            'laporan' => Laporan::with(['user', 'barang'])->find($request->laporan)
        ]);
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
    public function update(Request $request, Laporan $laporan)
    {
        //
    }

    public function approve(Request $request, Laporan $laporan)
    {
        $laporan->update(['status' => 'approve']);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil di approve');
    }

    public function reject(Request $request, Laporan $laporan)
    {
        $laporan->update(['status' => 'reject']);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil di reject');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
