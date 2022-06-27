@extends('layouts.frontend')
@section('title', 'Tracking Details | '. Config::get('siteSetting.site_name') )

@section('metatag')
    <meta name="title" content="{{ $order->order_details[0]->product->title }} | {{$order->billing_name}}">
    <meta name="description" content="{{ $order->order_details[0]->product->title }}">
 
    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta property="og:title" content="{{ $order->order_details[0]->product->title }} | {{$order->billing_name}}">
    <meta property="og:description" content="{{ $order->order_details[0]->product->title }}">
    @if($order->order_details[0]->product)
  <meta property="og:image" content="{{asset('upload/images/product/thumb/'.$order->order_details[0]->product->feature_image)}}">
  @endif
    
    <meta property="og:url" content="{{ url()->full() }}">
    <meta property="og:site_name" content="{{Config::get('siteSetting.site_name')}}">
    <meta property="og:locale" content="en">
    <meta property="og:type" content="website">
    <meta property="fb:admins" content="1323213265465">
    <meta property="fb:app_id" content="13212465454">
    <meta property="og:type" content="e-commerce">

    <!-- Schema.org for Google -->

    <meta itemprop="title" content="{{ $order->order_details[0]->product->title }}">
    <meta itemprop="description" content="{{ $order->order_details[0]->product->title }}">
    <meta itemprop="image" content="{{asset('upload/images/product/thumb/'.$order->order_details[0]->product->feature_image)}}">
 @endsection
@section('css')
    <style type="text/css">

        .orderprogressbar {
          counter-reset: step;
        }

        .orderprogressbar li {
          position: relative;
          list-style: none;
          float: left;
          width: 19.33%;
          text-align: center;
        }

        /* Circles */
        .orderprogressbar li:before {
          content: counter(step);
          counter-increment: step;
          width: 40px;
          height: 40px;
          border: 1px solid #2979FF;
          display: block;
          text-align: center;
          margin: 0 auto 10px auto;
          border-radius: 50%;
          background-color: #ddd;
           
          /* Center # in circle */
          line-height: 39px;
        }

        .orderprogressbar li:after {
          content: "";
          position: absolute;
          width: 100%;
          height: 5px;
          background: #ddd ;
          top: 20px; /*half of height Parent (li) */
          left: -50%;
          z-index: -1;
        }

        .orderprogressbar li:first-child:after {
          content: none;
        }

        .orderprogressbar li.active:before {
          background: #0f7d0f;
          content: "✔";  
          color: #fff;
        }
        .orderprogressbar li.orderprocess:before {
          background: orange;
          content: "\039F";  
        }

        .orderprogressbar li.active + li:after {
          background: #0f7d0f;
        }

        #content{position: sticky !important;}
       
        .title{border-bottom: 1px solid #ccc;padding-bottom:10px;}
    </style>
@endsection
@section('content')
  <div class="breadcrumbs">
      <div class="container">
          <ul class="breadcrumb-cate">
              <li><a href="{{url('/')}}"><i class="fa fa-home"></i> </a></li>
              <li><a href="#">Order Infomation</a></li>
          </ul>
      </div>
  </div>
    <!-- Main Container  -->
    <div class="container">
        <div class="row">
            <!--Middle Part Start-->
            <div id="content" class="col-md-9 sticky-content">
                <h2 class="title"><a href="{{ url()->previous() }}"> <i class="fa fa-angle-left"></i> Tracking Details</a></h2>
                <div style="width: 100%; display: inline-block;margin-top: 10px;">
                  <ul class="orderprogressbar">
                    @if($order->payment_method == 'pending')
                    <li class="@if('payment_method' != 'cod') orderprocess @endif">Payment @if('cod' == 'cod') Pending @endif</li>
                    @endif
                   
                    <li  @if($order->order_status == 'pending' && $order->payment_method != 'pending') class="orderprocess" @endif @if($order->order_status != 'pending' && $order->payment_method != 'pending') class="active" @endif >Order placed</li>

                    @if($order->order_status != 'cancel')
                    <li  @if($order->order_status == 'accepted') class="orderprocess" @endif  @if($order->order_status == 'on-delivery' || $order->order_status == 'ready-to-ship' || $order->order_status == 'accepted' || $order->order_status == 'delivered') class="active" @endif>Processing</li>

                    <li  @if($order->order_status == 'ready-to-ship') class="orderprocess" @endif  @if($order->order_status == 'on-delivery' || $order->order_status == 'ready-to-ship' || $order->order_status == 'delivered') class="active" @endif>Ready to ship</li>

                    <li  @if($order->order_status == 'on-delivery') class="orderprocess" @endif   @if($order->order_status == 'delivered') class="active" @endif>On Delivery</li>
                    <li @if($order->order_status == 'delivered') class="active" @endif >Delivered</li>
                    @else
                    <li class="active">Cancel</li>
                    @endif
                  </ul>
                </div>
                
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            @if($order->payment_method == 'pending')
                            <td colspan="2">
                                <span  class="text-left">Order Details</span> 
                                <span style="float: right;" class="text-right"> Payment Pending <a style="margin-top: 5px;" href="{{route('order.paymentGateway', $order->order_id)}}" class="btn btn-danger">Pay Now</a></span>
                            </td>
                            @else
                            <td colspan="2" class="text-left">Order Details</td>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width: 50%;" class="text-left"> <b>Order ID:</b> #{{$order->order_id}}
                                <br>
                                <b>Order Date:</b> {{Carbon\Carbon::parse($order->order_date)->format(Config::get('siteSetting.date_format'))}}
                            </td>
                            <td style="width: 50%;" class="text-left"> 
                                <b>Shipping Status::</b> {{ $order['order_status'] }} <br>
                                <b>Payment Status:</b> {{$order->payment_status}} <br>
                                <b>Payment Method:</b> {{$order->payment_method}} 
                                 @if($order->shipping_method)<br> <b>Shipping Method:</b>{{ $order->shipping_method->name }} @endif<br>
                            </td>
                        </tr>
                    </tbody>
                </table>
              
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td class="text-left">Product</td>
                                <td class="text-right">Quantity</td>
                                <td class="text-right">Price</td>
                                <td class="text-right">Total</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->order_details as $order_detail)
                                         
                            <tr>
                                <td class="text-left">
                                    <img width="50" src="{{ asset('upload/images/product/thumb/'.$order_detail->product->feature_image) }}"> 
                                     <a href="{{route('product_details', $order_detail->product->slug)}}">{{Str::limit($order_detail->product->title, 50)}}</a><br>
                                    @if($order_detail->attributes)
                                    @foreach(json_decode($order_detail->attributes) as $key=>$value)
                                    <small> {{$key}} : {{$value}} </small>
                                    @endforeach
                                    @endif
                                </td>
                                
                                <td class="text-right">{{$order_detail->qty}}</td>
                                <td class="text-right">{{$order->currency_sign. $order_detail->price}}</td>
                                <td class="text-right">{{$order->currency_sign. $order_detail->price*$order_detail->qty}}</td>
                               
                            </tr>
                            @endforeach
                        </tbody>
                       
                    </table>
                </div>
                @if(count($order->voucherTimelines)>0)
                <h4>Voucher Delivery Timeline</h4>
                <div class="table-responsive">
                        <table class="table display table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Invoice</th>
                                    <th>Customer</th>
                                    <th>Shipping Address</th>
                                  
                                    <th>Status</th>
                                    
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
                                        
                                        <td> 
                                            
                                            <span class="btn-sm @if($voucherTimeline->status == 'delivered') btn-success @elseif($voucherTimeline->status == 'processing') btn-warning 
                                            @elseif($voucherTimeline->shipping_status == 'ready-to-ship') btn-info
                                            @elseif($voucherTimeline->status == 'cancel')  btn-danger @elseif($voucherTimeline->status == 'on-delivery') btn-primary 
                                            @else btn-info @endif ">
                                               {{ str_replace('-', ' ', $voucherTimeline->status)}}
                                            </span>
                                                
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else <tr><td style="text-align: center;" colspan="8">There was no delivery @if($order->order_status != 'closed' && $order->order_status != 'cancel') <button data-toggle="modal" data-target="#orderInvoiceModal" class="btn btn-success btn-sm">Generate delivery invoice</button> @endif</td></tr> @endif
                            </tbody>
                        </table>
                    </div>
                @endif
                <div class="buttons clearfix">
                    <div class="pull-right"><a class="btn btn-primary" href="{{url('/')}}">Continue Shop</a>
                    </div>
                </div>
            </div>
            <!--Middle Part End-->
            <div  class="col-md-3 sticky-content">
              @if(count($related_products)>0)
              <div class="moduletable module so-extraslider-ltr best-seller best-seller-custom">
               
                <div class="modcontent">
                  
                  <div id="so_extra_slider" class="so-extraslider buttom-type1 preset00-1 preset01-1 preset02-1 preset03-1 preset04-1 button-type1">
                    <div class="extraslider-inner " >
                        <div class="item ">
                          Related products
                          @foreach($related_products as $product)
                          <div class="item-wrap style1 ">
                            <div class="item-wrap-inner">
                             <div class="media-left">
                              <div class="item-image">
                                 <div class="item-img-info product-image-container ">
                                  <div class="box-label">
                                  </div>
                                  <a class="lt-image" data-product="66" href="{{ route('product_details', $product->slug) }}" >
                                  <img src="{{asset('upload/images/product/thumb/'. $product->feature_image)}}" alt="">
                                  </a>
                                 </div>
                              </div>
                             </div>
                             <div class="media-body">
                              <div class="item-info">
                                 <!-- Begin title -->
                                 <div class="item-title">
                                  <a href="{{ route('product_details', $product->slug) }}" target="_self">
                                 {{Str::limit($product->title, 40)}}
                                  </a>
                                 </div>
                                 <!-- Begin ratting -->
                                 <div class="price  price-left" style="font-size: 12px;">
                                  <!-- Begin ratting -->
                                 <div>
                                 {{\App\Http\Controllers\HelperController::ratting(round($product->reviews->avg('ratting'), 1))}}
                                 </div>
                                  <?php  
                                      $discount = null;
                                      //check offer active/inactive
                                      if($product->offer_product && $product->offer_product->offer != null){

                                          $selling_price = $product->selling_price;
                                          $discount = $product->offer_product->offer_discount;
                                          $discount_type = $product->offer_product->discount_type;
                                         
                                      }else{
                                          $selling_price = $product->selling_price;
                                          $discount = $product->discount;
                                          $discount_type = $product->discount_type;
                                      }

                                      $calculate_discount = App\Http\Controllers\HelperController::calculate_discount($selling_price, $discount, $discount_type );
                                  ?>
                                    @if($discount)
                                        <span class="price-new">{{Config::get('siteSetting.currency_symble')}}{{ $calculate_discount['price'] }}</span>
                                        <span class="price-old">{{Config::get('siteSetting.currency_symble')}}{{$selling_price}}</span>
                                    @else
                                        <span class="price-new">{{Config::get('siteSetting.currency_symble')}}{{$selling_price}}</span>
                                    @endif
                                </div>

                                @if($discount)
                                <div class="price-sale price-right">
                                    <span class="discount">
                                      @if($discount_type == '%')-@endif{{$calculate_discount['discount']}}%
                                    <strong>OFF</strong>
                                  </span>
                                </div>
                                @endif
                              </div>
                             </div>
                             <!-- End item-info -->
                            </div>
                            <!-- End item-wrap-inner -->
                          </div>
                          @endforeach
                        </div>
                    </div>
                  </div>
                </div>
             </div>
             @endif
            </div>
        </div>
    </div>
    <!-- //Main Container -->
@endsection
