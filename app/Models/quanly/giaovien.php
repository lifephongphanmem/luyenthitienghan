<?php

namespace App\Models\quanly;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class giaovien extends Model
{
    use HasFactory;
    protected $table='giaovien';
    protected $fillable=[
        'magiaovien',
        'tengiaovien',
        'cccd',
        'sdt',
        'email',
        'ngaysinh',
        'gioitinh',
        'trangthai',
        'ghichu',
        'diachi'
    ];
}
