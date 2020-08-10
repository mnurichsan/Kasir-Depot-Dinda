<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $guarded = [];
    
    public function barang()
    {
        return $this->belongsTo('App\Barang','id_barang', 'id');
    }

    public function setoran(){
         return $this->belongsTo('App\Setoran','id_setoran', 'id');
    }

}
