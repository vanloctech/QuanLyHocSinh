@extends('index.layout.index')
@section('title')
    <title>Xem bảng điểm - Quản lý học sinh</title>
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
            width: 180px;
        }

        .styled-select select {
            background: transparent;
            border: none;
            font-size: 14px;
            height: 29px;
            padding: 5px; /* If you add too much padding here, the options won't show in IE */
            width: 180px;
        }

        .styled-select.slate {
            background: url(http://i62.tinypic.com/2e3ybe1.jpg) no-repeat right center;
            height: 34px;
            width: 180px;
        }

        .styled-select.slate select {
            border: 1px solid #ccc;
            font-size: 16px;
            height: 34px;
            width: 180px;
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
                    Xem bảng điểm
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
                <h4 class="m-t-0 header-title"><b>Xem bảng điểm</b></h4>

                {{csrf_field()}}
                <div class="form-group hidden-print">
                    <label class="control-label">Năm học</label>&#160;&#160;
                    <select class="styled-select slate" data-style="btn-default btn-custom" id="namhoc"
                            name="namhoc" onchange="getdsLop();getdsHocKy(this.value)" required>
                        <option value="" selected>--- Chọn năm học ---</option>
                        @foreach($dsNamHoc as $detail)
                            <option value="{{$detail->MaNH}}">{{$detail->TenNH}}</option>
                        @endforeach
                    </select>&#160;&#160;
                    <label class="control-label"> Lớp </label>&#160;&#160;
                    <select class="styled-select slate" data-style="btn-default btn-custom" name="lop" id="lop"
                            required style="width: 150px;">
                        <option value="" selected>--- Chọn lớp ---</option>
                    </select>&#160;&#160;
                    <label class="control-label"> Học kỳ </label>&#160;&#160;
                    <select class="styled-select slate" data-style="btn-default btn-custom" name="hocky" id="hocky"
                            required style="width: 150px;">
                        <option value="" selected>--- Chọn học kỳ ---</option>
                    </select>&#160;&#160;
                    <label class="control-label"> Môn học</label>&#160;&#160;
                    <select class="styled-select slate" data-style="btn-default btn-custom" name="monhoc"
                            id="monhoc" required style="width: 180px;">
                        <option value="" selected>--- Chọn môn học ---</option>
                        @foreach($dsMonHoc as $detail)
                            <option value="{{$detail->MaMH}}">{{$detail->TenMH}}</option>
                        @endforeach
                    </select>&#160;&#160;&#160;&#160;
                    <button class="ladda-button btn btn-default" data-style="expand-right" type="button"
                            onclick="XemDiem()">Xem điểm
                    </button>
                </div>
                <div class="form-group">
                </div>
                <table id="datatable-responsive"
                       class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        {{--<th>#</th>--}}
                        <th>STT</th>
                        <th>Họ tên</th>
                        <th>Giới tính</th>
                        <th>Ngày sinh</th>
                        <th>Miệng</th>
                        <th>15 Phút</th>
                        <th>1 Tiết</th>
                        <th>Thi HK</th>
                        <th>TBM</th>
                        <th class="hidden-print">Hành động</th>
                    </tr>
                    </thead>

                    <tbody style="text-align: center" id="data">
                    </tbody>
                </table>
                <div class="hidden-print p-t-10">
                    <div class="pull-right">
                        <a href="javascript:window.print()" class="btn btn-inverse waves-effect waves-light"><i
                                    class="fa fa-print"></i></a>
                    </div>
                </div>
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
        function getdsLop() {
            var value = $("#namhoc").val();
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

        function getdsHocKy(value) {
            if (value == "")
                $("#hocky").html("<option value='' selected>--- Chọn học kỳ ---</option>");
            else {
                $.ajax({
                    url: "ajax/dshocky/" + value,
                    type: "GET",
                    async: true,
                    success: function (data) {
                        $("#hocky").html(data);
                    }
                });
            }
        }

        function XemDiem() {
            var lop = $("#lop").val();
            var hocky = $("#hocky").val();
            var monhoc = $("#monhoc").val();
            var token = $("input[name='_token']").val();
            if (!lop || !hocky || !monhoc) {
                alert("Bạn chưa chọn các thông tin.");
            }
            else {
                $.ajax({
                    url: "{{route('ajax-ds-diem.get')}}",
                    type: "GET",
                    async: true,
                    data: {
                        "_token": token,
                        "lop": lop,
                        "hocky": hocky,
                        "monhoc": monhoc
                    },
                    success: function (data) {
                        $("#data").html(data);
                    }
                });
            }
        }

    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#datatable-responsive').DataTable(
                    {
                        "columnDefs": [
                            {
                                "className": "text-center",
                                "targets": [0, 1, 2, 3,4,5,6,7,8]
                            }
                        ],
                        "paging":   false,
                        "ordering": false,
                        "info":     false,
                        "bFilter": false,
                        "searching": false
                    }
            );
        });
    </script>
@endsection