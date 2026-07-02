<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokcabangModel extends Model
{
    protected $table = 'stokcabang';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $guarded = [];

    public function cabang()
    {
        return $this->belongsTo(CabangModel::class, 'cabang_id', 'id');
    }

    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'barang_id', 'id');
    }
}
