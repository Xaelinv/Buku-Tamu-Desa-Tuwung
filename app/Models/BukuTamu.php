<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BukuTamu extends Model
{
    protected $table = 'buku_tamus';

    protected $fillable = [

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

    ];
}