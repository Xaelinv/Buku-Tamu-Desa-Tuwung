<?php

namespace App\Exports;

use App\Models\BukuTamu;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StatistikExport implements FromArray, ShouldAutoSize, WithStyles
{
    protected $startDate;
    protected $endDate;
    protected $kategori;

    public function __construct($startDate = null, $endDate = null, $kategori = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->kategori = $kategori;
    }

    public function array(): array
    {
        /*
        |--------------------------------------------------------------------------
        | FILTER
        |--------------------------------------------------------------------------
        */

        $query = BukuTamu::query();

        if ($this->startDate && $this->endDate) {

            $query->whereBetween('created_at', [
                Carbon::parse($this->startDate)->startOfDay(),
                Carbon::parse($this->endDate)->endOfDay()
            ]);

        }

        if (!empty($this->kategori)) {

            $query->where('kategori_tujuan', $this->kategori);

        }

        /*
        |--------------------------------------------------------------------------
        | RINGKASAN
        |--------------------------------------------------------------------------
        */

        $hariIni = (clone $query)
            ->whereDate('created_at', Carbon::today())
            ->count();

        $bulanIni = (clone $query)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        $tahunIni = (clone $query)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        $total = (clone $query)->count();

        /*
        |--------------------------------------------------------------------------
        | TOP INSTANSI
        |--------------------------------------------------------------------------
        */

        $topInstansi = (clone $query)
            ->get()
            ->groupBy('instansi')
            ->map(function ($items, $instansi) {

                return [
                    'nama' => $instansi ?: '-',
                    'total' => $items->count()
                ];

            })
            ->sortByDesc('total')
            ->take(5);

        /*
        |--------------------------------------------------------------------------
        | TOP KEPERLUAN
        |--------------------------------------------------------------------------
        */

        $topKeperluan = (clone $query)
            ->get()
            ->map(function ($item) {

                return [
                    'keperluan' => $item->keperluan_lainnya ?: $item->keperluan
                ];

            })
            ->groupBy('keperluan')
            ->map(function ($items, $keperluan) {

                return [
                    'nama' => $keperluan ?: '-',
                    'total' => $items->count()
                ];

            })
            ->sortByDesc('total')
            ->take(5);

        /*
        |--------------------------------------------------------------------------
        | TOP PENGUNJUNG
        |--------------------------------------------------------------------------
        */

        $topPengunjung = (clone $query)
            ->get()
            ->groupBy('nama')
            ->map(function ($items, $nama) {

                return [
                    'nama' => $nama ?: '-',
                    'total' => $items->count()
                ];

            })
            ->sortByDesc('total')
            ->take(5);

        /*
        |--------------------------------------------------------------------------
        | ISI EXCEL
        |--------------------------------------------------------------------------
        */

        $data = [];

        $data[] = ['PEMERINTAH DESA TUWUNG'];
        $data[] = ['LAPORAN STATISTIK BUKU TAMU'];
        $data[] = [];

        $data[] = ['Tanggal Cetak', Carbon::now()->format('d-m-Y H:i')];

        if ($this->startDate && $this->endDate) {

            $data[] = [
                'Periode',
                Carbon::parse($this->startDate)->format('d-m-Y')
                .' s/d '.
                Carbon::parse($this->endDate)->format('d-m-Y')
            ];

        }

        if (!empty($this->kategori)) {

            $data[] = [
                'Kategori Tujuan',
                $this->kategori
            ];

        }

        $data[] = [];

        $data[] = ['Hari Ini', $hariIni];
        $data[] = ['Bulan Ini', $bulanIni];
        $data[] = ['Tahun Ini', $tahunIni];
        $data[] = ['Total Pengunjung', $total];

        /*
        |--------------------------------------------------------------------------
        | TOP INSTANSI
        |--------------------------------------------------------------------------
        */

        $data[] = [];
        $data[] = ['TOP 5 INSTANSI'];
        $data[] = ['Instansi', 'Jumlah'];

        foreach ($topInstansi as $item) {

            $data[] = [
                $item['nama'],
                $item['total']
            ];

        }

        /*
        |--------------------------------------------------------------------------
        | TOP KEPERLUAN
        |--------------------------------------------------------------------------
        */

        $data[] = [];
        $data[] = ['TOP 5 KEPERLUAN'];
        $data[] = ['Keperluan', 'Jumlah'];

        foreach ($topKeperluan as $item) {

            $data[] = [
                $item['nama'],
                $item['total']
            ];

        }

        /*
        |--------------------------------------------------------------------------
        | TOP PENGUNJUNG
        |--------------------------------------------------------------------------
        */

        $data[] = [];
        $data[] = ['TOP 5 PENGUNJUNG'];
        $data[] = ['Nama', 'Jumlah'];

        foreach ($topPengunjung as $item) {

            $data[] = [
                $item['nama'],
                $item['total']
            ];

        }

        return $data;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(14);

        $highestRow = $sheet->getHighestRow();

        for ($row = 1; $row <= $highestRow; $row++) {

            $value = strtoupper(trim((string) $sheet->getCell("A{$row}")->getValue()));

            if (
                $value === 'TOP 5 INSTANSI' ||
                $value === 'TOP 5 KEPERLUAN' ||
                $value === 'TOP 5 PENGUNJUNG'
            ) {

                $sheet->getStyle("A{$row}")
                    ->getFont()
                    ->setBold(true)
                    ->setSize(12);

                $sheet->getStyle("A" . ($row + 1) . ":B" . ($row + 1))
                    ->getFont()
                    ->setBold(true);

            }
        }

        return [];
    }
}