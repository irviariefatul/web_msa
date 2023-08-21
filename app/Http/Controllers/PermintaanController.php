<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth;

class PermintaanController extends Controller
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
            $permintaan = Permintaan::all();
        } else {
            $permintaan = $user->permintaans;
        }

        return view('permintaans.index', ['permintaan' => $permintaan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permintaans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    // Melakukan pengecekan user
    $user = Auth::user();

    // Validasi input sesuai kebutuhan Anda
    $validatedData = $request->validate([
        'nama_barang' => 'required|string|max:255',
        'jenis_barang' => 'required|in:Investment,Operational',
        'harga' => 'required|numeric|min:0.01',
        'link' => 'required|url',
        'note'=> 'string|nullable',
    ]);

    $user->permintaans()->create($validatedData + ['status' => 'Pending']);
    // Redirect atau lakukan apa yang perlu setelah berhasil menyimpan
    return redirect()->route('permintaans.index')->with('status', 'Request added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permintaan = Permintaan::findOrFail($id);
        $user = Auth::user();

        if ($user->isAdmin() || $permintaan->user_id === $user->id) {
            return view('permintaans.show', compact('permintaan'));
        }

        return abort(403, 'Unauthorized');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permintaan = Permintaan::findOrFail($id);
        $user = Auth::user();

        if ($user->isAdmin() || $permintaan->user_id === $user->id) {
            return view('permintaans.edit', compact('permintaan'));
        }

        return abort(403, 'Unauthorized');
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
        $permintaan = Permintaan::findOrFail($id);
        $user = Auth::user();

    if ($user->isAdmin() || $permintaan->user_id === $user->id) {
        $validatedData = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jenis_barang' => 'required|in:Investment,Operational',
            'harga' => 'required|numeric|min:0.01',
            'link' => 'required|url',
            'note'=> 'string|nullable',
        ]);
    
        $permintaan->update($validatedData + ['status' => 'Pending']);

        return redirect()->route('permintaans.index')->with('status', 'Request updated successfully.');
    }
    return abort(403, 'Unauthorized');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permintaan = Permintaan::findOrFail($id);
        $user = Auth::user();

        if ($user->isAdmin() || $permintaan->user_id === $user->id) {
            $permintaan->delete();
            return redirect()->route('permintaans.index');
        }

        return abort(403, 'Unauthorized');
    }

    public function __construct() {
        $this->middleware('auth');
        }

    public function updateStatus(Request $request, $id){
        $permintaan = Permintaan::findOrFail($id);
            
        $newStatus = $request->input('status');
        $permintaan->status = $newStatus;
        $permintaan->save();
        
        return redirect()->back()->with('status', 'Status updated successfully.');
    }
        

}

