<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BukuTamu;

class BukuTamuController extends Controller
{
    /**
     * Menampilkan halaman Buku Tamu
     */
    public function create()
    {
        return view('buku-tamu');
    }

    /**
     * Menyimpan data Buku Tamu
     */
    public function store(Request $request)
    {
        $request->validate([

            'nama' => 'required|string|max:255',

            'instansi' => 'required|string|max:255',

            'jabatan' => 'required|string|max:255',

            'no_hp' => 'nullable|string|max:20',

            'kategori_tujuan' => 'required|string|max:255',

            'bertemu_dengan' => 'nullable|string|max:255',

            'bertemu_lainnya' => 'nullable|string|max:255',

            'keperluan' => 'required|string|max:255',

            'keperluan_lainnya' => 'nullable|string|max:255',

            'pesan_kesan' => 'nullable|string',

        ]);

        /**
         * Menentukan tujuan bertemu
         */

        if ($request->kategori_tujuan == 'Kantor Desa') {

            if ($request->bertemu_dengan == 'Lainnya') {

                $request->validate([
                    'bertemu_lainnya' => 'required|string|max:255',
                ]);

                $bertemu = $request->bertemu_lainnya;

            } else {

                $bertemu = $request->bertemu_dengan;

            }

        } else {

            $request->validate([
                'bertemu_lainnya' => 'required|string|max:255',
            ]);

            $bertemu = $request->bertemu_lainnya;

        }

        /**
         * Menentukan keperluan
         */

        if ($request->keperluan == 'Lainnya') {

            $request->validate([
                'keperluan_lainnya' => 'required|string|max:255',
            ]);

            $keperluan = $request->keperluan_lainnya;

        } else {

            $keperluan = $request->keperluan;

        }

        BukuTamu::create([

            'nama' => $request->nama,

            'instansi' => $request->instansi,

            'jabatan' => $request->jabatan,

            'no_hp' => $request->no_hp,

            'kategori_tujuan' => $request->kategori_tujuan,

            'bertemu_dengan' => $bertemu,

            'bertemu_lainnya' => $request->bertemu_lainnya,

            'keperluan' => $keperluan,

            'keperluan_lainnya' => $request->keperluan_lainnya,

            'pesan_kesan' => $request->pesan_kesan,

        ]);

        return redirect()
            ->route('buku-tamu')
            ->with('success', 'Terima kasih, data berhasil disimpan.');
    }
}