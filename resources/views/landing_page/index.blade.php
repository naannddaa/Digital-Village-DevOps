<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Village</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>     

    <body>

        <section class="header-section">
    <div class="container">
        <div class="row">
           <div class="col-lg-6 d-flex align-items-center justify-content-between">
    <div class="logo-container d-flex align-items-center">
        <img src="{{ asset('storage/logo/logo.png') }}" alt="Logo Desa" class="logo-img">
        <div class="logo-text ms-3">
            <h4 class="mb-0">Desa Kalipait</h4>
            <small>Kabupaten Banyuwangi</small>
        </div>
    </div>
    <button class="menu-toggle d-md-none" onclick="toggleMenu()">☰</button>
</div>

                  <div class="col-lg-6">
               <nav class="menu d-none d-md-block">
                   <ul class="d-flex flex-column flex-md-row">
                      <li><a href="#hero-section">Beranda</a></li>
                      <li><a href="#section-1-first">Layanan</a></li>
                      <li><a href="#profile-section">Profile</a></li>
                       <li><a href="#berita-section">Berita</a></li>
                       <li><a href="#footer-section">Tentang Kami</a></li>
                     <li><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                    </ul>
               </nav>
            </div>
        </div>
    </div>
</section>

    <section class="hero-section" id="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="left-section">
                        <h1>{{ $data->judul }}</h1>
                        <p>{{ $data->deskripsi1 }}</p>
                        <div class="d-flex">
                            <a href="#" class="contact-button">Download</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('image/coroseul/flash1.png') }}" alt="Slide 1">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('image/coroseul/flash2.png') }}" alt="Slide 2">
                            </div>
                        </div>
    
                        <!-- Custom Indicators -->
                        {{-- <div class="carousel-indicators-custom">
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div> --}}
    
                        <!-- Custom Controls -->
                        {{-- <div class="carousel-controls-bottom">
                            <div class="carousel-nav-buttons">
                                <button type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">&#8592;</button>
                                <button type="button" data-bs-target="#heroCarousel" data-bs-slide="next">&#8594;</button>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="service-section" id="service-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                   <div class="inner">
                        <img src="{{ asset('image/service/1.png') }}" alt="">
                        <div class="service">
                            <h1>Website</h1>
                            <p>
                                Pusat informasi dan e-form Desa Kalipait
                            </p>
                        </div>
                   </div>
                </div>
                <div class="col-lg-3">
                     <div class="inner">
                         <img src="{{ asset('image/service/2.png') }}" alt="">
                         <div class="service">
                             <h1>Pengajuan Surat</h1>
                             <p>
                                 Ajukan dokumen resmi tanpa antre
                             </p>
                         </div>
                     </div>
                  </div>
                  <div class="col-lg-3">
                     <div class="inner">
                         <img src="{{ asset('image/service/3.png') }}" alt="">
                         <div class="service">
                             <h1>Berita</h1>
                             <p>
                                  Info dan pengumuman desa terkini
                             </p>
                         </div>
                     </div>
                  </div>
                  <div class="col-lg-3">
                     <div class="inner">
                         <img src="{{ asset('image/service/4.png') }}" alt="">
                         <div class="service">
                             <h1>Aplikasi Mobile </h1>
                             <p>
                                  Layanan desa dalam genggaman anda
                             </p>
                         </div>
                     </div>
                  </div>
            </div>
        </div>
    </section>
    <section class="dummy-section" id="dummy-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3>Aplikasi Desa Digital : Semua Layanan Surat Kini dalam Genggaman </h3>
                    <p>
                        Ajukan Akta Kelahiran, Kartu Keluarga, KTP, dan beragam surat lainya 
                        <br>tanpa antre cukup menggunakan handphone
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="section-1" id="section-1-first">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                <h3>{{ $data->subtittle }}</h3>
                    <p>{{ $data->section_text }}</p>
                </div>
                <div class="col-lg-6">
                <?php if (!empty($data['image_description1'])): ?>
    <div style="display: flex; justify-content: flex-end; max-width: 90%; margin: auto;">
        <img src="{{ asset('storage/' . $data->image_description1) }}" style="width: 500px; height: auto;" class="image-description1" alt="Description Image">
    </div>
<?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <section class="section-1" id="section-1-second">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                <?php if (!empty($data['image_description2'])): ?>
       <img src="{{ asset('storage/' . $data->image_description2) }}" style="width: 600px; height: auto;" class="image-description2" alt="Description Image2">
    <?php endif; ?>
                </div>
                <div class="col-lg-6">
                <h3>{{ $data->subtitle_2 ?? '' }}</h3>
                <p id="section-second">{{ nl2br(e($data->section_second ?? '')) }}</p>
                </div>

            </div>
        </div>
    </section>

    <section class="visi-misi-section">
        <div class="container">
            <div class="row">
                <div class="col visi">
                    <h2>Visi</h2>
                    <p id="visi">{{ nl2br(e($data->visi ?? '')) }}</p>
                </div>
                <div class="col misi">
                    <h2>Misi</h2>
                    <p id="misi">{{ nl2br(e($data->misi ?? '')) }}</p>
                </div>
            </div>
        </div>
    </section>
    
    <section class="profile-section" id="profile-section">
        <h2>Perangkat Desa</h2>
        <p>Perangkat Desa Kalipait periode tahun 2025–2029</p>
      
        {{-- Kepala Desa --}}
        <div class="kepala-desa">
          <div class="card">
            <img src="{{ asset('image/profile/kepaladesa.jpg') }}" alt="Kepala Desa">
            <h4>Supriyono.</h4>
            <p>Kepala Desa Kalipait 2025–2029</p>
          </div>
        </div>
      
        {{-- 8 perangkat lain --}}
        <div class="container perangkat-desa">
          <div class="card">
            <img src="{{ asset('image/profile/ADI.jpg') }}" alt="Wakil">
            <h4>Adi Jatman,S.H</h4>
            <p>Kepala Dusun Purworejo  </p>
          </div>
          <div class="card">
            <img src="{{ asset('image/profile/misyadi.jpg') }}" alt="Sekretaris">
            <h4>Misyadi</h4>
            <p> Kepala Dusun Kutorejo </p>
          </div>
          <div class="card">
            <img src="{{ asset('image/profile/abal.jpg') }}" alt="Bendahara">
            <h4>Abal Mudlofar,S.Pd</h4>
            <p>Sekretaris Desa Kalipait</p>
          </div>
          <div class="card">
            <img src="{{ asset('image/profile/luluk.jpg') }}" alt="Pemerintahan">
            <h4>Luluk Uswatun Hasanah</h4>
            <p>Kepala Seksi Kesejahteraan Rakyat</p>
          </div>
          <div class="card">
            <img src="{{ asset('image/profile/sumarji.jpg') }}" alt="Kesejahteraan">
            <h4>Sumarji</h4>
            <p>Kepala Seksi Pemerintahan</p>
          </div>
          <div class="card">
            <img src="{{ asset('image/profile/yustika.jpg') }}" alt="Pelayanan">
            <h4>Yustika Nova Anggraini</h4>
            <p>Kepala Urusan Umum</p>
          </div>
          <div class="card">
            <img src="{{ asset('image/profile/melin.jpg') }}" alt="Umum">
            <h4>Melin Efraini</h4>
            <p>Kepala Urusan Keuangan</p>
          </div>
          <div class="card">
            <img src="{{ asset('image/profile/abd.jpg') }}" alt="Keuangan">
            <h4>M. Abdul Ghofur</h4>
            <p>Kepala Urusan Perencanaan</p>
          </div>
        </div>  
      </section>
      
      <section class="berita-section py-5" id="berita-section">
        <div class="container-berita">
            <div class="berita-header text-center mb-5">
                <h2 class="berita-heading">Berita Terkini</h2>
                <p class="berita-subheading">Berita terbaru tentang Desa Kalipait dan informasi terkini untuk masyarakat.</p>
            </div>
    
            @if($beritas->count() > 0)
                <div class="scroll-wrapper-berita">
                    @foreach($beritas as $berita)
                        <div class="card-berita d-flex flex-column">
                            <img src="{{ asset('storage/imageberita/' . $berita->image) }}" alt="{{ $berita->judul }}">
                            <div class="card-body-berita">
                                <h5 class="card-title-berita">{{ $berita->judul }}</h5>
                                <p class="card-text-berita">{{ Str::limit(strip_tags($berita->isi), 100, '...') }}</p>
                                <a href="{{ route('landing_page.show', $berita->id_berita) }}" class="btn-berita" >Baca Selengkapnya</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
    
    <footer class="footer-section" id="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h4>About Us</h4>
                    <p>{{ $data->about_us }}</p>
                </div>
    
                <div class="col-lg-4 text-center">
                    <h4>Connect</h4>
                    <hr style="width: 50px; border: 1px solid #fff; margin: 10px auto;">
                    <div class="social-icons">
                        <a href="https://www.instagram.com/desakalipait/" class="social-icon" target="_blank">
                            <img src="{{ asset('image/icons/instagram.png') }}" alt="Instagram">
                        </a>
                        <a href="mailto:desa.kalipait@gmail.com" class="social-icon">
                            <img src="{{ asset('image/icons/email.png') }}" alt="Email">
                        </a>
                        <a href="https://wa.me/6289526432934" class="social-icon" target="_blank">
                            <img src="{{ asset('image/icons/whatsapp.png') }}" alt="WhatsApp">
                        </a>
                    </div>
                </div>
    
                <div class="col-lg-4">
                    <h4>Contact Us</h4>
                    <p>Email: desa.kalipait@gmail.com</p>
                    <p>Phone: +62 895-2643-2934</p>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126275.58843042006!2d114.2060889218844!3d-8.488476627450437!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd3effd0234747f%3A0x3ef5ac1d39badfe2!2sKantor%20Desa%20Kalipait!5e0!3m2!1sid!2sid!4v1743259735533!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
    
            <div class="row mt-4">
                <div class="col-lg-12 text-center">
                    <p class="copyright">
                        © 2025 Desa Kalipait x About You. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>
    
       <script>
    function toggleMenu() {
        const menu = document.querySelector('.menu');
        menu.classList.toggle('d-none');
        menu.classList.toggle('mobile-menu-open');
    }

    // Tutup menu jika klik di luar area menu (opsional tapi direkomendasikan)
    document.addEventListener('click', function (e) {
        const toggle = document.querySelector('.menu-toggle');
        const menu = document.querySelector('.menu');

        if (!menu.contains(e.target) && !toggle.contains(e.target)) {
            if (!menu.classList.contains('d-none')) {
                menu.classList.add('d-none');
                menu.classList.remove('mobile-menu-open');
            }
        }
    });
</script>

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('js/landingpage.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
 
    
</body>
</html>