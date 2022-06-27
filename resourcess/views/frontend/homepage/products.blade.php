<?php  
    $discount = null;
    $selling_price = $product->selling_price;
    $discount = ($product->discount) ? $product->discount : null;
    $discount_type = $product->discount_type;
    if($discount){
        $calculate_discount = App\Http\Controllers\HelperController::calculate_discount($selling_price, $discount, $discount_type );
    }
?>

<div  class="product-item-container">
	<div class="left-block ">
	    <div class="image product-image-container">
		@if($product->is_b2b == 0)
	        <a class="lt-image" href="{{ route('product_details', $product->slug) }}" >
		@else
			 <a class="lt-image" href="{{ route('b2bproduct_details', $product->slug) }}" >
		@endif
            <img src="{{asset('upload/images/product/thumb/'. $product->feature_image)}}" class="img-1 img-responsive" alt="{{$product->title}}">
			@if($product->is_b2b == 0)
            @if($discount)
            <div class="box-label">
				<span class="label-sale">@if($discount_type == '%')-@endif{{$calculate_discount['discount']}}%</span>
			</div>
			@endif
			@else
				<div class="box-label">
				<span class="label-sale">Wholesale(B2B)</span>
			</div>
			
			@endif
            </a>
            @if($product->is_b2b == 0)
            <span title="Quickview product details" data-toggle="tooltip" class="btn-button btn-quickview quickview quickview_handler" onclick="quickview('{{$product->slug}}')" href="javascript:void(0)"> <i class="fa fa-search"></i> </span>
           @endif
	    </div>
	  	<div class="box-label">
	  	</div>
	</div>
	<div class="right-block">
	   	<div class="caption">
		
		@if($product->is_b2b == 0)
		
	      	<h4><a href="{{ route('product_details', $product->slug) }}">{{Str::limit($product->title, 40)}}</a></h4>
			@else 
			
	      	<h4><a href="{{ route('b2bproduct_details', $product->slug) }}">{{Str::limit($product->title, 40)}}</a></h4>	
			@endif
			
			
	      	<div class="total-price clearfix" style="visibility: hidden; display: block;">
	        	<div class="price">
				    <label for="ratting5">
				       {{\App\Http\Controllers\HelperController::ratting(round($product->reviews->avg('ratting'), 1))}}
				    </label><br/>
				    @if($product->is_b2b == 0)
			        @if($discount)
				        <span class="price-new">{{Config::get('siteSetting.currency_symble')}}{{ $calculate_discount['price'] }}</span>
				        <span class="price-old">{{Config::get('siteSetting.currency_symble')}}{{$selling_price}}</span>
				    @else
				        <span class="price-new">{{Config::get('siteSetting.currency_symble')}}{{$selling_price}}</span>
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
				
	      	</div>
	      	
	  	</div>
	</div>
</div>