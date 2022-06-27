<?php
 
namespace App\Console\Commands;
 
use Illuminate\Console\Command;
use App\Models\Offer;
use App\Models\QuizQuestion;
use App\Models\QuizExamAnswer;
use App\User;
use App\Traits\Sms;
use Carbon\Carbon;
use App\Models\Transaction;
class Quiz extends Command
{
    
    use Sms;
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:quiz';
 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Quiz Activity';
 
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
 
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        
       
        
$data = Offer::where('paid', 0)->where('offer_type', 'quiz')->whereDate('end_date', '<=', Carbon::now())->get();
		foreach($data as $quiz){
			
				
				
				
			$answer = QuizExamAnswer::with('user')->where('right_answer', 1)->where('quiz_id', $quiz->id)->selectRaw('count(right_answer) as total_right_answer, user_id')->orderBy('total_right_answer', 'desc')->groupBy('user_id')->get();
			$paid = Offer::find($quiz->id);
			
			foreach($answer as $key => $user){
				//$customer = User::find($user->user_id);
				
				$rank = ($key+1);
				if($key <10){
					$msg = 'Dear '. $user->user->name .', Congratulation for ranked #'.$rank.' under top 10 On KalkerDeal Quiz ('.$quiz->title.'). Our support team will contact with You ASAP';
                $this->sendSms($user->user->mobile, $msg);
			
				
				} else {
					
					$balance = round(round($quiz->discount/$quiz->allow_item, 2)*$user->total_right_answer, 2);
				$newbal = ($user->user->wallet_balance+$balance);
					$useradd = User::find($user->user_id);
					$useradd->wallet_balance += $balance;
					$useradd->save();
					$msg = 'Dear '. $user->user->name .', Thanks for participated On KalkerDeal Quiz ('.$quiz->title.'). Your Quiz Point has been added on your WPP balance.';
                $this->sendSms($user->user->mobile, $msg);
				

				 $transaction = new Transaction();
            $transaction->type = 'walletRecharge';
            $transaction->notes = 'Earn From '.$quiz->title;
            $transaction->item_id = $user->user->id;
            $transaction->payment_method = 'quizPoint';
            $transaction->transaction_details = 'Quiz Right Answer Point';
            $transaction->amount = $balance;
            $transaction->total_amount = $balance;
            $transaction->customer_id = $user->user->id;
            $transaction->created_by = 1;
            $transaction->status = 'paid';
            $transaction->save();
				
				}
				
				
				
			}
			
			$paid->paid = 1;
			if($paid->save()){
			    
			    
			    
			    
			    
			}
			
			
			
			
		}
			
    }
}