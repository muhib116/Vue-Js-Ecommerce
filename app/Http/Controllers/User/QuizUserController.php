<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NagadPaymentController;
use App\Http\Controllers\ShurjopayController;
use App\Http\Controllers\SslCommerzPaymentController;

use App\Models\Offer;
use App\Models\Order;
use App\Models\PaymentGateway;
use App\Models\QuizExamAnswer;
use App\Models\QuizParticipant;
use App\Models\QuizQuestion;
use App\Models\State;
use App\Traits\Sms;
use App\Traits\shurjopayDelivery;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class QuizUserController extends Controller
{
    use Sms;
    //quiz participant form
    public function quizStarted(Request $request, $slug){
        $offer = Offer::where('slug', $slug)->whereDate('start_date', '<=', Carbon::now())->whereDate('end_date', '>=', Carbon::now())->where('status', '=', 1)->first();
        if ($offer) {
            $states = State::where('status', 1)->get();
            return view('frontend.offer.quiz.quiz')->with(compact('states','offer'));
        } else {
            Toastr::error('Sorry at this moment quiz not available.');
        }
        return redirect()->back();
    }

    //get started quiz
    public function quizParticipate(Request $request){

        $request->validate([
            'order_id' => 'required',
            'division' => 'required',
            'city' => 'required',
            'address' => 'required',
        ]);
        //get offer quiz id for query any quiz attend in one place
        $quizParticipant = QuizParticipant::where('user_id', Auth::id())->where('order_id', $request->order_id)->where('payment_status', '!=', 'pending')->first();
        if($quizParticipant) {
            $user = User::find(Auth::id());
            $user->region =  $request->division;
            $user->city = $request->city;
            $user->address = $request->address;
            $user->save();
            Session::put('city', $request->city);
            $quiz_id = $quizParticipant->quiz_id;
            //check offer availability
            $offer = Offer::where('id', $quiz_id)->whereDate('start_date', '<=', Carbon::now())->whereDate('end_date', '>=', Carbon::now())->where('status', '=', 1)->first();
            if($offer) {
                //check already exam Participate
                if ($quizParticipant->status == 'pending') {
                    $quizParticipant->division = $request->division;
                    $quizParticipant->city = $request->city;
                    $quizParticipant->address = $request->address;
                    $quizParticipant->status = 'participate';
                    $quizParticipant->participate_date = Carbon::now();
                    $quizParticipant->save();
                    //set number of question
                    Session::put('number_of_question', $offer->allow_item);
                    Session::forget('total_right_answer');
                    Session::forget('number_of_question_no');
                    //direct question page
                    return redirect()->route('get_questions', [$offer->slug, $offer->id, $request->order_id]);
                } else {
                    $msg = 'You are already participating this quiz';
                    return redirect()->back()->with('error', $msg);
                }
            } else {
                return redirect()->back()->with('error', 'Sorry at this moment quiz not available.');
            }
        }else{
            return redirect()->back()->withInput()->with('error', 'This order id is invalid.');
        }
    }
    //get quiz question
    public function get_questions(Request $request, $slug, $quiz_id, $order_id){
        
        $checkOrder = QuizParticipant::where('user_id', Auth::id())->where('quiz_id', $quiz_id)->where('order_id', $order_id)->first();
        if($checkOrder) {
            //insert question answer
            if ($request->qsn_id) {
                $quizExam = new QuizExamAnswer();
                $quizExam->user_id = Auth::id();
                $quizExam->quiz_id = $quiz_id;
                $quizExam->question_id = $request->qsn_id;
                $quizExam->participant_id = $checkOrder->id;
                $quizExam->answer_no = $request->answer;
                $quizExam->right_answer = ($request->answer == Session::get('right_answer')) ? 1 : 0;
                $quizExam->save();
                $total_right_answer = Session::has('total_right_answer') ? Session::get('total_right_answer') : [];
                if($request->answer == Session::get('right_answer')){
                    $ansStatus =  'right';
                    $total_right_answer[] = 1;
                    session(['total_right_answer' => $total_right_answer]);
                }else{
                    $ansStatus =  'wrong';
                }
            }
            //get participate questions
            $getAnsQuestions = QuizExamAnswer::where('user_id', Auth::id())->where('quiz_id', $quiz_id)->get();

            //count question no
            $number_of_question_no = Session::has('number_of_question_no') ? Session::get('number_of_question_no') : [];
            $number_of_question_no[] = 1;
            session(['number_of_question_no' => $number_of_question_no]);
            $quizNO = count(Session::get('number_of_question_no'));
            //get total question no
            $number_of_question = Session::get('number_of_question');
            $progress = ($quizNO == 1) ? 0 : round(($quizNO / $number_of_question) * 100, 0);
            //get question
            $question = QuizQuestion::where('status', 1);
            //check default
            if ( $quizNO == 1) {
                $question->where('category', 1);
            }elseif ($quizNO == 2 || $quizNO == 7 || $quizNO == 10) {
                $question->where('category', 2);
            }elseif ($quizNO == 3 || $quizNO == 8 || $quizNO == 11) {
                $question->where('category', 3);
            }elseif ($quizNO == 4 || $quizNO == 9) {
                $question->where('category', 4);
            }elseif ($quizNO == 5) {
                $question->where('category', 5);
            } elseif ($quizNO == 6) {
                $question->where('category', 6);
            } else {
                $question->where('category', 2);
            }
            //remove use question
            $ids = array_column($getAnsQuestions->toArray(), 'question_id');
            $question = $question->whereNotIN('id', $ids)->inRandomOrder()->first();
            //if any question not found recycle
            if(!$question){
                //get participate question
                $getAnsQuestions = QuizExamAnswer::where('user_id', Auth::id())->where('quiz_id', $quiz_id)->where('participant_id', $checkOrder->id)->get();
                $question = QuizQuestion::where('status', 1);
                if ( $quizNO == 1) {
                    $question->where('category', 1);
                }elseif ($quizNO == 2 || $quizNO == 7 || $quizNO == 10) {
                    $question->where('category', 2);
                }elseif ($quizNO == 3 || $quizNO == 8 || $quizNO == 11) {
                    $question->where('category', 3);
                }elseif ($quizNO == 4 || $quizNO == 9) {
                    $question->where('category', 4);
                }elseif ($quizNO == 5) {
                    $question->where('category', 5);
                } elseif ($quizNO == 6) {
                    $question->where('category', 6);
                } else {
                    $question->where('category', 2);
                }
                //remove use question
                $ids = array_column($getAnsQuestions->toArray(), 'question_id');
                $question = $question->whereNotIN('id', $ids)->inRandomOrder()->first();
            }
            Session::forget('right_answer');
            Session::put('right_answer', $question->answer);

            //if post method
            if ($request->isMethod('post')) {
                if ($question) {
                    $question_option = '';
                    if ($quizNO <= $number_of_question) {
                        $question_option .= '<div class="QuizQuestions">
                        <h3>'.$quizNO.'.'.$question->question_title.'</h3>
                        <input type="hidden" name="qsn_id" value="'.$question->id.'">
                        <div class="radio">
                            <input id="1" required type="radio" value="1" name="answer">
                            <label class="radio-label" for="1">'.$question->option_1.'</label>
                        </div>
                        <div class="radio"><input id="2" required type="radio" value="2" name="answer">
                            <label class="radio-label" for="2">'.$question->option_2.'</label>
                        </div>';
                        if($question->option_3 != null){
                            $question_option .= '<div class="radio"><input id="3" required type="radio" value="3" name="answer">
                            <label class="radio-label" for="3">'.$question->option_3.'</label>
                        </div>';
                        }
                        if($question->option_4 != null){
                            $question_option .= '<div class="radio"><input id="4" required type="radio" value="4" name="answer">
                            <label class="radio-label" for="4">'.$question->option_4.'</label>
                        </div>';
                        }
                        $question_option .= '</div>
                        <div id="quizButtons" class="quizButtons large-10 medium-10 columns">
                            <div id="next" class="quizButton large-2">
                              <input type="submit" id="nextButton" class="buttons" value="Next question">
                            </div>
                        </div>';
                        $output = [
                            'status' => true,
                            'data' => $question_option,
                            'qsnNo' => $quizNO,
                            'progress' => $progress,
                            'answer' => $ansStatus
                        ];
                        return response()->json($output);
                    }else{
                        //insert total right answer
                        $checkOrder->right_answer = count(Session::get('total_right_answer'));
                        $checkOrder->save();
                    }
                    $right_ans_image = (count(Session::get('total_right_answer')) == $number_of_question) ? 'https://c.tenor.com/_5aHVUEDXn0AAAAC/thanks-emoji-thumbs-up.gif' : 'https://c.tenor.com/JO3HPnO1fYsAAAAM/head-angry.gif';
                    $output = [
                        'status' => true,
                        'answer' => $ansStatus,
                        'data' => '<h3>Thanks <br/> Your quiz successfully completed! <br/> Your Score: '.count(Session::get('total_right_answer')).'/'.$number_of_question.'</h3><img src="'.$right_ans_image.'">'
                    ];
                    return response()->json($output);
                } else {
                    $output = [
                        'status' => false,
                        'error' => 'Something went wrong.'
                    ];
                    return response()->json($output);
                }
            } else {
                $offer = Offer::where('id', $quiz_id)->whereDate('start_date', '<=', Carbon::now())->whereDate('end_date', '>=', Carbon::now())
                    ->where('status', '=', 1)->first();
                Session::put('number_of_question', $offer->allow_item);
            }
            $participateTime = $checkOrder->participate_date;
            return view('frontend.offer.quiz.quiz')->with(compact('offer', 'participateTime', 'quizNO', 'progress', 'question'));
        }else{
            return back();
        }
    }
    //view more competitor
    public function allCompetitors(Request $request, $slug){
        $data['offer'] = Offer::where('slug', $slug)->where('status', 1)->first();
        if($data['offer']) {
            //minuse custom competitor
            $top = $data['offer']->seller_id ? count(explode(',', $data['offer']->seller_id)) : 0;
            $limit = 20 - $top;
            $quizTopParticipants = QuizParticipant::join('quiz_exam_answers', 'quiz_participants.id', 'quiz_exam_answers.participant_id')
                ->join('users', 'quiz_exam_answers.user_id', 'users.id')
                ->join('states', 'quiz_participants.division', 'states.id')
                ->where('quiz_participants.status', 'participate')
                ->where('quiz_exam_answers.quiz_id', $data['offer']->id)->where('quiz_exam_answers.right_answer', 1)
                ->whereNotIn('quiz_participants.user_id', explode(',', $data['offer']->seller_id))
                ->selectRaw('users.name,users.photo,states.name as division_name , count(quiz_exam_answers.right_answer) as total_right_answer')
                ->orderBy('total_right_answer', 'desc')
                ->groupBy('quiz_exam_answers.user_id')
                ->paginate($limit);
            $output = '';
            if (count($quizTopParticipants) > 0){
                foreach ($quizTopParticipants as $index => $participate) {
                    $serial = (($quizTopParticipants->perPage() * $quizTopParticipants->currentPage() - $quizTopParticipants->perPage()) + ($index + $top + 1));
                    $image = ($participate->photo) ? $participate->photo : 'default.png';
                    if($serial <= 100) {
                        $output .= '<tr>
                        <td style="width: 3px;"><span style="font-size:20px;">' . $serial . '</span></td>
                        <td style="width: 60px;">
                        <img style="width: 60px; border-radius: 50%;border: 1px solid #009c05;" src="' . asset('upload/users') . '/' . $image . '">
                      </td>
                      <td>
                        <h5 style="margin-bottom:0">' . $participate->name . '</h5>
                        <p>' . $participate->division_name . '</p>
                      </td></tr>';
                    }
                }
                if($serial <= 100) {
                    $output .= '<tr id="load_more_button"><td colspan="3"><a style="text-align:center;font-size: 15px;display: block;" onclick="load_more_competitor(' . ($quizTopParticipants->currentPage() + 1) . ')" href="javascript:void(0)"> View More Competitors</a></td></tr>';
                }
            }
            return $output;
        }
        return view('404');
    }
    //quiz purchase data insert and direct payment gateway page
    public function quizPurchase(Request $request, $slug){
        $offer = Offer::where('slug', $slug)->whereDate('start_date', '<=', Carbon::now())->whereDate('end_date', '>=', Carbon::now())->where('status', '=', 1)->first();
        if ($offer) {
            $order_id = $this->uniqueOrderId($offer->id);
            $quizParticipant = new QuizParticipant();
            $quizParticipant->order_id = $order_id;
            $quizParticipant->quiz_id = $offer->id;
            $quizParticipant->quiz_fee = $offer->discount;
            $quizParticipant->user_id = Auth::id();
            $quizParticipant->payment_method = 'pending';
            $quizParticipant->payment_status = 'pending';
            $quizParticipant->currency_sign = Config::get('siteSetting.currency_symble');
            $quizParticipant->status = 'pending';
            $quizParticipant->save();
            //redirect payment method page for payment
            return redirect()->route('quiz.paymentGateway', encrypt($order_id));
        } else {
            Toastr::error('Sorry at this moment quiz not available.');
        }
        return redirect()->back();
    }
    //select payment gateway list
    public function quizPaymentGateway($orderId)
    {
        try {
            $orderId = Crypt::decrypt($orderId);
        } catch (DecryptException $e) {
            $orderId = $orderId;
        }
        $quizParticipant = QuizParticipant::join('offers', 'quiz_participants.quiz_id', 'offers.id')->where('order_id', $orderId)->selectRaw('quiz_participants.*, offers.title,offers.slug,offers.thumbnail')->first();
        if($quizParticipant){
            $paymentgateways = PaymentGateway::orderBy('position', 'asc')->whereIn('method_slug', ['wallet-balance', 'shurjopay'])->where('method_for', '!=', 'payment')->get();
            return view('frontend.offer.quiz.quiz_payment')->with(compact('quizParticipant', 'paymentgateways'));
        }
        return view('404');
    }
    // process payment gateway & redirect specific gateway
    public function quizPayment(Request $request, $orderId){
        $quizParticipant = QuizParticipant::where('order_id', $orderId)->first();
        if($quizParticipant){
            $total_price = $quizParticipant->quiz_fee;
            $session_data = [
                'order_id' => $quizParticipant->order_id,
                'offer_type' => 'quiz',
                'total_price' => $quizParticipant->quiz_fee,
                'total_qty' => 1,
                'payment_method' => $request->payment_method,
                'currency' => Config::get('siteSetting.currency'),
            ];
            //put new session data
            Session::put('payment_data', $session_data);
        }else{
            Toastr::error('Payment failed.');
            return redirect()->back();
        }
        $payment_data = Session::get('payment_data');

        if($request->payment_method == 'wallet-balance'){
            if(Auth::user()->wallet_balance >= $total_price) {
                Session::put('payment_data.status', 'success');
                Session::put('payment_data.payment_status', 'paid');
                //redirect payment success method
                return $this->paymentSuccess();
            }else{
                Toastr::error('Insufficient waodi power point balance.');
                return redirect()->back();
            }
        }
        elseif($request->payment_method == 'sslcommerz'){
            //redirect SslCommerzPaymentController for payment process
            $sslcommerz = new SslCommerzPaymentController;
            return $sslcommerz->sslCommerzPayment();
        }elseif($request->payment_method == 'nagad'){
            //redirect PaypalController for payment process
            $nagad = new NagadPaymentController;
            return $nagad->nagadPayment();
        }elseif($request->payment_method == 'shurjopay'){
            //redirect shurjopayController for payment process
            $shurjopay = new ShurjopayController();
            return $shurjopay->shurjopayPayment();
        }
        elseif($request->payment_method == 'manual'){
            $trnx_id = ($request->manual_method_name == 'cash') ? 'cash'.rand(000, 999) : $request->trnx_id;
            $checkTrnx = Order::where('tnx_id', $trnx_id)->first();
            if(!$checkTrnx){
                Session::put('payment_data.payment_method', $request->manual_method_name);
                Session::put('payment_data.status', 'success');
                Session::put('payment_data.trnx_id', $request->trnx_id);
                Session::put('payment_data.payment_info', $request->payment_info);
                //redirect payment success method
                return $this->paymentSuccess();
            }else{
                Toastr::error('This transaction is invalid.');
                return redirect()->back()->withInput()->with('error', 'This transaction is invalid.');
            }
        }else{
            Toastr::error('Please select payment method');
        }
        return back();
    }
    //payment confirm and direct quiz form
    public function paymentSuccess(){
        $payment_data = Session::get('payment_data');
        //clear session payment data
        Session::forget('payment_data');
        if($payment_data && $payment_data['status'] == 'success') {
            $order_id = $payment_data['order_id'];
            $quizParticipant = QuizParticipant::with('offer:id,slug')->where('order_id', $order_id)->first();
            if ($quizParticipant) {
                $user_id = $quizParticipant->user_id;
                $user = User::find($user_id);
                if ($quizParticipant && $payment_data['payment_method'] == 'wallet-balance') {
                    //minuse wallet balance;
                    $total_price = $quizParticipant->quiz_fee;
                    if($user->wallet_balance < $total_price) {
                        Toastr::error('Insufficient your kalkerdeal power point balance.');
                        return redirect()->back();
                    }
                    $user->wallet_balance = $user->wallet_balance - $total_price;
                    $user->save();
                }
                $quizParticipant->payment_method = $payment_data['payment_method'];
                $quizParticipant->tnx_id = (isset($payment_data['trnx_id'])) ? $payment_data['trnx_id'] : null;
                $quizParticipant->payment_status = (isset($payment_data['payment_status'])) ? $payment_data['payment_status'] : 'pending';
                $quizParticipant->payment_info = (isset($payment_data['payment_info'])) ? $payment_data['payment_info'] : null;
                $quizParticipant->save();

                $countParticipate = QuizParticipant::where('user_id', $user_id)->where('status', '!=', 'pending')->count();
                if($countParticipate < 3) {
                    //send mobile notify
                    $customer_mobile = $user->mobile;
                    $msg = 'Dear '.$user->name.', Thanks for participating the quiz, your quiz order id (' . $quizParticipant->order_id . ').';
                    $this->sendSms($customer_mobile, $msg);
                }

                //update shurjopay delivery status
               
                return redirect('quiz/'.$quizParticipant->offer->slug.'?order_id='.$quizParticipant->order_id);
            }
        }
        return redirect()->route('user.orderHistory');
    }

    public function uniqueOrderId($offer_id)
    {
        $user_id = Auth::id();
        $offer_id = 'WQ'.$offer_id;
        $numberLen = 10 - strlen($offer_id);
        $order_id = $offer_id.strtoupper(substr(str_shuffle("0123456789"), -$numberLen));

        $check_path = DB::table('quiz_participants')->select('order_id')->where('order_id', 'like', $order_id.'%')->get();
        if (count($check_path)>0){
            //find slug until find not used.
            for ($i = 1; $i <= 999; $i++) {
                $new_order_id = $offer_id.strtoupper(substr(str_shuffle("0123456789"), -$numberLen));
                if (!$check_path->contains('order_id', $new_order_id)) {
                    return $new_order_id;
                }
            }
        }else{ return $order_id; }
    }
}
