<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "tb_order";
    protected $fillable = [
        'id_admin',
        'id_pengunjung',
        'waktu_pesan',
        'no_meja',
        'total_harga',
        'uang_bayar',
        'uang_kembali',
        'status_order',
    ];
    public $timestamps = false;
}
