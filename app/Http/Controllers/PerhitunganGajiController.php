<?php

namespace App\Http\Controllers;

use App\Models\Qualification;
use App\Models\Allowance;
use App\Models\PerhitunganGaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth;

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
            $perhitungan_gajis = $user->perhitunganGajis;
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
        $qualificationId = $request->qualification_id;
        $allowanceIds = $request->allowances;

        $qualification = Qualification::findOrFail($qualificationId);
        $allowances = Allowance::whereIn('id', $allowanceIds)->get();

        $totalAllowance = $allowances->sum('amount');
        $totalGaji = $qualification->salary->gaji;

        // Hitung total_gaji dan total_allowance
        $totalSalary = $totalGaji * $totalAllowance;

        // Simpan data ke tabel total_salary
        $totalSalaryEntry = new TotalSalary([
            'total_allowance' => $totalAllowance,
            'total_gaji' => $totalGaji,
        ]);

        $qualification->allowances()->save($totalSalaryEntry, ['allowance_id' => $allowanceIds]);

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
