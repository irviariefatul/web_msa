<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerhitunganGaji extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','qualification_id','allowance_id','total_allowance','total_gaji',];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
