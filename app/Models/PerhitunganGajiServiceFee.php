<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\PerhitunganGaji;
use App\ServiceFee;

class PerhitunganGajiServiceFee extends Model
{
    use HasFactory;

    protected $table = "perhitungan_gajis_service_fees";
    protected $fillable = ['user_id','perhitungan_gaji_id',
    'service_fee_id', 'estimasi'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Definisikan relasi Many-to-Many ke tabel perhitungan_gajis
    public function perhitunganGajis()
    {
        return $this->belongsToMany(PerhitunganGaji::class, 'perhitungan_gajis_service_fees', 'service_fee_id', 'perhitungan_gaji_id');
    }

    // Definisikan relasi Many-to-Many ke tabel service_fees
    public function serviceFees()
    {
        return $this->belongsToMany(ServiceFee::class, 'perhitungan_gajis_service_fees', 'perhitungan_gaji_id', 'service_fee_id');
    }
}
