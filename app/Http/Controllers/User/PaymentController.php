<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\NagadPaymentController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\ShurjoController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\StripeController;
use App\Mail\OrderMail;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderPayment;
use App\Models\OrderDetail;
use App\Models\PaymentGateway;
use App\Traits\Sms;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;


class PaymentController extends Controller
{
    use Sms;
    //display payment gateway list in payment page
    public function orderPaymentGateway($orderId)
    {
       
        $orderId = decrypt($orderId);
        
        $order = Order::with('order_details.product:id,title,slug,feature_image')
            ->where('user_id', Auth::id())
            ->where('order_id', $orderId)->first();
        if($order){
            
            
             
        $detailcount = OrderDetail::where('order_id', $order->order_id)->where('offer_id', 84)->count();
            if($detailcount>0){
               $paymentgateways = PaymentGateway::orderBy('position', 'asc')->where('method_for', '!=', 'payment')->where('status', 1)->whereNotIn('method_slug', ['cash-on-delivery', 'wallet-balance'])->get();
            } else {
               $paymentgateways = PaymentGateway::orderBy('position', 'asc')->where('method_for', '!=', 'payment')->where('status', 1)->get();
            }
			//print_r($paymentgateways);
            return view('frontend.checkout.order-payment')->with(compact('order', 'paymentgateways'));
        }
        return view('404');
    }

    // process payment gateway & redirect specific gateway
    public function orderPayment(Request $request, $orderId){
        $order = Order::with('order_details.product:id,title')->where('user_id', Auth::id())->where('order_id', $orderId)->first();
        
        
       
        
        if($order){
            $total_price = $order->total_price + $order->shipping_cost - $order->coupon_discount;
            $data = [
                'order_id' => $order->order_id,
                'total_price' => $total_price,
                'total_qty' => $order->total_qty,
                'currency' => $order->currency,
                'payment_method' => $request->payment_method
            ];
            Session::put('payment_data', $data);
        }else{
            Toastr::error('Payment failed.');
            return redirect()->back();
        }

        if($request->payment_method == 'cash-on-delivery'){
			
			if(isset($request->trnx_id)) {
			 $checkTrnx = Order::where('tnx_id', $trnx_id)->first();
			$checkPay = OrderPayment::where('transaction_id', $trnx_id)->first();
            if(empty($checkTrnx) && empty($checkPay)){
			
			
            Session::put('payment_data.status', 'success');
			
			
			
			
			$prepay = (Config::get('siteSetting.cod') / 100) * $total_price;
			
			 
				 
				 
				 
				 
				 
				 
				 
                  OrderPayment::create([
                        'order_id' => $order->order_id,
                       'user_id' => Auth::id(),
                       'payment_method' => 'pending',
                     'amount' => $prepay,
                     'transaction_id' => $request->trnx_id,
                     'account_no' => $request->account,
                     'transaction_details' => 'Prepay For COD',
					 'status' => 'pending'
                   ]);
                
			
            //redirect payment success method
            return $this->paymentSuccess();
			}
			}
        }elseif($request->payment_method == 'wallet-balance'){
            if(Auth::user()->wallet_balance >= $total_price) {
                Session::put('payment_data.status', 'success');
                Session::put('payment_data.payment_status', 'paid');
                //redirect payment success method
                return $this->paymentSuccess();
            }else{
                Toastr::error('Insufficient wallet balance.');
                return redirect()->back();
            }
        }
        elseif($request->payment_method == 'sslcommerz'){
            //redirect SslCommerzPaymentController for payment process
            $sslcommerz = new SslCommerzPaymentController;
            return $sslcommerz->sslCommerzPayment();
        }elseif($request->payment_method == 'nagad'){
            //redirect PaypalController for payment process
            $nagad = new NagadPaymentController;
            return $nagad->nagadPayment();
        }elseif($request->payment_method == 'shurjopay'){
            //redirect shurjopayController for payment process
            $shurjopay = new ShurjoController();
            return $shurjopay->shurjoPayment();
        }elseif($request->payment_method == 'paypal'){
            //redirect PaypalController for payment process
            $paypal = new PaypalController;
            return $paypal->paypalPayment();
        }
        elseif($request->payment_method == 'masterCard'){
            //redirect StripeController for payment process
            Session::put('payment_data.stripeToken', $request->stripeToken);
            $stripe = new StripeController();
            return $stripe->masterCardPayment();
        }
        elseif($request->payment_method == 'manual'){
            $trnx_id = ($request->manual_method_name == 'cash') ? 'cash'.rand(000, 999) : $request->trnx_id;
            $checkTrnx = Order::where('tnx_id', $trnx_id)->first();
			$checkPay = OrderPayment::where('transaction_id', $trnx_id)->first();
            if(empty($checkTrnx) && empty($checkPay)){
                Session::put('payment_data.payment_method', $request->manual_method_name);
                Session::put('payment_data.status', 'success');
                Session::put('payment_data.trnx_id', $request->trnx_id);
                Session::put('payment_data.payment_info', $request->payment_info);
                //redirect payment success method
                return $this->paymentSuccess();
            }else{
                Toastr::error('This transaction is invalid.');
                return redirect()->back()->withInput()->with('error', 'This transaction is invalid.');
            }
        }else{
            Toastr::error('Please select payment method');
        }
        return back();
    }

    //payment status success then update payment status
    public function paymentSuccess(){

        $payment_data = Session::get('payment_data');
        //clear session payment data
        Session::forget('payment_data');
        if($payment_data && $payment_data['status'] == 'success') {
            $order = Order::with('order_details')->where('order_id', $payment_data['order_id'])->first();
            if ($order) {
                $user_id = $order->user_id;
                $order->payment_method = $payment_data['payment_method'];
                $order->tnx_id = (isset($payment_data['trnx_id'])) ? $payment_data['trnx_id'] : null;
                $order->order_date = now();
                $order->payment_status = (isset($payment_data['payment_status'])) ? $payment_data['payment_status'] : 'pending';
                $order->payment_info = (isset($payment_data['payment_info'])) ? $payment_data['payment_info'] : null;
                $order->save();
                //when one order multi payment work this
//                if(isset($payment_data['trnx_id'])) {
//                    OrderPayment::create([
//                        'order_id' => $order->order_id,
//                        'user_id' => $user_id,
//                        'paymant_method' => $order->payment_method,
//                        'amount' => $order->total_price,
//                        'transaction_id' => $order->tnx_id,
//                        'transaction_details' => $order->payment_info,
//                        'status' => 'paid'
//                    ]);
//                }
                if ($order && $payment_data['payment_method'] == 'wallet-balance') {
                    $order = Order::where('order_id', $payment_data['order_id'])->first();
                    $shipping_cost = ($order->shipping_cost) ? $order->shipping_cost : 0;
                    $total_price = $order->total_price + $shipping_cost - $order->coupon_discount;
                    if(Auth::user()->wallet_balance < $total_price) {
                        Toastr::error('Insufficient your wallet balance.');
                        return redirect()->back();
                    }
                    //minuse wallet balance;
                    $user = User::find($order->user_id);
                    $user->wallet_balance = $user->wallet_balance - $total_price;
                    $user->save();
                }
                //minus product stock qty
                foreach ($order->order_details as $order_detail){
                    if($order_detail->qty <= $order_detail->product->stock && $order_detail->product->product_type != 'mystery-box') {
                        $order_detail->product->decrement('stock', $order_detail->qty);
                    }
                }
                //send mobile notify
                $customer_mobile = ($order->billing_phone) ? $order->billing_phone : $order->shipping_phone;
                if($order->order_type == 'quiz'){
                    $msg = 'Dear customer, Your quiz package purchase order id ('.$order->order_id .'). Go to the link to participate in the quiz.'. url('quiz/'.$order->offer->slug.'?order_id='.$order->order_id);
                }else{
                    $msg = 'Dear customer, Your order has been successfully placed on ' . $_SERVER['SERVER_NAME'];
                }
                $this->sendSms($customer_mobile, $msg);
                if($order->order_type == 'quiz'){
                    return redirect('quiz/'.$order->offer->slug.'?order_id='.$order->order_id);
                }
                // $admin_mobile = Config::get('siteSetting.phone');
                // $admin_msg = 'You have received a new order on '.$_SERVER['SERVER_NAME'].'. Order details '.route('orderTracking').'?order_id='.$order->order_id;
                // $this->sendSms($admin_mobile, $admin_msg);
                //insert notification in database
                Notification::create([
                    'type' => 'order',
                    'fromUser' => Auth::id(),
                    'toUser' => null,
                    'item_id' => $payment_data['order_id'],
                    'notify' => 'Placed order',
                ]);
                return redirect()->route('order.paymentConfirm', $payment_data['order_id']);
            }
        }
        return redirect()->route('user.orderHistory');
    }

    //payment complete thanks page
    public function paymentConfirm($orderId){
        $order = Order::with(['order_details.product:id,title,slug,feature_image','get_area','get_city','get_state'])->where('user_id', Auth::id())
            ->where('order_id', $orderId)->first()->toArray();

        //send notification in email
        //Mail::to(Auth::user()->email)->send(new OrderMail($order));
        Toastr::success('Thanks Your order submitted successfully');
        return view('frontend.checkout.payemnt-confirmation')->with(compact('order'));
    }

}
