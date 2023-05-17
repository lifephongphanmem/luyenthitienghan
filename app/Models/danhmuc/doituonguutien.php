<?php

namespace App\Models\danhmuc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doituonguutien extends Model
{
    use HasFactory;
    protected $table='doituonguutien';
    protected $fillable=[
        'madm',
        'tendm',
        'stt'
    ];
}
