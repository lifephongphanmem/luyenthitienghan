<?php

namespace App\Http\Controllers\Hethong;

use App\Http\Controllers\Controller;
use App\Models\Hethong\Chucnang;
use App\Models\Hethong\dsnhomtaikhoan;
use App\Models\Hethong\dsnhomtaikhoan_phanquyen;
use App\Models\Hethong\dstaikhoan_phanquyen;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;


class dstaikhoanController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Session::has('admin')) {
                return redirect('/');
            };
            return $next($request);
        });
    }
    public function ThongTin()
    {
        if (!chkPhanQuyen('taikhoan', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'taikhoan');
        }
        $model = User::where('sadmin','0')->get();
        $a_phanloai=['giaovien'=>1,'hocvien'=>2,'hethong'=>3];
        foreach($model as $ct){
            foreach($a_phanloai as $k=>$val){
                if($ct->$k ==1){
                    $ct->phanloai=$val;
                }
            }
        }
        // dd($model);
        $a_nhomtk = array_column(dsnhomtaikhoan::all()->toArray(), 'tennhomchucnang', 'manhomchucnang');
        return view('Hethong.taikhoan.index')
            ->with('model', $model)
            ->with('a_nhomtk', $a_nhomtk);
    }

    public function store(Request $request)
    {
        if (!chkPhanQuyen('taikhoan', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'taikhoan');
        }
        $inputs = $request->all();
        //Kiểm tra cccd
        $cccd=User::where('cccd',$inputs['cccd'])->first();
        if(isset($cccd)){
            return view('errors.tontaidulieu')
            ->with('message','Số căn cước công dân đã được sử dụng')
            ->with('furl','/TaiKhoan/ThongTin');
        }
        //kiểm tra email
        $email=User::where('email',$inputs['email'])->first();

        if(isset($email) && $email->email != null){
            return view('errors.tontaidulieu')
                        ->with('message','Email đã được sử dụng')
                        ->with('furl','/TaiKhoan/ThongTin');
        }
        $inputs['password'] = Hash::make($inputs['password']);
        // $inputs['mataikhoan']=date('YmdHis');
        // $inputs['email']='a@gmail.com';
        $inputs['status'] = 1;
        switch ($inputs['phanloai']) {
            case '1':
                $inputs['giaovien'] = 1;
                break;
            case '2':
                $inputs['hocvien'] = 1;
                break;
            default:
                $inputs['hethong'] = 1;
                break;
        }
        User::create($inputs);
        return redirect('/TaiKhoan/ThongTin');
    }

    public function update(Request $request, $id)
	{
		if (!chkPhanQuyen('taikhoan', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'taikhoan');
        }
        $validate = $request->validate([
			'email' => 
                [Rule::unique('users')->ignore($id)],
                'cccd' => 
                [Rule::unique('users')->ignore($id)],				
			
			]);
		$inputs = $request->all();
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
                break;
            case '2':
                $inputs['hocvien'] = 1;
                $inputs['giaovien'] = 0;
                $inputs['hethong'] = 0;
                break;
            default:
                $inputs['hehthong'] = 1;
                $inputs['hocvien'] = 0;
                $inputs['giaovien'] = 0;
                break;
        }
		$model->update($inputs);

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
            ->with('m_taikhoan', $m_taikhoan);
    }

    public function luuphanquyen(Request $request)
    {
        if (!chkPhanQuyen('taikhoan', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'taikhoan');
        }
        $inputs = $request->all();
        $inputs['phanquyen'] = isset($inputs['phanquyen']) ? 1 : 0;
        $inputs['danhsach'] = isset($inputs['danhsach']) ? 1 : 0;
        $inputs['thaydoi'] = isset($inputs['thaydoi']) ? 1 : 0;
        $inputs['hoanthanh'] = isset($inputs['hoanthanh']) ? 1 : 0;
        $inputs['danhsach'] = ($inputs['hoanthanh'] == 1 || $inputs['thaydoi'] == 1) ? 1 : $inputs['danhsach'];
        $m_chucnang = Chucnang::where('trangthai', '1')->get();
        $ketqua = new Collection();
        if (isset($inputs['nhomchucnang'])) {
            $this->getChucNang($m_chucnang, $inputs['machucnang'], $ketqua);
        }
        $ketqua->add($m_chucnang->where('maso', $inputs['machucnang'])->first());

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
        $m_taikhoan = User::where('username', $inputs['tendangnhap'])->first();
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
        if ($inputs['phanloaitk'] == 1) {
            return redirect('/TaiKhoan/DanhSach?madv=' . $m_taikhoan->madv);
        } else {
            return redirect('/TaiKhoan/ThongTin?phanloaitk=' . $inputs['phanloaitk']);
        }
    }
}
