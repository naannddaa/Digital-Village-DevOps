@extends('rt.layout.main')
@section('title', 'Detail Surat Masuk')
@section('konten')

<div class="container mt-4">
  <h3 class="mb-4">Detail Pengajuan Surat</h3>

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

  {{-- Form Setujui / Tolak --}}
  @if($data->status === 'Diajukan')
  <div class="d-flex gap-2 mt-4">
    {{-- Tombol Setujui --}}
    <form action="{{ route('rt.suratmasuk.setujui') }}" method="POST">
      @csrf
      <input type="hidden" name="id_pengajuan" value="{{ $data->id_pengajuan }}">
      <button type="submit" class="btn btn-success">
        <i class="bi bi-check-circle"></i> Setujui
      </button>
    </form>

    {{-- Tombol Tolak --}}
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTolak">
      <i class="bi bi-x-circle"></i> Tolak
    </button>
  </div>
  @endif

  <a href="{{ route('rt.suratmasuk.index') }}" class="btn btn-secondary mt-3">
    <i class="bi bi-arrow-left-circle"></i> Kembali
  </a>
</div>

{{-- Modal Tolak --}}
<div class="modal fade" id="modalTolak" tabindex="-1" aria-labelledby="modalTolakLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('rt.suratmasuk.tolak') }}" method="POST">
      @csrf
      <input type="hidden" name="id_pengajuan" value="{{ $data->id_pengajuan }}">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTolakLabel">Tolak Pengajuan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="alasan" class="form-label">Alasan Penolakan</label>
            <textarea name="alasan" id="alasan" rows="3" class="form-control" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Kirim Penolakan</button>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection
