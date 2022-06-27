@foreach($offer_products as $product)
<div class="product-layout col-lg-2 col-md-2 col-sm-4 col-xs-6">
    <div class="product-item-container">
        <div class="left-block"> 
            <div class="product-image-container">
                <img src="{{asset('upload/images/product/thumb/'. $product->feature_image)}}" class="img-1 img-responsive">
                <span class="quickview iframe-link visible-lg btn-button" data-toggle="tooltip" title="" data-fancybox-type="iframe" href="{{route('quickview', $product->slug)}}?type=kanamachi" data-original-title="Quickview "> <i class="fa fa-search"></i> </span>
            </div>
        </div>
        <div class="right-block">
            <div class="caption">
                <h4> <span style="font-size: 14px;color: #222;display: block; text-transform: capitalize;font-weight: 500;" class="quickview iframe-link " title="Quickview" data-fancybox-type="iframe" href="{{route('quickview', $product->slug)}}?type=kanamachi">{{Str::limit($product->title, 40)}}</span></h4>
                <div class="total-price clearfix" style="min-height: 54px;">
                    <div class="price price-left">
                        <label for="ratting5">{{\App\Http\Controllers\HelperController::ratting(round($product->reviews->avg('ratting'), 1))}}</label><br/>
                        <?php
                            $selling_price = $product->selling_price;
                            $discount_price = $offer->discount;
                            $percantage =  $product->selling_price -  $discount_price;
                            $percantage = round(((($selling_price - $percantage) - $selling_price) / $selling_price) * 100, 0); 
                        ?>
                        <span class="price-new">{{Config::get('siteSetting.currency_symble')}}{{ $discount_price }}</span>
                        <span class="price-old">{{Config::get('siteSetting.currency_symble')}}{{round($selling_price)}}</span>                    
                    </div>
                    <div class="price-sale price-right">
                        <span class="discount">
                          {{$percantage}}%
                        <strong>OFF</strong>
                      </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach 