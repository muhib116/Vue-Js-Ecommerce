<?php

namespace App\Http\Controllers;

use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\QuizUserController;
use App\Models\Order;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use shurjopayv2\ShurjopayLaravelPackage8\Http\Controllers\ShurjopayController;


class ShurjoController extends Controller
{
    public function shurjopayPayment(){
         $payment_data = Session::get('payment_data');
        if(in_array('quiz', $payment_data)){
            $total_price = $payment_data['total_price'];
            $customer_name= (Auth::user()->name) ? Auth::user()->name : 'kalkerdeal.com';
            $customer_email= (Auth::user()->email) ? Auth::user()->email : 'support@kalkerdeal.com';
            $customer_cell= (Auth::user()->mobile) ? Auth::user()->mobile : '+8801851526510';
            $customer_address = 'Shop No: 29 , Lavel-3,Mia Bari Tower, Dhaka, Bangladesh - 1216';
        }else {
            $order = Order::where('order_id', $payment_data['order_id'])->first();
            if (!Session::has('payment_data') && !$order) {
                return redirect()->back();
            }
            $customer_name= (Auth::user()->name) ? Auth::user()->name : $order->shipping_name;
            $customer_email= (Auth::user()->email) ? Auth::user()->email : $order->shipping_email;
            $customer_cell= (Auth::user()->mobile) ? Auth::user()->mobile : $order->shipping_phone;
            $customer_address = ($order->billing_address) ? $order->billing_address : $order->shipping_address;
            $total_price = $order->total_price + $order->shipping_cost - $order->coupon_discount;
        }
        $order_id = $payment_data['order_id'];
      
		
// $order->get_city->name;

$city = 'Dhaka';


$info = array( 'currency' => "BDT",'currency' => "BDT", 'prefix' => env('MERCHANT_PREFIX'), 'amount' => $total_price, 'order_id' => $order_id, 'discsount_amount' => 0, 'disc_percent' => 0, 'client_ip' => visitorip(), 'customer_name' => $customer_name, 'customer_phone' => $customer_cell, 'email' => $customer_email, 'customer_address' => $customer_address, 'customer_city' => $city, 'customer_state' => "", 'customer_postcode' => "", 'customer_country' => "Bangladesh" );


        $shurjopay_service = new ShurjopayController(); 
return $shurjopay_service->checkout($info);
        
        
        
    }

    public function paymentSuccess(Request $request)
    {
        try{
       if($request->filled('order_id')){
$shurjopay_service = new ShurjopayController(); 
$pdata = $shurjopay_service->verify($order_id);


} else {
Toastr::error('Payment failed');
            return redirect('/');
}




$cont = json_decode($pdata, true);
$data =  $cont['0'];
            if ($data && $data['sp_code'] == 1000 && $data['sp_massage']=="Success") {
                $orderid = $data['customer_order_id'];

                //after payment success update payment status
                Session::forget('payment_data');
                $data = [
                    'order_id' => $orderid,
                    'trnx_id' => $request->order_id,
                    'payment_status' => 'paid',
                    'payment_info' => $data['method'] . ' ,txId:' . $request->bank_trx_id,
                    'payment_method' => 'shurjopay',
                    'status' => 'success'
                ];
                
                
               
                    if(count(explode('WK', $payment_data['order_id']))>1){
                        if(Session::has('redirectLink')){
                            return redirect(Session::get('redirectLink'));
                        }
                        return Redirect::route('offers');
                    }
                    if(count(explode('WQ', $payment_data['order_id']))>1){
                        return redirect()->route('quiz.paymentGateway', encrypt($payment_data['order_id']));
                    }
                    return Redirect::route('order.paymentGateway', $payment_data['order_id']);
            }
        }catch (\Mockery\Exception $exception) {
            Toastr::error('Payment failed');
            return redirect('/');
        }
    }

}
