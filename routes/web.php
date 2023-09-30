<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\userController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DeliveryFileController;
use App\Http\Middleware\LoginMiddleware;
use App\Http\Middleware\RoleMiddleware;


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



Route::get('/{locale?}', [CustomerController::class, 'homePage'])->name('homepage');

Route::post('/import-data', [OrderController::class, 'importData'])->name('import-data');
Route::post('/upload', [OrderController::class, 'fileUpload'])->name('upload');
Route::get('/multi-download/{id}', [OrderController::class, 'multiple'])->name('multi-download');

Route::middleware([LoginMiddleware::class . ':admin'])->prefix('{locale}/admin')->group(function () {
    Route::get('/login', [AdminController::class, 'adminloginpage'])->name('admin-login');
    Route::post('/signin', [AdminController::class, 'adminLogin'])->name('admin-signin');
});
Route::middleware([RoleMiddleware::class . ':admin'])->prefix('{locale}/admin')->group(function () {
    Route::get('/logout', [AdminController::class, 'adminLogout'])->name('admin-logout');

    // Route::get('/view-orders', [AdminController::class, 'viewOrders'])->name('admin-vieworders');
    Route::get('/admin-view-orders', [AdminController::class, 'AdminviewOrders']);
    Route::get('/order-details/{id}', [AdminController::class, 'orderDetails']);
    Route::get('/change-password', [AdminController::class, 'changePassword']);
    Route::post('/update-password', [AdminController::class, 'updatePassword']);
    Route::get('/profile', [AdminController::class, 'adminProfile']);
    Route::post('/profile-update', [AdminController::class, 'profileUpdate']);
});

Route::middleware([LoginMiddleware::class . ':customer'])->prefix('{locale}/customer')->group(function () {
    Route::get('/login', [CustomerController::class, 'login'])->name('customer-login');
    Route::post('/customer-login', [CustomerController::class, 'customerLogin']);
    Route::get('/registration', [CustomerController::class, 'registration']);
    Route::post('/customer-registration', [CustomerController::class, 'customerRegistration']);
    Route::get('/setpassword/{id}', [CustomerController::class, 'setEmployerPassword']);
    Route::post('/employer-password-update', [CustomerController::class, 'EmployerPasswordUpdate']);
});

// Customer
Route::middleware([RoleMiddleware::class . ':customer'])->prefix('{locale}/customer')->group(function () {
    Route::get('/logout', [CustomerController::class, 'customerLogout']);




    Route::get('/view-orders', [OrderController::class, 'viewOrder'])->name('customer-vieworders');
    Route::get('/order_detail', [OrderController::class, 'OrderDetail'])->name('customer-order_detail');
    Route::get('/order_change', [OrderController::class, 'OrderChange'])->name('customer-order_change');

    Route::post('/toggle-status', [OrderController::class, 'toggle_status'])->name('customer-toggle-status');
    Route::get('/order-details/{id}', [OrderController::class, 'orderDetails']);
    Route::get('/get-order-detail', [OrderController::class, 'getOrderDetail'])->name('customer-get-order-detail');
    Route::post('/order-file-index-change', [OrderController::class, 'changeOrderIndex'])->name('customer-order-file-index-change');

    // Profile Management
    Route::get('/profile', [CustomerController::class, 'CustomerProfile']);
    Route::POST('/profile-update', [CustomerController::class, 'profileUpdate']);




    Route::get('/embroidery-program', [OrderController::class, 'embroideryForm'])->name('embroidery-program');


    Route::post('embroidery-order/save', [OrderController::class, 'embroideryOrderSave'])->name('embroidery-order/save');
    Route::post('embroidery-order/submit', [OrderController::class, 'embroideryOrderSumit'])->name('embroidery-order/submit');

    Route::get("embroidery-order/delete/{id}", [OrderController::class, 'embroidery_orderDelete'])->name('embroidery-order/delete/{id}');
    Route::get("embroidery-order/edit/{id}", [OrderController::class, 'display_embDetails'])->name('embroidery-order/edit/{id}');
    Route::post("updated-embroidery-order", [OrderController::class, 'updated_embroidery']);

    Route::get('/change-password', [CustomerController::class, 'changePassword']);
    Route::POST('/update-password', [CustomerController::class, 'updatePassword'])->name('update-password');
    Route::get('/vectorization-service', [OrderController::class, 'vectorizeForm'])->name('vector-program');
    Route::post('/vector-order/submit', [OrderController::class, 'vectorOrderSumit'])->name('vector-order-submit');

    Route::get("vector-order/delete/{id}", [OrderController::class, 'vector_orderDelete'])->name('vector-order/delete/{id}');
    Route::get("vector-order/edit/{id}", [OrderController::class, 'display_vectorDetails'])->name('vector-order/edit/{id}');
    Route::post("updated-vector-order", [OrderController::class, 'updated_vector'])->name('updated-vector-order');

    Route::post('/vec-delete-file', [OrderController::class, 'vectordeleteFile'])->name('vec-delete-file');
    Route::post('/emb-delete-file', [OrderController::class, 'embdeleteFile'])->name('emb-delete-file');

    Route::get('/files/{id}', [CustomerController::class, 'files']);
    Route::get('invite-employee', [CustomerController::class, 'InviteEmployeeView'])->name('invite-employee');
    Route::post('/send-invite', [CustomerController::class, 'sendInvite'])->name('send-invite');
    Route::get('/listEmployees', [CustomerController::class, 'listEmployees']);
    Route::get('/edit-employee/{id}', [CustomerController::class, 'editEmployee']);
    Route::Post('/update-employee', [CustomerController::class, 'updateEmployee']);
    Route::Post('/deleteemployee/{id}', [CustomerController::class, 'deleteEmployee']);
    Route::get('/employee-profile', [CustomerController::class, 'EmployeeProfile']);
});



Route::middleware([LoginMiddleware::class . ':freelancer'])->prefix('{locale}/freelancer')->group(function () {
    Route::get('/login', [FreelancerController::class, 'freelancerloginpage'])->name('freelancer-login');
    Route::post('/signin', [FreelancerController::class, 'freelancerLogin'])->name('freelancer-signin');
});

Route::middleware([RoleMiddleware::class . ':freelancer'])->prefix('{locale}/freelancer')->group(function () {
    Route::get('/logout', [FreelancerController::class, 'freelancerLogout'])->name('freelancer-logout');
    Route::get('/view-orders', [FreelancerController::class, 'viewOrder'])->name('freelancer-vieworders');
    Route::get('/order-details/{id}', [FreelancerController::class, 'orderDetails']);
    Route::POST('/downloadFile', [FreelancerController::class, 'downloadAddressFIle']);
    Route::get('/upload-file', [FreelancerController::class, 'UploadFile']);
    Route::POST('/download', [FreelancerController::class, 'downloadFile']);
    Route::POST('/files', [FreelancerController::class, 'checkFiles']);
    // delivery Files
    Route::get('/upload-files/{id}', [DeliveryFileController::class, 'DeliveryPage']);
    Route::POST('/upload-delivery-files', [DeliveryFileController::class, 'UploadDeliveryFiles']);


    Route::get('/profile', [FreelancerController::class, 'freelancerProfile']);
    Route::POST('/profile-update', [FreelancerController::class, 'Profileupdate']);
    Route::get('/change-password', [FreelancerController::class, 'changePassword']);
    Route::POST('/change-password-update', [FreelancerController::class, 'updatePassword']);
    Route::get('/deletefiles/{id}/{orderid}/', [FreelancerController::class, 'DeleteFile']);
    Route::get('/filter-data', [FreelancerController::class, 'filtersData']);
});