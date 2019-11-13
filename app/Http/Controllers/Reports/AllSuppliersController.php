<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Supplier;

use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class AllSuppliersController extends Controller
{
    //
    public function index()
    {
        return view('reports.all-suppliers');
    }

    public function accounts(Request $request)
    {
        
      $query = Supplier::select('id','name','init','balance')->latest();
      if(!$request->from){
        $query = collect([]);
    }
      return Datatables::of($query)
      ->editColumn('balance',function(Supplier $supplier) use($request){
        $balance = $supplier->init;
        $orderIn = $supplier->orders()->where('type','in')->whereBetween('date',[
            $request->from,
            $request->to,
        ])->sum('final_total');
        $orderOut = $supplier->orders()->where('type','out')->whereBetween('date',[
            $request->from,
            $request->to,
        ])->sum('final_total');
        $cost = $supplier->accounts()->where('type','out')->whereBetween('date',[
            $request->from,
            $request->to,
        ])->sum('cost');
        $balance +=  $orderIn - ($orderOut + $cost);
        return -$balance;
      })
      ->make(true);
    
    }
}
