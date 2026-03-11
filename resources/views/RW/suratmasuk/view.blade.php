@extends('rw.layout.main')
@section('title', 'Detail Surat Masuk')
@section('konten')

<div class="container mt-4">
  <h3 class="mb-4">Detail Surat Masuk</h3>

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
    @if($data->status == 'Ditolak' && $data->keterangan_ditolak)
    <tr>
      <th>Alasan Penolakan</th>
      <td>{{ $data->keterangan_ditolak }}</td>
    </tr>
    @endif
  </table>

  @if($data->status === 'Disetujui RT')
  <div class="d-flex gap-2 mt-3">
    <form action="{{ route('rw.suratmasuk.index') }}" method="POST">
      @csrf
      <input type="hidden" name="id_pengajuan" value="{{ $data->id_pengajuan }}">
      <button type="submit" class="btn btn-success">
        <i class="bi bi-check-circle"></i> Setujui RW
      </button>
    </form>
  </div>
  @endif

  <a href="{{ route('rw.suratmasuk.index') }}" class="btn btn-secondary mt-3">
    <i class="bi bi-arrow-left-circle"></i> Kembali
  </a>
</div>

@endsection
