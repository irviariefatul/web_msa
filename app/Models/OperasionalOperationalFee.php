<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperasionalOperationalFee extends Model
{
    use HasFactory;

    protected $table = "operasionals_operational_fees";
    protected $fillable = ['user_id','operational_id',
    'operational_fee_id', 'estimasi','pemeliharaan_opts', 'biaya_pemeliharaan_opts'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function operasionals()
    {
        return $this->belongsToMany(Operasional::class, 'operasionals_operational_fees', 'user_id','operational_id',
        'operational_fee_id');
    }

    public function operationalFees()
    {
        return $this->belongsToMany(OperationalFee::class, 'operasionals_operational_fees', 'user_id','operational_id',
        'operational_fee_id');
    }
}
