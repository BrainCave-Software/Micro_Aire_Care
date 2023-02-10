<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','users_id','product_name','product_varient','product_category','uom','img_path','sku_code','min_sale_price','tax','supplier_code','image','image'];

}
