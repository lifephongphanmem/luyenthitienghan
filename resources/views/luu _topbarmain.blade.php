                            <!--begin::Left-->
                            <div class="d-none d-lg-flex align-items-center mr-3">
                                <!--begin::Logo-->
                                <a href="{{ '/TrangChu' }}" class="mr-20">
                                    <img alt="Logo" src="{{ url('assets/media/logos/ttdvvl.png') }}"
                                        class="max-h-55px" />
                                </a>
                                <!--end::Logo-->
                                <!--begin::Desktop Search-->
                                <div class="quick-search quick-search-inline ml-4 w-300px" id="kt_quick_search_inline">
                                    <!--begin::Form-->
                                    <form method="get" class="quick-search-form">
                                        <div class="input-group rounded bg-light">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <span class="svg-icon svg-icon-lg">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <path
                                                                    d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                                                                    fill="#000000" fill-rule="nonzero"
                                                                    opacity="0.3" />
                                                                <path
                                                                    d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                                                                    fill="#000000" fill-rule="nonzero" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control h-45px"
                                                placeholder="Search..." />
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="quick-search-close ki ki-close icon-sm"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </form>
                                    <!--end::Form-->
                                    <!--begin::Search Toggle-->
                                    <div id="kt_quick_search_toggle" data-toggle="dropdown" data-offset="0px,1px">
                                    </div>
                                    <!--end::Search Toggle-->
                                    <!--begin::Dropdown-->
                                    <div
                                        class="dropdown-menu dropdown-menu-left dropdown-menu-lg dropdown-menu-anim-up">
                                        <div class="quick-search-wrapper scroll" data-scroll="true" data-height="350"
                                            data-mobile-height="200"></div>
                                    </div>
                                    <!--end::Dropdown-->
                                </div>
                                <!--end::Desktop Search-->
                            </div>
                            <!--end::Left-->
                            <!--begin::Topbar-->
                            <div class="topbar">
                                <!--begin::Notifications-->
                                @if (Session::has('admin'))
                                    @if (session('admin')->giaovien == 1)
                                        <div class="dropdown">
                                            <!--begin::Toggle-->
                                            <div class="topbar-item" data-offset="10px,0px">
                                                <a href="{{ '/HDSD/HDSD Tiếng Hàn (giáo viên).docx' }}"
                                                    title="Hướng dẫn sử dụng">
                                                    <div
                                                        class="btn btn-icon btn-hover-transparent-white btn-dropdown btn-lg mr-1 pulse pulse-primary">
                                                        <span class="svg-icon svg-icon-xl">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-book"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                                                            </svg>
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Toggle-->
                                        </div>
                                    @endif
                                    @if (session('admin')->sadmin == 'ADMIN')
                                        <div class="dropdown">
                                            <!--begin::Toggle-->
                                            <div class="topbar-item" data-offset="10px,0px">
                                                <a href="{{ '/HDSD/HDSD Tiếng Hàn (admin).docx' }}"
                                                    title="Hướng dẫn sử dụng">
                                                    <div
                                                        class="btn btn-icon btn-hover-transparent-white btn-dropdown btn-lg mr-1 pulse pulse-primary">
                                                        <span class="svg-icon svg-icon-xl">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-book"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                                                            </svg>
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Toggle-->
                                        </div>
                                    @endif
                                    <!--end::Notifications-->
                                    <!--begin::Notifications-->
                                    <div class="dropdown">
                                        <!--begin::Toggle-->
                                        <div class="topbar-item" data-offset="10px,0px">
                                            <a href="{{ '/thongtinhotro' }}" target="_blank" title="Trợ giúp">
                                                <div
                                                    class="btn btn-icon btn-hover-transparent-white btn-dropdown btn-lg mr-1 pulse pulse-primary">

                                                    <span class="svg-icon svg-icon-xl">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Active-call.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <path
                                                                    d="M13.0799676,14.7839934 L15.2839934,12.5799676 C15.8927139,11.9712471 16.0436229,11.0413042 15.6586342,10.2713269 L15.5337539,10.0215663 C15.1487653,9.25158901 15.2996742,8.3216461 15.9083948,7.71292558 L18.6411989,4.98012149 C18.836461,4.78485934 19.1530435,4.78485934 19.3483056,4.98012149 C19.3863063,5.01812215 19.4179321,5.06200062 19.4419658,5.11006808 L20.5459415,7.31801948 C21.3904962,9.0071287 21.0594452,11.0471565 19.7240871,12.3825146 L13.7252616,18.3813401 C12.2717221,19.8348796 10.1217008,20.3424308 8.17157288,19.6923882 L5.75709327,18.8875616 C5.49512161,18.8002377 5.35354162,18.5170777 5.4408655,18.2551061 C5.46541191,18.1814669 5.50676633,18.114554 5.56165376,18.0596666 L8.21292558,15.4083948 C8.8216461,14.7996742 9.75158901,14.6487653 10.5215663,15.0337539 L10.7713269,15.1586342 C11.5413042,15.5436229 12.4712471,15.3927139 13.0799676,14.7839934 Z"
                                                                    fill="#000000" />
                                                                <path
                                                                    d="M14.1480759,6.00715131 L13.9566988,7.99797396 C12.4781389,7.8558405 11.0097207,8.36895892 9.93933983,9.43933983 C8.8724631,10.5062166 8.35911588,11.9685602 8.49664195,13.4426352 L6.50528978,13.6284215 C6.31304559,11.5678496 7.03283934,9.51741319 8.52512627,8.02512627 C10.0223249,6.52792766 12.0812426,5.80846733 14.1480759,6.00715131 Z M14.4980938,2.02230302 L14.313049,4.01372424 C11.6618299,3.76737046 9.03000738,4.69181803 7.1109127,6.6109127 C5.19447112,8.52735429 4.26985715,11.1545872 4.51274152,13.802405 L2.52110319,13.985098 C2.22450978,10.7517681 3.35562581,7.53777247 5.69669914,5.19669914 C8.04101739,2.85238089 11.2606138,1.72147333 14.4980938,2.02230302 Z"
                                                                    fill="#000000" fill-rule="nonzero"
                                                                    opacity="0.3" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>

                                                    <span class="pulse-ring">Trợ giúp</span>
                                                    {{-- <span class="menu-text">Trợ giúp</span> --}}
                                                </div>
                                            </a>
                                        </div>
                                        <!--end::Toggle-->
                                    </div>
                                    <!--end::Notifications-->

                                    <!--begin::User-->
                                    <div class="topbar-item">
                                        <div class="btn btn-icon btn-hover-transparent-white w-auto d-flex align-items-center btn-lg px-2"
                                            id="kt_quick_user_toggle">
                                            <div class="d-flex flex-column text-right pr-3">
                                                <span
                                                    class="text-white font-weight-bolder font-size-sm d-none d-md-inline">{{ session('admin') ? session('admin')->tentaikhoan : '' }}</span>
                                            </div>
                                            <span class="symbol symbol-35">
                                                <div class="symbol symbol-35 mr-3">
                                                    <img alt="Pic"
                                                        src="{{ '/assets/media/users/blank.png' }}" />
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                @else
                                    <a href="{{ '/DangNhap' }}" title="Đăng nhập">
                                        <div class="topbar-item" data-offset="10px,0px">
                                            <div
                                                class="btn btn-icon btn-hover-transparent-white w-auto d-flex align-items-center btn-lg px-2">

                                                <span class="symbol symbol-35">
                                                    <div class="symbol symbol-35 mr-3">
                                                        <i class="icon-xl fas fa-sign-in-alt"></i>
                                                    </div>
                                                </span>
                                                <div class="d-flex flex-column text-right pr-3">
                                                    <span
                                                        class="text-white font-weight-bolder font-size-sm d-none d-md-inline">ĐĂNG
                                                        NHẬP</span>
                                                </div>
                                            </div>
                                    </a>
                                @endif
                            </div>
                        </div>