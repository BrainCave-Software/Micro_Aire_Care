<?php

namespace App\Http\Controllers\CustomerAPI;

use App\Http\Controllers\Controller;
use App\Models\Assign;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Projects;
use App\Models\Employee;
use App\Models\product;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Products;
use App\Models\ProjectFile;
use App\Models\Attendance;
use App\Models\clock;
use App\Models\Excel;
use App\Models\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use PhpParser\Node\Stmt\If_;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;
use SebastianBergmann\Environment\Console;
use Symfony\Contracts\Service\Attribute\Required;

class CustomerController extends Controller
{
    public function viewprofile($id)
    {
        
        
        
        $customer = User::join('employees','employees.users_id','=','users.id')->where('users_id',$id)->first();
        return response()->json([
            "status" => true,
            "message" => "User profile Details",
            "data" => $customer,
        ]);
    }
    // update employee method
    public function updateemployee(Request $request)
    {
        if (auth()->user()) {
            $validator = validator::make($request->all(), [
                'id' => 'required',
                'user_name' => 'Required|string',
                'contact_no' => 'Required|string',
                'email_id' => 'Required|email|string',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors());
            }
            $employee = Employee::find($request->id);
            $employee->user_name = $request->user_name;
            $employee->contact_no = $request->contact_no;
            $employee->email_id = $request->email_id;
            $employee->save();
            return response()->json(['success' => true, 'msg' => 'User Data', 'data' => $employee]);
        } else {

            return response()->json(['success' => false, 'msg' => 'User is not Authenticated.']);
        }
    }

    public function updateprofile(Request $request)
    {
        try {
            header('Access-Control-Allow-Methods: * ');
            header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Accept,charset,boundary,Content-Length');
            header('Access-Control-Allow-Origin: *');
            $user = User::find($request->id);
            $validator = Validator::make($request->all(), [
                "id" => "required",
                "email" => "required",
                "name" => "required",
                "mobile" => "required",
                "gender" => "required",
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->getMessageBag()->toArray()]);
            }
            if ($request->image) {
                $file = $request->file('image');
                $ext =  $file->getClientOriginalExtension();
                $filename = time() . '.' . $ext;
                $file->move('Profile/', $filename);
                $profileimageWithFullPath = "Profile/";
                User::where('id', $request->id)
                    ->update([
                        "name" => $request->name,
                        "email" => $request->email,
                        "phone_number" => $request->phone_number,
                        "mobile_number" => $request->mobile_number,
                        "image" => 'https://yongseng.tbcsstesting.com/' . $profileimageWithFullPath . $filename,
                    ]);
                Employee::where('users_id', $request->id)
                    ->update([
                        "customer_name" => $request->name,
                        "address" => $request->address,
                        "email" => $request->email,
                        "phone_number" => $request->phone_number,
                        "mobile_number" => $request->mobile_number,
                    ]);

                return response(['message' => 'Profile updated successfully!'], 200);
            } else {
                User::where('id', $request->id)
                    ->update([
                        "id" => $user->id,
                        "email" => $request->email,
                        "name" => $request->name,
                        "mobile_number" => $request->mobile,
                        
                    ]);
                Employee::where('users_id', $request->id)
                    ->update([
                        "users_id" => $user->id,
                        "email_id" => $request->email,
                        "name" => $request->name,
                        "contact_no" => $request->mobile,
                        "gender" => $request->gender,
                    ]);
                return response(['message' => 'Profile updated successfully!'], 200);
            }
        } catch (Exception $e) {
            return response()->json(['error' => "Some things went wrong! Please try again"]);
        }
    }
    public function category()
    {
        try {
            $category = Category::where('status', 'active')->get();
            return $category;
        } catch (Exception $e) {
            return response()->json(['error' => "Some things  went wrong! Please try again"]);
        }
    }
    public function products()
    {
        try {
            $products = product::all();
            return $products;
        } catch (Exception $e) {
            return response()->json(['error' => "Some things went wrong! Please try again"]);
        }
    }
    public function product(Request $request)
    {
        try {
            $product = product::where('id', $request->id)->first();
            return $product;
        } catch (Exception $e) {
            return response()->json(['error' => "Some things went wrong! Please try again"]);
        }
    }
    public function customers($id)
    {
        $customer = Customer::find($id);
        return response()->json([
            "status" => true,
            "message" => "customer Details",
            "data" => $customer,
        ]);
    }
    public function employee()
    {
        try {
            $products = Employee::all();
            return $products;
        } catch (Exception $e) {
            return response()->json(['error' => "Some things went wrong! Please try again"]);
        }
    }
    public function updateClient(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "id" => "required",
                "name" => "required",
                "email" => "required",
                "phone_number" => "required",
                "address" => "required",
                "postal" => "required",
                "unit" => "required",
                "status" => "required",
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "message" => "Invalid Inputs",
                    "error" => $validator->getMessageBag()->toArray()
                ], 422);
            } else {

                $address = Customer::where('id', $request->id)
                    ->update([
                        "customer_name" => $request->name,
                        "customer_status" => $request->status,
                        "customer_email" => $request->email,
                        "customer_mobile" => $request->phone_number,
                        "customer_address" => $request->address,
                        "customer_postal" => $request->postal,
                        "unit_number" => $request->unit,
                        "updated_at" => now(),
                    ]);

                $response = [
                    'status' => true,
                    'message' => 'Client details updated',
                    'user_details' => $address,
                ];
                return response($response, 200);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function jobsheet($employee_id)
    {

        $job = Assign::all()->where('employee_id', $employee_id);

        return response()->json([
            "status" => true,
            "message" => "job descriptions Details",
            "data" => $job,
        ]);
    }




    public function jobsheetdetail($id)
    {

        $jobDetails = Projects::all()->where('project_id', $id);


        return response()->json([
            "status" => true,
            "message" => "job Sheet Details",
            "data" => $jobDetails,
        ]);
    }

    public function jobdescriptions($project_id, $employee_id)
    {
        $poject = Assign::all()->where("project_id", $project_id)->where("employee_id", $employee_id);

        return response()->json([
            "status" => true,
            "message" => "job descriptions Details",
            "data" => $poject,
        ]);
    }

    public function jobdescriptionsdetail(Request $request)
    {
        $jobdescDetail = ProjectFile::where('id', $request->id)->first();


        return response()->json([
            "status" => true,
            "message" => "file details",
            "data" => $jobdescDetail,
        ]);
    }

    public function ImageUpload(Request $request)
    {


        $validator = validator::make($request->all(), [
            'users_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,project_id',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ]);


        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()->toArray()]);
        }
        $image_path = $request->file('image')->store('image', 'public');

        $data = UploadImage::create([
            'users_id' => $request->users_id,
            'project_id' => $request->project_id,
            'img_path' => $image_path,
        ]);
        // dd($data);


        // $image = new UploadImage;
        // $image->id = $project->id;
        // $image->image_path = $image_path;
        // $image->save();
        //  // dd($customer);
        return response()->json([
            "status" => true,
            "message" => "Image Added successfully",
            "data" => $data,
        ]);
        // dd($data);



        // if ($validator->fails()) {
        //     return response()->json($validator->errors());
        // }
        // $image['$image'] = $request->file('image')->store('image','public');

        // $data = Image::create($validatedData);
        // $images->save();
        // return response()->json(['success' => true, 'msg' => 'Image Added successfully']);
    }

    public function clockIn(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:employees,id',
            'employee' => 'required',
            'date_time' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $attendance = new Attendance;
        $attendance->employee = $request->employee;
        $attendance->e_id = $request->id;
        $attendance->clock_in = $request->date_time;
        $attendance->save();

        // dd($attendance);
        return response()->json(['success' => true, 'attendance' => $attendance]);
    }


    public function clockOut(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:employees,id',
            'employee' => 'required',
            'date_time' => 'required',
            'attendance_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $attendance = Attendance::find($request->attendance_id);

        $attendance->clock_out = $request->date_time;
        $attendance->save();

        // dd($attendance);
        return response()->json(['success' => true, 'attendance' => $attendance]);
    }

    public function JobHistory($id)
    {
        // $history = DB::table('project_files')->join('task_progress', 'project_files.id', '=', 'task_progress.project_id')->select('project_files.job_sheet', 'task_progress.progress', 'task_progress.employee_name')->get();
        $history = DB::table('assigns')->where('employee_id',$id)->get();
        return response()->json([
            "status" => true,
            "message" => "job Status",
            "data" => $history,
        ]);
    }
    public function clocking()
    {
        $data = clock::first();
        return response()->json($data->status,200);
    }
}
