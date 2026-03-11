@extends('rw.layout.main')
@section('title', 'Detail Surat Selesai RW')
@section('konten')

<div class="container mt-4">
  <h3 class="mb-4">Detail Surat Selesai</h3>

  <table class="table table-bordered">
    <tr>
      <th>NIK</th>
      <td>{{ $data->nik }}</td>
    </tr>
    <tr>
      <th>Nama Lengkap</th>
      <td>{{ $data->nama_lengkap }}</td>
    </tr>
    <tr>
      <th>Jenis Surat</th>
      <td>{{ $data->nama_surat }}</td>
    </tr>
    <tr>
      <th>Tanggal Pengajuan</th>
      <td>{{ $data->tanggal_diajukan }}</td>
    </tr>
    <tr>
      <th>Status</th>
      <td>{{ $data->status }}</td>
    </tr>
    @if($data->keterangan_ditolak)
    <tr>
      <th>Keterangan</th>
      <td>{{ $data->keterangan_ditolak }}</td>
    </tr>
    @endif
  </table>

  <a href="{{ route('suratselesairw.index') }}" class="btn btn-secondary mt-3">
    <i class="bi bi-arrow-left-circle"></i> Kembali
  </a>
</div>

@endsection
