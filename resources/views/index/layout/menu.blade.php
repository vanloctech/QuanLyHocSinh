<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>

                <li class="text-muted menu-title">Quản lý phòng học sinh v1.0</li>

                {{--<li class="has_sub">--}}
                    {{--<a href="" class="waves-effect"><i class="ti-home"></i><span> Trang chủ </span></a>--}}
                {{--</li>--}}

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-user"></i>
                        <span> Quản lý học sinh </span> <span class="menu-arrow"></span> </a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('ds-hocsinh.get')}}"> Danh học sinh </a></li>
                        <li><a href="{{route('them-hocsinh.get')}}"> Thêm học sinh </a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-view-list"></i>
                        <span> Quản lý xếp lớp </span> <span class="menu-arrow"></span> </a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('xeplop.get')}}"> Lập  danh sách lớp </a></li>
                        <li><a href="{{route('dshslop.get')}}"> Xem DS học sinh theo lớp </a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-view-list"></i>
                        <span> Quản lý điểm </span> <span class="menu-arrow"></span> </a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('ds-diem.get')}}"> Xem bảng điểm </a></li>
                        <li><a href="{{route('tracuu-diem.get')}}"> Tra cứu điểm </a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-layers-alt"></i>
                        <span> Quản lý giáo viên </span> <span class="menu-arrow"></span> </a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('ds-giaovien.get')}}"> Danh sách giáo viên </a></li>
                        <li><a href="{{route('them-giaovien.get')}}"> Thêm giáo viên </a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-layers-alt"></i>
                        <span> Danh mục </span> <span class="menu-arrow"></span> </a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('ds-lop.get')}}"> Quản lý lớp </a></li>
                        <li><a href="{{route('ds-namhoc.get')}}"> Quản lý năm học </a></li>
                    </ul>
                </li>

                {{--<li class="has_sub">--}}
                    {{--<a href="#" class="waves-effect"><i class="ti-settings"></i><span> Quy định </span></a>--}}
                {{--</li>--}}

                {{--<li class="has_sub">--}}
                    {{--<a href="{{route('ttpk.get')}}" class="waves-effect"><i class="ti-info"></i><span> Thông tin phòng khám </span></a>--}}
                {{--</li>--}}

                {{--<li class="has_sub">--}}
                    {{--<a href="{{route('dangxuat.get')}}" class="waves-effect"><i class="ti-power-off"></i><span> Đăng xuất </span></a>--}}
                {{--</li>--}}

                <li class="text-muted menu-title">Tác giả</li>

                <li class="has_sub">
                    <a href="{{route('aboutus.get')}}" class="waves-effect"><i class="ti-window"></i><span> Về chúng tôi </span></a>
                </li>

            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>