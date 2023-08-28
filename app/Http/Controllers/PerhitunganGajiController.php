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
        $user = Auth::user();
        $qualificationId = $request->Qualification;
        $qualification = Qualification::findOrFail($qualificationId);
        $allowanceInputs = $request->input('Allowance');
        $allowanceIds = array_column($allowanceInputs, 'id');
        $allowances = Allowance::whereIn('id', $allowanceIds)->get();

        $totalAllowance = $allowances->sum('harga');
        $totalGaji = $qualification->salaries->gaji;
        $totalSalary = $totalGaji + $totalAllowance;

        $perhitunganGaji = PerhitunganGaji::create([
            'total_allowance' => $totalAllowance,
            'total_gaji' => $totalSalary,
            'user_id' => $user->id,
            'qualification_id' => $qualificationId,
        ]);

        foreach ($allowances as $allowance) {
            $perhitunganGaji->allowances()->attach($allowance->id, ['allowance_id' => $allowance->id]);
        }

        return redirect()->route('perhitungan_gajis.index')->with('success', 'Total salary calculated and saved.');
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $perhitunganGaji = PerhitunganGaji::findOrFail($id); 
        $allowances = Allowance::all();
        $qualifications = Qualification::all();
        return view('perhitungan-gajis.show', compact('perhitunganGaji', 'allowances', 'qualifications'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $perhitunganGaji = PerhitunganGaji::findOrFail($id); 
        $allowances = Allowance::all();
        $qualifications = Qualification::all();
        return view('perhitungan-gajis.edit', compact('perhitunganGaji', 'allowances', 'qualifications'));
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
        $qualificationId = $request->Qualification;
        $qualification = Qualification::findOrFail($qualificationId);
        $allowanceInputs = $request->input('Allowance');
        $allowanceIds = array_column($allowanceInputs, 'id');
        $allowances = Allowance::whereIn('id', $allowanceIds)->get();

        $totalAllowance = $allowances->sum('harga');
        $totalGaji = $qualification->salaries->gaji;
        $totalSalary = $totalGaji + $totalAllowance;

        $perhitunganGaji = PerhitunganGaji::findOrFail($id); // Menggunakan findOrFail untuk mencari data yang akan diupdate
        $perhitunganGaji->total_allowance = $totalAllowance;
        $perhitunganGaji->total_gaji = $totalSalary;
        $perhitunganGaji->user_id = $user->id;
        $perhitunganGaji->qualification_id = $qualificationId;
        $perhitunganGaji->save();

        $perhitunganGaji->allowances()->sync($allowanceIds); // Menggunakan sync untuk mengelola hubungan many-to-many

        return redirect()->route('perhitungan_gajis.index')->with('success', 'Total salary recalculated and updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perhitunganGaji = PerhitunganGaji::findOrFail($id);

    // Pastikan hanya admin atau pemilik yang dapat menghapus
    if (!Auth::user()->isAdmin() && $perhitunganGaji->user_id !== Auth::user()->id) {
        return redirect()->route('perhitungan_gajis.index')->with('error', 'You are not authorized to delete this record.');
    }

    // Hapus relasi allowances sebelum menghapus data perhitungan gaji
    $perhitunganGaji->allowances()->detach();

    // Hapus data perhitungan gaji
    $perhitunganGaji->delete();

    return redirect()->route('perhitungan_gajis.index')->with('success', 'Calculation record deleted successfully.');
    }

    public function __construct() {
        $this->middleware('auth');
        }
    
}


