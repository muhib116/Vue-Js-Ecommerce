<?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(View::exists('frontend.homepage.'.$section->section_type)): ?>
	<?php try{ ?>
	<?php echo $__env->make('frontend.homepage.'.$section->section_type, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php }catch(\Exception $e){
		echo '';
	} 
	?>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/frontend/homepage/homesection.blade.php ENDPATH**/ ?>