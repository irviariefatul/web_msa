<?php

namespace App\Http\Controllers;

use App\Models\OperationalFee;
use App\Models\Operasional;
use App\Models\OperasionalOperationalFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class OperationalFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $operational_fees = OperationalFee::with('operasionals')->get();
        } else {
            $operational_fees = $user->operationalFees()->with('operasionals')->get();
        }

        return view('operational_fees.index', ['operational_fees' => $operational_fees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $operationals = Operasional::all();
        return view('operational_fees.create', compact('operationals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
    
        $validatedData = $request->validate([
            'layanan' => 'required|string|max:255',
        ]);
        // Mengumpulkan data dari inputan form
        $inputData = $request->input('opts');
    
        $persentase = 0;
        $totalBiayaInvest = 0;
        $totalBiayaPemeliharaan = 0;
        $totalBiayaPemeliharaan2 = 0;

        // Array untuk menyimpan data estimasi
        $estimasiData = [];
    
        // Loop melalui data input
        foreach ($inputData as $input) {
            if (!empty($input['id']) && !empty($input['estimasi_opts']) || !empty($input['pemeliharaan_opts'])) {
                $operasional = Operasional::find($input['id']);
    
                if ($operasional) {
                    $persentase = $input['pemeliharaan_opts'] / 100;
                    $totalBiayaInvest += $operasional->harga * $input['estimasi_opts'];
                    $totalBiayaPemeliharaan += $operasional->harga * $input['estimasi_opts'] * $persentase;
                    $totalBiayaPemeliharaan2 = $operasional->harga * $input['estimasi_opts'] * $persentase;
    
                    // Menyimpan data estimasi ke dalam array untuk tabel pivot
                    $estimasiData[$input['id']] = [
                        'user_id' => $user->id,
                        'estimasi' => $input['estimasi_opts'],
                        'pemeliharaan_opts' => $persentase,
                        'biaya_pemeliharaan_opts' => $totalBiayaPemeliharaan2,
                    ];
                }
            }
        }
    
        // Simpan total biaya SDM ke dalam model ServiceFee
        $operational_fees = new OperationalFee([
            'layanan' => $validatedData['layanan'],
            'total_biaya_operational' => $totalBiayaInvest,
            'total_biaya_pemeliharaan' => $totalBiayaPemeliharaan,
        ]);
    
        // Simpan serviceFee ke dalam database
        $user->operationalFees()->save($operational_fees);
    
        // Simpan data estimasi ke dalam tabel pivot
        $operational_fees->operasionals()->attach($estimasiData);
    
        // Pastikan bahwa operasi penyimpanan data berhasil
        return redirect()->route('operational_fees.index')->with('success', 'Calculate operational component costs and saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $operationalFee = OperationalFee::with('operasionals')->find($id);
    
        if (!$operationalFee) {
            return redirect()->route('operational_fees.index')->with('error', 'Operational component costs not found.');
        }
    
        return view('operational_fees.show', compact('operationalFee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $operationalFee = OperationalFee::with('operasionals')->find($id);
    
        if (!$operationalFee) {
            return redirect()->route('operational_fees.index')->with('error', 'Operational component costs not found.');
        }
    
        $operationals = Operasional::all();
        
        return view('operational_fees.edit', compact('operationalFee', 'operationals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'layanan' => 'required|string|max:255',
        ]);
    
        $operationalFee = OperationalFee::find($id);
    
        if (!$operationalFee) {
            return redirect()->route('operational_fees.index')->with('error', 'Operational component costs not found.');
        }

        $inputData = $request->input('opts');

        $persentase = 0;
        $totalBiayaInvest = 0;
        $totalBiayaPemeliharaan = 0;
        $totalBiayaPemeliharaan2 = 0;

        // Array untuk menyimpan data estimasi
        $estimasiData = [];
    
        // Loop melalui data input
        foreach ($inputData as $input) {
            if (!empty($input['id']) && !empty($input['estimasi_opts']) || !empty($input['pemeliharaan_opts'])) {
                $operasional = Operasional::find($input['id']);
    
                if ($operasional) {
                    $persentase = $input['pemeliharaan_opts'] / 100;
                    $totalBiayaInvest += $operasional->harga * $input['estimasi_opts'];
                    $totalBiayaPemeliharaan += $operasional->harga * $input['estimasi_opts'] * $persentase;
                    $totalBiayaPemeliharaan2 = $operasional->harga * $input['estimasi_opts'] * $persentase;
    
                    // Menyimpan data estimasi ke dalam array untuk tabel pivot
                    $estimasiData[$input['id']] = [
                        'user_id' => $user->id,
                        'estimasi' => $input['estimasi_opts'],
                        'pemeliharaan_opts' => $persentase,
                        'biaya_pemeliharaan_opts' => $totalBiayaPemeliharaan2,
                    ];
                }
            }
        }

    // Update total biaya SDM ke dalam model InvestFee yang ada
    $operasionalFee->update([
        'layanan' => $validatedData['layanan'],
        'total_biaya_invest' => $totalBiayaInvest,
        'total_biaya_pemeliharaan' => $totalBiayaPemeliharaan,
    ]);

    // Update data estimasi ke dalam tabel pivot
    $operationalFee->operasionals()->sync($estimasiData);

    return redirect()->route('operational_fees.index')->with('success', 'Operational component costs updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $operationalFee = OperationalFee::find($id);

        if (!$operationalFee) {
            return redirect()->route('operational_fees.index')->with('error', 'Operational component cost found.');
        }
    
        // Hapus serviceFee
        $operationalFee->delete();
    
        return redirect()->route('operational_fees.index')->with('success', 'Operational component cost deleted.');
    }
    
    public function __construct() {
            $this->middleware('auth');
    }
}
