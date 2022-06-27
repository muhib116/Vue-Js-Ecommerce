<div class="row">
    <div class="col-md-12">
        <div class="pull-left" style="float: left;max-width: 60%">
            <address>
                {{$order->shipping_name}}
                @if($order->shipping_email)<br>{{$order->shipping_email}}@endif
                <br>{{$order->shipping_phone}}
                <br>
                {!!
                    $order->shipping_address. ', '.
                    $order->shipping_area. ', '.
                    $order->shipping_city. ', '.
                    $order->shipping_region
                
                !!}
                @if($order->order_notes)<br><b style="font-weight: bold;">Notes: </b>{{$order->order_notes}}@endif
            </address>
        </div>
        <div class="pull-right text-right">
            <address>
            <strong>Order ID:</strong> #{{$order->order_id}} <br>
            <b>Order Date:</b> {{Carbon\Carbon::parse($order->order_date)->format('M d, Y')}}<br> 
            <b>Payment Status:</b> {{str_replace( '-', ' ',$order->payment_status) }} <br>
            <b>Payment Method:</b> {{str_replace( '-', ' ',  $order->payment_method) }} <br>
            </address>
        </div>
    </div>

    <div class="col-md-12">
        <div class="table-responsive" style="clear: both;">
            <table class="table table-hover" style="width: 100%">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Voucher Rate</th>
                        <th>Price</th>
                        <th style="text-align: center;">Qty</th>
                        <th style="text-align: right;">Sub Total</th>
                        <th>Status</th>
                    </tr>
                </thead> 
                <tbody>
                    <?php $total = 0; ?>
                    @foreach($order->order_details as $item)
                        @php $attribute = ''; @endphp
                        @if($item->product)
                        <tr @if( $item->shipping_status == 'cancel' || $item->shipping_status == 'return') style="background:#ff000026" @endif>
                            <td><img src="{{asset('upload/images/product/'.$item->product->feature_image)}}" width="48" height="38" ><a target="_blank" href="{{ route('product_details', $item->product->slug) }}"> {{Str::limit($item->product->title, 50)}} </a> <br>
                            @if($item->attributes) 
                                @foreach(json_decode($item->attributes) as $key=>$value)
                                @php $attribute .= $value; @endphp
                                @endforeach
                            @endif
                           <!--  @if($order->order_status != 'delivered') 
                                <input style="width: 80%;" type="text" class="form-control" value="{{ $attribute }}" id="attributes{{$item->product_id}}" placeholder="Exm: color:red, size:30">
                                <button style="padding: 9px 10px;" class="btn btn-sm btn-info" onclick="addedAttribute('{{$order->order_id}}', '{{$item->product_id}}')" type="button"> Set </button>  
                            @endif -->
                            </td>
                            <td><input style="width: 40%;" type="text" class="form-control" value="{{ $order->voucher_rate }}" id="voucher_rate{{$order->order_id}}" placeholder="Set Rate">
                                <button style="padding: 9px 10px;" class="btn btn-sm btn-info" onclick="voucherRate('{{$order->order_id}}')" type="button"> Set </button> </td>
                            <td>{{$order->currency_sign. $item->price}}</td>
                            <td style="text-align: center;">{{$item->qty}}</td>
                            <td style="text-align: right;">{{$order->currency_sign. $item->price*$item->qty}}</td>
                            <td>
                            <select name="status" class="selectpicker" data-style="btn-sm @if($order->order_status == 'delivered') btn-success @elseif($order->order_status == 'accepted') btn-warning @elseif($order->order_status == 'cancel')  btn-danger @elseif($order->order_status == 'on-delivery') btn-primary @else btn-info @endif " id="order_status" onchange="changeOrderStatus(this.value, '{{$order->order_id}}')">
            
					            <option disabled value="pending" @if($order->order_status == 'pending') selected @endif>Pending</option>
					            <option value="accepted" @if($order->order_status == 'accepted') selected @endif>Accepted</option>

                                <option value="cancel" @if($order->order_status == 'cancel') selected @endif>Cancel</option>
					            
					            @if(Auth::guard('admin')->user()->role_id == 'admin' || in_array(Auth::guard('admin')->id(), [19,22,25]))
					               <option value="closed"  @if($order->order_status == 'closed') selected @endif >Closed</option>
					            @endif
					          
					        </select>
                            @if(Auth::guard('admin')->user()->role_id == 'admin')
                            <br/>
                            <a style="margin-top: 5px;" href="javascript:void(0)" class="btn btn-success btn-sm" onclick="reviewModal('{{$order->order_id}}','{{$item->product_id}}')" data-toggle="tooltip" data-original-title=" Write Product Review"><i class="fa fa-edit"></i> Write Review</a>
                            @endif
                        </td>
                        </tr> 
                        @endif
                    @endforeach
                </tbody>
                <tfoot style="text-align: right;">
                    <tr>
                        <td colspan="2"></td>
                        <td ><b>Sub-Total</b>
                        </td>
                        <td >{{$order->currency_sign . $order->total_price}}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td ><b>Shipping Cost(+)</b>
                        </td>
                        <td >{{$order->currency_sign . $order->shipping_cost}}</td>
                        <td></td>
                    </tr>
                    @if($order['coupon_discount'] != null)
                    <tr>
                        <td colspan="2"></td>
                        <td ><b>Coupon Discount(-)</b>
                        </td>
                        <td >{{$order->currency_sign . $order->coupon_discount}}</td>
                        <td></td>
                    </tr>
                    @endif
                    <tr>
                        <td colspan="2"></td>
                        <td ><b>Comments</b>
                        </td>
                        <td><textarea type="text" rows="1" style="text-align: right;" class="form-control" id="comment" placeholder="Write Comment" name="comment"></textarea> 
                        </td>
                        <td style="text-align: left;">
                            <span class="mytooltip tooltip-effect-2">
                                <button class="btn btn-sm btn-info" onclick="addedOrderInfo('comment', '{{ $order->order_id }}')" type="button">Comment</button> 
                                <span class="tooltip-content clearfix">
                                <span class="tooltip-text" style="line-height: 15px;">
                                    {!! $order->comment !!}
                                </span>
                                </span>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td><h3><b>Total</b></h3>
                        </td>
                        <td><h3>{{$order->currency_sign . ($order->total_price + $order->shipping_cost - $order->coupon_discount)  }}</h3></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<div style="text-align: right;"> <a target="_blank" href="{{route('admin.voucherTimelineDetails', $order->order_id)}}" class="text-inverse" title="View Delivery Timeline" data-toggle="tooltip"><i class="ti-eye"></i> View Delivery Timeline</a></div>