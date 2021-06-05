<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Library\JsonRes;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        return JsonRes::data(true,'testing product');
    }

    public function getAll()
    {
        $data = Product::all();

        return response()->json($data);
    }

    public function getId($id)
    {
        $data = Product::where('id_masakan',$id)->first();
        return JsonRes::data(true, 'Successfully', $data);
    }

    public function create(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'img' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        // return JsonRes::data(true, 'Successfully', $request->all());

        if ($valid->fails()) {
            return $this->data(false, 'Create unsuccessfully', 'Your Data is wrong');
        } else {
            $newName = null;
            $image = $request->file('img');
            if ($image) {
                $path = 'img/upload/product';
                $imgName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $imgExt = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
                $name = $imgName.'-'.time().'.'.$imgExt;
                $image->storeAs($path,$name);
                $newName = $path.'/'.$name;
            }
            Product::create([
                'nama_masakan' => $request->prodName,
                'harga' => $request->price,
                'stok' => $request->stock,
                'status_masakan' => $request->status,
                'gambar_masakan' => $newName,
            ]);
            return JsonRes::data(true, 'Create Successfully');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            'uStoreId' => 'required',
            'catId' => 'required',
            'img' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($valid->fails()) {
            return $this->data(false, 'Update unsuccessfully', 'Your Data is wrong');
        } else {
            $newName = null;
            $image = $request->file('img');
            if ($image) {
                $path = 'img/upload/product';
                $imgName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $imgExt = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
                $name = $imgName.'-'.time().'.'.$imgExt;
                $image->storeAs($path,$name);
                $newName = $path.'/'.$name;
                Product::whereId($id)
                    ->update([
                        'image' => $newName,
                    ]);
            }
            Product::whereId($id)
                ->update([
                    'userStoreId' => $request->uStoreId,
                    'categoryId' => $request->catId,
                    'productType' => $request->prodType,
                    'productCode' => $request->prodCode,
                    'productName' => $request->prodName,
                    'buyingPrice' => $request->buyPrice,
                    'sellingPrice' => $request->sellPrice,
                    'stock' => $request->stock,
                    'unit' => $request->unit,
                    'productDiscount' => $request->prodDisc,
                    'buyDate' => $request->buyDate,
                ]);
            return JsonRes::data(true, 'Update Successfully');
        }
    }

    public function destroy($id)
    {
        Product::where('id_masakan', $id)->delete();
        return JsonRes::data(true, 'Delete Successfully');
    }
}
