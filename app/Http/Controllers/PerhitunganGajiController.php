<?php

namespace App\Http\Controllers;

use App\Models\Qualification;
use App\Models\Allowance;
use App\Models\PerhitunganGaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class PerhitunganGajiController extends Controller
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
            $perhitungan_gajis = PerhitunganGaji::all();
        } else {
            $perhitungan_gajis = $user->perhitungan_gajis;
        }

        return view('perhitungan-gajis.index', ['perhitungan_gajis' => $perhitungan_gajis,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allowances = Allowance::all();
        $qualifications = Qualification::all();
        return view('perhitungan-gajis.create', compact('allowances', 'qualifications'));
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

    $qualificationId = $request->Qualification;

    $qualification = Qualification::findOrFail($qualificationId);
    $salary = $qualification->salary;

    $allowanceIds = array_column($request->input('Allowance'), 'id'); // Ambil array of id dari Allowances
    $allowances = Allowance::whereIn('id', $allowanceIds)->get();

    $totalAllowance = $allowances->sum('amount');
    $totalGaji = $salary->gaji;

    $totalSalary = $totalGaji + $totalAllowance;

    $perhitunganGaji = PerhitunganGaji::create([
        'total_allowance' => $totalAllowance,
        'total_gaji' => $totalSalary,
    ]);

    $qualification->perhitunganGajis()->attach($perhitunganGaji->id, ['total_allowance' => $totalAllowance]);

    foreach ($allowances as $allowance) {
        // Menggunakan attach untuk menyimpan data pada tabel pivot
        $perhitunganGaji->allowances()->attach($allowance->id, ['total_allowance' => $allowance->amount]);
    }

    // Simpan relasi user
    $perhitunganGaji->user()->associate($user);
    $perhitunganGaji->save();

    return redirect()->route('perhitungan-gajis.index')->with('success', 'Total salary calculated and saved.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
}
