<?php  
$products = App\Models\Product::where('status', 'active')
->selectRaw('products.id,title,selling_price,discount, discount_type, slug, feature_image,is_b2b,pricing,profit')->whereRaw('id IN (select MAX(id) FROM products GROUP BY category_id)')->orderBy('selling_price', 'desc')->take($section->item_number)->get(); 
?>
<?php if(count($products)>0): ?>
<section class="section" <?php if($section->layout_width == 1): ?> style="background:<?php echo e($section->background_color); ?>" <?php endif; ?>>
  <div class="container" <?php if($section->layout_width != 1): ?> style="background:<?php echo e($section->background_color); ?>;border-radius: 5px; padding:5px;" <?php endif; ?>>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
          <span class="title" style="color: <?php echo e($section->text_color); ?> !important;"><?php echo e($section->title); ?></span> 
          <!-- <span class="moreBtn" style="border: 1px solid <?php echo e($section->text_color); ?>;"><a href="<?php echo e(route('moreProducts', $section->slug)); ?>" style="color: <?php echo e($section->text_color); ?> !important;">See More</a></span> -->
            <div class="clearfix module horizontal">
                  <div class="products-category">
                      <div class="category-slider-inner products-list yt-content-slider releate-products grid" data-rtl="yes" data-autoplay="yes" data-pagination="no" data-delay="7" data-speed="0.6" data-margin="5" data-items_column0="6" data-items_column1="6" data-items_column2="5" data-items_column3="3" data-items_column4="2" data-arrows="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item-inner product-thumb trg transition product-layout">
                            <?php echo $__env->make('frontend.homepage.products', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </div>
                  </div>
            </div>
        </div>
      </div>
  </div>
</section>
<?php endif; ?><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/frontend/homepage/top-ratted.blade.php ENDPATH**/ ?>