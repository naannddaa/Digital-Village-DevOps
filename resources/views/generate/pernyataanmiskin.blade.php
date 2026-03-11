<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Surat Keterangan Miskin</title>
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
    
    .institution {
      text-align: center;
      font-weight: bold;
      font-size: 18px;
      line-height: 1.4;
    }
    .underline {
      text-decoration: underline;
    }
    .title {
      text-align: center;
      margin-top: 20px;
      font-weight: bold;
    }
    .number {
      text-align: center;
      margin-bottom: 30px;
    }
    .content {
      line-height: 1.8;
    }
    .table {
      margin-top: 15px;
      margin-bottom: 20px;
    }
    .table td {
      padding: 4px 8px;
      vertical-align: top;
    }
    .footer {
      margin-top: 40px;
    }
    .ttd {
      float: right;
      text-align: center;
      margin-top: 40px;
    }
    .signature {
      margin-top: 60px;
      font-weight: bold;
      text-align: right;
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
        <p>Jl Purwo Indah - Kalipait - Banyuwangi 68484</p>
    </div>
</div>
<hr>    
    
    <div class="title">SURAT KETERANGAN MISKIN</div>
    <div class="number">Nomor: ___ / ___ / 2020</div>

    <div class="content">
      Desa Kalipait Kecamatan Tegaldlimo Kabupaten Banyuwangi dengan ini menerangkan bahwa:
      <table class="table">
        <tr><td>Nama</td><td>: {{ $data->nama_lengkap }}</td></tr>
        <tr><td>Tempat/Tanggal Lahir</td><td>: {{ $data->tempat_tanggal_lahir }}</td></tr>
        <tr><td>Jenis Kelamin</td><td>: {{ $data->jenis_kelamin }}</td></tr>
        <tr><td>Status</td><td>: Siswa</td></tr>
        <tr><td>Agama</td><td>: {{ $data->agama }}</td></tr>
        <tr><td>Alamat</td><td>: {{ $data->alamat }}</td></tr>
      </table>
      <p style="text-align: justify;">
        Benar yang namanya tersebut diatas adalah Penduduk Desa Kalipait Kecamatan Tegaldlimo Kabupaten Banyuwangi, dan menurut amatan kami benar yang bersangkutan berasal dari keluarga miskin.
        <br><br>
        Demikian Surat Keterangan ini kami perbuat, untuk dapat dipergunakan seperlunya.
      </p>
    </div>

    <div class="ttd">
      Kalipait, {{ $data->updated }}<br>
      Kepala Desa Kalipait<br><br><br><br>
      <b><u>Supriyono</u></b>
    </div>
  </div>
</body>
</html> 