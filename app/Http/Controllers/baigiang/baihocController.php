<?php

namespace App\Http\Controllers\baigiang;

use App\Http\Controllers\Controller;
use App\Models\baigiang\baihoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\AbstractHandler;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class baihocController extends Controller
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
        if (!chkPhanQuyen('baihoc', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'baihoc');
        }

        $model = baihoc::all();

        return view('baigiang.baihoc.index')
            ->with('model', $model)
            ->with('baocao', getdulieubaocao())
            ->with('pageTitle', 'Quản lý bài học');
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
        if (!chkPhanQuyen('baihoc', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'baihoc');
        }

        $inputs = $request->all();

        $inputs['mabaihoc'] = getdate()[0];

        baihoc::create($inputs);

        loghethong(getIP(), session('admin'), 'them', 'baihoc');

        return redirect('/BaiHoc/ThongTin')
            ->with('success', 'Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function upload(Request $request, string $id)
    {
        // create the file receiver
        $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));

        // check if the upload is success, throw exception or return response you need
        if ($receiver->isUploaded() === false) {
            throw new UploadMissingFileException();
        }

        // receive the file
        $save = $receiver->receive();

        // check if the upload has finished (in chunk mode it will send smaller files)
        if ($save->isFinished()) {
            // save the file and return any response you need, current example uses `move` function. If you are
            // not using move, you need to manually delete the file by unlink($save->getFile()->getPathname())
            return $this->saveFile($save->getFile(), $id);
        }

        // we are in chunk mode, lets send the current progress
        /** @var AbstractHandler $handler */
        $handler = $save->handler();

        return response()->json([
            "done" => $handler->getPercentageDone(),
            'status' => true
        ]);
    }

    protected function saveFile(UploadedFile $file, string $id)
    {
        $fileName = $this->createFilename($file);

        $model = baihoc::where('id', $id)->first();

        // Build the file path
        if (isset($model->link1)) {
            if (File::exists($model->link1)) {
                File::delete($model->link1);
            }
            $split_link = explode("baihocchinh/", $model->link1);
            $filePath = $split_link[0] . 'baihocchinh/';
        } else {
            $filePath = "data/" . Str::slug(Str::limit($model->tenbaihoc, 145) . getdate()[0]) . "/baihocchinh/";
        }
        $finalPath = public_path($filePath);

        // move the file name
        $file->move($finalPath, $fileName);

        $model->update([
            'link1' => $filePath . $fileName,
        ]);

        return response()->json([
            'path' => asset($filePath),
            'name' => $fileName
        ]);
    }

    protected function createFilename(UploadedFile $file)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = str_replace("." . $extension, "", $file->getClientOriginalName()); // Filename without extension

        // Add timestamp hash to name of the file
        $filename .= "_" . md5(time()) . "." . $extension;

        return $filename;
    }

    public function update(Request $request, string $id)
    {
        if (!chkPhanQuyen('baihoc', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'baihoc');
        }

        $model = baihoc::where('id', $id)->first();

        if (isset($model)) {
            if ($request->hasFile('anh-nen-video')) {
                if (File::exists($model->link3)) {
                    File::delete($model->link3);
                }

                $filePath = 'data/anhvideo/';

                $finalPath = public_path($filePath);

                $extension = $request->file('anh-nen-video')->getClientOriginalExtension();
                $fileName = Str::limit(str_replace("." . $extension, "", $request->file('anh-nen-video')->getClientOriginalName()), 210);

                $fileName .= "_" . md5(time()) . "." . $extension;

                $request->file('anh-nen-video')->move($finalPath, $fileName);

                $model->update([
                    'link3' => $filePath . $fileName
                ]);
            }

            $model->update([
                'tenbaihoc' => $request['tenbaihoc'],
                'stt' => $request['stt']
            ]);
        }

        return redirect('/BaiHoc/ThongTin')
            ->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!chkPhanQuyen('baihoc', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'baihoc');
        }

        $model = baihoc::where('id', $id);

        if (isset($model)) {
            if (isset($model->link1)) {
                File::Delete($model->link1);
            }
            if (isset($model->link3)) {
                File::Delete($model->link3);
            }
            $model->delete();
            loghethong(getIP(), session('admin'), 'xoa', 'baihoc');
        }

        return redirect('/BaiHoc/ThongTin')
            ->with('success', 'Xóa thành công');
    }
}