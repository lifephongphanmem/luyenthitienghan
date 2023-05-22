<?php

namespace App\Models\danhmuc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loaicauhoi extends Model
{
    use HasFactory;
    protected $table='loaicauhoi';
    protected $fillable=['madm','tendm','soluongcau'];
}
