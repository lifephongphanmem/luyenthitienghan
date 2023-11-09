<?php

namespace App\Models\quanly;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hocvien extends Model
{
    use HasFactory;
    protected $table='hocvien';
    protected $fillable=['mahocvien','malop','tenhocvien','cccd','sdt','email','ngaysinh','gioitinh','diachi','trangthai','ghichu','diachi',
    'trangthaithithu',//0:chưa thi,1:đang thi
    'giaotrinhhoc'
];
}
