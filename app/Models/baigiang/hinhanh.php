<?php

namespace App\Models\baigiang;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hinhanh extends Model
{
    use HasFactory;
    protected $table='hinhanh';
    protected $fillable=[
        'mabaihoc',
        'mahinhanh',
        'hinhanh',
        'audio',
        'tienghan',
        'A','B','C','D',
        'dapan',
        'stt'
    ];
}
