<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Surat Pernyataan</title>
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

        .title {
      text-align: center;
      margin-top: 20px;
      font-weight: bold;
    }
    .number {
      text-align: center;
      margin-bottom: 30px;
    }

    .content, .signature-section {
      font-size: 14px;
      line-height: 1.6;
    }

    .table-info td {
      padding: 4px 8px;
      vertical-align: top;
    }

    .gray-box {
      background-color: #f0f0f0;
      padding: 2px 6px;
      display: inline-block;
      border-radius: 3px;
    }

    .signature-section {
      margin-top: 30px;
      display: flex;
      justify-content: space-between;
    }

    .signature-block {
      text-align: center;
      margin-top: 40px;
    }

    .stamp {
      margin-top: 10px;
    }
    .footer {
      margin-top: 40px;
    }
    .ttd {
      width: 50%;
      float: left;
      text-align: center;
      font-size: 14px;
    }
    .ttd-right {
      float: right;
      text-align: center;
      font-size: 14px;
    }
    .signature {
      font-weight: bold;
      text-align: center;
      margin-top: 60px;
    }
    .double-signature {
      display: flex;
      justify-content: space-between;
      margin-top: 80px;
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

    <div class="title">SURAT PERNTAYAAN AKTA KEMATIAN</div>
    <div class="number">Nomor: ___ / ___ / 2020</div>


<div class="content" style="text-align: justify;">
    Saya yang bertanda tangan di bawah ini:
    <table class="table-info">
        <tr><td>Nama</td><td>: {{ $data->nama_lengkap }}</td></tr>
        <tr><td>Tempat, Tanggal Lahir</td><td>: {{ $data->tempat_tanggal_lahir }}</td></tr>
        <tr><td>NIK</td><td>: {{ $data->nik }}</td></tr>
        <tr><td>Jenis Kelamin</td><td>: {{ $data->jenis_kelamin }}</td></tr>
        <tr><td>Pekerjaan</td><td>: {{ $data->pekerjaan }}</td></tr>
        <tr><td>Alamat</td><td>: {{ $data->alamat }}</td></tr>
    </table>

    <p>Dengan ini menyatakan bahwa saya benar ingin mengurus Surat Keterangan Kematian abang saya yang bernama: <span class="gray-box">(alm) {{ $data->keperluan }}.</span></p>

    <p>Surat Pernyataan ini saya buat dengan sesungguhnya tanpa ada unsur paksaan dari pihak manapun. Bilamana surat pernyataan ini tidak benar, maka saya bersedia dituntut sesuai dengan peraturan yang berlaku.</p>

    <p>Demikian surat pernyataan ini saya buat untuk dapat dipergunakan seperlunya.</p>
</div>

  <div class="footer">
    <div class="ttd">
      Ketua Rt {{ $data->rt_rtrw }}<br><br><br>
      <div class="signature"><u> {{ $data->nama_rt }}</u></div>
    </div>
    <div class="ttd-right">
      Kalipait, {{ $data->updated }}<br>
      Kepala Desa Kalipait<br><br>  
      <div class="signature"><u>Supriyono</u></div>
    </div>
    <div class="clear"></div>
  </div>

</body>
</html>