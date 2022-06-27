@foreach($products as $product)
<div class="product-layout col-lg-3 col-md-3 col-sm-4 col-xs-6">
    <div class="product-item-container">
        <div class="left-block">
            <div class="product-image-container">
                <a href="{{ route('product_details', $product->slug) }}?ref={{$agent->referral_code}}" >
                <img src="{{asset('upload/images/product/thumb/'. $product->feature_image)}}" class="img-1 img-responsive">
                </a>
                @if($product->stock <= 0)
                <div class="box-label">
                <span class="label-sale">Sold Out</span>
                </div>
                @endif
            </div>
        </div> 
        <div class="right-block">
            <div class="caption">
                <h4><a href="{{ route('product_details', $product->slug) }}?ref={{$agent->referral_code}}">{{Str::limit($product->title, 40)}}</a></h4>
                <div class="total-price clearfix">
                    <div class="price price-left">
                         <label for="ratting5">{{\App\Http\Controllers\HelperController::ratting(round($product->reviews->avg('ratting'), 1))}}</label><br/>
                        <?php
                        $selling_price = $product->selling_price;
                        $discount = $product->selling_price - $product->agent_price ;
                        $discount_type = Config::get('siteSetting.currency_symble');
                       
                        if($discount){
                            $calculate_discount = App\Http\Controllers\HelperController::calculate_discount($selling_price, $discount, $discount_type );
                            $price = $calculate_discount['price'];
                        }
                        ?>

                       @if($discount)
                            <span class="price-new">{{Config::get('siteSetting.currency_symble')}}{{ $price }}</span>
                            <span class="price-old">{{Config::get('siteSetting.currency_symble')}}{{ round($selling_price) }}</span>
                        @else
                            <span class="price-new">{{Config::get('siteSetting.currency_symble')}}{{$selling_price}}</span>
                        @endif
                        </div>
                        @if($discount)
                        <div class="price-sale price-right">
                            <span class="discount">
                              @if($discount_type == '%')-@endif{{$calculate_discount['discount']}}%
                            <strong>OFF</strong>
                          </span>
                        </div>
                        @endif
                </div>
            </div>
            
        </div>
    </div>
</div>
@endforeach
