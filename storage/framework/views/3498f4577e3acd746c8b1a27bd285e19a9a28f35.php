
<?php $__env->startSection('title', '404 page not found'); ?>
<?php $__env->startSection('metatag'); ?>
    <meta name="title" content="404 page not found">
    <meta name="description" content="<?php echo e(Config::get('siteSetting.description')); ?>">
    <meta name="keywords" content="<?php echo e(Config::get('siteSetting.meta_keywords')); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<style type="text/css">   
/*======================
    404 page
=======================*/
.page_404{ padding:40px 0; background:#fff; font-family: 'Arvo', serif;}
.page_404  img{ width:100%;}
.four_zero_four_bg{
 background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);height: 400px;background-position: center;}
.four_zero_four_bg h1{font-size:80px;}
.four_zero_four_bg h3{font-size:80px;}
.link_404{color: #fff!important;padding: 10px 20px;background: #39ac31;margin: 20px 0;display: inline-block;}
.contant_box_404{ margin-top:-50px;}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section class="page_404">
    <div class="container">
        <div class="row">   
        <div class="col-sm-12 ">
        <div class="col-sm-10 col-sm-offset-1  text-center">
        <div class="four_zero_four_bg">
            <h1 class="text-center ">404</h1>
        </div>
        <div class="contant_box_404">
            <h3 class="h2">
           Ohh! Page Not Found
            </h3>
            <p>The page you are looking for not avaible!</p>
            <a href="<?php echo e(url('/')); ?>" class="link_404">Go to Home</a>
        </div>
        </div>
        </div>
        </div>
    </div>
</section>
<?php  
$products = App\Models\Product::join('order_details', 'products.id', 'order_details.product_id')
  ->where('status', 'active')
  ->selectRaw('products.id, title,selling_price,discount,discount_type,slug,feature_image,count(order_details.product_id) as total_sale')
  ->groupBy('order_details.product_id')
  ->orderBy('total_sale', 'desc')
   ->take(12)
  ->get();
?>
  <section style="margin-bottom: 10px;">
    <div class="container">
      <div class="products-list grid row number-col-6 so-filter-gird" >
         <h3 class="modtitle" style="margin:10px 0 0">Just For You</h3>
          <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="product-layout col-lg-2 col-md-2 col-sm-4 col-xs-6">
              <?php echo $__env->make('frontend.homepage.products', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mv\resources\views/404.blade.php ENDPATH**/ ?>