
<li class="content-item" <?php if(count($getCart)>4): ?> style="height: 400px;overflow-y: scroll;" <?php endif; ?> >
    <table class="table table-striped" style="margin-bottom:10px;color:#000">
      <tbody>
       
        <?php $__currentLoopData = $getCart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
        $discount = null;
        $price = $item->price;  
        ?>
        <tr>
          <td class="text-center size-img-cart">
            <a href="<?php echo e(route('product_details', $item->slug)); ?>"><img src="<?php echo e(asset('upload/images/product/thumb/'.$item->image)); ?>" title="<?php echo e(Str::limit($item->title, 100)); ?>" class="img-thumbnail"></a>
          </td>
          <td class="text-left"><a style="color:#000" href="<?php echo e(route('product_details', $item->slug)); ?>"><?php echo e(Str::limit($item->title, 22)); ?></a>
            <?php if($item->attributes): ?>
            <br> - <?php $__currentLoopData = json_decode($item->attributes); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <small style="color:#000"> <?php echo e($key); ?> : <?php echo e($value); ?>,  </small>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
          </td>
          <td class="text-right">x<?php echo e($item->qty); ?></td>
          <td class="text-right"><?php echo e(Config::get('siteSetting.currency_symble')); ?><?php echo e($price); ?></td>
          <td class="text-center">
            <button type="button" title="Remove" data-target="#delete" data-toggle="modal" onclick='deleteCartItem("<?php echo e(route("cart.itemRemove", $item->id)); ?>")' class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       
      </tbody>
  </table>

</li>
<li>
    <div class="checkout clearfix">
      <a href="<?php echo e(route('cart')); ?>" class="btn btn-info inverse"> View Cart</a>
      <a href="<?php echo e(route('checkout')); ?>?process=checkout" class="btn btn-success pull-right">Checkout</a>
    </div>
</li>
<?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/frontend/carts/cart-head.blade.php ENDPATH**/ ?>