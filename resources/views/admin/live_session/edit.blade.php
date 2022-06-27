<input type="hidden" value="{{$section->id}}" name="id">

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="required" for="name">Section Title</label>
            <input  name="title" id="name" value="{{$section->title}}" required="" type="text" class="form-control">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label class="required" for="video_path">Video Path</label>
            <input  name="video_path" placeholder="Enter Youtube id" id="video_path" value="{{$section->video_path}}" required="" type="text" class="form-control">
            <i>Allow only youtube video id</i>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group"> <label for="categoryedit">Product Categories</label> <select onchange="getAllProducts(this.value, 'edit')"  id="categoryedit" class="form-control select2 custom-select"> <option value="">Select category</option> @foreach($categories as $category)  <option value="{{$category->id}}">{{$category->name}}</option> <!-- get subcategory --> @if(count($category->get_subcategory)>0) @foreach($category->get_subcategory as $subcategory)  <option value="{{$subcategory->id}}">&nbsp; -{{$subcategory->name}}</option>  <!-- get childcategory --> @if(count($subcategory->get_subchild_category)>0) @foreach($subcategory->get_subchild_category as $childcategory)  <option value="{{$childcategory->id}}">&nbsp; &nbsp; --{{$childcategory->name}}</option>  @endforeach @endif <!-- end subcategory --> @endforeach  @endif <!-- end subcategory --> @endforeach</select> </div>
    </div>
    <div class="col-md-6"> <div class="form-group"><label for="homepage">Select Product</label><select  onchange="getProduct(this.value, 'edit')" id="showAllProductsedit" class="form-control select2 custom-select" style="width: 100%"><option value="">Select First Category</option></select></div></div>

    <div class="col-md-12"><div class="form-group"><label for="getProducts">Selected Products</label><select required name="product_id[]" id="showSingleProductedit" class="select2 m-b-10 select2-multiple" style="width: 100%" multiple="multiple" data-placeholder="Choose">
            @foreach($section->liveProducts as $liveProduct)
            <option selected value="{{  $liveProduct->product_id }}">{{  $liveProduct->product->title }}</option>
            @endforeach
        </select></div>
    </div>
  
    <div class="col-md-6">
        <div class="form-group">
            <label class="required" for="name">Bacground Color</label>
            <input name="background_color" value="{{$section->background_color}}" class="form-control gradient-colorpicker">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="required" for="name">Text Color</label>
            <input name="text_color" value="{{$section->text_color}}" class="form-control gradient-colorpicker">
        </div>
    </div>
   
    <div class="col-md-12">
        <div class="form-group"> 
            <label class="dropify_image">Tumbnail Image </label>
            <div class="thumb_image">
            <input data-default-file="{{asset('upload/images/liveSession/'.$section->thumb_image)}}" type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="thumb_image" id="input-file-events">
            </div>
            <i class="update-info">Recommended size: 250px*150px</i>
        </div>
        @if($errors->has('thumb_image'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('thumb_image') }}
            </span>
        @endif
    </div>  
 
</div>
                         
<div class="col-md-12">

    <div class="form-group">
        <label class="switch-box">Status</label>
        <div  class="status-btn" >
            <div class="custom-control custom-switch">
                <input name="status" {{($section->status == 1) ?  'checked' : ''}}   type="checkbox" class="custom-control-input" id="status-edit">
                <label  class="custom-control-label" for="status-edit">Publish/UnPublish</label>
            </div>
        </div>
    </div>

</div>

