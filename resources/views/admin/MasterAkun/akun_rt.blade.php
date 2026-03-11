@extends('admin.layout.main')
@section('konten')
@section('title', 'Akun RT')

<!doctype html>
<html lang="en">

<body class="bg-light">
    <div class="container-scroller">
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="text-start mb-4">Akun Rukun Tetangga</h2>
            </div>

            {{-- Form Search --}}
            <div class="pb-3">
                  <form id="searchForm" class="d-flex" action="{{ route('akunrt') }}" method="get">
                    <input class="form-control me-1" type="search" name="katakunci"
                    id="searchInput"
                    value="{{ Request::get('katakunci') }}"
                    placeholder="Cari" aria-label="Search"
                    autocomplete="off">
                    <button class="btn btn-outline-primary" type="submit">Cari</button>
                </form>
            </div>

            {{-- Tambah Data --}}
            <div class="pb-3" style="text-align:right;">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal" id="addDataBtn" data-id="{{ $id_rtrw }}">+ Tambah Data</a>
            </div>

            {{-- Display Data --}}
            <div class="table-responsive">
                <table class="display expandable-table dataTable no-footer" style="width: 100%">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama Ketua Rukun Tetangga</th>
                            <th>Nomer Handphone</th>
                            <th>RT</th>
                            <th>RW</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataakunrt as $a)
                            
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$a->nik}}</td>
                                    <td>{{$a->nama}}</td>
                                    <td>{{$a->no_hp}}</td>
                                    <td>{{$a->rt}}</td>
                                    <td>{{$a->rw}}</td>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-sm btn-edit"
                                            data-id_rtrw="{{ $a->id_rtrw }}"
                                            data-nik="{{ $a->nik }}"
                                            data-nama="{{ $a->nama }}"
                                            data-no_hp="{{ $a->no_hp }}"
                                            data-rt="{{ $a->rt }}"
                                            data-rw="{{ $a->rw }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <a href="{{ route('akunrt.destroy', $a->id_rtrw) }}" class="btn btn-danger btn-sm delete right" title="Hapus Data">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </td>
                                </tr>
                           
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $dataakunrt->withQueryString()->links() }}
            </div>
            
            {{-- Modal Tambah/Edit Data --}}
            <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalTitle">Tambah Akun Ketua RT</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="modalForm" action="{{ route('akun.store') }}" method="POST">
                                @csrf
                                <div class="col-12">
                                    <label class="form-label" hidden >ID Akun RT</label>
                                    <input type="text" class="form-control" name='id_rtrw' id="id_rtrw" value="{{$id_rtrw}}" hidden>
                                </div>
                                <div class="col-12">
                                    <label for="nama" class="form-label">Nama Ketua RT</label>
                                    <select class="form-select select-nama" name="nama" id="nama" required>
                                        <option disabled selected value="">Pilih Nama</option>
                                        @foreach ($data as $value)
                                            <option 
                                                value="{{ $value->nama_lengkap }}"
                                                data-nik="{{ $value->nik }}"
                                                data-rw="{{ $value->rw }}"
                                                data-rt="{{ $value->rt }}">
                                                {{ $value->nama_lengkap }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 mt-2">
                                    <label class="form-label">No HP</label>
                                    <input type="text" class="form-control" name="no_hp" id="no_hp" required>
                                </div>
                                <div class="col-12 mt-2">
                                    <label class="form-label">NIK</label>
                                    <input type="text" class="form-control" name="nik" id="nik" required readonly>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3 row">
                                        <div class="col mt-2">
                                            <label class="form-label">RT</label>
                                            <input type="text" class="form-control" name="rt" id="rt" required>
                                        </div>
                                        <div class="col mt-2">
                                            <label class="form-label">RW</label>
                                            <input type="text" class="form-control" name="rw" id="rw" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary" id="submitBtn">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Tambahkan jQuery -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="{{ asset('js/rt.js') }}"></script>
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

            <!-- Select2 JS -->
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

            <style>
                .select2-container .select2-selection--single {
                    height: 38px;
                    padding: 6px 12px;
                    border: 1px solid #ced4da;
                    border-radius: 0.375rem;
                }

                .select2-container--default .select2-selection--single .select2-selection__rendered {
                    line-height: 24px;
                }

                .select2-container--default .select2-selection--single .select2-selection__arrow {
                    height: 38px;
                    right: 10px;
                }

                .select2-dropdown {
                    z-index: 1056 !important; 
                }
            </style>
        </div>
    </div>
</body>
</html>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById('searchInput');
    const searchForm = document.getElementById('searchForm');

    let timeout = null;
    searchInput.addEventListener('input', function () {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            searchForm.submit();
        }, 500); 
    });
});
</script>
@endsection