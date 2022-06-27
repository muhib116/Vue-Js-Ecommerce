<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Order;
use App\Models\State;
use App\Models\OfferType;
use App\Models\OrderDetail;
use App\Models\OrderInvoice;
use App\Models\ShippingMethod;
use App\Traits\Sms;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    use Sms;
    //get all order by user id
    
    
    public function loyal(Request $request)
    {
		
		if(!empty($request->start) && !empty($request->end)){
            $smt = $request->start;
            $emt = $request->end;
        } else {
           $smt = 50000;
            $emt = 500000; 
        }
        $states = State::where('country_id', 18)->where('status', 1)->get();
			$porders = Order::where('order_status', 'delivered')->whereBetween('total_price', [$smt, $emt])->groupBy('user_id')->selectRaw('*, sum(total_price) as amount')->orderBy('total_price', 'desc');
		if($request->region != 0){
            $porders->where('billing_region', $request->region);
        }
        if($request->city != 0){
            $porders->where('billing_city', $request->city);
        }
         if($request->area != 0){
            $porders->where('billing_area', $request->area);
        }
        
        
        $orders = $porders->paginate(15);
		return view('admin.order.loyal', compact('orders','states','smt','emt'));
      
    }
    
    
    
      public function smsloyal(Request $request)
    {
		
		if(!empty($request->start) && !empty($request->end)){
            $smt = $request->start;
            $emt = $request->end;
        } else {
           $smt = 50000;
            $emt = 500000; 
        }
        $states = State::where('country_id', 18)->where('status', 1)->get();
			$porders = Order::where('order_status', 'delivered')->whereBetween('total_price', [$smt, $emt])->groupBy('user_id')->selectRaw('*, sum(total_price) as amount')->orderBy('total_price', 'desc');
		if($request->region != 0){
            $porders->where('billing_region', $request->region);
        }
        if($request->city != 0){
            $porders->where('billing_city', $request->city);
        }
         if($request->area != 0){
            $porders->where('billing_area', $request->area);
        }
        
        
        $orders = $porders->get();
        
        foreach ($orders as $user) {
            if(!empty($order->billing_phone)){
           pvlsms($user->billing_phone, $request->details); 
            } else {
            pvlsms($user->customer->mobile, $request->details);     
            }
        }
        
	Toastr::success('Sms Sent Done.');
return back();
      
    }
    
    
    
    
    public function offerorderHistory(Request $request, $slug, $status='')
    {
		
		
		
		$offertype = Offer::where('offer_type', $slug)->pluck('id')->toArray();
		
		
        $data['orderCount'] = Order::whereIn('offer_id', $offertype)->where('is_b2b', 0)->where('payment_method', '!=', 'pending')->whereNull('is_voucher')->whereNull('is_pre_order')->select('order_status', DB::raw('count(*) as total'))->groupBy('order_status')->get();
        $data['regularPendingOrder'] = Order::whereIn('offer_id', $offertype)->where('is_b2b', 0)->where('payment_method', '!=', 'pending')->whereNull('is_voucher')->whereNull('is_pre_order')->whereNull('offer_id')->where('order_status', 'pending')->count();
        $data['offerPendingOrder'] = Order::whereIn('offer_id', $offertype)->where('is_b2b', 0)->where('payment_method', '!=', 'pending')->whereNull('is_voucher')->whereNull('is_pre_order')->whereNotNull('offer_id')->where('order_status', 'pending')->count();

        $orders = Order::whereIn('offer_id', $offertype)->where('is_b2b', 0)->with(['affiliateProduct.affiliateAgent','offer','orderCancelReason', 'orderNotify' => function($query){
            $query->orderBy('id', 'DESC');  }, 'orderNotify.staff', 'orderPartialPayments'])
            ->leftJoin('users', 'orders.user_id', 'users.id')
            ->where('orders.payment_method', '!=', 'pending')
            ->whereNull('is_voucher')
            ->whereNull('is_pre_order');
        if($request->order_id){
            $orders->where('orders.order_id', $request->order_id);
        }
        if($request->payment_status){
            $orders->where('payment_status', $request->payment_status);
        }if($request->payment){
        $orders->where('orders.payment_method', $request->payment);
    }
        if($request->offer && $request->offer != 'offer' &&  $request->offer != 'regular'){
            $orders->where('orders.offer_id', $request->offer);
        }else{
            if($request->offer && $request->offer == 'offer'){
                $orders->where('offer_id', '!=', null);
            }if($request->offer && $request->offer == 'regular'){
                $orders->where('offer_id', null);
            }
        }
        if($request->customer){
            $keyword = $request->customer;
            $orders->where(function ($query) use ($keyword) {
                $query->orWhere('orders.shipping_name', 'like', '%' . $keyword . '%');
                $query->orWhere('orders.shipping_phone', 'like', '%' . $keyword . '%');
                $query->orWhere('orders.shipping_email', 'like', '%' . $keyword . '%');
                $query->orWhere('users.name', 'like', '%' . $keyword . '%');
                $query->orWhere('users.mobile', 'like', '%' . $keyword . '%');
                $query->orWhere('users.email', 'like', '%' . $keyword . '%');
            });
        }
        if($status){
            $orders = $orders->where('order_status', $status);
        }
        if($request->from_date){
            $from_date = Carbon::parse($request->from_date)->format('Y-m-d')." 00:00:00";
            $orders = $orders->whereDate('order_date', '>=', $from_date);
        }if($request->end_date){
        $end_date = Carbon::parse($request->end_date)->format('Y-m-d')." 23:59:59";
        $orders = $orders->whereDate('order_date', '<=', $request->end_date);
    }
        if(!$status && $request->status && $request->status != 'all'){
            $orders = $orders->where('order_status',$request->status);
        }
        $data['orders'] = $orders->orderBy('order_date', 'desc')
            ->selectRaw('orders.*,users.name as customer_name,username')->paginate(15);

        $data['offers'] = Offer::orderBy('id', 'desc')->get();
        return view('admin.order.orders')->with($data);
    }
	
	
	
	 public function orderHistory(Request $request, $status='')
    {
		
		
		
		
		
		
        $data['orderCount'] = Order::where('is_b2b', 0)->where('payment_method', '!=', 'pending')->whereNull('is_voucher')->whereNull('is_pre_order')->select('order_status', DB::raw('count(*) as total'))->groupBy('order_status')->get();
        $data['regularPendingOrder'] = Order::where('is_b2b', 0)->where('payment_method', '!=', 'pending')->whereNull('is_voucher')->whereNull('is_pre_order')->whereNull('offer_id')->where('order_status', 'pending')->count();
        $data['offerPendingOrder'] = Order::where('is_b2b', 0)->where('payment_method', '!=', 'pending')->whereNull('is_voucher')->whereNull('is_pre_order')->whereNotNull('offer_id')->where('order_status', 'pending')->count();

        $orders = Order::where('is_b2b', 0)->with(['affiliateProduct.affiliateAgent','offer','orderCancelReason', 'orderNotify' => function($query){
            $query->orderBy('id', 'DESC');  }, 'orderNotify.staff', 'orderPartialPayments'])
            ->leftJoin('users', 'orders.user_id', 'users.id')
            ->where('orders.payment_method', '!=', 'pending')
            ->whereNull('is_voucher')
            ->whereNull('is_pre_order');
        if($request->order_id){
            $orders->where('orders.order_id', $request->order_id);
        }
        if($request->payment_status){
            $orders->where('payment_status', $request->payment_status);
        }if($request->payment){
        $orders->where('orders.payment_method', $request->payment);
    }
        if($request->offer && $request->offer != 'offer' &&  $request->offer != 'regular'){
            $orders->where('orders.offer_id', $request->offer);
        }else{
            if($request->offer && $request->offer == 'offer'){
                $orders->where('offer_id', '!=', null);
            }if($request->offer && $request->offer == 'regular'){
                $orders->where('offer_id', null);
            }
        }
        if($request->customer){
            $keyword = $request->customer;
            $orders->where(function ($query) use ($keyword) {
                $query->orWhere('orders.shipping_name', 'like', '%' . $keyword . '%');
                $query->orWhere('orders.shipping_phone', 'like', '%' . $keyword . '%');
                $query->orWhere('orders.shipping_email', 'like', '%' . $keyword . '%');
                $query->orWhere('users.name', 'like', '%' . $keyword . '%');
                $query->orWhere('users.mobile', 'like', '%' . $keyword . '%');
                $query->orWhere('users.email', 'like', '%' . $keyword . '%');
            });
        }
        if($status){
            $orders = $orders->where('order_status', $status);
        }
        if($request->from_date){
            $from_date = Carbon::parse($request->from_date)->format('Y-m-d')." 00:00:00";
            $orders = $orders->whereDate('order_date', '>=', $from_date);
        }if($request->end_date){
        $end_date = Carbon::parse($request->end_date)->format('Y-m-d')." 23:59:59";
        $orders = $orders->whereDate('order_date', '<=', $request->end_date);
    }
        if(!$status && $request->status && $request->status != 'all'){
            $orders = $orders->where('order_status',$request->status);
        }
        $data['orders'] = $orders->orderBy('order_date', 'desc')
            ->selectRaw('orders.*,users.name as customer_name,username')->paginate(15);

        $data['offers'] = Offer::orderBy('id', 'desc')->get();
        return view('admin.order.orders')->with($data);
    }
	
	
	
	
	
	  public function b2borderHistory(Request $request, $status='')
    {
		
		
		
		
		
        $data['orderCount'] = Order::where('is_b2b', 1)->where('payment_method', '!=', 'pending')->whereNull('is_voucher')->whereNull('is_pre_order')->select('order_status', DB::raw('count(*) as total'))->groupBy('order_status')->get();
        $data['regularPendingOrder'] = Order::where('is_b2b', 1)->where('payment_method', '!=', 'pending')->whereNull('is_voucher')->whereNull('is_pre_order')->whereNull('offer_id')->where('order_status', 'pending')->count();
        $data['offerPendingOrder'] = Order::where('is_b2b', 1)->where('payment_method', '!=', 'pending')->whereNull('is_voucher')->whereNull('is_pre_order')->whereNotNull('offer_id')->where('order_status', 'pending')->count();

        $orders = Order::where('is_b2b', 1)->with(['affiliateProduct.affiliateAgent','offer','orderCancelReason', 'orderNotify' => function($query){
            $query->orderBy('id', 'DESC');  }, 'orderNotify.staff', 'orderPartialPayments'])
            ->leftJoin('users', 'orders.user_id', 'users.id')
            ->where('orders.payment_method', '!=', 'pending')
            ->whereNull('is_voucher')
            ->whereNull('is_pre_order');
        if($request->order_id){
            $orders->where('orders.order_id', $request->order_id);
        }
        if($request->payment_status){
            $orders->where('payment_status', $request->payment_status);
        }if($request->payment){
        $orders->where('orders.payment_method', $request->payment);
    }
        if($request->offer && $request->offer != 'offer' &&  $request->offer != 'regular'){
            $orders->where('orders.offer_id', $request->offer);
        }else{
            if($request->offer && $request->offer == 'offer'){
                $orders->where('offer_id', '!=', null);
            }if($request->offer && $request->offer == 'regular'){
                $orders->where('offer_id', null);
            }
        }
        if($request->customer){
            $keyword = $request->customer;
            $orders->where(function ($query) use ($keyword) {
                $query->orWhere('orders.shipping_name', 'like', '%' . $keyword . '%');
                $query->orWhere('orders.shipping_phone', 'like', '%' . $keyword . '%');
                $query->orWhere('orders.shipping_email', 'like', '%' . $keyword . '%');
                $query->orWhere('users.name', 'like', '%' . $keyword . '%');
                $query->orWhere('users.mobile', 'like', '%' . $keyword . '%');
                $query->orWhere('users.email', 'like', '%' . $keyword . '%');
            });
        }
        if($status){
            $orders = $orders->where('order_status', $status);
        }
        if($request->from_date){
            $from_date = Carbon::parse($request->from_date)->format('Y-m-d')." 00:00:00";
            $orders = $orders->whereDate('order_date', '>=', $from_date);
        }if($request->end_date){
        $end_date = Carbon::parse($request->end_date)->format('Y-m-d')." 23:59:59";
        $orders = $orders->whereDate('order_date', '<=', $request->end_date);
    }
        if(!$status && $request->status && $request->status != 'all'){
            $orders = $orders->where('order_status',$request->status);
        }
        $data['orders'] = $orders->orderBy('order_date', 'desc')
            ->selectRaw('orders.*,users.name as customer_name,username')->paginate(15);

        $data['offers'] = Offer::orderBy('id', 'desc')->get();
        return view('admin.order.b2borders')->with($data);
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

    //show order details by order id
    public function showOrderDetails($orderId){




        $data['order'] = Order::where('is_b2b', 0)->with(['order_details.product:id,title,slug,feature_image,product_type','get_country', 'get_state', 'get_city', 'get_area'])
            ->where('order_id', $orderId)->first();
        if($data['order']){
            $data['shipping_methods'] = ShippingMethod::where('status', 1)->orderBy('position', 'asc')->selectRaw('id, name, logo, duration')->get();
            return view('admin.order.order-details')->with($data);
        }
        return false;
    }
	
	
	public function b2bshowOrderDetails($orderId){



        $data['order'] = Order::where('is_b2b', 1)->with(['order_details.product:id,title,slug,feature_image,product_type','get_country', 'get_state', 'get_city', 'get_area'])
            ->where('order_id', $orderId)->first();
        if($data['order']){
            $data['shipping_methods'] = ShippingMethod::where('status', 1)->orderBy('position', 'asc')->selectRaw('id, name, logo, duration')->get();
            return view('admin.order.order-details')->with($data);
        }
        return false;
    }

	
	

    //show order details by order id
    public function orderInvoice($orderId){
		
		
		
	
		
        $order = Order::with(['order_details.product:id,title,slug,feature_image'])
            ->where('order_id', $orderId)->first();
        if($order){
            return view('admin.order.invoice')->with(compact('order'));
        }
        return view('404');
    }

    //set product attribute size , color etc
    public function orderAttributeUpdate(Request $request){
		
		
	
		
        $order = OrderDetail::where('order_id', $request->order_id)->where('product_id', $request->product_id)->first();
        if($order){
            $attributes = explode(',', $request->productAttributes);
            $attributes = json_encode($attributes);
            $order->attributes = $attributes;
            $order->save();
            $output = array( 'status' => true,  'message'  => 'Product Attribute added successful.');
        }else{
            $output = array( 'status' => false,  'message'  => 'Product Attribute added failed.!');
        
		}
        return response()->json($output);
    }

    // add order info exm( shipping cost, comment)
    public function addedOrderInfo(Request $request){
		
			
		
        $order = Order::where('order_id', $request->order_id)->first();
        $staff_name = Auth::guard('admin')->user()->name;
        if($order){
            if($request->field_data) {
                $field = $request->field;
                $order->$field = ($request->field_data) ? $order->$field .'<p> By '.$staff_name.' => '. $request->field_data .' ('. date('d M, Y') .')</p>' : null;
                $order->save();
            }
            $output = array( 'status' => true,  'message'  => str_replace( '_', ' ', $request->field).' added successful.');
        }else{
            $output = array( 'status' => false,  'message'  => str_replace( '_', ' ', $request->field).' added failed.');
        
		}
        return response()->json($output);
    }

    //order invoice Print By
    public function invoicePrintBy(Request $request, $order_id){
		
		
		
		
        $order = Order::where('order_id', $order_id)->first();
        if($order){
            $order->increment('invoicePrints');
            $staff_id = Auth::guard('admin')->id();
            //add  order invoice
            $orderInvoice = new OrderInvoice();
            $orderInvoice->invoice_id = $request->invoice_id;
            $orderInvoice->all_orders = $request->all_orders;
            $orderInvoice->notes = 'order: '. $order->order_status.', payment: '.$order->payment_status;
            $orderInvoice->user_id = $order->user_id;
            $orderInvoice->created_by = $staff_id;
            $orderInvoice->save();
        }
        return true;
    }

    //get all pre order by user id
    public function preOrderHistory(Request $request, $status='')
    {
		
		
		
		
		
        //pre order status count
        $data['orderCount'] = Order::where('payment_method', '!=', 'pending')
            ->where('is_pre_order', 1)->select('order_status', DB::raw('count(*) as total'))
            ->groupBy('order_status')->get();
        $orders = Order::with(['affiliateProduct.affiliateAgent','offer','orderCancelReason', 'orderNotify' => function($query){
            $query->orderBy('id', 'DESC');  }, 'orderNotify.staff', 'orderPartialPayments'])
            ->where('payment_method', '!=', 'pending')
            ->leftJoin('users', 'orders.user_id', 'users.id')
            ->where('is_pre_order', 1);
        if($request->order_id){
            $orders->where('order_id', $request->order_id);
        }if($request->payment_status){
        $orders->where('payment_status', $request->payment_status);
    }if($request->payment){
        $orders->where('payment_method', $request->payment);
    }
        if($request->offer && $request->offer != 'offer' &&  $request->offer != 'regular'){
            $orders->where('offer_id', $request->offer);
        }else{
            if($request->offer && $request->offer == 'offer'){
                $orders->where('offer_id', '!=', null);
            }if($request->offer && $request->offer == 'regular'){
                $orders->where('offer_id', null);
            }
        }
        if($request->customer){
            $keyword = $request->customer;
            $orders->where(function ($query) use ($keyword) {
                $query->orWhere('orders.shipping_name', 'like', '%' . $keyword . '%');
                $query->orWhere('orders.shipping_phone', 'like', '%' . $keyword . '%');
                $query->orWhere('orders.shipping_email', 'like', '%' . $keyword . '%');
                $query->orWhere('users.name', 'like', '%' . $keyword . '%');
                $query->orWhere('users.mobile', 'like', '%' . $keyword . '%');
                $query->orWhere('users.email', 'like', '%' . $keyword . '%');
            });
        }
        if($status){
            $orders = $orders->where('order_status', $status);
        }
        if($request->from_date){
            $from_date = Carbon::parse($request->from_date)->format('Y-m-d')." 00:00:00";
            $orders = $orders->whereDate('order_date', '>=', $from_date);
        }if($request->end_date){
        $end_date = Carbon::parse($request->end_date)->format('Y-m-d')." 23:59:59";
        $orders = $orders->whereDate('order_date', '<=', $request->end_date);
    }
        if(!$status && $request->status && $request->status != 'all'){
            $orders = $orders->where('order_status',$request->status);
        }
        $data['orders'] = $orders->orderBy('order_date', 'desc')->selectRaw('orders.*, users.name as customer_name,username')->paginate(15);
        return view('admin.order.preOrder.orders')->with($data);
    }

}
