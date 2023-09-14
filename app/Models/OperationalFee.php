<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationalFee extends Model
{
    use HasFactory;

    protected $table = "operational_fees";
    protected $fillable = ['user_id','layanan','total_biaya_operational','total_biaya_pemeliharaan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function operasionals()
    {
        return $this->belongsToMany(Operasional::class,'operasionals_operational_fees')->withPivot('biaya_pemeliharaan_opts', 'estimasi', 'pemeliharaan_opts');
    }

    public function applicationPrices()
    {
        return $this->hasMany(ApplicationPrice::class);
    }
}
