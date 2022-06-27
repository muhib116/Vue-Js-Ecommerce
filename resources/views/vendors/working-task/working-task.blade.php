@extends('layouts.admin-master')
@section('title', 'Working Task')
@section('css-top')
	<link href="{{asset('assets')}}/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets')}}/node_modules/dropzone-master/dist/dropzone.css" rel="stylesheet">
@endsection
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- page css -->
    <link href="{{asset('css')}}/pages/inbox.css" rel="stylesheet">
    <link href="{{asset('assets')}}/node_modules/summernote/dist/summernote-bs4.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
    tbody p{padding: 0;margin: 0}
    tbody a{color: #000;}
    </style>
@endsection
@section('content')
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
                        <h4 class="text-themecolor">Working Task</h4>
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
                        <div class="card">
                            <div class="row">
                                <div class="col-xlg-2 col-lg-3 col-md-4">
                                    @include('admin.working-task.leftsidebar')
                                </div>
                                <div class="col-xlg-10 col-lg-9 col-md-8 bg-light border-left sticky-conent">
                                    <div class="card-body">
                                        <div class="btn-group m-b-10 m-r-10" role="group" aria-label="Button group with nested dropdown">
                                            <button type="button" class="btn btn-secondary font-18"><i class="mdi mdi-inbox-arrow-down"></i></button>
                                            <button type="button" class="btn btn-secondary font-18"><i class="mdi mdi-alert-octagon"></i></button>
                                            <button type="button" class="btn btn-secondary font-18"><i class="mdi mdi-delete"></i></button>
                                        </div>
                                        <div class="btn-group m-b-10 m-r-10" role="group" aria-label="Button group with nested dropdown">
                                            <div class="btn-group" role="group">
                                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-folder font-18 "></i> </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1"> <a class="dropdown-item" href="javascript:void(0)">Dropdown link</a> <a class="dropdown-item" href="javascript:void(0)">Dropdown link</a> </div>
                                            </div>
                                            <div class="btn-group" role="group">
                                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-label font-18"></i> </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1"> <a class="dropdown-item" href="javascript:void(0)">Dropdown link</a> <a class="dropdown-item" href="javascript:void(0)">Dropdown link</a> </div>
                                            </div>
                                        </div>
                                        <button type="button " class="btn btn-secondary m-r-10 m-b-10"><i class="mdi mdi-reload font-18"></i></button>
                                        <div class="btn-group" role="group">
                                            <button id="btnGroupDrop1" type="button" class="btn m-b-10 btn-secondary font-18 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> More </button>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1"> <a class="dropdown-item" href="javascript:void(0)">Mark as all read</a> <a class="dropdown-item" href="javascript:void(0)">Dropdown link</a> </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-t-0">
                                        <div class="card b-all shadow-none">
                                            <div class="table-responsive" style="padding-top:0">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 10px;"><input type="checkbox"></th>
                                                            <th style="width: 100px;max-width: 100px;">@if(Request::segment(4) == 'send' || Request::segment(4) == 'scheduled')  Assign To @elseif(Request::segment(4) == 'inbox') From @else user @endif</th>
                                                            <th style="max-width: 150px;">Subject</th>
                                                            <th>Description</th>
                                                            <th style="width: 80px;">Date</th>
                                                            <th style="width: 50px;">Status</th>
                                                           
                                                            @if(Request::segment(4) == 'send' || Request::segment(4) == 'scheduled')
                                                            <th style="width: 50px;">Action</th> @endif
                                                        </tr>
                                                    </thead> 
                                                    <tbody>
                                                        @foreach($tasks as $index => $task)
                                                        <tr id="item{{$task->id}}">
                                                            <td><input type="checkbox" name="serial[{{$task->id}}]"></td>
                                                            <td>@if(Request::segment(4) == 'inbox') {{$task->workingTaskFrom->name}} @else @if(count($task->workingTaskUsers)>0) @foreach($task->workingTaskUsers as $taskUser) @if($taskUser->user_id != 0) {{$taskUser->taskUser->name}}, @endif @endforeach @else All Staff @endif @endif</td>
                                                            <td><a href="{{route('admin.workingTaskDetails', $task->slug)}}"> {{Str::limit($task->subject, '50')}}</a></td>
                                                            <td><a href="{{route('admin.workingTaskDetails', $task->slug)}}">{!! Str::limit(strip_tags($task->details), 60) !!} @if($task->attachment) <br/><i class="ti-link"></i> Attachment @endif</a></td>
                                                            <td><p>{{ Carbon\Carbon::parse($task->start_date)->format('d M') }}</p><p> {{ Carbon\Carbon::parse($task->start_date)->format('h:i A') }}</p></td>
                                                            <td>@if($task->status == 'completed')
                                                            <span class="label label-success"> {{ str_replace('-', ' ', $task->status)}} </span>

                                                            @elseif($task->status == 'processing')
                                                            <span class="label label-warning"> {{ str_replace('-', ' ', $task->status)}} </span> @else <span class="label label-danger"> {{ str_replace('-', ' ', $task->status)}} </span> @endif</td>
                                                            @if(Request::segment(4) == 'send' || Request::segment(4) == 'scheduled')
                                                            <td><a title="Edit" href="{{route('admin.workingTask.edit', $task->slug)}} "> <i class="fa fa-edit"></i> </a> <a title="Delete" data-target="#delete" onclick="deleteConfirmPopup('{{route("workingTask.delete", $task->id)}}')" data-toggle="modal" href="javascript:void(0)"> <i class="ti-trash"></i> </a> </td>@endif
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="row">
                                                    <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                                                       {{$tasks->appends(request()->query())->links()}}
                                                    </div>
                                                    <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing {{ $tasks->firstItem() }} to {{ $tasks->lastItem() }} of total {{$tasks->total()}} entries ({{$tasks->lastPage()}} Pages)</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
   	<!-- delete Modal -->
   	@include('admin.modal.delete-modal')
@endsection
@section('js')
    <script src="{{asset('assets')}}/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <!-- dropzone version change -->
    <script src="{{asset('assets')}}/node_modules/dropzone-master/dist/dropzone.js" type="text/javascript"></script>
    <script src="{{asset('assets')}}/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script type="text/javascript">
        $(".select2").select2({placeholder: "Select User", allowClear: true});

        Dropzone.options.dropzone =
            {
                url: '{{route('dropzone.store')}}',
                type: 'POST',
                maxFilesize: 12,
                renameFile: function (file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time + file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 50000,
                removedfile: function (file) {
                    var name = file.upload.filename;
                    $.ajax({
                        type: 'POST',
                        url: '{{ route("dropzone.delete") }}',
                        data: {filename: name, '_token':'{{csrf_token()}}'},
                        success: function (data) {
                            console.log("File has been successfully removed!!");
                        },
                        error: function (e) {
                            console.log(e);
                        }
                    });
                    var fileRef;
                    return (fileRef = file.previewElement) != null ?
                        fileRef.parentNode.removeChild(file.previewElement) : void 0;
                },

                success: function (file, response) {
                    console.log(response.success);
                },
                error: function (file, response) {
                    return false;
                }
            };
    </script>

       <script src="{{asset('assets')}}/node_modules/summernote/dist/summernote-bs4.min.js"></script>
    <script>
    $(function() {

        $('.summernote').summernote({
            height: 150, // set editor height
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
@endsection
