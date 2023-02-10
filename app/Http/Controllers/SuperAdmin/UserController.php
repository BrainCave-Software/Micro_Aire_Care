<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('superadmin.userManagement');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserDetails()
    {
        try {
            return response()->json(DB::table('users')->where('role_id', "1")->paginate(6));
        } catch (Exception $e) {
            return response()->json(["success" => "Database Query Error ..."]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "username" => "required",
            "mobilenumber" => "required|min:7",
            "emailid" => "required",
            "password" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()->toArray()]);
        } else {

            if (User::all()->where('email', $request->emailid)->count() > 0) {

                return response()->json(['barerror' => 'Email is Alrealy Registered.']);
            } else {
                User::insert([
                    "name" => $request->username,
                    "role_id" => "1",
                    "phone_number" => $request->phonenumber,
                    "mobile_number" => $request->mobilenumber,
                    "email" => $request->emailid,
                    "password" => Hash::make($request->password),
                    "assigned_modules" => implode(",", array_filter($request->list)),
                    "created_at" => now()
                ]);

                return response()->json(['success' => 'User Added Succesfully']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $id = $_GET['id'];
        return response()->json(User::all()->where('id', $id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
        $id = $_GET['id'];
        return response()->json(User::all()->where('id', $id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            "username" => "required",
            "mobilenumber" => "required|min:7",
            "emailid" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()->toArray()]);
        } else {
            User::where('email', $request->emailid)
                ->update([
                    "name" => $request->username,
                    "phone_number" => $request->phonenumber,
                    "mobile_number" => $request->mobilenumber,
                    "assigned_modules" => implode(",", array_filter($request->list)),
                    "updated_at" => now()
                ]);

            return response()->json(['success' => 'User Updated Succesfully']);
        }


        return ['success' => 'User Updated Succesfully'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        try {
            $id = $_GET['id'];
            User::where('id', $id)->delete();
            return response()->json(['success' => 'User Delete Succesfully']);
        } catch (Exception $e) {
            return response()->json(['success' => 'Database query error..']);
        }
    }

    public function supplier()
    {
        $supplier = Vendor::all();
        return response()->json($supplier);
    }
   
}
