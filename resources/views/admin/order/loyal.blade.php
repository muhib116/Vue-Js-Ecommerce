@extends('layouts.admin-master')
@section('title', 'Loyal Order List')
@section('css')
<link href="{{asset('assets')}}/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/pages/stylish-tooltip.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets')}}/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
    <style type="text/css">
        .payment-method, .customer{ max-width: 150px !important; font-size: 12px; }
        .label-return{background: #ff6226;}
        .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn){max-width: 100px;}
        #orerControll .form-control{padding: 3px;}
        .clockdiv{margin-bottom: 0px;}
        .count{ display: inline-flex; margin: 0 auto; text-align: center; align-items: center;}
        .count_d {position: relative;padding: 0px 4px 0px;margin: 0px 3px;border-radius: 5px;background: #00000078;overflow: hidden;}
        .count_d:before{ content: '';  position: absolute;top: 0;left: 0;width: 100%;height: 50%;}
        .count_d span { display: block; text-align: center; font-size: 12px; font-weight: 800;color: #fff;}
        .count_d h2 { display: block; text-align: center;color: #fff; font-size: 7px; font-weight: 600; text-transform: uppercase; margin: 0;}
        .irotate {  text-align: center;  margin: 0 auto; display: block;}
        .thisis { display: inline-block; vertical-align: middle; }
        .slidem { text-align: center; min-width: 90px;}
    </style>
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
                    <h4 class="text-themecolor"> Total Consumer ({{ $orders->total() }})</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <a class="btn btn-info btn-sm d-none d-lg-block m-l-15" href="{{ route('toporder') }}"><i class="fa fa-eye"></i> Order lists</a>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
         
		 
		 
		 
		 
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" style="margin-bottom: 2px;">
                        <form action="{{route('toporder')}}" id="orerControll" method="get">
                            <div class="form-body">
                                <div class="card-body" style="padding-bottom: 0;">
                                    <div class="row">
                                        <div class="col-md-2 col-6">
                                            <div class="form-group ">
							<span class="required">Select Your Region</span>
							<select name="region" onchange="get_city(this.value)" required id="input-payment-country" class="form-control select2">
								<option value=""> Please Select  </option>
								<option value="0"> All Region  </option>
								@foreach($states as $state)
								<option value="{{$state->id}}"> {{$state->name}} </option>
								@endforeach
							</select>
						</div>
                                        </div>
                                        <div class="col-md-2 col-6">
                                            <div class="form-group">
								<span class="required">City</span>
								<select name="city" onchange="get_area(this.value)"  required id="show_city" class="form-control select2">
									
									
									<option  value="0"> All City </option>
									
								</select>
							</div>
                                        </div>
                                                                                  
                                        <div class="col-md-2 col-6">
                                         <div class="form-group ">
							<span class="required">Area</span>
							<select name="area" required id="show_area" class="form-control select2">
									<option  value="0"> All Area </option>
							</select>
						</div>
                                        </div>
                                  
                                        <div class="col-md-2 col-6">
                                            <div class="form-group">
                                                <label class="control-label">From Amount</label>
                                                <input name="start" value="{{ $smt }}" type="number" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-6">
                                            <div class="form-group">
                                                <label class="control-label">To Amount</label>
                                                <input name="end" value="{{ $emt }}" type="number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-6">
                                            <div class="form-group">
                                                <label class="control-label">.</label>
                                               <button type="submit" class="form-control btn btn-success"><i style="color:#fff; font-size: 20px;" class="ti-search"></i> </button>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-1 col-6">
                                            <div class="form-group">
                                                <label class="control-label">.</label>
                                               <button data-toggle="modal" data-target="#sms" class="form-control btn btn-warning"><i class="fa fa-comment-alt"></i> </button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Column -->
                 <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                        <h3>
                           
                                Total Record: ({{$orders->total()}})
                        
                        </h3>
                        <div class="table-responsive">
                            <table class="table display table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                       
                                        <th>Name</th>
                                        <th style="min-width: 100px;">Amount Order</th>
                                        <th>Billing Phone</th>
                                        <th>Shipping Phone</th>
                                         <th>State</th>
                                         <th>City</th>
                                         <th>Area</th>
										<th>Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($orders)>0)
                                        @foreach($orders as $index => $order)
                                        
                                        <tr id="{{$order->order_id}}">
                                            <td>{{(($orders->perPage() * $orders->currentPage() - $orders->perPage()) + ($index+1) )}}</td>
                                           
                                           <td>{{ $order->customer->name }}    </td>
                                            <td>{{config('siteSetting.currency_symble')}}{{$order->amount}}</td>
                                            <td>
                                                @if(!empty($order->billing_phone))
                                                {{$order->billing_phone}} @else
												{{ $order->customer->mobile }}	
												@endif
                                                
                                            </td>
											<td>
											{{$order->shipping_phone}}
											</td>
											
											
											
											 <td>
											     @if(\App\Models\State::where('id', $order->billing_region)->first() != null)
										   {{\App\Models\State::where('id', $order->billing_region)->first()->name}}
										   @endif
                                            </td>
                                            	 <td>
                                            	     @if(\App\Models\City::where('id', $order->billing_city)->first() != null)
										   	{{\App\Models\City::where('id', $order->billing_city)->first()->name}}
										   @endif
                                            </td>		 <td>
										   @if(\App\Models\Area::where('id', $order->billing_area)->first() != null)
										   	{{\App\Models\Area::where('id', $order->billing_area)->first()->name}}
										   	@endif
                                            </td>
											
											
                                           <td>
										   {{$order->billing_address}}
										   
                                            </td>
                                        </tr>
                                       @endforeach
                                    @else <tr><td colspan="8"> <h1>No Consumer found.</h1></td></tr> @endif
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
                   {{$orders->appends(request()->query())->links()}}
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of total {{$orders->total()}} entries ({{$orders->lastPage()}} Pages)</div>
            </div>
     
            <!-- ============================================================== -->
            <!-- End PAge Content -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
 
   <!-- add Modal -->
        <div class="modal fade" id="sms" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Send Sms</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row">
                        <div class="card-body">
                            <form action="{{route('smstoporder')}}" data-parsley-validate method="POST" >
                                {{ csrf_field() }}
                                <div class="form-body">
                                    <div class="row">
                                        
                                        
                                        
                                        <input type="hidden" name="start" value="{{$smt}}">
                                        <input type="hidden" name="end" value="{{$emt}}">
                                        
                                        @if(request()->has('region'))
                                        <input type="hidden" name="region" value="{{request()->region}}">
                                        @endif
                                        
                                         @if(request()->has('city'))
                                        <input type="hidden" name="city" value="{{request()->city}}">
                                        @endif
                                        
                                         @if(request()->has('area'))
                                        <input type="hidden" name="area" value="{{request()->area}}">
                                        @endif
                                        <div class="col-md-12">
                                          
                                                    <div class="form-group">
                                                        <textarea name="details" class="form-control " required placeholder="Write your details" id="details" rows="3">{{old('details')}}</textarea>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="col-md-12">
                                           <div class="modal-footer">
                                                        <button type="submit" name="submit" value="add" class="btn btn-success"> <i class="fa fa-check"></i> Send message</button>
                                                        <button type="button" data-dismiss="modal" class="btn btn-inverse">Cancel</button>
                                                    </div>
                                                    </div>
                                    </div>
                                    <hr/>
                                    <div id="showCustomerDetails"> </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

   
@endsection
@section('js')
    <script type="text/javascript">
	function get_city(id, type=''){
       
        var  url = '{{route("sms.get_city", ":id")}}';
        url = url.replace(':id',id);
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
               
                    $("#show_city"+type).html(data.allcity);
                    $("#show_city"+type).focus();
                
            }
        });
    }  	 

    function get_area(id, type=''){
           
        var  url = '{{route("sms.get_area", ":id")}}';
        url = url.replace(':id',id);
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#show_area"+type).html(data);
                    $("#show_area"+type).focus();
                }else{
                    $("#show_area"+type).html('<option value="0">All Area</option>');
                }
            }
        });
    }  
</script>
	
	

    <script src="{{asset('assets')}}/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets')}}/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
        <script>
    // responsive table
        $('#config-table').DataTable({
            responsive: true, searching: false, paging: false, info: false, ordering: false
        });
    </script>

    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
 
    <script src="{{asset('assets')}}/node_modules/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
 
    <script>
        function checkField(value, field){
            if(value != ""){
                $.ajax({
                    method:'get',
                    url:"{{ route('checkField') }}",
                    data:{table:'order_payments', field:field, value:value},
                    success:function(data){
                        if(data.status){
                            $('#'+field).html("");
                            
                            $('#submitBtn').removeAttr('disabled');
                            $('#submitBtn').removeAttr('style', 'cursor:not-allowed');
                            
                        }else{
                            $('#'+field).html("<span style='color:red'><i class='fa fa-times'></i> "+data.msg+"</span>");
                            
                            $('#submitBtn').attr('disabled', 'disabled');
                            $('#submitBtn').attr('style', 'cursor:not-allowed');
                            
                        }
                    },
                    error: function(jqXHR, exception) {
                        toastr.error('Unexpected error occur.');
                    }
                });
            }else{
                $('#'+field).html("<span style='color:red'>"+field +" is required</span>");
                $('#submitBtn').attr('disabled', 'disabled');
                $('#submitBtn').attr('style', 'cursor:not-allowed');   
            }
        }
        $(function () {
            $('.selectpicker').selectpicker();
        });
    </script>
    <script src="{{asset('assets')}}/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

    <script type="text/javascript">

    $(".select2").select2();
    </script>
 
    <script type="text/javascript">
        function reviewModal(order_id, product_id){
            $('#reviewModal').modal('show');
            $("#getReviewForm").html("<div class='loadingData-sm'></div>");
            $.ajax({
                url:'{{route("adminGetReviewForm")}}',
                type:'get',
                data:{order_id:order_id,product_id:product_id},
                success:function(data){
                    if(data){
                       $('#getReviewForm').html(data);
                    }else{
                      toastr.error(data);
                    }
                }
            });
         }
    </script>


@endsection
