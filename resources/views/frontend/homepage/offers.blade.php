<?php  

$offers = App\Models\Offer::where('end_date', '>=', now())->orderBy('position', 'asc')->where('status', 1)->take($section->item_number)->get(); 
$feature_exist = null;
?>
@if(count($offers)>0)





<section class="showall"  @if($section->layout_width == 1) style="background:{{$section->background_color}};padding: 10px 0 10px;" @endif>
  <div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-1 hidden-xs hidden-sm"></div>
       <div class="col-xs-12 col-md-2 hidden-xs hidden-sm">
											<div class="offer-box">
												<div class="category-slider-inner products-list yt-content-slider releate-products grid owl2-carousel owl2-theme owl2-responsive-1200 owl2-loaded" data-rtl="yes" data-autoplay="yes" data-pagination="no" data-delay="10" data-speed="1" data-margin="5" data-items_column0="1" data-items_column1="1" data-items_column2="1" data-items_column3="1" data-items_column4="1" data-arrows="no" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
													
                                    
                                    
                                    
                                    
                                    
                                  @foreach($offers as $offer)
                                  <div class="owl2-stage-outer">
														<div class="owl2-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 221px;">
                                  <div class="owl2-item active" style="width: 216px; margin-right: 5px;">
                                                  
                                                  <a class="_2yWGi _3Ln1l" href="{{route('offer.details', $offer->slug)}}" style="float: right;background-color: #0018a7;">
                                                      
                                                      
                            <div class="WgI_x"> 
                                <img src="{{asset('upload/images/offer/thumbnail/'. $offer->thumbnail)}}">  
                            </div>
                            <div class="_3Azs_"><span class="_42vxh">{{Str::limit($offer->title, 40)}}</span></div>
                        </a>
                        </div>
                         </div>
													</div>
                    @endforeach  
                        
													<div class="owl2-controls">
														<div class="owl2-nav">
															<div class="owl2-prev" style="display: none;"><i class="fa fa-angle-left"></i></div>
															<div class="owl2-next" style="display: none;"><i class="fa fa-angle-right"></i></div>
														</div>
														<div class="owl2-dots" style="display: none;"></div>
													</div>
												</div>
											</div>
										</div>
        <div class="col-xs-12 col-md-6">
           
            @foreach($offers as $offer)
          @if($offer->featured == 1)
            
                              <div class="offer_sections">
            <a href="{{route('offer.details', $offer->slug)}}">
                
                <div class="offer_areass" style="display:block; background: {{ $offer->background_color }}">
                    <h1 style="color: rgb(255, 255, 255);margin-bottom: 0;font-size:20px">{{Str::limit($offer->title, 40)}}</h1>
                                        
                                        
                                        
                                        
                                        
                                        
                                       
                                            
                                            
                                            
                                             @if(now() <= $offer->start_date)
                                              <div class="liveBtns">
                                            <span style="text-decoration: blink;
    -webkit-animation-name: blinker;
    -webkit-animation-duration: 0.7s;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-timing-function: ease-in-out;
    -webkit-animation-direction: alternate;
"><i class="fa fa-play-circle"></i> Upcomeing</span>
                       
                        <div class="heads" id="offerDate" data-offerdate="{{Carbon\Carbon::parse($offer->start_date)->format('m,d,Y H:i:s')}}">
                            <div class="count">
                              <div class="count_dd">
                            <span id="days">00</span><p>Days</p>
                            </div>
                            <div class="count_dd">
                            <span id="hour">00</span><p>Hours</p>
                            </div>
                            <div class="count_dd">
                            <span id="minutes">00</span><p>Minuts</p>
                            </div>
                            <div class="count_dd">
                            <span id="seconds">00</span><p>Seconds</p>
                            </div>
                            </div>
                        </div>
                        </div>
                        @elseif(now() >= $offer->start_date && now() <= $offer->end_date)
                         <div class="liveBtns">
                        <span style="text-decoration: blink;
    -webkit-animation-name: blinker;
    -webkit-animation-duration: 0.7s;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-timing-function: ease-in-out;
    -webkit-animation-direction: alternate;
    "><i class="fa fa-play-circle"></i> Live Now</span>
                       
                        <div class="heads" id="offerDate" data-offerdate="{{Carbon\Carbon::parse($offer->end_date)->format('m,d,Y H:i:s')}}">
                            <div class="count">
                              <div class="count_dd">
                            <span id="days">00</span><p>Days</p>
                            </div>
                            <div class="count_dd">
                            <span id="hour">00</span><p>Hours</p>
                            </div>
                            <div class="count_dd">
                            <span id="minutes">00</span><p>Minuts</p>
                            </div>
                            <div class="count_dd">
                            <span id="seconds">00</span><p>Seconds</p>
                            </div>
                            </div>
                        </div>
                        
                        </div>
                        @else
                        
                         <div class="liveBtn" style="padding: 8px 60px 23px;">Closed <br/> Offer</div>
                        @endif
                        
                        
                    
                    
                    
                    
                    
                    
                                    </div></a>
                <div class="offer-top-productss">
													<div class="row">
														<div class="category-slider-inner products-list yt-content-slider releate-products grid owl2-carousel owl2-theme owl2-responsive-1200 owl2-loaded" data-rtl="yes" data-autoplay="yes" data-pagination="no" data-delay="4" data-speed="0.6" data-margin="5" data-items_column0="6" data-items_column1="6" data-items_column2="4" data-items_column3="3" data-items_column4="2" data-arrows="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
															
                                                                                       
                                               
                                             @php $offerProducts = App\Models\OfferProduct::with('product:id,title,feature_image')->orderBy('position', 'asc')->where('offer_id', $offer->id)->where('status', 'active')->limit(20)->get(); 
                      @endphp
                      @if($offerProducts)
                      @foreach($offerProducts as $offerProduct) 
                 
                                           <div class="item boxx"><a href={{route('offer.details', $offer->slug)}}"><img src="{{asset('upload/images/product/thumb/'. $offerProduct->product->feature_image)}}" title="{{$offerProduct->product->title}}" alt="{{$offerProduct->product->title}}"></a>
															</div>
                        @endforeach
                        @endif
                      
														
														</div>
													</div>
												</div>
											</div>
                                    @endif
                                    @endforeach
                                      </div>
       
        <div class="col-xs-12 col-md-2 hidden-xs hidden-sm">
            <div class="offer-box">
                  <div class="category-slider-inner products-list yt-content-slider releate-products grid owl2-carousel owl2-theme owl2-responsive-1200 owl2-loaded" data-rtl="yes" data-autoplay="yes" data-pagination="no" data-delay="10" data-speed="1" data-margin="5" data-items_column0="1" data-items_column1="1" data-items_column2="1" data-items_column3="1" data-items_column4="1" data-arrows="no" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
                                            
                                      @foreach($offers as $offer)
                                  
                                   <div class="owl2-stage-outer">
                                          
                                          <div class="owl2-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 221px;">
                                              
                                              <div class="owl2-item active" style="margin-right: 5px;">
                                                  
                                                  <a class="_2yWGi _3Ln1l" href="{{route('offer.details', $offer->slug)}}" style="float: right;background-color: #0018a7;">
                                                      
                                                      
                            <div class="WgI_x"> 
                                <img src="{{asset('upload/images/offer/thumbnail/'. $offer->thumbnail)}}">  
                            </div>
                            <div class="_3Azs_"><span class="_42vxh">{{Str::limit($offer->title, 40)}}</span></div>
                        </a></div></div></div>
                    @endforeach  
                                      
                                     
                        
                        <div class="owl2-controls"><div class="owl2-nav"><div class="owl2-prev" style="display: none;"><i class="fa fa-angle-left"></i></div><div class="owl2-next" style="display: none;"><i class="fa fa-angle-right"></i></div></div><div class="owl2-dots" style="display: none;"></div></div></div>
              </div>
        </div>
        <div class="col-xs-12 col-md-1 hidden-xs hidden-sm"></div>
    </div>
  </div>
</section>

@endif