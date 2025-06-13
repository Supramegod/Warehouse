<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ItemsExport implements FromArray, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * @return array
     */
    public function array(): array
    {
        // Contoh data
        return [
            [
                'Obat Nyamuk Bakar', 'Baygon Coil', 'BG001', '100', '125',
            ],
            [
                'Obat Nyamuk Elektrik', 'HIT Liquid Electric', 'HT002', '50', '33',
            ],
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'jenis_barang',
            'nama_barang',
            'id_barang',
            'jumlah_barang',
            'berat_barang',
        ];
    }

    /**
     * @param Worksheet $sheet
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}