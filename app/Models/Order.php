<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "Order";
    protected $fillable = [
        'UserId',
        'Total',
        'Bayar',
        'Kembali',
        'StatusOrder',
        'CreatedTime',
    ];
    public $timestamps = false;
}

class OrderDetail extends Model
{
    protected $table = "OrderDetail";
    protected $fillable = [
        'OrderId',
        'ProductId',
        'Qty',
        'SubTotal',
    ];
    public $timestamps = false;
}

class Cart extends Model
{
    protected $table = "Cart";
    protected $fillable = [
        'UserId',
        'ProductId',
        'Qty',
        'StatusCart',
        'CreatedTime',
    ];
    public $timestamps = false;
}
