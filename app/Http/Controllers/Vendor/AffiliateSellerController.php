<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Models\Affiliate;
use App\Models\AffiliateAgentProduct;
use App\Models\AffiliateProduct;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Vendor;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class AffiliateSellerController extends Controller
{
    public function affiliateProducts(Request $request){
        $seller_id = Auth::guard('vendor')->id();
        $affiliate_products = AffiliateProduct::join('products', 'affiliate_products.product_id', 'products.id')
        ->where('affiliate_products.vendor_id', $seller_id);
        if($request->title){
            $affiliate_products->where('products.title', 'LIKE', '%'. $request->title .'%');
        }
        if($request->status && $request->status != 'all'){
            if($request->status == 'stock-out'){
                $affiliate_products->where('stock', 0);
            }else {
                $affiliate_products->where('affiliate_products.status', $request->status);
            }
        }if($request->brand && $request->brand != 'all'){
            $affiliate_products->where('products.brand_id', $request->brand);
        }if($request->seller && $request->seller != 'all'){
            $affiliate_products->where('products.vendor_id', $request->seller);
        }
        $perPage = 15;
        if($request->show){
            $perPage = $request->show;
        }

        $data['affiliate_products'] = $affiliate_products->orderBy('id', 'desc')
            ->selectRaw('affiliate_products.*, products.title,selling_price,discount,discount_type,stock,products.slug,feature_image')
            ->paginate($perPage);

        $data['categories'] = Category::where('parent_id', '=', null)->orderBy('name', 'asc')->where('status', 1)->get();
        $data['brands'] = Brand::orderBy('name', 'asc')->get();
        $data['stockout_products'] = AffiliateProduct::join('products', 'affiliate_products.product_id', 'products.id')->where('stock', '<=', 0)->where('affiliate_products.vendor_id', $seller_id)->count();
        $data['active_products'] = AffiliateProduct::where('status', 'active')->where('vendor_id', $seller_id)->count();
        $data['deactive_products'] = AffiliateProduct::where('status', 'deactive')->where('vendor_id', $seller_id)->count();
        $data['pending_products'] = AffiliateProduct::where('status', 'pending')->where('vendor_id', $seller_id)->count();
        $data['affiliate_configure'] = Affiliate::first();
        return view('vendors.affiliates.affiliateProducts')->with($data);
    }
    //get products added for affiliate
    public function getAllProducts (Request $request){
        $seller_id = Auth::guard('vendor')->id();
        $products = Product::with('affiliate_product')->where('vendor_id', $seller_id)->where('status', 'active');
        if ($request->product) {
            $keyword = $request->product;
            $products->where(function ($query) use ($keyword) {
                $query->orWhere('title', 'like', '%' . $keyword . '%');
                $query->orWhere('meta_keywords', 'like', '%' . $keyword . '%');
                $query->orWhere('summery', 'like', '%' . $keyword . '%');
            });
        }
        if ($request->brand && $request->brand != 'all') {
            $products->where('brand_id', $request->brand);
        }

        if ($request->category && $request->category != 'all') {
            $products->where('category_id', $request->category);
        }
        $data['allproducts'] = $products->orderBy('title', 'asc')->paginate(15);
        $data['affiliate_configure'] = Affiliate::first();
        return view('vendors.affiliates.getProducts')->with($data);
    }
    //added affiliate product
    public function affiliateProductStore(Request $request)
    {
        $seller_id = Auth::guard('vendor')->id();
        $affiliate_configure = Affiliate::first();
        //single product store
        if(request()->isMethod('get')) {
            //check price integer
            if (!is_numeric($request->seller_rate)) {
                $output = [
                    'status' => false,
                    'msg' => 'Invalid Price.'
                ];
                return response()->json($output);
            }
            $affiliateProduct = AffiliateProduct::where('product_id', $request->product_id)->where('vendor_id', $seller_id)->first();
            if (!$affiliateProduct) {
                $product = Product::where('vendor_id', $seller_id)->where('id', $request->product_id)->first();
                $discount = $product->discount;
                $discount_type = $product->discount_type;
                $selling_price = $product->selling_price;
                if($discount){
                    $calculate_discount = HelperController::calculate_discount($selling_price, $discount, $discount_type );
                    $selling_price = $calculate_discount['price'];
                }
                //minus minimum offer price by admin
                $selling_price = $selling_price - $affiliate_configure->minimum_offer_price;
                if($request->seller_rate <= $selling_price){
                    $affiliateProduct = new AffiliateProduct();
                    $affiliateProduct->product_id = $request->product_id;
                    $affiliateProduct->vendor_id = $seller_id;
                    $affiliateProduct->seller_rate = $request->seller_rate;
                    $affiliateProduct->office_rate = $request->seller_rate;
                    $affiliateProduct->day = $request->day;
                    $affiliateProduct->approved = 1;
                    $affiliateProduct->status = 'pending';
                    $affiliateProduct->save();
                    $output = [
                        'status' => true,
                        'msg' => 'Product added success.'
                    ];
                }else{
                    $output = [
                        'status' => false,
                        'msg' => 'Product price must be less than '. Config::get('siteSetting.currency_symble'). $selling_price
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
            if($request->product_id && count($request->product_id) > 0){
                foreach ($request->product_id as $product_id => $value) {
                    $affiliateProduct = AffiliateProduct::where('product_id', $product_id)->where('vendor_id', $seller_id)->orderBy('id', 'asc')->select('position')->first();
                    if (is_numeric($request->seller_rate[$product_id])) {
                        if (!$affiliateProduct) {
                            $product = Product::where('vendor_id', $seller_id)->where('id', $product_id)->first();
                            $discount = $product->discount;
                            $discount_type = $product->discount_type;
                            $selling_price = $product->selling_price;
                            if($discount){
                                $calculate_discount = HelperController::calculate_discount($selling_price, $discount, $discount_type );
                                $selling_price = $calculate_discount['price'];
                            }
                            //minus minimum offer price by admin
                            $selling_price = $selling_price - $affiliate_configure->minimum_offer_price;
                            if($request->seller_rate[$product_id] <= $selling_price) {
                                $affiliateProduct = new AffiliateProduct();
                                $affiliateProduct->product_id = $product_id;
                                $affiliateProduct->vendor_id = $seller_id;
                                $affiliateProduct->seller_rate = ($request->seller_rate[$product_id]) ? $request->seller_rate[$product_id] : 0;
                                $affiliateProduct->office_rate = ($request->seller_rate[$product_id]) ? $request->seller_rate[$product_id] : 0;
                                $affiliateProduct->day = ($request->day[$product_id]) ? $request->day[$product_id] : 0;
                                $affiliateProduct->approved = 1;
                                $affiliateProduct->status = 'pending';
                                $affiliateProduct->save();
                            }
                        } else {
                            $status = false;
                        }
                    }
                }
                if($status){
                    Toastr::success('Product added success.');
                }else {
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
        $seller_id = Auth::guard('vendor')->id();
        $affiliateProduct = AffiliateProduct::where('vendor_id', $seller_id)->where('id', $id)->first();
        if($affiliateProduct){
            $affiliateProduct->delete();
            //delete agent product
            AffiliateAgentProduct::where('product_id', $affiliateProduct->product_id)->delete();
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
    //set product price
    public function setProductPrice(Request $request){
        if (!is_numeric($request->seller_rate)) {
            $output = [
                'status' => false,
                'msg' => 'Invalid Price.'
            ];
            return response()->json($output);
        }
        $seller_id = Auth::guard('vendor')->id();
        $affiliate_configure = Affiliate::first();
        $affiliateProduct = AffiliateProduct::with(['product'])->where('vendor_id', $seller_id)->where('id', $request->id)->first();
        if($affiliateProduct) {
            $discount = $affiliateProduct->product->discount;
            $discount_type = $affiliateProduct->product->discount_type;
            $selling_price = $affiliateProduct->product->selling_price;
            if($discount){
                $calculate_discount = HelperController::calculate_discount($selling_price, $discount, $discount_type );
                $selling_price = $calculate_discount['price'];
            }
            //minus minimum offer price by admin
            $selling_price = $selling_price - $affiliate_configure->minimum_offer_price;
            if($request->seller_rate <= $selling_price)
            {
                $affiliateProduct->seller_rate = $request->seller_rate;
                $affiliateProduct->office_rate = $request->seller_rate;
                $affiliateProduct->save();
                $output = [
                    'status' => true,
                    'msg' => 'Product price update success.'
                ];
            }else{
                $output = [
                    'status' => false,
                    'msg' => 'Product price must be less than '. Config::get('siteSetting.currency_symble'). $selling_price
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
}
