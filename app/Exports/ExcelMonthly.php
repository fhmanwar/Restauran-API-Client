<?php

namespace App\Exports;

use App\ViewModels\ExcelVM;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExcelMonthly implements FromView, ShouldAutoSize, WithStyles
{
    public function __construct(string $month)
    {
        $this->month = $month;
    }

    public function view(): View
    {
        $model = new ExcelVM();
        $month = Carbon::parse($this->month)->format('m');
        $data = $model->hydrate(
            // For MySql
            DB::select('call SP_ExportExcelDay(?)', [$this->day])

            // for SQL Server
            // DB::select('exec SP_ExportExcelMonth ?', [$month])
        );

        $monthFullName = Carbon::parse($this->month)->format('F');
        $first = Carbon::parse($this->month)->startOfMonth()->format('d');
        $last = Carbon::parse($this->month)->lastOfMonth()->format('d');
        $year = Carbon::parse($this->month)->format('Y');

        return view('admins.exports.ExcelMonth', [
            'data' => $data,
            'mth' => $monthFullName,
            'period' => $first.' sd '.$last.' '.$monthFullName.' '.$year,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => [
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,],
                'font' => [
                    'size' => 18,
                    'bold' => true,
                ]
            ],
            2 => [
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,],
                'font' => ['size' => 16]
            ],

            4 => [
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,],
                'font' => ['bold' => true,]
            ],

            'A4:D16' => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ]
            ]

            // // Styling a specific cell by coordinate.
            // 'B2' => ['font' => ['italic' => true]],

            // // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],
        ];
    }

}
