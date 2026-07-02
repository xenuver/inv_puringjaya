<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokkeluarModel extends Model
{
    protected $table = 'stokkeluar';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $guarded = [];

    /**
     * Relasi ke Cabang
     */
    public function cabang()
    {
        return $this->belongsTo(CabangModel::class, 'cabang_id');
    }

    /**
     * Relasi ke User / Pengguna
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke detail stok keluar (One to Many)
     */
    public function stokkeluardetail()
    {
        return $this->hasMany(StokkeluardetailModel::class, 'stokkeluar_id');
    }
}
