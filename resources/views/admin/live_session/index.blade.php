@extends('layouts.admin-master')
@section('title', 'Live session list')

@section('css-top')
    <link href="{{asset('assets')}}/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets')}}/node_modules/jquery-asColorPicker-master/dist/css/asColorPicker.css" rel="stylesheet" type="text/css" />

@endsection
@section('css')
<link href="{{asset('assets')}}/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .asColorPicker_open{z-index: 9999999}
        .dropify-wrapper{height: 120px;}
        p{line-height: 14px;margin-bottom: 5px;}
    </style>
@endsection
@section('content')
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Live session List</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Live session</a></li>
                            <li class="breadcrumb-item active">list</li>
                        </ol>
                        <button data-toggle="modal" data-target="#add" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Add live session</button>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <i class="drag-drop-info">Drag & drop sorting position</i>
                            
                            <div class="table-responsive">
                                <table  class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Thumbnail</th>
                                            <th>Title</th>
                                            <th>Statistics</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="positionSorting" data-table="live_sessions">
                                        @foreach($liveSessions as $index => $data)
                                        <tr id="item{{$data->id}}">
                                            <td>{{$index+1}}</td>
                                            <td><img width="50" src="{{ asset('upload/images/liveSession')}}/{{$data->thumb_image }}"> </td>
                                            <td><a href="{{route('liveSessionDetails', $data->slug)}}"> {{Str::limit($data->title, 50)}}</a></td>
                                            <td>
                                                <?php $api_key = "AIzaSyCb3w2vwCXfG1MCI70NOAAHAJi-v1OJEHk";
                                                    $video_id = $data->video_path;
                                                    $url = "https://www.googleapis.com/youtube/v3/videos?id=$video_id&key=$api_key&part=contentDetails,statistics";
                                                    $json = file_get_contents($url);
                                                    $getData = json_decode( $json , true);
                                                 
                                                ?>
                                                @if(count($getData['items'])>0)
                                                    @php  $duration =  new DateInterval($getData['items'][0]['contentDetails']['duration']); $statistics = $getData['items'][0]['statistics'];  @endphp
                                                    <p> Duration: {{$duration->format('%H:%I:%S') }}</p>
                                                    @if(array_key_exists('viewCount' ,$statistics))
                                                    <p>Views: {{ number_format($statistics['viewCount'])}}</p>
                                                    @endif
                                                    @if(array_key_exists('likeCount' ,$statistics))
                                                    <p>Likes: {{number_format($statistics['likeCount'])}}</p>
                                                    @endif
                                                    @if(array_key_exists('commentCount' ,$statistics))
                                                    <p> Comments: {{number_format($statistics['commentCount'])}}</p>
                                                    @endif
                                                @endif
                                            </td>
                                           
                                            <td>
                                                <div class="custom-control custom-switch" style="padding-left: 3.25rem;">
                                                  <input name="status" onclick="satusActiveDeactive('live_sessions', {{$data->id}})"  type="checkbox" {{($data->status == 1) ? 'checked' : ''}} class="custom-control-input" id="status{{$data->id}}">
                                                  <label class="custom-control-label" for="status{{$data->id}}"></label>
                                                </div>
                                            </td>
                                            <td>
                                                
                                                <button type="button" onclick="edit('{{$data->id}}')"  data-toggle="modal" data-target="#edit" class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i> Edit</button>
                                               
                                               
                                                <button title="Delete" data-target="#delete" onclick="deleteConfirmPopup('{{route("admin.liveSession.delete", $data->id)}}')" class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i> Delete</button>
                                               
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->

        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->

    <!-- update Modal -->
    <div class="modal fade" id="edit" role="dialog" style="display: none;">
        <div class="modal-dialog modal-dialog modal-lg">
            <form action="{{route('admin.liveSession.update')}}" enctype="multipart/form-data" method="post">
                  {{ csrf_field() }}
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update live session</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body form-row" id="edit_form"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-success">Update</button>
                </div>
              </div>
            </form>
        </div>
    </div>
    <!-- add Modal -->
    <div class="modal fade" id="add">
        <div class="modal-dialog modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create live session</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body form-row">
                    <div class="card-body">
                        <form action="{{route('admin.liveSession.store')}}" enctype="multipart/form-data" data-parsley-validate  method="POST" >
                            {{csrf_field()}}
                            <div class="form-body">
                                <!--/row-->
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="required" for="name">Section Title</label>
                                            <input  name="title" placeholder="Enter title" id="name" value="{{old('title')}}" required="" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="required" for="video_path">Video Path</label>
                                            <input  name="video_path" placeholder="Enter Youtube id" id="video_path" value="{{old('video_path')}}" required="" type="text" class="form-control">
                                            <i>Allow only youtube video id</i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <label class="required" for="category">Product Categories</label> <select onchange="getAllProducts(this.value)"  required="required" id="category" class="form-control select2 custom-select"> <option value="">Select category</option> @foreach($categories as $category)  <option value="{{$category->id}}">{{$category->name}}</option> <!-- get subcategory --> @if(count($category->get_subcategory)>0) @foreach($category->get_subcategory as $subcategory)  <option value="{{$subcategory->id}}">&nbsp; -{{$subcategory->name}}</option>  <!-- get childcategory --> @if(count($subcategory->get_subchild_category)>0) @foreach($subcategory->get_subchild_category as $childcategory)  <option value="{{$childcategory->id}}">&nbsp; &nbsp; --{{$childcategory->name}}</option>  @endforeach @endif <!-- end subcategory --> @endforeach  @endif <!-- end subcategory --> @endforeach</select> </div>
                                    </div>

                                    <div class="col-md-6"> <div class="form-group"><label for="homepage">Select Product</label><select required onchange="getProduct(this.value)" id="showAllProducts" class="form-control select2 custom-select" style="width: 100%"><option value="">Select First Category</option></select></div></div>

                                    <div class="col-md-12"><div class="form-group"><label for="getProducts">Selected Products</label><select required name="product_id[]" id="showSingleProduct" class="select2 m-b-10 select2-multiple" style="width: 100%" multiple="multiple" data-placeholder="Choose"></select></div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="required" for="name">Bacground Color</label>
                                            <input type="text" name="background_color" value="#ffffff" class="form-control gradient-colorpicker" >
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="required" for="name">Text Color</label>
                                            <input name="text_color" value="#000000" class="gradient-colorpicker form-control" >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group"> 
                                            <label class="dropify_image">Tumbnail Image</label>
                                            <input  type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="thumb_image" id="input-file-events">
                                            <i class="upload-info">Recommended size: 250px*150px</i>
                                        </div>
                                        @if ($errors->has('thumb_image'))
                                            <span class="invalid-feedback" role="alert">
                                                {{ $errors->first('thumb_image') }}
                                            </span>
                                        @endif
                                    </div>
                                    
                                </div>

                                <div class="row justify-content-md-center">
                                    <div class="col-md-12">
                                        <div class="head-label">
                                            <label class="switch-box" style="margin-left: -12px; top:-12px;">Status</label>
                                            <div  class="status-btn" >
                                                <div class="custom-control custom-switch">
                                                    <input name="status" checked  type="checkbox" class="custom-control-input" {{ (old('status') == 'on') ? 'checked' : '' }} id="status">
                                                    <label  class="custom-control-label" for="status">Publish/UnPublish</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="submit" value="add" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                            <button type="button" data-dismiss="modal" class="btn btn-inverse">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- delete Modal -->
    @include('admin.modal.delete-modal')
@endsection
@section('js')
       <script src="{{asset('assets')}}/node_modules/jqueryui/jquery-ui.min.js"></script>
    <script src="{{asset('assets')}}/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <!-- Color Picker Plugin JavaScript -->
    <script src="{{asset('assets')}}/node_modules/jquery-asColor/dist/jquery-asColor.js"></script>
    <script src="{{asset('assets')}}/node_modules/jquery-asGradient/dist/jquery-asGradient.js"></script>
    <script src="{{asset('assets')}}/node_modules/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>

    <script src="{{asset('assets')}}/node_modules/dropify/dist/js/dropify.min.js"></script>
    <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();
    });
    // Colorpicker
  
    $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    });

    $(".select2").select2();
    </script>

    <script type="text/javascript">


    function edit(id){
        $('#edit_form').html('<div class="loadingData"></div>');
        var  url = '{{route("admin.liveSession.edit", ":id")}}';
        url = url.replace(':id',id);
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#edit_form").html(data);
                    $(".select2").select2();
                    $('.dropify').dropify();
                    $(".gradient-colorpicker").asColorPicker({
                        mode: 'gradient'
                    });
                }
            },
            // $ID Error display id name
            @include('common.ajaxError', ['ID' => 'edit_form'])
        });

    }

    // get homepage Sourch
    function getAllProducts(id, edit=''){

        var  url = '{{route("admin.getProducts")}}';

        $.ajax({
            url:url,
            method:"get",
            data:{id:id},
            success:function(data){

                if(data){
                    $("#showAllProducts"+edit).html(data);
                    $(".select2").select2();
                }else{
                    $("#showAllProducts").html('<option>Product not found</option>');
                }
            }
        });
    }
    // get single product
    function getProduct(id, edit=''){

        var  url = '{{route("admin.getSingleProduct")}}';

        $.ajax({
            url:url,
            method:"get",
            data:{id:id},
            success:function(data){
                if(data){
                    $("#showSingleProduct"+edit).append(data);
                    $(".select2").select2();
                }
            }
        });
    }
    </script>

@endsection
