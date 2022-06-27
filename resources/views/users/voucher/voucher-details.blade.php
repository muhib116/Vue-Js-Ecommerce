@extends('layouts.frontend')
@section('title', 'Voucher Details' )
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/stylish-tooltip.css') }}">
    <style type="text/css">
.clockdiv{margin-bottom: 5px;}
    .count{ display: inline-flex; margin: 0 auto; text-align: center; align-items: center;}
.count_d {position: relative;width: 57px;padding: 2px 4px 5px;margin: 0px 3px;border-radius: 5px;background: #0e91ef;overflow: hidden;}
.count_d:before{ content: '';  position: absolute;top: 0;left: 0;width: 100%;height: 50%;}
.count_d span { display: block; text-align: center; font-size: 16px; font-weight: 800;color: #fff;}
.count_d h2 { display: block; text-align: center;color: #fff; font-size: 8px; font-weight: 800; text-transform: uppercase; margin: 0;}
.irotate {  text-align: center;  margin: 0 auto; display: block;}
.thisis { display: inline-block; vertical-align: middle; }
.slidem { text-align: center; min-width: 90px;}

  /*vertical progress bar*/

.history-tl-container{
    font-family: "Roboto",sans-serif;
  display:block;
  position:relative;
}
.history-tl-container ul.tl{
    margin:20px 0;
    padding:0;
    display:inline-block;

}
.history-tl-container ul.tl li{
    list-style: none;
    margin:auto;
    margin-left:20px;
    min-height:50px;
    /*background: rgba(255,255,0,0.1);*/
    border-left:5px dashed #86D6FF;
    padding:0 0 20px 15px;
    position:relative;
}
.history-tl-container ul.tl li:last-child{ border-left:0;}
.history-tl-container ul.tl li::before{
    position: absolute;
    left: -14px;
    top: 0px;
    content: " ";
    border: 8px solid rgba(255, 255, 255, 0.74);
    border-radius: 500%;
    background: #258CC7;
    height: 25px;
    width: 25px;
    transition: all 500ms ease-in-out;

}
.history-tl-container ul.tl li:hover::before{
    border-color:  #258CC7;
    transition: all 1000ms ease-in-out;
}
ul.tl li .item-title{
}
ul.tl li .item-detail{
    color:rgba(0,0,0,0.5);
    font-size:12px;
}
ul.tl li .timestamp{
    color: #8D8D8D;
    position: absolute;
  width:100px;
    left: -50%;
    text-align: right;
    font-size: 12px;
}

 
    .error{padding-left:20px;color:red;font-size:12px;}
</style>
@endsection
@section('content')
  <div class="breadcrumbs">
      <div class="container">
          <ul class="breadcrumb-cate">
              <li><a href="{{url('/')}}"><i class="fa fa-home"></i> </a></li>
              <li><a href="#">Voucher Timeline</a></li>
          </ul>
      </div>
  </div>
	<!-- Main Container  -->
	<div class="container">
		@include('users.inc.sidebar')
		<!--Middle Part Start--> 
		<div id="content" style="position:sticky; background: transparent; " class="col-md-9 sticky-content">
			<div class="row">
				<div class="col-md-12">
                    @if($order->order_status != 'closed' && $order->order_status != 'cancel' && $order->payment_method !='pending')
					@php $delivery_next_date = (count($order->voucherTimelines)>0) ? $order->voucherTimelines[0]->invoice_date : $order->order_date; $days = (count($order->voucherTimelines)>0) ? 30 : 10;  @endphp
                    <div class="row">
                        <div class="col-md-3">
                        <h3 class="title"> Next Delivery Time</h3>
                        <i class="fa fa-clock-o"></i>  {{Carbon\Carbon::parse($delivery_next_date)->addDays($days)->format('d M, Y')}} 
                        </div>
                        <div class="col-md-5">
                        <div class="head clockdiv" id="offerDate" data-date="{{Carbon\Carbon::parse($delivery_next_date)->addDays($days)->format('m,d,Y'. ' 00:00:00')}}">
                            <div class="count">
                              <div class="count_d" >
                                <span class="days">00</span>
                                <h2>Days</h2>
                              </div>
                              <div class="count_d" >
                                <span class="hours">00</span>
                                <h2>HOURS</h2>
                              </div>
                              <div class="count_d" >
                                <span class="minutes">00</span>
                                <h2>MINUTES</h2>
                              </div>
                              <div class="count_d" >
                                <span class="seconds">00</span>
                                <h2>SECONDS</h2>
                              </div>
                            </div>
                        </div>
                       
                        </div>
                    </div>
				</div>
                 @else <h3 style="color:red">Voucher: {{$order->order_status}}</h3> @endif
				<div class="col-md-9 sticky-content">
					<div class="table-responsive" >
                    <table style="width: 100%;margin-top: 5px;" class="table display table-bordered table-striped no-wrap">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Invoice ID</td>
                                <td style="min-width:100px;">Date</td>
                                <td>Name</td>
                                <td>Shipping_Address</td>
                                <td>Delivery_Status</td>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($order->voucherTimelines)>0)
                                @foreach($order->voucherTimelines as $index => $voucherTimeline)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$voucherTimeline->invoice_id}}</td>
                                    <td>{{\Carbon\Carbon::parse($voucherTimeline->invoice_date)->format(Config::get('siteSetting.date_format'))}}
                                    <p style="font-size: 12px;margin: 0;padding: 0">{{\Carbon\Carbon::parse($voucherTimeline->invoice_date)->format('h:i:s A')}}</p>
                                   </td>
                                   <td>{{ $voucherTimeline->shipping_name }}
                                    <p style="font-size: 12px;margin: 0;padding: 0">{{ $voucherTimeline->shipping_phone }}</p>
                                    </td>
                                    <td>
                                        {{ $voucherTimeline->shipping_address }},
                                        {{ $voucherTimeline->shipping_area }},
                                        {{ $voucherTimeline->shipping_city }},
                                        {{ $voucherTimeline->shipping_region }}
                                    </td>
                                    <td>
                                    	<span class="mytooltip tooltip-effect-2">
                                    	@if($voucherTimeline->status == 'delivered')
	                                    <span class="btn btn-success btn-xs"> {{ str_replace('-', ' ', $voucherTimeline->status)}} </span>

	                                    @elseif($voucherTimeline->status == 'processing')
	                                    <span class="btn btn-warning btn-xs"> {{ str_replace('-', ' ', $voucherTimeline->status)}} </span>

	                                    @elseif($voucherTimeline->status == 'ready-to-ship')
	                                    <span class="btn btn-info btn-xs"> {{ str_replace('-', ' ', $voucherTimeline->status)}} </span>

	                                    @elseif($voucherTimeline->status == 'cancel')
	                                    <span class="btn btn-danger btn-xs"> {{ str_replace('-', ' ', $voucherTimeline->status)}} </span>

	                                    @elseif($voucherTimeline->status == 'on-delivery')
	                                    <span class="btn btn-primary btn-xs"> {{ str_replace('-', ' ', $voucherTimeline->status)}} </span>
	                                    @elseif($voucherTimeline->status == 'return')
	                                    <span class="btn btn-return btn-xs"> {{ str_replace('-', ' ', $voucherTimeline->status)}} </span>

	                                    @else
	                                    <span class="btn btn-info btn-xs"> Pending </span>
	                                    @endif
	                                    <span class="tooltip-content clearfix">
                                            <span class="tooltip-text">
                                               @foreach($voucherTimeline->voucherNotify as $notifyNo => $statusNotify)
                                                    @if($statusNotify->notify)
                                                    <p style="font-size: 10px;padding: 0;margin: 0">{{$index+1 .'. '. ucwords($statusNotify->notify)}} <br/><i class="fa fa-clock-o">  {{\Carbon\Carbon::parse($statusNotify->created_at)->format(Config::get('siteSetting.date_format') .' | '.' h:i A')}}</i></p>
                                                    @endif
                                                @endforeach
                                            </span> 
                                        </span>
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            @else <tr><td style="text-align: center;" colspan="8">There was no delivery found.</td></tr> @endif
                        </tbody>
                    </table>
                    </div>
             	</div>
				<div class="col-md-3 sticky-content" style="background:#fff;padding-top: 10px;">
					<h4 style="margin:0;padding: 0;">Delivery Timeline</h4>
					<div class="history-tl-container">
					  <ul class="tl">
					  	@foreach($voucherNotify as $index => $statusNotify)
					    <li class="tl-item" ng-repeat="item in retailer_history">
					      <div class="item-title">{{ucwords($statusNotify->notify)}}</div>
					      <div class="item-detail"><i class="fa fa-clock-o">  {{\Carbon\Carbon::parse($statusNotify->created_at)->format(Config::get('siteSetting.date_format') .' | '.' h:i A')}}</i></div>
					    </li>
					    @endforeach

					  </ul>

					</div>
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
