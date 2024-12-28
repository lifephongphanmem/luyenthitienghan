<?php

namespace App\Models\Thivong2;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class congcu extends Model
{
    use HasFactory;
    protected $table='congcu';
    protected $fillable=[
        'phanloai','macongcu','tencongcu','hinhanh','tiengHan','tiengViet','stt'
    ];
}
