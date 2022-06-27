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
                    <img width="200" src="{{ asset('upload/images/logo/'.Config::get('siteSetting.logo') )}}" title="woadi logo" alt="woadi logo">
                    <p itemprop="name">{{Config::get('siteSetting.about')}}</p>
                    <div class="content-footer">

                      <div class="address">
                        <label><i class="fa fa-map-marker" aria-hidden="true"></i></label>
                        <span itemprop="address">{{Config::get('siteSetting.address')}}</span>
                      </div>
                      <div class="phone">
                        <label><i class="fa fa-phone" aria-hidden="true"></i></label>
                        <a itemprop="tel" href="tel:{{Config::get('siteSetting.phone')}}">{{Config::get('siteSetting.phone')}}</a>
                      </div>
                      <div class="email">
                        <label><i class="fa fa-envelope"></i></label>
                        <a itemprop="email" href="mailto:{{Config::get('siteSetting.email')}}">{{Config::get('siteSetting.email')}}</a>
                      </div>
                    </div>
                  </div>
                </div>
                
                @php $footer_menus = $menus->where('footer', 1); @endphp
                @foreach($footer_menus as $menu)
                <div class="col-lg-{{(count($footer_menus) > 2 )  ? 2 : 3}} col-md-{{(count($footer_menus) > 2 )  ? 2 : 3}} col-sm-6 col-xs-6">
                  <div class="footer-links">
                    <h4 class="title-footer">
                      {{$menu->name}}
                    </h4>
                    <ul class="links">
                      @php
                        $source_id = explode(',', $menu->source_id);
                        $get_pages =  \App\Models\Page::whereIn('id', $source_id)->get();
                      @endphp
                      
                        @if($menu->menu_source == 'page')
                        @foreach($get_pages as $page)
                        <li>
                          <a href="{{ route('page', $page->slug)}}">{{$page->title}}</a>
                        </li>
                        @endforeach
                        @endif
                        @if(count($menu->get_categories)>0)
                          @foreach($menu->get_categories as $category)
                          <li>
                          <a href="{{route('home.category', [$category->get_singleSubcategory->slug, $category->slug])}}" >{{$category->name}}</a>
                          </li>
                          @endforeach
                        @endif
                    </ul>
                  </div>
                </div>
                @endforeach
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
                        @php
                          if(!Session::has('socialLists')){
                              Session::put('socialLists', App\Models\Social::where('type', 'admin')->orderBy('position', 'asc')->where('status', 1)->get());
                          }
                        @endphp
                        @foreach(Session::get('socialLists') as $social)
                        <a style="margin-right:5px;" href="{{$social->link}}" class="facebook" target="_blank" itemprop="sameAs">
                          <i class="fa {{$social->icon}}" style="background:{{$social->background}}; color:{{$social->text_color}}"></i>
                          <p>on</p>
                          <span class="name-social">{{$social->social_name}}</span>
                        </a>
                        @endforeach
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
                    <div class="col-xs-2 col-md-2 "><img alt="ecab logo" src="{{asset('frontend/image/ecab.png')}}"></div>
                    <div class="col-xs-10 col-md-10 footerPaymentImage">
                    <img alt="payment gateway logo" src="{{asset('frontend/image/shurjoPaylogo.png')}}">
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
          {!! config::get('siteSetting.copyright_text') !!}
        </div>
      </div>
    </div>
  </div>
</footer>