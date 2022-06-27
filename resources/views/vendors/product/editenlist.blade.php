<input type="hidden" value="{{$product->id}}" name="id">

<div class="col-md-12">
    <div class="form-group">
        <label class="required" for="offer_quantity">Available Stock</label>
        <input name="stock" placeholder="Enter My Stock" id="stock" value="{{$product->stock}}" type="number" class="form-control">
    </div>
</div>

    <div class="col-md-12">
    <div class="form-group">
        <label class="required" for="offer_quantity">Selling Price</label>
        <input name="selling_price" placeholder="Enter My Selling Price {{$product->products->min_price}} to {{$product->products->max_price}}" min="{{$product->products->min_price}}" max="{{$product->products->max_price}}" id="min_price" value="{{$product->selling_price}}" type="number" step="0.01" class="form-control">
    </div>
</div>
