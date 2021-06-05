<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "tb_user";
    protected $fillable = [
        'username',
        'password',
        'nama_user',
        'id_level',
        'status',
    ];
    public $timestamps = false;
}
