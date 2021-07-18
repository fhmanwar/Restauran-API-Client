<?php

namespace App\Exports;

use App\ViewModels\ExcelVM;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExcelDaily implements FromCollection
{
    public function __construct(string $day)
    {
        $this->day = $day;
    }

    public function collection()
    {
        $model = new ExcelVM();
        $data = $model->hydrate(
            // For MySql
            // DB::select('call SP_ExportExcelDay(?)', [$this->day])

            // for SQL Server
            DB::select('exec SP_ExportExcelDay ?', [$this->day])
        );
        return $data;
    }
}
