@extends('rw.layout.main')
@section('title', 'Surat Selesai RW')
@section('konten')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-scroller">
    <div class="table-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="text-start mb-4">Surat Selesai RW</h2>
        </div>

        {{-- Notifikasi --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Form Pencarian --}}
        <div class="pb-3">
            <form class="d-flex" method="GET" action="{{ route('rw.suratselesai.index') }}">
                <input class="form-control me-1" type="search" name="katakunci" value="{{ request('katakunci') }}" placeholder="Cari" aria-label="Search">
                <button class="btn btn-outline-primary" type="submit">Cari</button>
            </form>
        </div>

        {{-- Tabel Data --}}
        <div class="table-responsive">
            <table class="display expandable-table dataTable no-footer" style="width: 100%">
                <thead class="table-primary text-center">
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Jenis Surat</th>
                        <th>Tanggal Pengajuan</th>
                        <th>RT</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengajuan as $index => $item)
                        <tr class="text-center">
                            <td>{{ $pengajuan->firstItem() + $index }}</td>
                            <td>{{ $item->nik }}</td>
                            <td>{{ $item->nama_lengkap }}</td>
                            <td>{{ $item->nama_surat }}</td>
                            <td>{{ $item->tanggal_diajukan }}</td>
                            <td>{{ $item->rt }}</td>
                            <td>{{ $item->status }}</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetail-{{ $item->id_pengajuan }}">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                                <button class="btn btn-danger btn-sm btn-hapus" data-id="{{ $item->id_pengajuan }}" data-nama="{{ $item->nama_lengkap }}">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>

                        {{-- Modal Detail --}}
                        <div class="modal fade" id="modalDetail-{{ $item->id_pengajuan }}" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title">Detail Pengajuan</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label class="form-label">Nama</label>
                                        <input type="text" class="form-control" value="{{ $item->nama_lengkap }}" readonly>
                                        <label class="form-label mt-2">Nama Surat</label>
                                        <input type="text" class="form-control" value="{{ $item->nama_surat }}" readonly>
                                        <label class="form-label mt-2">Jenis Kelamin</label>
                                        <input type="text" class="form-control" value="{{ $item->jenis_kelamin }}" readonly>
                                        <label class="form-label mt-2">TTL</label>
                                        <input type="text" class="form-control" value="{{ $item->tempat_tanggal_lahir }}" readonly>
                                        <label class="form-label mt-2">Warga / Agama</label>
                                        <input type="text" class="form-control" value="{{ $item->warga_agama }}" readonly>
                                        <label class="form-label mt-2">RW</label>
                                        <input type="text" class="form-control" value="{{ $item->rw }}" readonly>
                                        <label class="form-label mt-2">RT</label>
                                        <input type="text" class="form-control" value="{{ $item->rt }}" readonly>
                                        <label class="form-label mt-2">Keperluan</label>
                                        <input type="text" class="form-control" value="{{ $item->keperluan }}" readonly>
                                        <label class="form-label mt-2">Tanggal Diajukan</label>
                                        <input type="text" class="form-control" value="{{ $item->tanggal_diajukan }}" readonly>

                                        <div class="mt-3">
                                            @for ($i = 1; $i <= 8; $i++)
                                                @php $foto = 'foto' . $i; @endphp
                                                @if (!empty($item->$foto))
                                                    <label class="form-label">Bukti {{ $i }}</label><br>
                                                    <img src="{{ asset($item->$foto) }}" class="img-fluid mb-2" alt="Bukti {{ $i }}">
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">
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

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $pengajuan->links() }}
        </div>
    </div>
</div>

{{-- Form Delete --}}
<form id="formHapus" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

{{-- Script SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.querySelectorAll('.btn-hapus').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const nama = this.dataset.nama;

            Swal.fire({
                title: `<div class="text-danger">Hapus Data?</div>`,
                html: `
                    <div class="card p-3">
                        <div class="fw-bold text-dark mb-2">Pengajuan Surat: ${nama}</div>
                        <div class="text-muted">Data akan dihapus secara permanen.</div>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6c757d',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('formHapus');
                    form.action = `/rw/surat-selesai/${id}`;
                    form.submit();
                }
            });
        });
    });
</script>

@endsection
