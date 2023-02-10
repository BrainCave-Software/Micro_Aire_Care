<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ProjectFile;
use Illuminate\Support\Facades\Auth;
use Shuchkin\SimpleXLSX;
use App\Models\Excel;
use App\Models\notes;
use Illuminate\Support\Facades\DB;
use Shuchkin\SimpleXLSXEx;
use PHPExcel; 
use PHPExcel_IOFactory;
use Maatwebsite\Excel\Concerns\ToModel;

class ProjectFileController extends Controller
{

    //Add to DB
    public function createProjectFile(Request $request)
    {
        $file = $request->projectFile;

        $xlsx = SimpleXLSX::parse($file);
        // job sheet
        $data = $xlsx->rowsEx();
        $row = $data[2];
        $tb = $row[18];
        $job = $tb['value'];
        // client name
        $row1 = $data[13];
        $tb1 = $row1[4];
        $name = $tb1['value'];
        // mobile
        $row15 = $data[15];
        $col7 = $row15[7];
        $mobile = $col7['value'];
        // Address
        $row6 = $data[6];
        $col4 = $row6[4];
        $address = $col4['value'];
        // postal code
        $row8 = $data[8];
        $col4 = $row8[4];
        $postal = $col4['value'];

         // Task
         $arr = [];
         $subArr = [];
      
         for ($i = 20;; ++$i) {
             $subH = $data[$i][2]['value'];
            $subT = $data[++$i][3]['value'];
             array_push($arr, (object) ["heading" => $subH, "data" => $subT]);
             array_push($subArr,  ["heading" => $subH, "data" => $subT]);
             if ($data[$i + 1][2]['value'] == '') {
                
                 break;
             }
             
            }
       

           

        

        $imageName = time() . '.' . $request->projectFile->extension();

        $request->projectFile->move(public_path('products'), $imageName);
        $url = env("APP_URL", "https://microaire.braincave.work");

       $task_id = ProjectFile::create([
            "owner_id" => Auth::user()->id,
            "project_file" => $url . 'products/' . $imageName,
            "job_sheet" => $job,
            "client_name" => $name,
            "mobile" => $mobile,
            "address" => $address,
            "task" => json_encode($arr),
            "postalCode" => $postal,
            "created_at" => now()
        ]);

            foreach($subArr as $key => $value ){
                Excel::insert([
                    "owner_id" => Auth::user()->id,
                    "project_id" => $task_id->id,
                    "project_no" => $job,
                    'progress' => 'New',
                    "heading" => $value['heading'],
                    "task" =>$value['data'],
                    "created_at" => now()
                ]);
                notes::insert([
                    "owner_id" => Auth::user()->id,
                    "project_id" => $task_id->id,
                    "project_no" => $job,
                    "heading" => $value['heading'],
                    "task" =>$value['data'],
                    "created_at" => now()
                ]);
            }
        $return_data= array(
            "project_id" => $task_id->id,
            "job_sheet" => $job,
            "client_name" => $name,
            "address" => $address,
            "mobile" => $mobile,
            "task" =>json_encode($arr),
            "postalCode" => $postal,
        );


        return response()->json(["success" => "successfully" , "return_data"=>$return_data]);
        // $csvData = file_get_contents($file);
        // $rows = array_map("str_getcsv", explode("\n",$csvData));
        // $xlsx = SimpleXLSX::parse($file);
        // $rows = $xlsx->getCell('AK10');
        // dd($xlsx->rowsEx());



    }
    // For sheet Check(row and colum)
    public function exelsheet()
    {
        $file = public_path('\products\1668055235.xlsx');

        $xlsx = SimpleXLSX::parse($file);

        $data = $xlsx->rowsEx();
         $row = $data[9];
        // $tb = $row[44];
        // $tp = $tb['value'];



        // foreach($data[45] as $i){
        //     if($i["name"] == "T46"){
        //         return $i['value'];
        //     }
        // }
        // dd($row);
        // return response()->json($data[52]);
    }
    // table list
    public function getProjectfileList()
    {
        return response()->json(DB::table('project_files')->paginate(10));
    }
    // auto Fill Form
    public function autoFillForm(){
        // return response()->json(ProjectFile::last());

    } 
    // update Project table
    public function addProject(Request $request){
        ProjectFile::where('id', $request->id)
        ->update([
            "job_sheet" =>$request->projecttitle,
            "client_name" =>  $request->clientExcelName,
            "date" => $request->startdate,
            "delivery_date" => $request->deadline,
            "mobile" =>  $request->mobileNo,
            "sale_person" => $request->assignto,
            "sale_contact" => $request->saleContact,
            "updated_at" => now()
        ]);

    return response()->json(['success' => 'User Updated Succesfully']);
    }

    
}
