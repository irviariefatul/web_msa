<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestFee extends Model
{
    use HasFactory;

    protected $table = "invest_fees";
    protected $fillable = ['user_id','layanan','total_biaya_invest','total_biaya_pemeliharaan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function investments()
    {
        return $this->belongsToMany(Investment::class, 'investments_invest_fees')->withPivot('investment_id','estimasi','pemeliharaan_ivts', 'biaya_pemeliharaan_ivts');
    }

    public function applicationPrices()
    {
        return $this->hasMany(ApplicationPrice::class, 'invest_fee_id');
    }
}
