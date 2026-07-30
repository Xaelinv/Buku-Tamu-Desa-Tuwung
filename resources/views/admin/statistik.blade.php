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
    
       class="btn btn-success">

        <i class="bi bi-file-earmark-excel me-1"></i>

        Export Excel

    </a>

    <a href="{{ route('admin.statistik.export.pdf', [
    'start_date' => request('start_date'),
    'end_date' => request('end_date'),
    'kategori' => request('kategori')
]) }}"
       class="btn btn-danger">

        <i class="bi bi-file-earmark-pdf me-1"></i>

        Export PDF

    </a>

</div>

@endsection

@section('content')

<div class="card mb-4 border-0 shadow-sm">

    <div class="card-body">

        <form method="GET">

    <div class="row g-3 align-items-end">

<div class="col-lg-3">
<label class="form-label">Dari Tanggal</label>
<input type="date"
name="start_date"
value="{{ request('start_date') }}"
class="form-control">
</div>

<div class="col-lg-3">
<label class="form-label">Sampai Tanggal</label>
<input type="date"
name="end_date"
value="{{ request('end_date') }}"
class="form-control">
</div>

<div class="col-lg-3">
<label class="form-label">Kategori Tujuan</label>

<select name="kategori" class="form-select">

<option value="">Semua</option>

<option value="Kantor Desa" {{ request('kategori')=='Kantor Desa'?'selected':'' }}>Kantor Desa</option>

<option value="BPD" {{ request('kategori')=='BPD'?'selected':'' }}>BPD</option>

<option value="TP-PKK" {{ request('kategori')=='TP-PKK'?'selected':'' }}>TP-PKK</option>

<option value="Karang Taruna" {{ request('kategori')=='Karang Taruna'?'selected':'' }}>Karang Taruna</option>

<option value="BUMDes" {{ request('kategori')=='BUMDes'?'selected':'' }}>BUMDes</option>

<option value="LPHD" {{ request('kategori')=='LPHD'?'selected':'' }}>LPHD</option>

</select>

</div>

<div class="col-lg-3">

<label class="form-label opacity-0">Aksi</label>

<div class="d-flex gap-2">

<button class="btn btn-primary flex-fill">
<i class="bi bi-funnel me-1"></i>
Terapkan
</button>

<a href="{{ route('admin.statistik') }}"
class="btn btn-outline-secondary">
<i class="bi bi-arrow-clockwise"></i>
</a>

</div>

</div>

</div>

</form>

    </div>

</div>

<div class="row g-4 mb-4">

    <!-- Hari Ini -->

    <div class="col-lg-3 col-md-6">

        <div class="card stat-card h-100">

            <div class="card-body">

                <div class="icon">

                    <i class="bi bi-calendar-day"></i>

                </div>

                <div class="stat-title">

                    Hari Ini

                </div>

                <div class="stat-value">

                    {{ $hariIni }}

                </div>

            </div>

        </div>

    </div>

    <!-- Bulan Ini -->

    <div class="col-lg-3 col-md-6">

        <div class="card stat-card h-100">

            <div class="card-body">

                <div class="icon">

                    <i class="bi bi-calendar2-week"></i>

                </div>

                <div class="stat-title">

                    Bulan Ini

                </div>

                <div class="stat-value">

                    {{ $bulanIni }}

                </div>

            </div>

        </div>

    </div>

    <!-- Tahun Ini -->

    <div class="col-lg-3 col-md-6">

        <div class="card stat-card h-100">

            <div class="card-body">

                <div class="icon">

                    <i class="bi bi-calendar3"></i>

                </div>

                <div class="stat-title">

                    Tahun Ini

                </div>

                <div class="stat-value">

                    {{ $tahunIni }}

                </div>

            </div>

        </div>

    </div>

    <!-- Total -->

    <div class="col-lg-3 col-md-6">

        <div class="card stat-card h-100">

            <div class="card-body">

                <div class="icon">

                    <i class="bi bi-people-fill"></i>

                </div>

                <div class="stat-title">

                    Total Pengunjung

                </div>

                <div class="stat-value">

                    {{ $total }}

                </div>

            </div>

        </div>

    </div>

</div>

<!-- ================= Grafik ================= -->

<div class="card chart-card mb-4">

    <div class="card-body">

        <h5 class="fw-semibold mb-4">

            Grafik Kunjungan Bulanan

        </h5>

        <div class="chart-box">

            <canvas id="grafikBulanan"></canvas>

        </div>

    </div>

</div>

<div class="row g-4">

    <!-- ================= Top Instansi ================= -->

    <div class="col-lg-6">

        <div class="card h-100">

            <div class="card-body">

                <h5 class="fw-semibold mb-4">

                    🏢 Top 5 Instansi

                </h5>

                @php
                    $maxInstansi = $topInstansi->max('total') ?: 1;
                @endphp

                @foreach($topInstansi as $item)

                    <div class="mb-4">

                        <div class="d-flex justify-content-between mb-2">

                            <strong>{{ $item->instansi }}</strong>

                            <span>{{ $item->total }}</span>

                        </div>

                        <div class="progress">

                            <div
                                class="progress-bar"
                                style="width: {{ ($item->total / $maxInstansi) * 100 }}%">

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

    <!-- ================= Top Keperluan ================= -->

    <div class="col-lg-6">

        <div class="card h-100">

            <div class="card-body">

                <h5 class="fw-semibold mb-4">

                    📄 Top 5 Keperluan

                </h5>

                @php
                    $maxKeperluan = $topKeperluan->max('total') ?: 1;
                @endphp

                @foreach($topKeperluan as $item)

                    <div class="mb-4">

                        <div class="d-flex justify-content-between mb-2">

                            <strong>{{ $item->keperluan }}</strong>

                            <span>{{ $item->total }}</span>

                        </div>

                        <div class="progress">

                            <div
                                class="progress-bar"
                                style="width: {{ ($item->total / $maxKeperluan) * 100 }}%">

                            </div>

                        </div>

                    </div>

                @endforeach
            </div>

        </div>

    </div>

</div>

<!-- ================= Top Pengunjung & Statistik Kategori ================= -->

<div class="row mt-4 g-4">

    <!-- Top Pengunjung -->
    <div class="col-lg-6">

        <div class="card h-100 shadow-sm top-pengunjung-card">

            <div class="card-body">

                <h5 class="fw-semibold mb-4">
                    👤 Top Pengunjung Teraktif
                </h5>

                @forelse($topPengunjung as $item)

                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">

                        <div class="d-flex align-items-center">

                            @if($loop->iteration == 1)
                                <span class="fs-4 me-3">🥇</span>
                            @elseif($loop->iteration == 2)
                                <span class="fs-4 me-3">🥈</span>
                            @elseif($loop->iteration == 3)
                                <span class="fs-4 me-3">🥉</span>
                            @else
                                <span class="fw-bold me-3" style="width:28px">
                                    {{ $loop->iteration }}.
                                </span>
                            @endif

                            <div>
                                <div class="fw-semibold">
                                    {{ $item->nama }}
                                </div>
                            </div>

                        </div>

                        <span class="badge bg-success kategori-badge">
                         {{ $item->total }}x
                         </span>

                    </div>

                @empty

                    <div class="text-center py-5">
                        <i class="bi bi-inbox display-5 text-secondary"></i>
                        <h5 class="mt-3">Belum Ada Data</h5>
                    </div>

                @endforelse

            </div>

        </div>

    </div>

    <!-- Statistik Kategori -->
    <div class="col-lg-6">

        <div class="card h-100 shadow-sm kategori-card">

            <div class="card-body">

                <h5 class="fw-semibold mb-4">
                    📊 Statistik Kategori Tujuan
                </h5>

                @php
                    $maxKategori = $kategoriStatistik->max('total') ?: 1;
                @endphp

                @forelse($kategoriStatistik as $item)

                    <div class="kategori-item">

                        <div class="d-flex justify-content-between mb-2">

                            <strong>{{ $item->kategori_tujuan }}</strong>

                            <span class="badge bg-success kategori-badge">
                             {{ $item->total }}
                            </span>

                        </div>

                        <div class="progress kategori-progress">

                            <div
                                class="progress-bar bg-success"
                                role="progressbar"
                                style="width: {{ ($item->total / $maxKategori) * 100 }}%">

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

const ctx = document.getElementById('grafikBulanan');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: bulan,

        datasets: [{

            label: 'Jumlah Pengunjung',

            data: dataGrafik,

            backgroundColor: '#2E7D32',

            borderRadius: 10,

            borderSkipped: false,

            maxBarThickness: 40

        }]

    },

    options: {

        responsive: true,

        maintainAspectRatio: false,

        plugins: {

            legend: {

                display: false

            }

        },

        scales: {

            x: {

                grid: {

                    display: false

                }

            },

            y: {

                beginAtZero: true,

                ticks: {

                    precision: 0,

                    stepSize: 1

                },

                grid: {

                    color: '#f1f5f9'

                }

            }

        }

    }

});

</script>

@endpush