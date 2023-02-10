<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    // page redirect to Dashboard
    public function index()
    {
        $chart = DB::select(DB::raw("select count(*) as total_progress, progress from excels group by progress"));
         
        $chartData="";
         foreach($chart as $list){
                $chartData.="['".$list->progress."',  ".$list->total_progress."],";
            }   
            
            $arr['chartData']=rtrim($chartData,",");
            // echo $chartData;
        return view('superadmin.projectManagement.dashboard',$arr);
    }
}
