<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\product;
use App\Models\PurchaseOrder;
use App\Models\SalesInvoice;
use App\Models\Projects;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class SuperAdminController extends Controller
{
    public function dashboard()
    {
        // $count1 = User::where('is_admin', 1)->count();
        $count2 = Attendance::all()->count();
        $count3 = Attendance::all()->count();
        $count4 = Projects::all()->count();
        // $count5 = product::count();
       
       
        return view('superadmin.index',['count2'=>$count2,'count3'=>$count3 ,'count4'=>$count4]);
    }

    // view profile info
    public function profile(){
        return view('superadmin.profile-modal.view');
    }

    // update page redirect (profile detials update page)
    public function updateProfileFile(){
        return view('superadmin.profile-modal.update');
    }

    // update super admin profile / other user profile 
    public function updateProfile(Request $request){
        $validator = Validator::make($request->all(),[
            "name" => "required",
            "email" => "required|email:rfc,dns",
            "mobno" => "required|min:10",
            "phno" => "required|min:10",
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
        }else{
            User::where('id', $request->id)
            ->update([
                "name" => $request->name,
                "email" => $request->email,
                "phone_number" => $request->phno,
                "mobile_number" => $request->mobno,
                "updated_at" => now(),
            ]);
            return response()->json(['success'=>'Profile Updated Succesfully']);
        }
    }

    // fetch updated data
    public function getProfile(){
        $id = Auth::User()->id;
        return response()->json(User::all()->where('id', $id));
    }

    // update password
    public function updatePassword(Request $request){
        $user = User::find($request->id);
        $old_password = $user->password;
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|min:8|same:password_confirmation',
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
        }

        if (Hash::check($request->password, $old_password)) {
            return response()->json(["barerror" =>  "Error! New Password and Current password can't be same."]);
        } elseif (Hash::check($request->current_password, $old_password)) {
            $obj_user = User::find($request->id);
            $obj_user->password = Hash::make($request->password);
            $obj_user->save();
            return response()->json(["success" => "Password Changed Successfully !"]);
        } else {
            return response()->json(["barerror" =>  "Error! Please enter correct current password."]);
        }
    }

    // fetch no of products
    public function getNoOfProducts()
    {
        return response()->json(product::all()->count());
    }

    // Total Sale
    public function totalSale()
    {
        $total = 0;

        $data = SalesInvoice::all();

        foreach($data as $value){
            $total += $value['total'];
        }
        return $total;
    }

    // Total Purchase
    public function totalPurchase()
    {
        $total = 0;

        $data = PurchaseOrder::all();

        foreach($data as $value){
            $total += $value['total'];
        }
        return $total;        
    }

    // Total Orders
    public function totalOrders()
    {
        return response()->json(SalesInvoice::all()->count());
    }
}
