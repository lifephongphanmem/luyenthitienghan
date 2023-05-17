<?php

namespace App\Models\danhmuc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chitietloaicauhoict extends Model
{
    use HasFactory;
    protected $table='chitietloaicauhoict';
    protected $fillable=['madmct','madmct2','tendmct2'];
}
