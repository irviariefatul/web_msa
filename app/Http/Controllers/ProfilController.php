<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('users.profil',['user' => $user]);
    }

    public function __construct() {
    $this->middleware('auth');
    }
}
