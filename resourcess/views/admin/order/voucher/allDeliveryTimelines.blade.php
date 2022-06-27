@extends('layouts.admin-master')
@section('title', 'Voucher Delivery Timeline')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/stylish-tooltip.css') }}">
    <link href="{{asset('assets')}}/node_modules/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <style type="text/css">
         .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn){max-width: 100px;}
        .mytooltip{z-index: initial;}
        .form-control{padding-left: 5px ;}
    </style>
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
                    <h4 class="text-themecolor"><a href="{{ route('admin.voucherOrderList') }}"> <i class="fa fa-angle-left"></i> </a>Voucher Delivery Timelines</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <button data-toggle="modal" data-target="#Export" class="btn btn-success btn-sm d-none d-lg-block m-l-15"><i class="fa fa-download"></i> Export</button>
                        <a class="btn btn-info btn-sm d-none d-lg-block m-l-15" href="{{route('admin.voucherOrderList')}}"><i class="fa fa-arrow-left"></i> Back Voucher lists</a>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            
                <div class="card">
                    <div class="card-body">
                        
                    
                    <form action="{{route('admin.voucherTimelines')}}" id="orerControll" method="get">
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
                                                                              
                                    
                                    <div class="col-md-1 col-6">
                                        <div class="form-group">
                                            <label class="control-label"> Type  </label>
                                            <select name="delivery_type" class="form-control">
                                                <option value="">All Type</option>
                                                <option value="product" {{ (Request::get('delivery_type') == 'product') ? 'selected' : ''}}>Product</option>
                                                <option value="amount" {{ (Request::get('delivery_type') == 'amount') ? 'selected' : ''}}>Amount</option>
                                               
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-6">
                                        <div class="form-group">
                                            <label class="control-label"> Status  </label>
                                            <select name="status" class="form-control">
                                                <option value="">All Status</option>
                                                <option value="ready-to-ship" {{ (Request::get('status') == 'ready-to-ship') ? 'selected' : ''}}>Ready to ship</option>
                                                <option value="on-delivery" {{ (Request::get('status') == 'on-delivery') ? 'selected' : ''}}>On Delivery</option>
                                                <option value="delivered" {{ (Request::get('status') == 'delivered') ? 'selected' : ''}}>Delivered</option>
                                                <option value="return" {{ (Request::get('status') == "return") ? 'selected' : ''}}>Return</option>
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

                    
                    <h3>Total Voucher: {{count($voucherTimelines)}}</h3>
                    <div class="table-responsive">
                        <table class="table display table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th style="min-width: 120px;">Order</th>
                                    <th style="min-width: 100px;">Voucher</th>
                                    <th style="width:90px;">Customer</th>
                                    <th>Qty×Rate</th>
                                    <th>Amount</th>
                                    <th style="max-width: 150px;">Shipping Address</th>
                                    <th>Notes</th>
                                    <th>Created</th>
                                    <th>Status</th>
                                    <th>Invoice</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($voucherTimelines)>0)
                                    @foreach($voucherTimelines as $index => $voucherTimeline)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$voucherTimeline->invoice_id}}<br>
                                        {{\Carbon\Carbon::parse($voucherTimeline->invoice_date)->format(Config::get('siteSetting.date_format'))}}
                                       
                                       </td>
                                        <td>
                                            @if(count($voucherTimeline->order->order_details)>0)
                                            <a target="_blank" style="text-transform: lowercase;" href="{{ route('product_details', $voucherTimeline->order->order_details[0]->product->slug)}}">
                                            <img width="50" src="{{asset('upload/images/product/'.$voucherTimeline->order->order_details[0]->product->feature_image)}}">
                                            {{ $voucherTimeline->order->order_details[0]->product->title }} </a>@endif</td>
                                        <td>{{ $voucherTimeline->shipping_name }}
                                        <p style="font-size: 12px;margin: 0;padding: 0">{{ $voucherTimeline->shipping_phone }}</p>
                                        </td>
                                        <td>{{$voucherTimeline->voucher_qty.'×'.$voucherTimeline->voucher_rate}}</td>
                                        <td>{{$voucherTimeline->order->currency_sign. $voucherTimeline->voucher_qty * $voucherTimeline->voucher_rate}}</td>
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
                                       
                                        <td>
                                             @if($voucherTimeline->order->order_status != 'closed' && $voucherTimeline->order->order_status != 'cancel')<a target="_blank" class="dropdown-item" href="{{route('admin.voucherInvoice', $voucherTimeline->invoice_id)}}" class="text-inverse" title="View Voucher Invoice" data-toggle="tooltip"><i class="ti-printer"></i> Invoice</a> @else
                                        <span style="color:red">Voucher {{$voucherTimeline->order->order_status}}</span>
                                        @endif</td>
                                        
                                    </tr>
                                    @endforeach
                                @else <tr><td style="text-align: center;" colspan="8">There was no delivery found.</td></tr> @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Column -->
            </div>
            <div class="row">
               <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                   {{$voucherTimelines->appends(request()->query())->links()}}
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing {{ $voucherTimelines->firstItem() }} to {{ $voucherTimelines->lastItem() }} of total {{$voucherTimelines->total()}} entries ({{$voucherTimelines->lastPage()}} Pages)</div>
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>

    <div class="modal fade" id="Export" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="padding: 5px 15px;">
                    <h4 class="modal-title" id="myLargeModalLabel">Export Data Filter</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.exportVoucherTimeline') }}" id="exportVoucherTimeline" method="get">
                        <div class="row">
                        <div class="col-md-6 col-6">
                            <div class="form-group">
                                <label class="control-label">Delivery Status  </label>
                                <select name="status" class="form-control">
                                    <option value="">All Status</option>
                                    <option value="ready-to-ship" {{ (Request::get('status') == 'ready-to-ship') ? 'selected' : ''}}>Ready to ship</option>
                                    <option value="on-delivery" {{ (Request::get('status') == 'on-delivery') ? 'selected' : ''}}>On Delivery</option>
                                    <option value="delivered" {{ (Request::get('status') == 'delivered') ? 'selected' : ''}}>Delivered</option>
                                    <option value="return" {{ (Request::get('status') == "return") ? 'selected' : ''}}>Return</option>
                                </select>
                            </div>
                        </div>  
                        <div class="col-md-6 col-6">
                            <div class="form-group">
                                <label class="control-label">Delivery Type  </label>
                                <select name="delivery_type" class="form-control">
                                    <option value="">All Type</option>
                                    <option value="product" {{ (Request::get('delivery_type') == 'product') ? 'selected' : ''}}>Product</option>
                                    <option value="amount" {{ (Request::get('delivery_type') == 'amount') ? 'selected' : ''}}>Amount</option>
                                   
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-6">
                            <div class="form-group">
                                <label class="control-label">From Date</label>
                                <input name="from_date" value="{{ Request::get('from_date')}}" type="date" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 col-6">
                            <div class="form-group">
                                <label class="control-label">End Date</label>
                                <input name="end_date" value="{{ Request::get('end_date')}}" type="date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 col-6">
                            <div class="form-group">
                               <button type="submit" class="form-control btn btn-success"><i class="ti-download"></i> Export Data</button>
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
@endsection
@section('js')
   <script src="{{asset('assets')}}/node_modules/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <script>
        $(function () {
            $('.selectpicker').selectpicker();
        });
    </script>
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

        $('#exportVoucherTimeline').submit(function() {
            $('#Export').modal('hide');
        });    
    </script>
@endsection
