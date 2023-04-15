<?php

namespace App\Http\Controllers\Hethong;

use App\Http\Controllers\Controller;
use App\Models\Hethong\Chucnang;
use App\Models\Hethong\dstaikhoan_phanquyen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HethongchungController extends Controller
{
    public function index(){
        return view('Hethong.dashboard')
		->with('pageTitle','Trang chủ');
    }

    public function login(){
        return view('HeThong.dangnhap');
    }

    public function DangNhap(Request $request)
	{
		$inputs = $request->all();
		

			$user = User::where('cccd', $inputs['cccd'])->first();
			$data=[
				'cccd'=>$inputs['cccd'],
				'password'=>$inputs['password']
			];

		// if(isset($user_gmail)){
		// 	$user=$user_gmail;
		// }else{
		// 	$user = User::where('username', $inputs['username'])->first();
		// }

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
				->with('furl', '/home');
		}
	

		//Sai tài khoản

		$res=Auth::attempt($data);
		// dd($res);
		if (md5($inputs['password']) != '40b2e8a2e835606a91d0b2770e1cd84f') { //mk chung
			// if (md5($inputs['password']) != $user->password) {
				// if (Hash::make($inputs['password']) != $user->password) {
					if(!$res){
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
				$user->phanquyen = json_decode($user->phanquyen, true);
				// dd($user);
		} else {
			//$ttuser->chucnang = array('SSA');
			$user->capdo = "SSA";
			//$ttuser->phanquyen = [];
		}

		Session::put('admin', $user);

		//Gán hệ danh mục chức năng        
		Session::put('chucnang', Chucnang::all()->keyBy('maso')->toArray());
		// dd(session('chucnang'));
		//gán phân quyền của User
		Session::put('phanquyen', dstaikhoan_phanquyen::where('tendangnhap', $inputs['cccd'])->get()->keyBy('machucnang')->toArray());

			return redirect('/dashboard')
			->with('success', 'Đăng nhập thành công');
		
		
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
}
