
<?php $__env->startSection('title', $section->title); ?>

<?php $__env->startSection('content'); ?>
    <!-- Main Container  -->
    <div class="breadcrumbs">
        <div class="container">
            
            <ul class="breadcrumb-cate">
                <li><a href="<?php echo e(url('/')); ?>"><i class="fa fa-home"></i> </a></li>
                <li><a href="#"><?php echo e($section->title); ?></a></li>
            </ul>
        </div>
    </div>
    
    <div class="container product-detail">
     
        <div class="row">
          <div class="col-sm-12">
          <div class="banners">
            <div>
              <a href="#">
              <img src="<?php echo e(asset('frontend')); ?>/image/catalog/demo/category/electronic-cat.png" alt="Apple Cinema 30&quot;">
              </a>
            </div>
          </div>
          </div>
        </div>
        <?php $related_products = App\Models\Product::whereNotIn('id', explode(',', $section->product_id))->where('subcategory_id', $products[0]->subcategory_id)->orderBy('id', 'desc')->paginate(5);
            ?>
        <div class="row">
           <?php if(count($products)>0): ?>
            <div id="content" class="col-md-<?php echo e(count($related_products)>0 ? 9 : 12); ?> col-sm-9 col-xs-12 sticky-content" >
                <div class="products-category">
                  <div class="products-list grid row number-col-6 so-filter-gird">
                      <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="product-layout col-md-<?php echo e(count($related_products)>0 ? 3 : 2); ?> col-sm-4 col-xs-6">
                          <?php echo $__env->make('frontend.homepage.products', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                      </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>

                  <div class="product-filter product-filter-bottom filters-panel">
                      <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                         <?php echo e($products->appends(request()->query())->links()); ?>

                        </div>
                      <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing <?php echo e($products->firstItem()); ?> to <?php echo e($products->lastItem()); ?> of total <?php echo e($products->total()); ?> entries (<?php echo e($products->lastPage()); ?> Pages)</div>
                  </div>
                </div>
            </div>
           
            <?php if(count($related_products)>0): ?>
            <div class="col-md-3 sticky-content">
              <div class="moduletable module so-extraslider-ltr best-seller best-seller-custom">
                <h3 class="modtitle"><span>Related products</span></h3>
                <div class="modcontent">
                  <div id="so_extra_slider" class="so-extraslider buttom-type1 preset00-1 preset01-1 preset02-1 preset03-1 preset04-1 button-type1">
                    <div class="extraslider-inner " >
                        <div class="item ">
                          <?php $__currentLoopData = $related_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <div class="item-wrap style1 ">
                            <div class="item-wrap-inner">
                             <div class="media-left">
                              <div class="item-image">
                                 <div class="item-img-info product-image-container ">
                                  <div class="box-label">
                                  </div>
                                  <a class="lt-image" data-product="66" href="<?php echo e(route('product_details', $related_product->slug)); ?>" >
                                  <img src="<?php echo e(asset('upload/images/product/thumb/'. $related_product->feature_image)); ?>" alt="">
                                  </a>
                                 </div>
                              </div>
                             </div>
                             <div class="media-body">
                              <div class="item-info">
                                 <!-- Begin title -->
                                 <div class="item-title">
                                  <a href="<?php echo e(route('product_details', $related_product->slug)); ?>" target="_self">
                                 <?php echo e(Str::limit($related_product->title, 20)); ?>

                                  </a>
                                 </div>
                                 
                                 <div class="price  price-left" style="font-size: 12px;">
                                  <!-- Begin ratting -->
                                 <div>
                                 <?php echo e(\App\Http\Controllers\HelperController::ratting(round($related_product->reviews->avg('ratting'), 1))); ?>

                                 </div>
                                  <?php  
                                      $discount = null;
                                      $selling_price = $product->selling_price;
                                      $discount = ($product->discount) ? $product->discount : null;
                                      $discount_type = $product->discount_type;
                                      if($discount){
                                      $calculate_discount = App\Http\Controllers\HelperController::calculate_discount($selling_price, $discount, $discount_type );
                                    }
                                  ?>
                                    <?php if($discount): ?>
                                        <span class="price-new"><?php echo e(Config::get('siteSetting.currency_symble')); ?><?php echo e($calculate_discount['price']); ?></span>
                                        <span class="price-old"><?php echo e(Config::get('siteSetting.currency_symble')); ?><?php echo e($selling_price); ?></span>
                                    <?php else: ?>
                                        <span class="price-new"><?php echo e(Config::get('siteSetting.currency_symble')); ?><?php echo e($selling_price); ?></span>
                                    <?php endif; ?>
                                </div>

                                <?php if($discount): ?>
                                <div class="price-sale price-right">
                                    <span class="discount">
                                      <?php if($discount_type == '%'): ?>-<?php endif; ?><?php echo e($calculate_discount['discount']); ?>%
                                    <strong>OFF</strong>
                                  </span>
                                </div>
                                <?php endif; ?>
                              </div>
                             </div>
                             <!-- End item-info -->
                            </div>
                            <!-- End item-wrap-inner -->
                          </div>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                  </div>
                </div>
             </div>
            </div>
            <?php endif; ?>
          <?php else: ?>
            <div style="text-align: center;">
                <i style="font-size: 80px;" class="fa fa-shopping-cart"></i>
                <h1>Sorry Products Not Found!!.</h1>
               
                Click here <a href="<?php echo e(url('/')); ?>">Continue Shopping</a>
            </div>
          <?php endif; ?>
        </div>
    </div>
    
 <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/frontend/homepage/moreProducts.blade.php ENDPATH**/ ?>