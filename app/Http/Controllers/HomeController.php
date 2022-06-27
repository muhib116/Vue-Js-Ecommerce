<?php

namespace App\Http\Controllers;
use App\Models\Keyword;
use App\Models\Affiliate;
use App\Models\AffiliateAgent;
use App\Models\AffiliateAgentProduct;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Currency;
use App\Models\HomepageSection;
use App\Models\BusinessSection;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductVariation;
use App\Models\ProductVariationDetails;
use App\Models\SiteSetting;
use App\Models\Slider;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
	
	public function userip(Request $request)
    {
       
        return visitorip();
    }
	

	public function recent(){
		return view('lol');
	}
	
	
	
    //home page function
    public function index(Request $request)
    {
        $data = [];
        //get all homepage section
        $data['sections'] = HomepageSection::where('status', 1)->orderBy('position', 'asc')->paginate(3);
        //check ajax request
        if ($request->ajax()) {
            $view = view('frontend.homepage.homesection', $data)->render();
            return response()->json(['html'=>$view]);
        }
        $data['sliders'] = Slider::where('status', 1)->where('type', 'homepage')->orderBy('position', 'asc')->get();
        return view('frontend.home')->with($data);
    }


 //home page function
    public function b2b(Request $request)
    {
        $data = [];
        //get all homepage section
        $data['sections'] = BusinessSection::where('status', 1)->orderBy('position', 'asc')->paginate(3);
        //check ajax request
        if ($request->ajax()) {
            $view = view('frontend.b2b.homesection', $data)->render();
            return response()->json(['html'=>$view]);
        }
        $data['sliders'] = Slider::where('status', 1)->where('type', 'homepage')->orderBy('position', 'asc')->get();
        return view('frontend.b2b')->with($data);
    }

	//product keywords
	public function keywords(Request $request)
    {
	$keywords = request('searchTerm');
	
	if(strlen($keywords)>0){
		
		
		
		$data = Keyword::where('text', 'like', '%' . $keywords . '%')->get();
		
		
		
		$pdata = array();
		
		foreach($data as $key){
			
			$pkey['id'] = $key->text;
			$pkey['text'] = $key->text;
			$pdata[] = $pkey;
			
		}
		
		
		return json_encode($pdata);
	} else {
		
		$data = Keyword::orderBy('search', 'desc')->take('15')->get();
		
		
		
		$pdata = array();
		
		foreach($data as $key){
			
			$pkey['id'] = $key->text;
			$pkey['text'] = $key->text;
			$pdata[] = $pkey;
			
		}
		
		
		return json_encode($pdata);
		
		
	}
	}
	



    //subcategory products show by category
    public function maincategory(Request $request, $category){
        $catlist = Category::where('slug', $category)->first();
		
		$data['category'] = $catlist;
		
		if(!empty($catlist->keyword)){
			
			$service = Visitor::where('ip', visitorip())->first();
			
			if($service != null && $service->category){
				$catkey = Visitor::find($service->id);
				$olddata = explode(',', $catlist->keyword);				
				$catkey->category = json_encode(array_unique(array_merge(json_decode($catkey->category, true),$olddata), SORT_REGULAR));
				$catkey->save();
			} else {
				$catkey = new Visitor();
				$catkey->ip = visitorip();
				$catkey->category = json_encode(explode(',', $catlist->keyword));
				$catkey->save();			
			}			
		}
        $data['subcategories'] = Category::with(['productsBySubcategory' => function ($query) {
            $query->where('status', '=', 'active'); }])
            ->where('parent_id', $data['category']->id)->paginate(3);

        if($data['category'] && count($data['subcategories'])>0){
            //check ajax request
            if ($request->ajax()) {
                $view = view('frontend.products.productsBySubcategory', $data)->render();
                return response()->json(['html'=>$view]);
            }
            $data['banners'] = Banner::where('page_name', $data['category']->slug)->where('status', 1)->get();
            return view('frontend.products.maincategory')->with($data);
        }
        return view('frontend.pages.category-sitemap');

    }
    //product show by category
    public function category(Request $request)
    {
        $data['products'] = $data['banners'] = $data['product_variations'] = $data['category'] = $data['filterCategories'] = $data['brands'] = [];

        try {
            $products = Product::with('offer_discount.offer:id');

            if ($request->catslug) {
				
				$catlist = Category::where('slug', $request->catslug)->first();
				
                $data['category'] = $catlist;
                if($data['category']) {
					
					
					
					
					if(!empty($catlist->keyword)){
			
			$service = Visitor::where('ip', visitorip())->first();
			
			if($service != null && $service->category){
				$catkey = Visitor::find($service->id);
				$olddata = explode(',', $catlist->keyword);				
				$catkey->category = json_encode(array_unique(array_merge(json_decode($catkey->category, true),$olddata), SORT_REGULAR));
				$catkey->save();
			} else {
				$catkey = new Visitor();
				$catkey->ip = visitorip();
				$catkey->category = json_encode(explode(',', $catlist->keyword));
				$catkey->save();			
			}			
		}
					
					
					
                    $data['filterCategories'] = $data['category']->get_subcategory;
                    //get product by category id
                    $products = $products->where('category_id', $data['category']->id);
                }
            }
            if ($request->subslug) {
				
				$subcat = Category::where('slug', $request->subslug)->first();
				
                $data['category'] = $subcat;
                if($data['category']) {
					
					
					
					
					if(!empty($subcat->keyword)){
			
			$service = Visitor::where('ip', visitorip())->first();
			
			if($service != null && $service->category){
				$catkey = Visitor::find($service->id);
				$olddata = explode(',', $subcat->keyword);				
				$catkey->category = json_encode(array_unique(array_merge(json_decode($catkey->category, true),$olddata), SORT_REGULAR));
				$catkey->save();
			} else {
				$catkey = new Visitor();
				$catkey->ip = visitorip();
				$catkey->category = json_encode(explode(',', $subcat->keyword));
				$catkey->save();			
			}			
		}
					
					
					
					
					
					
					
                    $data['filterCategories'] = $data['category']->get_subchild_category;
                    //get product by sub category id
                    $products = $products->where('subcategory_id', $data['category']->id);
                }
            }
            if ($request->childslug) {
				$child = Category::where('slug', $request->childslug)->first();
                $data['category'] = $child;
                if($data['category']) {
					
					
					
					
					if(!empty($child->keyword)){
			
			$service = Visitor::where('ip', visitorip())->first();
			
			if($service != null && $service->category){
				$catkey = Visitor::find($service->id);
				$olddata = explode(',', $child->keyword);				
				$catkey->category = json_encode(array_unique(array_merge(json_decode($catkey->category, true),$olddata), SORT_REGULAR));
				$catkey->save();
			} else {
				$catkey = new Visitor();
				$catkey->ip = visitorip();
				$catkey->category = json_encode(explode(',', $child->keyword));
				$catkey->save();			
			}			
		}
					
					
					
					
					
                    $data['filterCategories'] = Category::where('subcategory_id', $data['category']->subcategory_id)->get();
                    $products = $products->where('childcategory_id', $data['category']->id);
                }
            }

            if(!$data['category']){
                return view('frontend.pages.category-sitemap');
            }

            //recent views set category id
            $recent_catId = $data['category']->id;
            $recentViews = (Cookie::has('recentViews') ? json_decode(Cookie::get('recentViews')) :  []);
            $recentViews = array_merge([$recent_catId], $recentViews);
            $recentViews = array_values(array_unique($recentViews)); //reindex & remove duplicate value
            Cookie::queue('recentViews', json_encode($recentViews), time() + (86400));

            //check search keyword
            if ($request->q) {
                $products = $products->where('title', 'like', '%' . $request->q . '%')->orWhere('keyword', 'like', '%' . $request->q . '%');
            }

            //check ratting
            if ($request->ratting) {
                $products = $products->where('avg_ratting', $request->ratting);
            }
			
			
			if (isset($request->b2b) && ($request->b2b == 1)) {
                $products = $products->where('is_b2b', 1);
            }
			
			

            //check brand
            if ($request->brand) {
                if (!is_array($request->brand)) { // direct url tags
                    $brand = explode(',', $request->brand);
                } else { // filter by ajax
                    $brand = implode(',', $request->brand);
                }
                $products = $products->whereIn('brand_id', $brand);
            }
            $field = 'id'; $value = 'desc';
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
                }catch (\Exception $exception){}
            }
            $products = $products->orderBy($field, $value);

            //check price keyword
            if ($request->price) {
                $price = explode(',', $request->price);
                $products = $products->whereBetween('selling_price', [$price[0], $price[1]]);
            }

            //check perPage
            $perPage = 16;
            if (isset($request->perPage) && $request->perPage) {
                $perPage = $request->perPage;
            }

            $products = $products->selectRaw('id,title,selling_price,discount, discount_type,slug, feature_image,is_b2b,pricing,profit')->where('status', 'active');
            //get product id for product_variations
            $product_id  = $products->get()->pluck('id')->toArray();

            $data['product_variations'] = ProductVariation::with('allVariationValues')
                ->whereIn('product_id', $product_id)
                ->groupBy('attribute_id')
                ->get();

            //check weather ajax request identify filter parameter
            foreach ($data['product_variations'] as $filterAttr) {
                $filter = strtolower($filterAttr->attribute_name);
                if ($request->$filter) {
                    if (!is_array($request->$filter)) { // direct url tags
                        $tags = explode(',', $request->$filter);
                    } else { // filter by ajax
                        $tags = implode(',', $request->$filter);
                    }
                    //get product id from url filter id (size=1,2)
                    $productsFilter = ProductVariationDetails::whereIn('attributeValue_name', $tags)->groupBy('product_id')->get()->pluck('product_id');
                    $products = $products->whereIn('id', $productsFilter);
                }
            }
            $data['products'] = $products->paginate($perPage);

        }catch (\Exception $e){

        }

        if($request->filter){
            return view('frontend.products.filter_products')->with($data);
        }else{
            if($data['category']){
                $data['banners'] = Banner::where('page_name', $data['category']->slug)->where('status', 1)->get();
                $data['brands'] = Brand::where('category_id', $data['category']->id)->where('status', 1)->get();
            }
            return view('frontend.products.category')->with($data);
        }
    }
    //search products
    public function search(Request $request)
    {
        $search = Product::where('products.status', 'active');
        $keywords = request('q');
       if($request->q) {
            $search->where(function ($query) use ($keywords) {
				$query->orWhere('keyword', 'like', '%' . $keywords . '%');
                $query->orWhere('title', 'like', '%' . $keywords . '%');
            });
        }
        //check brand
        if ($request->brand) {
            if (!is_array($request->brand)) { // direct url tags
                $brand = explode(',', $request->brand);
            } else { // filter by ajax
                $brand = implode(',', $request->brand);
            }
            $search->whereIn('brand_id', $brand);
        }

        if ($request->cat){
            $search->join('categories', 'products.category_id', 'categories.id');
            $search->where('categories.slug', $request->cat);
        }
        $search = $search->first();
        $data['products'] = $data['specifications'] = $data['category'] = $data['filterCategories'] = $data['brands'] = [];
        //dd($get_products);
        if($search) {
            $products = Product::where('products.status', 'active');
            $specifications = ProductAttribute::orderBy('id', 'asc');
            if ($search->category_id) {
                $data['category'] = Category::where('id', $search->category_id)->first();
                $data['filterCategories'] = $data['category']->get_subcategory;
                //get product attribute by category id
                $specifications->where('category_id', $data['category']->id);

            }
            if (!$search->childcategory_id && !$search->subcategory_id && $search->category_id) {
                $specifications->orWhere('category_id', $data['category']->id)
                    ->orWhereIn('category_id', $data['filterCategories']->pluck('id'))
                    ->orWhereIn('category_id', $data['category']->get_subchild_category->pluck('id'));
            }
            if ($search->subcategory_id) {
                $data['category'] = Category::where('id', $search->subcategory_id)->first();
                if($data['category'] != null){
                $data['filterCategories'] = $data['category']->get_subchild_category;
                if(isset($data['category']->id)){
                //get product attribute by sub category id
                $specifications->where('category_id', $data['category']->id);
                }
                }

            }
            if ($search->childcategory_id) {
                $data['category'] = Category::where('id', $search->childcategory_id)->first();
                $data['filterCategories'] = Category::where('subcategory_id', $data['category']->subcategory_id)->get();
                //get product attribute by child category id
                $specifications->where('category_id', $data['category']->id);

            }
            //check search keyword
          if ($request->q) {
                $products->where(function ($query) use ($keywords) {
					$query->orWhere('keyword', 'like', '%' . $keywords . '%');
                    $query->orWhere('title', 'like', '%' . $keywords . '%');
                });
          }


if(strlen($keywords)>0){
			$keytags = Keyword::where('text', $keywords)->first();
			
			if($keytags != null){
				$keytag = Keyword::find($keytags->id);
				$keytag->search += 1;
				$keytag->save();
			} else {
				$keytag = new Keyword();
				$keytag->text = $keywords;
				$keytag->search = 1;
				$keytag->save();
			}
			
			}




            //check ratting
            if ($request->ratting) {
                $products = $products->where('avg_ratting', $request->ratting);
            }



if (isset($request->b2b) && ($request->b2b == 1)) {
                $products = $products->where('is_b2b', 1);
            }

            if ($request->cat){
                $products->join('categories', 'products.category_id', 'categories.id');
                $products->where('categories.slug', $request->cat);
            }

            //check orderby
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
                    $value = (($sort[1] == 'a' || $sort[1] == 'l')) ? 'asc' : 'desc';

                    $products = $products->orderBy($field, $value);
                }catch (\Exception $exception){}
            }

            //check price keyword
            if ($request->price) {
                $price = explode(',', $request->price);
                $products = $products->whereBetween('selling_price', [$price[0], $price[1]]);
            }

            $data['specifications'] = $specifications->get();

            //check weather ajax request identify filter parameter

            foreach ($data['specifications'] as $filterAttr) {
                $filter = strtolower($filterAttr->name);
                if ($request->$filter) {
                    if (!is_array($request->$filter)) { // direct url tags
                        $tags = explode(',', $request->$filter);
                    } else { // filter by ajax
                        $tags = implode(',', $request->$filter);
                    }
                    //get product id from url filter id (size=1,2)
                    $productsFilter = ProductVariationDetails::whereIn('attributeValue_name', $tags)->groupBy('product_id')->get()->pluck('product_id');
                    $products = $products->whereIn('id', $productsFilter);
                }
            }
            //check perPage
            $perPage = 16;
            if (isset($request->perPage) && $request->perPage) {
                $perPage = $request->perPage;
            }
			
			
			
			$keyproduct = $products->count();
			
			
			
			
			if(!empty($keyproduct) && !empty($keywords)){
			
			
			$service = Visitor::where('ip', visitorip())->first();
			
			if($service != null){
				$catkey = Visitor::find($service->id);
				$olddata = explode(',', $keywords);		

				if(!empty($service->product)){
				$catkey->product = json_encode(array_unique(array_merge(json_decode($catkey->product, true),$olddata), SORT_REGULAR));
			} else {
				$catkey->product = json_encode(explode(',', $keywords));
			}
				
				$catkey->save();
			} else {
				$catkey = new Visitor();
				$catkey->ip = visitorip();
				$catkey->product = json_encode(explode(',', $keywords));
				$catkey->save();			
			}			
		}
			
			
			
            $data['products'] = $products->selectRaw('products.id,title,selling_price,discount, discount_type, products.slug, feature_image,is_b2b,pricing,profit' )->paginate($perPage);
            $data['brands'] = Brand::where('category_id', $data['category']->id)->where('status', 1)->get();

        }

        //check ajax request
        if($request->filter){
            return view('frontend.products.filter_products')->with($data);
        }else{
            return view('frontend.products.search_products')->with($data);
        }
    }
    //display product details by product id/slug
    public function b2bproduct_details(Request $request, $slug)
    {
        $data['product_detail'] = Product::with('offer_discount.offer:id','reviews.review_image_video', 'reviews.user:id,name,photo', 'reviews.review_comments.user:id,name,photo', 'user:id,name', 'get_features','get_variations.get_variationDetails')
            ->where('slug', $slug)->where('is_b2b', 1)->where('status', '!=', 'pending')->first();

        if($data['product_detail']) {
			
			
			
			
			
			
			if(!empty($data['product_detail']->keyword)){
			
			$service = Visitor::where('ip', visitorip())->first();
			
			if($service != null){
				$catkey = Visitor::find($service->id);
				$olddata = explode(',', $data['product_detail']->keyword);		
				if(!empty($catkey->product)){
				$catkey->product = json_encode(array_unique(array_merge(json_decode($catkey->product, true),$olddata), SORT_REGULAR));
				} else {
				$catkey->product = json_encode(explode(',', $data['product_detail']->keyword));	
				}
				
				$catkey->save();
			} else {
				$catkey = new Visitor();
				$catkey->ip = visitorip();
				$catkey->product = json_encode(explode(',', $data['product_detail']->keyword));
				$catkey->save();			
			}			
		}
			
			
			
			
			
            //recent views set category id
            $recent_catId = ($data['product_detail']->childcategory_id) ? $data['product_detail']->childcategory_id : $data['product_detail']->subcategory_id;
            $recentViews = (Cookie::has('recentViews') ? json_decode(Cookie::get('recentViews')) :  []);
            $recentViews = array_merge([$recent_catId], $recentViews);
            $recentViews = array_values(array_unique($recentViews)); //reindex & remove duplicate value
            Cookie::queue('recentViews', json_encode($recentViews), time() + (86400));
            //referral
            if($request->ref){
                $affiliate_configure = Affiliate::first();
                Session::put('referral_code', $request->ref);
                Cookie::make('referral_code', $request->ref, time() + 60 * 60 * 2 * $affiliate_configure->cookie_duration);
                //affiliate view count
                $agent = AffiliateAgent::where('referral_code', $request->ref)->first();
                if($agent) {
                    $affiliateProduct = AffiliateAgentProduct::where('agent_id', $agent->user_id)
                        ->where('product_id', $data['product_detail']->id)
                        ->first();
                    if ($affiliateProduct) {
                        $affiliateProduct->increment('views');
                    }
                }
            }
            $data['refund'] = SiteSetting::where('type', 'refund_request_time')
                ->orWhere('type', 'refund_sticker')
                ->orWhere('type', 'allow_refund_request')->get()->toArray();
            //$data['currencies'] = Currency::where('status', 1)->get();

            $data['product_detail']->increment('views'); // news view count
            $related_products = Product::where('status', 'active');
            if($data['product_detail']->childcategory_id != null){
                $category_feild = 'childcategory_id';
                $category_id = $data['product_detail']->childcategory_id;
            }elseif($data['product_detail']->subcategory_id != null){
                $category_feild = 'subcategory_id';
                $category_id = $data['product_detail']->subcategory_id;
            }else{
                $category_feild = 'category_id';
                $category_id = $data['product_detail']->category_id;
            }
            $data['related_products'] = $related_products->where($category_feild, $category_id)->selectRaw('id,title,slug,feature_image,selling_price,discount,discount_type,summery,is_b2b,pricing,profit')->where('is_b2b', 1)->where('id', '!=', $data['product_detail']->id)->take(8)->get();



$views = Product::where('status', 'active')->where('is_b2b', 1);
			$keytext = explode(',', $data['product_detail']->keyword);
			$userviews = Visitor::whereIn('product', $keytext)->inRandomOrder()->get();
			
		
			
			
			foreach($userviews as $recent){
			    
			   $views = $views->where('status', 'active')->whereNotNull('keyword')->where(function ($query) use($recent) {
          foreach(json_decode($recent->product, true) as $pick){
             $query->orWhere('keyword', 'like', '%' . $pick . '%');
			
          }
       });
			}    
			
			
       $data['views'] = $views->selectRaw('id,title,slug,feature_image,selling_price,discount,discount_type,summery,is_b2b,pricing,profit')->where('id', '!=', $data['product_detail']->id)->take(8)->inRandomOrder()->get();
		 
			






            $data['best_sales'] = Product::where('status', 'active')->where('is_b2b', 1)
                ->where('id', '!=', $data['product_detail']->id)
                ->where($category_feild, $category_id)
                ->selectRaw('id,title,selling_price,discount, discount_type, slug, feature_image,is_b2b,pricing,profit' )
                ->take(5)->get();
                
                
                
             
                
             
                
                
                
                
                
            //get offer slug
            return view('frontend.products.product_detailsb2b')->with($data);
        }else{
            return view('404');
        }
    }
	
	
	
	
	
	
	
	
	//display product details by product id/slug
    public function product_details(Request $request, $slug)
    {
        $data['product_detail'] = Product::with('offer_discount.offer:id','reviews.review_image_video', 'reviews.user:id,name,photo', 'reviews.review_comments.user:id,name,photo', 'user:id,name', 'get_features','get_variations.get_variationDetails')
            ->where('slug', $slug)->where('is_b2b', 0)->where('status', '!=', 'pending')->first();

        if($data['product_detail']) {
			
			
			
			
			
			
			if(!empty($data['product_detail']->keyword)){
			
			$service = Visitor::where('ip', visitorip())->first();
			
			if($service != null){
				$catkey = Visitor::find($service->id);
				$olddata = explode(',', $data['product_detail']->keyword);		
				if(!empty($catkey->product)){
				$catkey->product = json_encode(array_unique(array_merge(json_decode($catkey->product, true),$olddata), SORT_REGULAR));
				} else {
				$catkey->product = json_encode(explode(',', $data['product_detail']->keyword));	
				}
				
				$catkey->save();
			} else {
				$catkey = new Visitor();
				$catkey->ip = visitorip();
				$catkey->product = json_encode(explode(',', $data['product_detail']->keyword));
				$catkey->save();			
			}			
		}
			
			
			
			
			
            //recent views set category id
            $recent_catId = ($data['product_detail']->childcategory_id) ? $data['product_detail']->childcategory_id : $data['product_detail']->subcategory_id;
            $recentViews = (Cookie::has('recentViews') ? json_decode(Cookie::get('recentViews')) :  []);
            $recentViews = array_merge([$recent_catId], $recentViews);
            $recentViews = array_values(array_unique($recentViews)); //reindex & remove duplicate value
            Cookie::queue('recentViews', json_encode($recentViews), time() + (86400));
            //referral
            if($request->ref){
                $affiliate_configure = Affiliate::first();
                Session::put('referral_code', $request->ref);
                Cookie::make('referral_code', $request->ref, time() + 60 * 60 * 2 * $affiliate_configure->cookie_duration);
                //affiliate view count
                $agent = AffiliateAgent::where('referral_code', $request->ref)->first();
                if($agent) {
                    $affiliateProduct = AffiliateAgentProduct::where('agent_id', $agent->user_id)
                        ->where('product_id', $data['product_detail']->id)
                        ->first();
                    if ($affiliateProduct) {
                        $affiliateProduct->increment('views');
                    }
                }
            }
            $data['refund'] = SiteSetting::where('type', 'refund_request_time')
                ->orWhere('type', 'refund_sticker')
                ->orWhere('type', 'allow_refund_request')->get()->toArray();
            //$data['currencies'] = Currency::where('status', 1)->get();

            $data['product_detail']->increment('views'); // news view count
            $related_products = Product::where('status', 'active')->where('is_b2b', 0);
            if($data['product_detail']->childcategory_id != null){
                $category_feild = 'childcategory_id';
                $category_id = $data['product_detail']->childcategory_id;
            }elseif($data['product_detail']->subcategory_id != null){
                $category_feild = 'subcategory_id';
                $category_id = $data['product_detail']->subcategory_id;
            }else{
                $category_feild = 'category_id';
                $category_id = $data['product_detail']->category_id;
            }
            $data['related_products'] = $related_products->where($category_feild, $category_id)->selectRaw('id,title,slug,feature_image,selling_price,discount,discount_type,summery')->where('id', '!=', $data['product_detail']->id)->take(8)->get();



$views = Product::where('status', 'active')->where('is_b2b', 0);
			$keytext = explode(',', $data['product_detail']->keyword);
			$userviews = Visitor::whereIn('product', $keytext)->inRandomOrder()->get();
			
		
			
			
			foreach($userviews as $recent){
			    
			   $views = $views->where('status', 'active')->whereNotNull('keyword')->where(function ($query) use($recent) {
          foreach(json_decode($recent->product, true) as $pick){
             $query->orWhere('keyword', 'like', '%' . $pick . '%');
			
          }
       });
			}    
			
			
       $data['views'] = $views->selectRaw('id,title,slug,feature_image,selling_price,discount,discount_type,summery')->where('id', '!=', $data['product_detail']->id)->take(8)->inRandomOrder()->get();
		 
			






            $data['best_sales'] = Product::where('status', 'active')
                ->where('id', '!=', $data['product_detail']->id)
                ->where($category_feild, $category_id)
                ->selectRaw('id,title,selling_price,discount, discount_type, slug, feature_image' )
                ->take(5)->get();
                
                
                
             
                
             
                
                
                
                
                
            //get offer slug
            return view('frontend.products.product_details')->with($data);
        }else{
            return view('404');
        }
    }

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

    public function moreProducts($slug)
    {
        $data['section'] = HomepageSection::where('slug', $slug)->where('status', 1)->first();
        if($data['section']){
            if($slug == 'recommended-for-you'){
                $data['products'] = Product::where('status', 'active')->selectRaw('id,title,selling_price,discount,discount_type, slug, feature_image')->orderBy('views', 'desc')->paginate(16);
            }else {
                $data['products'] = Product::whereIn('id', explode(',', $data['section']->product_id))->orderBy('id', 'desc')->where('status', 'active')->paginate(16);
            }
            return view('frontend.homepage.moreProducts')->with($data);
        }
        return view('frontend.404');
    }

    public function quickview(Request $request, $slug){
        $data['product'] = Product::with('user:id,name','get_category:id,name','get_features')->where('slug', $slug)->first();
        $data['type'] = ($request->type) ? $request->type : 'on';
        $data['offer'] = $request->offer ? $request->offer : null;
        if($data['product']) {
            return view('frontend.products.quickview-iframe')->with($data);
        }else{
            return 'Product not found.';
        }
    }
}
