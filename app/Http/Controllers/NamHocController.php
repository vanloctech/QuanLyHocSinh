<?php

namespace App\Http\Controllers;

use App\HocKy;
use App\Lop;
use App\NamHoc;
use Illuminate\Http\Request;

class NamHocController extends Controller
{
    //
    public function getDSNamHoc()
    {
        $dsNamHoc = NamHoc::all();
        return view('index.namhoc.danhsach',compact('dsNamHoc'));
    }

    public function postThemNamHoc(Request $request)
    {
        $NamHoc = new NamHoc();
        $NamHoc->TenNH = $request->namhoc;
        $NamHoc->save();
        $HocKy1 = new HocKy();
        $HocKy1->TenHK = "HK1";
        $HocKy1->MaNH = $NamHoc->MaNH;
        $HocKy2 = new HocKy();
        $HocKy2->TenHK = "HK2";
        $HocKy2->MaNH = $NamHoc->MaNH;
        $HocKy1->save();
        $HocKy2->save();
        return redirect()->route("ds-namhoc.get")->with('success','Thêm thành công.');
    }

    public function getXoaNamHoc($id)
    {
        if (Lop::where('MaNH',$id)->count() > 0)
            return redirect()->route('ds-namhoc.get')->with('error','Không thể xóa do năm học đang được sử dụng');
        else
        {
            $NamHoc = NamHoc::find($id);
            $NamHoc->delete();
            return redirect()->route("ds-namhoc.get")->with('success','Xóa thành công.');
        }
    }
}
