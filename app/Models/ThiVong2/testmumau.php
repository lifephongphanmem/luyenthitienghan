<?php

namespace App\Models\ThiVong2;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class testmumau extends Model
{
    use HasFactory;
    protected $table='testmumau';
    protected $fillable=[
        'matest','dapan','hinhanh','stt'
    ];
}
