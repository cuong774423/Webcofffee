<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AdminContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\CartController;
use App\Http\Middleware\AdminLoginMiddleware;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\SupplyHistoryController;


// Route resource cho Supplier

Route::resource('pages', PageController::class);

Route::get('/', [PageController::class, 'index']);

Route::prefix('admin')->group(function () {
    Route::middleware([AdminLoginMiddleware::class])->group(function () {
        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('users', UserController::class);
        Route::resource('employees', EmployeeController::class);
        Route::resource('inventories', InventoryController::class);
        Route::resource('suppliers', SupplierController::class);
        Route::resource('shipments', ShipmentController::class);  
        Route::resource('supply-history', SupplyHistoryController::class);
    });
});
Route::get('/category/{id}', [PageController::class, 'showCategory'])->name('page.category');

Route::resource('orders', OrderController::class);
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');


Route::resource('contacts', ContactController::class);
Route::get('/contactview', [ContactController::class, 'view'])->name('contact.view');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::resource('contactss', AdminContactController::class);
Route::group(['prefix'=>'contact'], function(){
    Route::get('contactad', [AdminContactController::class, 'index'])->name('admin.listcontact');
    Route::post('contactad/{id}/reply', [AdminContactController::class, 'reply'])->name('admin.contacts.reply');
    Route::delete('xoa/{id}', [AdminContactController::class, 'destroy'])->name('admin.getContactDelete');
});

Route::get('/contact', function () {
    return view('pages.contact');
});

Route::post('/input-email',[PageController::class,'postInputEmail'])->name('postInputEmail');
Route::get('/input-email',[PageController::class,'getInputEmail'])->name('getInputEmail');


Route::get('/dangky',[PageController::class,'getSignup'])->name('getSignup');
Route::post('/dangky',[PageController::class,'postSignup'])->name('postSignup');

Route::get('/dangnhap',[PageController::class,'getLogin'])->name('getLogin');
Route::post('/dangnhap',[PageController::class,'postLogin'])->name('postLogin');

Route::get('/dangxuat',[PageController::class,'getLogout'])->name('getLogout');
Route::get('/admin/dangnhap',[UserController::class,'getLogin'])->name('admin.getLogin');
Route::post('/admin/dangnhap',[UserController::class,'postLogin'])->name('admin.postLogin');
Route::get('/admin/dangxuat',[UserController::class,'getLogout']);

Route::resource('inventories', InventoryController::class);

Route::get('/product/{id}',[PageController::class,'show'])->name('page.product');  

Route::get('/add-to-cart/{id}',[PageController::class,'addToCart'])->name('banhang.addtocart');
Route::get('/del-cart/{id}',[PageController::class,'delCartItem'])->name('page.xoagiohang');
Route::get('checkout',[PageController::class,'getCheckout'])->name('page.getdathang');
Route::post('checkout',[PageController::class,'postCheckout'])->name('page.postdathang');

Route::get('index',[CartController::class,'index'])->name('cart.index');
Route::get('/add-to-cart2/{id}',[CartController::class,'addToCart'])->name('cart.addtocart');
Route::get('/del-cart2/{id}',[CartController::class,'delCartItem'])->name('cart.xoagiohang');
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('updateCart');
Route::get('/reduce/{id}', [CartController::class, 'getReduceByOne'])->name('cart.reduceByOne'); 
Route::resource('discounts', DiscountController::class); 

Route::post('/apply-discount', [DiscountController::class, 'applyDiscount'])->name('apply.discount');

