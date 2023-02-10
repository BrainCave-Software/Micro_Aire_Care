<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\notes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Exception;


class NotesController extends Controller
{
    //Add to DB
    public function createNotes(Request $request)
    {
        $validator = validator::make($request->all(), [
            "titlename" => "required",
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()->toArray()]);
        } else {

            if (notes::all()->where('customer_id', $request->clientnoteid)->where('title_name', $request->titlename)->count() > 0) {

                return response()->json(['barerror' => 'Alrealy Add.']);
            } else {


                notes::insert([
                    "owner_id" => Auth::user()->id,
                    "customer_id" => $request->clientnoteid,
                    "title_name" => $request->titlename,
                    "created_at" => now()
                ]);
                return response()->json(["success" => "Note Add Successfully."]);
            }
        }
    }
    // note list
    public function noteslist()
    {
       $id = $_GET['customer_id'];
        return response()->json(notes::all()->where("customer_id",$id));
    }
    // fetch a single Notes 
    public function getSingleNotes()
    {
        $id = $_GET["id"];
        $data = notes::all()->where("id", $id);
        return response()->json($data);
    }
    // remove notes
    public function notesremove()
    {
        try {
            $id = $_GET['id'];
            notes::where('id', $id)->delete();
            return response()->json(['success' => 'Notes  Delete Succesfully']);
        } catch (Exception $e) {
            return response()->json(['success' => 'Database query error..']);
        }
    }
    // add remarks for task
    public function getIdTask()
    {
        $id = $_GET['id'];
        $data = notes::all()->where('id', $id);
        return response()->json($data);
    }
}
