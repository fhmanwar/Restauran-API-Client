<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "tb_masakan";
    protected $fillable = [
        'nama_masakan',
        'harga',
        'stok',
        'status_masakan',
        'gambar_masakan',
    ];
    public $timestamps = false;
}
