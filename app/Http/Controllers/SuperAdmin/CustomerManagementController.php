<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\SalesInvoice;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CustomerManagementController extends Controller
{
    // ***************************************************************************************************//
    //                                           Customer View                                        //
    //****************************************************************************************************//    
    //   create new page  for client view
    public function viewClient()
    {
        return view('superadmin.customer-modal.client');
    }

    // ***************************************************************************************************//
    //                                           Customer Management                                        //
    //****************************************************************************************************//    

    //   Main Customer Tab
    public function customerManagement()
    {
        return view('superadmin.customerManagement');
    }

    //    Customer Management view pages redirect Tab
    public function customerManagementView()
    {
        return view('superadmin.customerManagementView');
    }

    // Add Customer
    public function CreatCustomer(Request $request)
    {
        $uniqueTime = str_replace(' ', '', hexdec(date('Y-m-d H:i:s')));

        $validator = Validator::make($request->all(), [
            "customername" => "required",
            "customermobile" => "required|min:7",
            "customeremail" => "required",
            "customeraddress" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()->toArray()]);
        } else {
            if (Customer::all()->where('customer_email', $request->customeremail)->count() > 0) {

                return response()->json(['barerror' => 'Email is alrealy registered.']);
            } else {

                Customer::insert([
                    "owner_id" => Auth::user()->id,
                    "customer_id" => $request->$uniqueTime . rand(),
                    "customer_name" => $request->customername,
                    "customer_status" => $request->customerstatus,
                    "customer_email" => $request->customeremail,
                    "customer_mobile" => $request->customermobile,
                    "customer_address" => $request->customeraddress,
                    "customer_postal" => $request->customerPostalname,
                    "unit_number" => $request->unitNumber,
                    "created_at" => now()
                ]);

                return response()->json(["success" => "Customer Added Successfully."]);
            }
        }
    }

    // fetch all customer details for table
    public function ClientsList()
    {

        return response()->json(DB::table('customers')->paginate(5));
    }

    // fetch Individual  customer details (edit,view)
    public function FatchClients()
    {
        $id = $_GET['customer_id'];
        return response()->json(Customer::all()->where("customer_id", $id));
    }

    // filter customer name
    public function filterCustomerName()
    {
        return response()->json(DB::table('customers')->where('customer_name', 'LIKE', '%' . $_GET['user'] . '%')->paginate(5));
    }

    // fetch single business details
    public function getBusinessDetails()
    {
        $id = $_GET['id'];
        return response()->json(Customer::all()->where('id', $id));
    }

    // fetch single customer salesInvoice details
    public function getBusinessInvoiceDetails()
    {
        $id = $_GET['id'];
        return response()->json(SalesInvoice::all()->where('customer_id', $id));
    }

    // edit customer detials
    public function updateClients(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "customernameedit" => "required",
            "customeremailedit" => "required",
            "customermobileedit" => "required",
            "customeraddressedit" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()->toArray()]);
        } else {

            Customer::where('id', $request->oid)
                ->update([
                    "customer_name" => $request->customernameedit,
                    "customer_status" => $request->customerstatusedit,
                    "customer_email" => $request->customeremailedit,
                    "customer_mobile" => $request->customermobileedit,
                    "customer_address" => $request->customeraddressedit,
                    "customer_postal" => $request->customerpostalcodeedit,
                    "unit_number" => $request->unitNumberEdit,
                    "updated_at" => now()
                ]);

            return response()->json(["success" => "Details Updated Successfully."]);
        }
    }

    // remove customer
    public function removecustomer()
    {
        try {
            $id = $_GET['id'];
            Customer::where('id', $id)->delete();
            return response()->json(['success' => 'Clients Delete Succesfully']);
        } catch (Exception $e) {
            return response()->json(['success' => 'Database query error..']);
        }
    }
}
