<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerhitunganGaji extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','qualification_id','total_allowance','total_gaji',];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function qualifications()
    {
        return $this->belongsTo(Qualification::class, 'qualification_id');
    }

    public function allowances()
    {
        return $this->belongsToMany(Allowance::class, 'allowance_perhitungan_gajis');
    }

    public function serviceFees()
    {
        return $this->belongsToMany(ServiceFee::class, 'perhitungan_gajis_service_fees')->withPivot('perhitungan_gaji_id','estimasi');
    }
    
}
