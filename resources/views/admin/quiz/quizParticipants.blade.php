@extends('layouts.admin-master')
@section('title', 'Participants list')
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
                    <h4 class="text-themecolor">Participants List</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <a class="btn btn-info btn-sm d-none d-lg-block m-l-15" href="{{ route('quiz_list') }}"><i class="fa fa-eye"></i> Quiz lists</a>
                        @if(in_array(Auth::guard('admin')->user()->id, [1,7]))
                        <a class="btn btn-warning btn-sm d-none d-lg-block m-l-15" href="{{ route('quiz.topParticipantLists', $quiz->slug) }}"><i class="fa fa-eye"></i> Top Participants</a>@endif
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
                                                <label class="control-label">Quiz Id</label>
                                                <input name="order_id" value="{{ Request::get('order_id')}}" type="text" placeholder="WQ12345678" class="form-control">
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
                                        <th>Division</th>
                                        <th>Order Id</th>
                                        
                                        <th style="color: green;">Right_Ans</th>
                                        <th style="color:red">Wrong_Ans</th>
                                        <th>Question</th>
                                        <th>Participate date</th>
                                        <th>Payment</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($quizParticipants)>0)
                                        @foreach($quizParticipants as $index => $quizParticipant)
                                        @php 
                                        $total_ans = count($quizParticipant->quizAnswers);
                                        try {
                                            $right_ans = (count($quizParticipant->quizAnswers)>0) ? array_count_values(array_column($quizParticipant->quizAnswers->toArray(), 'right_answer'))[1] : 0; 
                                        } catch (\Exception $e) {
                                           $right_ans = 0;
                                        }
                                       @endphp
                                        <tr>
                                            <td>{{(($quizParticipants->perPage() * $quizParticipants->currentPage() - $quizParticipants->perPage()) + ($index+1) )}}</td>
                                           <td>{{ $quizParticipant->name }}
                                            <p style="font-size: 12px;margin: 0;padding: 0">{{ $quizParticipant->mobile }}</p>
                                           </td>
                                           <td>{{$quizParticipant->division_name}} <br/> {{$quizParticipant->address}}</td>
                                           <td>{{$quizParticipant->order_id}}</td>
                                          
                                           <td style="color: green;"> {{$right_ans}}</td>
                                           <td style="color: red;">{{$total_ans - $right_ans}}</td>
                                            <td>{{$total_ans}}</td>
                                           <td>{{\Carbon\Carbon::parse($quizParticipant->participate_date)->format(Config::get('siteSetting.date_format'))}}
                                            <p style="font-size: 12px;margin: 0;padding: 0">{{\Carbon\Carbon::parse($quizParticipant->participate_date)->format('h:i:s A')}}</p>
                                           </td>
                                           <td>
                                               <span class="mytooltip tooltip-effect-2">
                                                <span class="label label-{{($quizParticipant->payment_method=='pending') ? 'danger' : 'success' }}">{{ str_replace( '-', ' ', $quizParticipant->payment_method) }}</span>
                                                
                                                @if($quizParticipant->payment_info)
                                                <span class="tooltip-content clearfix">
                                                <span class="tooltip-text">
                                                    @if($quizParticipant->tnx_id)
                                                    <strong>Tnx_id:</strong> <span> {{$quizParticipant->tnx_id}}</span><br/>
                                                    @endif
                                                    {{$quizParticipant->payment_info}}
                                                </span> 
                                                </span>
                                                @endif
                                               
                                                </span>
                                           </td>
                                           <td><button onclick="viewParticipantAns('{{ route("quiz.participantAns", $quizParticipant->id)}}')" class="btn btn-success btn-sm"> View Answer </button></td>
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
                   {{$quizParticipants->appends(request()->query())->links()}}
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing {{ $quizParticipants->firstItem() }} to {{ $quizParticipants->lastItem() }} of total {{$quizParticipants->total()}} entries ({{$quizParticipants->lastPage()}} Pages)</div>
            </div>
            
            <!-- ============================================================== -->
            <!-- End PAge Content -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>

        <div class="modal bs-example-modal-lg" id="ansDetails" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Participant Answer details</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body" id="getParticipantAns"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                    </div>
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
