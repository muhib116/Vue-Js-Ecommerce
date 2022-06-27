
<?php $__env->startSection('title', Config::get('siteSetting.title')); ?>

<?php $__env->startSection('css'); ?>
	<style type="text/css">
        .category-box{ transition: .5s; position: relative; height: 45px; font-size: 12px;  font-weight: bold; background: #fff;display: block;border:2px solid #ccc; border-radius: 3px; cursor: pointer; padding: 10px 10px;line-height: 1;margin-bottom:  10px;}
        .category-box:hover{border:2px solid <?php echo e(config('siteSetting.text_color')); ?>;background:#ccc;}
        .catSection{background: #fff; overflow: auto; padding: 1rem; margin-bottom: 1rem;}
        .category{font-weight: bold;font-size: 16px;color: #000;margin-top: 15px;}
        .subcategory{font-weight: bold;font-size: 14px;color: #1686cc;margin-top: 10px;}
        .childcategory{color: #333;}
   </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="breadcrumbs">
        <div class="container">
            <ul class="breadcrumb-cate">
                <li><a href="<?php echo e(url('/')); ?>"><i class="fa fa-home"></i> </a></li>
                <li>All Categories</li>
                
            </ul>
        </div>
    </div>
    <?php $categories = App\Models\Category::where('parent_id', '=', null)->orderBy('orderBy', 'asc')->where('status', 1)->get(); ?>
    <div class="container">
        <span class="title">Products by Category</span>
        <div class="row catSection">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          	<div class="col-md-2 col-xs-6">
                <a class="category-box" href="#category<?php echo e($category->slug); ?>">
                	<span style="position: absolute;top: 8px;">
                        <img width="30" src="<?php echo e(asset('upload/images/category/thumb/'.$category->image)); ?>" alt=""> 
                    </span>
                    <span style="margin-left: 38px;display: block;"> <?php echo e($category->name); ?> </span>
                </a>
          	</div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row catSection" id="category<?php echo e($category->slug); ?>">
            <div class="col-md-12">
            <a href="<?php echo e(route('home.category', $category->slug)); ?>" class="clearfix"><img width="25" src="<?php echo e(asset('upload/images/category/thumb/'.$category->image)); ?>" alt="">
            <span class="category"><?php echo e($category->name); ?></span></a>
            </div>
            <?php if(count($category->get_subcategory)>0): ?>
            <?php $__currentLoopData = $category->get_subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 sticky-content">
                    <a href="<?php echo e(route('home.category', [$category->slug, $subcategory->slug])); ?>" class="subcategory"><?php echo e($subcategory->name); ?></a>
                    <?php if(count($subcategory->get_subchild_category)>0): ?>
                    <div class="row">
                    <?php $__currentLoopData = $subcategory->get_subchild_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-6"><a class="childcategory" href="<?php echo e(route('home.category',[ $category->slug, $subcategory->slug, $childcategory->slug])); ?>" ><?php echo e($childcategory->name); ?></a></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
    var $root = $('html, body');

    $('a[href^="#"]').click(function() {
        var href = $.attr(this, 'href');

        $root.animate({
            scrollTop: $(href).offset().top
        }, 500, function () {
            window.location.hash = href;
        });

        return false;
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/frontend/pages/category-sitemap.blade.php ENDPATH**/ ?>