<?php

namespace App\Models\baigiang;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class giaotrinh_baihoc extends Model
{
    use HasFactory;
    protected $table='giaotrinh_baihoc';
    protected $fillable=['magiaotrinh','mabaihoc'];
}
