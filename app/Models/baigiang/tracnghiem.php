<?php

namespace App\Models\baigiang;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tracnghiem extends Model
{
    use HasFactory;
    protected $table='tracnghiem';
    protected $fillable=[
        'mabaihoc',
        'matracnghiem',
        'tencautracnghiem',
        'noidung',
        'audio',
        'A','B','C','D',
        'dapan'
    ];
}
