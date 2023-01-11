<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'Frontend\FrontendController@index');
Route::get('category', 'Frontend\FrontendController@category');
Route::get('category/{slug}', 'Frontend\FrontendController@viewCategory');
Route::get('category/{cat_slug}/{prod_slug}', 'Frontend\FrontendController@viewProduct');

Route::get('product-list', 'Frontend\FrontendController@productList');
Route::post('searchProduct', 'Frontend\FrontendController@search');
Auth::routes();

Route::get('load-cart-data', 'Frontend\CartController@cartCount');
Route::get('load-wishlist-data', 'Frontend\WishlistController@wishlistCount');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('add-to-cart', 'Frontend\CartController@addProduct');
Route::post('delete-cart-item', 'Frontend\CartController@deleteItem');
Route::post('update-cart', 'Frontend\CartController@updateCart');

Route::post('add-to-wishlist', 'Frontend\WishlistController@addProd');
Route::post('delete-wishlist-item', 'Frontend\WishlistController@deleteProd');

Route::middleware(['auth'])->group(function () {
    Route::get('cart', 'Frontend\CartController@viewCart');
    Route::get('checkout', 'Frontend\CheckoutController@index');
    Route::post('place-order', 'Frontend\CheckoutController@placeOrder');

    Route::post('add-rating', 'Frontend\RatingController@add');
    Route::get('add-review/{product_slug}/userreview', 'Frontend\ReviewController@addReview');
    Route::post('add-review', 'Frontend\ReviewController@insertReview');
    Route::get('edit-review/{product_slug}/userreview', 'Frontend\ReviewController@editReview');
    Route::put('update-review', 'Frontend\ReviewController@updatetReview');


    Route::get('my-orders', 'Frontend\UserController@index');
    Route::get('view-order/{id}', 'Frontend\UserController@viewOrder');

    Route::get('wishlist', 'Frontend\WishlistController@index');

});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('dashboard', 'Admin\FrontendController@index');

    Route::get('categories', 'Admin\CategoryController@index');
    Route::get('add-category', 'Admin\CategoryController@add');
    Route::post('insert-category', 'Admin\CategoryController@insert');
    Route::get('edit-cat/{id}', 'Admin\CategoryController@edit');
    Route::put('update-category/{id}', 'Admin\CategoryController@update');
    Route::get('delete-cat/{id}', 'Admin\CategoryController@delete');

    Route::get('products', 'Admin\ProductController@index');
    Route::get('add-product', 'Admin\ProductController@add');
    Route::post('insert-product', 'Admin\ProductController@insert');
    Route::get('edit-product/{id}', 'Admin\ProductController@edit');
    Route::put('update-product/{id}', 'Admin\ProductController@update');
    Route::get('delete-product/{id}', 'Admin\ProductController@delete');

    Route::get('orders', 'Admin\OrderController@index');
    Route::get('admin/view-order/{id}', 'Admin\OrderController@viewOrder');
    Route::put('update-order/{id}', 'Admin\OrderController@updateOrder');
    Route::get('order-history', 'Admin\OrderController@orderHistory');

    Route::get('users', 'Admin\DashboardController@users');
    Route::get('view-user/{id}', 'Admin\DashboardController@viewUser');
});
