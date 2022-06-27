<input type="hidden" value="<?php echo e($offerProduct->id); ?>" name="id">

<div class="col-md-12">
    <div class="form-group">
        <label class="required" for="offer_quantity">Quantity</label>
        <input name="offer_quantity" placeholder="Enter quantity" id="offer_quantity" value="<?php echo e($offerProduct->offer_quantity); ?>" type="text" class="form-control">
    </div>
</div>
<?php if($offer->offer_type == 'regular'): ?>
<div class="col-md-12">
    <div class="form-group">
        <label class="required" for="offer_price">Offer Price</label>
        <input name="offer_price" placeholder="Offer Price" id="offer_price" value="<?php echo e($offerProduct->offer_price); ?>" type="text" class="form-control">
    </div>
</div>
<?php endif; ?>

<?php if($offer->offer_type == 'jowar-bhata'): ?>
<div class="col-md-12">
    <div class="form-group">
        <label class="required" for="offer_price">View Limit</label>
        <input name="viewlimit" placeholder="Daily View Limit" id="viewlimit" value="<?php echo e($offerProduct->viewlimit); ?>" type="text" class="form-control">
    </div>
</div>
<?php endif; ?>
    <?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/admin/offer/editOfferProduct.blade.php ENDPATH**/ ?>