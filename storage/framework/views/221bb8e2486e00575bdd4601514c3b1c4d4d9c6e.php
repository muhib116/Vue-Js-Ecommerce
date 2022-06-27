<input type="hidden" value="<?php echo e($data->id); ?>" name="id">

<div class="col-md-12">
    <div class="form-group">
        <label for="title">Service Title</label>
        <input name="title" id="title" value="<?php echo e($data->title); ?>" required="" type="text" class="form-control">
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label for="subtitle">Link</label>
        <input name="subtitle" id="subtitle" value="<?php echo e($data->subtitle); ?>" required="" type="text" class="form-control">
    </div>
</div>


<div class="col-md-6">
    <div class="form-group"> 
        <label class="dropify_image">Service Image</label>
        <input data-default-file="<?php echo e(asset('upload/images/services/'.$data->image)); ?>" type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg png gif"  data-max-file-size="2M"  name="image" id="input-file-events">
    </div>
    <?php if($errors->has('image')): ?>
        <span class="invalid-feedback" role="alert">
            <?php echo e($errors->first('image')); ?>

        </span>
    <?php endif; ?>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="required font">OR Font Icon</label>
        <input name="font" id="font" value="<?php echo e($data->font); ?>" placeholder="Example: fa fa-icon" type="text" class="form-control">
    </div>
</div>

<div class="col-md-12 mb-12">
    <div class="form-group">
        <label class="switch-box">Status</label>
        <div  class="status-btn" >
            <div class="custom-control custom-switch">
                <input name="status" <?php echo e(($data->status == 1) ?  'checked' : ''); ?>   type="checkbox" class="custom-control-input" id="status-edit">
                <label class="custom-control-label" for="status-edit">Publish/UnPublish</label>
            </div>
        </div>
    </div>
</div>

<?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/admin/services/editform.blade.php ENDPATH**/ ?>