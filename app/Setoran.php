<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    protected $guarded = [];
    
    protected $dates = ['tanggal_setoran'];
//     protected $dateFormat = 'd:m:Y';
   

    public function pegawai(){
         return $this->belongsTo('App\Pegawai','id_pegawai', 'id');
    }

    public function transaksi(){
         return $this->hasMany('App\Transaksi','id','id');
    }
}
