<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\DropShipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;

class DropShippingController extends Controller
{
    public function index()
    {
        return view('superadmin.dropshipping');
    }
    // ***************************************************************************************************//
    //                                           Drop Shipping SECTION                                    //
    //****************************************************************************************************//
/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // =================================================================================
    // fetch all Shippings
    // =================================================================================
    public function getShippings ()
    {
        if (Auth::user()->role_id == "0") {
            // $data = DropShipping::all();
            $data = response()->json(DB::table('drop_shippings')->paginate(5));
        } else {
            // $data = DropShipping::where('user_id',Auth::user()->id)->get();
            $data = response()->json(DB::table('drop_shippings')->where('owner_id',Auth::user()->id)->paginate(5));
        }
        return $data;
    }

    // public function getShippings()
    // {
        
    //         return response()->json(DB::table('drop_shippings')->where('customer', 'LIKE', '%' . $_GET['user'] . '%')->paginate(5));
        
            
        
    // }

    // =================================================================================
    // fetch a single Shipping
    // =================================================================================
    public function getShipping()
    {
        $id = $_GET["id"];
        $data = DropShipping::all()->where("id", $id);
        return response()->json($data);
    }

    // =================================================================================
    // Add Shipping
    // =================================================================================    
    public function addShipping(Request $request)
    {
        $uniqueTime = str_replace(' ', '', hexdec(date('Y-m-d H:i:s')));

        $validator = Validator::make($request->all(), [
            // "customer" => "required",
            // "product" => "required",
            // "order_no" => "required",
            // "mobile" => "required",
            // "merchant" => "required",
            // "pickup_address" => "required",
            // "delivery_address" => "required",
            // "date" => "required",
            // "status" => "required",
            // "payment_status" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()->toArray()]);
        } else {
            DropShipping::insert([
                "id" => $request->$uniqueTime . rand(),
                "owner_id" => Auth::user()->id,
                "customer" => $request->customer,
                "product" => $request->product,
                "order_no" => $request->ShippingOrder_no,
                "mobile" => $request->ShippingMobile_no,
                "merchant" => $request->merchant,
                "pickup_address" => $request->pickupAddress,
                "delivery_address" => $request->DeliveryName,
                "date" => $request->shippingDateName,
                "status" => $request->status,
                "payment_status" => $request->payment_status,
            ]);

            return response()->json(['success' => 'Shipping Added Succesfully']);
        }
    }

    // =================================================================================
    // Edit Shipping
    // =================================================================================    
    public function editShipping(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "customer" => "required",
            "product" => "required",
            "varient" => "required",
            "category" => "required",
            "merchant" => "required",
            "initial_address" => "required",
            "final_address" => "required",
            "deliveryman" => "required",
            "date" => "required",
            "status" => "required",
            "payment_status" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()->toArray()]);
        } else {
            DropShipping::where("id", $request->id)
                ->update([
                    "customer" => $request->customer,
                    "product" => $request->product,
                    "varient" => $request->varient,
                    "category" => $request->category,
                    "merchant" => $request->merchant,
                    "initial_address" => $request->initial_address,
                    "final_address" => $request->final_address,
                    "deliveryman" => $request->deliveryman,
                    "date" => $request->date,
                    "status" => $request->status,
                    "payment_status" => $request->payment_status,
                    "updated_at" => now()
                ]);

            return response()->json(['success' => 'Shipping Updated Succesfully']);
        }
    }

    // =================================================================================
    // Delete Shipping
    // =================================================================================        
    public function removeShipping()
    {
        $id = $_GET["id"];
        DropShipping::where("id", $id)->delete();
        return response()->json(["success" => "Shipping deleted successfully."]);
    }

    // =================================================================================
    // view Shipping
    // =================================================================================
    public function viewShipping()
    {
        $id = $_GET["id"];
        $data = DropShipping::all()->where("id", $id);
        return response()->json($data);
    }
}
