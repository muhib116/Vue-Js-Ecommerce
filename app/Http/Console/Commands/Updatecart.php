<?php
 
namespace App\Console\Commands;
 
use Illuminate\Console\Command;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Cart;
use Carbon\Carbon;

class Updatecart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:cart';
 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make Jowar Bhata On Product Pricing';
 
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
			
$newtime  = Carbon::now()->subMinutes(30);				
				
				
				
        $cart = Cart::where('created_at','<=',$newtime)->whereNotNull('offer_id')->pluck('id')->toArray();
			
			Cart::whereIn('id', $cart)->delete();
			
			
			
		
		$order = Order::where('created_at','<=',$newtime)->whereNotNull('offer_id')->where('payment_method', 'pending')->pluck('order_id')->toArray();	
			
			OrderDetail::where('created_at','<=',$newtime)->whereIn('order_id', $order)->delete();
			Order::whereIn('order_id', $order)->delete();
			
    }
}