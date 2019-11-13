<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Reposite;
use App\Models\Account;
use App\Models\Daily;
use App\Models\Salary;
use App\Models\Loan;

use Yajra\Datatables\Datatables;


class RepositeController extends Controller
{
    //
    public function index()
    {
        $reposites = Reposite::select('name','id')->latest()->get();
        return view('reports.reposite',compact('reposites'));
    } 

    public function suppliersAccountsIn(Request $request)
    {
       $query =  Account::
       select('accounts.id','accounts.created_at','accounts.no','accounts.date','reposites.name','cost','orders.no as order')
        ->where('accountable_type', 'App\Models\Supplier')
        ->where('accounts.type','in')
        ->whereBetween('accounts.date',[
            $request->from,
            $request->to
        ])
        ->leftJoin('orders','orders.id','=','accounts.order_id')
        ->leftJoin('reposites','reposites.id','=','accounts.reposite_id')
        ->latest();

        return Datatables::of($query)
        ->editColumn('date',function(Account $account){
            return optional($account->date)->toDateString();
        })
        ->make(true);
        
    }


    public function suppliersAccountsOut(Request $request)
    {
       $query =  Account::select('accounts.id','accounts.created_at','accounts.no','accounts.date','reposites.name','cost','orders.no as order')
       ->where('accountable_type', 'App\Models\Supplier')
        ->where('accounts.type','out')
        ->whereBetween('accounts.date',[
            $request->from,
            $request->to
        ])
        ->leftJoin('orders','orders.id','=','accounts.order_id')
        ->leftJoin('reposites','reposites.id','=','accounts.reposite_id')
        ->latest();

        return Datatables::of($query)
        ->editColumn('date',function(Account $account){
            return optional($account->date)->toDateString();
        })
        ->make(true);
        
    }



    public function clientsAccountsIn(Request $request)
    {
       $query =  Account::
       select('accounts.id','accounts.created_at','accounts.no','accounts.date','reposites.name','cost','orders.no as order')
        ->where('accountable_type', 'App\Models\Client')
        ->where('accounts.type','in')
        ->whereBetween('accounts.date',[
            $request->from,
            $request->to
        ])
        ->leftJoin('orders','orders.id','=','accounts.order_id')
        ->leftJoin('reposites','reposites.id','=','accounts.reposite_id')
        ->latest();

        return Datatables::of($query)
        ->editColumn('date',function(Account $account){
            return optional($account->date)->toDateString();
        })
        ->make(true);
        
    }


    public function clientsAccountsOut(Request $request)
    {
       $query =  Account::select('accounts.id','accounts.created_at','accounts.no','accounts.date','reposites.name','cost','orders.no as order')
       ->where('accountable_type', 'App\Models\Client')
        ->where('accounts.type','out')
        ->whereBetween('accounts.date',[
            $request->from,
            $request->to
        ])
        ->leftJoin('orders','orders.id','=','accounts.order_id')
        ->leftJoin('reposites','reposites.id','=','accounts.reposite_id')
        ->latest();

        return Datatables::of($query)
        ->editColumn('date',function(Account $account){
            return optional($account->date)->toDateString();
        })
        ->make(true);
        
    }


    public function dailyIn(Request $request)
    {
       $query =  Daily::select(
        'dailies.created_at',
        'dailies.no',
        'dailies.id',
        'dailies.cost',
        'dailies.notes'
        ,'dailies.date',
        'reposites.name as reposite',
        'trees.text as text'

        )
        ->leftJoin('reposites','reposites.id','=','dailies.reposite_id')
        ->leftJoin('trees','trees.id','=','dailies.tree_id')
        ->where('dailies.type','in')
        ->whereBetween('date',[
            $request->from,
            $request->to
        ])
        ->latest();

        return Datatables::of($query)
        ->editColumn('date',function(Daily $account){
            return optional($account->date)->toDateString();
        })
        ->make(true);
        
    }


    public function dailyOut(Request $request)
    {
       $query =  Daily::select(
        'dailies.created_at',
        'dailies.no',
        'dailies.id',
        'dailies.cost',
        'dailies.notes'
        ,'dailies.date',
        'reposites.name as reposite',
        'trees.text as text'

        )
        ->leftJoin('reposites','reposites.id','=','dailies.reposite_id')
        ->leftJoin('trees','trees.id','=','dailies.tree_id')
        ->where('dailies.type','out')
        ->whereBetween('date',[
            $request->from,
            $request->to
        ])
        ->latest();

        return Datatables::of($query)
        ->editColumn('date',function(Daily $account){
            return optional($account->date)->toDateString();
        })
        ->make(true);
        
    }


    public function salaries(Request $request)
    {
       $query =  Salary::select(
        'salaries.notes',
        'salaries.created_at',
        'salaries.id',
        'salaries.net',
        'reposites.name as reposite',
        'employees.name  as employee'
        )
        ->leftJoin('reposites','reposites.id','salaries.reposite_id')
        ->leftJoin('employees','employees.id','salaries.employee_id')
        ->whereBetween('salaries.created_at',[
            $request->from,
            $request->to
        ])
        ->latest();

        return Datatables::of($query)
        ->editColumn('created_at',function(Salary $account){
            return optional($account->created_at)->toDateString();
        })
        ->make(true);
        
    }



    public function loans(Request $request)
    {
       $query =  Loan::select(
        'loans.created_at',
        'loans.id',
        'loans.cost',
        'loans.notes','reposites.name as reposite',
        'employees.name  as employee'
        ,'date')
        ->leftJoin('reposites','reposites.id','=','loans.reposite_id')
        ->leftJoin('employees','employees.id','=','loans.employee_id')
        ->whereBetween('date',[
            $request->from,
            $request->to
        ])
        ->latest();

        return Datatables::of($query)
        ->editColumn('date',function(Loan $account){
            return optional($account->date)->toDateString();
        })
        ->make(true);
    }






}
