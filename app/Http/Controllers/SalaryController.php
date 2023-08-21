<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salary = Salary::all();
        return view('salaries.index', ['salary' => $salary]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('salaries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    // Validasi input sesuai kebutuhan 
    $validatedData = $request->validate([
        'nama_posisi' => 'required|string|max:255',
        'kompetensi' => 'required|string|max:255',
        'gaji' => 'required|numeric|min:0.01',
    ]);

    // Buat objek Permintaan dengan data yang divalidasi
    $salary = new Salary([
        'nama_posisi' => $validatedData['nama_posisi'],
        'kompetensi' => $validatedData['kompetensi'],
        'gaji' => $validatedData['gaji'],
     // Atur status default di sini
    ]);

    // Simpan objek Permintaan ke dalam database
    $salary->save();

    // Redirect atau lakukan apa yang perlu setelah berhasil menyimpan
    return redirect()->route('salaries.index')->with('status', 'Salary added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $salary = Salary::find($id);
    return view('salaries.show', compact('salary'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $salary = Salary::findOrFail($id);
        return view('salaries.edit', compact('salary'));
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
        // Validasi input sesuai kebutuhan Anda
        $validatedData = $request->validate([
            'nama_posisi' => 'required|string|max:255',
            'kompetensi' => 'required|string|max:255',
            'gaji' => 'required|numeric|min:0.01',
        ]);

        // Temukan data yang ingin diupdate
        $salary = Salary::findOrFail($id);

        // Update data dengan data yang divalidasi
        $salary->update([
            'nama_posisi' => $validatedData['nama_posisi'],
            'kompetensi' => $validatedData['kompetensi'],
            'gaji' => $validatedData['gaji'],
        ]);

        // Redirect atau lakukan apa yang perlu setelah berhasil mengupdate
        return redirect()->route('salaries.index')->with('status', 'Salary updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $salary = Salary::find($id);
        $salary->delete();
        return redirect()->route('salaries.index');
    }

    public function __construct() {
        $this->middleware('auth');
    }
}