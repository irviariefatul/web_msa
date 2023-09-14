<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentInvestFee extends Model
{
    use HasFactory;

    protected $table = "investments_invest_fees";
    protected $fillable = ['user_id','invesment_id',
    'invest_fee_id', 'estimasi','pemeliharaan_ivts', 'biaya_pemeliharaan_ivts'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function investments()
    {
        return $this->belongsToMany(Investment::class, 'investments_invest_fees', 'user_id','invesment_id',
        'invest_fee_id');
    }

    public function investFees()
    {
        return $this->belongsToMany(InvestFee::class, 'investments_invest_fees', 'user_id','invesment_id',
        'invest_fee_id');
    }
}
