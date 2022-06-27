<div class="price price-left">
    <label for="ratting5">
       {{\App\Http\Controllers\HelperController::ratting(round($product->reviews->avg('ratting')))}}
    </label><br/>
    <?php  
        $selling_price = $product->selling_price;
        $discount = ($product->discount) ? $product->discount : null;
        $discount_type = $product->discount_type;
        if($discount){
            $calculate_discount = App\Http\Controllers\HelperController::calculate_discount($selling_price, $discount, $discount_type );
        }
    ?>
	
	@if($product->is_b2b == 0)
	
    @if($discount)
        <span class="price-new">{{Config::get('siteSetting.currency_symble')}}{{round( $calculate_discount['price']) }}</span>
        <span class="price-old">{{Config::get('siteSetting.currency_symble')}}{{round($selling_price)}}</span>
    @else
        <span class="price-new">{{Config::get('siteSetting.currency_symble')}}{{round($selling_price)}}</span>
    @endif
	@else
		
		@php
					$pricing = explode("-", $product->pricing);
        $start = $pricing[0];
        $end   = $pricing[1];
		
		
		$nstart = $start+(($product->profit/100)*$start);
		$nend = $end+(($product->profit/100)*$end);
@endphp
					
	
	 <span class="price-new">{{Config::get('siteSetting.currency_symble')}}{{$nstart}}-{{$nend}}</span>
	@endif
</div>
@if($product->is_b2b == 1)
<div class="price-sale price-right">
    <span class="discount">
    <strong>Wholesale (B2B)</strong>
  </span>
</div>
@endif

@if($discount)
<div class="price-sale price-right">
    <span class="discount">
      @if($discount_type == '%')-@endif{{$calculate_discount['discount']}}%
    <strong>OFF</strong>
  </span>
</div>
@endif