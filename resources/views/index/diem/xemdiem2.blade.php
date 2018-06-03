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
    <style>
        .input-custom {
            padding: 12px;
            margin: 0;
            width: 188px;
            height: 34px;
            border-radius: 5px;
            border: 1px solid #E3E3E3;
        }

        .input-custom:read-only {
            background-color: #EEEEEE;
        }

        .input-custom:focus {
            border-color: #AAAAAA;
            transition-delay: 0.2s;
        }

        .tbm {
            width: 232px;
            color: red;
            font-weight: bold;
            font-size: 1.2em;
        }

        .error
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
                <div class="form-group">
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
                        <th>Hành động</th>
                    </tr>
                    </thead>

                    <tbody style="text-align: center" id="data">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form class="form-horizontal" role="form" name="main"

                              method="post">
                            {{--                            {{csrf_field()}}--}}
                            <div class="col-md-6">
                                <div class="p-l-r-10">
                                    <div class="form-group">
                                        <label class="control-label">Họ & tên</label>
                                        <input name="hoten" type="text" class="form-control" id="hoten"
                                               {{--                                               value="{{old('hoten',$Diem->hocsinh->TenHS)}}"--}}
                                               required readonly>
                                    </div>
                                    <hr/>
                                    <div class="form-group">
                                        <label class="control-label">Điểm miệng</label><br/>
                                        <button class="ladda-button btn btn-danger" type="button" id="btn-mieng"
                                                onclick="readonly('#mieng','#btn-mieng')"><i class=" fa fa-key"></i>
                                        </button>
                                        <input name="mieng" type="text" class="input-custom" id="mieng"
                                               value=""
                                               onkeypress="return isNumberKey(event)" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Điểm 15 phút lần 1</label><br/>
                                        <button class="ladda-button btn btn-danger" type="button" id="btn-15l1"
                                                onclick="readonly('#15l1','#btn-15l1')"><i class=" fa fa-key"></i>
                                        </button>
                                        <input name="l115" type="text" class="input-custom" id="15l1"

                                               onkeypress="return isNumberKey(event)" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Điểm 15 phút lần 2</label><br/>
                                        <button class="ladda-button btn btn-danger" type="button" id="btn-15l2"
                                                onclick="readonly('#15l2','#btn-15l2')"><i class=" fa fa-key"></i>
                                        </button>
                                        <input name="l215" type="text" class="input-custom" id="15l2"

                                               onkeypress="return isNumberKey(event)" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Điểm 15 phút lần 3</label><br/>
                                        <button class="ladda-button btn btn-danger" type="button" id="btn-15l3"
                                                onclick="readonly('#15l3','#btn-15l3')"><i class=" fa fa-key"></i>
                                        </button>
                                        <input name="l315" type="text" class="input-custom" id="15l3"

                                               onkeypress="return isNumberKey(event)" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Điểm trung bình môn</label>
                                        <input name="diemtbm" type="text" class="input-custom tbm" id="diemtbm"

                                               onkeypress="return isNumberKey(event)" readonly>
                                    </div>

                                    <div class="form-group">
                                        <button class="ladda-button btn btn-default" data-style="expand-right">Lưu lại
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-l-r-10">

                                    <div class="form-group">
                                        <label class="control-label">Học kỳ</label>
                                        <input name="hockym" type="text" class="form-control"
                                               required readonly hidden>
                                    </div>
                                    <hr/>
                                    <div class="form-group">
                                        <label class="control-label">Điểm 1 tiết lần 1</label><br/>
                                        <button class="ladda-button btn btn-danger" type="button" id="btn-1tl1"
                                                onclick="readonly('#1tl1','#btn-1tl1')"><i class=" fa fa-key"></i>
                                        </button>
                                        <input name="l11t" type="text" class="input-custom" id="1tl1"

                                               onkeypress="return isNumberKey(event)" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Điểm 1 tiết lần 2</label><br/>
                                        <button class="ladda-button btn btn-danger" type="button" id="btn-1tl2"
                                                onclick="readonly('#1tl2','#btn-1tl2')"><i class=" fa fa-key"></i>
                                        </button>
                                        <input name="l21t" type="text" class="input-custom" id="1tl2"

                                               onkeypress="return isNumberKey(event)" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Điểm 1 tiết lần 3</label><br/>
                                        <button class="ladda-button btn btn-danger" type="button" id="btn-1tl3"
                                                onclick="readonly('#1tl3','#btn-1tl3')"><i class=" fa fa-key"></i>
                                        </button>
                                        <input name="l31t" type="text" class="input-custom" id="1tl3"

                                               onkeypress="return isNumberKey(event)" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Điểm thi học kỳ</label><br/>
                                        <button class="ladda-button btn btn-danger" type="button" id="btn-diemhk"
                                                onclick="readonly('#diemhk','#btn-diemhk')"><i class=" fa fa-key"></i>
                                        </button>
                                        <input name="diemhk" type="text" class="input-custom" id="diemhk"

                                               onkeypress="return isNumberKey(event)" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">&nbsp;</label><br/>
                                        <button class="ladda-button btn btn-success" data-style="expand-right"
                                                type="button"
                                                onclick="TinhTBM()">Tính điểm TBM
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
        //        $(document).ready(function(){
        //            $("#myBtn").click(function(){
        //
        //            });
        //        });

        jQuery.validator.addMethod("checkDecimal", function(value, element) {
            // allow any non-whitespace characters as the host part
            return this.optional( element ) || /^[0-9]{1}\.*[0-9]{0,1}$/.test( value );
        }, 'Điểm tối đa 1 chữ số thập phân.');

        jQuery.validator.setDefaults({
            debug: true,
            success: "valid"
        });

        jQuery.extend(jQuery.validator.messages, {
            max: jQuery.validator.format("Điểm phải nhỏ hơn hoặc bằng {0}."),
            min: jQuery.validator.format("Điểm phải lớn hơn hoặc bằng {0}.")
        });

        $("form[name='main']").validate({
            rules: {
                mieng: {
                    max: 10,
                    min:0,
                    checkDecimal: true
                },
                l115: {
                    max: 10,
                    min:0,
                    checkDecimal: true
                },
                l215: {
                    max: 10,
                    min:0,
                    checkDecimal: true
                },
                l315: {
                    max: 10,
                    min:0,
                    checkDecimal: true
                },
                l11t: {
                    max: 10,
                    min:0,
                    checkDecimal: true
                },
                l21t: {
                    max: 10,
                    min:0,
                    checkDecimal: true
                },
                l31t: {
                    max: 10,
                    min:0,
                    checkDecimal: true
                },
                diemhk: {
                    max: 10,
                    min:0,
                    checkDecimal: true
                }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });

        function SuaDiem(malop,mahk,mamh,mahs) {
            $.ajax({
                url: "diem/ajaxsua/" + 1 + "/" + 1 + "/" + 2 + "/" + 2,
                type: "GET",
                async: true,
                success: function (data) {
                    var getData = $.parseJSON(data);
                    $('#hoten').val(getData.HoTen);
                    $('#mieng').val(getData.DiemM);
                    $('#15l1').val(getData.Diem15L1);
                    $('#15l2').val(getData.Diem15L2);
                    $('#15l3').val(getData.Diem15L3);
                    $('#1tl1').val(getData.Diem1TL1);
                    $('#1tl2').val(getData.Diem1TL2);
                    $('#1tl3').val(getData.Diem1TL3);
                    $('#diemhk').val(getData.DiemHK);
                    $('#diemtbm').val(getData.DiemTBM);
                }
            });
            $("#myModal").modal();
        }

        function readonly(value, value2) {
            if ($(value).is('[readonly]')) {
                $(value).prop('readonly', false);
                $(value2).removeClass('btn-danger');
                $(value2).addClass('btn-success');
            }
            else {
                $(value).prop('readonly', true);
                $(value2).removeClass('btn-success');
                $(value2).addClass('btn-danger');
            }
        }

        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode != 46 && charCode > 31
                    && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }

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
                                "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8]
                            }
                        ],
                        "paging": false,
                        "ordering": false,
                        "info": false,
                        "bFilter": false,
                        "searching": false
                    }
            );
        });
    </script>
@endsection