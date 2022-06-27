
<?php $__env->startSection('title', 'Today Deals  | '. Config::get('siteSetting.site_name') ); ?>
<?php $__env->startSection('content'); ?>
    <!-- Main Container  -->
    <div class="breadcrumbs">
        <div class="container">
            
            <ul class="breadcrumb-cate">
                <li><a href="<?php echo e(url('/')); ?>"><i class="fa fa-home"></i> </a></li>
                <li>Today Deals</li>
            </ul>
        </div>
    </div>
    <?php echo $__env->make('frontend.sliders.slider2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container">
        <div class="row">
            <h3 style="padding: 5px 0;margin: 0;"> Today Deals</h3>
            <div class="col-md-12 col-sm-12 col-xs-12" >
                <div class="products-category">
                    <?php if(count($products)>0): ?>
                        
                        <div class="products-list grid row number-col-6 so-filter-gird">
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="product-layout col-lg-2 col-md-2 col-sm-4 col-xs-6">
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
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/frontend/pages/today-deals.blade.php ENDPATH**/ ?>