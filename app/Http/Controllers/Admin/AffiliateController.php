<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Models\Affiliate;
use App\Models\AffiliateAgent;
use App\Models\AffiliateAgentProduct;
use App\Models\AffiliateProduct;
use App\Models\Brand;
use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Vendor;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;


class AffiliateController extends Controller
{
    //affiliate configure
    public function affiliateConfigure(){
        $affiliate_configure = Affiliate::first();
        return view('admin.affiliates.affiliateConfigure')->with(compact('affiliate_configure'));
    }
    //affiliate agent list
    public function affiliateAgentList(){
        $agents = AffiliateAgent::with('agentProducts')->join('users', 'affiliate_agents.user_id', 'users.id')->orderBy('affiliate_agents.id', 'desc')->selectraw('users.*, affiliate_agents.status as agent_status, affiliate_agents.id as agent_id')->paginate(25);
        $locations = City::orderBy('name', 'asc')->get();
        return view('admin.affiliates.agents')->with(compact('agents', 'locations'));
    }
    //affiliate product history
    public function affiliateProducts(Request $request){
        $affiliate_products = AffiliateProduct::join('products', 'affiliate_products.product_id', 'products.id');
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
            ->selectRaw('affiliate_products.*, products.title,selling_price,stock,products.slug,feature_image')
            ->paginate($perPage);

        $data['sellers'] = Vendor::orderBy('shop_name', 'asc')->where('status', 'active')->get();
        $data['categories'] = Category::where('parent_id', '=', null)->orderBy('name', 'asc')->where('status', 1)->get();
        $data['brands'] = Brand::orderBy('name', 'asc')->get();
        $data['stockout_products'] = AffiliateProduct::where('quantity', '<=', 0)->count();
        $data['active_products'] = AffiliateProduct::where('status', 'active')->count();
        $data['deactive_products'] = AffiliateProduct::where('status', 'deactive')->count();
        $data['pending_products'] = AffiliateProduct::where('status', 'pending')->count();
        $data['affiliate_configure'] = Affiliate::first();
        return view('admin.affiliates.affiliateProducts')->with($data);
    }
    //get products added for affiliate
    public function getAllProducts (Request $request){
        $products = Product::with('affiliate_product')->where('status', 'active');
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
        if ($request->seller && $request->seller != 'all') {
            $products->where('vendor_id', $request->seller);
        }
        if ($request->category && $request->category != 'all') {
            $products->where('category_id', $request->category);
        }
        $data['allproducts'] = $products->orderBy('title', 'asc')->paginate(15);
        $data['affiliate_configure'] = Affiliate::first();
        return view('admin.affiliates.getProducts')->with($data);
    }
    //added affiliate product
    public function affiliateProductStore(Request $request)
    {
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
            $affiliateProduct = AffiliateProduct::where('product_id', $request->product_id)->first();
            if (!$affiliateProduct) {
                $product = Product::where('id', $request->product_id)->first();
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
                    $affiliateProduct->vendor_id = $product->vendor_id;
                    $affiliateProduct->seller_rate = $request->seller_rate;
                    $affiliateProduct->office_rate = $request->seller_rate;
                    $affiliateProduct->day = $request->day;
                    $affiliateProduct->approved = 1;
                    $affiliateProduct->status = 'active';
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
                    $affiliateProduct = AffiliateProduct::where('product_id', $product_id)->orderBy('id', 'asc')->select('position')->first();
                    if (is_numeric($request->seller_rate[$product_id])) {
                        if (!$affiliateProduct) {
                            $product = Product::where('id', $product_id)->first();
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
                                $affiliateProduct->vendor_id = $product->vendor_id;
                                $affiliateProduct->seller_rate = ($request->seller_rate[$product_id]) ? $request->seller_rate[$product_id] : 0;
                                $affiliateProduct->office_rate = ($request->seller_rate[$product_id]) ? $request->seller_rate[$product_id] : 0;
                                $affiliateProduct->day = ($request->day[$product_id]) ? $request->day[$product_id] : 0;
                                $affiliateProduct->approved = 1;
                                $affiliateProduct->status = 'active';
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
    //agent set product price
    public function setAffiliateProductPrice(Request $request){
        $affiliateProduct = AffiliateProduct::with(['product'])->where('id', $request->id)->first();
        if($affiliateProduct) {
            if($request->office_rate >= $affiliateProduct->seller_rate && $request->office_rate <= $affiliateProduct->product->selling_price)
            {
                $affiliateProduct->office_rate = $request->office_rate;
                $affiliateProduct->save();
                $commission = $affiliateProduct->product->selling_price - $request->office_rate;
                $output = [
                    'status' => true,
                    'commission' => $commission,
                    'msg' => 'Product price update success.'
                ];
            }else{
                $output = [
                    'status' => false,
                    'msg' => 'Product price must be greater than '. Config::get('siteSetting.currency_symble'). $affiliateProduct->seller_rate . ' And less than ' .Config::get('siteSetting.currency_symble') . round($affiliateProduct->product->selling_price)
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
    //admin Product Remove from affiliate
    public function affiliateProductRemove($id)
    {
        $affiliateProduct = AffiliateProduct::find($id);
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
}
