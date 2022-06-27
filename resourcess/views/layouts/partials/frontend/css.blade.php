@yield('css-top')
<link rel="stylesheet" type="text/css" href="{{ mix('frontend/css/style.min.css') }}">
<link href="{{asset('frontend')}}/css/custom.css" rel="stylesheet">
<link href="{{asset('frontend')}}/css/headline.css" rel="stylesheet">

@yield('css')
<style type="text/css">
.mainArea{position: relative;}
#pageloaderOpend{width: 100%;height: 100%;top: 0;display: none;position: fixed;z-index: 9999999999;background: #ffffff2e}
/*process bar*/
.pace{-webkit-pointer-events:none;pointer-events:none;-webkit-user-select:none;-moz-user-select:none;user-select:none}.pace-inactive{display:none}.pace .pace-progress{background:#07c10d;position:fixed;z-index:2000;top:0;right:100%;width:100%;height:2px}
.card {border-radius: 5px;}
#content{position: relative;}
/*mobile menu*/
.bottom-nav { display: flex; position: fixed; bottom: 0;left: 0;right: 0;padding: 0.8rem 0;background-color: #fff;z-index: 9999999999;line-height: 1.42857143;will-change: transform;transform: translateZ(0);box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 3px rgba(0, 0, 0, 0.24);}
.bottom-nav-item {display: flex;flex-direction: column;flex-grow: 1;justify-content: center;text-align: center;font-size: 0.8rem;color: #525252;font-weight: 600; position: relative;}
.bottom-nav-link {display: flex;flex-direction: column;}
.bottom-nav-link i{font-size: 20px;}
.bottom-nav-link .active {color: #d32f2f;} @media (max-width: 768px) {#searchKey{border-radius: 4px 0px 0px 4px;}.footer-container{margin-bottom: 48px;}.back-to-top{bottom: 50px;}}
.typeheader-6 { background:{{ config('siteSetting.header_bg_color') }}; color: {{ config('siteSetting.header_text_color')}} !important }
.typeheader-6 .megamenu-style-dev .horizontal ul.megamenu > li > a { color: {{ config('siteSetting.header_text_color')}} }
  #getCartHead {color: #777;}
.typeheader-6 .header_custom_link .compare a {background: url('{{asset("frontend/image/icon/icon-compare2.png")}}') no-repeat center;}
.typeheader-6 .header_custom_link .wishlist a {background: url('{{asset("frontend/image/icon/icon-wishlist2.png")}}') no-repeat center;}
.typeheader-6 .header-cart h2.title-cart2{color:{{ config('siteSetting.header_text_color')}};}
.typeheader-6 .header-cart .btn-shopping-cart .fa-check-circle, .header-top a, .typeheader-6 .header-cart .btn-shopping-cart .cart-total-full{color: {{ config('siteSetting.header_text_color')}} !important;}
.typeheader-6 .header-top{background: {{ config('siteSetting.header_bg_color') }}; color: {{ config('siteSetting.header_text_color')}} }
.dropdown-menu > li > a{color: #000 !important}
#typeheadsection{z-index: 999999; width: 100%;height: 100%;top: 50%; left: 50%;ransform: translate(-50%, -50%);text-align: center;position: fixed; background: #e6e4e4 url('{{ asset("assets/images/loading.gif")}}') no-repeat center;}    
#dataLoading{z-index: 999999;  width: 100%;  height: 100%; top: 50%;  left: 50%; text-align: center; display: none;
transform: translate(-50%, -50%); position: absolute; background: #ffffffe0 url('{{ asset("frontend/image/loading.gif")}}') no-repeat center;}
#loadingData { z-index: 999999; width: 100%; height: 100%; top: 50%; left: 50%; transform: translate(-50%, -50%); display: none; position: absolute; background: url('{{ asset("assets/images/loading.gif")}}') no-repeat center; }
.loadingData-sm { z-index: 9999; width: 100%; height: 20px; background: url('{{ asset("assets/images/loader.gif")}}') no-repeat center; }
#process{  display: none; width: 100%; position: absolute; height: 100%; z-index: 9999; background: #ffffffb3 url('{{ asset("assets/images/loader.gif")}}') no-repeat center; }
.footer_area{background: {{ config('siteSetting.footer_bg_color') }}; color: {{ config('siteSetting.footer_text_color') }} }
.footer_area span,  .footer_area a,  .footer_area h4,  .footer_area i{color: {{ config('siteSetting.footer_text_color') }} !important; }
.footer_area .title-footer{border-bottom:1px solid {{ config('siteSetting.footer_text_color') }} !important; }
.footer_area li a:before{background: {{ config('siteSetting.footer_text_color') }} !important;}
.copyright_area{ background: {{ config('siteSetting.copyright_bg_color') }} !important; color: {{ config('siteSetting.copyright_text_color') }} !important; }
</style>
@yield('perpage-css')