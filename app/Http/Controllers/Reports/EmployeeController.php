<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use Yajra\Datatables\Datatables;

class EmployeeController extends Controller
{
    //
    public function index()
    {
        $employees = Employee::all();
        return view('reports.employee',compact('employees'));
    }

    public function perform(Request $request)
    {
         $query = Employee::select(
            'employees.name',
            'employees.date_of_appointment',
            'employees.id','employees.phone_1',
            'jobs.name as job','employees.created_at'
            )
            ->leftJoin('jobs','jobs.id','=','employees.job_id')
            ->whereBetween('date_of_appointment',[
                $request->from,
                $request->to,
            ]);

            return Datatables::of($query)
            ->editColumn('date_of_appointment',function(Employee $employee){
                return optional($employee->date_of_appointment)->toDateString();
            })
            ->make(true);
    }
}
