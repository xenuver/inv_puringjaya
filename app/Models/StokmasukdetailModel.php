<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokmasukdetailModel extends Model
{
    protected $table = 'stokmasukdetail';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $guarded = [];

    public function stokmasuk()
    {
        return $this->belongsTo(StokmasukModel::class, 'stokmasuk_id', 'id');
    }

    public function stokgudang()
    {
        return $this->belongsTo(StokgudangModel::class, 'stokgudang_id', 'id');
    }
}
