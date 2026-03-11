@extends('admin.layout.main')
@section('title', 'Edit Berita')

@section('content')

<section class="section">

    <div class="section-header">
        <h1>Edit Berita</h1>
    </div>
       <div class="section-body">
        <div class="row">
            <div class="col-12">

                <div class="card">
        <!-- START FORM -->
        <form action="{{ url('admin/berita/' . $databerita->id_berita) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="my-3 p-3 bg-body rounded shadow-sm">
                {{-- tombol kembali start--}}
                <a  href="{{ url('admin/berita') }}" class="btn btn-outline-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
                    </svg> Kembali
                </a>
                {{-- tombol kembali end--}}

                {{-- Field ID Berita Hidden --}}
                <input type="hidden" name="id_berita" value="{{ $databerita->id_berita }}">

                {{-- Field Judul --}}
                <div class="mb-3 row mt-5">
                    <label for="judul" class="col-sm-2 col-form-label">Judul Berita</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="judul" id="judul" value="{{ $databerita->judul }}" required>
                    </div>
                </div>

                {{-- Field Deskripsi --}}
                <div class="mb-3 row">
                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="8" required>{{ $databerita->deskripsi }}</textarea>
                    </div>
                </div>

                {{-- Field Gambar --}}
                <div class="mb-3 row">
                    <label for="image" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        {{-- Tampilkan gambar lama jika ada --}}
                        @if($databerita->image)
                            <img src="{{ asset('storage/imageberita/' . $databerita->image) }}" alt="Gambar Berita" id="oldImage" class="img-fluid mb-3" style="max-width: 200px; max-height: 200px;">
                        @endif
                        {{-- Tempat untuk gambar baru --}}
                        <img src="" id="showImage" class="img-fluid mt-3 mb-4" style="max-width: 200px; max-height: 200px; display: none;">
                        {{-- accept hanya akan menampilkan file dalam bentuk gambar --}}
                        <input type="file" class="form-control" name="image" id="image" accept="image/*">
                    </div>
                </div>

                {{-- Field Tanggal --}}
                <div class="mb-3 row">
                    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{ $databerita->tanggal }}" required>
                    </div>
                </div>

                {{-- Tombol Submit --}}
                <div class="mb-3 row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>

                {{-- SweetAlert Notification --}}
                {{-- @include('sweetalert::alert') --}}
            </div>
        </form>
<!-- AKHIR FORM -->

{{-- JQUERY untuk preview gambar --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#image').change(function(e) {
            var file = e.target.files[0]; //mengambil file yang dipilih
            if (file) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $('#oldImage').remove(); // Hapus gambar lama
                    $('#showImage').attr('src', event.target.result).show(); // menampilkan gambar baru
                };
                reader.readAsDataURL(file);
            } else {
                $('#showImage').hide(); // Sembunyikan gambar baru jika tidak ada file dipilih
            }
        });
    });

    document.getElementById('tanggal').addEventListener('focus', function(e) {
        this.showPicker && this.showPicker(); // Untuk browser yang support showPicker()
    });
</script>

@endsection
