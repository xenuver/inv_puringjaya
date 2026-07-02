<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokkeluardetailModel extends Model
{
    protected $table = 'stokkeluardetail';
    protected $primaryKey = 'id';
    public $timestamps = false; // Sesuaikan dengan database Anda (true/false)

    protected $guarded = [];

    /**
     * Relasi ke model Stokkeluar (Induk)
     */
    public function stokkeluar()
    {
        return $this->belongsTo(StokkeluarModel::class, 'stokkeluar_id');
    }

    /**
     * Relasi ke Stok Cabang
     */
    public function stokcabang()
    {
        return $this->belongsTo(StokcabangModel::class, 'stokcabang_id');
    }

    /**
     * RELASI INI YANG HILANG: Hubungan langsung ke model Barang
     * Digunakan untuk memanggil nama barang di halaman laporan
     */
    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'barang_id');
    }
}
