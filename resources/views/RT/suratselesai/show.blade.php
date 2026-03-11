@extends('rt.layout.main')
@section('title', 'Detail Surat Selesai')
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
      <th>Catatan</th>
      <td>{{ $data->keterangan_ditolak }}</td>
    </tr>
    @endif
  </table>

  <div class="mt-3">
    <a href="{{ route('suratselesai.index') }}" class="btn btn-secondary">
      <i class="bi bi-arrow-left-circle"></i> Kembali
    </a>
    {{-- Tombol download/cetak jika diperlukan --}}
    {{-- <a href="#" class="btn btn-primary"><i class="bi bi-download"></i> Cetak Surat</a> --}}
  </div>
</div>

@endsection
