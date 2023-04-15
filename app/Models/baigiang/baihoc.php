<?php

namespace App\Models\baigiang;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class baihoc extends Model
{
    use HasFactory;
    protected $table='baihoc';
    protected $fillable=[
        'mabaihoc',
        'magiaotrinh',
        'tenbaihoc',
        'link1',
        'link2',
        'link3',
        'stt'
    ];
}
