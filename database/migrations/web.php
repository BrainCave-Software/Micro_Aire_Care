<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Http\Controllers\SuperAdmin\UserController;
use App\Http\Controllers\SuperAdmin\InventoryController;
use App\Http\Controllers\SuperAdmin\purchaseController;
use App\Http\Controllers\SuperAdmin\SalesController;
use App\Http\Controllers\User\FrontendController;
use App\Http\Controllers\SuperAdmin\FixedAssetContoller;
use App\Http\Controllers\SuperAdmin\ReportController;
use App\Http\Middleware\CheckInventory;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use App\Http\Controllers\SuperAdmin\BulkProductUpload;
use App\Http\Controllers\SuperAdmin\BulkStock;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\product;
use App\Http\Controllers\LanguageController;

# Import Controller Class
use App\Http\Controllers\SuperAdmin\PDFController;
use App\Models\PurchaseOrder;
use Stichoza\GoogleTranslate\GoogleTranslate;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome')->name('Home');
// });

Route::get('/',[FrontendController::class,'index'])->name('Home');
// Admin
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // Route::get('/', [AdminController::class, 'dashboard'])->name('Admin-Dashboard');

    # Add Route for PDF
    //Route::get('generate-pdf', [PDFController::class, 'generatePDF']);

    // Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);
    // Route::get('lang/{lang}', [LanguageController::class, 'switchLang'])->name('SA-Language');


    // Route::get('/', function(){
    //     $tr = new GoogleTranslate('hi');
    //     // return $tr->translate('/');
    //     $tr->setUrl(url()->current());
    //     return view('superadmin.index');
    // });

    //  ===============================================================================================
    // Dashboard Section
    //===============================================================================================
    Route::get('/', [SuperAdminController::class, 'dashboard'])->name('SA-Dashboard');
        // Total No of Products
    Route::get('/no-of-products', [SuperAdminController::class, 'getNoOfProducts'])->name('SA-GetNoOfProducts');
        // Total Sale
    Route::get('/total-sale', [SuperAdminController::class, 'totalSale'])->name('SA-TotalSale');
        // Total Purchase
    Route::get('/total-purchase', [SuperAdminController::class, 'totalPurchase'])->name('SA-TotalPurchase');
        // Total Orders
    Route::get('/total-orders', [SuperAdminController::class, 'totalOrders'])->name('SA-TotalOrders');        

    //===============================================================================================
    // Update Profile Section
    //===============================================================================================    
        // view profile info
    Route::get('/profile', [SuperAdminController::class, 'profile'])->name('SA-Profile');    
        // file for update profile info
    Route::get('/profile-path', [SuperAdminController::class, 'updateProfileFile'])->name('SA-UpdateProfilePath');    
        // update profile
    Route::post('/update-profile', [SuperAdminController::class, 'updateProfile'])->name('SA-UpdateProfile');
        // Fetch updated data
    Route::get('/fetch-profile-detials', [SuperAdminController::class, 'getProfile'])->name('SA-GetProfile');
        // update password
    Route::post('/update-password/profile', [SuperAdminController::class, 'updatePassword'])->name('SA-UpdatePassword');        

    //===============================================================================================
    // User Management Section
    //===============================================================================================    
        // user management tab
    Route::get('/user-management', [UserController::class, 'index'])->name('SA-ListUser');
        // show all detials in table format
    Route::get('/fetch-users-details', [UserController::class, 'getUserDetails'])->name('SA-FetchUsersDetials');
        // insert user detials in db
    Route::post('/add-user/user', [UserController::class, 'store'])->name('SA-AddNewUser');
        // fetch data from edit data
    Route::get('/edit-user', [UserController::class, 'edit'])->name('SA-EditUser');
        // update the existing data in db
    Route::post('/update-user', [UserController::class, 'update'])->name('SA-UpdateUser');
        // remvoe user
    Route::get('/delete-user', [UserController::class, 'destroy'])->name('SA-DeleteUser');
        // view the indiviusal details in modal
    Route::get('/view-user', [UserController::class, 'show'])->name('SA-ViewUser');
        // list supplier
    Route::get('/supplier-name', [UserController::class, 'supplier'])->name('SA-ListSupplier');

        // Inventory
    Route::get('/inventory', [InventoryController::class, 'inventory'])->name('SA-Inventory')->middleware('checkinventory');

    //===============================================================================================
    // Product Section
    //===============================================================================================

        // add product
    Route::post('/product', [InventoryController::class, 'addProduct'])->name('SA-AddProduct');
        // fetch all products
    Route::get('/get-products', [InventoryController::class, 'getProducts'])->name('SA-GetProducts');
        // fetch a single product
    Route::get('/get-product', [InventoryController::class, 'getProductSection'])->name('SA-GetProductSection');
        // Edit Product
    Route::post('/edit-product', [InventoryController::class, 'editProduct'])->name('SA-EditProduct');
        // Delete Product
    Route::get('/remove-product', [InventoryController::class, 'removeProduct'])->name('SA-RemoveProduct');
        // View Product
    Route::get('/view-product', [InventoryController::class, 'viewProduct'])->name('SA-ViewProduct');
        // fetch all cateogory
    Route::get('/list-categories', [InventoryController::class, 'listCategories'])->name('SA-ListCategories');
        // fetch varients to select category
    Route::get('/list-varients', [InventoryController::class, 'listVarients'])->name('SA-ListVarients');
        // fetch all varients
    Route::get('/list-varients/unique', [InventoryController::class, 'listUniqueVarients'])->name('SA-ListUniqueVarients');
        // filter product by seletcing category & varients
    Route::get('/list-filter/products', [InventoryController::class, 'listProductsFilter'])->name('SA-ListProductsFilter');
        // filter products by typing products name
    Route::get('/list-filter-name/products', [InventoryController::class, 'listProNameFilter'])->name('SA-ListProNameFilter');
        // list all products detials for form
    Route::get('/get-all-products', [InventoryController::class, 'getAllProducts'])->name('SA-GetAllProducts');
        // 
    Route::get('/get-name-products', [InventoryController::class, 'getNameProducts'])->name('SA-GetNameProducts');
        // Bulk Upload Product
    Route::post('/bulk-uploads/product', [BulkProductUpload::class, 'bulkProductUpload'])->name('SA-GetBulkProductUpload');
        // download product excel file
    Route::get('/products-excel', [BulkProductUpload::class, 'productsExcel'])->name('SA-ProductsExcelFile');
        // store bluck stock
    Route::post('/bulk-uploads/stock', [BulkStock::class, 'bulkStockUpload'])->name('SA-GetBulkStockUpload');
        // download stock excel file
    Route::get('/stock-excel', [BulkStock::class, 'stocksExcel'])->name('SA-StocksExcelFile');

    //===============================================================================================
    // Category Section
    //===============================================================================================

        // Add Category
    Route::post('/add-category', [InventoryController::class, 'addCategory'])->name('SA-AddCategory');
        // fetch all cateogory
    Route::get('/get-categories', [InventoryController::class, 'getCategories'])->name('SA-GetCategories');
        // fetch a single category
    Route::get('/get-category', [InventoryController::class, 'getCategory'])->name('SA-GetCategory');
        // Edit Category
    Route::post('/edit-category', [InventoryController::class, 'editCategory'])->name('SA-EditCategory');
        // Delete Category
    Route::get('/remove-category', [InventoryController::class, 'removeCategory'])->name('SA-RemoveCategory');
        // View Category
    Route::get('/view-category', [InventoryController::class, 'viewCategory'])->name('SA-ViewCategory');        
        // add stock
    Route::post('/add-stock', [InventoryController::class, 'addStock'])->name('SA-AddStock');
        // category filter
    Route::get('/category/filter', [InventoryController::class, 'searchCategory'])->name('SA-SearchCategory');        


    //===============================================================================================
    // Return and Exchange Section
    //===============================================================================================

        // Add Product
    Route::post('/add-product', [InventoryController::class, 'addREProduct'])->name('SA-AddREProduct');
        // fetch all Products
    Route::get('/fetch-products', [InventoryController::class, 'getREProducts'])->name('SA-GetREProducts');
        // fetch single Product
    Route::get('/return-exchange/fetch-product', [InventoryController::class, 'fetchREProducts'])->name('SA-FetchREProducts');
        // edit Product
    Route::post('/return-exchange/edit-product', [InventoryController::class, 'editREProducts'])->name('SA-EditREProducts');    
        // remove Product
    Route::get('/return-exchange/remove-product', [InventoryController::class, 'removeREProducts'])->name('SA-RemoveREProducts');
        // view Product
    Route::get('/return-exchange/view-product', [InventoryController::class, 'viewREProducts'])->name('SA-ViewREProducts');    
        // filter status return & exchange
    Route::get('/return-exchange/filter', [InventoryController::class, 'viewREFilter'])->name('SA-ViewREFilter');
        // filter by adding product value
    Route::get('/return-exchange/filter-value', [InventoryController::class, 'inputREFilter'])->name('SA-InputREFilter');        

    //===============================================================================================
    // Stock Tracking Section
    //===============================================================================================
        // fetch all products detials in stock tracking tab
    Route::get('/stock-tracking-details', [InventoryController::class, 'fetchStockTrackingDetails'])->name('SA-FetchStockTrackingDetails');
        // 
    Route::get('/stock-tracking-products', [InventoryController::class, 'fetchStockProductsDetails'])->name('SA-FetchStockProductsDetails');
        // Stock Tracking Filter Data Search by verdor / customer name
    Route::get('/stock-tracking-products/filter', [InventoryController::class, 'fetchStockProductsDetailsFilter'])->name('SA-FetchStockProductsDetailsFilter');


    //===============================================================================================
    // Stock Againg Section
    //===============================================================================================
        // get stock aging details
    Route::get('/stok-aging-details/get-details', [InventoryController::class, 'getStockDetails'])->name('SA-StockDetails');        
        // View single stock product detials
    Route::get('/stok-aging-details/get-single-details', [InventoryController::class, 'getSingleStockDetails'])->name('SA-GetStockDetails');
        // Update Stock detials
    Route::post('/stok-aging-details/update-single-details', [InventoryController::class, 'updateSingleStockDetails'])->name('SA-UpdateStockDetails');        
        // remove single stock detials
    Route::get('/stok-aging-details/remove-single-details', [InventoryController::class, 'removeSingleStockDetails'])->name('SA-RemoveStockDetails');
        // filter
    Route::get('/stok-aging-details/filter-single-details', [InventoryController::class, 'filterSingleStockDetails'])->name('SA-FilterStockDetails');       



    //===============================================================================================
    // Warehouse Section
    //===============================================================================================
        // Add Warehouse
    Route::post('/add-warehouse', [InventoryController::class, 'addWarehouse'])->name('SA-AddWarehouse');
        // Fetch all warehouse detials
    Route::get('/add-warehouse/list-detials', [InventoryController::class, 'getWarehouseDetails'])->name('SA-GetWarehouseDetails');    
        // Fetch single warehouse detials
    Route::get('/add-warehouse/warehouse-detial', [InventoryController::class, 'singleWarehouseDetails'])->name('SA-singleWarehouseDetails');
        // Update warehoue detials
    Route::post('/add-warehouse/update-warehouse-detial', [InventoryController::class, 'updateWarehouseDetails'])->name('SA-UpdateWarehouseDetails');
        // Delete single warehouse detials
    Route::get('/add-warehouse/remove-warehouse-detial', [InventoryController::class, 'removeWarehouseDetails'])->name('SA-RemoveWarehouseDetails');        
        // fetch warehouse detials for forms
    Route::get('/add-warehouse/all-list-detials', [InventoryController::class, 'getAllWarehouseDetails'])->name('SA-GetAllWarehouseDetails');            
        // get warehouse list name using id
    Route::get('/warehouse/name-list-detials', [InventoryController::class, 'getlistWarehouseNameDetails'])->name('SA-GetListWarehouseNameDetails');            
        // fetch all rack detials
    Route::get('/warehouse/rack-info', [InventoryController::class, 'rackInfo'])->name('SA-RackWarehouseInfo');
        // warehouse filter
    Route::get('/warehouse/filter', [InventoryController::class, 'warehouseFilter'])->name('SA-WarehouseFilter');
        // return goods warehouse
    Route::get('/return-goods-warehouse/list-detials', [InventoryController::class, 'getReturnGoodsWarehouseDetails'])->name('SA-GetReturnGoodsWarehouseDetails');            

    //===============================================================================================
    // Sales Section
    //===============================================================================================
        // Sales Tab
    Route::get('/sales', [SalesController::class, 'index'])->name('SA-SalesTab')->middleware('checksales');

     // store orders
     Route::post('/sales/orders', [SalesController::class, 'storeOrders'])->name('SA-StoreOrders');

    //===============================================================================================
    // Quotation Tab
    //===============================================================================================
        // create quotation
    Route::post('/sales/add-quotation', [SalesController::class, 'addQuotation'])->name('SA-AddQuotation');
        // fetch all quotation
    Route::get('/sales/list-quotations', [SalesController::class, 'getQuotations'])->name('SA-GetQuotations');
        // fetch a single quotation
    Route::get('/sales/list-quotation', [SalesController::class, 'getQuotation'])->name('SA-GetQuotation');        
        // remove a single quotation
    Route::get('/sales/remove-quotation', [SalesController::class, 'removeQuotation'])->name('SA-RemoveQuotation');            
        // update quotation
    Route::post('/sales/update-quotation', [SalesController::class, 'updateQuotation'])->name('SA-UpdateQuotation');    
        // list all quotations number for forms
    Route::get('/sales/all-list-quotations', [SalesController::class, 'getAllQuotations'])->name('SA-GetAllQuotations');
        // list all quotations number for invoice
    Route::get('/sales/all-list-quotationsinvoice', [SalesController::class, 'getAllinvoiceQuotations'])->name('SA-GetAllinvoiceQuotations');
        // list filter to special price products details & fetch filtered data
    Route::get('/sales/list-filterd-products', [SalesController::class, 'getFilterProducts'])->name('SA-GetFilteredProductsDetials');
        // get products price/special price and other detials by selecting product name
    // Route::get('/sales/list-filterd-products', [SalesController::class, 'getFilterProducts'])->name('SA-GetFilteredProductsDetials');
        // filter quotaion
    Route::get('/sales/quotation/filter', [SalesController::class, 'salesQuotationFilter'])->name('SA-SalesQuotationFilter');
        // get all product detials by matching product and varient detials
    Route::get('/sales/all-products-detials-filtered', [SalesController::class, 'fetchProductsDetialsInfo'])->name('SA-FetchProductsDetialsInfo');


    //===============================================================================================
    // Invoice Tab
    //===============================================================================================
    //     // Get Customer List
    Route::get('/sales/customer-list', [SalesController::class, 'getCustomer'])->name('SA-CustomerList');
        // Get Products details List
    Route::get('/sales/products-list', [SalesController::class, 'getProducts'])->name('SA-GetProductsSales');
        // fetch product
    Route::get('/sales/product', [SalesController::class, 'getProduct'])->name('SA-GetProduct');
        // fetch product info by name
    Route::get('/sales/product', [SalesController::class, 'getProductInfo'])->name('SA-GetProductInfo');
        // store invoice
    Route::post('/sales/invoice', [SalesController::class, 'storeInvoice'])->name('SA-StoreInvoice');
        // get invoice detials
    Route::get('/sales/invoice-list', [SalesController::class, 'getInvoice'])->name('SA-InvoiceList');
        // fetch single invoice
    Route::get('/sales/single-invoice', [SalesController::class, 'getSingleInvoice'])->name('SA-SingleInvoice');
        // Edit Invoice
    Route::post('/sales/update-invoice', [SalesController::class, 'updateInvoice'])->name('SA-UpdateInvoice');
        // remove invoice
    Route::get('/sales/remove-invoice', [SalesController::class, 'removeInvoice'])->name('SA-RemoveInvoice');
        // sales invoice filter
    Route::get('/sales/filter-invoice', [SalesController::class, 'filterInvoice'])->name('SA-FilterInvoice');      
        // fetch all invoice detials to view in payment section
    Route::get('/sales/all-invoice-list', [SalesController::class, 'getAllInvoice'])->name('SA-AllInvoiceList');
        // 
    Route::get('/sales/all-invoice-list-Payment', [SalesController::class, 'getAllInvoiceForPayment'])->name('SA-GetAllInvoiceForPayment');
        // fetch all invoices detials
    Route::get('/sales/all-invoices-for-payments', [SalesController::class, 'getAllInvoicesforPayment'])->name('SA-FetchAllInvoiceForPayments');
        // list purchase invoice
    Route::get('/purchase/all-invoice-list-return-exchage', [purchaseController::class, 'getAllInvoiceForReturnExchange'])->name('SA-GetAllInvoiceForReturnExchange');
        // fetch all purchase invoice of unique vendors
    Route::get('/purchase/all-invoices-no-for-return-exchage', [purchaseController::class, 'fetchAllInvoicesNoforPayment'])->name('SA-FetchAllInvoiceNoForPayments');
        // fetch all products detials by choosing invoice number from dropdown
    Route::get('/purchase/purchase-order-details', [purchaseController::class, 'fetchAllProductsDetails'])->name('SA-FetchAllProductsDetials');
        // filter invoice by customer name
    Route::get('/invoice/filter', [SalesController::class, 'filterInvoiceName'])->name('SA-FilterInvoiceName');      

    
    //===============================================================================================
    // Payment Tab
    //===============================================================================================
        // fetch all invoice number
    Route::get('/sales/invoice-details', [SalesController::class, 'getInvoiceDetails'])->name('SA-InvoiceDetails');
        // store data in database
    Route::post('/sales/add-payment', [SalesController::class, 'addPayment'])->name('SA-AddPayment');
        // fetch payment all details
    Route::get('/sales/payment-list', [SalesController::class, 'getPayments'])->name('SA-GetPaymentList');
        // fech single column payment detials
    Route::get('/sales/payment', [SalesController::class, 'getPaymentDetials'])->name('SA-GetPaymentDetails');
        // edit payment detials
    Route::post('/sales/edit-payment', [SalesController::class, 'editPaymentDetails'])->name('SA-editPaymentDetails');
        // delete payment row
    Route::get('/sales/remove-payment', [SalesController::class, 'removePaymentDetials'])->name('SA-RemovePaymentDetails');   
        // payment filter
    Route::get('/sales/filter-payment', [SalesController::class, 'filterPaymentDetials'])->name('SA-FilterPaymentDetails');
        // fetch all invoice number for dropdown
    Route::get('/sales/invoice-No-details', [SalesController::class, 'getInvoiceNoDetails'])->name('SA-FetchInvoiceNoDetails');
        // filter by customer name
    Route::get('/sales/payment/filter', [SalesController::class, 'getPaymentsFilter'])->name('SA-GetPaymentFilter');

    //===============================================================================================
    // Customer Tab
    //===============================================================================================
        // Customer Management System
    Route::get('/customer-management', [SalesController::class, 'customerManagement'])->name('SA-CustomerManagement')->middleware('checkcustomer');
        // add customer
    Route::post('/sales/add-customer', [SalesController::class, 'addCustomer'])->name('SA-AddCustomer');
        // fetch all customer details
    Route::get('/sales/customer/customers-list', [SalesController::class, 'customersList'])->name('SA-CustomersList');
        // all customers for pagination
    Route::get('/sales/customer/customers-list/Paginate', [SalesController::class, 'customersListPaginate'])->name('SA-CustomersListPaginate');
        // get single customer details
    Route::get('/sales/customer', [SalesController::class, 'getCustomerDetails'])->name('SA-GetCustomerDetails');
        // get single customer sales invoice details
    Route::get('/sales/customer/sales-invoice', [SalesController::class, 'getCustomerSalesInvoiceDetails'])->name('SA-getCustomerSalesInvoiceDetails');
        // update customer details
    Route::post('/sales/edit-customer', [SalesController::class, 'editCustomerDetails'])->name('SA-EditCustomerDetails');
        // remove customer details
    Route::get('/sales/remove-customer', [SalesController::class, 'removeCustomer'])->name('SA-RemoveCustomer');
        // add customer special price
    Route::post('/sales/update-customer', [SalesController::class, 'updateCustomerDetails'])->name('SA-UpdateCustomerDetails');
        // customer filter
    Route::get('/customer/filter', [SalesController::class, 'customerFilter'])->name('SA-CustomerFilter');

   
    //===============================================================================================
    // Vendor Tab
    //===============================================================================================
        // Add Vendor
    Route::post('/purchase/add-vendor', [purchaseController::class, 'addVendor'])->name('SA-AddVendor');
        // Fetch all vendors details
    Route::get('/purchase/fetch-vendors', [purchaseController::class, 'getVendors'])->name('SA-GetVendors');
        // Update single vendor
    Route::post('/purchase/update-vendor', [purchaseController::class, 'updateVendor'])->name('SA-UpdateVendor');    
        // Remove single vendor
    Route::get('/purchase/remove-vendor', [purchaseController::class, 'removeVendor'])->name('SA-RemoveVendor');    
        // fetch all vendors detials
    Route::get('/purchase/fetch-all-vendor', [purchaseController::class, 'getAllVendors'])->name('SA-FetchAllVendor');
        // filter via vendor name
    Route::get('/purchase/vendor/filter', [purchaseController::class, 'filterPurchaseVendor'])->name('SA-FilterPurchaseVendor');        

    //===============================================================================================
    // Purchase Requisition Tab
    //===============================================================================================    
        // Get GST treatments by choosing vendor names
    Route::get('/purchase/gst-treatment', [purchaseController::class, 'getGSTTreatment'])->name('SA-GSTTreatment');
        // Add Quotation for purchase section
    Route::post('/purchase/add-request', [purchaseController::class, 'addRequest'])->name('SA-AddRequest');
        // Fetch all Requesting Quotations
    Route::get('/purchase/all-quotation', [purchaseController::class, 'requestQuotations'])->name('SA-RequestQuotation');
        // Fetch Single Requesting Quotation
    Route::get('/purchase/single-quotation', [purchaseController::class, 'getRequestQuotation'])->name('SA-GetSingleQuotation');
        // Update Quotation
    Route::post('/purchase/update-quotation', [purchaseController::class, 'updateRequestQuotation'])->name('SA-UpdateSingleQuotation');
        // Remove Requesting Quotataion
    Route::get('/purchase/remove-quotation', [purchaseController::class, 'removeRequestQuotation'])->name('SA-RemoveSingleQuotation');
        // fetch all products detials to show quotation id 
    Route::get('/purchase/all-quotation-detials', [purchaseController::class, 'requestAllQuotations'])->name('SA-RequestAllQuotation');
        // purchase request filter by vendor name
    Route::get('/purchase-req/filter', [purchaseController::class, 'requestAllQuotationsFilter'])->name('SA-RequestAllQuotationsFilter');
        // fetch all products detials
    Route::get('/sales/all-products-purchase', [purchaseController::class, 'fetchProductsAllInfo'])->name('SA-FetchProductsAllDetialsInfo');

    
    //===============================================================================================
    // Fixed Asset Management Tab
    //===============================================================================================    

        // Asset
        // fixed asset management route
    Route::get('/fixed-asset-management', [FixedAssetContoller::class, 'index'])->name('SA-FixedAssetManagement');
        // Add Asset
    Route::post('/fixed-asset-management/add-asset', [FixedAssetContoller::class, 'addAsset'])->name('SA-AddAsset');
        // Fatch all Asset Detials
    Route::get('/fixed-asset-management/list-asset', [FixedAssetContoller::class, 'getAsset'])->name('SA-GetAsset');
    // 
    Route::get('/fixed-asset-management/list-asset-all', [FixedAssetContoller::class, 'getAssetList'])->name('SA-getAssetList');
        // get single asset detials
    Route::get('/fixed-asset-management/single-asset', [FixedAssetContoller::class, 'fetchAsset'])->name('SA-FetchAsset');
        // Update asset detials
    Route::post('/fixed-asset-management/update-asset', [FixedAssetContoller::class, 'updateAsset'])->name('SA-UpdateAsset');
        // Remove asset detials
    Route::get('/fixed-asset-management/remove-asset', [FixedAssetContoller::class, 'removeAsset'])->name('SA-RemoveAsset');    

    //===============================================================================================
    // Asset Tracking Tab
    //===============================================================================================   

        // get quantity
    Route::get('/fixed-asset-management/single-asset-quantity', [FixedAssetContoller::class, 'fetchAssetQuantity'])->name('SA-FetchAssetQuantity');        
        // Add asset tracking data
    Route::post('/fixed-asset-tracking/add-asset-tracking', [FixedAssetContoller::class, 'addAssetTrakingData'])->name('SA-AddAssetTrackingData');
        // fetch all asset tracking detials
    Route::get('/fixed-asset-tracking/asset-tracking-details', [FixedAssetContoller::class, 'assetTrakingDetails'])->name('SA-AssetTrackingDetails');
        // fetch single asset tracking detials
    Route::get('/fixed-asset-tracking/single-asset-tracking-details', [FixedAssetContoller::class, 'fetchAssetTrakingDetails'])->name('SA-FetchAssetTrackingDetails');
        // update asset tracking detials
    Route::post('/fixed-asset-tracking/update-asset-tracking-details', [FixedAssetContoller::class, 'updateAssetTrakingDetails'])->name('SA-UpdateAssetTrackingDetails');
        // remove single asst traking detials
    Route::get('/fixed-asset-tracking/remove-asset-tracking-details', [FixedAssetContoller::class, 'removeAssetTrakingDetails'])->name('SA-RemoveAssetTrackingDetails');        

    //===============================================================================================
    // Reports Tab
    //===============================================================================================       

        // reports tab
    Route::get('/reports', [ReportController::class, 'index'])->name('SA-Reports')->middleware('checkreports');
        // get total products (sum of price)
    Route::get('/reports/all-products', [ReportController::class, 'getTotalProductsValues'])->name('SA-TotalProductsValues');
        // fetch detials of product in report tab
    Route::get('/reports/product-detials', [ReportController::class, 'getTotalProductsDetials'])->name('SA-TotalProductsDetails');


});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
