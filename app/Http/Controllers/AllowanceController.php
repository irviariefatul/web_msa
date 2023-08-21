<?php

namespace App\Http\Controllers;

use App\Models\Allowance;
use Illuminate\Http\Request;

class AllowanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allowance = Allowance::all();
        return view('allowances.index', ['allowance' => $allowance]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('allowances.create');
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
        'nama_tunjangan' => 'required|string|max:255',
        'deskripsi' => 'required|string|max:255',
        'harga' => 'required|numeric|min:0.01',
    ]);

    // Buat objek Permintaan dengan data yang divalidasi
    $allowance = new Allowance([
        'nama_tunjangan' => $validatedData['nama_tunjangan'],
        'deskripsi' => $validatedData['deskripsi'],
        'harga' => $validatedData['harga'],
     // Atur status default di sini
    ]);

    // Simpan objek Permintaan ke dalam database
    $allowance->save();

    // Redirect atau lakukan apa yang perlu setelah berhasil menyimpan
    return redirect()->route('allowances.index')->with('status', 'Allowance added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $allowance = Allowance::find($id);
    return view('allowances.show', compact('allowance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $allowance = Allowance::findOrFail($id);
    return view('allowances.edit', compact('allowance'));
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
        // Validasi input sesuai kebutuhan
    $validatedData = $request->validate([
        'nama_tunjangan' => 'required|string|max:255',
        'deskripsi' => 'required|string|max:255',
        'harga' => 'required|numeric|min:0.01',
    ]);

    // Temukan data yang ingin diupdate
    $allowance = Allowance::findOrFail($id);

    // Update data dengan data yang divalidasi
    $allowance->update([
        'nama_tunjangan' => $validatedData['nama_tunjangan'],
        'deskripsi' => $validatedData['deskripsi'],
        'harga' => $validatedData['harga'],
    ]);

    // Redirect atau lakukan apa yang perlu setelah berhasil mengupdate
    return redirect()->route('allowances.index')->with('status', 'Allowance updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $allowance = Allowance::find($id);
        $allowance->delete();
        return redirect()->route('allowances.index');
    }
    public function __construct() {
        $this->middleware('auth');
    }
}
