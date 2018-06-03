<?php

namespace App\Http\Controllers;

use App\CTLop;
use App\GiaoVien;
use App\Khoi;
use App\Lop;
use App\NamHoc;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Validator;
use Illuminate\Validation\Rule;

class LopController extends Controller
{
    //
    public function getDSLop()
    {
        $dsLop = Lop::all();
        return view('index.lop.danhsach', compact('dsLop'));
    }

    public function getThemLop()
    {
        $dsGV = GiaoVien::all();
        $dsNamHoc = NamHoc::all();
        return view('index.lop.them', compact('dsGV', 'dsNamHoc'));
    }

    protected function KiemTraLopTonTai($TenLop, $NamHoc)
    {
        $TenLop = strtoupper($TenLop);
        $Lop = Lop::where('TenLop', $TenLop)->where('MaNH', $NamHoc)->count();
        if ($Lop == 0)
            return 1;
        return 0;
    }

    public function getMaKhoi($TenKhoi)
    {
        if (Khoi::where('TenKhoi', $TenKhoi)->count() == 0)
            return 0;
        return Khoi::where('TenKhoi', $TenKhoi)->first()->MaKhoi;
    }

    public function checkMaGV($MaGV)
    {
        if (GiaoVien::where('MaGV', $MaGV)->count() == 0)
            return 0;
        return 1;
    }

    public function postThemLop(Request $request)
    {
        $messages = [
            'dslop.required' => 'Không có dữ liệu.',
        ];
        $rules = [
            'dslop' => 'required',
        ];
        $errors = Validator::make($request->all(), $rules, $messages);
        if ($errors->fails()) {
            return redirect()
                ->route('them-lop.get')
                ->withErrors($errors)
                ->withInput();
        }
        $errors = new MessageBag();
        $success = array();
        $dsLop = explode("\r\n", $request->dslop);
        $NamHoc = $request->namhoc;
        $i = 0;
        foreach ($dsLop as $detail) {
            $Lop = explode("/", $detail);
            if (count($Lop) == 3 && $this->getMaKhoi($Lop[0]) != 0 && $this->KiemTraLopTonTai($Lop[1], $NamHoc) == 1 && $this->checkMaGV($Lop[2]) == 1) {
                $ThemLop = new Lop();
                $ThemLop->TenLop = strtoupper($Lop[1]);
                $ThemLop->MaKhoi = $this->getMaKhoi($Lop[0]);
                $ThemLop->MaGV = $Lop[2];
                $ThemLop->SiSo = 0;
                $ThemLop->MaNH = $NamHoc;
                $ThemLop->save();
                $success[$i++] = "Dòng " . $detail . " được thêm thành công.";
            } elseif (count($Lop) != 3) {
                $errors->add($Lop[1], 'Lỗi dòng: ' . $detail . ' (Không đúng định dạng)');
            } elseif ($this->getMaKhoi($Lop[0]) == 0) {
                $errors->add($Lop[1], 'Lỗi dòng: ' . $detail . ' (Khối không tồn tại)');
            } elseif ($this->KiemTraLopTonTai($Lop[1], $NamHoc) == 0) {
                $errors->add($Lop[1], 'Lỗi dòng: ' . $detail . ' (Lớp đã tồn tại)');
            } elseif ($this->checkMaGV($Lop[2]) == 0) {
                $errors->add($Lop[1], 'Lỗi dòng: ' . $detail . ' (Giáo viên không tồn tại)');
            }
        }
        return redirect()->route("them-lop.get")->with('success', $success)->withErrors($errors);
    }

    public function getSuaLop($id)
    {
        if (Lop::where('MaLop', $id)->count() == 0)
            return redirect()->route('ds-lop.get')->with('error', 'Lớp không tồn tại.');
        else {
            $dsNamHoc = NamHoc::all();
            $dsGV = GiaoVien::all();
            $Lop = Lop::find($id);
            return view('index.lop.sua',compact('dsNamHoc','dsGV','Lop'));
        }
    }

    public function postSuaLop(Request $request, $id)
    {
        if (Lop::where('MaLop', $id)->count() == 0)
            return redirect()->route('ds-lop.get')->with('error', 'Lớp không tồn tại.');
        else {
            $messages = [
                'tenlop.required' => 'Chưa nhập tên lớp.',
                'tenlop.unique' => 'Lớp đã tồn tại.',
            ];
            $rules = [
                'tenlop' => [
                    'required',
                    Rule::unique('lop','TenLop')
                        ->ignore($id,'MaLop')
                        ->where('MaNH',$request->namhoc)
                ]
            ];
            $errors = Validator::make($request->all(), $rules, $messages);
            if ($errors->fails()) {
                return redirect()
                    ->route('sua-lop.get',$id)
                    ->withErrors($errors)
                    ->withInput();
            }
            $Lop = Lop::find($id);
            $Lop->TenLop = $request->tenlop;
            $Lop->MaNH = $request->namhoc;
            $Lop->MaKhoi = $request->khoi;
            $Lop->MaGV = $request->giaovien;
            $Lop->save();
            return redirect()->route("sua-lop.get",$id)->with('success','Sửa thành công.');
        }
    }

    public function getXoaLop($id)
    {
        if (CTLop::where('MaLop', $id)->count() > 0) {
            return redirect()->route('ds-lop.get')->with('error', 'Còn học sinh trong lớp này nên không thể xóa.');
        } else {
            $Lop = Lop::find($id);
            $Lop->delete();
            return redirect()->route('ds-lop.get')->with('success', 'Xóa thành công.');
        }
    }
}
