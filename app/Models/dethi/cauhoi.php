<?php

namespace App\Models\dethi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cauhoi extends Model
{
    use HasFactory;
    protected $table='cauhoi';
    protected $fillable=[
        'macauhoi',
        'loaicauhoi',//nghe hiểu, đọc hiểu
        'cauhoi',
        'noidung',
        'audio',
        'anh',
        'loaidapan',//1:text, 2:hình ảnh
        'A','B','C','D',
        'dapan',
        'dangcaudochieu',// 7 dạng câu đọc hiểu
        'dangcauxemtranh',
        'nganhhoc',
        'nguoncauhoi',// từ bộ 960 câu, tự tạo
        'dangcau', //1: câu 1 câu hỏi, 2: câu 2 câu hỏi
        'macaughep',
        'hoithoai',
        'nguoi1',
        'nguoi2',
        'cauhoitiengviet',
        'noidungtiengviet',
        'Atiengviet',
        'Btiengviet',
        'Ctiengviet',
        'Dtiengviet',
        'loaicaunghe',//7 dạng câu nghe
        'stt'
    ];
}
