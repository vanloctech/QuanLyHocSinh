@extends('index.layout.index')
@section('title')
    <title>Thêm học sinh - Quản lý học sinh</title>
@endsection
@section('style')
    <link href="assets/plugins/switchery/css/switchery.min.css" rel="stylesheet"/>
    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet"/>
    <link href="assets/css/cssdate.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <ol class="breadcrumb">
                <li>
                    <a href=""><i class="ti-home"></i></a>
                </li>
                <li>
                    <a href="{{route('ds-hocsinh.get')}}">Danh sách học sinh</a>
                </li>
                <li class="active">
                    Thêm học sinh
                </li>
            </ol>
        </div>
    </div>

    @if (count($errors) > 0 || session('error'))
        <div class="alert alert-danger" role="alert">
            <strong>Cảnh báo!</strong><br>
            @foreach($errors->all() as $err)
                {{$err}}<br/>
            @endforeach
            {{session('error')}}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            <strong>Thành công!</strong>
            <button type="button" class="close" data-dismiss="alert">×</button>
            <br/>
            {{session('success')}}
        </div>
    @endif

    <!--end duong dan nho-->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title"><b>Thêm học sinh</b></h4>
                <p class="text-muted m-b-10 font-13">
                    <b>Bắt buộc</b> <code>Tất cả</code>
                </p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="p-l-r-10">
                            <form class="form-horizontal" role="form" action="{{route('them-hocsinh.post')}}"
                                  method="post">
                                {{csrf_field()}}

                                <div class="form-group">
                                    <label class="control-label">Họ & tên</label>
                                    <input name="hoten" type="text" class="form-control" value="{{old('hoten')}}"
                                           placeholder="Nhập họ tên..." required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Giới tính</label>
                                    <select class="selectpicker" data-style="btn-default btn-custom" id="gioitinh"
                                            name="gioitinh">
                                        <option value="" selected>--- Chọn giới tính ---</option>
                                        <option value="1" @if (old('gioitinh') == 1) selected @endif>Nam</option>
                                        <option value="2" @if (old('gioitinh') == 2) selected @endif>Nữ</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Ngày sinh</label><br/>
                                    <input class="input-small datepicker hasDatepicker" id="ngaysinh" type="date"
                                           name="ngaysinh" value="{{old('ngaysinh')}}">
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Địa chỉ</label>
                                    <input name="diachi" type="text" class="form-control" value="{{old('diachi')}}"
                                           placeholder="Nhập địa chỉ..." required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Dân tộc</label>
                                    <input name="dantoc" type="text" class="form-control" value="{{old('dantoc')}}"
                                           placeholder="Nhập dân tộc..." required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Tôn giáo</label>
                                    <input name="tongiao" type="text" class="form-control" value="{{old('tongiao')}}"
                                           placeholder="Nhập tôn giáo..." required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Họ & tên cha</label>
                                    <input name="hotencha" type="text" class="form-control" value="{{old('hotencha')}}"
                                           placeholder="Nhập họ & tên cha..." required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Nghề nghiệp cha</label>
                                    <input name="nghecha" type="text" class="form-control" value="{{old('nghecha')}}"
                                           placeholder="Nhập nghề nghiệp cha..." required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Họ & tên mẹ</label>
                                    <input name="hotenme" type="text" class="form-control" value="{{old('hotenme')}}"
                                           placeholder="Nhập họ & tên mẹ..." required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Nghề nghiệp mẹ</label>
                                    <input name="ngheme" type="text" class="form-control" value="{{old('ngheme')}}"
                                           placeholder="Nhập nghề nghiệp mẹ..." required>
                                </div>

                                <div class="form-group">
                                    <button class="ladda-button btn btn-default" data-style="expand-right">Lưu lại
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script-ori')
    <script src="assets/plugins/switchery/js/switchery.min.js"></script>
@endsection
@section('script')

@endsection