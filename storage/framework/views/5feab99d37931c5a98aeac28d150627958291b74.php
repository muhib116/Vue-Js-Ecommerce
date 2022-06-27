<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="shortcut icon" type="text/css" href="<?php echo e(asset('upload/images/logo/'. Config::get('siteSetting.favicon'))); ?>"/>
  <title><?php echo $__env->yieldContent('title'); ?></title>
  <?php echo $__env->yieldContent('metatag'); ?>
  <?php echo $__env->make('layouts.partials.frontend.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo config('siteSetting.header'); ?>

  
  
  
  
  
  <?php if(!empty(Config::get('siteSetting.fbpixel'))): ?>
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '<?php echo e(Config::get('siteSetting.fbpixel')); ?>');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=<?php echo e(env('FACEBOOK_PIXEL_ID')); ?>&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->
<?php endif; ?>
  
  
  
  
</head>
<body class="common-home res layout-6" style="background: <?php echo e(config('siteSetting.bg_color')); ?>; color: <?php echo e(config('siteSetting.text_color')); ?>">
  <?php if(\Route::current()->getName() == 'offer.prizeWinner'): ?> 
  <div id="prizeLoading" style="padding-top: 20px;color: #fff;">Offer Product Loading Please Wait...</div>
  <?php endif; ?>
  <div id="wrapper" class="wrapper-fluid banners-effect-5">
  <div id="app">
    <?php 
      if(!Session::has('menus')){
        $menus =  \App\Models\Menu::with(['get_categories'])->orderBy('position', 'asc')->where('status', 1)->get();
        Session::put('menus', $menus);
      }
      $menus = Session::get('menus');
      
    if(!Session::has('categories')){
      $categories =  \App\Models\Category::with('get_subcategory')->where('parent_id', '=', null)->orderBy('orderBy', 'asc')->where('status', 1)->get();
        Session::put('categories', $categories);
      }
      $categories = Session::get('categories');
    ?>
    <?php 
        $header = 'layouts.partials.frontend.header'.Config::get('siteSetting.header_no');
        $footer = 'layouts.partials.frontend.footer'.Config::get('siteSetting.footer_no');
    ?>
    <!-- Header Start -->
    <?php echo $__env->first([$header, "layouts.partials.frontend.header1"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="mainArea">
      <div id="pageloaderOpend">
        <div style="width:70px;position: absolute; top: 50%; left: 50%;border-radius: 3px; background:#08080894;-webkit-transform: translate(-50%,-50%);-moz-transform: translate(-50%,-50%);-ms-transform: translate(-50%,-50%);-o-transform: translate(-50%,-50%);transform: translate(-50%,-50%);"><img alt="woadi loader image" src="<?php echo e(asset("frontend/image/loading.gif")); ?>"></div>
      </div>
      <?php if(Auth::check()): ?>
      <?php echo $__env->make('layouts.partials.frontend.user-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php endif; ?>
    <!-- Header End -->
    
    <style type="text/css">
  @media (min-width: 1200px){
  .sliderArea .col-md-2 {
    width: 20% !important;
}
@media (min-width: 1200px){
.sliderArea .col-md-6 {
    width: 54% !important;
}

._2oXSl:after {
    content: "";
    position: absolute;
    right: 11px;
    top: 33px;
    width: 16px;
    height: 16px;

}
.module.sohomepage-slider .owl2-controls .owl2-nav div {
    position: absolute;
    margin: 0;
    top: 38%;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
    outline: 0;
    border-radius: 0;
    font-size: 0;
    z-index: 9;
    transition: all 0.3s ease;
    transform: scale(0);
    -ms-transform: scale(0);
    -webkit-transform: scale(0);
    padding: 30px;
}
.module.sohomepage-slider .owl2-controls .owl2-nav div.owl2-prev {
    border-radius: 0 28px 28px 0;
}
.module.sohomepage-slider .owl2-controls .owl2-nav div.owl2-next {
    border-radius: 28px 0 0 28px;
}
.module.sohomepage-slider .owl2-dots .owl2-dot.active span {
    height: 15px;
    width: 0px;
    background: #ff6e26!important;
    -webkit-transition: all .3s;
    transition: all .3s;
    border-radius: 0 !important;
    margin-bottom: 5px;
    border-color: #ff6e26;
    border-radius: 5px !important;
}
.module.sohomepage-slider .owl2-dots {
    position: relative;
    bottom: 33px;
    left: 30px;
    line-height: 100%;
    display: flex;
    justify-content: flex-start;
    align-items: center;
}
.module.sohomepage-slider .owl2-dots .owl2-dot span {
    width: 0;
    height: 10px;
    background-color: transparent;
    border: 3px solid #fff;
    margin: 0 4px;
    opacity: 1;
    display: block;
    border-radius: 5px !important;
    -webkit-border-radius: 50%;
    transition: all 0.2s ease 0s;
    -moz-transition: all 0.2s ease 0s;
    -webkit-transition: all 0.2s ease 0s;
}
.policy-bg {
    width: 100%;
    height: 64px;
    position: absolute;
    left: 0;
    bottom: 0;
    background: url('https://oibazar.com/upload/images/banner/policy_bg.png') no-repeat;
}
.policy-see a {
    font-size: 14px;
    color: #333;
    line-height: 19px;
}
.policy-see {
    width: 100%;
    display: inline-block;
    padding-top: 17px;
    text-align: right;
    position: relative;
    z-index: 1;
}
._2kPHY {
    display: flex;
    justify-content: space-around;
    align-items: center;
    flex-direction: row;
    color: black;
}
.h189IM i {
    font-size: 17px;
    background: whitesmoke;
    padding: 13px;
    border-radius: 50%;
    color: black;
}
.h189IM {
    display: flex;
    flex-direction: column;
    align-content: center;
    align-items: center;
    font-size: 13px;
    color: #a5a5a5;
}
.sliderAreas .col-md-3 {
    width: 22%;
}
.sliderAreas .col-md-6 {
    width: 56%;
}
.container-megamenu.vertical ul.megamenu > li > a strong {
    font-weight: normal;
    display: flex;
    flex-direction: row;
    align-items: center;
}
.container-megamenu.vertical .vertical-wrapper ul.megamenu > li > .sub-menu .content {
    padding: 10px;
    box-shadow: none;
}
.megamenu-style-dev .vertical ul.megamenu .sub-menu .content .static-menu .menu ul ul a {
    padding: 0;
    margin-left: 10px;
    color: black;
}
h3._1OU-S {
    margin-bottom: 0;
}
.owl2-stage-outer {
    max-height: 274px;
}
.hot86U7Z {
    display: flex;
    flex-direction: column;
    align-content: center;
    align-items: center;
}
.hot1a8KA img {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    margin: 3em 0 1.3em;
}
.hot1kB2E {
    background: -145px -14px;
    background-repeat: no-repeat;
    background-color: #fff;
}
.hot3UD {
    font-size: 14px;
    font-weight: bold;
    line-height: 30px;
}
.hot3lTD3 {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    margin: 2em 0;
}
.hot3ggnV {
    background-image: linear-gradient(94deg,#ff0a0a,#ff7539);
    padding: 0px 25px;
    border-radius: 20px;
    margin-right: 5px;
    color: white;
}
.hot34l2i {
    background-color: #f5f5f5;
    padding: 0px 25px;
    border-radius: 20px;
    margin-left: 5px;
    color: #000;
}
.hotmgoj {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    margin-bottom: 2em;
}
.hotSCkh {
    display: block;
    margin: 1em 0 6em;
}
.hotWbbW {
    color: white;
    font-size: 13px;
}
.hotZ1ZH {
    font-size: 16px;
    font-weight: bold;
    color: white;
}
.hot3t7wL dl {
    margin-top: 13px;
    border-top: 1px solid #ebedf0;
    padding-top: 10px;
    margin-bottom: 0;
}
.hot3t7wL dt {
    font-size: 14px;
    line-height: 19px;
    font-weight: 700;
    color: #333;
    margin-left: 10px;
    margin-bottom: 15px;
}
.hot3t7wL dd {
    line-height: 18px;
    font-size: 13px;
    color: #333;
    margin-bottom: 18px;
    position: relative;
    padding-left: 20px;
}
._3Vh1O {
    display: flex;
    flex-direction: column;
    height: 98%;
    background-color: #fff;
    padding: 3px;
}
._3Vh1O img {
    border-radius: 3.46px;
    height: 110px;
}
._70E3C {
    display: block;
    font-size: 16px;
    margin-top: 3px;
    color: #ff4747;
    font-weight: bold;
    text-align: center;
}
._90Rvw {
    align-items: flex-start;
    justify-content: center;
    display: flex;
    flex-direction: column;
    color: white;
}
._2oXSl {
    display: block;
    width: 216px;
    height: 65px;

    position: relative;
    color: #ff4733;
    line-height: 20px;
    font-size: 14px;
    padding: 20px 12px;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    margin-top: 12px;
}
._2oXSl p {
    overflow: hidden;
    text-overflow: ellipsis;
    width: 100%;
    font-size: 12px;
    color: #fff;
    white-space: nowrap;
}
</style>
    <?php echo $__env->yieldContent('content'); ?>
    </div>
  </div>
  <!-- Footer Area start -->
  <?php echo $__env->first([$footer, "layouts.partials.frontend.footer1"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  
  <style>
    .title-footer{color: #fff;
    border-bottom: 1px solid #7e7e7e;
    margin-bottom: 5px;
    padding: 3px;}
#footer {z-index: 9999999999;}
/* Footer */
 .footer-app a {
     float: left;
     
     padding: 3px 10px;
}
 .footer-Content {
     background: #232f3e;
     margin: 0;
     padding: 4rem 0;
}
 .footer-widget .block-title {
     color: #ffffff;
     font-size: 16px;
     font-weight: 600;
     margin: 0 0 25px;
     position: relative;
     text-transform: uppercase;
}
 .footer-widget .block-title::after {
     background: #4a3eed;
     background: -moz-linear-gradient(left, #4a3eed 0%, #9d1fff 100%);
     background: -webkit-linear-gradient(left, #4a3eed 0%, #9d1fff 100%);
     background: linear-gradient(to right, #4a3eed 0%, #9d1fff 100%);
     filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#4a3eed', endColorstr='#9d1fff', GradientType=1);
     border-radius: 12px;
     content: "";
     height: 3px;
     left: 0;
     position: absolute;
     top: 30px;
     width: 40px;
}
 .footer-widget .menu li {
     line-height: 28px;
}
 .footer-widget .menu span {
     font-weight: bold;
     margin: 0 4px 0 0;
}
 .footer-widget .menu li a {
     color: rgba(255, 255, 255, 0.97);
     padding: 8px 0px;
}
 .footer-widget .menu a::before {
     color: rgba(255, 255, 255, 0.97);
     content: "\f105";
     font-family: fontawesome;
     padding: 0 7px 0 0;
}
 .footer-widget .menu a:hover::before {
     color: rgba(255, 255, 255, 0.97);
}
 .footer-Content a:hover:before {
     color: #fff !important;
     margin-right: 5px;
     transition: 0.1s padding ease-out, 0.1s margin ease-out, 0.1s border ease-out;
}
 .footer-bottom h6 {
     display: inline;
     vertical-align: sub;
}
 .footer p {
     margin: 0;
     padding: 0;
     color: rgba(255, 255, 255, 0.97);
}
 .footer-Content p {
     line-height: 30px;
}
 .footer {
     background-color: #131A22;
     padding: 1rem 0;
     z-index: 999999;
    display: block;
}
 .footer-logo {
     min-width: 100px;
     padding: 0px 40px 0 0;
}
 .footer-links > ul {
     margin: -5px 0 0 0;
     padding: 0;
}
 .footer-links > ul li {
     display: inline;
     margin: 0;
     padding: 0;
}
 .footer-links li a {
     padding: 0 15px 0 0;
     font-weight: 500;
     color: #ffffff;
}
.copyright p {
     color: #ffffff;
     font-size: 11px;
     line-height: 13px;
     margin: 0;
     opacity: 0.8;
}
 .copyright a {
     color: #ffffff;
}
 .social-icon a i {
     border-radius: 50px;
     background: #ffffff none repeat scroll 0 0;
     box-shadow: 0 0 8px 0 rgba(77, 73, 112, 0.12);
     display: inline-block;
     font-size: 16px;
     height: 34px;
     line-height: 34px;
     margin: 0 0 0 1px;
     box-shadow: 0 2px 5px 0 rgba(77, 73, 112, 0.12);
     text-align: center;
     width: 34px;
     color: #343a40;
}
 .social-icon a i:hover {
     box-shadow: 0 0 9px 0 rgba(77, 73, 112, 0.12);
     background: #4a3eed none repeat scroll 0 0;
     color:#fff;
}
 .footer-bottom {
     background: #ffffff none repeat scroll 0 0;
     overflow: hidden;
     padding: 30px 0;
     width: 100%;
}
 .footer-bottom img {
     background: #231f20 none repeat scroll 0 0;
     border-radius: 3px;
     height: 38px;
     object-fit: scale-down;
     padding: 3px 4px;
}
 .footer-bottom .payment-menthod img {
     background: #fff none repeat scroll 0 0;
     height: auto;
     padding: 0;
}
 .footer-bottom strong {
     font-stretch: normal;
     font-style: normal;
}
 .footer-bottom .payment-menthod {
     margin: 0;
}
 .footer-bottom .payment-menthod a i {
     color: #cccccc;
     font-size: 56px;
     line-height: 45px;
     vertical-align: top;
}
 .footer a:hover {
     color: #eee !important;
}
 .copyright .fa-heart {
     animation: 2.5s ease 0s normal none infinite running animateHeart;
     color: #e92424;
     margin: 0 2px;
}
.services-block-footer .item {
    border: medium;
    border-radius: 2px;
    padding: 33px 0;
}
.services-block i {
    font-size: 41px;
    margin-right: 10px;
}
.icofont {
    font-family: fontawesome;
    speak: none;
    font-style: normal;
    font-weight: 400;
    font-variant: normal;
    text-transform: none;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    color: #232f3e!important;
    float: left;
}
.services-block small {
    color: #555;
    display: block;
    font-size: 12px;
    font-weight: 500;
}
.address,
.phone, 
.email,
.email a {
    color: white;
}
.services-block span {
    color: #232f3e;
    display: block;
    font-size: 16px;
    font-weight: 600;
    line-height: 15px;
}
 @keyframes    animateHeart {
     0% {
         transform: scale(1);
    }
     5% {
         transform: scale(1.2);
    }
     10% {
         transform: scale(1.1);
    }
     15% {
         transform: scale(1.25);
    }
     50% {
         transform: scale(1);
    }
     100% {
         transform: scale(1);
    }
}
/* End Footer */
 @media    screen and (max-width: 768px) {
     .d-none {
         display: none!important;
        ;
    }
     .social-icon {
        
         padding-top: 10px;
         margin-bottom: 20px;
    }
     .footer-bottom {
         padding-top: 0;
    }
}
 .col-xs-15, .col-sm-15, .col-md-15, .col-lg-15 {
     position: relative;
     min-height: 1px;
     padding-right: 10px;
     padding-left: 10px;
}
 .col-xs-15 {
     width: 20%;
     float: left;
}
 @media (min-width: 768px) {
     .col-sm-15 {
         width: 50%;
         float: left;
    }
}
 @media (min-width: 992px) {
     .col-md-15 {
         width: 33%;
         float: left;
    }
}
 @media (min-width: 1200px) {
     .col-lg-15 {
         width: 20%;
         float: left;
    }
}
</style>
<style>
								.servicesdzs {
								    display: flex;
								    flex-direction: row;
								    align-content: center;
								    align-items: center;
								    background: #fff;
								    border-radius: 20px;
								    justify-content: flex-start;
								}
								.servicesdzs:hover {
								    box-shadow: 0 2px 4px 0 rgba(0,0,0,.25);
								    -webkit-transform: all .3s ease-in-out;
								    -ms-transform: all .3s ease-in-out;
								    transform: all .3s ease-in-out;
								    position: relative;
								}
								@media    only screen and (max-width: 1000px) {
								.servicesdzs {
								    display: flex;
								    flex-direction: column;
								    align-content: center;
								    align-items: center;
								    background: #fff0;
								    border-radius: 0;
								}
								.servicesdz {
								    font-size: 12px !important;
								}
								}
								.servicesdz {
								    line-height: 15px;
								    display: block;
								    color: black;
								    text-align: center;
								    margin: 10px 0;
								    font-size: 20px;
								    font-weight: normal;
								}
							</style>
							<style>
								.boxx img {
								    height: 100px;
								    display: flex;
								    align-content: center;
								    flex-direction: column;
								    justify-content: center;
								}
								.marquee {
								    font-size: 27px;
								    margin-bottom: -23px;
								    font-weight: 900;
								}
								._2yWGi {
								    display: inline-block;
								    position: relative;
								    margin-top: 40px;
								    border-radius: 24px;
								    width: 139px;
								    z-index: 1;
								    overflow: auto;
								}
								._2yWGi .WgI_x {
								    background-color: #fff;
								    overflow: hidden;
								    border-radius: 24px;
								}
								.WgI_x img {
								    width: 127px !important;
								    height: 127px;
								    border-radius: 16px;
								    margin: 6px;
								    overflow: hidden;
								}
								._3Azs_ {
								    width: 100%;
								    height: 44px;
								    padding: 5px 10px;
								    display: flex;
								    align-items: center;
								    justify-content: center;
								}
								._42vxh {
								    color: #fff;
								    font-size: 16px;
								    line-height: 17px;
								    max-height: 34px;
								    text-align: center;
								    overflow: hidden;
								}
								.offer-top-productss {
								    border-radius: 24px;
								    background-color: #fff;
								    padding: 4px 3px;
								    display: block;
								}
								.counts {
								    display: flex;
								    justify-content: center;
								    align-items: center;
								}
								.offer_areass {
								    text-align: center;
								    margin: 10px 0;
								    padding: 14px 0;
								    border-radius: 30px;
								}
								.counts .count_dd {
								    display: flex;
								    padding: 5px 10px;
								    margin: 0 5px;
								    color: black;
								    font-size: 16px;
								    background: white;
								    border-radius: 5px;
								}
								.counts .count_dd p {
								    padding-left: 3px;
								}
								.count .count_dd p {
								    padding: 0px !important;
								}
								.count_dd {position: relative;
								    width: 57px;
								    border-radius: 5px;
								    padding: 10px 0px;
								    margin: 0px 3px;
								    background: #fbfbfb;
								    color: #000;
								    overflow: hidden; line-height:normal}
								    
								    .count_dd h2 {
								    display: block;
								    text-align: center;
								    font-size: 8px;
								    font-weight: 800;
								    text-transform: uppercase;
								    /* color: rgb(255, 255, 255); */
								    margin: 0;
								}
								.count_dd p {
								    display: block;
								    text-align: center;
								    font-size: 10px;
								    font-weight: 800; text-transform: uppercase;
								}
								.col-md-88 {
								    width: 12.5%;
								    float: left;
								}
								@media    only screen and (max-width: 600px) {
								.col-md-88 {
								    width: 33.33333333%;
								    float: left;
								}
								}
								.col-md-88 .boxx {
								    background: white;
								    margin: 5px;
								    display: flex;
								    flex-direction: column;
								    align-content: center;
								    justify-content: center;
								    align-items: center;
								    border-radius: 5px;
								    padding: 5px;
								}
								
								.productss {
								    margin: 15px;
								    display: block;
								    position: relative;
								}
								._152Gk {
								    display: block;
								    position: relative;
								    background-color: aliceblue;
								    overflow: auto;
								    border-radius: 20px;
								}
								.emKYQ {
								    margin: 0 15px;
								}
								
								
								._15I5z {
								    display: flex;
								    flex-direction: column;
								    justify-content: center;
								    box-sizing: border-box;
								    height: 140px;
								    padding: 10px 10px 10px 140px;
								    color: #222;
								}
								._1Iilo {
								    max-height: 52px;
								    line-height: 26px;
								    font-size: 20px;
								    font-weight: 700;
								    overflow: hidden;
								}
								@-webkit-keyframes blinker {
								from {opacity: 1.0;}
								to {opacity: 0.1;}
								}
								.blink{text-decoration: blink;-webkit-animation-name: blinker;-webkit-animation-duration: 0.7s;-webkit-animation-iteration-count:infinite;-webkit-animation-timing-function:ease-in-out;-webkit-animation-direction: alternate;color: #ffbc00}
								.offer-top-productss .item{padding:10px 0 !important;}
							</style>
  <!--  Footer Area End -->
  </div>
  
  
  
  
  
  
  
  
  <div class="cart_area">
<div id="main-nav" class="cart_menu cart_menu--right">
<div style="background: #354165;padding: 4px;font-size: 14px;color: #fff;;"><span class="cart_menu__close">✕</span> SHOPPING BAG</div>
<div class="cart_body">
</div>
</div>
</div>
<div class="modal fade" id="quickviewModal" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
<div class="modal-dialog modal-lg">

<div class="modal-content">
<div class="modal-header" style="border:none;">
<button type="button" id="modalClose" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body form-row" id="quickviewProduct"></div>
</div>
</div>
</div>
<div class="modal fade in" id="video_pop" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-body">
<button style="background: #bdbdbd;color:#f90101;opacity: 1;padding: 0 5px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>

<div id="showVideoFrame"></div>
</div>
</div>
</div>
</div>
<div id="outletModal" class="modal fade">
<style type="text/css">
   
    .outlet-box{border: 2px solid #dbdbdb;display: inline-block; border-radius: 10px;padding: 5px;margin-bottom: 5px; color: #4c4c4c; 
    min-height: 100px;
    max-height: 100px;width: 100%;
    overflow: hidden;}
    .outlet-box h6{margin: 5px 0;}
    .outlet-box p{line-height: normal;}
    .outlet-box:hover{border-color: #3db83a;}
</style>
<div class="modal-dialog modal-md">

<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Choose your nearest outlet</h4>
</div>
<div class="modal-body">
<div class="row" id="showOutlet">
<div style='height:135px' class='col-xs-12 loadingData-sm'></div>
</div>
</div>
</div>
</div>
</div>
<div id="removeCartItems" class="modal fade">
<div class="modal-dialog modal-sm">

<div class="modal-content">
<div class="modal-header" style="border: none;margin-bottom: 0;">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h5 class="modal-title">Remove your previous items?</h5>
</div>
<div class="modal-body">
<p style="text-align: center;line-height: normal;">You have still cart products from another branch. Do you want to delete the previous products of your cart.?</p><br>
<div class="row">
<div class="col-xs-4"> <button style="width: 100%;" type="button" class="btn btn-info " data-dismiss="modal">No</button></div>
<div class="col-xs-8" id="removePreItems"></div>
</div>
</div>
</div>
</div>
</div>







<div class="back-to-top hidden-top"><i class="fa fa-angle-up"></i></div>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  <div class="modal fade" id="quickviewModal" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header" style="border:none;">
              <button type="button" id="modalClose" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body form-row" id="quickviewProduct"></div>
      </div>
    </div>
  </div>
  <div class="modal fade in" id="video_pop"  aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content" >
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
  <?php if(!Auth::check()): ?> 
  <!-- login Modal -->
  <?php echo $__env->make('users.modal.login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>
  <div class="back-to-top hidden-top"><i class="fa fa-angle-up"></i></div>
  <script src="<?php echo e(asset('frontend/js/pace.min.js')); ?>"></script>
 
  <?php echo $__env->make('layouts.partials.frontend.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo config('siteSetting.google_analytics'); ?>

  <?php echo config('siteSetting.google_adsense'); ?>

  <?php echo config('siteSetting.footer'); ?>

  <script type="text/javascript">
    $(".header-bottom a, .offerType_box a, .navbar-logo a, .vertical-wrapper a, a.offer_box,  .product-item-container a, .caption h4 a, .buyNowBtn, .products-category a, .offer_section a, .bottom-nav a, aside a").click(function () {
        $("#pageloaderOpend").css("display","block").fadeIn(3000);
         setTimeout(function () {
           $("#pageloaderOpend").css("display","none");
        }, 5000);
    });
  
  $(document).ready(function() {  
  // Gets the video src from the data-src on each button   
  $('.video-btn').click(function() {
    var videoType = $(this).data( "type" ); 
    var videoSrc = $(this).data( "src" );
    $("#video_pop").css("display","block")
    if(videoType == 'video'){
        $('#showVideoFrame').html('<video id="myVideo" width="100%" controls autoplay><source id="video" src="'+ videoSrc+'" type="video/mp4"></video>');
    }
    if(videoType == 'youtube'){
        $('#showVideoFrame').html( '<iframe width="100%" height="100%" src="'+ videoSrc+'?autoplay=1&rel=0'+'"  frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'); 
    }
  });

  $('.modal .close').click(function(){
  modal.style.display = "none";
  $('#showVideoFrame').html('');
  });

  var modal = document.getElementById('video_pop');
  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
  if (event.target == modal) {
  modal.style.display = "none";
  $('#showVideoFrame').html('');
  }
  }
  // stop playing the video when I close the modal
  $('#video_pop').on('hidden.bs.modal', function (e) {
  $('#showVideoFrame').html('');
  });
  }); 
  </script>
</body>
</html><?php /**PATH /home/kalkerdeal/pg.kalkerdeal.com/resources/views/layouts/frontend.blade.php ENDPATH**/ ?>