<?php

namespace App\Exports;

use App\ViewModels\ExcelVM;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

// class ExcelDaily implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize//, WithCustomStartCell
class ExcelDaily implements FromView, ShouldAutoSize, WithStyles
{
    public function __construct(string $day)
    {
        $this->day = $day;
    }

    public function view(): View
    {
        $model = new ExcelVM();
        $data = $model->hydrate(
            // For MySql
            DB::select('call SP_ExportExcelDay(?)', [$this->day])

            // for SQL Server
            // DB::select('exec SP_ExportExcelDay ?', [$this->day])
        );

        return view('admins.exports.excelDay', [
            'data' => $data,
            'tgl' => $this->day,
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

    // public function collection()
    // {
    //     $model = new ExcelVM();
    //     $data = $model->hydrate(
    //         // For MySql
    //         // DB::select('call SP_ExportExcelDay(?)', [$this->day])

    //         // for SQL Server
    //         DB::select('exec SP_ExportExcelDay ?', [$this->day])
    //     );
    //     return $data;
    // }

    // public function headings(): array
    // {
    //     return [
    //        ['', '', 'Laporan Keuangan Tanggal '. $this->day, '', ''],
    //        ['', '', 'First row', '', ''],
    //        [
    //             '#',
    //             'Nama Product',
    //             'Jumlah Pesanan',
    //             'Harga',
    //        ],
    //     ];
    // }

    // public function map($row): array {
    //     return [
    //         [],
    //         [],
    //         [],
    //         [
    //             $row->id_masakan,
    //             $row->nama_masakan,
    //             $row->Quantity,
    //             $row->Total
    //         ]
    //     ];
    // }


    // public function startCell(): string
    // {
    //     return 'A3';
    // }
}
