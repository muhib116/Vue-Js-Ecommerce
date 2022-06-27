@extends('layouts.frontend')
@section('title', 'Pre Order | '. Config::get('siteSetting.site_name') )
@section('css')
<style type="text/css">
    .breadcrumbTitle{color: #ff6e26;font-size: 24px;font-family: OpenSans;display: inline-block !important; font-weight: 600; padding-right: 10px;}
    .count{ display: inline-flex; margin: 0 auto; text-align: center; align-items: center;}
.count_d {position: relative;width: 57px;padding: 5px 0px 15px;margin: 0px 3px;border-radius: 50%;overflow: hidden;}
.count_d:before{ content: '';  position: absolute;top: 0;left: 0;width: 100%;height: 50%;}
.count_d span { display: block; text-align: center; font-size: 16px; font-weight: 800;}
.count_d h2 { display: block; text-align: center; font-size: 8px; font-weight: 800; text-transform: uppercase; margin: 0;}
.irotate {  text-align: center;  margin: 0 auto; display: block;}
.thisis { display: inline-block; vertical-align: middle; }
.slidem { text-align: center; min-width: 90px;}
</style>
@endsection
@section('content')
    <!-- Main Container  -->
    <div class="breadcrumbs">
        <div class="container">
            <ul class="breadcrumb-cate">
                <li><a href="{{url('/')}}"><i class="fa fa-home"></i> </a></li>
                <li class="breadcrumbTitle">Pre Order</li>
            </ul>
        </div>
    </div>
    @include('frontend.sliders.slider2')
    <div class="container">
        <div class="row">
            
            <div  class="col-md-12 col-sm-12 col-xs-12" >
                <div class="products-category">
                    @if(count($products)>0)
                        <div class="products-list grid row number-col-6 so-filter-gird">
                            @foreach($products as $product)
                            <div class="product-layout col-lg-2 col-md-3 col-sm-3 col-xs-6">
                                <?php  
                                    $discount = null;
                                    $selling_price = $product->selling_price;
                                    $discount = ($product->discount) ? $product->discount : null;
                                    $discount_type = $product->discount_type;
                                    if($discount){
                                        $calculate_discount = App\Http\Controllers\HelperController::calculate_discount($selling_price, $discount, $discount_type );
                                    }
                                ?>

                                <div  class="product-item-container">
                                    <div class="left-block ">
                                        <div class="image product-image-container">
                                            <a class="lt-image" href="{{ route('product_details', $product->slug) }}" >
                                            <img src="{{asset('upload/images/product/thumb/'. $product->feature_image)}}" class="img-1 img-responsive" alt="{{$product->title}}">
                                            @if($discount)
                                            <div class="box-label">
                                                <span class="label-sale">@if($discount_type == '%')-@endif{{$calculate_discount['discount']}}%</span>
                                            </div>
                                            @endif
                                            </a>
                                            
                                            <span title="Quickview product details" data-toggle="tooltip" class="btn-button btn-quickview quickview quickview_handler" onclick="quickview('{{$product->slug}}')" href="javascript:void(0)"> <i class="fa fa-search"></i> </span>
                                           
                                        </div>
                                        <div class="box-label">
                                        </div>
                                    </div>
                                    <div class="right-block">
                                        <div class="caption">
                                            <h4><a href="{{ route('product_details', $product->slug) }}">{{Str::limit($product->title, 40)}}</a></h4>
                                            <div class="total-price clearfix" style="visibility: hidden; display: block;">
                                                <div class="price">
                                                    <label for="ratting5">
                                                       {{\App\Http\Controllers\HelperController::ratting(round($product->reviews->avg('ratting'), 1))}}
                                                    </label><br/>
                                                    
                                                    @if($discount)
                                                        <span class="price-new">{{Config::get('siteSetting.currency_symble')}}{{ $calculate_discount['price'] }}</span>
                                                        <span class="price-old">{{Config::get('siteSetting.currency_symble')}}{{$selling_price}}</span>
                                                    @else
                                                        <span class="price-new">{{Config::get('siteSetting.currency_symble')}}{{$selling_price}}</span>
                                                    @endif
                                                </div>
                                              
                                                <div class="head clockdiv" data-date="{{Carbon\Carbon::parse($product->availability_date)->format('m,d,Y H:i:s')}}">
                                                <p><strong>Time left:</strong> <span style="color: red;"> <span class="days">00</span>:<span class="hours">00</span>:<span class="minutes">00</span>:<span class="seconds">00</span></span></p></div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="product-filter product-filter-bottom filters-panel">
                            <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                               {{$products->appends(request()->query())->links()}}
                              </div>
                            <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of total {{$products->total()}} entries ({{$products->lastPage()}} Pages)</div>
                        </div>
                    @else
                    <h3>Pre order product not available.</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script type="text/javascript">
    document.addEventListener('readystatechange', event => {
    if (event.target.readyState === "complete") {
        var clockdiv = document.getElementsByClassName("clockdiv");
        var countDownDate = new Array();
        for (var i = 0; i < clockdiv.length; i++) {
            countDownDate[i] = new Array();
            countDownDate[i]['el'] = clockdiv[i];
            countDownDate[i]['time'] = new Date(clockdiv[i].getAttribute('data-date')).getTime();
            countDownDate[i]['days'] = 0;
            countDownDate[i]['hours'] = 0;
            countDownDate[i]['seconds'] = 0;
            countDownDate[i]['minutes'] = 0;
        }
      
        var countdownfunction = setInterval(function() {
            for (var i = 0; i < countDownDate.length; i++) {
                var now = new Date().getTime();
                var distance = countDownDate[i]['time'] - now;
                 countDownDate[i]['days'] = Math.floor(distance / (1000 * 60 * 60 * 24));
                 countDownDate[i]['hours'] = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                 countDownDate[i]['minutes'] = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                 countDownDate[i]['seconds'] = Math.floor((distance % (1000 * 60)) / 1000);
                
                 if (distance < 0) {
                    countDownDate[i]['el'].querySelector('.days').innerHTML = 0;
                    countDownDate[i]['el'].querySelector('.hours').innerHTML = 0;
                    countDownDate[i]['el'].querySelector('.minutes').innerHTML = 0;
                    countDownDate[i]['el'].querySelector('.seconds').innerHTML = 0;
                 }else{
                    countDownDate[i]['el'].querySelector('.days').innerHTML = countDownDate[i]['days'];
                    countDownDate[i]['el'].querySelector('.hours').innerHTML = countDownDate[i]['hours'];
                    countDownDate[i]['el'].querySelector('.minutes').innerHTML = countDownDate[i]['minutes'];
                    countDownDate[i]['el'].querySelector('.seconds').innerHTML = countDownDate[i]['seconds'];
                }
            }
        }, 1000);
    }
});

</script>


@endsection