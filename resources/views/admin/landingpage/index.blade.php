@extends('admin.layout.main')
@section('title', 'Edit Landingpage')

@section('content')

<section class="section">

```
<div class="section-header">
    <h1>Edit Landingpage</h1>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">

            <div class="card">

                <div class="card-body">

                    <form action="{{ route('homepage.update') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <!-- JUDUL -->
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" class="form-control" name="title" value="{{ $data->judul }}" required>
                        </div>

                        <!-- DESKRIPSI -->
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" rows="5" required>{{ $data->deskripsi1 }}</textarea>
                        </div>

                        <!-- SUBJUDUL -->
                        <div class="mb-3">
                            <label class="form-label">Subjudul</label>
                            <textarea class="form-control" name="subtittle">{{ $data->subtittle }}</textarea>
                        </div>

                        <!-- DESKRIPSI SUBJUDUL -->
                        <div class="mb-3">
                            <label class="form-label">Deskripsi Subjudul</label>
                            <textarea class="form-control" name="section_text" rows="5">{{ $data->section_text }}</textarea>
                        </div>

                        <!-- IMAGE DESKRIPSI 1 -->
                        <div class="mb-3">
                            <label class="form-label">Image Deskripsi 1</label>
                            <input type="file" class="form-control" name="image_description1" id="image_description1">

                            @if($data->image_description1)
                                <img src="{{ asset('storage/' . $data->image_description1) }}"
                                     class="img-fluid mt-2"
                                     width="200"
                                     id="previewDesc1">
                            @endif
                        </div>

                        <!-- SUBJUDUL 2 -->
                        <div class="mb-3">
                            <label class="form-label">Subjudul 2</label>
                            <textarea class="form-control" name="subtitle_2">{{ $data->subtitle_2 }}</textarea>
                        </div>

                        <!-- DESKRIPSI SUBJUDUL 2 -->
                        <div class="mb-3">
                            <label class="form-label">Deskripsi Subjudul 2</label>
                            <textarea class="form-control" name="section_second" rows="5">{{ $data->section_second }}</textarea>
                        </div>

                        <!-- IMAGE DESKRIPSI 2 -->
                        <div class="mb-3">
                            <label class="form-label">Image Deskripsi 2</label>
                            <input type="file" class="form-control" name="image_description2" id="image_description2">

                            @if($data->image_description2)
                                <img src="{{ asset('storage/' . $data->image_description2) }}"
                                     class="img-fluid mt-2"
                                     width="200"
                                     id="previewDesc2">
                            @endif
                        </div>

                        <!-- VISI -->
                        <div class="mb-3">
                            <label class="form-label">Visi</label>
                            <textarea class="form-control" name="visi" rows="4">{{ $data->visi }}</textarea>
                        </div>

                        <!-- MISI -->
                        <div class="mb-3">
                            <label class="form-label">Misi</label>
                            <textarea class="form-control" name="misi" rows="4">{{ $data->misi }}</textarea>
                        </div>

                        <!-- ABOUT -->
                        <div class="mb-3">
                            <label class="form-label">Tentang Kami</label>
                            <textarea class="form-control" name="about_content" rows="4">{{ $data->about_us }}</textarea>
                        </div>

                        <!-- BUTTON -->
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4">
                                SIMPAN
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
</div>
```

</section>

<script>

document.getElementById('image_description1')?.addEventListener('change', function(e){
    if (e.target.files[0]) {
        document.getElementById('previewDesc1').src = URL.createObjectURL(e.target.files[0]);
    }
});

document.getElementById('image_description2')?.addEventListener('change', function(e){
    if (e.target.files[0]) {
        document.getElementById('previewDesc2').src = URL.createObjectURL(e.target.files[0]);
    }
});

</script>

@endsection
