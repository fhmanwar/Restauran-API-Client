<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Library\JsonRes;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index()
    {
        $first = Carbon::parse('2021-02')->startOfDay()->format('d');
        $second = Carbon::parse('2021-02')->startOfMonth()->format('d');
        $last1 = Carbon::parse('2021-02')->lastOfMonth()->format('d');
        $data = [
            'test1' => $first,
            'test2' => $second,
            'test3' => $last1,
        ];
        return JsonRes::data(true, 'Successfully', $data);
    }

    public function chart()
    {
        $data = Product::select(
            'tb_masakan.id_masakan',
            'tb_masakan.nama_masakan',
            'tb_masakan.harga',
            DB::raw('SUM(OrderDetail.Qty) AS Quantity'),
            DB::raw('SUM(OrderDetail.SubTotal) AS Total')
        )
        ->leftJoin('OrderDetail', 'tb_masakan.id_masakan', '=', 'OrderDetail.ProductId')
        ->groupBy('tb_masakan.id_masakan')
        ->groupBy('tb_masakan.nama_masakan')
        ->groupBy('tb_masakan.harga')
        ->orderBy('Quantity', 'desc')
        ->get();
        // return JsonRes::data(true, 'Successfully', $data);
        return response()->json($data);
    }

    public function dataCount()
    {
        $customer = User::leftJoin('tb_level', 'tb_user.id_level', '=', 'tb_level.id')
                    ->where('tb_level.nama_level', '<>', 'Administrator')
                    ->get()
                    ->count();

        $staff = User::leftJoin('tb_level', 'tb_user.id_level', '=', 'tb_level.id')
                ->where('tb_level.nama_level', '=', 'Administrator')
                ->get()
                ->count();

        $sale = Order::sum(DB::raw('Total'));
        $orderTotal = Order::count();

        $data = [
            'customer' => $customer,
            'staff' => $staff,
            'sale' => $sale,
            'order' => $orderTotal,
        ];
        return JsonRes::data(true, 'Successfully', $data);
    }
}
