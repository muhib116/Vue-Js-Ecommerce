@extends('layouts.frontend')
@section('title', $offer->title .' | Offer')
@section('metatag')
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.range.css') }}">
	
	@if($offer->offer_type = 'hadudu')
	<style>
.the_wheel
{
    background-image: url({{ asset('css/wheel_back.png') }});
    background-position: center;
    background-repeat: no-repeat;
	text-align: center;
}

/* Do some css reset on selected elements */
h1, p
{
    margin: 0;
}

div.power_controls
{
    margin-right:70px;
}

div.html5_logo
{
    margin-left:70px;
}

/* Styles for the power selection controls */
table.power
{
    background-color: #cccccc;
    cursor: pointer;
    border:1px solid #333333;
}

table.power th
{
    background-color: white;
    cursor: default;
}

td.pw1
{
    background-color: #6fe8f0;
}

td.pw2
{
    background-color: #86ef6f;
}

td.pw3
{
    background-color: #ef6f6f;
}

/* Style applied to the spin button once a power has been selected */
.clickable
{
    cursor: pointer;
}

/* Other misc styles */
.margin_bottom
{
    margin-bottom: 5px;
}
</style>


 <script type="text/javascript" src="{{ asset('js/Winwheel.js') }}"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>
	@endif
    <meta name="title" content="{{$offer->title}}">
    <meta name="description" content="{{$offer->title}}">
 
    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta property="og:description" content="{{$offer->title}}">
    <meta property="og:description" content="{!!$offer->title!!}">
    <meta property="og:image" content="{{asset('upload/images/offer/thumbnail/'.$offer->thumbnail)}}">
    <meta property="og:url" content="{{ url()->full() }}">
    <meta property="og:site_name" content="{{Config::get('siteSetting.site_name')}}">
    <meta property="og:locale" content="en">
    <meta property="og:type" content="website">
    <meta property="fb:admins" content="1323213265465">
    <meta property="fb:app_id" content="13212465454">
    <meta property="og:type" content="e-commerce">

    <!-- Schema.org for Google -->

    <meta itemprop="title" content="{{$offer->title}}">
    <meta itemprop="description" content="{{$offer->title}}">
    <meta itemprop="image" content="{{asset('upload/images/offer/thumbnail/'.$offer->thumbnail)}}">

    <!-- Twitter -->
    <meta name="twitter:card" content="{{$offer->title}}">
    <meta name="twitter:title" content="{{$offer->title}}">
    <meta name="twitter:description" content="{{$offer->title}}">
    <meta name="twitter:site" content="{{url('/')}}">
    <meta name="twitter:creator" content="@Neyamul">
    <meta name="twitter:image:src" content="{{asset('upload/images/offer/thumbnail/'.$offer->thumbnail)}}">

    <!-- Twitter - Product (e-commerce) -->

@endsection
@section('css')
<style type="text/css">
.progress{background-color: #f5f5f5eb;}
.progress-bar{background-color: #c5e3fb;color: #fc2828;}
.common-home .label-sale{width: 100%;
right: -90px;
top: 12px !important;
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
.blink{text-decoration: blink;-webkit-animation-name: blinker;-webkit-animation-duration: 0.9s;-webkit-animation-iteration-count:infinite;-webkit-animation-timing-function:ease-in-out;-webkit-animation-direction: alternate; color: #ffbc00}
.liveBox{ position: absolute; color: red; font-size: 20px; top: -20px; right: 15px;
}
.liveBtn {    width: 285px; height: 105px; transition: auto; background: #121213bd; display: inline-block;border-radius: 50%;font-weight: 800;color: #fff;transform: translate(-50%, -0%);left: 50%;position: absolute;margin-top: 10px;
}
.offer_area { height: 155px; background: linear-gradient(#0364c7b8, #eeefcfeb); border-top-right-radius: 75px; border-top-left-radius: 75px; border-bottom-right-radius: 75px; border-bottom-left-radius: 75px; width: 100%; text-align: center; padding-top: 12px; margin-top: 10px; margin-bottom: 60px; position: relative;
}
.offer-info{text-align: left;display: inline-block;padding: 10px;border-radius: 5px;margin-bottom: 10px;}
.offer-info p{line-height: 16px;}
.offer-left-right{margin-top: 25px !important;}
.offer-left-right .caption{min-height: 50px;overflow: hidden;line-height: normal;text-align: center;}
.offer-left-right .caption a{color: #da154a !important;font-weight: 600;
font-size: 12px;}

.offer-top-product{left: auto; left: 50%;transform: translate(-50%, -0%);position: absolute;}
.offer-image_area{width: 100%; overflow: hidden; border-radius: 4clipx; padding: 5px 15px; background: #fff;}
.offer-image_area img{width: 100%;height: 100%}
.offer-title{ margin-top: 20px;padding: 10px 5px; color: #000;  height: 60px;overflow: hidden;}
.offer_area p{color: #000; font-size:30px; margin-bottom: 100%}
@media (max-width: 768px) {
    .common-home .label-sale{right: -58px;
    top: 8px !important;}
.offer-title p{font-size: 20px;}
.offer-top-product{width: 80%;}
.offers{background-size: inherit !important;}
.offer_area{margin-top: 20px;margin-bottom: 65px; border-top-right-radius: 25px;
border-top-left-radius: 25px;
border-bottom-right-radius: 25px;
border-bottom-left-radius: 25px;}
}

.count{ display: inline-flex; margin: 0 auto; text-align: center; align-items: center;}
.count_d { position: relative;width: 57px;padding: 10px 0px;margin: 0px 3px;background: {{($offer->background_color) ? $offer->background_color : 'background:linear-gradient(to top, #77a0dd 0%, #0847a5 100%)'}};color:{{$offer->text_color}};border-radius: 50%;overflow: hidden;
}
.count_d:before{content: '';position: absolute;top: 0;left: 0;width: 100%;height: 50%;}
.count_d span {display: block;text-align: center;font-size: 15px;font-weight: 800;}
.count_d h2 { display: block;text-align: center;font-size: 8px;font-weight: 800;text-transform: uppercase;color:{{($offer->text_color) ? $offer->text_color : '#fff'}};margin: 0;}
.irotate {text-align: center;margin: 0 auto;display: block;}
.thisis {display: inline-block;vertical-align: middle;}
.slidem {text-align: center; min-width: 90px;}
.offerTitle{color: #ff6e26;font-size: 24px;font-family: OpenSans;display: inline-block !important; font-weight: 600; padding-right: 10px;}
</style>
@endsection
@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <ul class="breadcrumb-cate">
                <li><a href="{{url('/')}}"><i class="fa fa-home"></i> </a></li>
                <li><a href="{{route('offers')}}" class="offerTitle">Offer</a> {{$offer->title}}</li>
            </ul>
        </div>
    </div> 
    <section class="offers" style="padding: 10px 0;background:{{$offer->background_color}};color:{{$offer->text_color}};">
        <div class="container" id="purchase_offer">
          <div class="offer_area" style="background:linear-gradient(to top, #419c07 0%, #0888a5 100%)">
            <div class="offer-title">
                <div class="irotate">
                  <div class="thisis slidem">
                    <p style="color: {{$offer->text_color}}">{{$offer->title}}</p>
                    <p style="color: {{$offer->text_color}}">ওয়াদিতে শপিং করুন WORRY FREE. </p>
                  </div>
                </div>
            </div>
            @if(now() <= $offer->start_date)
              <div class="liveBtn">
                @if(Auth::guard('admin')->check())
                  <span >Offer Started </span>
                  <a @if(Auth::check() && $offer->offer_type == 'kanamachi') href="{{ route('offer.buyOffer', $offer->slug) }}" @endif>
                     
                    <div class="blink" style="font-size: 25px; padding: 13px 0px 18px; white-space: nowrap; line-height: 1"><i class="fa fa-play-circle"></i> Shopping Now</div>
                  </a>
                  @else
                  <span class="blink">Offer Upcomming</span>
                  <div class="head" id="offerDate" data-offerDate="{{Carbon\Carbon::parse($offer->start_date)->format('m,d,Y H:i:s')}}">
                    
                    <div class="count">
                      <div class="count_d">
                      <h2>Days</h2>
                        <span id="days">00</span>
                      </div>
                      <div class="count_d">
                      <h2>HOURS</h2>
                        <span id="hour">00</span>
                      </div>
                      <div class="count_d">
                      <h2>MINUTES</h2>
                        <span id="minutes">00</span>
                      </div>
                      <div class="count_d">
                      <h2>SECONDS</h2>
                        <span id="seconds">00</span>
                      </div>
                    </div>
                  </div>
                   @endif
              </div>
            @elseif(now() >= $offer->start_date && now() <= $offer->end_date)
              @if(in_array($offer->offer_type, ['kanamachi', 'hadudu']))
              <a @if(Auth::check() && (in_array($offer->offer_type, ['kanamachi', 'hadudu']))) href="{{ route('offer.buyOffer', $offer->slug) }}" @else data-toggle="modal" data-target="#so_sociallogin" @endif>
                  <div class="liveBtn">
                    <span class="blink"><i class="fa fa-shopping-cart"></i> Click To Buy Offer</span>
                    <div class="head" id="offerDate" data-offerDate="{{Carbon\Carbon::parse($offer->end_date)->format('m,d,Y H:i:s')}}">
                      <div class="count">
                        <div class="count_d">
                        <h2>Days</h2>
                          <span id="days">00</span>
                        </div>
                        <div class="count_d">
                        <h2>HOURS</h2>
                          <span id="hour">00</span>
                        </div>
                        <div class="count_d">
                        <h2>MINUTES</h2>
                          <span id="minutes">00</span>
                        </div>
                        <div class="count_d">
                        <h2>SECONDS</h2>
                          <span id="seconds">00</span>
                        </div>
                      </div><br/>
                      Live Offer
                    </div>
                  </div>
                </a>
                @else
                 <div class="liveBtn">
                    <span class="blink"><i class="fa fa-play-circle"></i> Live Offer</span>
                    <p style="line-height: 1; font-size: 10px; margin: -5px; color: #ffbc00;">Until</p>
                    <div class="head" id="offerDate" data-offerDate="{{Carbon\Carbon::parse($offer->end_date)->format('m,d,Y H:i:s')}}">
                      
                      <div class="count">
                        <div class="count_d">
                        <h2>Days</h2>
                          <span id="days">00</span>
                        </div>
                        <div class="count_d">
                        <h2>HOURS</h2>
                          <span id="hour">00</span>
                        </div>
                        <div class="count_d">
                        <h2>MINUTES</h2>
                          <span id="minutes">00</span>
                        </div>
                        <div class="count_d">
                        <h2>SECONDS</h2>
                          <span id="seconds">00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                @endif
            @else
              <span class="liveBtn" style="padding: 8px 60px 23px;">Closed <br/> Offer</span>
            @endif
          </div>
        </div>
		
		
		
		
		
		
		
		
		
		
		
		
		
           
        <div class="container  product-detail" style="padding:0">
            
            @if((in_array($offer->offer_type, ['kanamachi'])) && now() >= $offer->start_date && now() <= $offer->end_date)
                        <div style="text-align:center;background: #4d0026;padding: 5px;margin: 22px 10px;">
                            @if(Auth::check())
                            <a style="font-size: 3rem;font-weight: bold;" class="blink" href="{{ route('offer.buyOffer', $offer->slug) }}"> অর্ডার করতে ক্লিক করুন </a>
                            @else <span style="font-size: 2rem;font-weight: bold;cursor: pointer;" class="blink" data-toggle="modal" data-target="#so_sociallogin">অর্ডার করতে ক্লিক করুন </span> @endif
						
                        </div>
                        @endif
           @if((in_array($offer->offer_type, ['hadudu'])) && now() >= $offer->start_date && now() <= $offer->end_date)
			   <br>
			   <div class="the_wheel">
		    <canvas id="canvas" width="500" height="500">
                        <p style="{color: white}" align="center">Sorry, your browser doesn't support canvas. Please try another.</p>
                    </canvas>
			   
		</div>
		<div style="text-align:center;background: #4d0026;padding: 5px;margin: 22px 10px;">
                            @if(Auth::check())
							@php	
						$spin = \App\Models\Spin::where('user_id', Auth::user()->id)->where('offer_id', $offer->id)->where('available', '>', 0)->first();
						@endphp
						
						@if(!empty($spin))
                            <span  id="spin_button" style="font-size: 2rem;font-weight: bold;cursor: pointer;" alt="Spin" class="blink" onClick="startSpin();">হা ডু ডু খেলুন</span>
							@else
							<a style="font-size: 3rem;font-weight: bold;" class="blink" href="{{ route('offer.buyOffer', $offer->slug) }}"> হা ডু ডু খেলুন</a>	
							@endif
							
							
							
                            @else <span style="font-size: 2rem;font-weight: bold;cursor: pointer;" class="blink" data-toggle="modal" data-target="#so_sociallogin">হা ডু ডু খেলুন</span> @endif
						
                        </div>
		
		
		   @endif
            
            <div class="products-category">
                <div class="row" >
				
				
				
				
				
					 <aside class="col-md-3 col-sm-3 col-xs-12 content-aside left_column sidebar-offcanvas">
                <span id="close-sidebar" class="fa fa-times"></span>
                <div class="module so_filter_wrap filter-horizontal">
                    <h3 class="modtitle"><span>Filter By</span> 
                        <span data-toggle="tooltip"  data-original-title="Clear all filter" title="" style="float: right;text-transform: none;padding: 0px 5px; font-size: 12px;color: red" id="resetAll">
                            Clear All <i class="fa fa-times"></i>
                        </span>
                    </h3>
                    <div class="modcontent">
                        <ul>
						
						
						
					
						
						
						
						
						
                          
							
							
							
							
							@foreach($category as $listcategories )
                                  <li class="so-filter-options" data-option="{{$listcategories->slug}}">                     
							
                                <div class="so-filter-heading">
                                    <div class="so-filter-heading-text">
                                        <span>{{$listcategories->name}}</span>
                                    </div>
                                    <i class="fa fa-chevron-down"></i>
                                </div>
								
								
								
								
								
                                <div class="so-filter-content-opts" style="display: block;">
                                    <div class="mod-content box-category">
                                        <ul class="accordion" id="accordion-category">
                                            <li class="panel">
                                                <div style="clear:both">
                                                    <ul>
													@php
													$filterCategories = \App\Models\Category::where('parent_id', $listcategories->id)->get();
													@endphp
													
                                                      @foreach($filterCategories as $filterCategory )
                                                        <?php 
                                                        $parent_category = $subcategory = $childcategory = '';
                                                        if(Request::route('catslug')){
                                                            $parent_category = Request::route('catslug');
                                                            $subcategory = $filterCategory->slug;
                                                        }
                                                        if(Request::route('subslug')){
                                                            $parent_category = Request::route('catslug');
                                                            $subcategory = Request::route('subslug');
                                                            $childcategory = $filterCategory->slug;
                                                        }
                                                          ?>
														  
														  
														 <li>
                                        <input @if(in_array($filterCategory->id , explode(',', Request::get('category')))) checked @endif class="common_selector category" value="{{$filterCategory->id}}" id="category{{$filterCategory->id}}" type="checkbox" />
                                        <label style="margin: 0px;" for="category{{$filterCategory->id}}" >{{ $filterCategory->name }}</label> 
                                    </li> 
														  
														  
														  
                                                      
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
								 </li>
								@endforeach
                           
                            @if(count($brands)>0)
                            <li class="so-filter-options" data-option="Brand">
                                <div class="so-filter-heading">
                                    <div class="so-filter-heading-text">
                                        <span>Brand</span>
                                    </div>
                                    <i class="fa fa-chevron-down"></i>
                                </div>
                                <div class="so-filter-content-opts" style="display: block;padding-left: 10px;">
                                  <ul>
                                    @foreach($brands as $brand)
                                    <li>
                                        <input @if(in_array($brand->id , explode(',', Request::get('brand')))) checked @endif class="common_selector brand" value="{{$brand->id}}" id="brand{{$brand->id}}" type="checkbox" />
                                        <label style="margin: 0px;" for="brand{{$brand->id}}" >{{ $brand->name }}</label> 
                                    </li>
                                    @endforeach
                                    </ul>
                                </div>
                            </li>
                            @endif

                           

                           
                            <li class="so-filter-options" data-option="Price">
                                <div class="so-filter-heading">
                                  <div class="so-filter-heading-text">
                                    <span>Price</span>
                                  </div>
                                </div>
                                <div class="so-filter-content-opts" style="display: block;padding-left: 10px;">
                                  <ul>
                                    <li>
                                        <input  type="hidden" id="price-range"  class="price-range-slider tertiary" value="@if(Request::get('price')) {{Request::get('price')}} @else 999999 @endif" form="shop_search_form"><br/>
                                        <button id="+'&price='+price" class="btn btn-info btn-sm common_selector">Update your Search</button>
                                    </li>
                                    
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <div class="clear_filter" style="text-align: right;padding: 5px">
                            <button type="reset" id="resetAll" class="btn btn-danger inverse">
                                 Reset All
                            </button>
                        </div>
                    </div>
                </div>
            </aside>
				
				      
                <span class="open-sidebar hidden-lg hidden-md"><i class="fa fa-bars"></i>Filter By</span>
        		
				
                    <div class="col-md-9">
                        
                        
                        <div id="dataLoading"></div>
                        
                        
                    @if(count($offer_products)>0)
                        <div class="products-list grid row " id="loadProducts">
                            @if(in_array($offer->offer_type, ['kanamachi', 'hadudu']))
                            @include('frontend.offer.kanamachi-product')
                            @else
                            @include('frontend.offer.products')
                            @endif
                        </div>
                        <div class="ajax-load  text-center" id="data-loader"><img  alt="woadi loader image" src="{{asset('frontend/image/loading.gif')}}"></div>
                        @if($offer->offer_type == 'kanamachi' && now() >= $offer->start_date && now() <= $offer->end_date)
                        <div style="text-align:center;background: #4d0026;padding: 5px;margin: 22px 0px;">
                            @if(Auth::check())
                            <a style="font-size: 3rem;font-weight: bold;" class="blink" href="{{ route('offer.buyOffer', $offer->slug) }}">অর্ডার করতে ক্লিক করুন </a>
                            @else <span style="font-size: 2rem;font-weight: bold;cursor: pointer;" class="blink" data-toggle="modal" data-target="#so_sociallogin">অর্ডার করতে ক্লিক করুন </span> @endif
                        </div>
                        @endif
                    @endif
                   
                  </div>
                 
                </div>
				
				
				
				@if(count($offers)>0)
                  <div class="col-12"> <a  href="{{route('offers')}}"><h3 style="background: red;color: #fff; padding: 10px 5px;text-align:center;border-radius: 5px;">More Offers</h3></a>
                    <div class="row">
					
					<div class="products-list grid row ">
                      @foreach($offers as $offerz)
					  <div class="product-layout col-lg-3 col-md-3 col-sm-4 col-xs-6">
					  <div class="product-item-container">
    <div class="left-block">
        <div class="product-image-container">
					  
					  <a href="{{route('offer.details', $offerz->slug)}}"> <img src="{{ asset('upload/images/offer/thumbnail/'.$offerz->thumbnail) }}" alt="{{$offerz->title}}" class="img-1 img-responsive"></a>
            </a>
        </div>
    </div>
			
</div>
		</div>			  
                    
                      @endforeach
                    </div>
					</div>
                  </div>
                  @endif
				
				
				
            </div>
        </div>
    </section>
	
	
	
	
	  <div class="modal fade" id="edit_modal" role="dialog" style="display: none;">
            <div class="modal-dialog" style="width:80% !important;max-width:80%;">
                      {{ csrf_field() }}
                  <!-- Modal content-->
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Select Shop</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
					
					 <div class="product-attribute module" style="overflow-x: scroll;">
	   <div class="products-list grid row number-col-6 so-filter-gird" >
					
					
                    <div class="modal-body form-row" id="edit_form"></div>
                   
				   
				   
				   </div>
      </div>
  
				   
                  </div>
                 </div>
        </div>
		  
		  
@endsection

@section('js')



 <script type="text/javascript" src="{{ asset('frontend')}}/js/themejs/noui.js"></script>

<script src="{{ asset('frontend/js/jquery.range.min.js') }}"></script>
<script type="text/javascript">

 function edit_modal(id){
	 
            $('#edit_form').html('<div class="loadingData"></div>');
            $('#edit_modal').modal('show');
            var  url = '{{route("shoplist", ['id'=>':id','offer'=>$offer->id])}}';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data){
                        $("#edit_form").html(data);
                       
                    }
                }
            });
        }

  (function($) {
        /*-----------
            RANGE
        -----------*/
        $('.price-range-slider').jRange({
            from: 0,
            to: 999999,
            step: 1,
            format: '{{Config::get('siteSetting.currency_symble')}}%s',
            width: 250,
            showLabels: true,
            showScale: false,
            isRange : true,
            theme: "theme-edragon"
        });
    })(jQuery);



   
</script>

<script type="text/javascript">

@if($offer->offer_type = 'hadudu')



@php

foreach($offer_products as $index => $product){
	
	$data[] = ['fillStyle' => '#'.random_color().'', 'text' => 'Prize     #'.$product->id.''];
}

@endphp

  let theWheel = new Winwheel({
                'outerRadius'     : 218,        // Set outer radius so wheel fits inside the background.
                'innerRadius'     : 60,      
				'textFontSize'    : 16, 		 // Make text vertial so goes down from the outside of wheel.
                'textAlignment'   : 'outer',    // Align text to outside of wheel.
                'numSegments'     : {{count($offer_products)}},         // Specify number of segments.
                'segments'        :             // Define segments including colour and text.
                {!!json_encode($data)!!},
                'animation' :           // Specify the animation to use.
                {
                    'type'     : 'spinToStop',
                    'duration' : 15,    // Duration in seconds.
                    'spins'    : 3,     // Default number of complete spins.
                    'callbackFinished' : alertPrize,
                    'callbackSound'    : playSound,   // Function to call when the tick sound is to be triggered.
                    'soundTrigger'     : 'pin'        // Specify pins are to trigger the sound, the other option is 'segment'.
                },
                'pins' :				// Turn pins on.
                {
                    'number'     : {{count($offer_products)}},
                    'fillStyle'  : 'silver',
                    'outerRadius': 4,
                }
            });

            // Loads the tick audio sound in to an audio object.
            let audio = new Audio('{{ asset('css/tick.mp3') }}');

            // This function is called when the sound is to be played.
            function playSound()
            {
                // Stop and rewind the sound if it already happens to be playing.
                audio.pause();
                audio.currentTime = 0;

                // Play the sound.
                audio.play();
            }

            // Vars used by the code in this page to do power controls.
            let wheelPower    = 0;
            let wheelSpinning = false;

            // -------------------------------------------------------
            // Function to handle the onClick on the power buttons.
            // -------------------------------------------------------
            function powerSelected(powerLevel)
            {
                // Ensure that power can't be changed while wheel is spinning.
                if (wheelSpinning == false) {
                    // Reset all to grey incase this is not the first time the user has selected the power.
                    document.getElementById('pw1').className = "";
                    document.getElementById('pw2').className = "";
                    document.getElementById('pw3').className = "";

                    // Now light up all cells below-and-including the one selected by changing the class.
                    if (powerLevel >= 1) {
                        document.getElementById('pw1').className = "pw1";
                    }

                    if (powerLevel >= 2) {
                        document.getElementById('pw2').className = "pw2";
                    }

                    if (powerLevel >= 3) {
                        document.getElementById('pw3').className = "pw3";
                    }

                    // Set wheelPower var used when spin button is clicked.
                    wheelPower = powerLevel;

                    // Light up the spin button by changing it's source image and adding a clickable class to it.
                    document.getElementById('spin_button').src = "{{ asset('css/spin_on.png') }}";
                    document.getElementById('spin_button').className = "clickable";
                }
            }

            // -------------------------------------------------------
            // Click handler for spin button.
            // -------------------------------------------------------
            function startSpin()
            {
                // Ensure that spinning can't be clicked again while already running.
                if (wheelSpinning == false) {
                    // Based on the power level selected adjust the number of spins for the wheel, the more times is has
                    // to rotate with the duration of the animation the quicker the wheel spins.
                   
                    theWheel.animation.spins = 10;
                    // Disable the spin button so can't click again while wheel is spinning.
                    document.getElementById('spin_button').src       = "{{ asset('css/spin_off.png') }}";
                    document.getElementById('spin_button').className = "";

                    // Begin the spin animation by calling startAnimation on the wheel object.
                    theWheel.startAnimation();

                    // Set to true so that power can't be changed and spin button re-enabled during
                    // the current animation. The user will have to reset before spinning again.
                    wheelSpinning = true;
                }
            }

            // -------------------------------------------------------
            // Function for reset button.
            // -------------------------------------------------------
            function resetWheel()
            {
                     // Reset to false to power buttons and spin can be clicked again.
            }

            // -------------------------------------------------------
            // Called when the spin animation has finished by the callback feature of the wheel because I specified callback in the parameters.
            // -------------------------------------------------------
            function alertPrize(indicatedSegment)
            {
                // Just alert to the user what happened.
                // In a real project probably want to do something more interesting than this with the result.
                if (indicatedSegment.text == 'LOOSE TURN') {
					     theWheel.stopAnimation(false);  // Stop the animation, false as param so does not call callback function.
                theWheel.rotationAngle = 0;     // Re-set the wheel angle to 0 degrees.
                theWheel.draw();                // Call draw to render changes to the wheel.
                wheelSpinning = false;
                    alert('Sorry but you loose a turn.');
					
                } else if (indicatedSegment.text == 'BANKRUPT') {
					theWheel.stopAnimation(false);  // Stop the animation, false as param so does not call callback function.
                theWheel.rotationAngle = 0;     // Re-set the wheel angle to 0 degrees.
                theWheel.draw();                // Call draw to render changes to the wheel.
                wheelSpinning = false;
                    alert('Oh no, you have gone BANKRUPT!');
					
                } else {
					theWheel.stopAnimation(false);  // Stop the animation, false as param so does not call callback function.
                theWheel.rotationAngle = 0;     // Re-set the wheel angle to 0 degrees.
                theWheel.draw();                // Call draw to render changes to the wheel.
                wheelSpinning = false;
                    alert("You have won " + indicatedSegment.text);
					
                }
            }

@endif

    var offerDate = $('#offerDate').attr('data-offerDate');
    var count = new Date(offerDate).getTime();
    var x = setInterval(function() {
    var now = new Date().getTime();
    var time = count - now;

    var days = Math.floor(time / (1000 * 60 * 60 * 24));
    var hours = Math.floor((time % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((time % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((time % (1000 * 60)) / 1000);

    document.getElementById("days").innerHTML = days;
    document.getElementById("hour").innerHTML = hours;
    document.getElementById("minutes").innerHTML = minutes;
    document.getElementById("seconds").innerHTML = seconds;

    if (days < 0) {
      clearInterval(x);
      document.getElementById("days").innerHTML = "EXPIRED";
    }
  }, 1000);

//offer title slide
    jQuery(".slidem").prepend(jQuery(".slidem > p:last").clone()); /* copy last div for the first slideup */
    jQuery.fn.slideFadeToggle  = function(speed, easing, callback) {
        return this.animate({opacity: 'toggle', height: 'toggle'}, speed, easing, callback);
    }; /* slideup fade toggle code */
    var divS = jQuery(".slidem > p"), /* get the divs to slideup */
        sDiv = jQuery(".slidem > p").length, /* get the number of divs to slideup */
        n = 0; /* starting counter */
    function slidethem() { /* slide fade function */
        jQuery( divS ).eq( n ).slideFadeToggle(1000,"swing",n=n+1); /* slide fade the div at 1000ms swing and add to counter */
        jQuery( divS ).eq( n ).show(); /* make sure the next div is displayed */
    }
    ( function slideit() { /* slide repeater */
        if( n == sDiv ) { /* check if at the last div */
            n = 0; /* reset counter */
            jQuery( divS ).show(); /* reset the divs */
        }
        slidethem(); /* call slide function */
        if(n == sDiv) { /* check if at the last div */
            setTimeout(slideit,1); /* slide up first div fast */
        } else {
            setTimeout(slideit,5000); /* slide up every 1000ms */
        }
    } )();
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function filter_data(page)
    {
        //enable loader
        document.getElementById('dataLoading').style.display ='block';
        
        var category = "{!! str_replace(' ', '', Request::route('catslug')) !!}" ;
        var subcategory = "{!! (Request::route('subslug')) ? '/'. str_replace(' ', '', Request::route('subslug')) : '' !!}";
        var childcategory = "{!! (Request::route('childslug')) ? '/'. str_replace(' ', '', Request::route('childslug')) : '' !!}";

        var concatUrl = '?';
        
        var searchKey = "filter";
        if(searchKey != '' ){
            concatUrl += 'filter='+searchKey;
        }
       
       
        var brand = get_filter('brand');
		
        if(brand != '' ){
            concatUrl += '&brand='+brand;
        }      


var category = get_filter('category');
        if(category != '' ){
            concatUrl += '&category='+category;
        }    

		
        var price = document.getElementById('price-range').value;
        if(price != '' ){
            concatUrl += '&price='+price;
        }

        var perPage = null;
        var showItem = $("#perPage :selected").val();
        if(typeof showItem != 'undefined' || showItem != null){
           perPage = showItem;
           //check weather page null or set 
            if(page == null){
                //var active = $('.active .page-link').html();
                var page = 1;
            }
        }

        var sortby = $("#sortby :selected").val();
        if(typeof sortby != 'undefined' && sortby != ''){
            concatUrl += '&sortby='+sortby;
            //check weather page null or set 
            if(page == null){
                //var active = $('.active .page-link').html();
                var page = 1;
            }
        }

        if(page != null){concatUrl += '&page='+page;}
     
        var  link = '{{route('offer.details', $offer->slug)}}'+childcategory+concatUrl;
            history.pushState({id: 'category'}, category +' '+subcategory, link);

        $.ajax({
            url:link,
            method:"get",
            data:{
                filter:'filter',perPage:showItem
            },
            success:function(data){
               window.location.reload();
            },
            error: function() {
                document.getElementById('dataLoading').style.display ='none';
                $('#loadProducts').html('<span class="ajaxError">Internal server error.!</span>');
            }

        });
    }

    function get_filter(class_name)
    {

        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
       
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

    function sortproduct(){
        filter_data();
    }
    function showPerPage(){
        filter_data();
    }

    function searchItem(value){
        if(value != ''){ filter_data(); }
    }

    $(document).on('click', '.pagination a', function(e){
        e.preventDefault();

        var page = $(this).attr('href').split('page=')[1];

        filter_data(page);
    });

    $('#resetAll').click(function(){
        $('input:checkbox').removeAttr('checked');
        $('input[type=checkbox]').prop('checked', false);
        $("#searchKey").val('');
        $('input:radio').removeAttr('checked');
         $("#price-range").val('0,999999');
        //call function
        filter_data();
    });
	
	
	
	
	
	
	
	 $(document).ready(function(){
        var page = 2;
        loadMoreProducts(page);
        function loadMoreProducts(page){
			
			
			  var concatUrl = '?';
        
        var searchKey = "filter";
        if(searchKey != '' ){
            concatUrl += 'filter='+searchKey;
        }
       
       
        var brand = get_filter('brand');
		
        if(brand != '' ){
            concatUrl += '&brand='+brand;
        }      


var category = get_filter('category');
        if(category != '' ){
            concatUrl += '&category='+category;
        }    

		
        var price = document.getElementById('price-range').value;
        if(price != '' ){
            concatUrl += '&price='+price;
        }
			
			 var perPage = null;
        var showItem = $("#perPage :selected").val();
        if(typeof showItem != 'undefined' || showItem != null){
           perPage = showItem;
           //check weather page null or set 
            if(page == null){
                //var active = $('.active .page-link').html();
                var page = 1;
            }
        }

        var sortby = $("#sortby :selected").val();
        if(typeof sortby != 'undefined' && sortby != ''){
            concatUrl += '&sortby='+sortby;
            //check weather page null or set 
            if(page == null){
                //var active = $('.active .page-link').html();
                var page = 1;
            }
        }

        if(page != null){concatUrl += '&page='+page;}
     
			var  link = '{{route('offer.details', $offer->slug)}}'+concatUrl;
			
            $.ajax(
                {
                    url: link,
                    type: "get",
                    beforeSend: function()
                    {
                        $('.ajax-load').show();
                    }
                })
            .done(function(data)
            {
                $('.ajax-load').hide();
                $("#loadProducts").append(data.html);
                
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
                
                //check section last page
                if(page <= '{{$offer_products->lastPage()}}' ){
                    page++;
                    loadMoreProducts(page);
                }
                 
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                $('.ajax-load').hide();
            });
        }
    });

	
	
	
	
	
	
	
	
</script>



@endsection

