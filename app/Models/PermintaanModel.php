<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermintaanModel extends Model
{
    protected $table = 'permintaan';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function cabang()
    {
        return $this->belongsTo(CabangModel::class, 'cabang_id', 'id');
    }

    public function permintaandetail()
    {
        return $this->hasMany(PermintaandetailModel::class, 'permintaan_id', 'id');
    }
}
