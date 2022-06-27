<input type="hidden" value="<?php echo e($product_id); ?>" name="product_id">
<?php if(count($product_images)>0): ?>
	<?php $__currentLoopData = $product_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<div id="gelImage<?php echo e($product_image->id); ?>" style="width: 60px;height: 60px; float: left;position: relative;border: 1px solid #e6e2e2;
	    margin-right: 3px;">
	    <img style="width: 100%; height: 100%;" src="<?php echo e(asset('upload/images/product/gallery/thumb/'.$product_image->image_path)); ?>" >
	    <span title="Delete Gallerry Image" onclick="deleteGallerryImage(<?php echo e($product_image->id); ?>)" style="cursor: pointer; position: absolute;top: -4px;right: 0;color: red;"><i class="fa fa-times"></i></span>
	</div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
<i style='color:red'> Gallery image not found. Please upload image.</i>
<?php endif; ?><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/admin/product/gallery-images.blade.php ENDPATH**/ ?>