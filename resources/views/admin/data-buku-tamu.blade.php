@extends('layouts.admin')

@section('title', 'Data Buku Tamu')

@section('page-title', 'Data Buku Tamu')

@section('page-description')
Kelola seluruh data pengunjung Buku Tamu Digital Desa Tuwung.
@endsection

@section('header-action')

<a href="{{ route('admin.export.excel', request()->all()) }}"
   class="btn btn-success">
    <i class="bi bi-file-earmark-excel me-1"></i>
    Export Excel
</a>

@endsection

@section('content')

<div class="card">

    <div class="card-body">

        <form
    id="filterForm"
    method="GET"
    action="{{ route('admin.data') }}">

    <div class="row g-3 align-items-end mb-4">

    {{-- Search --}}
    <div class="col-lg-3">
        <label class="form-label fw-semibold">
            Cari Data
        </label>

        <div class="input-group">
            <span class="input-group-text bg-white">
                <i class="bi bi-search"></i>
            </span>

            <input
                type="text"
                id="search"
                name="search"
                class="form-control border-start-0"
                placeholder="Cari nama, instansi..."
                value="{{ request('search') }}">
        </div>
    </div>

    {{-- Dari Tanggal --}}
    <div class="col-lg-2">
        <label class="form-label fw-semibold">
            Dari Tanggal
        </label>

        <input
            type="date"
            id="tanggal_awal"
            name="tanggal_awal"
            class="form-control"
            value="{{ request('tanggal_awal') }}">
    </div>

    {{-- Sampai Tanggal --}}
    <div class="col-lg-2">
        <label class="form-label fw-semibold">
            Sampai Tanggal
        </label>

        <input
            type="date"
            id="tanggal_akhir"
            name="tanggal_akhir"
            class="form-control"
            value="{{ request('tanggal_akhir') }}">
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
                {{ request('kategori') == 'Kantor Desa' ? 'selected' : '' }}>
                Kantor Desa
            </option>

            <option value="BPD"
                {{ request('kategori') == 'BPD' ? 'selected' : '' }}>
                BPD
            </option>

            <option value="TP-PKK"
                {{ request('kategori') == 'TP-PKK' ? 'selected' : '' }}>
                TP-PKK
            </option>

            <option value="Karang Taruna"
                {{ request('kategori') == 'Karang Taruna' ? 'selected' : '' }}>
                Karang Taruna
            </option>

            <option value="BUMDes"
                {{ request('kategori') == 'BUMDes' ? 'selected' : '' }}>
                BUMDes
            </option>

            <option value="LPHD"
                {{ request('kategori') == 'LPHD' ? 'selected' : '' }}>
                LPHD
            </option>

        </select>
    </div>

    {{-- Tombol --}}
    <div class="col-lg-2">

    <label class="form-label">&nbsp;</label>

    <div class="filter-buttons">

        <button type="submit" class="btn btn-success btn-filter">
            <i class="bi bi-funnel me-1"></i>
            Terapkan
        </button>

        <a href="{{ route('admin.data') }}" class="btn btn-outline-secondary btn-reset">
            Reset
        </a>

    </div>

</div>

</div>

    @if(request('tanggal_awal') && request('tanggal_akhir'))

        <div class="alert alert-info border-0">

            <i class="bi bi-calendar-range me-2"></i>

            Menampilkan data dari

            <strong>
                {{ \Carbon\Carbon::parse(request('tanggal_awal'))->translatedFormat('d F Y') }}
            </strong>

            sampai

            <strong>
                {{ \Carbon\Carbon::parse(request('tanggal_akhir'))->translatedFormat('d F Y') }}
            </strong>

        </div>

    @else

        <div class="alert alert-light border">

            <i class="bi bi-card-list me-2"></i>

            Menampilkan seluruh data buku tamu.

        </div>

    @endif

</form>

<div class="table-responsive">

</div>

        <div class="table-responsive">

            <table class="table table-modern align-middle mb-0">

                <thead>

                    <tr>

                        <th width="60">No</th>

                        <th>Nama</th>

                        <th>Instansi</th>

                        <th>Jabatan</th>

                        <th>No HP</th>

                        <th>Bertemu</th>

                        <th>Keperluan</th>

                        <th>Pesan & Kesan</th>

                        <th>Tanggal</th>

                        <th width="80" class="text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

@forelse($tamu as $item)

@php

$bertemu = $item->bertemu_lainnya
    ? $item->bertemu_lainnya
    : $item->bertemu_dengan;

$keperluan = $item->keperluan_lainnya
    ? $item->keperluan_lainnya
    : $item->keperluan;

@endphp

<tr>

    <td>

{{ $tamu->firstItem() + $loop->index }}

</td>

    <td>

    <div class="fw-semibold text-dark">

        {{ $item->nama }}

    </div>

    <small class="text-muted">

        {{ $item->created_at->diffForHumans() }}

    </small>

</td>

    <td>

    <span class="badge bg-light text-dark border">

        {{ $item->instansi }}

    </span>

</td>

    <td>

    <span class="text-secondary">

        {{ $item->jabatan }}

    </span>

</td>

    <td>{{ $item->no_hp ?: '-' }}</td>

    <td>{{ $bertemu }}</td>

    <td>{{ $keperluan }}</td>
        <td
        class="pesan-cell"
        role="button"
        data-bs-toggle="modal"
        data-bs-target="#detailModal"

        data-nama="{{ $item->nama }}"
        data-instansi="{{ $item->instansi }}"
        data-jabatan="{{ $item->jabatan }}"
        data-nohp="{{ $item->no_hp ?: '-' }}"
        data-bertemu="{{ $bertemu }}"
        data-keperluan="{{ $keperluan }}"
        data-tanggal="{{ $item->created_at->format('d-m-Y H:i') }}"
        data-pesan="{{ $item->pesan_kesan ?: '-' }}">

        {{ \Illuminate\Support\Str::limit($item->pesan_kesan ?: '-', 45) }}

    </td>

    <td>

        <div class="fw-semibold">

            {{ $item->created_at->format('d M Y') }}

        </div>

        <small class="text-muted">

            {{ $item->created_at->format('H:i') }}

        </small>

    </td>

    <td class="text-center">

        <form
            action="{{ route('admin.hapus', $item->id) }}"
            method="POST"
            class="delete-form">

            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="btn btn-sm btn-danger rounded-3 px-2"

                <i class="bi bi-trash"></i>

            </button>

        </form>

    </td>

</tr>

@empty

<tr>

    <td colspan="10" class="text-center py-5">

        <i class="bi bi-inbox display-5 text-secondary"></i>

        <h5 class="mt-3 mb-1">

            Belum Ada Data Buku Tamu

        </h5>

        <p class="text-muted mb-0">

            Data pengunjung akan muncul di sini.

        </p>

    </td>

</tr>

@endforelse

</tbody>

</table>
</table>

</div>

<div class="d-flex justify-content-between align-items-center flex-wrap mt-4">

    <small class="text-muted">

        Menampilkan

        {{ $tamu->firstItem() }}

        -

        {{ $tamu->lastItem() }}

        dari

        {{ $tamu->total() }}

        data

    </small>

    {{ $tamu->links('pagination::bootstrap-5') }}

</div>

</div>

</div>

</div>

</div>

</div>

<!-- Modal Detail -->

<div
    class="modal fade"
    id="detailModal"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    Detail Pengunjung

                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">

                </button>

            </div>

            <div class="modal-body">

                <table class="table">

                    <tbody>

                    <tr>

                        <th width="220">Nama</th>

                        <td id="modalNama"></td>

                    </tr>

                    <tr>

                        <th>Instansi</th>

                        <td id="modalInstansi"></td>

                    </tr>

                    <tr>

                        <th>Jabatan</th>

                        <td id="modalJabatan"></td>

                    </tr>

                    <tr>

                        <th>No. HP</th>

                        <td id="modalNoHp"></td>

                    </tr>

                    <tr>

                        <th>Bertemu Dengan</th>

                        <td id="modalBertemu"></td>

                    </tr>

                    <tr>

                        <th>Keperluan</th>

                        <td id="modalKeperluan"></td>

                    </tr>

                    <tr>

                        <th>Tanggal & Jam</th>

                        <td id="modalTanggal"></td>

                    </tr>

                    <tr>

                        <th>Pesan & Kesan</th>

                        <td id="modalPesan"></td>

                    </tr>

                    </tbody>

                </table>

            </div>

            <div class="modal-footer">

                <button
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    Tutup

                </button>

            </div>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script>

const form = document.getElementById('filterForm');
const search = document.getElementById('search');

let timer = null;

/* ==========================
   Live Search
========================== */

search.addEventListener('keyup', function () {

    clearTimeout(timer);

    timer = setTimeout(function () {

        form.submit();

    }, 500);

});

/* ==========================
   Modal Detail
========================== */

const detailModal = document.getElementById('detailModal');

detailModal.addEventListener('show.bs.modal', function (event) {

    const button = event.relatedTarget;

    document.getElementById('modalNama').textContent = button.dataset.nama;
    document.getElementById('modalInstansi').textContent = button.dataset.instansi;
    document.getElementById('modalJabatan').textContent = button.dataset.jabatan;
    document.getElementById('modalNoHp').textContent = button.dataset.nohp;
    document.getElementById('modalBertemu').textContent = button.dataset.bertemu;
    document.getElementById('modalKeperluan').textContent = button.dataset.keperluan;
    document.getElementById('modalTanggal').textContent = button.dataset.tanggal;
    document.getElementById('modalPesan').textContent = button.dataset.pesan;

});

/* ==========================
   Konfirmasi Hapus
========================== */

document.querySelectorAll('.delete-form').forEach(function(formDelete){

    formDelete.addEventListener('submit', function(e){

        e.preventDefault();

        Swal.fire({

            title: 'Hapus Data?',

            text: 'Data yang dihapus tidak dapat dikembalikan.',

            icon: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#2E7D32',

            cancelButtonColor: '#6B7280',

            confirmButtonText: 'Ya, Hapus',

            cancelButtonText: 'Batal'

        }).then((result)=>{

            if(result.isConfirmed){

                formDelete.submit();

            }

        });

    });

});

</script>

@endpush