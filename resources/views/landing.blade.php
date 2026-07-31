<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Buku Tamu Digital Desa Tuwung</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        :root{

            --primary:#2E7D32;
            --primary-dark:#1B5E20;
            --secondary:#66BB6A;
            --bg:#F5F7FA;
            --white:#ffffff;
            --text:#263238;
            --muted:#6B7280;
            --shadow:0 18px 45px rgba(15,23,42,.12);
            --radius:24px;

        }

        *{

            margin:0;
            padding:0;
            box-sizing:border-box;

        }

        html{

            scroll-behavior:smooth;

        }

        body{

            font-family:'Poppins',sans-serif;
            background:var(--bg);
            color:var(--text);
            overflow-x:hidden;

        }

        a{

            text-decoration:none;

        }

    .hero{
    position: relative;
    overflow: hidden;
    color: #fff;
    padding: 70px 0 130px;

    background:
        linear-gradient(
            rgba(27,94,32,.72),
            rgba(46,125,50,.72)
        ),
        url("{{ asset('images/KantorDesa.jpeg') }}");

    background-size: 110%;
    background-position: center 70%;
    background-repeat: no-repeat;
}

    .hero::before{
    content:"";
    position:absolute;
    width:500px;
    height:500px;
    background:rgba(255,255,255,.08);
    border-radius:50%;
    top:-180px;
    right:-140px;
}

        .hero::after{
    content:"";
    position:absolute;
    width:600px;
    height:600px;
    background:rgba(255,255,255,.08);
    border-radius:50%;
    top:-180px;
    right:-180px;
    filter:blur(12px);
}

    .hero .container{
    position:relative;
    z-index:2;
}

        .logo-box{

            width:125px;
            height:125px;
            margin:auto;
            border-radius:50%;
            background:rgba(255,255,255,.12);
            backdrop-filter:blur(10px);
            display:flex;
            justify-content:center;
            align-items:center;
            border:1px solid rgba(255,255,255,.25);

        }

        .logo-box img{

            width:88px;
            height:88px;
            object-fit:contain;

        }

        /* ================= Hero Kantor Desa ================= */

.hero-office{
    position:relative;
    width:100%;
    max-width:430px;
    margin:auto;
}

.hero-office img{
    width:100%;
    height:290px;
    object-fit:cover;
    border-radius:24px;
    border:5px solid rgba(255,255,255,.25);
    box-shadow:0 25px 50px rgba(0,0,0,.35);
    transition:.4s;
}

.hero-office img:hover{
    transform:scale(1.03);
}

.hero-office::before{
    content:'';
    position:absolute;
    inset:-10px;
    border-radius:28px;
    background:linear-gradient(135deg,
        rgba(255,255,255,.35),
        rgba(255,255,255,.05));
    z-index:-1;
}

.hero-office::after{
    content:'';
    position:absolute;
    width:180px;
    height:180px;
    background:rgba(255,255,255,.10);
    border-radius:50%;
    right:-40px;
    bottom:-40px;
    z-index:-2;
}

@media(max-width:992px){

.hero-office{

margin-top:35px;

}

.hero-office img{

height:240px;

}

}

        .hero h1{

            font-size:54px;
            font-weight:700;
            letter-spacing:.5px;
            margin-bottom:10px;

        }

        .hero h3{

            font-size:32px;
            font-weight:500;
            margin-bottom:12px;

        }

        .hero p{

            font-size:18px;
            opacity:.9;
            margin-bottom:0;

        }

        .main-card{

            margin-top:-75px;
            border:none;
            border-radius:30px;
            overflow:hidden;
            background:#fff;
            box-shadow:var(--shadow);
            position:relative;
            z-index:5;

        }

        .section{

            padding:55px;

        }

        .welcome-title{

            font-size:34px;
            font-weight:700;
            margin-bottom:8px;
            color:var(--text);

        }

        .welcome-sub{

            color:var(--muted);
            font-size:17px;
            margin-bottom:45px;

        }

        .menu-card{

            background:#fff;
            border-radius:22px;
            padding:30px;
            border:1px solid #EEF2F7;
            transition:.35s;
            height:100%;
            box-shadow:0 8px 18px rgba(15,23,42,.05);

        }

        .menu-card:hover{

            transform:translateY(-8px);
            box-shadow:0 18px 35px rgba(15,23,42,.10);

        }

        .menu-icon{

            width:72px;
            height:72px;
            border-radius:18px;
            background:#E8F5E9;
            display:flex;
            justify-content:center;
            align-items:center;
            margin:auto;
            margin-bottom:18px;
            font-size:30px;
            color:var(--primary);

        }

        .menu-card h4{

            font-size:22px;
            font-weight:600;
            margin-bottom:12px;

        }

        .menu-card p{

            color:#6B7280;
            font-size:15px;
            line-height:1.7;

        }
        .btn-main{

            display:flex;
            align-items:center;
            justify-content:center;
            gap:10px;
            width:100%;
            height:58px;
            border-radius:16px;
            font-size:17px;
            font-weight:600;
            transition:.3s;
            border:none;

        }

        .btn-success{

            background:linear-gradient(135deg,var(--primary),#43A047);
            box-shadow:0 12px 24px rgba(46,125,50,.25);

        }

        .btn-success:hover{

            background:linear-gradient(135deg,var(--primary-dark),var(--primary));
            transform:translateY(-3px);

        }

        .btn-outline-success{

            border:2px solid var(--primary);
            color:var(--primary);
            background:#fff;

        }

        .btn-outline-success:hover{

            background:var(--primary);
            color:#fff;
            transform:translateY(-3px);

        }

        .divider{

            width:90px;
            height:5px;
            background:linear-gradient(90deg,var(--primary),#66BB6A);
            border-radius:20px;
            margin:18px auto 45px;

        }

        .maps-card{

            overflow:hidden;
            border:none;
            border-radius:22px;
            background:#fff;
            box-shadow:0 12px 28px rgba(15,23,42,.08);

        }

        .maps-card iframe{

            display:block;
            width:100%;
            height:420px;
            border:0;

        }

        .maps-footer{

    padding:20px;
    display:flex;
    justify-content:center;
    align-items:center;
    background:#fff;

}

        .maps-footer .btn{

            padding:12px 30px;
            border-radius:14px;
            font-weight:600;

        }

        .login-admin{

            display:inline-flex;
            align-items:center;
            gap:10px;
            margin-top:45px;
            color:#64748B;
            font-weight:600;
            transition:.3s;

        }

        .login-admin:hover{

            color:var(--primary);

        }

footer{

    margin-top:45px;
    padding:35px 0;
    text-align:center;
    color:#64748B;
    font-size:15px;

}

footer hr{

    opacity:.12;

}

@media(max-width:992px){

    .hero{

        padding:55px 0 120px;
        text-align:center;

    }

    .hero h1{

        font-size:38px;

    }

    .hero h3{

        font-size:25px;

    }

    .hero p{

        font-size:16px;

    }

    .logo-box{

        width:100px;
        height:100px;
        margin-bottom:25px;

    }

    .logo-box img{

        width:70px;
        height:70px;

    }

    .main-card{

        margin-top:-55px;

    }

    .section{

        padding:30px;

    }

    .welcome-title{

        font-size:28px;

    }

    .menu-card{

        margin-bottom:22px;

    }

    .maps-card iframe{

        height:320px;

    }

}

</style>

</head>
<body>

<section class="hero">

    <div class="container">

        <div class="row align-items-center g-5">

    <div class="col-lg-2 col-md-12 text-center">
        <div class="logo-box">
            <img src="/images/logo-desa.png" alt="Logo Desa">
        </div>
    </div>

    <div class="col-lg-8 col-md-12 text-center">

        <span class="badge bg-light text-success px-4 py-2 rounded-pill mb-3 fw-semibold">
            SISTEM INFORMASI BUKU TAMU DIGITAL
        </span>

        <h1>
            Buku Tamu Digital
        </h1>

        <h3>
            Desa Tuwung
        </h3>

        <p>
            Kecamatan Kahayan Tengah • Kabupaten Pulang Pisau
        </p>

    </div>

    <div class="col-lg-2 col-md-12 text-center">
        <div class="logo-box">
            <img src="/images/logo-pulangpisau.png" alt="Logo Pulang Pisau">
        </div>
    </div>

</div>

        </div>

    </div>

</section>

<div class="container">

    <div class="card main-card">

        <div class="section">

            <h2 class="welcome-title text-center">

                Selamat Datang

            </h2>

            <div class="divider"></div>

            <p class="welcome-sub text-center">

                Silakan pilih layanan yang ingin Anda akses melalui Sistem Informasi Buku Tamu Digital Desa Tuwung.

            </p>

            <div class="row g-4">

                <div class="col-lg-6">

                    <div class="menu-card text-center">

                        <div class="menu-icon">

                            <i class="bi bi-globe2"></i>

                        </div>

                        <h4>

                            Website Desa

                        </h4>

                        <p>

                            Kunjungi website resmi Desa Tuwung untuk memperoleh informasi mengenai profil desa, pelayanan, berita, dan informasi publik lainnya.

                        </p>

                        <a href="https://tuwung.desa.id"
                            target="_blank"
                            class="btn btn-outline-success btn-main mt-4">

                            <i class="bi bi-box-arrow-up-right"></i>

                            Kunjungi Website

                        </a>

                    </div>

                </div>

                <div class="col-lg-6">

                    <div class="menu-card text-center">

                        <div class="menu-icon">

                            <i class="bi bi-pencil-square"></i>

                        </div>

                        <h4>

                            Buku Tamu Digital

                        </h4>

                        <p>

                            Isi data kunjungan Anda secara digital untuk mempermudah proses administrasi dan pencatatan tamu di Kantor Desa Tuwung.

                        </p>

                        <a href="/buku-tamu"
                            class="btn btn-success btn-main mt-4">

                            <i class="bi bi-arrow-right-circle"></i>

                            Isi Buku Tamu

                        </a>

                    </div>

                </div>

            </div>

            <hr class="my-5">

<div class="text-center mb-4">
    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
        <i class="bi bi-info-circle-fill me-2"></i>
        Informasi Kantor Desa
    </span>
</div>

<div class="row justify-content-center text-center g-4 mb-5">

    <!-- Jam Operasional -->
    <div class="col-md-4">
        <i class="bi bi-clock-fill text-success fs-1 mb-3"></i>

        <h5 class="fw-bold mb-3">
            Jam Operasional
        </h5>

        <p class="text-muted mb-0">
            Senin–Kamis : 08.00–12.00 WIB<br>
            Jumat : 08.00–10.00 WIB<br>
            Sabtu–Minggu : Tutup
        </p>
    </div>

    <!-- WhatsApp -->
    <div class="col-md-4">
        <i class="bi bi-whatsapp text-success fs-1 mb-3"></i>

        <h5 class="fw-bold mb-3">
            WhatsApp
        </h5>

        <div class="contact-info">

            <div class="contact-item">
                <small>Kepala Desa</small>
                <div class="fw-semibold">David Faisal</div>

                <a href="https://wa.me/6285248720174" target="_blank">
                    +62 852-4872-0174
                </a>
            </div>

            <hr class="my-3">

            <div class="contact-item">
                <small>Sekretaris Desa</small>
                <div class="fw-semibold">Selviana Naca</div>

                <a href="https://wa.me/6281326825964" target="_blank">
                    +62 813-2682-5964
                </a>
            </div>

        </div>
    </div>

    <!-- Instagram -->
    <div class="col-md-4">
        <i class="bi bi-instagram text-success fs-1 mb-3"></i>

        <h5 class="fw-bold mb-3">
            Instagram
        </h5>

        <a href="https://www.instagram.com/pemdes_tuwung?igsh=NHVneDJua3FpMHIx"
           target="_blank"
           class="text-decoration-none fw-semibold">
            @pemdes_tuwung
        </a>
    </div>

</div>

<div class="text-center mb-4">

    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
        <i class="bi bi-geo-alt-fill me-2"></i>
        Lokasi Kantor Desa
    </span>

    <h3 class="fw-bold mt-3 mb-2">
        Kantor Desa Tuwung
    </h3>

    <p class="text-muted">
        Kecamatan Kahayan Tengah,
        Kabupaten Pulang Pisau,
        Kalimantan Tengah.
    </p>

</div>

<div class="maps-card">

                <iframe
                    src="https://www.google.com/maps?q=Desa+Tuwung+Kahayan+Tengah+Kabupaten+Pulang+Pisau&output=embed"
                    loading="lazy"
                    allowfullscreen>
                </iframe>

                <div class="maps-footer">

    <a href="https://maps.app.goo.gl/ZJnYueGnp22NAeAB6"
        target="_blank"
        class="btn btn-success btn-main">

        <i class="bi bi-geo-alt-fill me-2"></i>

        Buka di Google Maps

    </a>

</div>

            </div>

            <div class="text-center">

                <a href="/admin/login"
                    class="login-admin">

                    <i class="bi bi-shield-lock-fill fs-5"></i>

                    Login Administrator

                </a>

            </div>

        </div>

    </div>

</div>
<footer>

    <hr class="container mb-4">

    <div class="container">

        <p class="mb-1 fw-semibold">

            © 2026 TMB Desa Tuwung

        </p>

        <small class="text-secondary">

            Sistem Informasi Buku Tamu Digital Desa Tuwung

        </small>

    </div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>