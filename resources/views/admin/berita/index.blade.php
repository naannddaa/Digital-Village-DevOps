@extends('admin.layout.main')
@section('title', 'Berita')

@section('content')

<section class="section">

    <div class="section-header">
        <h1>Master Berita</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">

                <div class="card">

                    {{-- CARD HEADER --}}
                    <div class="card-header d-flex justify-content-between">

                        {{-- FORM SEARCH --}}
                        <form class="d-flex" action="{{ url('admin/berita') }}" method="get">
                            <input class="form-control me-2"
                                   type="search"
                                   name="katakunci"
                                   value="{{ Request::get('katakunci') }}"
                                   placeholder="Cari..."
                                   autocomplete="off">

                            <button class="btn btn-outline-primary">
                                Cari
                            </button>
                        </form>

                        {{-- TOMBOL TAMBAH --}}
                        <a href="{{ url('admin/berita/create') }}"
                           class="btn btn-primary">
                            + Tambah Data
                        </a>

                    </div>


                    {{-- CARD BODY --}}
                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-striped">

                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Gambar</th>
                                        <th>Deskripsi</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @php
                                        $i = $databerita->firstItem();
                                    @endphp

                                    @forelse ($databerita as $item)

                                    <tr>

                                        <td>
                                            {{ $i }}
                                        </td>

                                        <td>
                                            {{ $item->judul }}
                                        </td>

                                        <td>

                                            <img src="{{ asset('storage/imageberita/'.$item->image) }}"
                                                 class="border"
                                                 style="width:200px; height:auto;">

                                        </td>

                                        <td>

                                            @php
                                                $words = explode(' ', strip_tags($item->deskripsi));
                                            @endphp

                                            @if(count($words) > 50)
                                                {{ implode(' ', array_slice($words,0,50)) }}...
                                            @else
                                                {{ $item->deskripsi }}
                                            @endif

                                        </td>

                                        <td>
                                            {{ $item->tanggal }}
                                        </td>


                                        {{-- AKSI --}}
                                        <td>

                                            {{-- EDIT --}}
                                            <a href="{{ url('admin/berita/'.$item->id_berita.'/edit') }}"
                                               class="btn btn-warning btn-sm me-1">

                                                <i class="fas fa-pencil-alt"></i>

                                            </a>


                                            {{-- DELETE --}}
                                            <form id="formHapus{{ $item->id_berita }}"
                                                  class="d-inline"
                                                  action="{{ url('admin/berita/'.$item->id_berita) }}"
                                                  method="POST">

                                                @csrf
                                                @method('DELETE')

                                                <button type="button"
                                                        class="btn btn-danger btn-sm btnHapus"
                                                        data-id="{{ $item->id_berita }}"
                                                        data-nama="{{ $item->judul }}">

                                                    <i class="fas fa-trash"></i>

                                                </button>

                                            </form>

                                        </td>

                                    </tr>

                                    @php $i++ @endphp

                                    @empty

                                    <tr>
                                        <td colspan="6" class="text-center">
                                            Belum ada data
                                        </td>
                                    </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>


                        {{-- PAGINATION --}}
                        {{ $databerita->links() }}

                    </div>

                </div>

            </div>
        </div>
    </div>

</section>


{{-- STYLE TABEL --}}
<style>

table{
    table-layout: fixed;
    width: 100%;
}

td.judul,
td.deskripsi{
    white-space: normal;
    word-wrap: break-word;
    max-width: 400px;
    text-align: justify;
}

</style>


{{-- SWEET ALERT DELETE --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

document.addEventListener('DOMContentLoaded', function(){

    const hapusButtons = document.querySelectorAll('.btnHapus');

    hapusButtons.forEach(button => {

        button.addEventListener('click', function(){

            const id   = this.getAttribute('data-id');
            const nama = this.getAttribute('data-nama');

            Swal.fire({

                title: 'Yakin ingin menghapus?',
                text: `Data berita dengan judul "${nama}" akan dihapus!`,
                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',

                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'

            }).then((result) => {

                if(result.isConfirmed){
                    document.getElementById('formHapus' + id).submit();
                }

            });

        });

    });

});

</script>

@endsection