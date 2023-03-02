<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PbcompanyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\BrandProduct;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\RouteGroup;

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
//frontend
Route::get('/', [HomeController::class,'index']);
Route::get('/trangchu', [HomeController::class,'index']);
Route::post('/tim-kiem', [HomeController::class,'search']);

//danh muc truyen trang chu
Route::get('/loai-truyen/{category_id}', [CategoryProduct::class,'show_category_home']);
Route::get('/tac-gia/{author_id}', [AuthorController::class,'show_author_home']);
Route::get('/chi-tiet-san-pham/{sanpham_id}', [ProductController::class,'details_product']);

//backend
Route::get('/Admin', [AdminController::class,'index']);
Route::get('/dashboard', [AdminController::class,'show_dashboard']);
Route::get('/logout', [AdminController::class,'logout']);
Route::post('/admin-dashboard', [AdminController::class,'dashboard']);


//category product
Route::get('/add-category-product', [CategoryProduct::class,'add_category_product']);
Route::get('/edit-category-product/{category_product_id}', [CategoryProduct::class,'edit_category_product']);
Route::get('/delete-category-product/{category_product_id}', [CategoryProduct::class,'delete_category_product']);
Route::get('/all-category-product', [CategoryProduct::class,'all_category_product']);

Route::get('/unactive-category-product/{category_product_id}', [CategoryProduct::class,'unactive_category_product']);
Route::get('/active-category-product/{category_product_id}', [CategoryProduct::class,'active_category_product']);

Route::post('/save-category-product', [CategoryProduct::class,'save_category_product']);
Route::post('/update-category-product/{category_product_id}', [CategoryProduct::class,'update_category_product']);





//product

Route::get('/add-product', [ProductController::class,'add_product']);
Route::get('/edit-product/{sanpham_id}', [ProductController::class,'edit_product']);
Route::get('/delete-product/{sanpham_id}', [ProductController::class,'delete_product']);
Route::get('/all-product', [ProductController::class,'all_product']);

Route::get('/unactive-product/{sanpham_id}', [ProductController::class,'unactive_product']);
Route::get('/active-product/{sanpham_id}', [ProductController::class,'active_product']);

Route::post('/save-product', [ProductController::class,'save_product']);
Route::post('/update-product/{sanpham_id}', [ProductController::class,'update_product']);

//author
Route::get('/add-author-product', [AuthorController::class,'add_author_product']);
Route::get('/edit-author-product/{author_id}', [AuthorController::class,'edit_author_product']);
Route::get('/delete-author-product/{author_id}', [AuthorController::class,'delete_author_product']);
Route::get('/all-author-product', [AuthorController::class,'all_author_product']);

Route::post('/save-author-product', [AuthorController::class,'save_author_product']);
Route::post('/update-author-product/{author_id}', [AuthorController::class,'update_author_product']);

//pbcompany
Route::get('/add-pbcompany-product', [PbcompanyController::class,'add_pbcompany_product']);
Route::get('/edit-pbcompany-product/{pbcompany_id}', [PbcompanyController::class,'edit_pbcompany_product']);
Route::get('/delete-pbcompany-product/{pbcompany_id}', [PbcompanyController::class,'delete_pbcompany_product']);
Route::get('/all-pbcompany-product', [PbcompanyController::class,'all_pbcompany_product']);

Route::post('/save-pbcompany-product', [PbcompanyController::class,'save_pbcompany_product']);
Route::post('/update-pbcompany-product/{pbcompany_id}', [PbcompanyController::class,'update_pbcompany_product']);

//cart
Route::post('/save-cart', [CartController::class,'save_cart']);
Route::post('/update-cart-quantity', [CartController::class,'update_cart_quantity']);
Route::get('/show-cart', [CartController::class,'show_cart']);
Route::get('/delete-to-cart/{rowId}', [CartController::class,'delete_to_cart']);
Route::post('/add-cart-ajax', [CartController::class,'add_cart_ajax']);

//checkout
Route::get('/login-checkout', [CheckoutController::class,'login_checkout']);
Route::get('/logout-checkout', [CheckoutController::class,'logout_checkout']);
Route::post('/add-customer', [CheckoutController::class,'add_customer']);
Route::post('/order-place', [CheckoutController::class,'order_place']);
Route::post('/login-customer', [CheckoutController::class,'login_customer']);
Route::get('/checkout', [CheckoutController::class,'checkout']);
Route::get('/payment', [CheckoutController::class,'payment']);
Route::post('/save-checkout-customer', [CheckoutController::class,'save_checkout_customer']);
//order
Route::get('/manage-order', [CheckoutController::class,'manage_order']);
Route::get('/view-order/{orderId}', [CheckoutController::class,'view_order']);
Route::get('/delete-order/{orderId}', [CheckoutController::class,'delete_order']);