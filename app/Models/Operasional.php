<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operasional extends Model
{
    use HasFactory;

    protected $table = "operasionals";
    protected $fillable = ['nama_operasional','deskripsi','harga',];

    public function operationalFees()
    {
        return $this->belongsToMany(OperationalFee::class,'operasionals_operational_fees')->withPivot('biaya_pemeliharaan_opts', 'estimasi', 'pemeliharaan_opts');
    }
}
