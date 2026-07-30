<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Laporan Statistik Buku Tamu</title>

<style>

body{

    font-family: DejaVu Sans, sans-serif;

    font-size:12px;

    color:#000;

}

.judul{

    text-align:center;

    margin-bottom:20px;

}

.judul h2{

    margin:0;

}

.judul h3{

    margin:5px 0;

}

.info{

    margin-bottom:20px;

}

table{

    width:100%;

    border-collapse:collapse;

    margin-bottom:25px;

}

th{

    background:#2E7D32;

    color:white;

    border:1px solid #000;

    padding:8px;

}

td{

    border:1px solid #000;

    padding:8px;

}

.section{

    margin-top:20px;

    margin-bottom:8px;

    font-weight:bold;

    font-size:14px;

}

</style>

</head>

<body>

<div class="judul">

<h2>

PEMERINTAH DESA TUWUNG

</h2>

<h3>

LAPORAN STATISTIK BUKU TAMU

</h3>

</div>

<div class="info">

<table style="border:none; width:auto;">

<tr>
    <td style="border:none; padding:2px 6px 2px 0;"><b>Tanggal Cetak</b></td>
    <td style="border:none;">: {{ now()->format('d F Y H:i') }}</td>
</tr>

@if($startDate && $endDate)
<tr>
    <td style="border:none; padding:2px 6px 2px 0;"><b>Periode</b></td>
    <td style="border:none;">
        : {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }}
        s/d
        {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}
    </td>
</tr>
@endif

@if(!empty($kategori))
<tr>
    <td style="border:none; padding:2px 6px 2px 0;"><b>Kategori Tujuan</b></td>
    <td style="border:none;">: {{ $kategori }}</td>
</tr>
@endif

</table>

</div>

<div class="section">

Ringkasan Statistik

</div>

<table>

<tr>

<th>Hari Ini</th>

<th>Bulan Ini</th>

<th>Tahun Ini</th>

<th>Total</th>

</tr>

<tr>

<td align="center">

{{ $hariIni }}

</td>

<td align="center">

{{ $bulanIni }}

</td>

<td align="center">

{{ $tahunIni }}

</td>

<td align="center">

{{ $total }}

</td>

</tr>

</table>

<div class="section">

Top 5 Instansi

</div>

<table>

<tr>

<th>No</th>

<th>Instansi</th>

<th>Jumlah</th>

</tr>

@foreach($topInstansi as $item)

<tr>

<td align="center">

{{ $loop->iteration }}

</td>

<td>

{{ $item['instansi'] }}

</td>

<td align="center">

{{ $item['total'] }}

</td>

</tr>

@endforeach

</table>

<div class="section">

Top 5 Keperluan

</div>

<table>

<tr>

<th>No</th>

<th>Keperluan</th>

<th>Jumlah</th>

</tr>

@foreach($topKeperluan as $item)

<tr>

<td align="center">

{{ $loop->iteration }}

</td>

<td>

{{ $item['keperluan'] }}

</td>

<td align="center">

{{ $item['total'] }}

</td>

</tr>

@endforeach

</table>

<div class="section">

Top 5 Pengunjung

</div>

<table>

<tr>

<th>No</th>

<th>Nama</th>

<th>Jumlah</th>

</tr>

@foreach($topPengunjung as $item)

<tr>

<td align="center">

{{ $loop->iteration }}

</td>

<td>

{{ $item['nama'] }}

</td>

<td align="center">

{{ $item['total'] }}

</td>

</tr>

@endforeach

</table>

</body>

</html>