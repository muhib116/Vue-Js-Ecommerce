<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\PaymentSetting;
use App\Models\Transaction;
use App\Vendor;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class VendorWalletController extends Controller
{
    //seller withdraw list
    public function sellerWithdrawHistory(){
        $vendor_id = Auth::guard('vendor')->id();
        $data['allwithdraws'] = Transaction::with('paymethod_name')->where('type', 'withdraw')
            ->orderBy('id', 'desc')
            ->where('seller_id', $vendor_id)->paginate(15);

        $data['withdraw_amount'] = Transaction::where('type', 'withdraw')->where('seller_id', $vendor_id)->where('status', '!=', 'cancel')->sum('amount');

        $data['total'] = Transaction::whereIn('type', ['order'])->where('seller_id', $vendor_id)->where('status', 'paid')->sum('amount');

        $data['paymentgateways'] = PaymentSetting::where('seller_id', $vendor_id)->get();

        return view('vendors.widthdraw')->with($data);
    }

    //seller send withdraw request
    public function sellerWithdrawRequest(Request $request){
        $vendor_id = Auth::guard('vendor')->id();
        $request->validate([
            'payment_method' => 'required',
            'amount' => 'required'
        ]);
        $seller = Vendor::find($vendor_id);

        if($request->amount < 50) {
            Toastr::error('Minimum Withdraw Amount '. Config::get('siteSetting.currency_symble') . 50);
        }elseif($request->amount > $seller->balance){
            Toastr::error('Insufficient Your Wallet Balance.');
        }else{
            //minus seller balance
            $seller->balance = $seller->balance - $request->amount;
            $seller->save();

            //insert transaction
            $withdraw = new Transaction();
            $withdraw->type = 'withdraw';
            $withdraw->payment_method = $request->payment_method;
            $withdraw->seller_id = $vendor_id;
            $withdraw->item_id = 'w-'.rand(0000,9999);
            $withdraw->amount = $request->amount;
            $withdraw->transaction_details = $request->message;
            $withdraw->status = 'pending';
            $withdraw->save();

            Toastr::success('Withdraw Request Send Success.');

            //insert notification in database
            Notification::create([
                'type' => 'withdraw',
                'fromUser' => $vendor_id,
                'toUser' => null,
                'item_id' => $withdraw->id,
                'notify' => 'withdraw request',
            ]);
        }

        return back();
    }

}
