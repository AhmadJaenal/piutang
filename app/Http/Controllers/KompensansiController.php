<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contracts;
use App\Models\Compensation;
use App\Models\Compensharing;

class KompensansiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($contractId)
    {
        $contract = Contracts::findOrFail($contractId);
        $kompensasi = Compensation::where('contract_id', $contractId)->get();
        $kompensasiSharing = Compensharing::where('contract_id', $contractId)->get();

        return view('admin.contracts.kompensansi', [
            'contract' => $contract,
            'kompensasi' => $kompensasi,
            'kompensasiSharing' => $kompensasiSharing
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($contractId)
    {
        $contract = Contracts::findOrFail($contractId);
        return view('admin.contracts.cr_kompensansi', [
            'contract' => $contract
        ]);
    }

    public function createCompenshare($contractId)
    {
        $contract = Contracts::findOrFail($contractId);
        return view('admin.contracts.cr_kompensharing', [
            'contract' => $contract
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function storeCompenshare(Request $request, $contractId)
    {
        $request->validate([
            'tahun' => 'required|integer',
            'pendapatan_mitra' => 'required|numeric',
        ]);

        $tahun = $request->input('tahun');
        $pendapatanMitra = $request->input('pendapatan_mitra');
    
        $kompensasiSharing = $pendapatanMitra * 0.30;
    
        Compensharing::create([
            'contract_id' => $contractId,
            'tahun' => $tahun,
            'pendapatan_mitra' => $pendapatanMitra,
            'kompensasi_sharing' => $kompensasiSharing,
        ]);
    
        return redirect()->route('listCompensations', ['contractId' => $contractId])
                         ->with('success', 'Kompensasi Sharing berhasil disimpan');
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

    public function editCompenshare(string $contractId, $id)
    {
        $contract = Contracts::findOrFail($contractId);  
        $compenshare = Compensharing::findOrFail($id);  

    return view('admin.contracts.edt_kompensharing', compact('contract', 'compenshare'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function updateCompenshare(Request $request, string $contractId, $id)
    {
        // Validate the request data
    $request->validate([
        'tahun' => 'required|integer',
        'pendapatan_mitra' => 'required|numeric',
    ]);

    // Find the Compensharing record by both 'contract_id' and 'id'
    $kompensasiSharing = Compensharing::where('contract_id', $contractId)
                                      ->where('id', $id)
                                      ->firstOrFail();

    // Calculate the compensasi sharing
    $pendapatanMitra = $request->input('pendapatan_mitra');
    $kompensasiSharingAmount = $pendapatanMitra * 0.30;

    // Update the compensasi sharing record
    $kompensasiSharing->update([
        'tahun' => $request->input('tahun'),
        'pendapatan_mitra' => $pendapatanMitra,
        'kompensasi_sharing' => $kompensasiSharingAmount,
    ]);

    // Redirect back with a success message
    return redirect()->route('listCompensations', ['contractId' => $contractId])
                     ->with('success', 'Data Kompensasi Sharing berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function destroyCompenshare(string $contractId, $id)
    {
        $compenshare = Compensharing::where('contract_id', $contractId)
                                ->where('id', $id)
                                ->firstOrFail();
        $compenshare->delete();

        return redirect()->route('listCompensations', ['contractId' => $contractId])
                     ->with('success', 'Kompensasi Sharing berhasil dihapus');
    }

    public function trash()
    {
        //
    }

    public function trashCompenshare(string $contractId)
    {
        $trashedCompenshares = Compensharing::onlyTrashed()
                                        ->where('contract_id', $contractId)
                                        ->get();

        return view('admin.contracts.trh_kompensharing', [
            'trashedCompenshares' => $trashedCompenshares,
            'contractId' => $contractId
        ]);
    }

    /**
     * Restore the specified partner from trash.
     */
    public function restore(string $id)
    {
        //
    }

    public function restoreCompenshare(string $contractId, $id)
    {
        $compenshare = Compensharing::onlyTrashed()
                                ->where('contract_id', $contractId)
                                ->where('id', $id)
                                ->firstOrFail();
        $compenshare->restore();

        return redirect()->route('trashCompenshare', ['contractId' => $contractId])
                     ->with('success', 'Kompensasi Sharing berhasil dipulihkan');
    }

    /**
     * Permanently delete the specified partner from storage.
     */
    public function forceDelete(string $id)
    {
        //
    }

    public function forceDeleteCompenshare(string $id)
    {
        $compenshare = Compensharing::onlyTrashed()
                                ->where('contract_id', $contractId)
                                ->where('id', $id)
                                ->firstOrFail();
        $compenshare->forceDelete();

        return redirect()->route('trashCompenshare', ['contractId' => $contractId])
                     ->with('success', 'Kompensasi Sharing berhasil dihapus permanen');
    }
}
