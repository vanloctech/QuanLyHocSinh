@extends('index.layout.index')
@section('title')
    <title>Sửa lớp học - Quản lý học sinh</title>
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
                    <a href="{{route('ds-lop.get')}}">Danh sách lớp học</a>
                </li>
                <li class="active">
                    Sửa lớp học
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
        <div class="col-sm-6">
            <div class="card-box">
                <h4 class="m-t-0 header-title"><b>Sửa lớp học</b></h4>
                <p class="text-muted m-b-10 font-13">
                    <b>Bắt buộc</b> <code>Tất cả</code>
                </p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="p-l-r-10">
                            <form class="form-horizontal" role="form" action="{{route('sua-lop.post',$Lop->MaLop)}}"
                                  method="post">
                                {{csrf_field()}}

                                <div class="form-group">
                                    <label class="control-label">Năm học</label>
                                    <select class="selectpicker" data-style="btn-default btn-custom" id="namhoc"
                                            name="namhoc" required>
                                        <option value="" selected>--- Chọn năm học ---</option>
                                        @foreach($dsNamHoc as $detail)
                                            <option value="{{$detail->MaNH}}"
                                                    @if (old('namhoc',$Lop->MaNH) == $detail->MaNH) selected @endif>{{$detail->TenNH}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Khối</label>
                                    <select class="selectpicker" data-style="btn-default btn-custom" id="khoi"
                                            name="khoi" required>
                                        <option value="" selected>--- Chọn khối ---</option>
                                        @for($i = 1; $i <= 3; $i++ )
                                            <option value="{{$i}}"
                                                    @if (old('khoi',$Lop->MaKhoi) == $i) selected @endif >{{$i+9}}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Tên lớp</label>
                                    <input name="tenlop" type="text" class="form-control"
                                           value="{{old('tenlop',$Lop->TenLop)}}"
                                           placeholder="Nhập tên lớp..." required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Sỉ số</label>
                                    <input name="siso" type="text" class="form-control"
                                           value="{{old('siso',$Lop->SiSo)}}"
                                           required readonly>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Giáo viên chủ nhiệm</label>
                                    <select class="selectpicker" data-style="btn-default btn-custom" id="giaovien"
                                            name="giaovien" required>
                                        <option value="" selected>--- Chọn GVCN ---</option>
                                        @foreach($dsGV as $detail)
                                            <option value="{{$detail->MaGV}}"
                                                    @if (old('giaovien',$Lop->MaGV) == $detail->MaGV) selected @endif>
                                                {{$detail->TenGV}} &#160;-&#160;@if($detail->GioiTinh == 2)
                                                    Nữ @else Nam @endif
                                                &#160;-&#160; {{date_format(date_create($detail->NgaySinh),'d/m/Y')}}
                                            </option>
                                        @endforeach
                                    </select>
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