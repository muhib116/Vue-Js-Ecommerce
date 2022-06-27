@foreach($offer_products as $index => $product)
@if($offer->offer_type == 'quiz')
<div class="product-layout col-lg-3 col-md-3 col-sm-4 col-xs-6">
    <div class="product-item-container">
        <div class="box-label">
            <span class="label-sale">Prize {{$index+1}}</span>
        </div>
        <div class="left-block">
            <div class="product-image-container">
                <a href="{{route('quizPurchase', $offer->slug)}}" >
                <img src="{{asset('upload/images/product/'. $product->feature_image)}}" alt="{{$product->title}}" class="img-1 img-responsive">
                </a>
                <span class="quickview iframe-link visible-lg btn-button" data-toggle="tooltip" title="" data-fancybox-type="iframe" href="{{route('quickview', $product->slug)}}?type=quickview" data-original-title="Quickview "> <i class="fa fa-search"></i> </span>
            </div>
        </div> 
        <div class="right-block">
            <div class="caption">
                <h4><a href="{{route('quizPurchase', $offer->slug)}}">{{Str::limit($product->title, 40)}}</a></h4>
                <div class="total-price clearfix">
                    <div class="price price-left">
                        
                        <?php
                        $selling_price = $product->selling_price;
                        $discount = $product->discount;
                        $discount_type = $product->discount_type;
                        
                        if($discount_type == '%'){
                            $price = $selling_price - ( $discount * $selling_price) / 100; 
                        }elseif($discount_type == 'fixed'){
                            $price = $discount;
                            $discount = $selling_price - $discount;
                            //make persentage
                            $discount = round(((($selling_price-$discount) - $selling_price)/$selling_price) * 100);
                          
                        }else{
                            $price = $selling_price - $discount;
                            //make persentage
                            $discount = round(((($selling_price-$discount) - $selling_price)/$selling_price) * 100);
                        }
                        ?>
                       @if($discount)
                            <span class="price-new">{{Config::get('siteSetting.currency_symble')}}{{ $price }}</span>
                            <span class="price-old">{{Config::get('siteSetting.currency_symble')}}{{ round($selling_price) }}</span>
                        @else
                            <span class="price-new">{{Config::get('siteSetting.currency_symble')}}{{$selling_price}}</span>
                        @endif
                        </div>
                       
                        <div class="price-sale price-right">
                            <span class="discount">
                            Prize
                            <strong>{{$index+1}}</strong>
                          </span>
                        </div>
                        
                </div>
            </div>
            <div class="button-group2" style="padding:0">

            <a style="display: block;padding: 5px;font-weight: 600; width: 100%;background: #0397d3;color: #fff;" href="{{ route('quizPurchase', $offer->slug) }}"> Purchase Quiz</a>
          </div>
        </div>
    </div>
</div>
@else
<div class="product-layout col-lg-3 col-md-3 col-sm-4 col-xs-6">
    <div class="product-item-container">
        <div class="left-block">
            <div class="product-image-container">
                <a href="{{ route('product_details', $product->slug) }}?offer={{$offer->slug}}" >
                <img src="{{asset('upload/images/product/thumb/'. $product->feature_image)}}" alt="{{$product->title}}" class="img-1 img-responsive">
                </a>
                 <span class="quickview iframe-link visible-lg btn-button" data-toggle="tooltip" title="" data-fancybox-type="iframe" href="{{route('quickview', $product->slug)}}?type=quickview&offer={{$offer->slug}}" data-original-title="Quickview "> <i class="fa fa-search"></i> </span>
                @if($product->stock <= 0)
                <div class="box-label">
                <span class="label-sale">Sold Out</span>
                </div>
                @endif
            </div>
        </div> 
        <div class="right-block">
            <div class="caption">
                <h4><a href="{{ route('product_details', $product->slug) }}?offer={{$offer->slug}}">{{Str::limit($product->title, 40)}}</a></h4>
                <div class="total-price clearfix">
                    <div class="price price-left">
                         <label for="ratting5">{{\App\Http\Controllers\HelperController::ratting(round($product->reviews->avg('ratting'), 1))}}</label><br/>
                        <?php
                        $selling_price = $product->selling_price;
                        $discount = $product->discount;
                        $discount_type = $product->discount_type;
                        
                        if($discount_type == '%'){
                            $price = $selling_price - ( $discount * $selling_price) / 100; 
                        }elseif($discount_type == 'fixed'){
                            $price = $discount;
                            $discount = $selling_price - $discount;
                            //make persentage
                            $discount = round(((($selling_price-$discount) - $selling_price)/$selling_price) * 100);
                          
                        }else{
                            $price = $selling_price - $discount;
                            //make persentage
                            $discount = round(((($selling_price-$discount) - $selling_price)/$selling_price) * 100);
                        }
                        ?>

                       @if($discount)
                            <span class="price-new">{{Config::get('siteSetting.currency_symble')}}{{ $price }}</span>
                            <span class="price-old">{{Config::get('siteSetting.currency_symble')}}{{ round($selling_price) }}</span>
                        @else
                            <span class="price-new">{{Config::get('siteSetting.currency_symble')}}{{$selling_price}}</span>
                        @endif
                        </div>
                        @if($discount)
                        <div class="price-sale price-right">
                            <span class="discount">
                              @if($discount_type == '%')-@endif{{$discount}}%
                            <strong>OFF</strong>
                          </span>
                        </div>
                        @endif
						
						
						<div class="price-right" style="display: inline-block;">
						 
						
						
						  
						   <span class="btn btn-warning btn-lg" onclick="addcart('{{$product->id}}')" data-toggle="tooltip" title="Add to cart" data-original-title="{{str_replace('-', ' ', $product->product_type ?? 'Add to cart')}}"> <i class="fa fa-shopping-cart"></i> </span>
						  
						  
                        
								
							
</div>
								
                </div>
            </div>
            
        </div>
    </div>
</div>
@endif
@endforeach

<script type="text/javascript">
	

     function addcart(id){
          
          $.ajax({
            url:'{{route("cart.add")}}',
            type:'get',
           data: {product_id: id, offer: "{{$offer->slug}}"},
            success:function(data){
                if(data.status == 'success'){
					
					
					
                    var url = window.location.origin;
                    addProductNotice(data.msg, '<img src="'+url+'/upload/images/product/thumb/'+data.image+'" alt="">', '<h3>'+data.title+'</h3>', 'success');
       
                    
                    $('.cartCount').html(Number($('.cartCount').html())+1);
                   
                }else{
                    toastr.error(data.msg);
                }
              }
          });
      }
</script>
