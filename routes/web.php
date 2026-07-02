<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PanelController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (!Auth::check()) {
        return redirect('login')->with('error', 'Anda harus login terlebih dahulu');
    } else {
        return redirect('panel');
    }
});

// Auth Controller Routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/loginproses', [AuthController::class, 'loginproses'])->name('login.proses');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// Panel Controller Routes (Protected by Auth Middleware)
Route::middleware(['auth'])->group(function () {
    // ROUTE PANEL DIARAHKAN KE DASHBOARDCONTROLLER
    Route::get('/panel', [DashboardController::class, 'index'])->name('panel.dashboard');

    // cabang
    Route::get('/panel/cabang', [PanelController::class, 'cabang'])->name('cabang.index');
    Route::post('/panel/cabangsimpan', [PanelController::class, 'cabangsimpan'])->name('cabang.simpan');
    Route::get('/panel/cabangedit/{id}', [PanelController::class, 'cabangedit'])->name('cabang.edit');
    Route::put('/panel/cabangupdate/{id}', [PanelController::class, 'cabangupdate'])->name('cabang.update');
    Route::delete('/panel/cabanghapus/{id}', [PanelController::class, 'cabanghapus'])->name('cabang.hapus');

    // pengguna
    Route::get('/panel/pengguna', [PanelController::class, 'pengguna'])->name('pengguna.index');
    Route::post('/panel/penggunasimpan', [PanelController::class, 'penggunasimpan'])->name('pengguna.simpan');
    Route::get('/panel/penggunaedit/{id}', [PanelController::class, 'penggunaedit'])->name('pengguna.edit');
    Route::put('/panel/penggunaupdate/{id}', [PanelController::class, 'penggunaupdate'])->name('pengguna.update');
    Route::delete('/panel/penggunahapus/{id}', [PanelController::class, 'penggunahapus'])->name('pengguna.hapus');

    // barang
    Route::get('/panel/barang', [PanelController::class, 'barang'])->name('barang.index');
    Route::post('/panel/barangsimpan', [PanelController::class, 'barangsimpan'])->name('barang.simpan');
    Route::get('/panel/barangedit/{id}', [PanelController::class, 'barangedit'])->name('barang.edit');
    Route::put('/panel/barangupdate/{id}', [PanelController::class, 'barangupdate'])->name('barang.update');
    Route::delete('/panel/baranghapus/{id}', [PanelController::class, 'baranghapus'])->name('barang.hapus');

    // stokgudang
    Route::get('/panel/stokgudang', [PanelController::class, 'stokgudang'])->name('stokgudang.index');
    Route::post('/panel/stokgudang/keluar', [PanelController::class, 'stokgudangkeluar'])->name('stokgudang.keluar');

    // stokmasuk
    Route::get('/panel/stokmasuk', [PanelController::class, 'stokmasuk'])->name('stokmasuk.index');
    Route::get('/panel/stokmasuktambah', [PanelController::class, 'stokmasuktambah'])->name('stokmasuk.tambah');
    Route::post('/panel/stokmasuksimpan', [PanelController::class, 'stokmasuksimpan'])->name('stokmasuk.simpan');
    Route::delete('/panel/stokmasukhapus/{id}', [PanelController::class, 'stokmasukhapus'])->name('stokmasuk.hapus');

    // stokcabang
    Route::get('/panel/stokcabang', [PanelController::class, 'stokcabang'])->name('stokcabang.index');
    Route::get('/panel/stokcabangrefresh', [PanelController::class, 'stokcabangrefresh'])->name('stokcabang.refresh');
    Route::post('/panel/stokcabang/keluar', [PanelController::class, 'stokcabangkeluar'])->name('stokcabang.keluar');

    // permintaan (Kasir & Gudang)
    Route::get('/panel/permintaan', [PanelController::class, 'permintaan'])->name('permintaan.index');
    Route::get('/panel/permintaantambah', [PanelController::class, 'permintaantambah'])->name('permintaan.tambah');
    Route::get('/panel/permintaandetail/{id}', [PanelController::class, 'permintaandetail'])->name('permintaan.detail');
    Route::post('/panel/permintaansimpan', [PanelController::class, 'permintaansimpan'])->name('permintaan.simpan');
    Route::delete('/panel/permintaanhapus/{id}', [PanelController::class, 'permintaanhapus'])->name('permintaan.hapus');
    Route::patch('/panel/permintaanstatus/{id}', [PanelController::class, 'permintaanupdatestatus'])->name('permintaan.updatestatus');

    // permintaan cabang
    Route::get('/panel/laporan/permintaancabang', [PanelController::class, 'permintaancabang'])->name('permintaancabang.index');
    Route::get('/panel/laporan/permintaancabang/detail/{id}', [PanelController::class, 'permintaancabangdetail'])->name('permintaancabang.detail');
    Route::post('/panel/laporan/permintaancabang/update-status/{id}', [PanelController::class, 'permintaancabangupdatestatus'])->name('permintaancabang.updatestatus');

    // stokkeluar
    Route::get('/panel/stokkeluar', [PanelController::class, 'stokkeluar'])->name('stokkeluar.index');
    Route::get('/panel/stokkeluartambah', [PanelController::class, 'stokkeluartambah'])->name('stokkeluar.tambah');
    Route::post('/panel/stokkeluarsimpan', [PanelController::class, 'stokkeluarsimpan'])->name('stokkeluar.simpan');
    Route::delete('/panel/stokkeluarhapus/{id}', [PanelController::class, 'stokkeluarhapus'])->name('stokkeluar.hapus');

    // profile
    Route::get('/panel/profile', [PanelController::class, 'profile'])->name('profile.index');
    Route::put('/panel/profileupdate', [PanelController::class, 'profileupdate'])->name('profile.update');

    // laporan
    Route::get('/panel/laporan/stokmasuk', [PanelController::class, 'laporanStokMasuk'])->name('laporan.stokmasuk');
    Route::get('/panel/laporan/stokkeluar', [PanelController::class, 'laporanStokKeluar'])->name('laporan.stokkeluar');
    Route::get('/panel/laporan/permintaan', [PanelController::class, 'laporanPermintaan'])->name('laporan.permintaan');

    // Cetak PDF
  Route::get('/panel/laporan/stokmasuk/pdf', [PanelController::class, 'cetakStokMasukPdf'])->name('laporan.stokmasuk.pdf');

Route::get('/panel/laporan/stokkeluar/pdf', [PanelController::class, 'cetakStokKeluarPdf'])->name('laporan.stokkeluar.pdf');
Route::get('/panel/laporan/permintaancabang/pdf', [PanelController::class, 'cetakPermintaanCabangAllPdf'])->name('laporan.permintaancabang.pdf');

    Route::get('/panel/cek-permintaan-baru', [PanelController::class, 'cekPermintaanBaru'])->name('permintaan.cekbaru');
});
