<?php

namespace App\Http\Controllers;

use App\Library\JsonRes;
use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    protected $rootUri = 'http://localhost:5000/api/';
    public function index()
    {
        // return View::make('welcome');
        return view('tes.welcome')->render();
    }

    public function setSessionCustomer($id)
    {
        session([
            'noMeja' => $id,
        ]);
        return redirect()->route('home');
    }

    public function katalog()
    {
        $data = [
            'product' => Product::all(),
        ];
        // return View::make('user.katalog', $data);
        return view('users.katalog', $data);
    }

    public function addCart(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'noMeja' => 'required',
            'productName' => 'required',
        ]);

        if ($valid->fails()) {
            // return redirect()->route('home')->with('status', 'nomer Meja tidak ada');
            return JsonRes::data(false, 'nomer Meja tidak ada', $valid->errors());
        } else {
            $getProdId = Product::where('nama_masakan',$request->productName)->first();
            Cart::create([
                'UserId' => $request->UserId,
                'ProductId' => $getProdId->id_masakan,
                'Qty' => '1',
                'NoMeja' => $request->noMeja,
                'CreatedTime' => Carbon::now(),
            ]);
            // return redirect()->route('home');
            return JsonRes::data(true, 'Add To Cart Successfully');
        }
    }

    public function cart($id)
    {
        $cart = Cart::select('Cart.id','Cart.Qty', 'Cart.NoMeja', 'Cart.statusCart', 'Cart.createdTime', 'tb_user.nama_user', 'Cart.productId', 'tb_masakan.nama_masakan', 'tb_masakan.harga', 'tb_masakan.stok', 'tb_masakan.gambar_masakan')
                    ->leftJoin('tb_user', 'Cart.userId','=','tb_user.id_user')
                    ->leftJoin('tb_masakan', 'Cart.productId','=','tb_masakan.id_masakan')
                    ->where([
                        ['Cart.NoMeja', '=', $id],
                        ['Cart.StatusCart', '<>', 'true'],
                    ])
                    ->get();

        $data = [
            'cart' => $cart,
        ];
        return view('users.cart', $data);
    }

    public function completeOder($id)
    {
        if (session('noMeja') == $id) {
            session()->flush();
            return view('users.done');
        }
        else {
            return redirect()->route('home')->with('status','tidak memiliki akses');
        }
    }


}
