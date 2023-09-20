<?php

namespace App\Models\quantrihethong;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loghethong extends Model
{
    use HasFactory;
    protected $table='loghethong';
    protected $fillable=[
        'ip',
        'taikhoantruycap',
        'tentaikhoan',
        'thaotac',
        'chucnang',
        'noidung',
        'thoigian'
    ];
}
