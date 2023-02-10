<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Exception;


class DepartmentController extends Controller
{
    // Redirect to Department Page
    public function index()
    {
        return view('superadmin.staff-management.department');
    }

    // insert Department data in DB
    public function addDepartment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "departmentname" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()->toArray()]);
        } else {
            Department::insert([
                "owner_id" => Auth::user()->id,
                "department_name" => $request->departmentname,
                "created_at" => now()
            ]);

            return response()->json(['success' => 'Department Added Succesfully']);
        }
    }
   
    // find department list
    public function getDepartmentDetail()
    {

        return response()->json(DB::table('departments')->paginate(5));
    }

    // Remove Department
    public function removeDepartment()
    {
        try {
            $id = $_GET['id'];
            Department::where('id', $id)->delete();
            return response()->json(["success" => "Details Deleted Successfully."]);
        } catch (Exception $e) {
            return response()->json(['success' => 'Database query error..']);
        }
    }
    // fatch department detail for update
    public function updateDepartmentDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "editdepartmentname" => "required",

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()->toArray()]);
        } else {
            Department::where("id", $request->oldeditdepartment)
                ->update([
                    "department_name" => $request->editdepartmentname,
                    "updated_at" => now()

                ]);

            return response()->json(['success' => 'department updated succesfully']);
        }
    }
    // fetch single department detials
    public function getSingleDepartmentDetails()
    {
        $id = $_GET['id'];
        $data = Department::all()->where('id', $id);
        return response()->json($data);
    }
    // filter department name
    public function filterDepartmentName()
    {
        return response()->json(DB::table('departments')->where('department_name', 'LIKE', '%' . $_GET['department'] . '%')->paginate(5));
    }
}
