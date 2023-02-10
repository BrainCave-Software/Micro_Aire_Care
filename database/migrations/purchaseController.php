<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PurchaseQuotation;
use App\Models\PurchaseOrder;
use App\Models\product;
use App\Models\Stock;
use Exception;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

class purchaseController extends Controller
{


    // fetch unique vendors for return & exchange forms
    public function getAllInvoiceForReturnExchange()
    {
        $data = DB::table('purchase_orders')->select('vendor_id', 'vendor_name')->distinct()->get();

        return response()->json($data);
    }

    // all vendors unique invoice numbers
    public function fetchAllInvoicesNoforPayment()
    {
        $id = $_GET['id'];
        $data = PurchaseOrder::all()->where('vendor_id', $id);
        return response()->json($data);
    }

    // fetch all invoice numbers
    public function fetchAllProductsDetails(){
        $id = $_GET["pro"];
        $data = PurchaseOrder::all()->where('id', $id);
        return response()->json($data);
    }

    //
    public function index(){
        return view('superadmin.purchase');
    }

    //generate pdf
    public function purchaseInvoiceGeneratePDF($id)
    {
        $data = PurchaseOrder::where('id', $id)->get();
        $products = PurchaseOrder::where('id', $id)->value('products');
        $pdf = PDF::loadView('superadmin.purchase.purchase-order-modal.purchase-pdf', ['data'=>$data, 'products'=>$products]);
            
        return $pdf->download('invoice.pdf');
    }

    // quotaion sales
    public function purchaseQGeneratePDF($id)
    {
        $data = PurchaseQuotation::where('id', $id)->get();
        $products = PurchaseQuotation::where('id', $id)->value('products');
        $pdf = PDF::loadView('superadmin.purchase.purchase-order-modal.quotation-pdf', ['data'=>$data, 'products'=>$products]);
            
        return $pdf->download('purchase_quotation.pdf');
    }

    
   

    

    


  



  


    //===============================================================================================
    //                                  add quotation request
    //===============================================================================================       
    public function addRequest(Request $request){
        $products = $request->allProductDetails;
        $validator = Validator::make($request->all(),[
            "vendorName" => "required",
            "receiptDate" => "required",
            "vendorReference" => "required",
            "untaxtedAmount" => "required",
            "gst" => "required",
            "quotationTotal" => "required"
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
        }else if(sizeof(json_decode($products)) === 0){
            return response()->json(['barerror'=>'Please add products in product table.']);
        }else{
            try
            {

                $checkbox = ($request->taxInclude === 'on')?true:false;

                PurchaseQuotation::insert([
                    "vendor_name" => $request->vendorName,
                    "receipt_date" => $request->receiptDate,
                    "vendor_reference" => $request->vendorReference,
                    "confirmation" => $request->askForConfirm,
                    "products" => $products,
                    "note" => $request->notes,
                    "tax_inclusive" => $checkbox,
                    "untaxted_amount" => $request->untaxtedAmount,
                    "GST" => $request->gst,
                    "total" => $request->quotationTotal,
                    "created_at" => now()
                ]);

                return response()->json(['success'=>'Quotation added succesfully']);
            }
            catch(Exception $e)
            {
                return response()->json(['barerror'=>"Database Query Error."]);
            }
        }
    }

    //===============================================================================================
    //                          get all request quotations detials
    //===============================================================================================     
    public function requestQuotations(){
        return response()->json(DB::table('purchase_quotations')->paginate(5));
    }

    // all quotation ids
    public function requestAllQuotations()
    {
        return response()->json(PurchaseQuotation::all());
    }

    // filter
    public function requestAllQuotationsFilter()
    {
        return response()->json(DB::table('purchase_quotations')->where('vendor_name', 'LIKE', '%'.$_GET['user'].'%')->paginate(5));
    }

    // fetch all products detials
    public function fetchProductsAllInfo()
    {
        return response()->json(product::all());
    }


    //===============================================================================================
    //                              get single quotation
    //===============================================================================================     
    public function getRequestQuotation(){
        $id = $_GET['id'];
        return response()->json(PurchaseQuotation::all()->where('id', $id));
    }

    //===============================================================================================
    //                          update quotation detials
    //===============================================================================================         
    public function updateRequestQuotation(Request $request){
        $products = $request->allProductDetails;
        $validator = Validator::make($request->all(),[
            "vendorName" => "required",
            "receiptDate" => "required",
            "vendorReference" => "required",
            "untaxtedAmount" => "required",
            "gst" => "required",
            "quotationTotal" => "required"
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
        }else if(sizeof(json_decode($products)) === 0){
            return response()->json(['barerror'=>'Please add products in product table.']);
        }else{

            try
            {

                $checkbox = ($request->taxInclude === 'on')?true:false;

                PurchaseQuotation::where('id', $request->id)
                ->update([
                    "vendor_name" => $request->vendorName,
                    "receipt_date" => $request->receiptDate,
                    "vendor_reference" => $request->vendorReference,
                    "confirmation" => $request->askForConfirm,
                    "products" => $products,
                    "tax_inclusive" => $checkbox,
                    "note" => $request->notes,
                    "untaxted_amount" => $request->untaxtedAmount,
                    "GST" => $request->gst,
                    "total" => $request->quotationTotal,
                    "updated_at" => now()
                ]);

                return response()->json(['success'=>'Quotation updated succesfully']);
            }
            catch(Exception $e)
            {
                return response()->json(['barerror'=>"Database Query Error."]);
            }
        }
    }

    //===============================================================================================
    //                                     remove quotation
    //===============================================================================================             
    public function removeRequestQuotation(){
        $id = $_GET['id'];
        try{
            PurchaseQuotation::where('id', $id)->delete();
            return response()->json(['success'=>'Quotation deleted succesfully']);
        }
        catch(Exception $e)
        {
            return response()->json(['barerror'=>"Database Error."]);
        }
    }


          // ***************************************************************************************************//
         //                             Purchase Requisition Tab Function                                      //
        //****************************************************************************************************//    

    //===============================================================================================
    // Add New Purchase Order
    //===============================================================================================  
    public function addPurchaseOrder(Request $request){

        $products = $request->allProductDetails;

        $validator = Validator::make($request->all(),[
            "vendorNameOrder" => "required",
            "receiptDate" => "required",
            "vendorReference" => "required",
            "billingStatus"  => "required",
            "untaxtedAmount" => "required",
            "gst" => "required",
            "quotationTotal" => "required"
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
        }else if($request->quotationNumber == "" && $request->refOrderNum == ""){
            return response()->json(['barerror'=>'Please select quotation number or inter INV/2022/00001 (Anyone field required).']);
        }else if(sizeof(json_decode($products)) === 0){
            return response()->json(['barerror'=>'Please add products in product table.']);
        }else{
            try
            {   
                $checkbox = ($request->taxInclude === 'on')?true:false;

                PurchaseOrder::insert([
                    "quotation_no"=> $request->quotationNumber,
                    "refOrderNum"=> $request->refOrderNum,
                    "vendor_name"=> $request->vendorNameOrder,
                    "receipt_date"=> $request->receiptDate,
                    "vendor_reference"=> $request->vendorReference,
                    "billing_status"=> $request->billingStatus,
                    "confirmation"=> $request->askForConfirm,
                    "products"=> $products,
                    "notes"=> $request->notes,
                    "tax_inclusive" => $checkbox,
                    "untaxted_amount"=> $request->untaxtedAmount,
                    "GST"=> $request->gst,
                    "total"=> $request->quotationTotal,
                    "created_at" => now(),
                ]);

                $output =   json_decode($products, true);
        
                // foreach($output as $value){
                //     $inStock = Stock::where('product_id', $value['product_Id'])->value('quantity');
                //     $sum = $inStock + $value['quantity'];

                //     Stock::where('product_id', $value['product_Id'])
                //             ->update([
                //                 "quantity" => $sum,
                //                 "updated_at" => now(),
                //             ]);
                // }

                return response()->json(['success'=>'Purchase order details added succesfully']);
            }
            catch(Exception $e)
            {
                return response()->json(['barerror'=>"Database Query Error."]);
            }
        }
    }

    //===============================================================================================
    //                              get quotation detials
    //===============================================================================================     
    public function getOrdersDetails(){
        return response()->json(DB::table('purchase_orders')->paginate(5));
    }


    //===============================================================================================
    //                              get single order detials
    //===============================================================================================     
    public function getOrderDetails(){
        $id = $_GET['id'];
        return response()->json(PurchaseOrder::all()->where('id', $id));
    }

    //===============================================================================================
    //                                  Update
    //===============================================================================================     
    public function updateOrderDetails(Request $request){
        $products = $request->allProductDetails;
        $validator = Validator::make($request->all(),[
            "vendorName" => "required",
            "receiptDate" => "required",
            "vendorReference" => "required",
            "billingStatus"  => "required",
            "untaxtedAmount" => "required",
            "gst" => "required",
            "quotationTotal" => "required"
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
        }else if($request->quotationNumber == "" && $request->refOrderNum == ""){
            return response()->json(['barerror'=>'Please select quotation number or inter INV/2022/00001 (Anyone field required).']);
        }else if(sizeof(json_decode($products)) === 0){
            return response()->json(['barerror'=>'Please add products in product table.']);
        }else{
            try
            {

                $checkbox = ($request->taxInclude === 'on')?true:false;

                PurchaseOrder::where('id', $request->id)
                ->update([
                    "quotation_no"=> $request->quotationNumber,
                    "refOrderNum"=> $request->refOrderNum,
                    "vendor_name"=> $request->vendorName,
                    "receipt_date"=> $request->receiptDate,
                    "vendor_reference"=> $request->vendorReference,
                    "billing_status"=> $request->billingStatus,
                    "confirmation"=> $request->askForConfirm,
                    "tax_inclusive" => $checkbox,
                    "products"=> $products,
                    "notes"=> $request->notes,
                    "untaxted_amount"=> $request->untaxtedAmount,
                    "GST"=> $request->gst,
                    "total"=> $request->quotationTotal,
                    "updated_at" => now()
                ]);

                return response()->json(['success'=>'Purchase order details updated succesfully']);
            }
            catch(Exception $e)
            {
                return response()->json(['barerror'=>"Database Query Error."]);
            }
        }
    }

    //===============================================================================================
    //                                  remove order detials
    //===============================================================================================     
    public function removeOrderDetails(){
        $id = $_GET['id'];
        try{
            PurchaseOrder::where('id', $id)->delete();
            return response()->json(['success'=>'Purchase order details removed succesfully']);
        }
        catch(Exception $e)
        {
            return response()->json(['barerror'=>"Database Query Error..."]);
        }
    }

    // filter purchase order by vendor name
    public function purchaseOrderFilter()
    {
        return response()->json(DB::table('purchase_orders')->where('vendor_name', 'LIKE', '%'.$_GET['user'].'%')->paginate(5));
    }
}
