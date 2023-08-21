<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allowance extends Model
{
    use HasFactory;
    protected $fillable = ['nama_tunjangan',
    'deskripsi',
    'harga',];

    public function qualifications()
    {
        return $this->belongsToMany(Qualification::class, 'perhitungan_gajis')
            ->withPivot('total_allowance', 'total_gaji');
    }
}
