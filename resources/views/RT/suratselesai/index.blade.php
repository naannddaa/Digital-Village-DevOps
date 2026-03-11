@extends('rt.layout.main')
@section('title', 'Surat Selesai')
@section('konten')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-scroller">
    <div class="table-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="text-start mb-4">Surat Selesai</h2>
        </div>

        {{-- Form Pencarian --}}
        <div class="pb-3">
            <form class="d-flex" method="GET" action="{{ route('suratselesai.index') }}">
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengajuan as $a)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $a->nik }}</td>
                        <td>{{ $a->nama_lengkap }}</td>
                        <td>{{ $a->nama_surat }}</td>
                        <td>{{ $a->tanggal_diajukan }}</td>
                        <td>{{ $a->rw }}</td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetail-{{ $a->id_pengajuan }}">
                                <i class="bi bi-eye-fill"></i>
                            </button>

                            <button class="btn btn-outline-danger btn-sm btn-hapus" data-id="{{ $a->id_pengajuan }}" data-nama="{{ $a->nama_lengkap }}">
                                <i class="bi bi-trash-fill"></i>
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
                            </div>
                        </div>
                    </div>
                @empty
                        <tr>
                        <td colspan="7" class="text-center">
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
    </div>
</div>

{{-- Hidden delete form --}}
<form id="formHapus" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

{{-- SweetAlert & Bootstrap --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

{{-- SweetAlert Delete Script --}}
<script>
    document.querySelectorAll('.btn-hapus').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const nama = this.dataset.nama;

            Swal.fire({
                title: `<div class="text-danger">Hapus Data?</div>`,
                html: `
                    <div class="card p-3">
                        <div class="fw-bold text-dark mb-2">Pengajuan Surat : ${nama}</div>
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
                    form.action = `/suratselesai/${id}`;
                    form.submit();
                }
            });
        });
    });
</script>

{{-- Notifikasi berhasil --}}
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        html: `<div class="text-success fw-bold">{{ session('success') }}</div>`,
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif

@endsection
