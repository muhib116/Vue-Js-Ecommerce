<input type="hidden" value="{{$quiz->id}}" name="id">

<div class="col-md-12">
<div class="form-group">
    <label class="required" for="title">Quiz title</label>
    <input  name="title" placeholder="Quizz title" id="title" value="{{$quiz->title}}" required="" type="text" class="form-control">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
    <label class="required" for="duration">Quiz fee</label>
    <input name="fee" placeholder="Exm: 50 taka" value="{{$quiz->discount}}" required class="form-control" type="number">
</div>
</div>
<div class="col-md-4">
<div class="form-group">
    <label class="required" for="duration">Duration</label>
    <input name="duration" value="{{$quiz->duration}}" placeholder="Exm: 30 minutes" required class="form-control" type="number">
</div>
</div><div class="col-md-4">
<div class="form-group">
    <label class="required" for="allow_item">Number Of Question</label>
    <input name="allow_item" value="{{$quiz->allow_item}}" placeholder="Exm: 30 minutes" required class="form-control" type="number">
</div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label class="required" for="name">Start Date</label>
        <input name="start_date" required class="form-control" type="datetime-local" value="{{ Carbon\Carbon::parse($quiz->start_date)->format('Y-m-d\TH:i:s')}}">
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label class="required" for="name">End Date</label>
        <input name="end_date" required class="form-control" type="datetime-local" value="{{ Carbon\Carbon::parse($quiz->end_date)->format('Y-m-d\TH:i:s')}}">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="name">Bacground Color</label>
        <input name="background_color" type="text" value="{!!$quiz->background_color!!}" class="form-control gradient-colorpicker">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="name">Text Color</label>
        <input name="text_color" value="{!!$quiz->text_color!!}" class="form-control gradient-colorpicker" type="text">
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label for="details">Details</label>
        <textarea name="details" id="details" placeholder="Describe quiz dtails" class="summernote form-control">{{$quiz->notes}}</textarea>
    </div>
</div>

<div class="col-md-4 col-6">
    <div class="form-group"> 
        <label class="dropify_image">Thumbnail Image</label>
        <input type="file" data-default-file="{{asset('upload/images/offer/thumbnail/'.$quiz->thumbnail)}}" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="5M"  name="thumbnail" id="input-file-events">
        <i class="image_size">Image Size:600px * 250px </i>
    </div>
    @if ($errors->has('thumbnail'))
        <span class="invalid-feedback" role="alert">
            {{ $errors->first('thumbnail') }}
        </span>
    @endif
</div>
<div class="col-md-8 col-6">
    <div class="form-group"> 
        <label class="dropify_image">Banner Image</label>
        <input  type="file" data-default-file="{{asset('upload/images/offer/banner/'.$quiz->banner)}}" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="banner" id="input-file-events">
        <i class="image_size">Image Size:1200px * 300px </i>
    </div>
    @if ($errors->has('banner'))
        <span class="invalid-feedback" role="alert">
            {{ $errors->first('banner') }}
        </span>
    @endif
</div>