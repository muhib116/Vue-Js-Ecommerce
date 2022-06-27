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
            $all = $pending =  $accepted = $readyToship =$return = $on_delivery = $delivered = $cancel = 0;
            foreach($orders as $shipping_status){
                if($shipping_status->shipping_status == 'pending'){ $pending +=1 ; }
                if($shipping_status->shipping_status == 'accepted'){ $accepted +=1 ; }
                if($shipping_status->shipping_status == 'ready-to-ship'){ $readyToship +=1 ; }
                if($shipping_status->shipping_status == 'return'){ $return +=1 ; }
                if($shipping_status->shipping_status == 'on-delivery'){ $on_delivery +=1 ; }
                if($shipping_status->shipping_status == 'delivered'){ $delivered +=1 ; }
                if($shipping_status->shipping_status == 'cancel'){ $cancel +=1 ; }
            }
            $all = $pending+$accepted+$return+ $readyToship +$on_delivery+ $delivered +$cancel;
        ?>
		<div class="row">
			@include('users.inc.sidebar')
			<!--Middle Part Start-->
			<div id="content" class="col-md-9 sticky-content">
				@include('users.affiliates.quicklink')
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
				<a  href="{{route('agent.affiliateOrders')}}"><h2 style="margin-bottom: 10px;" class="title">Total Order ({{$all}})</h2></a>
				<div class="row">
		            <div class="col-md-2 col-xs-6">
		                <div class="card label-info">
		                    <div class="user-box">
		                        <h5 class="card-title">Pending Orders</h5> 
		                        <div class="d-flex   no-block align-items-center">
		                            <a href="{{route('agent.affiliateOrders', 'pending')}}" class="link ml-auto">{{$pending}}</a>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            <div class="col-md-2 col-xs-6">
		                <div class="card label-warning">
		                    <div class="user-box">
		                        <h5 class="card-title">Accept Order</h5> 
		                        <div class="d-flex   no-block align-items-center">
		                            <a href="{{route('agent.affiliateOrders', 'accepted')}}" class="link ml-auto">{{$accepted}}</a>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            <div class="col-md-2 col-xs-6">
		                <div class="card label-default">
		                    <div class="user-box">
		                        <h5 class="card-title">Ready To Ship</h5> 
		                        <div class="d-flex  no-block align-items-center">
		                            <a href="{{route('agent.affiliateOrders', 'ready-to-ship')}}" class="link ml-auto">{{$readyToship}}</a>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            <div class="col-md-2 col-xs-6">
		                <div class="card label-primary">
		                    <div class="user-box">
		                        <h5 class="card-title">On Delivery</h5> 
		                        <div class="d-flex   no-block align-items-center">
		                            <a href="{{route('agent.affiliateOrders', 'on-delivery')}}" class="link ml-auto">{{$on_delivery}}</a>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            <div class="col-md-2 col-xs-6">
		                <div class="card label-danger">
		                    <div class="user-box">
		                        <h5 class="card-title">Cancel Order</h5> 
		                        <div class="d-flex  no-block align-items-center">
		                            <a href="{{route('agent.affiliateOrders', 'cancel')}}" class="link ml-auto">{{$cancel}}</a>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            <div class="col-md-2 col-xs-6">
		                <div class="card label-success">
		                    <div class="user-box">
		                        <h5 class="card-title">Complete Order</h5> 
		                        <div class="d-flex  no-block align-items-center">
		                            <a href="{{route('agent.affiliateOrders', 'delivered')}}" class="link ml-auto">{{$delivered}}</a>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		        <br/>
				<div class="table-responsive" >
					<table style="width: 100%" id="config-table" class="table display table-bordered table-striped no-wrap">
						<thead>
							<tr><td>#</td>
								<td class="text-left">Order</td>
								<td class="text-left" style="min-width: 180px;">Product</td>
								<td class="text-center">Qty</td>
								<td class="text-center">Amount</td>
								<td>Commission</td>
								<td class="text-center">Shipping Status</td>
							</tr>
						</thead>
						<tbody>
							@foreach($orders as $index => $order)
							@if($order->payment_method != 'pending' || $order->offer_id == null)
							<tr @if($order->shipping_status == 'cancel') style="background:#ff000026" @endif>
								<td>{{ $index+1 }}</td>
								<td class="text-left"> #{{$order->order_id}}
								<p style="font-size: 11px;color: #797676;" ><i class="fa fa-clock-o"></i> {{Carbon\Carbon::parse($order->order_date)->format(Config::get('siteSetting.date_format'))}}</p></td>
								<td class="text-left">
									@if($order->product)  
									<img src="{{asset('upload/images/product/'.$order->product->feature_image)}}" width="40">
									<a target="_blank" href="{{ route('product_details', $order->product->slug) }}"> {{Str::limit($order->product->title, 50)}} </a> 
									@else product not found @endif
								</td>
								<td class="text-center">{{$order->qty}}</td>
								<td class="text-center">{{$order->currency_sign . $order->price }}</td>
								<td class="text-center">{{$order->currency_sign . ($order->affiliate_amount * $order->qty) }}</td>
							
								<td class="text-center" id="ship_status{{$order->order_id}}">
									
									<span class="mytooltip tooltip-effect-2">
										@if($order->shipping_status == 'delivered')
	                                    <span class="label label-success"> {{ str_replace('-', ' ', $order->shipping_status)}} </span>

	                                    @elseif($order->shipping_status == 'accepted')
	                                    <span class="label label-warning"> {{ str_replace('-', ' ', $order->shipping_status)}} </span>

	                                    @elseif($order->shipping_status == 'ready-to-ship')
	                                    <span class="label label-default"> {{ str_replace('-', ' ', $order->shipping_status)}} </span>

	                                    @elseif($order->shipping_status == 'cancel')
	                                    <span class="label label-danger"> {{ str_replace('-', ' ', $order->shipping_status)}} </span>

	                                    @elseif($order->shipping_status == 'on-delivery')
	                                    <span class="label label-primary"> {{ str_replace('-', ' ', $order->shipping_status)}} </span>
	                                    @elseif($order->shipping_status == 'return')
	                                    <span class="label label-return"> {{ str_replace('-', ' ', $order->shipping_status)}} </span>

	                                    @else
	                                    <span class="label label-info"> Pending </span>
	                                    @endif
	                                    
                                    </span>
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

    <script>
    // responsive table
        $('#config-table').DataTable({
            responsive: true,
            ordering: false
        });
    </script>
@endsection		


