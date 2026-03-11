<!DOCTYPE html>
  <html lang="id">
  <head>
    <meta charset="UTF-8">
    <title>Kartu Keluarga</title>
    <style>
      @page {
        size: A4 landscape;
        margin: 20px;
      }
      body {
        font-family: 'Arial', sans-serif;
        font-size: 12px;
        margin: 0;
        padding: 10px;
      }
      .members, .status {
        width: 100%;
        border-collapse: collapse;
        margin: 10px 0;
        font-size: 11px;
      }
      .members th, .members td,
      .status th, .status td {
        border: 1px solid #000;
        padding: 3px;
        text-align: center;
        vertical-align: middle;
      }
      th {
        background-color: #f2f2f2;
      }
    </style>
  </head>
  <body>

  <!-- Header -->
  <div style="display: flex; align-items: flex-start; margin-bottom: 15px;">
    <div style="width: 100%; text-align: center; margin: 0 auto;">
      <h1 style="font-size: 24px; margin: 0; font-weight: bold;">KARTU KELUARGA</h1>
      <p style="font-size: 18px; margin: 8px 0 0 0; font-weight: bold;">No. {{ $no_kk }}</p>
    </div>

    <!-- Logo dan Data -->
    <table style="width: 100%; font-size: 12px; margin-bottom: 15px; margin-left: 150px;">
      <tr>
        <td style="width: 100px; text-align: center;">
          <img src="{{ public_path('image/draftkk/garuda.png') }}" style="width: 80px; height: 80px;">
          <p style="font-weight: bold; margin: 0;">REPUBLIK<br>INDONESIA</p>
        </td>
        <td style="padding-left: 15px;">
          <table style="width: 100%; font-size: 12px; table-layout: fixed;">
            <tr>
              <td style="width: 25%;">Nama Kepala Keluarga</td>
              <td style="width: 25%;">: {{ $kepala_keluarga->nama_lengkap ?? 'N/A' }}</td>

              <td style="width: 25%;">Kecamatan</td>
              <td style="width: 25%;">: {{ $kecamatan ?? '-' }}</td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>: {{ $alamat ?? '-' }}</td>
              <td>Kabupaten/Kota</td>
              <td>: {{ $kabupaten ?? '-' }}</td>
            </tr>
            <tr>
              <td>RT/RW</td>
              <td>: {{ $rt ?? '-' }}/{{ $rw ?? '-' }}</td>
              <td>Provinsi</td>
              <td>: {{ $provinsi ?? '-' }}</td>
            </tr>
            <tr>
              <td>Kode Pos</td>
              <td>: {{ $kode_pos ?? '-' }}</td>
              <td></td>
              <td></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>

  <!-- Tabel Anggota -->
  <table class="members">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Lengkap<br>(1)</th>
        <th>NIK<br>(2)</th>
        <th>Jenis Kelamin<br>(3)</th>
        <th>Tempat Lahir<br>(4)</th>
        <th>Tanggal Lahir<br>(5)</th>
        <th>Agama<br>(6)</th>
        <th>Pendidikan<br>(7)</th>
        <th>Jenis Pekerjaan<br>(8)</th>
        <th>Golongan Darah<br>(9)</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($data as $index => $item)
      <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $item->nama_lengkap }}</td>
        <td>{{ $item->nik }}</td>
        <td>{{ $item->jenis_kelamin }}</td>
        <td>{{ $item->tempat_lahir }}</td>
        <td>{{ $item->tanggal_lahir }}</td>
        <td>{{ $item->agama }}</td>
        <td>{{ $item->pendidikan }}</td>
        <td>{{ $item->pekerjaan }}</td>
        <td>{{ $item->golongan_darah ?? '-' }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <!-- Status Perkawinan & Orang Tua -->
  <table class="status">
    <thead>
      <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">Status Perkawinan<br>(10)</th>
        <th rowspan="2">Tanggal Perkawinan<br>(11)</th>
        <th rowspan="2">Status Hubungan Dalam Keluarga<br>(12)</th>
        <th rowspan="2">Kewarganegaraan<br>(13)</th>
        <th colspan="2">Dokumen Imigrasi</th>
        <th colspan="2">Nama Orang Tua</th>
      </tr>
      <tr>
        <th>No. Paspor<br>(14)</th>
        <th>No. KITAP<br>(15)</th>
        <th>Ayah<br>(16)</th>
        <th>Ibu<br>(17)</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($data as $index => $item)
      <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ strtoupper($item->status_perkawinan ?? '-') }}</td>
        <td>{{ $item->tanggal_perkawinan ?? '-' }}</td>
        <td>{{ strtoupper($item->status_keluarga ?? '-') }}</td>
        <td>{{ strtoupper($item->kewarganegaraan ?? '-') }}</td>
        <td>{{ $item->no_paspor ?? '-' }}</td>
        <td>{{ $item->no_kitap ?? '-' }}</td>
        <td>{{ strtoupper($item->nama_ayah ?? '-') }}</td>
        <td>{{ strtoupper($item->nama_ibu ?? '-') }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  </body>
  </html>