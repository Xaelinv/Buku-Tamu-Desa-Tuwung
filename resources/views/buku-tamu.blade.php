<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Buku Tamu Digital Desa Tuwung</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>

        body{

            background:#eef5ef;

            font-family:'Segoe UI',sans-serif;

        }

        .card{

            max-width:900px;

            margin:40px auto;

            border:none;

            border-radius:20px;

            overflow:hidden;

            box-shadow:0 10px 25px rgba(0,0,0,.15);

        }

        .header{

            background:#2E7D32;

            color:#fff;

            text-align:center;

            padding:32px;

        }

        .header h2{

            font-weight:700;

            margin-bottom:8px;

        }

        .required{

            color:#dc3545;

        }

        .form-control,
        .form-select{

            border-radius:10px;

            padding:11px 14px;

        }

        textarea{

            resize:none;

        }

        .btn-success{

            padding:12px;

            border-radius:10px;

            font-weight:600;

        }

        .btn-secondary{

            padding:12px;

            border-radius:10px;

        }

        #bertemu_lainnya,
        #keperluan_lainnya{

            display:none;

        }

    </style>

</head>

<body>

<div class="container">

    <div class="card">

        <div class="header">

            <h2>Buku Tamu Digital</h2>

            <p class="mb-0">

                Desa Tuwung

            </p>

        </div>

        <div class="card-body p-4">

            @if(session('success'))

                <div class="alert alert-success">

                    {{ session('success') }}

                </div>

            @endif

            <form method="POST"
                  action="{{ route('buku-tamu.store') }}">

                @csrf

                <!-- Nama -->

                <div class="mb-3">

                    <label class="form-label">

                        Nama Lengkap

                        <span class="required">*</span>

                    </label>

                    <input
                        type="text"
                        name="nama"
                        class="form-control"
                        value="{{ old('nama') }}"
                        required>

                </div>

                <!-- Instansi -->

                <div class="mb-3">

                    <label class="form-label">

                        Instansi / Asal

                        <span class="required">*</span>

                    </label>

                    <input
                        type="text"
                        name="instansi"
                        class="form-control"
                        value="{{ old('instansi') }}"
                        required>

                </div>

                <!-- Jabatan -->

                <div class="mb-3">

                    <label class="form-label">

                        Jabatan

                        <span class="required">*</span>

                    </label>

                    <input
                        type="text"
                        name="jabatan"
                        class="form-control"
                        value="{{ old('jabatan') }}"
                        required>

                </div>
                <!-- Nomor HP -->

                <div class="mb-3">

                    <label class="form-label">

                        Nomor HP (Opsional)

                    </label>

                    <input
                        type="text"
                        name="no_hp"
                        class="form-control"
                        value="{{ old('no_hp') }}">

                </div>

       <!-- Kategori Tujuan -->

<div class="mb-3">
    <label class="form-label">
        Kategori Tujuan
        <span class="required">*</span>
    </label>

    <select
        class="form-select"
        id="kategori_tujuan"
        name="kategori_tujuan"
        onchange="toggleKategori()"
        required>

        <option value="">-- Pilih Kategori --</option>

        <option value="Kantor Desa"
            {{ old('kategori_tujuan') == 'Kantor Desa' ? 'selected' : '' }}>
            Kantor Desa
        </option>

        <option value="BPD"
            {{ old('kategori_tujuan') == 'BPD' ? 'selected' : '' }}>
            Badan Permusyawaratan Desa (BPD)
        </option>

        <option value="TP-PKK"
            {{ old('kategori_tujuan') == 'TP-PKK' ? 'selected' : '' }}>
            TP-PKK
        </option>

        <option value="Karang Taruna"
            {{ old('kategori_tujuan') == 'Karang Taruna' ? 'selected' : '' }}>
            Karang Taruna
        </option>

        <option value="BUMDes"
            {{ old('kategori_tujuan') == 'BUMDes' ? 'selected' : '' }}>
            Badan Usaha Milik Desa (BUMDes)
        </option>

        <option value="LPHD"
            {{ old('kategori_tujuan') == 'LPHD' ? 'selected' : '' }}>
            Lembaga Pengelola Hutan Desa (LPHD)
        </option>

    </select>
</div>

<!-- Dropdown Tujuan -->

<div
    class="mb-3"
    id="bertemu_dropdown">

    <label class="form-label">
        Bertemu Dengan
        <span class="required">*</span>
    </label>

    <select
        class="form-select"
        id="bertemu"
        name="bertemu_dengan"
        onchange="toggleTujuan()">

        <option value="">-- Pilih --</option>

        <option value="Kepala Desa"
            {{ old('bertemu_dengan') == 'Kepala Desa' ? 'selected' : '' }}>
            Kepala Desa
        </option>

        <option value="Sekretaris Desa"
            {{ old('bertemu_dengan') == 'Sekretaris Desa' ? 'selected' : '' }}>
            Sekretaris Desa
        </option>

        <option value="Kaur Pemerintahan"
            {{ old('bertemu_dengan') == 'Kaur Pemerintahan' ? 'selected' : '' }}>
            Kaur Pemerintahan
        </option>

        <option value="Kaur Keuangan"
            {{ old('bertemu_dengan') == 'Kaur Keuangan' ? 'selected' : '' }}>
            Kaur Keuangan
        </option>

        <option value="Kaur Umum"
            {{ old('bertemu_dengan') == 'Kaur Umum' ? 'selected' : '' }}>
            Kaur Umum
        </option>

        <option value="Kasi Pelayanan"
            {{ old('bertemu_dengan') == 'Kasi Pelayanan' ? 'selected' : '' }}>
            Kasi Pelayanan
        </option>

        <option value="Kasi Pemerintahan"
            {{ old('bertemu_dengan') == 'Kasi Pemerintahan' ? 'selected' : '' }}>
            Kasi Pemerintahan
        </option>

        <option value="Kasi Kesejahteraan"
            {{ old('bertemu_dengan') == 'Kasi Kesejahteraan' ? 'selected' : '' }}>
            Kasi Kesejahteraan
        </option>

        <option value="Lainnya"
            {{ old('bertemu_dengan') == 'Lainnya' ? 'selected' : '' }}>
            Lainnya
        </option>

    </select>

</div>

    <!-- Nama / Jabatan yang Dituju -->

<div
    class="mb-3"
    id="bertemu_textbox"
    style="display:none;">

    <label
        class="form-label"
        id="bertemu_label">

        Nama / Jabatan yang Dituju
        <span class="required">*</span>

    </label>

    <input
        type="text"
        class="form-control"
        id="bertemu_lainnya_input"
        name="bertemu_lainnya"
        value="{{ old('bertemu_lainnya') }}">

</div>

<script>

function toggleKategori(){

    const kategori = document.getElementById('kategori_tujuan').value;

    const dropdown = document.getElementById('bertemu_dropdown');

    const textbox = document.getElementById('bertemu_textbox');

    const label = document.getElementById('bertemu_label');

    const select = document.getElementById('bertemu');

    const input = document.getElementById('bertemu_lainnya_input');

    if(kategori === ''){

        dropdown.style.display = 'none';

        textbox.style.display = 'none';

        select.required = false;

        input.required = false;

        select.value = '';

        input.value = '';

        return;

    }

    if(kategori === 'Kantor Desa'){

        dropdown.style.display = 'block';

        select.required = true;

        if(select.value === 'Lainnya'){

            textbox.style.display = 'block';

            label.innerHTML = 'Nama / Jabatan yang Dituju <span class="required">*</span>';

            input.required = true;

        }else{

            textbox.style.display = 'none';

            input.required = false;

            input.value = '';

        }

    }else{

        dropdown.style.display = 'none';

        textbox.style.display = 'block';

        label.innerHTML = 'Nama / Jabatan yang Dituju <span class="required">*</span>';

        select.required = false;

        select.value = '';

        input.required = true;

    }

}

function toggleTujuan(){

    const kategori = document.getElementById('kategori_tujuan').value;

    if(kategori !== 'Kantor Desa') return;

    const pilih = document.getElementById('bertemu').value;

    const textbox = document.getElementById('bertemu_textbox');

    const input = document.getElementById('bertemu_lainnya_input');

    if(pilih === 'Lainnya'){

        textbox.style.display = 'block';

        input.required = true;

    }else{

        textbox.style.display = 'none';

        input.required = false;

        input.value = '';

    }

}

document.addEventListener('DOMContentLoaded', function(){

    toggleKategori();

});

</script>

                <!-- Keperluan -->

                <div class="mb-3">

                    <label class="form-label">

                        Keperluan

                        <span class="required">*</span>

                    </label>

                    <select
                        class="form-select"
                        id="keperluan"
                        name="keperluan"
                        onchange="toggleKeperluan()"
                        required>

                        <option value="">

                            -- Pilih Keperluan --

                        </option>

                        <option value="Administrasi Kependudukan"
                            {{ old('keperluan') == 'Administrasi Kependudukan' ? 'selected' : '' }}>

                            Administrasi Kependudukan

                        </option>

                        <option value="Surat Menyurat"
                            {{ old('keperluan') == 'Surat Menyurat' ? 'selected' : '' }}>

                            Surat Menyurat

                        </option>

                        <option value="Konsultasi"
                            {{ old('keperluan') == 'Konsultasi' ? 'selected' : '' }}>

                            Konsultasi

                        </option>

                        <option value="Koordinasi"
                            {{ old('keperluan') == 'Koordinasi' ? 'selected' : '' }}>

                            Koordinasi

                        </option>

                        <option value="Audiensi"
                            {{ old('keperluan') == 'Audiensi' ? 'selected' : '' }}>

                            Audiensi

                        </option>

                        <option value="Kunjungan Dinas"
                            {{ old('keperluan') == 'Kunjungan Dinas' ? 'selected' : '' }}>

                            Kunjungan Dinas

                        </option>

                        <option value="Kegiatan Desa"
                            {{ old('keperluan') == 'Kegiatan Desa' ? 'selected' : '' }}>

                            Kegiatan Desa

                        </option>

                        <option value="Penelitian"
                            {{ old('keperluan') == 'Penelitian' ? 'selected' : '' }}>

                            Penelitian

                        </option>

                        <option value="Lainnya"
                            {{ old('keperluan') == 'Lainnya' ? 'selected' : '' }}>

                            Lainnya

                        </option>

                    </select>

                </div>

                <!-- Keperluan Lainnya -->

                <div
                    class="mb-3"
                    id="keperluan_lainnya">

                    <label class="form-label">

                        Tulis Keperluan Lainnya

                        <span class="required">*</span>

                    </label>

                    <input
                        type="text"
                        id="keperluan_lainnya_input"
                        name="keperluan_lainnya"
                        class="form-control"
                        value="{{ old('keperluan_lainnya') }}">

                </div>

                <!-- Pesan & Kesan -->

                <div class="mb-3">

                    <label class="form-label">

                        Pesan & Kesan (Opsional)

                    </label>

                    <textarea
                        class="form-control"
                        rows="4"
                        name="pesan_kesan">{{ old('pesan_kesan') }}</textarea>

                </div>
                <!-- Tanggal & Jam -->

                <div class="row">

                    <div class="col-md-6">

                        <label class="form-label">

                            Tanggal

                        </label>

                        <input
                            type="date"
                            class="form-control"
                            value="{{ now()->format('Y-m-d') }}"
                            readonly>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">

                            Jam

                        </label>

                        <input
                            type="time"
                            class="form-control"
                            value="{{ now()->format('H:i') }}"
                            readonly>

                    </div>

                </div>

                <br>

                <!-- Tombol -->

                <button
                    type="submit"
                    class="btn btn-success w-100">

                    Simpan Buku Tamu

                </button>

                <br><br>

                <a
                    href="{{ url('/') }}"
                    class="btn btn-secondary w-100">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>

<script>

function toggleKeperluan(){

    const pilih = document.getElementById("keperluan").value;

    const kolom = document.getElementById("keperluan_lainnya");

    const input = document.getElementById("keperluan_lainnya_input");

    if(pilih === "Lainnya"){

        kolom.style.display = "block";

        input.required = true;

    }else{

        kolom.style.display = "none";

        input.required = false;

        input.value = "";

    }

}

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>