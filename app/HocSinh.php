<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HocSinh extends Model
{
    //
    protected $table = "hocsinh";
    protected $primaryKey = "MaHS";

    public function diem()
    {
        return $this->hasMany('App\Diem','MaHS');
    }

    public function ctlop()
    {
        return $this->hasMany('App\HocSinh','MaHS');
    }
}
