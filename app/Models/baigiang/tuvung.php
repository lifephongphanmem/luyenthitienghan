<?php

namespace App\Models\baigiang;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tuvung extends Model
{
    use HasFactory;
    protected $table='tuvung';
    protected $fillable=[
        'mabaihoc',
        'matuvung',
        'cumtuvung',
        'audio',
        'tutienghan',
        'tiengviet'
    ];
}
