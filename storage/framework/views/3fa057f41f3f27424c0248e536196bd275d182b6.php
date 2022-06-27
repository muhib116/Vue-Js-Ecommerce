<?php  
$products = App\Models\Product::where('status', 'active')->where('product_type', 'pre-order')
  ->selectRaw('id,title,selling_price,discount,discount_type,slug,feature_image,is_b2b,pricing,profit')
  ->orderBy('id', 'desc')
  ->take($section->item_number)
  ->get();
?>
<?php if(count($products)>0): ?>
<section class="section" <?php if($section->layout_width == 1): ?> style="background:<?php echo e($section->background_color); ?>" <?php endif; ?>>
  <div class="container" <?php if($section->layout_width != 1): ?> style="background:<?php echo e($section->background_color); ?>;border-radius: 5px; padding:5px;" <?php endif; ?>>
   
    <span class="title" style="color: <?php echo e($section->text_color); ?> !important;"><?php echo e($section->title); ?></span> 
    <span class="moreBtn" style="background: linear-gradient(to right, <?php echo e($section->background_color); ?>, #ffffff);border: 1px solid <?php echo e($section->text_color); ?>; box-shadow: 1px 1px 3px -1px <?php echo e($section->text_color); ?>"><a href="<?php echo e(url($section->slug)); ?>" style="color: <?php echo e($section->text_color); ?> !important;">See More</a></span>
    <div class="row">
      <?php if($section->thumb_image && $section->image_position == 'left'): ?>
      <div class="col-md-3">
        <div style="background: #fff;padding: 5px">
          <img style="width: 100%;height: 100%;" src="<?php echo e(asset('upload/images/homepage/'.$section->thumb_image)); ?>" alt="<?php echo e($section->title); ?>">
        </div>
      </div>
      <?php endif; ?>
      <div class="col-md-<?php echo e(($section->thumb_image) ? 9 : 12); ?> col-xs-12">
          <div class="clearfix module horizontal">
              <div class="products-category">
                  <div class="category-slider-inner products-list yt-content-slider releate-products grid" data-rtl="yes" data-autoplay="no" data-pagination="no" data-delay="1" data-speed="1.5" data-margin="5" data-items_column0="6" data-items_column1="<?php echo e(($section->thumb_image) ? 4 : 6); ?>" data-items_column2="<?php echo e(($section->thumb_image) ? 4 : 6); ?>" data-items_column3="3" data-items_column4="2" data-arrows="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
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
</section>
<?php endif; ?><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/frontend/homepage/pre-order.blade.php ENDPATH**/ ?>