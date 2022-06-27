<?php

namespace App\Http\Controllers\Admin;

use App\Exports\VoucherTimelineExport;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Offer;
use App\Models\Order;
use App\Models\OrderInvoice;
use App\Models\ShippingMethod;
use App\Models\VoucherTimeline;
use App\Traits\Sms;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class VoucherAdminController extends Controller
{
    use Sms;
    //get all voucher
    public function orderHistory(Request $request, $status='')
    {
        $orders = Order::with(['affiliateProduct.affiliateAgent','voucherTimelines' => function($query){ $query->orderBy('id', 'desc'); },'order_details.product:id,title,slug,feature_image', 'orderCancelReason', 'orderNotify' => function($query){
            $query->orderBy('id', 'DESC');  }, 'orderNotify.staff', 'orderPartialPayments'])
            ->withCount('voucherTimelines')
            ->where('payment_method', '!=', 'pending')
            ->where('is_voucher', 1)
            ->leftJoin('users', 'orders.user_id', 'users.id');
        if($request->order_id){
            $orders->where('order_id', $request->order_id);
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
        $delivery_period_date = Carbon::parse(now())->subDay(30)->format('Y-m-d');
        $first_delivery_date = Carbon::parse(now())->subDay(10)->format('Y-m-d');
        //get today voucher delivery period order id
        $voucher_order_ids = VoucherTimeline::whereDate('invoice_date', '>=', $delivery_period_date)
            ->whereDate('invoice_date', '<=', $delivery_period_date)->pluck('order_id')->toArray();
        //get first delivery ids
        $first_delivery_order_ids = Order::where('payment_method', '!=', 'pending')->where('is_voucher', 1)->whereDate('order_date', '<=', $first_delivery_date)->whereDate('order_date', '>=', $first_delivery_date)->pluck('order_id')->toArray();
        $today_voucher_id = array_merge($voucher_order_ids, $first_delivery_order_ids);
        $today_voucher_id = array_unique($today_voucher_id);

        if($status){
            if($status == 'today'){
                $orders->whereIn('order_id', $today_voucher_id);
            }else{
                $orders->where('order_status', $status);
            }
            $orders->orderBy('order_date', 'asc');
        }else{
            $orders->orderBy('order_date', 'desc');
        }
        if($request->from_date){
            $from_date = Carbon::parse($request->from_date)->format('Y-m-d'. ' 00:00:00');

            $orders->whereDate('order_date', '>=', $from_date);
        }if($request->end_date){
            $end_date = Carbon::parse($request->end_date)->format('Y-m-d'. ' 00:00:00');
            $orders->whereDate('order_date', '<=', $request->end_date);
        }
        if(!$status && $request->status && $request->status != 'all'){
            $orders->where('order_status',$request->status);
        }
        $data['orders'] = $orders->selectRaw('orders.*, users.name as customer_name,username')->paginate(15);
        $data['offers'] = Offer::orderBy('id', 'desc')->get();
        $data['total_voucher'] = Order::where('payment_method', '!=', 'pending')->where('is_voucher', 1)->count();
        $data['pending'] = Order::where('payment_method', '!=', 'pending')->where('is_voucher', 1)->where('order_status', 'pending')->count();
        $data['accepted'] = Order::where('payment_method', '!=', 'pending')->where('is_voucher', 1)->where('order_status', 'accepted')->count();
        $data['voucherCounts'] = VoucherTimeline::select('status')->get();

        $data['today_voucher'] = Order::where('payment_method', '!=', 'pending')->where('is_voucher', 1)->whereIn('order_id', $today_voucher_id)->count();

        return view('admin.order.voucher.vouchers')->with($data);
    }

    //show voucher details by order id
    public function showOrderDetails($orderId){
        $data['order'] = Order::with(['order_details.product:id,title,slug,feature_image,product_type','get_country', 'get_state', 'get_city', 'get_area'])
            ->where('order_id', $orderId)->first();
        if($data['order']){
            return view('admin.order.voucher.voucherDetails')->with($data);
        }
        return false;
    }

    //show voucher Timeline by order id
    public function voucherTimelines (Request $request){
        $voucherTimelines = VoucherTimeline::with('order');

        if ($request->customer) {
            $keyword = $request->customer;
            $voucherTimelines->where(function ($query) use ($keyword) {
                $query->orWhere('orders.shipping_name', 'like', '%' . $keyword . '%');
                $query->orWhere('orders.shipping_phone', 'like', '%' . $keyword . '%');
                $query->orWhere('orders.shipping_email', 'like', '%' . $keyword . '%');
                $query->orWhere('users.name', 'like', '%' . $keyword . '%');
                $query->orWhere('users.mobile', 'like', '%' . $keyword . '%');
                $query->orWhere('users.email', 'like', '%' . $keyword . '%');
                $query->orWhereHas('order.order_details.product', function($query)  use ($keyword) {
                    $query->where('title', 'like', '%' . $keyword . '%');
                });
            });
        }
        if($request->order_id){
            $order_id = $request->order_id;
            $voucherTimelines->where(function($query) use ($order_id){
                $query->orWhere('order_id', $order_id)->orWhere('invoice_id', $order_id);
            });
        }
        if ($request->from_date) {
            $from_date = Carbon::parse($request->from_date)->format('Y-m-d');
            $voucherTimelines->where('invoice_date', '>=', $from_date);
        }
        if ($request->end_date) {
            $end_date = Carbon::parse($request->end_date)->format('Y-m-d');
            $voucherTimelines->where('invoice_date', '<=', $request->end_date);
        }
        if ($request->delivery_type && $request->delivery_type != 'all') {
            $voucherTimelines->where('delivery_type', $request->delivery_type);
        }if ($request->status && $request->status != 'all') {
            $voucherTimelines->where('status', $request->status);
        }
        $data['voucherTimelines']  = $voucherTimelines->orderBy('id', 'desc')->paginate(25);
        return view('admin.order.voucher.allDeliveryTimelines')->with($data);
    }

    //show voucher Timeline by order id
    public function voucherTimelineDetails ($orderId){
        $data['order'] = Order::with(['voucherTimelines' => function($query){ $query->orderBy('id', 'desc'); }, 'voucherTimelines.voucherNotify' ])
            ->where('order_id', $orderId)->first();
        if($data['order']){
            $data['shipping_methods'] = ShippingMethod::where('status', 1)->orderBy('position', 'asc')->selectRaw('id, name, logo, duration')->get();
            return view('admin.order.voucher.deliveryTimeline')->with($data);
        }
        return back();
    }
    //set voucher commission rate
    public function voucherRate(Request $request){
        $order = Order::where('order_id', $request->order_id)->first();
        if($order && $order->is_voucher == 1){
            $order->voucher_rate = $request->voucher_rate;
            $order->save();
            $output = array( 'status' => true,  'message'  => 'Voucher rate added successful.');
        }else{
            $output = array( 'status' => false,  'message'  => 'Voucher rate added failed.!');
        }
        return response()->json($output);
    }
    //voucher delivery invoice generate
    public function voucherInvoiceGenerate(Request $request, $order_id){
        $request->validate([
            'invoice_date' => 'required',
            'status' => 'required',
        ]);
        $user_id = Auth::guard('admin')->id();
        $order = Order::where('order_id', $order_id)->first();
        if($order) {
            $invoice_id = $order->order_id.'-'.$request->invoice_no;
            $data = new VoucherTimeline();
            $data->order_id = $order->order_id;
            $data->invoice_id = $invoice_id;
            $data->invoice_date = $request->invoice_date;
            $data->delivery_type = $request->delivery_type;
            $data->voucher_qty = $order->total_qty;
            $data->voucher_rate = ($request->voucher_rate) ? $request->voucher_rate : $order->voucher_rate;
            $data->notes = $request->notes;
            $data->shipping_method = $request->shipping_method;
            $data->shipping_name = $order->shipping_name;
            $data->shipping_email = $order->shipping_email;
            $data->shipping_phone = $order->shipping_phone;
            $data->shipping_country = $order->shipping_country;
            $data->shipping_region = $order->shipping_region;
            $data->shipping_city = $order->shipping_city;
            $data->shipping_area = $order->shipping_area;
            $data->shipping_address = $order->shipping_address;
            $data->created_by = $user_id;
            $data->status = $request->status;
            $store = $data->save();
            if ($store) {
                $status = str_replace( '-', ' ', $request->status);
                $a = $request->invoice_no;
                $invoice_no = $a.substr(date('jS', mktime(0,0,0,1,($a%10==0?9:($a%100>20?$a%10:$a%100)),2000)),-2);

                //insert notification in database
                Notification::create([
                    'type' => 'orderStatus',
                    'fromUser' => $user_id,
                    'toUser' => $order->user_id,
                    'item_id' => $invoice_id,
                    'notify' => $status.' voucher '.$invoice_no. ' delivery',
                ]);
                if($request->status != 'delivered') {
                    $msg = 'Dear customer, Your voucher ' . $invoice_no . ' delivery has been ' . $status . '. Thanks for ordering from ' . $_SERVER['SERVER_NAME'];
                    $customer_mobile = ($order->billing_phone) ? $order->billing_phone : $order->shipping_phone;
                    $this->sendSms($customer_mobile, $msg);
                }
                Toastr::success('Voucher invoice generate success.');
                return redirect()->back();
            }
        }
        Toastr::error('Sorry voucher generate failed');
        return redirect()->back();
    }

    //show voucher details by order id
    public function voucherInvoice($orderId){
        $order = Order::with(['order_details.product:id,title,slug,feature_image'])->join('voucher_timelines', 'orders.order_id', 'voucher_timelines.order_id')
            ->where('invoice_id', $orderId)
            ->selectRaw('voucher_timelines.*, orders.payment_status, orders.total_price, orders.shipping_cost ,orders.coupon_discount, orders.currency_sign,orders.order_status, orders.order_notes')
            ->first();
        if($order){
            return view('admin.order.voucher.invoice')->with(compact('order'));
        }
        return view('404');
    }

    //change voucher timeline delivery status
    public function changeVoucherStatus(Request $request){
        $voucher = VoucherTimeline::where('invoice_id', $request->invoice_id)->first();
        $status = str_replace( '-', ' ', $request->status);
        $invoice_no = explode( '-', $request->invoice_id)[1];
        $output = [];
        if($voucher && $voucher->status != $request->status && $voucher->status != 'delivered'){
            $voucher->status = $request->status;
            $voucher->save();
            $staff_id = Auth::guard('admin')->id();
            $user_id = Order::where('order_id', $voucher->order_id)->first()->user_id;
            //insert notification in database
            $a = $invoice_no;
            $invoice_no = $a.substr(date('jS', mktime(0,0,0,1,($a%10==0?9:($a%100>20?$a%10:$a%100)),2000)),-2);

            Notification::create([
                'type' => 'orderStatus',
                'fromUser' => $staff_id,
                'toUser' => $user_id,
                'item_id' => $request->invoice_id,
                'notify' => $request->status.' voucher '.$invoice_no. ' delivery',
            ]);
            $output = array( 'status' => true,  'message'  => 'Delivery status '.$status.' successful.');
        }else{
            $output = array( 'status' => false,  'message'  => 'Delivery status update failed.! Already order '. $voucher->status);
        }
        return response()->json($output);
    }
    //voucher invoice Print By
    public function voucherInvoicePrintBy(Request $request, $invoice_id){
        $order = VoucherTimeline::where('invoice_id', $invoice_id)->first();
        if($order){
            $order->increment('invoicePrints');
            $staff_id = Auth::guard('admin')->id();
            //add  order invoice
            $orderInvoice = new OrderInvoice();
            $orderInvoice->invoice_id = $request->invoice_id;
            $orderInvoice->all_orders = $request->all_orders;
            $orderInvoice->notes = 'order: '. $order->status;
            $orderInvoice->created_by = $staff_id;
            $orderInvoice->save();
        }
        return true;
    }

    public function exportVoucherTimeline(Request $request)
    {
        $voucherTimelines = VoucherTimeline::orderBy('id', 'desc');
        if($request->delivery_type){
            $voucherTimelines->where('delivery_type', $request->delivery_type);
        }if($request->status){
            $voucherTimelines->where('status', $request->status);
        }if($request->from_date){
            $voucherTimelines->whereDate('invoice_date', '>=', $request->from_date);
        }if($request->end_date){
            $voucherTimelines->whereDate('invoice_date', '<=', $request->end_date);
        }
        $voucherTimelines = $voucherTimelines->get();
        $filename = 'voucherTimeline('.date('d-m-Y').').xlsx';
        return Excel::download(new VoucherTimelineExport($voucherTimelines), $filename);

    }
}
