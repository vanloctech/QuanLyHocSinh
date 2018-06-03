@extends('index.layout.index')
@section('title')
    <title>Chỉnh sửa điểm - Quản lý học sinh</title>
@endsection
@section('style')
    <link href="assets/plugins/switchery/css/switchery.min.css" rel="stylesheet"/>
    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet"/>
    <link href="assets/css/cssdate.css" rel="stylesheet" type="text/css">
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
            font-size: 1.4em;
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
                <li>
                    <a onclick="close_window();return false" style="cursor: pointer">Xem bảng điểm</a>
                </li>
                <li class="active">
                    Chỉnh sửa điểm
                </li>
            </ol>
        </div>
    </div>

    <!--end duong dan nho-->

    <div class="row">
        <div class="col-sm-6">
            <div class="card-box">
                <h4 class="m-t-0 header-title"><b>Chỉnh sửa điểm</b></h4>
                {{--<p class="text-muted m-b-10 font-13">--}}
                {{--<b>Bắt buộc</b> <code>Tất cả</code>--}}
                {{--</p>--}}
                <div class="row">
                    <form class="form-horizontal" role="form" name="main"
                          action="{{route('sua-diem.post',[$Diem->MaLop,$Diem->MaHK,$Diem->MaMH,$Diem->MaHS])}}"
                          method="post">
                        {{csrf_field()}}
                        <div class="col-md-6">
                            <div class="p-l-r-10">
                                <div class="form-group">
                                    <label class="control-label">Họ & tên</label>
                                    <input name="hoten" type="text" class="form-control"
                                           value="{{old('hoten',$Diem->hocsinh->TenHS)}}"
                                           required readonly>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Lớp</label>
                                    <input name="lop" type="text" class="form-control"
                                           value="{{old('lop',$Diem->lop->TenLop)}}"
                                           required readonly>
                                </div>
                                <hr/>
                                <div class="form-group">
                                    <label class="control-label">Điểm miệng</label><br/>
                                    <button class="ladda-button btn btn-danger" type="button" id="btn-mieng"
                                            onclick="readonly('#mieng','#btn-mieng')"><i class=" fa fa-key"></i>
                                    </button>
                                    <input name="mieng" type="text" class="input-custom"
                                           value="{{$Diem->DiemM==-1?"":$Diem->DiemM}}" id="mieng"
                                           onkeypress="return isNumberKey(event)" readonly>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Điểm 15 phút lần 1</label><br/>
                                    <button class="ladda-button btn btn-danger" type="button" id="btn-15l1"
                                            onclick="readonly('#15l1','#btn-15l1')"><i class=" fa fa-key"></i>
                                    </button>
                                    <input name="l115" type="text" class="input-custom" id="15l1"
                                           value="{{$Diem->Diem15L1==-1?"":$Diem->Diem15L1}}"
                                           onkeypress="return isNumberKey(event)" readonly>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Điểm 15 phút lần 2</label><br/>
                                    <button class="ladda-button btn btn-danger" type="button" id="btn-15l2"
                                            onclick="readonly('#15l2','#btn-15l2')"><i class=" fa fa-key"></i>
                                    </button>
                                    <input name="l215" type="text" class="input-custom" id="15l2"
                                           value="{{$Diem->Diem15L2==-1?"":$Diem->Diem15L2}}"
                                           onkeypress="return isNumberKey(event)" readonly>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Điểm 15 phút lần 3</label><br/>
                                    <button class="ladda-button btn btn-danger" type="button" id="btn-15l3"
                                            onclick="readonly('#15l3','#btn-15l3')"><i class=" fa fa-key"></i>
                                    </button>
                                    <input name="l315" type="text" class="input-custom" id="15l3"
                                           value="{{$Diem->Diem15L3==-1?"":$Diem->Diem15L3}}"
                                           onkeypress="return isNumberKey(event)" readonly>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Điểm trung bình môn</label>
                                    <input name="diemtbm" type="text" class="input-custom tbm" id="diemtbm"
                                           value="{{$Diem->DiemTBM==-1?"":$Diem->DiemTBM}}"
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
                                    <input name="hocky" type="text" class="form-control"
                                           value="{{old('hocky',$Diem->hocky->TenHK)}}"
                                           required readonly>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Môn học</label>
                                    <input name="monhoc" type="text" class="form-control"
                                           value="{{old('monhoc',$Diem->monhoc->TenMH)}}"
                                           required readonly>
                                </div>
                                <hr/>
                                <div class="form-group">
                                    <label class="control-label">Điểm 1 tiết lần 1</label><br/>
                                    <button class="ladda-button btn btn-danger" type="button" id="btn-1tl1"
                                            onclick="readonly('#1tl1','#btn-1tl1')"><i class=" fa fa-key"></i>
                                    </button>
                                    <input name="l11t" type="text" class="input-custom" id="1tl1"
                                           value="{{$Diem->Diem1TL1==-1?"":$Diem->Diem1TL1}}"
                                           onkeypress="return isNumberKey(event)" readonly>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Điểm 1 tiết lần 2</label><br/>
                                    <button class="ladda-button btn btn-danger" type="button" id="btn-1tl2"
                                            onclick="readonly('#1tl2','#btn-1tl2')"><i class=" fa fa-key"></i>
                                    </button>
                                    <input name="l21t" type="text" class="input-custom" id="1tl2"
                                           value="{{$Diem->Diem1TL2==-1?"":$Diem->Diem1TL2}}"
                                           onkeypress="return isNumberKey(event)" readonly>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Điểm 1 tiết lần 3</label><br/>
                                    <button class="ladda-button btn btn-danger" type="button" id="btn-1tl3"
                                            onclick="readonly('#1tl3','#btn-1tl3')"><i class=" fa fa-key"></i>
                                    </button>
                                    <input name="l31t" type="text" class="input-custom" id="1tl3"
                                           value="{{$Diem->Diem1TL3==-1?"":$Diem->Diem1TL3}}"
                                           onkeypress="return isNumberKey(event)" readonly>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Điểm thi học kỳ</label><br/>
                                    <button class="ladda-button btn btn-danger" type="button" id="btn-diemhk"
                                            onclick="readonly('#diemhk','#btn-diemhk')"><i class=" fa fa-key"></i>
                                    </button>
                                    <input name="diemhk" type="text" class="input-custom" id="diemhk"
                                           value="{{$Diem->DiemHK==-1?"":$Diem->DiemHK}}"
                                           onkeypress="return isNumberKey(event)" readonly>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">&nbsp;</label><br/>
                                    <button class="ladda-button btn btn-success" data-style="expand-right" type="button"
                                            onclick="TinhTBM()">Tính điểm TBM
                                    </button>
                                </div>
                                <div class="form-group pull-right">
                                    <button class="ladda-button btn btn-inverse" data-style="expand-right" type="button"
                                            onclick="close_window()">Đóng
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            @if (!session('success') || !$errors)
            <div class="alert alert-success" role="alert" id="luuy">
                <strong>Lưu ý!</strong>
                <button type="button" class="close" data-dismiss="alert">×</button>
                <br>
                Vui lòng bấm lưu lại trước khi tính Trung bình môn(TBM).<br/>
                Sau khi tính điểm TBM, điểm TBM sẽ tự động được lưu lại.
            </div>
            @endif

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
        </div>
    </div>

@endsection
@section('script-ori')
    <script src="assets/plugins/switchery/js/switchery.min.js"></script>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $(document).ready( function() {
            $('#luuy').delay(6000).fadeOut();
        });

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
    </script>
    <script>
        function TinhTBM() {
            $.ajax({
                url: "{{route('ajax-diemtbm.get',[$Diem->MaLop,$Diem->MaHK,$Diem->MaMH,$Diem->MaHS])}}",
                type: "GET",
                async: true,
                success: function (data) {
                    $("#diemtbm").val(data);
                }
            });
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

        function close_window() {
//            if (confirm("Close Window?"))
                close();
        }
        //-->
    </script>
@endsection