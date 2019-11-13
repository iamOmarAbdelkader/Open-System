<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Client;

use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class AllClientsController extends Controller
{
    //
    public function index()
    {
        return view('reports.all-clients');
    }

    public function accounts(Request $request)
    {
        
      $query = Client::select('id','name','init','balance')->latest();
      if(!$request->from){
          $query = collect([]);
      }
      return Datatables::of($query)
      ->editColumn('balance',function(Client $client) use($request){
        $balance = $client->init;
        $orderIn = $client->orders()->where('type','in')->whereBetween('date',[
            $request->from,
            $request->to,
        ])->sum('final_total');
        $orderOut = $client->orders()->where('type','out')->whereBetween('date',[
            $request->from,
            $request->to,
        ])->sum('final_total');
        $cost = $client->accounts()->where('type','in')->whereBetween('date',[
            $request->from,
            $request->to,
        ])->sum('cost');
        $balance +=  $orderIn - ($orderOut + $cost);
        return $balance;
      })
      ->make(true);
    
    }
}
