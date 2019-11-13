<?php

namespace App\Http\Controllers;


use App\Models\Salary;
use App\Models\Employee;
use App\Models\Reposite;
use Illuminate\Http\Request;

use App\DataTables\SalaryDataTable;


class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SalaryDataTable $dataTable)
    {
        return $dataTable->render('salary.index');
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
        return view('salary.create',compact('employees','reposites'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Salary::createSalary($request);
        flash('تمت العمليه بنجاح')->success();
        return redirect()->route('salary.index');        
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function show(Salary $salary)
    {
        return view('salary.show',compact('salary'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function edit(Salary $salary)
    {
        $employees = Employee::all();
        $reposites = Reposite::all();
        return view('salary.edit',[
                'salary'=>$salary,
                'employees'=>$employees,
                'reposites'=>$reposites,
        ]);

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salary $salary)
    {
        $salary->updateSalary($request);
        flash('تمت العمليه بنجاح')->success();
        return redirect()->route('salary.index');      
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salary $salary)
    {
        $salary->deleteSalary();
        flash('تمت العمليه بنجاح')->success();
        return redirect()->route('salary.index');  
    }
}
