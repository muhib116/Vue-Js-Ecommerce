@if(count($allproducts)>0)
    @foreach($allproducts as $index => $product) 
        <tr @if($product->agentProduct) style="background: #ffe2e2" @else id="product{{  $product->product_id }}" @endif>
             <td style="text-align: center;">@if(!$product->agentProduct)<input type="checkbox" class="product_id" name="product_id[{{  $product->product_id }}]" > @endif<p> {{(($allproducts->perPage() * $allproducts->currentPage() - $allproducts->perPage()) + ($index+1) )}}</p></td>
            <td><a style="color: #000" target="_blank" href="{{ route('product_details', $product->slug) }}"><img width="35" src="{{ asset('upload/images/product/thumb/'. $product->feature_image)}}"> {{Str::limit($product->title, 40)}}</a></td>
            <td>{{ Config::get('siteSetting.currency_symble') . $product->office_rate }}</td>
            
            <td>
                @if($product->agentProduct)
                {{Config::get('siteSetting.currency_symble') . $product->agentProduct->agent_price}}
                @else
                <p class="commissionStatus" id="commissionStatus{{$product->product_id}}"></p>
                <input type="number" min="1" class="form-control" onkeyup ="commissionCalculate({{$product->product_id}}, {{$product->office_rate}}, {{round($product->selling_price)}}, this.value)" value="{{round( $product->selling_price)}}" id="agent_rate{{ $product->product_id }}" name="agent_rate[{{ $product->product_id }}]">
                <i style="font-size:10px;color: #616060;">Price >=  {{Config::get('siteSetting.currency_symble') . round($product->office_rate) }}   And <=   {{ Config::get('siteSetting.currency_symble') . round($product->selling_price)}}</i>
                @endif
            </td>
            <td id="commission{{ $product->product_id }}">{{ Config::get('siteSetting.currency_symble') . ($product->selling_price - $product->office_rate)}}</td>

            <td>{!!($product->stock > 0) ? $product->stock : '<span style="width: 68px" class="label label-danger">Stock Out</span>' !!}</td>
            <td>
                @php $current_date = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', date('Y-m-d'. ' 00:00:00')); 
                $end_date = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', Carbon\Carbon::parse($product->created_at)->addDays($product->day)->format('Y-m-d'. ' 00:00:00')); 
                $diff_in_days = $current_date->diffInDays($end_date);
                @endphp
               {{($diff_in_days )}} Days
            </td>
            @if($product->agentProduct)
            <td><a href="javascript:void(0)" title="Alreay Added" style="color:red">Alreay Added</a></td>
            @else
             <td><a href="javascript:void(0)"  class="btn btn-success btn-sm" onclick="addProduct({{ $product->product_id }})"><i class="fa fa-plus"></i> Add</a></td>
            @endif
        </tr>
    @endforeach
    <tr><td colspan="15">{{$allproducts->appends(request()->query())->links()}}</td></tr>
@endif