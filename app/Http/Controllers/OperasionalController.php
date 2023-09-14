<?php

namespace App\Http\Controllers;

use App\Models\Operasional;
use Illuminate\Http\Request;

class OperasionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operasionals = Operasional::all();
        return view('operasionals.index', ['operasionals' => $operasionals]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('operasionals.create');
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
            'nama_operasional' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'harga' => 'required|numeric',
        ]);

        // Buat objek Permintaan dengan data yang divalidasi
        $operationals = new Operasional([
            'nama_operasional' => $validatedData['nama_operasional'],
            'deskripsi' => $validatedData['deskripsi'],
            'harga' => $validatedData['harga'],
        // Atur status default di sini
        ]);

        // Simpan objek Permintaan ke dalam database
        $operationals->save();

        // Redirect atau lakukan apa yang perlu setelah berhasil menyimpan
        return redirect()->route('operasionals.index')->with('status', 'Operational added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $operationals = Operasional::findOrFail($id);
        return view('operasionals.show', compact('operationals'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $operationals = Operasional::findOrFail($id);
        return view('operasionals.edit', compact('operationals'));
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
        $validatedData = $request->validate([
            'nama_operasional' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'harga' => 'required|numeric',
        ]);
    
        $operationals = Operasional::findOrFail($id);
        $operationals->nama_operasional = $validatedData['nama_operasional'];
        $operationals->deskripsi = $validatedData['deskripsi'];
        $operationals->harga = $validatedData['harga'];
        $operationals->save();
    
        return redirect()->route('operasionals.index')->with('status', 'Operational updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $operationals = Operasional::findOrFail($id);
        $operationals->delete();

        return redirect()->route('operasionals.index')->with('status', 'Investment deleted successfully.');
    }

    public function __construct() {
        $this->middleware('auth');
        }
}
