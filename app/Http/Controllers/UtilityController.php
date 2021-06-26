<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilityController extends Controller
{
    public function generateQr($id)
    {
        $getEnv = env('APP_URL', 'http://localhost');
        $data = [
            'qrCode' => \QrCode::size(200)->generate($getEnv.'/customer/'.$id),
        ];
        return view('qrCode', $data);
    }
}
