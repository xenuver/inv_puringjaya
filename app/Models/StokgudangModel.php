<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokgudangModel extends Model
{
    protected $table = 'stokgudang';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = [];

    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'barang_id', 'id');
    }
}
