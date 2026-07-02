<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\CabangModel;
use App\Models\PermintaandetailModel;
use App\Models\PermintaanModel;
use App\Models\StokcabangModel;
use App\Models\StokgudangModel;
use App\Models\StokkeluardetailModel;
use App\Models\StokkeluarModel;
use App\Models\StokmasukdetailModel;
use App\Models\StokmasukModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PanelController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $totalcabang     = CabangModel::count();
        $totalbarang     = BarangModel::count();
        $totaluser       = User::count();
        $totalpermintaan = PermintaanModel::count();

        $totalstokgudang = StokgudangModel::sum('jumlah');
        $totalstokcabang = StokcabangModel::sum('jumlah');
        $stokmasuk       = StokmasukdetailModel::sum('jumlah');

        $permintaanmenunggu = PermintaanModel::where('status', 'Menunggu Konfirmasi')->count();
        $statusDiterima     = PermintaanModel::where('status', 'Diterima')->count();
        $statusDitolak      = PermintaanModel::where('status', 'Ditolak')->count();

        $stokKritis = StokgudangModel::with(['barang'])
            ->whereHas('barang', function($query) {
                $query->whereColumn('stokgudang.jumlah', '<=', 'barang.stok_minimum');
            })
            ->get();

        $jumlahKritis = $stokKritis->count();

        $permintaanTerbaru = PermintaanModel::with(['cabang', 'user'])
                            ->latest()
                            ->take(5)
                            ->get();

        return view('panel.dashboard', compact(
            'user', 'totalcabang', 'totalbarang', 'totaluser', 'totalpermintaan',
            'totalstokgudang', 'totalstokcabang', 'stokmasuk', 'permintaanmenunggu',
            'statusDiterima', 'statusDitolak', 'permintaanTerbaru', 'stokKritis', 'jumlahKritis'
        ));
    }

    // cabang
    public function cabang()
    {
        $data['cabang'] = CabangModel::orderBy('id', 'DESC')->get();
        return view('panel.cabang', $data);
    }

    public function cabangsimpan(Request $request)
    {
        $request->validate(['nama' => 'required|string|max:255']);
        CabangModel::create(['nama' => $request->nama]);
        return redirect('panel/cabang')->with('success', 'Data cabang berhasil disimpan');
    }

    public function cabangedit($id)
    {
        $data['cabang'] = CabangModel::findOrFail($id);
        return view('panel.cabangedit', $data);
    }

    public function cabangupdate(Request $request, $id)
    {
        $request->validate(['nama' => 'required|string|max:255']);
        $cabang = CabangModel::findOrFail($id);
        $cabang->update(['nama' => $request->nama]);
        return redirect('panel/cabang')->with('success', 'Data cabang berhasil diupdate');
    }

    public function cabanghapus($id)
    {
        CabangModel::findOrFail($id)->delete();
        return redirect('panel/cabang')->with('success', 'Data cabang berhasil dihapus');
    }

    // pengguna
    public function pengguna()
    {
        $data['pengguna'] = User::with(['cabang'])->where('role', '!=', 'Admin')->orderBy('id', 'DESC')->get();
        $data['cabang']   = CabangModel::all();
        return view('panel.pengguna', $data);
    }

    public function penggunasimpan(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:3|confirmed',
            'role'      => 'required|in:Kasir,Gudang',
            'cabang_id' => 'required_if:role,Kasir|nullable|exists:cabang,id',
        ]);

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => $request->role,
            'cabang_id' => $request->role == 'Kasir' ? $request->cabang_id : null,
        ]);

        return redirect('panel/pengguna')->with('success', 'Data pengguna berhasil disimpan');
    }

    public function penggunaedit($id)
    {
        $data['pengguna'] = User::findOrFail($id);
        $data['cabang']   = CabangModel::all();
        return view('panel.penggunaedit', $data);
    }

    public function penggunaupdate(Request $request, $id)
    {
        $pengguna = User::findOrFail($id);

        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users,email,' . $pengguna->id,
            'password'  => 'nullable|string|min:3|confirmed',
            'role'      => 'required|in:Kasir,Gudang',
            'cabang_id' => 'required_if:role,Kasir|nullable|exists:cabang,id',
        ]);

        $input = [
            'name'      => $request->name,
            'email'     => $request->email,
            'role'      => $request->role,
            'cabang_id' => $request->role == 'Kasir' ? $request->cabang_id : null,
        ];

        if ($request->filled('password')) {
            $input['password'] = Hash::make($request->password);
        }

        $pengguna->update($input);
        return redirect('panel/pengguna')->with('success', 'Data pengguna berhasil diupdate');
    }

    public function penggunahapus($id)
    {
        User::findOrFail($id)->delete();
        return redirect('panel/pengguna')->with('success', 'Data pengguna berhasil dihapus');
    }

    // barang
    public function barang()
    {
        $data['barang'] = BarangModel::orderBy('id', 'DESC')->get();
        return view('panel.barang', $data);
    }

    public function barangsimpan(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'satuan'   => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $barang = BarangModel::create([
                'nama'     => $request->nama,
                'kategori' => $request->kategori,
                'satuan'   => $request->satuan,
            ]);

            $barang->update(['kodebarang' => 'BRG' . str_pad($barang->id, 5, '0', STR_PAD_LEFT)]);

            StokgudangModel::create(['barang_id' => $barang->id, 'jumlah' => 0]);

            $this->stokcabangrefresh();
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data barang: ' . $e->getMessage());
        }

        return redirect('panel/barang')->with('success', 'Data barang berhasil disimpan');
    }

    private function stokcabangrefresh()
    {
        $barang = BarangModel::all();
        $cabang = CabangModel::all();

        foreach ($cabang as $cbg) {
            foreach ($barang as $brg) {
                StokcabangModel::firstOrCreate(
                    ['cabang_id' => $cbg->id, 'barang_id' => $brg->id],
                    ['jumlah' => 0]
                );
            }
        }
    }

    public function barangedit($id)
    {
        $data['barang'] = BarangModel::findOrFail($id);
        return view('panel.barangedit', $data);
    }

    public function barangupdate(Request $request, $id)
    {
        $barang = BarangModel::findOrFail($id);

        $request->validate([
            'nama'     => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'satuan'   => 'required|string|max:255',
        ]);

        $barang->update([
            'nama'     => $request->nama,
            'kategori' => $request->kategori,
            'satuan'   => $request->satuan,
        ]);

        return redirect('panel/barang')->with('success', 'Data barang berhasil diupdate');
    }

    public function baranghapus($id)
    {
        $barang = BarangModel::findOrFail($id);
        StokgudangModel::where('barang_id', $barang->id)->delete();
        StokcabangModel::where('barang_id', $barang->id)->delete();
        $barang->delete();
        return redirect('panel/barang')->with('success', 'Data barang berhasil dihapus');
    }

    // stokgudang
    public function stokgudang()
    {
        $data['stokgudang'] = StokgudangModel::with(['barang'])->orderBy('id', 'DESC')->get();
        return view('panel.stokgudang', $data);
    }

    public function stokgudangkeluar(Request $request)
    {
        $request->validate([
            'stokgudang_id' => 'required',
            'jumlah'        => 'required|integer|min:1',
            'catatan'       => 'required|string',
        ]);

        $stokGudang = StokgudangModel::findOrFail($request->stokgudang_id);

        if ($stokGudang->jumlah < $request->jumlah) {
            return redirect()->back()->with('error', 'Jumlah pengeluaran melebihi stok yang tersedia di gudang!');
        }

        DB::beginTransaction();

        try {
            $hariIni      = Carbon::now()->format('Ymd');
            $hitungKeluar = StokkeluarModel::whereDate('created_at', Carbon::today())->count() + 1;
            $kodeKeluar   = 'SK-' . $hariIni . '-' . str_pad($hitungKeluar, 4, '0', STR_PAD_LEFT);

            $stokKeluar             = new StokkeluarModel();
            $stokKeluar->kodekeluar = $kodeKeluar;
            $stokKeluar->cabang_id  = null;
            $stokKeluar->user_id    = Auth::id();
            $stokKeluar->catatan    = $request->catatan;
            $stokKeluar->save();

            $detail                = new StokkeluardetailModel();
            $detail->stokkeluar_id = $stokKeluar->id;
            $detail->barang_id     = $stokGudang->barang_id;
            $detail->jumlah        = $request->jumlah;
            $detail->save();

            $stokGudang->jumlah -= $request->jumlah;
            $stokGudang->save();

            DB::commit();
            return redirect()->back()->with('success', 'Stok gudang berhasil dikurangi dan tercatat di laporan.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    // stokmasuk
    public function stokmasuk()
    {
        $data['stokmasuk'] = StokmasukModel::with(['stokmasukdetail.stokgudang.barang'])->latest()->get();
        return view('panel.stokmasuk', $data);
    }

    public function stokmasuktambah()
    {
        $data['stokgudang'] = StokgudangModel::with('barang')->orderBy('id', 'ASC')->get();
        return view('panel.stokmasuktambah', $data);
    }

    public function stokmasuksimpan(Request $request)
    {
        $request->validate([
            'stokgudang_id'   => 'required|array',
            'stokgudang_id.*' => 'required|exists:stokgudang,id',
            'jumlah'          => 'required|array',
            'jumlah.*'        => 'required|numeric|min:1',
        ]);

        DB::beginTransaction();

        try {
            $stokmasuk = StokmasukModel::create(['kodemasuk' => 'SM' . date('YmdHis')]);

            foreach ($request->stokgudang_id as $key => $stokgudang_id) {
                $jumlah = $request->jumlah[$key];
                StokmasukdetailModel::create([
                    'stokmasuk_id'  => $stokmasuk->id,
                    'stokgudang_id' => $stokgudang_id,
                    'jumlah'        => $jumlah,
                ]);
                $stokgudang = StokgudangModel::find($stokgudang_id);
                $stokgudang->increment('jumlah', $jumlah);
            }

            DB::commit();
            return redirect('panel/stokmasuk')->with('success', 'Data stok masuk berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function stokmasukhapus($id)
    {
        $stokmasuk = StokmasukModel::findOrFail($id);

        DB::beginTransaction();

        try {
            foreach ($stokmasuk->stokmasukdetail as $detail) {
                $stokgudang = StokgudangModel::find($detail->stokgudang_id);
                if ($stokgudang) {
                    $stokgudang->decrement('jumlah', $detail->jumlah);
                }
            }

            $stokmasuk->delete();
            DB::commit();
            return redirect('panel/stokmasuk')->with('success', 'Data stok masuk berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    // stokcabang
    public function stokcabang(Request $request)
    {
        if (Auth::user()->role == 'Admin') {
            $data['cabang'] = CabangModel::orderBy('nama')->get();

            if ($request->filled('cabang_id')) {
                $data['stokcabang'] = StokcabangModel::with(['cabang', 'barang'])
                    ->where('cabang_id', $request->cabang_id)
                    ->orderBy('id', 'DESC')
                    ->get();
            } else {
                $data['stokcabang'] = collect();
            }
        } else {
            $data['stokcabang'] = StokcabangModel::with(['cabang', 'barang'])
                ->where('cabang_id', Auth::user()->cabang_id)
                ->orderBy('id', 'DESC')
                ->get();
        }

        return view('panel.stokcabang', $data);
    }

    public function stokcabangkeluar(Request $request)
    {
        $request->validate([
            'stokcabang_id' => 'required',
            'jumlah'        => 'required|integer|min:1',
            'catatan'       => 'required|string|max:255'
        ]);

        $stokCabang = StokcabangModel::findOrFail($request->stokcabang_id);

        if ((int)$request->jumlah > (int)$stokCabang->jumlah) {
            return redirect()->back()->with('error', 'Gagal! Jumlah pengeluaran melebihi sisa stok yang tersedia.');
        }

        DB::beginTransaction();

        try {
            $stokCabang->jumlah -= $request->jumlah;
            $stokCabang->save();

            $hariIni      = Carbon::now()->format('Ymd');
            $hitungKeluar = StokkeluarModel::whereDate('created_at', Carbon::today())->count() + 1;
            $kodeKeluar   = 'SK' . $hariIni . str_pad($hitungKeluar, 4, '0', STR_PAD_LEFT);

            $stokKeluar = StokkeluarModel::create([
                'cabang_id'  => Auth::user()->cabang_id ?? $stokCabang->cabang_id,
                'user_id'    => Auth::id(),
                'kodekeluar' => $kodeKeluar,
                'catatan'    => 'Dikurangi Kasir via Modal: ' . $request->catatan,
            ]);

            StokkeluardetailModel::create([
                'stokkeluar_id' => $stokKeluar->id,
                'stokcabang_id' => $stokCabang->id,
                'barang_id'     => $stokCabang->barang_id,
                'jumlah'        => $request->jumlah,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Stok berhasil dikurangi dan tercatat di laporan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    // ================= PERMINTAAN KASIR & GUDANG (DI FOLDER PANEL) =================
    public function permintaan()
    {
        if (Auth::user()->role == 'Gudang' || Auth::user()->role == 'Admin') {
            $data['permintaan'] = PermintaanModel::with(['cabang', 'user', 'permintaandetail', 'permintaandetail.barang'])
                ->orderBy('id', 'DESC')->get();
        } else {
            $data['permintaan'] = PermintaanModel::with(['cabang', 'permintaandetail', 'permintaandetail.barang'])
                ->where('cabang_id', Auth::user()->cabang_id)
                ->where('user_id', Auth::user()->id)
                ->orderBy('id', 'DESC')->get();
        }

        return view('panel.permintaan', $data);
    }

    public function permintaantambah()
    {
        $data['barang'] = BarangModel::orderBy('nama', 'ASC')->get();
        return view('panel.permintaantambah', $data);
    }

    public function permintaansimpan(Request $request)
    {
        $request->validate([
            'barang_id'   => 'required|array',
            'barang_id.*' => 'required|exists:barang,id',
            'jumlah'      => 'required|array',
            'jumlah.*'    => 'required|numeric|min:1',
            'catatan'     => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            foreach ($request->barang_id as $key => $barang_id) {
                $stokgudang = StokgudangModel::where('barang_id', $barang_id)->first();

                if (!$stokgudang) {
                    DB::rollBack();
                    return back()->with('error', 'Stok barang tidak ditemukan di gudang.');
                }

                if ($request->jumlah[$key] > $stokgudang->jumlah) {
                    DB::rollBack();
                    return back()->with('error', 'Stok barang ' . $stokgudang->barang->nama . ' tidak mencukupi di gudang. Stok tersedia: ' . $stokgudang->jumlah);
                }
            }

            $permintaan = PermintaanModel::create([
                'cabang_id' => Auth::user()->cabang_id,
                'user_id'   => Auth::id(),
                'status'    => 'Menunggu Konfirmasi',
                'catatan'   => $request->catatan,
            ]);

            foreach ($request->barang_id as $key => $barang_id) {
                PermintaandetailModel::create([
                    'permintaan_id' => $permintaan->id,
                    'barang_id'     => $barang_id,
                    'jumlah'        => $request->jumlah[$key],
                ]);
            }

            DB::commit();
            return redirect('panel/permintaan')->with('success', 'Permintaan berhasil dikirim');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function permintaandetail($id)
    {
        $data['permintaan'] = PermintaanModel::with([
            'cabang', 'user', 'permintaandetail', 'permintaandetail.barang'
        ])->findOrFail($id);

        return view('panel.permintaandetail', $data);
    }

    public function permintaanupdatestatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:Diterima,Ditolak']);

        \DB::beginTransaction();

        try {
            $permintaan = \App\Models\PermintaanModel::with(['permintaandetail.barang'])->findOrFail($id);

            if ($permintaan->status != 'Menunggu Konfirmasi') {
                return back()->with('error', 'Permintaan sudah diproses sebelumnya.');
            }

            if ($request->status == 'Diterima') {

                $hariIni      = Carbon::now()->format('Ymd');
                $hitungKeluar = \App\Models\StokkeluarModel::whereDate('created_at', Carbon::today())->count() + 1;
                $kodeKeluar   = 'SK-' . $hariIni . '-' . str_pad($hitungKeluar, 4, '0', STR_PAD_LEFT);

                $stokKeluar = \App\Models\StokkeluarModel::create([
                    'kodekeluar' => $kodeKeluar,
                    'cabang_id'  => $permintaan->cabang_id,
                    'user_id'    => Auth::id(),
                    'catatan'    => 'Pengeluaran otomatis dari permintaan disetujui (ID Permintaan: ' . $permintaan->id . ')',
                ]);

                foreach ($permintaan->permintaandetail as $detail) {
                    $stokGudang = \App\Models\StokgudangModel::where('barang_id', $detail->barang_id)->lockForUpdate()->first();
                    $namaBarang = $detail->barang->nama ?? 'ID Barang: ' . $detail->barang_id;

                    if (!$stokGudang) {
                        throw new \Exception("Stok gudang untuk barang [{$namaBarang}] tidak ditemukan di master data.");
                    }

                    if ($stokGudang->jumlah < $detail->jumlah) {
                        throw new \Exception("Stok gudang untuk barang [{$namaBarang}] tidak mencukupi. Sisa stok: {$stokGudang->jumlah}, diminta: {$detail->jumlah}.");
                    }

                    $stokGudang->decrement('jumlah', $detail->jumlah);

                    $stokCabang = \App\Models\StokcabangModel::firstOrCreate(
                        ['cabang_id' => $permintaan->cabang_id, 'barang_id' => $detail->barang_id],
                        ['jumlah' => 0]
                    );
                    $stokCabang->increment('jumlah', $detail->jumlah);

                    \App\Models\StokkeluardetailModel::create([
                        'stokkeluar_id' => $stokKeluar->id,
                        'stokcabang_id' => null,
                        'barang_id'     => $detail->barang_id,
                        'jumlah'        => $detail->jumlah,
                    ]);
                }
            }

            $permintaan->update(['status' => $request->status]);
            \DB::commit();

            return redirect('panel/permintaan')->with('success', 'Status permintaan berhasil diperbarui menjadi ' . $request->status);

        } catch (\Exception $e) {
            \DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function permintaanhapus($id)
    {
        $permintaan = PermintaanModel::findOrFail($id);

        if ($permintaan->status == 'Diterima') {
            return back()->with('error', 'Permintaan yang sudah diterima tidak bisa dihapus');
        }

        $permintaan->delete();
        return redirect('panel/permintaan')->with('success', 'Data permintaan berhasil dihapus');
    }

    // ================= PERMINTAAN CABANG ADMIN (DI FOLDER LAPORAN) =================
    public function permintaancabang(Request $request)
    {
        if (Auth::user()->role != 'Admin') {
            abort(403, 'Unauthorized action.');
        }

        $query = PermintaanModel::with(['cabang', 'user', 'permintaandetail.barang']);

        if ($request->filled('cabang_id')) {
            $query->where('cabang_id', $request->cabang_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('created_at', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('created_at', '<=', $request->tanggal_akhir);
        }

        $data['permintaan'] = $query->orderBy('id', 'DESC')->get();
        $data['cabang']     = CabangModel::orderBy('nama', 'ASC')->get();

        return view('panel.laporan.permintaancabang', $data);
    }

    public function permintaancabangdetail($id)
    {
        if (Auth::user()->role != 'Admin') {
            abort(403, 'Unauthorized action.');
        }

        $data['permintaan'] = PermintaanModel::with([
            'cabang', 'user', 'permintaandetail', 'permintaandetail.barang'
        ])->findOrFail($id);

        return view('panel.laporan.permintaancabangdetail', $data);
    }

    public function permintaancabangupdatestatus(Request $request, $id)
    {
        if (Auth::user()->role != 'Admin') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate(['status' => 'required|in:Diterima,Ditolak']);

        DB::beginTransaction();

        try {
            $permintaan = PermintaanModel::with(['permintaandetail'])->findOrFail($id);

            if ($permintaan->status != 'Menunggu Konfirmasi') {
                return back()->with('error', 'Permintaan cabang ini sudah diproses sebelumnya.');
            }

            if ($request->status == 'Diterima') {

                $hariIni      = Carbon::now()->format('Ymd');
                $hitungKeluar = StokkeluarModel::whereDate('created_at', Carbon::today())->count() + 1;
                $kodeKeluar   = 'SK-' . $hariIni . '-' . str_pad($hitungKeluar, 4, '0', STR_PAD_LEFT);

                $stokKeluar = StokkeluarModel::create([
                    'kodekeluar' => $kodeKeluar,
                    'cabang_id'  => $permintaan->cabang_id,
                    'user_id'    => Auth::id(),
                    'catatan'    => 'Pengeluaran otomatis (Admin) dari permintaan disetujui (ID Permintaan: ' . $permintaan->id . ')',
                ]);

                foreach ($permintaan->permintaandetail as $detail) {
                    $stokGudang = StokgudangModel::where('barang_id', $detail->barang_id)->lockForUpdate()->first();

                    if (!$stokGudang) {
                        throw new \Exception('Stok gudang pusat untuk barang ini tidak ditemukan.');
                    }

                    if ($stokGudang->jumlah < $detail->jumlah) {
                        throw new \Exception('Stok gudang pusat tidak mencukupi untuk memenuhi permintaan barang: ' . $stokGudang->barang->nama);
                    }

                    $stokGudang->decrement('jumlah', $detail->jumlah);

                    $stokCabang = StokcabangModel::firstOrCreate(
                        ['cabang_id' => $permintaan->cabang_id, 'barang_id' => $detail->barang_id],
                        ['jumlah' => 0]
                    );
                    $stokCabang->increment('jumlah', $detail->jumlah);

                    StokkeluardetailModel::create([
                        'stokkeluar_id' => $stokKeluar->id,
                        'stokcabang_id' => null,
                        'barang_id'     => $detail->barang_id,
                        'jumlah'        => $detail->jumlah,
                    ]);
                }
            }

            $permintaan->update(['status' => $request->status]);
            DB::commit();

            return redirect()->route('permintaancabang.index')->with('success', 'Status permintaan cabang berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    // stokkeluar
    public function stokkeluar()
    {
        $data['stokkeluar'] = StokkeluarModel::with(['cabang', 'user', 'stokkeluardetail.barang'])
            ->orderBy('id', 'DESC')->get();

        return view('panel.stokkeluar', $data);
    }

    public function stokkeluartambah()
    {
        $data['stokcabang'] = StokcabangModel::with('barang')
            ->where('cabang_id', Auth::user()->cabang_id)
            ->orderBy('id', 'ASC')->get();

        return view('panel.stokkeluartambah', $data);
    }

    public function stokkeluarsimpan(Request $request)
    {
        $request->validate([
            'stokcabang_id'   => 'required|array',
            'stokcabang_id.*' => 'required|exists:stokcabang,id',
            'jumlah'          => 'required|array',
            'jumlah.*'        => 'required|numeric|min:1',
            'catatan'         => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            foreach ($request->stokcabang_id as $key => $stokcabang_id) {
                $stokcabang = StokcabangModel::where('id', $stokcabang_id)
                    ->where('cabang_id', Auth::user()->cabang_id)->first();

                if (!$stokcabang) {
                    throw new \Exception('Stok cabang tidak ditemukan atau Anda tidak memiliki akses ke cabang ini.');
                }

                if ($request->jumlah[$key] > $stokcabang->jumlah) {
                    throw new \Exception('Stok ' . $stokcabang->barang->nama . ' tidak mencukupi. Stok tersedia: ' . $stokcabang->jumlah . ' ' . $stokcabang->barang->satuan);
                }
            }

            $stokkeluar = StokkeluarModel::create([
                'cabang_id'  => Auth::user()->cabang_id,
                'user_id'    => Auth::id(),
                'kodekeluar' => 'SK' . date('YmdHis'),
                'catatan'    => $request->catatan,
            ]);

            foreach ($request->stokcabang_id as $key => $stokcabang_id) {
                $jumlah     = $request->jumlah[$key];
                $stokcabang = StokcabangModel::find($stokcabang_id);

                StokkeluardetailModel::create([
                    'stokkeluar_id' => $stokkeluar->id,
                    'stokcabang_id' => $stokcabang_id,
                    'barang_id'     => $stokcabang->barang_id,
                    'jumlah'        => $jumlah,
                ]);

                $stokcabang->decrement('jumlah', $jumlah);
            }

            DB::commit();
            return redirect('panel/stokkeluar')->with('success', 'Data stok keluar berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function stokkeluarhapus($id)
    {
        $stokkeluar = StokkeluarModel::findOrFail($id);

        DB::beginTransaction();

        try {
            foreach ($stokkeluar->stokkeluardetail as $detail) {
                if ($detail->stokcabang_id) {
                    StokcabangModel::where('id', $detail->stokcabang_id)->increment('jumlah', $detail->jumlah);
                } else {
                    StokgudangModel::where('barang_id', $detail->barang_id)->increment('jumlah', $detail->jumlah);
                }
            }

            $stokkeluar->delete();
            DB::commit();
            return redirect('panel/stokkeluar')->with('success', 'Data stok keluar berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    // profile
    public function profile()
    {
        $data['profile'] = User::where('id', Auth::id())->first();
        return view('panel.profile', $data);
    }

    public function profileupdate(Request $request)
    {
        $profile = User::findOrFail(Auth::id());

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $profile->id,
            'password' => 'nullable|string|min:3',
        ]);

        $input = ['name' => $request->name, 'email' => $request->email];

        if ($request->filled('password')) {
            $input['password'] = Hash::make($request->password);
        }

        $profile->update($input);
        return redirect('panel/profile')->with('success', 'Profile berhasil diupdate');
    }

    // Laporan Keseluruhan
    public function laporanStokMasuk(Request $request)
    {
        if (!in_array(Auth::user()->role, ['Admin', 'Gudang'])) {
            abort(403, 'Unauthorized action.');
        }

        $query = StokmasukModel::with(['stokmasukdetail.stokgudang.barang']);

        if ($request->filled('tgl_mulai') && $request->filled('tgl_selesai')) {
            $query->whereBetween(DB::raw('DATE(created_at)'), [$request->tgl_mulai, $request->tgl_selesai]);
        }

        $data['stokmasuk'] = $query->latest()->get();
        return view('panel.laporan.stokmasuk', $data);
    }

    // ===================== UPDATED: laporanStokKeluar =====================
    public function laporanStokKeluar(Request $request)
    {
        $query = StokkeluarModel::with(['cabang', 'user', 'stokkeluardetail.barang']);

        // Role Kasir hanya bisa lihat cabangnya sendiri, tidak bisa pilih cabang lain
        if (Auth::user()->role == 'Kasir') {
            $query->where('cabang_id', Auth::user()->cabang_id);
        } else {
            // Admin/Gudang bisa filter cabang secara manual
            if ($request->filled('cabang_id')) {
                $query->where('cabang_id', $request->cabang_id);
            }
        }

        if ($request->filled('tgl_mulai') && $request->filled('tgl_selesai')) {
            $query->whereBetween(DB::raw('DATE(created_at)'), [$request->tgl_mulai, $request->tgl_selesai]);
        }

        $data['stokkeluar'] = $query->latest()->get();
        $data['cabang']     = CabangModel::orderBy('nama', 'ASC')->get();

        return view('panel.laporan.stokkeluar', $data);
    }

    public function laporanPermintaan(Request $request)
    {
        $query = PermintaanModel::with(['cabang', 'user', 'permintaandetail.barang']);

        if (Auth::user()->role == 'Kasir') {
            $query->where('cabang_id', Auth::user()->cabang_id);
        }

        if ($request->filled('tgl_mulai') && $request->filled('tgl_selesai')) {
            $query->whereBetween(DB::raw('DATE(created_at)'), [$request->tgl_mulai, $request->tgl_selesai]);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $data['permintaan'] = $query->latest()->get();
        return view('panel.laporan.permintaan', $data);
    }

    public function cetakStokMasukPdf(Request $request)
    {
        $query = \App\Models\StokMasukModel::with(['stokmasukdetail.stokgudang.barang']);

        if ($request->filled('tgl_mulai') && $request->filled('tgl_selesai')) {
            $query->whereBetween('created_at', [
                $request->tgl_mulai . ' 00:00:00',
                $request->tgl_selesai . ' 23:59:59'
            ]);
            $periode = Carbon::parse($request->tgl_mulai)->translatedFormat('d F Y')
                     . ' s/d '
                     . Carbon::parse($request->tgl_selesai)->translatedFormat('d F Y');
        } else {
            $periode = 'Semua Periode';
        }

        $data['periode']   = $periode;
        $data['stokmasuk'] = $query->orderBy('id', 'DESC')->get();

        if ($data['stokmasuk']->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data stok masuk pada periode yang dipilih untuk dicetak.');
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('panel.laporan.stokmasuk_pdf', $data)->setPaper('a4', 'portrait');
        return $pdf->stream('Laporan_Stok_Masuk_' . date('Ymd') . '.pdf');
    }

    // ===================== UPDATED: cetakStokKeluarPdf =====================
    public function cetakStokKeluarPdf(Request $request)
    {
        $query = StokkeluarModel::with(['cabang', 'user', 'stokkeluardetail.barang']);

        // Role Kasir hanya bisa cetak cabangnya sendiri
        if (Auth::user()->role == 'Kasir') {
            $query->where('cabang_id', Auth::user()->cabang_id);
        } else {
            if ($request->filled('cabang_id')) {
                $query->where('cabang_id', $request->cabang_id);
            }
        }

        if ($request->filled('tgl_mulai') && $request->filled('tgl_selesai')) {
            $query->whereBetween('created_at', [
                $request->tgl_mulai . ' 00:00:00',
                $request->tgl_selesai . ' 23:59:59'
            ]);
        }

        $stokkeluar = $query->orderBy('id', 'DESC')->get();

        if ($stokkeluar->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data pada periode yang dipilih.');
        }

        // Buat string periode
        if ($request->filled('tgl_mulai') && $request->filled('tgl_selesai')) {
            $periode = Carbon::parse($request->tgl_mulai)->translatedFormat('d F Y')
                     . ' s/d '
                     . Carbon::parse($request->tgl_selesai)->translatedFormat('d F Y');
        } else {
            $periode = 'Semua Periode';
        }

        // Nama cabang filter untuk keterangan di PDF
        $namaCabang = 'Semua Cabang';
        if (Auth::user()->role == 'Kasir') {
            $namaCabang = Auth::user()->cabang->nama ?? 'Cabang Saya';
        } elseif ($request->filled('cabang_id')) {
            $cabangTerpilih = CabangModel::find($request->cabang_id);
            $namaCabang     = $cabangTerpilih->nama ?? 'Semua Cabang';
        }

        $data = [
            'stokkeluar' => $stokkeluar,
            'periode'    => $periode,
            'namaCabang' => $namaCabang,
        ];

        $pdf = Pdf::loadView('panel.laporan.stokkeluar_pdf', $data)->setPaper('a4', 'portrait');
        return $pdf->stream('Laporan_Stok_Keluar_' . date('Ymd') . '.pdf');
    }

    public function cetakPermintaanCabangAllPdf(Request $request)
    {
        $query = \App\Models\PermintaanModel::with(['cabang', 'user', 'permintaandetail.barang']);

        if ($request->filled('cabang_id')) {
            $query->where('cabang_id', $request->cabang_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('created_at', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('created_at', '<=', $request->tanggal_akhir);
        }

        $permintaan = $query->orderBy('id', 'DESC')->get();

        if ($permintaan->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data permintaan untuk dicetak.');
        }

        $namaCabangFilter = 'Semua Cabang';
        if ($request->filled('cabang_id')) {
            $cabangTerpilih   = \App\Models\CabangModel::find($request->cabang_id);
            $namaCabangFilter = $cabangTerpilih->nama ?? 'Semua Cabang';
        }

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_akhir')) {
            $periode = Carbon::parse($request->tanggal_mulai)->translatedFormat('d F Y')
                     . ' s/d '
                     . Carbon::parse($request->tanggal_akhir)->translatedFormat('d F Y');
        } elseif ($request->filled('tanggal_mulai')) {
            $periode = 'Mulai ' . Carbon::parse($request->tanggal_mulai)->translatedFormat('d F Y');
        } elseif ($request->filled('tanggal_akhir')) {
            $periode = 'Sampai ' . Carbon::parse($request->tanggal_akhir)->translatedFormat('d F Y');
        } else {
            $periode = 'Semua Periode';
        }

        $data = [
            'permintaan' => $permintaan,
            'namaCabang' => $namaCabangFilter,
            'periode'    => $periode,
        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('panel.laporan.permintaancabang_pdf', $data)->setPaper('a4', 'portrait');
        return $pdf->stream('Laporan_Permintaan_Cabang_' . date('Ymd') . '.pdf');
    }
}
