@extends('layouts.frontend')
@section('title',  $offerType->title)
@section('metatag')
    <meta name="title" content="{{$offerType->title }}">
    <meta name="description" content="{{$offerType->title }}">
 
    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta property="og:description" content="{{$offerType->title }}">
    <meta property="og:description" content="{{$offerType->title }}">
    <meta property="og:image" content="{{asset('upload/images/offer/'.$offerType->image)}}">
    <meta property="og:url" content="{{ url()->full() }}">
    <meta property="og:site_name" content="{{$offerType->title}}">

    <!-- Schema.org for Google -->

    <meta itemprop="title" content="{{$offerType->title }}">
    <meta itemprop="description" content="{{$offerType->title }}">
    <meta itemprop="image" content="{{asset('upload/images/offer/'.$offerType->image)}}">

    <!-- Twitter -->
    <meta name="twitter:card" content="{{$offerType->title }}">
    <meta name="twitter:title" content="{{$offerType->title }}">
    <meta name="twitter:description" content="{{$offerType->title }}">
    <meta name="twitter:site" content="{{url('/')}}">
    <meta name="twitter:creator" content="@Neyamul">
    <meta name="twitter:image:src" content="{{asset('upload/images/offer/'.$offerType->image)}}">

@endsection
@section('css')
<style type="text/css">

.progress{background-color: #f5f5f5eb;}
.progress-bar{background-color: #c5e3fb;color: #fc2828;}
.common-home .label-sale{width: 100%;
right: -75px;
top: 8px !important;
font-weight: 600;
border: 1px solid red;
color: #fffcfc;
background: #ff3839;
transform: rotateZ(45deg);
}
@-webkit-keyframes blinker {
from {opacity: 1.0;}
to {opacity: 0.1;}
}
.blink{text-decoration: blink;-webkit-animation-name: blinker;-webkit-animation-duration: 0.7s;-webkit-animation-iteration-count:infinite;-webkit-animation-timing-function:ease-in-out;-webkit-animation-direction: alternate; color: #ffbc00}
.liveBox{ position: absolute; color: red; font-size: 20px; top: -20px; right: 15px;
}
.liveBtn { transition: auto; display: inline-block;font-weight: 800;color: #fff;margin-top: 8px;
}
.offer_area { height: 155px; border-top-right-radius: 75px; border-top-left-radius: 75px; border-bottom-right-radius: 75px; border-bottom-left-radius: 75px; width: 100%; text-align: center; padding-top: 10px; margin-top: 20px; margin-bottom: 60px; position: relative;
}
.offer-info{text-align: left;display: inline-block;padding: 10px;border-radius: 5px;margin-bottom: 10px;}
.offer-info p{line-height: 16px;}
.offer-left-right{margin-top: 25px !important;}
.offer-left-right .caption{min-height: 50px;overflow: hidden;line-height: normal;text-align: center;}
.offer-left-right .caption a{color: #da154a !important;font-weight: 600;
font-size: 12px;}
.offer-top-product{left: 50%;transform: translate(-50%, -50%);position: absolute;}
.offer-image_area{width: 100%; overflow: hidden; border-radius: 4px; padding: 5px 15px; background: #fff;}
.offer-image_area img{width: 100%;height: 100%}
.offer-title{color: #000;height: 48px;padding:15px; margin-top: 30px; overflow: hidden;}
.offer_area p{color: #000; font-size: 25px; margin-bottom: 100%}
@media (max-width: 768px) {
.offer-title p{font-size: 20px;}
.offer-top-product{width: 80%;}
.offers{background-size: inherit !important;}
.offer_area{margin-top: 20px;padding-top: 10px; margin-bottom: 65px; border-top-right-radius: 25px;
border-top-left-radius: 25px;
border-bottom-right-radius: 25px;
border-bottom-left-radius: 25px;}
}

.offer_box{padding: 10px 10px;border-radius: 5px; display: block;}
.offer_box:hover{box-shadow: 0 4px 7px 0 rgb(0 0 0 / 25%);}
.count{ display: inline-flex; margin: 0 auto; text-align: center; align-items: center;}
.count_d {position: relative;width: 45px;border: 1px solid #ccc; border-radius: 5px;padding: 0px 0px 5px;margin: 0px 3px;overflow: hidden;}
.count_d:before{ content: '';  position: absolute;top: 0;left: 0;width: 100%;height: 50%;}
.count_d span { display: block; text-align: center; font-size: 14px; font-weight: 800;}
.count_d h2 { display: block; text-align: center; font-size: 7px; font-weight: 800; text-transform: uppercase; margin: 0;}
.irotate {  text-align: center;  margin: 0 auto; display: block;}
.thisis { display: inline-block; vertical-align: middle; }
.slidem { text-align: center; min-width: 90px;}
.offerTitle{color: #ff6e26;font-size: 24px;font-family: OpenSans;display: inline-block !important; font-weight: 600; padding-right: 10px;}
.common-home .label-sale{width: 100%;
right: -90px;
top: 12px !important;
font-weight: 600;
border: 1px solid red;
color: #fffcfc;
background: #ff3839;
transform: rotateZ(45deg);
}
@media (max-width: 768px) {
    .common-home .label-sale{right: -58px;
    top: 8px !important;}
}
h3::after {
    content: "";
    position: absolute;
    left: 0px;
    top: 50%;
    width: 8px;
    height: 100%;
    border-radius: 0px 4px 4px 0px;
    background: rgb(29 157 217);
    transform: translateY(-50%);
}.offerTitleArea{padding: 5px 0;border-radius: 5px;margin: 10px 0 0px;box-shadow: 1px 0px 6px -4.6px;}
    .offerTitleArea .col-xs-6{padding-left: 12px;} .offerTitleArea h3{ font-weight: bold;font-size: 1.7rem;margin:5px 0 0; color:{{$offerType->text_color}};}
</style>
@endsection
@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <ul class="breadcrumb-cate">
                <li><a href="{{url('/')}}"><i class="fa fa-home"></i> </a></li>
                <li><a href="{{route('offers')}}" class="offerTitle">Offers</a> {{$offerType->title}}</li>
            </ul>
        </div>
    </div> 
    <section  style=" @if($offerType->slug == 'jowar-bhata') background: url(https://data.whicdn.com/images/345496465/original.gif); background-size: cover; min-height: 680px; @else background:{{$offerType->background_color}}; @endif color:{{$offerType->text_color}}; ">
         <div class="container" style="padding-top: 10px;">
            <a href="{{route('offers', $offerType->slug)}}" target="_self">
            <img class="responsive" style="width: 100%" src="{{asset('upload/images/offer/banner/'. $offerType->banner)}}" alt="slider image">
            </a>
        </div>
     @if($offerType && count($offerType->offers)>0)
        <div class="container" style="border-radius: 3px;padding: 10px 5px;"> 
            @foreach($offerType->offers as $offer)
            @php
                $offer_products = App\Models\Product::join('offer_products', 'products.id', 'offer_products.product_id')
                ->where('offer_id', $offer->id)
                ->selectRaw('offer_discount as discount, offer_products.discount_type,fake_sale,offer_quantity, offer_id, products.id,title,slug,selling_price,stock,feature_image,product_type')
                ->where('offer_products.status', 'active');
                if($offer->offer_type == 'jowar-bhata'){
                    $offer_products =  $offer_products->take(6)->inRandomOrder()->get();
                }else{
                    $offer_products = $offer_products->orderBy('offer_products.position', 'asc')->take(6)->get();
                }
            @endphp
            @if(count($offer_products)>0)
                <a href="{{route('offer.details', $offer->slug)}}" target="_self">
                <img class="responsive" src="{{asset('upload/images/offer/banner/'. $offer->banner)}}" alt="">
                </a>
                <div class="row offerTitleArea">
                    <div class="col-xs-6">
                    <h3>{{$offer->title}}  @if(now() <= $offer->start_date) <sup class="blink">Upcomming</sup>  @elseif(now() >= $offer->start_date && now() <= $offer->end_date)  <sup class="blink" style="color:#ff0712"> Live @else @endif</sup></h3>
                    @if(now() <= $offer->start_date)
                        <div class="liveBtn">
                         
                          <div class="head clockdiv" id="offerDate" data-date="{{Carbon\Carbon::parse($offer->start_date)->format('m,d,Y H:i:s')}}">
                            <div class="count">
                              <div class="count_d" style=" color: {{$offer->text_color}}">
                                <span class="days">00</span>
                                <h2>Days</h2>
                              </div>
                              <div class="count_d" style=" color: {{$offer->text_color}}">
                                <span class="hours">00</span>
                                <h2>HOURS</h2>
                              </div>
                              <div class="count_d" style=" color: {{$offer->text_color}}">
                                <span class="minutes">00</span>
                                <h2>MINUTES</h2>
                              </div>
                              <div class="count_d" style=" color: {{$offer->text_color}}">
                                <span class="seconds" style=" color: {{$offer->text_color}}">00</span>
                                <h2>SECONDS</h2>
                              </div>
                            </div>
                          </div>
                        </div>
                    @elseif(now() >= $offer->start_date && now() <= $offer->end_date)
                        <div class="liveBtn">
                          
                          <div class="head clockdiv" id="offerDate" data-date="{{Carbon\Carbon::parse($offer->end_date)->format('m,d,Y H:i:s')}}">
                            <div class="count">
                              <div class="count_d" style=" color: {{$offer->text_color}}">
                                <span class="days">00</span>
                                <h2>Days</h2>
                              </div>
                              <div class="count_d" style=" color: {{$offer->text_color}}">
                                <span class="hours">00</span>
                                <h2>HOURS</h2>
                              </div>
                              <div class="count_d" style=" color: {{$offer->text_color}}">
                                <span class="minutes">00</span>
                                <h2>MINUTES</h2>
                              </div>
                              <div class="count_d" style=" color: {{$offer->text_color}}">
                                <span class="seconds" style=" color: {{$offer->text_color}}">00</span>
                                <h2>SECONDS</h2>
                              </div>
                            </div>
                          </div>
                        </div>
                    @else
                        <span class="liveBtn" style="padding: 8px 20px 23px;">  @if($offer->offer_type == 'quiz') Quiz @else Offer @endif Closed</span>
                    @endif
                    </div>
                    <div class="col-xs-6">
                    <span class="moreBtn" style="background: hsl(87, 60%, 40%);padding: 5px 0px;margin-top: 15px;border: 1px solid #000; box-shadow: 1px 1px 3px -1px #fff"><a href="{{route('offer.details', $offer->slug)}}" style="color:#fff;padding: 5px 10px;">View Details</a></span></div>
                </div>
                
                <div class="clearfix module horizontal">
                    <div class="products-category">
                        <div class="category-slider-inner products-list yt-content-slider releate-products grid" data-rtl="yes" data-autoplay="no" data-pagination="no" data-delay="4" data-speed="0.6" data-margin="5" data-items_column0="5" data-items_column1="4" data-items_column2="2" data-items_column3="2" data-items_column4="2" data-arrows="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
                        @foreach($offer_products as $index => $product)
                            @if($offer->offer_type == 'kanamachi')
                            <div class="product-layout">
                                <div class="product-item-container">
                                    <div class="left-block"> 
                                        <div class="product-image-container">
                                            <img src="{{asset('upload/images/product/thumb/'. $product->feature_image)}}" class="img-1 img-responsive">
                                            <span class="quickview iframe-link visible-lg btn-button" data-toggle="tooltip" title="" data-fancybox-type="iframe" href="{{route('quickview', $product->slug)}}?type=kanamachi" data-original-title="Quickview "> <i class="fa fa-search"></i> </span>
                                        </div>
                                    </div>
                                    <div class="right-block">
                                        <div class="caption">
                                            <h4> <a href="{{route('offer.details', $offer->slug)}}">{{Str::limit($product->title, 40)}}</a></h4>
                                            <div class="total-price clearfix" style="min-height: 54px;">
                                                <div class="price price-left">
                                                    <label for="ratting5">{{\App\Http\Controllers\HelperController::ratting(round($product->reviews->avg('ratting'), 1))}}</label><br/>
                                                    <?php
                                                        $selling_price = $product->selling_price;
                                                        $discount_price = $offer->discount;
                                                        $percantage =  $product->selling_price -  $discount_price;
                                                        $percantage = round(((($selling_price - $percantage) - $selling_price) / $selling_price) * 100, 0); 
                                                    ?>
                                                    <span class="price-new">{{Config::get('siteSetting.currency_symble')}}{{ $discount_price }}</span>
                                                    <span class="price-old">{{Config::get('siteSetting.currency_symble')}}{{round($selling_price)}}</span>                    
                                                </div>
                                                <div class="price-sale price-right">
                                                    <span class="discount">
                                                      {{$percantage}}%
                                                    <strong>OFF</strong>
                                                  </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                          
                            <div class="product-layout">
                                <div class="product-item-container">
                                    <div class="left-block">
                                        <div class="product-image-container">
                                            <a href="{{ route('product_details', $product->slug) }}?offer={{$offer->slug}}" >
                                            <img src="{{asset('upload/images/product/thumb/'. $product->feature_image)}}" alt="{{$product->title}}" class="img-1 img-responsive">
                                            </a>
                                             <span class="quickview iframe-link visible-lg btn-button" data-toggle="tooltip" title="" data-fancybox-type="iframe" href="{{route('quickview', $product->slug)}}?type=quickview&offer={{$offer->slug}}" data-original-title="Quickview "> <i class="fa fa-search"></i> </span>
                                            @if($product->stock <= 0)
                                            <div class="box-label">
                                            <span class="label-sale">Sold Out</span>
                                            </div>
                                            @endif
                                        </div>
                                    </div> 
                                    <div class="right-block">
                                        <div class="caption">
                                            <h4><a href="{{ route('product_details', $product->slug) }}?offer={{$offer->slug}}">{{Str::limit($product->title, 40)}}</a></h4>
                                            <div class="total-price clearfix">
                                                <div class="price price-left">
                                                     <label for="ratting5">{{\App\Http\Controllers\HelperController::ratting(round($product->reviews->avg('ratting'), 1))}}</label><br/>
                                                    <?php
                                                    $selling_price = $product->selling_price;
                                                    $discount = $product->discount;
                                                    $discount_type = $product->discount_type;
                                                    
                                                    if($discount_type == '%'){
                                                        $price = $selling_price - ( $discount * $selling_price) / 100; 
                                                    }elseif($discount_type == 'fixed'){
                                                        $price = $discount;
                                                        $discount = $selling_price - $discount;
                                                        //make persentage
                                                        $discount = round(((($selling_price-$discount) - $selling_price)/$selling_price) * 100);
                                                      
                                                    }else{
                                                        $price = $selling_price - $discount;
                                                        //make persentage
                                                        $discount = round(((($selling_price-$discount) - $selling_price)/$selling_price) * 100);
                                                    }
                                                    ?>

                                                   @if($discount)
                                                        <span class="price-new">{{Config::get('siteSetting.currency_symble')}}{{ $price }}</span>
                                                        <span class="price-old">{{Config::get('siteSetting.currency_symble')}}{{ round($selling_price) }}</span>
                                                    @else
                                                        <span class="price-new">{{Config::get('siteSetting.currency_symble')}}{{$selling_price}}</span>
                                                    @endif
                                                    </div>
                                                    @if($discount)
                                                    <div class="price-sale price-right">
                                                        <span class="discount">
                                                          @if($discount_type == '%')-@endif{{$discount}}%
                                                        <strong>OFF</strong>
                                                      </span>
                                                    </div>
                                                    @endif
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                        </div>
                    </div>
                </div>
                
            @endif
            @endforeach
        </div>
    @else
        <div style="text-align: center;">
            <i style="font-size: 70px;" class="fa fa-shopping-cart"></i>
             <h1>Sorry at this moment any {{$offerType->title}} @if($offerType->offer_type == 'quiz') Quiz @else Offer @endif not available.</h1>
            Click here <a href="{{route('offers')}}">Back To All Offer</a>
        </div>
    @endif
    </section>
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