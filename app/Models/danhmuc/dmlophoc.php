<?php

namespace App\Models\danhmuc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dmlophoc extends Model
{
    use HasFactory;
    protected $table='dmlophoc';
    protected $fillable=[
        'malop','tenlop'
    ];
}
