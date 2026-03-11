<link rel="stylesheet" href="{{ asset('css/detailberita.css') }}">

@if(isset($beritas))
    <section class="berita-section">
        <div class="container-berita">
            <h2 class="section-title-berita">📰 Berita Terkini</h2>
            <p class="section-subtitle-berita">Informasi terbaru seputar Desa Kalipait</p>

            <div class="row-berita">
                @foreach($beritas as $berita)
                    <div class="col-berita">
                        <div class="card-berita">
                            <img src="{{ asset('storage/imageberita/' . $berita->gambar) }}" class="card-img-berita" alt="{{ $berita->judul }}">
                            <div class="card-body-berita">
                                <h5 class="card-title-berita">{{ $berita->judul }}</h5>
                                <small class="text-muted">🖊 {{ $berita->penulis->nama_lengkap ?? 'Tidak diketahui' }}</small>
                                <small class="text-muted">📅 {{ date('d-m-Y', strtotime($berita->tanggal)) }}</small>
                                <p class="card-text-berita">{{ Str::limit(strip_tags($berita->isi), 100) }}</p>
                                <a href="{{ route('landing_page.show', $berita->id_berita) }}" class="btn-berita">Baca Selengkapnya →</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

@if(isset($berita))
    <section class="berita-detail">
        <div class="container-berita">
            <div class="card-berita-detail">
                <img src="{{ asset('storage/imageberita/' . $berita->image) }}" alt="{{ $berita->judul }}">
                <div class="card-body-berita-detail">
                    <h2 class="card-title-berita-detail">{{ $berita->judul }}</h2>
                    <small class="penulis-berita">🖊 {{ $berita->penulis->nama_lengkap ?? 'Tidak diketahui' }}</small>
                    <small class="text-muted">📅 {{ date('d-m-Y', strtotime($berita->tanggal)) }}</small>
                    <div class="card-text-berita-detail">{!! $berita->deskripsi !!}</div>
                    <a href="{{ route('website') }}#berita-section" class="btn-berita mt-4">← Kembali ke Daftar Berita</a>
                </div>
            </div>
        </div>
    </section>
@endif

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const cards = document.querySelectorAll('.card-berita, .card-berita-detail');
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        cards.forEach(card => observer.observe(card));
    });
</script>