<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HocKy extends Model
{
    //
    protected $table = "hocky";
    protected $primaryKey = "MaHK";

    public function namhoc()
    {
        return $this->belongsTo('App\NamHoc','MaNH');
    }

    public function diem()
    {
        return $this->hasMany('App\Diem','MaHK');
    }
}
