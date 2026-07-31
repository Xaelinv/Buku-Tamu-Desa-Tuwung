<?php

namespace App\Http\Controllers;

use App\Models\BukuTamu;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class StatistikController extends Controller
{
    public function index(Request $request)
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
        | CARD
        |--------------------------------------------------------------------------
        */

        $total = (clone $query)->count();

        if ($startDate && $endDate) {

            $tanggalFilter = Carbon::parse($endDate);

            $hariIni = (clone $query)
                ->whereDate('created_at', $tanggalFilter->toDateString())
                ->count();

            $bulanIni = (clone $query)
                ->whereMonth('created_at', $tanggalFilter->month)
                ->whereYear('created_at', $tanggalFilter->year)
                ->count();

            $tahunIni = (clone $query)
                ->whereYear('created_at', $tanggalFilter->year)
                ->count();

            $tahunGrafik = $tanggalFilter->year;

        } else {

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

            $tahunGrafik = Carbon::now()->year;

        }

        /*
        |--------------------------------------------------------------------------
        | GRAFIK
        |--------------------------------------------------------------------------
        */

        $grafik = [];

        for ($i = 1; $i <= 12; $i++) {

            $grafik[] = (object) [

                'bulan' => $i,

                'total' => (clone $query)
                    ->whereMonth('created_at', $i)
                    ->whereYear('created_at', $tahunGrafik)
                    ->count()

            ];

        }

        /*
        |--------------------------------------------------------------------------
        | TOP INSTANSI
        |--------------------------------------------------------------------------
        */

        $topInstansi = (clone $query)
            ->get()
            ->groupBy('instansi')
            ->map(function ($items, $instansi) {

                return (object) [

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

                    'keperluan' => !empty($item->keperluan_lainnya)
                        ? $item->keperluan_lainnya
                        : $item->keperluan

                ];

            })
            ->groupBy('keperluan')
            ->map(function ($items, $keperluan) {

                return (object) [

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

                return (object) [

                    'nama' => $nama ?: '-',

                    'total' => $items->count()

                ];

            })
            ->sortByDesc('total')
            ->take(5);

        /*
        |--------------------------------------------------------------------------
        | STATISTIK KATEGORI TUJUAN
        |--------------------------------------------------------------------------
        */

        $kategoriStatistik = (clone $query)
            ->select(
                'kategori_tujuan',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('kategori_tujuan')
            ->orderByDesc('total')
            ->get();

        return view('admin.statistik', compact(

            'hariIni',

            'bulanIni',

            'tahunIni',

            'total',

            'grafik',

            'topInstansi',

            'topKeperluan',

            'topPengunjung',

            'kategoriStatistik',

            'startDate',

            'endDate',

            'kategori'

        ));

    }
}