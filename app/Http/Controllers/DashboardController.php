<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\BarangModel as Barang;
use App\Models\CabangModel as Cabang;
use App\Models\User;
use App\Models\PermintaanModel as PermintaanCabang;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalcabang = Cabang::count();
        $totalbarang = Barang::count();
        $totaluser = User::count();
        $totalpermintaan = PermintaanCabang::count();

        // Mengambil total stok dari kolom 'jumlah' di tabel 'stokgudang'
        $totalstokgudang = DB::table('stokgudang')->sum('jumlah');

        $permintaanmenunggu = PermintaanCabang::where('status', 'Menunggu Konfirmasi')->count();
        $statusDiterima = PermintaanCabang::where('status', 'Diterima')->count();
        $statusDitolak = PermintaanCabang::where('status', 'Ditolak')->count();

        // Stok kritis: Join barang dengan stokgudang, filter berdasarkan kolom 'jumlah' < 10
        $stokKritis = Barang::join('stokgudang', 'barang.id', '=', 'stokgudang.barang_id')
            ->select('barang.nama', 'stokgudang.jumlah')
            ->where('stokgudang.jumlah', '<', 10)
            ->get();

        $jumlahKritis = $stokKritis->count();

        $permintaanTerbaru = PermintaanCabang::with(['cabang', 'user'])->latest()->take(5)->get();

        $topBarang = DB::table('permintaandetail')
            ->join('barang', 'permintaandetail.barang_id', '=', 'barang.id')
            ->select('barang.nama', DB::raw('SUM(permintaandetail.jumlah) as total_qty'))
            ->groupBy('barang.nama')
            ->orderBy('total_qty', 'DESC')
            ->limit(5)
            ->get();

        $labels = $topBarang->pluck('nama');
        $data = $topBarang->pluck('total_qty');

        return view('panel.dashboard', compact(
            'user', 'totalcabang', 'totalbarang', 'totaluser', 'totalpermintaan',
            'totalstokgudang', 'permintaanmenunggu', 'statusDiterima', 'statusDitolak',
            'permintaanTerbaru', 'stokKritis', 'jumlahKritis', 'labels', 'data'
        ));
    }
}
