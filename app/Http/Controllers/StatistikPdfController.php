<?php

namespace App\Http\Controllers;

use App\Models\BukuTamu;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class StatistikPdfController extends Controller
{
    public function export(Request $request)
    {
        $startDate = $request->start_date;
        $endDate   = $request->end_date;
        $kategori  = $request->kategori;

        $query = BukuTamu::query();

        /*
        |--------------------------------------------------------------------------
        | FILTER TANGGAL
        |--------------------------------------------------------------------------
        */

        if ($startDate && $endDate) {

            $query->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);

        }

        /*
        |--------------------------------------------------------------------------
        | FILTER KATEGORI
        |--------------------------------------------------------------------------
        */

        if (!empty($kategori)) {

            $query->where('kategori_tujuan', $kategori);

        }

        /*
        |--------------------------------------------------------------------------
        | STATISTIK
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
                    'instansi' => $instansi ?: '-',
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
                    'keperluan' => $keperluan ?: '-',
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

        $pdf = Pdf::loadView('admin.statistik-pdf', compact(
            'hariIni',
            'bulanIni',
            'tahunIni',
            'total',
            'topInstansi',
            'topKeperluan',
            'topPengunjung',
            'startDate',
            'endDate',
            'kategori'
        ));

        $filename = 'Laporan_Statistik_Buku_Tamu';

        if (!empty($kategori)) {
            $filename .= '_' . str_replace(' ', '_', $kategori);
        }

        if ($startDate && $endDate) {
            $filename .= '_' . $startDate . '_sampai_' . $endDate;
        }

        $filename .= '.pdf';

        return $pdf->download($filename);
    }
}