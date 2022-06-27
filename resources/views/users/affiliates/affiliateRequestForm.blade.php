@extends('layouts.frontend')
@section('title', 'Affiliate Request | '. Config::get('siteSetting.site_name') )
@section('css-top')
    <link href="{{asset('assets')}}/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="breadcrumbs">
    <div class="container">
        <ul class="breadcrumb-cate">
            <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="#">My account</a></li>
         </ul>
    </div>
</div>
<!-- Main Container  -->
<div class="container">
    <div class="row">
        <!--Right Part Start -->
        @include('users.inc.sidebar')
        <!--Middle Part Start-->
        <div id="content" class="col-md-9 sticky-conent">
            @if(Session::has('success'))
            <div class="alert alert-success">
              <strong>Success! </strong> {{Session::get('success')}}
            </div>
            @endif
            @if(Session::has('error'))
            <div class="alert alert-danger">
              <strong>Error! </strong> {{Session::get('error')}}
            </div>
            @endif

            @if($user->affiliateAgent)
            <div class="alert alert-danger">
              <strong>Alert! </strong> Your affiliate request is {{$user->affiliateAgent->status}} review by our team before being activated.
            </div>
            @endif
          
            <form action="{{ route('agent.affiliateRequest') }}" method="post" data-parsley-validate>
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                    <fieldset id="personal-details">
                        <legend>Affiliate Request Form</legend></fieldset>
                    </div>
                    
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="referral_website" class="control-label">Referral Website</label>
                            <input type="text" class="form-control" id="referral_website" placeholder="Enter link" value="{{ ($user->affiliateAgent) ? $user->affiliateAgent->referral_website : old('referral_website')}}" name="referral_website">
                        </div>
                    </div>
                    <div class="col-sm-8" style="padding:0;margin: 0;">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="profession" class="control-label required">Profession</label>
                             <select name="profession" required id="profession" class="form-control">
                                <option value="">Select</option>
                                <option @if( $user->profession == 'student') selected @endif value="student">Student</option>
                                <option @if( $user->profession == 'doctor') selected @endif value="doctor">Doctor</option>
                                <option @if( $user->profession == 'employee') selected @endif value="employee">Employee</option>
                                <option @if( $user->profession == 'labourers') selected @endif value="labourers">Labourers</option>
                                <option @if( $user->profession == 'teacher') selected @endif value="teacher">Teacher</option>
                                <option @if( $user->profession == 'others') selected @endif value="others">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="gender" class="control-label required">Gender</label>
                            <select name="gender" required id="gender" class="form-control">
                                <option value="">Select</option>
                                <option @if( $user->gender == 'male') selected @endif value="male">Male</option>
                                <option @if( $user->gender == 'female') selected @endif value="female">Female</option>
                                <option @if( $user->gender == 'other') selected @endif value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    </div>
                    <div class="col-sm-8" style="padding:0;margin: 0;">
                    <div class="row" >
                    
                    <div class="col-sm-4">
                    <div class="form-group ">
                        <span class="required">Select Your Division</span>
                        <select name="region" onchange="get_city(this.value)" required id="input-payment-country" class="form-control select2">
                            <option value=""> Please Select  </option>
                            @foreach($states as $state)
                            <option @if($user->region == $state->id) selected @endif value="{{$state->id}}"> {{$state->name}} </option>
                            @endforeach
                        </select>
                    </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <span class="required">City</span>
                            <select name="city" onchange="get_area(this.value)"  required id="show_city" class="form-control select2">
                                
                                <option value="">Please Select</option>
                                @foreach($cities as $city)
                                <option @if($user->city == $city->id) selected @endif value="{{$city->id}}"> {{$city->name}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                    <div class="form-group ">
                        <span class="required">Area</span>
                        <select name="area" required id="show_area" class="form-control select2">
                                <option value="">Please Select</option>
                                @foreach($areas as $area)
                                <option @if($user->area == $area->id) selected @endif value="{{$area->id}}"> {{$area->name}} </option>
                                @endforeach
                        </select>
                    </div>
                    </div>
                    </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="details" class="control-label">How do you affiliate. </label>
                            <textarea style="resize: vertical;" placeholder="Write details" class="form-control" rows="2" id="details" name="details">{{ ($user->affiliateAgent) ? $user->affiliateAgent->details : old('details')}}</textarea>
                        </div>
                    </div>
                </div>
                 <div class="col-sm-8">
                    <input type="submit" style="width:100%" class="btn btn-md btn-success" value="Affiliate Request">
                </div>
            </form>
        </div>
        <!--Middle Part End-->
    </div>
</div>
<!-- //Main Container -->
@endsection

@section('js')
    <script src="{{asset('assets')}}/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(".select2").select2();
         function get_city(id, type=''){
            var  url = '{{route("checkout.get_city", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data.status){
                        $("#show_city"+type).html(data.allcity);
                        $("#show_city"+type).focus();
                        $(".select2").select2();
                    }else{
                        $("#show_city"+type).html('<option>City not found</option>');
                    }
                }
            });
        }    

        function get_area(id, type=''){
               
            var  url = '{{route("get_area", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data){
                        $("#show_area"+type).html(data);
                        $("#show_area"+type).focus();
                        $(".select2").select2();
                    }else{
                        $("#show_area"+type).html('<option>Area not found</option>');
                    }
                }
            });
        }  
    </script>
@endsection