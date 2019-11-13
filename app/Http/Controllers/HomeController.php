<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Order;
use App\Models\Account;
use App\Models\Daily;
use App\Models\Quantity;
use App\Models\Item;
use Yajra\Datatables\Datatables;
use DB;

class HomeController extends Controller
{
    //
    public function index()
    {
        $clients = Client::count();
        $employees = Employee::count();
        $suppliers = Supplier::count();
        $ordersIn = Order::where('type','in')->whereNull('order_id')->sum('final_total');
        $ordersOut = Order::where('type','out')->whereNotNull('order_id')->sum('final_total');
        $in = Account::where('type','in')->sum('cost') + Daily::where('type','in')->sum('cost');
        $out = Account::where('type','out')->sum('cost') + Daily::where('type','out')->sum('cost');
        $items = Item::count();
        $profits =   $in - $out;
        return view('home.index',compact('clients','employees','suppliers','ordersIn','ordersOut','profits','items','in','out'));
    }


    public function quantitiesLessThan()
    {
        $query = Quantity::
        select('items.created_at','items.name as item','stores.name as store','quantity')
        ->leftJoin('items','items.id','=','quantities.item_id')
        ->leftJoin('stores','stores.id','=','quantities.store_id')
        ->where('quantities.quantity','<=',10)->latest();
        return Datatables::of($query)->make(true);
    }

    public function itemsBalance()
    {
        $query = Item::
        select('items.created_at','items.name as item',DB::raw('sum(quantities.quantity) as sum_of_quantity'))
        ->leftJoin('quantities','items.id','=','quantities.item_id')
        ->groupBy('items.id');
        return Datatables::of($query)
        ->editColumn('sum_of_quantity',function(Item $item){
            if(!$item->sum_of_quantity)
            {
                $item->sum_of_quantity = 0;
            }

            return $item->sum_of_quantity;
        })
        ->make(true);
    }

    
}
