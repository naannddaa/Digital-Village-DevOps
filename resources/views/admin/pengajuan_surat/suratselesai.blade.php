@extends('admin.layout.main')
@section('title', 'Surat Selesai')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<section class="section">
    <div class="section-header">
        <h1>Surat Selesai</h1>
    </div>
    <div class="section-body">
            <div class="row">
                <div class="col-12">

                    <div class="card">

                    {{-- Form Search --}}
                    <div class="card-header d-flex justify-content-between">
                        <form class="d-flex" action="{{ route('pengajuan.masuk') }}" method="get">
                            <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Cari" aria-label="Search">
                            <button class="btn btn-outline-primary" type="submit">Cari</button>
                        </form>
                    </div>
                {{-- Display Data --}}
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Jenis Surat</th>
                                <th>Tanggal Pengajuan</th>
                                <th>RW</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($datapengajuan as $a)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$a->nik}}</td>
                                <td>{{$a->nama_lengkap}}</td>
                                <td>{{$a->nama_surat}}</td>
                                <td>{{$a->tanggal_diajukan}}</td>
                                <td>{{$a->rw}}</td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetail-{{ $a->id_pengajuan }}">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                </td>
                            </tr>

                            {{-- Modal Detail Pengajuan --}}
                            <div class="modal fade" id="modalDetail-{{ $a->id_pengajuan }}" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
                                    <div class="modal-dialog"> 
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title">Detail Pengajuan</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Konten detail pengajuan -->
                                                <div class="">
                                                    <label class="form-label">Nama</label>
                                                    <input type="text" class="form-control" value="{{ $a->nama_lengkap }}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Surat</label>
                                                    <input type="text" class="form-control" value="{{ $a->nama_surat }}" readonly>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label class="form-label">Jenis Kelamin</label>
                                                        <input type="text" class="form-control" value="{{ $a->jenis_kelamin }}" readonly>
                                                    </div>
                                                    <div class="col">
                                                        <label class="form-label">TTL</label>
                                                        <input type="text" class="form-control" value="{{ $a->tempat_tanggal_lahir }}" readonly>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label class="form-label">Warga / Agama</label>
                                                        <input type="text" class="form-control" value="{{ $a->warga_agama }}" readonly>
                                                    </div>
                                                    <div class="col">
                                                        <label class="form-label">RW</label>
                                                        <input type="text" class="form-control" value="{{ $a->rw }}" readonly>
                                                    </div>
                                                    <div class="col">
                                                        <label class="form-label">RT</label>
                                                        <input type="text" class="form-control" value="{{ $a->rt }}" readonly>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label class="form-label">Keperluan</label>
                                                        <input type="text" class="form-control" value="{{ $a->keperluan }}" readonly>
                                                    </div>
                                                    <div class="col">
                                                        <label class="form-label">Tanggal Diajukan</label>
                                                        <input type="text" class="form-control" value="{{ $a->tanggal_diajukan }}" readonly>
                                                    </div>
                                                </div>

                                                {{-- Bukti Upload (jika ada) --}}
                                                <div class="row">
                                                    @for ($i = 1; $i <= 8; $i++)
                                                        @php $foto = 'foto'.$i; @endphp
                                                        @if (!empty($a->$foto))
                                                            <div class="col-12 mb-2">
                                                                <label class="form-label">Bukti{{ $i }}</label><br>
                                                                <img src="{{ asset('storage/surat/' . $a->$foto) }}" width="100%">
                                                            </div>
                                                        @endif
                                                    @endfor
                                                </div>

                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                            {{-- End Modal --}}
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>            


            </div> {{-- end table-container --}}
        </div>
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('js/suratmasuk.js') }}"></script>
@endsection
