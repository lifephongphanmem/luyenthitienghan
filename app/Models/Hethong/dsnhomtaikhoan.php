<?php

namespace App\Models\Hethong;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dsnhomtaikhoan extends Model
{
    use HasFactory;
    protected $table='dsnhomtaikhoan';
    protected $fillable=[
        'stt',
        'manhomchucnang',
        'tennhomchucnang',
        'ghichu'
    ];
}

