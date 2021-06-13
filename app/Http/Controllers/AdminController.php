<?php

namespace App\Http\Controllers;

use App\Library\JsonRes;
use App\Library\Utilities;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PDF;

class AdminController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        // $value = $request->session()->get('key');
        // $this->middleware(function ($request, $next) { });
        if (!session('statusLogin')) {
            return redirect()->route('login')->with('status', 'Login dulu bray!');
        }
    }

    public function index()
    {
        return view('admin.dashboard.dasbor');
    }

    public function level()
    {
        return view('admin.user.level');
    }

    public function user()
    {
        return view('admin.user.user');
    }

    public function product()
    {
        return view('admin.dashboard.item');
    }

    public function order()
    {
        return view('admin.transaction.order');
    }
    public function transaction()
    {
        return view('admin.transaction.transaksi');
    }
    public function laporan()
    {
        return view('admin.transaction.laporan');
    }

    public function print($id)
    {
        $order = Order::select(
                'Order.id as OrderId',
                'Order.NoMeja as noMeja',
                'Order.Total',
                'Order.Bayar',
                'Order.Kembali',
                'Order.CreatedTime as OrderTime',
                'Order.UserId as UserId',
                'tb_user.nama_user as Name',
            )
            ->leftJoin('tb_user', 'Order.UserId','=','tb_user.id_user')
            ->where([
                ['Order.id', '=', $id],
                // ['Order.id', '=', 1],
            ])
            ->first();
        $orderDet = OrderDetail::select(
                'OrderDetail.Id as OrderDetId',
                'OrderDetail.Qty',
                'OrderDetail.SubTotal',
                'OrderDetail.ProductId',
                'tb_masakan.nama_masakan',
                'tb_masakan.harga',
                'tb_masakan.gambar_masakan',
            )
            ->leftJoin('Order', 'Order.Id','=','OrderDetail.OrderId')
            ->leftJoin('tb_masakan', 'OrderDetail.ProductId','=','tb_masakan.id_masakan')
            ->where([
                ['OrderDetail.OrderId', '=', $id],
                // ['OrderDetail.OrderId', '=', 1],
            ])
            ->get();

        $data = [
            'order' => $order,
            'detail' => $orderDet,
        ];

        // return Utilities::printPreview($data);
        $pdf = PDF::loadview('admin.transaction.pdf', $data);
        return $pdf->stream();
    }
}
