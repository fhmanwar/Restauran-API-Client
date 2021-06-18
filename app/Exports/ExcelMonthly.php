<?php

namespace App\Exports;

use App\ViewModels\ExcelVM;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExcelMonthly implements FromCollection
{
    public function __construct(string $month)
    {
        $this->month = $month;
    }

    public function collection()
    {
        $model = new ExcelVM();
        $user = $model->hydrate(
            DB::select('call SP_ExportExcelMonth(?)', [$this->month])
        );
        return $user;
    }
}
