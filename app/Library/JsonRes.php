<?php
namespace App\Library;

class JsonRes
{
    public static function data($bool=false, $msg='error', $data=[null])
    {
        return response()->json([
            'statusCode' => $bool,
            'msg' => $msg,
            'data' => $data,
        ]);
    }
}
