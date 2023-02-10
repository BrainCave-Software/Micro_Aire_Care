<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;
    protected $fillable = ["id", "owner_id", "customer_id", "project_Name", "project_Name",  "project_Name", "project_Name"];
}
