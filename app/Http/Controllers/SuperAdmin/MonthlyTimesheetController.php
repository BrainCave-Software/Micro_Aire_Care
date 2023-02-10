<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MonthlyTimesheetController extends Controller
{
    //Redirect to  monthly attendance page 
    public function index()
    {
        return view('superadmin.timesheet.monthlyTimesheet');
    }
}
