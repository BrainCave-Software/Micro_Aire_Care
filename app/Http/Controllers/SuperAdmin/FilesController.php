<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Storage;
use Illuminate\Http\Request;
use App\Models\Files;

use Illuminate\Support\Facades\Auth;
use Exception;

use Symfony\Component\Finder\Iterator\FilenameFilterIterator;

class FilesController extends Controller
{
    //add data to database
    public function addFiles(Request $request)
    {
        
        $filesize = filesize( $request->project_document);
        $filesizeMB = round($filesize / 1024 / 1024, 2);
        $image = $request->project_document;
        $namewithextension = $image->getClientOriginalName();
        $imageName = time() . '.' . $request->project_document->extension();
        $request->project_document->move(public_path('products'), $imageName);
        $url = env("APP_URL", "https://microaire.braincave.work");

        Files::insert([
            "owner_id" => Auth::user()->id,
            "customer_id" => $request->clientfileid,
            "project_Name" =>$namewithextension ,
            "file" => $url . 'products/' . $imageName,
            "size" => $filesizeMB . 'MB',
            "created_at" => now(),
        ]);

        return response()->json(['success' => 'File Added Succesfully']);


        
    }
    // Fatch data  client file
    public function showFiles()
    {
        $id = $_GET['customer_id'];
        return response()->json(Files::all()->where("customer_id", $id));
    }

    // Fatch data  project file
    public function showProjectFiles()
    {
        $id = $_GET['id'];
        return response()->json(Files::all()->where("id", $id));
    }
    // remove files
    public function deleteFiles()
    {
        try {
            $id = $_GET['id'];
            Files::where('id', $id)->delete();
            return response()->json(['success' => 'Files Detials Removed Succesfully']);
        } catch (Exception $e) {
            return response()->json(['success' => 'Database query error..']);
        }
    }

    //  Download files
    public function downloadFiles()
    {
        try {
            $id = $_GET['id'];
            Files::where('id', $id);
            return response()->json(['success' => 'Files Detials Download Succesfully']);
        } catch (Exception $e) {
            return response()->json(['success' => 'Database query error..']);
        }
    }

   
    
}
