<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use App\Models\AffiliateAgent;
use App\Models\AffiliateAgentProduct;
use App\Models\AffiliateProduct;
use App\Models\Area;
use App\Models\Brand;
use App\Models\Category;
use App\Models\City;
use App\Models\Notification;
use App\Models\OrderDetail;
use App\Models\PaymentGateway;
use App\Models\SiteSetting;
use App\Models\State;
use App\Models\Transaction;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AffiliateAgentController extends Controller
{
    public function affiliateProducts(Request $request){
        //check affiliate request active/pending
        if(Auth::user()->affiliateAgent && Auth::user()->affiliateAgent->status == 'active') {
            $agent_id = Auth::id();
            $products = AffiliateProduct::with(['agentProduct' => function($query) use ($agent_id) {$query->where('agent_id', $agent_id);} ])
                ->join('products', 'affiliate_products.product_id', 'products.id')
                ->where('products.status', 'active')->where('day', '>', 0)
                ->where('affiliate_products.status', 'active');
            if ($request->product) {
                $keyword = $request->product;
                $products->where(function ($query) use ($keyword) {
                    $query->orWhere('title', 'like', '%' . $keyword . '%');
                    $query->orWhere('meta_keywords', 'like', '%' . $keyword . '%');
                });
            }
            if ($request->brand && $request->brand != 'all') {
                $products->where('brand_id', $request->brand);
            }
            if ($request->sorting && $request->sorting != 'all') {
                $products->orderBy('office_rate', $request->sorting);
            }
            if ($request->category && $request->category != 'all') {
                $products->where('category_id', $request->category);
            }
            $data['allproducts'] = $products->orderBy('id', 'desc')->selectRaw('affiliate_products.*, products.title,selling_price,stock,products.slug,feature_image')->paginate(15);
            $data['categories'] = Category::where('parent_id', '=', null)->orderBy('name', 'asc')->where('status', 1)->get();
            $data['brands'] = Brand::orderBy('name', 'asc')->get();
            return view('users.affiliates.affiliateProducts')->with($data);
        }else{
            return redirect()->route('agent.affiliateRequest');
        }
    }
    //agent affiliate product list
    public function myAffiliateProducts(Request $request){
        //check affiliate request active/pending
        if(Auth::user()->affiliateAgent && Auth::user()->affiliateAgent->status == 'active') {
            $affiliate_products = AffiliateAgentProduct::with('affiliateProduct')
                ->join('products', 'affiliate_agent_products.product_id', 'products.id')
                ->where('agent_id', Auth::id());
            if ($request->title) {
                $affiliate_products->where('products.title', 'LIKE', '%' . $request->title . '%');
            }
            if ($request->status && $request->status != 'all') {
                if ($request->status == 'stock-out') {
                    $affiliate_products->where('stock', 0);
                } else {
                    $affiliate_products->where('affiliate_agent_products.status', $request->status);
                }
            }
            $perPage = 15;
            if ($request->show) {
                $perPage = $request->show;
            }
            $data['affiliate_products'] = $affiliate_products->orderBy('position', 'asc')
                ->selectRaw('affiliate_agent_products.*, products.title,selling_price,stock,products.slug,feature_image')
                ->paginate($perPage);
            $data['categories'] = Category::where('parent_id', '=', null)->orderBy('name', 'asc')->where('status', 1)->get();
            $data['brands'] = Brand::orderBy('name', 'asc')->get();
            $data['totalStoreProducts'] = AffiliateAgentProduct::where('agent_id', Auth::id())->count();
            return view('users.affiliates.myAffiliateProducts')->with($data);
        }else{
            return redirect()->route('agent.affiliateRequest');
        }
    }
    //get all affiliate products for store
    public function affiliateGetAllProducts (Request $request){
        $agent_id = Auth::id();
        $products = AffiliateProduct::with(['agentProduct' => function($query) use ($agent_id) {$query->where('agent_id', $agent_id);} ])
            ->join('products', 'affiliate_products.product_id', 'products.id')
            ->where('products.status', 'active')->where('day', '>', 0)->where('affiliate_products.status', 'active');

        if ($request->product) {
            $keyword = $request->product;
            $products->where(function ($query) use ($keyword) {
                $query->orWhere('title', 'like', '%' . $keyword . '%');
                $query->orWhere('meta_keywords', 'like', '%' . $keyword . '%');
            });
        }
        if ($request->brand && $request->brand != 'all') {
            $products->where('brand_id', $request->brand);
        }
        if ($request->sorting && $request->sorting != 'all') {
            $products->orderBy('office_rate', $request->sorting);
        }
        if ($request->category && $request->category != 'all') {
            $products->where('category_id', $request->category);
        }
        $data['allproducts'] = $products->orderBy('id', 'desc')->selectRaw('affiliate_products.*, products.title,selling_price,stock,products.slug,feature_image')->paginate(15);

        return view('users.affiliates.getProducts')->with($data);
    }
    //added agent affiliate product in her store
    public function agentAffiliateProductStore(Request $request)
    {
        $agent_id = Auth::id();
        //single product store
        if(request()->isMethod('get')) {
            //check price integer
            if (!is_numeric($request->agent_rate)) {
                $output = [
                    'status' => false,
                    'msg' => 'Invalid Price.'
                ];
                return response()->json($output);
            }
            $affiliateProduct = AffiliateAgentProduct::where('agent_id', $agent_id)->where('product_id', $request->product_id)->first();
            if (!$affiliateProduct) {
                $affiliateProduct = AffiliateProduct::with('product:id,selling_price')->where('product_id', $request->product_id)->first();
                if ($request->agent_rate >= $affiliateProduct->office_rate && $request->agent_rate <= $affiliateProduct->product->selling_price) {
                    $product = new AffiliateAgentProduct();
                    $product->affiliate_product_id = $affiliateProduct->id;
                    $product->product_id = $affiliateProduct->product_id;
                    $product->agent_id = $agent_id;
                    $product->agent_price = $request->agent_rate;
                    $product->status = 'active';
                    $product->save();
                    $output = [
                        'status' => true,
                        'msg' => 'Product added success.'
                    ];
                } else {
                    $output = [
                        'status' => false,
                        'msg' => 'Product price must be greater than ' . Config::get('siteSetting.currency_symble') . $affiliateProduct->office_rate . ' And less than ' . Config::get('siteSetting.currency_symble') . $affiliateProduct->product->selling_price
                    ];
                }
            } else {
                $output = [
                    'status' => false,
                    'msg' => 'This product already added.'
                ];
            }
            return response()->json($output);
        }
        //multi product store
        if(request()->isMethod('post')) {
            $status = true;
            if ($request->product_id && count($request->product_id) > 0){
                foreach ($request->product_id as $product_id => $value) {
                    //check agent rate integer
                    if (is_numeric($request->agent_rate[$product_id])) {
                        $affiliateProduct = AffiliateAgentProduct::where('agent_id', $agent_id)->where('product_id', $product_id)->first();
                        if (!$affiliateProduct) {
                            $affiliateProduct = AffiliateProduct::with('product:id,selling_price')->where('product_id', $product_id)->first();
                            //check agent price
                            if ($request->agent_rate[$product_id] >= $affiliateProduct->office_rate && $request->agent_rate[$product_id] <= $affiliateProduct->product->selling_price) {
                                $product = new AffiliateAgentProduct();
                                $product->affiliate_product_id = $affiliateProduct->id;
                                $product->product_id = $affiliateProduct->product_id;
                                $product->agent_id = $agent_id;
                                $product->agent_price = $request->agent_rate[$product_id];
                                $product->status = 'active';
                                $product->save();
                            }
                        } else {
                            $status = false;
                        }
                    }
                }
                if ($status) {
                    Toastr::success('Product added success.');
                } else {
                    Toastr::error('Some product already added.');
                }
            }else{
                Toastr::error('Please select any product.');
            }
            return redirect()->back();
        }
    }
    //Product Remove from affiliate
    public function affiliateProductRemove($id)
    {
        $agent_id = Auth::id();
        $affiliateProduct = AffiliateAgentProduct::where('id', $id)->where('agent_id', $agent_id)->first();
        if($affiliateProduct){
            $affiliateProduct->delete();
            $output = [
                'status' => true,
                'msg' => 'Product remove successful.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Product cannot remove.'
            ];
        }
        return response()->json($output);
    }
    //agent set product price
    public function agentSetProductPrice(Request $request){
        $agent_id = Auth::id();
        $product = AffiliateAgentProduct::with(['affiliateProduct', 'product'])->where('agent_id', $agent_id)->where('id', $request->id)->first();
        if($product) {
            if($request->agent_rate >= $product->affiliateProduct->office_rate && $request->agent_rate <= $product->product->selling_price)
            {
                $product->agent_price = $request->agent_rate;
                $product->save();
                $commission = $request->agent_rate - $product->affiliateProduct->office_rate;
                $output = [
                    'status' => true,
                    'commission' => $commission,
                    'msg' => 'Product price update success.'
                ];
            }else{
                $output = [
                    'status' => false,
                    'msg' => 'Product price must be greater than '. Config::get('siteSetting.currency_symble'). $product->affiliateProduct->office_rate . ' And less than ' .Config::get('siteSetting.currency_symble') . round($product->product->selling_price)
                ];
            }
        } else {
            $output = [
                'status' => false,
                'msg' => 'Product price update failed.'
            ];
        }
        return response()->json($output);

    }
    //user affiliate request
    public function affiliateRequest(Request $request){
        $user_id = Auth::id();
        $user = User::with('affiliateAgent')->where('id', $user_id)->first();
        //if already register
        if($user->affiliateAgent && $user->affiliateAgent->status == 'active'){
            return redirect()->route('agent.affiliateProducts');
        }
        if($request->isMethod('get')) {
            $data['user'] = $user;
            $data['states'] = State::where('country_id', 18)->where('status', 1)->get();
            $data['cities'] = City::where('state_id', $data['user']->region )->where('status', 1)->get();
            $data['areas'] = Area::where('city_id', $data['user']->city )->where('status', 1)->get();
            return view('users.affiliates.affiliateRequestForm')->with($data);
        }
        if($request->isMethod('post')){
            $affiliate_configure = Affiliate::first();
            if($affiliate_configure->status == 1) {
                $user->gender = $request->gender;
                $user->profession = $request->profession;
                $user->region = $request->region;
                $user->city = $request->city;
                $user->area = $request->area;
                $user->address = $request->address;
                $update = $user->save();
                if ($update) {
                    $affiliate_configure = Affiliate::first();
                    //check affiliate request
                    $affiliate = AffiliateAgent::where('user_id', $user_id)->first();
                    if (!$affiliate) {
                        $affiliate = new AffiliateAgent();
                        $affiliate->referral_code = $this->uniqueReferralCode();
                    }
                    $affiliate->referral_website = $request->referral_website;
                    $affiliate->user_id = $user_id;
                    $affiliate->details = $request->details;
                    //check account active/pending
                    $affiliate->status = ($affiliate_configure->registration_status == 1) ? 'active' : 'pending';
                    $affiliate->save();
                }
                Toastr::success('Your affiliate agent request send success.');
            }else{
                Toastr::error('Sorry ay this moment affiliate agent request closed.');
            }
            return redirect()->back();
        }
    }
    //affiliate order reports
    public function affiliateOrders($status=''){
        $agent_id = Auth::id();
        $orders = OrderDetail::join('orders', 'order_details.order_id', 'orders.order_id')
            ->where('affiliate_agent_id', $agent_id)
            ->where('payment_method', '!=',  'pending');
        if($status){
            $orders->where('order_status', $status);
        }
        $orders = $orders->orderBy('order_details.id', 'desc')->selectRaw('order_details.*, orders.currency_sign, orders.order_date')->paginate(25);
        return view('users.affiliates.affiliateOrders')->with(compact('orders'));
    }
    //transaction history
    public function affiliateTransactions(Request $request){
        $agent_id = Auth::id();
        $wallets = Transaction::with(['paymentGateway'])
            ->where('ref_id', $agent_id)
            ->whereIn('type', ['order', 'withdraw']);
        if($request->withdraw && $request->withdraw != 'all'){
            $wallets->where('transactions.status', $request->withdraw);
        }
        $data['wallets'] =   $wallets->orderBy('id', 'desc')->get();
        $data['paymentGateways'] = PaymentGateway::where('method_for', 'payment')->where('status', 1)->get();
        $data['affiliate_configure'] = Affiliate::first();
        return view('users.affiliates.affiliateTransactions')->with($data);
    }
    //affiliate Withdraw Request
    public function affiliateWithdrawRequest(Request $request){
        $affiliate_configure = Affiliate::first();
        $request->validate([
            'payment_method' => ['required'],
            'amount' => ['required'],
            'account_no' => ['required'],
            'password' => ['required'],
        ]);
        // if occur error open model
        Session::put('submitType', 'withdraw_request');
        $agent_id = Auth::id();
        $amount = $request->amount;
        $user = User::where('id', $agent_id)->first();
        if($user && Hash::check($request->password, $user->password)) {
            //Minimum withdrawal amount
            if($amount < $affiliate_configure->withdrawal_amount){
                $msg = 'Minimum withdrawal amount '. Config::get('siteSetting.currency_symble') . $affiliate_configure->withdrawal_amount;
                Toastr::error($msg);
            }
            elseif($request->amount > $user->affiliate_balance){
                $msg = 'Insufficient Your Wallet Balance.';
                Toastr::error($msg);
            }
            else {
                //minus customer balance
                $user->affiliate_balance = $user->affiliate_balance - $request->amount;
                $user->save();
                $invoice_id = 'A'.Auth::id() . strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), -6));
                //insert transaction
                $withdraw = new Transaction();
                $withdraw->type = 'withdraw';
                $withdraw->payment_method = $request->payment_method;
                $withdraw->customer_id = $agent_id;
                $withdraw->item_id = $invoice_id;
                $withdraw->amount = $amount;
                $withdraw->ref_id = $agent_id;
                $withdraw->account_no = $request->account_no;
                $withdraw->notes = $request->notes;
                $withdraw->status = 'pending';
                $withdraw->save();

                //insert notification in database
                Notification::create([
                    'type' => 'withdraw',
                    'fromUser' => $agent_id,
                    'toUser' => null,
                    'item_id' => $withdraw->id,
                    'notify' => 'withdraw request',
                ]);
                $msg = 'Withdrawal request submitted successful.';
                Toastr::success($msg);
                return redirect()->back()->with('success', $msg);
            }
        }else{
            $msg = 'Sorry invalid password.!.';
            Toastr::error($msg);
        }
        return redirect()->back()->withInput()->with('error', $msg);

    }
    //generate referral unique code
    public function uniqueReferralCode($field='referral_code')
    {
        $prefix = 'WR';
        $numberLen = 6;
        $order_id = $prefix. strtoupper(substr(str_shuffle("0123456789"), -$numberLen));
        $check_path = DB::table('affiliate_agents')->select($field)->where($field, 'like', $order_id.'%')->get();
        if (count($check_path)>0){
            //find slug until find not used.
            for ($i = 1; $i <= 999; $i++) {
                $new_order_id = $prefix.strtoupper(substr(str_shuffle("0123456789"), -$numberLen));
                if (!$check_path->contains($field, $new_order_id)) {
                    return $new_order_id;
                }
            }
        }else{ return $order_id; }
    }
}
