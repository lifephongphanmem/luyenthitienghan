<?php

namespace App\Http\Controllers\quanly;

use App\Http\Controllers\Controller;
use App\Models\Hethong\dstaikhoan_phanquyen;
use App\Models\ketqua\ketquathithu;
use App\Models\quanly\hocvien;
use App\Models\quanly\lophoc;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class hocvienController extends Controller
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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!chkPhanQuyen('hocvien', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'hocvien');
        }

        if (in_array(session('admin')->sadmin, ['SSA', 'ADMIN']) || session('admin')->hethong == 1) {
            // $model = hocvien::all();
            $model = User::join('hocvien','hocvien.sdt','users.sodienthoai')->where('hocvien',1)->get();
        } else if (session('admin')->giaovien == 1) {
            $model = User::join('lophoc', 'lophoc.malop', 'users.malop')
                ->join('hocvien','hocvien.sdt','users.sodienthoai')
                ->select('users.*','hocvien.*')
                ->where('lophoc.giaovienchunhiem', session('admin')->mataikhoan)
                ->get();
        }
        // dd($model);
        return view('quanly.hocvien.index')
            ->with('model', $model)
            ->with('baocao', getdulieubaocao())
            ->with('pageTitle', 'Quản lý học viên');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!chkPhanQuyen('hocvien', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'hocvien');
        }
        $inputs = $request->all();
        //check cccd
        $sdt = hocvien::where('sdt', $inputs['sdt'])->first();
        if (isset($sdt)) {
            return view('errors.tontaidulieu')
                ->with('furl', '/HocVien/ThongTin')
                ->with('message', 'Số điện thoại đã được sử dụng');
        }
        ;

        $inputs['mahocvien'] = getdate()[0];
        hocvien::create($inputs);
        $taikhoan = User::where('sodienthoai', $inputs['sdt'])->first();
        //Tạo tài khoản
        if (!isset($taikhoan)) {
            // $data = [
            //     'tentaikhoan' => $inputs['tenhocvien'],
            //     'cccd' => $inputs['cccd'],
            //     'password' => Hash::make('123456abc'),
            //     'hocvien' => 1,
            //     'sodienthoai' => $inputs['sdt'],
            //     'mataikhoan' => date('YmdHis'),
            //     'manhomchucnang' => 1680748012
            // ];
            $inputs['tentaikhoan']=$inputs['tenhocvien'];
            $inputs['password']=Hash::make('123456abc');
            $inputs['hocvien']=1;
            $inputs['mataikhoan']=$inputs['mahocvien'];
            $inputs['sodienthoai']=$inputs['sdt'];
            $inputs['manhomchucnang']=1680748012;
            User::create($inputs);
            add_phanquyen('1680748012',$inputs['sdt']);
        }
        return redirect('/HocVien/ThongTin')
            ->with('success', 'Thêm mới thành công');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $mahocvien)
    {
        // $hocvien = hocvien::where('mahocvien', $mahocvien)->first();
        $hocvien = User::where('mataikhoan', $mahocvien)->first();

        $ketquathi = ketquathithu::join('dethi', 'ketquathithu.madethi', '=', 'dethi.made')
            ->where('mahocvien', $mahocvien)
            ->orderBy('ketquathithu.created_at', 'DESC')
            ->get();

        return view('quanly.hocvien.chitiet', compact('hocvien', 'ketquathi'))
            ->with('baocao', getdulieubaocao())
            ->with('pageTitle', 'Thông tin học viên');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!chkPhanQuyen('hocvien', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'hocvien');
        }

        $model = User::findOrFail($id);
        return response()->json($model);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!chkPhanQuyen('hocvien', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'hocvien');
        }

        $inputs = $request->all();
        $model = User::findOrFail($id);
        if (isset($model)) {
            if($model->sodienthoai != $inputs['sdt']){
                $model->update(['sodienthoai'=>$inputs['sdt']]);
                // add_phanquyen('1680748012',$inputs['cccd']);
            }
            $user=hocvien::where('sdt',$model->sodienthoai)->first();
            if(isset($user)){
                $user->update($inputs);
            }
            $inputs['tentaikhoan']=$inputs['tenhocvien'];
            $inputs['sodienthoai']=$inputs['sdt'];
            $model->update($inputs);
        }

        return redirect('/HocVien/ThongTin')
            ->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!chkPhanQuyen('hocvien', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'hocvien');
        }
        // $model = hocvien::findOrFail($id);
        $model = User::findOrFail($id);
        
        if (isset($model)) {
            // $taikhoan = User::where('cccd', $model->cccd)->delete();
            $lophoc = lophoc::where('malop', $model->malop)->first();
            $lophoc->soluonghocvien--;
            $lophoc->save();
            hocvien::where('sdt',$model->sodienthoai)->delete();

            //Xóa phân quyền
            dstaikhoan_phanquyen::where('tendangnhap',$model->sodienthoai)->delete();

            $model->delete();

        }

        return redirect('/HocVien/ThongTin')
            ->with('success', 'Xóa thành công');
    }
}