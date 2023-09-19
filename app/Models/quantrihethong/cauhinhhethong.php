<?php

namespace App\Models\quantrihethong;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cauhinhhethong extends Model
{
    use HasFactory;
    protected $table='cauhinhhethong';
    protected $fillable=['thumuc','trangthai','macauhinh','machucnang','thoigianluu'];
}
