<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_kamar',
        'no_kamar',
        'kapasitas_kamar',
        'jenis_kamar',
        'harga_kamar',
        'gambar'
    ];
}