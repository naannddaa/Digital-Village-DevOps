@extends('admin.layout.main')
@section('title', 'Penduduk')
@section('content')

@php
    $no_kk = request('nokk');
@endphp

<!-- CSS Selectric -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-selectric/1.13.0/selectric.css" integrity="sha512-0qVbXztEFgh+qSrfFQaA/2z2P7sHqv6pouVbC+6p4rt5WjEM45ZUBQdqU30z4RhvYVq4Nnhq2vLQfYgOZyLxUQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<section class="section">
    <div class="section-header">
        <h1>Penduduk</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <!-- CARD HEADER -->
                    <div class="card-header">
                        <div class="d-flex justify-content-between w-100 align-items-center">

                            <!-- Kiri: Pencarian -->
                            <form class="d-flex" action="{{ url('master_penduduk') }}" method="get">
                                <input class="form-control me-2" type="search" name="katakunci"
                                    value="{{ Request::get('katakunci') }}"
                                    placeholder="Cari NIK / Nama">
                                <button class="btn btn-outline-primary">Cari</button>
                            </form>

                            <!-- Kanan: Tombol Tambah + Draft KK -->
                            <div>
                                <a href="#" class="btn btn-primary me-2"
                                   data-bs-toggle="modal"
                                   data-bs-target="#exampleModal">
                                   + Tambah Data
                                </a>
                                <a href="{{ url('admin/master_penduduk/cetak-draft-kk?nokk=' . $no_kk) }}" 
                                   target="_blank" 
                                   class="btn btn-success">
                                   <i class="bi bi-printer-fill"></i> Draft KK
                                </a>
                            </div>

                        </div>
                    </div>

                    <!-- TABEL ANGGOTA KELUARGA -->
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table table-striped" id="activityTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NO KK</th>
                                        <th>NIK</th>
                                        <th>Nama Lengkap</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Status Keluarga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($master_penduduk as $a)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $a->no_kk }}</td>
                                        <td>{{ $a->nik }}</td>
                                        <td>{{ $a->nama_lengkap }}</td>
                                        <td>{{ $a->tempat_lahir }}</td>
                                        <td>{{ $a->tanggal_lahir }}</td>
                                        <td>{{ $a->status_keluarga }}</td>
                                        <td>
                                            <!-- Tombol Edit -->
                                            <a href="#" 
                                               class="btn btn-warning btn-sm btn-edit"
                                               data-bs-toggle="modal"
                                               data-bs-target="#exampleModal"
                                               data-nik="{{ $a->nik }}"
                                               data-nama_lengkap="{{ $a->nama_lengkap }}"
                                               data-tempat_lahir="{{ $a->tempat_lahir }}"
                                               data-tanggal_lahir="{{ $a->tanggal_lahir }}">
                                               <i class="fas fa-pencil-alt"></i>
                                            </a>

                                            <!-- Tombol Hapus -->
                                            <a href="{{ route('penduduk.delete',$a->nik) }}" 
                                               data-nama_lengkap="{{$a->nama_lengkap}}" 
                                               class="btn btn-danger btn-sm" 
                                               title="Hapus Data">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- PAGINATION -->
                        <div class="mt-3">
                            {{ $master_penduduk->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- MODAL TAMBAH / EDIT -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form id="anggotaForm" action="{{ url('admin/master_penduduk/masuk') }}" method="POST">
                @csrf
                <input type="hidden" name="no_kk" value="{{ $no_kk }}">
                <input type="hidden" name="_method" id="formMethod" value="POST">

                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="exampleModalLabel">Tambah Anggota Keluarga</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Form Inputs -->
                    <div class="mb-3">
                        <label class="form-label">NIK</label>
                        <input type="tel" class="form-control" name="nik" 
                               pattern="[0-9]{16}" title="Masukkan 16 digit angka" required>  
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select id="jenis_kelamin" class="form-control selectric" name="jenis_kelamin" required>
                            <option selected></option>
                            <option>Laki - Laki</option>
                            <option>Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3 row">
                        <div class="col">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" required>
                        </div>
                        <div class="col">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" required>
                        </div>
                    </div>

                    <!-- Tambahkan semua select lainnya dengan class selectric -->
                    <div class="mb-3 row">
                        <div class="col">
                            <label class="form-label">Agama</label>
                            <select class="form-control selectric" name="agama" required>
                                <option selected></option>
                                <option>ISLAM</option>
                                <option>HINDU</option>
                                <option>KRISTEN</option>
                                <option>KATHOLIK</option>
                                <option>BUDHA</option>
                            </select>
                        </div>
                        <div class="col">
                            <label class="form-label">Pendidikan</label>
                            <select class="form-control selectric" name="pendidikan" required>
                                <option selected></option>
                                <option>TIDAK / BELUM SEKOLAH</option>
                                <option>BELUM TAMAT SD / SEDERAJAT</option>
                                <option>TAMAT SD / SEDERAJAT</option>
                                <option>SLTP / SEDERAJAT</option>
                                <option>SLTA / SEDERAJAT</option>
                                <option>Diploma I / II</option>
                                <option>AKADEMI / DIPLOMA III / S.MUDA</option>
                                <option>DIPLOMA IV / STRATA I</option>
                                <option>STRATA II</option>
                                <option>STRATA III</option>
                            </select>
                        </div>
                    </div>
                      <div class="mb-3">
                    <label class="form-label">Pekerjaan</label>
                    <input type="text" class="form-control" name="pekerjaan"  required>
                </div>


                <div class="mb-3 row">
                    <div class="col">
                        <label class="form-label">Golongan Darah</label>
                        <select id="golongan_darah" class="form-control selectric" name="golongan_darah"  required>
                            <option selected></option>
                            <option>A</option>
                            <option>B</option>
                            <option>AB</option>
                            <option>O</option>
                          </select>
                    </div>
                    <div class="col">
                        <label class="form-label">Status Perkawinan</label>
                        <select id="status_perkawinan " class="form-control selectric" name="status_perkawinan"  required>
                            <option selected></option>
                            <option>BELUM KAWIN</option>
                            <option>KAWIN</option>
                            <option>CERAI HIDUP</option>
                            <option>CERAI MATI</option>
                          </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Perkawinan</label>
                    <input type="date" class="form-control" name="tanggal_perkawinan">
                </div>

                <div class="mb-3 row">
                    <div class="col">
                        <label class="form-label">Status Keluarga</label>
                        <select id="status_keluarga" class="form-control selectric" name="status_keluarga"  required>
                            <option selected></option>
                            <option>KEPALA KELUARGA </option>
                            <option>SUAMI</option>
                            <option>ISTRI</option>
                            <option>ANAK</option>
                            <option>MENANTU</option>
                            <option>ORANG TUA</option>
                            <option>MERTUA</option>
                            <option>PEMBANTU</option>
                            <option>FAMILI LAIN</option>
                          </select>
                    </div>
                    <div class="col">
                        <label class="form-label">Kewarganegaraan</label>
                        <select id="kewarganegaraan" class="form-control selectric" name="kewarganegaraan"  required>
                            <option selected></option>
                            <option>WNI</option>
                            <option>WNA</option>
                          </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label class="form-label">Nomor Paspor</label>
                      <input type="text" class="form-control" name="no_paspor">
                    </div>
                    <div class="col">
                        <label class="form-label">Nomor KITAP</label>
                      <input type="text" class="form-control" name="no_kitap">
                    </div>
                </div>
                <div class="mb-3 row">
                <div class="col">
                    <label class="form-label">Nama Ayah</label>
                    <input type="text" class="form-control" name="nama_ayah" required>
                </div>
                <div class="col">
                    <label class="form-label">Nama Ibu</label>
                    <input type="text" class="form-control" name="nama_ibu" required>
                </div>
                    

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SCRIPTS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-selectric/1.13.0/jquery.selectric.min.js" integrity="sha512-1JkUu6uJnlI2XnXYH/XR/3JCEFFwVwCKwBpH0xNGiFqN2b2f+zjX0F6yKxufskqkHf7aQYxqKXwlm70mTDq1cA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        // Inisialisasi Selectric untuk semua dropdown
        $('.selectric').selectric();
    });
</script>
<script src="{{ asset('js/penduduk.js') }}"></script>

@endsection