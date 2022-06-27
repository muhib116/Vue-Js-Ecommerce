<?php
if(Auth::check()){
  $user_id = Auth::id();
}else{
  $user_id = (Cookie::has('user_id') ? Cookie::get('user_id') :  Session::get('user_id'));
}
$getCart = App\Models\Cart::where('user_id', $user_id)->count();
?>
<style>
button.btn.btn-secondary.dropdown-toggle.users {
    background: transparent;
    color: #ffffff;
    border: 0;
    padding: 10px 0;
    margin-right: 10px;
    font-size: 16px;
    font-weight: bold;
}
.dropdown-toggle::after {
    display: inline-block;
    margin-left: .255em;
    vertical-align: .255em;
    content: "";
    border-top: .3em solid;
    border-right: .3em solid transparent;
    border-bottom: 0;
    border-left: .3em solid transparent;
}
.dropdown-item.signin a {
    background: #f68b1e;
    padding: 10px !important;
    text-align: center;
    color: white !important;
    font-size: 16px;
    font-weight: bold;
}
.dropdown-item.signin a:hover {
    background: #f68b1e !important;
    color: wheat !important;
}
.dropdown-menu.dropdown-menu-lg-right a {
    padding: 5px 10px;
    font-size: 15px;
    width: 100%;
    display: block;
    color: #333;
}
.dropdown-menu.dropdown-menu-lg-right a:hover {
    background: #f5f5f5;
    color: black;
}
p.dropdown-item.signin {
    padding: 10px;
    border-bottom: 2px solid #ededed;
    margin-bottom: 10px;
}
header .open > .dropdown-menu {
    margin-top: 0;
    opacity: 1;
    filter: alpha(opacity=100);
    visibility: visible;
    width: 250px;
    margin-right: 10px;
}
.typeheader-6 #sosearchpro.so-search .button-search {
    border-color: #f68b1e;
    background: #f68b1e;
    box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%);
    padding: 10px 30px;
    margin-left: 10px;
    color: white;
}
a.-df.-i-ctr.-gy8.-hov-or5.-phs.-fs16 {
    float: right;
    margin-top: 5px;
    display: flex;
    height: 25px;
    font-size: 16px;
    color: #333;
}
a.-df.-i-ctr.-gy8.-hov-or5.-phs.-fs16 i {
    font-size: 24px;
    color: black;
    margin-right: 5px;
}
span.-mrs.-fs0 p {
    padding: 0 5px;
    background: #f68b1e;
    position: relative;
    top: -12px;
    color: white;
    right: 13px;
    border-radius: 50%;
    height: 16px;
    display: flex;
    align-content: center;
    justify-content: center;
    align-items: center;
    font-size: 10px;
}
p.dropdown-item.signin.ss {
    padding-top: 10px;
    padding-bottom: 0;
    border-bottom: 0;
    margin-top: 15px;
    border-top: 2px solid #ededed;
}
.herakhan {
    font-size: 14px;
    border-bottom: 1px solid #ccc;
    padding-bottom: 10px;
    font-weight: bold;
}
b.caret {
    display: none;
}

.fixed-top {
    position: fixed;
    top: 0;
    right: 0;
    left: 0;
    z-index: 1030;
    background: white;
}
.typeheader-6 #sosearchpro.so-search .button-search p {
    color: white;
}
.srcBtn{border:none;background: #de1f26;border-top-right-radius: 4px;
    border-bottom-right-radius:4px }
    .logo{ float: left; margin-top: 5px;width: 185px;}
@media  only screen and (min-width: 1098px) { #navbar_top .col-md-6{width: 50%;} }
@media  only screen and (max-width: 1000px) {
    .logo{height: 40px; width: inherit;}
    .srcBtn{background: transparent;} 
.col-md-55 {width: 100%;}
b.caret {
    display: block;
}
li.item-style2.content-full.feafute.with-sub-menu.hover {
    width: 100%;
}
.-df.-j-end {
    display: flex;
    justify-content: flex-end;
    align-items: center;
}
a.nav-b.-mhs {
    font-size: 20px;
    padding: 10px 12px;
    display: block;
    color: black;
    font-weight: bold;
}
button.nav-b {
    border: 0;
    background: transparent;
    font-size: 20px;
    padding: 5px;
    display: block;
}
.-df.-j-end .cart {
    padding: 10px;
    box-shadow: 0 0 0 0 rgb(0 0 0 / 0%);
}
.modal.right .modal-dialog {
    position: fixed;
    margin: auto;
    width: 100%;
    height: 100%;
    -webkit-transform: translate3d(0%, 0, 0);
        -ms-transform: translate3d(0%, 0, 0);
         -o-transform: translate3d(0%, 0, 0);
            transform: translate3d(0%, 0, 0);
}
.modal.right .modal-content {
        height: 100%;
        overflow-y: auto;
    }
.modal.right .modal-body {
        padding: 15px 15px 80px;
    }
        
/*Right*/
.modal.right.fade .modal-dialog {
    right: -320px;
    -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
       -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
         -o-transition: opacity 0.3s linear, right 0.3s ease-out;
            transition: opacity 0.3s linear, right 0.3s ease-out;
}

.modal.right.fade.in .modal-dialog {
    right: 0;
}
.modal-content {
    border-radius: 0;
    border: none;
}
#myModal2 .modal-header .close {
    float: left;
    display: flex;
    margin: 10px 11px 0 0px;
}
#myModal2 .modal-header {
    border-bottom-color: #EEEEEE;
    background-color: #FAFAFA;
    display: flex;
}
.btn-demo {
    border-radius: 0;
    font-size: 16px;
    background-color: #FFFFFF;
}
.fa-search:before {
    content: "\f002";
   
}
.btn-demo:focus {
    outline: 0;
}
button.button-searchs.btn.btn-default.btn-lg {
    padding: 8px;
}
.typeheader-6 #sosearchpro.so-search .button-search {
    border-color: #fff;
    background: #fff;
    box-shadow: 0 0px 0px 0 rgb(0 0 0 / 20%);
    padding: 10px;
    margin-left: 0;
    color: white;
}
.typeheader-6 #sosearchpro.so-search {
    width: 100% !important;
}
.typeheader-6 #sosearchpro.so-search .search {
    border-radius: 20px !important;
}
}
.form-control:focus {
    border-color: 0;
    outline: 0;
    -webkit-box-shadow: 0;
    box-shadow: 0;
}
#search0 .form-control {
    border: 0;
}
.typeheader-6 #sosearchpro.so-search .search {
    width: 100%;
    display: flex;
 
    border-radius: 5px;
}
div#search0 i {
    font-size: 16px;
    float: left;
    padding: 10px 10px;
    color: #fff;
}
span.-mrs.-fs0 {
    font-weight: bold;
    display: flex;
    align-items: center;
}
span.-mrs.-fs0 img {
    margin-right: 5px;
}
.modal-homesearch a {
    padding-right: 5px;
    margin: 0;
    color: gray;
}
.modal-homesearch  a:hover {
    color: rgb(255, 110, 38);
    transition: color 0.4s ease 0s;
}

#searchResult{position: absolute;top:43px;width: 100%;left: 0;background: #fff;display: inline-block;z-index: 9999;padding: 5px 0;display: none;}
</style>
<!-- Header Top -->
<header id="header" class="typeheader-6">
    <div class="row" style="padding: 0;">
<a class="col16 ar _1168-56 hidden-xs hidden-sm" href="#">
<img src="https://oibazar.com/upload/images/banner/231456879.png" alt="" style="width: 100%; border-radius: 0;">
</a>
</div>
  <!-- mobile menu  -->
    <!-- mobile menu  -->
        <nav class="bottom-nav hidden-lg hidden-md">
            
            
            <a href="/" class="bottom-nav-item">
            <div class="bottom-nav-link">
            <i class="fa fa-home"></i>
            <span>Home</span>
            </div>
            </a>
            
            
            <a href="{{route('campaigns')}}" class="bottom-nav-item">
            <div class="bottom-nav-link">
            <i class="fa fa-bullhorn"></i>
            <span>Offers</span>
            </div>
             </a>
             
             
            <a href="{{route('cart')}}" class="bottom-nav-item" style="align-items: center;">
            <div class="bottom-nav-link" style="background: #ff471a;border-radius: 50%;justify-content: center!important;width: 50px;height: 50px;color: #fff;margin: -30px 0 0px;padding: 5px;border: 5px solid #ffffff!important;" id="cart" data-menu="#main-nav" class="cart cart_open">
            <i class="cartCount" style="z-index: 1;top: -30px;right: 48px;min-width: 18px;height: 18px;line-height: 12px;font-size: 11px;padding: 3px;background: #ff6e26;border-radius: 12px;position: absolute;color: #fff;">{{$getCart}}</i>
        <i class="fa fa-cart-plus"></i>
            </div>
            <span>Cart</span>
            </a>
            
            
            <a href="{{route('wishlists')}}" class="bottom-nav-item">
            <div class="bottom-nav-link">
            <i class="fa fa-heart"></i>
            <span>Wishlist</span>
            </div>
            </a>
            
            
            @if(Auth::check())
            <div class="bottom-nav-item open-sidebar">
              <div class="bottom-nav-link">
                <i class="fa fa-user-circle"></i>
                <span>Dashboard</span>
              </div>
            </div>
            @else
            <div class="bottom-nav-item">
              <div class="bottom-nav-link" data-toggle="modal" data-target="#so_sociallogin">
                <i class="fa fa-user-circle"></i>
                <span>Account</span>
              </div>
            </div>
            @endif
            
            
        </nav>
        
        
        
        <div id="navbar_top" class="header-center">
            <div class="container">
            <div class="row">
            <div class="navbar-logo col-md-3 col-sm-3 col-xs-12" style="padding: 0;max-height: 50px;">
            <button type="button" style="float: left;margin-left: 0" id="show-verticalmenu" data-toggle="collapse" class="navbar-toggle">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
           
             <div class="mobile">
            <a href="{{ url('/') }}"><img class="logo" src="{{asset('upload/images/logo/'.Config::get('siteSetting.logo'))}}" title="Home" alt="Logo"></a>
            <div class="-df -j-end hidden-lg hidden-md demo">
            <button type="button" class="btn btn-demo @if(!Request::is('/')) nav-b @endif" data-toggle="modal" data-target="#myModal2"><i class="fa fa-search" aria-hidden="true"></i></button>
            @if(!Auth::check())
           <a data-toggle="modal" data-target="#so_sociallogin" class="nav-b -mhs"><i class="fa fa-user-o" aria-hidden="true"></i></a>
           @else
            <a href="{{route('user.dashboard')}}" class="nav-b -mhs"><i class="fa fa-user-o" aria-hidden="true"></i></a>
           @endif
            <div id="cart" data-menu="#main-nav" class="cart cart_open">
            <span class="-df -i-ctr -gy8 -hov-or5 -phs -fs16" href="javascript:void(0)">
            <span class="-mrs -fs0" data-bdg="0"><img width="25" height="25" src="{{ asset('upload/images/shopping-cart.png') }}" title="shopping-cart" alt="shopping-cart"><p class="cartCount">0</p></span>
            </span>
            </div>
            </div>
            </div>
            
            </div>
            <div class="header-center-right col-md-6 col-sm-6 col-xs-12 @if(!Request::is('/')) hidden-xs hidden-sm @endif">
                <div class="header_search">
                    <div id="sosearchpro" class="sosearchpro-wrapper so-search ">
                        <form method="GET" action="{{ route('product.search') }}">
                        <div id="search0" class="search input-group form-group">
                        <input title="Search products, brands and categories" class="form-control searchKey" type="text" style="width: 100%;height: 40px; background: #fff0;float: initial;" name="q" value="@if(Request::get('q')) {!! preg_replace('/"/',' ',Request::get('q') ) !!} @endif" id="searchKey" required placeholder="Search, Whatever you needs...">
                        <button title="Search products, brands and categories" class="srcBtn" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <div id="searchResult" class="searchResult"></div>
                        </div>
                        </form>
                    </div>
            </div>
            
            <div class="modal-homesearch">
            @foreach(\App\Models\Keyword::take(8)->orderBy('search', 'desc')->get() as $keyword)
            <a href="{{ route('product.search') }}?q={{$keyword->text}}">{{$keyword->text}}</a>
            @endforeach
            </div>
            
            </div>
          
            <div class="header-cart-phone col-lg-3 col-md-3 col-xs-3 hidden-xs hidden-sm">
            <div id="cart" data-menu="#main-nav" class="cart cart_open">
            <a class="-df -i-ctr -gy8 -hov-or5 -phs -fs16" href="javascript:void(0)">
            <span class="-mrs -fs0" data-bdg="0"><img width="25" height="25" src="{{ asset('upload/images/shopping-cart.png') }}" title="shopping-cart" alt="shopping-cart"> <p class="cartCount">0</p></span>
            </a>
            </div>
            <div class="btn-group user">
            @if(Auth::check())
            <button type="button" class="btn btn-secondary dropdown-toggle users" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
            <img width="25" height="25" style="border-radius:50%;border: 1px solid yellow;" src="{{ asset('upload/users') }}/{{(Auth::user()->photo) ? Auth::user()->photo : 'default.png'}}"> {{ \Illuminate\Support\Str::limit(Auth::user()->name, 7,'..')  }}
            </button>
            @else
            <button type="button" class="btn btn-secondary dropdown-toggle users" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user-o" aria-hidden="true" style="padding-right: 3px;font-size: 16px;"></i> Account
            </button>
            @endif
            <div class="dropdown-menu dropdown-menu-lg-right">


            @if(Auth::check())
            @if(Auth::guard('admin')->check()) 
            <p class="dropdown-item signin"><a href="{{route('admin.dashboard')}}">Admin Dashboard</a></p>
            @else
            <p class="dropdown-item signin"><a href="{{route('user.dashboard')}}">Dashboard</a></p>
            @endif
            <a href="{{ route('user.myAccount') }}" class="dropdown-item" type="button"><i class="fa fa-user-o" aria-hidden="true"></i> My Account</a>
            <a href="{{route('user.orderHistory')}}" class="dropdown-item" type="button"><i class="fa fa-archive" aria-hidden="true"></i> Order</a>
            <a href="{{ route('wishlists') }}" class="dropdown-item" type="button"><i class="fa fa-heart" aria-hidden="true"></i> Saved Items</a>
            <a href="{{route('customer.walletHistory')}}" class="dropdown-item" type="button"><i class="fa fa-credit-card" aria-hidden="true"></i></i> My Wallet</a>
            <a href="{{route('user.change-password')}}" class="dropdown-item" type="button"><i class="fa fa-key" aria-hidden="true"></i>Change Password</a>
            <a href="{{route('productCompare')}}" class="dropdown-item" type="button"><i class="fa fa-compress" aria-hidden="true"></i> Saved Items</a>
            <a href="{{route('userLogout')}}" class="dropdown-item" type="button"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>                     
                                
        @else
            <p class="dropdown-item signin"><a data-toggle="modal" data-target="#so_sociallogin" type="button">Sign In</a></p>
            <a href="{{route('user.dashboard')}}" class="dropdown-item" type="button"><i class="fa fa-user-o" aria-hidden="true"></i> My Account</a>
            <a href="{{route('user.orderHistory')}}" class="dropdown-item" type="button"><i class="fa fa-archive" aria-hidden="true"></i> Order</a>
           
             <a href="{{route('productCompare')}}" class="dropdown-item" type="button"><i class="fa fa-compress" aria-hidden="true"></i> Saved Items</a>
            <a href="{{ route('wishlists') }}" class="dropdown-item" type="button"><i class="fa fa-heart" aria-hidden="true"></i> Saved Items</a>

        @endif
            </div>
            </div>
            
            
            <div class="btn-group user">
            <button type="button" class="btn btn-secondary dropdown-toggle users" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-question-circle-o" aria-hidden="true" style="font-size: 16px;"></i> Help
            </button>
            <div class="dropdown-menu dropdown-menu-lg-right">
            <a href="#" class="dropdown-item" type="button">Help Center</a>
            <a href="{{ route('orderTracking') }}" class="dropdown-item" type="button">Place &amp; Track Order</a>
            <a href="#" class="dropdown-item" type="button">Order Cancellation</a>
            <a href="#" class="dropdown-item" type="button">Returns &amp; Refunds</a>
            <a href="#" class="dropdown-item" type="button">Payment &amp; Account</a>
            <p class="dropdown-item signin ss"><a href="https://wa.me/Config::get('siteSetting.whatsapp')" type="button"><i class="fa fa-commenting-o" aria-hidden="true"></i> Live Help</a></p>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            
            
            <div class="header-bottom hidden-compact">
            <div class="container">
            <div class="header-bottom-inner">
            <div class="row">
            <div class="header-bottom-left menu-vertical col-md-3 col-sm-6 col-xs-7">
            <div class="megamenu-style-dev megamenu-dev">
            <div class="responsive">
            <div class="so-vertical-menu no-gutter">
            <nav class="navbar-default">
            <div class=" container-megamenu  container   vertical  " style="background:transparent;">
            <a href="{{route('home.category')}}">
            <div id="menuHeading">
            <div class="megamenuToogle-wrapper">
            <div class="megamenuToogle-pattern">
            <div class="container">
            <span class="title-mega">
            <i class="fa fa-bars"></i> All Categories </span>
            </div>
            </div>
            </div>
            </div></a>
            
            @if(!Request::is('/'))
                                        <div class="vertical-wrapper">
                                          <span id="remove-verticalmenu" class="fa fa-times"></span>
                                          <div class="megamenu-pattern">
                                            <div class="container">
                                              <ul class="megamenu" data-transition="slide" data-animationtime="300">
                                              @foreach($categories as $category)
                                                @if(count($category->get_subcategory)>0)
                                                  @if(config('siteSetting.header_menu') == 'mega')
                                                  <li class="item-vertical  css-menu with-sub-menu hover">
                                                    <p class="close-menu"></p>
                                                    <a href="{{ route('home.category', $category->slug) }}" class="clearfix">
                                                    <span>
                                                    <strong> {{$category->name}}</strong>
                                                    </span>
                                                    <b class="fa fa-caret-right"></b>
                                                    </a>
                                                    <div class="sub-menu" style="width: 934px;">
                                                      <div class="content">
                                                        <div class="row">
                                                          <div class="col-sm-3">
                                                            <div class="row">
                                                              @php $max_iteration = round(count($category->get_subcategory) / 4);  @endphp
                                                              @foreach($category->get_subcategory as $menuRow => $subcategory)
                                                          
                                                                <div class="col-sm-12 static-menu">
                                                                  <div class="menu">
                                                                    <ul>
                                                                      <li>
                                                                        <a href="{{ route('home.category', [$category->slug, $subcategory->slug]) }}" class="main-menu">{{$subcategory->name }}
                                                                        </a>
                                                                        @if(count($subcategory->get_subcategory)>0)
                                                                        <ul>
                                                                          @foreach($subcategory->get_subcategory as $childcategory)
                                                                          <li><a href="{{ route('home.category',[ $category->slug, $subcategory->slug, $childcategory->slug]) }}" > {{$childcategory->name}}</a></li>
                                                                          @endforeach
                                                                        </ul>
                                                                        @endif
                                                                      </li>
                                                                    </ul>
                                                                  </div>
                                                                </div>
                                                              @if(($menuRow + 1) % $max_iteration == 0)
                                                            </div>
                                                          </div> <div class="col-sm-3">
                                                            <div class="row">@endif
                                                           @endforeach
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </li>
                                                  @else
                                                  <li class="item-vertical  css-menu with-sub-menu hover">
                                                    <p class="close-menu"></p>
                                                    <a href="{{ route('home.category', $category->slug) }}" class="clearfix">
                                                    <span>
                                                    <strong> {{$category->name}}</strong>
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
                                                                      @foreach($category->get_subcategory as $subcategory)
                                                                      <li>
                                                                        <a href="{{ route('home.category', [$category->slug, $subcategory->slug]) }}"  class="main-menu"> {{$subcategory->name}}
                                                                          @if(count($subcategory->get_subcategory)>0)
                                                                          <b class="fa fa-angle-right"></b>
                                                                          @endif
                                                                        </a>
                                                                        @if(count($subcategory->get_subcategory)>0)
                                                                        <ul>
                                                                          @foreach($subcategory->get_subcategory as $childcategory)
                                                                          <li><a href="{{ route('home.category',[ $category->slug, $subcategory->slug, $childcategory->slug]) }}" > {{$childcategory->name}}</a></li>
                                                                          @endforeach
                                                                        </ul>
                                                                        @endif
                                                                      </li>
                                                                      @endforeach
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
                                                  @endif
                                                @else
                                                  <li class="item-vertical">
                                                    <p class="close-menu"></p>
                                                    <a href="{{ route('home.category', $category->slug) }}" class="clearfix">
                                                    <span>
                                                    <strong> {{$category->name}}</strong>
                                                    </span>
                                                    </a>
                                                  </li>
                                                @endif
                                                @endforeach
                                              </ul>
                                            </div>
                                          </div>
                                        </div>
                                        @endif
            </div>
            </nav>
            </div>
            </div>
            </div>
            </div>
            
            
            <div class="header-bottom-right col-md-9 col-sm-12 col-xs-12">
            <div class="header-menu">
            <div class="megamenu-style-dev megamenu-dev">
            <div class="responsive">
            <nav class="navbar-default">
            <div class="container-megamenu horizontal">
            <div class="megamenu-wrapper">
            <a class="hidden-lg hidden-md" href="https://oibazar.com"><img width="145" height="45" src="{{asset('upload/images/logo/'.Config::get('siteSetting.logo'))}}" title="Home" alt="Logo" style="margin-top: 5px;"></a><span id="remove-megamenu">✕</span>
            <div class="megamenu-pattern">
            <div class="container">
            <ul class="megamenu" data-transition="slide" data-animationtime="500">
           
            <li class="hidden-lg hidden-md"><a href="{{route('vendorLogin')}}">Be a Seller</a></li>
                                                  @foreach($menus->where('top_header', 1) as $menu)
                                                  <li class="hidden-lg hidden-md"><a  href="{{  route('page', $menu->get_pages->slug)}}">{{$menu->get_pages->title}}</a></li>
                                                  @endforeach
                                                  @if(count($menus)>0)
                                                    @foreach($menus->where('main_header', 1) as $menu)
                                                      @if($menu->menu_source == 'category')
                                                      <li class="item-style2 content-full feafute with-sub-menu hover">
                                                        <p class="close-menu"></p>
                                                          <a class="clearfix">
                                                          <strong>
                                                          {{$menu->name}}
                                                          </strong>
                                                          @if(count($menu->get_categories)>0)
                                                            <b class="caret"></b>
                                                            </a>
                                                            <div class="sub-menu" style="width: 100%">
                                                              <div class="content">
                                                                <div class="categories ">
                                                                  <div class="row">
                                                                    @foreach($menu->get_categories as $category)
                                                                    <div class="col-sm-3 static-menu">
                                                                      <div class="menu">
                                                                        <ul>
                                                                          <li>
                                                                            <a href="{{route('home.category', [$category->get_singleSubcategory->slug, $category->slug])}}" class="main-menu">{{$category->name}}</a>
                                                                            @if(count($category->get_subchild_category)>0)
                                                                            <ul>
                                                                              @foreach($category->get_subchild_category as $childcategory)
                                                                              <li><a href="{{route('home.category', [$category->get_singleSubcategory->slug, $childcategory->get_singleChildCategory->slug, $childcategory->slug])}}">{{$childcategory->name}}</a></li>
                                                                              @endforeach
                                                                            </ul>
                                                                            @endif
                                                                          </li>
                                                                        </ul>
                                                                      </div>
                                                                    </div>
                                                                   @endforeach
                                                                  </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          @else
                                                          </a>
                                                          @endif
                                                      </li>
                                                      @elseif($menu->menu_source == 'page')
                                                      <li class="style-page with-sub-menu hover" @if($menu->name == 'Offers' ) style="border-radius: 1px;background: #ff6a00;border-bottom-right-radius: 15px;border-top-left-radius: 15px;" @endif>
                                                        <p class="close-menu"></p>
                                                        @php
                                                          $source_id = explode(',', $menu->source_id);
                                                          $get_pages =  \App\Models\Page::whereIn('id', $source_id)->get();
                                                        @endphp
                                                        @if(count($get_pages)>0)
                                                          @if(count($get_pages)>1)
                                                            <a class="clearfix"><strong>{{$menu->name}} </strong>
                                                            <b class="caret"></b> </a>
                                                            <div class="sub-menu" style="width: 40%;">
                                                              <div class="content" >
                                                                <div class="row">
                                                                  <div class="col-md-6">
                                                                    <ul class="row-list">
                                                                      @foreach($get_pages as $page)
                                                                      <li><a class="subcategory_item" href="{{  route('page', $page->slug)}}">{{$page->title}}</a></li>
                                                                      @endforeach
                                                                    </ul>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          @else
                                                           <a href="{{  route('page', $get_pages[0]->slug)}}" class="clearfix">
                                                            <strong> {{$menu->name}} </strong>
                                                            </a>
                                                          @endif
                                                        @endif
                                                      </li>
                                                      @else @endif
                                                    @endforeach
                                                  @endif
                                                  @if(Auth::check())
                                                  <li class="hidden-lg hidden-md"><a href="{{route('userLogout')}}"><i class="fa fa-power-off"></i> Logout </a> </li>
                                                  @endif
            
                       
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
                                </div>
                                </div>
                                </div>
                                </div>
                                
                                
            
            <div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
            <div id="sosearchpro" class="sosearchpro-wrapper so-search ">
            <form method="GET" action="{{ route('product.search') }}">
            <div id="search0" class="search input-group form-group">
            <input title="Search products, brands and categories" name="q" class="form-control searchKey" type="text" style="background: #fff0;float: initial;" value="@if(Request::get('q')) {!! preg_replace('/"/',' ',Request::get('q') ) !!} @endif" required placeholder="Search products, brands and categories">
            <span class="input-group-btn hidden-xs">
            <button title="Search products, brands and categories" type="submit" class="button-searchs btn btn-default btn-lg"><i class="fa fa-search" aria-hidden="true"></i></button>
            </span>
            </div>
            </form>
            </div>
            </div>
            <div class="modal-body" style="padding:0">
            <div style="top: 0;" id="searchResult" class="searchResult"></div>
            </div>
            </div>
            </div>
            </div>
            </header>
        