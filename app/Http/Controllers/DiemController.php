<?php

namespace App\Http\Controllers;

use App\Diem;
use App\MonHoc;
use App\NamHoc;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class DiemController extends Controller
{
    //
    public function getDSDiem()
    {
        $dsNamHoc = NamHoc::all();
        $dsMonHoc = MonHoc::all();
        return view('index.diem.xemdiem', compact('dsNamHoc', 'dsMonHoc'));
    }

    public function getAjaxDSDiem(Request $request)
    {
        if ($request->ajax()) {
            $lop = "";
            $hocky = "";
            $monhoc = "";

            if ($request->lop != "")
                $lop = $request->lop;
            if ($request->hocky != "")
                $hocky = $request->hocky;
            if ($request->monhoc != "")
                $monhoc = $request->monhoc;

//            echo $lop." ".$hocky." ".$monhoc;

            $dsHocSinh = Diem::where('MaLop', $lop)
                ->where('MaHK', $hocky)
                ->where('MaMH', $monhoc)
                ->get();

            if ((count($dsHocSinh)) == 0)
                echo "<tr><td colspan='10'>Không có dữ liệu</td></tr>";
            else {
                $i = 0;
                foreach ($dsHocSinh as $detail) {
                    echo "<tr>";
                    echo "<td>" . ++$i . "</td>";
                    echo "<td>" . $detail->hocsinh->TenHS . "<td>";
                    if ($detail->GioiTinh == 2)
                        echo "Nữ";
                    else
                        echo "Nam";
                    echo "</td>";
                    echo "<td>" . date_format(date_create($detail->hocsinh->NgaySinh), 'd/m/Y') . "</td>";
                    echo "<td>" . ($detail->DiemM == -1 ? "" : $detail->DiemM) . "</td>";
                    echo "<td>" . ($detail->Diem15L1 == -1 ? "" : $detail->Diem15L1) . ($detail->Diem15L2 == -1 ? "" : " | " . $detail->Diem15L2) . ($detail->Diem15L3 == -1 ? "" : " | " . $detail->Diem15L3) . "</td>";
                    echo "<td>" . ($detail->Diem1TL1 == -1 ? "" : $detail->Diem1TL1) . ($detail->Diem1TL2 == -1 ? "" : " | " . $detail->Diem1TL2) . ($detail->Diem1TL3 == -1 ? "" : " | " . $detail->Diem1TL3) . "</td>";
                    echo "<td>" . ($detail->DiemHK == -1 ? "" : $detail->DiemHK) . "</td>";
                    echo "<td>" . ($detail->DiemTBM == -1 ? "" : $detail->DiemTBM) . "</td>";
                    echo "<td class='hidden-print'><a href=\"" . route('sua-diem.post', [$detail->MaLop, $detail->MaHK, $detail->MaMH, $detail->MaHS]) . "\"
                                   class=\"btn btn-icon waves-effect waves-light btn-warning\" title=\"Sửa\" target='_blank'> <i
                                            class=\"fa fa-wrench\"></i></a></td>";
                    echo "</tr>";
                }
            }
        }
    }

    //test mau 2
    public function getAjaxDSDiemNew(Request $request)
    {
        if ($request->ajax()) {
            $lop = "";
            $hocky = "";
            $monhoc = "";

            if ($request->lop != "")
                $lop = $request->lop;
            if ($request->hocky != "")
                $hocky = $request->hocky;
            if ($request->monhoc != "")
                $monhoc = $request->monhoc;

//            echo $lop." ".$hocky." ".$monhoc;

            $dsHocSinh = Diem::where('MaLop', $lop)
                ->where('MaHK', $hocky)
                ->where('MaMH', $monhoc)
                ->get();

//            echo count($dsHocSinh);

            if ((count($dsHocSinh)) == 0)
                echo "<tr><td colspan='10'>Không có dữ liệu</td></tr>";
            else {
                $i = 0;
                foreach ($dsHocSinh as $detail) {
                    echo "<tr>";
                    echo "<td>" . ++$i . "</td>";
                    echo "<td>" . $detail->hocsinh->TenHS . "<td>";
                    if ($detail->GioiTinh == 2)
                        echo "Nữ";
                    else
                        echo "Nam";
                    echo "</td>";
                    echo "<td>" . date_format(date_create($detail->NgayKham), 'd/m/Y') . "</td>";
                    echo "<td>" . ($detail->DiemM == -1 ? "" : $detail->DiemM) . "</td>";
                    echo "<td>" . ($detail->Diem15L1 == -1 ? "" : $detail->Diem15L1) . ($detail->Diem15L2 == -1 ? "" : " | " . $detail->Diem15L2) . ($detail->Diem15L3 == -1 ? "" : " | " . $detail->Diem15L3) . "</td>";
                    echo "<td>" . ($detail->Diem1TL1 == -1 ? "" : $detail->Diem1TL1) . ($detail->Diem1TL2 == -1 ? "" : " | " . $detail->Diem1TL2) . ($detail->Diem1TL3 == -1 ? "" : " | " . $detail->Diem1TL3) . "</td>";
                    echo "<td>" . ($detail->DiemHK == -1 ? "" : $detail->DiemHK) . "</td>";
                    echo "<td>" . ($detail->DiemTBM == -1 ? "" : $detail->DiemTBM) . "</td>";
                    echo "<td class='hidden-print'><a onclick='SuaDiem()'
                                   class=\"btn btn-icon waves-effect waves-light btn-warning\" title=\"Sửa\"> <i
                                            class=\"fa fa-wrench\"></i></a></td>";
                    echo "</tr>";
                }
            }
        }
    }

    //test mau 2
    public function getAjaxSuaDiem($malop, $mahk, $mamh, $mahs)
    {
        $Diem = Diem::where('MaLop', $malop)
            ->where('MaHK', $mahk)
            ->where('MaMH', $mamh)
            ->where('MaHS', $mahs)
            ->first();
        $hoten = $Diem->hocsinh->TenHS;
        $Diem->HoTen = "$hoten";
        $Diem = json_encode($Diem);
        return $Diem;

    }

    public function getSuaDiem($malop, $mahk, $mamh, $mahs)
    {
        $Diem = Diem::where('MaLop', $malop)
            ->where('MaHK', $mahk)
            ->where('MaMH', $mamh)
            ->where('MaHS', $mahs)
            ->first();
        return view('index.diem.sua', compact('Diem'));
    }

    public function postSuaDiem(Request $request, $malop, $mahk, $mamh, $mahs)
    {
        $Diem = Diem::where('MaLop', $malop)
            ->where('MaHK', $mahk)
            ->where('MaMH', $mamh)
            ->where('MaHS', $mahs)
            ->first();
        $Diem->DiemM = $request->mieng == "" ? -1 : round($request->mieng, 1);
        $Diem->Diem15L1 = $request->l115 == "" ? -1 : round($request->l115, 1);
        $Diem->Diem15L2 = $request->l215 == "" ? -1 : round($request->l215, 1);
        $Diem->Diem15L3 = $request->l315 == "" ? -1 : round($request->l315, 1);
        $Diem->Diem1TL1 = $request->l11t == "" ? -1 : round($request->l11t, 1);
        $Diem->Diem1TL2 = $request->l21t == "" ? -1 : round($request->l21t, 1);
        $Diem->Diem1TL3 = $request->l31t == "" ? -1 : round($request->l31t, 1);
        $Diem->DiemHK = $request->diemhk == "" ? -1 : round($request->diemhk, 1);
        $Diem->DiemTBM = $request->diemtbm == "" ? -1 : $request->diemtbm;
        $Diem->save();
        $success = "Cập nhật điểm thành công.";

        return redirect()->route('sua-diem.get', [$malop, $mahk, $mamh, $mahs])->with('success', $success);
    }

    public function getAjaxTBM($malop, $mahk, $mamh, $mahs)
    {
        $Diem = Diem::where('MaLop', $malop)
            ->where('MaHK', $mahk)
            ->where('MaMH', $mamh)
            ->where('MaHS', $mahs)
            ->first();
        $TongDiem = 0;
        $countTongDiem = 0;
        if ($Diem->DiemM != -1) {
            $TongDiem += $Diem->DiemM;
            $countTongDiem += 1;
        }
        if ($Diem->Diem15L1 != -1) {
            $TongDiem += $Diem->Diem15L1;
            $countTongDiem += 1;
        }
        if ($Diem->Diem15L2 != -1) {
            $TongDiem += $Diem->Diem15L2;
            $countTongDiem += 1;
        }
        if ($Diem->Diem15L3 != -1) {
            $TongDiem += $Diem->Diem15L3;
            $countTongDiem += 1;
        }
        if ($Diem->Diem1TL1 != -1) {
            $TongDiem += $Diem->Diem1TL1 * 2;
            $countTongDiem += 2;
        }
        if ($Diem->Diem1TL2 != -1) {
            $TongDiem += $Diem->Diem1TL2 * 2;
            $countTongDiem += 2;
        }
        if ($Diem->Diem1TL3 != -1) {
            $TongDiem += $Diem->Diem1TL3 * 2;
            $countTongDiem += 2;
        }
        if ($Diem->DiemHK != -1) {
            $TongDiem += $Diem->DiemHK * 3;
            $countTongDiem += 3;
        }
        $Diem->DiemTBM = round($TongDiem / $countTongDiem, 1);
        $Diem->save();
        echo $Diem->DiemTBM;
//        echo round($TongDiem/$countTongDiem,1);
    }

    public function getTraCuuDiem()
    {
        $dsNamHoc = NamHoc::all();
        $dsMonHoc = MonHoc::all();
        return view('index.diem.tracuu', compact('dsNamHoc', 'dsMonHoc'));
    }

    public function getAjaxTraCuuDiem(Request $request)
    {
        if ($request->ajax()) {
            $maLop = "";
            if ($request->lop != "")
                $maLop = $request->lop;

            $dsHocSinh = Diem::whereHas('hocsinh', function ($query) use ($request, $maLop) {
                $query->where('TenHS', 'like', '%' . $request->hoten . '%');
            })
                ->where('MaHK', $request->hocky)
                ->where('MaMH', $request->monhoc)
                ->where('MaLop', 'like' , "%".$maLop."%")
                ->get();
            sleep(3);
            if ((count($dsHocSinh)) == 0)
                echo "<tr><td colspan='11'>Không có dữ liệu</td></tr>";
            else {
                $i = 0;
                foreach ($dsHocSinh as $detail) {
                    echo "<tr>";
                    echo "<td>" . ++$i . "</td>";
                    echo "<td>" . $detail->hocsinh->TenHS . "<td>";
                    if ($detail->GioiTinh == 2)
                        echo "Nữ";
                    else
                        echo "Nam";
                    echo "</td>";
                    echo "<td>" . date_format(date_create($detail->hocsinh->NgaySinh), 'd/m/Y') . "</td>";
                    echo "<td>" . $detail->lop->TenLop . "</td>";
                    echo "<td>" . ($detail->DiemM == -1 ? "" : $detail->DiemM) . "</td>";
                    echo "<td>" . ($detail->Diem15L1 == -1 ? "" : $detail->Diem15L1) . ($detail->Diem15L2 == -1 ? "" : " | " . $detail->Diem15L2) . ($detail->Diem15L3 == -1 ? "" : " | " . $detail->Diem15L3) . "</td>";
                    echo "<td>" . ($detail->Diem1TL1 == -1 ? "" : $detail->Diem1TL1) . ($detail->Diem1TL2 == -1 ? "" : " | " . $detail->Diem1TL2) . ($detail->Diem1TL3 == -1 ? "" : " | " . $detail->Diem1TL3) . "</td>";
                    echo "<td>" . ($detail->DiemHK == -1 ? "" : $detail->DiemHK) . "</td>";
                    echo "<td>" . ($detail->DiemTBM == -1 ? "" : $detail->DiemTBM) . "</td>";
                    echo "<td class='hidden-print'><a href=\"" . route('sua-diem.post', [$detail->MaLop, $detail->MaHK, $detail->MaMH, $detail->MaHS]) . "\"
                                   class=\"btn btn-icon waves-effect waves-light btn-warning\" title=\"Sửa\" target='_blank'> <i
                                            class=\"fa fa-wrench\"></i></a></td>";
                    echo "</tr>";
                }
            }
        }
    }
}
