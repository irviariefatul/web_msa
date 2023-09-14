<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceFee extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','total_biaya_sdm',];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function perhitunganGajis()
    {
        return $this->belongsToMany(PerhitunganGaji::class, 'perhitungan_gajis_service_fees')->withPivot('perhitungan_gaji_id','estimasi');
    }

    public function applicationPrices()
    {
        return $this->hasMany(ApplicationPrice::class);
    }

}
