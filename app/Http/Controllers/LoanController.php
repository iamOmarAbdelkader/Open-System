<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Employee;
use App\Models\Reposite;
use Illuminate\Http\Request;

use App\DataTables\LoansDataTable;


class LoanController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LoansDataTable $dataTable)
    {
  
        return $dataTable->render('loans.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            $employees = Employee::all();
            $reposites = Reposite::all();
            return view('loans.create',compact('employees','reposites'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Loan::createLoan($request);
        flash('تمت العمليه بنجاح')->success();
        return redirect()->route('loans.index');        
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
            $employees = Employee::all();
            $reposites = Reposite::all();
            return view('loans.edit',[
                'loan'=>$loan,
                'employees'=>$employees,
                'reposites'=>$reposites,
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {
        $loan->updateLoan($request);
        flash('تمت العمليه بنجاح')->success();
        return redirect()->route('loans.index');      
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        $loan->deleteLoan();
        flash('تمت العمليه بنجاح')->success();
        return redirect()->route('loans.index');  
    }
}
