<?php

namespace App\Models\danhmuc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dmtrinhdocmkt extends Model
{
    use HasFactory;
    protected $table = 'trinhdocmkt';
    protected $fillable=['madm','tendm','stt'];
}
