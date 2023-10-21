<?php

namespace App\Models\ketqua;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ketquathithu extends Model
{
    use HasFactory;
    protected $table='ketquathithu';
    protected $fillable=[
        'maketqua',
        'mahocvien',
        'madethi',
        'diemthi',
        'dapanchon',
        'thoigianlambai',
        'malop',
        'maphongthi',
        'ngaythi',
        'giothi',
        'lanthithu'
    ];
}
