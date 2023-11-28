<?php

namespace App\Models\Hethong;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class generalCOnfig extends Model
{
    use HasFactory;
    protected $table='general_config';
    protected $fillable=[
                            'dxtaikhoan',//0: Không cho đăng nhập khi có tk đang onl, 1: đăng xuất tài khoản hiện tại ở thiết bị
                            'solandn'
                        ];
}
