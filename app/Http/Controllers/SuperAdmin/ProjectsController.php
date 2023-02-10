<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Stroage;
use App\Http\Controllers\Controller;
use App\Models\Assign;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Excel;
use App\Models\Projects;
use App\Models\ProjectFile;
use App\Models\Files;
use App\Models\notes;
use App\Models\product;
use App\Models\TaskProgress;
use Exception;
use File;
use Response;



use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProjectsController extends Controller
{
    // **********************************************************************
    // Project 
    // ***********************************************************************
    //Page redirect to project page
    public function index()
    {
        return view('superadmin.projectManagement.project');
    }
    public function getClientName()
    {

        // return response()->json(Customer::all()->where("customer_name"));
    }
    // add project
    public function addProject(Request $request)
    {
        $task = [];
        $validator = Validator::make($request->all(), [
            "projecttitle" => "required",
            "clientExcelName" => "required",
            "startdate"  => "required",
            "deadline"  => "required",
            "assignto" => "required",
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()->toArray()]);
        } else {
            
            Projects::insert([
                "owner_id" => Auth::user()->id,
                "project_id" => $request->projectIdName,
                "project_title" => $request->projecttitle,
                "clientExcel_name" => $request->clientExcelName,
                "address" => $request->clientAddress,
                "start_date" => $request->startdate,
                "deadline" => $request->deadline,
                "assign_to" => $request->assignto,
                "mobile" => $request->mobileNo,
                "sale_contact" => $request->saleContact,
                "task1" =>  json_encode( $request->taskName),
                "created_at" => now()
            ]);
            return response()->json(["success" => "Project Add Successfully."]);
        }
    }
    // fetch all Project details for table
    public function getProjectList()
    {

        return response()->json(DB::table('projects')->orderBy('id','DESC')->paginate(10));
    }
    // fetch Individual  project details (edit,view)
    public function FatchProject()
    {
        $id = $_GET['id'];
        return response()->json(Projects::all()->where("id", $id));
    }

    public function updateProduct(Request $request)
    {
        $products = $request->allProductDetails;
        $validator = Validator::make($request->all(), [
            "editprojecttitle" => "required",
            "editclientname" => "required",
            "editstartdate"  => "required",
            "editdeadline"  => "required",
            "editassignto" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()->toArray()]);
        } else {
            try {

                $checkbox = ($request->taxInclude === 'on') ? true : false;

                Projects::where('id', $request->projectid)
                    ->update([
                        "project_title" => $request->editprojecttitle,
                        "client_name" => $request->editclientname,
                        "start_date" => $request->editstartdate,
                        "deadline" => $request->editdeadline,
                        "assign_to" => $request->editassignto,
                        "manager" => $request->editmanager,
                        "updated_at" => now()
                    ]);

                return response()->json(['success' => 'Product Updated Succesfully']);
            } catch (Exception $e) {
                return response()->json(['barerror' => "Database Query Error."]);
            }
        }
    }
    // remove customer
    public function removeproject()
    {
        $id = $_GET['id'];
        projects::where('id', $id)->delete();
        return response()->json(["success" => "Details Deleted Successfully."]);
    }


    //  ***********************************************************
    //  Project view
    //  ************************************************************
    //Page redirect to project view page


    public function projectView()
    {
        $id = $_GET['customer_id'];
        return response()->json(notes::all()->where("customer_id", $id));
    }
    // Get project file list
    public function projectViewId($id)
    {
        $data = Projects::all()->where("project_id", $id);
        $excelData = Excel::all()->where("project_id", $id)->where("progress","New");
        $excelData1 = TaskProgress::all()->where("project_id", $id)->where("progress","Process");
        // $excelData1 = TaskProgress::all()->where("project_id", $id)->where("progress","Process")->join('employees','employees.users_id','=','employees.employee_id');
        $empName = Assign::join('employees','employees.users_id','=','assigns.employee_id')->select('assigns.*','employees.name')->where("assigns.project_id", $id)->get();


        $excelData0 = TaskProgress::all()->where("project_id", $id)->where("progress","Complete");
        $data2 = Files::where("customer_id", $id)->get();
        $note = notes::all()->where("project_id", $id);
        $chart = DB::select(DB::raw("select count(*) as total_progress, progress from excels WHERE project_id=$id group by progress"));
        // $chart = response()->json(DB::table('excels')->where("project_id", $id)->select("select count(*) as total_progress, progress from excels group by progress"));
        
        $chartData= [];
        foreach($chart as $list){
                array_push($chartData,[$list->progress,  $list->total_progress]);
            } 
            


        return view('superadmin.projectManagement.project.viewproject', ["data" => $data, "data2" => $data2, "excel_data"=>$excelData, "excel_data1"=>$excelData1, "excel_data0"=>$excelData0,"note"=>$note ,"arr"=> $chartData,"empName"=>$empName]);
    }
    //  get File list
    public function projectViewfile($id)
    {
        $data22 = Files::all()->where("customer_id", $id);
        // $chart = DB::select(DB::raw("select count(*) as total_progress, progress from excels group by progress"));
         
        // $chartData="";
        //  foreach($chart as $list){
        //         $chartData.="['".$list->progress."',  ".$list->total_progress."],";
        //     }   
            // $chartData=rtrim($chartData,",");
            // $arr['chartData']=rtrim($chartData,",");
            // echo $chartData;
            dd($data22);
        return view('superadmin.projectManagement.project-details.viewproject', ["data" => $data22]);
    }
    // Edit Test
    public function projectEdittest()
    {
        $id = $_GET['customer_id'];
        return response()->json(notes::all()->where("customer_id", $id));
    }
    // download Project
    public function downloadProject()
    {
        $filepath = public_path('/images/Job sheet.xlsx');
        return response()->download($filepath); 
    }
    // task List
    public function taskList(){
        $id = $_GET["customer_id"];
        $data = Projects::all()->where("customer_id", $id);
        return response()->json($data);
    }
    // filter project 
    public function filterProjectName()
    {
        return response()->json(DB::table('projects')->where('clientExcel_name', 'LIKE', '%' . $_GET['user'] . '%')->paginate(10));
    }
}
