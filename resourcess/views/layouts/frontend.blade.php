<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="shortcut icon" type="text/css" href="{{asset('upload/images/logo/'. Config::get('siteSetting.favicon'))}}"/>
  <title>@yield('title')</title>
  @yield('metatag')
  @include('layouts.partials.frontend.css')
  {!! config('siteSetting.header') !!}
  
  
  
  
  
  @if (!empty(Config::get('siteSetting.fbpixel')))
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
        fbq('init', '{{ Config::get('siteSetting.fbpixel') }}');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id={{ env('FACEBOOK_PIXEL_ID') }}&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->
@endif
  
  
  
  
</head>
<body class="common-home res layout-6" style="background: {{ config('siteSetting.bg_color') }}; color: {{ config('siteSetting.text_color') }}">
    @if (\Route::current()->getName() == 'offer.prizeWinner') 
  <div id="prizeLoading" style="padding-top: 20px;color: #fff;">Offer Product Loading Please Wait...</div>
  @endif
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
    @php 
        $header = 'layouts.partials.frontend.header'.Config::get('siteSetting.header_no');
        $footer = 'layouts.partials.frontend.footer'.Config::get('siteSetting.footer_no');
    @endphp
    <!-- Header Start -->
    @includeFirst([$header, "layouts.partials.frontend.header1"])
    
        <div class="mainArea">
    <div id="pageloaderOpend">
    <div style="width:70px;position: absolute; top: 50%; left: 50%;border-radius: 3px; background:#08080894;-webkit-transform: translate(-50%,-50%);-moz-transform: translate(-50%,-50%);-ms-transform: translate(-50%,-50%);-o-transform: translate(-50%,-50%);transform: translate(-50%,-50%);"><img src="{{ asset("frontend/image/loading.gif")}}"></div>
    </div>
    
    
   
      @if(Auth::check())
      @include('layouts.partials.frontend.user-sidebar')
      @endif
      
      
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
    background: url('{{asset('upload/images/banner/policy_bg.png')}}') no-repeat;
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
    height: 100%;
    background-color: #fff;
    padding: 4px;
}
._3Vh1O img {
    border-radius: 3.46px;
    height: 120px;
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
    <!-- Header End -->
    @yield('content')
    </div>
  </div>
  <!-- Footer Area start -->
  @includeFirst([$footer, "layouts.partials.frontend.footer1"])
  <!--  Footer Area End -->
  </div>
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
  @if(!Auth::check()) 
  <!-- login Modal -->
  @include('users.modal.login')
  @endif
  <div class="back-to-top hidden-top"><i class="fa fa-angle-up"></i></div>
  <script src="{{asset('frontend/js/pace.min.js')}}"></script>
 
  @include('layouts.partials.frontend.scripts')
  {!! config('siteSetting.google_analytics') !!}
  {!! config('siteSetting.google_adsense') !!}
  {!! config('siteSetting.footer') !!}
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
</html>