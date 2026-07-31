<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BukuTamu;

class DataBukuTamuController extends Controller
{
    public function index(Request $request)
    {
        $query = BukuTamu::query();

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('instansi', 'like', "%{$search}%")
                    ->orWhere('jabatan', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%")
                    ->orWhere('kategori_tujuan', 'like', "%{$search}%")
                    ->orWhere('bertemu_dengan', 'like', "%{$search}%")
                    ->orWhere('bertemu_lainnya', 'like', "%{$search}%")
                    ->orWhere('keperluan', 'like', "%{$search}%")
                    ->orWhere('keperluan_lainnya', 'like', "%{$search}%")
                    ->orWhere('pesan_kesan', 'like', "%{$search}%")
                    ->orWhereDate('created_at', $search);

            });

        }

        /*
        |--------------------------------------------------------------------------
        | FILTER RENTANG TANGGAL
        |--------------------------------------------------------------------------
        */

        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {

            $awal = $request->tanggal_awal;
            $akhir = $request->tanggal_akhir;

            if ($awal > $akhir) {
                [$awal, $akhir] = [$akhir, $awal];
            }

            $query->whereBetween('created_at', [
                $awal . ' 00:00:00',
                $akhir . ' 23:59:59'
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER KATEGORI
        |--------------------------------------------------------------------------
        */

        if ($request->filled('kategori')) {
            $query->where('kategori_tujuan', $request->kategori);
        }

        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */

        $tamu = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.data-buku-tamu', compact('tamu'));
    }
}