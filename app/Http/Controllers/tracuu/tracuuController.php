<?php

namespace App\Http\Controllers\tracuu;

use App\Http\Controllers\Controller;
use App\Models\quanly\giaovien;
use App\Models\quanly\hocvien;
use App\Models\quanly\lophoc;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class tracuuController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Session::has('admin')) {
                return redirect('/DangNhap');
            };
            if (!chksession()) {
                return redirect('/DangNhap');
            };
            chkaction();
            return $next($request);
        });
    }

    public function index()
    {
        if (!chkPhanQuyen('tracuu', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'tracuu');
        }

        $user = Session::get('admin');

        if ($user->giaovien == 1) {
            $loaitaikhoan = 'giaovien';
        } else if ($user->hethong == 1) {
            $loaitaikhoan = 'hethong';
        }

        $a_lophoc = array_column(lophoc::select('malop', 'tenlop')->get()->toarray(), 'tenlop', 'malop');

        return view('tracuu.index', compact('loaitaikhoan'))
            ->with('baocao', getdulieubaocao())
            ->with('a_lophoc', $a_lophoc)
            ->with('pageTitle', 'Thông tin tra cứu');
    }

    public function ketqua(Request $request)
    {
        if (!chkPhanQuyen('tracuu', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'tracuu');
        }

        if ($request['phanloai'] == 'giaovien') {
            // $giaovien = giaovien::leftjoin('lophoc', 'giaovien.magiaovien', '=', 'lophoc.giaovienchunhiem')
            //     ->select('giaovien.tengiaovien', 'giaovien.gioitinh', 'giaovien.ngaysinh', 'giaovien.sdt', 'giaovien.cccd', 'lophoc.tenlop', 'lophoc.malop')
            //     ->where('giaovien.tengiaovien', 'LIKE', '%' . $request['hoten'] . '%')
            //     ->when($request['lophoc'] != '', function ($query) use ($request) {
            //         return $query->where('lophoc.malop', 'LIKE', '%' . $request['lophoc'] . '%');
            //     })->get();
                $giaovien = User::leftjoin('lophoc', 'users.mataikhoan', '=', 'lophoc.giaovienchunhiem')
                ->select('users.tentaikhoan', 'users.gioitinh', 'users.ngaysinh', 'users.sodienthoai', 'users.cccd', 'lophoc.tenlop', 'lophoc.malop')
                ->where('giaovien',1)
                ->where('users.tentaikhoan', 'LIKE', '%' . $request['hoten'] . '%')
                ->when($request['lophoc'] != '', function ($query) use ($request) {
                    return $query->where('lophoc.malop', 'LIKE', '%' . $request['lophoc'] . '%');
                })->get();

            $ketqua = $giaovien;
        } else if ($request['phanloai'] == 'hocvien') {
            // $hocvien = hocvien::leftjoin('lophoc', 'hocvien.malop', '=', 'lophoc.malop')
            $hocvien = User::leftjoin('lophoc', 'users.malop', '=', 'lophoc.malop')
                ->leftJoin('ketquathithu', 'users.mataikhoan', '=', 'ketquathithu.mahocvien')
                ->select('users.tentaikhoan', 'users.gioitinh', 'users.ngaysinh', 'users.sodienthoai', 'users.cccd', 'lophoc.tenlop', 'ketquathithu.diemthi', 'ketquathithu.ngaythi', 'lophoc.malop')
                ->where('users.hocvien',1)
                ->where('users.tentaikhoan', 'LIKE', '%' . $request['hoten'] . '%')
                ->when($request['lophoc'] != '', function ($query) use ($request) {
                    return $query->where('lophoc.malop', 'LIKE', '%' . $request['lophoc'] . '%');
                })
                ->when($request['ngaythi'] != '', function ($query) use ($request) {
                    return $query->where('ketquathithu.ngaythi', '=', $request['ngaythi']);
                })
                ->when($request->has('lonhonoption') || $request->has('nhohonoption'), function ($query) use ($request) {
                    $min_value = 0;
                    $max_value = 200;
                    if ($request->has('lonhonoption') && !$request->has('nhohonoption')) {
                        return $query->whereBetween('ketquathithu.diemthi', [$request['lonhonvalue'], $max_value]);
                    } else if (!$request->has('lonhonoption') && $request->has('nhohonoption')) {
                        return $query->whereBetween('ketquathithu.diemthi', [$min_value, $request['nhohonvalue']]);
                    } else if ($request->has('lonhonoption') && $request->has('nhohonoption')) {
                        return $query->whereBetween('ketquathithu.diemthi', [$request['lonhonvalue'], $request['nhohonvalue']]);
                    }
                })->get();

            $ketqua = $hocvien;
        } else if ($request['phanloai'] == 'tatca') {
            // $giaovien = giaovien::leftjoin('lophoc', 'giaovien.magiaovien', '=', 'lophoc.giaovienchunhiem')
            //     ->select('giaovien.tengiaovien', 'giaovien.gioitinh', 'giaovien.ngaysinh', 'giaovien.sdt', 'giaovien.cccd', 'lophoc.tenlop', 'lophoc.malop')
            //     ->where('giaovien.tengiaovien', 'LIKE', '%' . $request['hoten'] . '%')
            //     ->when($request['lophoc'] != '', function ($query) use ($request) {
            //         return $query->where('lophoc.malop', 'LIKE', '%' . $request['lophoc'] . '%');
            //     })->get();
            $giaovien = User::leftjoin('lophoc', 'users.mataikhoan', '=', 'lophoc.giaovienchunhiem')
            ->select('users.tentaikhoan', 'users.gioitinh', 'users.ngaysinh', 'users.sodienthoai', 'users.cccd', 'lophoc.tenlop', 'lophoc.malop')
            ->where('users.tentaikhoan', 'LIKE', '%' . $request['hoten'] . '%')
            ->when($request['lophoc'] != '', function ($query) use ($request) {
                return $query->where('lophoc.malop', 'LIKE', '%' . $request['lophoc'] . '%');
            })->get();

            // $hocvien = hocvien::leftjoin('lophoc', 'hocvien.malop', '=', 'lophoc.malop')
            //     ->leftJoin('ketquathithu', 'hocvien.mahocvien', '=', 'ketquathithu.mahocvien')
            //     ->select('hocvien.tenhocvien', 'hocvien.gioitinh', 'hocvien.ngaysinh', 'hocvien.sdt', 'hocvien.cccd', 'lophoc.tenlop', 'ketquathithu.diemthi', 'ketquathithu.ngaythi', 'lophoc.malop')
            //     ->where('hocvien.tenhocvien', 'LIKE', '%' . $request['hoten'] . '%')
                $hocvien = User::leftjoin('lophoc', 'users.malop', '=', 'lophoc.malop')
                ->leftJoin('ketquathithu', 'users.mataikhoan', '=', 'ketquathithu.mahocvien')
                ->select('users.tentaikhoan', 'users.gioitinh', 'users.ngaysinh', 'users.sodienthoai', 'users.cccd', 'lophoc.tenlop', 'ketquathithu.diemthi', 'ketquathithu.ngaythi', 'lophoc.malop')
                ->where('users.tentaikhoan', 'LIKE', '%' . $request['hoten'] . '%')
                ->when($request['lophoc'] != '', function ($query) use ($request) {
                    return $query->where('lophoc.malop', 'LIKE', '%' . $request['lophoc'] . '%');
                })
                ->when($request['ngaythi'] != '', function ($query) use ($request) {
                    return $query->where('ketquathithu.ngaythi', '=', $request['ngaythi']);
                })
                ->when($request->has('lonhonoption') || $request->has('nhohonoption'), function ($query) use ($request) {
                    $min_value = 0;
                    $max_value = 200;
                    if ($request->has('lonhonoption') && !$request->has('nhohonoption')) {
                        return $query->whereBetween('ketquathithu.diemthi', [$request['lonhonvalue'], $max_value]);
                    } else if (!$request->has('lonhonoption') && $request->has('nhohonoption')) {
                        return $query->whereBetween('ketquathithu.diemthi', [$min_value, $request['nhohonvalue']]);
                    } else if ($request->has('lonhonoption') && $request->has('nhohonoption')) {
                        return $query->whereBetween('ketquathithu.diemthi', [$request['lonhonvalue'], $request['nhohonvalue']]);
                    }
                })->get();

            if ($request->has('lonhonoption') || $request->has('nhohonoption') || $request['ngaythi'] != '') {
                $ketqua = $hocvien;
            } else {
                $ketqua = array_merge($giaovien->toArray(), $hocvien->toArray());
            }
        }

        return view('tracuu.inketqua', compact('ketqua'))
            ->with('baocao', getdulieubaocao())
            ->with('pageTitle', 'Kết quả tra cứu');
    }
}