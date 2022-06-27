<?php
 
namespace App\Console\Commands;
 
use Illuminate\Console\Command;
use App\Models\Day;
use App\Models\OfferProduct;




class Updatebhata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:bhata';
 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Daily View Limit';
 
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
        $offerproduct = OfferProduct::where('campaign', 'jowar-bhata')->where('status', 1)->get();
			
			
			
			
			
			
			foreach($offerproduct as $product){
				
				
				$offer = OfferProduct::find($product->id);
				$offer->viewlimit = $offer->viewlimits;
			
				
				$offer->save();
			}
			
			
			
			
			
			
    }
}