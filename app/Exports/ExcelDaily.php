<?php

namespace App\Exports;

use App\ViewModels\ExcelVM;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExcelDaily implements FromCollection
{
    public function __construct(string $month)
    {
        $this->month = $month;
    }

    public function collection()
    {
        $model = new ExcelVM();
        $data = $model->hydrate(
            DB::select('call SP_ExportExcelDay(?)', [$this->month])
        );
        return $data;
    }
}
