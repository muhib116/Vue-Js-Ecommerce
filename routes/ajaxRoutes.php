<?php

use Illuminate\Support\Facades\Route;

route::group(['middleware' => ['auth', 'admin']], function(){

});

//get subchild category menu by main category
Route::get('get/subchildcategory/menu/{cat_id}', 'AjaxController@getSubChildMenu')->name('getSubChildMenu');

Route::get('get/subcategory/{cat_id}', 'AjaxController@get_subcategory')->name('getSubCategory');

Route::get('get/designation/{cat_id}', 'AjaxController@get_designation')->name('getDesignation');
Route::get('get/salary/{cat_id}', 'AjaxController@get_salary')->name('getSalary');
//get product sub child category by sub category ID
Route::get('get/subchild/category/{subcat_id}', 'AjaxController@get_subchild_category')->name('getSubChildCategory');

Route::get('get/attribute/{cat_id}', 'AjaxController@getAttributeByCategory')->name('getAttributeByCategory');
Route::get('get/brand/{cat_id}', 'AjaxController@getBrand')->name('getBrand');

// get product feature in product upload
Route::get('get/feature/{cat_id}', 'AjaxController@getFeature')->name('getFeature');
Route::get('create/unique/slug', 'AjaxController@createUniqueSlug')->name('slug');
//delete variation product edit page
Route::get('product/variation/delete/{id}', 'AjaxController@deleteVariation')->name('deleteVariation');
//delete data common all table
Route::get('/delete/data/common', 'AjaxController@deleteDataCommon')->name('deleteDataCommon');
//get menu source
Route::get('get/menu/sourch/{type}', 'Admin\MenuController@getMenuSourch')->name('getMenuSourch');

//get products by anyone field
Route::get('get/products/by/{field}', 'AjaxController@getProductsByField')->name('admin.getProductsByField');
Route::get('set/setAny/ItemValue', 'AjaxController@setAnyItemValue')->name('admin.setAnyItemValue');

//get search keyword in header
Route::get('search/keyword', 'AjaxController@search_keyword')->name('search_keyword');

//change status active/deactive
Route::get('status/change', 'AjaxController@satusActiveDeactive')->name('statusChange');
Route::get('status/approve/Unapprove', 'AjaxController@approveUnapprove')->name('approveUnapprove');

Route::get('currency/change', 'CurrencyController@changeCurrency')->name('changeCurrency');

//position sorting
Route::get('position/sorting', 'AjaxController@positionSorting')->name('positionSorting');


Route::get('get/state/{country_id?}', 'AjaxController@get_state')->name('get_state');
Route::get('get/city/{state_id?}', 'AjaxController@get_city')->name('get_city');
Route::get('get/area/{city_id?}', 'AjaxController@get_area')->name('get_area');