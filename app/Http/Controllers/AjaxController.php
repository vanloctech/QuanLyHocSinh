<?php

namespace App\Http\Controllers;

use App\HocKy;
use Illuminate\Http\Request;
use App\Lop;
use App\CTLop;
use App\Exports\DiemExport;
use Maatwebsite\Excel\Facades\Excel;

class AjaxController extends Controller
{
    //
    public function getDSLop($id)
    {
        $dsLop = Lop::where('MaNH', $id)->get();
        foreach ($dsLop as $value) {
            echo "<option value=\"$value->MaLop\">$value->TenLop</option>";
        }
    }

    public function getDSLop2($id)
    {
        $dsLop = Lop::where('MaNH', $id)->get();
        echo "<option value=\"\">Tất cả</option>";
        foreach ($dsLop as $value) {
            echo "<option value=\"$value->MaLop\">$value->TenLop</option>";
        }
    }

    public function getDSHocKy($id)
    {
        $dsHocKy = HocKy::where('MaNH', $id)->get();
        foreach ($dsHocKy as $value) {
            echo "<option value=\"$value->MaHK\">$value->TenHK</option>";
        }
    }

    public function getDSHS($lop)
    {
        $dsHocSinh = CTLop::where('MaLop', $lop)->get();
        if (count($dsHocSinh) == 0) {
            echo "<tr class='text-center'>";
            echo "<td colspan='5'>Không có dữ liệu</td>";
            echo "</tr>";
        } else
            foreach ($dsHocSinh as $i => $detail) {
                echo "<tr class='text-center'>";
                echo "<td>" . ++$i . "</td>";
                echo "<td>" . $detail->hocsinh->TenHS . "</td>";
                echo "<td>";
                if ($detail->hocsinh->GioiTinh == 2)
                    echo "Nữ";
                elseif ($detail->hocsinh->GioiTinh == 1)
                    echo "Nam";
                echo "</td>";
                echo "<td>" . date_format(date_create($detail->NgaySinh), 'd/m/Y') . "</td>";
                echo "<td>" . $detail->hocsinh->DiaChi . " </td > ";
                echo "</tr>";
            }
    }
}
