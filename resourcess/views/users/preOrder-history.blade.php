@extends('layouts.frontend')
@section('title', 'Order History')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/pages/stylish-tooltip.css') }}">
   <link rel="stylesheet" type="text/css"
        href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
    <style type="text/css">
    	    .icon-box i{font-size: 4rem}
    .ml-auto, .mx-auto {
        margin-left: auto!important;
    }
    .label-return{background: #ff6226;}
    #content .card{border-radius: 5px; }
    .user-box{padding: 10px;    margin-bottom: 10px;}
    .card-title, .icon-box{color: #fff}
    .user-box a{    font-size: 3rem !important; color: #fff}
    #user-dashboard{padding-top: 15px;}
    #user-dashboard section{background: #fff;margin-bottom: 10px;padding: 10px 0;}
    .clockdiv{margin-bottom: 0px;}
        .count{ display: inline-flex; margin: 0 auto; text-align: center; align-items: center;}
        .count_d {position: relative;padding: 2px 3px 3px;margin: 1px;border-radius: 5px;background: #ff7a08;overflow: hidden;}
        .count_d:before{ content: '';  position: absolute;top: 0;left: 0;width: 100%;height: 50%;}
        .count_d span { display: block; text-align: center; font-size: 12px; font-weight: 800;color: #fff;}
        .count_d h2 { display: block; text-align: center;color: #fff; font-size: 7px; font-weight: 600; text-transform: uppercase; margin: 0;}
        .irotate {  text-align: center;  margin: 0 auto; display: block;}
        .thisis { display: inline-block; vertical-align: middle; }
        .slidem { text-align: center; min-width: 90px;}
    </style>
@endsection 
@section('content')
	<div class="breadcrumbs">
		<div class="container">
		  	<ul class="breadcrumb-cate">
		      	<li><a href="{{url('/')}}"><i class="fa fa-home"></i> </a></li>
		      	<li><a href="#">Order History</a></li>
		  	</ul>
		</div>
	</div>
	<!-- Main Container  -->
	<div class="container">
		<?php 
            $all = $pending = $offerPendingOrder = $accepted = $readyToship = $on_delivery = $delivered = $cancel = 0;
            foreach($orders as $order_status){
                if($order_status->payment_method != 'pending' || $order_status->offer_id == null){
                    if($order_status->order_status == 'pending'){ $pending +=1 ; }
                    if($order_status->order_status == 'accepted'){ $accepted +=1 ; }
                    if($order_status->order_status == 'ready-to-ship'){ $readyToship +=1 ; }
                    if($order_status->order_status == 'on-delivery'){ $on_delivery +=1 ; }
                    if($order_status->order_status == 'delivered'){ $delivered +=1 ; }
                    if($order_status->order_status == 'cancel'){ $cancel +=1 ; }
                }
            }
            $all = $pending+$offerPendingOrder+$accepted+ $readyToship +$on_delivery+ $delivered +$cancel;
        ?>
		<div class="row">
			@include('users.inc.sidebar')
			<!--Middle Part Start-->
			<div id="content" class="col-md-9 sticky-content">
				
				@if(Session::has('success'))
                <div class="alert alert-success">
                  <strong>Success! </strong> {{Session::get('success')}}
                </div>
                @endif
                @if(Session::has('error'))
                <div class="alert alert-danger">
                  <strong>Error! </strong> {{Session::get('error')}}
                </div>
                @endif
				<a  href="{{route('user.orderHistory')}}"><h2 style="margin-bottom: 10px;" class="title">Total Order ({{$all}})</h2></a>
				<div class="row">
		            <div class="col-md-2 col-xs-6">
		                <div class="card label-info">
		                    <div class="user-box">
		                        <h5 class="card-title">Pending Orders</h5> 
		                        <div class="d-flex   no-block align-items-center">
		                            <a href="{{route('user.orderHistory', 'pending')}}" class="link ml-auto">{{$pending}}</a>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            <div class="col-md-2 col-xs-6">
		                <div class="card label-warning">
		                    <div class="user-box">
		                        <h5 class="card-title">Accept Order</h5> 
		                        <div class="d-flex   no-block align-items-center">
		                            <a href="{{route('user.orderHistory', 'accepted')}}" class="link ml-auto">{{$accepted}}</a>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            <div class="col-md-2 col-xs-6">
		                <div class="card label-default">
		                    <div class="user-box">
		                        <h5 class="card-title">Ready To Ship</h5> 
		                        <div class="d-flex  no-block align-items-center">
		                            <a href="{{route('user.orderHistory', 'ready-to-ship')}}" class="link ml-auto">{{$readyToship}}</a>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            <div class="col-md-2 col-xs-6">
		                <div class="card label-primary">
		                    <div class="user-box">
		                        <h5 class="card-title">On Delivery</h5> 
		                        <div class="d-flex   no-block align-items-center">
		                            <a href="{{route('user.orderHistory', 'on-delivery')}}" class="link ml-auto">{{$on_delivery}}</a>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            <div class="col-md-2 col-xs-6">
		                <div class="card label-danger">
		                    <div class="user-box">
		                        <h5 class="card-title">Cancel Order</h5> 
		                        <div class="d-flex  no-block align-items-center">
		                            <a href="{{route('user.orderHistory', 'cancel')}}" class="link ml-auto">{{$cancel}}</a>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            <div class="col-md-2 col-xs-6">
		                <div class="card label-success">
		                    <div class="user-box">
		                        <h5 class="card-title">Complete Order</h5> 
		                        <div class="d-flex  no-block align-items-center">
		                            <a href="{{route('user.orderHistory', 'delivered')}}" class="link ml-auto">{{$delivered}}</a>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            
		        </div>
		        <br/>


		        
				<div class="table-responsive" >
					<table style="width: 100%" class="table display table-bordered table-striped no-wrap">
						<thead>
							<tr><td>#</td>
								<td class="text-left">Order</td>
								<td class="text-center">Expected Delivery Date</td>
								<td class="text-left" style="min-width: 160px;">Product</td>
								<td class="text-center">Qty</td>
								<td class="text-center">Amount</td>
								<td>Pay_Method</td>
								
								<td class="text-center">Payment</td>
								<td class="text-center">Status</td>
								<td class="text-center">Invoice</td>
								<td class="text-right">Action</td>
							</tr>
						</thead>
						<tbody>
							@foreach($orders as $index => $order)
							@if($order->payment_method != 'pending' || $order->offer_id == null)
							<tr @if($order->order_status == 'cancel') style="background:#ff000026" @endif>
								<td>{{ $index+1 }}</td>
								<td class="text-left"> #{{$order->order_id}}
								<p style="font-size: 11px;color: #797676;" ><i class="fa fa-clock-o"></i> {{Carbon\Carbon::parse($order->order_date)->format(Config::get('siteSetting.date_format'))}}</p></td>
								<td>
                                	
                                    @php $delivery_date = Carbon\Carbon::parse($order->order_details[0]->product->availability_date ? $order->order_details[0]->product->availability_date : 0)->format('Y-m-d'. ' 00:00:00'); @endphp
                                    <div class="head  clockdiv" data-date="{{$delivery_date}}">
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
                                  
                                </td>
								<td class="text-left">
									@if(count($order->order_details)>0 && $order->order_details[0]->product)  
									<img src="{{asset('upload/images/product/'.$order->order_details[0]->product->feature_image)}}" width="40">
									<a target="_blank" href="{{ route('product_details', $order->order_details[0]->product->slug) }}"> {{Str::limit($order->order_details[0]->product->title, 50)}} </a> 
									@else product not found @endif
								</td>
								<td class="text-center">{{$order->total_qty}}</td>
								<td class="text-center">{{$order->currency_sign . ($order->total_price + $order->shipping_cost - $order->coupon_discount)  }}</td>
								<td class="text-center">
									@if($order->payment_method !='pending')
									<span class="label label-success"> {{ ucfirst(str_replace('-', ' ', $order->payment_method))}}</span> 
                                   
                                    @else
                                    <span style="color: red"> Pending </span><br/>
                                    <a style="margin-top: 5px;" href="{{route('order.paymentGateway', encrypt($order->order_id))}}" class="btn btn-warning btn-xs">Pay Now</a>
                                    @endif
                                </td>
                                
								<td class="text-center"><span class="label label-{{($order->payment_status=='paid' ? 'success' : ($order->payment_status=='received' ? 'warning' : 'danger')) }}">{{$order->payment_status}}</span></td>
								
								<td class="text-center" id="ship_status{{$order->order_id}}">
									@php $updateStatus = $order->orderNotify->where('type', '=', 'orderStatus'); @endphp
									<span class="mytooltip tooltip-effect-2">
										@if($order->order_status == 'delivered')
	                                    <span class="label label-success"> {{ str_replace('-', ' ', $order->order_status)}} </span>

	                                    @elseif($order->order_status == 'accepted')
	                                    <span class="label label-warning"> {{ str_replace('-', ' ', $order->order_status)}} </span>

	                                    @elseif($order->order_status == 'ready-to-ship')
	                                    <span class="label label-default"> {{ str_replace('-', ' ', $order->order_status)}} </span>

	                                    @elseif($order->order_status == 'cancel')
	                                    <span class="label label-danger"> {{ str_replace('-', ' ', $order->order_status)}} </span>

	                                    @elseif($order->order_status == 'on-delivery')
	                                    <span class="label label-primary"> {{ str_replace('-', ' ', $order->order_status)}} </span>
	                                    @elseif($order->order_status == 'return')
	                                    <span class="label label-return"> {{ str_replace('-', ' ', $order->order_status)}} </span>

	                                    @else
	                                    <span class="label label-info"> Pending </span>
	                                    @endif
	                                    @if($order->order_status != 'pending')
	                                    @if(count($order->orderNotify)>0)
                                    	<span class="tooltip-content clearfix">
                                            <span class="tooltip-text">
                                            	
                                                @foreach($updateStatus as $index => $statusNotify)
                                                    @if($statusNotify->notify)
                                                    <p style="font-size: 10px;padding: 0;margin: 0">{{$index+1 .'. '. ucwords($statusNotify->notify)}} <br/><i class="fa fa-clock-o">  {{\Carbon\Carbon::parse($statusNotify->created_at)->format(Config::get('siteSetting.date_format') .' | '.' h:i A')}}</i></p>
                                                    @endif
                                                @endforeach
                                            </span> 
                                        </span>                                        
                                        @endif
                                        @endif
                                    </span>
								</td>
								<td><a target="_blank" class="dropdown-item" href="{{route('user.orderInvoice', $order->order_id)}}" class="text-inverse" title="View Order Invoice" data-toggle="tooltip"><i class="fa fa-print"></i>Invoice</a>
                                            </td>
								<td class="text-center">
									<div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item text-inverse" title="View order" data-toggle="tooltip" href="{{route('user.orderDetails', $order->order_id)}}" data-original-title="View"><i class="fa fa-eye"></i> View Details</a></li>
                                           
                                            @if($order->order_status == 'pending' || $order->order_status == 'accepted')
                                            <li><a title="Cancel Order" onclick="orderCancel('{{ route("user.orderCancelForm", [$order->order_id]) }}')" data-toggle="modal" class="dropdown-item" ><i class="fa fa-trash"></i> Cancel order</a></li>
                                            @endif
                                            <!-- <li><a title="Cancel Order" onclick="orderCancel('{{ route("user.orderCancelForm", [$order->order_id]) }}')" data-toggle="modal" class="dropdown-item" > Address Change Request</a></li> -->
                                        </ul>
                                    </div> 
								</td>
							</tr>
							@endif
							@endforeach
						</tbody>
					</table>
				</div>	
			</div>
			<!--Middle Part End-->
			
		</div>
	</div>
	<!-- //Main Container -->
	<!-- canel Modal -->
	<div class="modal fade" id="orderCancel" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Order Cancel</h4>

                    <button type="button" style="margin-top: -25px;" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body form-row">
                	
                    <div class="card-body">
                        <form action="{{route('user.orderCancel')}}" onsubmit="return confirm('{{Auth::user()->name}} Are you sure cancel this order.?');" method="POST" class="floating-labels">
                            {{csrf_field()}}
                            <div class="form-body" id="getCancelForm"> </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
	
@endsection		
@section('js')

   	<script src="{{asset('assets')}}/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets')}}/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
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
	<script type="text/javascript">
	    
	    function orderCancel(url) {
	      	$('#orderCancel').modal('show');
	      	$("#getCancelForm").html("<div style='height:135px' class='loadingData-sm'></div>");
	        $.ajax({
	            url:url,
	            method:"get",
	            success:function(data){
	                if(data){
	                    $("#getCancelForm").html(data);
	                }
	            }
	        });
	    }

	</script>
     <script>
    // responsive table
        $('#config-table').DataTable({
            responsive: true,
            ordering: false
        });
    </script>
@endsection		


