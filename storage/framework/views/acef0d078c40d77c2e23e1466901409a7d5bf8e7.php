<div class="price price-left">
    <label for="ratting5">
       <?php echo e(\App\Http\Controllers\HelperController::ratting(round($product->reviews->avg('ratting')))); ?>

    </label><br/>
    <?php  
        $selling_price = $product->selling_price;
        $discount = ($product->discount) ? $product->discount : null;
        $discount_type = $product->discount_type;
        if($discount){
            $calculate_discount = App\Http\Controllers\HelperController::calculate_discount($selling_price, $discount, $discount_type );
        }
    ?>
	
	<?php if($product->is_b2b == 0): ?>
	
    <?php if($discount): ?>
        <span class="price-new"><?php echo e(Config::get('siteSetting.currency_symble')); ?><?php echo e(round( $calculate_discount['price'])); ?></span>
        <span class="price-old"><?php echo e(Config::get('siteSetting.currency_symble')); ?><?php echo e(round($selling_price)); ?></span>
    <?php else: ?>
        <span class="price-new"><?php echo e(Config::get('siteSetting.currency_symble')); ?><?php echo e(round($selling_price)); ?></span>
    <?php endif; ?>
	<?php else: ?>
		
		<?php
					$pricing = explode("-", $product->pricing);
        $start = $pricing[0];
        $end   = $pricing[1];
		
		
		$nstart = $start+(($product->profit/100)*$start);
		$nend = $end+(($product->profit/100)*$end);
?>
					
	
	 <span class="price-new"><?php echo e(Config::get('siteSetting.currency_symble')); ?><?php echo e($nstart); ?>-<?php echo e($nend); ?></span>
	<?php endif; ?>
</div>
<?php if($product->is_b2b == 1): ?>
<div class="price-sale price-right">
    <span class="discount">
    <strong>Wholesale (B2B)</strong>
  </span>
</div>
<?php endif; ?>

<?php if($discount): ?>
<div class="price-sale price-right">
    <span class="discount">
      <?php if($discount_type == '%'): ?>-<?php endif; ?><?php echo e($calculate_discount['discount']); ?>%
    <strong>OFF</strong>
  </span>
</div>
<?php endif; ?><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/inc/discount-&-offer.blade.php ENDPATH**/ ?>