<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Employee;
use App\Models\Attendance;
use Yajra\Datatables\Datatables;

class AttendanceController extends Controller
{
    //
    public function index()
    {
        $employees = Employee::all();
        return view('reports.attendance.index',compact('employees'));
    }

    public function detailed(Request $request)
    {
        $query = Attendance::select(
            'date',
            'attendance_time',
            'abandonment_time',
            'absence',
            'absence_with_permission',
            'employees.id',
            'employees.name as employee',
            'jobs.name as job',
            'employees.created_at'
            )
            ->leftJoin('employees','employees.id','=','attendances.employee_id')
            ->leftJoin('jobs','employees.job_id','=','jobs.id')
            ->whereBetween('date',[
                $request->from,
                $request->to
            ]);

            if($request->employee_id){
                $query->where('employees.id', $request->employee_id);
            }

            return Datatables::of($query)
            ->editColumn('date',function(Attendance $attendance){
                return optional($attendance->date)->toDateString();
            })
            ->editColumn('absence',function(Attendance $attendance){
                return view('reports.attendance.datatable',[
                    'status'=>$attendance->absence,
                ]);
            })
            ->editColumn('absence_with_permission',function(Attendance $attendance){
                return view('reports.attendance.datatable',[
                    'status'=>$attendance->absence_with_permission,
                ]);
            })
            ->rawColumns(['absence','absence_with_permission'])
            ->make(true);


    }


    public function abstracted(Request $request)
    {
        $query = Employee::
        select('employees.id','employees.name as employee','jobs.name as job','employees.created_at')
        ->leftJoin('jobs','jobs.id','=','employees.job_id')
        ->latest();

        if($request->employee_id){
            $query->where('employees.id', $request->employee_id);
        }

        if(!$request->from){
            $query->where('employees.id', 0);
        }

        return Datatables::of($query)
        ->addColumn('attendance',function(Employee $employee) use($request) {
           return  $employee->attendances()->whereBetween('date',[
                $request->from,
                $request->to,
            ])
            ->whereNotNull('attendance_time')
            ->whereNotNull('abandonment_time')
            ->count();

        })
        ->addColumn('absence',function(Employee $employee) use($request) {
           return $employee->attendances()->whereBetween('date',[
                $request->from,
                $request->to,
            ])
            ->where('absence',true)
            ->count();
        })
        ->addColumn('absence_with_permission',function(Employee $employee) use($request) {
           return $employee->attendances()->whereBetween('date',[
                $request->from,
                $request->to,
            ])
            ->where('absence_with_permission',true)
            ->count();
        })
        ->make(true);
    }
}
