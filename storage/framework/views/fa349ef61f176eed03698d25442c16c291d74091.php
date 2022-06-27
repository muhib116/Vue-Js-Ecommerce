<footer class="footer-container typefooter-2" style="margin-top: 25px;">
  <div class="footer_area" >
    <div class="so-page-builder">
      <section class="section_3">
        <div class="container">
          <div class="row row_bh6y  row-style ">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_mehx  col-style">
              <div class="row row_q34c  border ">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col_5j8y col-style">
                  <div class="contactinfo" itemscope itemtype="http://schema.org/Organization">
                    <img width="200" src="<?php echo e(asset('upload/images/logo/'.Config::get('siteSetting.logo') )); ?>" title="woadi logo" alt="woadi logo">
                    <p itemprop="name"><?php echo e(Config::get('siteSetting.about')); ?></p>
                    <div class="content-footer">

                      <div class="address">
                        <label><i class="fa fa-map-marker" aria-hidden="true"></i></label>
                        <span itemprop="address"><?php echo e(Config::get('siteSetting.address')); ?></span>
                      </div>
                      <div class="phone">
                        <label><i class="fa fa-phone" aria-hidden="true"></i></label>
                        <a itemprop="tel" href="tel:<?php echo e(Config::get('siteSetting.phone')); ?>"><?php echo e(Config::get('siteSetting.phone')); ?></a>
                      </div>
                      <div class="email">
                        <label><i class="fa fa-envelope"></i></label>
                        <a itemprop="email" href="mailto:<?php echo e(Config::get('siteSetting.email')); ?>"><?php echo e(Config::get('siteSetting.email')); ?></a>
                      </div>
                    </div>
                  </div>
                </div>
                
                <?php $footer_menus = $menus->where('footer', 1); ?>
                <?php $__currentLoopData = $footer_menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-<?php echo e((count($footer_menus) > 2 )  ? 2 : 3); ?> col-md-<?php echo e((count($footer_menus) > 2 )  ? 2 : 3); ?> col-sm-6 col-xs-6">
                  <div class="footer-links">
                    <h4 class="title-footer">
                      <?php echo e($menu->name); ?>

                    </h4>
                    <ul class="links">
                      <?php
                        $source_id = explode(',', $menu->source_id);
                        $get_pages =  \App\Models\Page::whereIn('id', $source_id)->get();
                      ?>
                      
                        <?php if($menu->menu_source == 'page'): ?>
                        <?php $__currentLoopData = $get_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                          <a href="<?php echo e(route('page', $page->slug)); ?>"><?php echo e($page->title); ?></a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <?php if(count($menu->get_categories)>0): ?>
                          <?php $__currentLoopData = $menu->get_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <li>
                          <a href="<?php echo e(route('home.category', [$category->get_singleSubcategory->slug, $category->slug])); ?>" ><?php echo e($category->name); ?></a>
                          </li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </ul>
                  </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-2 section_4 col-xs-12 col_l99d col-style">
                    <div class="footer-links">
                    <h4 class="title-footer">
                      Follow us
                    </h4>
                    </div>
                     <div class="footer-social">
                   
                      <h3 class="block-title hidden"></h3>
                      <div class="app-store spcustom_html">
                      <div style="display:flex;margin:15px 0 20px;">
                        <a class="app-1" href="https://play.google.com/store/apps/details?id=com.woadi.lite">google store</a>   
                        <a class="app-2" href="">apple store</a>
                       
                      </div>
                    </div>
                      <div class="socials" itemscope itemtype="http://schema.org/Organization">
                        <?php
                          if(!Session::has('socialLists')){
                              Session::put('socialLists', App\Models\Social::where('type', 'admin')->orderBy('position', 'asc')->where('status', 1)->get());
                          }
                        ?>
                        <?php $__currentLoopData = Session::get('socialLists'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a style="margin-right:5px;" href="<?php echo e($social->link); ?>" class="facebook" target="_blank" itemprop="sameAs">
                          <i class="fa <?php echo e($social->icon); ?>" style="background:<?php echo e($social->background); ?>; color:<?php echo e($social->text_color); ?>"></i>
                          <p>on</p>
                          <span class="name-social"><?php echo e($social->social_name); ?></span>
                        </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section_4 ">
        <div class="container">
          <div class="row row_njct  row-style ">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_7f0l  col-style">
              <div class="border" style="padding:0px">
                <div class="row">
                    <div class="col-xs-2 col-md-2 "><img alt="ecab logo" src="<?php echo e(asset('frontend/image/ecab.png')); ?>"></div>
                    <div class="col-xs-10 col-md-10 footerPaymentImage">
                    <img alt="payment gateway logo" src="<?php echo e(asset('frontend/image/shurjoPaylogo.png')); ?>">
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <div class="footer-bottom copyright_area ">
    <div class="container">
      <div class="row">
        <div class="col-md-12  col-sm-12 copyright">
          <?php echo config::get('siteSetting.copyright_text'); ?>

        </div>
      </div>
    </div>
  </div>
</footer><?php /**PATH C:\xampp\htdocs\mv\resources\views/layouts/partials/frontend/footer1.blade.php ENDPATH**/ ?>