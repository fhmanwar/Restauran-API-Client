<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Library\JsonRes;
use App\Models\Cart;
use App\Models\Level;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index()
    {
        // $user = new UserController;
        // $data = $user->getAll();
        $data = $this->addCustmoer('wkwkwk');
        return JsonRes::data(true,'testing', $data);
    }

    public function addCustmoer($name)
    {
        $level = Level::where('nama_level','Pelanggan')->first();
        $userId = User::insertGetId([
            // 'username' => $request->username,
            // 'password' => Hash::make($request->pass),
            'nama_user' => $name,
            'id_level' => $level->id,
            'status' => 'aktif',
        ]);
        return $userId;
    }

    /** ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Cart ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
    public function cartUserId($id)
    {
        $data = Cart::select('Cart.id','Cart.Qty', 'Cart.NoMeja', 'Cart.statusCart', 'Cart.createdTime','tb_user.nama_user', 'tb_masakan.id_masakan', 'tb_masakan.nama_masakan', 'tb_masakan.harga', 'tb_masakan.stok', 'tb_masakan.gambar_masakan')
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
        $data = Cart::select('Cart.id','Cart.Qty', 'Cart.NoMeja', 'Cart.statusCart', 'Cart.createdTime','tb_user.nama_user', 'tb_masakan.nama_masakan', 'tb_masakan.harga', 'tb_masakan.stok', 'tb_masakan.gambar_masakan')
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
            'noMeja' => 'required',
            'productName' => 'required',
        ]);

        if ($valid->fails()) {
            return JsonRes::data(false, 'Add unsuccessfully', $valid->errors());
        } else {
            $getProdId = Product::where('nama_masakan',$request->productName)->first();
            Cart::create([
                'UserId' => $request->UserId,
                'ProductId' => $getProdId->id_masakan,
                'Qty' => '1',
                'NoMeja' => $request->noMeja,
                'CreatedTime' => Carbon::now(),
            ]);
            return JsonRes::data(true, 'Add Successfully');
        }
    }

    public function updCart(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'IdCart' => 'required',
        ]);

        if ($valid->fails()) {
            return JsonRes::data(false, 'Update unsuccessfully', $valid->errors());
        } else {
            Cart::where('Id', $request->IdCart)
                ->update([
                    'Qty' => $request->qty,
                ]);
            return JsonRes::data(true, 'Update Successfully');
        }
    }

    public function delCartById($id)
    {
        Cart::where('Id', $id)->delete();
        return JsonRes::data(true, 'Delete Successfully');
    }

    /** ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Order ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
    public function getAllOrderByStatus()
    {
        $data = Order::select(
                    'Order.id as OrderId',
                    'Order.NoMeja as noMeja',
                    'Order.Total',
                    'Order.UserId as UserId',
                    'tb_user.nama_user as Name',
                )
                ->leftJoin('tb_user', 'Order.UserId','=','tb_user.id_user')
                ->where('StatusOrder','false')
                ->get();
        return response()->json($data);
    }

    public function getIdOrderByStatus($id)
    {
        $data = Order::select(
                'Order.id as OrderId',
                'Order.NoMeja as noMeja',
                'Order.Total',
                'Order.Bayar',
                'Order.Kembali',
                'Order.UserId as UserId',
                'tb_user.nama_user as Name',
            )
            ->leftJoin('tb_user', 'Order.UserId','=','tb_user.id_user')
            ->where([
                ['Id', '=', $id],
                ['StatusOrder', '<>', 'true'],
            ])
            ->first();
        return JsonRes::data(true, 'Successfully', $data);
    }

    public function addOrder(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required',
            'noMeja' => 'required',
            'total' => 'required',
            // 'bayar' => 'required',
            // 'kembali' => 'required',
        ]);
        // return JsonRes::data(true, 'Successfully', $request->all());

        if ($valid->fails()) {
            return JsonRes::data(false, 'Add unsuccessfully', $valid->errors());
        } else {
            $order = Order::forceCreate([
                'NoMeja' => $request->noMeja,
                'UserId' => $request->userId == '' ? $this->addCustmoer($request->name) : $request->userId,
                'Total' => $request->total,
                'CreatedTime' => Carbon::now(),
                // 'Bayar' => $request->bayar,
                // 'Kembali' => $request->kembali,
                // 'StatusOrder' => $request->statusCart,
            ]);

            $ordDetail = explode('~',$request->orderDet);
            $data = [];
            $countData = count($ordDetail);
            for ($i=0; $i < $countData; $i++) {
                if ($ordDetail[$i] == 'null') {
                    continue;
                } else {
                    $get = explode('|',$ordDetail[$i]);
                    $product = Product::where('nama_masakan',$get[1])->first();
                    $data[] = [
                        'OrderId' => $order->id,
                        'ProductId' => $product->id_masakan,
                        'Qty' => $get[2],
                        'SubTotal' => $product->harga * $get[2],
                    ];
                    Cart::where('Id', $get[0])
                        ->update([
                            'StatusCart' => 'true',
                        ]);
                }
            }
            OrderDetail::insert($data);
            return JsonRes::data(true, 'Order Successfully');
            // return JsonRes::data(true, 'Successfully', $data);
        }
    }

    public function delOrder($id)
    {
        if ($id == null) {
            return JsonRes::data(false, 'Delete unsuccessfully', 'data cannot be null');
        } else {
            Order::whereId($id)->delete();
            return JsonRes::data(true, 'Delete Successfully');
        }
    }


    public function getOrderDetailByOrderId($id)
    {
        // $order = Order::select(
        //         'Order.id as OrderId',
        //         'Order.NoMeja as noMeja',
        //         'Order.Total',
        //         'Order.Bayar',
        //         'Order.Kembali',
        //         'Order.UserId as UserId',
        //         'tb_user.nama_user as Name',
        //     )
        //     ->leftJoin('tb_user', 'Order.UserId','=','tb_user.id_user')
        //     ->where([
        //         ['Order.id', '=', $id],
        //         ['StatusOrder', '<>', 'true'],
        //     ])
        //     ->first();
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
                // ['Order.StatusOrder', '<>', 'true'],
            ])
            ->get();
        // $data = [
        //     // 'order' => $order,
        //     'detail' => $orderDet,
        // ];
        return JsonRes::data(true, 'Successfully', $orderDet);
    }

    /** ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Order Detail ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
    public function getIdOrderDetail($id)
    {
        $data = OrderDetail::select(
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
                ['OrderDetail.Id', '=', $id],
                ['Order.StatusOrder', '<>', 'true'],
            ])
            ->first();
        return JsonRes::data(true, 'Successfully', $data);
    }

    public function updOrderDetail(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'OrderDetailId' => 'required',
            'productName' => 'required',
        ]);
        // return JsonRes::data(true, 'Successfully', $request->all());

        if ($valid->fails()) {
            return JsonRes::data(false, 'Update unsuccessfully', $valid->errors());
        } else {
            $product = Product::where('nama_masakan', $request->productName)->first();
            OrderDetail::where('Id', $request->OrderDetailId)
                ->update([
                    'Qty' => $request->qty,
                    'SubTotal' => $product->harga * $request->qty,
                ]);


            $orderDet = OrderDetail::where('Id', $request->OrderDetailId)->first();
            $orderSum = OrderDetail::where('OrderId', $orderDet->OrderId)->sum('SubTotal');
            Order::where('Id', $orderDet->OrderId)
                ->update([
                    'Total' => $orderSum,
                ]);
            return JsonRes::data(true, 'Update Successfully');
        }
    }

    public function delOrderDetail($id)
    {
        if ($id == null) {
            return JsonRes::data(false, 'Delete unsuccessfully', 'data cannot be null');
        } else {
            $orderDet = OrderDetail::where('Id', $id)->first();
            $getOrderId = [$orderDet->OrderId];
            OrderDetail::where('Id', $id)->delete();
            $orderSum = OrderDetail::where('OrderId', $getOrderId)->sum('SubTotal');
            Order::where('Id', $getOrderId)
                ->update([
                    'Total' => $orderSum,
                ]);
            return JsonRes::data(true, 'Delete Successfully', [$getOrderId[0], $orderSum]);
        }
    }


    /** ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Transaction ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
    public function getAllTransaction()
    {
        $data = Order::select(
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
            ->where('StatusOrder','true')
            ->get();
        return response()->json($data);
    }

    public function getIdTransaction($id)
    {
        $data = Order::select(
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
            ->where('Id', $id)
            ->first();
        return JsonRes::data(true, 'Successfully', $data);
    }

    public function addTransaction(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'orderId' => 'required',
            'userId' => 'required',
            'bayar' => 'required',
            'kembali' => 'required',
        ]);
        // return JsonRes::data(true, 'Successfully', $request->all());

        if ($valid->fails()) {
            return JsonRes::data(false, 'Order unsuccessfully', $valid->errors());
        } else {
            Order::where('Id', $request->orderId)
                ->update([
                    'StatusOrder' => 'true',
                    'Bayar' => $request->bayar,
                    'Kembali' => $request->kembali,
                ]);
            // return JsonRes::data(true, 'Successfully', $data);
            return JsonRes::data(true, 'Order Successfully');
        }
    }

}
