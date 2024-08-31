<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\FacultyFilterController;
use App\Http\Controllers\StaffFilterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});


Route::get('/login', [CustomAuthController::class, 'login'])->middleware('alreadyLoggedIn');
Route::post('/login-user', [CustomAuthController::class, 'loginUser'])->name('login-user');
Route::get('/adminDashboard',  [CustomAuthController::class, 'adminDashboard'])->middleware('isLoggedIn');
Route::get('/logout', [CustomAuthController::class, 'logout']);

Route::get('/sosDashboard',  [CustomAuthController::class, 'sosDashboard'])->middleware('sosIsLoggedIn');
Route::get('/login', [CustomAuthController::class, 'login'])->middleware('sosAlreadyLoggedIn');

Route::get('/facultyDashboard',  [CustomAuthController::class, 'facultyDashboard'])->middleware('facultyIsLoggedIn');
Route::get('/login', [CustomAuthController::class, 'login'])->middleware('facultyAlreadyLoggedIn');

// Route::group(['middleware' => ['isLoggedIn']], function () {
//     // Routes that require authentication for any user type
//     Route::get('/adminDashboard', [CustomAuthController::class, 'adminDashboard']);
//     Route::get('/sosDashboard', [CustomAuthController::class, 'sosDashboard']);
//     Route::get('/facultyDashboard', [CustomAuthController::class, 'facultyDashboard']);
//     // Add other user-specific routes here
// });


//Route::resource('admin', AdminController::class);

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'admin_Dashboard'])->name('admin.adminDashboard');
    Route::get('/manage-admin', [AdminController::class, 'manageAdmin'])->name('admin.manageAdmin');
    Route::get('/delAdmin/{id}', [AdminController::class, 'deleteAdmin']);
    Route::post('/addAdmin', [AdminController::class, 'addAdministrator']);
    Route::get('/editAdmin/{id}', [AdminController::class, 'editAdmin']);
    Route::post('/updateAdmin/{id}', [AdminController::class, 'updateAdmin']);
    Route::get('/manageSOS', [AdminController::class, 'manageSOS'])->name('admin.manageSOS');
    Route::post('/addSOS', [AdminController::class, 'addStaff']);
    Route::get('/delStaff/{id}', [AdminController::class, 'deleteStaff']);
    Route::get('/editStaff/{id}', [AdminController::class, 'editStaff']);
    Route::post('/updateStaff/{id}', [AdminController::class, 'updateStaff']);
    Route::get('/viewInventory', [AdminController::class, 'viewInventory'])->name('admin.viewInventory');
    Route::get('/viewFaculty', [AdminController::class, 'viewFaculty'])->name('admin.viewFaculty');
    Route::get('/filter', [AdminController::class, 'filterInventory'])->name('admin.filterInventory');


    
    // Add more routes for your admin actions here
});




Route::prefix('staff')->group(function () {
    Route::get('/dashboard', [StaffController::class, 'staff_Dashboard'])->name('staff.staffDashboard');
    Route::get('/manage-faculty', [StaffController::class, 'manageFaculty'])->name('staff.manageFaculty');
    Route::post('/addFaculty', [StaffController::class, 'addFacultyIncharge']);
    Route::get('/delFaculty/{id}', [StaffController::class, 'deleteFaculty']);
    Route::get('/editFaculty/{id}', [StaffController::class, 'editFaculty']);
    Route::post('/updateFaculty/{id}', [StaffController::class, 'updateFaculty']);
    Route::get('/manageItem', [StaffController::class, 'manageItem'])->name('staff.manageItem');
    Route::post('/addItem', [StaffController::class, 'addItem']);
    Route::get('/delItem/{id}', [StaffController::class, 'deleteItem']);
    Route::get('/editItem/{id}', [StaffController::class, 'editItem']);
    Route::post('/updateItem/{id}', [StaffController::class, 'updateItem']);
    Route::get('/transferItem', [StaffController::class, 'transferItem'])->name('staff.transferItem');
    Route::post('/addTransfer', [StaffController::class, 'addTransfer']);
    Route::get('/delTransfer/{id}', [StaffController::class, 'deleteTransfer']);
    Route::get('/editTransfer/{id}', [StaffController::class, 'editTransfer']);
    Route::post('/updateTransfer/{id}', [StaffController::class, 'updateTransfer']);

    Route::get('/viewFacultyR/{id}', [StaffController::class, 'viewFacultyR']);
    Route::get('/viewFacultyChart/{id}/{recordID}/{catID}', [StaffController::class, 'viewFacultyChart']);
    
   // Add more routes for your admin actions here
});



Route::prefix('faculty')->group(function () {
    Route::get('/dashboard', [FacultyController::class, 'faculty_Dashboard'])->name('faculty.facultyDashboard');
    Route::get('/monthlyReport', [FacultyController::class, 'monthlyReport'])->name('faculty.monthlyReport');
    Route::get('/addMonthlyReport/{id}/{categoryId}', [FacultyController::class, 'addMonthlyReport']);
    Route::post('/updateInventoryState/{recordno}', [FacultyController::class, 'updateInventoryState']);
    Route::get('/delInventoryState/{stateID}/{checkedId}', [FacultyController::class, 'deleleteInventoryState']);
    Route::get('/editInventoryState/{stateID}/{checkedId}/{category}', [FacultyController::class, 'editInventoryState']);
    Route::post('/updateInventoryStateReport/{stateID}/{checkedID}/{recordno}', [FacultyController::class, 'updateInventoryStateReport']);
    Route::get('/viewDatachart/{recordno}/{categoryID}',[FacultyController::class, 'viewDatachart']);
    Route::post('/filter/item_monthly_chart', [FacultyController::class, 'itemMonthlyChart'])->name('filter.item_monthly_chart');
    Route::post('/filter/item_monthly_chart2', [FacultyController::class, 'itemMonthlyChart2'])->name('filter.item_monthly_chart2');

});


Route::prefix('fFilter')->group(function () {

    Route::get('/filterInventory', [FacultyFilterController::class, 'facultyFilterInventory'])->name('faculty.filterInventory');
    Route::post('/filter/changeDropdown', [FacultyFilterController::class, 'changeDropdown'])->name('filter.changeDropdown');
    Route::post('/filter/facFilterItem', [FacultyFilterController::class, 'facFilterItem'])->name('filter.fac_filter_item');
    Route::post('/filter/sosFilterItem', [FacultyFilterController::class, 'sosFilterItem'])->name('filter.staff_filter_item');
    Route::post('/filter/adminFilterItem', [FacultyFilterController::class, 'adminFilterItem'])->name('filter.admin_filter_item');

    //
    Route::get('/facultyReport', [FacultyFilterController::class, 'facultyReport'])->name('faculty.facultyReport');

});


Route::prefix('sFilter')->group(function () {

    Route::get('/sFilterInventory', [StaffFilterController::class, 'staffFilterInventory'])->name('staff.sFilterInventory');
   // Route::post('/filter/sosFilterItem', [StaffFilterController::class, 'sosFilterItem'])->name('filter.staff_filter_item');

});





//Route::get('/admin/dashboard', [AdminController::class, 'admin_Dashboard'])->name('admin.adminDashboard');
