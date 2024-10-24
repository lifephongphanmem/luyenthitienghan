<?php

namespace App\Models\ThiVong2;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vandap_cautraloi extends Model
{
    use HasFactory;
    protected $table='vandap_cautraloi';
    protected $fillable=[
        'macau',
        'macautraloi',
        'noidung',
        'nghiatiengviet',
        'stt'
    ];
}
