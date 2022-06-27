<?php  
  $liveSessions = App\Models\LiveSession::with(['liveProducts.product:id,feature_image'])->orderBy('position', 'asc')->where('status', 1)->limit(3)->get();
?>
@if(count($liveSessions)>0)
<section @if($section->layout_width == 1) style="background:{{$section->background_color}}" @endif>
  <div class="container" @if($section->layout_width != 1) style="background:{{$section->background_color}};border-radius: 5px; padding:5px;" @endif>
    <span class="title" style="color: {{$section->text_color}} !important;">{{$section->title}} <sup class="blink" style="color: #ff6372">live</sup></span> 
    <span class="moreBtn" style="background: linear-gradient(to right, {{$section->background_color}}, #ffffff);border: 1px solid {{$section->text_color}}; box-shadow: 1px 1px 3px -1px {{$section->text_color}}"><a href="{{url($section->slug)}}" style="color: {{$section->text_color}} !important;">See More</a></span>
    <div class="row">
      @if($section->thumb_image && $section->image_position == 'left')
      <div class="col-md-3">
        <div style="background: #fff;padding: 5px">
          <img style="width: 100%;height: 100%;" src="{{ asset('upload/images/homepage/'.$section->thumb_image) }}" alt="{{$section->title}}">
        </div>
      </div>
      @endif
      <div class="col-md-{{($section->thumb_image) ? 9 : 12}} col-xs-12" style="padding:0;margin-bottom: 5px;">
          <ul class="list-unstyled video-list-thumbs row">
              @foreach($liveSessions as $liveSession)
              <?php $api_key = "AIzaSyCb3w2vwCXfG1MCI70NOAAHAJi-v1OJEHk";
                  $video_id = $liveSession->video_path;
                  $url = "https://www.googleapis.com/youtube/v3/videos?id=$video_id&key=$api_key&part=contentDetails,statistics";
                  $json = file_get_contents($url);
                  $getData = json_decode( $json , true);
                  $duration = '00:00';
              ?>
              <li class="col-lg-4 col-sm-4">
                  <div class="live-session" style="background: #fff;padding: 10px;border-radius: 5px;margin-bottom: 5px;">
                      <a href="{{route('liveSessionDetails', $liveSession->slug)}}">
                      <h4 style="margin-bottom: 5px;min-height: 30px; font-size: 14px;color: #333;">{{Str::limit($liveSession->title, 80)}}</h4>
                      @if(count($getData['items'])>0)
                      @php  $duration =  new DateInterval($getData['items'][0]['contentDetails']['duration']); $duration = $duration->format('%H:%I:%S'); $statistics = $getData['items'][0]['statistics']; @endphp
                      <div class="live-info">
                          <ul>
                             @if(array_key_exists('viewCount' ,$statistics))
                              <li style="display: inline-block;color: #666;margin-right: 10px;"><i class="fa fa-eye"></i> {{ number_format($statistics['viewCount'])}}</li>
                              @endif
                              @if(array_key_exists('likeCount' ,$statistics))
                              <li style="display: inline-block;color: #666;margin-right: 10px;"><i class="fa fa-thumbs-up"></i> {{number_format($statistics['likeCount'])}}</li>
                              @endif
                              @if(array_key_exists('dislikeCount' ,$statistics))
                              <li style="display: inline-block;color: #666;margin-right: 10px;"><i class="fa fa-thumbs-down"></i> {{number_format($getData['items'][0]['statistics']['dislikeCount'])}}</li>
                              @endif
                              @if(array_key_exists('commentCount' ,$statistics))
                              <li style="display: inline-block;color: #666;margin-right: 10px;"> <i class="fa fa-comment"></i> {{number_format($statistics['commentCount'])}}</li>
                              @endif
                          </ul>
                      </div>
                      @endif
                      <div class="row">
                          <div class="col-md-9  col-xs-9" style="padding-left:0">
                              
                          <img style="margin:inherit;" src="{{ asset('upload/images/liveSession')}}/{{$liveSession->thumb_image }}" alt="{{$liveSession->title}}" class="img-responsive" />
                         
                          <span style="font-size: 60px;position: absolute;color: #fff; right: 39%;top: 31%;text-shadow: 0 1px 3px rgba(0,0,0,.5);transition:all 500ms ease-in-out;" class="fa fa-play-circle-o"></span>
                          <span style="background-color: rgba(0, 0, 0, 0.4);border-radius: 2px;color: #fff;font-size: 11px;font-weight: bold;left: 12px;line-height: 13px;padding: 2px 3px 1px;position: absolute;top: 12px;transition:all 500ms ease;">{{ $duration }}</span>
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
      </div>
      @if($section->thumb_image && $section->image_position == 'right')
        <div class="col-md-3">
          <div style="background: #fff;padding: 5px">
            <img style="width: 100%;height: 100%;" src="{{ asset('upload/images/homepage/'.$section->thumb_image) }}" alt="{{$section->title}}">
          </div>
        </div>
        @endif
    </div>
  </div>
</section>
@endif