@extends('layouts.frontend')
@section('title', $offer->title)

@section('css')
<link href="{{asset('assets')}}/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .countdown-item{background: red;border-radius: 3%}
    .terms-condition p{font-size:15px;padding-left: 25px;}

.radio input[type="radio"] {
    position: absolute;
    opacity: 0;
}
.radio input[type="radio"] + .radio-label:before  {
        content: '';
        background: #f4f4f4;
        border-radius: 100%;
        border: 1px solid #b4b4b4;
        display: inline-block;
        width: 1.6em;
        height: 1.6em;
        position: relative;
        top: -0.2em;
        left: -1rem;
        margin-right: 1em;
        vertical-align: top;
        cursor: pointer;
        text-align: center;
        transition: all 250ms ease;      
    }
.radio input[type="radio"]:checked + .radio-label:before {background-color: #7c4dff;box-shadow: inset 0 0 0 4px #f4f4f4;}
.radio input[type="radio"]:focus + .radio-label:before  {outline: none;border-color: #7c4dff;} 
.radio input[type="radio"]:disabled + .radio-label:before  {box-shadow: inset 0 0 0 4px #f4f4f4;border-color: darken(#f4f4f4, 25%);border-color: #b4b4b4;}
.radio input[type="radio"]:empty + .radio-label:before {  margin-right: 0;     }
input[type="text"], input[type="password"] {
  margin-bottom: 0.1rem;
}
.fb_dialog_content iframe{display:none !important;}
#nextButton {
  border: none;
  border-radius: 5rem;
  background-color: #649a05;  
  padding: 1.0rem 1.0rem;
  margin-right: 1rem;
    transition: background-color 0.5s ease; 
}
#nextButton:focus {
  outline:0;
}
#nextButton:hover {color: #000000;background-color: #FFC107; }
label {text-align: left;font-weight: bold;line-height: 16px;}
.buttons { padding: 1rem;font-size: smaller;font-weight: bold;margin: 0.5rem 0 2rem 0;}
.show {display: visible;}
.hide {display: none;}

/* quiz section */
.callout {display: inline-block;background-color: #DCEDC8;border: 1rem solid #FFC107;border-radius: 1.8rem;margin: 2.5rem 0;}
.main {margin: 5px 2rem;}
.radio{margin-left: 2rem}
.answer p{margin-bottom: 0.1rem;}
.quizButtons {color: #ffffff;padding: 0 20px;font-size: 18px;}
.quizButton {display: inline-block;}
#scoreButton { color: #000000;background-color: #FFC107;  }
#scoreButton:hover {color: #FFFFFF;background-color: #7c4dff;  }
.results {color: white;margin-top: 1.5rem;}
#quizForm{min-height: 200px;}
#quizForm h3{font-size:14px;line-height: initial;}
.QuizQuestions{min-height: 160px;}
.errorArea{color: red;}
#countDown{width: 100%;
    height: 30px;font-size: 18px;color: #e20b0b;
    font-size: 20px;
    text-align: right;}
    .offer-info{text-align: left;display: inline-block;padding: 10px;border-radius: 5px;margin-bottom: 10px;}
.offer-info p{line-height: 16px;}
.unselectable {
  -webkit-user-select: none;  /* Chrome all / Safari all */
  -moz-user-select: none;     /* Firefox all */
  -ms-user-select: none;      /* IE 10+ */
  user-select: none;          /* Likely future */       
}
#ansStatus{display: none;}
</style>
@endsection
@section('content')
    <section onselectstart="return false" class="unselectable" @if(Request::route('order_id')) oncontextmenu="return false;" @endif style="background: #5f0449;">
        <div class="container">
            <div id="main-menu">
                <div class="row">
                    <div id="quizContainer" style="width: 100%;position: relative;" class="callout default-primary-color medium-8 small-12 columns">
                        <h1 style="font-size: 18px; text-align: center;background: #d4d1cc;color: #e9168c;margin: 0;padding: 5px;border-top-left-radius: 13px; border-top-right-radius: 13px;">{{$offer->title}} </h1>
                        <!-- quiz question area  -->
                        <div class="row">
                            <div class="col-12">
                                <div id="formContainer" class="main">
                                    @if(Request::route('order_id'))
                                    @php $quizStartTime = Carbon\Carbon::parse($participateTime)->addMinutes($offer->duration)->format('Y-m-d H:i:s'); $quizEndTime = Carbon\Carbon::parse(now())->format('Y-m-d H:i:s');
         
                                    @endphp
                                    @if( $quizEndTime <= $quizStartTime)
                                    @if ($quizNO <= Session::get('number_of_question'))
                                    <div id="countDown"></div>
                                    <form id="quizForm" class="answer" action="#" style="display: block;">
                                        @csrf
                                        <div id="QuizQuestions">
                                        <h3>{{$quizNO}} . {{$question->question_title}} </h3>
                                        <input type="hidden" name="qsn_id" value="{{$question->id}}">
                                        <div class="radio">
                                            <input id="1" required type="radio" value="1" name="answer">
                                            <label class="radio-label" for="1">{{$question->option_1 }}</label>
                                        </div>
                                        <div class="radio"><input id="2" required type="radio" value="2" name="answer">
                                            <label class="radio-label" for="2">{{ $question->option_2 }}</label>
                                        </div>
                                        @if ($question->option_3 != null)
                                        <div class="radio"><input id="3" required type="radio" value="3" name="answer">
                                            <label class="radio-label" for="3">{{$question->option_3 }}</label>
                                        </div>
                                        @endif
                                        @if ($question->option_4 != null) 
                                        <div class="radio"><input id="4" required type="radio" value="4" name="answer">
                                            <label class="radio-label" for="4">{{ $question->option_4 }}</label>
                                        </div>
                                        @endif

                                        <div id="quizButtons" class="quizButtons large-10 medium-10 columns">
                                            <div id="next" class="quizButton large-2">
                                              <button type="submit" id="nextButton" class="buttons">Next question</button>
                                            </div>
                                        </div>
                                        </div><p style="color: red;" id="errorArea"></p>
                                    </form> 
                                    <div id="ansStatus"><img style="position: absolute;top: -30px;left: 0;width: 90px;" src="https://thumbs.gfycat.com/AptDifferentGrunion-max-1mb.gif"></div>
                                    <div class="progress" style="position:relative;width: 100%;">
                                      <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50"
                                      aria-valuemin="0" aria-valuemax="100" style="background-color:#689F38;width: {{$progress}}%;">
                                        <span style="position: absolute;top: 0;color: #000;left: 15px;"><span id="qsnNo" >{{$quizNO}}</span> out of {{Session::get('number_of_question')}}</span>
                                      </div>
                                    </div>
                                    @else
                                    <h3>Thanks <br/> Your quiz successfully completed!</h3>
                                    @endif
                                    @else
                                    <h3>Quiz Time Expired</h3>
                                    @endif
                                    @else
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p style="font-size: 14px;padding-bottom: 5px;line-height: initial; "><span style="font-size:25px">☛</span> কুইজে অংশগ্রহণ করার জন্য দয়া করে @if(!Request::get('order_id')) আপনার কুইজ ক্রয়কৃত অর্ডার আইডি দিয়ে  @endif ফর্মটি পূরণ করে নিচের Get started now বাটনে ক্লিক করুন ।</p>
                                            <form method="post" action="{{route('quizParticipate')}}" style="display: block;">
                                            @csrf
                                            
                                                <div @if(Request::get('order_id')) style="display:none;" @endif class="form-group">
                                                    <label style="left: 25px !important;" for="option1">Quiz Package Order Id</label>
                                                    <input type="text" value="{{ old('order_id') ? old('order_id') : Request::get('order_id') }}"  required placeholder="Enter Order Id" name="order_id" class="form-control">
                                                    <p style="color: red;" id="errorArea"> @if(Session::has('error')) {{Session::get('error')}} @endif</p>
                                                </div>
                                                <div class="form-group" style="width: 49%; float: left;">
                                                    <span class="required">Select Your Division</span>
                                                    <select name="division" onchange="get_city_by_division(this.value)" required  class="form-control ">
                                                        <option value=""> --- Please Select --- </option>
                                                        @foreach($states as $state)
                                                        <option @if(Auth::user()->region == $state->id) selected @endif value="{{$state->id}}"> {{$state->name}} </option>
                                                        @endforeach
                                                    </select>
                                                    </div>
                                                    <div class="form-group " style="width: 49%; float: right;">
                                                        <span class="required">City</span>
                                                        <select name="city" required id="show_city" class="form-control select2">
                                                            <option value=""> Select first division </option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group ">
                                                        <span class="required">Address</span>
                                                        <input type="text" value="{{Auth::user()->address}}" required name="address" placeholder="Enter Address" id="input-payment-address" class="form-control">
                                                    </div>
                                                <!-- quiz buttons area  -->
                                                <div id="quizButtons" class="quizButtons large-10 medium-10 columns">
                                                    <div id="next" class="quizButton large-2">
                                                      <button type="submit" id="nextButton" class="buttons">Get started now</button>
                                                    </div>
                                                </div>
                                            </form> 
                                        </div>
                                        <div class="col-md-6">
                                            @if($offer->notes)
                                                <div class="offer-info" style="width: 100%; background: #00000029;color:{!! $offer->text_color !!};">
                                                 {!! $offer->notes !!}
                                                </div> 
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                    <p>You want to participate in more quizzes.? <a href="{{route('offer.details', $offer->slug)}}"> Click Here</a></p>
                                </div>
                            </div>
                        </div>
                    </div>        
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{asset('assets')}}/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

    <script type="text/javascript">
    $(".select2").select2();

    @if(Auth::user()->region) get_city_by_division({{Auth::user()->region}}); @endif
    function get_city_by_division(id, type=''){
        var  url = '{{route("get_city", ":id")}}';
        url = url.replace(':id',id);
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#show_city"+type).html(data);
                    $("#show_city"+type).focus();
                    $(".select2").select2();
                }else{
                    $("#show_city"+type).html('<option>City not found</option>');
                }
            }
        });
    }   
        
        
    </script>
@if(Request::route('order_id'))
<script type="text/javascript">
      $("#quizForm").on("submit", function(event){
        event.preventDefault();
        var formValues= $(this).serialize();
        $('#QuizQuestions').html('<img src="{{asset('frontend/image/loading.gif')}}">');
        var url = '{{route("get_questions", [Request::route("slug"), $offer->id, Request::route("order_id")])}}';
        $.ajax({
            url:url,
            type:'post',
            data:formValues,
            success:function(data){
                if(data.status){
                    if(data.answer == 'wrong'){
                        $("#ansStatus").show(0).delay(1000).hide(0);
                    }
                    $('#QuizQuestions').html(data.data);
                    $('#qsnNo').html(data.qsnNo);
                    $('.progress-bar').css('width', data.progress+'%');
                }else{
                  $('#errorArea').html(data.msg);
                }
              },error: function(jqXHR, exception) {
                 $('#QuizQuestions').html('Internal server error.');
            }
          });
    }); 
    
     $(document).ready(function () {
            document.oncontextmenu = document.body.oncontextmenu = function () { return false; }
        });

</script>

<script>

// Set the date we're counting down to
var countDownDate = new Date("{{Carbon\Carbon::parse($participateTime)->addMinutes($offer->duration)->format('m,d,Y H:i:s')}}").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("countDown").innerHTML = "<span class='timer'>Time Remaining: " + minutes+":"+seconds+"s</span>";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("quizForm").innerHTML = '<div style="text-align: center;"><h3>Thanks <br/> Your quiz time is expired!.</h3><img src="https://c.tenor.com/JO3HPnO1fYsAAAAM/head-angry.gif"></div>';
    document.getElementById("countDown").innerHTML = "";
    $('.progress-bar').css('width', '100%');
  }
}, 1000);

</script>
@endif
@endsection
