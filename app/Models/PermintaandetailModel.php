<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermintaandetailModel extends Model
{
    protected $table = 'permintaandetail';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $guarded = [];

    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'barang_id', 'id');
    }

    public function permintaan()
    {
        return $this->belongsTo(PermintaanModel::class, 'permintaan_id', 'id');
    }
}
