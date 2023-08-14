<?php

namespace App\Models\baigiang;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class baitap extends Model
{
    use HasFactory;
    protected $table='baitap';
    protected $fillable=[
        'mabaihoc',
        'mabaitap',
        'cauhoi',
        'noidung',
        'anh',
        'audio',
        'A','B','C','D',
        'dapan',
        'stt',
        'hoithoai1',
        'hoithoai2',
        'hoithoai3',
        'hoithoai4',
        'loaidapan'
    ];
}
