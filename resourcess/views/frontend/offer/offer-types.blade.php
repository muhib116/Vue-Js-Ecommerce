@extends('layouts.frontend')
@section('title', 'Offers')
@section('metatag')
    <meta name="title" content="{{Config::get('siteSetting.site_name') .' | Offers'}}">
    <meta name="description" content="{{Config::get('siteSetting.site_name') .' | Offers'}}">
 
    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta property="og:description" content="{{Config::get('siteSetting.site_name') .' | Offers'}}">
    <meta property="og:description" content="{{Config::get('siteSetting.site_name') .' | Offers'}}">
    <meta property="og:image" content="{{asset('upload/images/offer/thumbnail/'.$offerColor->thumb_image)}}">
    <meta property="og:url" content="{{ url()->full() }}">
    <meta property="og:site_name" content="{{Config::get('siteSetting.site_name')}}">

    <!-- Schema.org for Google -->

    <meta itemprop="title" content="{{Config::get('siteSetting.site_name') .' | Offers'}}">
    <meta itemprop="description" content="{{Config::get('siteSetting.site_name') .' | Offers'}}">
    <meta itemprop="image" content="{{asset('upload/images/offer/thumbnail/'.$offerColor->thumb_image)}}">

    <!-- Twitter -->
    <meta name="twitter:card" content="{{Config::get('siteSetting.site_name') .' | Offers'}}">
    <meta name="twitter:title" content="{{Config::get('siteSetting.site_name') .' | Offers'}}">
    <meta name="twitter:description" content="{{Config::get('siteSetting.site_name') .' | Offers'}}">
    <meta name="twitter:site" content="{{url('/')}}">
    <meta name="twitter:creator" content="@Neyamul">
    <meta name="twitter:image:src" content="{{asset('upload/images/offer/thumbnail/'. $offerColor->thumb_image)}}">

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


.offer_box_area ul {
    overflow-x: scroll;
    overflow-y: hidden;
    white-space: nowrap;
    margin: 0px 0 15px;
}
.offer_box_area ul > li {
    float: left;
    width: 32.3%;
    border-right: 1px solid #ebebeb;
    text-align: center;

    /* background: #fff; */
    margin-right: 12px;
    padding: 0px 8px;
    border-radius: 20px;
    text-align: left;
    position: relative;
}
.offer_box_area ul {
    -ms-overflow-style: none;
    scrollbar-width: none;
}.offer_box_area ul::-webkit-scrollbar {
  display: none;
}
@media (max-width: 991px){
.offer_box_area ul li {
    float: none !important;
    display: inline-block;
    vertical-align: top;
    white-space: normal;
    width: 100%;
}
}
.blink{position: absolute; top: -22px;
    transform: translate(0%, -0%);
    left: 40%;text-decoration: blink;-webkit-animation-name: blinker;-webkit-animation-duration: 0.7s;-webkit-animation-iteration-count:infinite;-webkit-animation-timing-function:ease-in-out;-webkit-animation-direction: alternate; color: #ffbc00}
.liveBox{ position: absolute; color: red; font-size: 20px; top: -20px; right: 15px;
}
.liveBtn { transition: auto; display: inline-block;font-weight: 800;color: #fff;transform: translate(-50%, -0%);left: 50%;position: absolute;margin-top: 8px;
}
.offer_area {height: 130px; border-top-right-radius: 25px; border-top-left-radius: 25px; border-bottom-right-radius: 25px; border-bottom-left-radius: 25px; text-align: center; padding-top: 10px; margin-top: 35px; position: relative;
}
.offer-info{text-align: left;display: inline-block;padding: 10px;border-radius: 5px;margin-bottom: 10px;}
.offer-info p{line-height: 16px;}
.offer-left-right{margin-top: 25px !important;}
.offer-left-right .caption{min-height: 50px;overflow: hidden;line-height: normal;text-align: center;}
.offer-left-right .caption a{color: #da154a !important;font-weight: 600;
font-size: 12px;}
.offer-top-product{left: 35%;transform: translate(-25%, -65%);position: absolute;}
.offer-image_area{width: 100%; overflow: hidden; border-radius: 4px; padding: 3px; background: #fff;}
.offer-image_area img{width: 100%;height: 100%}
.offer-title{color: #000;height: 48px;padding:15px; margin-top: 15px; overflow: hidden;}
.offer_area p{color: #000; font-size: 20px; margin-bottom: 100%}
@media (max-width: 768px) {
.offer-title p{font-size: 20px;}
.offer-top-product{width: 70%;}
.offers{background-size: inherit !important;}
.offer_area{margin-top: 35px;padding-top: 10px;  border-top-right-radius: 30px;
border-top-left-radius: 30px;
border-bottom-right-radius: 30px;
border-bottom-left-radius: 30px;}
}

.offer_box{padding: 10px 10px;border-radius: 5px; display: block;}
.offer_box:hover{box-shadow: 0 4px 7px 0 rgb(0 0 0 / 25%);}
.count{ display: inline-flex; margin: 0 auto; text-align: center; align-items: center;}
.count_d {position: relative;width: 50px;border: 1px solid {{$offerColor->text_color}}; border-radius: 5px;padding: 0px 0px 8px;margin: 0px 3px;overflow: hidden;}
.count_d:before{ content: '';  position: absolute;top: 0;left: 0;width: 100%;height: 50%;}
.count_d span { display: block; text-align: center; font-size: 16px; font-weight: 800;}
.count_d h2 { display: block; text-align: center; font-size: 8px; font-weight: 800; text-transform: uppercase; margin: 0;}
.irotate {  text-align: center;  margin: 0 auto; display: block;}
.thisis { display: inline-block; vertical-align: middle; }
.slidem { text-align: center; min-width: 90px;}
.offerTitle{color: #ff6e26;font-size: 24px;font-family: OpenSans;display: inline-block !important; font-weight: 600; padding-right: 10px;}

.releate-products .owl2-controls .owl2-nav .owl2-next, div.so-extraslider.grid .owl2-controls .owl2-nav .owl2-next, .releate-products .owl2-controls .owl2-nav .owl2-prev, div.so-extraslider.grid .owl2-controls .owl2-nav .owl2-prev{
    height: 65px;
    width: 30px;line-height: 65px;border-radius: 5px;font-size: 30px;
}
h3::after {
    content: "";
    position: absolute;
    left: 0px;
    top: 50%;
    width: 8px;
    height:100%;
    border-radius: 0px 4px 4px 0px;
    background: rgb(29 157 217);
    transform: translateY(-50%);
}.offerTitleArea{padding: 8px 0 0px;
    margin: 10px 0 10px;border-radius: 5px;box-shadow: 0px 1px 5px -4.6px;}
    .offerTitleArea .col-xs-6{padding-left: 12px;} .offerTitleArea h3{
        font-weight: bold;
    font-size: 1.5rem;margin:5px 0 0;color:{{$offerColor->text_color}};
    }
    section.section{margin-bottom: 15px;}
    .offer_box_area{border-radius: 5px;padding: 5px;border: 1px solid #ccc;margin-bottom: 10px;}
    .offer_box_area:hover{
    transition: all .3s ease 0s;
    -moz-box-shadow: 0 2px 4px 0 rgb(0 0 0 / 25%);
    box-shadow: 0 2px 4px 0 rgb(0 0 0 / 25%);
    transform: scale(1.0);
}
</style>
@endsection
@section('content')
    <!-- Main Container  -->
    <div class="breadcrumbs">
        <div class="container">
            <ul class="breadcrumb-cate">
                <li><a href="{{url('/')}}"><i class="fa fa-home"></i> </a></li>
                <li><span class="offerTitle">Offers</span> Get offer worry free</li>
            </ul>
        </div>
    </div> 
    <section style="padding-top: 15px; background:{{$offerColor->background_color}};color:{{$offerColor->text_color}};">
        @include('frontend.sliders.slider2')
        @if(count($offerTypes)>0)
            <div class="container">
            @foreach($offerTypes as $offerType)
                @if(count($offerType->offers)>0)
                <section class="offer_box_area">
                    <a href="{{route('offers', $offerType->slug)}}" target="_self">
                    <img class="responsive" style="width: 100%" src="{{asset('upload/images/offer/banner/'. $offerType->banner)}}" alt="slider image">
                    </a>
                    
                    <div class="row offerTitleArea">
                        <div class="col-xs-6">
                        <h3>{{$offerType->title}}</h3> <span>{{$offerType->sub_title}} </span></div>
                        @if($offerType->slug != 'jowar-bhata')
                        <div class="col-xs-6">
                        <span class="moreBtn" style="background: hsl(87, 60%, 40%);border: 1px solid #000; box-shadow: 1px 1px 3px -1px #fff"><a href="{{route('offers', $offerType->slug)}}" style="color:#fff;padding: 5px 10px;">View all offers</a></span></div>@endif
                    </div>
                    <ul>
                        @foreach($offerType->offers->take(3) as $offer)
                        <li>
                            <a href="{{route('offer.details', $offer->slug)}}">
                                <div class="offer_area" style="background:{!! ($offer->background_color) ? $offer->background_color : ' linear-gradient(#0364c7b8, #eeefcfeb)'!!};color: {!! ($offer->text_color) ? $offer->text_color : '#fff'!!}">
                                    <div class="offer-top-product">
                                        <div class="row">
                                            @if(count($offer->offer_products)>0)
                                            @foreach($offer->offer_products->take(3) as $offerProduct)
                                            <div class="col-xs-4">
                                                <div class="offer-image_area">
                                                  <img src="{{asset('upload/images/product/thumb/'. $offerProduct->product->feature_image)}}" title="{{ $offerProduct->product->title }}" alt="{{ $offerProduct->product->title }}">
                                                </div>
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="offer-title">
                                        <div class="irotate">
                                          <div class="thisis slidem">
                                            <p style="color: {{$offer->text_color}}">{{$offer->title}}</p>
                                          </div>
                                        </div>
                                    </div>
                                    @if(now() <= $offer->start_date)
                                        <div class="liveBtn">
                                          <span class="blink">Upcomming</span>
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
                                          <span class="blink" style="color:#ff0712">Live</span>
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
                            </a>
                        </li>
                        @endforeach
                    </ul>
                   
                </section>
                @endif
            @endforeach
            </div>
        @else
        <div style="text-align: center;">
            <i style="font-size: 80px;" class="fa fa-shopping-cart"></i>
             <h1>Sorry at this moment any offer not available.</h1>
            Click here <a href="{{url('/')}}">Back To Home</a>
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