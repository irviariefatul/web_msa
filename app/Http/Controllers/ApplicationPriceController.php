<?php

namespace App\Http\Controllers;

use App\Models\ApplicationPrice;
use App\Models\PerhitunganGaji;
use App\Models\ServiceFee;
use App\Models\InvestFee;
use App\Models\OperationalFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ApplicationPriceController extends Controller
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
            $applicationPrices = ApplicationPrice::with('investFee')->get();
        } else {
            $applicationPrices = $user->applicationPrices;
        }

        return view('application_prices.index',compact('applicationPrices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $serviceFees = ServiceFee::with('perhitunganGajis')->get();
        $investFees = InvestFee::with('investments')->get();
        $operationalFees = OperationalFee::with('operasionals')->get();
        return view('application_prices.create', compact('serviceFees','investFees', 'operationalFees'));
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
    
        $request->validate([
            'estimasi_bulan' => 'required|integer',
            'estimasi_user' => 'required|integer',
            'ServiceFee' => 'required|exists:service_fees,id',
            'InvestFee' => 'required|exists:invest_fees,id',
            'OperationalFee' => 'required|exists:operational_fees,id',
        ]);
    
        // Ambil ServiceFee, InvestFee, dan OperationalFee berdasarkan ID yang dipilih
        $selectedServiceFee = ServiceFee::findOrFail($request->input('ServiceFee'));
        $selectedInvestFee = InvestFee::findOrFail($request->input('InvestFee'));
        $selectedOperationalFee = OperationalFee::findOrFail($request->input('OperationalFee'));
    
        $totalBiayaPemeliharaan = 0; 
        // Etimasi bulan
        $estimasiBulan = $request->input('estimasi_bulan') * 12;
    
        // Presentase Fee Management
        $presentaseFee = $request->input('persentase_biaya_admin') / 100;
    
        // Biaya Pemeliharaan
        $biayaPemeliharaanInvest = $selectedInvestFee->total_biaya_pemeliharaan;
        $biayaPemeliharaanOperational = $selectedOperationalFee->total_biaya_pemeliharaan;
        $totalBiayaPemeliharaan = $biayaPemeliharaanInvest + $biayaPemeliharaanOperational;
    
        // Biaya Kebutuhan
        $totalBiayaSDM = $selectedServiceFee->total_biaya_sdm;
        $totalBiayaInvest = $selectedInvestFee->total_biaya_invest;
        $totalBiayaOperational = $selectedOperationalFee->total_biaya_operational;
        $biayaKebutuhan = $totalBiayaSDM + ($totalBiayaInvest/$estimasiBulan) + $totalBiayaOperational + $totalBiayaPemeliharaan;
    
        // Estimasi User
        $estimasiUsers = $request->input('estimasi_user');
    
        // Harga Aplikasi
        $hargaApp = $biayaKebutuhan / $estimasiUsers;
    
        // Biaya Admin
        $biayaAdmin = $hargaApp * $presentaseFee;
    
        // Total Harga Aplikasi
        $totalHargaApp = $hargaApp + $biayaAdmin;
    
        // Jumlah Pemasukan
        $jmlPemasukan = $totalHargaApp * $estimasiUsers;
    
        // Jumlah Keuntungan
        $jmlKeuntungan = $jmlPemasukan - $biayaKebutuhan;
    
        $applicationPrice = new ApplicationPrice([
            'user_id' => $user->id,
            'service_fee_id' => $selectedServiceFee->id,
            'invest_fee_id' => $selectedInvestFee->id,
            'operational_fee_id' => $selectedOperationalFee->id,
            'estimasi_bulan' => $estimasiBulan,
            'estimasi_user' => $estimasiUsers,
            'persentase_biaya_admin' => $presentaseFee,
            'total_biaya_pemeliharaan' => $totalBiayaPemeliharaan,
            'total_biaya_kebutuhan' => $biayaKebutuhan,
            'harga_aplikasi' => $hargaApp,
            'biaya_admin' => $biayaAdmin,
            'total_harga_aplikasi' => $totalHargaApp,
            'jumlah_pemasukan' => $jmlPemasukan,
            'jumlah_keuntungan' => $jmlKeuntungan,
        ]);
    
        $applicationPrice->save();
    
        return redirect()->route('application_prices.index')->with('success', 'Application Price added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find the application price by its ID
        $applicationPrices = ApplicationPrice::with(['serviceFee.perhitunganGajis.allowances.perhitunganGajis.qualifications', 'investFee', 'operationalFee'])->find($id);
    
        // Return a view to display the details of the application price
        return view('application_prices.show', compact('applicationPrices'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $applicationPrice = ApplicationPrice::findOrFail($id);
        $serviceFees = ServiceFee::with('perhitunganGajis')->get();
        $investFees = InvestFee::with('investments')->get();
        $operationalFees = OperationalFee::with('operasionals')->get();
        
        return view('application_prices.edit', compact('applicationPrice', 'serviceFees', 'investFees', 'operationalFees'));
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

        $request->validate([
            'estimasi_bulan' => 'required|integer',
            'estimasi_user' => 'required|integer',
            'ServiceFee' => 'required|exists:service_fees,id',
            'InvestFee' => 'required|exists:invest_fees,id',
            'OperationalFee' => 'required|exists:operational_fees,id',
        ]);
    
        $selectedServiceFee = ServiceFee::findOrFail($request->input('ServiceFee'));
        $selectedInvestFee = InvestFee::findOrFail($request->input('InvestFee'));
        $selectedOperationalFee = OperationalFee::findOrFail($request->input('OperationalFee'));
    
        $totalBiayaPemeliharaan = 0; 
        $estimasiBulan = $request->input('estimasi_bulan') * 12;
        $presentaseFee = $request->input('persentase_biaya_admin') / 100;
    
        $biayaPemeliharaanInvest = $selectedInvestFee->total_biaya_pemeliharaan;
        $biayaPemeliharaanOperational = $selectedOperationalFee->total_biaya_pemeliharaan;
        $totalBiayaPemeliharaan = $biayaPemeliharaanInvest + $biayaPemeliharaanOperational;
    
        $totalBiayaSDM = $selectedServiceFee->total_biaya_sdm;
        $totalBiayaInvest = $selectedInvestFee->total_biaya_invest;
        $totalBiayaOperational = $selectedOperationalFee->total_biaya_operational;
        $biayaKebutuhan = $totalBiayaSDM + ($totalBiayaInvest/$estimasiBulan) + $totalBiayaOperational + $totalBiayaPemeliharaan;
    
        $estimasiUsers = $request->input('estimasi_user');
        $hargaApp = $biayaKebutuhan / $estimasiUsers;
        $biayaAdmin = $hargaApp * $presentaseFee;
        $totalHargaApp = $hargaApp + $biayaAdmin;
        $jmlPemasukan = $totalHargaApp * $estimasiUsers;
        $jmlKeuntungan = $jmlPemasukan - $biayaKebutuhan;
    
        // Fetch the existing application price by ID
        $applicationPrice = ApplicationPrice::findOrFail($id);
        
        // Update the fields
        $applicationPrice->user_id = $user->id;
        $applicationPrice->service_fee_id = $selectedServiceFee->id;
        $applicationPrice->invest_fee_id = $selectedInvestFee->id;
        $applicationPrice->operational_fee_id = $selectedOperationalFee->id;
        $applicationPrice->estimasi_bulan = $estimasiBulan;
        $applicationPrice->estimasi_user = $estimasiUsers;
        $applicationPrice->persentase_biaya_admin = $presentaseFee;
        $applicationPrice->total_biaya_pemeliharaan = $totalBiayaPemeliharaan;
        $applicationPrice->total_biaya_kebutuhan = $biayaKebutuhan;
        $applicationPrice->harga_aplikasi = $hargaApp;
        $applicationPrice->biaya_admin = $biayaAdmin;
        $applicationPrice->total_harga_aplikasi = $totalHargaApp;
        $applicationPrice->jumlah_pemasukan = $jmlPemasukan;
        $applicationPrice->jumlah_keuntungan = $jmlKeuntungan;
    
        $applicationPrice->save();
    
        return redirect()->route('application_prices.index')->with('success', 'Application Price updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $applicationPrice = ApplicationPrice::find($id);

        if (!$applicationPrice) {
            return redirect()->route('application_prices.index')->with('error', 'Application price not found.');
        }
    
        // Hapus applicationPrice
        $applicationPrice->delete();
    
        return redirect()->route('application_prices.index')->with('success', 'Application Price deleted.');
    }
    
    public function __construct() {
            $this->middleware('auth');
    }
}
