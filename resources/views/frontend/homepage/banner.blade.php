<?php
	$banner = App\Models\Banner::find($section->product_id); 
?>

@if($banner)
<section class="hidden-lg" style="@if($section->layout_width == 1) background:{{$section->background_color}}; @endif padding:5px;">
								<div class="container" @if($section->layout_width != 1) style="background:{{$section->background_color}};border-radius: 3px; padding: 5px;" @endif>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background:#000000;display: none;margin: 0;padding: 15px 15px 0;">
										<h4 class="herakhans" style="color:#000000">{{$banner->title}}</h4>
									</div>
									
									
									 @if($banner->banner_type>1)
    <span class="title" style="color: {{$section->text_color}} !important;">{{$section->title}}</span>
    @endif
									                        <div class="row" style="padding: 0 5px;">
									                             @for($i=1;$i<=$banner->banner_type; $i++)
                                        @php $col = round(12/$banner->banner_type); 
                                        $mobcol = ($banner->banner_type == 1) ? 12 : 6;
                                        $btn_link = 'btn_link'.$i;
                                        $banner_img = 'banner'.$i;
                                        @endphp
									    <div class="col-md-12 col-xs-12" style="margin:5px 0px;padding: 5px;">
            											<div class="banner-layout-5 clearfix">
            												<div class="banner-22  banners">
            													<div> <a title="{{$banner->title}}" href="{{url($banner->$btn_link)}}"><img src="{{asset('upload/images/banner/'.$banner->$banner_img)}}"><p style="text-align: center;color: #333;font-size: 14px;"></p></a> </div>
            												</div>
            											</div>
            										</div>
            								@endfor
									</div>
									
									
									
									
									
								</div>
</section>

@endif
