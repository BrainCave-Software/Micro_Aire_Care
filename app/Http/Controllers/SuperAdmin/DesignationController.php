<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Designation;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Exception;


class DesignationController extends Controller
{
    //Redirect to Designation Page
    public function index()
    {
        return view('superadmin.staff-management.designation');
    }

    // insert Department data in DB
    public function addDesignation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "designationName" => "required",
            "mainDepartment" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()->toArray()]);
        } else {
            Designation::insert([
                "owner_id" => Auth::user()->id,
                "designation_name" => $request->designationName,
                "main_department" => $request->mainDepartment,
                "created_at" => now()
            ]);

            return response()->json(['success' => 'Designation Added Succesfully']);
        }
    }

    // find designation list
    public function getDesignationDetail()
    {

        return response()->json(DB::table('designations')->paginate(5));
    }
    // fetch single employee detials
    public function getSingleDesignationDetails()
    {
        $id = $_GET['id'];
        $data = Designation::all()->where('id', $id);
        return response()->json($data);
    }
    // Remove Designation
    public function removeDesignation()
    {
        try {
            $id = $_GET['id'];
            Designation::where('id', $id)->delete();
            return response()->json(["success" => "Details Deleted Successfully."]);
        } catch (Exception $e) {
            return response()->json(['success' => 'Database query error..']);
        }
    }
    // get department name
    public function selectDepartmentName(){
        return response()->json(Department::all()->where("department_name"));
    }
    // fatch designation detail for update
    public function UpdateDesignationDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "editDesignationName" => "required",
            "editMainDepartment" => "required",

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()->toArray()]);
        } else {
            Designation::where("id", $request->oldEditDegination)
                ->update([
                    "designation_name" => $request->editDesignationName,
                    "main_department" => $request->editMainDepartment,
                    "updated_at" => now()

                ]);

            return response()->json(['success' => 'Designation Updated Succesfully']);
        }
    }
    // filter designation
    public function filterDesignationName()
    {
        return response()->json(DB::table('designations')->where('designation_name', 'LIKE', '%' . $_GET['designation'] . '%')->paginate(5));
    }
}
