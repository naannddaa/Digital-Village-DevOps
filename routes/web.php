<?php



use App\Http\Controllers\API\status_diajukan_controller;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\beritaController;

use App\Http\Controllers\DashboardController;

use App\Http\Controllers\landing_pageController;

use App\Http\Controllers\LoginController;

use App\Http\Controllers\master_kartukeluargaController;

use App\Http\Controllers\master_pendudukController;

use App\Http\Controllers\Master_suratController;

use App\Http\Controllers\SuratditolakController;

use App\Http\Controllers\masterAkunController;

use App\Http\Controllers\masterAkunRtController;

use App\Http\Controllers\masterAkunRwController;

use App\Http\Controllers\SuratmasukController;

use App\Http\Controllers\LandingBeritaController;

use App\Http\Controllers\SuratSelesaiController;

use App\Http\Controllers\MasterPengaduanController;

use App\Http\Controllers\DashboardRTController;

use App\Http\Controllers\SuratDitolakRTController;

use App\Http\Controllers\SuratMasukRTController;

use App\Http\Controllers\SuratSelesaiRTController;

use App\Http\Controllers\DashboardRWController;

use App\Http\Controllers\SuratSelesaiRWController;

use App\Http\Controllers\SuratMasukRWController;

use App\Http\Controllers\generate;



// Dashboard

Route::get('/', [landing_pageController::class, 'tampil'])->name('website');




Route::get('/check-nama-nik', function () {

    return view('cekk');

})->middleware('auth');  // Pastikan hanya yang login yang bisa mengakses

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login.proses')->middleware('guest');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



Route::get('/landing_page', [LandingBeritaController::class, 'index'])->name('landing_page.index');

Route::get('/landing_page/{id_berita}', [LandingBeritaController::class, 'show'])->name('landing_page.show');


Route::middleware(['auth', 'role:3'])->prefix('rt')->group(function () {

    Route::get('/dashboard-rt', [DashboardRTController::class, 'index'])->name('dashboard.rt');

    // Surat Masuk
    Route::get('/surat-masuk', [SuratMasukRTController::class, 'index'])->name('rt.suratmasuk.index');
    Route::post('/surat-masuk/setujui/{id_pengajuan}', [SuratMasukRTController::class, 'setujui'])->name('rt.suratmasuk.setuju');
    Route::post('/surat-masuk/tolak/{id_pengajuan}', [SuratMasukRTController::class, 'tolak'])->name('rt.suratmasuk.tolak');

    // Surat Selesai
    Route::get('/surat-selesai', [SuratSelesaiRTController::class, 'index'])->name('rt.suratselesai.index');
    Route::get('/surat-selesai/{id}', [SuratSelesaiRTController::class, 'show'])->name('rt.suratselesai.show');
    Route::delete('/surat-selesai/{id}', [SuratSelesaiRTController::class, 'destroy'])->name('rt.suratselesai.destroy');

    // Surat Ditolak
    Route::get('/surat-ditolak', [SuratDitolakRTController::class, 'index'])->name('rt.suratditolak.index');
    Route::get('/surat-ditolak/{id}', [SuratDitolakRTController::class, 'show'])->name('rt.suratditolak.show');
    Route::post('/surat-ditolak/alasan', [SuratDitolakRTController::class, 'alasanPenolakan'])->name('rt.suratditolak.alasan');
    Route::delete('/rt/surat-ditolak/{id}', [App\Http\Controllers\SuratDitolakRTController::class, 'destroy'])->name('rt.suratditolak.destroy');

});

// Group route RW
Route::middleware(['auth', 'role:2'])->prefix('rw')->group(function () {

    Route::get('/dashboard-rw', [DashboardRWController::class, 'index'])->name('rw.dashboard');

    
    // Route::get('/count-pengajuan', function() {

    //     $count = \App\Models\master_pengajuan::where('status', 'Disetujui RT')->count();

    // return response()->json(['count' => $count]);

    // });

    // Surat Masuk
    Route::get('/surat-masuk', [SuratMasukRWController::class, 'index'])->name('rw.suratmasuk.index');
    Route::get('/surat-masuk/{id_pengajuan}', [SuratMasukRWController::class, 'show'])->name('rw.suratmasuk.show');
    Route::post('/surat-masuk/setujui/{id_pengajuan}', [SuratMasukRWController::class, 'setujui'])->name('rw.suratmasuk.setujui');

    Route::delete('/surat-masuk/{id_pengajuan}', [SuratMasukRWController::class, 'destroy'])->name('rw.suratmasuk.destroy');

    // Surat Selesai
    Route::get('/surat-selesai', [SuratSelesaiRWController::class, 'index'])->name('rw.suratselesai.index');
    Route::get('/surat-selesai/{id_pengajuan}', [SuratSelesaiRWController::class, 'show'])->name('rw.suratselesai.show');
    Route::delete('/surat-selesai/{id}', [SuratSelesaiRWController::class, 'destroy'])->name('rw.suratselesai.destroy');
});


// Group route admin

Route::middleware(['auth', 'role:1'])->prefix('admin')->group(function () {



    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route untuk Berita

    Route::resource('berita', beritaController::class);

    Route::get('upload/berita', [beritaController::class, 'index'])->name('admin.berita.index');

    Route::get('upload/berita/create', [beritaController::class, 'create'])->name('admin.berita.create');

    Route::post('upload/berita/create', [beritaController::class, 'store'])->name('admin.berita.store');

    Route::get('upload/berita/{id}/edit', [beritaController::class, 'edit'])->name('admin.berita.edit');

    Route::put('upload/berita/{id}', [beritaController::class, 'update'])->name('admin.berita.update');

    Route::delete('upload/berita/{id}/delete', [beritaController::class, 'destroy'])->name('admin.berita.destroy');



    // MASTER KARTU KELUARGA

    Route::get('master_kartukeluarga', [master_kartukeluargaController::class, 'index'])->name('kartukeluarga.view');

    Route::post('master_kartukeluarga/masuk', [master_kartukeluargaController::class, 'masuk'])->name('kartukeluarga.masuk');

    Route::put('master_kartukeluarga/{no_kk}', [master_kartukeluargaController::class, 'update'])->name('kartukeluarga.update');

    Route::get('master_kartukeluarga/{no_kk}', [master_kartukeluargaController::class, 'delete'])->name('kartukeluarga.delete');

    Route::get('get-data-kk/{no_kk}', [master_kartukeluargaController::class, 'getDataKK']);



    // MASTER PENDUDUK

    Route::get('master_penduduk', [master_pendudukController::class, 'index']);

    Route::post('master_penduduk/masuk', [master_pendudukController::class, 'masuk']);

    Route::put('master_penduduk/{nik}', [master_pendudukController::class, 'update']);

    Route::get('master_penduduk/{nik}', [master_pendudukController::class, 'delete'])->name('penduduk.delete');

    Route::get('master_penduduk/cetak-draft-kk/{no_kk}', [generate::class, 'draftKK'])->name('draftkk');

    // MASTER AKUN RW

    Route::get('akunrw/create', [masterAkunRwController::class, 'create']);

    Route::get('/akunrw', [masterAkunRwController::class, 'index'])->name('akunrw');

    Route::post('akunrw/store', [masterAkunRwController::class, 'store'])->name('akunrw.store');

    Route::put('akunrw/update/{id}', [masterAkunRwController::class, 'update'])->name('akunrw.update');

    Route::delete('akunrw/{id}', [masterAkunRwController::class, 'destroy'])->name('akun.destroy');

    Route::get('get-nama-rw', [masterAkunRwController::class, 'getNamaRw']);



    // MASTER AKUN RT

    Route::get('akunrt/create', [masterAkunRtController::class, 'create']);

    Route::get('/akunrt', [masterAkunRtController::class, 'index'])->name('akunrt');

    Route::post('akunrt/store', [masterAkunRtController::class, 'store'])->name('akun.store');

    Route::put('akunrt/update/{id}', [masterAkunRtController::class, 'update'])->name('akun.update');

    Route::get('akunrt/{id_rtrw}', [masterAkunRtController::class, 'destroy'])->name('akunrt.destroy');

    Route::get('get-nama-by-nik', [masterAkunRtController::class, 'getNamaByNik']); 



    // LANDING PAGE

    Route::get('/landingpage', [landing_pageController::class, 'index'])->name('homepage.index');

    Route::post('/landingpage', [landing_pageController::class, 'update'])->name('homepage.update');



    Route::get('/suratmasuk', [SuratmasukController::class, 'index'])->name('pengajuan.masuk');

    Route::post('/suratmasuk/{id_pengajuan}/setuju', [SuratmasukController::class, 'setuju'])->name('pengajuan.setuju');

    Route::post('/suratmasuk/{id_pengajuan}/tolak', [SuratmasukController::class, 'tolak'])->name('pengajuan.tolak');

    Route::delete('/suratmasuk/{id_pengajuan}/delete', [SuratmasukController::class, 'destroy'])->name('pengajuan.hapus');
    
    Route::get('/suratmasuk/{id_pengajuan}/cetak', [generate::class, 'generateAndStorePdf']);



    Route::get('/suratditolak', [SuratditolakController::class, 'index'])->name('suratditolak.tampil');

    Route::delete('/suratditolak/{id_pengajuan}/delete', [SuratditolakController::class, 'destroy'])->name('suratditolak.hapus');



    Route::get('/suratselesai', [SuratSelesaiController::class, 'index'])->name('suratselesai.index');



    

    // MASTER SURAT

    Route::get('/mastersurat', [Master_suratController::class, 'index'])->name('mastersurat.index');

    Route::post('/mastersurat/masuk', [Master_suratController::class, 'store'])->name('mastersurat.store');

    Route::put('/mastersurat/update/{id}', [Master_suratController::class, 'update'])->name('mastersurat.update');

    Route::delete('/mastersurat/delete/{id}', [Master_suratController::class, 'destroy'])->name('mastersurat.destroy');



    Route::get('suratmasuk/{id}/cetak', [generate::class, 'generateAndStorePdf']);



    // Master Pengaduan
    Route::get('pengaduan', [MasterPengaduanController::class, 'index'])->name('master-pengaduan.index');
    Route::get('pengaduan/create', [MasterPengaduanController::class, 'create'])->name('master-pengaduan.create');
    Route::post('pengaduan', [MasterPengaduanController::class, 'store'])->name('master-pengaduan.store');
    Route::get('pengaduan/{id}', [MasterPengaduanController::class, 'show'])->name('master-pengaduan.show');
    Route::delete('pengaduan/{id}', [MasterPengaduanController::class, 'destroy'])->name('master-pengaduan.destroy');
    Route::post('/pengaduan/{id}/feedback', [MasterPengaduanController::class, 'feedback'])->name('pengaduan.feedback');
});