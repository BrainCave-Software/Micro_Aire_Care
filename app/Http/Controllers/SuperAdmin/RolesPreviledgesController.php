<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rolepreviledges;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class RolesPreviledgesController extends Controller
{
    // Display a listing of the resource.

    public function index()
    {
        return view('superadmin.staff-management.rolesandpreviledges');
    }

    // insert employe data in DB
    public function addpreviledges(Request $request)
    {
        $uniqueTime = str_replace(' ', '', hexdec(date('Y-m-d H:i:s')));

        $validator = Validator::make($request->all(), [
            "employeid" => "rolename",
            "emailid" => "access",
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()->toArray()]);
        } else {

            if (rolepreviledges::all()->where('id', $request->id)->count() > 0) {

                return response()->json(['barerror' => 'id is alrealy registered.']);
            } else {
                rolepreviledges::insert([
                    "owner_id" => Auth::user()->id,
                    "role_id" => $request->$uniqueTime . rand(),
                    "role_name" => $request->rolename,
                    "access" => $request->access,
                    "role_modules" => implode(",", array_filter($request->list)),
                    "created_at" => now()
                ]);

                return response()->json(['success' => 'Role and Previledges Added Succesfully']);
            }
        }
    }
    // Table list 
    public function getRoleList(Request $request)
    {
        return response()->json(DB::table('rolepreviledges')->paginate(5));
    }
    // Edit and view getSingleRoleDetails
    public function getSingleRoleDetails()
    {
        $id = $_GET['id'];
        $data = rolepreviledges::all()->where("id", $id);
        return response()->json($data);
    }
    // Edit update
    public function getUpdateRole(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "task_name" => "rolename",
            "assigned_to" => "access",

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()->toArray()]);
        } else {
            rolepreviledges::where("id", $request->oldrole)
                ->update([
                    "role_name" => $request->rolename,
                    "access" => $request->access,
                    "role_modules" => implode(",", array_filter($request->list)),
                    "updated_at" => now()
                ]);

            return response()->json(['success' => ' Role and Previledges Updated Succesfully']);
        }
        return ['success' => 'Role and Previledges updated succesfully'];
    }
    // remove Role and previledges
    public function removeRolePreviledges()
    {
        $id = $_GET['id'];
        rolepreviledges::where('id', $id)->delete();
        return response()->json(["success" => "Details Deleted Successfully."]);
    }

      // filter Role and Previledges
      public function filterroleandpriviledges()
      {
          return response()->json(DB::table('rolepreviledges')->where('role_name', 'LIKE', '%' . $_GET['user'] . '%')->paginate(5));
      }
}
