<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lop extends Model
{
    //
    protected $table = "lop";
    protected $primaryKey = "MaLop";

    public function ctlop()
    {
        return $this->hasMany('App\CTLop','MaLop');
    }

    public function diem()
    {
        return $this->hasMany('App\Diem','MaLop');
    }

    public function khoi()
    {
        return $this->belongsTo('App\Khoi','MaKhoi');
    }

    public function namhoc()
    {
        return $this->belongsTo('App\NamHoc','MaNH');
    }

    public function giaovien()
    {
        return $this->belongsTo('App\GiaoVien','MaGV');
    }
}
