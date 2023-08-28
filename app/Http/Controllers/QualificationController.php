<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Qualification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth;

class QualificationController extends Controller
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
            $qualifications = Qualification::with('salaries')->get();
        } else {
            $qualifications = $user->qualifications;
        }

        return view('qualifications.index', compact('qualifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $salaries = Salary::all();
        return view('qualifications.create', compact('salaries'));
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
    
        $qualification = new Qualification;
        $qualification->layanan = $request->layanan;
        $qualification->deskripsi_layanan = $request->deskripsi_layanan;
        $qualification->jenjang_pendidikan = $request->jenjang_pendidikan;
        $qualification->user_id = $user->id;

        $salaries = new Salary;
        $salaries->id = $request->Salary;

        $qualification->salaries()->associate($salaries);
        $qualification->save();

        return redirect()->route('qualifications.index')->with('success', 'Data added successfully!');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $qualification = Qualification::findOrFail($id);

        if (!Auth::user()->isAdmin() && $qualification->user_id !== Auth::id()) {
            return redirect()->route('qualifications.index')->with('error', 'You are not authorized to view this qualification.');
        }

        return view('qualifications.show', compact('qualification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $qualification = Qualification::findOrFail($id);
        $salaries = Salary::all();

        if (!Auth::user()->isAdmin() && $qualification->user_id !== Auth::id()) {
            return redirect()->route('qualifications.index')->with('error', 'You are not authorized to edit this qualification.');
        }

        return view('qualifications.edit', compact('qualification', 'salaries'));
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
        $qualification = Qualification::findOrFail($id);

        if (!Auth::user()->isAdmin() && $qualification->user_id !== Auth::id()) {
        return redirect()->route('qualifications.index')->with('error', 'You are not authorized to update this qualification.');
        }

        $qualification->layanan = $request->layanan;
        $qualification->deskripsi_layanan = $request->deskripsi_layanan;
        $qualification->jenjang_pendidikan = $request->jenjang_pendidikan;

        $salary = Salary::findOrFail($request->Salary);
        $qualification->salaries()->associate($salary);
        $qualification->save();

        return redirect()->route('qualifications.index')->with('success', 'Data updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $qualification = Qualification::findOrFail($id);

        if (! $user->isAdmin() && $qualification->user_id !== $user->id) {
            return redirect()->route('qualifications.index')->with('error', 'You are not authorized to delete this qualification.');
        }

        $qualification->delete();
        return redirect()->route('qualifications.index')->with('success', 'Data deleted successfully!');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
