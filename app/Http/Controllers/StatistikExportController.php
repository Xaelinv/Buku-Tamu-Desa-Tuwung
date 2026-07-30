<?php

namespace App\Http\Controllers;

use App\Exports\StatistikExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StatistikExportController extends Controller
{
    public function exportExcel(Request $request)
    {
        $kategori = $request->kategori;

        $filename = 'Laporan_Statistik_Buku_Tamu';

        if (!empty($kategori)) {
            $filename .= '_' . str_replace(' ', '_', $kategori);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $filename .= '_' . $request->start_date . '_sampai_' . $request->end_date;
        }

        $filename .= '.xlsx';

        return Excel::download(
            new StatistikExport(
                $request->start_date,
                $request->end_date,
                $kategori
            ),
            $filename
        );
    }
}