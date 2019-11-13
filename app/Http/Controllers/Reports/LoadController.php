<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Store;
use App\Models\Load;
use Yajra\Datatables\Datatables;


class LoadController extends Controller
{
    //
    public function index()
    {
        $stores = Store::all();
        return view('reports.load',compact('stores'));
    }

    public function perform(Request $request)
    {
        $query = Load::select('loads.created_at','loads.id','no','stores.name','date')
            ->whereBetween('date',[
                $request->from,
                $request->to
            ]);

            if($request->store_id){
                $query = $query->where('stores.id',$request->store_id);
            }
            if($request->type == 'from'){
                    $query = $query->leftJoin('stores','stores.id','loads.from_id');
             }  else {
                $query = $query->leftJoin('stores','stores.id','loads.to_id');
            }



            return Datatables::of($query)
            ->editColumn('date',function(Load $order){
                return optional($order->date)->toDateString();
            })
            ->make(true);
            

    }
}
