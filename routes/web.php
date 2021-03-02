<?php

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

use App\Product;

Auth::routes();

Route::get('/', function () {
    $products = Product::join('categories', 'products.category_id', 'categories.id')
        ->select('products.*', 'categories.title as category_title')
        ->where('products.featured', 1)->get();
    return view('welcome', compact('products'));
});

Route::get('/welcome', function () {
    $products = Product::join('categories', 'products.category_id', 'categories.id')
    ->select('products.*', 'categories.title as category_title')
    ->where('products.featured', 1)->get();
    return view('welcome', compact('products'));
});

Route::group(['as'=>'product.'], function () {
    Route::get('/product/allList', 'ProductController@allList')->name('allList');
    Route::get('/product/featuredList', 'ProductController@featuredList')->name('featuredList');
    Route::get('/product/{product}', 'ProductController@productShow')->name('productShow');
});

Route::get('/add-to-cart/{id}', 'ProductController@getAddToCart')->name('getAddToCart');
Route::get('/shopping-cart', 'ProductController@getCart')->name('getCart');
Route::get('/checkout', 'ProductController@getCheckout')->name('checkout')->middleware('auth');
Route::get('/deduct/{id}', 'ProductController@deductByOne')->name('deductByOne');
Route::get('/delete/{id}', 'ProductController@removeItem')->name('removeItem');
Route::get('/admin/orders', 'OrderController@index')->name('order.index');

Route::group(['as'=>'cart.', 'prefix'=>'cart'], function () {
    Route::get('/', 'ProductController@cart')->name('all');
    Route::post('cart/remove/{product}', 'ProductController@removeProduct')->name('remove');
    Route::post('cart/update/{product}', 'ProductController@updateProduct')->name('update');
});

Route::group(['as'=>'admin.','middleware'=>['auth', 'admin']], function(){
    Route::get('admin/dashboard', 'AdminController@dashboard')->name('dashboard');
    Route::get('admin/category/{category}/remove', 'CategoryController@remove')->name('category.remove');
    Route::get('admin/category/trash', 'CategoryController@trash')->name('category.trash');
    Route::get('admin/category/recover/{id}', 'CategoryController@recoverCat')->name('category.recover');
    Route::resource('admin/category', 'CategoryController');

    Route::get('admin/profile/{profile}/remove', 'ProfileController@remove')->name('profile.remove');
    Route::get('admin/profile/trash', 'ProfileController@trash')->name('profile.trash');
    Route::get('admin/profile/recover/{id}', 'ProfileController@recoverProfile')->name('profile.recover'); 
    Route::resource('profile', 'ProfileController');

    Route::get('admin/product/{product}/remove', 'ProductController@remove')->name('product.remove');
    Route::get('admin/product/trash', 'ProductController@trash')->name('product.trash');
    Route::get('admin/product/recover/{id}', 'ProductController@recoverProduct')->name('product.recover');
    Route::resource('admin/product', 'ProductController');
});

Route::get('profile/{id}/account', 'ProfileController@profileEdit')->name('profileEdit');
