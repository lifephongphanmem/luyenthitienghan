<ul class="menu-nav">
    <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
        <a href="{{ '/TrangChu' }}" class="menu-link">
            <span class="menu-text text-center" style="text-transform: uppercase"><i class="text-dark-50 fas fa-home"
                    style="font-size: 1.35rem"></i>&nbsp;trang chủ</span>
            <i class="menu-arrow"></i>
        </a>

    </li>
    <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
        <a href="javascript:;" class="menu-link menu-toggle">
            <span class="menu-text text-center">GIÁO TRÌNH&nbsp;<i class="icon-xl fas fa-caret-down"></i></span>
            {{-- <span class="menu-desc">EPS-TOPIK</span> --}}

        </a>
        <div class="menu-submenu menu-submenu-classic menu-submenu-left">
            <ul class="menu-subnav">
                @if (chkPhanQuyen('baihoc', 'phanquyen'))
                    <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                        <a href="javascript:;" class="menu-link menu-toggle"><i
                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                            <span class="menu-text">QUẢN LÝ BÀI HỌC</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                            <ul class="menu-subnav">
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ '/BaiHoc/ThongTin' }}" class="menu-link"><i
                                            class="icon-sm la la-angle-double-right"></i>&nbsp;
                                        <span class="menu-text">QUẢN LÝ BÀI HỌC</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ '/BaiHocChinh/ThongTin' }}" class="menu-link"><i
                                            class="icon-sm la la-angle-double-right"></i>&nbsp;
                                        <span class="menu-text">BÀI HỌC CHÍNH</span>
                                    </a>
                                </li>
                                {{-- <li class="menu-item" aria-haspopup="true">
                        <a href="{{'/TracNghiem/ThongTin'}}" class="menu-link">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                            <span class="menu-text">TRẮC NGHIỆM</span>
                        </a>
                    </li> --}}
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ '/TuVung/ThongTin' }}" class="menu-link"><i
                                            class="icon-sm la la-angle-double-right"></i>&nbsp;
                                        <span class="menu-text">TỪ VỰNG</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ '/HinhAnh/ThongTin' }}" class="menu-link"><i
                                            class="icon-sm la la-angle-double-right"></i>&nbsp;
                                        <span class="menu-text">HÌNH ẢNH</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ '/BaiTap/ThongTin' }}" class="menu-link"><i
                                            class="icon-sm la la-angle-double-right"></i>&nbsp;
                                        <span class="menu-text">BÀI TẬP</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                @if (chkPhanQuyen('giaotrinhchitiet', 'phanquyen'))
                    <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                        <a href="{{ '/GiaoTrinh/ThongTin' }}" class="menu-link "><i
                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                            <span class="menu-text">GIÁO TRÌNH</span>
                        </a>
                    </li>
                @endif
                @if (chkPhanQuyen('60baieps', 'phanquyen'))
                    @foreach ($baocao['giaotrinh'] as $ct)
                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                            <a href="{{ '/GiaoTrinh/60-bai-eps-topik?magiaotrinh=' . $ct->magiaotrinh }}"
                                class="menu-link "><i class="icon-sm la la-angle-double-right"></i>&nbsp;
                                <span class="menu-text text-uppercase">{{ $ct->tengiaotrinh }}</span>
                            </a>
                        </li>
                    @endforeach
                @endif
                {{-- <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                    <a href="{{ '/GiaoTrinh/60-bai-eps-topik?magiaotrinh=1681271756' }}" class="menu-link "><i
                            class="icon-sm la la-angle-double-right"></i>&nbsp;
                        <span class="menu-text">60 BÀI EPS-TOPIK</span>
                    </a>
                </li> --}}
                @if (chkPhanQuyen('960caudoc', 'phanquyen'))
                    <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                        <a href="{{ '/960CauDocHieu' }}" class="menu-link "><i
                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                            <span class="menu-text">960 CÂU ĐỌC HIỂU</span>
                        </a>
                    </li>
                @endif
                @if (chkPhanQuyen('960caunghe', 'phanquyen'))
                    <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                        <a href="{{ '/960CauNgheHieu' }}" class="menu-link "><i
                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                            <span class="menu-text">960 CÂU NGHE HIỂU</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </li>
    <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
        <a href="javascript:;" class="menu-link menu-toggle">
            <span class="menu-text text-center">THI THỬ&nbsp;<i class="icon-xl fas fa-caret-down"></i></span>
            <i class="menu-arrow"></i>
        </a>
        <div class="menu-submenu menu-submenu-classic menu-submenu-right">
            <ul class="menu-subnav">
                @if (chkPhanQuyen('dethi', 'phanquyen'))
                    <li class="menu-item" aria-haspopup="true">

                        <a href="{{ '/DeThi/ThongTin' }}" class="menu-link"><i
                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                            <span class="menu-text">QUẢN LÝ ĐỀ THI</span>
                        </a>
                    </li>
                @endif
                @if (chkPhanQuyen('cauhoi', 'phanquyen'))
                    <li class="menu-item" aria-haspopup="true">
                        <a href="{{ '/CauHoi/ThongTin' }}" class="menu-link"><i
                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                            <span class="menu-text">QUẢN LÝ CÂU HỎI</span>
                        </a>
                    </li>
                @endif
                @if (chkPhanQuyen('phongthi', 'phanquyen'))
                    <li class="menu-item" aria-haspopup="true">
                        <a href="{{ '/PhongThi/ThongTin' }}" class="menu-link"><i
                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                            <span class="menu-text">QUẢN LÝ THI THỬ</span>
                        </a>
                    </li>
                @endif
                @if (chkPhanQuyen('luyenthi', 'phanquyen'))
                    <li class="menu-item" aria-haspopup="true">
                        <a href="{{ '/LuyenThi_EPS' }}" class="menu-link"><i
                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                            <span class="menu-text">LUYỆN THI EPS</span>
                        </a>
                    </li>
                @endif
                @if (session('admin') ? chkThiThu(session('admin')->manguoidung) : '')
                    <li class="menu-item" aria-haspopup="true">
                        <a href="{{ '/ThiThu/EPS-TOPIK' }}" class="menu-link"><i
                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                            <span class="menu-text">THI THỬ EPS</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </li>
    @if (chkPhanQuyen('quanlyhoso', 'phanquyen'))
        <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
            <a href="javascript:;" class="menu-link menu-toggle">
                <span class="menu-text text-center">HỒ SƠ&nbsp;<i class="icon-xl fas fa-caret-down"></i></span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                <ul class="menu-subnav">
                    @if (chkPhanQuyen('giaovien', 'phanquyen'))
                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                            <a href="{{ '/GiaoVien/ThongTin' }}" class="menu-link"><i
                                    class="icon-sm la la-angle-double-right"></i>&nbsp;
                                <span class="menu-text">QUẢN LÝ GIÁO VIÊN</span>
                            </a>
                        </li>
                    @endif
                    @if (chkPhanQuyen('hocvien', 'phanquyen'))
                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                            <a href="{{ '/HocVien/ThongTin' }}" class="menu-link"><i
                                    class="icon-sm la la-angle-double-right"></i>&nbsp;
                                <span class="menu-text">QUẢN LÝ HỌC VIÊN</span>
                            </a>
                        </li>
                    @endif

                    @if (chkPhanQuyen('lophoc', 'phanquyen'))
                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                            <a href="{{ '/LopHoc/ThongTin' }}" class="menu-link"><i
                                    class="icon-sm la la-angle-double-right"></i>&nbsp;
                                <span class="menu-text">QUẢN LÝ LỚP HỌC</span>
                            </a>
                        </li>
                    @endif

                </ul>
            </div>
        </li>
    @endif

    <!-- begin: Thi vòng 2 -->
    <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
        <a href="javascript:;" class="menu-link menu-toggle">
            <span class="menu-text text-center">VÒNG 2 EPS&nbsp;<i class="icon-xl fas fa-caret-down"></i></span>
            <i class="menu-arrow"></i>
        </a>
        <div class="menu-submenu menu-submenu-classic menu-submenu-left">
            <ul class="menu-subnav">
                {{-- @if (chkPhanQuyen('giaovien', 'phanquyen')) --}}
                    <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                        <a href="{{ '/epstopik-test/cauphongvan' }}" class="menu-link"><i
                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                            <span class="menu-text">QUẢN LÝ CÂU PHỎNG VẤN</span>
                        </a>
                    </li>
                {{-- @endif --}}
                {{-- @if (chkPhanQuyen('hocvien', 'phanquyen')) --}}
                    <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                        <a href="{{ '/epstopik-test/video' }}" class="menu-link"><i
                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                            <span class="menu-text">QUẢN LÝ VIDEO NGÀNH HỌC</span>
                        </a>
                    </li>
                {{-- @endif --}}

                {{-- @if (chkPhanQuyen('lophoc', 'phanquyen')) --}}
                    <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                        <a href="{{ '/epstopik-test/ThongTin' }}" class="menu-link"><i
                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                            <span class="menu-text">ÔN THI VÒNG 2 EPS</span>
                        </a>
                    </li>
                {{-- @endif --}}

            </ul>
        </div>
    </li>
    <!-- end: Thi vòng 2 -->

    @if (chkPhanQuyen('baocao', 'phanquyen'))
        <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
            <a href="javascript:;" class="menu-link menu-toggle">
                <span class="menu-text text-center">BÁO CÁO&nbsp;<i class="icon-xl fas fa-caret-down"></i></span>
            </a>
            @if (chkPhanQuyen('thongke', 'phanquyen'))
                <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                    <ul class="menu-subnav">
                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                            <a href="javascript:;" class="menu-link menu-toggle"><i
                                    class="icon-sm la la-angle-double-right"></i>&nbsp;
                                <span class="menu-text">THỐNG KÊ</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                <ul class="menu-subnav">
                                    <li class="menu-item" aria-haspopup="true">
                                        <a data-target="#modify-modal-danhsach" data-toggle="modal"
                                            class="menu-link"><i class="icon-sm la la-angle-double-right"></i>&nbsp;
                                            <span class="menu-text">DANH SÁCH HỌC VIÊN</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            @endif
        </li>
    @endif

    @if (chkPhanQuyen('tracuu', 'phanquyen'))
        <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
            <a href="{{ '/TraCuu' }}" class="menu-link">
                <span class="menu-text text-center">TRA CỨU</span>
                <i class="menu-arrow"></i>
            </a>
        </li>
    @endif

    <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
        <a href="javascript:;" class="menu-link menu-toggle">
            <span class="menu-text text-center">TIN TỨC&nbsp;<i class="icon-xl fas fa-caret-down"></i></span>
            <i class="menu-arrow"></i>
        </a>
        <div class="menu-submenu menu-submenu-classic menu-submenu-right">
            <ul class="menu-subnav">
                <li class="menu-item" aria-haspopup="true">
                    <a href="{{ '/TinTuc/TrangChu' }}" class="menu-link"><i
                            class="icon-sm la la-angle-double-right"></i>&nbsp;
                        <span class="menu-text">TIN TỨC</span>
                    </a>
                </li>
                @if (chkPhanQuyen('tintuc', 'phanquyen'))
                    <li class="menu-item" aria-haspopup="true">
                        <a href="{{ '/TinTuc/QuanLy' }}" class="menu-link"><i
                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                            <span class="menu-text">QUẢN LÝ TIN TỨC</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </li>

    @if (chkPhanQuyen('hethong', 'phanquyen'))
        <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
            <a href="javascript:;" class="menu-link menu-toggle">
                <span class="menu-text text-center">HỆ THỐNG&nbsp;<i class="icon-xl fas fa-caret-down"></i></span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                <ul class="menu-subnav">
                    @if (chkPhanQuyen('danhmuc', 'phanquyen'))
                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                            <a href="javascript:;" class="menu-link menu-toggle"><i
                                    class="icon-sm la la-angle-double-right"></i>&nbsp;
                                <span class="menu-text">DANH MỤC</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                <ul class="menu-subnav">
                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="{{ '/LoaiCauHoi/ThongTin' }}" class="menu-link"><i
                                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                                            <span class="menu-text">Loại câu hỏi</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="menu-subnav">
                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="{{ '/DiaBan/ThongTin' }}" class="menu-link"><i
                                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                                            <span class="menu-text">Danh mục hành chính</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="menu-subnav">
                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="{{ '/TrinhDoGDPT/ThongTin' }}" class="menu-link"><i
                                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                                            <span class="menu-text">Trình độ GDPT</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="menu-subnav">
                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="{{ '/TrinhDoCMKT/ThongTin' }}" class="menu-link"><i
                                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                                            <span class="menu-text">Trình độ CMKT</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="menu-subnav">
                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="{{ '/DoiTuongUuTien/ThongTin' }}" class="menu-link"><i
                                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                                            <span class="menu-text">Đối tượng ưu tiên</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="menu-subnav">
                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="{{ '/NganhHoc/ThongTin' }}" class="menu-link"><i
                                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                                            <span class="menu-text">Ngành học</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="menu-subnav">
                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="{{ '/dmLopHoc/ThongTin' }}" class="menu-link"><i
                                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                                            <span class="menu-text">Lớp học</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="menu-subnav">
                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="{{ '/NguonCauHoi/ThongTin' }}" class="menu-link"><i
                                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                                            <span class="menu-text">Nguồn câu hỏi</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif

                    <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                        <a href="javascript:;" class="menu-link menu-toggle"><i
                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                            <span class="menu-text">HỆ THỐNG CHUNG</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                            <ul class="menu-subnav">
                                @if (chkPhanQuyen('taikhoan', 'phanquyen'))
                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="{{ '/TaiKhoan/ThongTin' }}" class="menu-link"><i
                                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                                            <span class="menu-text">Tài khoản</span>
                                        </a>
                                    </li>
                                @endif
                                @if (chkPhanQuyen('chucnang', 'phanquyen'))
                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="{{ '/Chuc_nang/ThongTin' }}" class="menu-link"><i
                                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                                            <span class="menu-text">Chức năng</span>
                                        </a>
                                    </li>
                                @endif
                                @if (chkPhanQuyen('nhomtaikhoan', 'phanquyen'))
                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="{{ '/nhomchucnang/ThongTin' }}" class="menu-link"><i
                                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                                            <span class="menu-text">Nhóm tài khoản</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                    @if (chkPhanQuyen('quantrihethong', 'phanquyen'))
                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                            <a href="javascript:;" class="menu-link menu-toggle"><i
                                    class="icon-sm la la-angle-double-right"></i>&nbsp;
                                <span class="menu-text text-uppercase">quản trị hệ thống</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                <ul class="menu-subnav">
                                    @if (chkPhanQuyen('loghethong', 'phanquyen'))
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{ '/LogHeThong/ThongTin' }}" class="menu-link"><i
                                                    class="icon-sm la la-angle-double-right"></i>&nbsp;
                                                <span class="menu-text text-uppercase">Nhật ký sử dụng</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if (chkPhanQuyen('cauhinhhethong', 'phanquyen'))
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{ '/CauHinhHeThong/ThongTin' }}" class="menu-link"><i
                                                    class="icon-sm la la-angle-double-right"></i>&nbsp;
                                                <span class="menu-text text-uppercase">thư mục lưu nhật ký</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if (chkPhanQuyen('generalconfig', 'phanquyen'))
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{ '/generalconfig/ThongTin' }}" class="menu-link"><i
                                                    class="icon-sm la la-angle-double-right"></i>&nbsp;
                                                <span class="menu-text text-uppercase">thiết lập hệ thống</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </li>
    @endif
    @if (Session::has('admin'))
        @if (session('admin')->sadmin == 'SSA')
            <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
                <a href="{{ '/van_phong/danh_sach' }}" class="menu-link">
                    <span class="menu-text text-center" style="text-transform: uppercase"></i>&nbsp;vp hỗ trợ</span>
                    <i class="menu-arrow"></i>
                </a>

            </li>
        @endif
    @endif

</ul>
