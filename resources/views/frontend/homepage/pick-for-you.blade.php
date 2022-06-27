@php 
$recent = App\Models\Visitor::where('ip', visitorip())->whereNotNull('product')->first();

@endphp

@if($recent != null)
@php

$section_number = (count(json_decode($recent->product, true)) < $section->section_number) ? count(json_decode($recent->product, true)) : $section->section_number;
@endphp
<section class="section" style="max-height:initial !important; {!! (!$section->layout_width == 1) ?: 'background:'.$section->background_color !!}">
  <div class="container" @if($section->layout_width != 1) style="background:{{$section->background_color}};border-radius: 5px; padding:5px;" @endif>
  <div class="row">
	      	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><span class="title" style="color: {{$section->text_color}} !important;">{{$section->title}}</span> 
	      	<span class="moreBtn" style="background: linear-gradient(to right, {{$section->background_color}}, #ffffff);border: 1px solid {{$section->text_color}}; box-shadow: 1px 1px 3px -1px {{$section->text_color}}"><a href="{{route('recommand')}}" style="color: {{$section->text_color}} !important;">See More</a></span>
	      	</div>
  			@for($i=0; $i < $section_number; $i++)
  			@php
  			$products = App\Models\Product::where('status', 'active')->whereNotNull('keyword')->where(function ($query) use($recent) {
          foreach(json_decode($recent->product, true) as $pick){
             $query->orWhere('keyword', 'like', '%' . $pick . '%');
			
          }
       })->selectRaw('id, title,selling_price,discount,discount_type, slug, feature_image,is_b2b,pricing,profit')
			->distinct()->inRandomOrder()->take($section->item_number)->get();

  @endphp
  
		
  			@if(count($products)>0)
      		<div style="max-height: 395px !important;overflow: hidden; " class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	          	
	          	<div class="clearfix module horizontal">
	                <div class="products-category">
	                    <div class="category-slider-inner products-list yt-content-slider releate-products grid" data-rtl="yes" data-autoplay="no" data-pagination="no" data-delay="4" data-speed="0.6" data-margin="5" data-items_column0="6" data-items_column1="6" data-items_column2="5" data-items_column3="3" data-items_column4="2" data-arrows="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
	                      @foreach($products as $product)
	                      <div class="item-inner product-thumb trg transition product-layout">
	                          @include('frontend.homepage.products')
	                      </div>
	                      @endforeach
	                    </div>
	                </div>
	          	</div>
      		</div>
      		@endif
      		@endfor
    	</div>
  </div>
</section>
@endif