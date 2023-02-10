<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\rolepreviledges;
use Illuminate\Http\Request;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Role;
use GuzzleHttp\Client;
use App\Models\User;
use Exception;


class EmployeeController extends Controller
{
    // Display a listing of the resource.

    public function index()
    {

        return view('superadmin.staff-management.employee');
    }
    // insert employe data in DB
    public function addEmployee(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "name" => "required",
            "username" => "required",
            "emailid" => "required",
            "contactno" => "required|min:7",
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()->toArray()]);
        } else {

            if (Employee::all()->where('email_id', $request->emailid)->count() > 0) {

                return response()->json(['barerror' => 'Email is already registered.']);
            } else {
                $user = User::create([
                    "role_id" => '2',
                    "name" => $request->name,
                    "email" => $request->emailid,
                    "mobile_number" => $request->contactno,
                    "password" => Hash::make($request->password)
                ]);
                Employee::insert([
                    "owner_id" => Auth::user()->id,
                    "users_id" => $user->id,
                    "name" => $request->name,
                    "main_department" => $request->mainDepartmentEmployee,
                    "designation" => $request->designation,
                    "user_name" => $request->username,
                    "email_id" => $request->emailid,
                    "gender" => $request->gender,
                    "contact_no" => $request->contactno,
                    "password" => Hash::make($request->password),
                    "view_password" => $request->password,
                    "role" => $request->role,
                    "created_at" => now()
                ]);

                return response()->json(['success' => 'Employee Added Succesfully']);
            }
        }
    }
    // Address
    public function APIaddres()
    {
        $address = new Client();
        $res =  $address->request('GET', 'https://developers.onemap.sg/commonapi/search?searchVal=' . request()->postalcode . '&returnGeom=Y&getAddrDetails=Y', [
            'headers' => [
                'Content-Type' => 'application/json',
                'cache' => false,
                'Accept' => 'application/json',
            ],
            // 'data'=>[
            //         "searchVal"=> 819642,
            //     "returnGeom" => 'Y',
            //     "getAddrDetails"=> 'Y',
            //     ]
        ]);
        return ($res->getBody());
    }

    // find employee list
    public function getEmployeeDetail()
    {

        return response()->json(DB::table('employees')->paginate(5));
    }
    // fetch single employee detials
    public function getSingleEmployeeDetails()
    {
        $id = $_GET['id'];
        $data = Employee::all()->where('id', $id);
        return response()->json($data);
    }
    // fatch employee detail for update
    public function updateEmployeeDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "editcontactno" => "required",
            "editemailid" => "required",

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()->toArray()]);
        } else {
            $employee = Employee::where("id", $request->oldeditemployee)->first();
            $data = User::where("email", $employee->email)->first();
            // User::where("email",)
            // User::where("id",$employee->)
            user::where("id", $request->editUsersId)
                ->update([
                "name" => $request->editname,
                "email" => $request->editemailid,
                "mobile_number" => $request->editcontactno,
                "password" => Hash::make($request->editPassword),
                "updated_at" => now()
            ]);
            
            Employee::where("users_id", $request->editUsersId)
                ->update([
                    "name" => $request->editname,
                    "main_department" => $request->editMainDepartmentEmployee,
                    "designation" => $request->editDesignation,
                    "user_name" => $request->editusername,
                    "email_id" => $request->editemailid,
                    "gender" => $request->editgender,
                    "contact_no" => $request->editcontactno,
                    "password" =>  Hash::make($request->editPassword),
                    "view_password" => $request->editConformPassword,
                    "role" => $request->editRole,
                    "updated_at" => now()
                ]);

            return response()->json(['success' => 'Employee Updated Sucessfully']);
        }
    }
    // Remove Employee
    public function removeEmployee()
    {
        try {
            $id = $_GET['id'];
            Employee::where('id', $id)->delete();
            return response()->json(["success" => "Details Deleted Sucessfully."]);
        } catch (Exception $e) {
            return response()->json(['success' => 'Database query error..']);
        }
    }
    // filter Employee name
    public function filterEmployeeName()
    {
        return response()->json(DB::table('employees')->where('user_name', 'LIKE', '%' . $_GET['user'] . '%')->paginate(5));
    }
    // get Role name
    public function selectRoleName()
    {

        return response()->json(rolepreviledges::all()->where("role_name"));
    }
    // get Designation name
    public function selectdesignationName()
    {

        return response()->json(Designation::all()->where("designation_name"));
    }
}
