<?php

namespace App\Models\thithu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phongthi_lop extends Model
{
    use HasFactory;
    protected $table='phongthi_lop';
    protected $fillable=[
        'maphongthi','malop','made'
    ];
}
