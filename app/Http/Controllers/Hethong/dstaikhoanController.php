<?php

namespace App\Http\Controllers\Hethong;

use App\Http\Controllers\Controller;
use App\Models\Hethong\Chucnang;
use App\Models\Hethong\dsnhomtaikhoan;
use App\Models\Hethong\dsnhomtaikhoan_phanquyen;
use App\Models\Hethong\dstaikhoan_phanquyen;
use App\Models\quanly\giaovien;
use App\Models\quanly\hocvien;
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
                return redirect('/DangNhap');
            };
            return $next($request);
        });
    }
    public function ThongTin(Request $request)
    {
        if (!chkPhanQuyen('taikhoan', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'taikhoan');
        }
        $inputs=$request->all();
        
        $model = User::where('sadmin','0')
                    ->where(function($q) use ($inputs){
                        if(isset($inputs['nhomcn'])){
                            $q->where('manhomchucnang',$inputs['nhomcn']);
                        }
                    })
                    ->get();
        $a_phanloai=['giaovien'=>1,'hocvien'=>2,'hethong'=>3];
        foreach($model as $ct){
            foreach($a_phanloai as $k=>$val){
                if($ct->$k ==1){
                    $ct->phanloai=$val;
                }
            }
        }
        $inputs['nhomcn']=isset($inputs['nhomcn'])?$inputs['nhomcn']:'';
        $inputs['url']='/TaiKhoan/ThongTin';
        // dd($model);
        $a_nhomtk = array_column(dsnhomtaikhoan::all()->toArray(), 'tennhomchucnang', 'manhomchucnang');
        return view('Hethong.taikhoan.index')
            ->with('model', $model)
            ->with('baocao',getdulieubaocao())
            ->with('a_nhomtk', $a_nhomtk)
            ->with('inputs',$inputs)
            ->with('pageTitle','Quản lý tài khoản');
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
        $inputs['mataikhoan']=date('YmdHis');
        // $inputs['email']='a@gmail.com';
        $inputs['status'] = 1;
        switch ($inputs['phanloai']) {
            case '1':
                $inputs['giaovien'] = 1;
                $data=[
                    'magiaovien'=>$inputs['cccd'].'_'.getdate()[0],
                    'tengiaovien'=>$inputs['tentaikhoan'],
                    'cccd'=>$inputs['cccd'],
                    'email'=>$inputs['email'],
                ];
                giaovien::create($data);
                break;
            case '2':
                $inputs['hocvien'] = 1;
                $data=[
                    'hocvien'=>$inputs['cccd'].'_'.getdate()[0],
                    'tenhocvien'=>$inputs['tentaikhoan'],
                    'cccd'=>$inputs['cccd'],
                    'email'=>$inputs['email'],
                ];
                hocvien::create($data);
                break;
            default:
                $inputs['hethong'] = 1;
                break;
        }
        User::create($inputs);
        loghethong(getIP(),session('admin'),'them','taikhoan');
        return redirect('/TaiKhoan/ThongTin');
    }

    public function update(Request $request, $id)
	{
		if (!chkPhanQuyen('taikhoan', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'taikhoan');
        }

        // $validate = $request->validate([
		// 	'email' => 
        //         [Rule::unique('users')->ignore($id)],
        //         'cccd' => 
        //         [Rule::unique('users')->ignore($id)],							
		// 	]);
        
        $validate=$request->validate([
            'cccd'=>'unique:users,cccd,'.$id,
            // 'email'=>'unique:users,email,'.$id
        ],
        [
        'cccd.unique'=>'CCCD đã được sử dụng'
        ]);

        // if($validate->fails()){
        //     return redirect('/TaiKhoan/ThongTin')->with('error','CCCD đã được sử dụng');
        // }
// dd(1);

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
                $inputs['tengiaovien'] = $inputs['tentaikhoan'];
                $gv=giaovien::where('cccd',$model->cccd)->first();
                $gv->update($inputs);
                break;
            case '2':
                $inputs['hocvien'] = 1;
                $inputs['giaovien'] = 0;
                $inputs['hethong'] = 0;
                $inputs['tenhocvien'] = $inputs['tentaikhoan'];
                $hv=hocvien::where('cccd',$model->cccd)->first();
                $hv->update($inputs);
                break;
            default:
                $inputs['hehthong'] = 1;
                $inputs['hocvien'] = 0;
                $inputs['giaovien'] = 0;
                break;
        }
		$model->update($inputs);
        loghethong(getIP(),session('admin'),'capnhat','taikhoan');
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
            ->with('baocao',getdulieubaocao())
            ->with('pageTitle','Phân quyền tài khoản');
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
            $ketqua=$m_chucnang->where('machucnang_goc',$inputs['machucnang']);
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
        loghethong(getIP(),session('admin'),'phanquyen','taikhoan');
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
        loghethong(getIP(),session('admin'),'phanquyentaikhoannhom','taikhoan');
            return redirect('/TaiKhoan/ThongTin?nhomcn=' . $inputs['manhomchucnang']);

    }

    public function destroy($id)
    {
        if (!chkPhanQuyen('taikhoan', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'taikhoan');
        }
        $model=User::findOrFail($id);
        if(isset($model)){
            if($model->hocvien == 1){
                $hocvien=hocvien::where('cccd',$model->cccd)->first();
                if(isset($hocvien)){
                    $hocvien->delete();
                }
            }
            if($model->giaovien == 1){
                $giaovien=giaovien::where('cccd',$model->cccd)->first();
                if(isset($giaovien)){
                    $giaovien->delete();
                }
            }

            $model->delete();
            loghethong(getIP(),session('admin'),'xoa','taikhoan');
        }

        return redirect('/TaiKhoan/ThongTin')->with('message','Xóa thành công');
    }
}
