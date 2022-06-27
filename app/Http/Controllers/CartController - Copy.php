<?php

namespace App\Http\Controllers;

use App\Models\AffiliateAgent;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Offer;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\Price;
use App\Models\ProductVariationDetails;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function cartAdd(Request $request)
    {
        $product = Product::find($request->product_id);
		
		
	
		
		
		if($product->is_b2b == 0){
		
		
        if($product->product_type == 'voucher' || $product->product_type == 'pre-order'){
            $output = array(
                'status' => 'error',
                'msg' => str_replace('-', ' ', $product->product_type) .' product cannot be added to the cart.'
            );
            return response()->json($output);
        }
        $qty = 1;
		
		  $user_id = rand(0000, 9999);
        if(Auth::check()){
            $user_id = Auth::id();
        }else{
            if(Cookie::has('user_id') || Session::get('user_id')){
                $user_id = (Cookie::has('user_id') ? Cookie::get('user_id') :  Session::get('user_id'));
            }else{
                Session::put('user_id', $user_id );
                Cookie::queue('user_id', $user_id, time() + (86400));
            }
        }
		
		
		
		$selling_price = $product->selling_price;
	
        $cart_user = Cart::where('product_id', $product->id)->where('user_id', $user_id)->first();
        if($cart_user  && !$request->quantity){
            $qty = $cart_user->qty + 1;
        }else{
            $qty = ($request->quantity) ? $request->quantity : 1;
        }
        //check quantity
        if($qty > $product->stock) {
            $output = array(
                'status' => 'error',
                'msg' => 'Out of stock'
            );
            return $output;
        }







        $attributes = $request->except(['product_id', '_token', 'offer', 'quantity', 'buyDirect']);
        $variations = ProductVariationDetails::where('product_id', $request->product_id)->whereIn('attributeValue_name', array_values($attributes))->get();
        if(count($variations)>0){
            $variation_price = $selling_price;
            foreach ($variations as $variation){
                //check <,> variation & selling price
                if($variation->price > $variation_price){
                    $variation_price = $variation->price;
                }
            }
            //product variation price
            $selling_price = $variation_price;
        }
        
        $array  = array($request->offer, $product->id);
        
        
        $discount = $calculate_discount = $offer_id = $affiliate = $affiliate_amount = $affiliate_agent_id = null;
        $getOffer = Offer::join('offer_products', 'offers.id', 'offer_products.offer_id')->join('products', 'offer_products.product_id', 'products.id')
            ->where('offers.slug', $request->offer)
            ->where('offer_products.product_id', $request->product_id)
            ->where('offers.start_date', '<=', Carbon::now())->where('offers.end_date', '>=', Carbon::now())->where('offers.status', '=', 1)->whereNotIn('offers.offer_type', ['kanamachi', 'quiz'])
            ->selectRaw('offer_products.offer_id, offer_products.offer_discount, offer_products.discount_type')->first();
            
			
			
			
            
        if ($getOffer) {
            $offer_id = $getOffer->offer_id;
            $discount = $getOffer->offer_discount;
            $discount_type = $getOffer->discount_type;
			
			
			
			if($getOffer->offer_id == 84 && $request->product_id == 2760){
            $fivetaka = OrderDetail::where('product_id', 2760)->where('offer_id', 84)->where('user_id', $user_id)->count();
			if ($fivetaka >= 1) {
				$output = array(
                'status' => 'error',
                'msg' => 'Sorry, You Already Exceeds The Buying Limits For The Item'
            );
            return $output;
			} else {
				$tqty = ($fivetaka+$qty);
				if ($tqty > 1) {
				$output = array(
                'status' => 'error',
                'msg' => 'Sorry, You Already Exceeds The Buying Limits For The Item'
            );
            return $output;
			}
				
			}
			
			}
			
			
			
			if($getOffer->offer_id == 84 && $request->product_id == 2759){
            $fivetaka = OrderDetail::where('product_id', 2759)->where('offer_id', 84)->where('user_id', $user_id)->count();
			if ($fivetaka >= 3) {
				$output = array(
                'status' => 'error',
                'msg' => 'Sorry, You Already Exceeds The Buying Limits For The Item'
            );
            return $output;
			} else {
				$tqty = ($fivetaka+$qty);
				if ($tqty > 3) {
				$output = array(
                'status' => 'error',
                'msg' => 'Sorry, You Already Exceeds The Buying Limits For The Item'
            );
            return $output;
			}
				
			}
			
			}
			
			if($getOffer->offer_id == 84 && $request->product_id == 2758){
            $fivetaka = OrderDetail::where('product_id', 2758)->where('offer_id', 84)->where('user_id', $user_id)->count();
			if ($fivetaka >= 3) {
				$output = array(
                'status' => 'error',
                'msg' => 'Sorry, You Already Exceeds The Buying Limits For The Item'
            );
            return $output;
			} else {
				$tqty = ($fivetaka+$qty);
				if ($tqty > 3) {
				$output = array(
                'status' => 'error',
                'msg' => 'Sorry, You Already Exceeds The Buying Limits For The Item'
            );
            return $output;
			}
				
			}
			
			}
			
			
        } else {
            //check referral product
            $referral_code = (Session::has('referral_code')) ? Session::get('referral_code') : Cookie::get('referral_code');
            if($referral_code) {
                $affiliate = AffiliateAgent::join('affiliate_agent_products', 'affiliate_agents.user_id', 'affiliate_agent_products.agent_id')
                    ->join('affiliate_products', 'affiliate_agent_products.product_id', 'affiliate_products.product_id')
                    ->where('referral_code', $referral_code)
                    ->where('affiliate_agent_products.product_id', $request->product_id)
                    ->where('affiliate_products.status', 'active')
                    ->selectRaw('affiliate_agent_products.agent_id , affiliate_agent_products.agent_price, affiliate_products.office_rate')->first();
            }
            if($affiliate){
                $selling_price = $affiliate->agent_price;
                $affiliate_agent_id = $affiliate->agent_id;
                $affiliate_amount = $affiliate->agent_price - $affiliate->office_rate;
            }else {
                $discount = $product->discount;
                $discount_type = $product->discount_type;
            }
        }
        if($discount){
            $calculate_discount = HelperController::calculate_discount($selling_price, $discount, $discount_type );
            $selling_price = $calculate_discount['price'];
        }

        if($cart_user){
            $data = ['qty' => (isset($request->quantity)) ? $request->quantity : $cart_user->qty+1, 'price' => $selling_price];
            //check attributes set or not
            if($request->quantity){
                $data = array_merge(['attributes' => json_encode($attributes)], $data);
            }
            $cart_user->update($data);
        }else{
			
			
			
			$offlist = Cart::where('offer_id', 80)->where('user_id', $user_id)->get();
		
		$cartamt = 0;
		foreach($offlist as $offerlist){
			$cartamt += ($offerlist->price*$offerlist->qty);
			
		}
		
		
		$onionlist = Cart::where('offer_id', 83)->where('user_id', $user_id)->get();
		
		$onionamt = 0;
		foreach($onionlist as $onion){
			$onionamt += ($onion->price*$onion->qty);
			
		}
		
		
		
		if($product->id == 5292){
			if($cartamt>999){
				
				
				$totaloil = Cart::where('offer_id', 80)->where('product_id', 5292)->where('user_id', $user_id)->first();
				if(empty($totaloil) || $totaloil->qty<1){
					$selling_price = 500;
				} else {
					$selling_price = $product->selling_price;
				}
				
			} else{
				$selling_price = $product->selling_price;
			}
		} elseif($product->id == 2513){
			if($onionamt>499 && $onionamt<1000){
				
				
				$totaloil = Cart::where('offer_id', 83)->where('product_id', 2513)->where('user_id', $user_id)->first();
				
				if(empty($totaloil) || $totaloil->qty<4){
					$selling_price = 35;
				} else {
					$selling_price = $product->selling_price;
				}
				
			}  else{
				$selling_price = $product->selling_price;
			}
		} else {
		
        $selling_price = $product->selling_price;
		
		}
		
		
			
			
			
			
            $data = [
                'user_id' => $user_id,
                'offer_id' => $offer_id,
                'product_id' => $request->product_id,
                'title' => $product->title,
                'slug' => $product->slug,
                'image' => $product->feature_image,
                'qty' => (isset($request->quantity)) ? $request->quantity : 1,
                'price' => $selling_price,
                'attributes' => json_encode($attributes),
                'affiliate_agent_id' => $affiliate_agent_id,
                'affiliate_amount' => $affiliate_amount,
            ];
            Cart::create($data);
        }
        $output = array(
            'status' => 'success',
            'title' => $product->title,
            'image' => $product->feature_image,
            'msg' => 'Product Added To Cart.'
        );
		
		} else {
			
			
			if($product->product_type == 'voucher' || $product->product_type == 'pre-order'){
            $output = array(
                'status' => 'error',
                'msg' => str_replace('-', ' ', $product->product_type) .' product cannot be added to the cart.'
            );
            return response()->json($output);
        }
        $qty = 1;
        $user_id = rand(0000, 9999);
        if(Auth::check()){
            $user_id = Auth::id();
        }else{
            if(Cookie::has('user_id') || Session::get('user_id')){
                $user_id = (Cookie::has('user_id') ? Cookie::get('user_id') :  Session::get('user_id'));
            }else{
                Session::put('user_id', $user_id );
                Cookie::queue('user_id', $user_id, time() + (86400));
            }
        }
        $cart_user = Cart::where('product_id', $product->id)->where('user_id', $user_id)->first();
        if($cart_user  && !$request->quantity){
            $qty = $product->minqty;
        }else{
            $qty = ($request->quantity) ? $request->quantity : $product->minqty;
        }
		
		
		$listprice = Price::where('product_id', $request->product_id)->where('start', '<=', $qty)->where('end', '>=', $qty)->first();
		
		
		//file_put_contents('nprice.txt', $listprice);
		
        $selling_price = $listprice->price+(($product->profit/100)*$listprice->price);
		
        //check quantity
        if($qty > $product->stock) {
            $output = array(
                'status' => 'error',
                'msg' => 'Out of stock'
            );
            return $output;
        }

        $attributes = $request->except(['product_id', '_token', 'offer', 'quantity', 'buyDirect']);
        $variations = ProductVariationDetails::where('product_id', $request->product_id)->whereIn('attributeValue_name', array_values($attributes))->get();
        if(count($variations)>0){
            $variation_price = $selling_price;
            foreach ($variations as $variation){
                //check <,> variation & selling price
                if($variation->price > $variation_price){
                    //$variation_price = $variation->price;
                }
            }
            //product variation price
           // $selling_price = $variation_price;
        }
        $discount = $calculate_discount = $offer_id = $affiliate = $affiliate_amount = $affiliate_agent_id = null;
        $getOffer = Offer::join('offer_products', 'offers.id', 'offer_products.offer_id')->join('products', 'offer_products.product_id', 'products.id')
            ->where('offers.slug', $request->offer)
            ->where('offer_products.product_id', $product->id)
            ->where('offers.start_date', '<=', Carbon::now())->where('offers.end_date', '>=', Carbon::now())->where('offers.status', '=', 1)->whereNotIn('offers.offer_type', ['kanamachi', 'quiz'])
            ->selectRaw('offer_products.offer_id, offer_products.offer_discount, offer_products.discount_type')->first();
        if ($getOffer) {
            $offer_id = $getOffer->offer_id;
            $discount = $getOffer->offer_discount;
            $discount_type = $getOffer->discount_type;
        } else {
            //check referral product
            $referral_code = (Session::has('referral_code')) ? Session::get('referral_code') : Cookie::get('referral_code');
            if($referral_code) {
                $affiliate = AffiliateAgent::join('affiliate_agent_products', 'affiliate_agents.user_id', 'affiliate_agent_products.agent_id')
                    ->join('affiliate_products', 'affiliate_agent_products.product_id', 'affiliate_products.product_id')
                    ->where('referral_code', $referral_code)
                    ->where('affiliate_agent_products.product_id', $request->product_id)
                    ->where('affiliate_products.status', 'active')
                    ->selectRaw('affiliate_agent_products.agent_id , affiliate_agent_products.agent_price, affiliate_products.office_rate')->first();
            }
            if($affiliate){
                $selling_price = $affiliate->agent_price;
                $affiliate_agent_id = $affiliate->agent_id;
                $affiliate_amount = $affiliate->agent_price - $affiliate->office_rate;
            }else {
                $discount = $product->discount;
                $discount_type = $product->discount_type;
            }
        }
        if($discount){
            $calculate_discount = HelperController::calculate_discount($selling_price, $discount, $discount_type );
            $selling_price = $calculate_discount['price'];
        }

        if($cart_user){
            $data = ['qty' => (isset($request->quantity)) ? $request->quantity : $cart_user->qty+1, 'price' => $selling_price];
            //check attributes set or not
            if($request->quantity){
                $data = array_merge(['attributes' => json_encode($attributes)], $data);
            }
            $cart_user->update($data);
        }else{
            $data = [
                'user_id' => $user_id,
                'offer_id' => $offer_id,
                'product_id' => $request->product_id,
                'title' => $product->title,
                'slug' => $product->slug,
                'image' => $product->feature_image,
                'qty' => (isset($request->quantity)) ? $request->quantity : 1,
                'price' => $selling_price,
                'attributes' => json_encode($attributes),
                'affiliate_agent_id' => $affiliate_agent_id,
                'affiliate_amount' => $affiliate_amount,
            ];
            Cart::create($data);
        }
        $output = array(
            'status' => 'success',
            'title' => $product->title,
            'image' => $product->feature_image,
            'msg' => 'Product Added To Cart.'
        );
			
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
        return response()->json($output);
    }

    public function cartView()
    {
        Cookie::queue(Cookie::forget('direct_checkout_product_id'));
        Session::forget('direct_checkout_product_id');
        $user_id = 0;
        if(Auth::check()){
            $user_id = Auth::id();
        }else{
            $user_id = (Cookie::has('user_id') ? Cookie::get('user_id') :  Session::get('user_id'));
        }

        $cartOfferProducts = Cart::with('get_product:id,selling_price')->join('offers', 'carts.offer_id', 'offers.id')
            ->whereNotNull('offer_id')
            ->where(function ($query) {
                $query->where('end_date', '<', Carbon::now()->addMinute(10))->orWhere('offers.status', '!=', 1);
            })->where('carts.user_id', $user_id)->selectRaw('carts.*')->get();

        if($cartOfferProducts){
            //update cart offer price to regular price
            foreach($cartOfferProducts as $cartOfferProduct){
                $cartOfferProduct->price = $cartOfferProduct->get_product->selling_price;
                $cartOfferProduct->offer_id = null;
                $cartOfferProduct->attributes = [];
                $cartOfferProduct->save();
            }
        }
        //delete voucher product from cart table
        Cart::join('products', 'carts.product_id', 'products.id')->where('products.product_type', 'voucher')->orWhere('products.product_type', 'pre-order')->delete();
        $cartItems = Cart::where('user_id', $user_id)->orderBy('id', 'desc')->get();
        return view('frontend.carts.cart')->with(['cartItems' => $cartItems]);
    }

    public function cartUpdate(Request $request)
    {
        $request->validate([
            'qty' => 'required:numeric|min:1'
        ]);

        if(Auth::check()){
            $user_id = Auth::id();
        }else{
            $user_id = (Cookie::has('user_id') ? Cookie::get('user_id') :  Session::get('user_id'));
        }
        $cart = Cart::with('get_product')->where('id', $request->id)->where('user_id', $user_id)->first();











if($cart->offer_id == 84 && $cart->product_id == 2760){
            $fivetaka = OrderDetail::where('product_id', 2760)->where('offer_id', 84)->where('user_id', $user_id)->count();
			if ($fivetaka >= 1) {
					return response()->json(['status' => 'error', 'msg' => 'Sorry, You Already Exceeds The Buying Limits For The Item']);
			
				
			} else {
				$tqty = ($fivetaka+$request->qty);
				if ($tqty > 1) {
					return response()->json(['status' => 'error', 'msg' => 'Sorry, You Already Exceeds The Buying Limits For The Item']);
			
			}
				
			}
			
			}
			
			
			
			if($cart->offer_id == 84 && $cart->product_id == 2759){
            $fivetaka = OrderDetail::where('product_id', 2759)->where('offer_id', 84)->where('user_id', $user_id)->count();
			if ($fivetaka >= 3) {
					return response()->json(['status' => 'error', 'msg' => 'Sorry, You Already Exceeds The Buying Limits For The Item']);
			
			} else {
				$tqty = ($fivetaka+$request->qty);
				if ($tqty > 3) {
					return response()->json(['status' => 'error', 'msg' => 'Sorry, You Already Exceeds The Buying Limits For The Item']);
			
			}
				
			}
			
			}
			
			if($cart->offer_id == 84 && $cart->product_id == 2758){
            $fivetaka = OrderDetail::where('product_id', 2758)->where('offer_id', 84)->where('user_id', $user_id)->count();
			if ($fivetaka >= 3) {
				return response()->json(['status' => 'error', 'msg' => 'Sorry, You Already Exceeds The Buying Limits For The Item']);
				
			} else {
				$tqty = ($fivetaka+$qty);
				if ($tqty > 3) {
					return response()->json(['status' => 'error', 'msg' => 'Sorry, You Already Exceeds The Buying Limits For The Item']);
			
			}
				
			}
			
			}





















        if($request->qty <= $cart->get_product->stock) {



if($cart->offer_id == 80 || $cart->offer_id == 83){
            
	
	$offlist = Cart::where('offer_id', 80)->where('user_id', $user_id)->where('product_id', $cart->get_product->id)->get();
		
		$cartamt = 0;
		foreach($offlist as $offerlist){
			$cartamt += ($offerlist->price*$offerlist->qty);
			
		}
		
	
	$onionlist = Cart::where('offer_id', 83)->where('user_id', $user_id)->get();
		
		$onionamt = 0;
		foreach($onionlist as $onion){
			$onionamt += ($onion->price*$onion->qty);
			
		}
		
		
	
		if($cart->get_product->id == 5292){
			if($cartamt>999){
				
				
				$totaloil = Cart::where('offer_id', 80)->where('product_id', 5292)->where('user_id', $user_id)->first();
				if($request->qty<2){
					$cart->update(['qty' => $request->qty, 'price' => 500]);
				} else {
					$cart->update(['qty' => $request->qty, 'price' => 770]);
				}
				
			} else{
				$cart->update(['qty' => $request->qty]);
			}
		} elseif($cart->get_product->id == 2513){
			if($onionamt>499){
				
				
				$totaloil = Cart::where('offer_id', 83)->where('product_id', 2513)->where('user_id', $user_id)->first();
				
				if($request->qty<4){
					$cart->update(['qty' => $request->qty, 'price' => 35]);
				} else {
					$cart->update(['qty' => $request->qty, 'price' => 65]);
				}
				
			}  else{
				$cart->update(['qty' => $request->qty]);
			}
		}
	
	
	
	
} else {
	$cart->update(['qty' => $request->qty]);
}
			
			
			
			
            $cartItems = Cart::with('get_product:id,selling_price,shipping_cost,discount,discount_type,product_type,shipping_method,is_b2b,profit')->where('user_id', $user_id);
            //check direct checkout
            if(Cookie::has('direct_checkout_product_id') || Session::has('direct_checkout_product_id')){
                $direct_checkout_product_id = (Cookie::has('direct_checkout_product_id') ? Cookie::get('direct_checkout_product_id') :  Session::get('direct_checkout_product_id'));
                $cartItems = $cartItems->where('product_id', $direct_checkout_product_id);
            }
            $cartItems = $cartItems->orderBy('id', 'desc')->get();

            if($request->page == 'checkout'){
                return view('frontend.checkout.order_summery')->with(compact('cartItems'));
            }else{
                return view('frontend.carts.cart_summary')->with(compact('cartItems'));
            }

        }else{
            return response()->json(['status' => 'error', 'msg' => 'Out of stock']);
        }
    }

     public function itemRemove(Request $request, $id)
    {
        $user_id = 0;
        if(Auth::check()){
            $user_id = Auth::id();
        }else{
            $user_id = (Cookie::has('user_id') ? Cookie::get('user_id') :  Session::get('user_id'));
        }


$cartname = Cart::where('user_id', $user_id)->where('id', $id)->first();

if($cartname->offer_id != 80 || $cartname->offer_id != 83){

        $cartItems = Cart::where('user_id', $user_id)->where('id', $id)->delete();
        if($cartItems){
            $cartItems = Cart::with('get_product')->where('user_id', $user_id)->get();
            if($request->page == 'checkout'){
                return view('frontend.checkout.order_summery')->with(compact('cartItems'));
            }
            return view('frontend.carts.cart_summary')->with(compact('cartItems'));
        }else{
            $output = array(
                'status' => 'error',
                'msg' => 'Cart item cannot delete.'
            );
        }
		
		
		
		
} else {
	
	
	if(Cart::where('user_id', $user_id)->where('offer_id', 80)->where('product_id', 5292)->count()>0){
		Cart::where('user_id', $user_id)->where('offer_id', 80)->where('product_id', 5292)->delete();
	}
	
	if(Cart::where('user_id', $user_id)->where('offer_id', 83)->where('product_id', 2513)->count()>0){
		Cart::where('user_id', $user_id)->where('offer_id', 83)->where('product_id', 2513)->delete();
	}
	
	 $cartItems = Cart::where('user_id', $user_id)->where('id', $id)->delete();
        if($cartItems){
            $cartItems = Cart::with('get_product')->where('user_id', $user_id)->get();
            if($request->page == 'checkout'){
                return view('frontend.checkout.order_summery')->with(compact('cartItems'));
            }
            return view('frontend.carts.cart_summary')->with(compact('cartItems'));
        }else{
            $output = array(
                'status' => 'error',
                'msg' => 'Cart item cannot delete.'
            );
        }
	
}
		
		
		
        return response()->json($output);
    }

    public function clearCart(){
        $user_id = 0;
        if(Auth::check()){
            $user_id = Auth::id();
        }else{
            $user_id = (Cookie::has('user_id') ? Cookie::get('user_id') :  Session::get('user_id'));
        }
        Cart::where('user_id', $user_id)->delete();
        //destroy coupon
        Session::forget('couponCode');
        Session::forget('couponAmount');
        return redirect()->back();
    }

    // apply coupon code in cart & checkout page
    public function couponApply(Request $request){
        $coupon = Coupon::where('coupon_code', $request->coupon_code)->first();
        //check coupon exist
        if(!$coupon){
            return response()->json(['status' => false, 'msg' => 'This coupon does not exists.']);
        }else{
            if($coupon->status != 1)
            {
                return response()->json(['status' => false, 'msg' => 'This coupon is not active.']);
            }
            if($coupon->times != null)
            {
                if($coupon->times == "0")
                {
                    return response()->json(['status' => false, 'msg' => 'Coupon usage limit has been reached.']);
                }
            }
            $today = Carbon::parse(now())->format('d-m-Y');
            $from = Carbon::parse($coupon->start_date)->format('d-m-Y');
            $to = Carbon::parse($coupon->expired_date)->format('d-m-Y');
            if($today < $from ){ return response()->json(['status' => false, 'msg' => 'This coupon is running from: '.$from]);}
            if( $to < $today ){ return response()->json(['status' => false, 'msg' => 'This coupon is expired.']);}
            $user_id = 0;
            if(Auth::check()){$user_id = Auth::id();
            }else{ $user_id = (Cookie::has('user_id') ? Cookie::get('user_id') :  Session::get('user_id'));}
            $cartItems = Cart::with('get_product:id,selling_price,discount,discount_type,shipping_method,ship_region_id,shipping_cost,other_region_cost')->where('user_id', $user_id);
            //check direct checkout
            if(Cookie::has('direct_checkout_product_id') || Session::get('direct_checkout_product_id')){
                $direct_checkout_product_id = (Cookie::has('direct_checkout_product_id') ? Cookie::get('direct_checkout_product_id') :  Session::get('direct_checkout_product_id'));
                $cartItems = $cartItems->where('product_id', $direct_checkout_product_id);
            }
            $cartItems = $cartItems->get();
            $total_shipping_cost = $total_amount = 0;
            foreach($cartItems as $item) {
                //calculate_discount price
                $price = $item->price;
                $total_amount += $price*$item->qty;
                //calculate shipping cost
                if(config('siteSetting.shipping_method') == 'product_wise_shipping'){
                    $shipping_cost = $item->get_product->shipping_cost;
                    //check shipping method
                    if ($item->get_product->shipping_method == 'location') {
                        if ($item->get_product->ship_region_id != Session::get('ship_region_id')) {
                            $shipping_cost = $item->get_product->other_region_cost;
                        }
                    }
                }else{
                    $shipping_cost =  \App\Http\Controllers\HelperController::shippingCharge(Session::get('ship_region_id'));
                }
                //if this quiz product shipping cost 0
                $shipping_cost = ($item->get_product->product_type == 'quiz' && $item->get_product->shipping_method == 'free') ? 0 : $shipping_cost;
                //check calculate type
                if(config('siteSetting.shipping_calculate') == 'per_product'){
                    $total_shipping_cost +=  $shipping_cost;
                }else{
                    if($shipping_cost > $total_shipping_cost) {
                        $total_shipping_cost = $shipping_cost;
                    }
                }
            }
            if($coupon->type == 0)
            {
                $couponAmount = round($total_amount * ($coupon->amount/100), 2);
                Session::put('couponType', '%');
                Session::put('couponAmount', round(($coupon->amount/100),2));
            }else{
                $couponAmount = $coupon->amount;
                Session::put('couponType', 'fixed');
                Session::put('couponAmount', $coupon->amount);
            }

            if(Session::get('couponCode') == $request->coupon_code){
                return response()->json(['status' => false, 'msg' => 'This coupon is already used.']);
            }
            //set coupon code
            Session::put('couponCode', $request->coupon_code);
            $grandTotal = round((($total_amount + $total_shipping_cost) - $couponAmount), 2);
            return response()->json(['status' => true, 'couponAmount' => $couponAmount, 'grandTotal' => $grandTotal, 'msg' => 'Coupon code successfully applied. You are available discount.']);
        }
    }

    public function buyDirect(Request $request)
    {
		
		
		
		
        $product = Product::selectRaw('id,title,selling_price,discount,discount_type,slug,stock,feature_image,is_b2b,profit,minqty')->where('id', $request->product_id)->first();
		
		
		if($product->is_b2b == 0){
		
        $qty = 0;
        $selling_price = $product->selling_price;
        if(Auth::check()){
            $user_id = Auth::id();
        }else{
            if(Cookie::has('user_id') || Session::get('user_id')){
                $user_id = (Cookie::has('user_id') ? Cookie::get('user_id') :  Session::get('user_id'));
            }else{
                $user_id = rand(1000000000, 9999999999);
                Session::put('user_id', $user_id);
                Cookie::queue('user_id', $user_id, time() + (86400));
            }
        }
        $cart_user = Cart::where('product_id', $product->id)->where('user_id', $user_id)->first();
        if($cart_user  && !$request->quantity){
            $qty = 1;
        }else{
            $qty = ($request->quantity) ? $request->quantity : 1;
        }
        //check quantity
        if($qty > $product->stock) {
            Toastr::error('Out of stock');
            return redirect()->back();
        }
		
		
		
		
		
		
		
		

        $attributes = $request->except(['product_id', '_token', 'offer', 'quantity', 'buyDirect']);
        $variations = ProductVariationDetails::where('product_id', $request->product_id)->whereIn('attributeValue_name', array_values($attributes))->get();
        if(count($variations)>0){
            $variation_price = $selling_price;
            foreach ($variations as $variation){
                if($variation->price > $variation_price){
                    $variation_price = $variation->price;
                }
            }
            $selling_price = $variation_price;
        }
        $discount = $calculate_discount = $offer_id = $affiliate = $affiliate_amount = $affiliate_agent_id = null;
        $getOffer =  Offer::join('offer_products', 'offers.id', 'offer_products.offer_id')->join('products', 'offer_products.product_id','products.id')
            ->where('offers.slug', request()->get('offer'))
            ->where('offer_products.product_id', $product->id)
            ->where('offers.start_date', '<=',  Carbon::now())->where('offers.end_date', '>=', Carbon::now())->where('offers.status', '=', 1)->whereNotIn('offers.offer_type', ['kanamachi', 'quiz'])
            ->selectRaw('offer_products.offer_id, offer_products.offer_discount, offer_products.discount_type')->first();
			
			
			
			
			
			
        if($getOffer){
			
			
			if($getOffer->offer_id == 84 &&$product->id == 2760){
            $fivetaka = OrderDetail::where('product_id', 2760)->where('offer_id', 84)->where('user_id', $user_id)->count();
			if ($fivetaka >= 1) {
				 Toastr::error('Sorry, You Already Exceeds The Buying Limits For The Item');
            return redirect()->back();
				
			} else {
				$tqty = ($fivetaka+$qty);
				if ($tqty > 1) {
				Toastr::error('Sorry, You Already Exceeds The Buying Limits For The Item');
            return redirect()->back();
			}
				
			}
			
			}
			
			
			
			if($getOffer->offer_id == 84 && $product->id == 2759){
            $fivetaka = OrderDetail::where('product_id', 2759)->where('offer_id', 84)->where('user_id', $user_id)->count();
			if ($fivetaka >= 3) {
				Toastr::error('Sorry, You Already Exceeds The Buying Limits For The Item');
            return redirect()->back();
			} else {
				$tqty = ($fivetaka+$qty);
				if ($tqty > 3) {
				Toastr::error('Sorry, You Already Exceeds The Buying Limits For The Item');
            return redirect()->back();
			}
				
			}
			
			}
			
			if($getOffer->offer_id == 84 && $product->id == 2758){
            $fivetaka = OrderDetail::where('product_id', 2758)->where('offer_id', 84)->where('user_id', $user_id)->count();
			if ($fivetaka >= 3) {
				Toastr::error('Sorry, You Already Exceeds The Buying Limits For The Item');
            return redirect()->back();
			} else {
				$tqty = ($fivetaka+$qty);
				if ($tqty > 3) {
				Toastr::error('Sorry, You Already Exceeds The Buying Limits For The Item');
            return redirect()->back();
			}
				
			}
			
			}
		
			
			
			
            $offer_id = $getOffer->offer_id;
            $discount = $getOffer->offer_discount;
            $discount_type = $getOffer->discount_type;
        }else{
            //check referral product
            $referral_code = (Session::has('referral_code')) ? Session::get('referral_code') : Cookie::get('referral_code');
            if($referral_code) {
                $affiliate = AffiliateAgent::join('affiliate_agent_products', 'affiliate_agents.user_id', 'affiliate_agent_products.agent_id')
                    ->join('affiliate_products', 'affiliate_agent_products.product_id', 'affiliate_products.product_id')
                    ->where('referral_code', $referral_code)
                    ->where('affiliate_agent_products.product_id', $request->product_id)
                    ->where('affiliate_products.status', 'active')
                    ->selectRaw('affiliate_agent_products.agent_id , affiliate_agent_products.agent_price, affiliate_products.office_rate')->first();
            }
            if($affiliate){
                $selling_price = $affiliate->agent_price;
                $affiliate_agent_id = $affiliate->agent_id;
                $affiliate_amount = $affiliate->agent_price - $affiliate->office_rate;
            }else {
                $discount = $product->discount;
                $discount_type = $product->discount_type;
            }
        }
        if($discount){
            $calculate_discount = HelperController::calculate_discount($selling_price, $discount, $discount_type );
            $selling_price = $calculate_discount['price'];
        }
        if($cart_user){
            $data = ['qty' => (isset($request->quantity)) ? $request->quantity : 1, 'price' => $selling_price];
            //check attributes set or not
            if($request->quantity){
                $data = array_merge(['attributes' => json_encode($attributes)], $data);
            }
            $cart_user->update($data);
        }else{
            $data = [
                'user_id' => $user_id,
                'offer_id' => $offer_id,
                'product_id' => $request->product_id,
                'title' => $product->title,
                'slug' => $product->slug,
                'image' => $product->feature_image,
                'qty' => (isset($request->quantity)) ? $request->quantity : 1,
                'price' => $selling_price,
                'attributes' => json_encode($attributes),
                'affiliate_agent_id' => $affiliate_agent_id,
                'affiliate_amount' => $affiliate_amount,
            ];
            $cart_user = Cart::create($data);
        }
		} else {
			
			
			
			
			
        $qty = 0;
		
		
		
        if(Auth::check()){
            $user_id = Auth::id();
        }else{
            if(Cookie::has('user_id') || Session::get('user_id')){
                $user_id = (Cookie::has('user_id') ? Cookie::get('user_id') :  Session::get('user_id'));
            }else{
                $user_id = rand(1000000000, 9999999999);
                Session::put('user_id', $user_id);
                Cookie::queue('user_id', $user_id, time() + (86400));
            }
        }
        $cart_user = Cart::where('product_id', $product->id)->where('user_id', $user_id)->first();
        if($cart_user  && !$request->quantity){
            $qty = $product->minqty;
        }else{
            $qty = ($request->quantity) ? $request->quantity : $product->minqty;
        }
		
		$listprice = Price::where('product_id', $request->product_id)->where('start', '<=', $qty)->where('end', '>=', $qty)->first();
		
		
		//file_put_contents('nprice.txt', $listprice);
		
        $selling_price = $listprice->price+(($product->profit/100)*$listprice->price);
		
		//$selling_price = 0;
		
		
        //check quantity
        if($qty > $product->stock) {
            Toastr::error('Out of stock');
            return redirect()->back();
        }

        $attributes = $request->except(['product_id', '_token', 'offer', 'quantity', 'buyDirect']);
        $variations = ProductVariationDetails::where('product_id', $request->product_id)->whereIn('attributeValue_name', array_values($attributes))->get();
        if(count($variations)>0){
            $variation_price = $selling_price;
            foreach ($variations as $variation){
                if($variation->price > $variation_price){
                    $variation_price = $variation->price;
                }
            }
            $selling_price = $variation_price;
        }
        $discount = $calculate_discount = $offer_id = $affiliate = $affiliate_amount = $affiliate_agent_id = null;
        $getOffer =  Offer::join('offer_products', 'offers.id', 'offer_products.offer_id')->join('products', 'offer_products.product_id','products.id')
            ->where('offers.slug', request()->get('offer'))
            ->where('offer_products.product_id', $product->id)
            ->where('offers.start_date', '<=',  Carbon::now())->where('offers.end_date', '>=', Carbon::now())->where('offers.status', '=', 1)->whereNotIn('offers.offer_type', ['kanamachi', 'quiz'])
            ->selectRaw('offer_products.offer_id, offer_products.offer_discount, offer_products.discount_type')->first();
        if($getOffer){
            $offer_id = $getOffer->offer_id;
            $discount = $getOffer->offer_discount;
            $discount_type = $getOffer->discount_type;
        }else{
            //check referral product
            $referral_code = (Session::has('referral_code')) ? Session::get('referral_code') : Cookie::get('referral_code');
            if($referral_code) {
                $affiliate = AffiliateAgent::join('affiliate_agent_products', 'affiliate_agents.user_id', 'affiliate_agent_products.agent_id')
                    ->join('affiliate_products', 'affiliate_agent_products.product_id', 'affiliate_products.product_id')
                    ->where('referral_code', $referral_code)
                    ->where('affiliate_agent_products.product_id', $request->product_id)
                    ->where('affiliate_products.status', 'active')
                    ->selectRaw('affiliate_agent_products.agent_id , affiliate_agent_products.agent_price, affiliate_products.office_rate')->first();
            }
            if($affiliate){
                $selling_price = $affiliate->agent_price;
                $affiliate_agent_id = $affiliate->agent_id;
                $affiliate_amount = $affiliate->agent_price - $affiliate->office_rate;
            }else {
                $discount = $product->discount;
                $discount_type = $product->discount_type;
            }
        }
        if($discount){
            $calculate_discount = HelperController::calculate_discount($selling_price, $discount, $discount_type );
            $selling_price = $calculate_discount['price'];
        }
        if($cart_user){
            $data = ['qty' => (isset($request->quantity)) ? $request->quantity : 1, 'price' => $selling_price];
            //check attributes set or not
            if($request->quantity){
                $data = array_merge(['attributes' => json_encode($attributes)], $data);
            }
            $cart_user->update($data);
        }else{
            $data = [
                'user_id' => $user_id,
                'offer_id' => $offer_id,
                'product_id' => $request->product_id,
                'title' => $product->title,
                'slug' => $product->slug,
                'image' => $product->feature_image,
                'qty' => (isset($request->quantity)) ? $request->quantity : 1,
                'price' => $selling_price,
                'attributes' => json_encode($attributes),
                'affiliate_agent_id' => $affiliate_agent_id,
                'affiliate_amount' => $affiliate_amount,
            ];
            $cart_user = Cart::create($data);
        }
			
		}
        //cookie set & retrieve;
        Cookie::queue('direct_checkout_product_id', $cart_user->product_id, time() + (86400));
        Session::put('direct_checkout_product_id' , $cart_user->product_id);
        return redirect()->route('checkout', 'process-to-buy');
		
    }
}
