<div class="product-item-container">
    <div class="left-block">
        <div class="product-image-container">
		<?php if($product->is_b2b == 0): ?>
            <a href="<?php echo e(route('product_details', $product->slug)); ?>" >
		<?php else: ?>
			<a href="<?php echo e(route('b2bproduct_details', $product->slug)); ?>" >
		<?php endif; ?>
            <img alt="<?php echo e($product->title); ?>" src="<?php echo e(asset('upload/images/product/'. $product->feature_image)); ?>" class="img-1 img-responsive">
            </a>
        </div>
    </div>
    <div class="right-block">
        <div class="caption">
		<?php if($product->is_b2b == 0): ?>
            <h4><a href="<?php echo e(route('product_details', $product->slug)); ?>"><?php echo e(Str::limit($product->title, 40)); ?></a></h4>
		<?php else: ?>
			            <h4><a href="<?php echo e(route('b2bproduct_details', $product->slug)); ?>"><?php echo e(Str::limit($product->title, 40)); ?></a></h4>

		<?php endif; ?>
            <div class="total-price clearfix">
                <?php echo $__env->make('inc.discount-&-offer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <?php if(!Request::is('/')): ?>
                <div class="description item-desc hidden">
                    <p><?php echo Str::limit($product->summery, 150); ?> </p>
                </div>
                <div class="list-block hidden">
				 <?php if($product->is_b2b == 0): ?>
                    <button  type="button" data-toggle="tooltip" onclick="addToCart(<?php echo e($product->id); ?>)" data-original-title="Add to Cart "><i class="fa fa-cart-plus"></i> </button>
				<?php endif; ?>
                    <button class="wishlist btn-button" type="button"  title="Add to Wish List"  <?php if(Auth::check()): ?> onclick="addToWishlist(<?php echo e($product->id); ?>)" data-toggle="tooltip" <?php else: ?> data-toggle="modal" data-target="#so_sociallogin" <?php endif; ?> data-original-title="Add to Wish List "><i class="fa fa-heart-o"></i></button>
                    <button class="compare btn-button" type="button"  title="Compare this Product" onclick="addToCompare(<?php echo e($product->id); ?>)" data-toggle="tooltip" data-original-title="Compare this Product "><i class="fa fa-retweet"></i></button>
                </div>
            <?php endif; ?>
        </div>
        <div class="button-group">
       <?php if($product->is_b2b == 0): ?>
            <span class="visible-lg btn-button" onclick="quickview('<?php echo e($product->slug); ?>')" href="javascript:void(0)"> <i class="fa fa-search"></i> </span>
       
            <button class=" btn-button" type="button" data-toggle="tooltip" title="" onclick="addToCart('<?php echo e($product->id); ?>')" data-original-title="Add to Cart"><i class="fa fa-cart-plus"></i> </button>
<?php endif; ?>
            <button class="wishlist btn-button" type="button"  title="Add to Wish List" <?php if(Auth::check()): ?> onclick="addToWishlist(<?php echo e($product->id); ?>)" data-toggle="tooltip" <?php else: ?> data-toggle="modal" data-target="#so_sociallogin" <?php endif; ?> data-original-title="Add to Wish List"><i class="fa fa-heart-o"></i></button>
            
            <button class="compare btn-button" type="button" title="Compare this Product" data-toggle="tooltip" onclick="addToCompare(<?php echo e($product->id); ?>)" data-original-title="Compare this Product"><i class="fa fa-retweet"></i></button>

        </div>
    </div>
</div>
<?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/frontend/products/products.blade.php ENDPATH**/ ?>