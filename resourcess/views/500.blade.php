@extends('layouts.frontend')
@section('title', 'Techinal Issue Arise')
@section('metatag')
    <meta name="title" content="500 interval server error">
    <meta name="description" content="{{Config::get('siteSetting.description')}}">
    <meta name="keywords" content="{{Config::get('siteSetting.meta_keywords')}}" />
@endsection
@section('css')
<style type="text/css">   
/*======================
    505 page
=======================*/
.page_404{ padding:40px 0; background:#fff; font-family: 'Arvo', serif;}
.page_404  img{ width:100%;}
.four_zero_four_bg{
 background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);height: 400px;background-position: center;}
.four_zero_four_bg h1{font-size:80px;}
.four_zero_four_bg h3{font-size:80px;}
.link_404{color: #fff!important;padding: 10px 20px;background: #39ac31;margin: 20px 0;display: inline-block;}
.contant_box_404{ margin-top:-50px;}
</style>
@endsection
@section('content')
<section class="page_404">
    <div class="container">
        <div class="row">   
        <div class="col-sm-12 ">
        <div class="col-sm-10 col-sm-offset-1  text-center">
        <div class="four_zero_four_bg">
            <h1 class="text-center ">Techinal Issue Arise</h1>
        </div>
        <div class="contant_box_404">
            <h3 class="h2">
           Ops! Really Sorry .We Are Facing Some Techinal Issues
            </h3>
            <p>The page you are looking currently unavailable</p>
            <a href="{{url('/')}}" class="link_404">Go to Home</a>
        </div>
        </div>
        </div>
        </div>
    </div>
</section>
<?php  
$products = App\Models\Product::join('order_details', 'products.id', 'order_details.product_id')
  ->where('status', 'active')
  ->selectRaw('products.id, title,selling_price,discount,discount_type,slug,feature_image,count(order_details.product_id) as total_sale')
  ->groupBy('order_details.product_id')
  ->orderBy('total_sale', 'desc')
   ->take(12)
  ->get();
?>
  <section style="margin-bottom: 10px;">
    <div class="container">
      <div class="products-list grid row number-col-6 so-filter-gird" >
         <h3 class="modtitle" style="margin:10px 0 0">Just For You</h3>
          @foreach($products as $product)
          <div class="product-layout col-lg-2 col-md-2 col-sm-4 col-xs-6">
              @include('frontend.homepage.products')
          </div>
          @endforeach
      </div>
    </div>
  </section>
@endsection