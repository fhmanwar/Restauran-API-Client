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
            return JsonRes::data(false, 'Create unsuccessfully', $valid->errors());
        } else {
            $newName = null;
            $image = $request->file('img');
            if ($image) {
                // $path = '/img/product';
                $path = public_path('img/product');
                $imgName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // $imgExt = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
                // $name = $imgName.'-'.time().'.'.$image->extension();
                // $newName = $path.'/'.$name;
                $newName = $imgName.'-'.time().'.'.$image->extension();

                // Store Image in Storage Folder
                // $image->storeAs($path,$name);

                // Store Image in Public Folder
                $image->move($path, $newName);
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
            'img' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        // return JsonRes::data(true, 'Successfully', $request->all());

        if ($valid->fails()) {
            return JsonRes::data(false, 'Update unsuccessfully', $valid->errors());
        } else {
            $newName = null;
            $image = $request->file('img');
            if ($image) {
                // $path = '/img/product';
                $path = public_path('img/product');
                $imgName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // $imgExt = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
                // $name = $imgName.'-'.time().'.'.$image->extension();
                // $newName = $path.'/'.$name;
                $newName = $imgName.'-'.time().'.'.$image->extension();

                // Store Image in Storage Folder
                // $image->storeAs($path,$name);

                // Store Image in Public Folder
                $image->move($path, $newName);

                Product::where('id_masakan', $id)
                    ->update([
                        'gambar_masakan' => $newName,
                    ]);
            }
            Product::where('id_masakan', $id)
                ->update([
                    'nama_masakan' => $request->prodName,
                    'harga' => $request->price,
                    'stok' => $request->stock,
                    'status_masakan' => $request->status,
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
