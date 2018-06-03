<?php

namespace App\Http\Controllers;

use App\GiaoVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GiaoVienController extends Controller
{
    //
    public function getDSGiaoVien()
    {
        $dsGV = GiaoVien::where('KichHoat', 1)->get();
        return view('index.giaovien.danhsach', compact('dsGV'));
    }

    public function getThemGiaoVien()
    {
        return view('index.giaovien.them');
    }

    public function postThemGiaoVien(Request $request)
    {
        $messages = [
            'hoten.required' => 'Chưa nhập họ & tên.',
            'hoten.min' => 'Họ & tên quá ngắn.',
            'hoten.max' => 'Họ & tên quá dài.',
            'gioitinh.required' => 'Chưa chọn giới tính.',
            'ngaysinh.required' => 'Chưa nhập ngày sinh.',
            'bangcap.required' => 'Chưa nhập bằng cấp.',
            'bangcap.min' => 'Bằng cấp quá ngắn.',
            'bangcap.max' => 'Bằng cấp quá dài.',
            'chuyenmon.required' => 'Chưa nhập chuyên môn.',
            'chuyenmon.min' => 'Chuyên môn quá ngắn.',
            'chuyenmon.max' => 'Chuyên môn quá dài.',
        ];
        $rules = [
            'hoten' => 'required|min:5|max:50',
            'gioitinh' => 'required|numeric',
            'ngaysinh' => 'required',
            'bangcap' => 'required|min:5|max:50',
            'chuyenmon' => 'required|min:2|max:50',
        ];
        $errors = Validator::make($request->all(), $rules, $messages);
        if ($errors->fails()) {
            return redirect()
                ->route('them-giaovien.get')
                ->withErrors($errors)
                ->withInput();
        }

        $GiaoVien = new GiaoVien();
        $GiaoVien->TenGV = $request->hoten;
        $GiaoVien->GioiTinh = $request->gioitinh;
        $GiaoVien->NgaySinh = $request->ngaysinh;
        $GiaoVien->BangCap = $request->bangcap;
        $GiaoVien->ChuyenMon = $request->chuyenmon;
        $GiaoVien->save();

        return redirect()->route('them-giaovien.get')->with('success', 'Thêm giáo viên thành công');
    }

    public function getSuaGiaoVien($id)
    {
        if (GiaoVien::where('MaGV', $id)->count() == 0)
            return redirect()->route('ds-giaovien.get')->with('error', 'Giáo viên không tồn tại.');
        else {
            $GiaoVien = GiaoVien::find($id);
            return view('index.giaovien.sua', compact('GiaoVien'));
        }
    }

    public function postSuaGiaoVien(Request $request, $id)
    {
        if (GiaoVien::where('MaGV', $id)->count() == 0)
            return redirect()->route('ds-giaovien.get')->with('error', 'Giáo viên không tồn tại.');
        else {
            $GiaoVien = GiaoVien::find($id);
            $messages = [
                'hoten.required' => 'Chưa nhập họ & tên.',
                'hoten.min' => 'Họ & tên quá ngắn.',
                'hoten.max' => 'Họ & tên quá dài.',
                'gioitinh.required' => 'Chưa chọn giới tính.',
                'ngaysinh.required' => 'Chưa nhập ngày sinh.',
                'bangcap.required' => 'Chưa nhập bằng cấp.',
                'bangcap.min' => 'Bằng cấp quá ngắn.',
                'bangcap.max' => 'Bằng cấp quá dài.',
                'chuyenmon.required' => 'Chưa nhập chuyên môn.',
                'chuyenmon.min' => 'Chuyên môn quá ngắn.',
                'chuyenmon.max' => 'Chuyên môn quá dài.',
            ];
            $rules = [
                'hoten' => 'required|min:5|max:50',
                'gioitinh' => 'required|numeric',
                'ngaysinh' => 'required',
                'bangcap' => 'required|min:5|max:50',
                'chuyenmon' => 'required|min:2|max:50',
            ];
            $errors = Validator::make($request->all(), $rules, $messages);
            if ($errors->fails()) {
                return redirect()
                    ->route('sua-giaovien.get', $id)
                    ->withErrors($errors)
                    ->withInput();
            }

            $GiaoVien->TenGV = $request->hoten;
            $GiaoVien->GioiTinh = $request->gioitinh;
            $GiaoVien->NgaySinh = $request->ngaysinh;
            $GiaoVien->BangCap = $request->bangcap;
            $GiaoVien->ChuyenMon = $request->chuyenmon;
            $GiaoVien->save();

            return redirect()->route('sua-giaovien.get', $id)->with('success', 'Sửa giáo viên thành công');
        }
    }

    public function getXoaGiaoVien($id)
    {
        if (GiaoVien::where('MaGV', $id)->count() == 0)
            return redirect()->route('ds-giaovien.get')->with('error', 'Giáo viên không tồn tại.');
        else {
            $GiaoVien = GiaoVien::find($id);
            $GiaoVien->KichHoat = 0;
            $GiaoVien->save();
            return redirect()->route('ds-giaovien.get')->with('success', 'Xóa thành công.');
        }
    }
}
