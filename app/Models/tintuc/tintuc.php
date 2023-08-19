<?php

namespace App\Models\tintuc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tintuc extends Model
{
    use HasFactory;

    protected $table = 'tintuc';

    protected $fillable = [
        'tieude',
        'phude',
        'hinhanh',
        'user_id',
        'luotxem',
        'noidung',
        'slug',
        'active'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}