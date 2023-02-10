<?php

namespace App\Http\Controllers\CustomerAPI;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Exception;
use App\Models\Variation;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    //add variation
    public function addVariation(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "id"=> "required",
                "task_id"=> "required",
                "products" => "required",
                "size" => "required",
                "contact" => "required",
                "remarks" => "required",
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->getMessageBag()->toArray()]);
            } else {

                 Variation::create([
                    "user_id" => $request->id,
                    "sub_task_id" => $request->task_id,
                    "products" => $request->products,
                    "size" => $request->size,
                    "contact" => $request->contact,
                    "remarks" => $request->remarks,
                    "created_at" => now(),
                ]);
                
                return response()->json(["success" => "Variation added successfully."]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function getVariation($user_id , $sub_task_id){
        $newVar = Variation::all()->where("user_id", $user_id)->where("sub_task_id", $sub_task_id);

        return response()->json([
            "status" => true,
            "message" => "job descriptions Details",
            "data" => $newVar,
        ]);
    }
}
