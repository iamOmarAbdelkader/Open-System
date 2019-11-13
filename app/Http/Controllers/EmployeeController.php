<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DataTables\EmployeesDataTable;

use App\Models\Employee;

use App\Models\Country;

use App\Models\Job;

use Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EmployeesDataTable $dataTable)
    {
        return $dataTable->render('employees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        $jobs = Job::all();
        return view('employees.create',compact('countries','jobs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Employee::create($request->all());
        flash('تمت العملية بنجاح')->success();
        return redirect()->route('employees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        
        return view('employees.show',compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $countries = Country::all();
        $jobs = Job::all();
        return view('employees.edit',compact('employee','countries','jobs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $employee->update($request->all());
        flash('تمت العملية بنجاح')->success();
        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        flash('تمت العملية بنجاح')->success();
        return redirect()->route('employees.index');
    }


    public function download(Employee $employee , $resourse)
    {
        return Storage::download($employee[$resourse]);
    }

    
}
