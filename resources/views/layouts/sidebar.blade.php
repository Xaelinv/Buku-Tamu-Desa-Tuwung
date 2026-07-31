<div class="sidebar">

    <!-- Logo -->
    <div class="sidebar-logo">

    <div class="brand-logo">

        <img src="{{ asset('images/logo-desa.png') }}"
             alt="Logo Desa">

    </div>

    <div class="brand-text">

        <h3>Desa Tuwung</h3>

        <p>Buku Tamu Digital</p>

    </div>

</div>

    <!-- Menu -->
    <div class="sidebar-menu">

        <div class="text-uppercase small fw-bold text-muted px-3 mb-3">

            Menu Utama

        </div>

        <a href="{{ route('admin.dashboard') }}"
           class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

            <i class="bi bi-speedometer2"></i>

            <span>Dashboard</span>

        </a>

        <a href="{{ route('admin.data') }}"
           class="{{ request()->routeIs('admin.data') ? 'active' : '' }}">

            <i class="bi bi-journal-text"></i>

            <span>Data Buku Tamu</span>

        </a>

        <a href="{{ route('admin.statistik') }}"
           class="{{ request()->routeIs('admin.statistik') ? 'active' : '' }}">

            <i class="bi bi-bar-chart-line"></i>

            <span>Statistik</span>

        </a>

    </div>

    <!-- Footer -->
    <div class="sidebar-footer text-center">

        <small class="text-muted">

            <strong>Versi 1.0</strong><br>

            Buku Tamu Digital<br>

            Desa Tuwung

        </small>

    </div>

</div>