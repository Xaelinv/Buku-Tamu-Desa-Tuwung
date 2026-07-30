<?php

namespace App\Http\Controllers;

use App\Models\BukuTamu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $total = BukuTamu::count();

        $hariIni = BukuTamu::whereDate('created_at', today())->count();

        $bulanIni = BukuTamu::whereMonth('created_at', now()->month)
                            ->whereYear('created_at', now()->year)
                            ->count();

        $tahunIni = BukuTamu::whereYear('created_at', now()->year)
                            ->count();

        $grafik = BukuTamu::select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('COUNT(*) as jumlah')
            )
            ->whereYear('created_at', now()->year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $pengunjungTerbaru = BukuTamu::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'total',
            'hariIni',
            'bulanIni',
            'tahunIni',
            'grafik',
            'pengunjungTerbaru'
        ));
    }

    public function destroy($id)
    {
        BukuTamu::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}