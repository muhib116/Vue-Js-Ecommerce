@extends('layouts.frontend')
@section('title', 'Live Sessions | '. Config::get('siteSetting.site_name') )
@section('css')
<style type="text/css">
.breadcrumbTitle{color: #ff6e26;font-size: 24px;font-family: OpenSans;display: inline-block !important; font-weight: 600; padding-right: 10px;}
.live-session{background: #fff;padding:10px;}
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
.product-img{margin-bottom: 3px;max-width: 72px;}
@media (min-width:320px) and (max-width: 480px) { 
    .video-list-thumbs .fa-play-circle-o{font-size: 35px;right: 36%;top: 27%;}
    .video-list-thumbs h2{bottom: 0;font-size: 12px;height: 22px;margin: 8px 0 0;}
}
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
    @include('frontend.sliders.slider2')
    <div class="container" style="margin-top:15px">
        @if(count($liveSessions)>0)
            <ul class="list-unstyled video-list-thumbs row">
                @foreach($liveSessions as $liveSession)
                <?php $api_key = "AIzaSyCb3w2vwCXfG1MCI70NOAAHAJi-v1OJEHk";
                    $video_id = $liveSession->video_path;
                    $url = "https://www.googleapis.com/youtube/v3/videos?id=$video_id&key=$api_key&part=snippet,contentDetails,statistics,status";
                    $json = file_get_contents($url);
                    $getData = json_decode( $json , true);
                    $duration =  '00:00';
                ?>
                <li class="col-lg-4 col-sm-4">
                    <div class="live-session">
                        <a href="{{route('liveSessionDetails', $liveSession->slug)}}" title="{{$liveSession->title}}">
                        <h4>{{Str::limit($liveSession->title, 80)}}</h4>
                        @if(count($getData['items'])>0)
                          @php  $duration =  new DateInterval($getData['items'][0]['contentDetails']['duration']); $duration = $duration->format('%H:%I:%S');  $statistics = $getData['items'][0]['statistics']; @endphp
                          <div class="live-info">
                              <ul>
                                 @if(array_key_exists('viewCount' ,$statistics))
                                  <li><i class="fa fa-eye"></i> {{ number_format($statistics['viewCount'])}}</li>
                                  @endif
                                  @if(array_key_exists('likeCount' ,$statistics))
                                  <li><i class="fa fa-thumbs-up"></i> {{number_format($statistics['likeCount'])}}</li>
                                  @endif
                                  @if(array_key_exists('dislikeCount' ,$statistics))
                                  <li><i class="fa fa-thumbs-down"></i> {{number_format($getData['items'][0]['statistics']['dislikeCount'])}}</i></li>
                                  @endif
                                  @if(array_key_exists('commentCount' ,$statistics))
                                  <li> <i class="fa fa-comment"></i> {{number_format($statistics['commentCount'])}}</li>
                                  @endif
                              </ul>
                          </div>
                        @endif
                        <div class="row">
                            <div class="col-md-9  col-xs-9" style="padding-left:0">
                                
                            <img src="{{ asset('upload/images/liveSession')}}/{{$liveSession->thumb_image }}" alt="Barca" class="img-responsive" />
                           
                            <span class="fa fa-play-circle-o"></span>
                            <span class="duration">{{ $duration}}</span>
                       
                            </div>

                            <div class="col-md-3  col-xs-3">
                                @foreach($liveSession->liveProducts->take(2) as $liveProduct)
                                <div class="product-img">
                                <img alt="Black Color Khimar Collection 2020" src="{{asset('upload/images/product/thumb')}}/{{$liveProduct->product->feature_image}}" class="img-1 img-responsive"></div>
                                @endforeach
                            </div>
                        </div>
                        </a>
                    </div>
                </li>
                @endforeach
            </ul>
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                   {{$liveSessions->appends(request()->query())->links()}}
                  </div>
                <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing {{ $liveSessions->firstItem() }} to {{ $liveSessions->lastItem() }} of total {{$liveSessions->total()}} entries ({{$liveSessions->lastPage()}} Pages)</div>
            </div>
        @else
        <h3>Live session not available.</h3>
        @endif
                
    </div>
@endsection
@section('js')


@endsection