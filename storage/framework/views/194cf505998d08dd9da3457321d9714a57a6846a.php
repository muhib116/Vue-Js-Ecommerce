<?php  

$offers = App\Models\Offer::where('end_date', '>=', now())->orderBy('position', 'asc')->where('status', 1)->take($section->item_number)->get(); 
$feature_exist = null;
?>
<?php if(count($offers)>0): ?>





<section class="showall"  <?php if($section->layout_width == 1): ?> style="background:<?php echo e($section->background_color); ?>;padding: 10px 0 10px;" <?php endif; ?>>
  <div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-1 hidden-xs hidden-sm"></div>
       <div class="col-xs-12 col-md-2 hidden-xs hidden-sm">
											<div class="offer-box">
												<div class="category-slider-inner products-list yt-content-slider releate-products grid owl2-carousel owl2-theme owl2-responsive-1200 owl2-loaded" data-rtl="yes" data-autoplay="yes" data-pagination="no" data-delay="10" data-speed="1" data-margin="5" data-items_column0="1" data-items_column1="1" data-items_column2="1" data-items_column3="1" data-items_column4="1" data-arrows="no" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
													
                                    
                                    
                                    
                                    
                                    
                                  <?php $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <div class="owl2-stage-outer">
														<div class="owl2-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 221px;">
                                  <div class="owl2-item active" style="width: 216px; margin-right: 5px;">
                                                  
                                                  <a class="_2yWGi _3Ln1l" href="<?php echo e(route('offer.details', $offer->slug)); ?>" style="float: right;background-color: #0018a7;">
                                                      
                                                      
                            <div class="WgI_x"> 
                                <img src="<?php echo e(asset('upload/images/offer/thumbnail/'. $offer->thumbnail)); ?>">  
                            </div>
                            <div class="_3Azs_"><span class="_42vxh"><?php echo e(Str::limit($offer->title, 40)); ?></span></div>
                        </a>
                        </div>
                         </div>
													</div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                        
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
           
            <?php $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if($offer->featured == 1): ?>
            
                              <div class="offer_sections">
            <a href="<?php echo e(route('offer.details', $offer->slug)); ?>">
                
                <div class="offer_areass" style="display:block; background: <?php echo e($offer->background_color); ?>">
                    <h1 style="color: rgb(255, 255, 255);margin-bottom: 0;font-size:20px"><?php echo e(Str::limit($offer->title, 40)); ?></h1>
                                        
                                        
                                        
                                        
                                        
                                        
                                       
                                            
                                            
                                            
                                             <?php if(now() <= $offer->start_date): ?>
                                              <div class="liveBtns">
                                            <span style="text-decoration: blink;
    -webkit-animation-name: blinker;
    -webkit-animation-duration: 0.7s;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-timing-function: ease-in-out;
    -webkit-animation-direction: alternate;
"><i class="fa fa-play-circle"></i> Upcomeing</span>
                       
                        <div class="heads" id="offerDate" data-offerdate="<?php echo e(Carbon\Carbon::parse($offer->start_date)->format('m,d,Y H:i:s')); ?>">
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
                        <?php elseif(now() >= $offer->start_date && now() <= $offer->end_date): ?>
                         <div class="liveBtns">
                        <span style="text-decoration: blink;
    -webkit-animation-name: blinker;
    -webkit-animation-duration: 0.7s;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-timing-function: ease-in-out;
    -webkit-animation-direction: alternate;
    "><i class="fa fa-play-circle"></i> Live Now</span>
                       
                        <div class="heads" id="offerDate" data-offerdate="<?php echo e(Carbon\Carbon::parse($offer->end_date)->format('m,d,Y H:i:s')); ?>">
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
                        <?php else: ?>
                        
                         <div class="liveBtn" style="padding: 8px 60px 23px;">Closed <br/> Offer</div>
                        <?php endif; ?>
                        
                        
                    
                    
                    
                    
                    
                    
                                    </div></a>
                <div class="offer-top-productss">
													<div class="row">
														<div class="category-slider-inner products-list yt-content-slider releate-products grid owl2-carousel owl2-theme owl2-responsive-1200 owl2-loaded" data-rtl="yes" data-autoplay="yes" data-pagination="no" data-delay="4" data-speed="0.6" data-margin="5" data-items_column0="6" data-items_column1="6" data-items_column2="4" data-items_column3="3" data-items_column4="2" data-arrows="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
															
                                                                                       
                                               
                                             <?php $offerProducts = App\Models\OfferProduct::with('product:id,title,feature_image')->orderBy('position', 'asc')->where('offer_id', $offer->id)->where('status', 'active')->limit(20)->get(); 
                      ?>
                      <?php if($offerProducts): ?>
                      <?php $__currentLoopData = $offerProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offerProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                 
                                           <div class="item boxx"><a href=<?php echo e(route('offer.details', $offer->slug)); ?>"><img src="<?php echo e(asset('upload/images/product/thumb/'. $offerProduct->product->feature_image)); ?>" title="<?php echo e($offerProduct->product->title); ?>" alt="<?php echo e($offerProduct->product->title); ?>"></a>
															</div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                      
														
														</div>
													</div>
												</div>
											</div>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </div>
       
        <div class="col-xs-12 col-md-2 hidden-xs hidden-sm">
            <div class="offer-box">
                  <div class="category-slider-inner products-list yt-content-slider releate-products grid owl2-carousel owl2-theme owl2-responsive-1200 owl2-loaded" data-rtl="yes" data-autoplay="yes" data-pagination="no" data-delay="10" data-speed="1" data-margin="5" data-items_column0="1" data-items_column1="1" data-items_column2="1" data-items_column3="1" data-items_column4="1" data-arrows="no" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
                                            
                                      <?php $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  
                                   <div class="owl2-stage-outer">
                                          
                                          <div class="owl2-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 221px;">
                                              
                                              <div class="owl2-item active" style="margin-right: 5px;">
                                                  
                                                  <a class="_2yWGi _3Ln1l" href="<?php echo e(route('offer.details', $offer->slug)); ?>" style="float: right;background-color: #0018a7;">
                                                      
                                                      
                            <div class="WgI_x"> 
                                <img src="<?php echo e(asset('upload/images/offer/thumbnail/'. $offer->thumbnail)); ?>">  
                            </div>
                            <div class="_3Azs_"><span class="_42vxh"><?php echo e(Str::limit($offer->title, 40)); ?></span></div>
                        </a></div></div></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                                      
                                     
                        
                        <div class="owl2-controls"><div class="owl2-nav"><div class="owl2-prev" style="display: none;"><i class="fa fa-angle-left"></i></div><div class="owl2-next" style="display: none;"><i class="fa fa-angle-right"></i></div></div><div class="owl2-dots" style="display: none;"></div></div></div>
              </div>
        </div>
        <div class="col-xs-12 col-md-1 hidden-xs hidden-sm"></div>
    </div>
  </div>
</section>

<?php endif; ?><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/frontend/homepage/offers.blade.php ENDPATH**/ ?>