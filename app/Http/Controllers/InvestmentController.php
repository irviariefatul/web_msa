<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $investments = Investment::all();
        return view('investments.index', ['investments' => $investments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('investments.create');
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
            'nama_invest' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0.01',
        ]);

        // Buat objek Permintaan dengan data yang divalidasi
        $investments = new Investment([
            'nama_invest' => $validatedData['nama_invest'],
            'deskripsi' => $validatedData['deskripsi'],
            'harga' => $validatedData['harga'],
        // Atur status default di sini
        ]);

        // Simpan objek Permintaan ke dalam database
        $investments->save();

        // Redirect atau lakukan apa yang perlu setelah berhasil menyimpan
        return redirect()->route('investments.index')->with('status', 'Investment added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $investment = Investment::findOrFail($id);
        return view('investments.show', compact('investment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $investment = Investment::findOrFail($id);
        return view('investments.edit', compact('investment'));
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
            'nama_invest' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0.01',
        ]);
    
        $investment = Investment::findOrFail($id);
        $investment->nama_invest = $validatedData['nama_invest'];
        $investment->deskripsi = $validatedData['deskripsi'];
        $investment->harga = $validatedData['harga'];
        $investment->save();
    
        return redirect()->route('investments.index')->with('status', 'Investment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $investment = Investment::findOrFail($id);
        $investment->delete();

        return redirect()->route('investments.index')->with('status', 'Investment deleted successfully.');
    }

    public function __construct() {
        $this->middleware('auth');
        }
}
