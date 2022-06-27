@php $specialSection = App\Models\HomepageSection::with(['sectionItems' => function ($query) {
$query->where('status', '=', 'active')->orderBy('position', 'asc'); }])->where('slug', 'special-item')->where('status', 1)->first(); @endphp
<section class="sliderArea backgroundChange" style="-webkit-transition: all .5s;
    transition: all .5s;">
  <div class="container">
		<div class="row" >
			<div class="col-xs-12 col-md-3 ">
				<div class="megamenu-style-dev megamenu-dev" >
          	<div class="responsive">
              <div class="so-vertical-menu no-gutter">
                  <nav class="navbar-default">
                      <div class=" container-megamenu container vertical  ">
                        <div class="vertical-wrapper">
                          <a class="hidden-lg hidden-md" href="{{url('/')}}"><img width="145" height="45" src="{{asset('upload/images/logo/'.Config::get('siteSetting.logo'))}}" title="Home" alt="Logo" style="margin-top: 5px;"></a><span id="remove-verticalmenu">✕</span>

                          <div class="megamenu-pattern">
                            <div class="container">
                              <ul class="megamenu" data-transition="slide" data-animationtime="300">
                              	@php
                              	if(!Session::has('categories')){
  					                        $categories =  \App\Models\Category::where('parent_id', '=', null)->orderBy('orderBy', 'asc')->where('status', 1)->get();
  					                        Session::put('categories', $categories);
  					                    }
  					                    $categories = Session::get('categories'); 
  					                    @endphp
                              @foreach($categories as $category)
                                @if(count($category->get_subcategory)>0)
                                	@if(config('siteSetting.header_menu') == 'mega')
                                	<li class="item-vertical  css-menu with-sub-menu hover">
                                    <p class="close-menu"></p>
                                    <a href="{{ route('home.category', $category->slug) }}" class="clearfix">
                                    <span>
                                    <strong><img width="20" src="{{asset('upload/images/category/thumb/'.$category->image)}}" alt="{{$category->name}}"> {{$category->name}}</strong>
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
                                    <strong><img width="18" src="{{asset('upload/images/category/thumb/'.$category->image)}}" alt="{{$category->name}}"> {{$category->name}}</strong>
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
                                    <strong><img width="30" src="{{asset('upload/images/category/thumb/'.$category->image)}}" alt="{{$category->name}}"> {{$category->name}}</strong>
                                    </span>
                                    </a>
                                  </li>
                                @endif
                                @endforeach

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
			
			<div class="col-xs-12 col-md-{{($specialSection) ? 6 : 9}} "  style="padding: 8px 0 0 8px;;margin:0px;">
				<div class="module sohomepage-slider so-homeslider-ltr">
					
							<div class="so-homeslider yt-content-slider full_slider owl-drag" data-rtl="yes" data-autoplay="yes" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="10" data-items_column00="1" data-items_column0="1" data-items_column1="1" data-items_column2="1"  data-items_column3="1" data-items_column4="1" data-arrows="yes" data-pagination="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
							@foreach($sliders as $index => $slider)
								 <a href="{{$slider->btn_link}}" target="_self">
								 <img class="responsive" src="{{asset('upload/images/slider/'.$slider->phato)}}" alt="{{$slider->title}}">
								 </a>
							
							@endforeach
						 </div>
				</div>
				
				
				
				
				<div class="row util-clearfix hidden-xs" style="background: url('https://oibazar.com/upload/images/homepage/newuser_bg1.png') 0px 0px / cover no-repeat rgb(255, 245, 245);padding: 10px 0 0; overflow: hidden;">
<div class="_1Z9xI col-md-4">
<div class="_90Rvw">
<h3>New User Benefits</h3>
<p>$ First Order-Choose One Gift</p>
</div>
<a>
<div class="_2oXSl">
<strong class="_1OU-S">Free Gifts &amp; US$2</strong>
<p>Allowance</p>
</div>
</a>
</div>
<div class="col-md-8 hxje9">
<div class="category-slider-inner products-list yt-content-slider releate-products grid" data-rtl="yes" data-autoplay="yes" data-pagination="no" data-delay="15" data-speed="1" data-margin="3" data-items_column0="3" data-items_column1="3" data-items_column2="3" data-items_column3="3" data-items_column4="2" data-arrows="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
<div class="_3Vh1O">
<img src="https://oibazar.com/upload/images/homepage/ezgif.com-gif-maker-(3).jpg" alt="" />
<span class="_70E3C">$ 189.39</span>
</div>
<div class="_3Vh1O">
<img src="https://oibazar.com/upload/images/homepage/ezgif.com-gif-maker-(2).jpg" alt="" />
<span class="_70E3C">$ 189.39</span>
</div>
<div class="_3Vh1O">
<img src="https://oibazar.com/upload/images/homepage/ezgif.com-gif-maker-(1).jpg" alt="" />
<span class="_70E3C">$ 189.39</span>
</div>
 <div class="_3Vh1O">
<img src="https://oibazar.com/upload/images/homepage/ezgif.com-gif-maker.jpg" alt="" />
<span class="_70E3C">$ 189.39</span>
</div>
<div class="_3Vh1O">
<img src="https://oibazar.com/upload/images/homepage/ezgif.com-gif-maker-(1).jpg" alt="" />
<span class="_70E3C">$ 189.39</span>
</div>
<div class="_3Vh1O">
<img src="https://oibazar.com/upload/images/homepage/ezgif.com-gif-maker.jpg" alt="" />
<span class="_70E3C">$ 189.39</span>
</div>
<div class="_3Vh1O">
<img src="https://oibazar.com/upload/images/homepage/ezgif.com-gif-maker-(2).jpg" alt="" />
<span class="_70E3C">$ 189.39</span>
</div>
<div class="_3Vh1O">
<img src="https://oibazar.com/upload/images/homepage/ezgif.com-gif-maker-(3).jpg" alt="" />
<span class="_70E3C">$ 189.39</span>
</div>
</div>
</div>
</div>
</div>
<div class="col-xs-12 col-md-3 hidden-xs" style="padding-top: 8px;">
<div class="hot1kB2E" style="background-image: url('https://oibazar.com/upload/images/bds.png');">
<div class="hot86U7Z">
<div class="hot1a8KA">
<img src="https://oibazar.com/upload/users/default.png" />
</div>
<div class="hot3UD">Hi, Test</div>
</div>
<div class="_2kPHY">
<a class="h189IM" href="https://oibazar.com/dashboard">
<i class="fa fa-user-o" aria-hidden="true"></i><p>Account</p>
</a>
<a class="h189IM" href="https://oibazar.com/order/history">
<i class="fa fa-file-text-o" aria-hidden="true"></i><p>Orders</p>
</a>
<a class="h189IM" href="https://wa.me/8801781077094">
<i class="fa fa-whatsapp" aria-hidden="true"></i><p>Messages</p>
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
<span class="policy-see"><a href="https://oibazar.com/privacy-policy">See More</a></span>
<span class="policy-bg"></span>
</div>
</div>
</div>
</div>
</div>
</section> 