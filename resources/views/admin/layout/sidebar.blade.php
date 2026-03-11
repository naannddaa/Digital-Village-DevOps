<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">

    <!-- Logo besar -->
    <div class="sidebar-brand normal-logo">
      <a href="{{ url('/admin/dashboard') }}" class="d-flex align-items-center justify-content-center">
        <span style="font-weight: 900; font-size: 20px;">DIGITAL VILLAGE</span>
      </a>
    </div>

    <!-- Logo kecil -->
    <div class="sidebar-brand sidebar-brand-sm collapsed-logo">
      <a href="{{ url('/admin/dashboard') }}">
        {{-- <img src="{{ asset('/storage/foto/logotomat.png') }}" alt="Logo Kecil" style="height:35px; margin-left:5px;"> --}}
      </a>
    </div>

    <ul class="sidebar-menu">
      <li><a href="{{ url('/admin/dashboard') }}" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a></li>
      <li><a class="nav-link" href="{{ url('/admin/master_kartukeluarga') }}"><i class="fas fa-address-card"></i><span>Kartu Keluarga</span></a></li>

      <!-- Pengajuan Surat -->
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown">
          <i class="fas fa-envelope"></i>
          <span>Pengajuan Surat</span>
          {{-- <span class="badge bg-danger" id="pengajuan-count">{{ $jumlahPengajuan ?? 0 }}</span> --}}
        </a>
        <ul class="dropdown-menu">
          <li><a href="{{ url('admin/suratmasuk') }}" class="nav-link">Surat Masuk</a></li>
          <li><a href="{{ url('admin/suratselesai') }}" class="nav-link">Surat Selesai</a></li>
          <li><a href="{{ url('admin/suratditolak') }}" class="nav-link">Surat Ditolak</a></li>
        </ul>
      </li>

      <!-- Master Akun -->
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown">
          <i class="fas fa-users-cog"></i>
          <span>Master Akun</span>
        </a>
        <ul class="dropdown-menu">
          <li><a href="{{ url('admin/akunrw') }}" class="nav-link">Akun RW</a></li>
          <li><a href="{{ url('admin/akunrt') }}" class="nav-link">Akun RT</a></li>
        </ul>
      </li>

      <li><a class="nav-link" href="{{ url('admin/mastersurat') }}"><i class="fas fa-file-alt"></i><span>Master Surat</span></a></li>
      <li><a class="nav-link" href="{{ url('admin/berita') }}"><i class="fas fa-newspaper"></i><span>Berita</span></a></li>
      <li><a class="nav-link" href="{{ url('admin/pengaduan') }}"><i class="fas fa-comment-dots"></i><span>Pengaduan Masyarakat</span></a></li>
      <li><a class="nav-link" href="{{ url('admin/landingpage') }}"><i class="fas fa-globe"></i><span>Website</span></a></li>
    </ul>

  </aside>
</div>

<style>
  .collapsed-logo { display: none; }
  body.sidebar-mini .normal-logo { display: none !important; }
  body.sidebar-mini .collapsed-logo { display: block !important; }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
{{-- <script>
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
            url: "{{ url('admin/count-pengajuan') }}",
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
 --}}
