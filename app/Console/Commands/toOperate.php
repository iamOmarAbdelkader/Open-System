<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;
use App\Models\Detail;
use App\Models\Client;

use DB;
use App\Models\Transaction;

class toOperate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clients:operate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this for clients who was assigned and the user didnt response with status to them';

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

        Detail::
        select('type',DB::raw('MAX(details.id) as max'),'deadline','client_id','submitted')
        ->having('submitted',false)
        ->whereIn('details.id',function($query){
                $query
                ->select(DB::raw('max(details.id)'))
                ->from('details')
                ->where('type','operation')
               ->groupBy('details.client_id');
        }) 
         // archive
         ->where('user_id','!=','14')
        ->where('deadline','<',Carbon::now())
        ->having('type','operation')
        ->groupBy('client_id')->chunk(10,function($details){
                foreach($details as $detail)
                {
                    $detail->client->update(['to_operate'=>true]);
                }
        });
        
        Client::where('assigned',false)->update(['to_operate'=>true]);
    
    }
}
