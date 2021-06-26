<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilityController extends Controller
{
    public function generateQr($id)
    {
        $data = [
            'qrCode' => \QrCode::size(200)->generate('/customer/'.$id),
        ];
        return view('qrCode', $data);
    }
}
