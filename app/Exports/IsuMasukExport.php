<?php

namespace App\Exports;

use App\Models\Isu;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;


// use Maatwebsite\Excel\Concerns\FromCollection;

class IsuMasukExport implements FromQuery, ShouldAutoSize, WithHeadings, WithEvents, WithCustomStartCell
{
    use Exportable;
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     return Isu::all();
    // }
    public function __construct( $year,  $status)
    {
        $this->year = $year;
        $this->status = $status;
    }

    public function query()
    {
        return Isu::query()->whereYear('created_at', $this->year)->where('status', $this->status)
        ->select('nama', 'email', 'masalah');
    }

    public function headings(): array
    {
        return [ "Nama", "Email", "Masalah"];
    }

    public function registerEvents(): array
    {

        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A3:C3'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()
                ->setSize(12);
                $event->sheet->getDelegate()->getStyle('A3:C3')
                ->getFont()->setBold(true);
                
                $event->sheet->getDelegate()->mergeCells('A1:G1');
                $event->sheet->getDelegate()->getCell('A1')->setValue('Laporan Tahunan Data Pengaduan Masuk');
                $event->sheet->getDelegate()->getStyle('A1')
                ->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('A1')->getFont()
                ->setSize(14);

                
                
                // $event->sheet->getStyle('A1')->applyFromArray([
                //     'borders' => [
                //         'outline' => [
                //             'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                //             'color' => ['argb' => '000000'],
                //         ],
                //     ],

                // ]);

            },
        ];
    }

    public function startCell(): string
    {
        return 'A3';
    }
}
