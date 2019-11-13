<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

use App\DataTables\AttendanceDataTable;


class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AttendanceDataTable $dataTable)
    {
        return $dataTable->render('attendance.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();
        return view('attendance.create',compact('employees'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Attendance::create($request->all());
        flash('تمت العمليه بنجاح')->success();
        return redirect()->route('attendance.index');        
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
            $employees = Employee::all();
            return view('attendance.edit',[
                'attendance'=>$attendance,
                'employees'=>$employees,
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        $attendance->update($request->all());
        flash('تمت العمليه بنجاح')->success();
        return redirect()->route('attendance.index');      
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        flash('تمت العمليه بنجاح')->success();
        return redirect()->route('attendance.index');  
    }
}
