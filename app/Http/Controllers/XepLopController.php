<?php

namespace App\Http\Controllers;

use App\CTLop;
use App\Diem;
use App\HocKy;
use App\HocSinh;
use App\Lop;
use App\MonHoc;
use App\NamHoc;
use Illuminate\Http\Request;

class XepLopController extends Controller
{
    public function getXepLop()
    {
        $arrNotHS = array();
        $MaLop = Lop::where('MaNH', 1)->get();
        $i = 0;
        foreach ($MaLop as $value) {
            $dsCTLop = CTLop::where('MaLop', $value->MaLop)->get();
            foreach ($dsCTLop as $detail)
                $arrNotHS[$i++] = $detail->MaHS;
        }
        $dsHocSinh = HocSinh::where('KichHoat', 1)->whereNotIn('MaHS', $arrNotHS)->get();
        $dsNamHoc = NamHoc::all();
        return view('index.xeplop.xeplop', compact('dsHocSinh', 'dsNamHoc'));
    }

    public function ThemRecordDiem($MaHS,$MaLop)
    {
        $dsMonHoc = MonHoc::all();
        foreach ($dsMonHoc as $detail)
        {
            $NamHoc = Lop::find($MaLop)->MaNH;
            $dsHocKy = HocKy::where('MaNH',$NamHoc)->get();
            foreach ($dsHocKy as $value) {
                $Diem = new Diem();
                $Diem->MaHS = $MaHS;
                $Diem->MaLop = $MaLop;
                $Diem->MaMH = $detail->MaMH;
                $Diem->MaHK = $value->MaHK;
                $Diem->save();
                }
        }
    }

    public function postXepLop(Request $request)
    {
        $arr = array();
        $arrNotHS = array();
        $MaLop = Lop::where('MaNH', 1)->get();
        $i = 0;
        foreach ($MaLop as $value) {
            $dsCTLop = CTLop::where('MaLop', $value->MaLop)->get();
            foreach ($dsCTLop as $detail)
                $arrNotHS[$i++] = $detail->MaHS;
        }
        $dsHocSinh = HocSinh::where('KichHoat', 1)->whereNotIn('MaHS', $arrNotHS)->get();
        $i = 0;
        foreach ($dsHocSinh as $detail) {
            $namecheck = $detail->MaHS;
            if (isset($request->$namecheck)) {
                $arr[$i++] = $detail->MaHS;
            }
        }
        if (count($arr) == 0)
            return redirect()->route('xeplop.get')->with('success', 'Không có dữ liệu.');
        $Length = $i;
        $Lop = Lop::find($request->lop);
        $soHSThem = 0;
        for ($i = 0; $i < $Length; $i++) {
            $CTLop = new CTLop();
            $CTLop->MaHS = $arr[$i];
            $CTLop->MaLop = $request->lop;
            $CTLop->save();
            $soHSThem += 1;
            $this->ThemRecordDiem($arr[$i],$request->lop);
        }

        $Lop->SiSo += $soHSThem;
        $Lop->save();

        return redirect()->route('xeplop.get')->with('success', 'Xếp lớp thành công.');
    }

    public function getDSLop()
    {
        $dsNamHoc = NamHoc::all();
        return view('index.xeplop.dshs', compact('dsNamHoc'));
    }
}
