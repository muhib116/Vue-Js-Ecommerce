<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Slider;

Route::get('/slider', function(){
    $slider = Slider::where('status', 1)->where('type', 'homepage')->orderBy('position', 'asc')->get();
    if(count($slider)){
        return $slider->toJson();
    }
});


Route::get('cart/add', 'CartController@cartAdd')->name('cart.add');
Route::get('cart', 'CartController@cartView')->name('cart');
Route::get('cart/update', 'CartController@cartUpdate')->name('cart.update');
Route::get('cart/item/remove/{id}', 'CartController@itemRemove')->name('cart.itemRemove');
Route::get('cart/remove/allitem', 'CartController@clearCart')->name('cart.clear');
Route::get('cart/view/header', 'AjaxController@getCartHead')->name('getCartHead');
