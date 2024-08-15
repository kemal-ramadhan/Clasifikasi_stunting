<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReferensiController;
use App\Http\Controllers\KegiatanContoller;
use App\Http\Controllers\EduasiController;

use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [UserController::class, 'index'])->name('akses')->middleware('guest');
Route::post('/akses_public', [UserController::class, 'authenticate']);
Route::post('/logoutPublic', [UserController::class, 'logout']);

Route::get('/daftar', [UserController::class, 'indexDaftarAkun'])->name('daftar')->middleware('guest');
Route::post('/daftar_public', [UserController::class, 'storePengguna'])->middleware('guest');

Route::get('/home', [UserController::class, 'indexHome'])->name('home')->middleware('auth:ortu');
Route::get('/kegiatanPublic', [UserController::class, 'indexKegiatan'])->name('kegiatanPubic')->middleware('auth:ortu');
Route::get('/detail_kegiatan/{id}', [UserController::class, 'indexDetailKegiatan'])->name('detailKegiatanPubic')->middleware('auth:ortu');
Route::post('/add_antrian_pemeriksaan/{id}', [UserController::class, 'storeAntrian'])->middleware('auth:ortu');
Route::get('/hasil_pemeriksaan/{idAnak}/{idKegiatan}', [UserController::class, 'indexDetailPemeriksaan'])->name('detailPemeriksaan')->middleware('auth:ortu');
Route::get('/edukasiPublic', [UserController::class, 'indexEdukasi'])->name('edukasiPublic')->middleware('auth:ortu');
Route::get('/perkembangan', [UserController::class, 'indexPerkembangan'])->name('perkembangan')->middleware('auth:ortu');
Route::post('/c_anakPublic', [UserController::class, 'storeAnak'])->middleware('auth:ortu');
Route::get('/detail_perkembangan/{id}', [UserController::class, 'indexDetailPerkembangan'])->name('detailPerkembangan')->middleware('auth:ortu');
Route::get('/profile', [UserController::class, 'indexProfile'])->name('profile')->middleware('auth:ortu');
Route::post('/u_ortuPublic', [UserController::class, 'updateProfile'])->middleware('auth:ortu');
Route::get('/detail_anak/{id}', [UserController::class, 'indexDetailAnak'])->name('detailAnak')->middleware('auth:ortu');
Route::post('/u_anakPublic', [UserController::class, 'updateAnak'])->middleware('auth:ortu');

// admin
Route::get('/administrator', [AdminController::class, 'akses'])->name('administrator')->middleware('guest');
Route::post('/akses_admin', [AdminController::class, 'authenticate']);
Route::post('/logout', [AdminController::class, 'logout']);


Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard')->middleware('auth:admin');

// data referensi
Route::get('/ref-puskesmas-tempat', [ReferensiController::class, 'indexPuskesmas'])->name('refTempatPuskesmas')->middleware('auth:admin');
Route::post('/c_puskesmas', [ReferensiController::class, 'storePuskesmas']);
Route::get('/d_puskesmas/{id}', [ReferensiController::class, 'detailPuskesmas'])->name('refDetailPuskesmas')->middleware('auth:admin');
Route::post('/u_puskesmas', [ReferensiController::class, 'updatePuskesmas']);

Route::get('/d_posyandu/{id}', [ReferensiController::class, 'detailPosyandu'])->name('refDetailPosyandu')->middleware('auth:admin');
Route::post('/u_posyandu', [ReferensiController::class, 'updatePosyandu']);

Route::get('/ref-posyandu', [ReferensiController::class, 'indexPosyandu'])->name('refPosyandu')->middleware('auth:admin');
Route::post('/c_posyandu', [ReferensiController::class, 'storePosyandu']);

Route::post('/c_person', [ReferensiController::class, 'storePetugas']);
Route::get('/d_petugas/{id}', [ReferensiController::class, 'DetailPetugas'])->name('detailPetugas')->middleware('auth:admin');
Route::post('/u_person', [ReferensiController::class, 'updatePerson']);

Route::get('/ref-kelurahan', [ReferensiController::class, 'indexKelurahan'])->name('refKelurahan')->middleware('auth:admin');
Route::get('/ref-puskesmas', [ReferensiController::class, 'indexPuskesmasPerson'])->name('refPuskesmas')->middleware('auth:admin');
Route::get('/ref-kader', [ReferensiController::class, 'indexKaderPerson'])->name('refKader')->middleware('auth:admin');

// referensi pasien
Route::get('/ref-kb', [ReferensiController::class, 'indexKb'])->name('refKb')->middleware('auth:admin');
Route::get('/d_kb/{id}', [ReferensiController::class, 'detailKb'])->name('refDetailKb')->middleware('auth:admin');
Route::post('/c_kb', [ReferensiController::class, 'storeKb']);
Route::post('/u_kb', [ReferensiController::class, 'updateKb']);

// ref Orang Tua Wali
Route::get('/ref-ortu', [ReferensiController::class, 'indexOrtu'])->name('refOrtu')->middleware('auth:admin');
Route::get('/d_ortu/{id}', [ReferensiController::class, 'detailOrtu'])->name('refDetailOrtu')->middleware('auth:admin');
Route::post('/c_ortu', [ReferensiController::class, 'storeOrtu']);
Route::post('/u_ortu', [ReferensiController::class, 'updateOrtu']);

// anak
Route::get('/ref-anak', [ReferensiController::class, 'indexAnak'])->name('refAnak')->middleware('auth:admin');
Route::get('/d_anak/{id}', [ReferensiController::class, 'detailAnak'])->name('refDetailAnak')->middleware('auth:admin');
Route::post('/c_anak', [ReferensiController::class, 'storeAnak']);
Route::post('/u_anak', [ReferensiController::class, 'updateAnak']);

// kegiatan
Route::get('/kegiatan', [KegiatanContoller::class, 'indexKegiatan'])->name('kegiatan')->middleware('auth:admin');
Route::get('/e_kegiatan/{id}', [KegiatanContoller::class, 'editKegiatan'])->name('editKegiatan')->middleware('auth:admin');
Route::post('/c_kegiatan', [KegiatanContoller::class, 'storeKegiatan']);
Route::post('/u_kegiatan', [KegiatanContoller::class, 'updateKegiatan']);

Route::get('/d_kegiatan/{id}', [KegiatanContoller::class, 'detailKegiatan'])->name('detailKegiatan')->middleware('auth:admin');
Route::post('/c_antrian_kegiatan', [KegiatanContoller::class, 'storeAntrian']);

Route::get('/pemeriksaan/{id}', [KegiatanContoller::class, 'indexPemeriksaan'])->name('Pemeriksaan')->middleware('auth:admin');
Route::post('/c_pemeriksaan', [KegiatanContoller::class, 'storePemeriksaan']);
Route::post('/update_pemeriksaan', [KegiatanContoller::class, 'UpdatePemeriksaan']);

Route::get('/reportAnak/{id}', [KegiatanContoller::class, 'indexReportAnak'])->name('reportAnak')->middleware('auth:admin');
Route::get('/detail_pemeriksaan/{id}', [KegiatanContoller::class, 'detailReportAnak'])->name('detailReportAnak')->middleware('auth:admin');

Route::get('/riwayat', [KegiatanContoller::class, 'indexRiwayat'])->name('riwayat')->middleware('auth:admin');
Route::get('/d_riwayat_kegiatan/{id}', [KegiatanContoller::class, 'showDetailRiwayat'])->name('detailriwayat')->middleware('auth:admin');
Route::post('/exportKegiatan', [KegiatanContoller::class, 'exportPdf'])->name('exportPdf')->middleware('auth:admin');

// edukasi
Route::get('/edukasi', [EduasiController::class, 'indexEdukasi'])->name('edukasi')->middleware('auth:admin');
Route::post('/add_edukasi', [EduasiController::class, 'storeEdukasi']);
Route::get('/del_edukasi/{id}', [EduasiController::class, 'destroyEdukasi'])->middleware('auth:admin');

// training
Route::get('/training', [EduasiController::class, 'indexTraining'])->name('training')->middleware('auth:admin');
Route::post('/c_training', [EduasiController::class, 'storeTraining']);
Route::post('/update_training', [EduasiController::class, 'updateTraining']);
Route::get('/d_training/{id}', [EduasiController::class, 'destroyTraining'])->middleware('auth:admin');
Route::get('/e_training/{id}', [EduasiController::class, 'showTraining'])->middleware('auth:admin');