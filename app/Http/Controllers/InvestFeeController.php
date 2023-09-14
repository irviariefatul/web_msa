<?php

namespace App\Http\Controllers;

use App\Models\InvestFee;
use App\Models\Investment;
use App\Models\InvestmentInvestFee; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class InvestFeeController extends Controller
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
            $invest_fees = InvestFee::with('investments')->get();
        } else {
            $invest_fees = $user->investFees()->with('investments')->get();
        }

        return view('invest_fees.index', ['invest_fees' => $invest_fees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $investments = Investment::all();
        return view('invest_fees.create', compact('investments'));
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
        $inputData = $request->input('ivts');
    
        $persentase = 0;
        $totalBiayaInvest = 0;
        $totalBiayaPemeliharaan = 0;
        $totalBiayaPemeliharaan2 = 0;

        // Array untuk menyimpan data estimasi
        $estimasiData = [];
    
        // Loop melalui data input
        foreach ($inputData as $input) {
            if (!empty($input['id']) && !empty($input['estimasi_ivts']) || !empty($input['pemeliharaan_ivts'])) {
                $investment = Investment::find($input['id']);
    
                if ($investment) {
                    // Mengalikan total_gaji dengan estimasi dan menambahkannya ke total biaya SDM
                    $persentase = $input['pemeliharaan_ivts'] / 100;
                    $totalBiayaInvest += $investment->harga * $input['estimasi_ivts'];
                    $totalBiayaPemeliharaan += $investment->harga * $input['estimasi_ivts'] * $persentase;
                    $totalBiayaPemeliharaan2 = $investment->harga * $input['estimasi_ivts'] * $persentase;
    
                    // Menyimpan data estimasi ke dalam array untuk tabel pivot
                    $estimasiData[$input['id']] = [
                        'user_id' => $user->id,
                        'estimasi' => $input['estimasi_ivts'],
                        'pemeliharaan_ivts' => $persentase,
                        'biaya_pemeliharaan_ivts' => $totalBiayaPemeliharaan2,
                    ];
                }
            }
        }
    
        // Simpan total biaya SDM ke dalam model ServiceFee
        $invest_fees = new InvestFee([
            'layanan' => $validatedData['layanan'],
            'total_biaya_invest' => $totalBiayaInvest,
            'total_biaya_pemeliharaan' => $totalBiayaPemeliharaan,
        ]);
    
        // Simpan serviceFee ke dalam database
        $user->investFees()->save($invest_fees);
    
        // Simpan data estimasi ke dalam tabel pivot
        $invest_fees->investments()->attach($estimasiData);
    
        // Pastikan bahwa operasi penyimpanan data berhasil
        return redirect()->route('invest_fees.index')->with('success', 'Calculate investment component costs and saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $investFee = InvestFee::with('investments')->find($id);
    
        if (!$investFee) {
            return redirect()->route('invest_fees.index')->with('error', 'Investment component costs not found.');
        }
    
        return view('invest_fees.show', compact('investFee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $investFee = InvestFee::with('investments')->find($id);
    
        if (!$investFee) {
            return redirect()->route('invest_fees.index')->with('error', 'Investment component costs not found.');
        }
    
        $investments = Investment::all();
        
        return view('invest_fees.edit', compact('investFee', 'investments'));
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
        
        $investFee = InvestFee::find($id);
    
        if (!$investFee) {
            return redirect()->route('invest_fees.index')->with('error', 'Investment component costs not found.');
        }
    
        // Mengumpulkan data dari inputan form
        $inputData = $request->input('ivts');
    
        $persentase = 0;
        $totalBiayaInvest = 0;
        $totalBiayaPemeliharaan = 0;
        $totalBiayaPemeliharaan2 = 0;
    
        // Array untuk menyimpan data estimasi
        $estimasiData = [];
    
        // Loop melalui data input
        foreach ($inputData as $input) {
            if (!empty($input['id']) && (!empty($input['estimasi_ivts']) || !empty($input['pemeliharaan_ivts']))) {
                $investment = Investment::find($input['id']);
    
                if ($investment) {
                    // Mengalikan total_gaji dengan estimasi dan menambahkannya ke total biaya SDM
                    $persentase = $input['pemeliharaan_ivts'] / 100;
                    $totalBiayaInvest += $investment->harga * $input['estimasi_ivts'];
                    $totalBiayaPemeliharaan += $investment->harga * $input['estimasi_ivts'] * $persentase;
                    $totalBiayaPemeliharaan2 = $investment->harga * $input['estimasi_ivts'] * $persentase;
    
                    // Menyimpan data estimasi ke dalam array untuk tabel pivot
                    $estimasiData[$input['id']] = [
                        'user_id' => $user->id,
                        'estimasi' => $input['estimasi_ivts'],
                        'pemeliharaan_ivts' => $persentase,
                        'biaya_pemeliharaan_ivts' => $totalBiayaPemeliharaan2,
                    ];
                }
            }
        }
    
        // Update total biaya SDM ke dalam model InvestFee yang ada
        $investFee->update([
            'layanan' => $validatedData['layanan'],
            'total_biaya_invest' => $totalBiayaInvest,
            'total_biaya_pemeliharaan' => $totalBiayaPemeliharaan,
        ]);
    
        // Update data estimasi ke dalam tabel pivot
        $investFee->investments()->sync($estimasiData);
    
        // Pastikan bahwa operasi pembaruan data berhasil
        return redirect()->route('invest_fees.index')->with('success', 'Investment component costs updated.');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $investFee = InvestFee::find($id);

        if (!$investFee) {
            return redirect()->route('invest_fees.index')->with('error', 'Investment component cost found.');
        }
    
        // Hapus serviceFee
        $investFee->delete();
    
        return redirect()->route('invest_fees.index')->with('success', 'Investment component cost deleted.');
    }
    
    public function __construct() {
            $this->middleware('auth');
    }
}
