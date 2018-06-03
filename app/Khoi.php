<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Khoi extends Model
{
    //
    protected $table = "khoi";
    protected $primaryKey = "MaKhoi";

    public function lop()
    {
        return $this->hasMany('App\Lop','MaKhoi');
    }
}
