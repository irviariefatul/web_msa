<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Permintaan;
use App\Models\PerhitunganGaji;
use App\Models\ApplicationPrice;

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
        $user = Auth::user();
        $totalUsers = User::count();
        $totalPermintaans = Permintaan::count();
        $totalPendingPermintaans = Permintaan::where('status', 'pending')->count();
        $totalSalaryCalculations = PerhitunganGaji::count();
        $totalApplicationPrices = ApplicationPrice::count();
        
        // Mengambil hanya data ApplicationPrices yang sesuai dengan user_id pengguna saat ini
        if ($user->isAdmin()) {
            $data = ApplicationPrice::with([
                'investFee'
            ])
                ->orderByDesc('jumlah_keuntungan')
                ->orderBy('total_harga_aplikasi')
                ->take(10)
                ->get();
        } else {
            $data = ApplicationPrice::with([
                'investFee'
            ])
                ->where('user_id', $user->id) // Menambahkan kondisi ini
                ->orderByDesc('jumlah_keuntungan')
                ->orderBy('total_harga_aplikasi')
                ->take(10)
                ->get();
        }
        
        // Mengambil 'layanan' dari data
        $labels = $data->map(function ($item) {
            if ($item->investFee) {
                return $item->investFee->layanan;
            }
            return '';
        });
        
        return view('home', compact(
            'user', 'totalUsers', 'totalPermintaans', 'totalPendingPermintaans',
            'totalSalaryCalculations', 'totalApplicationPrices', 'data', 'labels' // Menambahkan 'labels' ke dalam compact
        ));

        $user = Auth::user();
        return view('home',['user' => $user]);
    }
}
