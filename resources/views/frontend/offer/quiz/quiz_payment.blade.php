@extends('layouts.frontend')
@section('title', 'Quiz Payment')
@section('css')
  <link href="{{asset('frontend')}}/css/themecss/so_onepagecheckout.css" rel="stylesheet">
  <style type="text/css">
      .nav-tabs{background: #f1f1f1; text-align: center;border-bottom: none;}
      .nav-tabs li a{height: 60px; min-width: 95px;padding: 8px 2px; font-weight: bold;color: #423f3f;}
      .box-inner {padding: 10px 8px !important }
      .checkout-shipping-form p {padding: 3px !important; margin: 0px !important }
      .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
    color: blue; cursor: default; background-color: #fff; border: 1px solid green; border-bottom-color: transparent;}
  </style>
@endsection
@section('content')
	<div class="breadcrumbs">
	    <div class="container">
		    <ul class="breadcrumb-cate">
		        <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
		        <li><a href="#">Quiz Payment</a></li>
		    </ul>
	    </div>
	</div>
	<!-- Main Container  -->
	<div class="container">
		<div id="dataLoading"></div>
		<div class="row">
			<div id="content" class="col-sm-12">
       
				@if(Session::has('alert'))
				<div class="alert alert-danger">
				  {{Session::get('alert')}}
				</div>
				@endif

        
		<div class="so-onepagecheckout layout1 row">
          <div class="col-right col-lg-4 col-md-4 col-sm-6 col-xs-12 sticky-content" style="float:right;">
            <div class="checkout-content checkout-cart">
              <h2 class="secondary-title"><i class="fa fa-shopping-cart"></i>Purchase Details</h2>
              <div class="box-inner">
                <div class="table-responsive checkout-product">
                  <table  id="order_summary" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th class="text-left name" colspan="2">Quiz Name</th>
                        <th class="text-center checkout-price">Price</th>
                        <th class="text-center quantity">Qty</th>
                        <th class="text-right total">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                        <tr>
                          <td class="text-left name"> 
                            <a href="{{route('offer.details', $quizParticipant->slug)}}"><img width="40" src="{{asset('upload/images/offer/thumbnail/'.$quizParticipant->thumbnail)}}" class="img-thumbnail"></a> 
                          </td>
                          <td class="text-left attributes">
                            <a href="{{route('offer.details', $quizParticipant->slug)}}">{{Str::limit($quizParticipant->title, 30)}}</a>
                          </td>
                          <td class="text-right price">{{$quizParticipant->currency_sign}}<span class="amount">{{$quizParticipant->quiz_fee}}</span></td>
                          <td class="text-left quantity">
                            <div class="input-group"> 1 </div>
                          </td>
                          <td class="text-right total">{{$quizParticipant->currency_sign}}<span id="subtotal">{{$quizParticipant->quiz_fee}}</td>
                        </tr>
                      
                    </tbody>
                   
                  </table>
                </div>
              </div>
            </div>
          </div>
					<div style="float:left;" class="col-left col-lg-8 col-md-8 col-sm-6 col-xs-12 sticky-content">
						<div class="checkout-content checkout-register">
							<fieldset>
								<h2 class="secondary-title"><i class="fa fa-map-marker"></i>Select Payment Method</h2>
								<div class="checkout-shipping-form">
									<div class="box-inner">          
                   <div id="process"></div>  
                      @if(Session::has('error'))
                        <div class="alert alert-danger">
                          {{Session::get('error')}}
                        </div>
                      @endif        
                      <ul class="nav nav-tabs">
                          @foreach($paymentgateways as $index => $method)
                            @php 
                            $payment_method[] = $method->method_slug;
                            @endphp
                            
                            <li style=" border-right:1px solid #e2dbdb; margin: 4px 6px 0px 0px;padding: 0; border-radius: 3px;" @if($index == 0) class="active" @endif ><a data-toggle="tab" href="#paymentgateway{{$method->id}}"><img @if($method->method_slug == 'shurjopay') width = "190" height="45" @else width="90" @endif src="{{asset('upload/images/payment/'.$method->method_logo)}}"></a></li>
                          
                          
                          @endforeach
                      </ul>
                     
                      <div class="tab-content">
                        @foreach($paymentgateways as $index => $method)
                          @if($method->is_default == 1)
                          <div id="paymentgateway{{$method->id}}" class="tab-pane fade @if($index == 0) active in @endif">
                              <form action="{{route('quizPayment', $quizParticipant->order_id)}}" method="post" @if($method->method_slug == 'masterCard') class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{$method->public_key}}"  @endif >
                                  @csrf
                                  <input type="hidden"  name="payment_method" value="{{$method->method_slug}}">
                                  
                                  {!! $method->method_info !!}
                                  
                                  @if($method->method_slug == 'wallet-balance')
                                    Woadi Power Point balance: {{ $quizParticipant->currency_sign .  Auth::user()->wallet_balance }}

                                    <p>WPP তে ব্যালেন্স নিতে চাইলে বিকাশে পেমেন্ট করে কাস্টমার সাপোর্ট এ কল করুন। </p><strong>Bkash Merchant: 0131 6100 326</strong>
                                  @endif

                                  @if($method->method_slug == 'masterCard')
                                    <div class="form-row">                                    
                                        <div id="card-element" style="width: 100%">
                                             <div class="display-td" >                            
                                                <img class="img-responsive pull-right" src="https://i76.imgup.net/accepted_c22e0.png">
                                              </div>
                                           
                                              <div class="row">
                                                <div class="col-lg-8 col-md-8">
                                                <div class='col-lg-12 col-md-12 col-xs-12 card '> <span class='control-label required'>Card Number</span> <input  autocomplete='off' placeholder='Enter card number' class='form-control card-number' required size='20' type='text'> </div> <div class='col-xs-3  cvc '> <span class='control-label required'>CVC</span> <input autocomplete='off' class='form-control card-cvc' maxlength="3" placeholder='ex. 311' required size='4' type='text'> </div> <div class='col-xs-4 expiration '> <span class='required control-label'>Month</span>  <input maxlength="2" required class='form-control card-expiry-month' placeholder='MM' size='2' type='text'> </div> <div class='col-xs-5 expiration '> <span class='control-label required'>Expiration Year</span> <input class='form-control card-expiry-year' placeholder='YYYY' required size='4' maxlength="4" type='text'> </div>
                                              </div>
                                            </div>
                      
                                            <div class='row'>
                                                <div class='col-md-12 error form-group hide'>
                                                    <div style="padding: 5px;margin-top: 10px;" class='alert-danger alert'>Please correct the errors and try again.</div>
                                                </div>
                                            </div>          
                                        </div>
                                      <!-- Used to display Element errors. -->
                                      <div id="card-errors" role="alert"></div>
                                    </div>
                                  @endif
                                <div class="text-left">
                                  <span class="secure-checkout-banner1">
                                    <i class="fa fa-lock"></i>
                                    Secure checkout
                                  </span>
                                </div>
                                <div class="text-right" >
                                @if($method->method_slug == 'wallet-balance')
                                    @if(Auth::user()->wallet_balance >= $quizParticipant->quiz_fee)
                                      <button  class="btn payButton btn-success"><span><i class="fa fa-money" aria-hidden="true"></i> Pay with Woadi Power Point </span></button>
                                    @else
                                     <button title="Insufficient Woadi Power Point balance" disabled  class="btn btn-success"><span><i class="fa fa-money" aria-hidden="true"></i> Insufficient Woadi Power Point balance </span></button>

                                    @endif
                                  @else
                                    <button id="{{$method->method_slug}}"  class="btn btn-success payButton"><span><i class="fa fa-money" aria-hidden="true"></i> Pay with {{$method->method_name}}</span></button>
                                  @endif
                                  </div>
                              </form>
                          </div>
                          @else
                          <div id="paymentgateway{{$method->id}}" class="tab-pane fade @if($index == 0) active in @endif">
                            {!! $method->method_info !!}
                            <form action="{{route('order.payment', $quizParticipant->order_id)}}" data-parsley-validate method="post">
                              @csrf
                              <strong style="color: green;">Pay with {{$method->method_name}}.</strong><br/>
                              <input type="hidden"  name="manual_method_name" value="{{$method->method_slug}}">
                              @if($method->method_slug != 'cash')
                              <strong>Payment Transaction Id</strong>
                              <p><input type="text" required data-parsley-required-message = "Transaction Id is required" placeholder="Enter Transaction Id" value="{{old('trnx_id')}}" class="form-control" name="trnx_id"></p>
                              @endif
                              <strong>Write Your {{$method->method_name}} Payment Information below.</strong>
                              <textarea required data-parsley-required-message = "Payment Information is required" name="payment_info" style="margin: 0;" rows="2" placeholder="Write Payment Information" class="form-control">{{old('payment_info')}}</textarea>

                              <div class="text-left">
                                <span class="secure-checkout-banner1">
                                  <i class="fa fa-lock"></i> Secure checkout
                                </span>
                              </div>
                              <div class="text-right">
                                  <button name="payment_method" value="manual" class="btn btn-success"><span><i class="fa fa-money" aria-hidden="true"></i> Pay {{$method->method_name}}</span></button>
                              </div>
                            </form>
                          </div>
                          @endif
                        @endforeach
                         
                      </div>
                  </div>
								</div>
							</fieldset>
						</div>
					</div>

					
				</div>
			</div>
		</div>
	</div>

@endsection

@section('js')
    <script type="text/javascript" src="{{asset('frontend/js/parsley.min.js')}}"></script>

    <script type="text/javascript">

      $('.payButton').on('click', function(){
          document.getElementById('process').style.display = 'block';
      });
   </script>

  @if(in_array('masterCard', $payment_method))
  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  <script type="text/javascript">


  $(function() {
      var $form         = $(".require-validation");
    $('form.require-validation').bind('submit', function(e) {
      var $form         = $(".require-validation"),
          inputSelector = ['input[type=email]', 'input[type=password]',
                           'input[type=text]', 'input[type=file]',
                           'textarea'].join(', '),
          $inputs       = $form.find('.required').find(inputSelector),
          $errorMessage = $form.find('div.error'),
          valid         = true;
          $errorMessage.addClass('hide');
   
          $('.has-error').removeClass('has-error');
      $inputs.each(function(i, el) {
        var $input = $(el);
        if ($input.val() === '') {
          $input.parent().addClass('has-error');
          $errorMessage.removeClass('hide');
          e.preventDefault();
        }
      });
    
      if (!$form.data('cc-on-file')) {
        e.preventDefault();
        Stripe.setPublishableKey($form.data('stripe-publishable-key'));
        Stripe.createToken({
          number: $('.card-number').val(),
          cvc: $('.card-cvc').val(),
          exp_month: $('.card-expiry-month').val(),
          exp_year: $('.card-expiry-year').val()
        }, stripeResponseHandler);
      }
    
    });
    
    function stripeResponseHandler(status, response) {
          if (response.error) {
              $('.error')
                  .removeClass('hide')
                  .find('.alert')
                  .text(response.error.message);
          } else {
              // token contains id, last4, and card type
              var token = response['id'];
              // insert the token into the form so it gets submitted to the server
              $form.find('input[type=text]').empty();
              $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
              $form.get(0).submit();
          }
      }
    
  });

  </script>
  @endif

@endsection