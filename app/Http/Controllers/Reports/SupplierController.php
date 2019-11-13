<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Supplier;
use App\Models\Account;
use App\Models\Order;

use Yajra\Datatables\Datatables;

use Carbon\Carbon;


class SupplierController extends Controller
{
    private $balance = 0;

    public function index()
    {
        $suppliers = Supplier::select('name','id')->latest()->get();
        return view('reports.supplier',compact('suppliers'));
    }

    public function ordersIn(Request $request)
    {
        $query = Order::
        select('orders.id','orders.created_at','no','date','final_total','suppliers.name')
        ->join('suppliers', function ($join) {
            $join->on('suppliers.id', '=', 'orders.ownerable_id')
            ->where('orders.ownerable_type','App\Models\Supplier');
        })
        ->where('type','in')
        ->whereBetween('date',[
            $request->from,
            $request->to
        ])
        ->where([
            'ownerable_type'=>'App\Models\Supplier',
            'ownerable_id'=>$request->supplier_id,
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
        select('orders.id','orders.created_at','no','date','final_total','suppliers.name')
        ->join('suppliers', function ($join) {
            $join->on('suppliers.id', '=', 'orders.ownerable_id')
            ->where('orders.ownerable_type','App\Models\Supplier');
        })
        ->where('type','out')
        ->whereBetween('date',[
            $request->from,
            $request->to
        ])
        ->where([
            'ownerable_type'=>'App\Models\Supplier',
            'ownerable_id'=>$request->supplier_id,
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
       select('accounts.id','accounts.created_at','accounts.no','accounts.date','reposites.name','cost','orders.no as order','suppliers.name as supplier')
       ->join('suppliers', function ($join) {
        $join->on('suppliers.id', '=', 'accounts.accountable_id')
        ->where('accounts.accountable_type','App\Models\Supplier');
       })
        ->where('accounts.type','in')
        ->whereBetween('accounts.date',[
            $request->from,
            $request->to
        ])
        ->leftJoin('orders','orders.id','=','accounts.order_id')
        ->leftJoin('reposites','reposites.id','=','accounts.reposite_id')
        ->where('accountable_id', $request->supplier_id)
        ->latest();
      
        return Datatables::of($query)
        ->editColumn('date',function(Account $account){
            return optional($account->date)->toDateString();
        })
        ->make(true);
        
    }


    public function accountsOut(Request $request)
    {
       $query =  Account::select('accounts.id','accounts.created_at','accounts.no','accounts.date','reposites.name','cost','orders.no as order','suppliers.name as supplier')
       ->join('suppliers', function ($join) {
        $join->on('suppliers.id', '=', 'accounts.accountable_id')
        ->where('accounts.accountable_type','App\Models\Supplier');
       })
        ->where('accounts.type','out')
        ->whereBetween('accounts.date',[
            $request->from,
            $request->to
        ])
        ->leftJoin('orders','orders.id','=','accounts.order_id')
        ->leftJoin('reposites','reposites.id','=','accounts.reposite_id')
        ->where('accountable_id', $request->supplier_id)
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
        $supplier = null;
       if($request->supplier_id){
        $from = Carbon::parse($request->from);
        $to = Carbon::parse($request->to);
        $supplier = Supplier::find($request->supplier_id);
        $balance = $supplier->init;
        for($date = $from; $date->lte($to); $date->addDay()) {
                $d = $date->toDateString();
                $orderOut = $supplier->orders()->where('type','out')->whereDate('date',$d)->sum('final_total');
                $orderIn = $supplier->orders()->where('type','in')->whereDate('date',$d)->sum('final_total');
                $cost = $supplier->accounts()->where('type','out')->whereDate('date',$d)->sum('cost');
                $balance +=  $orderOut - ($orderIn + $cost);

                $collect->push([
                    'date'=>$d,
                    'order_in'=> $orderIn ,
                    'order_out'=> $orderOut ,
                    'cost'=> $cost,
                    'balance'=>-$balance,
                ]);
        }
        $this->balance = $collect->last()['balance'];
    }
       
      return Datatables::of($collect)
        ->with(['balance'=>$this->balance ,'supplier'=>$supplier])
        ->make(true);
    
    
    }
}
