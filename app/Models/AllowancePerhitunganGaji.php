<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllowancePerhitunganGaji extends Model
{
    use HasFactory;

    protected $table = "allowance_perhitungan_gajis";
    protected $fillable = ['allowance_id',
    'perhitungan_gaji_id'];

    public function perhitunganGajis()
    {
        return $this->belongsToMany(PerhitunganGaji::class, 'allowance_perhitungan_gajis', 'allowance_id', 'perhitungan_gaji_id');
    }

    public function allowances()
    {
        return $this->belongsToMany(Allowance::class, 'allowance_perhitungan_gajis', 'allowance_id', 'perhitungan_gaji_id');
    }
}
