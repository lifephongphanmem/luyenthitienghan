<?php

namespace App\Http\Controllers\quanly;

use App\Http\Controllers\Controller;
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
            $model = User::where('hocvien',1)->get();
        } else if (session('admin')->giaovien == 1) {
            $model = User::join('lophoc', 'lophoc.malop', 'users.malop')
                ->select('users.*')
                ->where('lophoc.giaovienchunhiem', session('admin')->manguoidung)
                ->get();
        }
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
        $cccd = hocvien::where('cccd', $inputs['cccd'])->first();
        if (isset($cccd)) {
            return view('errors.tontaidulieu')
                ->with('furl', '/HocVien/ThongTin')
                ->with('message', 'CCCD đã được sử dụng');
        }
        ;

        $inputs['mahocvien'] = getdate()[0];
        hocvien::create($inputs);
        $taikhoan = User::where('cccd', $inputs['cccd'])->first();
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
            $inputs['manhomchucnang']=1680747743;
            User::create($inputs);
            add_phanquyen('1680748012',$inputs['cccd']);
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
            if($model->cccd != $inputs['cccd']){
                $model->update(['cccd'=>$inputs['cccd']]);
                // add_phanquyen('1680748012',$inputs['cccd']);
            }
            $user=hocvien::where('cccd',$model->cccd)->first();
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
            // $lophoc = lophoc::where('malop', $model->malop)->delete();
            hocvien::where('cccd',$model->cccd)->delete();
            $model->delete();

        }

        return redirect('/HocVien/ThongTin')
            ->with('success', 'Xóa thành công');
    }
}