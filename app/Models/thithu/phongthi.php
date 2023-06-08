<?php

namespace App\Models\thithu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phongthi extends Model
{
    use HasFactory;
    protected $table='phongthi';
    protected $fillable=[
        'maphongthi','tenphongthi','trangthai','made'
    ];
}
