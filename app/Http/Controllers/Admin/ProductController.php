<?php

namespace App\Http\Controllers\Admin;
use App\Models\Keyword;
use App\Models\CartButton;
use App\Models\SiteSetting;
use App\Vendor;
use App\Models\Brand;
use App\Models\Price;
use App\Models\Country;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomepageSection;
use App\Models\PredefinedFeature;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductFeature;
use App\Models\ProductImage;
use App\Models\ProductVariation;
use App\Models\ProductVariationDetails;
use App\Models\ProductVideo;
use App\Models\State;
use App\Traits\CreateSlug;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Mockery\Exception;

class ProductController extends Controller
{
    use CreateSlug;
    // get product lists function
	
	
	
	public function b2bupload(){
			
        $data['vendors'] = Vendor::orderBy('shop_name', 'asc')->where('status', 'active')->get();
        $data['regions'] = State::orderBy('name', 'asc')->get();
        $data['brands'] = Brand::orderBy('name', 'asc')->where('status', 1)->get();
        $data['categories'] = Category::where('parent_id', '=', null)->orderBy('name', 'asc')->where('status', 1)->get();
        $data['cartButtons'] = CartButton::orderBy('position', 'asc')->get();
        $data['attributes'] = ProductAttribute::where('category_id', 'all')->get();
        $data['features'] = PredefinedFeature::where('category_id', 'all')->get();
        return view('admin.product.b2b')->with($data);
	}
	
	
	public function b2bstore(Request $request){
		
		
		
		
	
		 $request->validate([
            'title' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
            'feature_image' => 'image|mimes:jpeg,png,jpg,gif'
        ]);
        //auto select purpose
        Session::put('category_id', $request->category);
        Session::put('subcategory_id', $request->subcategory);
        Session::put('childcategory_id', ($request->childcategory) ? $request->childcategory : 0);
        Session::put('ship_region_id', $request->ship_region_id);
        Session::put('shipping_cost', $request->shipping_cost);
        Session::put('other_region_cost', $request->other_region_cost);
        Session::put('shipping_time', $request->shipping_time);
        Session::put('brand', ($request->brand ? $request->brand : null));
        Session::put('vendor_id', ($request->vendor_id ? $request->vendor_id : null));
        Session::put('product_type', ($request->product_type ? $request->product_type : null));

        // Insert product
        $data = new Product();
        $data->vendor_id = ($request->vendor_id ? $request->vendor_id : null);
        $data->title = $request->title;
        $data->slug = strtolower($this->createSlug('products', ($request->slug) ? $request->slug : $request->title));
        $data->sku = $request->sku;
        $data->summery = $request->summery;
        $data->description = $request->description;
        $data->category_id = $request->category;
        $data->subcategory_id = $request->subcategory;
        $data->childcategory_id = ($request->childcategory) ? $request->childcategory : null;
        $data->brand_id = ($request->brand ? $request->brand : null);
        $data->purchase_price = 0;
        $data->selling_price = 0;
		$data->profit = $request->profit;
        $data->discount = ($request->discount) ? $request->discount : null;
        $data->discount_type = ($request->discount_type) ? $request->discount_type : null;
        $data->stock = ($request->stock) ? $request->stock : 0;
        $data->total_stock = ($request->stock) ? $request->stock : 0;
        $data->manufacture_date = $request->manufacture_date;
        $data->expired_date = $request->expired_date;
        $data->video = ($request->product_video) ? 1 : null;
        $data->weight = $request->weight;
        $data->length = $request->length;
        $data->width = $request->width;
        $data->height = $request->height;
		$data->minqty = $request->minqty;
        if($request->shipping_method){
            $data->shipping_method = ($request->shipping_method) ? $request->shipping_method : null;
            $data->order_qty = ($request->order_qty) ? $request->order_qty : null;
            $data->free_shipping = ($request->free_shipping) ? 1 : null;
            $data->shipping_cost = ($request->shipping_cost) ? $request->shipping_cost : null;
            $data->discount_shipping_cost = ($request->discount_shipping_cost) ? $request->discount_shipping_cost : null;
            $data->ship_region_id = ($request->ship_region_id) ? $request->ship_region_id : null;

            $data->other_region_cost = ($request->other_region_cost) ? $request->other_region_cost : null;
            $data->shipping_time = ($request->shipping_time) ? $request->shipping_time : null;
        }
        $data->cash_on_delivery = ($request->cash_on_delivery) ? $request->cash_on_delivery : null;
        
        $data->status = ($request->status ? 'active' : 'deactive');
        $data->created_by = Auth::guard('admin')->id();

        //if feature image set
        if ($request->hasFile('feature_image')) {
            $image = $request->file('feature_image');
            $new_image_name = $this->uniqueImagePath('products', 'feature_image', $request->title.'.'.$image->getClientOriginalExtension());
            $image_path = public_path('upload/images/product/thumb/' . $new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(200, 200);
            $image_resize->save($image_path);
            $image->move(public_path('upload/images/product'), $new_image_name);
            $data->feature_image = $new_image_name;
        }

        //if meta image set
        if ($request->hasFile('meta_image')) {
            $image = $request->file('meta_image');
            $new_image_name = $this->uniqueImagePath('products', 'meta_image', $request->title.'.'.$image->getClientOriginalExtension());
            $image->move(public_path('upload/images/product/meta_image'), $new_image_name);
            $data->meta_image = $new_image_name;
        }

        $data->product_type = ($request->product_type ? $request->product_type : 'add-to-cart');

        $data->availability_date = $request->availability_date ?? null;
        $data->pre_order_fee = $request->pre_order_fee ?? null;
        $data->file_link = $request->file_link ?? null;
        //if file set
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $new_file_name = $this->uniqueImagePath('products', 'file', $request->title.'.'.$image->getClientOriginalExtension());
            $file->move(public_path('upload/file/product'), $new_file_name);
            $data->file = $new_file_name;
        }
        
        $tags = $request->keywords;
        if(!empty($tags)){
            
            $newtags = implode(', ', $tags);
            
		$data->keyword = str_replace(',,', ',', $newtags);
		
			foreach($tags as $tag){
				if(strlen($tag)>0){
			$keytags = Keyword::where('text', $tag)->first();
			
			if($keytags != null){
				$keytag = Keyword::find($keytags->id);
				$keytag->product += 1;
				$keytag->save();
			} else {
				$keytag = new Keyword();
				$keytag->text = $tag;
				$keytag->product = 1;
				$keytag->save();
			}
				}
			}
		}
        
        
		
		$start = $request->start;
		$end = $request->end;
		$amt = $request->amt;
		$min = min($amt);
		$max = max($amt);
		$data->is_b2b = 1;
		$data->pricing = ''.$min.'-'.$max.'';
        $store = $data->save();
		
		
		

        if($store) {
			
			
			
			foreach($start as $key => $startp){
			
			$price = new Price();
			    $price->product_id = $data->id;
				$price->start = $startp;
				$price->end = $end[$key];
				$price->price = $amt[$key];
				$price->save();
			
		}
			
			
			
			
			
			
			
            $total_qty = 0;
            //insert variation
            if ($request->attribute) {
                foreach ($request->attribute as $attribute_id => $attr_value) {
                    //insert product feature name in feature table
                    $feature = new ProductVariation();
                    $feature->product_id = $data->id;
                    $feature->attribute_id = $attribute_id;
                    $feature->attribute_name = $attr_value;
                    $feature->in_display = 1;
                    $feature->save();
                    if(isset($request->attributeValue) && array_key_exists($attribute_id, $request->attributeValue)) {
                        for ($i = 0; $i < count($request->attributeValue[$attribute_id]); $i++) {
                            $quantity = 0;
                            //check weather attribute value set
                            if (array_key_exists($i, $request->attributeValue[$attribute_id]) && $request->attributeValue[$attribute_id][$i]) {
                                //insert feature attribute details in ProductFeatureDetail table
                                $quantity = (isset($request->qty[$attribute_id]) && array_key_exists($i, $request->qty[$attribute_id]) ? $request->qty[$attribute_id][$i] : 0);
                                $feature_details = new ProductVariationDetails();
                                $feature_details->product_id = $data->id;
                                $feature_details->attribute_id = $attribute_id;
                                $feature_details->variation_id = $feature->id;
                                $feature_details->attributeValue_name = $request->attributeValue[$attribute_id][$i];
                                $feature_details->sku = (isset($request->sku[$attribute_id]) && is_array($request->sku[$attribute_id]) && array_key_exists($i, $request->sku[$attribute_id]) ? $request->sku[$attribute_id][$i] : 0);
                                $feature_details->quantity = $quantity;
                                $feature_details->price = (isset($request->price[$attribute_id]) && is_array($request->price[$attribute_id]) && array_key_exists($i, $request->price[$attribute_id]) ? $request->price[$attribute_id][$i] : 0);
                                $feature_details->color = (isset($request->color[$attribute_id]) && is_array($request->color[$attribute_id]) && array_key_exists($i, $request->color[$attribute_id]) ? $request->color[$attribute_id][$i] : null);

                                //if attribute variant image set
                                if (isset($request->image[$attribute_id]) && array_key_exists($i, $request->image[$attribute_id])) {
                                    $image = $request->image[$attribute_id][$i];
                                    $new_variantimage_name = $this->uniqueImagePath('product_variation_details', 'image', $request->title.'.'.$image->getClientOriginalExtension());

                                    $image_path = public_path('upload/images/product/varriant-product/thumb/' . $new_variantimage_name);
                                    $image_resize = Image::make($image);
                                    $image_resize->resize(250, 200);
                                    $image_resize->save($image_path);

                                    $image->move(public_path('upload/images/product/varriant-product'), $new_variantimage_name);
                                    $feature_details->image = $new_variantimage_name;
                                }
                                $feature_details->save();
                            }
                            //count total stock quantity
                            $total_qty += $quantity;
                        }
                    }
                }
            }
            //insert additional Feature data
            if ($request->features) {
                try {
                    foreach ($request->features as $feature_id => $feature_name) {
                        if ($request->featureValue[$feature_id]) {
                            $extraFeature = new ProductFeature();
                            $extraFeature->product_id = $data->id;
                            $extraFeature->feature_id = $feature_id;
                            $extraFeature->name = $feature_name;
                            $extraFeature->value = $request->featureValue[$feature_id];
                            $extraFeature->save();
                        }
                    }
                } catch (Exception $exception) {

                }
            }
            // gallery Image upload
            if ($request->hasFile('gallery_image')) {
                $gallery_image = $request->file('gallery_image');
                foreach ($gallery_image as $image) {
                    $new_image_name = $this->uniqueImagePath('product_images', 'image_path', $request->title.'.'.$image->getClientOriginalExtension());
                    $image_path = public_path('upload/images/product/gallery/thumb/' . $new_image_name);
                    $image_resize = Image::make($image);
                    $image_resize->resize(200, 200);
                    $image_resize->save($image_path);
                    $image->move(public_path('upload/images/product/gallery'), $new_image_name);

                    ProductImage::create([
                        'product_id' => $data->id,
                        'image_path' => $new_image_name
                    ]);
                }
            }
            //video upload
            if (isset($request->video_provider)) {
                for ($i = 0; $i < count($request->video_provider); $i++) {
                    ProductVideo::create(['product_id' => $data->id,
                        'provider' => $request->video_provider[$i],
                        'link' => $request->video_link[$i]
                    ]);
                }
            }
            //update total quantity
            if ($total_qty != 0){
                $productStock = Product::find($data->id);
                $productStock->stock = ($total_qty != 0) ? $total_qty : $request->stock;
                $productStock->total_stock = ($total_qty != 0) ? $total_qty : $request->stock;
                $productStock->save();
            }

            Toastr::success('Product Upload Successful.');
        }else{
            Toastr::error('Product Cannot Upload.!');
        }
        return back();
		 
		
		
		
	}
	
	
	
	
	
	
	
	
	
	 public function b2b(Request $request, $status='')
    {
		
		
		
	
		
		
		
		
		
		
		
		
		
        $products = Product::where('is_b2b', 1)->orderBy('id', 'desc');
        if($status){
            if($status == 'stock-out'){
                $products->where('stock', '<=', 0);
            }
            elseif($status == 'image-missing'){
                $products->where('feature_image', null);
            }elseif($status == 'seo-missing'){
                $products->where(function ($query){
                    $query->orWhere('meta_title', null)->orWhere('meta_keywords', null)->orWhere('meta_description', null);
                });
            }
            else{
                $products->where('status', $status);
            }
        }

        if(!$status && $request->status && $request->status != 'all'){
            $products->where('status', $request->status);
        }if($request->brand && $request->brand != 'all'){
        $products->where('brand_id', $request->brand);
    }if($request->seller && $request->seller != 'all'){
        $products->where('vendor_id', $request->seller);
    }
        if($request->title){
            $products->where('title', 'LIKE', '%'. $request->title .'%');
        }
        $data['products'] = $products->paginate(15);

        $data['all_products'] = Product::where('is_b2b', 1)->count();
        $data['stockout_products'] = Product::where('is_b2b', 1)->where('stock', '<=', 0)->count();
        $data['active_products'] = Product::where('is_b2b', 1)->where('status', 'active')->count();
        $data['deactive_products'] = Product::where('is_b2b', 1)->where('status', 'deactive')->count();
        $data['pending_products'] = Product::where('is_b2b', 1)->where('status', 'pending')->count();
        $data['image_missing'] = Product::where('is_b2b', 1)->where('feature_image', null)->count();
        $data['seo_missing'] = Product::where('is_b2b', 1)->where(function ($query) {
    $query->where('meta_title', null)
          ->orWhere('meta_keywords', null)->orWhere('meta_description', null);
})->count();
        $data['brands'] = Brand::orderBy('position', 'asc')->where('status', 1)->get();
        $data['vendors'] = Vendor::orderBy('shop_name', 'asc')->where('status', 'active')->get();

        return view('admin.product.product-b2b')->with($data);
    }
	
	
	
	
	
	
	
	
	
	
	
    public function index(Request $request, $status='')
    {
		
	
       $products = Product::where('is_b2b', 0)->orderBy('id', 'desc');
        if($status){
            if($status == 'stock-out'){
                $products->where('stock', '<=', 0);
            }
            elseif($status == 'image-missing'){
                $products->where('feature_image', null);
            }elseif($status == 'seo-missing'){
                $products->where(function ($query){
                    $query->orWhere('meta_title', null)->orWhere('meta_keywords', null)->orWhere('meta_description', null);
                });
            }
            else{
             $products->where('status', $status);
            }
        }

        if(!$status && $request->status && $request->status != 'all'){
            $products->where('status', $request->status);
        }if($request->brand && $request->brand != 'all'){
        $products->where('brand_id', $request->brand);
    }if($request->seller && $request->seller != 'all'){
        $products->where('vendor_id', $request->seller);
    }
        if($request->title){
            $products->where('title', 'LIKE', '%'. $request->title .'%');
        }
        $data['products'] = $products->paginate(15);

        $all_products = Product::where('is_b2b', 0)->get();
        $data['all_products'] = 1;
        $stockout_products = Product::where('is_b2b', 0)->where('stock', '<=', 0)->get();
        $data['stockout_products'] = 1;
        $active_products = Product::where('is_b2b', 0)->where('status', 'active')->get();
        $data['active_products'] = 1;
        $deactive_products = Product::where('is_b2b', 0)->where('status', 'deactive')->get();
        $data['deactive_products'] = 1;
        $pending_products = Product::where('is_b2b', 0)->where('status', 'pending')->get();
        $data['pending_products'] = 1;
        $image_missing = Product::where('is_b2b', 0)->where('feature_image', null)->get();
        $data['image_missing'] = 1;
        $seo_missing = Product::where('is_b2b', 0)->where(function ($query) {
    $query->where('meta_title', null)
          ->orWhere('meta_keywords', null)->orWhere('meta_description', null);
})->get();
        $data['seo_missing'] = 1;
        $data['brands'] = Brand::orderBy('position', 'asc')->where('status', 1)->get();
        $data['vendors'] = Vendor::orderBy('shop_name', 'asc')->where('status', 'active')->get();
    $data['status'] = $status;
        return view('admin.product.product-lists')->with($data);
    }

    // Add new product
    public function upload()
    {
	
		
		
        $data['vendors'] = Vendor::orderBy('shop_name', 'asc')->where('status', 'active')->get();
        $data['regions'] = State::orderBy('name', 'asc')->get();
        $data['brands'] = Brand::orderBy('name', 'asc')->where('status', 1)->get();
        $data['categories'] = Category::where('parent_id', '=', null)->orderBy('name', 'asc')->where('status', 1)->get();
        $data['cartButtons'] = CartButton::orderBy('position', 'asc')->get();
        $data['attributes'] = ProductAttribute::where('category_id', 'all')->get();
        $data['features'] = PredefinedFeature::where('category_id', 'all')->get();
        return view('admin.product.product')->with($data);
    }

    //store new product
    public function store(Request $request)
    {
		
		
		
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
            'selling_price' => 'required',
            'feature_image' => 'image|mimes:jpeg,png,jpg,gif'
        ]);
        //auto select purpose
        Session::put('category_id', $request->category);
        Session::put('subcategory_id', $request->subcategory);
        Session::put('childcategory_id', ($request->childcategory) ? $request->childcategory : 0);
        Session::put('ship_region_id', $request->ship_region_id);
        Session::put('shipping_cost', $request->shipping_cost);
        Session::put('other_region_cost', $request->other_region_cost);
        Session::put('shipping_time', $request->shipping_time);
        Session::put('brand', ($request->brand ? $request->brand : null));
        Session::put('vendor_id', ($request->vendor_id ? $request->vendor_id : null));
        Session::put('product_type', ($request->product_type ? $request->product_type : null));

        // Insert product
        $data = new Product();
        $data->vendor_id = ($request->vendor_id ? $request->vendor_id : null);
        $data->title = $request->title;
        $data->slug = strtolower($this->createSlug('products', ($request->slug) ? $request->slug : $request->title));
        $data->sku = $request->sku;
        $data->summery = $request->summery;
        $data->description = $request->description;
        $data->category_id = $request->category;
        $data->subcategory_id = $request->subcategory;
        $data->childcategory_id = ($request->childcategory) ? $request->childcategory : null;
        $data->brand_id = ($request->brand ? $request->brand : null);
        $data->purchase_price = $request->purchase_price;
        $data->selling_price = $request->selling_price;
        $data->discount = ($request->discount) ? $request->discount : null;
        $data->discount_type = ($request->discount_type) ? $request->discount_type : null;
        $data->stock = ($request->stock) ? $request->stock : 0;
        $data->total_stock = ($request->stock) ? $request->stock : 0;
        $data->manufacture_date = $request->manufacture_date;
        $data->expired_date = $request->expired_date;
        $data->video = ($request->product_video) ? 1 : null;
        $data->weight = $request->weight;
        $data->length = $request->length;
        $data->width = $request->width;
        $data->height = $request->height;
        if($request->shipping_method){
            $data->shipping_method = ($request->shipping_method) ? $request->shipping_method : null;
            $data->order_qty = ($request->order_qty) ? $request->order_qty : null;
            $data->free_shipping = ($request->free_shipping) ? 1 : null;
            $data->shipping_cost = ($request->shipping_cost) ? $request->shipping_cost : null;
            $data->discount_shipping_cost = ($request->discount_shipping_cost) ? $request->discount_shipping_cost : null;
            $data->ship_region_id = ($request->ship_region_id) ? $request->ship_region_id : null;

            $data->other_region_cost = ($request->other_region_cost) ? $request->other_region_cost : null;
            $data->shipping_time = ($request->shipping_time) ? $request->shipping_time : null;
        }
        $data->cash_on_delivery = ($request->cash_on_delivery) ? $request->cash_on_delivery : null;
        
        $data->status = ($request->status ? 'active' : 'deactive');
        $data->created_by = Auth::guard('admin')->id();

        //if feature image set
        if ($request->hasFile('feature_image')) {
            $image = $request->file('feature_image');
            $new_image_name = $this->uniqueImagePath('products', 'feature_image', $request->title.'.'.$image->getClientOriginalExtension());
            $image_path = public_path('upload/images/product/thumb/' . $new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(200, 200);
            $image_resize->save($image_path);
            $image->move(public_path('upload/images/product'), $new_image_name);
            $data->feature_image = $new_image_name;
        }

        //if meta image set
        if ($request->hasFile('meta_image')) {
            $image = $request->file('meta_image');
            $new_image_name = $this->uniqueImagePath('products', 'meta_image', $request->title.'.'.$image->getClientOriginalExtension());
            $image->move(public_path('upload/images/product/meta_image'), $new_image_name);
            $data->meta_image = $new_image_name;
        }

        $data->product_type = ($request->product_type ? $request->product_type : 'add-to-cart');

        $data->availability_date = $request->availability_date ?? null;
        $data->pre_order_fee = $request->pre_order_fee ?? null;
        $data->file_link = $request->file_link ?? null;
        //if file set
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $new_file_name = $this->uniqueImagePath('products', 'file', $request->title.'.'.$image->getClientOriginalExtension());
            $file->move(public_path('upload/file/product'), $new_file_name);
            $data->file = $new_file_name;
        }
        
        $tags = $request->keywords;
        if(!empty($tags)){
            
            $newtags = implode(', ', $tags);
            
		$data->keyword = str_replace(',,', ',', $newtags);
		
			foreach($tags as $tag){
				if(strlen($tag)>0){
			$keytags = Keyword::where('text', $tag)->first();
			
			if($keytags != null){
				$keytag = Keyword::find($keytags->id);
				$keytag->product += 1;
				$keytag->save();
			} else {
				$keytag = new Keyword();
				$keytag->text = $tag;
				$keytag->product = 1;
				$keytag->save();
			}
				}
			}
		}
        
        
		
		
		
		
        $store = $data->save();

        if($store) {
            $total_qty = 0;
            //insert variation
            if ($request->attribute) {
                foreach ($request->attribute as $attribute_id => $attr_value) {
                    //insert product feature name in feature table
                    $feature = new ProductVariation();
                    $feature->product_id = $data->id;
                    $feature->attribute_id = $attribute_id;
                    $feature->attribute_name = $attr_value;
                    $feature->in_display = 1;
                    $feature->save();
                    if(isset($request->attributeValue) && array_key_exists($attribute_id, $request->attributeValue)) {
                        for ($i = 0; $i < count($request->attributeValue[$attribute_id]); $i++) {
                            $quantity = 0;
                            //check weather attribute value set
                            if (array_key_exists($i, $request->attributeValue[$attribute_id]) && $request->attributeValue[$attribute_id][$i]) {
                                //insert feature attribute details in ProductFeatureDetail table
                                $quantity = (isset($request->qty[$attribute_id]) && array_key_exists($i, $request->qty[$attribute_id]) ? $request->qty[$attribute_id][$i] : 0);
                                $feature_details = new ProductVariationDetails();
                                $feature_details->product_id = $data->id;
                                $feature_details->attribute_id = $attribute_id;
                                $feature_details->variation_id = $feature->id;
                                $feature_details->attributeValue_name = $request->attributeValue[$attribute_id][$i];
                                $feature_details->sku = (isset($request->sku[$attribute_id]) && is_array($request->sku[$attribute_id]) && array_key_exists($i, $request->sku[$attribute_id]) ? $request->sku[$attribute_id][$i] : 0);
                                $feature_details->quantity = $quantity;
                                $feature_details->price = (isset($request->price[$attribute_id]) && is_array($request->price[$attribute_id]) && array_key_exists($i, $request->price[$attribute_id]) ? $request->price[$attribute_id][$i] : 0);
                                $feature_details->color = (isset($request->color[$attribute_id]) && is_array($request->color[$attribute_id]) && array_key_exists($i, $request->color[$attribute_id]) ? $request->color[$attribute_id][$i] : null);

                                //if attribute variant image set
                                if (isset($request->image[$attribute_id]) && array_key_exists($i, $request->image[$attribute_id])) {
                                    $image = $request->image[$attribute_id][$i];
                                    $new_variantimage_name = $this->uniqueImagePath('product_variation_details', 'image', $request->title.'.'.$image->getClientOriginalExtension());

                                    $image_path = public_path('upload/images/product/varriant-product/thumb/' . $new_variantimage_name);
                                    $image_resize = Image::make($image);
                                    $image_resize->resize(250, 200);
                                    $image_resize->save($image_path);

                                    $image->move(public_path('upload/images/product/varriant-product'), $new_variantimage_name);
                                    $feature_details->image = $new_variantimage_name;
                                }
                                $feature_details->save();
                            }
                            //count total stock quantity
                            $total_qty += $quantity;
                        }
                    }
                }
            }
            //insert additional Feature data
            if ($request->features) {
                try {
                    foreach ($request->features as $feature_id => $feature_name) {
                        if ($request->featureValue[$feature_id]) {
                            $extraFeature = new ProductFeature();
                            $extraFeature->product_id = $data->id;
                            $extraFeature->feature_id = $feature_id;
                            $extraFeature->name = $feature_name;
                            $extraFeature->value = $request->featureValue[$feature_id];
                            $extraFeature->save();
                        }
                    }
                } catch (Exception $exception) {

                }
            }
            // gallery Image upload
            if ($request->hasFile('gallery_image')) {
                $gallery_image = $request->file('gallery_image');
                foreach ($gallery_image as $image) {
                    $new_image_name = $this->uniqueImagePath('product_images', 'image_path', $request->title.'.'.$image->getClientOriginalExtension());
                    $image_path = public_path('upload/images/product/gallery/thumb/' . $new_image_name);
                    $image_resize = Image::make($image);
                    $image_resize->resize(200, 200);
                    $image_resize->save($image_path);
                    $image->move(public_path('upload/images/product/gallery'), $new_image_name);

                    ProductImage::create([
                        'product_id' => $data->id,
                        'image_path' => $new_image_name
                    ]);
                }
            }
            //video upload
            if (isset($request->video_provider)) {
                for ($i = 0; $i < count($request->video_provider); $i++) {
                    ProductVideo::create(['product_id' => $data->id,
                        'provider' => $request->video_provider[$i],
                        'link' => $request->video_link[$i]
                    ]);
                }
            }
            //update total quantity
            if ($total_qty != 0){
                $productStock = Product::find($data->id);
                $productStock->stock = ($total_qty != 0) ? $total_qty : $request->stock;
                $productStock->total_stock = ($total_qty != 0) ? $total_qty : $request->stock;
                $productStock->save();
            }

            Toastr::success('Product Upload Successful.');
        }else{
            Toastr::error('Product Cannot Upload.!');
        }
        return back();
    }


   public function review($slug)
    {
	$product = Product::where('slug', $slug)->first();
return view('admin.product.review', compact('product'));
	}


public function approve(Request $request, $product_id)
    {
	$data = Product::find($product_id);
        $data->profit = $request->profit;
		$data->status = 'active';
       $data->save();
	   
	   Toastr::success('Product Approved Successfully.');
        return redirect()->route('admin.b2b.list');
	}
	
	
	
    //edit product
    public function edit($slug)
    {
		
		
		
        $data['product'] = Product::with('get_variations.get_variationDetails','videos')->where('slug', $slug)->first();
        $data['vendors'] = Vendor::orderBy('id', 'asc')->where('status', 'active')->get();
        $data['regions'] = State::orderBy('name', 'asc')->get();
        $data['brands'] = Brand::orderBy('name', 'asc')->where('status', 1)->get();
        $data['cartButtons'] = CartButton::orderBy('position', 'asc')->get();
        // categroy id make array for query
        $category_id = [];
        if($data['product']->category_id) {
            $category_id[] = $data['product']->category_id;
        }if($data['product']->subcategory_id) {
        $category_id[] = $data['product']->subcategory_id;
    }if($data['product']->childcategory_id) {
        $category_id[] = $data['product']->childcategory_id;
    }
        //get  attributes
        $data['attributes'] = ProductAttribute::whereIn('category_id', $category_id)
            ->orWhere('category_id', 'all')
            ->doesntHave('variations')->get();

        $product_id = $data['product']->id;
        $data['features'] = PredefinedFeature::with(['featureValue' => function ($query) use ($product_id) {
            $query->where('product_id', $product_id);
        }])->whereIn('category_id', $category_id)
            ->orWhere('category_id', 'all')->get();
        $data['categories'] = Category::where('parent_id', '=', null)->where('status', 1)->get();
        $data['subcategories'] = Category::where('parent_id', '=', $data['product']->category_id)->where('status', 1)->get();
        $data['childcategories'] = Category::where('subcategory_id', '=', $data['product']->subcategory_id)->where('status', 1)->get();
        return view('admin.product.product-edit')->with($data);
    }




  public function b2bedit($slug)
    {
		
		
		
		
        $data['product'] = Product::with('get_variations.get_variationDetails','videos')->where('slug', $slug)->first();
		$data['prices'] = Price::where('product_id', $data['product']->id)->get();
        $data['vendors'] = Vendor::orderBy('id', 'asc')->where('status', 'active')->get();
        $data['regions'] = State::orderBy('name', 'asc')->get();
        $data['brands'] = Brand::orderBy('name', 'asc')->where('status', 1)->get();
        $data['cartButtons'] = CartButton::orderBy('position', 'asc')->get();
        // categroy id make array for query
        $category_id = [];
        if($data['product']->category_id) {
            $category_id[] = $data['product']->category_id;
        }if($data['product']->subcategory_id) {
        $category_id[] = $data['product']->subcategory_id;
    }if($data['product']->childcategory_id) {
        $category_id[] = $data['product']->childcategory_id;
    }
        //get  attributes
        $data['attributes'] = ProductAttribute::whereIn('category_id', $category_id)
            ->orWhere('category_id', 'all')
            ->doesntHave('variations')->get();

        $product_id = $data['product']->id;
        $data['features'] = PredefinedFeature::with(['featureValue' => function ($query) use ($product_id) {
            $query->where('product_id', $product_id);
        }])->whereIn('category_id', $category_id)
            ->orWhere('category_id', 'all')->get();
        $data['categories'] = Category::where('parent_id', '=', null)->where('status', 1)->get();
        $data['subcategories'] = Category::where('parent_id', '=', $data['product']->category_id)->where('status', 1)->get();
        $data['childcategories'] = Category::where('subcategory_id', '=', $data['product']->subcategory_id)->where('status', 1)->get();
        return view('admin.product.b2bproduct-edit')->with($data);
    }








    //update product
    public function update(Request $request, $product_id)
    {
		
	
		
        $admin_id = Auth::guard('admin')->id();
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
            'selling_price' => 'required',
        ]);
        // Insert product
        $data = Product::find($product_id);
        $data->vendor_id = ($request->vendor_id ? $request->vendor_id : null);
        $data->title = $request->title;
        $data->sku = $request->sku;
        $data->summery = $request->summery;
        $data->description = $request->description;
        $data->category_id = $request->category;
        $data->subcategory_id = $request->subcategory;
        $data->childcategory_id = ($request->childcategory) ? $request->childcategory : null;
        $data->brand_id = ($request->brand ? $request->brand : null);
        $data->purchase_price = $request->purchase_price;
        $data->selling_price = $request->selling_price;
        $data->discount = ($request->discount) ? $request->discount : null;
        $data->discount_type = ($request->discount_type) ? $request->discount_type : null;
        $data->stock = ($request->stock) ? $request->stock : 0;
        $data->total_stock = ($request->stock) ? $request->stock : 0;
        $data->manufacture_date = $request->manufacture_date;
        $data->expired_date = $request->expired_date;
        $data->video = ($request->product_video) ? 1 : null;
        $data->weight = $request->weight;
        $data->length = $request->length;
        $data->width = $request->width;
        $data->height = $request->height;
        if($request->shipping_method){
            $data->shipping_method = ($request->shipping_method) ? $request->shipping_method : null;
            $data->order_qty = ($request->order_qty) ? $request->order_qty : null;
            $data->free_shipping = ($request->free_shipping) ? 1 : null;
            $data->shipping_cost = ($request->shipping_cost) ? $request->shipping_cost : null;
            $data->discount_shipping_cost = ($request->discount_shipping_cost) ? $request->discount_shipping_cost : null;
            $data->ship_region_id = ($request->ship_region_id) ? $request->ship_region_id : null;
            $data->other_region_cost = ($request->other_region_cost) ? $request->other_region_cost : null;
            $data->shipping_time = ($request->shipping_time) ? $request->shipping_time : null;
        }
        $data->cash_on_delivery = ($request->cash_on_delivery) ? $request->cash_on_delivery : null;
        
        $data->status = ($request->status ? 'active' : 'deactive');
        $data->updated_by = $admin_id;
        $data->product_type = ($request->product_type ? $request->product_type : 'add-to-cart');
        $data->availability_date = $request->availability_date ?? null;
        $data->pre_order_fee = $request->pre_order_fee ?? null;
        $data->file_link = $request->file_link ?? null;
        //if file set
        if ($request->hasFile('file')) {
            $getfile_path = public_path('upload/file/product/'. $data->file);
            if(file_exists($getfile_path) && $data->file){
                unlink($getfile_path);
            }
            $file = $request->file('file');
            $new_file_name = $this->uniqueImagePath('products', 'file', $file->getClientOriginalName());
            $file->move(public_path('upload/file/product'), $new_file_name);
            $data->file = $new_file_name;
        }
        //if feature image set
        if ($request->hasFile('feature_image')) {

            $getimage_path = public_path('upload/images/product/'. $data->feature_image);
            if(file_exists($getimage_path) && $data->feature_image){
                unlink($getimage_path);
                unlink(public_path('upload/images/product/thumb/'. $data->feature_image));
            }

            $image = $request->file('feature_image');
            $new_image_name = $this->uniqueImagePath('products', 'feature_image', $data->slug.'.'.$image->getClientOriginalExtension());

            $image_path = public_path('upload/images/product/thumb/' . $new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(200, 200);
            $image_resize->save($image_path);

            $image->move(public_path('upload/images/product'), $new_image_name);

            $data->feature_image = $new_image_name;
        }

        //if meta image set
        if ($request->hasFile('meta_image')) {
            $getimage_path = public_path('upload/images/product/meta_image/'. $data->meta_image);
            if(file_exists($getimage_path) && $data->meta_image){
                unlink($getimage_path);
            }
            $image = $request->file('meta_image');
            $new_image_name = $this->uniqueImagePath('products', 'meta_image', $request->title.'.'.$image->getClientOriginalExtension());
            $image->move(public_path('upload/images/product/meta_image'), $new_image_name);
            $data->meta_image = $new_image_name;
        }

$tags = $request->keywords;
 if(!empty($tags)){
		$newtags = implode(', ', $tags);
            
		$data->keyword = str_replace(',,', ',', $newtags);
		
			foreach($tags as $tag){
				if(strlen($tag)>0){
			$keytags = Keyword::where('text', $tag)->first();
			
			if($keytags != null){
				$keytag = Keyword::find($keytags->id);
				$keytag->product += 1;
				$keytag->save();
			} else {
				$keytag = new Keyword();
				$keytag->text = $tag;
				$keytag->product = 1;
				$keytag->save();
			}
				}
			}
		}


        $update = $data->save();

        if($update){
            //update variation value
            if($request->featureUpdate){
                foreach ($request->featureUpdate as $attribute_id => $variation_id){
                    if($request->attributeValueUpdate && array_key_exists($attribute_id, $request->attributeValueUpdate)) {
                        for ($i = 0; $i < count($request->attributeValueUpdate[$attribute_id]); $i++) {
                            //check weather attribute value set
                            if (array_key_exists($i, $request->attributeValueUpdate[$attribute_id]) ) {
                                //insert or update feature attribute details in ProductVariationDetails table
                                $feature_details = ProductVariationDetails::where('attributeValue_name', $request->attributeValueUpdate[$attribute_id][$i])
                                    ->where('product_id', $product_id)->first();
                                if (!$feature_details) {
                                    $feature_details = new ProductVariationDetails();
                                }
                                $feature_details->product_id = $product_id;
                                $feature_details->attribute_id = $attribute_id;
                                $feature_details->variation_id = $variation_id;
                                $feature_details->attributeValue_name = $request->attributeValueUpdate[$attribute_id][$i];
                                $feature_details->sku = (isset($request->skuUpdate[$attribute_id]) && array_key_exists($i, $request->skuUpdate[$attribute_id]) ? $request->skuUpdate[$attribute_id][$i] : 0);
                                $feature_details->quantity = (isset($request->qtyUpdate[$attribute_id]) && array_key_exists($i, $request->qtyUpdate[$attribute_id]) ? $request->qtyUpdate[$attribute_id][$i] : 0);
                                $feature_details->price = (isset($request->priceUpdate[$attribute_id]) && array_key_exists($i, $request->priceUpdate[$attribute_id]) ? $request->priceUpdate[$attribute_id][$i] : 0);
                                $feature_details->color = (isset($request->colorUpdate[$attribute_id]) && array_key_exists($i, $request->colorUpdate[$attribute_id]) ? $request->colorUpdate[$attribute_id][$i] : null);

                                //if attribute variant image set
                                if (isset($request->imageUpdate[$attribute_id]) && array_key_exists($i, $request->imageUpdate[$attribute_id])) {
                                    $image = $request->imageUpdate[$attribute_id][$i];
                                    $new_variantimage_name = $this->uniqueImagePath('product_variation_details', 'image', $request->title.'.'.$image->getClientOriginalExtension());

                                    $image_path = public_path('upload/images/product/varriant-product/thumb/' . $new_variantimage_name);
                                    $image_resize = Image::make($image);
                                    $image_resize->resize(250, 200);
                                    $image_resize->save($image_path);

                                    $image->move(public_path('upload/images/product/varriant-product'), $new_variantimage_name);
                                    $feature_details->image = $new_variantimage_name;
                                }
                                $feature_details->save();
                            }
                        }
                    }
                }
            }

            //insert new variation
            if($request->attribute){
                foreach ($request->attribute as $attribute_id => $attr_value){
                    //insert product feature name in feature table
                    $feature = new ProductVariation();
                    $feature->product_id = $data->id;
                    $feature->attribute_id = $attribute_id;
                    $feature->attribute_name = $attr_value;
                    $feature->in_display= 1;
                    $feature->save();

                    for ($i=0; $i< count($request->attributeValue[$attribute_id]); $i++){
                        $quantity = 0;
                        //check weather attribute value set
                        if(array_key_exists($i, $request->attributeValue[$attribute_id]) && $request->attributeValue[$attribute_id][$i]) {
                            //insert feature attribute details in ProductVariationDetails table
                            $feature_details = new ProductVariationDetails();
                            $feature_details->product_id = $data->id;
                            $feature_details->attribute_id = $attribute_id;
                            $feature_details->variation_id = $feature->id;
                            $feature_details->attributeValue_name = $request->attributeValue[$attribute_id][$i];
                            $feature_details->sku = (isset($request->sku[$attribute_id]) && array_key_exists($i, $request->sku[$attribute_id]) ? $request->sku[$attribute_id][$i] : 0);
                            $feature_details->quantity = (isset($request->qty[$attribute_id]) && array_key_exists($i, $request->qty[$attribute_id]) ? $request->qty[$attribute_id][$i] : 0);
                            $feature_details->price = (isset($request->price[$attribute_id]) && array_key_exists($i, $request->price[$attribute_id]) ? $request->price[$attribute_id][$i] : 0);
                            $feature_details->color = (isset($request->color[$attribute_id]) && array_key_exists($i, $request->color[$attribute_id]) ? $request->color[$attribute_id][$i] : null);

                            //if attribute variant image set
                            if (isset($request->image[$attribute_id]) && array_key_exists($i, $request->image[$attribute_id])) {
                                $image = $request->image[$attribute_id][$i];
                                $new_variantimage_name = $this->uniqueImagePath('product_variation_details', 'image', $image->getClientOriginalName());

                                $image_path = public_path('upload/images/product/varriant-product/thumb/' . $new_variantimage_name);
                                $image_resize = Image::make($image);
                                $image_resize->resize(250, 200);
                                $image_resize->save($image_path);

                                $image->move(public_path('upload/images/product/varriant-product'), $new_variantimage_name);
                                $feature_details->image = $new_variantimage_name;
                            }
                            $feature_details->save();
                        }
                    }
                }
            }

            //insert or update product feature
            if($request->features){
                try {
                    foreach($request->features as $feature_id => $feature_name) {

                        $extraFeature = ProductFeature::where('product_id', $product_id)->where('feature_id', $feature_id)->first();
                        if(!$extraFeature){
                            $extraFeature = new ProductFeature();
                        }
                        $extraFeature->product_id = $product_id;
                        $extraFeature->feature_id = $feature_id;
                        $extraFeature->name = $feature_name;
                        $extraFeature->value = ($request->featureValue[$feature_id]) ? $request->featureValue[$feature_id] : null;
                        $extraFeature->save();

                    }
                }catch (Exception $exception){

                }
            }

            //video upload
            if(isset($request->video_provider)){
                for ($i=0; $i< count($request->video_provider); $i++) {
                    ProductVideo::updateOrCreate(['product_id' => $product_id,
                        'provider' => $request->video_provider[$i],
                        'link' => $request->video_link[$i]
                    ],['product_id' => $product_id,
                        'provider' => $request->video_provider[$i],
                        'link' => $request->video_link[$i]
                    ]);
                }
            }
        }

        Toastr::success('Product update Successfully.');
        return back();
    }












 //update product
    public function b2bupdate(Request $request, $product_id)
    {
		
		
		
        $admin_id = Auth::guard('admin')->id();
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'subcategory' => 'required'
        ]);
        // Insert product
        $data = Product::find($product_id);
        $data->vendor_id = ($request->vendor_id ? $request->vendor_id : null);
        $data->title = $request->title;
        $data->sku = $request->sku;
        $data->summery = $request->summery;
        $data->description = $request->description;
        $data->category_id = $request->category;
        $data->subcategory_id = $request->subcategory;
        $data->childcategory_id = ($request->childcategory) ? $request->childcategory : null;
        $data->brand_id = ($request->brand ? $request->brand : null);
        $data->purchase_price = 0;
        $data->selling_price = 0;
		$data->profit = $request->profit;
        $data->discount = ($request->discount) ? $request->discount : null;
        $data->discount_type = ($request->discount_type) ? $request->discount_type : null;
        $data->stock = ($request->stock) ? $request->stock : 0;
        $data->total_stock = ($request->stock) ? $request->stock : 0;
        $data->manufacture_date = $request->manufacture_date;
        $data->expired_date = $request->expired_date;
        $data->video = ($request->product_video) ? 1 : null;
        $data->weight = $request->weight;
        $data->length = $request->length;
        $data->width = $request->width;
        $data->height = $request->height;
        if($request->shipping_method){
            $data->shipping_method = ($request->shipping_method) ? $request->shipping_method : null;
            $data->order_qty = ($request->order_qty) ? $request->order_qty : null;
            $data->free_shipping = ($request->free_shipping) ? 1 : null;
            $data->shipping_cost = ($request->shipping_cost) ? $request->shipping_cost : null;
            $data->discount_shipping_cost = ($request->discount_shipping_cost) ? $request->discount_shipping_cost : null;
            $data->ship_region_id = ($request->ship_region_id) ? $request->ship_region_id : null;
            $data->other_region_cost = ($request->other_region_cost) ? $request->other_region_cost : null;
            $data->shipping_time = ($request->shipping_time) ? $request->shipping_time : null;
        }
        $data->cash_on_delivery = ($request->cash_on_delivery) ? $request->cash_on_delivery : null;
        
        $data->status = ($request->status ? 'active' : 'deactive');
        $data->updated_by = $admin_id;
        $data->product_type = ($request->product_type ? $request->product_type : 'add-to-cart');
        $data->availability_date = $request->availability_date ?? null;
        $data->pre_order_fee = $request->pre_order_fee ?? null;
        $data->file_link = $request->file_link ?? null;
        //if file set
        if ($request->hasFile('file')) {
            $getfile_path = public_path('upload/file/product/'. $data->file);
            if(file_exists($getfile_path) && $data->file){
                unlink($getfile_path);
            }
            $file = $request->file('file');
            $new_file_name = $this->uniqueImagePath('products', 'file', $file->getClientOriginalName());
            $file->move(public_path('upload/file/product'), $new_file_name);
            $data->file = $new_file_name;
        }
        //if feature image set
        if ($request->hasFile('feature_image')) {

            $getimage_path = public_path('upload/images/product/'. $data->feature_image);
            if(file_exists($getimage_path) && $data->feature_image){
                unlink($getimage_path);
                unlink(public_path('upload/images/product/thumb/'. $data->feature_image));
            }

            $image = $request->file('feature_image');
            $new_image_name = $this->uniqueImagePath('products', 'feature_image', $data->slug.'.'.$image->getClientOriginalExtension());

            $image_path = public_path('upload/images/product/thumb/' . $new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(200, 200);
            $image_resize->save($image_path);

            $image->move(public_path('upload/images/product'), $new_image_name);

            $data->feature_image = $new_image_name;
        }

        //if meta image set
        if ($request->hasFile('meta_image')) {
            $getimage_path = public_path('upload/images/product/meta_image/'. $data->meta_image);
            if(file_exists($getimage_path) && $data->meta_image){
                unlink($getimage_path);
            }
            $image = $request->file('meta_image');
            $new_image_name = $this->uniqueImagePath('products', 'meta_image', $request->title.'.'.$image->getClientOriginalExtension());
            $image->move(public_path('upload/images/product/meta_image'), $new_image_name);
            $data->meta_image = $new_image_name;
        }

$tags = $request->keywords;
 if(!empty($tags)){
		$newtags = implode(', ', $tags);
            
		$data->keyword = str_replace(',,', ',', $newtags);
		
			foreach($tags as $tag){
				if(strlen($tag)>0){
			$keytags = Keyword::where('text', $tag)->first();
			
			if($keytags != null){
				$keytag = Keyword::find($keytags->id);
				$keytag->product += 1;
				$keytag->save();
			} else {
				$keytag = new Keyword();
				$keytag->text = $tag;
				$keytag->product = 1;
				$keytag->save();
			}
				}
			}
		}


       	$start = $request->start;
		$end = $request->end;
		$amt = $request->amt;
		$min = min($amt);
		$max = max($amt);
		$data->is_b2b = 1;
		$data->pricing = ''.$min.'-'.$max.'';
       
		
		
		
		
		
		
        $update = $data->save();

        if($update) {
			
			
			Price::where('product_id', $data->id)->delete();
			
			
			
				foreach($start as $key => $startp){
			
			$price = new Price();
			    $price->product_id = $data->id;
				$price->start = $startp;
				$price->end = $end[$key];
				$price->price = $amt[$key];
				$price->save();
			
		}
            //update variation value
            if($request->featureUpdate){
                foreach ($request->featureUpdate as $attribute_id => $variation_id){
                    if($request->attributeValueUpdate && array_key_exists($attribute_id, $request->attributeValueUpdate)) {
                        for ($i = 0; $i < count($request->attributeValueUpdate[$attribute_id]); $i++) {
                            //check weather attribute value set
                            if (array_key_exists($i, $request->attributeValueUpdate[$attribute_id]) ) {
                                //insert or update feature attribute details in ProductVariationDetails table
                                $feature_details = ProductVariationDetails::where('attributeValue_name', $request->attributeValueUpdate[$attribute_id][$i])
                                    ->where('product_id', $product_id)->first();
                                if (!$feature_details) {
                                    $feature_details = new ProductVariationDetails();
                                }
                                $feature_details->product_id = $product_id;
                                $feature_details->attribute_id = $attribute_id;
                                $feature_details->variation_id = $variation_id;
                                $feature_details->attributeValue_name = $request->attributeValueUpdate[$attribute_id][$i];
                                $feature_details->sku = (isset($request->skuUpdate[$attribute_id]) && array_key_exists($i, $request->skuUpdate[$attribute_id]) ? $request->skuUpdate[$attribute_id][$i] : 0);
                                $feature_details->quantity = (isset($request->qtyUpdate[$attribute_id]) && array_key_exists($i, $request->qtyUpdate[$attribute_id]) ? $request->qtyUpdate[$attribute_id][$i] : 0);
                                $feature_details->price = (isset($request->priceUpdate[$attribute_id]) && array_key_exists($i, $request->priceUpdate[$attribute_id]) ? $request->priceUpdate[$attribute_id][$i] : 0);
                                $feature_details->color = (isset($request->colorUpdate[$attribute_id]) && array_key_exists($i, $request->colorUpdate[$attribute_id]) ? $request->colorUpdate[$attribute_id][$i] : null);

                                //if attribute variant image set
                                if (isset($request->imageUpdate[$attribute_id]) && array_key_exists($i, $request->imageUpdate[$attribute_id])) {
                                    $image = $request->imageUpdate[$attribute_id][$i];
                                    $new_variantimage_name = $this->uniqueImagePath('product_variation_details', 'image', $request->title.'.'.$image->getClientOriginalExtension());

                                    $image_path = public_path('upload/images/product/varriant-product/thumb/' . $new_variantimage_name);
                                    $image_resize = Image::make($image);
                                    $image_resize->resize(250, 200);
                                    $image_resize->save($image_path);

                                    $image->move(public_path('upload/images/product/varriant-product'), $new_variantimage_name);
                                    $feature_details->image = $new_variantimage_name;
                                }
                                $feature_details->save();
                            }
                        }
                    }
                }
            }

            //insert new variation
            if($request->attribute){
                foreach ($request->attribute as $attribute_id => $attr_value){
                    //insert product feature name in feature table
                    $feature = new ProductVariation();
                    $feature->product_id = $data->id;
                    $feature->attribute_id = $attribute_id;
                    $feature->attribute_name = $attr_value;
                    $feature->in_display= 1;
                    $feature->save();

                    for ($i=0; $i< count($request->attributeValue[$attribute_id]); $i++){
                        $quantity = 0;
                        //check weather attribute value set
                        if(array_key_exists($i, $request->attributeValue[$attribute_id]) && $request->attributeValue[$attribute_id][$i]) {
                            //insert feature attribute details in ProductVariationDetails table
                            $feature_details = new ProductVariationDetails();
                            $feature_details->product_id = $data->id;
                            $feature_details->attribute_id = $attribute_id;
                            $feature_details->variation_id = $feature->id;
                            $feature_details->attributeValue_name = $request->attributeValue[$attribute_id][$i];
                            $feature_details->sku = (isset($request->sku[$attribute_id]) && array_key_exists($i, $request->sku[$attribute_id]) ? $request->sku[$attribute_id][$i] : 0);
                            $feature_details->quantity = (isset($request->qty[$attribute_id]) && array_key_exists($i, $request->qty[$attribute_id]) ? $request->qty[$attribute_id][$i] : 0);
                            $feature_details->price = (isset($request->price[$attribute_id]) && array_key_exists($i, $request->price[$attribute_id]) ? $request->price[$attribute_id][$i] : 0);
                            $feature_details->color = (isset($request->color[$attribute_id]) && array_key_exists($i, $request->color[$attribute_id]) ? $request->color[$attribute_id][$i] : null);

                            //if attribute variant image set
                            if (isset($request->image[$attribute_id]) && array_key_exists($i, $request->image[$attribute_id])) {
                                $image = $request->image[$attribute_id][$i];
                                $new_variantimage_name = $this->uniqueImagePath('product_variation_details', 'image', $image->getClientOriginalName());

                                $image_path = public_path('upload/images/product/varriant-product/thumb/' . $new_variantimage_name);
                                $image_resize = Image::make($image);
                                $image_resize->resize(250, 200);
                                $image_resize->save($image_path);

                                $image->move(public_path('upload/images/product/varriant-product'), $new_variantimage_name);
                                $feature_details->image = $new_variantimage_name;
                            }
                            $feature_details->save();
                        }
                    }
                }
            }

            //insert or update product feature
            if($request->features){
                try {
                    foreach($request->features as $feature_id => $feature_name) {

                        $extraFeature = ProductFeature::where('product_id', $product_id)->where('feature_id', $feature_id)->first();
                        if(!$extraFeature){
                            $extraFeature = new ProductFeature();
                        }
                        $extraFeature->product_id = $product_id;
                        $extraFeature->feature_id = $feature_id;
                        $extraFeature->name = $feature_name;
                        $extraFeature->value = ($request->featureValue[$feature_id]) ? $request->featureValue[$feature_id] : null;
                        $extraFeature->save();

                    }
                }catch (Exception $exception){

                }
            }

            //video upload
            if(isset($request->video_provider)){
                for ($i=0; $i< count($request->video_provider); $i++) {
                    ProductVideo::updateOrCreate(['product_id' => $product_id,
                        'provider' => $request->video_provider[$i],
                        'link' => $request->video_link[$i]
                    ],['product_id' => $product_id,
                        'provider' => $request->video_provider[$i],
                        'link' => $request->video_link[$i]
                    ]);
                }
            }
        }

        Toastr::success('Product update Successfully.');
        return back();
    }













    // delete product
    public function delete($id)
    {
		
		
        $product = Product::find($id);
        if($product){
            $image_path = public_path('upload/images/product/'. $product->feature_image);
            if(file_exists($image_path) && $product->feature_image){
                unlink($image_path);
                unlink(public_path('upload/images/product/thumb/'. $product->feature_image));
            }

            $product->delete();

            $gallery_images = ProductImage::where('product_id',  $product->id)->get();
            foreach ($gallery_images as $gallery_image) {
                $image_path = public_path('upload/images/product/varriant-product/'. $gallery_image->image_path);
                if(file_exists($image_path) && $gallery_image->image_path){
                    unlink($image_path);
                    unlink(public_path('upload/images/product/varriant-product/thumb/'. $gallery_image->image_path));
                }
                $gallery_image->delete();
            }
            ProductVariation::where('product_id',  $product->id)->delete();
            $variationDetails = ProductVariationDetails::where('product_id',  $product->id)->get();
            foreach ($variationDetails as $variation) {
                $image_path = public_path('upload/images/product/varriant-product/'. $variation->image);
                if(file_exists($image_path) && $variation->image){
                    unlink($image_path);
                    unlink(public_path('upload/images/product/varriant-product/thumb/'. $variation->image));
                }
                $variation->delete();
            }
            ProductFeature::where('product_id',  $product->id)->delete();
            $output = [
                'status' => true,
                'msg' => 'Product deleted successful.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Product cannot delete.'
            ];
        }
        return response()->json($output);
    }

    //get highlight popup
    public function highlight($product_id){
        $product = Product::find($product_id);
        if($product){
            return view('admin.product.hightlight')->with(compact('product'));
        }
        return false;
    }

    //add remove highlight product
    public function highlightAddRemove(Request $request){

        $section = HomepageSection::find($request->section_id);

        $products_id =  ($section->product_id) ? explode(',', $section->product_id) : [];

        if(in_array($request->product_id, $products_id)){
            //remove product id from array
            unset($products_id[array_search($request->product_id, $products_id)]);
            $output = [
                'status' => false,
                'msg' => 'Product remove successfully.'
            ];

        }else{
            //add product id in array
            array_push($products_id, $request->product_id);
            $output = [
                'status' => true,
                'msg' => 'Product added successfully.'
            ];
        }
        //update hompagesection table
        $section->update(['product_id' => implode(',', $products_id)]);

        return response()->json($output);

    }

    //insert gallery image
    public function storeGalleryImage(Request $request)
    {
        $request->validate([
            'gallery_image' => 'required'
        ]);
        // gallery Image upload
        if ($request->hasFile('gallery_image')) {
            $gallery_image = $request->file('gallery_image');
            foreach ($gallery_image as $image) {
                $new_image_name = $this->uniqueImagePath('product_images', 'image_path', $image->getClientOriginalName());
                $image_path = public_path('upload/images/product/gallery/thumb/' . $new_image_name);
                $image_resize = Image::make($image);
                $image_resize->resize(200, 200);
                $image_resize->save($image_path);
                $image->move(public_path('upload/images/product/gallery'), $new_image_name);
                ProductImage::create( [
                    'product_id' => $request->product_id,
                    'image_path' => $new_image_name
                ]);
            }

            Toastr::success('Gallery image upload successfully.');
            return back();
        }
        Toastr::error('Gallery image upload failed.');
        return back();
    }

    //display gallery image
    public function getGalleryImage($product_id){
        $product_images = ProductImage::where('product_id', $product_id)->get();

        return view('admin.product.gallery-images')->with(compact('product_images', 'product_id'));
    }

    // delete GalleryImage
    public function deleteGalleryImage($id)
    {
        $find = ProductImage::find($id);
        if($find){
            //delete image from folder
            $thumb_image_path = public_path('upload/images/product/gallery/thumb/'. $find->image_path);
            $image_path = public_path('upload/images/product/gallery/'. $find->image_path);
            if(file_exists($image_path) && $find->image_path){
                unlink($image_path);
                unlink($thumb_image_path);
            }
            $find->delete();
            $output = [
                'status' => true,
                'msg' => 'Gallery Image deleted successfully.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Gallery Image cannot deleted.'
            ];
        }
        return response()->json($output);
    }


}
