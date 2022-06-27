<?php
 
namespace App\Console\Commands;
 
use Illuminate\Console\Command;
use App\Models\Visitor;
use Carbon\Carbon;

class UpdateAI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:ai';
 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean User Activity';
 
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
$date  = Carbon::now()->subDays(3);
Visitor::where( 'updated_at', '<=', $date )->delete();
			
    }
}