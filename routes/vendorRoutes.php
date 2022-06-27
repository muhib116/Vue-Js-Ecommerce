<?php

use Illuminate\Support\Facades\Route;
Route::get('seller/update', 'Vendor\VendorController@updatescore')->name('sellerupdate');
Route::get('seller/newlogin', 'Vendor\VendorLoginController@LoginForm')->name('vendorLoginForm');
Route::post('seller/login', 'Vendor\VendorLoginController@login')->name('vendorLogin');
Route::get('seller/logout', 'Vendor\VendorLoginController@logout')->name('vendorLogout');

Route::get('seller/register', 'Vendor\VendorRegController@registerForm')->name('vendorRegisterForm');
Route::post('seller/register', 'Vendor\VendorRegController@register')->name('vendorRegister');

//reset for
Route::get('seller/password/recover', 'Auth\ForgotPasswordController@sellerPasswordRecover')->name('seller.password.recover');
//forgot password notify send
Route::match(array('GET','POST'), 'seller/password/recover/notify', 'Auth\ForgotPasswordController@sellerPasswordRecoverNotify')->name('seller.password.recover');
//verify token or otp
Route::get('seller/password/recover/verify', 'Auth\ForgotPasswordController@sellerPasswordRecoverVerify')->name('seller.password.recoverVerify');
//passord update
Route::post('seller/password/recover/update', 'Auth\ForgotPasswordController@sellerPasswordRecoverUpdate')->name('seller.password.recoverUpdate');


// Authenticate routes & check role vendor
route::group(['middleware' => ['auth:vendor'], 'prefix' => 'seller'], function(){

	// transaction
	Route::get('payment/setting', 'TransactionController@paymentSetting')->name('vendor.paymentSetting');
	Route::post('payment/setting', 'TransactionController@paymentSettingUpdate')->name('vendor.paymentSetting');
	Route::get('transactions', 'TransactionController@vendor_transactions')->name('vendor.transactions');

	//namespace 
	route::group(['namespace' => 'Vendor'], function(){

	Route::get('/', 'VendorController@dashboard')->name('vendor.dashboard');

	// shop page setting routes
	Route::get('shop/section', 'ShopSectionController@index')->name('vendor.shop-setting');
	Route::post('shop/section/store', 'ShopSectionController@store')->name('vendor.shopSection.store');
	Route::get('shop/section/edit/{id}', 'ShopSectionController@edit')->name('vendor.shopSection.edit');
	Route::post('shop/section/update', 'ShopSectionController@update')->name('vendor.shopSection.update');
	Route::get('shop/section/delete/{id}', 'ShopSectionController@delete')->name('vendor.shopSection.delete');

	Route::get('shop/section/get/single-product', 'ShopSectionController@getSingleProduct')->name('vendor.getSingleProduct');

	Route::get('shop/section/sorting', 'ShopSectionController@homepageSectionSorting')->name('vendor.shopSectionSorting');

	Route::get('profile', 'VendorController@profileEdit')->name('vendor.profile');
	Route::post('profile/update', 'VendorController@profileUpdate')->name('vendor.profileUpdate');
	Route::get('change-password', 'VendorController@passwordChange')->name('vendor.change-password');
	Route::post('change-password', 'VendorController@passwordUpdate')->name('vendor.change-password');
	Route::get('logo-banner', 'VendorController@logoBanner')->name('vendor.logo-banner');
	Route::post('logo-banner', 'VendorController@logoBannerUpdate')->name('vendor.logo-banner');


	// brand routes
	Route::get('brand', 'BrandController@index')->name('vendor.brand');
	Route::post('brand/store', 'BrandController@store')->name('vendor.brand.store');
	Route::get('brand/list', 'BrandController@index')->name('vendor.brand.list');
	Route::get('brand/edit/{id}', 'BrandController@edit')->name('vendor.brand.edit');
	Route::post('brand/update', 'BrandController@update')->name('vendor.brand.update');
	Route::get('brand/delete/{id}', 'BrandController@delete')->name('vendor.brand.delete');

	
	//b2b product
	
		Route::get('b2b/upload', 'VendorProductController@b2bupload')->name('vendor.b2b.upload');
	Route::post('b2b/store', 'VendorProductController@b2bstore')->name('vendor.b2b.store');
	Route::get('b2b/list/{status?}', 'VendorProductController@b2b')->name('vendor.b2b.list');
	Route::get('b2b/edit/{id}', 'VendorProductController@b2bedit')->name('vendor.b2b.edit');
	Route::post('b2b/update/{product_id}', 'VendorProductController@b2bupdate')->name('vendor.b2b.update');
	
	
	// product routes
	Route::get('product/upload', 'VendorProductController@upload')->name('vendor.product.upload');
	Route::post('product/store', 'VendorProductController@store')->name('vendor.product.store');
	Route::get('product/list/{status?}', 'VendorProductController@index')->name('vendor.product.list');
	Route::get('product/edit/{id}', 'VendorProductController@edit')->name('vendor.product.edit');
	Route::post('product/update/{product_id}', 'VendorProductController@update')->name('vendor.product.update');
	Route::get('product/delete/{id}', 'VendorProductController@delete')->name('vendor.product.delete');

	//upload product gallery image
	Route::get('product/gallery/image/{product_id}', 'VendorProductController@getGalleryImage')->name('vendor.product.getGalleryImage');
	Route::post('product/gallery/image', 'VendorProductController@storeGalleryImage')->name('vendor.product.storeGalleryImage');
	Route::get('product/gallery/image/delete/{id}', 'VendorProductController@deleteGalleryImage')->name('vendor.product.deleteGalleryImage');



//b2b order routes
	Route::get('b2b/order/{status?}', 'VendorOrderController@b2borderHistory')->name('vendor.b2borderList');
	Route::get('b2b/order/search/{status?}', 'VendorOrderController@b2borderHistory')->name('vendor.b2borderSearch');
	Route::get('b2b/order/invoice/{order_id?}', 'VendorOrderController@b2borderInvoice')->name('vendor.b2borderInvoice');
	Route::get('b2b/order/return/{order_id?}', 'VendorOrderController@b2borderReturn')->name('vendor.b2borderReturn');
	Route::get('b2b/order/details/{order_id}', 'VendorOrderController@b2bshowOrderDetails')->name('b2bgetVendorOrderDetails');




	//order routes
	Route::get('order/{status?}', 'VendorOrderController@orderHistory')->name('vendor.orderList');
	Route::get('order/search/{status?}', 'VendorOrderController@orderHistory')->name('vendor.orderSearch');
	Route::get('order/invoice/{order_id?}', 'VendorOrderController@orderInvoice')->name('vendor.orderInvoice');
	Route::get('order/return/{order_id?}', 'VendorOrderController@orderReturn')->name('vendor.orderReturn');
	Route::get('order/details/{order_id}', 'VendorOrderController@showOrderDetails')->name('getVendorOrderDetails');
	//change order status
	Route::get('order/status/change', 'VendorOrderController@changeOrderStatus')->name('vendor.changeOrderStatus');
	Route::get('order/cancel/form/{order_id}', 'VendorOrderController@orderCancelForm')->name('vendor.orderCancel');
	Route::post('order/cancel', 'VendorOrderController@orderCancel')->name('vendor.orderCancel');

	Route::get('withdraw', 'VendorWalletController@sellerWithdrawHistory')->name('vendor.withdrawHistory');
	Route::post('withdraw/request', 'VendorWalletController@sellerWithdrawRequest')->name('vendor.withdrawRequest');

	//affiliate route
	route::get('affiliate/products/{status?}', 'AffiliateSellerController@affiliateProducts')->name('vendor.affiliateProducts');
	//get product ajax request
	Route::get('get/affiliate/all-product', 'AffiliateSellerController@getAllProducts')->name('vendor.affiliateGetAllProducts');
	Route::match(['get', 'post'], 'affiliate/product/store', 'AffiliateSellerController@affiliateProductStore')->name('vendor.affiliateProductStore');
	Route::get('affiliate/product/remove/{id}', 'AffiliateSellerController@affiliateProductRemove')->name('vendor.affiliateProductRemove');
	Route::get('affiliate/set/product/price', 'AffiliateSellerController@setProductPrice')->name('vendor.setProductPrice');

	});
});


