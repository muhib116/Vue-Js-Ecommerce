@if(count($allproducts)>0)
    @foreach($allproducts as $product) 
        @php $products_id = $offer->offer_products->pluck('product_id')->toArray();

        $discount = ($product->discount) ? $product->discount : 5; @endphp
        <tr id="product{{  $product->id }}"  @if(in_array($product->id, $products_id)) style="background: #ffe2e2" @endif>
            <td><input type="checkbox" class="product_id" name="product_id[{{  $product->id }}]"></td>
            <td><a style="color: #000" target="_blank" href="{{ route('product_details', $product->slug) }}"><img width="35" src="{{ asset('upload/images/product/thumb/'. $product->feature_image)}}"> {{Str::limit($product->title, 40)}}</a></td>
            <td>{{ Config::get('siteSetting.currency_symble') . $product->selling_price }}</td>
            
                @if($offer->discount > 0)
                    @if($offer->discount_type == 'fixed')
                        {{ Config::get('siteSetting.currency_symble') . $offer->discount }}
                    @elseif($offer->discount_type == '%')
                        {{ Config::get('siteSetting.currency_symble') . ($product->selling_price *  $offer->discount) / 100 }}
                    @elseif($offer->discount_type == 'cash-back')
                        @if($offer->discount_type == '%')
                            {{ Config::get('siteSetting.currency_symble') . ($product->selling_price *  $offer->discount) / 100 }}
                        @else
                            {{ Config::get('siteSetting.currency_symble') . ($product->selling_price - $offer->discount) }}
                        @endif
                    @else
                        {{ Config::get('siteSetting.currency_symble') .( $product->selling_price - $offer->discount) }}
                    @endif
                @else  
					
				@if($offer->offer_type == 'jowar-bhata')
				<input type="hidden" id="discount{{$product->id}}" class="form-control" placeholder="Enter Discount" name="discount[{{ $product->id }}]" value="{{$product->selling_price}}">
@else
<td>
	<input type="text" id="discount{{$product->id}}" class="form-control" placeholder="Enter Discount" name="discount[{{ $product->id }}]" value="{{$discount}}">
</td>
@endif


				@endif
            
			
			
			
			@if($offer->offer_type == 'jowar-bhata')
			<td><input type="number" id="percentstart{{$product->id}}" class="form-control" placeholder="Enter Minimum %" name="percentstart[{{ $product->id }}]" value="1"> 
            </td>
			<td><input type="number" id="percentend{{$product->id}}" class="form-control" placeholder="Enter Maximum %" name="percentend[{{ $product->id }}]" value="20"> 
            </td>
			<td><input type="number" id="viewlimit{{$product->id}}" class="form-control" placeholder="Enter Daily Limit" name="viewlimit[{{ $product->id }}]" value="800"> 
            </td>
			<td><input type="number" id="timestart{{$product->id}}" class="form-control" placeholder="Update After Minutes" name="timestart[{{ $product->id }}]" value="5"> 
            </td>
			<td><input type="number" id="timeend{{$product->id}}" class="form-control" placeholder="Update After Max Minutes" name="timeend[{{ $product->id }}]" value="60"> 
            </td>
			@endif
			
@if($offer->offer_type != 'jowar-bhata')
            <td>
                @if(!$offer->discount_type)
                <select id="discount_type{{ $product->id}}" class="discount_type" name="discount_type[{{  $product->id }}]">
                <option value="{{Config::get('siteSetting.currency_symble') }}">{{Config::get('siteSetting.currency_symble') }}</option>
                <option selected value="%">%</option>
                </select>
                @else {{$offer->discount_type}} discount @endif
            </td>
			@endif
            <td><input type="text" class="form-control" value="{{$product->stock}}" id="quantity{{ $product->id }}" name="quantity[{{ $product->id }}]"></td>
			@if($offer->offer_type != 'jowar-bhata')
            <td><input type="checkbox" id="invisible{{ $product->id }}" value="1" name="invisible[{{ $product->id }}]"></td>
		@endif
            @if(in_array($product->id, $products_id))
            <td><a href="javascript:void(0)"  class="btn btn-danger btn-sm">Added</a></td>
            @else
             <td><a href="javascript:void(0)"  class="btn btn-success btn-sm" onclick="addProduct({{ $product->id }})">Add</a></td>
            @endif
        </tr>
    @endforeach
    <tr><td colspan="15">{{$allproducts->appends(request()->query())->links()}}</td></tr>

@endif