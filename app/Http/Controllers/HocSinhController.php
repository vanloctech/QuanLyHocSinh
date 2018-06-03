<?php

namespace App\Http\Controllers;

use App\HocSinh;
use App\Lop;
use App\MonHoc;
use Illuminate\Http\Request;
use Validator;

class HocSinhController extends Controller
{
    //
    public function getDSHocSinh()
    {
        $dsHocSinh = HocSinh::where('KichHoat', 1)->get();
        return view('index.hocsinh.danhsach', compact('dsHocSinh'));
    }

    public function getThemHocSinh()
    {
        return view('index.hocsinh.them');
    }

    public function postThemHocSinh(Request $request)
    {
        $messages = [
            'hoten.required' => 'Chưa nhập họ & tên.',
            'hoten.min' => 'Họ & tên quá ngắn.',
            'hoten.max' => 'Họ & tên quá dài.',
            'gioitinh.required' => 'Chưa chọn giới tính.',
            'ngaysinh.required' => 'Chưa nhập ngày sinh.',
            'diachi.required' => 'Chưa nhập địa chỉ.',
            'diachi.min' => 'Địa chỉ quá ngắn.',
            'diachi.max' => 'Địa chỉ quá dài.',
            'dantoc.required' => 'Chưa nhập dân tộc.',
            'dantoc.min' => 'Dân tộc quá ngắn.',
            'dantoc.max' => 'Dân tộc quá dài.',
            'hotencha.required' => 'Chưa nhập họ & tên cha.',
            'hotencha.min' => 'Họ & tên cha quá ngắn.',
            'hotencha.max' => 'Họ & tên cha quá dài.',
            'nghecha.required' => 'Chưa nhập nghề nghiệp cha.',
            'nghecha.min' => 'Nghề nghiệp cha quá ngắn.',
            'nghecha.max' => 'Nghề nghiệp cha quá dài.',
            'hotenme.required' => 'Chưa nhập họ & tên mẹ.',
            'hotenme.min' => 'Họ & tên mẹ quá ngắn.',
            'hotenme.max' => 'Họ & tên mẹ quá dài.',
            'ngheme.required' => 'Chưa nhập nghề nghiệp mẹ.',
            'ngheme.min' => 'Nghề nghiệp mẹ quá ngắn.',
            'ngheme.max' => 'Nghề nghiệp mẹ quá dài.',
        ];
        $rules = [
            'hoten' => 'required|min:5|max:50',
            'gioitinh' => 'required|numeric',
            'ngaysinh' => 'required',
            'diachi' => 'required|min:5|max:50',
            'dantoc' => 'required|min:2|max:50',
            'hotencha' => 'required|min:5|max:50',
            'nghecha' => 'required|min:3|max:50',
            'hotenme' => 'required|min:5|max:50',
            'ngheme' => 'required|min:3|max:50',
        ];
        $errors = Validator::make($request->all(), $rules, $messages);
        if ($errors->fails()) {
            return redirect()
                ->route('them-hocsinh.get')
                ->withErrors($errors)
                ->withInput();
        }
        $hocsinh = new HocSinh();
        if ($request->tongiao == "")
            $tongiao = "Không";
        else $tongiao = $request->tongiao;
        $hocsinh->TenHS = $request->hoten;
        $hocsinh->NgaySinh = $request->ngaysinh;
        $hocsinh->GioiTinh = $request->gioitinh;
        $hocsinh->DiaChi = $request->diachi;
        $hocsinh->DanToc = $request->dantoc;
        $hocsinh->TonGiao = $tongiao;
        $hocsinh->HoTenCha = $request->hotencha;
        $hocsinh->HoTenMe = $request->hotenme;
        $hocsinh->NgCha = $request->nghecha;
        $hocsinh->NgMe = $request->ngheme;
        $hocsinh->save();
        return redirect()->route('them-hocsinh.get')->with('success', 'Thêm học sinh thành công.');
    }

    public function getSuaHocSinh($id)
    {
        $HocSinh = HocSinh::find($id);
        return view('index.hocsinh.sua', compact('HocSinh'));
    }

    public function postSuaHocSinh($id, Request $request)
    {
        $messages = [
            'hoten.required' => 'Chưa nhập họ & tên.',
            'hoten.min' => 'Họ & tên quá ngắn.',
            'hoten.max' => 'Họ & tên quá dài.',
            'gioitinh.required' => 'Chưa chọn giới tính.',
            'ngaysinh.required' => 'Chưa nhập ngày sinh.',
            'diachi.required' => 'Chưa nhập địa chỉ.',
            'diachi.min' => 'Địa chỉ quá ngắn.',
            'diachi.max' => 'Địa chỉ quá dài.',
            'dantoc.required' => 'Chưa nhập dân tộc.',
            'dantoc.min' => 'Dân tộc quá ngắn.',
            'dantoc.max' => 'Dân tộc quá dài.',
            'hotencha.required' => 'Chưa nhập họ & tên cha.',
            'hotencha.min' => 'Họ & tên cha quá ngắn.',
            'hotencha.max' => 'Họ & tên cha quá dài.',
            'nghecha.required' => 'Chưa nhập nghề nghiệp cha.',
            'nghecha.min' => 'Nghề nghiệp cha quá ngắn.',
            'nghecha.max' => 'Nghề nghiệp cha quá dài.',
            'hotenme.required' => 'Chưa nhập họ & tên mẹ.',
            'hotenme.min' => 'Họ & tên mẹ quá ngắn.',
            'hotenme.max' => 'Họ & tên mẹ quá dài.',
            'ngheme.required' => 'Chưa nhập nghề nghiệp mẹ.',
            'ngheme.min' => 'Nghề nghiệp mẹ quá ngắn.',
            'ngheme.max' => 'Nghề nghiệp mẹ quá dài.',
        ];
        $rules = [
            'hoten' => 'required|min:5|max:50',
            'gioitinh' => 'required|numeric',
            'ngaysinh' => 'required',
            'diachi' => 'required|min:5|max:50',
            'dantoc' => 'required|min:2|max:50',
            'hotencha' => 'required|min:5|max:50',
            'nghecha' => 'required|min:3|max:50',
            'hotenme' => 'required|min:5|max:50',
            'ngheme' => 'required|min:3|max:50',
        ];
        $errors = Validator::make($request->all(), $rules, $messages);
        if ($errors->fails()) {
            return redirect()
                ->route('sua-hocsinh.get', $id)
                ->withErrors($errors)
                ->withInput();
        }
        $hocsinh = HocSinh::find($id);
        if ($request->tongiao == "")
            $tongiao = "Không";
        else $tongiao = $request->tongiao;
        $hocsinh->TenHS = $request->hoten;
        $hocsinh->NgaySinh = $request->ngaysinh;
        $hocsinh->GioiTinh = $request->gioitinh;
        $hocsinh->DiaChi = $request->diachi;
        $hocsinh->DanToc = $request->dantoc;
        $hocsinh->TonGiao = $tongiao;
        $hocsinh->HoTenCha = $request->hotencha;
        $hocsinh->HoTenMe = $request->hotenme;
        $hocsinh->NgCha = $request->nghecha;
        $hocsinh->NgMe = $request->ngheme;
        $hocsinh->save();
        return redirect()->route('sua-hocsinh.get', $id)->with('success', 'Sửa học sinh thành công.');
    }

    public function getXoaHocSinh($id)
    {
        $countHocSinh = HocSinh::where('MaHS', $id)->count();
        if ($countHocSinh == 0)
            return redirect()->route('ds-hocsinh.get')->with('error', 'Học sinh không tồn tại.');
        $HocSinh = HocSinh::find($id);
        $HocSinh->KichHoat = 0;
        $HocSinh->save();
        return redirect()->route('ds-hocsinh.get')->with('success', 'Xóa học sinh thành công.');
    }

}
