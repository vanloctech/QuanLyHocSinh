@extends('index.layout.index')
@section('title')
    <title>Thêm lớp học - Quản lý học sinh</title>
@endsection
@section('style')
    <link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet"/>
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
                    Thêm lớp học
                </li>
            </ol>
        </div>
    </div>

    @if (count($errors) > 0 || session('error'))
        <div class="alert alert-danger" role="alert">
            <strong>Cảnh báo!</strong>
            <button type="button" class="close" data-dismiss="alert">×</button>
            <br>
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
            @foreach(session('success') as $suc)
                {{$suc}}<br/>
            @endforeach
        </div>
    @endif

    <!--end duong dan nho-->

    <div class="row">
        <div class="col-sm-6">
            <div class="card-box">
                <h4 class="m-t-0 header-title"><b>Thêm lớp học</b></h4>
                <p class="text-muted m-b-10 font-13">
                    <b>Bắt buộc</b> <code>Tất cả</code>
                </p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="p-l-r-10">
                            <form class="form-horizontal" role="form" action="{{route('them-lop.post')}}"
                                  method="post">
                                {{csrf_field()}}

                                <div class="form-group">
                                    <label class="control-label">Năm học</label>
                                    <select class="selectpicker" data-style="btn-default btn-custom" id="namhoc"
                                            name="namhoc" required>
                                        <option value="">--- Chọn năm học ---</option>
                                        @foreach($dsNamHoc as $detail)
                                            <option value="{{ $detail->MaNH }}"
                                                    @if (old('namhoc') == $detail->MaNH) selected @endif>
                                                {{ $detail->TenNH }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Thêm Lớp nhanh (Mỗi lớp 1 dòng với cấu trúc: Khối/Tên-lớp/Mã-GV)</label><br/>
                                    <textarea name="dslop" rows="10" cols="65"></textarea>
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
        <div class="col-sm-6">
            <div class="card-box table-responsive dvData">
                <h4 class="m-t-0 header-title"><b>Danh sách giáo viên</b></h4>
                <table id="datatable-responsive"
                       class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        {{--<th>#ID</th>--}}
                        <th>Mã giáo viên</th>
                        <th>Họ tên</th>
                        <th>Giới tính</th>
                        <th>Ngày sinh</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($dsGV as $detail)
                        <tr>
                            <td>{{$detail->MaGV}}</td>
                            <td>{{$detail->TenGV}}</td>
                            <td>
                                @if($detail->GioiTinh == 2)
                                    Nữ
                                @elseif($detail->GioiTinh == 1)
                                    Nam
                                @endif
                            </td>
                            <td>{{date_format(date_create($detail->NgaySinh),'d/m/Y')}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@section('script-ori')
    <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="assets/plugins/datatables/buttons.bootstrap.min.js"></script>
    <script src="assets/plugins/datatables/jszip.min.js"></script>
    <script src="assets/plugins/datatables/vfs_fonts.js"></script>
    <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="assets/plugins/datatables/responsive.bootstrap.min.js"></script>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#datatable-responsive').DataTable(
                    {
                        "columnDefs": [
                            {
                                "className": "text-center",
                                "targets": [0, 1, 2, 3]
                            }
                        ],
//                        "paging":   false,
                        "ordering": false,
//                        "info":     false,
                        "bFilter": false,
                        "searching": true
                    }
            );
        });
    </script>
@endsection