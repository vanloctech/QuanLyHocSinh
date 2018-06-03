<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonHoc extends Model
{
    //
    protected $table = "monhoc";
    protected $primaryKey = "MaMH";

    public function diem()
    {
        return $this->hasMany('App\Diem','MaMH');
    }
}
