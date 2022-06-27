<input type="hidden" value="{{$data->id}}" name="id">

<div class="col-md-12">
    <div class="form-group">
        <label for="subcategory">Sub Childcategory Name</label>
        <input name="name" id="subcategory" value="{{$data->name}}" required="" type="text" class="form-control">
    </div>
</div>

<div class="col-md-12">                           
    <div class="form-group">
        <label for="category">Select Category</label>
        <select name="parent_id" id="category" class="form-control custom-select">
            
             @foreach($get_category as $category)
                <option value="{{$category->id}}" {{($category->id == $data->parent_id) ?  'selected' : ''}}>{{$category->name}}</option>
                
            @endforeach
        </select>
    </div>
</div>

<div class="col-md-12">
    <div class="form-group"> 
        <label class="dropify_image">Feature Image</label>
        <input data-default-file="{{asset('upload/images/category/'.$data->image)}}" type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg png gif"  data-max-file-size="2M"  name="phato" id="input-file-events">
    </div>
    @if ($errors->has('phato'))
        <span class="invalid-feedback" role="alert">
            {{ $errors->first('phato') }}
        </span>
    @endif
</div>
<div class="col-md-12">
<div class="form-group">
                                                            <span class="required">Tags( <span style="font-size: 12px;color: #777;font-weight: initial;">Write tags Separated by Comma[,] {{$data->keyword}}</span> )</span>

                                                             <div class="tags-default">
                                                                <select type="text" name="keywords[]" class="pitemName" multiple>
																 @php
																$keytags = explode(', ', $data->keyword);
																@endphp
																
																@foreach($keytags as $keyword)
																<option val="{{$keyword}}" selected>{{$keyword}}</option>
																@endforeach
																
																</select>
                                                            </div>
                                                        </div>
<div class="col-md-12 mb-12">
    <div class="form-group">
        <label class="switch-box">Status</label>
        <div  class="status-btn" >
            <div class="custom-control custom-switch">
                <input name="status" {{($data->status == 1) ?  'checked' : ''}}   type="checkbox" class="custom-control-input" id="status-edit">
                <label class="custom-control-label" for="status-edit">Publish/UnPublish</label>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">


  $(document).ready(function(){
		




		$('.pitemName').select2({
 placeholder: 'Select an item',
 tags:true,
 debug:true,
 multiple:true,
            ajax: {
                url: '/keyword',
                dataType: 'json',
                delay: 250,
                data: function (data) {
                    return {
                        searchTerm: data.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results:response
                    };
                },
                cache: true
            }
});









	});	


    </script>
