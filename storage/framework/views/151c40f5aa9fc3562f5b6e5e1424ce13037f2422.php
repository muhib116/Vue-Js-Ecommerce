<?php $brands = App\Models\Brand::where('top', 1)->where('status', 1)->take($section->item_number)->get(); ?>
<?php if(count($brands)>0): ?>

<section class="section" <?php if($section->layout_width == 1): ?> style="background:<?php echo e($section->background_color); ?>" <?php endif; ?>>
    <div class="container" <?php if($section->layout_width != 1): ?> style="background:<?php echo e($section->background_color); ?>;border-radius: 5px; padding: 5px;" <?php endif; ?>>
    
        <div class="row">
        <div class="col-md-12 catalog">
        	 <span class="title" style="color: <?php echo e($section->text_color); ?> !important;"><?php echo e($section->title); ?></span> 
            <span class="moreBtn" style="background: linear-gradient(to right, <?php echo e($section->background_color); ?>, #ffffff);border: 1px solid <?php echo e($section->text_color); ?>; box-shadow: 1px 1px 3px -1px <?php echo e($section->text_color); ?>"><a href="<?php echo e(route('topBrand')); ?>" style="color: <?php echo e($section->text_color); ?> !important;">See More</a></span>
        </div>
        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-xs-3 col-md-1" style="padding-left: 5px; padding-right: 5px;margin-bottom:10px;">
        	<div class="brand-list">
                <a href="<?php echo e(route('brandProducts', $brand->slug)); ?>"> 
                <div class="brand-thumb">
                    <img src="<?php echo e(asset('upload/images/brand/thumb/'.$brand->logo)); ?>" alt="<?php echo e($brand->name); ?>">
                </div>
                </a>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/frontend/homepage/brand.blade.php ENDPATH**/ ?>