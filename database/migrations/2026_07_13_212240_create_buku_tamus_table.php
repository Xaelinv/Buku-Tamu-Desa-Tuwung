<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BukuTamu;

class BukuTamuController extends Controller
{
    public function create()
    {
        return view('buku-tamu');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'instansi' => 'required',
            'jabatan' => 'required',
            'bertemu_dengan' => 'required',
            'keperluan' => 'required',
        ]);

        BukuTamu::create([

            'nama' => $request->nama,

            'instansi' => $request->instansi,

            'jabatan' => $request->jabatan,

            'no_hp' => $request->no_hp,

            'bertemu_dengan' => $request->bertemu_dengan == 'Lainnya'
                ? $request->bertemu_lainnya
                : $request->bertemu_dengan,

            'bertemu_lainnya' => $request->bertemu_lainnya,

            'keperluan' => $request->keperluan == 'Lainnya'
                ? $request->keperluan_lainnya
                : $request->keperluan,

            'keperluan_lainnya' => $request->keperluan_lainnya,

            'pesan_kesan' => $request->pesan_kesan,

        ]);

        return redirect('/buku-tamu')
            ->with('success', 'Data berhasil disimpan.');
    }
}