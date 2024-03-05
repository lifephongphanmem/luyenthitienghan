<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tentaikhoan',
        'cccd',
        'email',
        'password',
        'sodienthoai',
        'trangthai',
        'sadmin',
        'manhomchucnang',
        'hocvien',
        'giaovien',
        'hethong',
        'chucnangkhac',
        'mataikhoan',
        'islogin',
        'isluyenthi',
        'isaction',
        'islogout',//0:logout; 1:unlogout
        'trangthaithithu',
        'malop',
        'ngaysinh',
        'gioitinh',
        'diachi',
        'solandn',
        'dnlandau'//0:true,1:false
    ];

    public function tintuc() {
        return $this->hasMany('App\Models\tintuc\tintuc');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
