<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('aboutus', 'UserController@getAboutUs')->name('aboutus.get');

Route::get('dangnhap', 'UserController@getLogin')->name('dangnhap.get');
Route::post('dangnhap', 'UserController@postLogin')->name('dangnhap.post');
//logout
Route::get('dangxuat', 'UserController@getLogout')->name('dangxuat.get');

Route::group(['prefix' => '/', 'middleware' => 'adminLogin'], function () {

    Route::get('/', function () {
        return redirect()->route('ds-hocsinh.get');
    })->name('trangchu.get');

    //hoc sinh
    Route::group(['prefix' => 'hocsinh'], function () {
        //danhsach
        Route::get('/', 'HocSinhController@getDSHocSinh')->name('ds-hocsinh.get');
        //them
        Route::get('them', 'HocSinhController@getThemHocSinh')->name('them-hocsinh.get');
        Route::post('them', 'HocSinhController@postThemHocSinh')->name('them-hocsinh.post');
//        //sua
        Route::get('sua/{id}', 'HocSinhController@getSuaHocSinh')->name('sua-hocsinh.get');
        Route::post('sua/{id}', 'HocSinhController@postSuaHocSinh')->name('sua-hocsinh.post');
//        //xoa
        Route::get('xoa/{id}', 'HocSinhController@getXoaHocSinh')->name('xoa-hocsinh.get');
    });

    Route::group(['prefix' => 'ajax'], function () {

        Route::get('dslop/{id}', 'AjaxController@getDSLop')->name('ajax-dslop.get');
        Route::get('dslop2/{id}', 'AjaxController@getDSLop2')->name('ajax-dslop2.get');
        Route::get('dshocky/{id}', 'AjaxController@getDSHocKy')->name('ajax-dshocky.get');
        Route::get('dshs/{lop}', 'AjaxController@getDSHS')->name('ajax-dshs.post');
        Route::get('test', 'AjaxController@export')->name('ajax-dssdhs.post');
    });

    Route::get('xeplop', 'XepLopController@getXepLop')->name('xeplop.get');
    Route::post('xeplop', 'XepLopController@postXepLop')->name('xeplop.post');

    Route::get('dshocsinhtheolop', 'XepLopController@getDSLop')->name('dshslop.get');
    Route::post('dshocsinhtheolop', 'XepLopController@postDSLop')->name('dshslop.post');

    Route::group(['prefix' => 'lop'], function () {
        //danhsach
        Route::get('/', 'LopController@getDSLop')->name('ds-lop.get');
        //them
        Route::get('them', 'LopController@getThemLop')->name('them-lop.get');
        Route::post('them', 'LopController@postThemLop')->name('them-lop.post');
//        //sua
        Route::get('sua/{id}', 'LopController@getSuaLop')->name('sua-lop.get');
        Route::post('sua/{id}', 'LopController@postSuaLop')->name('sua-lop.post');
//        //xoa
        Route::get('xoa/{id}', 'LopController@getXoaLop')->name('xoa-lop.get');
    });

    Route::group(['prefix' => 'namhoc'], function () {
        //danhsach
        Route::get('/', 'NamHocController@getDSNamHoc')->name('ds-namhoc.get');
        //them
        Route::post('them', 'NamHocController@postThemNamHoc')->name('them-namhoc.post');
//        //xoa
        Route::get('xoa/{id}', 'NamHocController@getXoaNamHoc')->name('xoa-namhoc.get');
    });

    Route::group(['prefix' => 'giaovien'], function () {
        //danhsach
        Route::get('/', 'GiaoVienController@getDSGiaoVien')->name('ds-giaovien.get');
        //them
        Route::get('them', 'GiaoVienController@getThemGiaoVien')->name('them-giaovien.get');
        Route::post('them', 'GiaoVienController@postThemGiaoVien')->name('them-giaovien.post');
//        //sua
        Route::get('sua/{id}', 'GiaoVienController@getSuaGiaoVien')->name('sua-giaovien.get');
        Route::post('sua/{id}', 'GiaoVienController@postSuaGiaoVien')->name('sua-giaovien.post');
//        //xoa
        Route::get('xoa/{id}', 'GiaoVienController@getXoaGiaoVien')->name('xoa-giaovien.get');
    });

    Route::group(['prefix' => 'diem'], function () {
        //danhsach
        Route::get('/', 'DiemController@getDSDiem')->name('ds-diem.get');
        Route::get('/ajaxxemdiem', 'DiemController@getAjaxDSDiem')->name('ajax-ds-diem.get');
//      test mau 2
        Route::get('ajaxsua/{malop}/{mahk}/{mamh}/{mahs}', 'DiemController@getAjaxSuaDiem')->name('ajaxsua-diem.get');
        //sua
        Route::get('sua/{malop}/{mahk}/{mamh}/{mahs}', 'DiemController@getSuaDiem')->name('sua-diem.get');
        Route::post('sua/{malop}/{mahk}/{mamh}/{mahs}', 'DiemController@postSuaDiem')->name('sua-diem.post');

        Route::get('ajaxtbm/{malop}/{mahk}/{mamh}/{mahs}', 'DiemController@getAjaxTBM')->name('ajax-diemtbm.get');

        Route::get('tracuu', 'DiemController@getTraCuuDiem')->name('tracuu-diem.get');
        Route::post('tracuu', 'DiemController@getAjaxTraCuuDiem')->name('tracuu-diem.post');
    });

//    Route::get('quydinh', 'QuyDinhController@getQuyDinh')->name('quydinh.get');
//    Route::post('quydinh', 'QuyDinhController@postQuyDinh')->name('quydinh.post');

    //Edit user
    Route::get('hoso', 'UserController@getHoSo')->name('hoso.get');
    Route::post('hoso', 'UserController@postHoSo')->name('hoso.post');

    Route::get('doimatkhau', 'UserController@getDoiMatKhau')->name('doimatkhau.get');
    Route::post('doimatkhau', 'UserController@postDoiMatKhau')->name('doimatkhau.post');
});
