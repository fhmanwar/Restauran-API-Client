<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    protected $table = "tb_pesan";
    protected $fillable = [
        'id_order',
        'id_masakan',
        'jumlah',
        'status_pesan',
    ];
    public $timestamps = false;
}
