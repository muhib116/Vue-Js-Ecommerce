<?php  
  $liveSessions = App\Models\LiveSession::with(['liveProducts.product:id,feature_image'])->orderBy('position', 'asc')->where('status', 1)->limit(3)->get();
?>
<?php if(count($liveSessions)>0): ?>
<section <?php if($section->layout_width == 1): ?> style="background:<?php echo e($section->background_color); ?>" <?php endif; ?>>
  <div class="container" <?php if($section->layout_width != 1): ?> style="background:<?php echo e($section->background_color); ?>;border-radius: 5px; padding:5px;" <?php endif; ?>>
    <span class="title" style="color: <?php echo e($section->text_color); ?> !important;"><?php echo e($section->title); ?> <sup class="blink" style="color: #ff6372">live</sup></span> 
    <span class="moreBtn" style="background: linear-gradient(to right, <?php echo e($section->background_color); ?>, #ffffff);border: 1px solid <?php echo e($section->text_color); ?>; box-shadow: 1px 1px 3px -1px <?php echo e($section->text_color); ?>"><a href="<?php echo e(url($section->slug)); ?>" style="color: <?php echo e($section->text_color); ?> !important;">See More</a></span>
    <div class="row">
      <?php if($section->thumb_image && $section->image_position == 'left'): ?>
      <div class="col-md-3">
        <div style="background: #fff;padding: 5px">
          <img style="width: 100%;height: 100%;" src="<?php echo e(asset('upload/images/homepage/'.$section->thumb_image)); ?>" alt="<?php echo e($section->title); ?>">
        </div>
      </div>
      <?php endif; ?>
      <div class="col-md-<?php echo e(($section->thumb_image) ? 9 : 12); ?> col-xs-12" style="padding:0;margin-bottom: 5px;">
          <ul class="list-unstyled video-list-thumbs row">
              <?php $__currentLoopData = $liveSessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $liveSession): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php $api_key = "AIzaSyCb3w2vwCXfG1MCI70NOAAHAJi-v1OJEHk";
                  $video_id = $liveSession->video_path;
                  $url = "https://www.googleapis.com/youtube/v3/videos?id=$video_id&key=$api_key&part=contentDetails,statistics";
                  $json = file_get_contents($url);
                  $getData = json_decode( $json , true);
                  $duration = '00:00';
              ?>
              <li class="col-lg-4 col-sm-4">
                  <div class="live-session" style="background: #fff;padding: 10px;border-radius: 5px;margin-bottom: 5px;">
                      <a href="<?php echo e(route('liveSessionDetails', $liveSession->slug)); ?>">
                      <h4 style="margin-bottom: 5px;min-height: 30px; font-size: 14px;color: #333;"><?php echo e(Str::limit($liveSession->title, 80)); ?></h4>
                      <?php if(count($getData['items'])>0): ?>
                      <?php  $duration =  new DateInterval($getData['items'][0]['contentDetails']['duration']); $duration = $duration->format('%H:%I:%S'); $statistics = $getData['items'][0]['statistics']; ?>
                      <div class="live-info">
                          <ul>
                             <?php if(array_key_exists('viewCount' ,$statistics)): ?>
                              <li style="display: inline-block;color: #666;margin-right: 10px;"><i class="fa fa-eye"></i> <?php echo e(number_format($statistics['viewCount'])); ?></li>
                              <?php endif; ?>
                              <?php if(array_key_exists('likeCount' ,$statistics)): ?>
                              <li style="display: inline-block;color: #666;margin-right: 10px;"><i class="fa fa-thumbs-up"></i> <?php echo e(number_format($statistics['likeCount'])); ?></li>
                              <?php endif; ?>
                              <?php if(array_key_exists('dislikeCount' ,$statistics)): ?>
                              <li style="display: inline-block;color: #666;margin-right: 10px;"><i class="fa fa-thumbs-down"></i> <?php echo e(number_format($getData['items'][0]['statistics']['dislikeCount'])); ?></li>
                              <?php endif; ?>
                              <?php if(array_key_exists('commentCount' ,$statistics)): ?>
                              <li style="display: inline-block;color: #666;margin-right: 10px;"> <i class="fa fa-comment"></i> <?php echo e(number_format($statistics['commentCount'])); ?></li>
                              <?php endif; ?>
                          </ul>
                      </div>
                      <?php endif; ?>
                      <div class="row">
                          <div class="col-md-9  col-xs-9" style="padding-left:0">
                              
                          <img style="margin:inherit;" src="<?php echo e(asset('upload/images/liveSession')); ?>/<?php echo e($liveSession->thumb_image); ?>" alt="<?php echo e($liveSession->title); ?>" class="img-responsive" />
                         
                          <span style="font-size: 60px;position: absolute;color: #fff; right: 39%;top: 31%;text-shadow: 0 1px 3px rgba(0,0,0,.5);transition:all 500ms ease-in-out;" class="fa fa-play-circle-o"></span>
                          <span style="background-color: rgba(0, 0, 0, 0.4);border-radius: 2px;color: #fff;font-size: 11px;font-weight: bold;left: 12px;line-height: 13px;padding: 2px 3px 1px;position: absolute;top: 12px;transition:all 500ms ease;"><?php echo e($duration); ?></span>
                          </div>
                          <div class="col-md-3  col-xs-3">
                              <?php $__currentLoopData = $liveSession->liveProducts->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $liveProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <div class="product-img">
                              <img alt="Black Color Khimar Collection 2020" src="<?php echo e(asset('upload/images/product/thumb')); ?>/<?php echo e($liveProduct->product->feature_image); ?>" class="img-1 img-responsive"></div>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </div>
                      </div>
                      </a>
                  </div>
              </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
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
<?php endif; ?><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/frontend/homepage/live-session.blade.php ENDPATH**/ ?>