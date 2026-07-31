@extends('layouts.admin')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('page-description')
Ringkasan aktivitas Buku Tamu Digital Desa Tuwung.
@endsection

@section('content')

<div class="row g-4 mb-4">

    <!-- Total Pengunjung -->
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

                        <small class="text-muted">
                            Seluruh data pengunjung
                        </small>
                    </div>

                    <div class="icon">
                        <i class="bi bi-people-fill"></i>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- Hari Ini -->
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

                        <small class="text-muted">
                            Kunjungan hari ini
                        </small>
                    </div>

                    <div class="icon">
                        <i class="bi bi-calendar-day"></i>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- Bulan Ini -->
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

                        <small class="text-muted">
                            Kunjungan bulan ini
                        </small>
                    </div>

                    <div class="icon">
                        <i class="bi bi-calendar2-week"></i>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- Tahun Ini -->
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

                        <small class="text-muted">
                            Kunjungan tahun ini
                        </small>
                    </div>

                    <div class="icon">
                        <i class="bi bi-calendar3"></i>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>

<!-- Grafik Pengunjung -->
<div class="card chart-card mb-4 shadow-sm border-0">

    <div class="card-body p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h5 class="fw-bold mb-1">
                    Grafik Pengunjung Bulanan
                </h5>

                <small class="text-muted">
                    Statistik jumlah pengunjung setiap bulan
                </small>

            </div>

            <div class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                Tahun {{ date('Y') }}
            </div>

        </div>

        <div class="chart-box">
            <canvas id="chartPengunjung"></canvas>
        </div>

    </div>

</div>

<!-- Pengunjung Terbaru -->
<div class="card table-card shadow-sm border-0">

    <div class="card-body p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h5 class="fw-bold mb-1">
                    Pengunjung Terbaru
                </h5>

                <small class="text-muted">
                    Menampilkan 5 data kunjungan terakhir.
                </small>

            </div>

            <a href="{{ route('admin.data') }}" class="btn btn-success px-3">
                <i class="bi bi-list-ul me-1"></i>
                Lihat Semua
            </a>

        </div>

        <div class="table-responsive">

            <table class="table align-middle table-hover mb-0">

                <thead>

                    <tr>

                        <th width="60">No</th>
                        <th>Nama</th>
                        <th>Instansi</th>
                        <th>Bertemu</th>
                        <th width="180">Tanggal</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($pengunjungTerbaru as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>

                            <div class="fw-semibold">
                                {{ $item->nama }}
                            </div>

                        </td>

                        <td>{{ $item->instansi }}</td>

                        <td>{{ $item->bertemu_dengan }}</td>

                        <td>

                            <small class="text-muted">
                                {{ $item->created_at->format('d M Y') }}
                            </small>

                            <br>

                            <small class="text-success">
                                {{ $item->created_at->format('H:i') }}
                            </small>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5" class="text-center py-5 text-muted">

                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>

                            Belum ada data pengunjung.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script>

const bulan = [
    'Jan','Feb','Mar','Apr','Mei','Jun',
    'Jul','Agu','Sep','Okt','Nov','Des'
];

const jumlah = [

@for($i = 1; $i <= 12; $i++)
{{ $grafik->firstWhere('bulan', $i)->jumlah ?? 0 }},
@endfor

];

const ctx = document.getElementById('chartPengunjung').getContext('2d');

const gradient = ctx.createLinearGradient(0, 0, 0, 350);

gradient.addColorStop(0, 'rgba(46,125,50,0.25)');
gradient.addColorStop(1, 'rgba(46,125,50,0.02)');

new Chart(ctx, {

    type: 'line',

    data: {

        labels: bulan,

        datasets: [{

            label: 'Jumlah Pengunjung',

            data: jumlah,

            borderColor: '#2E7D32',

            backgroundColor: gradient,

            fill: true,

            tension: 0.4,

            pointBackgroundColor: '#2E7D32',

            pointBorderColor: '#ffffff',

            pointBorderWidth: 2,

            pointRadius: 5,

            pointHoverRadius: 7,

            borderWidth: 3

        }]

    },

    options: {

        responsive: true,

        maintainAspectRatio: false,

        plugins: {

            legend: {
                display: false
            },

            tooltip: {

                backgroundColor: '#ffffff',

                titleColor: '#111827',

                bodyColor: '#374151',

                borderColor: '#E5E7EB',

                borderWidth: 1,

                displayColors: false,

                padding: 12

            }

        },

        scales: {

            x: {

                grid: {
                    display: false
                },

                ticks: {
                    color: '#6B7280'
                }

            },

            y: {

                beginAtZero: true,

                ticks: {

                    precision: 0,

                    color: '#6B7280'

                },

                grid: {

                    color: '#F1F5F9',

                    drawBorder: false

                }

            }

        }

    }

});

</script>

@endpush