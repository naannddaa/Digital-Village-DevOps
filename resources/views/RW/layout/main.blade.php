<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>

    @include('RW.layout.style')

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
      body {
        font-family: 'Poppins', sans-serif;
      }
      .table-container {
        background: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      }
      .btn {
        border-radius: 5px;
      }
      thead th {
        text-align: center;
      }
      tbody td {
        text-align: center;
        vertical-align: middle;
      }
      .sidebar-fixed {
      position: fixed;
      top: 0;
      left: 0;
      bottom: 0;
      width: 250px; /* sesuaikan dengan lebar sidebar kamu */
      overflow-y: auto;
      /* sesuaikan dengan warna sidebar */
      z-index: 1000;
      padding-top: 70px; /* sesuaikan dengan tinggi navbar jika ada */
      
  }

  .content-wrapper {
      margin-left: 250px; /* biar kontennya nggak ketindih sidebar */
      padding: 20px;
  }

  .navbar {
    box-shadow: none !important;
}

  .no-caret::after {
    display: none !important;
}


    </style>


</head>
<body>

    <!-- Navbar -->
    @include('admin.layout.navbar')

   <div class="container-fluid page-body-wrapper">
            <!-- Sidebar -->
            @include('rw.layout.sidebar')

            <!-- Main Content -->
            <div class="content-wrapper">
                @yield('konten')
            </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
    .swal2-icon {
        margin-top: 30px !important; /* Atur sesuai kebutuhan */
    }
</style>
  @include('admin.layout.alerts')

    </body>
</html>
