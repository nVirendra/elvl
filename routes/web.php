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



Route::get('/',['uses'=>'ProductController@index','as'=>'allproducts']);

Route::get('product/addToCart/{id}',['uses'=>'ProductController@addProductToCart','as'=>'AddToCartProduct']);

Route::get('cart', ["uses"=>"ProductController@showCart", "as"=> "cartproducts"]);

//delete item from cart
Route::get('product/deleteItemFromCart/{id}',['uses'=>'ProductController@deleteItemFromCart','as'=>'DeleteItemFromCart']);
//User Authentication
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Admin Panel
Route::get('admin/products', ["uses"=>"Admin\AdminProductController@index", "as"=> "adminDisplayProducts"])->middleware('restrictToAdmin');

Route::group(['middleware' => ['restrictToAdmin']], function (){
	//display edit product form
Route::get('admin/editProductForm/{id}', ["uses"=>"Admin\AdminProductController@editProductForm", "as"=> "adminEditProductForm"]);

//display edit product image form
Route::get('admin/editProductImageForm/{id}', ["uses"=>"Admin\AdminProductController@editProductImageForm", "as"=> "adminEditProductImageForm"]);


//update product image
Route::post('admin/updateProductImage/{id}', ["uses"=>"Admin\AdminProductController@updateProductImage", "as"=> "adminUpdateProductImage"]);

//update product data
Route::post('admin/updateProduct/{id}', ["uses"=>"Admin\AdminProductController@updateProduct", "as"=> "adminUpdateProduct"]);

//display create product form
Route::get('admin/createProductForm', ["uses"=>"Admin\AdminProductController@createProdcutForm", "as"=> "adminCreateProductForm"]);

//send new product data to database
Route::post('admin/sendCreateProductForm/', ["uses"=>"Admin\AdminProductController@sendCreateProductForm", "as"=> "adminSendCreateProductForm"]);


//delete product
Route::get('admin/deleteProduct/{id}', ["uses"=>"Admin\AdminProductController@deleteProduct", "as"=> "adminDeleteProduct"]);
});


//Men
Route::get('products/men', ["uses"=>"ProductController@menProducts", "as"=> "menProducts"]);

//Women
Route::get('products/women', ["uses"=>"ProductController@womenProducts", "as"=> "womenProducts"]);

//search
Route::get('search', ["uses"=>"ProductController@search", "as"=> "searchProducts"]);

//increase single product in cart
Route::get('product/increaseSingleProduct/{id}',['uses'=>'ProductController@increaseSingleProduct','as'=>'IncreaseSingleProduct']);


//decrease single product in cart
Route::get('product/decreaseSingleProduct/{id}',['uses'=>'ProductController@decreaseSingleProduct','as'=>'DecreaseSingleProduct']);

//checkout page
Route::get('product/checkoutProducts/',['uses'=>'ProductController@checkoutProducts','as'=>'checkoutProducts']);


//create an order
Route::get('product/createOrder/',['uses'=>'ProductController@createOrder','as'=>'createOrder']);

//process checkout page
Route::post('product/createNewOrder/',['uses'=>'ProductController@createNewOrder','as'=>'createNewOrder']);

//payment page
Route::get('payment/paymentpage', ["uses"=> "Payment\PaymentsController@showPaymentPage", 'as'=> 'showPaymentPage']);

//process payment & receipt page
Route::get('payment/paymentreceipt/{paymentID}/{payerID}', ["uses"=> "Payment\PaymentController@showPaymentReceipt", 'as'=> 'showPaymentReceipt']);
