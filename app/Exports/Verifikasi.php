<?php

namespace App\Exports;

use App\Models\Pengaduan;
// use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class Verifikasi implements FromQuery, ShouldAutoSize, WithHeadings, WithEvents, WithCustomStartCell
{
    use Exportable;
    
  
    public function __construct(int $year)
    {
        $this->year = $year;
    }

    public function query()
    {
        return Pengaduan::query()->whereYear('tanggal_mulai', $this->year)
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
                $event->sheet->getDelegate()->getCell('A1')->setValue('Laporan Tahunan Data Pengaduan Verifikasi');
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

    // public function view(): View
    // {
    //     return view('exports.verifikasi', [
    //         'verifikasi' => Pengaduan::all()
    //     ]);
    // }

    
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     return Pengaduan::all();
    // }

    
}
