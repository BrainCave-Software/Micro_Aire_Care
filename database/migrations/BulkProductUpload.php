<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;
use Exception;
use Illuminate\Support\Facades\Auth;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Validator;

class BulkProductUpload extends Controller
{
    //
    public function bulkProductUpload(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "bulk_file" => "required",
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
        }else{

                $file = $request->file('bulk_file');

                $imageName = time().'.'.$request->bulk_file->extension();

                $request->bulk_file->move(public_path('uploads'), $imageName);

                $location = 'uploads';
                
                $filepath = public_path($location . "/" . $imageName);

                try{
                    $users = (new FastExcel)->import($filepath, function ($line) {
                        if($line['UOM'] === '' || $line['Product Name']=== '' || $line['Product Varient']==='' || $line['Product Category']==='' || $line['SKU Code']==='' || $line['Sale Price']==='' || $line['Tax']==='' || $line['Vendors']==='')
                        {
                            return 'empty';
                        }else{
                            return product::insert([
                                "owner_id" => Auth::user()->id,
                                "product_name" => $line['Product Name'],
                                "product_category" => $line['Product Category'],
                                "product_varient" => $line['Product Varient'],
                                "uom" => $line['UOM'],
                                "img_path" => $line['Image'],
                                "sku_code" => $line['SKU Code'],
                                "min_sale_price" => $line['Sale Price'],
                                "tax" => $line['Tax'],
                                "supplier_code" => $line['Vendors'],
                                "created_at" => now()
                            ]);
                        }
                    });

                    if($users[0] == 1){
                        return response()->json(['bulk_success' => 'Data Uploaded Successfully.']);
                    }else{
                        return response()->json(['bulk_success_alert' => 'Check your file. File should contain all maindatory fields.']);
                    }

                }Catch(Exception $e){
                    return response()->json(['bulk_success_alert' => 'Your file should contain all mandatory fields']);
                }
        }
    }


    // download products excel file
    public function productsExcel()
    {
        return (new FastExcel(product::all()))->download('product.xlsx', function ($product) {
            return [
                "Image" => '',
                "Product Name" => '',
                "Product Category" => '',
                "Product Varient" => '',
                "SKU Code" => '',
                "UOM" => '',
                "Sale Price" => '',
                "Tax" => '',
                "Vendors" => '',
            ];
        });
    }

}
