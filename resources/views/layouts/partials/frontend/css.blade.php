@yield('css-top')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.min.css') }}">
<link href="{{asset('frontend/css/custom.css')}}" rel="stylesheet">
<link href="{{asset('frontend/css/headline.css')}}" rel="stylesheet">

@yield('css')
<style type="text/css">
.block-service-home6 ul > li:last-child{border-right: none;}
.brand-thumb{position: relative;width: 100%;padding: 3px;max-height: 90px;
background: #fff;text-align: center;}
.desc-listcategoreis { color: #000;text-align: center;padding: 0px;background: #fff;}
.brand-thumb img{max-height: 100%}
.header-center-right.col-md-6.col-sm-6.col-xs-12 {
    display: block;
}
 .price .price-old {
    display: inline-block;
}
.homepage .section{max-height: 400px !important; overflow: hidden;}
.homepage .products-list .product-layout {max-width: 230px;max-height: 335px; min-height: 150px;}
.price-offer{ display: block; width: 80px; text-align: center; line-height: normal;margin: 3px auto 10px;padding: 1px 0;color: #fff;font-size: 12px;background: #ff4733;border-radius: 15px;}
.img-wrap{width: 100%;height: 100px;  display: block;overflow: hidden;}
.img-wrap img{height: 100%;width: 100%;object-fit: contain;}

.footer-third {
    display: block;
}
._82272_1L4fv a {
    width: 50%;
    float: left;
    padding: 5px;
    display: block;
}
.double-item {
    padding: 10px;
    border-radius: 4px;
    overflow: auto;
}
.double-item .link-text {
    text-align: center;
    font-size: 12px;
    color: #333;
    font-weight: 700;
    display: -webkit-box;
    line-height: 14px;
    height: 14px;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
    margin-top: 5px;
}
.double-item .link-img {
    font-size: 12px;
    color: #666;
    line-height: 14px;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-align: center;
    display: flex;
    align-items: end;
    justify-content: center;
}
@media (max-width: 800px) {
._82272_1L4fv {
    margin: 20px 0;
    display: flex;
    overflow-x: scroll;
}
._82272_1L4fv a {
    flex-shrink: 0;
}
.crs._bnrs.-pvs {
    padding-bottom: 8px;
    padding-top: 8px;
    scroll-behavior: smooth;
    scroll-snap-type: x mandatory;
    scroll-snap-type: mandatory;
    -webkit-scroll-snap-type: mandatory;
    width: 100%;
    flex-wrap: nowrap;
    display: flex;
    overflow-x: auto;
    overflow-y: hidden;
    align-content: center;
    align-items: center;
    flex-direction: row;
}
.crs._bnrs.-pvs .item {
    scroll-snap-stop: always;
    scroll-snap-align: center;
    flex-shrink: 0;
    -webkit-tap-highlight-color: transparent;
    display: inline-block;
    margin-right: 11px;
}
.crs._bnrs img {
    height: 40vw;
    width: 80vw;
}
.offer-title p{font-size: 20px;}
.offer-top-product { left: 20%; transform: translate(-10%, -50%); }

.offer_area{margin-top: 0px;margin-bottom: 0px; border-top-right-radius: 25px; border-top-left-radius: 25px; border-bottom-right-radius: 25px;
border-bottom-left-radius: 25px;}
.offer_area{height: 135px;}
.offer-title{margin-top: 35px;}
.-fs0.-fsh0 {
    background: #fff0 !important;
    padding: 0 !important;
    flex-direction: column;
    font-size: 8px;
    line-height: 12px;
    text-align: center;
    border-radius: 30px;
}
.-plm.-fs16.-gy8.-fw.-m.-elli {
    margin-left: 0!important;
}
.-fs0.-fsh0 img {
    width: 55px!important;
    height: 55px!important;
    border-radius: 50%;
    box-shadow: 0px 5px 5px 0px rgb(0 0 0 / 25%);
    overflow: hidden;
    background: white;
    margin-bottom: 10px;
}
}
.topbanner {display: block;}
.count{
  display: inline-flex;margin: 0 auto;text-align: center;align-items: center;}
.count_d { position: relative; width: 50px;padding: 5px 0px;margin: 0px 3px;background-image: linear-gradient(to right, #4e0c25 ,#8e0d3c,#0a060e);color: #eef1f5; overflow: hidden;
} 
.count_d:before{ content: ''; position: absolute; top: 0;left: 0;width: 100%;}
.count_d span {display: block;text-align: center;font-size: 15px; font-weight: 800;}
.count_d h2 {display: block;text-align: center;font-size: 8px;font-weight: 800;text-transform: uppercase;margin: 0;}
.irotate {text-align: center;margin: 0 auto;display: block;
    }
    .thisis { display: inline-block;vertical-align: middle;}
    .slidem {text-align: center;min-width: 90px;}
    .catSection{ background: #EADAEB; padding:10px 10px 15px; margin-bottom: 10px; border-radius: 3px;}
    .cat-title{ color: #333; text-transform: capitalize; font-size: 14px;}
    .catSection img{border-radius: 5px;}
    .catSection:hover{ box-shadow: 0 2px 4px 0 rgba(0,0,0,.25); }
._82272_1L4fv {
    margin-top: 20px;
}
.header-center-right.col-lg-6.col-md-6.col-sm-12.col-xs-12 {
    display: block;
}
 @if(Request::is('/'))
button.nav-b {
    display: none !important;
}
@endif
.col.-df.-j-end.-fsh0 a {
    font-size: 1.3em;
    color: #333;
    align-items: center;
    text-transform: uppercase;
}
.col.-df.-j-end.-fsh0 i {
    font-size: 0.8em;
    margin-left: 3px;
}
.-fs0.-fsh0 {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    align-content: center;
    background: white;
    padding: 10px;
    box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%);
    margin-bottom: 5px;
}
.-plm.-fs16.-gy8.-fw.-m.-elli {
    text-overflow: ellipsis;
    font-size: 1.2em;
    margin-left: 5px;
    color: #333;
    font-weight: bold;
}
.-fs0.-fsh0 img {
    width: 40px;
    height: 40px;
}
.note p {
    font-size: 1em;
    margin-bottom: 15px!important;
    color: #282828;
}
.note h3 {
    font-size: 1.5em;
    margin-bottom: 10px!important;
    color: #333;
    font-weight: normal;
}
.count span {
    font-size: 17px;
    font-weight: bold;
}

.count p {
    font-size: 17px;
    padding-right: 11px;
}
.col-xs-55 {
    flex: 0 0 20%;
    width: 20%;
    position: relative;
    padding-right: 5px;
    padding-left: 5px;
    float: left;
}
</style>
<style type="text/css">
.mainArea{position: relative;}
#pageloaderOpend{width: 100%;height: 100%;top: 0;display: none;position: fixed;z-index: 9999999999;background: #ffffff2e}
/*process bar*/
.pace{-webkit-pointer-events:none;pointer-events:none;-webkit-user-select:none;-moz-user-select:none;user-select:none}.pace-inactive{display:none}.pace .pace-progress{background:#07c10d;position:fixed;z-index:2000;top:0;right:100%;width:100%;height:2px}
.navbar-toggle .icon-bar{background: #5f5d5d;}
.typeheader-6 #sosearchpro.so-search .button-search{border-color: #ff4747;background: #ff4747;}
#content{position: relative;background: #fff;padding-top: 10px;}
/*mobile menu*/
.bottom-nav { display: flex; position: fixed; bottom: 0;left: 0;right: 0;padding: 0.8rem 0;background-color: #fff;z-index: 9999999999;line-height: 1.42857143;will-change: transform;transform: translateZ(0);box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 3px rgba(0, 0, 0, 0.24);}
.bottom-nav-item {display: flex;flex-direction: column;flex-grow: 1;justify-content: center;text-align: center;font-size: 0.8rem;color: #525252;font-weight: 600; position: relative;}
.bottom-nav-link {display: flex;flex-direction: column;}
.bottom-nav-link i{font-size: 20px;}
.bottom-nav-link .active {color: #d32f2f;} @media (max-width: 768px) {#searchKey{border-radius: 4px 0px 0px 4px;}.footer-container{margin-bottom: 48px;}.back-to-top{bottom: 50px;}}
.typeheader-6 { background:#2d2d38; color: #ffffff !important }
.megamenu-style-dev .title-mega{color: #ffffff;}
.header-bottom{background: #c66f05;box-shadow: 0 1px 4px rgb(0 0 0 / 8%);}
  #getCartHead {color: #777;}
.megamenuToogle-wrapper .container{color: #000;}
.typeheader-6 .header_custom_link .compare a {background: url('{{asset('frontend/image/icon/icon-compare2.png')}}') no-repeat center;}
.typeheader-6 .header_custom_link .wishlist a {background: url('{{asset('frontend/image/icon/icon-wishlist2.png')}}') no-repeat center;}
.typeheader-6 .header-cart h2.title-cart2{color:#ffffff;}
.typeheader-6 .header-cart .btn-shopping-cart .fa-check-circle, .header-top a, .typeheader-6 .header-cart .btn-shopping-cart .cart-total-full{color: #ffffff !important;}
.typeheader-6 .header-center{background: #2d2d38; color: #ffffff }
.header-bottom-left{background: #2d2d38; color: #ffffff }
.nav-b i{color: #ffffff }
.dropdown-menu > li > a{color: #000 !important}
#typeheadsection{z-index: 999999; width: 100%;height: 100%;top: 50%; left: 50%;ransform: translate(-50%, -50%);text-align: center;position: fixed; background: #e6e4e4 url('{{asset('assets/images/loading.gif') }}') no-repeat center;}    
#dataLoading{z-index: 999999;  width: 100%;  height: 100%; top: 50%;  left: 50%; text-align: center; display: none;
transform: translate(-50%, -50%); position: absolute; background: #ffffffe0 url('{{asset('assets/images/loading.gif') }}') no-repeat center;}
#loadingData { z-index: 999999; width: 100%; height: 100%; top: 50%; left: 50%; transform: translate(-50%, -50%); display: none; position: absolute; background: url('{{asset('assets/images/loading.gif') }}') no-repeat center; }
.loadingData-sm { z-index: 9999; width: 100%; height: 20px; background: url('{{asset('assets/images/loading.gif') }}') no-repeat center; }
#process{  display: none; width: 100%; position: absolute; height: 100%; z-index: 9999; background: #ffffffb3 url('{{asset('assets/images/loading.gif') }}') no-repeat center; }
.footer_area{background: {{ config('siteSetting.footer_bg_color') }}; color: {{ config('siteSetting.footer_text_color') }} }
.footer_area span,  .footer_area a,  .footer_area h4,  .footer_area i{color: {{ config('siteSetting.footer_text_color') }} !important; }
.footer_area .title-footer{border-bottom:1px solid {{ config('siteSetting.footer_text_color') }} !important; }
.footer_area li a:before{background: {{ config('siteSetting.footer_text_color') }} !important;}
.copyright_area{ background: {{ config('siteSetting.copyright_bg_color') }} !important; color: {{ config('siteSetting.copyright_text_color') }} !important; }
.socials a{border-radius: 50px;
    box-shadow: 0 0 8px 0 rgb(77 73 112 / 12%);
    display: inline-block;
    font-size: 16px;
    height: 30px;
    line-height: 30px;
    margin: 0 0 0 1px;
    box-shadow: 0 2px 5px 0 rgb(77 73 112 / 12%);
    text-align: center;
    width: 30px;
    color: #343a40; }
    .product-cart-with-wishlist{display: flex;
    justify-content: space-between;
    align-items: flex-end;}
.product-cart-with-wishlist button{
    box-shadow: none;
    color: #fff;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    border: none;
    border-radius: 20px; padding: 0 15px 0 10px;
    background: #2e3192;
    height: 28px;
    line-height: 20px;
    outline: none;
    transition: 0.3s all ease 0s;
    position: relative;
}
.product-cart-with-wishlist .wishlists{cursor: pointer; background: #ff3c3c;color: #fff; padding: 3px 10px;border-radius: 50%;}
.product-item-container{box-shadow: 0 2px 4px 0 rgb(0 0 0 / 15%);}
@media (max-width: 512px) {
    .product-cart-with-wishlist button{padding: 6px 8px;line-height: 15px;height: auto;font-size: 10px;}
    .product-cart-with-wishlist button i{font-size: 12px !important;}
}
</style>






@yield('perpage-css')