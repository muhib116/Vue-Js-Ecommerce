<?php  
$from_date = Carbon\Carbon::parse(now())->subDays(30)->format('Y-m-d')." 00:00:00";
$products = App\Models\Product::join('order_details', 'products.id', 'order_details.product_id')
  ->selectRaw('products.id, title,selling_price,discount,discount_type,slug,feature_image,products.is_b2b,pricing,profit,count(order_details.product_id) as total_sale')
  ->whereDate('order_details.created_at', '>=', $from_date)
  ->where('status', 'active')
  ->orderBy('total_sale', 'desc')
  ->groupBy('products.subcategory_id')
  ->take($section->item_number)->get();
?>
<?php if(count($products)>0): ?>
<section class="showall" style=" padding:0;margin:1em 0;" >

  <div class="container" style="border-radius: 5px; padding: 5px;">
   <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background:<?php echo e($section->background_color); ?>;display: block;margin: 0;padding: 10px;display: flex;justify-content: space-between;align-items: center;">
        <h4 style="color:<?php echo e($section->text_color); ?>;margin: 0;"><?php echo e($section->title); ?></h4>
										
    </div>										</div>  
       
       
       
       
    <div class="row" style="margin-bottom: 1.5em;background: rgb(255, 255, 255);">   
    
    
    
    <?php if($section->thumb_image && $section->image_position == 'left'): ?>
      <div class="col-md-3">
        <div style="background: #fff;padding: 5px">
          <img style="width: 100%;height: 100%;" src="<?php echo e(asset('upload/images/homepage/'.$section->thumb_image)); ?>" alt="<?php echo e($section->title); ?>">
        </div>
      </div>
      <?php endif; ?>
    
    
    <div class="col-lg-<?php echo e(($section->thumb_image) ? 9 : 12); ?> col-md-<?php echo e(($section->thumb_image) ? 9 : 12); ?> col-sm-12 col-xs-12">
					<div class="clearfix module horizontal">
												<div class="products-category">
                        <div class="category-slider-inner products-list yt-content-slider releate-products grid" data-rtl="yes" data-autoplay="yes" data-pagination="no" data-delay="4" data-speed="0.6" data-margin="5" <?php if($section->thumb_image): ?> data-items_column0="5" data-items_column1="4" data-items_column2="3" data-items_column3="2" data-items_column4="1"' <?php else: ?> 'data-items_column0="6" data-items_column1="6" data-items_column2="4" data-items_column3="3" data-items_column4="2" <?php endif; ?> data-arrows="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">  
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item-inner product-thumb trg transition product-layout">
                        <?php echo $__env->make('frontend.homepage.products', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                                        </div>
                    </div>
    </div>   
       
      <?php if($section->thumb_image && $section->image_position == 'right'): ?>
        <div class="col-md-3">
          <div style="background: #fff;padding: 5px">
            <img style="width: 100%;height: 100%;" src="<?php echo e(asset('upload/images/homepage/'.$section->thumb_image)); ?>" alt="<?php echo e($section->title); ?>">
          </div>
        </div>
        <?php endif; ?>  
       
    </div>   
       
    </div>
								</div>
							</section>
<?php endif; ?><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/frontend/homepage/best-selling.blade.php ENDPATH**/ ?>