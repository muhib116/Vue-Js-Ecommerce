<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Admin;
use App\Models\Notification;
use App\Models\PaymentSetting;
use App\Models\Transaction;
use App\User;
use App\Vendor;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Models\City;
use App\Models\SiteSetting;
use App\Traits\Sms;

class WalletController extends Controller
{
    use Sms;
    //customer wallet history
    public function customerWalletHistory($type=null){
        $data['totalBalance'] = User::where('wallet_balance', '>', 0)->sum('wallet_balance');
        $data['totalWithdraw'] = Transaction::where('type', 'withdraw')->where('customer_id', '!=', null)->where('status', 'paid')->sum('amount');
        $allWallets = Transaction::with(['customer:id,name,username,mobile', 'addedBy'])
            ->where('customer_id', '!=', null);
            if($type){
                $allWallets->where('type', $type);
            }else{
                $allWallets->whereIn('type', ['wallet','withdraw','walletRecharge', 'refund']);
            }
        $data['allWallets'] = $allWallets->orderBy('id', 'desc')->paginate(15);
        return view('admin.wallet.wallet')->with($data);
    }
    //seller wallet history
    public function sellerWalletHistory(){
        $data['transactions'] = Transaction::with(['seller:id,shop_name,slug,mobile', 'addedBy'])->orderBy('id', 'desc')->where('seller_id', '!=', null)->paginate(15);
        $data['totalBalance'] = Vendor::where('balance', '>', 0)->sum('balance');
        $data['totalWithdraw'] = Transaction::where('type', 'withdraw')->where('seller_id', '!=', null)->where('status', 'paid')->sum('amount');
        $data['pendingWithdraw'] = Transaction::where('type', 'withdraw')->where('seller_id', '!=', null)->where('status', 'pending')->sum('amount');

        return view('admin.vendor.transactions')->with($data);
    }
    //get customer wallet info
    public function customerWalletInfo(Request $request){
        $customer = User::where('name', $request->customer)->orWhere('mobile', $request->customer)->orWhere('email', $request->customer)->first();
        if($customer) {
            return view('admin.wallet.customerWalletInfo')->with(compact('customer'));
        }
        return false;
    }
    //recharge customer wallet
    public function walletRecharge(Request $request){
        $request->validate([
            'amount' => 'required',
            'transaction_details' => 'required',
        ]);
        $customer = User::find($request->customer_id);
        if($customer) {
            $old_balance = $customer->wallet_balance;
            if ($request->wallet_type == 'add') {
                $amount =  '+'.$request->amount;
                $total_amount =  $old_balance + $request->amount;
                $rechargeType = 'Add wallet balance';
            }
            if ($request->wallet_type == 'minus') {
                $amount =  '-'.$request->amount;
                $total_amount =  $old_balance - $request->amount;
                $rechargeType = 'Minus wallet balance';
                $customer->wallet_balance = $total_amount;
                $customer->save();
            }

            //insert transaction
            $transaction = new Transaction();
            $transaction->type = 'walletRecharge';
            $transaction->notes = $request->notes;
            $transaction->item_id = $customer->id;
            $transaction->payment_method = ($request->payment_method) ? $request->payment_method : $rechargeType;
            $transaction->transaction_details = $request->transaction_details;
            $transaction->amount = $amount;
            $transaction->total_amount = $total_amount;
            $transaction->customer_id = $customer->id;
            $transaction->created_by = Auth::guard('admin')->id();
            $transaction->status = ($request->wallet_type == 'minus') ? 'paid' : 'pending' ;
            $transaction->save();
            Toastr::success($customer->name.'\'s wallet recharge success.');
            //send sms notify
            if($customer->mobile && $request->wallet_type == 'minus') {
                $customer_mobile = $customer->mobile;
                $wallet_type = ($request->wallet_type == 'minus') ? 'minus ' : 'added ';
                $msg = 'Dear '. $customer->name .', ' . $wallet_type . Config::get('siteSetting.currency_symble') . $request->amount . ' to your kalkerdeal wallet balance. '.' Get up to 50% discount shop at '.$_SERVER['SERVER_NAME'];
                $this->sendSms($customer_mobile, $msg);
            }
        }else{
            Toastr::error('Wallet recharge failed customer not found.');
        }
        return back();
    }
    //change wallet recharge status
    public function walletRechargeStatus(Request $request){
        $wallet = Transaction::find($request->id);
        if($wallet && $wallet->status != 'paid') {
            $wallet->status = $request->status;
            $wallet->save();
            if ($request->status == 'paid'){
                $customer = User::find($wallet->customer_id);
                $amount = ($wallet->amount > 0) ? $customer->wallet_balance + str_replace('+', '', $wallet->amount) : $customer->wallet_balance - str_replace('-', '', $wallet->amount);
                $customer->wallet_balance = $amount;
                $customer->save();

                $customer_mobile = $customer->mobile;
                $wallet_type = ($wallet->amount < 0) ? 'minus ' : 'added ';
                $msg = 'Dear ' . $customer->name . ', ' . $wallet_type . Config::get('siteSetting.currency_symble') . preg_replace("/[-+]+/", "",$wallet->amount) . ' to your wallet balance. ' . ' Get up to 50% discount shop at ' . $_SERVER['SERVER_NAME'];
                $this->sendSms($customer_mobile, $msg);
            }
            $output = array('status' => true, 'message' => 'Wallet recharge status update success.');
        }else{
            $output = array( 'status' => false,  'message'  => 'Wallet recharge status update failed.');
        }
        return response()->json($output);
    }
    //admin view customer/seller all withdraw History
    public function getWithdrawHistory(Request $request, $user_id){
        if($request->customer){
            $withdraws = Transaction::with('paymentGateway')->where('type', 'withdraw')
                ->orderBy('id', 'desc')
                ->where('customer_id', $user_id)->get();
            return view('admin.wallet.withdraw-history')->with(compact('withdraws'));
        }

        $withdraws = Transaction::with('paymethod_name')->where('type', 'withdraw')
            ->orderBy('id', 'desc')
            ->where('seller_id', $user_id)->get();
        return view('admin.vendor.withdraw_history')->with(compact('withdraws'));
    }
    public function withdrawMakePaymentDetails(Request $request, $withdraw_id){

        $user = Transaction::with('paymentGateway')
            ->where('id', $withdraw_id)->first();

        if($user) {
            return view('admin.wallet.withdraw-details')->with(compact('user'));
        }else{
            return 'Withdraw request not found';
        }
    }

    // change withdraw Status function
    public function changeWithdrawStatus(Request $request){
        $withdraw = Transaction::find($request->withdraw_id);
        if($withdraw && $withdraw->status != 'cancel' && $withdraw->status != 'paid'){
            $withdraw->transaction_details = $request->transaction_details;
            $withdraw->status = $request->status;
            $withdraw->save();

            if($request->status == 'cancel') {
                //Returned seller balance
                if ($withdraw->seller_id && $withdraw->seller){
                    $seller = $withdraw->seller;
                    $seller->balance = $seller->balance + $withdraw->amount;
                    $seller->save();
                }
                //Returned customer balance
                if ($withdraw->customer_id && $withdraw->customer){
                    $customer = $withdraw->customer;
                    $customer->wallet_balance = $customer->wallet_balance + $withdraw->amount;
                    $customer->save();
                }
            }

            //insert notification in database
            Notification::create([
                'type' => 'withdraw',
                'fromUser' => Auth::guard('admin')->id(),
                'toUser' => ($withdraw->seller_id) ? $withdraw->seller_id : $withdraw->customer_id,
                'item_id' => $withdraw->id,
                'notify' => $request->status.' withdraw request',
            ]);
            Toastr::success( 'Withdraw status '.str_replace( '-', ' ', $request->status).' successful.' );

            if($withdraw->seller_id && $withdraw->seller){
                $output = array( 'status' => true,  'message'  => 'Withdraw status '.str_replace( '-', ' ', $request->status).' successful.');
                return response()->json($output);
            }

        }else{
            Toastr::error('Withdraw status update failed.!');
        }

        return back();
    }


}
