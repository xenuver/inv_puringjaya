<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokmasukModel extends Model
{
    protected $table = 'stokmasuk';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $guarded = [];

    public function stokmasukdetail()
    {
        return $this->hasMany(StokmasukdetailModel::class, 'stokmasuk_id', 'id');
    }
}
