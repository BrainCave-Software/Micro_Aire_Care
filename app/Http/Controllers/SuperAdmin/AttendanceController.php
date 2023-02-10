<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //Redirect to  monthly Attendance page 
    public function index()
    {
        return view('superadmin.timesheet.attendance');
    }
}
