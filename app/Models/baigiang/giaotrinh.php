<?php

namespace App\Models\baigiang;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class giaotrinh extends Model
{
    use HasFactory;
    protected $table='giaotrinh';
    protected $fillable=[
        'magiaotrinh',
        'tengiaotrinh',
        'soluongbai',
        'ghichu'
    ];
}
