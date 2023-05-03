<?php

namespace App\Models\dethi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cauhoi_dethi extends Model
{
    use HasFactory;
    protected $table='cauhoi_dethi';
    protected $fillable=[
        'made',
        'macauhoi'
    ];
}
