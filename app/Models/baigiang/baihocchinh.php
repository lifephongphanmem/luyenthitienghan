<?php

namespace App\Models\baigiang;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class baihocchinh extends Model
{
    use HasFactory;
    protected $table='baihocchinh';
    protected $fillable=[
        'mabaihoc',
        'mabaihocchinh',
        'loaisach',
        'audio',
        'anh',
        'anh2',
        'stt'
    ];
}
