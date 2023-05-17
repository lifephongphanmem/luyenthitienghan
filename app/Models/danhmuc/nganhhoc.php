<?php

namespace App\Models\danhmuc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nganhhoc extends Model
{
    use HasFactory;
    protected $table='nganhhoc';
    protected $fillable=[
        'manganh','tennganh'
    ];
}
