<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = ['owner_id','coupon_name','coupon_type','face_value','total_coupon','limitperperson','voucher_time','effective_time','coupon_description','participate_merchendise','status'];
}
