@extends('layouts.frontend')
@section('title', $liveSession->title . '| Live Sessions')
@section('css')
<style type="text/css">
.breadcrumbTitle{color: #ff6e26;font-size: 24px;font-family: OpenSans;display: inline-block !important; font-weight: 600; padding-right: 10px;}
.item-wrap-inner{margin: 8px 0 2px !important;padding: 3px !important;}
#tutVidTitle { 
  background: #fff;
  color: #000;
  padding: 15px;
}

#videoWrapper {
  position: relative;
  width: 100%;
  height: 0;
  padding-bottom: 56.25%;
  overflow: hidden;
}
iframe {
  position: absolute;
  top: 0; left: 0;
  width: 100%; height: 100%;
}
#videoList {
  flex: 1;
  display: flex;
  flex-direction: column;
  padding: 5px;
  background: #151515;
max-height: 500px;
overflow: scroll;
  align-items: center;
}
#videoList a {
  text-decoration: none;
  color: #fff;
  display: inline-block;
  width: 100%;
  transition: .4s;
  border-bottom: 1px solid #2E2E2E;
}
#videoList a:hover, #videoList a:active {
background: #000;
  text-shadow: .5px .5px black;
}
.item-title{color: #fff;line-height: 14px;}
@media screen and (max-width: 800px) {
  #mainContent {
    flex-direction: column;
  }
  #videoList {
    padding-top: 20px;
    margin: 5px 0;
  }
}
.live-info ul{display: inline-block;}
.live-info ul li{display: inline-block;color: #666;margin-right: 10px;}
.video-list-thumbs  li{margin-bottom:12px;}

.live-session{background: #fff;padding:10px; border-radius: 5px;}
.live-session h4{margin-bottom: 5px;min-height: 30px; font-size: 14px;color: #333;}
.live-info ul{display: inline-block;}
.live-info ul li{display: inline-block;color: #666;margin-right: 10px;}
.video-list-thumbs  li{margin-bottom:12px;}
.video-list-thumbs  li  a{display:block;position:relative;color: #e2e0e0;border-radius:3px;transition:all 500ms ease-in-out;border-radius:4px}
.video-list-thumbs h2{bottom: 0;font-size: 14px;min-height: 33px;margin: 8px 0 0;}
.video-list-thumbs .fa-play-circle-o{font-size: 60px;position: absolute;right: 39%;top: 31%;text-shadow: 0 1px 3px rgba(0,0,0,.5);transition:all 500ms ease-in-out;}
.video-list-thumbs  li  a:hover .fa-play-circle-o{color:#fff;opacity:1;text-shadow:0 1px 3px rgba(0,0,0,.8);}
.video-list-thumbs .duration{background-color: rgba(0, 0, 0, 0.4);border-radius: 2px;color: #fff;font-size: 11px;font-weight: bold;left: 12px;line-height: 13px;padding: 2px 3px 1px;position: absolute;top: 12px;transition:all 500ms ease;}
.video-list-thumbs  li  a:hover .duration{background-color:#000;}
.product-img{margin-bottom: 3px;}
@media (min-width:320px) and (max-width: 480px) { 
    .video-list-thumbs .fa-play-circle-o{font-size: 35px;right: 36%;top: 27%;}
    .video-list-thumbs h2{bottom: 0;font-size: 12px;height: 22px;margin: 8px 0 0;}
}
.live-session img{margin: inherit;}
.livemoreBtn{padding: 10px;text-align: center;}
</style>
@endsection
@section('content')
    <!-- Main Container  -->
    <div class="breadcrumbs">
        <div class="container">
            <ul class="breadcrumb-cate">
                <li><a href="{{url('/')}}"><i class="fa fa-home"></i> </a></li>
                <li class="breadcrumbTitle">Live Sessions</li>
            </ul>
        </div>
    </div>
    <section style="padding-bottom: 10px;background:{{$liveSession->background_color}};">
    <div class="container" style="padding-top:15px;">
        <div class="row" style="background: #000;">
            <div class="col-md-9" style="padding-left: 0;">
              <div id="videoWrapper">
                <iframe name="tutorial" width="560" height="315" src="https://www.youtube.com/embed/{{$liveSession->video_path}}?rel=0&autoplay=1&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
              </div>
              <div id="tutVidTitle">
                <h4>{{$liveSession->title}}</h4>
                <?php $api_key = "AIzaSyCb3w2vwCXfG1MCI70NOAAHAJi-v1OJEHk";
                            $video_id = $liveSession->video_path;
                            $url = "https://www.googleapis.com/youtube/v3/videos?id=$video_id&key=$api_key&part=contentDetails,statistics";
                            $json = file_get_contents($url);
                            $getData = json_decode( $json , true);
                            $duration =  '00:00';
                        ?>
                        @if(count($getData['items'])>0)
                          @php  $duration =  new DateInterval($getData['items'][0]['contentDetails']['duration']); $duration = $duration->format('%H:%I:%S');  $statistics = $getData['items'][0]['statistics']; @endphp
                          <div class="live-info">
                              <ul>
                                 @if(array_key_exists('viewCount' ,$statistics))
                                  <li>Views: {{ number_format($statistics['viewCount'])}}</li>
                                  @endif
                                  @if(array_key_exists('likeCount' ,$statistics))
                                  <li>Likes: {{number_format($statistics['likeCount'])}}</li>
                                  @endif
                                  @if(array_key_exists('dislikeCount' ,$statistics))
                                  <li>Dislike: {{number_format($getData['items'][0]['statistics']['dislikeCount'])}}</li>
                                  @endif
                                  @if(array_key_exists('commentCount' ,$statistics))
                                  <li> Comments: {{number_format($statistics['commentCount'])}}</li>
                                  @endif
                              </ul>
                          </div>
                        @endif
              </div>
            </div>
            <div class="col-md-3" style="padding:0px;">
                <div id="videoList">
                    <div class="moduletable module so-extraslider-ltr best-seller best-seller-custom">
                        <h3 class="modtitle"><span style="color:#fff">Products List</span></h3>
                        <div class="modcontent">
                          <div id="so_extra_slider" class="so-extraslider buttom-type1 preset00-1 preset01-1 preset02-1 preset03-1 preset04-1 button-type1">
                            <div class="extraslider-inner " >
                                <div class="item ">
                                  @foreach($liveSession->liveProducts as $liveProduct)
                                    <?php  
                                        $best_sale = $liveProduct->product;
                                        $discount = null;
                                        $selling_price = $best_sale->selling_price;
                                        $discount = ($best_sale->discount) ? $best_sale->discount : null;
                                        $discount_type = $best_sale->discount_type;
                                        if($discount){
                                            $calculate_discount = App\Http\Controllers\HelperController::calculate_discount($selling_price, $discount, $discount_type );
                                        }
                                    ?>
                                    <a href="{{ route('product_details', $best_sale->slug) }}" target="_self">
                                    <div class="item-wrap style1 ">
                                        <div class="item-wrap-inner">
                                         <div class="media-left">
                                          <div class="item-image">
                                             <div class="item-img-info product-image-container ">
                                              <div class="box-label">
                                              </div>
                                              
                                              <img style="width: 100px; height:75px" src="{{asset('upload/images/product/thumb/'. $best_sale->feature_image)}}" alt="{{ $best_sale->title }}">
                                             
                                             </div>
                                          </div>
                                         </div>
                                         <div class="media-body">
                                          <div class="item-info">
                                             <!-- Begin title -->
                                             <div class="item-title">
                                             {{Str::limit($best_sale->title, 50)}}
                                             </div>
                                             
                                             <div class="price  price-left" style="font-size: 12px;">
                                              <!-- Begin ratting -->
                                             <div>
                                             {{\App\Http\Controllers\HelperController::ratting(round($best_sale->reviews->avg('ratting'), 1))}}
                                             </div>
                                                <?php  
                                                    $discount = null;
                                                    //check offer active/inactive
                                                    if($best_sale->offer_discount && $best_sale->offer_discount->offer != null){
                                                        $selling_price = $best_sale->selling_price;
                                                        $discount = $best_sale->offer_discount->offer_discount;
                                                        $discount_type = $best_sale->offer_discount->discount_type;
                                                    }else{
                                                        $selling_price = $best_sale->selling_price;
                                                        $discount = $best_sale->discount;
                                                        $discount_type = $best_sale->discount_type;
                                                    }
                                                    $calculate_discount = App\Http\Controllers\HelperController::calculate_discount($selling_price, $discount, $discount_type );
                                                ?>
                                                @if($discount)
                                                    <span class="price-new">{{Config::get('siteSetting.currency_symble')}}{{ $calculate_discount['price'] }}</span>
                                                    <span class="price-old">{{Config::get('siteSetting.currency_symble')}}{{$selling_price}}</span>
                                                @else
                                                    <span class="price-new">{{Config::get('siteSetting.currency_symble')}}{{$selling_price}}</span>
                                                @endif
                                             </div>
                                              @if($discount)
                                              <div class="price-sale price-right">
                                                  <span class="discount">
                                                    @if($discount_type == '%')-@endif{{$calculate_discount['discount']}}%
                                                  <strong>OFF</strong>
                                                </span>
                                              </div>
                                              @endif
                                          </div>
                                         </div>
                                         <!-- End item-info -->
                                        </div>
                                        <!-- End item-wrap-inner -->
                                    </div>
                                    </a>
                                  @endforeach
                                </div>
                            </div>
                          </div>
                        </div>
                     </div>
                </div>
                @if($latestOffer)
              <a style="display: inline-block;padding: 3px 5px 3px 0px;" href="{{route('offer.details', $latestOffer->slug)}}">
              <img style="height: 92px" src="{{asset('upload/images/offer/banner/'. $latestOffer->banner)}}" class="img-1 img-responsive" alt="{{$latestOffer->title}}"></a>
              @endif
            </div>
        </div>  
        @if(count($liveSessions)>0)
        <section style="margin-top: 10px;background: #f5f5f5;border-radius: 5px;">
            <h4 style="padding:15px 20px 0;margin: 0;">Related Lives</h4>
            <ul class="list-unstyled video-list-thumbs row">
                @foreach($liveSessions as $liveSession)
                    
                <li class="col-lg-4 col-sm-4">
                    <a href="{{route('liveSessionDetails', $liveSession->slug)}}" title="{{$liveSession->title}}">
                    <div class="live-session">
                        <div class="row">
                            <div class="col-md-9  col-xs-9" style="padding-left:0">
                                
                            <img src="{{ asset('upload/images/liveSession')}}/{{$liveSession->thumb_image }}" alt="Barca" class="img-responsive" />
                           
                            <span class="fa fa-play-circle-o"></span>
                            
                            </div>

                            <div class="col-md-3  col-xs-3">
                                @foreach($liveSession->liveProducts->take(2) as $liveProduct)
                                <div class="product-img">
                                <img alt="Black Color Khimar Collection 2020" src="{{asset('upload/images/product/thumb')}}/{{$liveProduct->product->feature_image}}" class="img-1 img-responsive"></div>
                                @endforeach
                            </div>
                        </div>
                        <h4>{{Str::limit($liveSession->title, 80)}}</h4>
                    </div>
                    </a>
                </li>
                @endforeach
            </ul>
            @if(count($liveSessions)>5)
            <div class="livemoreBtn">
            <a class="btn btn-danger" href="{{url('live-session')}}">See More Live</a>
            </div>
            @endif
        </section>
        @endif
    </div>
</section>
@endsection
@section('js')
<script type="text/javascript">
    var link = document.getElementsByTagName('a'),
    tutVid = document.getElementById('tutVidTitle');

for(var i=0; i<9; i++){
  link[i].onclick = function(){
    tutVid.innerHTML = this.innerHTML;
  };
}
</script>

@endsection