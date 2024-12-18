<?php

namespace App\Http\Controllers\Hethong;

use App\Http\Controllers\Controller;
use App\Models\Hethong\Chucnang;
use App\Models\Hethong\dsnhomtaikhoan;
use App\Models\Hethong\dsnhomtaikhoan_phanquyen;
use App\Models\Hethong\dstaikhoan_phanquyen;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class dsnhomtaikhoanController extends Controller
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
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!chkPhanQuyen('nhomtaikhoan', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'nhomtaikhoan');
        }
        $inputs = $request->all();
        $model = dsnhomtaikhoan::orderBy('stt')->get();        
        $m_taikhoan = User::all();
        foreach ($model as $ct){
            $ct->soluong = $m_taikhoan->where('manhomchucnang', $ct->manhomchucnang)->count();
        }
        return view('Hethong.nhomchucnang.index')
            ->with('model', $model)
            ->with('baocao',getdulieubaocao())
            ->with('inputs', $inputs)
            ->with('pageTitle', 'Quản lý nhóm tài khoản');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!chkPhanQuyen('nhomtaikhoan', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'nhomtaikhoan');
        }
        $inputs = $request->all();
        $model = dsnhomtaikhoan::where('manhomchucnang', $inputs['manhomchucnang'])->first();
        if ($model == null) {
            $inputs['manhomchucnang'] = getdate()[0];
            dsnhomtaikhoan::create($inputs);
            loghethong(getIP(),session('admin'),'them','nhomtaikhoan');
        } else {

            $model->update($inputs);
            loghethong(getIP(),session('admin'),'capnhat','nhomtaikhoan');
        }

        return redirect('/nhomchucnang/ThongTin')
        ->with('success','Thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function PhanQuyen(Request $request)
    {
        if (!chkPhanQuyen('nhomtaikhoan', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'nhomtaikhoan');
        }
        $inputs = $request->all();
        $m_nhomtaikhoan = dsnhomtaikhoan::where('manhomchucnang', $inputs['manhomchucnang'])->first();
        $m_nhomphanquyen = dsnhomtaikhoan_phanquyen::where('manhomchucnang', $inputs['manhomchucnang'])->get();
        $m_chucnang = Chucnang::where('trangthai', '1')->get();
        foreach ($m_chucnang as $chucnang) {
            $phanquyen = $m_nhomphanquyen->where('machucnang', $chucnang->maso)->first();
            $chucnang->phanquyen = $phanquyen->phanquyen ?? 0;
            $chucnang->danhsach = $phanquyen->danhsach ?? 0;
            $chucnang->thaydoi = $phanquyen->thaydoi ?? 0;
            $chucnang->hoanthanh = $phanquyen->hoanthanh ?? 0;
            $chucnang->nhomchucnang = $m_chucnang->where('machucnang_goc', $chucnang->maso)->count() > 0 ? 1 : 0;
        }
        // dd($m_chucnang);
        return view('Hethong.nhomchucnang.phanquyen')
            ->with('model', $m_chucnang->where('capdo', '1')->sortby('sapxep'))
            ->with('m_chucnang', $m_chucnang)
            ->with('m_nhomtaikhoan', $m_nhomtaikhoan)
            ->with('baocao',getdulieubaocao())
            ->with('pageTitle', 'Phân quyền nhóm tài khoản');
    }

    public function LuuPhanQuyen(Request $request)
    {
        if (!chkPhanQuyen('nhomtaikhoan', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'nhomtaikhoan');
        }

        $inputs = $request->all();
        $inputs['phanquyen'] = isset($inputs['phanquyen']) ? 1 : 0;
        $inputs['danhsach'] = isset($inputs['danhsach']) ? 1 : 0;
        $inputs['thaydoi'] = isset($inputs['thaydoi']) ? 1 : 0;
        $inputs['hoanthanh'] = isset($inputs['hoanthanh']) ? 1 : 0;
        $inputs['danhsach'] = ($inputs['hoanthanh'] == 1 || $inputs['thaydoi'] == 1) ? 1 : $inputs['danhsach'];
        // dd($inputs);
        $m_chucnang = Chucnang::where('trangthai', '1')->get();
        $ketqua = new Collection();
        if (isset($inputs['nhomchucnang'])) {
            // $this->getChucNang($m_chucnang, $inputs['machucnang'], $ketqua);
            $ketqua=$m_chucnang->where('machucnang_goc',$inputs['machucnang']);
        }
        $ketqua->add($m_chucnang->where('maso', $inputs['machucnang'])->first());

        foreach ($ketqua as $ct) {
            $chk = dsnhomtaikhoan_phanquyen::where('machucnang', $ct->maso)->where('manhomchucnang', $inputs['manhomchucnang'])->first();
            $a_kq = [
                'machucnang' => $ct->maso,
                'manhomchucnang' => $inputs['manhomchucnang'],
                'phanquyen' => $inputs['phanquyen'],
                'danhsach' => $inputs['danhsach'],
                'thaydoi' => $inputs['thaydoi'],
                'hoanthanh' => $inputs['hoanthanh'],
            ];
            if ($chk == null) {
                dsnhomtaikhoan_phanquyen::create($a_kq);
            } else {
                $chk->update($a_kq);
            }
        }
        loghethong(getIP(),session('admin'),'phanquyen','nhomtaikhoan');
        return redirect('/nhomchucnang/PhanQuyen?manhomchucnang=' . $inputs['manhomchucnang'])
                        ->with('success','Thành công');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!chkPhanQuyen('nhomtaikhoan', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'nhomtaikhoan');
        }
        $model=dsnhomtaikhoan::findOrFail($id);
        $model->delete();
        loghethong(getIP(),session('admin'),'xoa','nhomtaikhoan');
        return redirect('/nhomchucnang/ThongTin')
                ->with('success','Xóa thành công');
    }

    public function DanhSachDonVi(Request $request)
    {
        if (!chkPhanQuyen('nhomtaikhoan', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'nhomtaikhoan');
        }
        $inputs = $request->all();
        $m_nhom = dsnhomtaikhoan::where('manhomchucnang', $inputs['manhomchucnang'])->first();
        $model = User::where('manhomchucnang', $inputs['manhomchucnang'])->get();
        // dd($model);
        return view('Hethong.nhomchucnang.danhsach')
            ->with('model', $model)
            ->with('m_nhom', $m_nhom)
            ->with('inputs', $inputs)
            ->with('baocao',getdulieubaocao())
            ->with('pageTitle', 'Danh sách tài khoản trong nhóm');
    }

    public function ThietLapLai(Request $request)
    {
        if (!chkPhanQuyen('nhomtaikhoan', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'dsnhomtaikhoan');
        }

        $inputs = $request->all();

        $model = User::where('manhomchucnang', $inputs['manhomchucnang'])->get();
        
        $model_phanquyen = dsnhomtaikhoan_phanquyen::where('manhomchucnang', $inputs['manhomchucnang'])->get();
        $a_phanquyen = [];
        foreach ($model as $taikhoan) {
            foreach ($model_phanquyen as $phanquyen) {
                $a_phanquyen[] = [
                    'tendangnhap' =>$taikhoan->cccd,
                    'machucnang' => $phanquyen->machucnang,
                    'phanquyen' => $phanquyen->phanquyen,
                    'danhsach' => $phanquyen->danhsach,
                    'thaydoi' => $phanquyen->thaydoi,
                    'hoanthanh' => $phanquyen->hoanthanh,
                ];
            }
        }
        // dd($a_phanquyen);
        foreach (array_chunk(array_column($model->toarray(), 'cccd'), 100) as $data) {
            dstaikhoan_phanquyen::wherein('tendangnhap', $data)->delete();
        }
        foreach (array_chunk($a_phanquyen, 200) as $data) {
            dstaikhoan_phanquyen::insert($data);
        }
        loghethong(getIP(),session('admin'),'phanquyennhom','nhomtaikhoan');
        return redirect('/nhomchucnang/danhsach_donvi?manhomchucnang=' . $inputs['manhomchucnang']);
    }
}
