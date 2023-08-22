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

    public function salary()
    {
        return $this->belongsTo(Salary::class, 'salaries_id'); // Ubah sesuai dengan nama kolom foreign key pada tabel qualifications
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function allowance()
    {
        return $this->belongsToMany(Allowance::class)->withPivot('total_allowance');
    }
}
