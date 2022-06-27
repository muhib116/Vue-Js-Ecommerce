<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
  <link rel="stylesheet" href="<?php echo e(asset('frontend')); ?>/css/bootstrap/css/bootstrap.min.css">
  <link href="<?php echo e(asset('frontend')); ?>/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo e(asset('frontend')); ?>/js/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
  <link href="<?php echo e(asset('frontend')); ?>/js/owl-carousel/owl.carousel.css" rel="stylesheet">
  <link href="<?php echo e(asset('frontend')); ?>/css/themecss/lib.css" rel="stylesheet">

  <!-- Theme CSS
     ============================================ -->
  <link href="<?php echo e(asset('frontend')); ?>/css/themecss/so-listing-tabs.css" rel="stylesheet">
  <link href="<?php echo e(asset('frontend')); ?>/css/themecss/so-newletter-popup.css" rel="stylesheet">
  <link id="color_scheme" href="<?php echo e(asset('frontend')); ?>/css/theme.css" rel="stylesheet">
  <link href="<?php echo e(asset('frontend')); ?>/css/responsive.css" rel="stylesheet">
  <style type="text/css">
    .reviews{background: #fff;}
    .single-review{border-bottom: 1px solid #eff0f5;padding: 10px;}
    .single-review .review-img{float: left;flex: inherit;}
    .single-review .review-top-wrap{margin:0px;}
    .out-stock{background: #ff5050; padding: 3px 5px; border-radius: 5px; color: #fff;}
    .in-stock {background: #329c32; padding: 3px 5px; border-radius: 5px; color: #fff;} 
    .heading {font-size: 15px;margin-right: 25px;}
    .average-ratting .fa {font-size: 20px;}
    .checked {color: orange;}
    .attribute_title{display: inline-block;vertical-align: top;min-width: 50px;}

    .attributes{
      box-sizing: border-box;
      display: inline-block;
      position: relative;
      margin-right: 5px;
      overflow: hidden;
      text-align: center;
    }
    .attributes_value{
      width: 60px;
      height: 40px;
      box-sizing: border-box;
      display: inline-block;
      position: relative;
   
      margin-right: 5px;
      overflow: hidden;
      text-align: left;
      border: 1px solid #eff0f5;
      border-radius: 3px;
    }

    .attribute-select select {
        border-radius: 3px;
        background: #fff;
        border: 1px solid #ff5e00;
        color: #3d3d3d;
        padding: 0 9px;
        margin-bottom: 10px;
    }

    .attributes label{margin: 0;cursor: pointer;text-shadow: 0px 1px 0px #0000003d;font-weight: bold;}
    .attributes input{display: none;}

   .attributes .active .selected{
      background: url('https://www.pinclipart.com/picdir/middle/16-161607_orange-checkmark-clipart-check-mark-clip-art-tick.png') no-repeat left;
      padding: 7px 26px 0px;
      background-size:contain;
    }
  .average-ratting span.fa-stack{width: 23px;}
  .video-btn{position: relative;display: inline-flex; align-items: center; background: #e2dfdf;width: 70px;height: 70px;}
  .playBtn{position: absolute;text-align: center; width: 100%;font-size: 45px;}
  </style>
</head>

<body class="loaded page-quickview">
  <?php
  $avg_ratting = round($product->reviews->avg('ratting'), 1);
  $total_review = count($product->reviews);
  ?>
<div id="wrapper">
    <div class="product-detail">
      <div id="product-quick" class="product-info">
        <div class="product-view row">
          <div class="left-content-product ">
            <div class="product-view product-detail">
                <div class="product-view-inner clearfix">
                  <div class="content-product-left  col-md-4 col-sm-4 col-xs-12">
                    <div class="so-loadeding"></div>
                    <div class="large-image  class-honizol">

                     <img class="product-image-zoom" src="<?php echo e(asset('upload/images/product/'. $product->feature_image)); ?>" data-zoom-image="<?php echo e(asset('upload/images/product/'. $product->feature_image)); ?>" title="image">
                    </div>
                    <div id="thumb-slider" class="full_slider category-slider-inner products-list yt-content-slider" data-rtl="no" data-autoplay="yes" data-pagination="no" data-delay="4" data-speed="0.6" data-margin="10" data-items_column0="3" data-items_column1="3" data-items_column2="3" data-items_column3="3" data-items_column4="2" data-arrows="yes" data-lazyload="yes" data-loop="no" data-hoverpause="yes">
                        <div class="owl2-item " >
                          <div class="image-additional">
                           <a data-index="0" class="img thumbnail" data-image="<?php echo e(asset('upload/images/product/'. $product->feature_image)); ?>" >
                           <img src="<?php echo e(asset('upload/images/product/thumb/'. $product->feature_image)); ?>" title="thumbnail" >
                           </a>
                          </div>
                         </div>
                         <?php $index = 1; ?>
                        <?php $__currentLoopData = $product->videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <a  data-index="<?php echo e($index); ?>"  class="video-btn" data-toggle="modal" data-type="<?php echo e($video->provider); ?>" data-src="<?php echo e($video->link); ?>" data-target="#video_pop">
                           
                           <span class="playBtn"><i class="fa fa-play-circle"></i></span>
                            
                           </a>
                          <?php $index++; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 
                        <?php $__currentLoopData = $product->get_galleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <div class="owl2-item " >
                          <div class="image-additional">
                           <a data-index="<?php echo e($index); ?>" class="img thumbnail" data-image="<?php echo e(asset('upload/images/product/gallery/'. $image->image_path)); ?>">
                           <img src="<?php echo e(asset('upload/images/product/gallery/thumb/'. $image->image_path)); ?>" title="thumbnail <?php echo e($index); ?>" alt="<?php echo e($product->title); ?>">
                           </a>
                          </div>
                         </div>
                          <?php $index++; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php $__currentLoopData = $product->get_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $variation->get_variationDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variationDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($variationDetail->image): ?>
                         <div class="owl2-item " >
                          <div class="image-additional">
                           <a data-index="<?php echo e($index); ?>" id="variationImage<?php echo e($variationDetail->id); ?>" class="img thumbnail" data-image="<?php echo e(asset('upload/images/product/varriant-product/'. $variationDetail->image)); ?>">
                           <img src="<?php echo e(asset('upload/images/product/varriant-product/thumb/'. $variationDetail->image)); ?>" title="thumbnail <?php echo e($index); ?>" alt="">
                           </a>
                          </div>
                         </div>
                          <?php $index++; ?>
                          <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                  </div>
                  <div class="content-product-right col-md-8 col-sm-8 col-xs-12">

                    <div class="title-product">
                     <h1 style="margin:0;"><?php echo e($product->title); ?></h1>
                    </div>
                    <div class="box-review">
                      <div class="rating">
                        <div class="rating-box">
                          <?php echo e(\App\Http\Controllers\HelperController::ratting($avg_ratting)); ?>

                          <a class="reviews_button" href="#tab-review"><?php echo e($total_review); ?> reviews</a> 
                        </div>
                      </div>

                      <?php if($product->get_brand): ?>
                      <p>Brand: <?php echo e($product->get_brand->name); ?> | <?php endif; ?>
                        <span class="availability"> Availability: <span class="<?php if($product->stock>0): ?> in-stock  <?php else: ?> out-stock <?php endif; ?>"> <i class="fa fa-check-square-o"></i><?php if($product->stock>0): ?> In Stock <?php else: ?>  Out of stock <?php endif; ?></span></span> </p>
                    </div>

                      <div class="inner-box-desc">
                        <?php if($product->sku): ?><div class="model"><span>Product SKU: </span> <?php echo e($product->sku); ?></div><?php endif; ?>
                      </div>
                      <div class="product_page_price price">
                     
                        <?php  
                          $discount = $calculate_discount = null;
                          $selling_price =  $product->selling_price ;
                          $getOffer =  App\Models\Offer::join('offer_products', 'offers.id', 'offer_products.offer_id')->join('products', 'offer_products.product_id','products.id')
                            ->where('offers.slug', request()->get('offer'))
                            ->where('offer_products.product_id', $product->id)
                            ->where('offers.start_date', '<=',  Carbon\Carbon::now())->where('offers.end_date', '>=', Carbon\Carbon::now())->where('offers.status', '=', 1)->where('offers.offer_type', '!=', 'kanamachi')
                            ->selectRaw('offer_products.offer_discount, offer_products.discount_type')->first();
                          //dd($getOffer);
                          if($getOffer){
                              $discount = $getOffer->offer_discount;
                              $discount_type = $getOffer->discount_type;
                          }else{
                              $discount = $product->discount;
                              $discount_type = $product->discount_type;
                          }
                          $price = $selling_price;
                          if($discount){
                              $calculate_discount = App\Http\Controllers\HelperController::calculate_discount($selling_price, $discount, $discount_type );
                              $price = $calculate_discount['price'];
                          }
                        ?>

                        <?php if($calculate_discount): ?>
                          <span class="price-new"><span id="price-special"><?php echo e(Config::get('siteSetting.currency_symble')); ?><?php echo e($price); ?></span></span>
                            <span>
                              <span class="price-old" id="price-old"><?php echo e(Config::get('siteSetting.currency_symble')); ?><?php echo e($selling_price); ?></span>
                              <span class="discount">
                                <?php echo e($calculate_discount['discount']); ?>%
                                <strong>OFF</strong>
                              </span>
                            </span>
                        <?php else: ?>
                          <span class="price-new"><span id="price-special"><?php echo e(Config::get('siteSetting.currency_symble')); ?><?php echo e($price); ?></span></span>
                        <?php endif; ?>
                      </div>
                   
                      <form action="<?php echo e(route('buyDirect')); ?>?offer=<?php echo e($offer); ?>" target="_parent" id="addToCart" method="post">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                        <?php if(count($product->get_variations)>0): ?>
                        <div class="product-box-desc">
                          <!-- //get feature attribute-->
                          <?php $__currentLoopData = $product->get_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                        <?php endif; ?>
                        <div class="short_description form-group">
                          <h3>OverView</h3>
                         <?php echo $product->summery; ?>

                        </div>
                        <?php if($type != 'kanamachi' && $product->stock > 0): ?>
                        <div id="product">
                          <input type="hidden" value="<?php echo e($offer); ?>" name="offer">
                            <div class="box-cart clearfix">
                            <div class="form-group box-info-product">
                               <?php if($product->product_type == null || $product->product_type == 'add-to-cart' || $product->product_type == 'download' || $product->product_type != 'mystery-box'): ?>
                               <div class="option quantity">
                                <div class="input-group quantity-control" unselectable="on" style="user-select: none;">
                                 <input class="form-control" type="text" name="quantity" value="1">
                                 
                                 <span class="input-group-addon product_quantity_down fa fa-caret-down"></span>
                                 <span class="input-group-addon product_quantity_up fa fa-caret-up"></span>
                                </div>
                               </div>
                              <?php endif; ?>
                              <div class="cart">
                                <!-- added cart only voucher & download product-->
                               <?php if($product->product_type == null && $product->product_type == 'add-to-cart' && $product->product_type == 'download' || $product->product_type != 'mystery-box'): ?>
                                <input type="button" value="<?php echo e(str_replace('-', ' ', $product->product_type ?? 'Add to cart')); ?>" class="addToCartBtn btn btn-mega btn-lg " data-toggle="tooltip" title="Add to cart" data-original-title="<?php echo e(str_replace('-', ' ', $product->product_type ?? 'Add to cart')); ?>">
                                <?php endif; ?>
                                <input style="background: #0077b5;" type="submit" value="<?php echo e(($product->product_type == 'pre-order') ? ' Pre Order' : 'Buy Now'); ?>" class="btn btn-success buyNowBtn" data-toggle="tooltip"  data-original-title="<?php echo e(($product->product_type == 'pre-order') ? ' Pre Order' : 'Buy Now'); ?>">
                              </div>
                              <?php if($product->product_type == null && $product->product_type == 'add-to-cart' && $product->product_type == 'download'): ?>
                              <div class="add-to-links wish_comp">
                              <ul class="blank">
                               <li class="wishlist" title="Add To Wishlist" data-toggle="tooltip" data-original-title="Add To Wishlist">
                                <a  <?php if(Auth::check()): ?>  onclick="addToWishlist(<?php echo e($product->id); ?>)" <?php else: ?> data-toggle="modal" data-target="#so_sociallogin" <?php endif; ?> ><i class="fa fa-heart"></i></a>
                               </li>
                               <li class="compare" title="Add To Compare" data-toggle="tooltip" data-original-title="Add To Compare">
                                <a onclick="addToCompare(<?php echo e($product->id); ?>)"  ><i class="fa fa-random"></i></a>
                               </li>
                              </ul>
                             </div>
                             <?php endif; ?>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                        </div>
                        <?php endif; ?>
                      </form>
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

                                     <?php echo $product->description; ?>


                                  </div>

                                  <div class="tab-pane" id="tab-specification">
                                    <div class="row">
                                      <div class="col-md-8" >
                                      <?php $__currentLoopData = $product->get_features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

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
              </div>
          </div>
        </div>
      </div>
  </div>
</div>

<!-- Include Libs & Plugins
============================================ -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="<?php echo e(asset('frontend')); ?>/js/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="<?php echo e(asset('frontend')); ?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo e(asset('frontend')); ?>/js/themejs/so_megamenu.js"></script>
<script type="text/javascript" src="<?php echo e(asset('frontend')); ?>/js/owl-carousel/owl.carousel.js"></script>
<script type="text/javascript" src="<?php echo e(asset('frontend')); ?>/js/slick-slider/slick.js"></script>
<script type="text/javascript" src="<?php echo e(asset('frontend')); ?>/js/themejs/libs.js"></script>
<script type="text/javascript" src="<?php echo e(asset('frontend')); ?>/js/unveil/jquery.unveil.js"></script>
<script type="text/javascript" src="<?php echo e(asset('frontend')); ?>/js/countdown/jquery.countdown.min.js"></script>
<script type="text/javascript" src="<?php echo e(asset('frontend')); ?>/js/dcjqaccordion/jquery.dcjqaccordion.2.8.min.js"></script>
<script type="text/javascript" src="<?php echo e(asset('frontend')); ?>/js/datetimepicker/moment.js"></script>
<script type="text/javascript" src="<?php echo e(asset('frontend')); ?>/js/datetimepicker/bootstrap-datetimepicker.min.js"></script>

<script type="text/javascript" src="<?php echo e(asset('frontend')); ?>/js/quickview/jquery.magnific-popup.min.js"></script>
<!-- Theme files
 ============================================ -->
<script type="text/javascript" src="<?php echo e(asset('frontend')); ?>/js/themejs/application.js"></script>
<script type="text/javascript" src="<?php echo e(asset('frontend')); ?>/js/themejs/homepage.js"></script>
<script type="text/javascript" src="<?php echo e(asset('frontend')); ?>/js/themejs/custom_h1.js"></script>
<script type="text/javascript" src="<?php echo e(asset('frontend')); ?>/js/themejs/addtocart.js"></script>  
<script src="<?php echo e(asset('frontend/js/toastr.js')); ?>"></script>
  <script>
      $('.large-image').magnificPopup({
        items: [
          {src: '<?php echo e(asset("upload/images/product/". $product->feature_image)); ?>' },
        <?php $__currentLoopData = $product->get_galleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          {src: '<?php echo e(asset("upload/images/product/gallery/". $image->image_path)); ?>' },
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
   $('#buy-now').click(function(){
          $.ajax({
            url:'<?php echo e(route("buyDirect")); ?>',
            type:'get',
            data:$('#addToCart').serialize()+ '&buyDirect=buy',
            success:function(data){
                if(data.status == 'success'){
                  link = "<?php echo e(route('checkout', ':product_id')); ?>";
                  link = link.replace(':product_id', data.buy_product_id);
                  window.location.href = link+"?process-to-checkout";
                }else{
                  toastr.error(data.msg);
                }
              }
          });
      });

      $('.addToCartBtn').click(function(){
          
          $.ajax({
            url:'<?php echo e(route("cart.add")); ?>',
            type:'get',
           
            data:$('#addToCart').serialize(),
            success:function(data){
                if(data.status == 'success'){
                    var url = window.location.origin;
                    addProductNotice(data.msg, '<img src="'+url+'/upload/images/product/thumb/'+data.image+'" alt="">', '<h3>'+data.title+'</h3>', 'success');
       
                    $('#cartCount').html(Number($('#cartCount').html())+1);
                   
                }else{
                    toastr.error(data.msg);
                }
              }
          });
      });
  </script>
</body>
</html><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/frontend/products/quickview-iframe.blade.php ENDPATH**/ ?>