<?php  
$products = App\Models\Product::whereIn('id', explode(',', $section->product_id))->where('is_b2b', 0)->where('status', 'active')->selectRaw('id,title,selling_price,discount,discount_type, slug, feature_image, is_b2b')->orderBy('id', 'desc')->take($section->item_number)->get();
?>
@if(count($products)>0)
<section class="showall" style=" padding:0;margin:1em 0;" >

  <div class="container" style="border-radius: 5px; padding: 5px;">
   <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background:{{$section->background_color}};display: block;margin: 0;padding: 10px;display: flex;justify-content: space-between;align-items: center;">
        <h4 style="color:{{$section->text_color}};margin: 0;">{{$section->title}}</h4>
											<div class="col -df -j-end -fsh0"> <a href="{{route('moreProducts', $section->slug)}}" class="-df -i-ctr -upp -m -mls -pvxs">See All <i class="fa fa-chevron-right" aria-hidden="true"></i></a> </div>
    </div>										</div>  
       
       
       
       
    <div class="row" style="margin-bottom: 1.5em;background: rgb(255, 255, 255);">   
    
    
    
    @if($section->thumb_image && $section->image_position == 'left')
      <div class="col-md-3">
        <div style="background: #fff;padding: 5px">
          <img style="width: 100%;height: 100%;" src="{{ asset('upload/images/homepage/'.$section->thumb_image) }}" alt="{{$section->title}}">
        </div>
      </div>
      @endif
    
    
    <div class="col-lg-{{($section->thumb_image) ? 9 : 12}} col-md-{{($section->thumb_image) ? 9 : 12}} col-sm-12 col-xs-12">
					<div class="clearfix module horizontal">
												<div class="products-category">
                        <div class="category-slider-inner products-list yt-content-slider releate-products grid" data-rtl="yes" data-autoplay="yes" data-pagination="no" data-delay="4" data-speed="0.6" data-margin="5" @if($section->thumb_image) data-items_column0="5" data-items_column1="4" data-items_column2="3" data-items_column3="2" data-items_column4="1"' @else 'data-items_column0="6" data-items_column1="6" data-items_column2="4" data-items_column3="3" data-items_column4="2" @endif data-arrows="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes"> 
                            
                          @foreach($products as $product)
                        
								<div class="item-inner product-thumb trg transition product-layout">
                              @include('frontend.homepage.products')
                          </div>
                         
                          @endforeach
                       
									</div>
                                        </div>
                    </div>
    </div>   
       
      @if($section->thumb_image && $section->image_position == 'right')
        <div class="col-md-3">
          <div style="background: #fff;padding: 5px">
            <img style="width: 100%;height: 100%;" src="{{ asset('upload/images/homepage/'.$section->thumb_image) }}" alt="{{$section->title}}">
          </div>
        </div>
        @endif  
       
    </div>   
       
    </div>
								</div>
							</section>

@endif