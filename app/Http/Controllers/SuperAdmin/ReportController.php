<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\SalesInvoice;
use App\Models\Stock;
use Illuminate\Http\Request;

class ReportController extends Controller
{
     // Route for report tab
     public function index(){
        return view('superadmin.reports');
    }

    public function getTotalProductsValues(){
        $id = $_GET['id'];

        // product table data - start
        $prototal = 0;
        $productDetials = Stock::all()->where('product_id', $id);

        foreach($productDetials as $value){
            $prototal += ($value['min_sale_price'] * $value['quantity']);
        }
        // end

        // sales invoice table data - start
        $saletotal = 0;
        $saleDetials = SalesInvoice::all();

        foreach($saleDetials as $value){
            foreach(json_decode($value['products']) as $v){
                if($v->product_Id === $id){
                    $saletotal += $v->subTotal;
                }
            }
        }
        // end

        // purchase invoice table data -start
        $purchasetotal = 0;
        $purchaseDetials = PurchaseOrder::all();

        foreach($purchaseDetials as $value){
            foreach(json_decode($value['products']) as $v){
                if($v->product_Id === $id){
                    $purchasetotal += $v->subTotal;
                }
            }
        }
        // end

        $arr = [];
        array_push($arr, $prototal);
        array_push($arr, $saletotal);
        array_push($arr, $purchasetotal);
        return $arr;
        
    }

    // fetch data for sales report
    public function getTotalProductsDetials(){

        $id = $_GET['id'];

        // sales invoice table data - start
        $saletotal = 0;
        $saleDetials = SalesInvoice::all();

        foreach($saleDetials as $value){
            foreach(json_decode($value['products']) as $v){
                if($v->product_Id === $id){
                    $saletotal += $v->subTotal;
                }
            }
        }
        // end

        // $arr = [];
        // array_push($arr, $prototal);
        // array_push($arr, $saletotal);
        // array_push($arr, $purchasetotal);
        // return $arr;
    }

}
