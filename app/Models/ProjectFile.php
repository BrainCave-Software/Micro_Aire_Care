<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectFile extends Model
{
    use HasFactory;
    protected $fillable = ['owner_id','customer_id','project_file','job_sheet','client_name','date','delivery_date','mobile','sale_person','address','task','postalCode'];

}
