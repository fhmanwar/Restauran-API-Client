<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Library\JsonRes;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index()
    {
        return JsonRes::data(true,'testing');
    }

    public function cartUserId($id)
    {
        $data = Cart::select('Cart.id','Cart.Qty','Cart.statusCart', 'Cart.createdTime','tb_user.nama_user', 'tb_masakan.id_masakan', 'tb_masakan.nama_masakan', 'tb_masakan.harga', 'tb_masakan.stok', 'tb_masakan.gambar_masakan')
                    ->leftJoin('tb_user', 'Cart.userId','=','tb_user.id_user')
                    ->leftJoin('tb_masakan', 'Cart.productId','=','tb_masakan.id_masakan')
                    ->where([
                        ['Cart.UserId', '=', $id],
                        ['Cart.StatusCart', '<>', 'true'],
                    ])
                    ->get();
        // return JsonRes::data(true, 'Successfully', $data);
        return response()->json($data);
    }

    public function cartById($id)
    {
        $data = Cart::select('Cart.id','Cart.Qty','Cart.statusCart', 'Cart.createdTime','tb_user.nama_user', 'tb_masakan.nama_masakan', 'tb_masakan.harga', 'tb_masakan.stok', 'tb_masakan.gambar_masakan')
                    ->leftJoin('tb_user', 'Cart.userId','=','tb_user.id_user')
                    ->leftJoin('tb_masakan', 'Cart.productId','=','tb_masakan.id_masakan')
                    ->where([
                        // ['Cart.UserId', '=', $id],
                        ['Cart.id', '=', $id],
                    ])
                    ->first();
        return JsonRes::data(true, 'Successfully', $data);
    }

    public function addToCart(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'UserId' => 'required',
            'productName' => 'required',
        ]);
        // return JsonRes::data(true, 'Successfully', $request->all());

        if ($valid->fails()) {
            return JsonRes::data(false, 'Add unsuccessfully', $valid->errors());
        } else {
            $getProdId = Product::where('nama_masakan',$request->productName)->first();
            Cart::create([
                'UserId' => $request->UserId,
                'ProductId' => $getProdId->id_masakan,
                // 'Qty' => $request->qty,
                'Qty' => '1',
                // 'StatusCart' => $request->statusCart,
                'CreatedTime' => Carbon::now(),
            ]);
            return JsonRes::data(true, 'Create Successfully');
        }
    }

    public function updCart(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'UserId' => 'required',
            'productName' => 'required',
        ]);
        // return JsonRes::data(true, 'Successfully', $request->all());

        if ($valid->fails()) {
            return JsonRes::data(false, 'Update unsuccessfully', $valid->errors());
        } else {
            Cart::where('Id', $request->Id)
                ->update([
                    'Qty' => $request->qty,
                ]);
            return JsonRes::data(true, 'Create Successfully');
        }
    }

    public function delCartById($id)
    {
        Cart::where('Id', $id)->delete();
        return JsonRes::data(true, 'Delete Successfully');
    }



    public function addOrder(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'userId' => 'required',
            'total' => 'required',
            'bayar' => 'required',
            'kembali' => 'required',
        ]);
        // return JsonRes::data(true, 'Successfully', $request->all());

        if ($valid->fails()) {
            return JsonRes::data(false, 'Add unsuccessfully', $valid->errors());
        } else {
            $order = Order::forceCreate([
                'UserId' => $request->userId,
                'Total' => $request->total,
                'Bayar' => $request->bayar,
                'Kembali' => $request->kembali,
                // 'StatusOrder' => $request->statusCart,
                'CreatedTime' => Carbon::now(),
            ]);

            $data = [];
            $countData = count($request->orderDet);
            for ($i=0; $i < $countData; $i++) {
                $data[] = [
                    'OrderId' => $order->id,
                    'ProductId' => $request->orderDet[$i]['productId'],
                    'Qty' => $request->orderDet[$i]['Qty'],
                    'SubTotal' => $request->orderDet[$i]['Subtotal'],
                ];
                Cart::where('Id', $request->orderDet[$i]['cartId'])
                    ->update([
                        'StatusCart' => 'true',
                    ]);

            }
            OrderDetail::insert($data);
            // return JsonRes::data(true, 'Successfully', $data);
            return JsonRes::data(true, 'Order Successfully');
        }
    }


    public function getTransactionByStatus()
    {
        $data = Order::where('StatusOrder','false')->get();
        return response()->json($data);
    }

    public function getTransactionIdByStatus(Request $request)
    {
        $data = Order::where('StatusOrder','false')->get();
        return response()->json($data);
    }

}
