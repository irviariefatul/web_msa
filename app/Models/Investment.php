<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;

    protected $table = "investments";
    protected $fillable = ['nama_invest','deskripsi','harga',];

    public function investFees()
    {
        return $this->belongsToMany(InvestFee::class, 'investments_invest_fees')->withPivot('investment_id','estimasi','pemeliharaan_ivts', 'biaya_pemeliharaan_ivts');
    }
}
