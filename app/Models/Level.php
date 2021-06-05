<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = "tb_level";
    protected $fillable = [
        'nama_level'
    ];
    public $timestamps = false;
}
