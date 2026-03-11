<nav class="sidebar sidebar-offcanvas sidebar-fixed" id="sidebar" style="background-color: #10243c">
    <style>
        .sidebar .menu-title, .sidebar span {
            color: white !important;
            font-weight: bold;
        }

        .sidebar .nav-item a.nav-link {
            color: white !important; /* Warna teks putih */
        }

        .sidebar .nav-item a.nav-link:hover {
            color: #ffcc00 !important; /* Warna hover jika diperlukan */
        }

        .sidebar .nav-item .sidebar-dropdown .nav-item a.nav-link {
            color: white !important; /* Warna teks putih */
        }

        /* Hover effect untuk submenu Akun RW dan RT */
        .sidebar .nav-item .sidebar-dropdown .nav-item a.nav-link:hover {
            color: white !important; /* Warna hover tetap putih */
        }
    </style>

    <ul class="nav">
      <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('rw.dashboard') ? 'active' : '' }}" href="{{ route('rw.dashboard') }}">
                <i class="bi bi-house-fill me-3"></i>
                <span class="menu-title">Dashboard RW</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link position-relative" data-bs-toggle="collapse" data-bs-target="#master-pengajuan" aria-expanded="false" aria-controls="master-pengajuan" id="toggle-master-pengajuan">
                <i class="bi bi-envelope-check-fill me-3 position-relative">
                    @if($jumlahPengajuan > 0)
                    <span class="position-absolute badge rounded-pill bg-danger" id="pengajuan-count"
                        style="top: 0; left: 140px; font-size: 10px; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; transform: translateY(-50%);">
                        {{ $jumlahPengajuan }}
                    </span>
                @endif
                </i>
                <span class="menu-title">Pengajuan Surat</span>
                <i class="menu-arrow"></i>
            </a>
            <ul id="master-pengajuan" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                 <li class="nav-item">
        <a href="{{ route('rw.suratmasuk.index') }}" class="nav-link {{ request()->routeIs('rw.suratmasuk.*') ? 'active' : '' }}">
            Surat Masuk
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('rw.suratselesai.index') }}" class="nav-link {{ request()->routeIs('rw.suratselesai.*') ? 'active' : '' }}">
            Surat Selesai
        </a>
    </li>
            </ul>
        </li>
    </ul>
</nav>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    // Hide Master Akun dropdown when Master Surat is clicked
    $('#toggle-master-pengajuan').click(function() {
        $('#master-akun').collapse('hide'); // Hide Master Akun
    });

    // Hide Pengajuan Surat dropdown when Master Akun is clicked
    $('#toggle-master-akun').click(function() {
        $('#master-pengajuan').collapse('hide'); // Hide Pengajuan Surat
    });
});

$(document).ready(function() {
    function loadPengajuanCount() {
        $.ajax({
            url: "{{ url('RW/count-pengajuan') }}",
            type: "GET",
            success: function(data) {
                if(data.count > 0) {
                    $('#pengajuan-count').text(data.count).show();
                } else {
                    $('#pengajuan-count').hide();
                }
            }
        });
    }

    // Load pertama
    loadPengajuanCount();

    // Refresh tiap 15 detik
    setInterval(loadPengajuanCount, 15000);
});



</script>
