<input type="hidden" value="<?php echo e($section->id); ?>" name="id">

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="required" for="name">Section Title</label>
            <input  name="title" id="name" value="<?php echo e($section->title); ?>" required="" type="text" class="form-control">
        </div>
    </div>
    <?php if($section->is_default != 1): ?>
    <div class="col-md-12">
        <div class="form-group">
            <label for="name required">Select Sourch</label>
            <select required onchange="sectionType(this.value, 'edit')" name="section_type" class="form-control">
                <option value="">Selct one</option>
                <option  <?php if($section->section_type == 'section'): ?> selected <?php endif; ?> value="section">Pick Products</option>
                <option  <?php if($section->section_type == 'category-product'): ?> selected <?php endif; ?> value="category-product"> Category Product</option>
                <option  <?php if($section->section_type == 'category'): ?> selected <?php endif; ?> value="category">Categories</option>
                <option <?php if($section->section_type == 'banner'): ?> selected <?php endif; ?> value="banner">Banner</option>
                
                
            </select>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row" id="editshowSection"> 
        <?php if($section->section_type == 'banner'): ?>
            <div class="col-md-12"><div class="form-group"> <label class="required" for="product_id">Select Banner</label> <select name="product_id" required="required" id="product_id" class="form-control custom-select"> <option value="">Select banner</option><?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option <?php if($section->product_id == $banner->id): ?> selected <?php endif; ?> value="<?php echo e($banner->id); ?>" > <?php echo e($banner->title); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select> </div></div>
        <?php elseif($section->section_type== 'category-product'): ?>
            <div class="col-md-12"><div class="form-group"> <label class="required" for="product_id">Product Categories</label> <select name="product_id" id="product_id" class="form-control select2 custom-select"> <option value="">Select category</option><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  <option  <?php if($section->product_id == $category->id): ?> selected <?php endif; ?> value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option> <!-- get subcategory --> <?php if(count($category->get_subcategory)>0): ?> <?php $__currentLoopData = $category->get_subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  <option  <?php if($section->product_id == $subcategory->id): ?> selected <?php endif; ?> value="<?php echo e($subcategory->id); ?>">&nbsp; -<?php echo e($subcategory->name); ?></option>  <!-- get childcategory --> <?php if(count($subcategory->get_subchild_category)>0): ?> <?php $__currentLoopData = $subcategory->get_subchild_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  <option  <?php if($section->product_id == $childcategory->id): ?> selected <?php endif; ?> value="<?php echo e($childcategory->id); ?>">&nbsp; &nbsp; --<?php echo e($childcategory->name); ?></option>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?> <!-- end subcategory --> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  <?php endif; ?> <!-- end subcategory --> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select> </div></div>

        <?php elseif($section->section_type== 'category'): ?>
            <div class="col-md-12"><div class="form-group"> <label class="required" for="product_id">Product Categories</label> <select name="product_id" id="product_id" class="form-control select2 custom-select"> <option value="">Select category</option><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  <option  <?php if($section->product_id == $category->id): ?> selected <?php endif; ?> value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option> <!-- get subcategory --> <?php if(count($category->get_subcategory)>0): ?> <?php $__currentLoopData = $category->get_subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  <option  <?php if($section->product_id == $subcategory->id): ?> selected <?php endif; ?> value="<?php echo e($subcategory->id); ?>">&nbsp; -<?php echo e($subcategory->name); ?></option>  <!-- end subcategory --> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  <?php endif; ?> <!-- end subcategory --> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select> </div></div>

        <?php elseif($section->section_type== 'section'): ?>
            <div class="col-md-12"><div class="form-group"> <label for="category">Product Categories</label> <select onchange="getAllProducts(this.value)"  id="category" class="form-control select2 custom-select"> <option value="">Select category</option><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option> <!-- get subcategory --> <?php if(count($category->get_subcategory)>0): ?> <?php $__currentLoopData = $category->get_subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  <option value="<?php echo e($subcategory->id); ?>">&nbsp; -<?php echo e($subcategory->name); ?></option>  <!-- get childcategory --> <?php if(count($subcategory->get_subchild_category)>0): ?> <?php $__currentLoopData = $subcategory->get_subchild_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  <option value="<?php echo e($childcategory->id); ?>">&nbsp; &nbsp; --<?php echo e($childcategory->name); ?></option>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?> <!-- end subcategory --> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  <?php endif; ?> <!-- end subcategory --> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select> </div></div>
            <div class="col-md-12"> <div class="form-group"><label for="homepage">Select More Product</label><select  onchange="getProduct(this.value)" id="showAllProducts" class="form-control custom-select" style="width: 100%"><option value="">Select First Category</option></select></div></div>

            <div class="col-md-12"><div class="form-group"><label for="getProducts">Selected Products</label><select required name="product_id[]" id="showSingleProduct" class="select2 m-b-10 select2-multiple" style="width: 100%" multiple="multiple" data-placeholder="Choose">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option selected value="<?php echo e($product->id); ?>"><?php echo e($product->title); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select></div></div>
        <?php else: ?>

       <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="col-md-6">
        <div class="form-group">
            <label class="required">Number Of Item</label>
            <input type="number" min="1" value="<?php echo e($section->item_number); ?>" class="form-control" placeholder="Example: 7" name="item_number">
        </div>
    </div>    
    <?php if($section->section_type == 'recent-views'): ?>
    <div class="col-md-6">
        <div class="form-group">
            <label class="required">Number Of Section</label>
            <input type="number" min="1" value="<?php echo e($section->section_number); ?>" class="form-control" placeholder="Example: 3" name="section_number">
        </div>
    </div>
    <?php endif; ?>
    <div class="col-md-6">
        <div class="form-group">
            <label class="required">Section Width</label>
            <select name="layout_width" class="form-control">
                <option <?php if($section->layout_width == null): ?> selected <?php endif; ?> value="box">Box</option>
                <option <?php if($section->layout_width != null): ?> selected <?php endif; ?> value="full">Full</option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="required" for="name">Bacground Color</label>
            <input name="background_color" value="<?php echo e($section->background_color); ?>" class="form-control gradient-colorpicker">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="required" for="name">Text Color</label>
            <input name="text_color" value="<?php echo e($section->text_color); ?>" class="form-control gradient-colorpicker">
        </div>
    </div>
    <?php if($section->section_type != 'offers' && $section->section_type != 'services'): ?>
    <div class="col-md-12">
        <div class="form-group"> 
            <label class="dropify_image">Tumbnail Image </label>
            <div class="thumb_image">
            <?php if($section->thumb_image): ?>
            <span style="color:red;float: right;cursor: pointer;" onclick="removeImage('<?php echo e($section->id); ?>')">Delete Image</span><?php endif; ?>
            <input data-default-file="<?php echo e(asset('upload/images/homepage/'.$section->thumb_image)); ?>" type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="thumb_image" id="input-file-events">
            </div>
            <i class="update-info">Recommended size: 300px*250px</i>
        </div>
        <?php if($errors->has('thumb_image')): ?>
            <span class="invalid-feedback" role="alert">
                <?php echo e($errors->first('thumb_image')); ?>

            </span>
        <?php endif; ?>
    </div>  
    <div class="col-md-12">
        <div class="form-group">
            <label for="name">Image Position</label>
            <select name="image_position" class="form-control">
                <option <?php if($section->image_position == 'left'): ?> selected <?php endif; ?> value="left">Left</option>
                
                <option <?php if($section->image_position == 'right'): ?> selected <?php endif; ?> value="right">Right</option>
            </select>
        </div>
    </div>
    <?php endif; ?>
</div>
                         
<div class="col-md-12">

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

<?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/admin/homepage/edit.blade.php ENDPATH**/ ?>