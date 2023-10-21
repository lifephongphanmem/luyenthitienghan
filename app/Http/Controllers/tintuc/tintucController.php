<?php

namespace App\Http\Controllers\tintuc;

use App\Http\Controllers\Controller;
use App\Models\tintuc\tintuc;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Filesystem\Filesystem;

class tintucController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Session::has('admin')) {
                return redirect('/DangNhap');
            };
            return $next($request);
        })->except([
                'index',
                'show'
            ]);
    }

    public function index()
    {
        dd(chkThiThu(session('admin')->manguoidung));
        $baiviet = tintuc::where('active', '=', 1)
            ->select('id', 'hinhanh', 'tieude', 'phude', 'created_at', 'slug')
            ->orderBy('created_at', 'DESC')->paginate(12);

        return view('tintuc.index', compact('baiviet'))
            ->with('baocao', getdulieubaocao())
            ->with('pageTitle', 'Tin tức');
    }

    public function quanly()
    {
        if (!chkPhanQuyen('tintuc', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'tintuc');
        }

        $baiviet = tintuc::with('user:id,tentaikhoan')
            ->select('id', 'tieude', 'phude', 'user_id', 'slug', 'created_at')
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('tintuc.quanly', compact('baiviet'))
            ->with('baocao', getdulieubaocao())
            ->with('pageTitle', 'Quản lý tin tức');
    }

    public function create()
    {
        if (!chkPhanQuyen('tintuc', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'tintuc');
        }

        return view('tintuc.taobai')
            ->with('baocao', getdulieubaocao())
            ->with('pageTitle', 'Tạo bài viết');
    }

    public function store(Request $request)
    {
        if (!chkPhanQuyen('tintuc', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'tintuc');
        }

        $user = Session::get('admin');

        $filename = 'hinhanhtieude.' . $request->file('acptfile')->extension();

        $slug = Str::slug($request['tieude'] . '-' . Carbon::now('Asia/Ho_Chi_Minh')->format('His-dmy'));

        tintuc::create([
            'tieude' => $request['tieude'],
            'phude' => $request['phude'],
            'hinhanh' => 'uploads/tintuc/' . $request->file('acptfile')->storeAs($slug, $filename, 'tintuc'),
            'user_id' => $user->id,
            'noidung' => $request['noidung'],
            'slug' => Str::slug($request['tieude'] . '-' . Carbon::now('Asia/Ho_Chi_Minh')->format('dmy-His'))
        ]);

        return redirect()->route('quanlytintuc');
    }

    public function show($slug)
    {
        $bai = tintuc::where('slug', '=', $slug)->first();

        $bai->update([
            'luotxem' => $bai->luotxem + 1
        ]);

        $baiviet = tintuc::with('user:id,tentaikhoan')
            ->select('id', 'tieude', 'luotxem', 'created_at', 'updated_at', 'noidung', 'user_id', 'slug')
            ->where('slug', '=', $slug)->first();

        $cacbaivietganday = tintuc::where('slug', 'NOT LIKE', $slug)
            ->select('id', 'hinhanh', 'tieude', 'slug', 'created_at')
            ->orderBy('created_at', 'DESC')->take(6)->get();

        return view('tintuc.noidungtintuc', compact('baiviet', 'cacbaivietganday'))
            ->with('baocao', getdulieubaocao())
            ->with('pageTitle', $baiviet->tieude);
    }

    public function edit($slug)
    {
        if (!chkPhanQuyen('tintuc', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'tintuc');
        }

        $baiviet = tintuc::where('slug', '=', $slug)->first();

        return view('tintuc.suabaiviet', compact('baiviet'))
            ->with('baocao', getdulieubaocao())
            ->with('pageTitle', 'Sửa bài viết');
    }

    public function update(Request $request, $slug)
    {
        if (!chkPhanQuyen('tintuc', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'tintuc');
        }

        $baiviet = tintuc::where('slug', '=', $slug)->first();

        if (substr($slug, 0, -14) != Str::slug($request['tieude'])) {
            $new_slug = Str::slug($request['tieude'] . '-' . Carbon::now('Asia/Ho_Chi_Minh')->format('dmy-His'));

            $file = new Filesystem();
            $file->moveDirectory(public_path('uploads/tintuc/' . $slug), public_path('uploads/tintuc/' . $new_slug));

            list($the_rest, $ext_file) = explode(".", $baiviet->hinhanh);

            $hinhanh = 'uploads/tintuc/' . $new_slug . '/hinhanhtieude.' . $ext_file;
        } else {
            $new_slug = $slug;

            $hinhanh = $baiviet->hinhanh;
        }

        if ($request->hasFile('acptfile')) {
            $file = new Filesystem;
            $file->cleanDirectory(public_path('uploads/tintuc/' . $new_slug));

            $filename = 'hinhanhtieude.' . $request->file('acptfile')->extension();
            $hinhanh = 'uploads/tintuc/' . $request->file('acptfile')->storeAs($new_slug, $filename, 'tintuc');
        }

        $baiviet->update([
            'tieude' => $request['tieude'],
            'phude' => $request['phude'],
            'noidung' => $request['noidung'],
            'slug' => $new_slug,
            'hinhanh' => $hinhanh
        ]);

        return redirect()->route('quanlytintuc');
    }

    public function destroy($slug)
    {
        if (!chkPhanQuyen('tintuc', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'tintuc');
        }

        tintuc::where('slug', '=', $slug)->delete();

        return redirect()->route('quanlytintuc');
    }
}