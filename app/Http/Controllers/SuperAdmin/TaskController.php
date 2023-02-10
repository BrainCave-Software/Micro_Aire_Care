<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Excel;
use App\Models\Task;
use App\Models\Employee;
use App\Models\TaskProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index()
    {
        return view('superadmin.taskmanagement');
    }
    // ***************************************************************************************************//
    //                                           Task SECTION                                          //
    //****************************************************************************************************//
/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTasks()
    {
        try{
            return response()->json(DB::table('tasks')->where('owner_id', Auth::user()->id)->paginate(5));
        }catch(Exception $e){
            return response()->json(["success"=>"Database Query Error ..."]);
        }
    }

    // =================================================================================
    // fetch all Tasks
    // =================================================================================
    // public function getTasks()
    // {
    //     if (Auth::user()->role_id == "0") {
    //         $data = Task::all();
    //     } else {
    //         $data = Task::where('user_id', Auth::user()->id)->get();
    //     }
    //     return response()->json($data);
    // }

    // =================================================================================
    // fetch a single Task
    // =================================================================================
    public function getTask()
    {
        $id = $_GET["id"];
        $data = Task::all()->where("id", $id);
        return response()->json($data);
    }

    // =================================================================================
    // Add Task
    // =================================================================================    
    public function addTask(Request $request)
    {
        $uniqueTime = str_replace(' ', '', hexdec(date('Y-m-d H:i:s')));

        $validator = Validator::make($request->all(), [
            "task_name" => "required",
            "assigned_to" => "required",
            "start_time" => "required",
            "end_time" => "required",
            "status" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()->toArray()]);
        } else {
            Task::insert([
                "id" => $request->$uniqueTime . rand(),
                "owner_id" => Auth::user()->id,
                "task_name" => $request->task_name,
                "assigned_to" => $request->assigned_to,
                "start_time" => $request->start_time,
                "end_time" => $request->end_time,
                "status" => $request->status,
            ]);

            return response()->json(['success' => 'Task Added Succesfully']);
        }
    }

    // =================================================================================
    // Edit Tak
    // =================================================================================    
    public function editTask(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "task_name" => "required",
            "assigned_to" => "required",
            "start_time" => "required",
            "end_time" => "required",
            "status" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()->toArray()]);
        } else {
            Task::where("id", $request->id)
                ->update([
                    "task_name" => $request->task_name,
                    "assigned_to" => $request->assigned_to,
                    "start_time" => $request->start_time,
                    "end_time" => $request->end_time,
                    "status" => $request->status,
                    "updated_at" => now()
                ]);

            return response()->json(['success' => 'Task Updated Succesfully']);
        }
    }

    // =================================================================================
    // Delete Task
    // =================================================================================        
    public function removeTask()
    {
        $id = $_GET["id"];
        Task::where("id", $id)->delete();
        return response()->json(["success" => "Task Deleted Successfully."]);
    }

    // =================================================================================
    // view Task
    // =================================================================================
    public function viewTask()
    {
        $id = $_GET["id"];
        $data = Task::all()->where("id", $id);
        return response()->json($data);
    }

     // add task for employee
     public function getSingle()
     {
         $id = $_GET['id'];
         $sub = TaskProgress::where('sub_task_id', $id)->get();
         $data = Excel::all()->where('id', $id);
         return response()->json(["data"=>$data, "sub"=>$sub]);
     }
      // get employee name
    public function selectEmployeeName(){
        return response()->json(Employee::all()->where("name"));
    }

    // add task for employee
    public function getSingleView()
    {
        $id = $_GET['sub_task_id'];
        $data = TaskProgress::all()->where('sub_task_id', $id);
        
        return response()->json($data);
    }

     
}
