<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = "tb_level";
    protected $fillable = [
        'id_pesan',
        'jumlah_terjual',
        'status_cetak',
    ];
    public $timestamps = false;
}
