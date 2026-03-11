<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Surat Keterangan Pindah Penduduk</title>
  <style>
     body {
            font-family: 'Times New Roman', Times, serif;
            margin: 40px;
        }
    
        .header-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            position: relative;
        }
    
        .logo-kiri {
            position: absolute;
            left: 0;
            top: 0;
        }
    
        .logo {
         width: 250px; 
         height: auto;
         margin-top: -40px;
        }

        .header-text {
            text-align: center;
            width: 100%;
        }
    
        .header-text h2, .header-text h3, .header-text p {
            margin: 2px;
        }

        .header-text h2 {
          font-size: 18px;
        }

        .header-text h3 {
        font-size: 16px;
        }
    .clearfix::after {
      content: "";
      display: table;
      clear: both;
    }
    .title {
      text-align: center;
      font-weight: bold;
      margin-top: 20px;
      text-decoration: underline;
    }
    .number {
      text-align: center;
      margin-bottom: 20px;
    }
    .field-table {
      margin-top: 20px;
      margin-bottom: 20px;
    }
    .field-table td {
      padding: 4px 8px;
      vertical-align: top;
    }
    .footer {
      margin-top: 40px;
    }
    .ttd {
      float: right;
      text-align: center;
    }
    .note {
      font-size: 14px;
    }
  </style>
</head>
<body>
  <div class="header-wrapper">
    <div class="logo-kiri">
        <img src="{{ public_path('storage/logo/logo.png') }}" alt="Logo Desa" class="logo">
    </div>
    <div class="header-text">
        <h3>PEMERINTAH KABUPATEN BANYUWANGI</h3>
        <h2>KECAMATAN TEGALDLIMO</h2>
        <h2>DESA KALIPAIT</h2>
        <p>Jl Purwo Indah - Kalipait - Banyuwangi  68484 </p>
    </div>
</div>
<hr> 

<div class="title">SURAT PENGANTAR PINDAH PENDUDUK</div>
<div class="number">Nomor: ____ /SPN-DSD/____ /201</div>
      </div>
    </div>

    <p>Memberi Keterangan Bahwa :</p>
    <table class="field-table">
      <tr><td>Nama</td><td>: {{ $data->nama_lengkap }}</td></tr>
      <tr><td>Tempat / Tanggal Lahir</td><td>: {{ $data->tempat_tanggal_lahir }}</td></tr>
      <tr><td>Jenis Kelamin</td><td>: {{ $data->jenis_kelamin }}</td></tr>
      <tr><td>Alamat</td><td>: {{ $data->alamat }}</td></tr>
      <tr><td>Pekerjaan</td><td>: {{ $data->pekerjaan }}</td></tr>
    </table>

    <p style="text-align: justify;">
      Adalah benar Penduduk Desa Kalipait, Kecamatan Tegaldlimo karena atas permintaan sendiri kepadanya diberikan Surat Keterangan Pindah ke Desa Kalipait, Kecamatan Tegal Dlimo,Kabupaten Banyuwangi dengan alasan {{ $data->keperluan }}<br><br>
      Demikian Surat Keterangan Pindah ini dibuat dan diberikan kepada yang bersangkutan untuk dipergunakan seperlunya.
    </p>

    <div class="footer">
      <div class="ttd">
       Kalipait, {{ $data->updatedd }}<br>
       Kepala Desa Kalipait<br><br><br><br>
        <b><u>Supriyono</u></b>
      </div>
  </div>
</body>
</html>