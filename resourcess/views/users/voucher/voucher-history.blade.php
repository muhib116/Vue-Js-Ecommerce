@extends('layouts.frontend')
@section('title', 'Voucher History' )
@section('css')
<link href="{{asset('assets')}}/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" type="text/css" href="{{ asset('css/pages/stylish-tooltip.css') }}">
   <link rel="stylesheet" type="text/css"
        href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
    <style type="text/css">
    @-webkit-keyframes blinker {
    from {background: #8cef81a1;}
    to {background: #8cef812e;}
    }
    .blink{text-decoration: blink;-webkit-animation-name: blinker;-webkit-animation-duration: 0.9s;-webkit-animation-iteration-count:infinite;-webkit-animation-timing-function:ease-in-out;-webkit-animation-direction: alternate; background: red;}
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{padding: 3px 3px 0 5px;}
    	    .icon-box i{font-size: 4rem}
    .ml-auto, .mx-auto {
        margin-left: auto!important;
    }
    .label-return{background: #ff6226;}
    #content .card{border-radius: 5px; }
    .user-box{padding: 7px;    margin-bottom: 10px;}
    .card-title, .icon-box{color: #fff}
    .user-box a{    font-size: 3rem !important; color: #fff}
    #user-dashboard{padding-top: 15px;}
    #user-dashboard section{background: #fff;margin-bottom: 10px;padding: 10px 0;}
                        .clockdiv{margin-bottom: 5px;}
    .count{ display: inline-flex; margin: 0 auto; text-align: center; align-items: center;}
.count_d {position: relative;padding: 2px 4px 5px;margin: 0px 3px;border-radius: 5px;background: #0e91ef;overflow: hidden;}
.count_d:before{ content: '';  position: absolute;top: 0;left: 0;width: 100%;height: 50%;}
.count_d span { display: block; text-align: center; font-size: 12px; font-weight: 800;color: #fff;}
.count_d h2 { display: block; text-align: center;color: #fff; font-size: 7px; font-weight: 600; text-transform: uppercase; margin: 0;}
.irotate {  text-align: center;  margin: 0 auto; display: block;}
.thisis { display: inline-block; vertical-align: middle; }
.slidem { text-align: center; min-width: 90px;}
  /* reveiw css*/
    .star-cb-group {
      /* remove inline-block whitespace */
      font-size: 0;
      /* flip the order so we can use the + and ~ combinators */
      unicode-bidi: bidi-override;
      direction: rtl;
      /* the hidden clearer */
    }
    .star-cb-group * {
      font-size: 3rem;
    }
    .star-cb-group > input {
   		margin-left: -10px;
      	opacity: 0
    }
    .star-cb-group > input + label {
      /* only enough room for the star */
      display: inline-block;
      text-indent: 9999px;
      width: 1em;
      white-space: nowrap;
      cursor: pointer;
    }
    .star-cb-group > input + label:before {
      display: inline-block;
      text-indent: -9999px;
      content: "☆";
      color: #888;
    }
    .star-cb-group > input:checked ~ label:before, .star-cb-group > input + label:hover ~ label:before, .star-cb-group > input + label:hover:before {
      content: "★";
      color: #ffa500;
      text-shadow: 0 0 1px #333;
    }
    .star-cb-group > .star-cb-clear + label {
      text-indent: -9999px;
      width: .5em;
      margin-left: -.5em;
    }
    .star-cb-group > .star-cb-clear + label:before {
      width: .5em;
    }
    .star-cb-group:hover > input + label:before {
      content: "☆";
      color: #888;
      text-shadow: none;
    }
    .star-cb-group:hover > input + label:hover ~ label:before, .star-cb-group:hover > input + label:hover:before {
      content: "★";
      color: #ffa500;
      text-shadow: 0 0 1px #333;
    }

    .rating-success{display:none;
        text-align: center;
        font-size: 20px;
        padding: 30px 0;}
    .rating-success.active{display:block}

    .rating-form input.text-field{display:block;width:100%;line-height:25px;font-size:14px;padding:0 10px;border:solid 1px #c1c1c1;}

    .rating-form #review{width:100%;padding:0 10px;line-height:25px;font-size:14px;height:100px;border:solid 1px #c1c1c1;}

    .rating-form #submit{width:100px;line-height:30px;font-size:14px;border-radius:0;-webkit-appearance:none;background: #467379;color: white;border:none;outline:none;}

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
			    <div class="row">
	            <div class="col-md-3 col-xs-6">
	                <div class="card label-info">
	                    <div class="user-box">
	                        <h5 class="card-title">Pending Voucher</h5> 
	                        <div class="d-flex   no-block align-items-center">
	                            <a href="{{route('user.voucherHistory', 'pending')}}" class="link ml-auto">{{$pending}}</a>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="col-md-3 col-xs-6">
	                <div class="card label-warning">
	                    <div class="user-box">
	                        <h5 class="card-title">Processing</h5> 
	                        <div class="d-flex   no-block align-items-center">
	                            <a href="{{route('user.voucherHistory', 'accepted')}}" class="link ml-auto">{{$accepted}}</a>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            
	            
	            <div class="col-md-3 col-xs-6">
	                <div class="card label-danger">
	                    <div class="user-box">
	                        <h5 class="card-title">Closed Voucher</h5> 
	                        <div class="d-flex  no-block align-items-center">
	                            <a href="{{route('user.voucherHistory', 'closed')}}" class="link ml-auto">{{$closed}}</a>
	                        </div>
	                    </div>
	                </div>
	            </div>

	            <div class="col-md-3 col-xs-6">
	                <div class="card label-primary">
	                    <div class="user-box">
	                        <h5 class="card-title">Total Voucher</h5> 
	                        <div class="d-flex   no-block align-items-center">
	                            <a href="{{route('user.voucherHistory')}}" class="link ml-auto">{{$total_voucher}}</a>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
				<div class="table-responsive" >
					<table style="width: 100%" id="config-table" class="table display table-bordered table-striped no-wrap">
						<thead>
							<tr><td>#</td>
								<td class="text-left" style="min-width: 75px;">Order</td>
                <td class="text-left" style="min-width:140px">Next Delivery Date</td>
								<td class="text-left" style="min-width: 100px;">Product</td>
								<td class="text-center">Qty</td>
								<td class="text-center">Amount</td>
								<td>Pay_method</td>
								<td class="text-center">Payment</td>
								<td class="text-center">Status</td>
								<td class="text-center">Delivery</td>
								<td class="text-right">Action</td>
							</tr>
						</thead>
						<tbody>
							@if(count($orders)>0)
							@foreach($orders as $index => $order)
							@php  $delivery_next_date = (count($order->voucherTimelines)>0) ? Carbon\Carbon::parse($order->voucherTimelines[0]->invoice_date)->addDays(30)->format('Y-m-d'. ' 00:00:00') : Carbon\Carbon::parse($order->order_date)->addDays(10)->format('Y-m-d'. ' 00:00:00');  @endphp
							 <tr @if( Carbon\Carbon::parse(now())->format('Y-m-d'. ' 00:00:00') >= $delivery_next_date && ($order->order_status != 'cancel' && $order->order_status != 'closed')) class="blink" @endif id="{{$order->order_id}}" @if($order->order_status == 'cancel' || $order->order_status == 'closed') style="background:#ff000026" @endif >
								<td>{{ $index+1 }}</td>
								<td class="text-left"> #{{$order->order_id}}
								<p style="font-size: 11px;color: #797676;" ><i class="fa fa-clock-o"></i> {{Carbon\Carbon::parse($order->order_date)->format(Config::get('siteSetting.date_format'))}}</p></td>
                <td style="text-align: center;">
                  @if($order->order_status != 'cancel' && $order->order_status != 'closed' && $order->payment_method !='pending')
                    <i class="fa fa-clock"></i> <span>{{Carbon\Carbon::parse($delivery_next_date)->format('d M, Y')}}</span>   
                  <div class="head  clockdiv" data-date="{{$delivery_next_date}}">
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
                  @else
                    <p class="label label-danger"> Voucher {{$order->order_status}} </p>
                  @endif
                </td>
								<td class="text-left">
									@if(count($order->order_details)>0)
                    <a target="_blank" href="{{ route('product_details', $order->order_details[0]->product->slug)}}">
                   	{{ $order->order_details[0]->product->title }} </a>@endif
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
								
								@if($order->order_status == 'delivered')
                    <span class="label label-success"> {{ str_replace('-', ' ', $order->order_status)}} </span>
                    @elseif($order->order_status == 'closed')
                    <span class="label label-danger"> {{ str_replace('-', ' ', $order->order_status)}} </span>

                    @elseif($order->order_status == 'accepted')
                    <span class="label label-warning"> Processing </span>

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
                      
								</td>
								<td><a class="label label-success" style="text-align: center; display: block;" href="{{route('user.voucherDetails', $order->order_id)}}">( {{$order->voucher_timelines_count}} )<br/>Times</a></td>
								<td class="text-center">
									<div class="btn-group">
                        <button type="button" class="btn btn-xs btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item text-inverse" title="View order" data-toggle="tooltip" href="{{route('user.voucherDetails', $order->order_id)}}" data-original-title="View"><i class="fa fa-eye"></i> View Details</a></li>
                           	@if($order->order_status != 'pending' && $order->order_status != 'cancel')
                          	<li><a onclick="reviewModal('{{$order->order_id}}','{{$order->order_details[0]->product->id}}')" data-toggle="tooltip" data-original-title=" Write Product Review"><i class="fa fa-edit"></i> Write Review</a></li>
                          	@endif
                          	<li><a href="javascript:void(0)" class="dropdown-item" onclick="changeShippingAddress('{{$order->order_id}}')" title="Change Shipping Address" data-toggle="tooltip" ><i class="fa fa-map-marker"></i> Shipping Address</a></li>
                            <!-- @if($order->order_status == 'pending' || $order->order_status == 'accepted')
                            <li><a title="Cancel Order" onclick="orderCancel('{{ route("user.orderCancelForm", [$order->order_id]) }}')" data-toggle="modal" class="dropdown-item" ><i class="fa fa-times"></i> Voucher Close</a></li>
                            @endif -->
                            <!-- <li><a title="Cancel Order" onclick="orderCancel('{{ route("user.orderCancelForm", [$order->order_id]) }}')" data-toggle="modal" class="dropdown-item" > Address Change Request</a></li> -->
                        </ul>
                    </div> 
								</td>
							</tr>
							@endforeach
							@else <tr><td colspan="8"> <h1>No vouchers found.</h1></td></tr> @endif
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
                    <h4 class="modal-title">Voucher CLosed</h4>

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
 
	<div class="modal fade" id="reviewModal" role="dialog">
	    <div class="modal-dialog">
	        <!-- Modal content-->
	        <div class="modal-content">
	            <div class="modal-header">
	                <h4 class="modal-title">Review this product</h4>
	                <button type="button" class="close" data-dismiss="modal" style="margin-top: -25px;">&times;</button>
	            </div>
	            <form action="{{route('review.insert')}}"  data-parsley-validate method="post" enctype="multipart/form-data">
	            	@csrf
	                <div class="modal-body" id="getReviewForm"> </div>

	                <div class="modal-footer">
	                   <button type="submit" class="btn btn-success">Publish Review</button>
	                </div>
	            </form>
	        </div>
	    </div>
	</div>

	<div class="modal fade" id="changeShippingAddress" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Change Shipping Address</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" id="getShippingAddress"></div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection		
@section('js')
    <script src="{{asset('assets')}}/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

   	<script src="{{asset('assets')}}/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets')}}/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>

	<script type="text/javascript">
	    function reviewModal(order_id, product_id){
			$('#reviewModal').modal('show');
			$("#getReviewForm").html("<div class='loadingData-sm'></div>");
			$.ajax({
			    url:'{{route("getReviewForm")}}',
			    type:'get',
			    data:{order_id:order_id,product_id:product_id},
			    success:function(data){
			        if(data){
			           $('#getReviewForm').html(data);
			          
			        }else{
			          toastr.error(data);
			        }
			    }
			});
	     }

	    function changeShippingAddress(id){
            $('#getShippingAddress').html('<div class="loadingData"></div>');
            $('#changeShippingAddress').modal('show');
            var  url = '{{route("user.changeShippingAddress", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
	            url:url,
	            method:"get",
	            success:function(data){
	                if(data){
	                    $("#getShippingAddress").html(data);
	                    $(".select2").select2();
	                }
	            }
	        });
        }

        function get_city(id){
    
        var  url = '{{route("get_city", ":id")}}';
        url = url.replace(':id', id);
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#show_city").html(data);
                  
                    $("#show_city").focus();
                    $("#show_area").html('<option>Select Area</option>');
                    $(".select2").select2();
                }else{
                    $("#show_city").html('<option>City not found</option>');
                    $("#show_area").html('<option>Select Area</option>');
                }
            }
        });
    }    

    function get_area(id, type=''){
           
        var  url = '{{route("get_area", ":id")}}';
        url = url.replace(':id',id);
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#show_area"+type).html(data);
                    $("#show_area"+type).focus();
                    $(".select2").select2();
                }else{
                    $("#show_area"+type).html('<option>Area not found</option>');
                }
            }
        });
    }  
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


