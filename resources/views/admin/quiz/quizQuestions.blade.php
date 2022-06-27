@extends('layouts.admin-master')
@section('title', 'Quiz question list')

@section('css')
      <link rel="stylesheet" type="text/css"
        href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
  
    <style type="text/css">
        .dropify-wrapper{  height: 100px !important; }
        #showProductArea{max-height: 400px; overflow-y: auto;}
        .discount_type{padding: 8px 3px; border: 1px solid #ccc; border-radius: 5px;}
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
                        <h4 class="text-themecolor">{{$quiz->title }} quiz questions </h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript::void(0)">question</a></li>
                                <li class="breadcrumb-item active">list</li>
                            </ol>
                            <a href="{{route('quiz_list')}}" class="btn btn-info btn-sm d-lg-block m-l-15"><i class="fa fa-eye"></i> Quiz List</a>
                            <button data-target="#questionModal" data-toggle="modal" type="button" class="btn btn-info btn-sm d-lg-block m-l-15"><i class="ti-plus"></i> Add more question</button>
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
                    <div class="col-lg-12">
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
                                            

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    
                                                    <select name="type" class="form-control">
                                                        <option value="all" {{ (Request::get('type') == "all") ? 'selected' : ''}}>All Type</option>
                                                       
                                                        <option value="1" {{ (Request::get('type') == '1') ? 'selected' : ''}}>Woadi</option>
                                                        <option value="2" {{ (Request::get('type') == '2') ? 'selected' : ''}}>National</option>
                                                        <option value="3" {{ (Request::get('type') == '3') ? 'selected' : ''}}>Intertional</option>
                                                        <option value="4" {{ (Request::get('type') == '4') ? 'selected' : ''}}>General</option>
                                                        <option value="5" {{ (Request::get('type') == '5') ? 'selected' : ''}}>Sports</option>
                                                        <option value="6" {{ (Request::get('type') == '6') ? 'selected' : ''}}>Technology</option>
                                                       
                                                    </select>
                                                </div>
                                            </div><div class="col-md-2">
                                                <div class="form-group">
                                                    
                                                    <select name="status" class="form-control">
                                                        <option value="all" {{ (Request::get('status') == "all") ? 'selected' : ''}}>All Status</option>
                                                        <option value="active" {{ (Request::get('status') == 'active') ? 'selected' : ''}}>Active</option>
                                                        <option value="deactive" {{ (Request::get('status') == 'deactive') ? 'selected' : ''}}>Deactive</option>
                                                        <option value="pending" {{ (Request::get('status') == 'pending') ? 'selected' : ''}}>Pending</option>
                                                       
                                                    </select>
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
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                           
                            <div class="table-responsive">
                                <p style="padding-left:15px;"><b>Total Question Segment:</b> 
                                    Woadi:<span class="badge badge-pill badge-primary ml-auto">({{$countSegments->ecommerce}})</span> 
                                    National:<span class="badge badge-pill badge-primary ml-auto">({{$countSegments->national}})</span> 
                                    International:<span class="badge badge-pill badge-primary ml-auto">({{$countSegments->international}})</span> 
                                    Sports:<span class="badge badge-pill badge-primary ml-auto">({{$countSegments->sports}})</span> 
                                    Technology:<span class="badge badge-pill badge-primary ml-auto">({{$countSegments->technology}})</span> 
                                </p>

                                <p style="padding-left:15px;"><b>Question Level: </b> 
                                    Beginner:<span class="badge badge-pill badge-cyan ml-auto">({{$countSegments->beginner}})</span> 
                                    Easy:<span class="badge badge-pill badge-cyan ml-auto">({{$countSegments->easy}})</span> 
                                    Normal:<span class="badge badge-pill badge-cyan ml-auto">({{$countSegments->normal}})</span> 
                                    Hard:<span class="badge badge-pill badge-cyan ml-auto">({{$countSegments->hard}})</span> 
                                    Challenging:<span class="badge badge-pill badge-cyan ml-auto">({{$countSegments->challenging}})</span>
                               </p>
                                <table id="myTable" class="table table-bordered table-hover table-striped ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Question</th>
                                            <th>Option 1</th>
                                            <th>Option 2</th>
                                            <th>Option 3</th>
                                            <th>Option 4</th>
                                            @if(in_array(Auth::guard('admin')->user()->id, [1,7]))
                                            <th>Answer</th>@endif
                                             <th>Level</th>
                                            <th>Upload_by</th>
                                           
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        @if(count($quizQuestions)>0)
                                        @foreach($quizQuestions as $index => $quizQuestion)
                                            <tr id="item{{$quizQuestion->id}}">
                                            	<td>{{(($quizQuestions->perPage() * $quizQuestions->currentPage() - $quizQuestions->perPage()) + ($index+1) )}}</td>
                                                <td>{{Str::limit($quizQuestion->question_title, 40)}}</td>
					                            <td>{{$quizQuestion->option_1}}</td>
					                            <td>{{$quizQuestion->option_2}}</td>
					                            <td>{{$quizQuestion->option_3}}</td>
					                            <td>{{$quizQuestion->option_4}}</td>
                                                 @if(in_array(Auth::guard('admin')->user()->id, [1,7]))
					                            <td>{{$quizQuestion->answer}}</td>@endif
                                                <td>{{ $quizQuestion->level }}</td>
                                                <td>@if($quizQuestion->user){{$quizQuestion->user->name}} @else not found @endif</td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                      <input name="status" onclick="satusActiveDeactive('quiz_questions', {{$quizQuestion->id}})"  type="checkbox" {{($quizQuestion->status == 1) ? 'checked' : ''}}  type="checkbox" class="custom-control-input" id="status{{$quizQuestion->id}}">
                                                      <label style="padding: 5px 12px" class="custom-control-label" for="status{{$quizQuestion->id}}"></label>
                                                    </div>
                                                </td>
                                               
                                                <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="ti-settings"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                       
                                                        <a class="dropdown-item" onclick="edit_modal({{$quizQuestion->id}})" title="Edit product" data-toggle="tooltip" href="javascript:void(0)"><i class="ti-pencil-alt"></i> Edit question</a>
                                                       
                                                        <span title="Remove product" data-toggle="tooltip"><button   data-target="#delete" data-toggle="modal" onclick='deleteConfirmPopup("{{route("quiz.question.delete", $quizQuestion->id)}}")'   class="dropdown-item" ><i class="ti-trash"></i> Remove question</button></span>
                                                    </div>
                                                </div>                                                  
                                                </td>
                                            </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        
                        </div>
                    </div>
                </div>

                <div class="row">
                   	<div class="col-sm-6 col-md-6 col-lg-6 text-center">
                       {{$quizQuestions->appends(request()->query())->links()}}
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing {{ $quizQuestions->firstItem() }} to {{ $quizQuestions->lastItem() }} of total {{$quizQuestions->total()}} entries ({{$quizQuestions->lastPage()}} Pages)</div>
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
        <div class="modal fade" id="questionModal" role="dialog" style="display: none;">
            <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Added question</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row">
                        <div class="card-body">
                                <form action="{{route('quiz.question.store')}}" method="post">
                                @csrf
                                <input type="hidden" value="{{$quiz->id}}" name="quiz_id">
                                <div class="form-body">
                                    <!--/row-->
                                    <div class="row">
                                       <div class="col-md-12">
											<div class="form-group">
											    <label for="question_title">Question title</label>
											    <textarea placeholder="Enter Title" name="question_title" id="question_title" class="form-control" rows="1" style="resize: vertical !important"  required=""></textarea>
											</div>
										</div>
									
										<div class="col-md-6">
										    <div class="form-group">
										        <label class="required" for="option1">1.Option</label>
										        <input type="text" required="" placeholder="Enter Option" name="option1" id="option1" class="form-control ">
										    </div>
										</div>
										<div class="col-md-6">
										    <div class="form-group">
										        <label  class="required" for="option2">2.Option</label>
										        <input type="text" required placeholder="Enter Option" name="option2" id="option2" class="form-control ">
										    </div>
										</div>
										<div class="col-md-6">
										    <div class="form-group">
										        <label  for="option3">3.Option</label>
										        <input type="text"  placeholder="Enter Option" name="option3" id="option3" class="form-control ">
										    </div>
										</div>
										<div class="col-md-6">
										    <div class="form-group">
										        <label for="option4">4.Option </label>
										        <input type="text"  placeholder="Enter Option" name="option4" id="option4" class="form-control ">
										    </div>
										</div>
										
										<div class="col-md-4">
										    <div class="form-group">
										       <label class="required" for="answer">Answer</label>
										        <input type="number" placeholder="Enter answer number" name="answer" id="answer" required=""  class="form-control ">
										       
										    </div>
										</div>
                                        <div class="col-md-4">
                                            <div class="form-group"> 
                                                <label lass="required">Question Category</label>
                                                <select name="category" class="form-control">
                                                    <option value="1">Woadi related</option>
                                                    <option value="2">National</option>
                                                    <option value="3">International</option>
                                                    <option value="4">General knowledge</option>
                                                    <option value="5">Sports</option>
                                                    <option value="6">Technology</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group"> 
                                                <label lass="required">Question level</label>
                                                <select name="level" class="form-control">
                                                    <option value="beginner">Beginner</option>
                                                    <option value="easy">Easy</option>
                                                    <option value="normal">Normal</option>
                                                    <option value="hard">Hard</option>
                                                    <option value="challenging">Challenging</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-md-center">
                                        
                                        <div class="col-md-12">
                                            
                                            <div class="modal-footer">
                                                <button type="submit" name="submit" value="add" class="btn btn-success"> <i class="fa fa-check"></i> Add question</button>
                                               
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
                <form action="{{route('quiz.question.store')}}"  method="post">
                      {{ csrf_field() }}
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update question</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row" id="edit_form"></div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-success">Update question</button>
                    </div>
                  </div>
                </form>
            </div>
        </div>

        <!-- delete Modal -->
        @include('admin.modal.delete-modal')

@endsection
@section('js')

    <!-- This is data table -->
    <script src="{{asset('assets')}}/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets')}}/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
  
    <!-- end - This is for export functionality only -->
    <script>
        $(function () {
            $('#myTable').dataTable({
                "ordering": false,
                "paging": false,"info":false
            });
        });
      
    </script>

    <script type="text/javascript">

        //edit offer
        function edit_modal(id){
           
            $('#edit_form').html('<div class="loadingData"></div>');
            $('#edit_modal').modal('show');
            var  url = '{{route("quiz.question.edit", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data){
                        $("#edit_form").html(data);
                        $(".select2").select2();
                    }
                }
            });
        }

    </script>

@endsection
