<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Client;
use App\Models\Account;
use App\Models\Order;

use Yajra\Datatables\Datatables;

use Carbon\Carbon;


class ClientController extends Controller
{

    private $balance = 0;
    public function index()
    {
        $clients = Client::select('name','id')->latest()->get();
        return view('reports.client',compact('clients'));
    }

    public function ordersIn(Request $request)
    {
        $query = Order::
        select('orders.id','orders.created_at','no','date','final_total','clients.name')
        ->join('clients', function ($join) {
            $join->on('clients.id', '=', 'orders.ownerable_id')
            ->where('orders.ownerable_type','App\Models\Client');
        })
        ->where('type','in')
        ->whereBetween('date',[
            $request->from,
            $request->to
        ])
        ->where([
            'ownerable_type'=>'App\Models\Client',
            'ownerable_id'=>$request->client_id,
        ])
        ->latest();

        return Datatables::of($query)
                ->editColumn('date',function(Order $order){
                    return optional($order->date)->toDateString();
                })
                ->addColumn('rest',function(Order $order){
                    return $order->max;
                })
                ->addColumn('payed',function(Order $order){
                    return $order->payed;
                })
                ->make(true);
    }


    public function ordersOut(Request $request)
    {

        $query = Order::
        select('orders.id','orders.created_at','no','date','final_total','clients.name')
        ->join('clients', function ($join) {
            $join->on('clients.id', '=', 'orders.ownerable_id')
            ->where('orders.ownerable_type','App\Models\Client');
        })
        ->where([
            'ownerable_type'=>'App\Models\Client',
            'ownerable_id'=>$request->client_id,
        ])
        ->where('type','out')
        ->whereBetween('date',[
            $request->from,
            $request->to
        ])
        ->latest();

        
        return Datatables::of($query)
                ->editColumn('date',function(Order $order){
                    return optional($order->date)->toDateString();
                })
                ->addColumn('rest',function(Order $order){
                    return $order->max;
                })
                ->addColumn('payed',function(Order $order){
                    return $order->payed;
                })
                ->make(true);
    }

    public function accountsIn(Request $request)
    {
       $query =  Account::
       select('accounts.id','accounts.created_at','accounts.no','accounts.date','reposites.name','cost','orders.no as order','clients.name as client')
       ->join('clients', function ($join) {
        $join->on('clients.id', '=', 'accounts.accountable_id')
        ->where('accounts.accountable_type','App\Models\Client');
       })
        ->where('accounts.type','in')
        ->whereBetween('accounts.date',[
            $request->from,
            $request->to
        ])
        ->where('accountable_id', $request->client_id)
        ->leftJoin('orders','orders.id','=','accounts.order_id')
        ->leftJoin('reposites','reposites.id','=','accounts.reposite_id')
        ->latest();
       
        return Datatables::of($query)
        ->editColumn('date',function(Account $account){
            return optional($account->date)->toDateString();
        })
        ->make(true);
        
    }


    public function accountsOut(Request $request)
    {
       $query =  Account::select('accounts.id','accounts.created_at','accounts.no','accounts.date','reposites.name','cost','orders.no as order','clients.name as client')
       ->join('clients', function ($join) {
        $join->on('clients.id', '=', 'accounts.accountable_id')
        ->where('accounts.accountable_type','App\Models\Client');
       })
        ->where('accounts.type','out')
        ->whereBetween('accounts.date',[
            $request->from,
            $request->to
        ])
        ->where('accountable_id', $request->client_id)
        ->leftJoin('orders','orders.id','=','accounts.order_id')
        ->leftJoin('reposites','reposites.id','=','accounts.reposite_id')
        ->latest();
        return Datatables::of($query)
        ->editColumn('date',function(Account $account){
            return optional($account->date)->toDateString();
        })
        ->make(true);
        
    }


    public function account(Request $request)
    {
        $collect =  collect();
        $client = null;
       if($request->client_id){
        $from = Carbon::parse($request->from);
        $to = Carbon::parse($request->to);
        $client = Client::find($request->client_id);
        $balance = $client->init;
        for($date = $from; $date->lte($to); $date->addDay()) {
                $d = $date->toDateString();
                $orderIn = $client->orders()->where('type','in')->whereDate('date',$d)->sum('final_total');
                $orderOut = $client->orders()->where('type','out')->whereDate('date',$d)->sum('final_total');
                $cost = $client->accounts()->where('type','in')->whereDate('date',$d)->sum('cost');
                $balance +=  $orderIn - ($orderOut + $cost);
                $collect->push([
                    'date'=>$d,
                    'order_in'=> $orderIn ,
                    'order_out'=> $orderOut ,
                    'cost'=> $cost,
                    'balance'=>$balance,
                ]);
        }
        $this->balance = $collect->last()['balance'];
    }
       
      return Datatables::of($collect)
        ->with(['balance'=>$this->balance ,'client'=>$client])
        ->make(true);
    
    
    }
}
