<?php

namespace App\Exports;

use App\Models\DokterOrder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class ExportMedok implements FromView, ShouldAutoSize, WithEvents
{
    public function __construct($data, $tanggal)
    {
        $this->data = $data;
        $this->tanggal = $tanggal;
    }

    public function view(): View
    {
        return view('master.excel', [
            'data' => $this->data,
            'tanggal' => $this->tanggal,
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:L2')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $event->sheet->getDelegate()->getStyle('A4:L4')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $event->sheet->getStyle('A1:L1')->applyFromArray([
                    'font' => [
                        'size'      =>  20,
                        'bold'      =>  true,
                    ],
                ]);

                $event->sheet->getStyle('A2:L2')->applyFromArray([
                    'font' => [
                        'size'      =>  15,
                        'bold'      =>  true,
                    ],
                ]);

                $event->sheet->getStyle('A4:L4')->applyFromArray([
                    'font' => [
                        'bold'      =>  true,
                    ],
                ]);

                // $event->sheet->getStyle('A4:L20')->applyFromArray([
                //     'borders' => [
                //         'allBorders' => [
                //             'borderStyle' => Border::BORDER_THIN,
                //             'color' => ['rgb' => '000000'],
                //         ],
                //     ],
                // ]);

                // $event->sheet->getStyle('A22:D23')->applyFromArray([
                //     'borders' => [
                //         'allBorders' => [
                //             'borderStyle' => Border::BORDER_THIN,
                //             'color' => ['rgb' => '000000'],
                //         ],
                //     ],
                // ]);

                $event->sheet->getDelegate()->getPageSetup()
                    ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);

                $event->sheet->getDelegate()->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);

                // $event->sheet->getDelegate()->getPageMargins()->setBottom(0);
            },
        ];
    }
}
