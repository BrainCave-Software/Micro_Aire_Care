<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','users_id','vendor_name','contact_person_name','address','email','phone_no','mobile_no','GST','image'];
}
