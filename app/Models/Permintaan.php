<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    use HasFactory;

    protected $table = "permintaans";
    protected $fillable = ['nama_barang',
    'jenis_barang',
    'harga',
    'link',
    'note',
    'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
