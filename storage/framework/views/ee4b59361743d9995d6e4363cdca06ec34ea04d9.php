<?php
	$banner = App\Models\Banner::find($section->product_id); 
?>

<?php if($banner): ?>
<section class="hidden-lg" style="<?php if($section->layout_width == 1): ?> background:<?php echo e($section->background_color); ?>; <?php endif; ?> padding:5px;">
								<div class="container" <?php if($section->layout_width != 1): ?> style="background:<?php echo e($section->background_color); ?>;border-radius: 3px; padding: 5px;" <?php endif; ?>>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background:#000000;display: none;margin: 0;padding: 15px 15px 0;">
										<h4 class="herakhans" style="color:#000000"><?php echo e($banner->title); ?></h4>
									</div>
									
									
									 <?php if($banner->banner_type>1): ?>
    <span class="title" style="color: <?php echo e($section->text_color); ?> !important;"><?php echo e($section->title); ?></span>
    <?php endif; ?>
									                        <div class="row" style="padding: 0 5px;">
									                             <?php for($i=1;$i<=$banner->banner_type; $i++): ?>
                                        <?php $col = round(12/$banner->banner_type); 
                                        $mobcol = ($banner->banner_type == 1) ? 12 : 6;
                                        $btn_link = 'btn_link'.$i;
                                        $banner_img = 'banner'.$i;
                                        ?>
									    <div class="col-md-12 col-xs-12" style="margin:5px 0px;padding: 5px;">
            											<div class="banner-layout-5 clearfix">
            												<div class="banner-22  banners">
            													<div> <a title="<?php echo e($banner->title); ?>" href="<?php echo e(url($banner->$btn_link)); ?>"><img src="<?php echo e(asset('upload/images/banner/'.$banner->$banner_img)); ?>"><p style="text-align: center;color: #333;font-size: 14px;"></p></a> </div>
            												</div>
            											</div>
            										</div>
            								<?php endfor; ?>
									</div>
									
									
									
									
									
								</div>
</section>

<?php endif; ?>
<?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/frontend/homepage/banner.blade.php ENDPATH**/ ?>