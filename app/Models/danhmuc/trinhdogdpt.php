<?php

namespace App\Models\danhmuc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trinhdogdpt extends Model
{
    use HasFactory;
    protected $table = 'trinhdogdpt';
    protected $fillable=['madm','tendm','stt'];
}
