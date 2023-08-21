<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = ['nama_posisi',
    'kompetensi',
    'gaji',];

    public function qualifications()
    {
        return $this->hasMany(Qualification::class);
    }
}
