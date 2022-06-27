<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Notification;
use App\Models\Offer;
use App\Models\Order;
use App\Models\OrderCancelReason;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ShippingAddress;
use App\Models\SiteSetting;
use App\Models\Transaction;
use App\Models\AffiliateAgentProduct;
use App\Models\AffiliateAgent;
use App\Traits\CreateSlug;
use App\Traits\Sms;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    use Sms;
    use CreateSlug;
    //Insert order in order table
    public function orderConfirm(Request $request)
    {
        $shipping_address = ShippingAddress::with(['get_country','get_state','get_city', 'get_area'])->find($request->confirm_shipping_address);
        if($shipping_address) {
            $user_id = Auth::id();
            //get cart items
            $cartItems = Cart::where('user_id', $user_id)->groupBy('product_id')->orderBy('id', 'asc');
            //check direct checkout product
            if(Cookie::has('direct_checkout_product_id') || Session::get('direct_checkout_product_id')){
                $direct_checkout_product_id = (Cookie::has('direct_checkout_product_id') ? Cookie::get('direct_checkout_product_id') :  Session::get('direct_checkout_product_id'));
                $cartItems = $cartItems->where('product_id', $direct_checkout_product_id);
            }
            $cartItems = $cartItems->get();
            if(!count($cartItems)>0) {
                return redirect()->back();
            }
            //get offer prefix id
            $prefix = null;
            $offer_id = $cartItems->pluck('offer_id')->toArray();
            $offer_id = array_values(array_filter($offer_id));
            if($offer_id){
                $offer = Offer::where('id', $offer_id[0])->select('prefix_id')->first();
                if($offer){
                    $prefix = $offer->prefix_id;
                }
            }
            $prefix = ($prefix) ? $prefix : 'W';
            $prefix = $prefix.$user_id;
            $order_id = $this->uniqueOrderId('orders', 'order_id', $prefix);

            $total_qty = array_sum(array_column($cartItems->toArray(), 'qty'));
            //old price
            $total_price = array_sum(array_column($cartItems->toArray(), 'price'));
            $coupon_discount = null;
            if (Session::has('couponAmount')) {
                $coupon = Coupon::where('coupon_code', Session::get('couponCode'))->first();
                if( $coupon && $coupon->times != null)
                {
                    if($coupon->times > 0)
                    {
                        $coupon_discount = (Session::get('couponType') == '%') ? round($total_price * Session::get('couponAmount'), 2) : Session::get('couponAmount');
                        $coupon->decrement('times', 1);
                    }
                }
            }

            //insert order in order table
            $order = new Order();
            $order->order_id = $order_id;
            $order->user_id = $user_id;
            $order->total_qty = $total_qty;
            $order->total_price = $total_price;
            $order->coupon_code = ($coupon_discount ? Session::get('couponCode') : null);
            $order->coupon_discount = $coupon_discount;
            $order->shipping_method_id = ($request->shipping_method) ? $request->shipping_method : null;

            $order->billing_name = Auth::user()->name;
            $order->billing_phone = Auth::user()->mobile;
            $order->billing_email = Auth::user()->email;
            $order->billing_country = Auth::user()->country;
            $order->billing_region = Auth::user()->region;
            $order->billing_city = Auth::user()->city;
            $order->billing_area = Auth::user()->area;
            $order->billing_address = Auth::user()->address;

            $order->shipping_name = $shipping_address->name;
            $order->shipping_phone = $shipping_address->phone;
            $order->shipping_email = $shipping_address->email;
            $order->shipping_country = $shipping_address->get_country->name;
            $order->shipping_region = $shipping_address->get_state->name;
            $order->shipping_city = $shipping_address->get_city->name;
            $order->shipping_area = ($shipping_address->get_area) ? $shipping_address->get_area->name : null;
            $order->shipping_address = $shipping_address->address;
            $order->order_notes = $request->order_notes;
            $order->currency = Config::get('siteSetting.currency');
            $order->currency_sign = Config::get('siteSetting.currency_symble');
            $order->currency_value = Config::get('siteSetting.currency_symble');
            $order->order_date = now();
            $order->payment_status = 'pending';
            $order->order_status = 'pending';
            $order = $order->save();
            if ($order) {
                // insert product details in table
                $total_shipping_cost = $total_price = 0;
                foreach ($cartItems as $item) {
                    $price =  $item->price;
                    $total_price += $price*$item->qty;
                    //calculate shipping cost
                    if(config('siteSetting.shipping_method') == 'product_wise_shipping'){
                        $shipping_cost = $item->get_product->shipping_cost;
                        //check product_wise_shipping shipping method type
                        if($item->get_product->shipping_method == 'location'){
                            if ($item->get_product->ship_region_id != $shipping_address->region) {
                                $shipping_cost = $item->get_product->other_region_cost;
                            }
                        }
                    }else{
                        //other shipping method
                        $shipping_cost =  \App\Http\Controllers\HelperController::shippingCharge($shipping_address->region);
                    }
                    //if this mystery-box product shipping cost 0
                    $shipping_cost = ($item->get_product->product_type == 'mystery-box' && $item->get_product->shipping_method == 'free') ? 0 : $shipping_cost;
                    //check shipping calculate type
                    if(config('siteSetting.shipping_calculate') == 'per_product'){
                        $total_shipping_cost +=  $shipping_cost;
                    }else{
                        if($shipping_cost > $total_shipping_cost) {
                            $total_shipping_cost = $shipping_cost;
                        }
                    }
                    //check voucher product
                    $is_voucher = ($item->get_product->product_type == 'voucher') ? 1 : null;
                    //check pre order
                    $is_pre_order = ($item->get_product->product_type == 'pre-order') ? 1 : null;
                    $order_type = ($item->get_product->product_type) ? $item->get_product->product_type : 'add-to-cart';
                    //check referral product
                    $affiliate = null;
                    if($item->affiliate_agent_id) {
                        $affiliate = AffiliateAgent::join('affiliate_agent_products', 'affiliate_agents.user_id', 'affiliate_agent_products.agent_id')
                            ->join('affiliate_products', 'affiliate_agent_products.product_id', 'affiliate_products.product_id')
                            ->where('agent_id', $item->affiliate_agent_id)
                            ->where('affiliate_agent_products.product_id', $item->product_id)
                            ->where('affiliate_products.status', 'active')
                            ->selectRaw('affiliate_agent_products.agent_id , affiliate_agent_products.agent_price, affiliate_products.office_rate')->first();
                    }
					
					
					
					 $b2bproduct = Product::find($item->product_id);
					
                    $orderDetails = new OrderDetail();
                    $orderDetails->order_id = $order_id;
                    $orderDetails->offer_id = ($item->offer_id) ? $item->offer_id : null;
                    $orderDetails->is_voucher = $is_voucher;
                    $orderDetails->is_pre_order = $is_pre_order;
                    $orderDetails->order_type = $order_type;
                    $orderDetails->vendor_id = $item->get_product->vendor_id;
                    $orderDetails->user_id = $user_id;
					
					$b2bproduct = Product::find($item->product_id);
					
					if($b2bproduct->is_b2b == 1){
						$orderDetails->is_b2b = 1;
					}
					
                    $orderDetails->product_id = $item->product_id;
                    $orderDetails->qty = $item->qty;
                    $orderDetails->price = $price;
                    $orderDetails->shipping_charge = $shipping_cost;
                    $orderDetails->coupon_discount = ($coupon_discount ? ($coupon_discount / $total_price) * ($item->price*$item->qty) : null);
                    $orderDetails->attributes = $item->attributes;
                    $orderDetails->shipping_status = 'pending';
                    if($affiliate){
                        $orderDetails->affiliate_agent_id = $item->affiliate_agent_id;
                        $orderDetails->affiliate_amount = $item->affiliate_amount;
                    }
                    $orderDetails->save();
                    //make array offer id
                    $offer_id[] = $item->offer_id;
                    //make array cart id for cart item delete
                    $cart_id[] = $item->id;
                    //minus product stock qty
                    if($item->qty <= $item->get_product->stock && $item->get_product->product_type == 'mystery-box') {
                        $item->get_product->decrement('stock', $item->qty);
                    }
                }
                // $offer_id = array_values(array_unique(array_filter($offer_id)));
                // $offer_id = (count($offer_id ) > 0) ? json_encode($offer_id) : null;
                $offer_id = $item->offer_id;
                //update order
				
				$b2b = OrderDetail::where('order_id', $order_id)->where('is_b2b', 1)->count();
				
				if($b2b>0){
                Order::where('order_id', $order_id)->update(['total_price' => $total_price, 'shipping_cost' => $total_shipping_cost, 'offer_id' => $offer_id, 'order_type' => $order_type, 'is_voucher' => $is_voucher, 'is_pre_order' => $is_pre_order, 'is_b2b' =>1]);
                } else {
					 Order::where('order_id', $order_id)->update(['total_price' => $total_price, 'shipping_cost' => $total_shipping_cost, 'offer_id' => $offer_id, 'order_type' => $order_type, 'is_voucher' => $is_voucher, 'is_pre_order' => $is_pre_order ]);
				}
				
				
				
				//delete cart item
                Cart::whereIn('id', $cart_id)->delete();
            }
            Session::put('shipping_city', $shipping_address->get_city->id);
            Session::forget('couponCode');
            Session::forget('couponType');
            Session::forget('couponAmount');
            //redirect payment method page for payment
            return redirect()->route('order.paymentGateway', encrypt($order_id));
        }else{
            Toastr::error('Please select shipping address.');
            return back();
        }
    }

    //get all order by user id
    public function orderHistory($status='')
    {
        $orders = Order::with(['offer','order_details.product:id,title,slug,feature_image', 'orderNotify' => function($query){
            $query->orderBy('id', 'DESC');
        }])->whereNull('is_voucher')->whereNull('is_pre_order')
            ->where('user_id', Auth::id());
        if($status){
            $orders->where('order_status', $status);
        }
        $data['orders'] = $orders->orderBy('id', 'desc')->get();

        return view('users.order-history')->with($data);
    }

    //get downloadable order
    public function orderDownloadable($status='')
    {
        $orders = Order::with(['order_details.product:id,title,slug,feature_image'])
            ->where('user_id', Auth::id());
        if($status){
            $orders = $orders->where('order_status', $status);
        }
        $data['orders'] = $orders->orderBy('id', 'desc')->get();
        return view('users.order-history')->with($data);
    }

    //show order details by order id
    public function orderDetails($orderId){
        $order = Order::with(['order_details.product:id,title,slug,feature_image,product_type,file,file_link','get_country', 'get_state', 'get_city', 'get_area'])
            ->where('user_id', Auth::id())
            ->where('order_id', $orderId)->first();
        if($order){
            $refund = SiteSetting::where('type', 'refund_request')->where('status', 1)->first();
            return view('users.order-details')->with(compact('order', 'refund'));
        }
        return view('404');
    }
    //get all pre order by user id
    //get all order by user id
    public function preOrderHistory($status='')
    {
        $orders = Order::with(['offer','order_details.product:id,title,slug,feature_image,availability_date', 'orderNotify' => function($query){
            $query->orderBy('id', 'DESC');
        }])->where('is_pre_order', 1)->where('user_id', Auth::id());
        if($status){
            $orders->where('order_status', $status);
        }
        $data['orders'] = $orders->orderBy('id', 'desc')->get();
        return view('users.preOrder-history')->with($data);
    }
    //show order invoice by order id
    public function orderInvoice($orderId){
        $order = Order::with(['order_details.product:id,title,slug,feature_image'])
            ->where('order_id', $orderId)->where('user_id', Auth::id())->first();

        if($order){
            return view('users.invoice')->with(compact('order'));
        }
        return view('404');
    }

    //order cancel form
    public function orderCancelForm (Request $request){
        $user_id = Auth::id();
        $data['order'] = Order::where('user_id', $user_id)->where('order_id', $request->order_id)->first();
        $data['orderCancel'] = OrderCancelReason::where('order_id', $request->order_id)->first();
        $data['cancelReasons'] = OrderCancelReason::where('order_id', null)->where('status', 1)->get();
        return view('users.order-cancel-form')->with($data);
    }
    //order cancel
    public function orderCancel (Request $request)
    {
        $user_id = Auth::id();
        $order = Order::with('order_details')
            ->where('order_status', 'pending')
            ->where('payment_method', '!=', 'pending')
            ->where('user_id', $user_id)
            ->where('order_id', $request->order_id)->first();

        if($order) {
            $orderDetails = $order->order_details->where('user_id', $user_id);
            //if specific product change
            if ($request->product_id) {
                $orderDetails = $orderDetails->where('product_id', $request->product_id);
            }
            foreach ($orderDetails as $orderDetail) {
                $orderDetail->shipping_status = 'cancel';
                $orderDetail->shipping_date = Carbon::now();
                $orderDetail->save();

                //insert cancel reason
                $orderCancel = new OrderCancelReason();
                $orderCancel->order_id = $request->order_id;
                $orderCancel->reason = $request->cancel_reason;
                $orderCancel->reason_details = $request->reason_details;
                $orderCancel->seller_id = $orderDetail->vendor_id;
                $orderCancel->user_id = $user_id;
                $orderCancel->user_type = 'customer';
                if ($request->product_id) {
                    $orderCancel->product_id = $request->product_id;
                }
                $orderCancel->status = 1;
                $orderCancel->save();
            }
            //change order status
            $order->order_status = 'cancel';
            $order->updated_at = Carbon::now();
            $order->save();
            if ($order->payment_status == 'paid'){
                //add wallet balance;
                $shipping_cost = ($order->shipping_cost) ? $order->shipping_cost : 0;
                $total = $order->total_price + $shipping_cost;
                $user = User::find($user_id);
                $user->wallet_balance = $user->wallet_balance + $total;
                $user->save();
                //insert transaction
                $transaction = new Transaction();
                $transaction->type = 'wallet';
                $transaction->notes = 'order cancel- '. $request->reason_details;
                $transaction->item_id = $order->order_id;
                $transaction->payment_method = 'Order Cancel';
                $transaction->transaction_details = $order->payment_info;
                $transaction->amount = $total;
                $transaction->total_amount = $user->wallet_balance + $total;
                $transaction->customer_id = $user->id;
                $transaction->created_by = null;
                $transaction->status = 'paid';
                $transaction->save();
            }
            //send mobile notify
            $customer_mobile = ($order->billing_phone) ? $order->billing_phone : $order->shipping_phone;
            $msg = 'Dear customer, Your order has been cancel. Order track at '.route('orderTracking').'?order_id='.$order->order_id;
            $this->sendSms($customer_mobile, $msg);
            //notify
            Notification::create([
                'type' => 'orderStatus',
                'fromUser' => $user_id,
                'toUser' => $orderDetail->vendor_id,
                'item_id' => $orderDetail->product_id,
                'notify' => 'cancel order',
            ]);
            Toastr::success('Order cancel successfully.');
            return back()->with('success', 'Your order cancellation successfully done. Please check your wallet.');
        }else{
            Toastr::error('Order can\'t cancel.');
            return back()->with('error', 'Your order cancellation failed. Please try again.');
        }

    }

    public function orderTracking(Request $request){
        if($request->order_id){
            $order = Order::with(['voucherTimelines' => function($query){ $query->orderBy('id', 'desc'); },'order_details.product:id,title,slug,feature_image,childcategory_id,subcategory_id,category_id'])
                ->where('order_id', $request->order_id)->first();
            if($order) {
                $category_id = $subcategory_id = $childcategory_id = $product_id = [];
                foreach ($order->order_details as $order_detail){
                    $product_id[] = $order_detail->product->id;
                    if ($order_detail->product->childcategory_id) {
                        $childcategory_id[] = $order_detail->product->childcategory_id;
                    } elseif ($order_detail->product->subcategory_id) {
                        $subcategory_id[] = $order_detail->product->subcategory_id;
                    } else {
                        $category_id[] = $order_detail->product->category_id;
                    }
                }

//                foreach ($order->order_details as $order_detail){
//                    if ($order_detail->product->childcategory_id != null) {
//                        $related_products->where('childcategory_id', $order_detail->product->childcategory_id);
//                    } elseif ($order_detail->product->subcategory_id != null) {
//                        $related_products->where('subcategory_id', $order_detail->product->subcategory_id);
//                    } else {
//                        $related_products->where('category_id', $order_detail->product->category_id);
//                    }
//                    break;
//                }

                $related_products = Product::where('status', 'active')->whereNotIn('id', $product_id);
                if(count($childcategory_id)>0){
                    $related_products->whereIn('childcategory_id', $childcategory_id);
                }if(count($subcategory_id)>0){
                    $related_products->whereIn('subcategory_id', $subcategory_id);
                }if(count($category_id)>0){
                    $related_products->whereIn('category_id', $category_id);
                }
                $related_products = $related_products->where('status', 'active')->selectRaw('id,title,slug,feature_image,selling_price')->take(7)->get();

                return view('users.order-tracking-details')->with(compact('order','related_products'));
            }else{
                return view('users.order-tracking');
            }
        }
        return view('users.order-tracking');
    }

    public function orderTrackingDetails($order_id){
        $order = Order::with(['order_details.product:id,title,slug,feature_image'])
            ->where('order_id', $order_id)->first();
        if($order){
            return view('users.order-tracking-details')->with(compact('order'));
        }
        return view('404');
    }

}
