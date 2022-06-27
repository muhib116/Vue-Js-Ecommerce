<?php

namespace App\Http\Controllers;

use App\Models\AffiliateAgent;
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

class AffiliateProductController extends Controller
{
    public function affiliateSoreProducts(Request $request, $referral_code=null, $catslug=null){

        $data['agent'] = AffiliateAgent::where('referral_code', $referral_code)->first();
        if($data['agent']) {
            $products = Product::join('affiliate_products', 'products.id', 'affiliate_products.product_id')->join('affiliate_agent_products', 'affiliate_products.product_id', 'affiliate_agent_products.product_id')
                ->where('agent_id', $data['agent']->user_id)
                ->where('affiliate_products.status', 'active')
                ->where('products.status', 'active');

            //check search keyword
            if ($request->q) {
                $keyword = $request->q;
                $products->where(function ($query) use ($keyword) {
                    $query->orWhere('title', 'like', '%' . $keyword . '%');
                    $query->orWhere('meta_keywords', 'like', '%' . $keyword . '%');
                });
            }

            if ($catslug) {
                $cat = Category::where('slug', $catslug)->first();
                if ($cat) {
                    $products->where(function ($query) use ($cat) {
                        $query->orWhere('category_id', $cat->id);
                        $query->orWhere('subcategory_id', $cat->id);
                        $query->orWhere('childcategory_id', $cat->id);
                    });
                }
            }

            //check ratting
//            if ($request->ratting) {
//                $products = $products->where('avg_ratting', $request->ratting);
//            }

            //check brand
            if ($request->brand) {
                if (!is_array($request->brand)) { // direct url tags
                    $brand = explode(',', $request->brand);
                } else { // filter by ajax
                    $brand = implode(',', $request->brand);
                }
                $products = $products->whereIn('brand_id', $brand);
            }
            $field = 'id';
            $value = 'desc';
            if (isset($request->sortby) && $request->sortby) {
                try {
                    $sort = explode('-', $request->sortby);
                    if ($sort[0] == 'name') {
                        $field = 'title';
                    } elseif ($sort[0] == 'price') {
                        $field = 'selling_price';
                    } elseif ($sort[0] == 'ratting') {
                        $field = 'avg_ratting';
                    } else {
                        $field = 'id';
                    }
                    $value = ($sort[1] == 'a' || $sort[1] == 'l') ? 'asc' : 'desc';
                    $products = $products->orderBy($field, $value);
                } catch (\Exception $exception) {
                }
            }
            $products = $products->orderBy($field, $value);

            //check price keyword
            if ($request->price) {
                $price = explode(',', $request->price);
                $products = $products->whereBetween('selling_price', [$price[0], $price[1]]);
            }

            //check perPage
            $perPage = 24;
            if (isset($request->perPage) && $request->perPage) {
                $perPage = $request->perPage;
            }
            $data['products'] = $products->groupBy('products.id')->selectRaw('products.id,title,selling_price,agent_price,stock, products.slug, feature_image')->paginate($perPage);

            //check ajax request
            if ($request->filter) {
                return view('users.affiliates.store.filter_products')->with($data);
            } else {
                $data['categories'] = Category::join('products', 'categories.id', 'products.category_id')

                    ->where('categories.status', 1)
                    ->groupBy('categories.id')
                    ->selectRaw('categories.id,categories.name, categories.slug')->get();
                //get all category id for brand
                $category_id = array_column($data['categories']->toArray(), 'id');
                $data['brands'] = Brand::whereIn('category_id', $category_id)->select('id', 'name', 'slug')->get();

                return view('users.affiliates.store.affiliateStoreProducts')->with($data);
            }
        }
        return view('404');
    }
}
