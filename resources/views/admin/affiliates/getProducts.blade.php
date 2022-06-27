@if(count($allproducts)>0)
    @foreach($allproducts as $index => $product) 
        <?php 
            $discount = $product->discount;
            $discount_type = $product->discount_type;
            $selling_price = $product->selling_price;
            if($discount){
                $calculate_discount = App\Http\Controllers\HelperController::calculate_discount($selling_price, $discount, $discount_type );
                $selling_price = $calculate_discount['price'];
            }
            $offer_price = $selling_price - $affiliate_configure->minimum_offer_price;
        ?>
        <tr @if($product->affiliate_product || $offer_price < $affiliate_configure->minimum_offer_price) style="background: #ffe2e2" @else id="product{{  $product->id }}" @endif>
            <td>@if(!$product->affiliate_product && $offer_price > $affiliate_configure->minimum_offer_price)<input type="checkbox" class="product_id" name="product_id[{{  $product->id }}]"> @endif <p> {{(($allproducts->perPage() * $allproducts->currentPage() - $allproducts->perPage()) + ($index+1) )}}</p></td>
            <td><a style="color: #000" target="_blank" href="{{ route('product_details', $product->slug) }}"><img width="35" src="{{ asset('upload/images/product/thumb/'. $product->feature_image)}}"> {{Str::limit($product->title, 40)}}</a></td>
            <td>{{ Config::get('siteSetting.currency_symble') . $product->selling_price }}</td>
            <td>{{ Config::get('siteSetting.currency_symble') . $offer_price }}</td>
            
            <td>
                <p class="commissionStatus" id="commissionStatus{{$product->id}}"></p>
                <input type="number" min="1" style="min-width:70px;" class="form-control" onkeyup ="commissionCalculate({{$product->id}}, {{$offer_price}}, this.value )" value="{{round(($product->affiliate_product) ? $product->affiliate_product->seller_rate : $offer_price)}}" id="seller_rate{{ $product->id }}" name="seller_rate[{{ $product->id }}]">
            
            <i style="font-size:11px;color: #616060;">Price less than  {{Config::get('siteSetting.currency_symble') . round($offer_price) }}</i>

            </td>
            <td><input type="number" min="{{ $affiliate_configure->time_duration }}" class="form-control" value="{{ ($product->affiliate_product) ? $product->affiliate_product->day : $affiliate_configure->time_duration }}" id="day{{ $product->id }}" placeholder="Enter day" name="day[{{ $product->id }}]"> <i style="font-size:11px;color: #616060;">Number of day</i></td>
             <td>{!!($product->stock > 0) ? $product->stock : '<span style="width: 68px" class="label label-danger">Stock Out</span>' !!}</td>
            
            @if($product->affiliate_product || $offer_price < $affiliate_configure->minimum_offer_price)
            <td style="color:red">{{($offer_price < $affiliate_configure->minimum_offer_price) ? 'Not Allow' : 'Already Added'}} </td>
            @else
            <td><a href="javascript:void(0)"  class="btn btn-success btn-sm" onclick="addProduct({{ $product->id }})"><i class="fa fa-plus"></i> Add</a></td>
            @endif
        </tr>
    @endforeach
    <tr><td colspan="15">{{$allproducts->appends(request()->query())->links()}}</td></tr>
@endif