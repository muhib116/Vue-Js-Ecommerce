<?php $specialSection = App\Models\HomepageSection::with(['sectionItems' => function ($query) {
$query->where('status', '=', 'active')->orderBy('position', 'asc'); }])->where('slug', 'special-item')->where('status', 1)->first(); ?>
<section class="sliderArea backgroundChange" style="padding: 0;-webkit-transition: all .5s;transition: all .5s;">
  <div class="container">
		<div class="row" >
		<div class="col-xs-12 col-md-2" style="padding: 0px;margin:0;">
				<div class="megamenu-style-dev megamenu-dev" >
          	<div class="responsive">
              <div class="so-vertical-menu no-gutter">
                  <nav class="navbar-default">
                      <div class=" container-megamenu container vertical  ">
                        <div class="vertical-wrapper">
                          <a class="hidden-lg hidden-md" href="<?php echo e(url('/')); ?>"><img width="145" height="45" src="<?php echo e(asset('upload/images/logo/'.Config::get('siteSetting.logo'))); ?>" title="Home" alt="Logo" style="margin-top: 5px;"></a><span id="remove-verticalmenu">✕</span>

                          <div class="megamenu-pattern">
                            <div class="container">
                              <ul class="megamenu" data-transition="slide" data-animationtime="300">
                              	<?php
                              	if(!Session::has('categories')){
  					                        $categories =  \App\Models\Category::where('parent_id', '=', null)->orderBy('orderBy', 'asc')->where('status', 1)->where('popular', 1)->limit(13)->get();
  					                        Session::put('categories', $categories);
  					                    }
  					                    $categories = Session::get('categories'); 
  					                    ?>
                              <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(count($category->get_subcategory)>0): ?>
                                	<?php if(config('siteSetting.header_menu') == 'mega'): ?>
                                	<li class="item-vertical  css-menu with-sub-menu hover">
                                    <p class="close-menu"></p>
                                    <a href="<?php echo e(route('home.category', $category->slug)); ?>" class="clearfix">
                                    <span>
                                     <?php echo e($category->name); ?>

                                    </span>
                                    <b class="fa fa-caret-right"></b>
                                    </a>
                                    <div class="sub-menu" style="width: 934px;">
                                      <div class="content">
                                        <div class="row">
                                          <div class="col-sm-3">
                                            <div class="row">
                                              <?php $max_iteration = round(count($category->get_subcategory) / 4);  ?>
                                              <?php $__currentLoopData = $category->get_subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuRow => $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          
                                                <div class="col-sm-12 static-menu">
                                                  <div class="menu">
                                                    <ul>
                                                      <li>
                                                        <a href="<?php echo e(route('home.category', [$category->slug, $subcategory->slug])); ?>" class="main-menu"><?php echo e($subcategory->name); ?>

                                                        </a>
                                                        <?php if(count($subcategory->get_subcategory)>0): ?>
                                                        <ul>
                                                          <?php $__currentLoopData = $subcategory->get_subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                          <li><a href="<?php echo e(route('home.category',[ $category->slug, $subcategory->slug, $childcategory->slug])); ?>" > <?php echo e($childcategory->name); ?></a></li>
                                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                        <?php endif; ?>
                                                      </li>
                                                    </ul>
                                                  </div>
                                                </div>
                                              <?php if(($menuRow + 1) % $max_iteration == 0): ?>
                                            </div>
                                          </div> <div class="col-sm-3">
                                            <div class="row"><?php endif; ?>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                      </div>
                                    </div>
                                  </li>
                                	<?php else: ?>
                                  <li class="item-vertical  css-menu with-sub-menu hover">
                                    <p class="close-menu"></p>
                                    <a href="<?php echo e(route('home.category', $category->slug)); ?>" class="clearfix">
                                    <span>
                                    <strong><img width="18" src="<?php echo e(asset('upload/images/category/thumb/'.$category->image)); ?>" alt="<?php echo e($category->name); ?>"> <?php echo e($category->name); ?></strong>
                                    </span>
                                    <b class="fa fa-caret-right"></b>
                                    </a>
                                    <div class="sub-menu" style="width: 250px;">
                                      <div class="content">
                                        <div class="row">
                                          <div class="col-sm-12">
                                            <div class="categories ">
                                              <div class="row">
                                                <div class="col-sm-12 hover-menu">
                                                  <div class="menu">
                                                    <ul>
                                                      <?php $__currentLoopData = $category->get_subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                      <li>
                                                        <a href="<?php echo e(route('home.category', [$category->slug, $subcategory->slug])); ?>"  class="main-menu"> <?php echo e($subcategory->name); ?>

                                                          <?php if(count($subcategory->get_subcategory)>0): ?>
                                                          <b class="fa fa-angle-right"></b>
                                                          <?php endif; ?>
                                                        </a>
                                                        <?php if(count($subcategory->get_subcategory)>0): ?>
                                                        <ul>
                                                          <?php $__currentLoopData = $subcategory->get_subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                          <li><a href="<?php echo e(route('home.category',[ $category->slug, $subcategory->slug, $childcategory->slug])); ?>" > <?php echo e($childcategory->name); ?></a></li>
                                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                        <?php endif; ?>
                                                      </li>
                                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </li>
                                  <?php endif; ?>
                                <?php else: ?>
                                  <li class="item-vertical">
                                    <p class="close-menu"></p>
                                    <a href="<?php echo e(route('home.category', $category->slug)); ?>" class="clearfix">
                                    <span>
                                    <strong><img width="30" src="<?php echo e(asset('upload/images/category/thumb/'.$category->image)); ?>" alt="<?php echo e($category->name); ?>"> <?php echo e($category->name); ?></strong>
                                    </span>
                                    </a>
                                  </li>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                              </ul>
                           </div>
                        </div>
                        </div>
                        </div>
                        </nav>
                        </div>
                        </div>
                        </div>
                        </div>
			
			<div class="col-xs-12 col-md-<?php echo e(($specialSection) ? 6 : 9); ?> "  style="padding: 8px 0 0 8px;;margin:0px;">
				<div class="module sohomepage-slider so-homeslider-ltr">
					
							<div class="so-homeslider yt-content-slider full_slider owl-drag" data-rtl="yes" data-autoplay="yes" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="10" data-items_column00="1" data-items_column0="1" data-items_column1="1" data-items_column2="1"  data-items_column3="1" data-items_column4="1" data-arrows="yes" data-pagination="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
							<?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								 <a href="<?php echo e($slider->btn_link); ?>" target="_self">
								 <img class="responsive" src="<?php echo e(asset('upload/images/slider/'.$slider->phato)); ?>" alt="<?php echo e($slider->title); ?>">
								 </a>
							
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						 </div>
				</div>
				
								<?php if($specialSection): ?>
				<div class="row util-clearfix hidden-xs" style="background: url('<?php echo e(asset('upload/images/homepage/newuser_bg1.png')); ?>') 0px 0px / cover no-repeat rgb(255, 245, 245);padding: 0px 0 0; overflow: hidden;">
<div class="_1Z9xI col-md-4">
<div class="_90Rvw">
<h3><?php echo e($specialSection->title); ?></h3>
<p>Currently Running Offers At <?php echo e(config('siteSetting.site_name')); ?></p>
</div>
<a>

</a>
</div>
<div class="col-md-8 hxje9">
<div class="category-slider-inner products-list yt-content-slider releate-products grid" data-rtl="yes" data-autoplay="yes" data-pagination="no" data-delay="15" data-speed="1" data-margin="3" data-items_column0="3" data-items_column1="3" data-items_column2="3" data-items_column3="3" data-items_column4="2" data-arrows="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
    
    
    <?php $__currentLoopData = $specialSection->sectionItems->take($specialSection->item_number); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
            <div class="_3Vh1O">
            <a href="<?php echo e(url($sectionItem->custom_url)); ?>"><img src="<?php echo e(asset('upload/images/homepage/'. $sectionItem->thumb_image)); ?>" alt="" />
             <?php if($sectionItem->item_sub_title): ?>
            <span class="_70E3C"><?php echo e($sectionItem->item_sub_title); ?></span>
            <?php endif; ?>
            </a>
            </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
    

</div>
</div>
</div>
<?php endif; ?>
				

</div>


<?php if(!Auth::check()): ?>
<div class="col-xs-12 col-md-3 hidden-xs" style="padding-top: 8px;">
<div class="hot1kB2E" style="background-image: url('<?php echo e(asset('upload/images/bds.png')); ?>');">
<div class="hot86U7Z">
<div class="hot1a8KA">
<img src="<?php echo e(asset('upload/images/users.png')); ?>" />
</div>
<div class="hot3UD">Welcome to <?php echo e(config('siteSetting.site_name')); ?></div>
</div>
<div class="hot3lTD3">
<a href="<?php echo e(route('register')); ?>" class="hot3ggnV">Join</a>
<a href=<?php echo e(route('login')); ?>" class="hot34l2i">Sign in</a>
</div>
<div class="hot3t7wL">
<dl>
<dt>Customer Service Policy</dt>
<dd><i class="fa fa-shield" aria-hidden="true"></i> Payment Security</dd>
<dd><i class="fa fa-ravelry" aria-hidden="true"></i> Delivery Guarantee</dd>
<dd><i class="fa fa-american-sign-language-interpreting" aria-hidden="true"></i> Quality Guarantee</dd>
<dd><i class="fa fa-life-ring" aria-hidden="true"></i> No Reason Returns</dd>
</dl>
<span class="policy-see"><a href="/privacy-policy">See More</a></span>
<span class="policy-bg"></span>
</div>
</div>
</div>
<?php else: ?>
<div class="col-xs-12 col-md-3 hidden-xs" style="padding-top: 8px;">
<div class="hot1kB2E" style="background-image: url('<?php echo e(asset('upload/images/bds.png')); ?>');">
<div class="hot86U7Z">
<div class="hot1a8KA">
<img src="<?php echo e(asset('upload/users')); ?>/<?php echo e((Auth::user()->photo) ? Auth::user()->photo : 'default.png'); ?>">
</div>
<div class="hot3UD">Hi, <?php echo e(Auth::user()->name); ?></div>
</div>
<div class="_2kPHY">
<a class="h189IM" href="<?php echo e(route('user.dashboard')); ?>">
<i class="fa fa-user-o" aria-hidden="true"></i><p>Account</p>
</a>
<a class="h189IM" href="<?php echo e(route('user.orderHistory')); ?>">
<i class="fa fa-file-text-o" aria-hidden="true"></i><p>Orders</p>
</a>

</div>
<div class="hot3t7wL">
<dl>
<dt>Customer Service Policy</dt>
<dd><i class="fa fa-shield" aria-hidden="true"></i> Payment Security</dd>
<dd><i class="fa fa-ravelry" aria-hidden="true"></i> Delivery Guarantee</dd>
<dd><i class="fa fa-american-sign-language-interpreting" aria-hidden="true"></i> Quality Guarantee</dd>
<dd><i class="fa fa-life-ring" aria-hidden="true"></i> No Reason Returns</dd>
</dl>
<span class="policy-see"><a href="/privacy-policy">See More</a></span>
<span class="policy-bg"></span>
</div>
</div>
</div>
<?php endif; ?>




</div>
</div>
</section> <?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/frontend/sliders/slider4.blade.php ENDPATH**/ ?>