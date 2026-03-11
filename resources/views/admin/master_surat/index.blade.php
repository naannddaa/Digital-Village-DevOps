@extends('admin.layout.main')
@section('title', 'Master Surat')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Master Surat</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">

                <div class="card">

                    <div class="card-header d-flex justify-content-between">

                        <form id="searchForm"
                              class="d-flex"
                              action="{{ route('mastersurat.index') }}"
                              method="get">

                            <input class="form-control me-2"
                                   type="search"
                                   name="katakunci"
                                   id="searchInput"
                                   value="{{ Request::get('katakunci') }}"
                                   placeholder="Cari..."
                                   autocomplete="off">

                            <button class="btn btn-outline-primary">
                                Cari
                            </button>

                        </form>

                        <a href="#"
                           class="btn btn-primary"
                           id="btnTambahSurat"
                           data-id_surat="{{ $id_surat }}">
                            + Tambah Data
                        </a>

                    </div>


                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-striped">

                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Surat</th>
                                        <th>Nama Surat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach($datasurat as $item)
                                        @if(!is_null($item->nama_surat))

                                        <tr>

                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ $item->id_surat }}</td>

                                            <td>{{ $item->nama_surat }}</td>

                                            <td>

                                                <button type="button"
                                                        class="btn btn-warning btn-sm btnEditSurat"
                                                        data-action="{{ route('mastersurat.update', $item->id_surat) }}"
                                                        data-id="{{ $item->id_surat }}"
                                                        data-nama="{{ $item->nama_surat }}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>


                                                <form method="POST"
                                                      action="{{ route('mastersurat.destroy', $item->id_surat) }}"
                                                      style="display:inline;">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="btn btn-danger btn-sm btnDeleteSurat"
                                                            data-nama="{{ $item->nama_surat }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>

                                                </form>

                                            </td>

                                        </tr>

                                        @endif
                                    @endforeach

                                </tbody>

                            </table>

                            {{ $datasurat->withQueryString()->links() }}

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

</section>


{{-- MODAL TAMBAH / EDIT --}}
<div class="modal fade"
     id="modalForm"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="modalTitle">
                    Tambah Surat
                </h4>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>


            <div class="modal-body">

                <form id="formSurat"
                      method="POST"
                      enctype="multipart/form-data"
                      data-store-url="{{ route('mastersurat.store') }}"
                      action="{{ route('mastersurat.store') }}">

                    @csrf

                    <input type="hidden"
                           name="_method"
                           id="formMethod"
                           value="POST">


                    <div class="mb-3">

                        <label class="form-label">
                            ID Surat
                        </label>

                        <input type="text"
                               class="form-control"
                               id="inputIdSurat"
                               name="id_surat"
                               value="{{ old('id_surat') }}"
                               readonly>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Nama Surat
                        </label>

                        <input type="text"
                               class="form-control"
                               id="inputNamaSurat"
                               name="nama_surat"
                               required>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Gambar
                        </label>

                        <input type="file"
                               class="form-control"
                               id="inputImage"
                               name="image"
                               accept="image/*">

                        <div class="mt-2"
                             id="previewGambar"
                             style="display:none;">

                            <label>Gambar Lama :</label>
                            <br>

                            <img id="gambarLama"
                                 src=""
                                 width="100">

                        </div>

                    </div>

                </form>

            </div>


            <div class="modal-footer">

                <button type="submit"
                        form="formSurat"
                        class="btn btn-primary">

                    Simpan

                </button>

            </div>

        </div>

    </div>

</div>


{{-- JAVASCRIPT --}}
<script src="{{ asset('js/mastersurat.js') }}"></script>

<script>

document.addEventListener("DOMContentLoaded", function(){

    const searchInput = document.getElementById('searchInput');
    const searchForm  = document.getElementById('searchForm');

    let timeout = null;

    searchInput.addEventListener('input', function(){

        clearTimeout(timeout);

        timeout = setTimeout(function(){
            searchForm.submit();
        }, 500);

    });

});

</script>

@endsection