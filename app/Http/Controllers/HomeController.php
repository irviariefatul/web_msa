<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Permintaan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalUsers = User::count();
        $totalPermintaans = Permintaan::count();
        $totalPendingPermintaans = Permintaan::where('status', 'pending')->count();
        //$totalKematian = Kematian::count();
        //$totalKK = KartuKeluarga::count();

        return view('home', compact(
            'totalUsers','totalPermintaans', 'totalPendingPermintaans',
        ));

        $user = Auth::user();
        return view('home',['user' => $user]);
    }
}
