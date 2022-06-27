<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Order;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{
    public function voucherHistory(Request $request, $status=''){
        $orders = Order::with(['voucherTimelines' => function($query){ $query->orderBy('id', 'desc'); }, 'order_details.product:id,title,slug,feature_image'])
            ->withCount('voucherTimelines')
            ->where('is_voucher', 1)
            ->where('user_id', Auth::id());
        if($status){
            $orders->where('order_status', $status);
        }
        $data['orders'] = $orders->orderBy('order_date', 'desc')->get();

        $data['total_voucher'] = Order::where('payment_method', '!=', 'pending')->where('is_voucher', 1)->where('user_id', Auth::id())->count();
        $data['pending'] = Order::where('payment_method', '!=', 'pending')->where('is_voucher', 1)->where('user_id', Auth::id())->where('order_status', 'pending')->count();
        $data['accepted'] = Order::where('payment_method', '!=', 'pending')->where('is_voucher', 1)->where('user_id', Auth::id())->where('order_status', 'accepted')->count();
        $data['closed'] = Order::where('payment_method', '!=', 'pending')->where('is_voucher', 1)->where('user_id', Auth::id())->where('order_status', 'closed')->count();

        return view('users.voucher.voucher-history')->with($data);
    }

    //show order details by order id
    public function voucherDetails($orderId){
        $data['order'] = Order::with(['voucherTimelines' => function($query){ $query->orderBy('id', 'desc'); }, 'voucherTimelines.voucherNotify' ])
            ->where('order_id', $orderId)->first();
        if($data['order']){
            $voucherNotify = Notification::where('item_id', $data['order']->order_id);
            //get all order notify
            for($i=1; $i<=12; $i++) {
                $voucherNotify->orWhere('item_id', $data['order']->order_id.'-'.$i);
            }
            $data['voucherNotify'] = $voucherNotify->orderBy('id', 'desc')->get();
            return view('users.voucher.voucher-details')->with($data);
        }
        return view('404');
    }

}
