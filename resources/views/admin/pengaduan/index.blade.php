@extends('admin.layout.main')
@section('title', 'Master Pengaduan')

@section('content')

<section class="section">

    <div class="section-header">
        <h1>Master Pengaduan</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">

                <div class="card">

                    <!-- HEADER -->
                    <div class="card-header d-flex justify-content-between">

                        <form class="d-flex"
                              action="{{ route('master-pengaduan.index') }}"
                              method="get"
                              id="searchForm">

                            <input class="form-control me-1"
                                   type="search"
                                   name="katakunci"
                                   placeholder="Cari..."
                                   value="{{ Request::get('katakunci') }}">

                            <button class="btn btn-outline-primary" type="submit">
                                Cari
                            </button>

                        </form>

                    </div>


                    <!-- BODY -->
                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-striped">

                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama Pengadu</th>
                                        <th>Kategori</th>
                                        <th>Ulasan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>

                                @forelse($pengaduan as $i => $item)

                                    <tr>

                                        <td>{{ $pengaduan->firstItem() + $i }}</td>
                                        <td>{{ $item->nik }}</td>
                                        <td>{{ $item->penduduk->nama_lengkap ?? '-' }}</td>
                                        <td>{{ $item->kategori ?? '-' }}</td>

                                        <td>
                                            {{ \Illuminate\Support\Str::words(strip_tags($item->ulasan), 20, '...') }}
                                        </td>

                                        <td>

                                            <!-- BUTTON LIHAT -->
                                            <button class="btn btn-success btn-sm me-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#lihatModal{{ $item->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>

                                            <!-- BUTTON HAPUS -->
                                            <form action="{{ route('master-pengaduan.destroy', $item->id) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  id="formHapus{{ $item->id }}">

                                                @csrf
                                                @method('DELETE')

                                                <button type="button"
                                                        class="btn btn-danger btn-sm me-1 btnHapus"
                                                        data-id="{{ $item->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                            </form>

                                            <!-- BUTTON FEEDBACK -->
                                            <button class="btn btn-primary btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#feedbackModal{{ $item->id }}">
                                                <i class="fas fa-comment-dots"></i>
                                            </button>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="6" class="text-center">
                                            Tidak ada data pengaduan
                                        </td>
                                    </tr>

                                @endforelse

                                </tbody>

                            </table>

                        </div>


                        <!-- PAGINATION -->
                        {{ $pengaduan->links() }}

                    </div>
                </div>

            </div>
        </div>
    </div>

</section>


<!-- ========================= -->
<!-- MODAL SECTION -->
<!-- ========================= -->

@foreach($pengaduan as $item)

<!-- MODAL LIHAT -->
<div class="modal fade" id="lihatModal{{ $item->id }}" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content p-4">

            <div class="modal-header">

                <h5 class="modal-title fw-bold">
                    Detail Pengaduan
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>

            </div>


            <div class="modal-body">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-bold">NIK</label>

                        <input type="text"
                               class="form-control"
                               value="{{ $item->nik }}"
                               readonly>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-bold">Nama</label>

                        <input type="text"
                               class="form-control"
                               value="{{ $item->penduduk->nama_lengkap ?? '-' }}"
                               readonly>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-bold">Kategori</label>

                        <input type="text"
                               class="form-control"
                               value="{{ $item->kategori ?? '-' }}"
                               readonly>

                    </div>


                    <div class="col-12 mb-3">

                        <label class="form-label fw-bold">Ulasan</label>

                        <textarea class="form-control"
                                  rows="3"
                                  readonly>{{ $item->ulasan }}</textarea>

                    </div>


                    <div class="col-12 text-center">

                        <label class="form-label fw-bold">
                            Foto Pengaduan
                        </label>

                        @if($item->foto1 && file_exists(storage_path('app/public/'.$item->foto1)))

                            <img src="{{ asset('storage/'.$item->foto1) }}"
                                 class="img-fluid rounded shadow-sm"
                                 style="max-height:300px;">

                        @else

                            <div class="text-muted fst-italic">
                                Tidak ada foto yang dilampirkan
                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- MODAL FEEDBACK -->
<div class="modal fade" id="feedbackModal{{ $item->id }}" tabindex="-1">

    <div class="modal-dialog">

        <form action="{{ route('pengaduan.feedback', $item->id) }}"
              method="POST">

            @csrf

            <div class="modal-content p-3">

                <div class="modal-header">

                    <h5 class="modal-title">
                        Kirim Feedback
                    </h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"></button>

                </div>


                <div class="modal-body">

                    <textarea name="feedback"
                              class="form-control"
                              rows="4"
                              placeholder="Tulis feedback...">{{ old('feedback', $item->feedback ?? '') }}</textarea>

                </div>


                <div class="modal-footer">

                    <button type="submit"
                            class="btn btn-success">
                        Kirim
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@endforeach


<!-- ========================= -->
<!-- SWEET ALERT DELETE -->
<!-- ========================= -->

<script>

document.addEventListener('DOMContentLoaded', function () {

    const hapusButtons = document.querySelectorAll('.btnHapus');

    hapusButtons.forEach(button => {

        button.addEventListener('click', function () {

            const id = this.dataset.id;

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data pengaduan ini akan dihapus permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {

                if (result.isConfirmed) {
                    document.getElementById('formHapus' + id).submit();
                }

            });

        });

    });

});

</script>


<!-- ========================= -->
<!-- AUTO SEARCH -->
<!-- ========================= -->

<script>

document.addEventListener("DOMContentLoaded", function () {

    const searchInput = document.querySelector('input[name="katakunci"]');
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