<?php

namespace App\Http\Controllers;

use App\Models\ServiceFee;
use App\Models\PerhitunganGaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ServiceFeeController extends Controller
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
            // Ambil semua data ServiceFee dengan relasi PerhitunganGajiServiceFee
            $service_fees = ServiceFee::with('perhitunganGajis')->get();
        } else {
            // Ambil data ServiceFee milik user saat ini dengan relasi PerhitunganGajiServiceFee
            $service_fees = $user->serviceFees()->with('perhitunganGajis')->get();
        }

        return view('service_fees.index', ['service_fees' => $service_fees]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $perhitungan_gajis = PerhitunganGaji::all();
        return view('service_fees.create', compact('perhitungan_gajis'));
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
    
        // Mengumpulkan data dari inputan form
        $inputData = $request->input('hrs');
    
        // Inisialisasi total biaya SDM
        $totalBiayaSDM = 0;
    
        // Array untuk menyimpan data estimasi
        $estimasiData = [];
    
        // Loop melalui data input
        foreach ($inputData as $input) {
            if (!empty($input['id']) && !empty($input['estimasi'])) {
                $perhitunganGaji = PerhitunganGaji::find($input['id']);
    
                if ($perhitunganGaji) {
                    // Mengalikan total_gaji dengan estimasi dan menambahkannya ke total biaya SDM
                    $totalBiayaSDM += $perhitunganGaji->total_gaji * $input['estimasi'];
    
                    // Menyimpan data estimasi ke dalam array untuk tabel pivot
                    $estimasiData[$input['id']] = [
                        'estimasi' => $input['estimasi'],
                        'user_id' => $user->id, // Tambahkan user_id ke dalam data estimasi
                    ];
                }
            }
        }
    
        // Simpan total biaya SDM ke dalam model ServiceFee
        $service_fees = new ServiceFee([
            'total_biaya_sdm' => $totalBiayaSDM,
        ]);
    
        // Simpan serviceFee ke dalam database
        $user->serviceFees()->save($service_fees);
    
        // Simpan data estimasi ke dalam tabel pivot
        $service_fees->perhitunganGajis()->attach($estimasiData);
    
        // Pastikan bahwa operasi penyimpanan data berhasil
        return redirect()->route('service_fees.index')->with('success', 'Calculate human resource cost and saved.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $serviceFee = ServiceFee::with('perhitunganGajis')->find($id);
        $perhitungan_gajis = PerhitunganGaji::with('allowances')->find($id);    
        if (!$serviceFee) {
            return redirect()->route('service_fees.index')->with('error', 'Human resource cost not found.');
        }
    
        return view('service_fees.show', compact('serviceFee', 'perhitungan_gajis'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $serviceFee = ServiceFee::find($id);

        if (!$serviceFee) {
            return redirect()->route('service_fees.index')->with('error', 'Human resource rost not found.');
        }

        return view('service_fees.edit', compact('serviceFee'));
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

        // Mengumpulkan data dari inputan form
        $inputData = $request->input('hrs');
    
        // Inisialisasi total biaya SDM
        $totalBiayaSDM = 0;
    
        // Array untuk menyimpan data estimasi
        $estimasiData = [];
    
        // Loop melalui data input
        foreach ($inputData as $input) {
            if (!empty($input['id']) && !empty($input['estimasi'])) {
                $perhitunganGaji = PerhitunganGaji::find($input['id']);
    
                if ($perhitunganGaji) {
                    // Mengalikan total_gaji dengan estimasi dan menambahkannya ke total biaya SDM
                    $totalBiayaSDM += $perhitunganGaji->total_gaji * $input['estimasi'];
    
                    // Menyimpan data estimasi ke dalam array untuk tabel pivot
                    $estimasiData[$input['id']] = [
                        'estimasi' => $input['estimasi'],
                        'user_id' => $user->id, // Tambahkan user_id ke dalam data estimasi
                    ];
                }
            }
        }
    
        // Temukan service fee yang akan diperbarui berdasarkan $id
        $service_fees = ServiceFee::find($id);
    
        if (!$service_fees) {
            // Handle jika service fee tidak ditemukan
            return redirect()->route('service_fees.index')->with('error', 'Human resource cost not found.');
        }
    
        // Update total biaya SDM
        $service_fees->total_biaya_sdm = $totalBiayaSDM;
        // Tambahkan kolom lain yang perlu diperbarui
    
        // Simpan perubahan ke dalam database
        $service_fees->save();
    
        // Synchronize data estimasi ke dalam tabel pivot
        $service_fees->perhitunganGajis()->sync($estimasiData);
    
        // Pastikan bahwa operasi pembaruan data berhasil
        return redirect()->route('service_fees.index')->with('success', 'Human resource cost updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $serviceFee = ServiceFee::find($id);

    if (!$serviceFee) {
        return redirect()->route('service_fees.index')->with('error', 'Human resource cost not found.');
    }

    // Hapus serviceFee
    $serviceFee->delete();

    return redirect()->route('service_fees.index')->with('success', 'Human resource cost deleted.');
    }

    public function __construct() {
        $this->middleware('auth');
    }
}
