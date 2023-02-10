<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskProgress extends Model
{
    use HasFactory;
    protected $fillable= ['owner_id','project_id','sub_task_id','heading','Task','progress','employee_name','deadline'];
}
