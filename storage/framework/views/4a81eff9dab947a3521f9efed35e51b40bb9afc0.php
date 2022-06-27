<?php if(count($banners)>0): ?>
<section class="section" style="background:transparent;">
  <div class="container" style="border-radius: 3px; padding:10px">
        <?php if(count($banners)>1): ?>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_k2sd col-style">
                <div class="module sohomepage-slider so-homeslider-ltr" style="overflow: hidden; max-height: 300px !important; width: 100% !important;">
                    <div class="modcontent">
                        <div id="sohompage-slider1">
                            <div class="so-homeslider yt-content-slider full_slider owl-drag" data-rtl="yes" data-autoplay="yes" data-autoheight="no" data-delay="4" data-speed="0.6"data-items_column00="1" data-items_column0="1" data-items_column1="1" data-items_column2="1"  data-items_column3="1" data-items_column4="1" data-arrows="yes" data-pagination="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
                            <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item">
                                <a href="<?php echo e($banner->btn_link1); ?>" target="_self">
                                <img class="responsive" src="<?php echo e(asset('upload/images/banner/'. $banner->banner1)); ?>" alt="slider image">
                                </a>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="module banners-effect-9 form-group">
            <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="banners">
                <a href="<?php echo e($banner->btn_link1); ?>"><img src="<?php echo e(asset('upload/images/banner/'. $banner->banner1)); ?>"></a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>




<?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/frontend/sliders/slider2.blade.php ENDPATH**/ ?>