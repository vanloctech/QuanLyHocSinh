<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Diem extends Model
{
    //
    protected $table = "diem";
    protected $primaryKey = ['MaHS','MaLop','MaHK','MaMH'];
    public $incrementing = false;
    public function lop()
    {
        return $this->belongsTo('App\Lop','MaLop');
    }

    public function monhoc()
    {
        return $this->belongsTo('App\MonHoc','MaMH');
    }

    public function hocsinh()
    {
        return $this->belongsTo('App\HocSinh','MaHS');
    }

    public function hocky()
    {
        return $this->belongsTo('App\HocKy','MaHK');
    }

    protected function getKeyForSaveQuery($keyName = null)
    {
        if(is_null($keyName)){
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }

    protected function setKeysForSaveQuery(Builder $query)
    {
        $keys = $this->getKeyName();
        if(!is_array($keys)){
            return parent::setKeysForSaveQuery($query);
        }

        foreach($keys as $keyName){
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }
}
