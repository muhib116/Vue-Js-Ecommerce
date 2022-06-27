@extends('layouts.frontend')
@section('title', $offer->title .' | Offer')
@section('metatag')
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
.liveBtn {    width: 285px; height: 105px; transition: auto; background: #ffffffbd; display: inline-block;border-radius: 50%;font-weight: 800;color:{{$offer->background_color}};transform: translate(-50%, -0%);left: 50%;position: absolute;margin-top: 10px;
}
.offer_area { height: 135px; background: border-top-right-radius: 75px; border-top-left-radius: 75px; border-bottom-right-radius: 75px; border-bottom-left-radius: 75px; width: 100%; text-align: center; margin-bottom: 60px; position: relative;
}
.offer-info{text-align: left;display: inline-block;padding: 10px;border-radius: 5px;margin-bottom: 10px;}
.offer-info p{line-height: 16px;}
.offer-left-right{margin-top: 25px !important;}
.offer-left-right .caption{min-height: 50px;overflow: hidden;line-height: normal;text-align: center;}
.offer-left-right .caption a{color: #da154a !important;font-weight: 600;
font-size: 12px;}

.offer-top-product{left: auto; left: 50%;transform: translate(-50%, -0%);position: absolute;}
.offer-image_area{width: 100%; overflow: hidden; border-radius: 4px; padding: 5px 15px; background: #fff;}
.offer-image_area img{width: 100%;height: 100%}
.offer-title{padding: 10px 5px; color: #000;  height: 60px;overflow: hidden;}
.offer_area p{color: #000; font-size:30px; margin-bottom: 100%}
@media (max-width: 768px) {
    .common-home .label-sale{right: -58px;
    top: 8px !important;}
.offer-title p{font-size: 20px;}
.offer-top-product{width: 80%;}
.offers{background-size: inherit !important;}
.offer_area{margin-bottom: 65px; border-top-right-radius: 25px;
border-top-left-radius: 25px;
border-bottom-right-radius: 25px;
border-bottom-left-radius: 25px;}
}
.topCompetitor{background: red;color: #fff; padding: 10px 5px;text-align:center;border-top-left-radius: 5px;border-top-right-radius: 5px;margin-bottom: 0;}
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
                <li><a href="{{route('offers')}}" class="offerTitle">{{ ucfirst($offer->offer_type) }}</a> {{$offer->title}}</li>
            </ul>
        </div>
    </div> 
    <section class="offers" style="padding: 10px 0;background:{{$offer->background_color}};color:{{$offer->text_color}};">
       
        <div class="container" style="padding:0">
            <div class="row" >
            	<div class="col-md-{{(count($quizTopParticipants)>0) ? 9 : 12}} sticky-content">
            		<div style="clear: both;margin-bottom: 15px;">
		            	<img src="{{asset('upload/images/offer/banner/'. $offer->banner)}}">
		            </div>
            		<div class="offer_area">
			            <div class="offer-title">
			                <div class="irotate">
			                  <div class="thisis slidem">
			                    <p style="color: {{$offer->text_color}}">{{$offer->title}}</p>
			                    <p style="color: {{$offer->text_color}}">ওয়াদিতে কুইজ খেলুন পুরস্কার জিতুন</p>
			                  </div>
			                </div>
			            </div>
			            @if(now() <= $offer->start_date)
			                <div class="liveBtn">
			                  <span class="blink">Quiz Upcomming</span>
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
			                </div>
			            @elseif(now() >= $offer->start_date && now() <= $offer->end_date)
			                <a @if(Auth::check() && $offer->offer_type == 'quiz') href="{{route('quizPurchase', $offer->slug)}}" @else data-toggle="modal" data-target="#so_sociallogin" @endif>
			                    <div class="liveBtn">
			                    <span >Getting Started</span>
			                        <div class="blink" style="color: #ec5242; font-size: 20px; padding: 13px 0px 10px; white-space: nowrap;line-height: 1">Quiz Live </div><i class="fa fa-angle-right"></i> Click to participate
			                    </div>
			                </a>
			            @else
			              <span class="liveBtn" style="padding: 8px 60px 23px;">Quiz <br/>Closed </span>
			            @endif
			        </div>
			        @if(now() >= $offer->start_date && now() <= $offer->end_date)
			        <div style="text-align: center;">
		        		<h5 style="color:red;margin:0">Quiz Live Until</h5>
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
                    <div>
	                    @if($offer->notes)
	                        <div style="text-align:center;margin-bottom: 10px;">View Quiz Terms &amp; Conditions <span data-toggle="modal" data-target="#termsCondition" href="javascript:void(0)" style="color: blue;cursor: pointer;">Click here</span> </div>
	                    @endif
                  </div>
              	</div>
              	@if(count($quizTopParticipants)>0)
          		<div class="col-md-3 sticky-content"><h3 class="topCompetitor">Top Competitors</h3>
                    <div class="row" style="background: #fff">
						    <table class="table table-striped" style="color:#000">
						      <tbody id="post_data">
						      	@foreach($quizTopParticipants as $index => $participate)
						        <tr>
						        	<td style="width: 3px;"><span style="font-size:20px;">{{ ($index + 1) }}</span></td>
							          <td style="width: 60px;">
							            <img style="width: 60px; border-radius: 50%;border: 1px solid #009c05;" src="{{ asset('upload/users') }}/{{ ($participate['photo']) ? $participate['photo'] : 'default.png' }}"> 
							          </td>
							          <td>
							          	<h5 style="margin-bottom:0">{{$participate['name']}}</h5>
							          	<p>{{$participate['division_name']}}</p>
							          </td>
						        </tr>
						        @endforeach
						        @if(count($quizTopParticipants) >= 20)
						        <tr id="load_more_button">
						        	<td colspan="3"><a style="text-align:center;font-size: 15px;display: block;" onclick="load_more_competitor(2)" href="javascript:void(0)"> View 100 Competitors</a></td>
						        </tr>
						        @endif
						    	</tbody>
						  </table>
                    </div>
                </div> 
                @endif 	
            </div>
        </div>
    </section>
    <div id="termsCondition" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@if($offer->offer_type == 'quiz') Quiz @else Offer @endif - এর শর্তাবলী</h4>
          </div>
          <div class="modal-body">
            {!! $offer->notes !!}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
@endsection

@section('js')

<script type="text/javascript">

	function load_more_competitor(page)
	{
	$('#load_more_button').html("<td colspan='3' style='height:35px' class='loadingData-sm'></td>");
	  $.ajax({
		url: '{{route("quiz.allCompetitors", $offer->slug)}}?page=' + page,
		method:"get",

		success:function(data)
		{ 
		$('#load_more_button').remove();
		$('#post_data').append(data);
		}
	  })
	}


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
</script>
@endsection

