<?php

namespace App\Http\Controllers\thithu;

use App\Http\Controllers\Controller;
use App\Models\dethi\dethi;
use App\Models\quanly\hocvien;
use App\Models\quanly\lophoc;
use App\Models\thithu\phongthi;
use App\Models\thithu\phongthi_lop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class phongthiController extends Controller
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
        if (!chkPhanQuyen('phongthi', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'phongthi');
        }
        $model = phongthi::all();
        $a_trangthai=[
            '0'=>'Đóng',
            '1'=>'Mở'
        ];
        return view('dethi.thithu.phongthi.index')
            ->with('model', $model)
            ->with('baocao',getdulieubaocao())
            ->with('a_trangthai', $a_trangthai)
            ->with('pageTitle', 'Danh sách phòng thi');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!chkPhanQuyen('phongthi', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'phongthi');
        }
        $inputs = $request->all();
        $inputs['maphongthi'] = getdate()[0];
        phongthi::create($inputs);
        return redirect('/PhongThi/ThongTin')
            ->with('success', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!chkPhanQuyen('phongthi', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'phongthi');
        }
        
        $phongthi = phongthi::where('maphongthi', $id)->first();
        $model = phongthi::join('phongthi_lop', 'phongthi_lop.maphongthi', 'phongthi.maphongthi')
            ->select('phongthi_lop.*')
            ->where('phongthi.maphongthi', $id)->get();
        $malop = array_column($model->toarray(), 'malop');
        $lophoc = lophoc::where('trangthai', 1)->wherenotin('malop', $malop)->get();
        $m_lophoc=lophoc::all();
        $tenlop = array_column($m_lophoc->toarray(), 'tenlop', 'malop');
        $khoa=array_column($m_lophoc->toarray(),'khoahoc','malop');
        $a_trangthai=[
            '0'=>'Khóa',
            '1'=>'Mở'
        ];
        $m_dethi=dethi::all();
        $a_dethi=array_column($m_dethi->toArray(),'tende','made');
        return view('dethi.thithu.phongthi.chitiet')
            ->with('model', $model)
            ->with('lophoc', $lophoc)
            ->with('tenlop', $tenlop)
            ->with('khoa', $khoa)
            ->with('m_dethi', $m_dethi)
            ->with('a_dethi', $a_dethi)
            ->with('a_trangthai', $a_trangthai)           
            ->with('phongthi', $phongthi)
            ->with('baocao',getdulieubaocao())
            ->with('pageTitle', 'Danh sách lớp thi');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!chkPhanQuyen('phongthi', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'phongthi');
        }
        $inputs = $request->all();
        // dd($inputs);
        $model = phongthi::where('maphongthi', $id)->first();
        $phongthi_lop=phongthi_lop::where('maphongthi',$id)->where('malop',$inputs['malop'])->first();

        if (isset($phongthi_lop)) {
            $phongthi_lop->update(['made'=>$inputs['made']]);
        };
        return redirect('/PhongThi/ChiTiet/'.$model->maphongthi)
            ->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!chkPhanQuyen('phongthi', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'phongthi');
        }
        $model = phongthi::where('maphongthi', $id)->first();
        if (isset($model)) {
            $model->delete();
        };
        return redirect('/PhongThi/ThongTin')
            ->with('success', 'Xóa thành công');
    }

    public function themlop(Request $request)
    {
        $inputs = $request->all();
        $inputs['made']=$inputs['made']??'';

        if (isset($inputs['malop'])) {
            foreach ($inputs['malop'] as $ct) {
                $data = [
                    'maphongthi' => $inputs['maphongthi'],
                    'malop' => $ct,
                    'made'=>$inputs['made']
                ];
                phongthi_lop::create($data);
                //khi thêm lớp set trangthaithi thử của học viên lên 1 để học viên có thể vào thi
                hocvien::where('malop',$ct)->update(['trangthaithithu'=>1]);
            }
        }
        // $phongthi=phongthi::where('maphongthi',$inputs['maphongthi'])->first();
        // if(isset($inputs['made'])){      
        //     $phongthi->update(['made'=>$inputs['made']]);
        // }
        return redirect('/PhongThi/ChiTiet/'.$inputs['maphongthi'])
            ->with('success', 'Thêm thành công');
    }
    public function xoalop(Request $request, $malop){
        $inputs=$request->all();
        $lopthi=phongthi_lop::where('malop',$malop)->first();
        if(isset($lopthi)){
            $lopthi->delete();
            //khi xóa lớp thi chuyển trạng thái của các học viên về 0 để kết thúc thi thử
            hocvien::where('malop',$malop)->update(['trangthaithithu'=>0]);
        }

        return redirect('/PhongThi/ChiTiet/'.$inputs['maphongthi'])
        ->with('success', 'Xóa thành công');
    }

    public function dongphongthi(Request $request){
        $inputs=$request->all();
        $phongthi=phongthi::where('maphongthi',$inputs['maphongthi'])->first();
        $inputs['trangthai'] == 1?$inputs['trangthai']=0:$inputs['trangthai']=1;
        if($inputs['trangthai'] == 0){
            phongthi_lop::where('maphongthi',$inputs['maphongthi'])->delete();
            $phongthi->update(['made'=>null]);
            //chuyển tất cả các học viên có trong lớp đó về 0 để đóng thi thử
            hocvien::where('trangthaithithu',1)->update(['trangthaithithu',0]);
        }
        $phongthi->update(['trangthai'=>$inputs['trangthai']]);

        return redirect('/PhongThi/ThongTin')
                    ->with('success','Thay đổi thành công');
        
    }
}
