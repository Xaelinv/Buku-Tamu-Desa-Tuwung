@extends('layouts.admin')

@section('title', 'Statistik')

@section('page-title', 'Statistik Buku Tamu')

@section('page-description')
Analisis data kunjungan Buku Tamu Digital Desa Tuwung.
@endsection

@section('header-action')

<div class="d-flex gap-2">

    <a href="{{ route('admin.statistik.export.excel', [
        'start_date' => request('start_date'),
        'end_date' => request('end_date'),
        'kategori' => request('kategori')
    ]) }}"
        class="btn btn-success px-4">

        <i class="bi bi-file-earmark-excel me-2"></i>
        Export Excel

    </a>

    <a href="{{ route('admin.statistik.export.pdf', [
        'start_date' => request('start_date'),
        'end_date' => request('end_date'),
        'kategori' => request('kategori')
    ]) }}"
        class="btn btn-danger px-4">

        <i class="bi bi-file-earmark-pdf me-2"></i>
        Export PDF

    </a>

</div>

@endsection

@section('content')

{{-- =========================
     FILTER
========================= --}}

<div class="card shadow-sm border-0 rounded-4 mb-4">

    <div class="card-body p-4">

        <form method="GET">

            <div class="row g-3 align-items-end">

                {{-- Dari Tanggal --}}
                <div class="col-lg-3">

                    <label class="form-label fw-semibold">
                        Dari Tanggal
                    </label>

                    <input
                        type="date"
                        name="start_date"
                        value="{{ request('start_date') }}"
                        class="form-control">

                </div>

                {{-- Sampai Tanggal --}}
                <div class="col-lg-3">

                    <label class="form-label fw-semibold">
                        Sampai Tanggal
                    </label>

                    <input
                        type="date"
                        name="end_date"
                        value="{{ request('end_date') }}"
                        class="form-control">

                </div>

                {{-- Kategori --}}
                <div class="col-lg-3">

                    <label class="form-label fw-semibold">
                        Kategori Tujuan
                    </label>

                    <select
                        name="kategori"
                        class="form-select">

                        <option value="">Semua</option>

                        <option value="Kantor Desa"
                            {{ request('kategori')=='Kantor Desa' ? 'selected' : '' }}>
                            Kantor Desa
                        </option>

                        <option value="BPD"
                            {{ request('kategori')=='BPD' ? 'selected' : '' }}>
                            BPD
                        </option>

                        <option value="TP-PKK"
                            {{ request('kategori')=='TP-PKK' ? 'selected' : '' }}>
                            TP-PKK
                        </option>

                        <option value="Karang Taruna"
                            {{ request('kategori')=='Karang Taruna' ? 'selected' : '' }}>
                            Karang Taruna
                        </option>

                        <option value="BUMDes"
                            {{ request('kategori')=='BUMDes' ? 'selected' : '' }}>
                            BUMDes
                        </option>

                        <option value="LPHD"
                            {{ request('kategori')=='LPHD' ? 'selected' : '' }}>
                            LPHD
                        </option>

                    </select>

                </div>

                {{-- Tombol --}}
                <div class="col-lg-3">

                    <div class="d-grid gap-2">

                        <button
                            class="btn btn-success"
                            type="submit">

                            <i class="bi bi-funnel me-2"></i>

                            Terapkan

                        </button>

                        <a
                            href="{{ route('admin.statistik') }}"
                            class="btn btn-outline-secondary">

                            <i class="bi bi-arrow-clockwise me-2"></i>

                            Reset

                        </a>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>

{{-- =========================
     CARD STATISTIK
========================= --}}

<div class="row g-4 mb-4">

    {{-- Hari Ini --}}
    <div class="col-lg-3 col-md-6">

        <div class="card stat-card h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <div class="stat-title">

                            Hari Ini

                        </div>

                        <div class="stat-value">

                            {{ $hariIni }}

                        </div>

                    </div>

                    <div class="stat-icon">

                        <i class="bi bi-calendar-day"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Bulan Ini --}}
    <div class="col-lg-3 col-md-6">

        <div class="card stat-card h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <div class="stat-title">

                            Bulan Ini

                        </div>

                        <div class="stat-value">

                            {{ $bulanIni }}

                        </div>

                    </div>

                    <div class="stat-icon">

                        <i class="bi bi-calendar2-week"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Tahun Ini --}}
    <div class="col-lg-3 col-md-6">

        <div class="card stat-card h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <div class="stat-title">

                            Tahun Ini

                        </div>

                        <div class="stat-value">

                            {{ $tahunIni }}

                        </div>

                    </div>

                    <div class="stat-icon">

                        <i class="bi bi-calendar3"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Total Pengunjung --}}
    <div class="col-lg-3 col-md-6">

        <div class="card stat-card h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <div class="stat-title">

                            Total Pengunjung

                        </div>

                        <div class="stat-value">

                            {{ $total }}

                        </div>

                    </div>

                    <div class="stat-icon">

                        <i class="bi bi-people-fill"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- ===========================
     GRAFIK KUNJUNGAN
=========================== --}}

<div class="card shadow-sm border-0 rounded-4 mb-4">

    <div class="card-header bg-white border-0 py-4">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h5 class="fw-bold mb-1">

                    Grafik Kunjungan Bulanan

                </h5>

                <small class="text-muted">

                    Statistik jumlah pengunjung setiap bulan.

                </small>

            </div>

            <div class="chart-icon">

                <i class="bi bi-graph-up-arrow"></i>

            </div>

        </div>

    </div>

    <div class="card-body pt-0">

        <div style="height:420px">

            <canvas id="grafikBulanan"></canvas>

        </div>

    </div>

</div>

{{-- ===========================
     TOP INSTANSI & TOP KEPERLUAN
=========================== --}}

<div class="row g-4 mb-4">

    {{-- ================= Top Instansi ================= --}}
    <div class="col-lg-6">

        <div class="card shadow-sm border-0 rounded-4 h-100">

            <div class="card-body p-4">

                <div class="d-flex align-items-center mb-4">

                    <div class="section-icon me-3">

                        <i class="bi bi-building"></i>

                    </div>

                    <div>

                        <h5 class="fw-bold mb-1">

                            Top 5 Instansi

                        </h5>

                        <small class="text-muted">

                            Instansi dengan jumlah kunjungan terbanyak.

                        </small>

                    </div>

                </div>

                @php
                    $maxInstansi = $topInstansi->max('total') ?: 1;
                @endphp

                @forelse($topInstansi as $item)

                    <div class="mb-4">

                        <div class="d-flex justify-content-between align-items-center mb-2">

                            <span class="fw-semibold">

                                {{ $item->instansi }}

                            </span>

                            <span class="badge bg-success rounded-pill px-3 py-2">

                                {{ $item->total }}

                            </span>

                        </div>

                        <div class="progress modern-progress">

                            <div
                                class="progress-bar bg-success"
                                role="progressbar"
                                style="width: {{ ($item->total/$maxInstansi)*100 }}%">

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="text-center py-5">

                        <i class="bi bi-inbox display-5 text-secondary"></i>

                        <h5 class="mt-3">

                            Belum Ada Data

                        </h5>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

    {{-- ================= Top Keperluan ================= --}}
    <div class="col-lg-6">

        <div class="card shadow-sm border-0 rounded-4 h-100">

            <div class="card-body p-4">

                <div class="d-flex align-items-center mb-4">

                    <div class="section-icon me-3">

                        <i class="bi bi-file-earmark-text"></i>

                    </div>

                    <div>

                        <h5 class="fw-bold mb-1">

                            Top 5 Keperluan

                        </h5>

                        <small class="text-muted">

                            Keperluan yang paling sering dipilih.

                        </small>

                    </div>

                </div>

                @php
                    $maxKeperluan = $topKeperluan->max('total') ?: 1;
                @endphp

                @forelse($topKeperluan as $item)

                    <div class="mb-4">

                        <div class="d-flex justify-content-between align-items-center mb-2">

                            <span class="fw-semibold">

                                {{ $item->keperluan }}

                            </span>

                            <span class="badge bg-success rounded-pill px-3 py-2">

                                {{ $item->total }}

                            </span>

                        </div>

                        <div class="progress modern-progress">

                            <div
                                class="progress-bar bg-success"
                                role="progressbar"
                                style="width: {{ ($item->total/$maxKeperluan)*100 }}%">

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="text-center py-5">

                        <i class="bi bi-inbox display-5 text-secondary"></i>

                        <h5 class="mt-3">

                            Belum Ada Data

                        </h5>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

{{-- ===========================
     TOP PENGUNJUNG & KATEGORI
=========================== --}}

<div class="row g-4">

    {{-- ================= Top Pengunjung ================= --}}
    <div class="col-lg-6">

        <div class="card shadow-sm border-0 rounded-4 h-100">

            <div class="card-body p-4">

                <div class="d-flex align-items-center mb-4">

                    <div class="section-icon me-3">

                        <i class="bi bi-person-fill"></i>

                    </div>

                    <div>

                        <h5 class="fw-bold mb-1">

                            Top Pengunjung Teraktif

                        </h5>

                        <small class="text-muted">

                            Pengunjung dengan jumlah kunjungan terbanyak.

                        </small>

                    </div>

                </div>

                @forelse($topPengunjung as $item)

                    <div class="visitor-item">

                        <div class="d-flex align-items-center">

                            <div class="ranking-number">

                                @if($loop->iteration == 1)

                                    <span class="text-warning">
                                        <i class="bi bi-trophy-fill"></i>
                                    </span>

                                @elseif($loop->iteration == 2)

                                    <span class="text-secondary">
                                        <i class="bi bi-award-fill"></i>
                                    </span>

                                @elseif($loop->iteration == 3)

                                    <span style="color:#CD7F32">
                                        <i class="bi bi-award-fill"></i>
                                    </span>

                                @else

                                    {{ $loop->iteration }}

                                @endif

                            </div>

                            <div>

                                <div class="fw-semibold">

                                    {{ $item->nama }}

                                </div>

                            </div>

                        </div>

                        <span class="badge bg-success rounded-pill px-3 py-2">

                            {{ $item->total }}x

                        </span>

                    </div>

                @empty

                    <div class="text-center py-5">

                        <i class="bi bi-inbox display-5 text-secondary"></i>

                        <h5 class="mt-3">

                            Belum Ada Data

                        </h5>

                    </div>

                @endforelse

            </div>

        </div>

    </div>



    {{-- ================= Statistik Kategori ================= --}}
    <div class="col-lg-6">

        <div class="card shadow-sm border-0 rounded-4 h-100">

            <div class="card-body p-4">

                <div class="d-flex align-items-center mb-4">

                    <div class="section-icon me-3">

                        <i class="bi bi-pie-chart-fill"></i>

                    </div>

                    <div>

                        <h5 class="fw-bold mb-1">

                            Statistik Kategori Tujuan

                        </h5>

                        <small class="text-muted">

                            Distribusi kunjungan berdasarkan kategori.

                        </small>

                    </div>

                </div>

                @php
                    $maxKategori = $kategoriStatistik->max('total') ?: 1;
                @endphp

                @forelse($kategoriStatistik as $item)

                    <div class="mb-4">

                        <div class="d-flex justify-content-between align-items-center mb-2">

                            <span class="fw-semibold">

                                {{ $item->kategori_tujuan }}

                            </span>

                            <span class="badge bg-success rounded-pill px-3 py-2">

                                {{ $item->total }}

                            </span>

                        </div>

                        <div class="progress modern-progress">

                            <div
                                class="progress-bar bg-success"
                                role="progressbar"
                                style="width: {{ ($item->total/$maxKategori)*100 }}%">

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="text-center py-5">

                        <i class="bi bi-inbox display-5 text-secondary"></i>

                        <h5 class="mt-3">

                            Belum Ada Data

                        </h5>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script>

const bulan = [
    'Jan',
    'Feb',
    'Mar',
    'Apr',
    'Mei',
    'Jun',
    'Jul',
    'Agu',
    'Sep',
    'Okt',
    'Nov',
    'Des'
];

let dataGrafik = new Array(12).fill(0);

@foreach($grafik as $item)
    dataGrafik[{{ $item->bulan - 1 }}] = {{ $item->total }};
@endforeach

const canvas = document.getElementById('grafikBulanan');

const ctx = canvas.getContext('2d');

const gradient = ctx.createLinearGradient(0,0,0,450);

gradient.addColorStop(0,'rgba(46,125,50,.35)');
gradient.addColorStop(.5,'rgba(46,125,50,.12)');
gradient.addColorStop(1,'rgba(46,125,50,0)');

new Chart(ctx,{

    type:'line',

    data:{

        labels:bulan,

        datasets:[{

            label:'Jumlah Pengunjung',

            data:dataGrafik,

            borderColor:'#2E7D32',

            backgroundColor:gradient,

            fill:true,

            tension:.35,

            borderWidth:3,

            pointRadius:5,

            pointHoverRadius:7,

            pointBackgroundColor:'#2E7D32',

            pointBorderColor:'#ffffff',

            pointBorderWidth:2

        }]

    },

    options:{

        responsive:true,

        maintainAspectRatio:false,

        interaction:{
            intersect:false,
            mode:'index'
        },

        plugins:{

            legend:{
                display:false
            },

            tooltip:{

                backgroundColor:'#1E293B',

                titleColor:'#fff',

                bodyColor:'#fff',

                padding:12,

                displayColors:false,

                callbacks:{

                    label:function(context){

                        return ' '+context.parsed.y+' Pengunjung';

                    }

                }

            }

        },

        scales:{

            x:{

                grid:{
                    display:false
                },

                ticks:{
                    color:'#64748B',
                    font:{
                        size:13
                    }
                }

            },

            y:{

                beginAtZero:true,

                ticks:{

                    precision:0,

                    stepSize:1,

                    color:'#64748B',

                    font:{
                        size:13
                    }

                },

                grid:{

                    color:'#E5E7EB',

                    drawBorder:false

                }

            }

        }

    }

});

</script>

@endpush