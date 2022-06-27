<form action="{{route('buyDirect')}}{{(request()->get('offer')) ? '?offer='. request()->get('offer') : ''}}" name="buy{{$vendor->id}}" method="post">

<div class="product-item-container">

<div class="left-block">
<div class="product-image-container">
<a href="{{ route('shop_details', $vendor->vendor->slug) }}" >

<img alt="{{ $vendor->vendor->shop_name }}" src="{{asset('upload/vendors/logo/'.($vendor->vendor->logo ? $vendor->vendor->logo : 'logo.png'))}}" height="120" width="120" class="img-1 img-responsive">
</a>
</div>
</div>
<div class="right-block">
<div class="caption">

<h3><a href="{{ route('shop_details', $vendor->vendor->slug) }}">{{Str::limit($vendor->vendor->shop_name, 40)}}</a></h3>


  Stock:{{$vendor->stock}}<br>
   <div style="display: inline-block;width: 40%;text-align: center;background: #ff5722;color: #fff;border-radius: 3px;cursor:pointer">
   
  <span style="display:block" onclick="addcart('{{$vendor->id}}')" data-toggle="tooltip" title="Add to cart" data-original-title="add to cart"> <i class="fa fa-shopping-cart"></i> Add Cart</span>
  </div>
   
   
   
	  @csrf
	  @if(request()->get('offer')) <input type="hidden" value="{{ request()->get('offer') }}" name="offer"> @endif
   
   
			
		
			 <div style="display: inline-block;width: 40%;text-align: center;background: #3366ff;color: #fff;border-radius: 3px;cursor:pointer">
   
   
   

			<input type="hidden" name="product_id" value="{{$vendor->products->id}}">
			<input type="hidden" name="enlist_id" value="{{$vendor->id}}">
			
			
			   <span style="display:block" onclick="buy{{$vendor->id}}.submit()" data-toggle="tooltip" title="{{ ($product_detail->product_type == 'pre-order') ? ' Pre Order' : 'Buy Now'}}" data-original-title="{{ ($product_detail->product_type == 'pre-order') ? ' Pre Order' : 'Buy Now'}}"> <i class="fa fa-shopping-cart"></i> {{ ($product_detail->product_type == 'pre-order') ? ' Pre Order' : 'Buy Now'}}</span>  
		</div>
	

</div>
</div>
</div>

</form>

