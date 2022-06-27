@extends('layouts.admin-master')
@section('title', 'Voucher order lists')
@section('css')
<link href="{{asset('assets')}}/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/pages/stylish-tooltip.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
    <style type="text/css">
    @-webkit-keyframes blinker {
    from {background: #8cef81a1;}
    to {background: #8cef812e;}
    }
    .blink{text-decoration: blink;-webkit-animation-name: blinker;-webkit-animation-duration: 0.9s;-webkit-animation-iteration-count:infinite;-webkit-animation-timing-function:ease-in-out;-webkit-animation-direction: alternate; background: red;}

    .payment-method, .customer{ max-width: 150px !important; font-size: 12px; }
    .label-return{background: #ff6226;}
    .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn){max-width: 100px;}
    #orerControll .form-control{padding: 3px;}
    .clockdiv{margin-bottom: 5px;}
    .count{ display: inline-flex; margin: 0 auto; text-align: center; align-items: center;}
.count_d {position: relative;padding: 2px 4px 5px;margin: 0px 3px;border-radius: 5px;background: #0e91ef;overflow: hidden;}
.count_d:before{ content: '';  position: absolute;top: 0;left: 0;width: 100%;height: 50%;}
.count_d span { display: block; text-align: center; font-size: 12px; font-weight: 800;color: #fff;}
.count_d h2 { display: block; text-align: center;color: #fff; font-size: 7px; font-weight: 600; text-transform: uppercase; margin: 0;}
.irotate {  text-align: center;  margin: 0 auto; display: block;}
.thisis { display: inline-block; vertical-align: middle; }
.slidem { text-align: center; min-width: 90px;}

    </style>
    <!-- page CSS -->
    <link href="{{asset('assets')}}/node_modules/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
@endsection
@section('content')
    <?php 
        $all = $readyToship = $on_delivery = $processing = $delivered = 0;
       
        foreach($voucherCounts as $voucherCount){
            
            if($voucherCount->status == 'processing'){ $processing +=1 ; }
            if($voucherCount->status == 'ready-to-ship'){ $readyToship +=1 ; }
            if($voucherCount->status == 'on-delivery'){ $on_delivery +=1 ; }
            if($voucherCount->status == 'delivered'){ $delivered +=1 ; }
            
        }
        $all = $processing+$readyToship +$on_delivery+$delivered;

    ?>
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">@if(Auth::guard('admin')->user()->role_id == 'admin') Total voucher ({{ $total_voucher }}) @else Voucher History @endif</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <a class="btn btn-info btn-sm d-none d-lg-block m-l-15" href="{{ route('admin.voucherTimelines') }}"><i class="fa fa-eye"></i> All Voucher Timelines</a>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->

            <div class="row">
                <!-- Column -->
                <div class="col-md-2 col-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pending Voucher</h5>
                        <div class="d-flex no-block align-items-center">
                            <span class="display-5 text-primary"><i class="fa fa-database"></i></span>
                            <a href="{{route('admin.voucherOrderList', 'pending')}}" class="link display-5 ml-auto">{{$pending}}</a>
                        </div>
                    </div>
                </div>
                </div>
               

                <!-- Column -->
                <div class="col-md-2 col-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Accept Voucher</h5>
                        <div class="d-flex no-block align-items-center">
                            <span class="display-5 text-info"><i class="fa fa-thumbs-up"></i></span>
                            <a href="{{route('admin.voucherOrderList', 'accepted')}}" class="link display-5 ml-auto">{{$accepted}}</a>
                        </div>
                    </div>
                </div>
                </div>
                
                <div class="col-md-2 col-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Today Delivery</h5>
                        <div class="d-flex no-block align-items-center">
                            <span class="display-5 text-primary"><i class="fa fa-list-ol"></i></span>
                            <a href="{{route('admin.voucherOrderList', 'today')}}" class="link display-5 ml-auto">{{$today_voucher}}</a>
                        </div>
                    </div>
                </div>
                </div>

                <div class="col-md-2 col-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Processing</h5>
                        <div class="d-flex no-block align-items-center">
                            <span class="display-5 text-success"><i class="fa fa-hourglass-half"></i></span>
                            <a href="{{route('admin.voucherOrderList', 'accepted')}}" class="link display-5 ml-auto">{{$accepted}}</a>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-md-2 col-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ready To Ship</h5>
                        <div class="d-flex no-block align-items-center">
                            <span class="display-5 text-primary"><i class="fa fa-check"></i></span>
                            <a href="{{route('admin.voucherTimelines')}}?status=ready-to-ship" class="link display-5 ml-auto">{{$readyToship}}</a>
                        </div>
                    </div>
                </div>
                </div>
                <!-- Column -->
                <div class="col-md-2 col-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">On Delivery</h5>
                        <div class="d-flex no-block align-items-center">
                            <span class="display-5 text-info"><i class="fa fa-shipping-fast"></i></span>
                            <a href="{{route('admin.voucherTimelines')}}?status=on-delivery" class="link display-5 ml-auto">{{$on_delivery}}</a>
                        </div>
                    </div>
                </div>
                </div>
                
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card" style="margin-bottom: 2px;">
                        <form action="{{route('admin.voucherOrderList')}}" id="orerControll" method="get">
                            <div class="form-body">
                                <div class="card-body" style="padding-bottom: 0;">
                                    <div class="row">
                                        <div class="col-md-2 col-6">
                                            <div class="form-group">
                                                <label class="control-label">Order Id</label>
                                                <input name="order_id" value="{{ Request::get('order_id')}}" type="text" placeholder="W123456789" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-6">
                                            <div class="form-group">
                                                <label class="control-label">Customer</label>
                                                <input name="customer" value="{{ Request::get('customer')}}" type="text" placeholder="name or mobile or email" class="form-control">
                                            </div>
                                        </div>
                                                                                  
                                        <div class="col-md-2 col-6">
                                            <div class="form-group">
                                                <label class="control-label">Offer</label>
                                                <select  z-index: 9!important; name="offer" class="form-control select2">
                                                    <option value="">Select Offer</option>
                                                    @foreach($offers as $offer)
                                                    <option value="{{$offer->id}}" {{ (Request::get('offer') == $offer->id) ? 'selected' : ''}} >{{$offer->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-6">
                                            <div class="form-group">
                                                <label class="control-label"> Status  </label>
                                                <select name="status" class="form-control">
                                                    <option value="">All Status</option>
                                                    <option value="pending" {{ (Request::get('status') == 'pending') ? 'selected' : ''}} >Pending</option>
                                                    <option value="accepted" {{ (Request::get('status') == 'accepted') ? 'selected' : ''}}>Processing</option>
                                                    <option value="ready-to-ship" {{ (Request::get('status') == 'ready-to-ship') ? 'selected' : ''}}>Ready to ship</option>
                                                    <option value="on-delivery" {{ (Request::get('status') == 'on-delivery') ? 'selected' : ''}}>On Delivery</option>
                                                    <option value="delivered" {{ (Request::get('status') == 'delivered') ? 'selected' : ''}}>Delivered</option>
                                                    <option value="cancel" {{ (Request::get('status') == 'cancel') ? 'selected' : ''}}>Cancel</option>
                                                    <option value="closed" {{ (Request::get('status') == "closed") ? 'selected' : ''}}>Closed</option>
                                                </select>
                                            </div>
                                        </div>  
                                        <div class="col-md-2 col-6">
                                            <div class="form-group">
                                                <label class="control-label">From Date</label>
                                                <input name="from_date" value="{{ Request::get('from_date')}}" type="date" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-6">
                                            <div class="form-group">
                                                <label class="control-label">End Date</label>
                                                <input name="end_date" value="{{ Request::get('end_date')}}" type="date" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-6">
                                            <div class="form-group">
                                                <label class="control-label">.</label>
                                               <button type="submit" class="form-control btn btn-success"><i style="color:#fff; font-size: 20px;" class="ti-search"></i> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-lg-12">
                    <div class="card">
                        <h3>
                            @if(Route::current()->getName() == 'order.search')
                                Total Record: ({{count($orders)}})
                            @endif
                        </h3>
                        <div class="table-responsive">
                            <table class="table display table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order</th>
                                        <th style="min-width: 100px;">Product</th>
                                        <th>Customer</th>
                                        <th>Next Delivery Time</th>
                                        <th>Qty</th>
                                        <th style="min-width: 95px;">Price</th>
                                        <th>Rate</th>
                                        <th>Pay_method</th>
                                        <th>Payment</th>
                                        <th>status</th>
                                        <th>Invoice</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($orders)>0)
                                        @foreach($orders as $index => $order)
                                        @php 
                                            $total_price = ($order->total_price + $order->shipping_cost) - $order->coupon_discount;
                                            $partailPayment =  ($order->orderPartialPayments) ? ($order->orderPartialPayments->sum('amount')) : 0;

                                            $delivery_next_date = (count($order->voucherTimelines)>0) ? Carbon\Carbon::parse($order->voucherTimelines[0]->invoice_date)->addDays(30)->format('Y-m-d'. ' 00:00:00') : Carbon\Carbon::parse($order->order_date)->addDays(10)->format('Y-m-d'. ' 00:00:00'); 
                                        @endphp
                                        <tr @if( Carbon\Carbon::parse(now())->format('Y-m-d'. ' 00:00:00') >= $delivery_next_date && ($order->order_status != 'cancel' && $order->order_status != 'closed')) class="blink" @endif id="{{$order->order_id}}" @if($order->order_status == 'cancel' || $order->order_status == 'closed') style="background:#ff000026" @endif >
                                            <td>{{(($orders->perPage() * $orders->currentPage() - $orders->perPage()) + ($index+1) )}}</td>
                                            <td>{{$order->order_id}}</br/>
                                                {{\Carbon\Carbon::parse($order->order_date)->format(Config::get('siteSetting.date_format'))}}
                                            <p style="font-size: 12px;margin: 0;padding: 0">{{\Carbon\Carbon::parse($order->order_date)->format('h:i:s A')}}</p>
                                           </td>
                                           <td>
                                            @if(count($order->order_details)>0)
                                            <a target="_blank" style="text-transform: lowercase;" href="{{ route('product_details', $order->order_details[0]->product->slug)}}">
                                            <img width="50" src="{{asset('upload/images/product/'.$order->order_details[0]->product->feature_image)}}">
                                            {{ $order->order_details[0]->product->title }} </a>@endif</td>
                                           <td>{{ $order->customer_name }}
                                            <p style="font-size: 12px;margin: 0;padding: 0">{{ $order->billing_phone }}</p>@if($order->affiliateProduct) <p style="color: red;font-size: 11px;margin: 0;padding: 0"> Referred By <br/><a href="{{ route('customer.profile', $order->affiliateProduct->affiliateAgent->username) }}"> {{$order->affiliateProduct->affiliateAgent->name}}</a> </p> @endif</td>
                                           
                                            <td style="text-align: center;"> 
                                                @if($order->order_status != 'cancel' && $order->order_status != 'closed')
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
                                             <td>{{$order->total_qty}}
                                             </td>
                                            <td>
                                                @if($partailPayment < $total_price && $order->payment_status != 'paid')
                                                <span style="font-size:11px;">
                                                Payable:{{$order->currency_sign}}{{$total_price }}<br/>
                                                Received:{{$order->currency_sign}}{{($partailPayment) ? $partailPayment : 0 }}<br/>
                                                Due:{{$order->currency_sign}}{{($partailPayment) ? $total_price - $partailPayment : $total_price }} </span>
                                                @else Paid:{{$order->currency_sign}}{{$total_price }} @endif
                                                
                                            </td>
                                            <td>{!! ($order->voucher_rate) ? $order->currency_sign. ($order->voucher_rate * $order->total_qty) : '<span style="color:red"> Not set </span>' !!}</td>
                                            <td class ="payment-method"> 
                                                <span class="mytooltip tooltip-effect-2">
                                                <span class="label label-{{($order->payment_method=='pending') ? 'danger' : 'success' }}">{{ str_replace( '-', ' ', $order->payment_method) }}</span>
                                                @if($order->payment_method != 'nagad' && $order->payment_method != 'shurjopay')
                                                @if($order->payment_info)
                                                <span class="tooltip-content clearfix">
                                                <span class="tooltip-text">
                                                    @if($order->tnx_id)
                                                    <strong>Tnx_id:</strong> <span> {{$order->tnx_id}}</span><br/>
                                                    @endif
                                                    {{$order->payment_info}}
                                                </span> 
                                                </span>
                                                @endif
                                                @endif
                                                </span>
                                                @if(Auth::guard('admin')->user()->email == 'neyamulkn2@gmail.com' && ($order->payment_method == 'nagad' || $order->payment_method == 'shurjopay'))
                                                    @if($order->tnx_id)
                                                    <strong>Tnx_id:</strong> <span> {{$order->tnx_id}}</span><br/>
                                                    @endif
                                                    {{$order->payment_info}}
                                                    <a onclick="paymentIssue('{{$order->order_id}}', 'Process To Verify')" class="label label-warning" >Add Payment Issue</a>
                                                @endif
                                            </td>
                                            <td><a href="javascript:void(0)" class="label btn-xs @if($order->payment_status == 'paid')  label-success @elseif($order->payment_status == 'received') label-info @else label-danger @endif">
                                                @if(Auth::guard('admin')->user()->role_id == 'admin' || in_array(Auth::guard('admin')->user()->id, [22]))
                                                <span class="mytooltip tooltip-effect-2">
                                                <div onclick="orderPaymentPopup('{{ route("admin.orderPaymentDetails", $order->order_id)}}')" title="Update order payment info" class="text-inverse p-r-10" >{{$order->payment_status}} </div>
                                                @if(count($order->orderNotify)>0)
                                                
                                                <span class="tooltip-content clearfix">
                                                <span class="tooltip-text">
                                                    @foreach($order->orderNotify->where('type', '=', 'orderPayment')  as $notify)
                                                       <p style="font-size: 10px;padding: 0;margin: 0">{{$index+1}}. By {{($notify->notify) ? $notify->staff->name : '' }} => {{$notify->notify}} <br/><i class="fa fa-clock">  {{\Carbon\Carbon::parse($notify->created_at)->format(Config::get('siteSetting.date_format') .' | '.' h:i A')}}</i></p>
                                                    @endforeach
                                                </span> 
                                                </span>
                                                </span>
                                                @endif
                                                @else
                                                    <span >{{$order->payment_status}}</span>
                                                @endif
                                                </a>
                                            </td>

                                            <td> 
                                                <span class="mytooltip tooltip-effect-2">
                                                    @if($order->order_status == 'delivered')
                                                    <span class="label label-success"> {{ str_replace('-', ' ', $order->order_status)}} </span>@elseif($order->order_status == 'closed')
                                                    <span class="label label-danger"> {{ str_replace('-', ' ', $order->order_status)}} </span>

                                                    @elseif($order->order_status == 'accepted')
                                                    <span class="label label-warning"> Processing </span>

                                                    @elseif($order->order_status == 'ready-to-ship')
                                                    <span class="label label-ready-ship"> {{ str_replace('-', ' ', $order->order_status)}} </span>
                                                    @elseif($order->order_status == 'return')
                                                    <span class="label label-return"> {{ str_replace('-', ' ', $order->order_status)}} </span>

                                                    @elseif($order->order_status == 'cancel')
                                                    <a href="javascript:void()" class="mytooltip">
                                                        <span class="label label-danger"> {{ str_replace('-', ' ', $order->order_status)}} 
                                                        </span>
                                                        @if(count($order->orderCancelReason)>0)
                                                            <br/>Reason  
                                                            @foreach($order->orderCancelReason as $reason)
                                                            <span class="tooltip-content3">{{$reason->reason}} {{$reason->reason_details}}</span>
                                                            @endforeach
                                                        
                                                        @endif
                                                    </a>
                                                    @elseif($order->order_status == 'on-delivery')
                                                    <span class="label label-primary"> {{ str_replace('-', ' ', $order->order_status)}} </span>

                                                    @else
                                                    <span class="label label-info"> Pending </span>
                                                    @endif
                                                    @php $updateStatus = $order->orderNotify->where('type', '=', 'orderStatus'); @endphp
                                                    @if(count($updateStatus)>0)
                                                    <span class="tooltip-content clearfix">
                                                        <span class="tooltip-text">
                                                            @foreach($updateStatus as $notifyNo => $statusNotify)
                                                                @if($statusNotify->notify)
                                                                <p style="font-size: 10px;padding: 0;margin: 0">{{$notifyNo+1}}. By {{($statusNotify->staff) ? $statusNotify->staff->name : 'Customer' }} => {{ucwords($statusNotify->notify)}} <br/><i class="fa fa-clock">  {{\Carbon\Carbon::parse($statusNotify->created_at)->format(Config::get('siteSetting.date_format') .' | '.' h:i A')}}</i></p>
                                                                @endif
                                                            @endforeach
                                                        </span> 
                                                    </span>
                                                    @endif
                                                </span>
                                            </td>
                                            <td> <a class="label label-info" style="text-align: center;" href="{{route('admin.voucherTimelineDetails', $order->order_id)}}">({{$order->voucher_timelines_count}}) Times</a></td>
                                            <td>
                                                
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="ti-settings"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a href="javascript:void(0)" class="dropdown-item" onclick="order_details('{{$order->order_id}}')" title=" View order details" class="text-inverse p-r-10" ><i class="ti-eye"></i> Views Details</a>
                                                        <a href="{{route('admin.voucherTimelineDetails', $order->order_id)}}" class="dropdown-item"  title=" View Delivery Timeline" class="text-inverse p-r-10" ><i class="ti-eye"></i> Delivery Timeline</a>
                                                        @if(Auth::guard('admin')->user()->role_id != 'admin')
                                                        <a href="javascript:void(0)" class="dropdown-item" onclick="changeShippingAddress('{{$order->order_id}}')" title="Change Shipping Address" class="text-inverse p-r-10" ><i class="fa fa-edit"></i> Shipping Address</a>@endif
                                                    </div>
                                                </div>
                                                
                                            </td>
                                        </tr>
                                       @endforeach
                                    @else <tr><td colspan="8"> <h1>No vouchers found.</h1></td></tr> @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Column -->
            </div>
            <div class="row">
               <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                   {{$orders->appends(request()->query())->links()}}
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of total {{$orders->total()}} entries ({{$orders->lastPage()}} Pages)</div>
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
   <div class="modal fade" id="getOrderDetails" style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="padding: 5px 15px;">
                    <h4 class="modal-title" id="myLargeModalLabel">Order Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" id="order_details"></div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- ordr cancel Modal -->
    <div id="orderCancel" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <h4 class="modal-title">Are you sure?</h4>
                    <p>Do you really want to cancel order?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                    <button type="button" value="" id="orderCancelRoute" onclick="orderCancel(this.value)" data-dismiss="modal" class="btn btn-danger">Order Cancel</button>
                </div>
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
    <div class="modal bs-example-modal-lg" id="orderPaymentModal" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Update payment info.</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                @if(Session::has('error'))
                    <div class="alert alert-danger">
                      {{Session::get('error')}}
                    </div>
                @endif
                <div class="modal-body" id="orderPaymentDetails"></div> 
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="reviewModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Review this product</h4>
                    <button type="button" class="close" data-dismiss="modal" style="margin-top: -25px;">&times;</button>
                </div>
                <form action="{{route('adminReviewInsert')}}"  data-parsley-validate method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body" id="getReviewForm"> </div>

                    <div class="modal-footer">
                       <button type="submit" class="btn btn-success">Publish Review</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')

    <script type="text/javascript">
        function order_details(id){
            $('#order_details').html('<div class="loadingData"></div>');
            $('#getOrderDetails').modal('show');
            var  url = '{{route("admin.voucherDetails", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#order_details").html(data);
                    $('.selectpicker').selectpicker();
                    $('#'+id).css("background-color", "rgb(0 255 231 / 14%)");
                }
            }
        });
        }
        function changeShippingMethod(shipping_method_id, order_id) {
            var link = '{{route("admin.shippingMethod")}}';
            $.ajax({
                url:link,
                method:"get",
                data:{'shipping_method_id': shipping_method_id, 'order_id': order_id},
                success:function(data){
                    if(data.status){
                        toastr.success(data.message);
                    }else{
                        toastr.error(data.message);
                    }
                }
            });
        }

        function changePaymentStatus(status, order_id) {
            if (confirm("Are you sure change payment status "+status+".?")) {
                var link = '{{route("admin.changePaymentStatus")}}';
                $.ajax({
                    url:link,
                    method:"get",
                    data:{'status': status, 'order_id': order_id},
                    success:function(data){
                        if(data){
                            toastr.success(data.message);
                        }else{
                            toastr.error(data.message);
                        }
                    }
                });
            }
            return false;
        }    

        function orderPaymentPopup(link){
            $('#orderPaymentModal').modal('show');
            $('#orderPaymentDetails').html('<div class="loadingData"></div>');
            $.ajax({
                url:link,
                method:"get",
                success:function(data){
                    $('#orderPaymentDetails').html(data);
                }
            });
        }

        function changeOrderStatus(status, order_id) {
            if (confirm("Are you sure "+status+ " this order.?")) {
                var link = '{{route("admin.changeOrderStatus")}}';
                $.ajax({
                    url:link,
                    method:"get",
                    data:{'status': status, 'order_id': order_id},
                    success:function(data){
                        if(data.status){
                            $('#getOrderDetails').modal('hide');
                            toastr.success(data.message);
                        }else{
                            toastr.error(data.message);
                        }
                    }
                });
            }
            return false;
        }        

        function changeProductOrderStatus(status, order_id, product_id) {
            if (confirm("Are you sure "+status+ " this product.?")) {

                var link = '{{route("admin.changeProductOrderStatus")}}';

                $.ajax({
                    url:link,
                    method:"get",
                    data:{'status': status, 'order_id': order_id, 'product_id': product_id},
                    success:function(data){
                        if(data.status){
                            $('#getOrderDetails').modal('hide');
                            toastr.success(data.message);
                        }else{
                            toastr.error(data.message);
                        }
                    }
                });
            }
            return false;
        }

        function paymentIssue(order_id, payment_status) {
            $.ajax({ 
                url:"{{route('admin.changePaymentStatus')}}",
                method:"post",
                data:{ 'order_id':order_id,'payment_status':payment_status, '_token': '{{csrf_token()}}'},
                success:function(data){
                    if(data.status){
                        toastr.success(data.message);
                    }else{
                        toastr.error('update failed.');
                    }
                }
            });
            return false
        }

        // product attribute set 
        function addedAttribute(order_id, product_id){

            var attributes = $('#attributes'+product_id).val();
           
            if(attributes){
                $.ajax({ 
                    url:"{{route('admin.orderAttribute.update')}}",
                    method:"get",
                    data:{ order_id:order_id,product_id:product_id,productAttributes:attributes },
                    success:function(data){
                        if(data.status){
                            toastr.success(data.message);
                        }else{
                            toastr.error(data.message);
                        }
                        
                    },
                    error: function(jqXHR, exception) {
                        toastr.error('Internal server error.');
                       
                    }
                });
            }
        }        

        // product attribute set 
        function voucherRate(order_id){
            var voucher_rate = $('#voucher_rate'+order_id).val();
            if(voucher_rate){
                $.ajax({ 
                    url:"{{route('admin.voucherRate')}}",
                    method:"get",
                    data:{ order_id:order_id,voucher_rate:voucher_rate },
                    success:function(data){
                        if(data.status){
                            toastr.success(data.message);
                        }else{
                            toastr.error(data.message);
                        }
                    },
                    error: function(jqXHR, exception) {
                        toastr.error('Internal server error.');
                    }
                });
            }
        }  

        // add order info exm( shipping cost, comment) 
        function addedOrderInfo(field, order_id) {

            var link = '{{route("admin.addedOrderInfo")}}';
            var field_data = $('#'+field).val();
            
            $.ajax({
                url:link,
                method:"get",
                data:{field:field,field_data:field_data, order_id:order_id},
                success:function(data){
                    if(data.status){
                        toastr.success(data.message);
                    }else{
                        toastr.error(data.message);
                    }
                }

            });
        }

        function changeShippingAddress(id){
            $('#getShippingAddress').html('<div class="loadingData"></div>');
            $('#changeShippingAddress').modal('show');
            var  url = '{{route("admin.changeShippingAddress", ":id")}}';
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
    </script>

    <script src="{{asset('assets')}}/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets')}}/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
        <script>
    // responsive table
        $('#config-table').DataTable({
            responsive: true, searching: false, paging: false, info: false, ordering: false
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


    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
 
    <script src="{{asset('assets')}}/node_modules/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
 
    <script>
        function checkField(value, field){
            if(value != ""){
                $.ajax({
                    method:'get',
                    url:"{{ route('checkField') }}",
                    data:{table:'order_payments', field:field, value:value},
                    success:function(data){
                        if(data.status){
                            $('#'+field).html("");
                            
                            $('#submitBtn').removeAttr('disabled');
                            $('#submitBtn').removeAttr('style', 'cursor:not-allowed');
                            
                        }else{
                            $('#'+field).html("<span style='color:red'><i class='fa fa-times'></i> "+data.msg+"</span>");
                            
                            $('#submitBtn').attr('disabled', 'disabled');
                            $('#submitBtn').attr('style', 'cursor:not-allowed');
                            
                        }
                    },
                    error: function(jqXHR, exception) {
                        toastr.error('Unexpected error occur.');
                    }
                });
            }else{
                $('#'+field).html("<span style='color:red'>"+field +" is required</span>");
                $('#submitBtn').attr('disabled', 'disabled');
                $('#submitBtn').attr('style', 'cursor:not-allowed');   
            }
        }
        $(function () {
            $('.selectpicker').selectpicker();
        });
    </script>
    <script src="{{asset('assets')}}/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

    <script type="text/javascript">

    $(".select2").select2();
    </script>
    <script type="text/javascript">
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
        function reviewModal(order_id, product_id){
            $('#reviewModal').modal('show');
            $("#getReviewForm").html("<div class='loadingData-sm'></div>");
            $.ajax({
                url:'{{route("adminGetReviewForm")}}',
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
    </script>
@endsection
