<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assign extends Model
{
    use HasFactory;
    protected $fillable =['taskProgress_id','progress','project_id','project_name','sub_task_id','heading','Task','employee_id'];

}
