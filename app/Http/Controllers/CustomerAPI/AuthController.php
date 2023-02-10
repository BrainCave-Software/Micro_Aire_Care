<?php

namespace App\Http\Controllers\CustomerAPI;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use App\Models\ResetPassword;
use App\Models\PasswordReset;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getdata()
    {
        $user = User::all();
        return $user;
    }
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name" => "required",
                "email" => "required|unique:users",
                "mobile_number" => "required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:10|unique:users",
                "password" => "required|min:8"
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->getMessageBag()->toArray()]);
            } else {

                $user = User::create([
                    "role_id" => "2",
                    "name" => $request->name,
                    "email" => $request->email,
                    "mobile_number" => $request->mobile_number,
                    "password" => Hash::make($request->password)
                ]);
                // dd($user);
                $employee_details = Employee::create([
                    "owner_id" => "20",
                    "users_id" => $user->id,
                    "name" => $request->name,
                    "user_name" => $request->name[0],
                    "email_id" => $request->email,
                    "contact_no" => $request->mobile_number,
                    "password" => Hash::make($request->password),
                    "view_password" => $request->password
                ]);

                $employee_details->save();


                return response()->json(["success" => "User created successfully."]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "email" => "required",
                "password" => "required"
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->getMessageBag()->toArray()]);
            } else {
                $user = User::where('email', $request->email)->first();
                if (!$user || !Hash::check($request->password, $user->password)) {
                    return response()->json(['status' => false, 'message' => 'Invalid Credential'], 200);
                }
                $token = $user->createToken('my-app-token')->plainTextToken;
                $response = [
                    'status' => true,
                    'message' => 'login successfully',
                    'user_details' => $user,
                    'token' => $token
                ];
                // Employee::where('email_id', $request->email_id)->update([
                //     'last_login_at' => Carbon::now()->toDateTimeString(),
                //     'last_login_ip' => $request->ip(),
                // ]);
                return response($response, 200);
            }
        } catch (Exception $e) {
            return response()->json(['error' => "Some things went wrong! Please try again"]);
        }
    }


    // private function resetPassword($email, $password)
    // {
    //     $email->password = bcrypt($password);
    //     $email->setRememberToken(Str::random(60));
    //     $email->save();
    // }


    public function changepswd(Request $request)
    {
       


        
    }



    public function forgotPassword(Request $request)
    {
        
            try {
                $validator = Validator::make($request->all(), [
                    "email" => "required",
                ]);
    
                if ($validator->fails()) {
                    return response()->json(['error' => $validator->getMessageBag()->toArray()]);
                } else {
                    $user = User::where('email', $request->email)->first();
    
                    if (!$user) {
                        return response()->json(['status' => false, 'message' => 'Email not exist!'], 200);
                    }
    
                    $credentials = request()->validate(['email' => 'required|email']);
                    Password::sendResetLink($credentials);
    
                    return response()->json(["success" => 'Reset password link sent on your email id.']);
                }
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        
        
        

    }

    

    public function resendPin(Request $request)
    {
        // return "HELLO";
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // find the code
        $passwordReset = ResetPassword::firstWhere('email', $request->email);

        // check if it does not expired: the time is one hour
        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            return response(['message' => trans('passwords.code_is_expire')], 422);
        }


        $user = User::firstWhere('email', $passwordReset->email);


        $user->update($request->only('password'));


        $passwordReset->delete();

        return response(['message' => 'password has been successfully reset'], 200);
    }

    public function broker()
    {
        return Password::broker();
    }
}
