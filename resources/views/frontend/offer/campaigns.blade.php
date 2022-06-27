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
.block-service-home6 ul > li:last-child{border-right: none;}
.brand-thumb{position: relative;width: 100%;padding: 3px;max-height: 90px;
background: #fff;text-align: center;}
.desc-listcategoreis { color: #000;text-align: center;padding: 0px;background: #fff;}
.brand-thumb img{max-height: 100%}
.homepage .section{max-height: 400px !important; overflow: hidden;}
.homepage .products-list .product-layout {max-width: 230px;max-height: 335px; min-height: 150px;}
.price-offer{ display: block; width: 80px; text-align: center; line-height: normal;margin: 3px auto 10px;padding: 1px 0;color: #fff;font-size: 12px;background: #ff4733;border-radius: 15px;}
.img-wrap{width: 100%;height: 100px;  display: block;overflow: hidden;}
.img-wrap img{height: 100%;width: 100%;object-fit: contain;}
@-webkit-keyframes blinker {
from {opacity: 1.0;}
to {opacity: 0.1;}
}
.blink{text-decoration: blink;-webkit-animation-name: blinker;-webkit-animation-duration: 0.7s;-webkit-animation-iteration-count:infinite;-webkit-animation-timing-function:ease-in-out;-webkit-animation-direction: alternate;color: #ffbc00}
.liveBox{ position: absolute;color: red;font-size: 20px;top: -20px;right: 15px;}
.offer_section{margin-top: 66px;display: block;margin-bottom: 50px;}
.liveBtn {width: 275px;height: 105px;position: absolute;transform: translate(-50%, 0%);background: #121213bd; display: inline-block;border-radius: 50%;font-weight: 800;color: #fff;}
.offer_area { height: 150px;position: relative;background: linear-gradient(#0364c7b8, #eeefcfeb);border-top-right-radius: 75px;border-top-left-radius: 75px; border-bottom-right-radius: 75px; border-bottom-left-radius: 75px;width: 100%;text-align: center;display: inline-block;}
.offer-left-right{margin-top: 25px !important;}
.offer-left-right .caption{min-height: 50px;overflow: hidden;line-height: normal;text-align: center;}
.offer-left-right .caption a{color: #da154a !important;font-weight: 600;
font-size: 12px;}
.offer-top-product{left: 50%;transform: translate(-50%, -50%);position: absolute;}
.offer-image_area{width: 100%; overflow: hidden; border-radius: 4px; padding: 5px 15px; background: #fff;}
.offer-image_area img{width: 100%;height: 100%}
.offer-title{color: #000;height: 48px;padding:15px; margin-top: 50px; overflow: hidden;}
.offer_area h1{color: #000; font-size: 25px; margin-bottom: 100%;font-weight: 500;}
@media (max-width: 512px) {
.offer-title h1{font-size: 20px;}
.offer-top-product { left: 20%; transform: translate(-10%, -50%); }
.offer_section{margin: 30px 0 50px;}
.offer_area{margin-top: 0px;margin-bottom: 0px; border-top-right-radius: 25px; border-top-left-radius: 25px; border-bottom-right-radius: 25px;
border-bottom-left-radius: 25px;}
.offer_area{height: 135px;}
.offer-title{margin-top: 35px;}
}

.count{
  display: inline-flex;margin: 0 auto;text-align: center;align-items: center;}
.count_d { position: relative; width: 57px;padding: 10px 0px;margin: 0px 3px;background-image: linear-gradient(to right, #4e0c25 ,#8e0d3c,#0a060e);color: #eef1f5; border-radius: 50%;overflow: hidden;
} 
.count_d:before{ content: ''; position: absolute; top: 0;left: 0;width: 100%;height: 50%;}
.count_d span {display: block;text-align: center;font-size: 15px; font-weight: 800;}
.count_d p {display: block;text-align: center;font-size: 8px;font-weight: 800;text-transform: uppercase;margin: 0;line-height: 1;}
.irotate {text-align: center;margin: 0 auto;display: block;
    }
    .thisis { display: inline-block;vertical-align: middle;}
    .slidem {text-align: center;min-width: 90px;}
    .catSection{ background: #EADAEB; padding:10px 10px 15px; margin-bottom: 10px; border-radius: 3px;}
    .cat-title{ color: #333; text-transform: capitalize; font-size: 14px;}
    .catSection img{border-radius: 5px;}
    .catSection:hover{ box-shadow: 0 2px 4px 0 rgba(0,0,0,.25); }
    .block-service-home6 ul > li:hover{transition: all .3s ease 0s;
    -moz-box-shadow: 0 2px 4px 0 rgb(0 0 0 / 25%);
    box-shadow: 0 2px 4px 0 rgb(0 0 0 / 25%);
    
}
</style>



<style type="text/css">
.mainArea{position: relative;}
#pageloaderOpend{width: 100%;height: 100%;top: 0;display: none;position: fixed;z-index: 9999999999;background: #ffffff2e}
/*process bar*/
.pace{-webkit-pointer-events:none;pointer-events:none;-webkit-user-select:none;-moz-user-select:none;user-select:none}.pace-inactive{display:none}.pace .pace-progress{background:#07c10d;position:fixed;z-index:2000;top:0;right:100%;width:100%;height:2px}
.card {border-radius: 5px;}
#content{position: relative;}
/*mobile menu*/
.bottom-nav { display: flex; position: fixed; bottom: 0;left: 0;right: 0;padding: 0.8rem 0;background-color: #fff;z-index: 9999999999;line-height: 1.42857143;will-change: transform;transform: translateZ(0);box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 3px rgba(0, 0, 0, 0.24);}
.bottom-nav-item {display: flex;flex-direction: column;flex-grow: 1;justify-content: center;text-align: center;font-size: 0.8rem;color: #525252;font-weight: 600; position: relative;}
.bottom-nav-link {display: flex;flex-direction: column;}
.bottom-nav-link i{font-size: 20px;}
.bottom-nav-link .active {color: #d32f2f;} @media (max-width: 768px) {#searchKey{border-radius: 4px 0px 0px 4px;}.footer-container{margin-bottom: 48px;}.back-to-top{bottom: 50px;}}
.typeheader-6 { background:#0a0704; color: rgb(255, 255, 255) !important }
.typeheader-6 .megamenu-style-dev .horizontal ul.megamenu > li > a { color: rgb(255, 255, 255) }
  #getCartHead {color: #777;}
.typeheader-6 .header_custom_link .compare a {background: url('https://woadi.com/frontend/image/icon/icon-compare2.png') no-repeat center;}
.typeheader-6 .header_custom_link .wishlist a {background: url('https://woadi.com/frontend/image/icon/icon-wishlist2.png') no-repeat center;}
.typeheader-6 .header-cart h2.title-cart2{color:rgb(255, 255, 255);}
.typeheader-6 .header-cart .btn-shopping-cart .fa-check-circle, .header-top a, .typeheader-6 .header-cart .btn-shopping-cart .cart-total-full{color: rgb(255, 255, 255) !important;}
.typeheader-6 .header-top{background: #0a0704; color: rgb(255, 255, 255) }
.dropdown-menu > li > a{color: #000 !important}
#typeheadsection{z-index: 999999; width: 100%;height: 100%;top: 50%; left: 50%;ransform: translate(-50%, -50%);text-align: center;position: fixed; background: #e6e4e4 url('https://woadi.com/assets/images/loading.gif') no-repeat center;}    
#dataLoading{z-index: 999999;  width: 100%;  height: 100%; top: 50%;  left: 50%; text-align: center; display: none;
transform: translate(-50%, -50%); position: absolute; background: #ffffffe0 url('https://woadi.com/frontend/image/loading.gif') no-repeat center;}
#loadingData { z-index: 999999; width: 100%; height: 100%; top: 50%; left: 50%; transform: translate(-50%, -50%); display: none; position: absolute; background: url('https://woadi.com/assets/images/loading.gif') no-repeat center; }
.loadingData-sm { z-index: 9999; width: 100%; height: 20px; background: url('https://woadi.com/assets/images/loader.gif') no-repeat center; }
#process{  display: none; width: 100%; position: absolute; height: 100%; z-index: 9999; background: #ffffffb3 url('https://woadi.com/assets/images/loader.gif') no-repeat center; }
.footer_area{background: #160606; color: rgb(243, 243, 243) }
.footer_area span,  .footer_area a,  .footer_area h4,  .footer_area i{color: rgb(243, 243, 243) !important; }
.footer_area .title-footer{border-bottom:1px solid rgb(243, 243, 243) !important; }
.footer_area li a:before{background: rgb(243, 243, 243) !important;}
.copyright_area{ background: #000000 !important; color: #f0f0f0 !important; }
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
    <section style="background:{{$offerColor->background_color}};color:{{$offerColor->text_color}};">
        @if(count($offerTypes)>0)
        <div class="row" >
            <div class="container">
             @foreach($offerTypes as $campaign)
			 
			
			<section style=" padding:5px;">
								<div class="container" style="background:#ffffff;border-radius: 3px; padding: 5px;">
									<div class="row">
										<div class="col-md-12 col-xs-12" style="margin-bottom: 10px;">
											<div class="banner-layout-5 clearfix">
												<div class="banner-22  banners">
													<div> <a title="{{$campaign->title}}" href="{{route('offers', $campaign->slug)}}">
													
													
													
													@if(is_file(public_path('upload/images/offer/banner/'. $campaign->banner)))
												
												<img src="{{asset('upload/images/offer/banner/'. $campaign->banner)}}" alt="{{$campaign->title}}"> 
												@else
													
												<img src="{{asset('upload/images/logo/'.Config::get('siteSetting.logo'))}}" alt="{{$campaign->title}}"> 
												@endif
													</a> </div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
							
							
							
							@php
							
							$offer = \App\Models\Offer::where('offer_type', $campaign->slug)->where('status', 1)->where('end_date', '>=', \Carbon\Carbon::now())->where('start_date', '<=', \Carbon\Carbon::now())->get();
							
							@endphp
							<section class="section">
								<div class="container" style="background:#ffffff;border-radius: 5px; padding:5px;"> <div class="row">
										<div class="col-md-12 col-xs-12">
								<div class="clearfix module horizontal">
												<div class="products-category">
													<div class="category-slider-inner products-list yt-content-slider releate-products grid owl2-carousel owl2-theme owl2-responsive-1200 owl2-loaded" data-rtl="yes" data-autoplay="yes" data-pagination="no" data-delay="1" data-speed="1.5" data-margin="5" data-items_column0="6" data-items_column1="6" data-items_column2="6" data-items_column3="3" data-items_column4="2" data-arrows="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
														<div class="owl2-stage-outer">
															<div class="owl2-stage" style="transform: translate3d(-1375.5px, 0px, 0px); transition: all 1.5s ease 0s; width: 3733.5px;">
							@foreach($offer as $offers)
											
									<div class="owl2-item cloned" style="width: 191.5px; margin-right: 5px;">
																	<div class="item-inner product-thumb trg transition product-layout">
																		<div class="product-item-container">
																			<div class="left-block ">
																				<div class="image product-image-container"> <a class="lt-image" href="{{route('offer.details', $offers->slug)}}"> <img src="{{ asset('upload/images/offer/thumbnail/'.$offers->thumbnail) }}" class="img-1 img-responsive" alt="{{$offers->title}}">  </a> </div>
																				<div class="box-label"> </div>
																			</div>
																			<div class="right-block">
																				<div class="caption">
																					<h4><a href="{{route('offer.details', $offers->slug)}}">{{$offers->title}}</a></h4>
																				
																				</div>
																			</div>
																		</div>
																	</div>
																</div>			
											
							@endforeach
							
							
							</div>
														</div>
														<div class="owl2-controls">
															<div class="owl2-nav">
																<div class="owl2-prev" style=""><i class="fa fa-angle-left"></i></div>
																<div class="owl2-next" style=""><i class="fa fa-angle-right"></i></div>
															</div>
															<div class="owl2-dots" style="display: none;"></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
							
						
@endforeach
            </div>
        </div>
       
        @endif
    </section>
@endsection
@section('js')
<script type="text/javascript">
$(document).ready(function ($) {
			    "use strict";
			    // Content slider
			    $('.yt-content-slider').each(function () {
			        var $slider = $(this),
			            $panels = $slider.children('div'),
			            data = $slider.data();
			        // Remove unwanted br's
			        //$slider.children(':not(.yt-content-slide)').remove();
			        // Apply Owl Carousel
			        
			        $slider.owlCarousel2({
			            responsiveClass: true,
			            mouseDrag: true,
			            video:true,
			        lazyLoad: (data.lazyload == 'yes') ? true : false,
			            autoplay: (data.autoplay == 'yes') ? true : false,
			            autoHeight: (data.autoheight == 'yes') ? true : false,
			            autoplayTimeout: data.delay * 1000,
			            smartSpeed: data.speed * 1000,
			            autoplayHoverPause: (data.hoverpause == 'yes') ? true : false,
			            center: (data.center == 'yes') ? true : false,
			            loop: (data.loop == 'yes') ? true : false,
			      dots: (data.pagination == 'yes') ? true : false,
			      nav: (data.arrows == 'yes') ? true : false,
			            dotClass: "owl2-dot",
			            dotsClass: "owl2-dots",
			      margin: data.margin,
			        navText:  ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
			            responsive: {
			                0: {
			                    items: data.items_column4 
			                    },
			                480: {
			                    items: data.items_column3
			                    },
			                768: {
			                    items: data.items_column2
			                    },
			                992: { 
			                    items: data.items_column1
			                    },
			                1200: {
			                    items: data.items_column0 
			                    }
			            }
			        });
			    });
@endsection