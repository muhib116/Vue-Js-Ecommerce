<?php
 
namespace App\Console\Commands;
 
use Illuminate\Console\Command;
use App\Models\Day;
use App\Models\OfferProduct;




class Jowarbhata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jowar:bhata';
 
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
	$now = date('Y-m-d H:i:s', time());
        $offerproduct = OfferProduct::where('campaign', 'jowar-bhata')->where('status', 'active')->where(function ($query)  use ($now){
				$query->whereNull('nextupdate');
                $query->orWhere('nextupdate', '>=', $now);
            })->get();
			
			
			
			
			
			foreach($offerproduct as $product){
			    
			    if (strtotime($product->nextupdate) > time() || empty($product->nextupdate)) {
			    $days = Day::where('start', '>=', $product->percentstart)->where('end', '<=', $product->percentend)->first();
			    
			    if($days != null){
			        $delivery = $days->days;
			    } else {
			        $delivery = 7;
			    }
			    
			    
				$min = rand($product->timestart,$product->timeend);
				
				
				$nexttime = strtotime("+{$min} minutes", time());
				$newtime = date('Y-m-d H:i:s', $nexttime);
				$percent = rand($product->percentstart,$product->percentend);
				
				
				$pprice = ($percent / 100) * $product->product->selling_price;
				
				$price =($product->product->selling_price-$pprice);
				
				$offer = OfferProduct::find($product->id);
				$offer->viewlimit -= 1;
				$offer->offer_price = $price;
				$offer->nextupdate = $newtime;
				$offer->lastupdate = $now;
				$offer->delivery = $delivery;
				$offer->discount_type = '%';
				$offer->offer_discount = $percent;
				$offer->off = $percent;
				$offer->save();
			}
			}
			
			
			
			
			
    }
}