<?php

namespace App\ViewModels;

use Illuminate\Database\Eloquent\Model;

class ExcelVM extends Model
{
    protected $fillable = [
        'id_masakan',
        'nama_masakan',
        'Harga',
        'Quantity',
        'Total',
    ];
}
