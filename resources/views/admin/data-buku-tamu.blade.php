@extends('layouts.admin')

@section('title', 'Data Buku Tamu')

@section('page-title', 'Data Buku Tamu')

@section('page-description')
Kelola seluruh data pengunjung Buku Tamu Digital Desa Tuwung.
@endsection

@section('header-action')
<a href="{{ route('admin.export.excel', request()->all()) }}"
    class="btn btn-success">
    <i class="bi bi-file-earmark-excel me-2"></i>
    Export Excel
</a>
@endsection

@section('content')

<div class="card shadow-sm border-0">
    <div class="card-body">

        <form
            id="filterForm"
            action="{{ route('admin.data') }}"
            method="GET">

            <div class="row g-3 align-items-end">

                {{-- Cari --}}
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
                            placeholder="Cari nama atau instansi..."
                            value="{{ request('search') }}">
                    </div>
                </div>

                {{-- Dari --}}
                <div class="col-lg-2">
                    <label class="form-label fw-semibold">
                        Dari Tanggal
                    </label>

                    <input
                        type="date"
                        class="form-control"
                        name="tanggal_awal"
                        value="{{ request('tanggal_awal') }}">
                </div>

                {{-- Sampai --}}
                <div class="col-lg-2">
                    <label class="form-label fw-semibold">
                        Sampai Tanggal
                    </label>

                    <input
                        type="date"
                        class="form-control"
                        name="tanggal_akhir"
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
                <div class="col-lg-2">

                    <div class="d-grid gap-2">

                        <button
                            class="btn btn-success"
                            type="submit">
                            <i class="bi bi-funnel me-2"></i>
                            Terapkan
                        </button>

                        <a
                            href="{{ route('admin.data') }}"
                            class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-clockwise me-2"></i>
                            Reset
                        </a>

                    </div>

                </div>

            </div>

        </form>

        <hr class="my-4">

        @if(request('tanggal_awal') && request('tanggal_akhir'))

            <div class="alert alert-info d-flex align-items-center mb-0">
                <i class="bi bi-calendar-range me-2"></i>

                <span>
                    Menampilkan data dari
                    <strong>
                        {{ \Carbon\Carbon::parse(request('tanggal_awal'))->translatedFormat('d F Y') }}
                    </strong>
                    sampai
                    <strong>
                        {{ \Carbon\Carbon::parse(request('tanggal_akhir'))->translatedFormat('d F Y') }}
                    </strong>
                </span>

            </div>

        @else

            <div class="alert alert-light border d-flex align-items-center mb-0">
                <i class="bi bi-card-list me-2"></i>

                <span>
                    Menampilkan seluruh data buku tamu.
                </span>

            </div>

        @endif

    </div>
</div>

<div class="card shadow-sm border-0 mt-4">
    <div class="card-body p-0">

        {{-- Hapus table-responsive yang dobel --}}
        <div class="table-responsive">

            <table class="table table-hover align-middle table-modern mb-0">

                <thead>

                    <tr>

                        <th class="text-center" style="width:60px">
                            No
                        </th>

                        <th style="width:180px">
                            Nama
                        </th>

                        <th style="width:180px">
                            Instansi
                        </th>

                        <th style="width:130px">
                            Jabatan
                        </th>

                        <th style="width:130px">
                            No. HP
                        </th>

                        <th style="width:170px">
                            Bertemu Dengan
                        </th>

                        <th style="width:180px">
                            Keperluan
                        </th>

                        <th>
                            Pesan & Kesan
                        </th>

                        <th class="text-center" style="width:90px">
                            Tanggal
                        </th>

                        <th class="text-center" style="width:70px">
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

    {{-- Nomor --}}
    <td class="text-center fw-semibold">
        {{ $tamu->firstItem() + $loop->index }}
    </td>

    {{-- Nama --}}
    <td>
        <div class="nama-cell">
    {{ $item->nama }}
</div>
    </td>

    {{-- Instansi --}}
    <td>
        <div class="instansi-cell">
    {{ $item->instansi }}
</div>
    </td>

    {{-- Jabatan --}}
    <td>
        <div class="wrap-cell">
    {{ $item->jabatan }}
</div>
    </td>

    {{-- Nomor HP --}}
    <td>
        <div class="wrap-cell">
            {{ $item->no_hp ?: '-' }}
        </div>
    </td>

    {{-- Bertemu --}}
    <td>
        <div class="wrap-cell">
    {{ $bertemu }}
</div>
    </td>

    {{-- Keperluan --}}
    <td>
        <div class="wrap-cell">
    {{ $keperluan }}
</div>
    </td>

    {{-- Pesan --}}
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

        {{ \Illuminate\Support\Str::limit($item->pesan_kesan ?: '-',40) }}

    </td>

    {{-- Tanggal --}}
    <td class="text-center">
        <div class="tanggal-box">

            <div class="tanggal">
                {{ $item->created_at->format('d M') }}
            </div>

            <div class="tahun">
                {{ $item->created_at->format('Y') }}
            </div>

            <small class="jam">
                {{ $item->created_at->format('H:i') }}
            </small>

        </div>
    </td>

    {{-- Aksi --}}
    <td class="text-center">

        <form id="deleteForm{{ $item->id }}"
      action="{{ route('admin.hapus',$item->id) }}"
      method="POST">

    @csrf
    @method('DELETE')

    <button
        type="button"
        class="btn btn-delete btn-open-delete"
        data-form="deleteForm{{ $item->id }}">

        <i class="bi bi-trash-fill"></i>

    </button>

</form>

    </td>

</tr>
@empty

<tr>

    <td colspan="10" class="text-center py-5">

        <div class="empty-state">

            <i class="bi bi-inbox"></i>

            <h5 class="mt-3 mb-2">
                Belum Ada Data Buku Tamu
            </h5>

            <p class="text-muted mb-0">
                Data pengunjung akan muncul di sini.
            </p>

        </div>

    </td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="d-flex justify-content-between align-items-center flex-wrap p-4 border-top">

    <small class="text-muted">

        Menampilkan

        <strong>
            {{ $tamu->firstItem() ?? 0 }}
        </strong>

        -

        <strong>
            {{ $tamu->lastItem() ?? 0 }}
        </strong>

        dari

        <strong>
            {{ $tamu->total() }}
        </strong>

        data

    </small>

    {{ $tamu->links('pagination::bootstrap-5') }}

</div>

</div>

</div>

{{-- ===========================
    MODAL DETAIL
=========================== --}}

<div
    class="modal fade"
    id="detailModal"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content border-0 shadow">

            <div class="modal-header">

                <h5 class="modal-title">
                    Detail Buku Tamu
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <div class="row g-4">

                    <div class="col-md-6">

                        <label class="form-label text-muted mb-1">
                            Nama
                        </label>

                        <div id="modalNama" class="fw-semibold"></div>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label text-muted mb-1">
                            Instansi
                        </label>

                        <div id="modalInstansi"></div>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label text-muted mb-1">
                            Jabatan
                        </label>

                        <div id="modalJabatan"></div>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label text-muted mb-1">
                            Nomor HP
                        </label>

                        <div id="modalNoHp"></div>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label text-muted mb-1">
                            Bertemu Dengan
                        </label>

                        <div id="modalBertemu"></div>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label text-muted mb-1">
                            Tanggal Kunjungan
                        </label>

                        <div id="modalTanggal"></div>

                    </div>

                    <div class="col-12">

                        <label class="form-label text-muted mb-1">
                            Keperluan
                        </label>

                        <div id="modalKeperluan"></div>

                    </div>

                    <div class="col-12">

                        <label class="form-label text-muted mb-1">
                            Pesan & Kesan
                        </label>

                        <div
                            id="modalPesan"
                            class="border rounded p-3 bg-light"
                            style="min-height:100px;">
                        </div>

                    </div>

                </div>

            </div>
            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    Tutup

                </button>

            </div>

        </div>

    </div>

</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow">

            <div class="modal-header border-0">

                <h5 class="modal-title fw-bold text-danger">
                    <i class="bi bi-trash-fill me-2"></i>
                    Konfirmasi Hapus
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body text-center">

                <div class="mb-3">

                    <div class="rounded-circle bg-danger bg-opacity-10 d-inline-flex align-items-center justify-content-center"
                        style="width:80px;height:80px;">

                        <i class="bi bi-trash-fill text-danger fs-1"></i>

                    </div>

                </div>

                <h5 class="fw-bold">
                    Hapus data ini?
                </h5>

                <p class="text-muted mb-0">
                    Data yang sudah dihapus tidak dapat dikembalikan lagi.
                </p>

            </div>

            <div class="modal-footer border-0 justify-content-center">

                <button
                    class="btn btn-light px-4"
                    data-bs-dismiss="modal">

                    Batal

                </button>

                <button
                    id="confirmDeleteBtn"
                    class="btn btn-danger px-4">

                    Ya, Hapus

                </button>

            </div>

        </div>

    </div>

</div>

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    // ======================
    // Live Search
    // ======================

    const searchInput = document.getElementById('search');

    if (searchInput) {

        searchInput.addEventListener('keyup', function () {

            clearTimeout(window.searchTimer);

            window.searchTimer = setTimeout(() => {

                document.getElementById('filterForm').submit();

            }, 500);

        });

    }

    // ======================
    // Detail Modal
    // ======================

    const detailModal = document.getElementById('detailModal');

    if (detailModal) {

        detailModal.addEventListener('show.bs.modal', function (event) {

            const button = event.relatedTarget;

            document.getElementById('modalNama').textContent =
                button.getAttribute('data-nama');

            document.getElementById('modalInstansi').textContent =
                button.getAttribute('data-instansi');

            document.getElementById('modalJabatan').textContent =
                button.getAttribute('data-jabatan');

            document.getElementById('modalNoHp').textContent =
                button.getAttribute('data-nohp');

            document.getElementById('modalBertemu').textContent =
                button.getAttribute('data-bertemu');

            document.getElementById('modalKeperluan').textContent =
                button.getAttribute('data-keperluan');

            document.getElementById('modalTanggal').textContent =
                button.getAttribute('data-tanggal');

            document.getElementById('modalPesan').textContent =
                button.getAttribute('data-pesan');

        });

    }

// ======================
// Konfirmasi Hapus
// ======================

const deleteModal = new bootstrap.Modal(
    document.getElementById('deleteModal')
);

let selectedForm = null;

document.querySelectorAll('.btn-open-delete').forEach(button => {

    button.addEventListener('click', function () {

        const formId = this.dataset.form;

        selectedForm = document.getElementById(formId);

        deleteModal.show();

    });

});

document.getElementById('confirmDeleteBtn').addEventListener('click', function () {

    if (selectedForm) {

        selectedForm.submit();

    }

});

});

</script>

@endpush

@endsection