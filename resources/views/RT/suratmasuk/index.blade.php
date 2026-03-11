@extends('rt.layout.main')
@section('title', 'Surat Masuk')
@section('konten')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-scroller">
    <div class="table-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="text-start mb-4">Surat Masuk</h2>
        </div>

        {{-- Form Pencarian --}}
        <div class="pb-3">
            <form class="d-flex" method="GET" action="{{ route('rt.suratmasuk.index') }}">
                <input class="form-control me-1" type="search" name="katakunci" value="{{ request('katakunci') }}" placeholder="Cari" aria-label="Search">
                <button class="btn btn-outline-primary" type="submit">Cari</button>
            </form>
        </div>

        {{-- Tabel Data --}}
        <div class="table-responsive">
            <table class="display expandable-table dataTable no-footer" style="width: 100%">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Jenis Surat</th>
                        <th>Tanggal Pengajuan</th>
                        <th>RW</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($datapengajuan as $index => $a)
                    <tr>
                        <td>{{ $datapengajuan->firstItem() + $index }}</td>
                        <td>{{ $a->nik }}</td>
                        <td>{{ $a->nama_lengkap }}</td>
                        <td>{{ $a->nama_surat }}</td>
                        <td>{{ $a->tanggal_diajukan }}</td>
                        <td>{{ $a->rw }}</td>
                        <td>{{ $a->status }}</td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetail-{{ $a->id_pengajuan }}">
                                <i class="bi bi-eye-fill"></i>
                            </button>
                        </td>
                    </tr>

                    {{-- Modal Detail --}}
                    <div class="modal fade" id="modalDetail-{{ $a->id_pengajuan }}" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title">Detail Pengajuan</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" value="{{ $a->nama_lengkap }}" readonly>
                                    <label class="form-label mt-2">Nama Surat</label>
                                    <input type="text" class="form-control" value="{{ $a->nama_surat }}" readonly>
                                    <label class="form-label mt-2">Jenis Kelamin</label>
                                    <input type="text" class="form-control" value="{{ $a->jenis_kelamin }}" readonly>
                                    <label class="form-label mt-2">TTL</label>
                                    <input type="text" class="form-control" value="{{ $a->tempat_tanggal_lahir }}" readonly>
                                    <label class="form-label mt-2">Warga / Agama</label>
                                    <input type="text" class="form-control" value="{{ $a->warga_agama }}" readonly>
                                    <label class="form-label mt-2">RW</label>
                                    <input type="text" class="form-control" value="{{ $a->rw }}" readonly>
                                    <label class="form-label mt-2">RT</label>
                                    <input type="text" class="form-control" value="{{ $a->rt }}" readonly>
                                    <label class="form-label mt-2">Keperluan</label>
                                    <input type="text" class="form-control" value="{{ $a->keperluan }}" readonly>
                                    <label class="form-label mt-2">Tanggal Diajukan</label>
                                    <input type="text" class="form-control" value="{{ $a->tanggal_diajukan }}" readonly>

                                    <div class="mt-3">
                                        @for ($i = 1; $i <= 8; $i++)
                                            @php $foto = 'foto'.$i; @endphp
                                            @if (!empty($a->$foto))
                                                <label class="form-label">Bukti {{ $i }}</label><br>
                                                <img src="{{ asset($a->$foto) }}" class="img-fluid mb-2" alt="Bukti {{ $i }}">
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <div class="modal-footer d-flex justify-content-end gap-2">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTolak-{{ $a->id_pengajuan }}">
                                        Tolak
                                    </button>
                                    <form method="POST" action="{{ route('rt.suratmasuk.setuju', $a->id_pengajuan) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Setujui</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Tolak --}}
                    <div class="modal fade" id="modalTolak-{{ $a->id_pengajuan }}" tabindex="-1" aria-labelledby="modalTolakLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form method="POST" action="{{ route('rt.suratmasuk.tolak', $a->id_pengajuan) }}">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Alasan Penolakan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="keterangan_ditolak_{{ $a->id_pengajuan }}" class="form-label">Masukkan alasan penolakan:</label>
                                            <textarea name="keterangan_ditolak" id="keterangan_ditolak_{{ $a->id_pengajuan }}" class="form-control" rows="3" required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Kirim Penolakan</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @empty
                        <tr>
                            <td colspan="8" class="text-center">
                                @if(request('katakunci'))
                                    Data dengan kata kunci <strong>{{ request('katakunci') }}</strong> tidak ditemukan.
                                @else
                                    Belum ada data.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $datapengajuan->links() }}
        </div>
    </div>
</div>

@endsection
