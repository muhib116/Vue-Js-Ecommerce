<input type="hidden" name="pid" value="{{$id}}" name="id">

<div class="col-md-12">
    <div class="form-group">
        <label class="required" for="offer_quantity">Shop</label>
		
		<select name="enlist_id" class="form-control select2">
		@foreach($shop as $vendor)
		<option value="{{$vendor->id}}">{{$vendor->vendor->shop_name}}
		@endforeach
		</select>
    </div>
</div>

@php
$price = ($offerProduct->offer_price-((10 / 100) * $offerProduct->offer_price));
@endphp


<div class="col-md-12">
    <div class="form-group">
        <label class="required" for="offer_quantity">Given Price</label>
        <input name="offer_price" value="{{$price}}" placeholder="Enter Given Price" id="price" type="number" step="0.01" class="form-control">
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label class="required" for="offer_quantity">Stock</label>
        <input name="stock" placeholder="Enter Stock" id="stock" value="100" type="text" class="form-control">
    </div>
</div>
