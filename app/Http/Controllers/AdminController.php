<?php

namespace App\Http\Controllers;

use App\Exports\ExcelDaily;
use App\Exports\ExcelMonthly;
use App\Library\JsonRes;
use App\Library\Utilities;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
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
        $product = Product::select(
                        'tb_masakan.id_masakan',
                        'tb_masakan.nama_masakan',
                        'tb_masakan.gambar_masakan',
                        'tb_masakan.harga',
                        'tb_masakan.stok',
                        DB::raw('SUM(OrderDetail.Qty) AS Quantity'),
                        DB::raw('SUM(OrderDetail.SubTotal) AS Total')
                    )
                    ->leftJoin('OrderDetail', 'tb_masakan.id_masakan', '=', 'OrderDetail.ProductId')
                    ->groupBy('tb_masakan.id_masakan')
                    ->orderBy('Quantity', 'desc')
                    ->limit(5)
                    ->get();
        $data = [
            'product' => $product,
        ];
        return view('admins.dashboards.dasbor', $data);
    }

    public function level()
    {
        return view('admins.users.level');
    }

    public function user()
    {
        return view('admins.users.user');
    }

    public function product()
    {
        return view('admins.dashboards.item');
    }

    public function order()
    {
        return view('admins.transactions.order');
    }
    public function transaction()
    {
        return view('admins.transactions.transaksi');
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
        $pdf = PDF::loadview('admins.transactions.pdf', $data);
        return $pdf->stream();
    }

    public function transaksiMonhtExcel(Request $request)
    {
        $month = Carbon::parse($request->dateMonth)->format('m');
        return Excel::download(new ExcelMonthly($month), 'Penjualan_Monthly.xlsx');
    }

    public function transaksiDailyExcel(Request $request)
    {
        $day = Carbon::parse($request->dateDay)->format('d');
        return Excel::download(new ExcelDaily($day), 'Penjualan_Daily.xlsx');
    }
}
