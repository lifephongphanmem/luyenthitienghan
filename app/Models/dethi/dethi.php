<?php

namespace App\Models\dethi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dethi extends Model
{
    use HasFactory;
    protected $table='dethi';
    protected $fillable=[
        'made',
        'tende'
    ];
}
