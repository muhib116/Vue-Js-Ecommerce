@extends('layouts.admin-master')
@section('title', 'Voucher Delivery Timeline')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/stylish-tooltip.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
    <style type="text/css">
        .payment-method, .customer{ max-width: 150px !important; font-size: 12px; }
        .label-return{background: #ff6226;}
        .mytooltip{z-index: initial;}
        .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn){max-width: 100px;}
        #orerControll .form-control{padding: 3px;}
.clockdiv{margin-bottom: 5px;}
    .count{ display: inline-flex; margin: 0 auto; text-align: center; align-items: center;}
.count_d {position: relative;width: 57px;padding: 2px 4px 5px;margin: 0px 3px;border-radius: 5px;background: #0e91ef;overflow: hidden;}
.count_d:before{ content: '';  position: absolute;top: 0;left: 0;width: 100%;height: 50%;}
.count_d span { display: block; text-align: center; font-size: 16px; font-weight: 800;color: #fff;}
.count_d h2 { display: block; text-align: center;color: #fff; font-size: 8px; font-weight: 800; text-transform: uppercase; margin: 0;}
.irotate {  text-align: center;  margin: 0 auto; display: block;}
.thisis { display: inline-block; vertical-align: middle; }
.slidem { text-align: center; min-width: 90px;}
    </style>
    <!-- page CSS -->
    <link href="{{asset('assets')}}/node_modules/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
@endsection
@section('content')

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
                    <h4 class="text-themecolor"><a href="{{ route('admin.voucherOrderList') }}"> <i class="fa fa-angle-left"></i> </a>Voucher Delivery Timeline</h4>
                </div>
                @if($order->payment_status == 'paid' && $order->order_status != 'closed' && $order->order_status != 'cancel')
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <a class="btn btn-success btn-sm d-none d-lg-block m-l-15" data-toggle="modal" data-target="#orderInvoiceModal" href="javascript:void(0)"><i class="fa fa-print"></i> Generate delivery invoice</a>
                    </div>
                </div>
                @endif
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
                @php $delivery_next_date = (count($order->voucherTimelines)>0) ? $order->voucherTimelines[0]->invoice_date : $order->order_date; $days = (count($order->voucherTimelines)>0) ? 30 : 10; @endphp
                <div class="card">
                    <div class="card-body">
                    @if($order->order_status != 'closed' && $order->order_status != 'cancel')
                    <div class="row">
                        <div class="col-md-3">
                        <h3 class="title"> Next Delivery Time</h3>
                        <i class="fa fa-clock"></i>  {{Carbon\Carbon::parse($delivery_next_date)->addDays( $days)->format('d M, Y')}} 
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
                    @else <h3 style="color:red">Voucher: {{$order->order_status}}</h3> @endif
                    <div class="table-responsive">
                        <table class="table display table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Invoice</th>
                                    <th>Customer</th>
                                    <th>Shipping Address</th>
                                    <th>Notes</th>
                                    <th>Created</th>
                                    <th>Status</th>
                                    @if($order->order_status != 'closed' && $order->order_status != 'cancel')
                                    <th>Invoice</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($order->voucherTimelines)>0)
                                    @foreach($order->voucherTimelines as $index => $voucherTimeline)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$voucherTimeline->invoice_id}} <br/>{{\Carbon\Carbon::parse($voucherTimeline->invoice_date)->format(Config::get('siteSetting.date_format'))}}
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
                                        
                                        <td>{{ $voucherTimeline->notes }}</td>
                                        <td>{{ $voucherTimeline->createdBy->name }}</td>
                                        <td> 
                                            <span class="mytooltip tooltip-effect-2">
                                                <select name="status" class="selectpicker" data-style="btn-sm @if($voucherTimeline->status == 'delivered') btn-success @elseif($voucherTimeline->status == 'processing') btn-warning 
                                                @elseif($voucherTimeline->shipping_status == 'ready-to-ship') btn-info
                                                @elseif($voucherTimeline->status == 'cancel')  btn-danger @elseif($voucherTimeline->status == 'on-delivery') btn-primary 
                                                @else btn-info @endif " id="order_status" onchange="changeVoucherStatus(this.value, '{{$voucherTimeline->invoice_id}}')">
                                                    <option value="processing" @if($voucherTimeline->status == 'processing') selected @endif>Processing</option>
                                                    
                                                    <option value="ready-to-ship" @if($voucherTimeline->status == 'ready-to-ship') selected @endif>Ready to ship</option>
                                                    @if(Auth::guard('admin')->user()->role_id == 'admin' || in_array(Auth::guard('admin')->id(), [19,22,25]))
                                                    <option value="on-delivery" @if($voucherTimeline->status == 'on-delivery') selected @endif>On Delivery</option>
                                                    <option value="delivered" @if($voucherTimeline->status == 'delivered') selected @endif>Delivered</option>
                                                    <option value="return"  @if($voucherTimeline->status == 'return') selected @endif >Return</option>
                                                    @endif
                                                </select>
                                                <span class="tooltip-content clearfix">
                                                    <span class="tooltip-text">
                                                       @foreach($voucherTimeline->voucherNotify as $notifyNo => $statusNotify)
                                                                @if($statusNotify->notify)
                                                                <p style="font-size: 10px;padding: 0;margin: 0">{{$notifyNo+1}}. By {{($statusNotify->staff) ? $statusNotify->staff->name : 'Customer' }} => {{ucwords($statusNotify->notify)}} <br/><i class="fa fa-clock">  {{\Carbon\Carbon::parse($statusNotify->created_at)->format(Config::get('siteSetting.date_format') .' | '.' h:i A')}}</i></p>
                                                                @endif
                                                            @endforeach
                                                    </span> 
                                                </span>
                                            </span>
                                        </td>
                                        @if($order->order_status != 'closed' && $order->order_status != 'cancel')
                                        <td><a target="_blank" class="dropdown-item" href="{{route('admin.voucherInvoice', $voucherTimeline->invoice_id)}}" class="text-inverse" title="View Voucher Invoice" data-toggle="tooltip"><i class="ti-printer"></i> Invoice</a></td>
                                        @endif
                                    </tr>
                                    @endforeach
                                @else <tr><td style="text-align: center;" colspan="8">There was no delivery @if($order->payment_status == 'paid' && $order->order_status != 'closed' && $order->order_status != 'cancel') <button data-toggle="modal" data-target="#orderInvoiceModal" class="btn btn-success btn-sm">Generate delivery invoice</button> @endif</td></tr> @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Column -->
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
    @if($order->order_status != 'closed' && $order->order_status != 'cancel')
    <div class="modal fade" id="orderInvoiceModal" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Generate Voucher Invoice</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form id="withdrawMakePaymentForm" onsubmit="return confirm('Are you sure generate voucher invoice.?')" action="{{route('admin.voucherInvoiceGenerate', $order->order_id)}}" method="post">
                    @csrf
                    <input type="hidden" name="invoice_no" value="{{count($order->voucherTimelines)+1}}">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="amount"><strong>Invoice Date</strong></label>
                            <input name="invoice_date" required class="form-control" type="date" value="{{ Carbon\Carbon::parse(now())->format('Y-m-d')}}">
                        </div> 
                        <div class="col-md-6">
                            <label for="amount"><strong>Voucher Rate</strong></label>
                            <input name="voucher_rate" @if($order->voucher_rate != null) disabled @endif required class="form-control" placeholder="set rate" type="text" value="{{$order->voucher_rate}}">
                        </div>
                        <div class="col-md-12">
                            <label for="shipping_method"><strong>Shipping Method</strong></label>
                            <select required class="form-control" name="shipping_method" id="shipping_method" onchange="changeShippingMethod(this.value, '{{$order->order_id}}')">
                                <option value="">Select Shipping Method</option>
                                @foreach($shipping_methods as $shipping_method)
                                <option value="{{$shipping_method->name}}" @if($shipping_method->id ==  $order->shipping_method_id) selected @endif >{{$shipping_method->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="notes"><strong>Delivery Type</strong></label>
                            <select name="delivery_type" required="" class="form-control" id="delivery_type">
                                <option value="">Select Type</option>
                                <option value="product">Product</option>
                                <option value="amount">Amount</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="notes"><strong>Delivery Status</strong></label>
                            <select name="status" required="" class="form-control" id="status">
                                <option value="">Select Status</option>
                                <option value="processing">Processing</option>
                                <option value="ready-to-ship">Ready to ship</option>
                                <option value="on-delivery">On Delivery</option>
                                <option value="delivered">Delivered</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="notes"><strong>Notes</strong></label>
                            <textarea required style="width:100%;resize: vertical;" rows="2" name="notes" id="notes"  placeholder="Write Notes" class="form-control"></textarea>
                        </div>
                        <div class="col-md-12">
                            <div class="modal-footer">
                                <button type="submit" name="submit" class="btn btn-success"> <i class="fa fa-check"></i> Generate Now</button>
                            </div>
                        </div>
                                    
                    </div>
                </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @endif
@endsection
@section('js')

    <script type="text/javascript">
        function changeVoucherStatus(status, invoice_id) {
            if (confirm("Are you sure "+status+ " this order.?")) {
                var link = "{{route('admin.changeVoucherStatus')}}";
                $.ajax({
                    url:link,
                    method:"get",
                    data:{'status': status, 'invoice_id': invoice_id},
                    success:function(data){
                        if(data.status){
                            toastr.success(data.message);
                        }else{
                            toastr.error(data.message);
                        }
                    }
                });
            }
            return false;
        }        
    </script>

    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
 
    <script src="{{asset('assets')}}/node_modules/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <script>
        $(function () {
            $('.selectpicker').selectpicker();
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
