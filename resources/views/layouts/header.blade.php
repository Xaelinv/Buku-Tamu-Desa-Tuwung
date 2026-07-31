<header class="header">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

        <!-- Judul Halaman -->
        <div>

            <h2 class="mb-1 fw-bold">

                @yield('page-title')

            </h2>

            <p class="mb-0 text-muted">

                @yield('page-description')

            </p>

        </div>

        <!-- Action -->
        <div class="d-flex align-items-center gap-3">

            @yield('header-action')

            <!-- Profil Admin -->
            <div class="dropdown">

                <button
    class="btn profile-btn"
    type="button"
    data-bs-toggle="dropdown">

    <i class="bi bi-person-circle"></i>

</button>

                <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">

                    <li>

                        <div class="dropdown-item-text">

                            <strong>Administrator</strong><br>

                            <small class="text-muted">

                                Buku Tamu Digital

                            </small>

                        </div>

                    </li>

                    <li>

                        <hr class="dropdown-divider">

                    </li>

                    <li>

                        <a href="#"
                           id="logoutButton"
                           class="dropdown-item text-danger">

                            <i class="bi bi-box-arrow-right me-2"></i>

                            Logout

                        </a>

                    </li>

                </ul>

            </div>

        </div>

    </div>

</header>

<form id="logoutForm"
      action="{{ route('logout') }}"
      method="POST"
      class="d-none">

    @csrf

</form>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const logoutButton = document.getElementById('logoutButton');

    if(logoutButton){

        logoutButton.addEventListener('click', function(e){

            e.preventDefault();

            Swal.fire({

                title: 'Konfirmasi Logout',

                text: 'Apakah Anda yakin ingin keluar dari sistem?',

                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: '#2E7D32',

                cancelButtonColor: '#d33',

                confirmButtonText: 'Ya, Logout',

                cancelButtonText: 'Batal',

                reverseButtons: true,

                focusCancel: true

            }).then((result) => {

                if(result.isConfirmed){

                    document.getElementById('logoutForm').submit();

                }

            });

        });

    }

});

</script>