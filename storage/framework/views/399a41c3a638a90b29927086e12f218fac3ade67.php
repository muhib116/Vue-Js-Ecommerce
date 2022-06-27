<?php 
$recent = App\Models\Visitor::where('ip', visitorip())->whereNotNull('product')->first();

?>

<?php if($recent != null): ?>
<?php

$section_number = (count(json_decode($recent->product, true)) < $section->section_number) ? count(json_decode($recent->product, true)) : $section->section_number;
?>
<section class="section" style="max-height:initial !important; <?php echo (!$section->layout_width == 1) ?: 'background:'.$section->background_color; ?>">
  <div class="container" <?php if($section->layout_width != 1): ?> style="background:<?php echo e($section->background_color); ?>;border-radius: 5px; padding:5px;" <?php endif; ?>>
  <div class="row">
	      	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><span class="title" style="color: <?php echo e($section->text_color); ?> !important;"><?php echo e($section->title); ?></span> 
	      	<span class="moreBtn" style="background: linear-gradient(to right, <?php echo e($section->background_color); ?>, #ffffff);border: 1px solid <?php echo e($section->text_color); ?>; box-shadow: 1px 1px 3px -1px <?php echo e($section->text_color); ?>"><a href="<?php echo e(route('recommand')); ?>" style="color: <?php echo e($section->text_color); ?> !important;">See More</a></span>
	      	</div>
  			<?php for($i=0; $i < $section_number; $i++): ?>
  			<?php
  			$products = App\Models\Product::where('status', 'active')->whereNotNull('keyword')->where(function ($query) use($recent) {
          foreach(json_decode($recent->product, true) as $pick){
             $query->orWhere('keyword', 'like', '%' . $pick . '%');
			
          }
       })->selectRaw('id, title,selling_price,discount,discount_type, slug, feature_image,is_b2b,pricing,profit')
			->distinct()->inRandomOrder()->take($section->item_number)->get();

  ?>
  
		
  			<?php if(count($products)>0): ?>
      		<div style="max-height: 395px !important;overflow: hidden; " class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	          	
	          	<div class="clearfix module horizontal">
	                <div class="products-category">
	                    <div class="category-slider-inner products-list yt-content-slider releate-products grid" data-rtl="yes" data-autoplay="no" data-pagination="no" data-delay="4" data-speed="0.6" data-margin="5" data-items_column0="6" data-items_column1="6" data-items_column2="5" data-items_column3="3" data-items_column4="2" data-arrows="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
	                      <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                      <div class="item-inner product-thumb trg transition product-layout">
	                          <?php echo $__env->make('frontend.homepage.products', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	                      </div>
	                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                    </div>
	                </div>
	          	</div>
      		</div>
      		<?php endif; ?>
      		<?php endfor; ?>
    	</div>
  </div>
</section>
<?php endif; ?><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/frontend/homepage/pick-for-you.blade.php ENDPATH**/ ?>