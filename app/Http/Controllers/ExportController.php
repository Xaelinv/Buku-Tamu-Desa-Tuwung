<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\BukuTamuExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportExcel(Request $request)
{
    $namaFile = 'Buku_Tamu_Semua_Data.xlsx';

    // Filter Kategori
    if ($request->filled('kategori')) {

        $kategori = str_replace(' ', '_', $request->kategori);

        $namaFile = "Buku_Tamu_{$kategori}.xlsx";
    }

    // Filter Tanggal
    if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {

        $awal = date('d-m-Y', strtotime($request->tanggal_awal));
        $akhir = date('d-m-Y', strtotime($request->tanggal_akhir));

        if ($request->filled('kategori')) {

            $kategori = str_replace(' ', '_', $request->kategori);

            $namaFile = "Buku_Tamu_{$kategori}_{$awal}_sampai_{$akhir}.xlsx";

        } else {

            $namaFile = "Buku_Tamu_{$awal}_sampai_{$akhir}.xlsx";

        }
    }

    // Search
    elseif ($request->filled('search')) {

        $namaFile = 'Buku_Tamu_Hasil_Pencarian.xlsx';
    }

    return Excel::download(
        new BukuTamuExport($request),
        $namaFile
    );
}
}