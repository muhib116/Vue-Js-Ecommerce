<?php  $services = App\Models\Services::where('status', 1)->orderBy('position', 'asc')->take(5)->get(); ?>



<section class="section" <?php if($section->layout_width == 1): ?> style="background:<?php echo e($section->background_color); ?>" <?php endif; ?>>
  <div class="container" <?php if($section->layout_width != 1): ?> style="background:<?php echo e($section->background_color); ?>;border-radius: 5px;" <?php endif; ?>>
    
    <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="block-service-home6" style="margin: 0">
        <ul>
          <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li class="item">
            <a href="<?php echo e($service->subtitle); ?>" style="display:block;padding: 5px;">
            <div class="wrap">
              <div class="icon"><?php if($service->image): ?><img src="<?php echo e(asset('upload/images/services/'.$service->image)); ?>" width="30" alt="<?php echo e($service->title); ?>"><?php else: ?> <i style="font-size: 40px;" class="<?php echo e($service->font); ?>"></i><?php endif; ?></div>
              <div class="text" style="text-align: left;">
                <h5 style="color:<?php echo e($section->text_color); ?>"><?php echo e($service->title); ?></h5>
              </div>
            </div> <i style="position: absolute;right: 10px;font-size: 17px;top: 18px;" class="fa fa-angle-right"></i> </a>
          </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
    </div>
    </div>
  </div>
</section><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/frontend/homepage/services.blade.php ENDPATH**/ ?>