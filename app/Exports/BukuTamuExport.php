<?php

namespace App\Exports;

use App\Models\BukuTamu;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BukuTamuExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = BukuTamu::query();

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($this->request->filled('search')) {

            $search = $this->request->search;

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

        if (
            $this->request->filled('tanggal_awal') &&
            $this->request->filled('tanggal_akhir')
        ) {

            $awal = $this->request->tanggal_awal;
            $akhir = $this->request->tanggal_akhir;

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

        if ($this->request->filled('kategori')) {
            $query->where('kategori_tujuan', $this->request->kategori);
        }

        return $query
            ->latest()
            ->get([
                'nama',
                'instansi',
                'jabatan',
                'no_hp',
                'kategori_tujuan',
                'bertemu_dengan',
                'bertemu_lainnya',
                'keperluan',
                'keperluan_lainnya',
                'pesan_kesan',
                'created_at'
            ]);
    }

    public function headings(): array
    {
        return [

            'Nama',

            'Instansi',

            'Jabatan',

            'No HP',

            'Kategori Tujuan',

            'Bertemu',

            'Bertemu Lainnya',

            'Keperluan',

            'Keperluan Lainnya',

            'Pesan & Kesan',

            'Tanggal & Jam'

        ];
    }
}