<?php  $services = App\Models\Services::where('status', 1)->orderBy('position', 'asc')->take(5)->get(); ?>
<section class="section" @if($section->layout_width == 1) style="background:{{$section->background_color}}" @endif>
  <div class="container" @if($section->layout_width != 1) style="background:{{$section->background_color}};border-radius: 5px;" @endif>
    
    <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="block-service-home6" style="margin: 0">
        <ul>
          @foreach($services as $service)
          <li class="item">
            <a href="{{$service->subtitle}}" style="display:block;padding: 5px;">
            <div class="wrap">
              <div class="icon">@if($service->image)<img src="{{asset('upload/images/services/'.$service->image)}}" width="30" alt="{{$service->title}}">@else <i style="font-size: 40px;" class="{{$service->font}}"></i>@endif</div>
              <div class="text" style="text-align: left;">
                <h5 style="color:{{$section->text_color}}">{{$service->title}}</h5>
              </div>
            </div> <i style="position: absolute;right: 10px;font-size: 17px;top: 18px;" class="fa fa-angle-right"></i> </a>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
    </div>
  </div>
</section>