@extends('admin.layout.main')
@section('title', 'Kartu Keluarga')
@section('content')

<section class="section">
    <div class="section-header">
        <h1>Kartu Keluarga</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">

                <div class="card">

                    <!-- CARD HEADER -->
                    <div class="card-header">
                      <div class="d-flex justify-content-between w-100">

                          <!-- KIRI : PENCARIAN -->
                          <form class="d-flex" action="{{ route('kartukeluarga.view') }}" method="get">
                              <input class="form-control me-2" type="search" name="katakunci"
                                  value="{{ Request::get('katakunci') }}"
                                  placeholder="Cari No KK / Nama Kepala Keluarga">

                              <button class="btn btn-outline-primary">Cari</button>
                          </form>

                          <!-- KANAN : TOMBOL TAMBAH -->
                          <a href="#" class="btn btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#modalKeluarga">
                              + Tambah Data
                          </a>

                      </div>
                  </div>
                    <!-- CARD BODY -->
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table table-striped" id="activityTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Kartu Keluarga</th>
                                        <th>Nama Kepala Keluarga</th>
                                        <th>Alamat</th>
                                        <th>RW</th>
                                        <th>RT</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($master_kartukeluarga as $a)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $a->no_kk }}</td>
                                        <td>{{ $a->nama_lengkap }}</td>
                                        <td>{{ $a->alamat }}</td>
                                        <td>{{ $a->rw }}</td>
                                        <td>{{ $a->rt }}</td>
                                        <td>
                                            <!-- EDIT -->
                                            <button class="btn btn-warning btn-sm editButton"
                                                data-id="{{ $a->no_kk }}"
                                                data-no_kk="{{ $a->no_kk }}"
                                                data-nik="{{ $a->nik ?? '' }}"
                                                data-nama_lengkap="{{ $a->nama_lengkap ?? '' }}"
                                                data-alamat="{{ $a->alamat }}"
                                                data-rt="{{ $a->rt }}"
                                                data-rw="{{ $a->rw }}"
                                                data-kode_pos="{{ $a->kode_pos }}"
                                                data-desa="{{ $a->desa }}"
                                                data-kecamatan="{{ $a->kecamatan }}"
                                                data-kabupaten="{{ $a->kabupaten }}"
                                                data-provinsi="{{ $a->provinsi }}"
                                                data-tanggal_dibuat="{{ $a->tanggal_dibuat }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>

                                            <!-- HAPUS -->
                                            <a href="{{ route('kartukeluarga.delete',$a->no_kk) }}"
                                               class="btn btn-danger btn-sm" title="Hapus Data">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                            <!-- TAMBAH PENDUDUK -->
                                            <a href="{{ url('admin/master_penduduk?nokk=' . $a->no_kk) }}"
                                               class="btn btn-success btn-sm" title="Tambah Penduduk">
                                                <i class="fas fa-user-plus"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- PAGINATION -->
                        <div class="mt-3">
                            {{ $master_kartukeluarga->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MODAL TAMBAH/EDIT -->
<div class="modal fade" id="modalKeluarga" tabindex="-1" aria-labelledby="modalKeluargaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="keluargaForm" method="POST" action="{{ url('admin/master_kartukeluarga/masuk') }}">
        @csrf
        <input type="hidden" name="_method" value="PUT">

        <div class="modal-header">
          <h5 class="modal-title" id="modalKeluargaLabel">Tambah Data Kepala Keluarga</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <!-- FORM INPUTS (Nomor KK, NIK, Nama, Alamat, RT/RW, dll) -->
          <!-- Sama seperti kode sebelumnya -->
          <div class="mb-3">
              <label class="form-label">Nomor KK</label>
              <input type="text" class="form-control" id="no_kk" name="no_kk" pattern="\d{16}" required>
          </div>
          <div class="mb-3">
              <label class="form-label">NIK</label>
              <input type="text" class="form-control" id="nik" name="nik" pattern="\d{16}" required>
          </div>
          <div class="mb-3">
              <label class="form-label">Nama Kepala Keluarga</label>
              <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
          </div>
          <div class="mb-3">
              <label class="form-label">Alamat</label>
              <input type="text" class="form-control" id="alamat" name="alamat" required>
          </div>
          <div class="mb-3 row">
              <div class="col"><label class="form-label">RT</label><input type="text" class="form-control" id="rt" name="rt" required></div>
              <div class="col"><label class="form-label">RW</label><input type="text" class="form-control" id="rw" name="rw" required></div>
              <div class="col"><label class="form-label">Kode Pos</label><input type="text" class="form-control" id="kode_pos" name="kode_pos" value="68484" readonly></div>
          </div>
          <div class="mb-3 row">
              <div class="col"><label class="form-label">Desa</label><input type="text" class="form-control" id="desa" name="desa" value="Kalipait" readonly></div>
              <div class="col"><label class="form-label">Kecamatan</label><input type="text" class="form-control" id="kecamatan" name="kecamatan" value="Tegaldlimo" readonly></div>
          </div>
          <div class="mb-3 row">
              <div class="col"><label class="form-label">Kabupaten</label><input type="text" class="form-control" id="kabupaten" name="kabupaten" value="Banyuwangi" readonly></div>
              <div class="col"><label class="form-label">Provinsi</label><input type="text" class="form-control" id="provinsi" name="provinsi" value="Jawa Timur" readonly></div>
          </div>
          <div class="mb-3">
              <label class="form-label">Tanggal Dibuat</label>
              <input type="date" class="form-control" id="tanggal_dibuat" name="tanggal_dibuat" required>
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

{{-- SCRIPTS --}}
<!-- Bootstrap CSS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/kartukeluarga.js') }}"></script>

@endsection