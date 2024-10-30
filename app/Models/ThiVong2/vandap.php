<?php

namespace App\Models\ThiVong2;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vandap extends Model
{
    use HasFactory;
    protected $table="vandap";
    protected $fillable=[
        'macau',
        'stt',
        'noidung',
        'nghiatiengviet',
        'audio',
        'phanloai'
    ];
}
