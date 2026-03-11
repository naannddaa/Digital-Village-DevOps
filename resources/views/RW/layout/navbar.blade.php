<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <img src="{{ asset('storage/logo/logo.png') }}" alt="Logo Desa" class="logo-img">
          <div class="logo-text ms-3">
              <h4 class="mb-0">Desa Kalipait</h4>
              <small>Kabupaten Banyuwangi</small>
          </div>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
            </a>
          </li>
          <li class="nav-item d-flex align-items-center mr-3">
  @auth
    <span class="font-weight-bold">
      Halo, {{ session('nama', 'Nama tidak ditemukan') }}
    </span>
  @endauth
</li>

          <li class="nav-item dropdown nav-settings d-none d-lg-flex">
            <a class="nav-link dropdown-toggle no-caret" id="settingsDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <i class="icon-ellipsis"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="settingsDropdown">
                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
            </div>
        </li>

        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- jQuery (Wajib untuk Bootstrap 4 dropdown) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Popper.js (Untuk positioning dropdown) -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>