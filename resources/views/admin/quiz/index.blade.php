@extends('layouts.admin-master')
@section('title', 'Quiz list')

@section('css-top')

    <link href="{{asset('assets')}}/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
   
    <link href="{{asset('assets')}}/node_modules/jquery-asColorPicker-master/dist/css/asColorPicker.css" rel="stylesheet" type="text/css" />

@endsection
@section('css')

    <link rel="stylesheet" type="text/css"
        href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
    <link href="{{asset('assets')}}/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />

    <link href="{{asset('assets')}}/node_modules/summernote/dist/summernote-bs4.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .asColorPicker_open{z-index: 9999999;border:1px solid #ccc;}
       
        .dropify-wrapper{  height: 120px !important; }
        #showProductArea{max-height: 450px; overflow-y: auto;}
        .discount_type{padding: 8px 3px; border: 1px solid #ccc; border-radius: 5px;}
        .image_size{font-size: 11px;}
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
                        <h4 class="text-themecolor">Quiz List</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Quiz</a></li>
                                <li class="breadcrumb-item active">list</li>
                            </ol>
                            <button data-toggle="modal" data-target="#add" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Add New Quiz</button>
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
                        <div class="card" style="margin-bottom: 2px;">

                            <form action="" method="get">

                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input name="title" placeholder="Title" value="{{ Request::get('title')}}" type="text" class="form-control">
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <select class="form-control" name="show">
                                                        <option @if(Request::get('show') == 15) selected @endif value="15">15</option>
                                                        <option @if(Request::get('show') == 25) selected @endif value="25">25</option>
                                                        <option @if(Request::get('show') == 50) selected @endif value="50">50</option>
                                                        <option @if(Request::get('show') == 100) selected @endif value="100">100</option>
                                                        <option @if(Request::get('show') == 255) selected @endif value="250">250</option>
                                                        <option @if(Request::get('show') == 500) selected @endif value="500">500</option>
                                                        <option @if(Request::get('show') == 750) selected @endif value="750">750</option>
                                                        <option @if(Request::get('show') == 1000) selected @endif value="1000">1000</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                   
                                                   <button type="submit" class="form-control btn btn-success"><i style="color:#fff; font-size: 20px;" class="ti-search"></i> </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-12">

                        <div class="card">
                            <div class="card-body">
                                <i class="drag-drop-info">Drag & drop sorting position</i>
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Quiz Name</th>
                                                <th>Fee</th>
                                                <th>Duration</th>
                                                <th>Q.NO</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Questions</th>
                                                <th>Participants</th>
                                                <th>Status</th>
                                                @if(Auth::guard('admin')->user()->role_id == 'admin')
                                                <th>Action</th>@endif
                                            </tr>
                                        </thead>
                                        <tbody id="positionSorting" data-table='offers'>
                                            @foreach($quizzes as $index => $quiz)
                                            <tr id="item{{$quiz->id}}">
                                                <td>{{(($quizzes->perPage() * $quizzes->currentPage() - $quizzes->perPage()) + ($index+1) )}}</td>
                                                 <td><img src="{{asset('upload/images/offer/thumbnail/'. $quiz->thumbnail)}}" width="50" alt=""></td>
                                                <td>{{Str::limit($quiz->title, 80)}}</td>
                                                <td>{{ config('siteSetting.currency_symble') . $quiz->discount}}</td>
                                                <td>{{$quiz->duration}} Minutes</td>
                                                <td>{{$quiz->allow_item}}</td>
                                                <td>{{ Carbon\Carbon::parse($quiz->start_date)->format('d M, Y') }} <br/>
                                                {{ Carbon\Carbon::parse($quiz->start_date)->format('h:i:s A') }}</td>
                                                <td>{{ Carbon\Carbon::parse($quiz->end_date)->format('d M, Y') }}
                                                <br/>
                                                {{ Carbon\Carbon::parse($quiz->end_date)->format('h:i:s A') }}</td>
                                                
                                                
                                                <td><a href="{{route('quiz.question.list', $quiz->slug)}}" class="btn btn-success btn-sm"><i class="ti-plus" aria-hidden="true"></i> Questions</a></td>
                                                <td>  <a class="btn btn-success btn-sm" title="Added New Products"  href="{{route('quiz.participants', $quiz->slug)}}"><i class="ti-eye"></i> Participants </a>
                                                </td>
                                                <td> <div class="custom-control custom-switch">
                                                      <input  name="status" onclick="satusActiveDeactive('offers', {{$quiz->id}})"  type="checkbox" {{($quiz->status == 1) ? 'checked' : ''}}  type="checkbox" class="custom-control-input" id="status{{$quiz->id}}">
                                                      <label style="padding: 5px 12px" class="custom-control-label" for="status{{$quiz->id}}"></label>
                                                    </div>
                                                </td>
                                                @if(Auth::guard('admin')->user()->role_id == 'admin')
                                                <td>
                                                    <div class="btn-group">
                                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="ti-settings"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                       
                                                       <a class="dropdown-item" title="Added New Products" href="{{route('admin.offerProducts', $quiz->slug)}}" ><i class="ti-plus" aria-hidden="true"></i> Products({{$quiz->offer_products_count}}) </a> 
                                                        
                                                        @if(Auth::guard('admin')->user()->role_id ==  'admin')
                                                        <button type="button" onclick="edit_quiz('{{$quiz->id}}')" class="dropdown-item"><i class="ti-pencil" aria-hidden="true"></i> Edit</button>
                                                        <button data-target="#delete" onclick="deleteConfirmPopup('{{route("quiz.delete", $quiz->id)}}')" data-toggle="modal" class="dropdown-item" ><i class="ti-trash" aria-hidden="true"></i> Delete</button>
                                                        @endif
                                                    </div>
                                                </div> 
                                                </td>
                                                @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                                       {{$quizzes->appends(request()->query())->links()}}
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing {{ $quizzes->firstItem() }} to {{ $quizzes->lastItem() }} of total {{$quizzes->total()}} entries ({{$quizzes->lastPage()}} Pages)</div>
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
        <div class="modal fade" id="add" role="dialog" style="display: none;">
            <div class="modal-dialog modal-md">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Create New Quiz</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row">
                        <div class="card-body">
                           <form action="{{route('quiz.store')}}" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-body">
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required" for="title">Quiz title</label>
                                                <input  name="title" onchange="getSlug(this.value)" placeholder="Quizz title" id="title" value="{{old('title')}}" required="" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required" for="slug">Quiz URl</label>
                                                <input  name="slug" placeholder="Quizz url" id="quiz_slug" value="{{old('slug')}}" required="" type="text" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required" for="fee">Quiz fee</label>
                                                <input name="fee" placeholder="Exm: 50 taka" required class="form-control" type="number">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required" for="duration">Duration</label>
                                                <input name="duration" placeholder="Exm: 30 minutes" required class="form-control" type="number">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required" for="allow_item">Number Of Question</label>
                                                <input name="allow_item" placeholder="Exm: 11" required class="form-control" type="number">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="name">Start Date</label>
                                                <input name="start_date" required class="form-control" type="datetime-local" value="{{now()}}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="name">End Date</label>
                                                <input name="end_date" required class="form-control" type="datetime-local" value="{{now()}}">
                                            </div>
                                        </div>

                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Bacground Color</label>
                                                <input name="background_color" type="text" value="#aee9f6" class="gradient-colorpicker form-control ">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Text Color</label>
                                                <input name="text_color" value="#000000" class="gradient-colorpicker form-control" type="text">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="details">Details</label>
                                                <textarea name="details" id="details" placeholder="Describe quizz Details" class="summernote form-control"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-6">
                                            <div class="form-group"> 
                                                <label class="dropify_image">Thumbnail Image</label>
                                                <input type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="5M"  name="thumbnail" id="input-file-events">
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
                                                <input  type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="banner" id="input-file-events">
                                                <i class="image_size">Image Size:1200px * 300px </i>
                                            </div>
                                            @if ($errors->has('banner'))
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $errors->first('banner') }}
                                                </span>
                                            @endif
                                        </div>
                                       
                                    </div>

                                    <div class="row justify-content-md-center">
                                        <div class="col-md-12">
                                            <div class="modal-footer">
                                                <button type="submit" name="submit" value="add" class="btn btn-success"> <i class="fa fa-check"></i> Create Now</button>
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
        <!-- update Modal -->
        <div class="modal fade" id="edit_modal" role="dialog" style="display: none;">
            <div class="modal-dialog">
                <form action="{{route('quiz.store')}}"  enctype="multipart/form-data" method="post">
                      {{ csrf_field() }}
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update quiz</h4>
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
        @include('admin.modal.delete-modal')
@endsection
@section('js')
    <script src="{{asset('assets')}}/node_modules/jqueryui/jquery-ui.min.js"></script>
    <script src="{{asset('assets')}}/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <script src="{{asset('assets')}}/node_modules/dropify/dist/js/dropify.min.js"></script>

    <!-- end - This is for export functionality only -->
    <script>
        $(".select2").select2();
        
         // Basic
        $('.dropify').dropify();

    </script>

    <script type="text/javascript">
        function getSlug(slug) {
            var  url = '{{route("slug")}}';
            $.ajax({
                url:url,
                method:"get",
                data:{slug:slug, field:'slug',table:'offers'},
                success:function(slug){
                    if(slug){
                        document.getElementById('quiz_slug').value = slug;
                    }else{
                        document.getElementById('quiz_slug').value = "";
                    }
                }
            });
        }
        //edit quiz
        function edit_quiz(id){
            $('#edit_form').html('<div class="loadingData"></div>');
            $('#edit_modal').modal('show');
            var  url = '{{route("quiz.edit", ":id")}}';
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
                        $('.summernote').summernote();

                    }
                }
            });
        }
    </script>

    <script src="{{asset('assets')}}/node_modules/summernote/dist/summernote-bs4.min.js"></script>
    <script>
        $(function() {

            $('.summernote').summernote({
                height: 100, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: false // set focus to editable area after initializing summernote
            });

            $('.inline-editor').summernote({
                airMode: true
            });

        });

        window.edit = function() {
            $(".click2edit").summernote()
        },
        window.save = function() {
            $(".click2edit").summernote('destroy');
        }
</script>

 
    <!-- Color Picker Plugin JavaScript -->
    <script src="{{asset('assets')}}/node_modules/jquery-asColor/dist/jquery-asColor.js"></script>
    <script src="{{asset('assets')}}/node_modules/jquery-asGradient/dist/jquery-asGradient.js"></script>
    <script src="{{asset('assets')}}/node_modules/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
    <script>
    $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    });
    </script>
@endsection
