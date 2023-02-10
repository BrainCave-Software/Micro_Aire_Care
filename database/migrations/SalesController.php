<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\SalesInvoice;
use App\Models\Payment;
use App\Models\Customer;
use App\Models\Quotation;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Symfony\Contracts\Service\Attribute\Required;

//namespace App\Http\Controllers;

//use Illuminate\Http\Request;

class SalesController extends Controller
{

   

    // ***************************************************************************************************//
   //                                           Quotation SECTION                                        //
  //****************************************************************************************************//
    // add quotation
    public function addQuotation(Request $request){

        $allProductDetails = $_REQUEST['allProductDetails'];

        $validator = Validator::make($request->all(),[
            "customerName" => "required",
            "expiration"  => "required",
            "customerAddress" => "required",
            "paymentTerms"  => "required",
            "untaxtedAmount"  => "required",
            // "gst"  => "required",
            "quotationTotal" => "required",
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
        }else if(sizeof(json_decode($allProductDetails)) === 0){
            return response()->json(['barerror'=>'Please add products in product table.']);
        }else{

            $checkbox = ($request->taxInclude === 'on')?true:false;

            Quotation::insert([
                "owner_id" => Auth::user()->id,
                "customer_id" => $request->customerName,
                "customer_name" => $request->qCustomer_id,
                "expiration" => $request->expiration,
                "customer_address" => $request->customerAddress,
                "payment_terms" => $request->paymentTerms,
                "products_details" => $allProductDetails,
                "tax_inclusive" => $checkbox,
                "untaxted_amount" => $request->untaxtedAmount,
                "GST" => $request->gst,
                "sub_total" => $request->quotationTotal,
                "created_at" => now()
            ]);

            return response()->json(["success" => "Quotation generated successfully."]);
        }
    }

    // list all quotations num for detials in invoice in sales tab
    public function getAllQuotations(){
        return response()->json(Quotation::all());
    }
    public function getAllinvoiceQuotations(){
        $id = "Yes";
        return response()->json(Quotation::all()->where("invoicestatus","!=", $id));
    }
    // fetch all quotations
    public function getQuotations(){
        return response()->json(DB::table('quotations')->paginate(5));
    }

    // fetch a single quotation
    public function getQuotation(){
        $id = $_GET['id'];
        return response()->json(Quotation::all()->where("id", $id));
    }

    // update quotation
    public function updateQuotation(Request $request){
        $allProductDetails = $_REQUEST['allProductDetails'];

        $validator = Validator::make($request->all(),[
            "customerName" => "required",
            "expiration"  => "required",
            "customerAddress" => "required",
            "paymentTerms"  => "required",
            "untaxtedAmount"  => "required",
            // "gst"  => "required",
            "quotationTotal" => "required",
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
        }else if(sizeof(json_decode($allProductDetails)) === 0){
            return response()->json(['barerror'=>'Please add products in product table.']);
        }else{

            $checkbox = ($request->taxInclude === 'on')?true:false;
            
            Quotation::where('id', $request->quotationId)
            ->update([
                "customer_id" => $request->customerName,
                "customer_name" => $request->qCustomer_id,
                "expiration" => $request->expiration,
                "customer_address" => $request->customerAddress,
                "payment_terms" => $request->paymentTerms,
                "products_details" => $allProductDetails,
                "tax_inclusive" => $checkbox,
                "untaxted_amount" => $request->untaxtedAmount,
                "GST" => $request->gst,
                "sub_total" => $request->quotationTotal,
                "updated_at" => now()
            ]);

            return response()->json(["success" => "Quotation updated successfully."]);
        }        
    }

    // remove quotation
    public function removeQuotation(){
        $id = $_GET['id'];
        Quotation::where('id', $id)->delete();
        return response()->json(['success'=>"Quotation removed successfully."]);
    }



    // Fetch Special Price Filtered Products Detials
    public function getFilterProducts()
    {
        $customer_id = $_GET['id'];
        // $all_products = product::all()->groupBy(['product_name', 'owner_id'])->toArray();
        $all_products = product::all()->unique(['product_name'])->toArray();
        // 
        // $all_products = DB::table('products')->select('product_name')->distinct()->get();

        $customer_pro = Customer::all()->where('id', $customer_id)->value('specialPrice');

        // return $all_products;

        $arr1Id = [];

        $arr2Id = [];

        $finalProDetials = [];

        if(empty(json_decode($customer_pro))){

                // $finalProDetials = $all_products;
                foreach($all_products as $k1 => $v1){
                    array_push($finalProDetials, [
                        "id" => $v1['id'],
                        "product_name" => $v1['product_name'],
                        "sku_code" => $v1['sku_code'],
                        "batch_code" => $v1['batch_code'],
                        "category" => $v1['product_category'],
                        "varient" => $v1['product_varient'],
                        "unit_price" => $v1['min_sale_price']
                    ]);
                }
        }else{

                foreach($all_products as $k => $v){
                    array_push($arr1Id, $v['product_name']);
                }

                // return $arr1Id;

                foreach(json_decode($customer_pro) as $k => $v){
                    array_push($arr2Id, $v->product_name);
                }

                // return $arr2Id;
                
                $unmatch_pro = array_diff($arr1Id, $arr2Id);

                // return $unmatch_pro;

                // products which not listed in special price list
                foreach($unmatch_pro as $k => $v){
                    foreach($all_products as $k1 => $v1){
                        if($v === $v1['product_name']){
                            array_push($finalProDetials, [
                                "id" => $v1['id'],
                                "product_name" => $v1['product_name'],
                                "category" => $v1['product_category'],
                                "varient" => $v1['product_varient'],
                                "sku_code" => $v1['sku_code'],
                                "batch_code" => $v1['batch_code'],
                                "sku_code" => $v1['sku_code'],
                                "unit_price" => $v1['min_sale_price']
                            ]);
                        }
                    }    
                }

                // products which listed in special price list
                foreach(json_decode($customer_pro) as $k => $v){
                    array_push($finalProDetials, [
                        "id" => (int)$v->id,
                        "product_name" => $v->product_name,
                        "category" => $v->category,
                        "varient" => $v->product_varient,
                        "sku_code" => $v->sku_code,
                        "batch_code" => $v->batch_code,
                        "unit_price" => $v->specialPrice
                    ]);
                }
        }

        return response()->json($finalProDetials);
    }

    public function fetchProductsDetialsInfo()
    {

        $customer_id = $_GET['id'];
        // $product = $_GET['product'];
        // $varient = $_GET['varient'];
        $all_products = product::all()->toArray();
        // $all_products = product::all()->unique(['product_name'])->toArray();
        // 
        // $all_products = DB::table('products')->select('product_name', 'product_varient')->distinct()->get();

        $customer_pro = Customer::all()->where('id', $customer_id)->value('specialPrice');

        // return $all_products;

        $arr1Id = [];

        $arr2Id = [];

        $unmatch_pro = [];

        // $finalProDetials = [];

        if(empty(json_decode($customer_pro))){

                // $finalProDetials = $all_products;
                foreach($all_products as $k1 => $v1){
                    array_push($unmatch_pro, [
                        "id" => $v1['id'],
                        "product_name" => $v1['product_name'],
                        "sku_code" => $v1['sku_code'],
                        "batch_code" => $v1['batch_code'],
                        "category" => $v1['product_category'],
                        "varient" => $v1['product_varient'],
                        "unit_price" => $v1['min_sale_price'],
                    ]);
                }
        }else{

                foreach($all_products as $k => $v){
                    $obj = (object)[
                        "id" => $v['id'],
                        "product_name" => $v['product_name'],
                        "product_varient" => $v['product_varient'],
                        "unit_price" => $v['min_sale_price'],
                        "category" => $v['product_category'],
                        "sku_code" => $v['sku_code'],
                        'batch_code' => $v['batch_code']
                    ];
                    array_push($arr1Id, $obj);
                }

                // return $arr1Id;

                foreach(json_decode($customer_pro) as $k => $v){
                    array_push($arr2Id, (object)[
                        "id" => $v -> id,
                        "product_name" => $v -> product_name,
                        "product_varient" => $v -> product_varient,
                        "unit_price" => $v -> specialPrice,
                        "sku_code" => $v -> sku_code,
                        "category" => $v -> category,
                        "batch_code" => $v -> batch_code,
                    ]);
                }

                // return $arr2Id;

                foreach($arr1Id as $k => $v){
                    foreach($arr2Id as $key => $value){
                        // return $v -> product_varient;
                        if($v->product_name != $value->product_name || $v -> product_varient != $value -> product_varient){
                            array_push($unmatch_pro, (object)[
                                "id" => $v->id,
                                "product_name" => $v->product_name,
                                "category" => $v->category,
                                "varient" => $v->product_varient,
                                "sku_code" => $v->sku_code,
                                "batch_code" => $v->batch_code,
                                "unit_price" => $v->unit_price
                            ]);
                        }
                    }
                }

                // return $arr2Id;
                
                // $unmatch_pro = array_diff_assoc((array)$arr2Id, (array)$arr1Id);

                // return $unmatch_pro;

                // products which not listed in special price list
                // foreach($unmatch_pro as $k => $v){
                //     foreach($all_products as $k1 => $v1){
                //         if($v === $v1['product_name']){
                //             array_push($finalProDetials, [
                //                 "id" => $v1['id'],
                //                 "product_name" => $v1['product_name'],
                //                 "category" => $v1['product_category'],
                //                 "varient" => $v1['product_varient'],
                //                 "sku_code" => $v1['sku_code'],
                //                 "batch_code" => $v1['batch_code'],
                //                 "sku_code" => $v1['sku_code'],
                //                 "unit_price" => $v1['min_sale_price']
                //             ]);
                //         }
                //     }    
                // }

                // products which listed in special price list
                foreach(json_decode($customer_pro) as $k => $v){
                    array_push($unmatch_pro, (object)[
                        // $k => $v
                        // "id" => (int)$v->id,
                        "product_name" => $v->product_name,
                        "category" => $v->category,
                        "varient" => $v->product_varient,
                        "sku_code" => $v->sku_code,
                        "batch_code" => $v->batch_code,
                        "unit_price" => $v->specialPrice
                    ]);
                }
        }

        return response()->json($unmatch_pro);

        // return response()->json(product::all()->where('product_name', $_GET['product'])->where('product_varient', $_GET['varient'])->pluck('sku_code'));
        // return response()->json(DB::table('products')->where('product_name', $_GET['product'])->where('product_varient', $_GET['varient'])->select('sku_code', 'batch_code', 'product_category')->get());
    }

    // sales quotation filter
    public function salesQuotationFilter()
    {
        return response()->json(DB::table('quotations')->where('customer_name', 'LIKE', '%'.$_GET['user'].'%')->paginate(5));
    }



    // ***************************************************************************************************//
   //                                           Invoice SECTION                                          //
  //****************************************************************************************************//    

    //generate pdf
    public function generatePDF($id)
    {
        $data = SalesInvoice::where('id', $id)->get();
        $products = SalesInvoice::where('id', $id)->value('products');
        $pdf = PDF::loadView('superadmin.sales.invoice-modal.invoice-pdf', ['data'=>$data, 'products'=>$products]);
            
        return $pdf->download('invoice.pdf');
    }

    // quotaion sales
    public function generateQuotationPDF($id)
    {
        $data = Quotation::where('id', $id)->get();
        $products = Quotation::where('id', $id)->value('products_details');
        $pdf = PDF::loadView('superadmin.sales.invoice-modal.quotation-pdf', ['data'=>$data, 'products'=>$products]);
            
        return $pdf->download('invoice.pdf');
    }

    //
    public function index(){
        return view('superadmin.sales');
    }
    // fetch customer list
    public function getCustomer(){
        $list = User::all();
        return response()->json($list);
    }

    // fetch products details
    public function getProducts(){
        $products = product::all();
        return response()->json($products);
    }

    // fetch a single product
    public function getProduct(){
        $proId = $_GET["pro"];
        $data = product::all()->where("id", $proId);
        return response()->json($data);
    }

        // fetch a single product by matching name
        public function getProductInfo(){
            $proName = $_GET["pro"];
            $data = product::all()->where("product_name", $proName);
            return response()->json($data);
        }

    // store invoice
    public function storeInvoice(Request $request){
        // return $request->post();
        $allProductDetails = $_REQUEST['allProductDetails'];
        
        $validator = Validator::make($request->all(),[
            "customerName" => "required",
            "invoiceDate" => "required",
            "refNextQColumn" => "required",
            "paymentReference" => "required",
            "allProductDetails" => "required",
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
        }else if($request->quotationNumber == "" && $request->refNextQColumn == ""){
            return response()->json(['barerror'=>'Please enter reference number or YYMMXXXX(2040001) field. <br> fill any one of the field.']);
        }else if($request->dueDate === null && $request->selectTerms === ""){
            return response()->json(['barerror'=>'Please inter <b><u>Due date</u></b> or select <b><u>select terms</u></b> field. <br> fill any one of the field.']);
        }else if(sizeof(json_decode($allProductDetails)) === 0){
            return response()->json(['barerror'=>'Please add products in product table.']);
        }else{

            $uniqueTime = str_replace(' ', '', hexdec(date('Y-m-d H:i:s')));
            $invoice_no = rand().$uniqueTime;

            $checkbox = ($request->taxInclude === 'on')?true:false;

            SalesInvoice::insert([
                //"invoice_no" => "elrica".$invoice_no,
                "invoice_no" => $request->refNextQColumn,
                "quotation_no" => $request->quotationNumber,
                "Qref_no" => $request->refNextQColumn,
                "customer_id" => $request->customerName,
                "customer_name" => $request->invoiceCustomer_id,
                "invoice_date" => $request->invoiceDate,
                "payment_ref" => $request->paymentReference,
                "due_date" => $request->dueDate,
                "status" => $request->selectTerms,
                "tax_inclusive" => $checkbox,
                "products" => $allProductDetails,
                "untaxed_amount" => $request->untaxtedAmountInvoice1,
                "GST" => $request->GST1,
                "total" =>$request->invoiceTotal1,
                "created_at" => now()
            ]);
            Quotation::where('id', $request->quotationNumber)
            ->update([
                "invoicestatus" => "Yes",
                "display" => "none"
            ]);
            $output =   json_decode($allProductDetails, true);
        
                foreach($output as $value){
                    $inStock = Stock::where('product_id', $value['product_Id'])->value('quantity');
                    $minus = $inStock - $value['quantity'];

                    Stock::where('product_id', $value['product_Id'])
                            ->update([
                                "quantity" => $minus,
                                "updated_at" => now(),
                            ]);
                }

            return response()->json(["success" => "Invoice generated successfully."]);
        }
    }

    // all invoice detials to view in payemet section
    public function getAllInvoice()
    {
        return response()->json(SalesInvoice::all());
    }

    // fetch unique customer for payment forms
    public function getAllInvoiceForPayment()
    {
        $data = DB::table('sales_invoices')->select('customer_id', 'customer_name')->distinct()->get();

        return response()->json($data);
    }

    // get all invoice detials
    public function getInvoice(){
        return response()->json(DB::table('sales_invoices')->paginate(5));
    }

    // fetch single invoice detials
    public function getSingleInvoice(){
        $id = $_GET['id'];
        $data = SalesInvoice::all()->where('id', $id);
        return response()->json($data);
    }

        // fetch all invoices detials for payments form
        public function getAllInvoicesforPayment(){
            $id = $_GET['id'];
            $data = SalesInvoice::all()->where('customer_id', $id);
            return response()->json($data);
        }

    // Update Invoice
    public function updateInvoice(Request $request){

        $allProductDetails = $_REQUEST['allProductDetails'];
        
        $validator = Validator::make($request->all(),[
            "customerName" => "required",
            "invoiceDate" => "required",
            "paymentReference" => "required",
            "allProductDetails" => "required",
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
        }else if($request->quotationNumber == "" && $request->refNextQColumn == ""){
            return response()->json(['barerror'=>'Please enter reference number or YYMMXXXX(2040001) field. <br> fill any one of the field.']);
        }else if($request->dueDate === null && $request->selectTerms === ""){
            return response()->json(['barerror'=>'Please inter <b><u>Due date</u></b> or select <b><u>select terms</u></b> field. <br> fill any one of the field.']);
        }else if(sizeof(json_decode($allProductDetails)) === 0){
            return response()->json(['barerror'=>'Please add products in product table.']);
        }else{

            $checkbox = ($request->taxInclude === 'on')?true:false;

            SalesInvoice::where('id', $request->invoiceId)
            ->update([
                "quotation_no" => $request->quotationNumber,
                "Qref_no" => $request->refNextQColumn,
                "customer_id" => $request->invoiceCustomer_id,
                "customer_name" => $request->customerName,
                "invoice_date" => $request->invoiceDate,
                "payment_ref" => $request->paymentReference,
                "due_date" => $request->dueDate,
                "status" => $request->selectTerms,
                "tax_inclusive" => $checkbox,
                "products" => $allProductDetails,
                "untaxed_amount" => $request->untaxtedAmountEInvoice1,
                "GST" => $request->GST1,
                "total" =>$request->invoiceETotal1,
                "updated_at" => now()
            ]);

            return response()->json(["success" => "Invoice updated successfully."]);
        }
    }

    // remove invoice
    public function removeInvoice(){
        $id = $_GET['id'];
        SalesInvoice::where('id', $id)->delete();
        return response()->json(["success" => "Invoice removed successfully."]);
    }

    // filter
    public function filterInvoice(){
        $status = $_GET['status'];
        return response()->json(SalesInvoice::all()->where('status', $status));
    }

    // filter invoice
    public function filterInvoiceName()
    {
        return response()->json(DB::table('sales_invoices')->where('customer_name', 'LIKE', '%'.$_GET['user'].'%')->paginate(5));
    }


    // ***************************************************************************************************//
   //                                           Payment SECTION                                          //
  //****************************************************************************************************//    

    // fetch all invoice numbers
    public function getInvoiceDetails(){
        $id = $_GET["pro"];
        $data = SalesInvoice::all()->where('invoice_no', $id);
        return response()->json($data);
    }

    // fetch all invoice numbers for dropdown
    public function getInvoiceNoDetails(){
        $data = SalesInvoice::all();
        return response()->json($data);
    }

    // add payment detials
    public function addPayment(Request $request){
        $validator = Validator::make($request->all(),[
            "invoiceNo" => "required",
            "paymentType" => "required",
            "paymentDate" => "required",
            "paymentStatus" => "required"
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
        }else if($request->invoiceNo === "default"){
            return response()->json(['barerror'=>'Please select the valid invoice number from field.']);
        }else if($request->paymentType === "default"){
            return response()->json(['barerror'=>'Please select the valid payment type from field.']);
        }else if($request->paymentDate === null){
            return response()->json(['barerror'=>'Please select the valid payment date from field.']);
        }else if($request->paymentStatus === "default"){
            return response()->json(['barerror'=>'Please select the valid payment status from field.']);
        }else{

            Payment::insert([
                "invoice_no" => $request->invoiceNo,
                "customer_id" => $request->customer_name,
                "customer_name" => $request->customer_id,
                "amount" => $request->amount,
                "partialamount" => $request->partialamount,
                "payment_type" => $request->paymentType,
                "payment_date" => $request->paymentDate,
                "invoice_date" => $request->invoicedaate,
                "payment_status" => $request->paymentStatus,
                "created_at" => now()
            ]);

            if($request->paymentStatus === 'paid'){
                SalesInvoice::where('invoice_no', $request->invoiceNo)
                ->update([
                    "payment_status" => "yes",
                    "display" => "none",
                    "updated_at" => now()
                ]);
            }

            return response()->json(["success" => "Payment added successfully."]);   
        }
    }
    
    // fetch all payments details list
    public function getPayments(){
        // $payment = Payment::with('salesInvoice')->get();
        // $invoice = SalesInvoice::with('payment')->get();
        // $data = Payment::all();

        return response()->json(DB::table('payments')->paginate(5));
    }

    // fetch single payment detials
    public function getPaymentDetials(){
        $id = $_GET['id'];
        $data = Payment::all()->where('id', $id);
        return response()->json($data);
    }

    // edit payment details
    public function editPaymentDetails(Request $request){
        $validator = Validator::make($request->all(),[
            "invoiceNo" => "required",
            "paymentType" => "required",
            "paymentDate" => "required",
            "paymentStatus" => "required"
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
        }else if($request->invoiceNo === "default"){
            return response()->json(['barerror'=>'Please select the valid invoice number from field.']);
        }else if($request->paymentType === "default"){
            return response()->json(['barerror'=>'Please select the valid payment type from field.']);
        }else if($request->paymentDate === null){
            return response()->json(['barerror'=>'Please select the valid payment date from field.']);
        }else if($request->paymentStatus === "default"){
            return response()->json(['barerror'=>'Please select the valid payment status from field.']);
        }else{

            Payment::where("id", $request->id)
            ->update([
                "amount" => $request->amount,
                "partialamount" => $request->partialamount,
                "payment_type" => $request->paymentType,
                "payment_date" => $request->paymentDate,
                "invoice_date" => $request->invoicedaate,
                "payment_status" => $request->paymentStatus,
                "created_at" => now()
            ]);

            if($request->paymentStatus === 'paid'){
                SalesInvoice::where('invoice_no', $request->invoiceNo)
                ->update([
                    "payment_status" => "yes",
                    "display" => "none",
                    "updated_at" => now()
                ]);
            }

            return response()->json(["success" => "Details edited successfully."]);   
        }        
    }
    
    // remove payment details
    public function removePaymentDetials(){
        $id = $_GET['id'];
        Payment::where('id', $id)->delete();
        return response()->json(["success" => "Payment deleted successfully."]);
    }

    // filter payment by status
    public function filterPaymentDetials(){
        $status = $_GET['status'];
        $data = Payment::with('salesInvoice')->where('payment_status', $status)->get();
        return response()->json($data);
    }

    // payment filter by customer name
    public function getPaymentsFilter()
    {
        return response()->json(DB::table('payments')->where('customer_name', 'LIKE', '%'.$_GET['user'].'%')->paginate(5));
    }


    // ***************************************************************************************************//
   //                                           Customer SECTION                                         //
  //****************************************************************************************************//    

    //   Main Customer Tab
    public function customerManagement(){
        return view('superadmin.customerManagement');
    }

    // Add Customer
    public function addCustomer(Request $request){
        $validator = Validator::make($request->all(),[
            "customerName" => "required",
            "address" => "required",
            "emailId" => "required",
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
        }else if($request->gst === "default"){
            return response()->json(['barerror'=>'Please select the valid gst from field.']);
        }else{

            Customer::insert([
                "customer_name" => $request->customerName,
                "address" => $request->address,
                "email_id" => $request->emailId,
                "phone_number" => $request->phoneNo,
                "mobile_number" => $request->mobileNo,
                "gst" => $request->gst,
                "created_at" => now()
            ]);

            return response()->json(["success" => "Customer added successfully."]);   
        }        
    }
    
    // fetch all customer details
    public function customersList(){
        $data = Customer::all();
        return response()->json($data);
    }

    // fetch all customer details
    public function customersListPaginate(){
        // $data = Customer::all();
        return response()->json(DB::table('customers')->paginate(5));
    }

    // fetch single customer details
    public function getCustomerDetails(){
        $id = $_GET['id'];
        return response()->json(Customer::all()->where('id', $id));
    }

    // fetch single customer salesInvoice details
    public function getCustomerSalesInvoiceDetails(){
        $id = $_GET['id'];
        return response()->json(SalesInvoice::all()->where('customer_id', $id));
    }

    // edit customer detials
    public function editCustomerDetails(Request $request){
        $validator = Validator::make($request->all(),[
            "customerName" => "required",
            "address" => "required",
            "emailId" => "required",
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
        }else if($request->gst === "default"){
            return response()->json(['barerror'=>'Please select the valid gst from field.']);
        }else{

            Customer::where('id', $request->id)
            ->update([
                "customer_name" => $request->customerName,
                "address" => $request->address,
                "email_id" => $request->emailId,
                "phone_number" => $request->phoneNo,
                "mobile_number" => $request->mobileNo,
                "gst" => $request->gst,
                "updated_at" => now()
            ]);

            return response()->json(["success" => "Details updated successfully."]);
        } 
    }

    // remove customer
    public function removeCustomer(){
        $id = $_GET['id'];
        Customer::where('id', $id)->delete();
        return response()->json(["success" => "Details deleted successfully."]);
    }

    // update special price to customer tab
    public function updateCustomerDetails(Request $request)
    {

        $alladdSpecialPriceArray = $request->alladdSpecialPriceArray;

        Customer::where('id', $request->customer_id)
        ->update([
            "specialPrice" => $alladdSpecialPriceArray,
            "updated_at" => now()
        ]);


        // if(sizeof(json_decode($alladdSpecialPriceArray)) === 0){
        //     return response()->json(['barerror'=>'Please add products in product table.']);
        // }else{
            
        //     Customer::where('id', $request->customer_id)
        //         ->update([
        //             "specialPrice" => $request->alladdSpecialPriceArray,
        //             "updated_at" => now(),
        //         ]);

            return response()->json(["special_price_success" => "Special Price Updated Successfully."]);
        // }
    }

    public function customerFilter()
    {
        return response()->json(DB::table('customers')->where('customer_name', 'LIKE', '%'.$_GET['user'].'%')->paginate(5));
    }

}
