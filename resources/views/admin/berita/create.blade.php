@extends('admin.layout.main')
@section('title', 'Tambah Berita')

@section('content')

<section class="section">

    <div class="section-header">
        <h1>Tambah Berita</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    

                        {{-- FORM TAMBAH BERITA --}}
                        <form action="{{ url('admin/berita') }}"
                              method="POST"
                              enctype="multipart/form-data">

                            @csrf

                            <div class="p-3 bg-body rounded mx-4 mt-4">

                                {{-- TOMBOL KEMBALI --}}
                                <a href="{{ url('admin/berita') }}"
                                   class="btn btn-outline-primary">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="16"
                                         height="16"
                                         fill="currentColor"
                                         class="bi bi-arrow-left-circle-fill"
                                         viewBox="0 0 16 16">

                                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
                                    </svg>

                                    Kembali

                                </a>


                                {{-- ID BERITA --}}
                                <div class="mb-3 row mt-4">

                                    <label class="col-sm-2 col-form-label">
                                        ID Berita
                                    </label>

                                    <div class="col-sm-10">
                                        <input type="text"
                                               name="id_berita"
                                               value="{{ $idBerita }}"
                                               class="form-control"
                                               readonly>
                                    </div>

                                </div>


                                {{-- JUDUL --}}
                                <div class="mb-3 row">

                                    <label class="col-sm-2 col-form-label">
                                        Judul Berita
                                    </label>

                                    <div class="col-sm-10">

                                        <input type="text"
                                               name="judul"
                                               id="judul"
                                               class="form-control"
                                               required>

                                    </div>

                                </div>


                                {{-- DESKRIPSI --}}
                                <div class="mb-3 row">

                                    <label class="col-sm-2 col-form-label">
                                        Deskripsi
                                    </label>

                                    <div class="col-sm-10">

                                        <textarea name="deskripsi"
                                                  id="deskripsi"
                                                  rows="8"
                                                  class="form-control"
                                                  required></textarea>

                                    </div>

                                </div>


                                {{-- GAMBAR --}}
                                <div class="mb-3 row">

                                    <label class="col-sm-2 col-form-label">
                                        Gambar
                                    </label>

                                    <div class="col-sm-10">

                                        <input type="file"
                                               name="image"
                                               id="image"
                                               class="form-control"
                                               accept="image/*"
                                               required>

                                        <img id="showImage"
                                             src=""
                                             class="img-fluid mt-2"
                                             width="200"
                                             style="display:none;">

                                    </div>

                                </div>


                                {{-- TANGGAL --}}
                                <div class="mb-3 row">

                                    <label class="col-sm-2 col-form-label">
                                        Tanggal
                                    </label>

                                    <div class="col-sm-10">

                                        <input type="date"
                                               name="tanggal"
                                               id="tanggal"
                                               class="form-control"
                                               required>

                                    </div>

                                </div>


                                {{-- TOMBOL SIMPAN --}}
                                <div class="mb-3 row">

                                    <div class="col-sm-10 offset-sm-2">

                                        <button type="submit"
                                                class="btn btn-primary">

                                            SIMPAN

                                        </button>

                                    </div>

                                </div>

                            </div>

                        </form>

                    
                </div>

            </div>
        </div>
    </div>

</section>


{{-- SCRIPT PREVIEW GAMBAR --}}
<script>

document.addEventListener("DOMContentLoaded", function(){

    const imageInput = document.getElementById('image');
    const previewImg = document.getElementById('showImage');

    imageInput.addEventListener('change', function(e){

        const reader = new FileReader();

        reader.onload = function(e){

            previewImg.src = e.target.result;
            previewImg.style.display = 'block';

        };

        reader.readAsDataURL(e.target.files[0]);

    });


    const tanggal = document.getElementById('tanggal');

    tanggal.addEventListener('focus', function(){

        if(this.showPicker){
            this.showPicker();
        }

    });

});

</script>

@endsection