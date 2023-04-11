<?php

namespace App\Models\Hethong;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chucnang extends Model
{
    use HasFactory;
    protected $table = 'dschucnang';
    protected $fillable = [
        'maso','tencn','capdo','parent','trangthai','machucnang_goc'
    ];
}
