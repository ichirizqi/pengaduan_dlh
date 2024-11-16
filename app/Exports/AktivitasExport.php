<?php

namespace App\Exports;

use App\Models\Aktivitas;
use App\Models\Pengaduan;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Illuminate\Support\Facades\DB;

class AktivitasExport implements FromQuery, ShouldAutoSize, WithHeadings, WithEvents, WithCustomStartCell
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($id)
    {
        $this->id = $id;
    }

    // SELECT aktivitas.narasi, aktivitas.tanggal, statuspengaduans.nama, pengaduans.nama FROM `aktivitas`, `statuspengaduans`, `pengaduans` WHERE id_pengaduan=97 AND statuspengaduans.id = aktivitas.id_status AND pengaduans.id = aktivitas.id_pengaduan;

    public function query()
    {
        // return Aktivitas::query()->where('id_pengaduan', $this->id)->where('id_status', )
        
        // ->select('nama', 'kode_lacak', 'narasi', 'tanggal', 'id_status');

        // SELECT `kode_lacak`, `narasi`, `tanggal`, `statuspengaduans`.`nama` from `aktivitas` inner join `statuspengaduans` on `statuspengaduans`.`id` = `aktivitas`.`id_status` where `id_pengaduan` = 97;

        $aktiv= DB::table('aktivitas')->select(
            'nama_pengadu',
            'aktivitas.kode_lacak',
            'narasi',
            'statuspengaduans.nama',
            'tanggal'
            
        )
        ->join('statuspengaduans','statuspengaduans.id', 'aktivitas.id_status')
        ->orderBy('aktivitas.id')
        ->where('id_pengaduan', $this->id);

        return $aktiv;
    }

    public function headings(): array
    {
        return [ "Nama", "Kode Lacak", "Narasi", "Status", "Tanggal"];
    }

    public function registerEvents(): array
    {

        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A3:C3'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()
                ->setSize(12);
                $event->sheet->getDelegate()->getStyle('A3:E3')
                ->getFont()->setBold(true);
                
                $event->sheet->getDelegate()->mergeCells('A1:G1');
                $event->sheet->getDelegate()->getCell('A1')->setValue('Laporan Aktivitas Penanganan Aduan');
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

