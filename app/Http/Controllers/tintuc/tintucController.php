<?php

namespace App\Http\Controllers\tintuc;

use App\Http\Controllers\Controller;
use App\Models\tintuc\tintuc;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

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
        $baiviet = tintuc::where('active', '=', 1)
            ->select('id', 'hinhanh', 'tieude', 'phude', 'created_at', 'slug')
            ->orderBy('created_at', 'DESC')->paginate(12);

        return view('tintuc.index', compact('baiviet'))
            ->with('pageTitle', 'Tin tức');
    }

    public function create()
    {
        return view('tintuc.taobai')
            ->with('pageTitle', 'Tạo bài viết');
    }

    public function store(Request $request)
    {
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

        return redirect()->route('trangchutintuc');
    }

    public function show($slug)
    {
        $bai = tintuc::where('slug', '=', $slug)->first();

        $bai->update([
            'luotxem' => $bai->luotxem + 1
        ]);

        $baiviet = tintuc::with('user:id,tentaikhoan')
        ->select('id', 'tieude', 'luotxem', 'created_at', 'updated_at', 'noidung', 'user_id')
        ->where('slug', '=', $slug)->first();

        $cacbaivietganday = tintuc::where('slug', 'NOT LIKE', $slug)
        ->select('id', 'hinhanh', 'tieude', 'slug', 'created_at')
        ->orderBy('created_at', 'DESC')->take(6)->get();

        return view('tintuc.noidungtintuc', compact('baiviet', 'cacbaivietganday'))
            ->with('pageTitle', $baiviet->tieude);
    }

    public function edit(tintuc $tintuc)
    {
        //
    }

    public function update(Request $request, tintuc $tintuc)
    {
        //
    }

    public function destroy(tintuc $tintuc)
    {
        //
    }
}