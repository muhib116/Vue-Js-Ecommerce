<input type="hidden" name="pid" value="{{$id}}" name="id">


@php
$price = ($offerProduct->products->offer_price-((3 / 100) * $offerProduct->products->offer_price));
@endphp


<div class="col-md-12">
    <div class="form-group">
        <label class="required" for="offer_quantity">Given Price</label>
        <input name="offer_price" max="{{$price}}" value="{{$offerProduct->offer_price}}" placeholder="Enter Given Price" id="price" type="number" step="0.01" class="form-control">
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label class="required" for="offer_quantity">Stock</label>
        <input name="stock" placeholder="Enter Stock" id="stock" value="100" type="text" class="form-control">
    </div>
</div>