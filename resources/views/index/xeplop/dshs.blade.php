@extends('index.layout.index')
@section('title')
    <title>Danh sách học sinh theo lớp - Quản lý học sinh</title>
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
    {{--<link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>--}}
    {{--<link href="assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet"/>--}}
    <style>
        .styled-select {
            background: url(http://i62.tinypic.com/15xvbd5.png) no-repeat 96% 0;
            height: 25px;
            overflow: hidden;
            width: 200px;
        }

        .styled-select select {
            background: transparent;
            border: none;
            font-size: 14px;
            height: 29px;
            padding: 5px; /* If you add too much padding here, the options won't show in IE */
            width: 200px;
        }

        .styled-select.slate {
            background: url(http://i62.tinypic.com/2e3ybe1.jpg) no-repeat right center;
            height: 34px;
            width: 200px;
        }

        .styled-select.slate select {
            border: 1px solid #ccc;
            font-size: 16px;
            height: 34px;
            width: 200px;
        }

        .slate {
            background-color: #ddd;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <ol class="breadcrumb">
                <li>
                    <a href=""><i class="ti-home"></i></a>
                </li>
                <li class="active">
                    Danh sách học sinh theo lớp
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
            <div class="card-box table-responsive dvData">
                <h4 class="m-t-0 header-title"><b>Danh sách học sinh theo lớp</b></h4>
                <form method="post" action="{{route('xeplop.post')}}" role="form">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="control-label">Năm học </label>
                        <select class="styled-select slate" data-style="btn-default btn-custom" id="namhoc"
                                name="namhoc" onchange="getdsLop(this.value)" required>
                            <option value="" selected>--- Chọn năm học ---</option>
                            @foreach($dsNamHoc as $detail)
                                <option value="{{$detail->MaNH}}">{{$detail->TenNH}}</option>
                            @endforeach
                        </select>
                        <label class="control-label">&nbsp;&nbsp;, lớp&nbsp;&nbsp;</label>
                        <select class="styled-select slate" data-style="btn-default btn-custom" name="lop" id="lop"
                                required>
                            <option value="" selected>--- Chọn lớp ---</option>
                        </select>
                        &nbsp;&nbsp;
                        <button class="ladda-button btn btn-default" data-style="expand-right" type="button"
                                onclick="getdsHS()">Xem danh sách học sinh
                        </button>
                    </div>
                    <table id="datatable-responsive"
                           class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Họ tên</th>
                            <th>Giới tính</th>
                            <th>Năm sinh</th>
                            <th>Địa chỉ</th>
                            {{--<th>Hành động</th>--}}
                        </tr>
                        </thead>

                        <tbody id="data">
                        </tbody>
                    </table>
                </form>
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
    <script>
        function del(id) {
            $.confirm({
                text: "Hành động này sẽ xóa dữ liệu của học sinh này. Bạn có chắc muốn xóa không?",
                title: "Xác nhận xóa",
                confirmButton: "Có, hãy xóa",
                cancelButton: "Không, đừng xóa",
                post: false,
                submitForm: false,
                confirmButtonClass: "btn-danger",
                cancelButtonClass: "btn-default",
                dialogClass: "modal-dialog",
                confirm: function (button) {
                    window.location.assign("hocsinh/xoa/" + id);
                },
                cancel: function (button) {
                }
            });
        }
    </script>
    <script>
        function getdsLop(value) {
            if (value == "")
                $("#lophoc").html("<option value='' selected>--- Chọn lớp ---</option>");
            else {
                $.ajax({
                    url: "ajax/dslop/" + value,
                    type: "GET",
                    async: true,
                    success: function (data) {
                        $("#lop").html(data);
                    }
                });
            }
        }
    </script>
    <script>
        function getdsHS() {
            var value = $("#lop").val();
            $.ajax({
                url: "ajax/dshs/" + value,
                type: "GET",
                async: true,
                success: function (data) {
                    $("#data").html(data);
                }
            });
        }
    </script>
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
                        "searching": false
                    }
            );
        });
    </script>
@endsection