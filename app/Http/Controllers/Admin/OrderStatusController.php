<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderPayment;
use App\Models\SiteSetting;
use App\Models\Transaction;
use App\Traits\Sms;
use App\Traits\shurjopayDelivery;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderStatusController extends Controller
{
    use shurjopayDelivery;
    use Sms;
    // change payment Status function
    public function changePaymentStatus(Request $request){

        $user_id = Auth::guard('admin')->id();
        $order = Order::where('order_id', $request->order_id)->first();
        if($order){
            if($request->payment_status == 'Process To Verify') {
                $order->update(['payment_status' => $request->payment_status]);
                $output = array( 'status' => true,  'message'  => 'Payment status '.str_replace( '-', ' ', $request->status).' successful.');
                return response()->json($output);
            }else {
                //when payment paid order status processing
                if ($request->payment_status == 'paid') {
                    if ($order->order_status == 'pending') {
                        $order->order_status = 'accepted';
                        $order->order_date = now();
                        foreach ($order->order_details as $orderDetails) {
                            $orderDetails->shipping_status = 'accepted';
                            $orderDetails->save();
                        }
                        $msg = 'Dear customer, Your order has been accepted. Order track at ' . route('orderTracking') . '?order_id=' . $order->order_id;
                        $customer_mobile = ($order->billing_phone) ? $order->billing_phone : $order->shipping_phone;
                        $this->sendSms($customer_mobile, $msg);
                    }
                }
                $order->payment_status = $request->payment_status;
                //$order->payment_info = $order->payment_info ." \n A/C:". $request->account_no .", \n Transaction id:".  $request->transaction_id .", \n Amount:".  $request->amount .", \n Notes:". $request->transaction_details;
                $order->save();
                //partial payment
                $partialPayment = OrderPayment::where('transaction_id', $request->transaction_id)->first();
                if (!$partialPayment) {
                    $partialPayment = new OrderPayment();
                    $partialPayment->order_id = $request->order_id;
                    $partialPayment->payment_method = $request->payment_status;;
                    $partialPayment->amount = $request->amount;
                    $partialPayment->account_no = $request->account_no;
                    $partialPayment->transaction_id = $request->transaction_id;
                    $partialPayment->transaction_details = $request->transaction_details;
                    $partialPayment->created_by = $user_id;
                    $partialPayment->save();
                    //insert notification in database
                    Notification::create([
                        'type' => 'orderPayment',
                        'fromUser' => $user_id,
                        'toUser' => $order->user_id,
                        'item_id' => $request->order_id,
                        'notify' => $request->payment_status . ' ' . $order->currency_sign . $request->amount . ' order payment ',
                    ]);
                    Toastr::success('Payment status ' . str_replace('-', ' ', $request->payment_status) . ' successful.');
                } else {
                    Toastr::error('Transaction id already used update failed.!');
                    return back()->with('error', 'Transaction id already used.!');
                }
            }
        }else{
            Toastr::error('Payment status update failed.!');
        }
        return back();
    }

    public function orderPaymentDetails($orderId){

        $order = Order::with('orderPartialPayments.staff')->where('order_id', $orderId)->first();
        if($order){
            return view('admin.order.paymentCheckModal')->with(compact('order'));
        }
    }
    //add 0r change shipping method
    public function shippingMethod(Request $request){
        $order = Order::where('order_id', $request->order_id)->first();
        if($order){
            $order->shipping_method_id = $request->shipping_method_id;
            $order->save();
            $output = array( 'status' => true,  'message'  => 'Shipping method set successful.');
        }else{
            $output = array( 'status' => false,  'message'  => 'Shipping method added failed.!');
        }
        return response()->json($output);
    }
    // change Order Status function
    public function changeOrderStatus(Request $request){
        $order = Order::with('order_details')->where('order_id', $request->order_id)->first();
        $status = str_replace( '-', ' ', $request->status);
        $output = [];
        if($order && $order->order_status != $request->status && $order->order_status != 'delivered' && $order->order_status != 'cancel' && $order->order_status != 'return'){
            $minusPrice = 0;
            foreach ($order->order_details as $orderDetails) {
                //check single product shipping status return ,cancel
                if( $orderDetails->shipping_status == 'cancel' || $orderDetails->shipping_status == 'return' || $orderDetails->shipping_status == 'delivered') {
                    //minus single product return, cancel amount
                    $minusPrice += $orderDetails->price*$orderDetails->qty;
                }else{
                    //add seller wallet balance
                    if ($request->status == 'delivered') {
                        //total price
                        $price = $orderDetails->price * $orderDetails->qty;
                        //get commission
                        $commission_percentage = SiteSetting::where('type', 'vendor_commission')->first()->value;
                        //calculate commission
                        $commission = ($commission_percentage && $commission_percentage > 0) ? round(($price * $commission_percentage) / 100, 2) : 0;
                        //minus commission
                        $amount = $price - $commission;
                        //update seller balance
                        $seller = $orderDetails->seller;
                        $seller->balance = $seller->balance+$amount;
                        $seller->save();

                        //insert seller transaction
                        $transaction = new Transaction();
                        $transaction->type = 'order';
                        $transaction->item_id = $orderDetails->order_id;
                        $transaction->payment_method = $order->payment_method;
                        $transaction->amount = $amount;
                        $transaction->commission = $commission;
                        //check whether referral product
                        if($orderDetails->affiliate_agent_id != null){
                            $transaction->ref_id = $orderDetails->affiliate_agent_id;
                            $transaction->ref_earning = $orderDetails->affiliate_amount;
                            //added affiliate agent balance
                            $affiliateAgent = $orderDetails->affiliateAgent;
                            $affiliateAgent->affiliate_balance = $affiliateAgent->affiliate_balance + $orderDetails->affiliate_amount;
                            $affiliateAgent->save();
                        }
                        $transaction->seller_id = $orderDetails->vendor_id;
                        $transaction->customer_id = $orderDetails->user_id;
                        $transaction->created_by = Auth::guard('admin')->id();
                        $transaction->status = 'paid';
                        $transaction->save();

                        if ($order->payment_status == 'paid' && $orderDetails->product) {
                            //if product is voucher then add wallet balance
                            if($orderDetails->is_voucher == 1) {
                                //update customer balance
                                $customer = $orderDetails->customer;
                                $customer->wallet_balance = $customer->wallet_balance + $price;
                                $customer->save();
                                //insert customer transaction
                                $transaction = new Transaction();
                                $transaction->type = 'wallet';
                                $transaction->item_id = $orderDetails->order_id;
                                $transaction->payment_method = 'Voucher balance';
                                $transaction->amount = $price;
                                $transaction->transaction_details = $order->payment_info;
                                $transaction->customer_id = $orderDetails->user_id;
                                $transaction->created_by = Auth::guard('admin')->id();
                                $transaction->status = 'paid';
                                $transaction->save();
                            }
                        }

                        //update shurjopay delivery status
                        if($order->payment_method == 'shurjopay'){
                           shurjopaynotification($order->tnx_id);
                        }
                    }
                    $orderDetails->shipping_status = $request->status;
                    $orderDetails->shipping_date = Carbon::now();
                    $orderDetails->save();
                }

                //added product stock qty
                if($request->status == 'cancel' || $request->status == 'return') {
                    $orderDetails->product->increment('stock', $orderDetails->qty);
                }
            }

            //if cancel order add wallet balance;
            if ($order->payment_status == 'paid' && $order->order_status != 'cancel') {
                if ($request->status == 'return' || $request->status == 'cancel') {
                    $shipping_cost = ($order->shipping_cost) ? $order->shipping_cost : 0;
                    //minus single product amount return, cancel
                    $total = $order->total_price - $minusPrice;
                    $total = $total + $shipping_cost;
                    $total = ($request->status == 'return') ? $total - $shipping_cost : $total;
                    $user = User::find($order->user_id);
                    $user->wallet_balance = $user->wallet_balance + $total;
                    $user->save();

                    //insert transaction
                    $transaction = new Transaction();
                    $transaction->type = 'wallet';
                    $transaction->notes = 'order ' . $request->status;
                    $transaction->item_id = $order->order_id;
                    $transaction->payment_method = 'Order  '. $request->status;
                    $transaction->transaction_details = $order->payment_info;
                    $transaction->amount = $total;
                    $transaction->total_amount = $user->wallet_balance + $total;
                    $transaction->customer_id = $user->id;
                    $transaction->created_by = Auth::guard('admin')->id();
                    $transaction->status = 'paid';
                    $transaction->save();
                }
            }

            $order->order_status = $request->status;
            $staff_id = Auth::guard('admin')->id();
            $order->updated_by = $staff_id;
            $order->save();
            //insert notification in database
            Notification::create([
                'type' => 'orderStatus',
                'fromUser' => $staff_id,
                'toUser' => $order->user_id,
                'item_id' => $request->order_id,
                'notify' => $request->status.' order',
            ]);

            $output = array( 'status' => true,  'message'  => 'Delivery status '.$status.' successful.');
            //send mobile notify
            if($request->status != 'delivered') {
                //$msg = 'Dear customer, Your order has been '.$status.'. Thanks for ordering from '.$_SERVER['SERVER_NAME'];
                $msg = 'Dear customer, Your order has been ' . $status . '. Order track at ' . route('orderTracking') . '?order_id=' . $order->order_id;
                $customer_mobile = ($order->billing_phone) ? $order->billing_phone : $order->shipping_phone;
                $this->sendSms($customer_mobile, $msg);
            }
        }else{
            $output = array( 'status' => false,  'message'  => 'Delivery status update failed.! Already order '. $order->order_status);
        }
        return response()->json($output);
    }
    
    // change Order single producrt  Status function
    public function changeProductOrderStatus(Request $request){
        $order = Order::where('order_id', $request->order_id)->first();
        $status = str_replace( '-', ' ', $request->status);
        $output = array( 'status' => false,  'message'  => 'Delivery status update failed.! Already order '. $order->order_status);
        if($order && $order->order_status != 'delivered' && $order->order_status != 'cancel' && $order->order_status != 'return'){
            $orderDetails = OrderDetail::with('product:id,title')->where('product_id', $request->product_id)->where('order_id', $request->order_id)->first();
            if($orderDetails  && $orderDetails->shipping_status != 'cancel' && $orderDetails->shipping_status != 'delivered' && $orderDetails->shipping_status != 'return') {
                $orderDetails->shipping_status = $request->status;
                $orderDetails->save();
                //added product stock qty
                if($request->status == 'cancel' || $request->status == 'return') {
                    $orderDetails->product->increment('stock', $orderDetails->qty);
                }
                if ($order->payment_status == 'paid') {
                    //if cancel or return product add wallet balance;
                    if ($request->status == 'return' || $request->status == 'cancel') {
                        //shipping charge
                        $shipping_cost = ($orderDetails->shipping_charge) ? $orderDetails->shipping_charge : 0;
                        $price = ($orderDetails->price * $orderDetails->qty);
                        $total = ($request->status == 'return') ? ($price - $shipping_cost) : $price;

                        //add user wallet balance
                        $user = User::find($order->user_id);
                        $user->wallet_balance = $user->wallet_balance + $total;
                        $user->save();

                        //insert transaction
                        $transaction = new Transaction();
                        $transaction->type = 'wallet';
                        $transaction->notes = $request->status . ' order product => ' . $orderDetails->product->title;
                        $transaction->item_id = $order->order_id;
                        $transaction->payment_method = $request->status . ' order product';
                        $transaction->transaction_details = $order->payment_info;
                        $transaction->amount = $total;
                        $transaction->total_amount = $user->wallet_balance + $total;
                        $transaction->customer_id = $user->id;
                        $transaction->created_by = Auth::guard('admin')->id();
                        $transaction->status = 'paid';
                        $transaction->save();
                    }
                }

                $staff_id = Auth::guard('admin')->id();
                //insert notification in database
                Notification::create([
                    'type' => 'orderStatus',
                    'fromUser' => $staff_id,
                    'toUser' => $order->user_id,
                    'item_id' => $request->order_id,
                    'item_id_two' => $request->product_id,
                    'notify' => $request->status . 'order product => ' . $orderDetails->product->title,
                ]);
                //send mobile notify
                if($request->status != 'delivered') {
                    $msg = 'Dear customer, Your order product ('.$orderDetails->product->title.')  has been '.$status.'. Order track at ' . route('orderTracking') . '?order_id=' . $order->order_id;
                    $customer_mobile = ($order->billing_phone) ? $order->billing_phone : $order->shipping_phone;
                    $this->sendSms($customer_mobile, $msg);
                }
                $output = array('status' => true, 'message' => 'Delivery status ' . $status . ' successful.');
            }
        }
        return response()->json($output);
    }

}
