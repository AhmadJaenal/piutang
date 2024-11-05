<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contracts;
use App\Models\Partners;
use App\Models\User;
use App\Models\Fields;
use Illuminate\Support\Str;
use Carbon\Carbon;

class KontrakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contracts = Contracts::with(['partner', 'field'])->get(); 
            return view('admin.contracts.index', [
            'contracts' => $contracts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $partners = Partners::all();
        $fields = Fields::all();
        return view('admin.contracts.create', [
            'partners' => $partners,
            'fields' => $fields
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'partner_id' => 'required|exists:partners,user_id',
            'field_id' => 'required|exists:fields,id',
            'badan_hukum' => 'required|string|max:255',
            'pic_aa' => 'required|string|max:255',
            'awal_janji' => 'required|date',
            'akhir_janji' => 'required|date|after_or_equal:awal_janji',
            'nilai' => 'required|integer|min:0',
            'no_pks' => 'required|url|max:255',
            'lokasi' => 'required|string|max:255',
            'kab_kota' => 'required|string|max:255',
            'luas' => 'required|integer|min:1',
            'no_wa' => 'nullable|string|max:20',
            'ket' => 'nullable|string|max:500',
        ]);
    
        // Menghitung jangka waktu (tahun) dari awal_janji dan akhir_janji
        $jangkaWaktu = Carbon::parse($request->akhir_janji)->diffInYears(Carbon::parse($request->awal_janji));

    
        // Menggunakan metode create untuk menyimpan data ke dalam model Contracts
        $contract = Contracts::create([
            'contract_code' => Contracts::generateContractNumber(),
            'partner_id' => $request->partner_id,
            'field_id' => $request->field_id,
            'badan_hukum' => $request->badan_hukum,
            'pic_aa' => $request->pic_aa,
            'awal_janji' => $request->awal_janji,
            'akhir_janji' => $request->akhir_janji,
            'nilai' => $request->nilai,
            'no_pks' => $request->no_pks,
            'kab_kota' => $request->kab_kota,
            'jangka_waktu' => $jangkaWaktu,
            'luas' => $request->luas,
            'no_wa' => $request->no_wa,
            'ket' => $request->ket,
            'status' => 'baru',
        ]);
    
        // Mengalihkan ke halaman index dengan pesan sukses
        return redirect()->route('listContracts')->with('success', 'Kontrak berhasil dibuat.');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
