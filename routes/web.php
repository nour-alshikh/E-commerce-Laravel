<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/' , [HomeController::class ,'index']);
Route::get('/redirect' , [HomeController::class ,'redirect'])->middleware('auth', 'verified');

Route::get('/view_cat' , [AdminController::class ,'view_cat']);
Route::post('/add_cat' , [AdminController::class ,'add_cat']);
Route::get('/del_cat/{id}' , [AdminController::class ,'del_cat']);
Route::get('/edit_cat/{id}' , [AdminController::class ,'edit_cat']);
Route::post('/update_cat/{id}' , [AdminController::class ,'update_cat']);

Route::get('/view_product' , [AdminController::class ,'view_product']);
Route::post('/add_product' , [AdminController::class ,'add_product']);
Route::get('/show_product' , [AdminController::class ,'show_product']);
Route::get('/delete_product/{id}' , [AdminController::class ,'delete_product']);
Route::get('/edit_product/{id}' , [AdminController::class ,'edit_product']);
Route::post('/update_product/{id}' , [AdminController::class ,'update_product']);

Route::get('/product_details/{id}' , [HomeController::class ,'product_details']);
Route::post('/add_cart/{id}' , [HomeController::class ,'add_cart']);
Route::get('/show_cart' , [HomeController::class ,'show_cart']);
Route::get('/del_cart/{id}' , [HomeController::class ,'del_cart']);

Route::get('/order_cash' , [HomeController::class ,'order_cash']);

Route::get('/stripe/{total_price}' , [HomeController::class ,'stripe']);
Route::post('stripe/{total_price}', [HomeController::class ,'stripePost'])->name('stripe.post');

Route::get('order', [AdminController::class ,'order']);
Route::get('deliver/{id}', [AdminController::class ,'deliver']);
Route::get('print_order/{id}', [AdminController::class ,'print_order']);
Route::get('send_email/{id}', [AdminController::class ,'send_email']);
Route::post('send_user_email/{id}', [AdminController::class ,'send_user_email']);

Route::get('search', [AdminController::class ,'search']);

Route::get('show_order', [HomeController::class ,'show_order']);
Route::get('del_order/{id}', [HomeController::class ,'del_order']);

Route::post('add_comment', [HomeController::class ,'add_comment']);
Route::post('add_reply', [HomeController::class ,'add_reply']);

Route::get('search_product', [HomeController::class ,'search_product']);

Route::get('show_products', [HomeController::class ,'show_products']);
Route::get('product_search', [HomeController::class ,'product_search']);

Route::get('show_blog', [HomeController::class ,'show_blog']);

Route::get('subscribe', [HomeController::class ,'subscribe']);
Route::get('log_in', [HomeController::class ,'log_in']);


Route::get('add_testim', [AdminController::class ,'add_testim']);
Route::post('store_testim', [AdminController::class ,'store_testim']);
Route::get('del_testim/{id}', [AdminController::class ,'del_testim']);

Route::get('show_test', [HomeController::class ,'show_test']);

Route::get('show_users' , [AdminController::class, 'show_users']);
Route::get('add_admin/{id}' , [AdminController::class, 'add_admin']);
Route::get('remove_admin/{id}' , [AdminController::class, 'remove_admin']);
