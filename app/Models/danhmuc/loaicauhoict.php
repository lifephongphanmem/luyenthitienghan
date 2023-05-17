<?php

namespace App\Models\danhmuc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loaicauhoict extends Model
{
    use HasFactory;
    protected $table='loaicauhoict';
    protected $fillable=['madm','madmct','tendmct'];
}
