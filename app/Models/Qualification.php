<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;

    protected $table = "qualifications";
    protected $fillable = ['user_id','salary_id',
    'layanan',
    'deskripsi_layanan',
    'jenjang_pendidikan',];

    public function salaries()
    {
        return $this->belongsTo(Salary::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function allowances()
    {
        return $this->belongsToMany(Allowance::class, 'perhitungan_gajis')
            ->withPivot('total_allowance', 'total_gaji');
    }
}
