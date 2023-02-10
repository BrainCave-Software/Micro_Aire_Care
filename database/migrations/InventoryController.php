<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\product;
use App\Models\Category;
use App\Models\PurchaseOrder;
use App\Models\Stock;
use App\Models\ReturnAndExchange;
use App\Models\SalesInvoice;
use App\Models\Warehouse;
use App\Models\Return_Goods_Warehouse;
use App\Models\Exchange_Goods_Warehouse;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    //
    // =================================================================================
    // All Inventory functions
    // =================================================================================    
    public function inventory(){
        $data = json_decode(product::all());

        return view('superadmin.inventory');

        // return response()->json(['data' => $data]);
    }

    // ***************************************************************************************************//
   //                                           PRODUCT SECTION                                          //
  //****************************************************************************************************//

    //   all list products details for forms
    public function getAllProducts(){
        if(Auth::User()->is_admin === '2'){
            // return response()->json(product::all());
            return response()->json(DB::table('products')->select('product_name')->distinct()->get());
        }else{
            // return response()->json(product::all()->where('owner_id', Auth::User()->id));
            return response()->json(DB::table('products')->where('owner_id', Auth::User()->id)->select('product_name')->distinct()->get());
        }
    }

    // get product name for stock form
    public function getNameProducts(){
        // return response()->json(product::all()->where('id', $_GET['val']));
        return response()->json(DB::table('products')->where('product_name', $_GET['val'])->distinct()->get());
    }


    // =================================================================================
    // fetch all products
    // =================================================================================
    public function getProducts(Request $request){
        if(Auth::User()->is_admin === '2'){
            // return response()->json(product::all());
            return response()->json(DB::table('products')->paginate(5));
        }else{
            // return response()->json(product::all()->where('owner_id', Auth::User()->id));
            return response()->json(DB::table('products')->where('owner_id', Auth::User()->id)->paginate(5));
        }
    }

    // =================================================================================
    // fetch a single product
    // =================================================================================
    public function getProductSection(){
        if(Auth::User()->is_admin === '2'){
            $id = $_GET["id"];
            $data = product::all()->where("id", $id);
            return response()->json($data);
        }else{
            $id = $_GET["id"];
            $data = product::all()->where("id", $id)->where('owner_id', Auth::User()->id);
            return response()->json($data);
        }
    }

    // =================================================================================
    // Add Product in inventory
    // =================================================================================    
    public function addProduct(Request $request){

            $uniqueTime = str_replace(' ', '', hexdec(date('Y-m-d H:i:s')));
            $count = product::all()
                            ->where("product_name", $request->name)
                            ->where("product_varient", $request->productVarient)
                            ->where("owner_id", Auth::user()->id)
                            ->count();
            if($count > 0){
                return response()->json(['barerror'=>'Product is already exists in stock.']);
            }else{
               
                $imageName = time().'.'.$request->image->extension();

                $request->image->move(public_path('products'), $imageName);

                product::insert([
                    "id" => $request->$uniqueTime.rand(),
                    "owner_id" => Auth::user()->id,
                    "product_name" => $request->name,
                    "product_varient" => $request->productVarient,
                    "product_category" => $request->productCategory,
                    "uom" => $request->uom,
                    "img_path" => $imageName,
                    "sku_code" => $request->skuCode,
                    "min_sale_price" => $request->minScalePrice,
                    "tax" => $request->tax,
                    "supplier_code" => $request->supCode,
                    "created_at" => now(),
                ]);

                return response()->json(['success'=>'Product added succesfully']);
            }
    }


    // =================================================================================
    // Edit Products
    // =================================================================================    
    public function editProduct(Request $request){

        $validator = Validator::make($request->all(),[
            "name" => "required",
            "productVarient" => "required",
            "productCategory" => "required",
            // "skuCode" => "required",
            "minScalePrice" => "required",
            // "tax" => "required",
            // "supCode" => "required",
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
        }else{
            if($request->file('image') === null){
                product::where("id", $request->product_id)
                ->update([
                    "product_name" => $request->name,
                    "product_varient" => $request->productVarient,
                    "product_category" => $request->productCategory,
                    "sku_code" => $request->skuCode,
                    "min_sale_price" => $request->minScalePrice,
                    "tax" => $request->tax,
                    "supplier_code" => $request->supCode,
                    "updated_at"=>now()
                ]);
            }else{

                $imageName = time().'.'.$request->image->extension();

                $request->image->move(public_path('products'), $imageName);

                product::where("id", $request->product_id)
                ->update([
                    "product_name" => $request->name,
                    "product_varient" => $request->productVarient,
                    "product_category" => $request->productCategory,
                    "img_path" => $imageName,
                    "sku_code" => $request->skuCode,
                    "min_sale_price" => $request->minScalePrice,
                    "tax" => $request->tax,
                    "supplier_code" => $request->supCode,
                    "updated_at"=>now()
                ]);
            }

            return response()->json(['success'=>'Product updated succesfully']);
        }
    }

    // =================================================================================
    // List Varients
    // =================================================================================            
    public function listVarients(){
        return response()->json(Category::all()->where('name', $_GET['val']));
    }

    // 
    // Fetch unique varietns
    // 
    public function listUniqueVarients()
    {
        return response()->json(DB::table('products')->select('product_name','product_varient')->distinct()->get());
    }

    // =================================================================================
    // Delete Product
    // =================================================================================        
    public function removeProduct(){
        $id = $_GET["id"];
        product::where("id", $id)->delete();
        return response()->json(["success" => "Product deleted successfully."]);
    }

    // =================================================================================
    // view product
    // =================================================================================
    public function viewProduct(){
        $id = $_GET["id"];
        $data = product::all()->where("id", $id);
        return response()->json($data);
    }

    // =================================================================================
    // Filter Product
    // =================================================================================
    public function listProductsFilter(){
        if(Auth::User()->is_admin === '2'){
            $category = $_GET['category'];
            $varient  = $_GET['varient'];

            $data = product::all()->where('product_category', $category)->where('product_varient', $varient);
            return response()->json($data);
        }else{
            $category = $_GET['category'];
            $varient  = $_GET['varient'];

            $data = product::all()->where('product_category', $category)->where('product_varient', $varient)->where('owner_id', Auth::user()->id);
            return response()->json($data);
        }
    }

    // =================================================================================
    // Filter Product
    // =================================================================================
    public function listProNameFilter(){
        if(Auth::User()->is_admin === '2'){
            $proName = $_GET['product_name'];

            // $data = product::all()->where('product_name', $proName);
            $data = DB::table('products')->where('product_name', 'LIKE', '%'.$proName.'%')->paginate(5);
            return response()->json($data);
        }else{
            $proName = $_GET['product_name'];

            // $data = product::all()->where('product_name', $proName)->where('owner_id', Auth::user()->id);
            $data = DB::table('products')->where('product_name', 'LIKE', '%'.$proName.'%')->where('owner_id', Auth::user()->id)->paginate(5);
            return response()->json($data);
        }
    }

    // ***************************************************************************************************//
   //                                           STOCK SECTION                                            //
  //****************************************************************************************************//


    // =================================================================================
    // add stock
    // =================================================================================
    public function addStock(Request $request){

            $count = Stock::all()
            ->where("product_name", $request->product_name)
            ->where("owner_id", Auth::user()->id)
            ->where('product_category', $request->category)
            ->where('product_varient', $request->varient)
            ->count();
            if($count > 0){
                return response()->json(['barerror'=> 'product is already exists in stock.']);
            }else{
                Stock::insert([
                    "owner_id" => Auth::user()->id,
                    "warehouse_name" => $request->warehouse,
                    "rack" => $request->rack,
                    "product_name" => $request->product_name,
                    "product_id" => $request->product_id,
                    "product_varient" => $request->varient,
                    "product_category" => $request->category,
                    "quantity" => $request->quantity,
                    // "sku_code" => $request->skuCode,
                    "sku_code" => $request->batchCode,
                    "expiry_date" => $request->expiryDate,
                    "created_at" => now()
                ]);

                product::where('id', $request->product_id)
                ->update([
                    'batch_code' => $request->batchCode,
                ]);

                return response()->json(["success" => "Product is added successfully in stock."]);
            }
    }


    // ***************************************************************************************************//
   //                                           CATEGORY SECTION                                         //
  //****************************************************************************************************//

    // =================================================================================
    // List Categories
    // =================================================================================
    public function listCategories(){
        $data = Category::all();
        return response()->json($data);
    }

    // =================================================================================
    // Add Category
    // =================================================================================
    public function addCategory(Request $request){
        $validator = Validator::make($request->all(),[
            "name" => "required",
            "status" => "required"
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
        }else{
            $count  = Category::all()->where("name", $request->name)->count();
            if($count > 0){
                return response()->json(['barerror'=> $request->name." name is already taken. Check category table!"]);
            }else{

                Category::insert([
                    "owner_id" => Auth::user()->id,
                    "name" => $request->name,
                    "status" => $request->status,
                    "created_at" => now(),
                ]);
    
                return response()->json(['success'=>'Category added succesfully']);
            }
        }
    }

    // =================================================================================
    // fetch Categories
    // =================================================================================
    public function getCategories(){
            return response()->json(DB::table('categories')->paginate(5));
    }

    // =================================================================================
    // fetch a single product
    // =================================================================================
    public function getCategory(){
        $id = $_GET["id"];
        $data = Category::all()->where("id", $id);
        return response()->json($data);
    }

    // =================================================================================
    // edit category
    // =================================================================================    
    public function editCategory(Request $request){
        $validator = Validator::make($request->all(),[
            "name" => "required",
            "status" => "required"
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
        }else{
            Category::where("id", $request->id)
            ->update([
                    "name" => $request->name,
                    "status" => $request->status,
                    "updated_at" => now(),
            ]);
            return response()->json(['success'=>'Category updated succesfully']);
        }        
    }

    // =================================================================================
    // Delete Category
    // =================================================================================        
    public function removeCategory(){
        $id = $_GET["id"];
        Category::where("id", $id)->delete();
        return response()->json(["success" => "Category deleted successfully."]);
    }

    // =================================================================================
    // view category
    // =================================================================================
    public function viewCategory(){
        $id = $_GET["id"];
        $data = Category::all()->where("id", $id);
        return response()->json($data);
    }    

    // =================================================================================
    // search category
    // =================================================================================    
    public function searchCategory()
    {
        if($_GET['category'] != ''){
            $filter = DB::table('categories')->where('name', 'LIKE', '%'.$_GET['category'].'%')->paginate(5);
            return response()->json($filter);
        }else{
            $filter = DB::table('categories')->paginate(5);
            return response()->json($filter);
        }
    }


    // ***************************************************************************************************//
   //                                    RETURN & EXCHAGE SECTION                                        //
  //****************************************************************************************************//

    // =================================================================================
    // Add Product
    // =================================================================================
            public function addREProduct(Request $request){

                $validator = Validator::make($request->all(),[
                    "type" => "required",
                    "user" => "required",
                    "invoiceNo" => "required",
                    "invoice_date" => "required",
                    "invoice_Amount" => "required",
                    "allProductDetails" => "required",
                ]);
        
                if($validator->fails()){
                    return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
                }else if(sizeof(json_decode($request->allProductDetails)) === 0){
                    return response()->json(['barerror'=>'Please add products in product table.']);
                }else{
                        ReturnAndExchange::insert([
                            "type" => $request->type,
                            "invoice_no" => $request->invoiceNo,
                            "user_id" => $request->user,
                            "user_name" => $request->user_name,
                            "invoice_date" => $request->invoice_date,
                            "invoice_amount" => $request->invoice_Amount,
                            "orders" => $request->allProductDetails,
                            "created_at" => now(),
                        ]);

                        $array = $request->allProductDetails;

                        // $dataArr = [];

                        // foreach(json_decode($array) as $k){
                            
                        //     if($k->status === 'return'){
                        //         // array_push($dataArr, [
                        //         //     "type" => $k->status,
                        //         //     "user_id" => $request->user,
                        //         //     "user_name" => $request->user_name,
                        //         //     "invoice_date" => $request->invoiceNo,
                        //         //     "product_Id" => $k->product_Id,
                        //         //     "product_name" => $k->product_name,
                        //         //     "quantity" => $k->quantityRAC,
                        //         //     "unit_price" => $k->unit_price,
                        //         //     "remark" => $k->remark,
                        //         // ]);

                        //         Return_Goods_Warehouse::insert([
                        //             "type" => $k->status,
                        //             "user_id" => $request->user,
                        //             "user_name" => $request->user_name,
                        //             "invoice_date" => $request->invoice_date,
                        //             "product_Id" => $k->product_Id,
                        //             "product_name" => $k->product_name,
                        //             "quantity" => $k->quantityRAC,
                        //             "unit_price" => $k->unit_price,
                        //             "remark" => $k->remark,
                        //             "created_at" => now(),
                        //         ]);
                        //     }else{
                        //         Exchange_Goods_Warehouse::insert([
                        //             "type" => $k->status,
                        //             "user_id" => $request->user,
                        //             "user_name" => $request->user_name,
                        //             "invoice_date" => $request->invoice_date,
                        //             "product_Id" => $k->product_Id,
                        //             "product_name" => $k->product_name,
                        //             "quantity" => $k->quantityRAC,
                        //             "unit_price" => $k->unit_price,
                        //             "remark" => $k->remark,
                        //             "created_at" => now(),
                        //         ]);
                        //     }
                            
                        // }

                        // return $dataArr;

                    return response()->json(["return_exchange_add_success" => "Product is added successfully."]);
                }
            }

    // =================================================================================
    // Fetch all products
    // =================================================================================    
    public function getREProducts(){
        return response()->json(DB::table('return_and_exchanges')->paginate(5));
    }

    // =================================================================================
    // fetch single product
    // =================================================================================        
    public function fetchREProducts(){
        $id = $_GET["id"];
        $data = ReturnAndExchange::all()->where("id", $id);
        return response()->json($data);
    }

    // =================================================================================
    // edit product
    // =================================================================================        
    public function editREProducts(Request $request){
        $validator = Validator::make($request->all(),[
            "type" => "required",
            "user" => "required",
            "invoiceNo" => "required",
            "invoice_date" => "required",
            "invoice_Amount" => "required",
            "allProductDetails" => "required",
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
        }else{

                $array = $request->allProductDetails;
            
                ReturnAndExchange::where('id', $request->reuniqueId)
                ->update([
                    "type" => $request->type,
                    "invoice_no" => $request->invoiceNo,
                    "user_id" => $request->user,
                    "user_name" => $request->user_name,
                    "invoice_date" => $request->invoice_date,
                    "invoice_amount" => $request->invoice_Amount,
                    "orders" => $request->allProductDetails,
                    "updated_at" => now(),
                ]);

                // foreach(json_decode($array) as $k){
                            
                //     if($k->status === 'return'){
                //         // array_push($dataArr, [
                //         //     "type" => $k->status,
                //         //     "user_id" => $request->user,
                //         //     "user_name" => $request->user_name,
                //         //     "invoice_date" => $request->invoiceNo,
                //         //     "product_Id" => $k->product_Id,
                //         //     "product_name" => $k->product_name,
                //         //     "quantity" => $k->quantityRAC,
                //         //     "unit_price" => $k->unit_price,
                //         //     "remark" => $k->remark,
                //         // ]);

                //         Return_Goods_Warehouse::where('product_Id', $k->product_Id)
                //         ->update([
                //             "type" => $k->status,
                //             "user_id" => $request->user,
                //             "user_name" => $request->user_name,
                //             "invoice_date" => $request->invoice_date,
                //             "product_Id" => $k->product_Id,
                //             "product_name" => $k->product_name,
                //             "quantity" => $k->quantityRAC,
                //             "unit_price" => $k->unit_price,
                //             "remark" => $k->remark,
                //             "updated_at" => now(),
                //         ]);
                //     }else{
                //         Exchange_Goods_Warehouse::where('product_Id', $k->product_Id)
                //         ->update([
                //             "type" => $k->status,
                //             "user_id" => $request->user,
                //             "user_name" => $request->user_name,
                //             "invoice_date" => $request->invoice_date,
                //             "product_Id" => $k->product_Id,
                //             "product_name" => $k->product_name,
                //             "quantity" => $k->quantityRAC,
                //             "unit_price" => $k->unit_price,
                //             "remark" => $k->remark,
                //             "updated_at" => now(),
                //         ]);
                //     }
                    
                // }

                return response()->json(["success" => "Product is updated successfully."]);
            }
        }

    // =================================================================================
    // remove product
    // =================================================================================        
    public function removeREProducts(){
        $id = $_GET["id"];
        ReturnAndExchange::where("id", $id)->delete();
        return response()->json(["success" => "Product is deleted successfully."]);
    }

    // =================================================================================
    // view product
    // =================================================================================        
    public function viewREProducts(){
        $id = $_GET["id"];
        $data = ReturnAndExchange::all()->where("id", $id);
        return response()->json($data);
    }

    // =================================================================================
    // filter return exchange product
    // =================================================================================            
    public function viewREFilter(){
        $status = $_GET['status'];
        return response()->json(ReturnAndExchange::all()->where('status', $status));
    }

    public function inputREFilter(){
        $pro_name = $_GET['user'];
        // return response()->json(ReturnAndExchange::all()->where('user', $pro_name));
        return response()->json(DB::table('return_and_exchanges')->where('user_name', 'LIKE', '%'.$pro_name.'%')->paginate(5));
    }

    // ***************************************************************************************************//
   //                                       Stock Tracking SECTION                                       //
  //****************************************************************************************************//     
  
    public function paginate($items, $perPage = 5, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $total = count($items);
        $currentpage = $page;
        $offset = ($currentpage * $perPage) - $perPage ;
        $itemstoshow = array_slice($items , $offset , $perPage);
        return new LengthAwarePaginator($itemstoshow ,$total   ,$perPage);
    }

    // =================================================================================
    // fetch all stock tracking detials
    // =================================================================================
    public function fetchStockTrackingDetails(Request $request){
        $sales_Invoice = SalesInvoice::all();
        $purchase_Invoice = PurchaseOrder::all();

        $arr = [];

        foreach($sales_Invoice as $value){
            array_push($arr, (object)[
                "id" => $value['id'],
                "products" => $value['products'],
                "name" => $value['customer_name'],
                "receipt_date" => $value['invoice_date'],
                "status" => "Outgoing"
            ]);
        }

        foreach($purchase_Invoice as $value){
            array_push($arr, (object)[
                "id" => $value['id'],
                "products" => $value['products'],
                "name" => $value['vendor_name'],
                "receipt_date" => $value['receipt_date'],
                "status" => "Incoming"
            ]);
        }

        $data = $this->paginate($arr, 4);
        $data->withPath($request->url());
        return $data;
    }

    // =================================================================================
    // fetch all stock tracking products detials
    // =================================================================================    
    public function fetchStockProductsDetails(){
        $id = $_GET['id'];
        $sales_Invoice = SalesInvoice::all()->where('id', $id);
        $purchase_Invoice = PurchaseOrder::all()->where('id', $id);

        $productsArr = [];

        foreach($sales_Invoice as $value){
            array_push($productsArr, (object)[
                "products" => $value['products'],
                "name" => $value['customer_name'],
                "status" => "Outgoing"
            ]);
        }

        foreach($purchase_Invoice as $value){
            array_push($productsArr, (object)[
                "products" => $value['products'],
                "name" => $value['vendor_name'],
                "status" => "Incoming"
            ]);
        }

        return $productsArr;
    }

    public function fetchStockProductsDetailsFilter(Request $request)
    {

        return $_GET['user'];

        $sales_Invoice = SalesInvoice::all();
        $purchase_Invoice = PurchaseOrder::all();

        $arr = [];

        foreach($sales_Invoice as $value){
            array_push($arr, (object)[
                "id" => $value['id'],
                "products" => $value['products'],
                "name" => $value['customer_name'],
                "receipt_date" => $value['invoice_date'],
                "status" => "Outgoing"
            ]);
        }

        foreach($purchase_Invoice as $value){
            array_push($arr, (object)[
                "id" => $value['id'],
                "products" => $value['products'],
                "name" => $value['vendor_name'],
                "receipt_date" => $value['receipt_date'],
                "status" => "Incoming"
            ]);
        }

        $data = $this->paginate($arr, 4);
        $data->withPath($request->url());
        return $data;
    }

    // ***************************************************************************************************//
   //                                       Stock Aging SECTION                                          //
  //****************************************************************************************************//    

    // =================================================================================
    // get stock details
    // =================================================================================            
    public function getStockDetails(){
        if(Auth::user()->is_admin === '2'){
            // return response()->json(Stock::all());
            return response()->json(DB::table('stocks')->paginate(5));
        }else{
            // return response()->json(Stock::all()->where('owner_id', Auth::user()->id));
            return response()->json(DB::table('stocks')->where('owner_id', Auth::user()->id)->paginate(5));
        }
    }

    // =================================================================================
    // get single stock detials
    // =================================================================================      
    public function getSingleStockDetails(){
        return response()->json(Stock::all()->where('id', $_GET['id']));
    }

    // =================================================================================
    // update single stock detials
    // =================================================================================      
    public function updateSingleStockDetails(Request $request){
        
                Stock::where('id', $request->id)
                ->update([
                    "quantity" => $request->quantity,
                    "sku_code" => $request->batchCode,
                    "expiry_date" => $request->expiryDate,
                    "updated_at" => now()
                ]);
                return response()->json(["success" => "Product is updated successfully in stock."]);
        
    }

    public function removeSingleStockDetails(){
        try{
            Stock::where('id', $_GET['id'])->delete();
            return response()->json(["success" => "Product is removed successfully in stock."]);
        }catch(Exception $e){
            return response()->json(['barerror'=>"Database Query Error..."]);
        }
    }
    
    // filter
    public function filterSingleStockDetails(){
        $proName = $_GET['product_name'];
        if($_GET['product_name'] != ''){
            // return response()->json(Stock::all()->where('product_name', $proName));
            return response()->json(DB::table('stocks')->where('product_name', 'LIKE', '%'.$proName.'%')->paginate(5));
        }else{
            return response()->json(DB::table('stocks')->paginate(5));
        }
    }



    // ***************************************************************************************************//
   //                                       Warehouse SECTION                                          //
  //****************************************************************************************************//    

    // =================================================================================
    // Add warehouse
    // =================================================================================   
    public function addWarehouse(Request $request){
        $validator = Validator::make($request->all(),[
            "name" => "required",
            "shortCode" => "required",
            // "address" => "required",
            // "racks" => "required",
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
        }else{
            try{

                if(Warehouse::where('name', $request->name)->where('owner_id', Auth::user()->id)->count() >= 1){

                    return response()->json(['barerror'=>'Warehouse name already exist.']);

                }else{

                    Warehouse::insert([
                        "owner_id" => Auth::user()->id,
                        "name" => $request->name,
                        "short_code" => $request->shortCode,
                        "address" => $request->address,
                        "racks" => $request->rack,
                        "created_at" => now(),
                    ]);

                    return response()->json(['success'=>'Warehouse details added succesfully']);
                }

            }catch(Exception $e){
                return response()->json(['barerror'=>"Database Query Error..."]);
            }
        }
    }

    // all list warehouse detials
    public function getAllWarehouseDetails(){
        if(Auth::user()->is_admin === '2'){
            try{
                return response()->json(Warehouse::all());
            }catch(Exception $e){
                return response()->json(['success'=>"Database Query Error..."]);
            }
        }else{
            try{
                return response()->json(Warehouse::all());
            }catch(Exception $e){
                return response()->json(['success'=>"Database Query Error..."]);
            }
        }
    }


    // get warehouse list name detials
    public function getlistWarehouseNameDetails()
    {
        try{
            return response()->json(Warehouse::all()->where('id', $_GET['id']));
        }catch(Exception $e){
            return response()->json(['success'=>"Database Query Error..."]);
        }
    }

    // fetch all rack warehouse details
    public function rackInfo()
    {
        $rack = $_GET['rack'];
        $warehouse = $_GET['warehouse'];

        try{
            return response()->json(Stock::all()->where('rack', $rack)->where('warehouse_name', $warehouse));
        }catch(Exception $e){
            return response()->json(['success'=>"Database Query Error..."]);
        }

    }

    // warehouse filter
    public function warehouseFilter()
    {
        try{
            return response()->json(DB::table('warehouses')->where('name', 'LIKE', '%'.$_GET['warehouse'].'%')->paginate(5));
        }catch(Exception $e){
            return response()->json(['success'=>"Database Query Error..."]);
        }
    }

    // fetch all
    public function getWarehouseDetails(){
        if(Auth::user()->is_admin === '2'){
            try{
                // Warehouse::all()
                return response()->json(DB::table('warehouses')->paginate(5));
            }catch(Exception $e){
                return response()->json(['success'=>"Database Query Error..."]);
            }
        }else{
            try{
                return response()->json(DB::table('warehouses')->where('owner_id', Auth::user()->id)->paginate(5));
            }catch(Exception $e){
                return response()->json(['success'=>"Database Query Error..."]);
            }
        }
    }

    // fetch single
    public function singleWarehouseDetails(){
        try{
            $id = $_GET['id'];
            return response()->json(Warehouse::all()->where('id', $id));
        }catch(Exception $e){
            return response()->json(['success'=>"Database Query Error..."]);
        }
    }

    // update 
    public function updateWarehouseDetails(Request $request){
        $validator = Validator::make($request->all(),[
            "name" => "required",
            "shortCode" => "required",
            // "address" => "required",
            // "racks" => "required",
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
        }else{
            try{

                Warehouse::where('id', $request->warehouseId)
                ->update([
                    "name" => $request->name,
                    "short_code" => $request->shortCode,
                    "address" => $request->address,
                    "racks" => $request->rackArr,
                    "updated_at" => now(),
                ]);

                return response()->json(['success'=>'Warehouse details updated succesfully']);

            }catch(Exception $e){
                return response()->json(['barerror'=>"Database Query Error..."]);
            }
        }
    }

    // remove
    public function removeWarehouseDetails(){
        try{
            $id = $_GET['id'];
            Warehouse::where('id', $id)->delete();
            return response()->json(['success'=>'Warehouse details removed succesfully']);
        }catch(Exception $e){
            return response()->json(['success'=>"Database Query Error..."]);
        }
    }


    // return goods warehouse
    public function getReturnGoodsWarehouseDetails()
    {
        return response()->json(ReturnAndExchange::all());
    }


}
