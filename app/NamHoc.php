<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NamHoc extends Model
{
    //
    protected $table = "namhoc";
    protected $primaryKey = "MaNH";

    public function hocky()
    {
        return $this->hasMany('App\HocKy','MaNH');
    }

    public function lop()
    {
        return $this->hasMany('App\Lop','MaNH');
    }

    public function diem()
    {
        return $this->hasMany('App\Diem','MaNH');
    }

    public function ctlop()
    {
        return $this->hasMany('App\CTLop','MaNH');
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function($namhoc) {
            $namhoc->hocky()->delete();
        });
    }
}
