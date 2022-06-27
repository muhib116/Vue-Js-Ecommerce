@extends('layouts.admin-master')
@section('title', 'Affiliate Configuration')
@section('css')
    <link href="{{asset('css')}}/pages/tab-page.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        #generalSetting input, #generalSetting textarea{color: #797878!important}
    </style>
@endsection
@section('content')
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                
                <div class="col-md-12 align-self-center ">
                    <div class="d-fl ">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Affiliate</a></li>
                            <li class="breadcrumb-item active">Configuration</li>
                        </ol>
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
                <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    
                                    <li class="nav-item"> <a class="nav-link  active " data-toggle="tab" href="#reCaptcha" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Affiliate Configuration</span></a> </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                   
                                    <div class="tab-pane active" id="reCaptcha" role="tabpanel">
                                        <div class="p-20">
                                            <form action="{{route('google_recaptcha')}}"  method="post" data-parsley-validate id="reCaptcha">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $affiliate_configure->id }}">
                                                <div class="form-body">
                                                    <div class="">
                                                        <div class="form-group row">
                                                            <div class="col-md-3 text-right">
                                                                <label class="col-form-label">Allow Affiliate Registration </label>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="custom-control custom-switch">
                                                                  <input name="status" onclick="satusActiveDeactive('affiliates', '{{$affiliate_configure->id}}')" {{ ($affiliate_configure->status) ? 'checked' : ''}}  type="checkbox" class="custom-control-input" id="status">
                                                                  <label style="padding: 5px 12px" class="custom-control-label" for="status"></label>
                                                                </div>
                                                            </div> 
                                                            <div class="col-md-6">
                                                                <p>Allow users to register as affiliate program</p>
                                                            </div> 
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-3 text-right col-form-label">
                                                                <label class="col-form-label"> Affiliate Agent Registration </label>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="custom-control custom-switch">
                                                                  <input name="registration_status" onclick="satusActiveDeactive('affiliates', '{{$affiliate_configure->id}}', 'registration')" {{ ($affiliate_configure->registration == 1) ? 'checked' : ''}} id="registration" type="checkbox" class="custom-control-input" >
                                                                  <label for="registration" style="padding: 5px 12px" class="custom-control-label"></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p>New user affiliate accounts registration status.</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-3 text-right col-form-label">
                                                                <label class="col-form-label">Register Affiliate as Active </label>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="custom-control custom-switch">
                                                                  <input name="registration_status" id="registration_status" onclick="satusActiveDeactive('affiliates', '{{$affiliate_configure->id}}', 'registration_status')" {{ ($affiliate_configure->registration_status == 1) ? 'checked' : ''}}  type="checkbox" class="custom-control-input" >
                                                                  <label style="padding: 5px 12px" class="custom-control-label" for="registration_status"></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p>New affiliate accounts will be created with active status.</p>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group row">
                                                            <label class="col-md-3 text-right col-form-label" for="value2">Minimum Withdrawal Amount</label>
                                                            <div class="col-md-5">
                                                                <input onblur="setItemValue('withdrawal_amount', this.value)" type="number" value="{{ $affiliate_configure->withdrawal_amount }}" placeholder="Example: 50" name="withdrawal_amount" class="form-control" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-3 text-right col-form-label" for="value3">Cookie Duration</label>
                                                            <div class="col-md-5">
                                                                <input type="number" onblur="setItemValue('cookie_duration', this.value)" value="{{ $affiliate_configure->cookie_duration }}" min="1" placeholder="Example: 30" name="cookie_duration" class="form-control" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-3 text-right col-form-label">Minimum Offer Price</label>
                                                            <div class="col-md-5">
                                                                <input type="number" onblur="setItemValue('minimum_offer_price', this.value)" value="{{ $affiliate_configure->minimum_offer_price }}" min="1" placeholder="Example: 30" name="minimum_offer_price" class="form-control" >
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-3 text-right col-form-label" for="value3">Minimum Time Duration</label>
                                                            <div class="col-md-5">
                                                                <input type="number" onblur="setItemValue('time_duration', this.value)" value="{{ $affiliate_configure->time_duration }}" min="1" placeholder="Example: 30" name="time_duration" class="form-control" >
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
                    </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
@endsection

@section('js')
    <script type="text/javascript">
        // set seller price rate for offer 
        function setItemValue(field,value) {
          if(value){
            var link = '{{route("admin.setAnyItemValue")}}';
           var id = '{{$affiliate_configure->id}}';
            $.ajax({
                url:link,
                method:"get",
                data:{value:value,id:id,table:'affiliates', field: field},
                success:function(data){
                    if(data.status){
                        toastr.success(data.msg);
                    }else{
                        toastr.error(data.msg);
                    }
                }

            });
        }
        }
    </script>
@endsection
