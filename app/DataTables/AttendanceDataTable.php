<?php

namespace App\DataTables;

use App\Models\Employee;
use Yajra\DataTables\Services\DataTable;

class AttendanceDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
        ->addColumn('attendance',function(Employee $employee){
            $attendance = optional($employee->attendances()->whereDate('date',$this->request()->date)->first())->attendance_time;
            $id = $employee->id;
            return view('attendance.datatbles.attendance',compact('id','attendance'))->render();
        })
        ->addColumn('abandonment',function(Employee $employee){
            $abandonment = optional($employee->attendances()->whereDate('date',$this->request()->date)->first())->abandonment_time;
            $id = $employee->id;
            return view('attendance.datatbles.abandonment',compact('id','abandonment'))->render();
        })
        ->addColumn('absence',function(Employee $employee){
            $absence = optional($employee->attendances()->whereDate('date',$this->request()->date)->first())->absence;
            $id = $employee->id;
            return view('attendance.datatbles.absence',compact('id','absence'))->render();
        })
        ->addColumn('absence_with_permission',function(Employee $employee){
            $absenceWithPermission = $employee->absence_with_permission;
            $absenceWithPermission = optional($employee->attendances()->whereDate('date',$this->request()->date)->first())->absence_with_permission;
            $id = $employee->id;
            return view('attendance.datatbles.absence-with-permission',compact('id','absenceWithPermission'))->render();
        })
        ->addColumn('action',function(Employee $employee){
            $attendance = optional($employee->attendances()->whereDate('date',$this->request()->date)->first())->id;
            return view('attendance.datatbles.actions',compact('attendance'))->render();
            
        })
        ->rawColumns(['attendance','abandonment','absence','absence_with_permission','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\client $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Employee $model)
    {
        return $model
        ->select(
        'employees.id',
        'employees.name as employee',
        'jobs.name as job',
        'employees.created_at'
        )
        ->leftJoin('jobs','employees.job_id','=','jobs.id')
        ->latest();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->ajax([
                        'data'=>'function(data){
                            data.date = date;
                        }'
                    ])
                    ->parameters($this->getBuilderParameters());
    }

     
    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'name'=>'employees.name',
                'data'=>'employee',
                'title'=>'الموظف',                
            ],
            [
                'name'=>'jobs.name',
                'data'=>'job',
                'title'=>'الوظيفة',                
            ], 
            [
                'name'=>'attendance',
                'data'=>'attendance',
                'title'=>'الحضور',  
                'orderable'=>false,
                'searchable'=>false,              
            ], 
            [
                'name'=>'abandonment',
                'data'=>'abandonment',
                'title'=>'الانصراف', 
                'orderable'=>false,
                'searchable'=>false,               
            ], 
            [
                'name'=>'absence_with_permission',
                'data'=>'absence_with_permission',
                'title'=>'غياب  باذن',                
                'orderable'=>false,
                'searchable'=>false,
            ], 
            [
                'name'=>'absence',
                'data'=>'absence',
                'title'=>'غياب',  
                'orderable'=>false,
                'searchable'=>false,              
            ], 
            [
                'name'=>'action',
                'data'=>'action',
                'title'=>'عمليات',   
                'exportable' => false,
                'printable' => false,
                'searchable' => false,
                'orderable' => false,
            ], 
        ];
    }


    /**
    *Get the builder parameters
    *@return array
    */
    public function getBuilderParameters()
    {
        return [
            'dom' => 'Bfrtip',
            'buttons' => ['excel', 'print', 'reset', 'reload'],
            'language' => [
                      'url' => url('/vendor/datatables/arabic.json')
            ],
            // 'responsive' => true,
            // 'filter' => true,
            // 'order' => [ [0,'desc'] ],
            // 'lengthMenu' => [10,25,50]
            
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Attendance_' . date('YmdHis');
    }
}
