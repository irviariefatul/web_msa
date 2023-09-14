<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationPrice extends Model
{
    use HasFactory;

    protected $table = "application_prices";
    protected $fillable = ['user_id','service_fee_id',
    'invest_fee_id', 'operational_fee_id','total_biaya_pemeliharaan', 'total_biaya_kebutuhan',
    'estimasi_bulan', 'estimasi_user', 'harga_aplikasi', 'persentase_biaya_admin', 'biaya_admin',
    'total_harga_aplikasi', 'jumlah_pemasukan', 'jumlah_keuntungan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function serviceFee()
    {
        return $this->belongsTo(ServiceFee::class);
    }

    public function investFee()
    {
        return $this->belongsTo(InvestFee::class, 'invest_fee_id');
    }
    
    public function operationalFee()
    {
        return $this->belongsTo(OperationalFee::class);
    }
}
