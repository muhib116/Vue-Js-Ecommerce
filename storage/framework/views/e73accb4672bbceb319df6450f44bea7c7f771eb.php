
<?php $__env->startSection('title', $product_detail->title.' | '.Config::get('siteSetting.title')); ?>
<?php
  $avg_ratting = round($product_detail->reviews->avg('ratting'), 1);
  $total_review = count($product_detail->reviews);
  $ratting_star = $product_detail->reviews->groupBy('ratting')->map->count()->toArray();
  $ratting1 = array_key_exists(1, $ratting_star) ? $ratting_star[1] : 0;
  $ratting2 = array_key_exists(2, $ratting_star) ? $ratting_star[2] : 0;
  $ratting3 = array_key_exists(3, $ratting_star) ? $ratting_star[3] : 0;
  $ratting4 = array_key_exists(4, $ratting_star) ? $ratting_star[4] : 0;
  $ratting5 = array_key_exists(5, $ratting_star) ? $ratting_star[5] : 0;
?>
<?php $__env->startSection('metatag'); ?>
    <meta name="keywords" content="<?php echo e($product_detail->meta_keywords); ?>" />
    <meta name="title" content="<?php echo e(($product_detail->meta_title) ? $product_detail->meta_title : $product_detail->title); ?>" />
    <meta name="description" content="<?php echo strip_tags( ($product_detail->meta_description) ? $product_detail->meta_description : Str::limit($product_detail->description, 500)); ?>">
    <meta name="image" content="<?php echo e(asset('upload/images/product/'.$product_detail->feature_image)); ?>">
    <meta name="rating" content="5">
    <!-- Schema.org for Google -->
    <meta itemprop="name" content="<?php echo e(($product_detail->meta_title) ? $product_detail->meta_title : $product_detail->title); ?>">
    <meta itemprop="description" content="<?php echo strip_tags(($product_detail->meta_description) ? $product_detail->meta_description : Str::limit($product_detail->description, 500)); ?>">
    <meta itemprop="image" content="<?php echo e(asset('upload/images/product/'.$product_detail->feature_image)); ?>">
    <!-- Twitter -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="<?php echo e(($product_detail->meta_title) ? $product_detail->meta_title : $product_detail->title); ?>">
    <meta name="twitter:description" content="<?php echo strip_tags(($product_detail->meta_description) ? $product_detail->meta_description : Str::limit($product_detail->description, 500)); ?>">
    <meta name="twitter:site" content="<?php echo e(url()->full()); ?>">
    <meta name="twitter:creator" content="@neyamul">
    <meta name="twitter:image:src" content="<?php echo e(asset('upload/images/product/'.$product_detail->feature_image)); ?>">
    <meta name="twitter:player" content="#">
    <!-- Twitter - Product (e-commerce) -->
    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta property="og:title" content="<?php echo e(($product_detail->meta_title) ? $product_detail->meta_title : $product_detail->title); ?>">
    <meta property="og:description" content="<?php echo strip_tags(($product_detail->meta_description) ? $product_detail->meta_description : Str::limit($product_detail->description, 500)); ?>">
    <meta property="og:image" content="<?php echo e(asset('upload/images/product/'.$product_detail->feature_image)); ?>">
    <meta property="og:url" content="<?php echo e(url()->full()); ?>">
    <meta property="og:site_name" content="<?php echo e(Config::get('siteSetting.site_name')); ?>">
    <meta property="og:locale" content="bd">
    <meta property="og:type" content="product">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
  <style>
.reviews{background: #fff;}
.single-review{border-bottom: 1px solid #eff0f5;padding: 10px;}
.single-review .review-img{float: left;flex: inherit;}
.single-review .review-top-wrap{margin:0px;}
.out-stock{background: #ff5050; padding: 3px 5px; border-radius: 5px; color: #fff;}
.in-stock {background: #329c32; padding: 3px 5px; border-radius: 5px; color: #fff;} 
.heading {font-size: 15px;margin-right: 25px;}
.average-ratting .fa {font-size: 20px;}
.checked {color: orange;}
/* Three column layout */
.side {float: left; width: 12%; margin-top:0px;}
.middle {margin-top:0px;float: left;width: 70%;}
/* Place text to the right */
.right {padding-left: 5px;}
/* Clear floats after the columns */
.row:after { content: "";display: table;clear: both;}
/* The bar container */
.bar-container { width: 100%;background-color: #f1f1f1;text-align: center;color: white;}
/* Individual bars */
.bar-5 {width: <?php echo e(($total_review >0) ? ($ratting5 / $total_review)*100 : 0); ?>%; height: 16px; background-color: #ff9800;}
.bar-4 {width: <?php echo e(($total_review >0) ? ($ratting4 / $total_review)*100 : 0); ?>%; height: 16px; background-color: #ff9800;}
.bar-3 {width: <?php echo e(($total_review >0) ? ($ratting3 / $total_review)*100 : 0); ?>%; height: 16px; background-color: #ff9800;}
.bar-2 {width: <?php echo e(($total_review >0) ? ($ratting2 / $total_review)*100 : 0); ?>%; height: 16px; background-color: #ff9800;}
.bar-1 {width: <?php echo e(($total_review >0) ? ($ratting1 / $total_review)*100 : 0); ?>%; height: 16px; background-color: #ff9800;}
/* Responsive layout - make the columns stack on top of each other instead of next to each other */
.review-filterSort {height: 44px;padding-left: 10px;margin: 10px 0;border-top: 1px solid #eff0f5;border-bottom: 1px solid #eff0f5;}
.review-filterSort .filterSort {float: right;display: inline-block;padding: 0 12px;height: 44px;line-height: 44px;border-left: 1px solid #eff0f5;font-size: 13px;color: #757575;cursor: pointer;}
.review-filterSort .title { display: inline-block;height: 44px;line-height: 44px;font-size: 14px;color: #212121;}
.availability.in-stock span {color: #fff;background-color: #5cb85c;padding: 5px 12px; border-radius: 50px;font-size: 12px;font-weight: bold;}
/*text more & less*/
a.morelink { text-decoration:none;outline: none;}
.morecontent span { display: none;}
#tab-description p{line-height: 1;}
/*text more & less*/
.divrigth_border:after {content: '';width: 0;height: 100%;position: absolute;top: 3px;right: 0px;margin-left: 0px;z-index: 999;border-right: 1px solid #ececec;}
.delivery_header { padding: 5px 0px;margin-bottom: 8px;border-bottom: 1px solid #eff0f5;}
.location_icon {width: 30px; font-size: 25px;padding-right: 10px;text-align: center;display: table-cell;vertical-align: middle;}
.all_location{ position: absolute;top: 65px;right: 15px;background: #fff;width: 95%;padding: 0 10px;text-align: left; z-index: 999;display: none;}
ul.location-list li{border-bottom: 1px solid #e6e6e6cc;cursor: pointer;padding:2px 5px;}
ul.location-list li:hover{background: #f9f9f9;}
.location_address {max-width: 195px;  line-height: initial;word-break: break-word;display: table-cell;vertical-align: middle;color: #202020;padding-right: 15px;}
.location_address p{padding: 0;margin: 0; font-size: 14px;}
.location_address i{font-size: 11px;}
.location_link{font-size: 11px;display: table-cell;vertical-align: middle; color: #009db4;text-align: right; text-transform: uppercase; white-space: nowrap;}
.location_link .rate{font-size: 20px;color:#e74c3c;}
.wishlistbtn{width: 100%;margin-bottom: 10px;}
.buy-now{width: 100%;background: #ef8c0f;}
.seller-option{ margin: 10px 0;}
.seller-header{ border-bottom: 1px solid #eae9e9;font-size: 1.3rem;color: #000;}
.seller_content { width: 150px; padding-right: 10px; display: table-cell; font-size: 12px;vertical-align: text-bottom;padding: 0 5px;border-right: 1px solid #e6e6e6; text-align: center;}
.chat_response, .seller_shipTime{font-size: 25px;}
.view-stor{width:100%;margin:3px 0px; }
.contact-seller{margin-top: 7px;}
.contact-seller a{background: #0077B5 !important;}
.best-seller-custom.best-seller {border-top: 0 !important;box-shadow: none;border: none;;}
.attribute_title{display: inline-block;vertical-align: top;min-width: 50px;}
.attributes{box-sizing: border-box;display: inline-block;position: relative;margin-right: 5px;overflow: hidden;text-align: center;}
.attributes_value{width: 60px;height: 40px;box-sizing: border-box;display: inline-block;position: relative;margin-right: 5px;overflow: hidden;text-align: left;border: 1px solid #eff0f5;border-radius: 3px; }
.attribute-select select {border-radius: 3px; background: #fff; border: 1px solid #ff5e00;color: #3d3d3d;padding: 0 9px; margin-bottom: 10px;}
.attributes label{margin: 0;cursor: pointer;text-shadow: 0px 1px 0px #0000003d;font-weight: bold;}
.attributes input{display: none;}
.attributes .active .selected{background: url('https://www.pinclipart.com/picdir/middle/16-161607_orange-checkmark-clipart-check-mark-clip-art-tick.png') no-repeat left;padding: 7px 26px 0px;background-size:contain;}
.average-ratting span.fa-stack{width: 23px;}
.video-btn{position: relative;display: inline-flex;    align-items: center; background: #e2dfdf;width: 70px;height: 70px;}
.playBtn{position: absolute;text-align: center; width: 100%;font-size: 45px;}
.product-preorder .preorder-sign {
    padding-right: 22px;
    overflow: hidden;
    position: relative;
}.product-preorder  span {
    display: inline-block;
    font-size: 12px;
    vertical-align: top;
    line-height: 22px;
}

.product-preorder .preorder-sign em {
    display: block;
    padding: 0 24px;
    color: #fff;
    font-size: 14px;
    background: -webkit-gradient(linear,left top,right top,from(#ff6e26),to(#ff4733));
    background: linear-gradient(
90deg
,#ff6e26,#ff4733);
    border-radius: 4px;
}.product-preorder  .preorder-sign:after {
    content: "";
    position: absolute;
    right: -12px;
    top: -22px;
    border: 22px solid rgba(0,0,0,0);
    border-left-color: #ff4733;
    -webkit-transform: rotate(
-20deg
);
    -ms-transform: rotate(-20deg);
    transform: rotate(
-20deg
);
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <div class="breadcrumbs">
      <div class="container">
          <ul class="breadcrumb-cate">
              <li><a href="<?php echo e(route('home.category', $product_detail->get_category->slug ?? '')); ?>"><?php echo e($product_detail->get_category->name ?? ''); ?></a></li>
              <?php if($product_detail->get_subcategory ?? false): ?>
              <li><a href="<?php echo e(route('home.category', [$product_detail->get_category->slug ?? '', $product_detail->get_subcategory->slug])); ?>"><?php echo e($product_detail->get_subcategory->name); ?></a></li>
              <?php endif; ?>
              <?php if($product_detail->get_childcategory ?? false): ?>
              <li><a href="<?php echo e(route('home.category', [$product_detail->get_category->slug ?? '', $product_detail->get_subcategory->slug ?? '', $product_detail->get_childcategory->slug])); ?>"><?php echo e($product_detail->get_childcategory->name); ?></a></li>
              <?php endif; ?>
              <li><?php echo e($product_detail->title); ?></li>
          </ul>
      </div>
  </div>
  <!-- Shop details Area start -->
  <div class="container product-detail" style="padding-top: 10px; background: #fff">
    <div class="row">
        <div id="content" style="padding-top: 0; margin-top: 0" class="col-md-9 col-sm-9 col-xs-12 divrigth_border sticky-content">
            <div class="sidebar-overlay "></div>
            <div class="product-view product-detail">
              <div class="product-view-inner clearfix">
                <div class="content-product-left  col-md-5 col-sm-6 col-xs-12">
                  <div class="so-loadeding"></div>
                  <div class="large-image  class-honizol">

                   <img class="product-image-zoom" alt="<?php echo e($product_detail->title); ?>" src="<?php echo e(asset('upload/images/product/'. $product_detail->feature_image)); ?>" data-zoom-image="<?php echo e(asset('upload/images/product/'. $product_detail->feature_image)); ?>">
                  </div>
                  <div id="thumb-slider" class="full_slider category-slider-inner products-list yt-content-slider" data-rtl="no" data-autoplay="yes" data-pagination="no" data-delay="4" data-speed="0.6" data-margin="10" data-items_column0="3" data-items_column1="3" data-items_column2="3" data-items_column3="3" data-items_column4="2" data-arrows="yes" data-lazyload="yes" data-loop="no" data-hoverpause="yes">
                      <div class="owl2-item " >
                        <div class="image-additional">
                         <a data-index="0" class="img thumbnail" data-image="<?php echo e(asset('upload/images/product/'. $product_detail->feature_image)); ?>" >
                         <img alt="<?php echo e($product_detail->title); ?>" src="<?php echo e(asset('upload/images/product/thumb/'. $product_detail->feature_image)); ?>" title="thumbnail" >
                         </a>
                        </div>
                       </div>
                       <?php $index = 1; ?>
                      <?php $__currentLoopData = $product_detail->videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <a  data-index="<?php echo e($index); ?>"  class="video-btn" data-toggle="modal" data-type="<?php echo e($video->provider); ?>" data-src="<?php echo e($video->link); ?>" data-target="#video_pop">
                         
                         <span class="playBtn"><i class="fa fa-play-circle"></i></span>
                          
                         </a>
                        <?php $index++; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               
                      <?php $__currentLoopData = $product_detail->get_galleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <div class="owl2-item " >
                        <div class="image-additional">
                         <a data-index="<?php echo e($index); ?>" class="img thumbnail" data-image="<?php echo e(asset('upload/images/product/gallery/'. $image->image_path)); ?>">
                         <img src="<?php echo e(asset('upload/images/product/gallery/thumb/'. $image->image_path)); ?>" title="thumbnail <?php echo e($index); ?>" alt="<?php echo e($product_detail->title); ?>">
                         </a>
                        </div>
                       </div>
                        <?php $index++; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                      <?php $__currentLoopData = $product_detail->get_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php $__currentLoopData = $variation->get_variationDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variationDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($variationDetail->image): ?>
                       <div class="owl2-item " >
                        <div class="image-additional">
                         <a data-index="<?php echo e($index); ?>" id="variationImage<?php echo e($variationDetail->id); ?>" class="img thumbnail" data-image="<?php echo e(asset('upload/images/product/varriant-product/'. $variationDetail->image)); ?>">
                         <img src="<?php echo e(asset('upload/images/product/varriant-product/thumb/'. $variationDetail->image)); ?>" title="thumbnail <?php echo e($index); ?>" alt="<?php echo e($product_detail->title); ?>">
                         </a>
                        </div>
                       </div>
                        <?php $index++; ?>
                        <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                </div>
                <div class="content-product-right col-md-7 col-sm-6 col-xs-12">

                  <div class="title-product">
                   <h1><?php echo e($product_detail->title); ?></h1>
                  </div>
                  <div class="box-review">
                    <div class="rating">
                      <div class="rating-box">
                        <?php echo e(\App\Http\Controllers\HelperController::ratting($avg_ratting)); ?>

                        <a class="reviews_button" href="#tab-review"><?php echo e($total_review); ?> reviews</a> / <a class="write_review_button" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">Write a review</a>
                        <?php if($product_detail->availability_date): ?>
                        <div class="product-preorder" style="color: #666;"> <span class="preorder-sign"><em> Pre-orders </em> </span> <strong>0 Pre-orders </strong> arrive on <?php echo e(Carbon\Carbon::parse($product_detail->availability_date)->format('M d, Y')); ?> </div><?php endif; ?>
                      </div>
                    </div>

                    <?php if($product_detail->get_brand): ?>
                    <p>Brand: <?php echo e($product_detail->get_brand->name); ?> | <?php endif; ?>
                      <span class="availability"> Availability: <span class="<?php if($product_detail->stock>0): ?> in-stock  <?php else: ?> out-stock <?php endif; ?>"> <i class="fa fa-check-square-o"></i><?php if($product_detail->stock>0): ?> In Stock <?php else: ?>  Out of stock <?php endif; ?></span></span> </p>
                  </div>

                  <div class="inner-box-desc">
                      <?php if($product_detail->sku): ?><div class="model"><span>Product SKU: </span> <?php echo e($product_detail->sku); ?></div><?php endif; ?>
                      
                    </div>
                  <div class="product_page_price price">
                   
                    <?php  
                      $discount = $calculate_discount = null;
                      $selling_price =  $product_detail->selling_price ;
                      $getOffer =  App\Models\Offer::join('offer_products', 'offers.id', 'offer_products.offer_id')->join('products', 'offer_products.product_id','products.id')
                        ->where('offers.slug', request()->get('offer'))
                        ->where('offer_products.product_id', $product_detail->id)
                        ->where('offers.start_date', '<=',  Carbon\Carbon::now())->where('offers.end_date', '>=', Carbon\Carbon::now())->where('offers.status', '=', 1)->whereNotIn('offers.offer_type', ['kanamachi','quiz'])
                        ->selectRaw('offer_products.offer_discount, offer_products.discount_type')->first();
                      
                      if($getOffer){
                          $discount = $getOffer->offer_discount;
                          $discount_type = $getOffer->discount_type;
                      }else{
                        //check referral product
                        $referral_code = (Session::has('referral_code')) ? Session::get('referral_code') : Cookie::get('referral_code');

                        $affiliate = null;
                        if($referral_code) {
                            $affiliate = App\Models\AffiliateAgent::join('affiliate_agent_products', 'affiliate_agents.user_id', 'affiliate_agent_products.agent_id')
                                ->join('affiliate_products', 'affiliate_agent_products.product_id', 'affiliate_products.product_id')
                                ->where('referral_code', $referral_code)
                                ->where('affiliate_agent_products.product_id', $product_detail->id)
                                ->selectRaw('affiliate_agent_products.agent_id , affiliate_agent_products.agent_price, affiliate_products.office_rate')->first();
                        }
                        if($affiliate){
                          
                          $selling_price = $product_detail->selling_price;
                          $discount = $product_detail->selling_price - $affiliate->agent_price ;
                          $discount_type = Config::get('siteSetting.currency_symble');
                        }else {
                          $discount = $product_detail->discount;
                          $discount_type = $product_detail->discount_type;
                        }
                      }
                      $price = $selling_price;
                      if($discount){
                          $calculate_discount = App\Http\Controllers\HelperController::calculate_discount($selling_price, $discount, $discount_type );
                          $price = $calculate_discount['price'];
                      }
                    ?>
                    <?php if($discount): ?>
                      <span class="price-new"><span id="price-special"><?php echo e(Config::get('siteSetting.currency_symble')); ?><?php echo e($price); ?></span></span>
                        <span>
                          <span class="price-old" id="price-old"><?php echo e(Config::get('siteSetting.currency_symble')); ?><?php echo e($selling_price); ?></span>
                        </span>
                    <?php else: ?>
                        <span class="price-new"><span id="price-special"><?php echo e(Config::get('siteSetting.currency_symble')); ?><?php echo e($selling_price); ?></span></span>
                    <?php endif; ?>

                  </div>
                 
                  <!-- check weather offer  -->
                  <form action="<?php echo e(route('buyDirect')); ?><?php echo e((request()->get('offer')) ? '?offer='. request()->get('offer') : ''); ?>" id="addToCart" method="post">
                  <?php echo csrf_field(); ?>
                  <?php if(request()->get('offer')): ?> <input type="hidden" value="<?php echo e(request()->get('offer')); ?>" name="offer"> <?php endif; ?>
                  <div class="product-box-desc">
                    <!-- //get feature attribute-->
                    <?php $__currentLoopData = $product_detail->get_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                      <!-- show attribute name -->
                      <?php $i=1; $attribute_name = str_replace(' ', '', $variation->attribute_name); ?>
                      <?php if($variation->in_display==2): ?>

                      <div class="product-size attribute-select">
                          <span class="attribute_title"> <?php echo e($variation->attribute_name); ?>: </span>
                          <select name="<?php echo e($attribute_name); ?>">
                              <!-- get feature details -->
                              <?php $__currentLoopData = $variation->get_variationDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variationDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <option value="<?php echo e($variationDetail->attributeValue_name); ?>"><?php echo e($variationDetail->attributeValue_name); ?></option>

                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                      </div>
                      <?php else: ?>
                      <div class="product-size">
                        <ul>
                            <li class="attribute_title"><?php echo e($variation->attribute_name); ?>: </li>
                            <li class="attributes <?php echo e($attribute_name); ?>">
                            <!-- get variation details -->
                             <?php $__currentLoopData = $variation->get_variationDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variationDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <!-- show variation attribute value name -->
                                <?php if($variationDetail->quantity > 0): ?>
                                <label data-price="<?php echo e($variationDetail->price); ?>" id="productVariation<?php echo e($variationDetail->id); ?>" onclick="productVariation(<?php echo e($variationDetail->id); ?>)" style="background:<?php echo e($variationDetail->color); ?> url('<?php echo e(asset('upload/images/product/varriant-product/thumb/'. $variationDetail->image)); ?>'); background-size: cover; color:#ebebeb; <?php if($variation->attribute_name != 'Color'): ?> width: inherit;height: inherit; <?php endif; ?>" class="attributes_value <?php if($i == 1): ?> active <?php endif; ?>" for="<?php echo e($attribute_name.$variationDetail->id); ?>" >
                                <span class="selected">
                                <input <?php if($i == 1): ?> checked <?php endif; ?> onclick="changeColor('<?php echo e($attribute_name); ?>', <?php echo e($variationDetail->id); ?>)" id="<?php echo e($attribute_name.$variationDetail->id); ?>" value="<?php echo e($variationDetail->attributeValue_name); ?>" name="<?php echo e($attribute_name); ?>"  type="<?php echo e(($variation->in_display==3) ? 'radio' : 'radio'); ?>" />

                                <?php echo e($variationDetail->attributeValue_name); ?></span> </label>
                                <?php $i++; ?>
                                <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </li>
                          </ul>
                      </div>
                      <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                  <div class="short_description form-group">
                   <h3>OverView</h3>
                   <?php echo $product_detail->summery; ?>

                  </div>
                  <div id="product">
                      <div class="box-cart clearfix">
                      <div class="form-group box-info-product">
                         <?php if($product_detail->product_type == null || $product_detail->product_type == 'add-to-cart' || $product_detail->product_type == 'download' || $product_detail->product_type != 'mystery-box'): ?>
                        <div class="option quantity">
                          <div class="input-group quantity-control" unselectable="on" style="user-select: none;">
                           <input class="form-control" type="text" name="quantity" value="1">
                           <span class="input-group-addon product_quantity_down fa fa-caret-down"></span>
                           <span class="input-group-addon product_quantity_up fa fa-caret-up"></span>
                          </div>
                        </div>
                        <?php endif; ?>
                        
                          <!-- added cart only voucher & download product-->
                          <?php if($product_detail->product_type == null || $product_detail->product_type == 'add-to-cart' || $product_detail->product_type == 'download' || $product_detail->product_type != 'mystery-box'): ?>
                          <div class="cart">
                          <input type="button" value="<?php echo e(str_replace('-', ' ', $product_detail->product_type ?? 'Add to cart')); ?>" class="addToCartBtn btn btn-mega btn-lg " data-toggle="tooltip" title="Add to cart" data-original-title="<?php echo e(str_replace('-', ' ', $product_detail->product_type ?? 'Add to cart')); ?>">
                          </div>
                          <?php endif; ?>

                          <input type="hidden" name="product_id" value="<?php echo e($product_detail->id); ?>">
                          <?php if($product_detail->product_type == 'mystery-box'): ?>
                          <?php if($getOffer): ?>
                           <div class="cart">
                          <input style="background: #0077b5;" type="submit" value="<?php echo e(($product_detail->product_type == 'pre-order') ? ' Pre Order' : 'Buy Now'); ?>" class="btn btn-success buyNowBtn" data-toggle="tooltip"  data-original-title="<?php echo e(($product_detail->product_type == 'pre-order') ? ' Pre Order' : 'Buy Now'); ?>"></div>
                          <?php endif; ?>
                          <?php else: ?>
                           <div class="cart">
                          <input style="background: #0077b5;" type="submit" value="<?php echo e(($product_detail->product_type == 'pre-order') ? ' Pre Order' : 'Buy Now'); ?>" class="btn btn-success buyNowBtn" data-toggle="tooltip"  data-original-title="<?php echo e(($product_detail->product_type == 'pre-order') ? ' Pre Order' : 'Buy Now'); ?>">
                          </div>
                          <div class="add-to-links wish_comp">
                          <ul class="blank">
                           <li class="wishlist" title="Add To Wishlist" data-toggle="tooltip" data-original-title="Add To Wishlist">
                            <a  <?php if(Auth::check()): ?>  onclick="addToWishlist(<?php echo e($product_detail->id); ?>)" <?php else: ?> data-toggle="modal" data-target="#so_sociallogin" <?php endif; ?> ><i class="fa fa-heart"></i></a>
                           </li>
                           <li class="compare" title="Add To Compare" data-toggle="tooltip" data-original-title="Add To Compare">
                            <a onclick="addToCompare(<?php echo e($product_detail->id); ?>)"  ><i class="fa fa-random"></i></a>
                           </li>
                          </ul>
                          </div>
                          <?php endif; ?>
                        
                       
                        
                        
                      </div>
                      <?php  
                      $offers = App\Models\Offer::where('end_date', '>=', now())->where('status', 1)->count(); 
                      $latestOffer = App\Models\Offer::where('end_date', '>=', now())->where('featured', 1)->orderBy('position', 'asc')->where('status', 1)->first(); 
                      ?>
                      <?php if($offers > 0): ?>
                      <div class="clearfix"></div>
                      <p style="font-weight: 600"><i class="fa fa-gift"></i> <?php echo e($offers); ?> other offers. <a href="<?php echo e(route('offers')); ?>"> View All Offers</a></p>
                      <?php if($latestOffer): ?>
                      <a href="<?php echo e(route('offer.details', $latestOffer->slug)); ?>">
                      <img src="<?php echo e(asset('upload/images/offer/banner/'. $latestOffer->banner)); ?>" class="img-1 img-responsive" alt="<?php echo e($latestOffer->title); ?>"></a>
                      <?php endif; ?>
                      <?php endif; ?>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                </form>
                </div>
              </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-12 sticky-content" >
          
            <div class="delivery-option">
              <div class="delivery-header">
                <div class="delivery_header_title">Delivery Options</div>
              </div>
          
              <?php if($product_detail->shipping_method == 'location'): ?>
              <div class="delivery_header">
                <div class="delivery_location">
                  <div class="location_icon">
                    <i class="fa fa-map-marker"></i>
                  </div>
                  <div class="location_address">
                    <p>Shipping Cost</p>
                    <i>Under <?php echo e($product_detail->shipping_region->name ?? ''); ?> : <?php echo e(Config::get('siteSetting.currency_symble') .' '.  $product_detail->shipping_cost); ?></i><br/>
                    <i>Outside <?php echo e($product_detail->shipping_region->name ?? ''); ?>: <?php echo e(Config::get('siteSetting.currency_symble') .' '. $product_detail->other_region_cost); ?></i><br/>
                    <?php if($product_detail->shipping_time): ?><i>Estimated shipping time: <?php echo e($product_detail->shipping_time); ?></i><?php endif; ?>
                  </div>
                  <div class="location_link">
                    <a class="rate"><?php if($product_detail->shipping_cost): ?><?php echo e(Config::get('siteSetting.currency_symble')); ?><?php echo e($product_detail->shipping_cost); ?><?php endif; ?></a>
                  </div>
                </div>
              </div>
             
              <?php elseif($product_detail->shipping_method == 'free'): ?>

              <div class="delivery_header">
                <div class="delivery_location">
                      <div class="location_icon">
                        <i class="fa fa-shipping-fast"><?php echo e(Config::get('siteSetting.currency_symble')); ?></i>
                      </div>
                      <div class="location_address">
                        <p>Free Shipping Available</p>
                         <?php if($product_detail->shipping_time): ?><i>Estimated shipping time: <?php echo e($product_detail->shipping_time); ?></i><?php endif; ?>
                      </div>
                  </div>
              </div>
              <?php elseif($product_detail->shipping_method == 'price'): ?>
              <div class="delivery_header">
                <div class="delivery_location">
                      <div class="location_icon">
                        <i class="fa fa-home"></i>
                      </div>
                      <div class="location_address">
                        <p>Shipping Cost</p>
                        <?php if($product_detail->shipping_time): ?><i>Estimated shipping time: <?php echo e($product_detail->shipping_time); ?></i><?php endif; ?>
                       </div>
                        <div class="location_link">
                         <a class="rate"><?php if($product_detail->shipping_cost): ?><?php echo e(Config::get('siteSetting.currency_symble')); ?><?php echo e($product_detail->shipping_cost); ?><?php endif; ?></a>
                      </div>
                  </div>
              </div>
              <?php else: ?>
              <div class="delivery_header">
                <div class="delivery_location">
                      <div class="location_icon">
                        <i class="fa fa-home"></i>
                      </div>
                      <div class="location_address">
                        <p>Shipping Cost</p>
                        <?php if($product_detail->shipping_time): ?><i>Estimated shipping time: <?php echo e($product_detail->shipping_time); ?></i><?php endif; ?>
                       </div>
                        <div class="location_link">
                         <a class="rate"><?php if($product_detail->shipping_cost): ?><?php echo e(Config::get('siteSetting.currency_symble')); ?><?php echo e($product_detail->shipping_cost); ?><?php endif; ?></a>
                      </div>
                  </div>
              </div>
              <?php endif; ?>

              <?php if($product_detail->cash_on_delivery): ?>
              <div class="delivery_header">
                <div class="delivery_location">
                      <div class="location_icon">
                        <i class="fa fa-handshake"><?php echo e(Config::get('siteSetting.currency_symble')); ?></i>
                      </div>
                      <div class="location_address">
                        <p>Cash on delivery available</p>
                       </div>
                  </div>
              </div>
              <?php endif; ?>

              <div class="delivery_header">
                <div class="delivery_location">
                      <div class="location_icon">
                        <i class="fa fa-handshake"><?php echo e(Config::get('siteSetting.currency_symble')); ?></i>
                      </div>
                      <div class="location_address">
                        <p> Secure Payment</p>
                        <i>100% secure payment</i>
                      </div>
                  </div>
              </div>
            </div>
          
            <div class="seller-option">

              <?php if($product_detail->vendor): ?>
              Sold By
              <div class="seller-header">
                <a href="<?php echo e(route('shop_details', $product_detail->vendor->slug)); ?>"> <i class="fa fa-shopping-bag"></i> <?php echo e($product_detail->vendor->shop_name); ?>


                  <!-- <span style="float: right;"><i class="fa fa-comments"></i> Chat Now</span> --></a>
              </div>
             

              <div class="delivery_header">
                <?php $seller_ratting = ($product_detail->vendor) ?  round($product_detail->vendor->reviews->avg('ratting'), 1) : 0; ?>
                <div class="delivery_location">
                      <div class="seller_content ">
                        Ratings
                        <div class="seller_ratting">
                        <?php echo e(\App\Http\Controllers\HelperController::ratting($seller_ratting)); ?>

                        </div>
                      </div>
                      <div class="seller_content ">
                         Ship on Time

                         <div class="seller_shipTime"> 90%</div>

                       </div>
                      <div class="seller_content">
                        Response Rate
                        <div class="chat_response"> 90%</div>

                      </div>

                        <div class="contact-seller">
                          <ul class="list">
                            <li>
                              <a class="view-stor btn" href="<?php echo e(route('shop_details', $product_detail->vendor->slug)); ?>">
                                <i class="icofont-plus"></i>
                                Visit Store
                              </a>
                            </li>
                            <li>
                              <a class="view-stor btn" <?php if(Auth::check()): ?>  onclick="favoriteSeller(<?php echo e($product_detail->vendor->id); ?>)" <?php else: ?> data-toggle="modal" data-target="#so_sociallogin" <?php endif; ?>>
                                <i class="icofont-plus"></i>
                                Add To Favorite Seller
                              </a>
                            </li>
                            <li>
                              <a href="<?php echo e(route('shop_details', $product_detail->vendor->slug)); ?>" class="view-stor btn" >
                                <i class="icofont-ui-chat"></i>
                                Contact Seller
                              </a>
                            </li>
                          </ul>
                      </div>
                </div>
              </div>
              <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="product-attribute module" style="overflow-x: scroll;">
        <div class="row content-product-midde clearfix">
            <div class="col-xs-12">
              <div class="producttab ">
                <div class="tabsslider  ">
                  <ul class="nav nav-tabs font-sn">
                     <li class="active"><a data-toggle="tab" href="#tab-description">Description</a></li>

                     <li><a href="#tab-specification" data-toggle="tab">Specification</a></li>
                    <!--  <li><a href="#tab-review" data-toggle="tab">Buy & Return Policy</a></li> -->
                  </ul>
                  <div class="tab-content ">
                    <div class="tab-pane active" id="tab-description">
                       <?php echo $product_detail->description; ?>

                    </div>
                    <div class="tab-pane" id="tab-specification">
                      <div class="row">
                        <div class="col-md-8" >
                        <?php $__currentLoopData = $product_detail->get_features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <div class="col-6 col-md-6">
                              <strong><?php echo e($feature->name); ?>: </strong> <?php echo e($feature->value); ?>

                          </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
    
    
    
    
    
    
    
    
   
    
    
    
    
    <div class="row" style="background: #fff">
        <div class="col-md-9 sticky-content divrigth_border" id="tab-review">
          <div class="row">
              <div class="col-md-12">
                  <!-- Section Title -->
                  <div class="section-title">
                      <h2>Customer reviews</h2>
                  </div>
                  <!-- Section Title -->
              </div>
          </div>
          <div class="row">
              <div class="col-md-4 average-ratting">
                  <h1 class="heading">User Rating</h1>
                  <p style="font-size: 30px;"><span style="font-size: 50px"><?php echo e($avg_ratting); ?></span>/5</p>
                  <?php echo e(\App\Http\Controllers\HelperController::ratting($avg_ratting)); ?>

                  <p><?php echo e($avg_ratting); ?> average based on <?php echo e($total_review); ?> reviews.</p>
              </div>
              <div class="col-md-8">
                  <div class="side">
                  <div>5 star</div>
                  </div>
                  <div class="middle">
                  <div class="bar-container">
                  <div class="bar-5"></div>
                  </div>
                  </div>
                  <div class="side right">
                  <div><?php echo e($ratting5); ?></div>
                  </div>
                  <div class="side">
                  <div>4 star</div>
                  </div>
                  <div class="middle">
                  <div class="bar-container">
                  <div class="bar-4"></div>
                  </div>
                  </div>
                  <div class="side right">
                  <div><?php echo e($ratting4); ?></div>
                  </div>
                  <div class="side">
                  <div>3 star</div>
                  </div>
                  <div class="middle">
                  <div class="bar-container">
                  <div class="bar-3"></div>
                  </div>
                  </div>
                  <div class="side right">
                  <div><?php echo e($ratting3); ?></div>
                  </div>
                  <div class="side">
                  <div>2 star</div>
                  </div>
                  <div class="middle">
                  <div class="bar-container">
                  <div class="bar-2"></div>
                  </div>
                  </div>
                  <div class="side right">
                  <div><?php echo e($ratting2); ?></div>
                  </div>
                  <div class="side">
                  <div>1 star</div>
                  </div>
                  <div class="middle">
                  <div class="bar-container">
                  <div class="bar-1"></div>
                  </div>
                  </div>
                  <div class="side right">
                  <div><?php echo e($ratting1); ?></div>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="review-filterSort">
                      <span class="title">Product Reviews</span>
                      <!-- <div class="filterSort">
                          <i class="fa fa-sort"></i><span> Filter:</span><span class="condition">All star</span>
                      </div>
                      <div class="filterSort">
                          <i class="fa fa-sort"></i><span> Sort:</span>
                          <span class="condition">Relevance</span>
                      </div> -->
                  </div>
              </div>
              <div class="col-md-12">
                <?php if(count($product_detail->reviews)>0): ?>
                  <div class="review-wrapper blog-listitem">
                    <?php $__currentLoopData = $product_detail->reviews->toArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="single-review">
                          <!-- <div class="review-img">
                              <img width="35" height="35" src="<?php echo e(asset('upload/users/default.png')); ?>" alt="<?php echo e($review['user']['name']); ?>" />
                          </div>  -->
                          <div class="review-content">
                              <div class="review-top-wrap">
                                  <div class="review-left">
                                      <div class="rating-product">
                                        <?php for($r=1; $r<=5; $r++): ?>
                                          <i class="fa fa-star <?php echo e(($r <= $review['ratting']) ? 'checked' : ' '); ?>"></i>
                                        <?php endfor; ?>
                                        <p style="margin: -8px 0 0;"> By <a href="#"><?php echo e($review['user']['name']); ?></a> | <?php echo e(Carbon\Carbon::parse($review['created_at'])->diffForHumans()); ?></p>
                                      </div>
                                       <!-- <div style="float: right;">
                                          <a href="#">Reply</a>
                                      </div> -->
                                  </div>
                              </div>
                              <div class="review-bottom">
                                  <p class="more">
                                     <?php echo e($review['review']); ?>

                                  </p>
                                  <?php $__currentLoopData = $review['review_image_video']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image_video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php if( $image_video['review_image']): ?>
                                      <a style="display: inline-flex;" class="popup-gallery" href="<?php echo e(asset('upload/review/'.$image_video['review_image'])); ?>">
                                        <img  width="70" height="70" src="<?php echo e(asset('upload/review/'.$image_video['review_image'])); ?>">
                                      </a>
                                      <?php endif; ?>
                                      <?php if( $image_video['review_video']): ?>
                                        <a href="#" class="video-btn" data-toggle="modal" data-type="video" data-src="<?php echo e(asset('upload/review/'.$image_video['review_video'])); ?>" data-target="#video_pop">
                                          <span class="playBtn"><i class="fa fa-play-circle"></i></span>
                                        </a>
                                      <?php endif; ?>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </div>
                          </div>
                      </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                <?php else: ?>
                <div style="text-align: center;">No product reviews</div>
                <?php endif; ?>
              </div>
          </div>
        </div>
        <div class="col-md-3 sticky-content">
          <?php if(count($best_sales)>0): ?>
          <div class="moduletable module so-extraslider-ltr best-seller best-seller-custom">
            <h3 class="modtitle"><span>Best Sellers</span></h3>
            <div class="modcontent">
              <div id="so_extra_slider" class="so-extraslider buttom-type1 preset00-1 preset01-1 preset02-1 preset03-1 preset04-1 button-type1">
                <div class="extraslider-inner " >
                    <div class="item ">
                      <?php $__currentLoopData = $best_sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $best_sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="item-wrap style1 ">
                        <div class="item-wrap-inner">
                         <div class="media-left">
                          <div class="item-image">
                             <div class="item-img-info product-image-container ">
                              <div class="box-label">
                              </div>
                              <a class="lt-image" data-product="66" href="<?php echo e(route('product_details', $best_sale->slug)); ?>" >
                              <img src="<?php echo e(asset('upload/images/product/thumb/'. $best_sale->feature_image)); ?>" alt="<?php echo e($best_sale->title); ?>">
                              </a>
                             </div>
                          </div>
                         </div>
                         <div class="media-body">
                          <div class="item-info">
                             <!-- Begin title -->
                             <div class="item-title">
                              <a href="<?php echo e(route('product_details', $best_sale->slug)); ?>" target="_self">
                             <?php echo e(Str::limit($best_sale->title, 20)); ?>

                              </a>
                             </div>
                             
                             <div class="price  price-left" style="font-size: 12px;">
                              <!-- Begin ratting -->
                             <div>
                             <?php echo e(\App\Http\Controllers\HelperController::ratting(round($best_sale->reviews->avg('ratting'), 1))); ?>

                             </div>
                                <?php  
                                    $discount = null;
                                    //check offer active/inactive
                                    if($best_sale->offer_discount && $best_sale->offer_discount->offer != null){
                                        $selling_price = $best_sale->selling_price;
                                        $discount = $best_sale->offer_discount->offer_discount;
                                        $discount_type = $best_sale->offer_discount->discount_type;
                                    }else{
                                        $selling_price = $best_sale->selling_price;
                                        $discount = $best_sale->discount;
                                        $discount_type = $best_sale->discount_type;
                                    }
                                    $calculate_discount = App\Http\Controllers\HelperController::calculate_discount($selling_price, $discount, $discount_type );
                                ?>
                                <?php if($discount): ?>
                                    <span class="price-new"><?php echo e(Config::get('siteSetting.currency_symble')); ?><?php echo e($calculate_discount['price']); ?></span>
                                    <span class="price-old"><?php echo e(Config::get('siteSetting.currency_symble')); ?><?php echo e($selling_price); ?></span>
                                <?php else: ?>
                                    <span class="price-new"><?php echo e(Config::get('siteSetting.currency_symble')); ?><?php echo e($selling_price); ?></span>
                                <?php endif; ?>
                             </div>
                              <?php if($discount): ?>
                              <div class="price-sale price-right">
                                  <span class="discount">
                                    <?php if($discount_type == '%'): ?>-<?php endif; ?><?php echo e($calculate_discount['discount']); ?>%
                                  <strong>OFF</strong>
                                </span>
                              </div>
                              <?php endif; ?>
                          </div>
                         </div>
                         <!-- End item-info -->
                        </div>
                        <!-- End item-wrap-inner -->
                      </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
              </div>
            </div>
         </div>
         <?php endif; ?>
        </div>
      </div>
  </div>
  
  
 
 

  
  <?php if(count($related_products)>0): ?>
    <section style="margin-bottom: 10px;">
      <div class="container">
        <div class="products-list grid row number-col-6 so-filter-gird" >
           <h3 class="modtitle" style="margin:10px 0 0">Related Products</h3>
            <?php $__currentLoopData = $related_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="product-layout col-lg-2 col-md-2 col-sm-4 col-xs-6">
                <?php echo $__env->make('frontend.products.products', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </section>
  <?php endif; ?>
  <div class="modal fade in" id="video_pop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content" style="background-color: inherit;border:none;box-shadow: none;">
         <div class="modal-body">        
            <button style="background: #bdbdbd;color:#f90101;opacity: 1;padding: 0 5px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>        
             <!-- 16:9 aspect ratio -->
             <div id="showVideoFrame"></div>                
         </div>        
       </div>
     </div>
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
  <script type="text/javascript">
      function productVariation(id){
        $('#variationImage'+id).click();
        var price = $('#productVariation'+id).data('price');
        if(price){
          $('#price-special').html('<?php echo e(Config::get('siteSetting.currency_symble')); ?>'+price);
        }
      }
      function currencyChanage(currency_code){
        var price = '<?php echo e($price); ?>';
        $.ajax({
          url:'<?php echo e(route("changeCurrency")); ?>',
          type:'get',
          data:{currency_code:currency_code,price:price},
          success:function(data){
              if(data.status){
                $('#price-special').html(data.price);
              }
            }
        });
      }
  </script>
  <script>
      $('.large-image').magnificPopup({
        items: [
          {src: '<?php echo e(asset("upload/images/product/". $product_detail->feature_image)); ?>' },
        <?php $__currentLoopData = $product_detail->get_galleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          {src: '<?php echo e(asset("upload/images/product/gallery/". $image->image_path)); ?>' },
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $product_detail->get_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $variation->get_variationDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variationDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($variationDetail->image): ?>
          {src: '<?php echo e(asset("upload/images/product/varriant-product/". $variationDetail->image)); ?>' },
          <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ],
        gallery: { enabled: true, preload: [0,2] },
        type: 'image',
        mainClass: 'mfp-fade',
        callbacks: {
          open: function() {
            var activeIndex = parseInt($('#thumb-slider .img.active').attr('data-index'));
            var magnificPopup = $.magnificPopup.instance;
            magnificPopup.goTo(activeIndex);
          }
        }
      });
  </script>
  <script type="text/javascript">
      function changeColor(name, id){
        $('.'+name+' label').click(function() {
          $(this).addClass('active').siblings().removeClass('active');
        });
      }
      $('.addToCartBtn').click(function(){
          $.ajax({
            url:'<?php echo e(route("cart.add")); ?>',
            type:'get',
            data:$('#addToCart').serialize(),
            success:function(data){
                if(data.status == 'success'){
                    var url = window.location.origin;
                    addProductNotice(data.msg, '<img src="'+url+'/upload/images/product/thumb/'+data.image+'" alt="">', '<h3>'+data.title+'</h3>', 'success');

                    $('.cartCount').html(Number($('.cartCount').html())+1);
                }else{
                    toastr.error(data.msg);
                }
              }
          });
      });
  </script>
  <!-- text more & less -->
  <script type="text/javascript">
      $(document).ready(function() {
        var showChar = 200;
        var ellipsestext = "...";
        var moretext = "more";
        var lesstext = "less";
        $('.more').each(function() {
            var content = $(this).html();
            if(content.length > showChar) {
                var c = content.substr(0, showChar);
                var h = content.substr(showChar-1, content.length - showChar);
                var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
                $(this).html(html);
            }
        });
        $(".morelink").click(function(){
            if($(this).hasClass("less")) {
                $(this).removeClass("less");
                $(this).html(moretext);
            } else {
                $(this).addClass("less");
                $(this).html(lesstext);
            }
            $(this).parent().prev().toggle();
            $(this).prev().toggle();
            return false;
        });
    });
  </script>
  <!-- text more & less -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/frontend/products/product_details.blade.php ENDPATH**/ ?>