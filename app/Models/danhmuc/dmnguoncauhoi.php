<?php

namespace App\Models\danhmuc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dmnguoncauhoi extends Model
{
    use HasFactory;
    protected $table='dmnguoncauhoi';
    protected $fillable=[
        'madm','tendm'
    ];
}
