<input type="hidden" value="<?php echo e($section->id); ?>" name="id">

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="required" for="name">Section Title</label>
            <input placeholder="Enter Title" name="title" id="name" value="<?php echo e($section->title); ?>" required="" type="text" class="form-control">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="sub_title">Sub Title</label>
            <input  name="sub_title" placeholder="Enter sub title" id="sub_title" value="<?php echo e($section->sub_title); ?>" type="text" class="form-control">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label class="required" for="category_id">Select category</label>
            <select required onchange="getSubcateogry(this.value, 'edit')" name="category_id" id="category_id" class="select2 form-control custom-select">
               <option value="">Select category</option>
               <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <option <?php if($category->id == $section->category_id): ?> selected <?php endif; ?>  value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

    <div class="col-md-12" >
        <div class="form-group">
            <label class="required" for="category_id">Sub category</label>
            <select required  name="subcategory_id[]" id="editshowSubcateogry" multiple class="select2 m-b-10 select2-multiple" data-placeholder="Choose" style="width: 100%">
               
               <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php if(in_array($subcategory->id, explode(',', $section->subcategory_id))): ?> selected <?php endif; ?> value="<?php echo e($subcategory->id); ?>"><?php echo e($subcategory->name .'('. count($subcategory->productsByChildCategory). ')'); ?></option>';
                <?php if(count($subcategory->get_subchild_category) > 0): ?> {
                <?php $__currentLoopData = $subcategory->get_subchild_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option <?php if(in_array($child_category->id, explode(',', $section->subcategory_id))): ?> selected <?php endif; ?> value="<?php echo e($child_category->id); ?>">--<?php echo e($child_category->name .'('. count($child_category->productsByChildCategory). ')'); ?> </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label class="required" for="name">Bacground Color</label>
            <input type="text" name="background_color" value="<?php echo e($section->background_color); ?>" class="form-control gradient-colorpicker" >
        </div>
    </div>
    
    <div class="col-md-5">
        <div class="form-group">
            <label class="required" for="name">Text Color</label>
            <input name="text_color" value="<?php echo e($section->text_color); ?>" class="gradient-colorpicker form-control" >
        </div>
    </div>

    <div class="col-md-6">
        <div class="head-label">
            <label class="switch-box">Allow Feature</label>
            <div  class="status-btn" >
                <div class="custom-control custom-switch">
                    <input name="is_feature" checked  type="checkbox" class="custom-control-input" <?php echo e(($section->is_feature == 1) ?  'checked' : ''); ?> id="is_feature">
                    <label  class="custom-control-label" for="is_feature">Publish/UnPublish</label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="switch-box">Status</label>
            <div  class="status-btn" >
                <div class="custom-control custom-switch">
                    <input name="status" <?php echo e(($section->status == 1) ?  'checked' : ''); ?>   type="checkbox" class="custom-control-input" id="status-edit">
                    <label  class="custom-control-label" for="status-edit">Publish/UnPublish</label>
                </div>
            </div>
        </div>
    </div>
</div>
                           <?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/admin/category_section/edit.blade.php ENDPATH**/ ?>