<?php

use App\Http\Controllers\V1\AdminsController;
use App\Http\Controllers\V1\TestEmailController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
     dd("hello");
});
//todo admin protected route
Route::controller(AdminsController::class)->group(function (){
    Route::get('/admin/dashboard/overview', 'overview')->name('overview');
    Route::get('/admin/dashboard/products', 'products')->name('products');
    Route::get('/admin/dashboard/add-product', 'addProduct')->name('addProduct');
    Route::get('/admin/dashboard/orders', 'orders')->name('orders');
    Route::get('/admin/dashboard/deliveries', 'deliveries')->name('deliveries');
    Route::get('/admin/dashboard/add-delivery', 'addDelivery')->name('addDelivery');
    Route::get('/admin/dashboard/brands', 'brands')->name('brands');
    Route::get('/admin/dashboard/categories', 'categories')->name('categories');
    Route::get('/admin/dashboard/staffs', 'staffs')->name('staffs');
    Route::get('/admin/dashboard/add-staff', 'addStaff')->name('addStaff');
    Route::get('/admin/dashboard/customers', 'customers')->name('customers');
});

Route::get('/email', [TestEmailController::class, 'index']);

//todo run command
Route::get('/artisan/{command}', function($command){
    //todo check if its migrate  command
    if($command == 'migrate')
        $output = ['--force'=>true];
    else
        $output = [];

    Artisan::call($command, $output);
    dd(Artisan::output());
});
