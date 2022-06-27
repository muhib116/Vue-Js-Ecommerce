<?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php if(count($subcategory->productsBySubcategory)>0): ?>
	<section class="section">
	  <div class="container" style="border-radius: 3px;padding: 5px;">
	    <div class="row">
	      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	            <span class="title"><?php echo e($subcategory->name); ?></span> 
	            <span class="moreBtn" style="background: hsl(87, 60%, 40%);border: 1px solid #000; box-shadow: 1px 1px 3px -1px #fff"><a href="<?php echo e(route('home.category', [$category->slug, $subcategory->slug])); ?>" style="color:#fff;padding: 5px 20px;">View all</a></span>
	               
	                <div class="clearfix module horizontal">
	                    <div class="products-category">
	                        <div class="category-slider-inner products-list yt-content-slider releate-products grid" data-rtl="yes" data-autoplay="yes" data-pagination="no" data-delay="4" data-speed="0.6" data-margin="5" data-items_column0="5" data-items_column1="5" data-items_column2="4" data-items_column3="3" data-items_column4="2" data-arrows="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
	                          <?php $__currentLoopData = $subcategory->productsBySubcategory->take(7); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                          <div  class="item-inner product-thumb trg transition product-layout">
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
	<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/frontend/products/productsBySubcategory.blade.php ENDPATH**/ ?>