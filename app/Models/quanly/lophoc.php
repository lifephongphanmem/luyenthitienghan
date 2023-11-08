<?php

namespace App\Models\quanly;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lophoc extends Model
{
    use HasFactory;
    protected $table='lophoc';
    protected $fillable=['malop','tenlop','khoahoc','giaovienchunhiem','soluonghocvien','stt','phanquyenluyenthi','giaotrinhhoc','phanquyengiaotrinhhoc','khoataikhoan'];
}
