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
        'loaicauhoi',
        'cauhoi',
        'noidung',
        'audio',
        'anh',
        'loaidapan',
        'A','B','C','D',
        'dapan',
        'dangcaudochieu',
        'dangcauxemtranh',
        'nganhhoc',
        'nguoncauhoi',
        'dangcau',
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
        'loaicaunghe'
    ];
}
