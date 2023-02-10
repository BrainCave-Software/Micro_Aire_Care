<?php

use App\Http\Controllers\SuperAdmin\AttendanceController;
use App\Http\Controllers\SuperAdmin\MonthlyTimesheetController;
use App\Http\Controllers\SuperAdmin\DropShippingController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Http\Controllers\SuperAdmin\UserController;
use App\Http\Controllers\SuperAdmin\TaskProgressController;
use App\Http\Controllers\SuperAdmin\InventoryController;
use App\Http\Controllers\SuperAdmin\ReportController;
use App\Http\Controllers\SuperAdmin\DesignationController;
use App\Http\Controllers\SuperAdmin\DepartmentController;
use App\Http\Controllers\SuperAdmin\TaskController;
use App\Http\Controllers\SuperAdmin\NotesController;
use App\Http\Controllers\SuperAdmin\FilesController;
use App\Http\Controllers\SuperAdmin\EmployeeController;
use App\Http\Controllers\User\FrontendController;
use App\Http\Controllers\SuperAdmin\CustomerManagementController;
use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\SuperAdmin\ProjectFileController;
use App\Http\Controllers\SuperAdmin\ProjectsController;
use App\Http\Controllers\SuperAdmin\RolesPreviledgesController;
use App\Models\TaskProgress;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
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

Route::get('/', [FrontendController::class, 'index'])->name('Home');
// Admin
// Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
//     Route::get('/', [AdminController::class, 'dashboard'])->name('Admin-Dashboard');
// });

//Super Admin
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [SuperAdminController::class, 'dashboard'])->name('SA-Dashboard');




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
    //                                       Customer Tab
    //===============================================================================================
    // Customer Management System
    Route::get('/customer-management', [CustomerManagementController::class, 'customerManagement'])->name('SA-CustomerManagement')->middleware('checkcustomer');
    // add customer
    Route::post('/add-customer', [CustomerManagementController::class, 'CreatCustomer'])->name('SA-CreatCustomer');
    // all customer list
    Route::get('/customers-list', [CustomerManagementController::class, 'ClientsList'])->name('SA-ClientsList');
    // fetch Individual  customer details (edit,view)
    Route::get('/customers-list/Paginate', [CustomerManagementController::class, 'FatchClients'])->name('SA-FatchClients');
    // Edit individual customer
    Route::post('/customers/update', [CustomerManagementController::class, 'updateClients'])->name('SA-EditClients');
    // remove business details
    Route::get('/customer/remove', [CustomerManagementController::class, 'removecustomer'])->name('SA-RemoveCustumer');
    // filter customer by customer name
    Route::get('/customer/filter', [CustomerManagementController::class, 'filterCustomerName'])->name('SA-FilterCustomerName');

    // get single customer details
    Route::get('/sales/customer', [SalesController::class, 'getCustomerDetails'])->name('SA-GetCustomerDetails');
    // fetch all customer details
    Route::get('/sales/customer/customers-list', [SalesController::class, 'customersList'])->name('SA-CustomersList');
    // get single Business details
    Route::get('/business/customer', [CustomerManagementController::class, 'getBusinessDetails'])->name('SA-GetBusinessDetails');
    // get single Retail details
    Route::get('/retail/customer', [CustomerManagementController::class, 'getRetailDetails'])->name('SA-GetRetailDetails');
    // get single business invoice details
    Route::get('/business/sales-invoice', [CustomerManagementController::class, 'getBusinessInvoiceDetails'])->name('SA-getBusinessInvoiceDetails');
    // get single retail invoice details
    Route::get('/retail/sales-invoice', [CustomerManagementController::class, 'getRetailInvoiceDetails'])->name('SA-getRetailInvoiceDetails');
    // update business details
    Route::post('/customer-modal/business/edit-customer', [CustomerManagementController::class, 'editBusinessDetails'])->name('SA-EditBusinessDetails');
    // update retail details
    Route::post('/customer-modal/retail/edit-customer', [CustomerManagementController::class, 'editRetailDetails'])->name('SA-editRetailDetails');
    // remove retail details
    Route::get('/retail/remove-customer', [SalesController::class, 'removeRetail'])->name('SA-RemoveRetail');
    // add customer special price
    Route::post('/sales/update-customer', [CustomerManagementController::class, 'updateCustomerDetails'])->name('SA-UpdateCustomerDetails');
    // business filter
    Route::get('/business/filter', [CustomerManagementController::class, 'businessFilter'])->name('SA-BusinessFilter');
    // retail filter
    Route::get('/retail/filter', [CustomerManagementController::class, 'retailFilter'])->name('SA-RetailFilter');
    //===============================================================================================
    // View Client Tab
    //===============================================================================================
    Route::get('/user-management/view', [CustomerManagementController::class, 'viewClient'])->name('SA-viewClient');


    //===============================================================================================
    // Note Section
    //===============================================================================================
    // Add To DB
    Route::post('/note', [NotesController::class, 'createNotes'])->name('SA-CreatNotes');
    // note list
    Route::get('/notelist', [NotesController::class, 'noteslist'])->name('SA-GetNotes');
    // fetch a single notes
    Route::get('/get-notes', [NotesController::class, 'getSingleNotes'])->name('SA-GetSingleNotes');
    // remvoe notes
    Route::get('/remove-notes', [NotesController::class, 'notesremove'])->name('SA-DeleteNotes');
    // add remarks for task
    Route::get('/task/remarks', [NotesController::class, 'getIdTask'])->name('SA-GetIdTask');
    //===============================================================================================
    // files Section
    //===============================================================================================
    //    data add in database
    Route::post('/files', [FilesController::class, 'addFiles'])->name('SA-addFile');
    // fatch data for client table
    Route::get('/filestable', [FilesController::class, 'showFiles'])->name('SA-GetFiles');
    // fatch data for project table
    Route::get('/filesprojecttable', [FilesController::class, 'showProjectFiles'])->name('SA-GetProjectFiles');
    // remove files
    Route::get('/filesdelete', [FilesController::class, 'deleteFiles'])->name('SA-DeleteFiles');
    //  Downloaf files
    Route::get('/filesdownload', [FilesController::class, 'downloadFiles'])->name('SA-DownloadFile');
    // file size
    Route::get('/fileSize', [FilesController::class, 'fileSize'])->name('SA-fileSize');


    // =============================================================================================
    //  Employee
    // ===================================================================================================
    Route::get('/employee', [EmployeeController::class, 'index'])->name('SA-Employee');
    // insert employe detials in db
    Route::post('/add-Employee', [EmployeeController::class, 'addEmployee'])->name('SA-AddEmployeeDB');
    // employee detail showw in list
    Route::get('/wmployee-list', [EmployeeController::class, 'getEmployeeDetail'])->name('SA-getEmployeeDetail');
    // featch single detail
    Route::get('/employee/single-details', [EmployeeController::class, 'getSingleEmployeeDetails'])->name('SA-GetSingleEmployeeDetails');
    // update employee details
    Route::post('/employee-update', [EmployeeController::class, 'updateEmployeeDetail'])->name('SA-UpdateEmployeeDetail');
    // Remove Employee
    Route::get('/employee-delete', [EmployeeController::class, 'removeEmployee'])->name('SA-RemoveEmployee');
    // filter employee by  name
    Route::get('/employee/filter', [EmployeeController::class, 'filterEmployeeName'])->name('SA-FilterEmployeeName');
    // get role name
    Route::get('/GetRole-name', [EmployeeController::class, 'selectRoleName'])->name('SA-selectRoletName');
    // get Designation name
    Route::get('/GetDesignation-name', [EmployeeController::class, 'selectdesignationName'])->name('SA-selectdesignationName');
    // address
    Route::get('/address/postal', [EmployeeController::class, 'APIaddres'])->name('SA-postaladdresses');


    // =============================================================================================
    //  Roles and Previledges 
    // ===================================================================================================
    Route::get('/roleandpriviledges', [RolesPreviledgesController::class, 'index'])->name('SA-RoleAndPrivileges');
    // insert previledges DB
    Route::post('/role-pSA-getRoleListriviledges', [RolesPreviledgesController::class, 'addpreviledges'])->name('SA-AddPreviledgesDB');
    // Table list
    Route::get('/roleandpriviledges-list', [RolesPreviledgesController::class, 'getRoleList'])->name('SA-GetRoleList');
    // Edit
    Route::get('/roleandpriviledges-update', [RolesPreviledgesController::class, 'getSingleRoleDetails'])->name('SA-GetSingleRoleDetails');
    // Edit update 
    Route::post('/roleandpriviledges-edit/update', [RolesPreviledgesController::class, 'getUpdateRole'])->name('SA-GetUpdateRole');
    // Remove Previledges
    Route::get('/roleandpriviledges-remove', [RolesPreviledgesController::class, 'removeRolePreviledges'])->name('SA-RemoveRolePreviledges');
    // filter Role by customer name
    Route::get('/roleandpriviledges-search', [RolesPreviledgesController::class, 'filterroleandpriviledges'])->name('SA-Filterroleandpriviledges');

    // ===================================================================================================
    //  Designation
    // ===================================================================================================
    Route::get('/designation', [DesignationController::class, 'index'])->name('SA-designation');
    // data send to DB
    Route::post('/add-designation', [DesignationController::class, 'addDesignation'])->name('SA-AddDesignationDB');
    // designation detail showw in list
    Route::get('/designation-list', [DesignationController::class, 'getDesignationDetail'])->name('SA-getDesignationDetail');
    // featch single detail
    Route::get('/designation/single-details', [DesignationController::class, 'getSingleDesignationDetails'])->name('SA-GetSingleDesignationDetails');
    // remove
    Route::get('/designation-delete', [DesignationController::class, 'removeDesignation'])->name('SA-RemoveDesignation');
    // get dipartment name
    Route::get('/GetDepartment-name', [DesignationController::class, 'selectDepartmentName'])->name('SA-selectDepartmentName');
    // update
    Route::post('/Designation-update', [DesignationController::class, 'UpdateDesignationDetail'])->name('SA-UpdatedesignationDetail');
    // filter  designation name
    Route::get('/Designation-filter', [DesignationController::class, 'filterDesignationName'])->name('SA-FilterDesignationName');

    // ===================================================================================================
    //  Department
    // ===================================================================================================
    Route::get('/department', [DepartmentController::class, 'index'])->name('SA-Department');
    // data send to DB
    Route::post('/add-Department', [DepartmentController::class, 'addDepartment'])->name('SA-AddDepartmentDB');
    // department detail showw in list
    Route::get('/department-list', [DepartmentController::class, 'getDepartmentDetail'])->name('SA-getDepartmentDetail');
    // department Employee
    Route::get('/department-delete', [DepartmentController::class, 'removeDepartment'])->name('SA-RemoveDepartment');
    // featch single detail
    Route::get('/department/single-details', [DepartmentController::class, 'getSingleDepartmentDetails'])->name('SA-GetSingleDepartmentDetails');
    // update Department details
    Route::post('/department-update', [DepartmentController::class, 'updateDepartmentDetail'])->name('SA-UpdateDepartmentDetail');
    // filter department by  name
    Route::get('/department/filter', [DepartmentController::class, 'filterDepartmentName'])->name('SA-FilterDepartmentName');

    //===============================================================================================
    // Attendance Section
    //===============================================================================================
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('SA-Attendance');



    //===============================================================================================
    // Monthly Timesheet Section
    //===============================================================================================
    Route::get('/monthlytimesheet', [MonthlyTimesheetController::class, 'index'])->name('SA-MonthlyTimesheet');



    //===============================================================================================
    // Dashboard Section
    //===============================================================================================
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('SA-Projectdashboard');

    //===============================================================================================
    // Project  Section
    //===============================================================================================
    Route::get('/project', [ProjectsController::class, 'index'])->name('SA-project');
    // Get client name foe addform
    Route::get('/project/form', [ProjectsController::class, 'getClientName'])->name('SA-clientName');
    //  Project data add
    Route::post('/project/add', [ProjectsController::class, 'addProject'])->name('SA-addProject');
    // Project list
    Route::get('/project-list', [ProjectsController::class, 'getProjectList'])->name('SA-GetProjectList');
    // Project detail for edit 
    Route::get('/project-view', [ProjectsController::class, 'FatchProject'])->name('SA-FatchProjectEdit');
    // Update project detail
    Route::post('/project/updat', [ProjectsController::class, 'updateProduct'])->name('SA-UpdateProject');
    // Delete Project
    Route::get('/project/remove', [ProjectsController::class, 'removeproject'])->name('SA-RemoveProject');
    // download
    Route::get('download', [ProjectsController::class, 'downloadProject']);
    // filter  project name
    Route::get('/project-filter', [ProjectsController::class, 'filterProjectName'])->name('SA-FilterProjectName');


    //===============================================================================================
    // Project view Section
    //===============================================================================================
    Route::Post('/projectfile', [ProjectFileController::class, 'createProjectFile'])->name('SA-CreateProjectFile');
    //   file uploading
    Route::get('/projectFile-list', [ProjectFileController::class, 'getProjectfileList'])->name('SA-GetProjectListFile');
    // exelsheet
    Route::get('/projectFile-sheet', [ProjectFileController::class, 'exelsheet'])->name('SA-exelsheet');
    // auto form fill
    Route::get('//projectFile-form', [ProjectFileController::class, 'autoFillForm'])->name('SA-autoFillForm');

    //===============================================================================================
    // Project view Section
    //===============================================================================================
    // Project detail for view
    Route::get('/project-edit', [ProjectsController::class, 'projectView'])->name('SA-FatchProject');
    // Project File detail for list
    Route::get('/project-edit/{id?}', [ProjectsController::class, 'projectViewId'])->name('SA-FatchProjectId');
    //   SA-FatchProjectEditTest
    Route::get('/project-Test', [ProjectsController::class, 'projectEdittest'])->name('SA-FatchProjectEditTest');
    // Get Task List
    Route::get('/task', [ProjectsController::class, 'taskList'])->name('SA-GetTaskList');




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
    // filter product by seletcing category & varients
    Route::get('/list-filter/products', [InventoryController::class, 'listProductsFilter'])->name('SA-ListProductsFilter');
    // download product excel file
    Route::get('/products-excel', [BulkProductUpload::class, 'productsExcel'])->name('SA-ProductsExcelFile');
    // fetch all varients
    Route::get('/list-varients/unique', [InventoryController::class, 'listUniqueVarients'])->name('SA-ListUniqueVarients');
    // Bulk Upload Product
    Route::post('/bulk-uploads/product', [BulkProductUpload::class, 'bulkProductUpload'])->name('SA-GetBulkProductUpload');
    // store bluck stock
    Route::post('/bulk-uploads/stock', [BulkStock::class, 'bulkStockUpload'])->name('SA-GetBulkStockUpload');

    // filter products by typing products name
    Route::get('/list-filter-name/products', [InventoryController::class, 'listProNameFilter'])->name('SA-ListProNameFilter');
    // list all products detials for form
    Route::get('/get-all-products', [InventoryController::class, 'getAllProducts'])->name('SA-GetAllProducts');
    //Product name for stock
    Route::get('/get-product-stock', [InventoryController::class, 'getAllProductsStock'])->name('SA-GetAllProductsStock');
    // product for business spacile price
    Route::get('/get-product-stock-Li', [InventoryController::class, 'getAllProductsStockLi'])->name('SA-GetAllProductsLi');
    Route::get('/get-name-products', [InventoryController::class, 'getNameProducts1'])->name('SA-GetNameProducts');
    // product list
    Route::get('/get-name-products-list', [InventoryController::class, 'getProductList'])->name('SA-GetProductList');
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
    // Drop Shipping Section
    //===============================================================================================
    Route::get('/drop-shipping', [DropShippingController::class, 'index'])->name('SA-DropShipping');
    // add Shipping
    Route::post('/drop-shipping', [DropShippingController::class, 'addShipping'])->name('SA-AddShipping');
    // fetch all Shipping
    Route::get('/get-shippings', [DropShippingController::class, 'getShippings'])->name('SA-GetShippings');
    // fetch a single Shipping
    Route::get('/get-shipping', [DropShippingController::class, 'getShipping'])->name('SA-GetShipping');
    // Edit Shipping
    Route::post('/edit-shipping', [DropShippingController::class, 'editShipping'])->name('SA-EditShipping');
    // Delete Shipping
    Route::get('/remove-shipping', [DropShippingController::class, 'removeShipping'])->name('SA-RemoveShipping');
    // View Shipping
    Route::get('/view-shipping', [DropShippingController::class, 'viewShipping'])->name('SA-ViewShipping');

    // access images
    Route::get('storage/{filename}', function ($filename) {
        $path = storage_path('public/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    });
    //===============================================================================================
    // Task Management Section
    //===============================================================================================
    Route::get('/task-management', [TaskController::class, 'index'])->name('SA-TaskManagement');
    // add Task
    Route::post('/task', [TaskController::class, 'addTask'])->name('SA-AddTask');
    // fetch all Task
    Route::get('/get-tasks', [TaskController::class, 'getTasks'])->name('SA-GetTasks');
    // fetch a single Task
    Route::get('/get-task', [TaskController::class, 'getTask'])->name('SA-GetTask');
    // Edit Task
    Route::post('/edit-task', [TaskController::class, 'editTask'])->name('SA-EditTask');
    // Delete Task
    Route::get('/remove-task', [TaskController::class, 'removeTask'])->name('SA-RemoveTask');
    // View Task
    Route::get('/view-task', [TaskController::class, 'viewTask'])->name('SA-ViewTask');
    // assign task for employee
    Route::get('/task/add', [TaskController::class, 'getSingle'])->name('SA-GetSingleTask');
    // view employee task
    Route::get('/task/view', [TaskController::class, 'getSingleView'])->name('SA-GetSingleView');
    // select employee name
    Route::get('/employee-name', [TaskController::class, 'selectEmployeeName'])->name('SA-selectEmployeeName');


    //  add task
    Route::post('/add-employee/Task', [TaskProgressController::class, 'AddNewTask'])->name('SA-AddNewTask');
    // update task
    Route::post('/complete-employee/Task', [TaskProgressController::class, 'completeTask'])->name('SA-CompleteTask');

    //===============================================================================================
    // Reports Tab
    //===============================================================================================       

    // reports tab
    Route::get('/reports', [ReportController::class, 'index'])->name('SA-Reports');
    // get total products (sum of price)
    Route::get('/reports/all-products', [ReportController::class, 'getTotalProductsValues'])->name('SA-TotalProductsValues');
    // fetch detials of product in report tab
    Route::get('/reports/product-detials', [ReportController::class, 'getTotalProductsDetials'])->name('SA-TotalProductsDetails');
    // fetch product
    Route::get('/sales/product', [SalesController::class, 'getProduct'])->name('SA-GetProduct');
    // fetch all products
    Route::get('/get-products', [InventoryController::class, 'getProducts'])->name('SA-GetProducts');
    // 
    Route::get('/get-products-list', [InventoryController::class, 'getProductslist'])->name('SA-GetProductsList');
    // all customers for pagination
    Route::get('/sales/customer/customers-list/Paginate', [SalesController::class, 'customersListPaginate'])->name('SA-CustomersListPaginate');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::any('/register', function(){
//     return redirect('/login');
// });