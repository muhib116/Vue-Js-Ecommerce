@extends('layouts.admin-master')
@section('title', 'Top Participants list')
@section('css')
<link href="{{asset('assets')}}/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/pages/stylish-tooltip.css') }}">
    <!-- page CSS -->
    <link href="{{asset('assets')}}/node_modules/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
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
                    <h4 class="text-themecolor">Top Participants List</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                         @if(in_array(Auth::guard('admin')->user()->id, [1,7]))
                         <button data-target="#settopcustomer" data-toggle="modal" type="button" class="btn btn-info btn-sm d-lg-block m-l-15"><i class="ti-plus"></i>Set top competitor</button>
                         @endif
                        <a class="btn btn-info btn-sm d-none d-lg-block m-l-15" href="{{ route('quiz_list') }}"><i class="fa fa-eye"></i> Quiz lists</a>
                         <a class="btn btn-warning btn-sm d-none d-lg-block m-l-15" href="{{ route('quiz.participants', $quiz->slug) }}"><i class="fa fa-eye"></i> All Participants</a>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
         
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" style="margin-bottom: 2px;">
                        <form action="" id="orerControll" method="get">
                            <div class="form-body">
                                <div class="card-body" style="padding-bottom: 0;">
                                    <div class="row">
                                        <div class="col-md-2 col-6">
                                            <div class="form-group">
                                                <label class="control-label">Customer</label>
                                                <input name="customer" value="{{ Request::get('customer')}}" type="text" placeholder="name or mobile or email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-6">
                                            <div class="form-group">
                                                <label class="control-label">Division name</label>
                                                <input name="division" value="{{ Request::get('division')}}" type="text" placeholder="Enter division" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-2 col-6">
                                            <div class="form-group">
                                                <label class="control-label"> Right Answer  </label>
                                                <select name="status" class="form-control">
                                                    <option value="all">Answer Status</option>
                                                    @for($i=1;$i<=$quiz->allow_item; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>  
                                        <div class="col-md-2 col-6">
                                            <div class="form-group">
                                                <label class="control-label">From Date</label>
                                                <input name="from_date" value="{{ Request::get('from_date')}}" type="date" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-6">
                                            <div class="form-group">
                                                <label class="control-label">End Date</label>
                                                <input name="end_date" value="{{ Request::get('end_date')}}" type="date" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-6">
                                            <div class="form-group">
                                                <label class="control-label">.</label>
                                               <button type="submit" class="form-control btn btn-success"><i style="color:#fff; font-size: 20px;" class="ti-search"></i> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

               
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                        
                        <div class="table-responsive">
                            <table class="table display table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer</th>
                                        <th>Address</th>
                                        <th>Total</th>                                        
                                        <th style="color: green;">Right_Ans</th>
                                        <th style="color:red">Wrong_Ans</th>
                                        <th>Question</th>
                                        <th>Participate date</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($topParticipants)>0)
                                        @foreach($topParticipants as $index => $quizParticipant)
                                        
                                        <tr>
                                            <td>{{(($topParticipants->perPage() * $topParticipants->currentPage() - $topParticipants->perPage()) + ($index+1) )}}</td>
                                           <td><a href="{{ route('customer.profile', $quizParticipant->username) }}"> {{ $quizParticipant->name }}</a>
                                            <p style="font-size: 12px;margin: 0;padding: 0">{{ $quizParticipant->mobile }}</p>
                                           </td>
                                            <td>{{$quizParticipant->get_division->name .', '. $quizParticipant->get_city->name}}<br>{{$quizParticipant->address}}</td>
                                           <td><a href="{{route('quiz.participants',[$quiz->slug, $quizParticipant->username])}}"> <span class="badge badge-pill badge-cyan ml-auto">{{$quizParticipant->totalParticipate}}</span></a></td>

                                           <td style="color: green;"> {{$quizParticipant->total_right_answers_count}}</td>
                                           <td style="color: red;">{{$quizParticipant->total_wrong_answers_count}}</td>
                                            <td>{{$quizParticipant->total_right_answers_count + $quizParticipant->total_wrong_answers_count}}</td>
                                           <td>{{\Carbon\Carbon::parse($quizParticipant->participate_date)->format(Config::get('siteSetting.date_format'))}}
                                            <p style="font-size: 12px;margin: 0;padding: 0">{{\Carbon\Carbon::parse($quizParticipant->participate_date)->format('h:i:s A')}}</p>
                                           </td>
                                           
                                           <td><a href="{{route('quiz.participants',[$quiz->slug, $quizParticipant->username])}}" class="btn btn-success btn-sm"> View details ({{$quizParticipant->totalParticipate}}) </a></td>
                                        </tr>
                                       @endforeach
                                    @else <tr><td colspan="8"> <h1>No quiz participant found.</h1></td></tr> @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                </div>
               
                <!-- Column -->
            </div> 
          
            <div class="row">
               <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                   {{$topParticipants->appends(request()->query())->links()}}
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing {{ $topParticipants->firstItem() }} to {{ $topParticipants->lastItem() }} of total {{$topParticipants->total()}} entries ({{$topParticipants->lastPage()}} Pages)</div>
            </div>
            
            <!-- ============================================================== -->
            <!-- End PAge Content -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>

        <div class="modal bs-example-modal-lg" id="settopcustomer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('quiz.setCustomTopUser', $quiz->id) }}">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Set top competitor</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <select name="user_id[]" class="select2 form-control" multiple="">
                            <option value="">Remove all</option>
                            @foreach($topParticipants->take(30) as $index => $quizParticipant)
                            <option @if(in_array($quizParticipant->user_id, explode(',', $quiz->seller_id))) selected @endif value="{{ $quizParticipant->user_id}}">{{ $quizParticipant->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success waves-effect text-left">Set Now</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
@endsection
@section('js')
    <script type="text/javascript">
        function viewParticipantAns(url){
            $('#getParticipantAns').html('<div class="loadingData"></div>');
            $('#ansDetails').modal('show');
            
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data){
                        $("#getParticipantAns").html(data);
                    }
                }
            });
        }
    </script>
    <script src="{{asset('assets')}}/node_modules/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>

    <script src="{{asset('assets')}}/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

    <script type="text/javascript">

    $(".select2").select2();
    </script>
 


@endsection
