<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','owner_id','customer_name','address','email_id','phone_number','mobile_number','customer_id','password','gst','image'];
}
