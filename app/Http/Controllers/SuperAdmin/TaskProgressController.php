<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Assign;
use App\Models\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TaskProgress;
use Illuminate\Support\Facades\Validator;
use App\Models\Vendor;

class TaskProgressController extends Controller
{
    //Add person for sub task
    public function AddNewTask(Request $request)
    {
        $validator = Validator::make($request->all(), []);


        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()->toArray()]);
        } else {
            
           $employeeName = TaskProgress::create([
                "owner_id" => Auth::user()->id,
                "project_id" => $request->projectName,
                "sub_task_id" => $request->projectExcel_id,
                "heading" => $request->heading_all,
                "Task" => $request->taskAll,
                "progress" => $request->addAction,
                "employee_name" => json_encode($request->username),
                "deadline" => $request->dueDate,
                "created_at" => now()
            ]);
            foreach($request->username as $key => $value){
                
            Assign::create([
                "taskProgress_id" => $employeeName->id,
                "project_id" => $request->projectName,
                "sub_task_id" => $request->projectExcel_id,
                "heading" => $request->heading_all,
                "Task" => $request->taskAll,
                "project_name" => $request->projName,
                "progress" => $request->addAction,
                "employee_id" => $value,
                "created_at" => now()

            ]);
            
        }
    

            Excel::where('id', $request->projectExcel_id)
                ->update([
                    'progress' => $request->addAction,
                ]);

            return response()->json(['success' => 'User Added Successfully']);
        }
    }
    public function completeTask(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
           
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()->toArray()]);
        } else {
            TaskProgress::where('id', $request->progressId)
                ->update([
                    "progress" => $request->addAction,
                    "updated_at" => now()
                ]);
                Excel::where('id', $request->projectExcel_id)
                ->update([
                    'progress' => $request->addAction,
                ]);
                Assign::where('sub_task_id', $request->projectExcel_id)
                ->update([
                    'progress' => $request->addAction,
                ]);

            return response()->json(['success' => 'User Updated Succesfully']);
        }


        return ['success' => 'User Updated Succesfully'];
    }
}
