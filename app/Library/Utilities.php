<?php
namespace App\Library;

use PDF;

class Utility
{
    public static function printPreview($data=null){
        $pdf = PDF::loadview('admin.transaction.pdf', $data);
        return $pdf->stream();
    }

    public static function printDownload($data=null){
        $pdf = PDF::loadview('admin.transaction.pdf', $data);
        return $pdf->download('laporan.pdf');
    }
}
