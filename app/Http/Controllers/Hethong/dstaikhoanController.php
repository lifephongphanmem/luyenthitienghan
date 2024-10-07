<?php

namespace App\Http\Controllers\Hethong;

use App\Http\Controllers\Controller;
use App\Models\Hethong\Chucnang;
use App\Models\Hethong\dsnhomtaikhoan;
use App\Models\Hethong\dsnhomtaikhoan_phanquyen;
use App\Models\Hethong\dstaikhoan_phanquyen;
use App\Models\ketqua\ketquathithu;
use App\Models\quanly\giaovien;
use App\Models\quanly\hocvien;
use App\Models\quanly\lophoc;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class dstaikhoanController extends Controller
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
    public function ThongTin(Request $request)
    {
        if (!chkPhanQuyen('taikhoan', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'taikhoan');
        }
        $inputs = $request->all();

        if (session('admin')->sadmin == 'SSA') {
            $model = User::where('sadmin', '<>', 'SSA')
                ->where(function ($q) use ($inputs) {
                    if (isset($inputs['nhomcn'])) {
                        if ($inputs['nhomcn'] == 4) {
                            $q->where('manhomchucnang', 0);
                        } else {
                            $q->where('manhomchucnang', $inputs['nhomcn']);
                        }
                    }
                })
                ->get();
        } else {
            $model = User::where('sadmin', '0')
                ->where(function ($q) use ($inputs) {
                    if (isset($inputs['nhomcn'])) {
                        $q->where('manhomchucnang', $inputs['nhomcn']);
                    }
                })
                ->get();
        }

        $a_phanloai = ['giaovien' => 1, 'hocvien' => 2, 'hethong' => 3];
        foreach ($model as $ct) {
            foreach ($a_phanloai as $k => $val) {
                if ($ct->$k == 1) {
                    $ct->phanloai = $val;
                }
            }
        }

        $inputs['nhomcn'] = isset($inputs['nhomcn']) ? $inputs['nhomcn'] : '';
        $inputs['url'] = '/TaiKhoan/ThongTin';
        // dd($model);
        $a_nhomtk = array_column(dsnhomtaikhoan::all()->toArray(), 'tennhomchucnang', 'manhomchucnang');
        return view('Hethong.taikhoan.index')
            ->with('model', $model->sortbyDesc('id'))
            ->with('baocao', getdulieubaocao())
            ->with('a_nhomtk', $a_nhomtk)
            ->with('inputs', $inputs)
            ->with('pageTitle', 'Quản lý tài khoản');
    }

    public function store(Request $request)
    {
        if (!chkPhanQuyen('taikhoan', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'taikhoan');
        }
        $inputs = $request->all();
        //Kiểm tra cccd
        // $cccd = User::where('cccd', $inputs['cccd'])->first(); chuyển sang dùng sđt để đăng nhập
        $sdt = User::where('sodienthoai', $inputs['sodienthoai'])->first();
        if (isset($sdt)) {
            return view('errors.tontaidulieu')
                ->with('message', 'Số điện thoại đã được sử dụng')
                ->with('furl', '/TaiKhoan/ThongTin');
        }
        //kiểm tra email
        $email = User::where('email', $inputs['email'])->first();

        if (isset($email) && $email->email != null) {
            return view('errors.tontaidulieu')
                ->with('message', 'Email đã được sử dụng')
                ->with('furl', '/TaiKhoan/ThongTin');
        }
        $inputs['password'] = Hash::make($inputs['password']);
        $inputs['mataikhoan'] = date('YmdHis');
        // $inputs['email']='a@gmail.com';
        $inputs['status'] = 1;
        switch ($inputs['phanloai']) {
            case '1':
                $inputs['giaovien'] = 1;
                $data = [
                    'magiaovien' => $inputs['mataikhoan'],
                    'tengiaovien' => $inputs['tentaikhoan'],
                    // 'cccd' => $inputs['cccd'],
                    'sodienthoai' => $inputs['sodienthoai'],
                    'email' => $inputs['email'],
                ];
                giaovien::create($data);
                break;
            case '2':
                $inputs['hocvien'] = 1;
                $data = [
                    'mahocvien' => $inputs['mataikhoan'],
                    'tenhocvien' => $inputs['tentaikhoan'],
                    // 'cccd' => $inputs['cccd'],
                    'sodienthoai' => $inputs['sodienthoai'],
                    'email' => $inputs['email'],
                ];
                hocvien::create($data);
                break;
            default:
                $inputs['hethong'] = 1;
                break;
        }
        User::create($inputs);
        add_phanquyen($inputs['manhomchucnang'], $inputs['sodienthoai']);
        loghethong(getIP(), session('admin'), 'them', 'taikhoan');
        return redirect('/TaiKhoan/ThongTin');
    }

    public function update(Request $request, $id)
    {
        if (!chkPhanQuyen('taikhoan', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'taikhoan');
        }

        $validator = Validator::make($request->all(), [
            'sodienthoai' => 'required|unique:users,sodienthoai,' . $id
        ]);

        if ($validator->fails()) {

            return redirect('/TaiKhoan/ThongTin')->with('error', 'Số điện thoại đã được sử dụng');
        }
        // dd(1);

        $inputs = $request->all();
        // dd($inputs);
        $model = User::findOrFail($id);
        // $model = User::where('username',$inputs['username'])->first();
        if ($inputs['password'] == '') {
            $inputs['password'] = $model->password;
        } else {
            $inputs['password'] = Hash::make($inputs['password']);
        }
        // $inputs['phanloai'] == 'tonghop'?$inputs['tonghop']=1:$inputs['nhaplieu']=1;
        switch ($inputs['phanloai']) {
            case '1':
                $inputs['giaovien'] = 1;
                $inputs['hocvien'] = 0;
                $inputs['hethong'] = 0;
                $inputs['tengiaovien'] = $inputs['tentaikhoan'];
                $gv = giaovien::where('sdt', $model->sodienthoai)->first();
                $gv->update($inputs);
                break;
            case '2':
                $inputs['hocvien'] = 1;
                $inputs['giaovien'] = 0;
                $inputs['hethong'] = 0;
                $inputs['tenhocvien'] = $inputs['tentaikhoan'];
                $hv = hocvien::where('sdt', $model->sodienthoai)->first();
                $hv->update($inputs);
                break;
            default:
                $inputs['hethong'] = 1;
                $inputs['hocvien'] = 0;
                $inputs['giaovien'] = 0;
                break;
        }

        if ($model->sadmin != 'ADMIN') {
            if ($inputs['sodienthoai'] != $model->sodienthoai) {
                dstaikhoan_phanquyen::where('tendangnhap', $model->sodienthoai)->delete();
                add_phanquyen($inputs['manhomchucnang'], $inputs['sodienthoai']);
            }
            if ($inputs['manhomchucnang'] != $model->manhomchucnang) {
                dstaikhoan_phanquyen::where('tendangnhap', $model->sodienthoai)->delete();
                add_phanquyen($inputs['manhomchucnang'], $inputs['sodienthoai']);
            }
        } else {
            if ($inputs['sodienthoai'] != $model->sodienthoai) {
                dstaikhoan_phanquyen::where('tendangnhap', $model->sodienthoai)->update(['tendangnhap' => $inputs['sodienthoai']]);
            }
            $inputs['manhomchucnang'] = 0;
        }

        $model->update($inputs);

        loghethong(getIP(), session('admin'), 'capnhat', 'taikhoan');
        return redirect('/TaiKhoan/ThongTin');
    }

    public function phanquyen(Request $request)
    {
        if (!chkPhanQuyen('taikhoan', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'taikhoan');
        }
        $inputs = $request->all();
        $m_taikhoan = User::where('cccd', $inputs['tendangnhap'])->first();
        $m_phanquyen = dstaikhoan_phanquyen::where('tendangnhap', $inputs['tendangnhap'])->get();
        $m_chucnang = Chucnang::where('trangthai', '1')->get();

        foreach ($m_chucnang as $chucnang) {
            $phanquyen = $m_phanquyen->where('machucnang', $chucnang->maso)->first();
            $chucnang->phanquyen = $phanquyen->phanquyen ?? 0;
            $chucnang->danhsach = $phanquyen->danhsach ?? 0;
            $chucnang->thaydoi = $phanquyen->thaydoi ?? 0;
            $chucnang->hoanthanh = $phanquyen->hoanthanh ?? 0;
            $chucnang->nhomchucnang = $m_chucnang->where('machucnang_goc', $chucnang->maso)->count() > 0 ? 1 : 0;
        }

        return view('Hethong.taikhoan.phanquyen')
            ->with('model', $m_chucnang->where('capdo', '1')->sortby('id'))
            ->with('m_chucnang', $m_chucnang)
            ->with('m_taikhoan', $m_taikhoan)
            ->with('baocao', getdulieubaocao())
            ->with('pageTitle', 'Phân quyền tài khoản');
    }

    public function luuphanquyen(Request $request)
    {
        if (!chkPhanQuyen('taikhoan', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'taikhoan');
        }
        $inputs = $request->all();
        // dd($inputs);
        $inputs['phanquyen'] = isset($inputs['phanquyen']) ? 1 : 0;
        $inputs['danhsach'] = isset($inputs['danhsach']) ? 1 : 0;
        $inputs['thaydoi'] = isset($inputs['thaydoi']) ? 1 : 0;
        $inputs['hoanthanh'] = isset($inputs['hoanthanh']) ? 1 : 0;
        $inputs['danhsach'] = ($inputs['hoanthanh'] == 1 || $inputs['thaydoi'] == 1) ? 1 : $inputs['danhsach'];
        $m_chucnang = Chucnang::where('trangthai', '1')->get();
        $ketqua = new Collection();
        if (isset($inputs['nhomchucnang'])) {
            // $this->getChucNang($m_chucnang, $inputs['machucnang'], $ketqua);
            $ketqua = $m_chucnang->where('machucnang_goc', $inputs['machucnang']);
        }

        $ketqua->add($m_chucnang->where('maso', $inputs['machucnang'])->first());
        // dd($ketqua);
        foreach ($ketqua as $ct) {
            $chk = dstaikhoan_phanquyen::where('machucnang', $ct->maso)->where('tendangnhap', $inputs['tendangnhap'])->first();
            $a_kq = [
                'machucnang' => $ct->maso,
                'tendangnhap' => $inputs['tendangnhap'],
                'phanquyen' => $inputs['phanquyen'],
                'danhsach' => $inputs['danhsach'],
                'thaydoi' => $inputs['thaydoi'],
                'hoanthanh' => $inputs['hoanthanh'],
            ];
            if ($chk == null) {
                dstaikhoan_phanquyen::create($a_kq);
            } else {
                $chk->update($a_kq);
            }
        }
        loghethong(getIP(), session('admin'), 'phanquyen', 'taikhoan');
        return redirect('/TaiKhoan/PhanQuyen?tendangnhap=' . $inputs['tendangnhap'])
            ->with('success', 'Phân quyền thành công');
    }

    function getChucNang(&$dschucnang, $machucnang_goc, &$ketqua)
    {

        foreach ($dschucnang as $key => $val) {
            if ($val->machucnang_goc == $machucnang_goc) {
                $ketqua->add($val);
                $dschucnang->forget($key);
                $this->getChucNang($dschucnang, $val->machucnang, $ketqua);
            }
        }
    }

    public function NhomChucNang(Request $request)
    {

        if (!chkPhanQuyen('taikhoan', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'taikhoan');
        }
        $inputs = $request->all();
        $m_taikhoan = User::where('cccd', $inputs['tendangnhap'])->first();
        // dd($inputs);

        if (!isset($inputs['manhomchucnang'])) {
            return view('errors.404')
                ->with('message', 'Bạn cần chọn nhóm chức năng cho tài khoản để cài lại phân quyền')
                ->with('url', '/TaiKhoan/DanhSach?madonvi=' . $m_taikhoan->madonvi);
        }

        $a_phanquyen = [];
        foreach (dsnhomtaikhoan_phanquyen::where('manhomchucnang', $inputs['manhomchucnang'])->get() as $phanquyen) {
            $a_phanquyen[] = [
                "tendangnhap" => $inputs['tendangnhap'],
                "machucnang" => $phanquyen->machucnang,
                "phanquyen" => $phanquyen->phanquyen,
                "danhsach" => $phanquyen->danhsach,
                "thaydoi" => $phanquyen->thaydoi,
                "hoanthanh" => $phanquyen->hoanthanh,
            ];
        }
        //Xóa phân quyền cũ
        dstaikhoan_phanquyen::where('tendangnhap', $inputs['tendangnhap'])->delete();
        //Lưu thông tin nhóm tài khoản
        $m_taikhoan->manhomchucnang = $inputs['manhomchucnang'];
        $m_taikhoan->save();
        //Lưu phân uyền
        dstaikhoan_phanquyen::insert($a_phanquyen);
        loghethong(getIP(), session('admin'), 'phanquyentaikhoannhom', 'taikhoan');
        return redirect('/TaiKhoan/ThongTin?nhomcn=' . $inputs['manhomchucnang']);
    }

    public function destroy($id)
    {
        if (!chkPhanQuyen('taikhoan', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'taikhoan');
        }
        $model = User::findOrFail($id);
        if (isset($model)) {
            if ($model->hocvien == 1) {
                $hocvien = hocvien::where('sdt', $model->sodienthoai)->first();
                if (isset($hocvien)) {
                    $hocvien->delete();
                }
            }
            if ($model->giaovien == 1) {
                $giaovien = giaovien::where('sdt', $model->sodienthoai)->first();
                if (isset($giaovien)) {
                    $giaovien->delete();
                }
            }

            $lophoc=lophoc::where('malop',$model->malop)->first();
            if(isset($lophoc) && $lophoc->soluonghocvien > 0){
                $lophoc->soluonghocvien--;
                $lophoc->save();
            }
            //xóa ở bảng phân quyền
            $phanquyen = dstaikhoan_phanquyen::where('tendangnhap', $model->sodienthoai)->delete();

            $model->delete();
            loghethong(getIP(), session('admin'), 'xoa', 'taikhoan');
        }

        return redirect('/TaiKhoan/ThongTin')->with('message', 'Xóa thành công');
    }
    public function quanlytaikhoan()
    {
        if (!chkPhanQuyen('quanlytaikhoan', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'quanlytaikhoan');
        }
        // dd(session('admin'));
        // if(session('admin')->sadmin != 'SSA'){
        $model = User::where('cccd', session('admin')->cccd)->first();
        $ketquathi = new ketquathithu();
        if (session('admin')->hocvien == 1) {
            // $hocvien = hocvien::where('cccd', $model->cccd)->first();
            // $model->sdt = $hocvien->sdt;
            // $model->gioitinh = $hocvien->gioitinh;
            // $model->ngaysinh = $hocvien->ngaysinh;
            // $model->diachi = $hocvien->diachi;
            // $model->hoten = $model->tentaikhoan;
            $ketquathi = ketquathithu::join('dethi', 'ketquathithu.madethi', '=', 'dethi.made')
                ->where('mahocvien', $model->mataikhoan)
                ->orderBy('ketquathithu.created_at', 'DESC')
                ->get();
        }
        // if (session('admin')->giaovien == 1) {
        //     $giaovien = giaovien::where('cccd', $model->cccd)->first();
        //     // $model->sdt = $giaovien->sdt;
        //     // $model->gioitinh = $giaovien->gioitinh;
        //     // $model->ngaysinh = $giaovien->ngaysinh;
        //     // $model->diachi = $giaovien->diachi;
        //     // $model->hoten = $giaovien->tengiaovien;
        //     // $ketquathi=new ketquathithu();
        // }
        // }

        return view('Hethong.taikhoan.quanlytaikhoan')
            ->with('model', $model)
            ->with('ketquathi', $ketquathi)
            ->with('baocao', getdulieubaocao())
            ->with('pageTitle', 'Quản lý tài khoản');
    }

    public function doimatkhau(Request $request)
    {

        if (!chkPhanQuyen('doimatkhau', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'quanlytaikhoan');
        }
        $inputs = $request->all();

        if ($inputs['password'] != $inputs['cpass']) {
            return view('errors.tontaidulieu')
                ->with('message', 'Nhập lại mật khẩu chưa khớp')
                ->with('furl', '/TaiKhoan/QuanLyTaiKhoan');
        }

        if ($inputs['password'] == '123456abc') {
            return view('errors.tontaidulieu')
                ->with('message', 'Mật khẩu mới phải khác mật khẩu mặc định được cấp')
                ->with('furl', '/TaiKhoan/QuanLyTaiKhoan');
        }

        $model = User::where('cccd', session('admin')->cccd)->first();
        $inputs['password'] = Hash::make($inputs['password']);
        if (isset($model)) {
            $model->update(['password' => $inputs['password'], 'dnlandau' => 1]);
            if (Session::has('admin')) {
                Session::flush();
            }
            return redirect('/DangNhap')
                ->with('success', 'Đổi mật khẩu thành công');
        } else {
            return redirect('/TaiKhoan/QuanLyTaiKhoan')
                ->with('error', 'Đổi mật khẩu thất bại');
        }
    }

    public function capnhatthongtincanhan(Request $request)
    {
        if (!chkPhanQuyen('thongtincanhan', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'quanlytaikhoan');
        }

        $inputs = $request->all();
        // dd($inputs);
        $user = User::where('cccd', session('admin')->cccd)->first();
        if ($user->hocvien == 1) {
            $hocvien = hocvien::where('cccd', $user->cccd)->first();
            $inputs['tenhocvien'] = $inputs['hoten'];
            if (isset($hocvien)) {
                $hocvien->update($inputs);
            }
        }

        if ($user->giaovien == 1) {
            $giaovien = giaovien::where('cccd', $user->cccd)->first();
            $inputs['tengiaovien'] = $inputs['hoten'];
            if (isset($giaovien)) {
                $giaovien->update($inputs);
            }
        }

        // $data = [
        //     'tentaikhoan' => $inputs['hoten'],
        //     'email' => $inputs['email'],
        //     'sodienthoai' => $inputs['sdt']
        // ];
        $inputs['tentaikhoan'] = $inputs['hoten'];
        $inputs['sodienthoai'] = $inputs['sdt'];
        $user->update($inputs);

        return redirect('/TaiKhoan/QuanLyTaiKhoan')
            ->with('success', 'Cập nhật thành công');
    }
    public function phanquyenluyenthi(Request $request)
    {
        $inputs = $request->all();
        if (isset($inputs['mahocvien'])) {
            $m_hocvien = User::select('cccd', 'malop')->where('hocvien', 1)->where('cccd', $inputs['mahocvien'])->get();
            $malop = $m_hocvien->first()->malop;
            $url = '/LopHoc/chitiet?lophoc=' . $malop;
        } else {
            $m_hocvien = User::select('cccd')->where('hocvien', 1)->where('malop', $inputs['malop'])->get();
            $url = '/LopHoc/ThongTin';
        }

        $a_hocvien = array_column($m_hocvien->toarray(), 'cccd');
        if (count($a_hocvien) > 0) {
            // dstaikhoan_phanquyen::wherein('tendangnhap',$a_hocvien)->where('machucnang','luyenthi')->update(['phanquyen'=>$phanquyen]);
            foreach ($a_hocvien as $val) {
                $model = dstaikhoan_phanquyen::where('tendangnhap', $val)->where('machucnang', 'luyenthi')->first();
                if (isset($model)) {
                    $model->update(['phanquyen' => $inputs['trangthai']]);
                } else {
                    $data = [
                        'machucnang' => 'luyenthi',
                        'tendangnhap' => $val,
                        'phanquyen' => $inputs['trangthai'],
                        'danhsach' => 0,
                        'thaydoi' => 0,
                        'hoanthanh' => 0,
                    ];
                    dstaikhoan_phanquyen::create($data);
                }
            }
        }
        if (isset($inputs['malop'])) {
            $lophoc = lophoc::where('malop', $inputs['malop'])->update(['phanquyenluyenthi' => $inputs['trangthai']]);
        }


        return redirect($url)
            ->with('success', 'Thay đổi thành công');
    }

    public function phanquyenkhoahoc(Request $request)
    {
        $inputs = $request->all();
        $inputs['trangthai'] = $inputs['kh_khoahoc'];
        $inputs['giaotrinh'] = array();
        isset($inputs['60baieps']) ? array_push($inputs['giaotrinh'], $inputs['60baieps']) : '';
        isset($inputs['960caudoc']) ? array_push($inputs['giaotrinh'], $inputs['960caudoc']) : '';
        isset($inputs['960caunghe']) ? array_push($inputs['giaotrinh'], $inputs['960caunghe']) : '';
        // dd($inputs);
        $khoahoc = implode(';', $inputs['giaotrinh']);
        // $m_hocvien=hocvien::select('cccd')->where('malop',$inputs['malop'])->get();
        if (isset($inputs['mahocvien'])) {
            $m_hocvien = User::select('cccd', 'malop')->where('hocvien', 1)->where('cccd', $inputs['mahocvien'])->get();
            $malop = $m_hocvien->first()->malop;
            $url = '/LopHoc/chitiet?lophoc=' . $malop;
        } else {
            $m_hocvien = User::select('cccd')->where('hocvien', 1)->where('malop', $inputs['malop'])->get();
            $url = '/LopHoc/ThongTin';
        }
        $a_hocvien = array_column($m_hocvien->toarray(), 'cccd');
        if (count($a_hocvien) > 0) {
            foreach ($inputs['giaotrinh'] as $ct) {
                foreach ($a_hocvien as $val) {
                    $model = dstaikhoan_phanquyen::where('tendangnhap', $val)->where('machucnang', $ct)->first();
                    if (isset($model)) {
                        $model->update(['phanquyen' => $inputs['trangthai']]);
                    } else {
                        $data = [
                            'machucnang' => $ct,
                            'tendangnhap' => $val,
                            'phanquyen' => $inputs['trangthai'],
                            'danhsach' => 0,
                            'thaydoi' => 0,
                            'hoanthanh' => 0,
                        ];
                        dstaikhoan_phanquyen::create($data);
                    }
                }
            }
        }

        if (isset($inputs['malop'])) {
            $thongtin = [
                'giaotrinhhoc' => $khoahoc,
                'phanquyengiaotrinhhoc' => $inputs['trangthai']
            ];
            lophoc::where('malop', $inputs['malop'])->update($thongtin);
        }
        return redirect($url)
            ->with('success', 'Thay đổi thành công');
    }

    public function khoataikhoan(Request $request)
    {
        $inputs = $request->all();
        if (isset($inputs['mahocvien'])) {
            $m_hocvien = User::select('cccd', 'malop')->where('hocvien', 1)->where('cccd', $inputs['mahocvien'])->get();
            $malop = $m_hocvien->first()->malop;
            $url = '/LopHoc/chitiet?lophoc=' . $malop;
        } else {
            $m_hocvien = User::select('cccd')->where('hocvien', 1)->where('malop', $inputs['malop'])->get();
            $url = '/LopHoc/ThongTin';
        }
        $a_hocvien = array_column($m_hocvien->toarray(), 'cccd');
        if (count($a_hocvien) > 0) {
            User::wherein('cccd', $a_hocvien)->update(['trangthai' => $inputs['trangthai']]);
        }
        if (isset($inputs['malop'])) {
            lophoc::where('malop', $inputs['malop'])->update(['khoataikhoan' => $inputs['trangthai']]);
        }
        return redirect($url)
            ->with('success', 'Thay đổi thành công');
    }

    public function getnhontaikhoan(Request $request)
    {
        $inputs = $request->all();
        $m_nhomtaikhoan = dsnhomtaikhoan::all();

        switch ($inputs['phanloai']) {
            case '1': //Nhóm giáo viên
                {
                    $nhomtaikhoan = $m_nhomtaikhoan->where('manhomchucnang', '1680747743');
                    break;
                }
            case '2': //Nhóm học viên
                {
                    $nhomtaikhoan = $m_nhomtaikhoan->wherenotin('manhomchucnang', ['1680747743', '1696908822']);
                    break;
                }
            case '3': //Nhóm quản lý
                {
                    $nhomtaikhoan = $m_nhomtaikhoan->where('manhomchucnang', '1696908822');
                    break;
                }
        }

        $html = '';
        if ($inputs['action'] === 'add') {
            $html .= '<div class="col-md-6 mt-1" id="manhomchucnang">';
        } else {
            $html .= '<div class="col-md-6 mt-1" id="manhomchucnang_update">';
        }

        $html .= '<label class="control-label">Tên nhóm chức năng<span class="require">*</span></label>';
        $html .= '<select name="manhomchucnang" class="form-control select2basic" style="width:100%" required>';
        // $html .= ' <option value="">-- Chọn nhóm chức năng --</option>';
        foreach ($nhomtaikhoan as $k => $ct) {
            $html .= ' <option value="' . $ct->manhomchucnang . '">' . $ct->tennhomchucnang . '</option>';
        }
        $html .= '</select>';
        $html .= '</div>';

        return response()->json($html);
    }

    public function chuyendulieu()
    {

        //Chuyển số cccd sang số điện thoại để chạy lại đăng nhập
        $m_taikhoan = User::wherenull('sodienthoai')->get();
        if (count($m_taikhoan) > 0) {
            foreach ($m_taikhoan as $ct) {
                $ct->update(['sodienthoai' => $ct->cccd]);
            };
        }
        //chuyển cccd sang sdt của bảng giáo viên và học sinh
        $m_giaovien = giaovien::all();
        if (count($m_giaovien) > 0) {
            foreach ($m_giaovien as $val) {
                $val->update(['sdt' => $val->cccd]);
            };
        }
        $m_hocvien = hocvien::all();
        if (count($m_hocvien) > 0) {
            foreach ($m_hocvien as $item) {
                $item->update(['sdt' => $item->cccd]);
            };
        }
        return redirect('/TaiKhoan/ThongTin');
    }
}
