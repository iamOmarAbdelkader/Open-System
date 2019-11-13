<?php

namespace App\DataTables;

use App\Models\Salary;
use Yajra\DataTables\Services\DataTable;

class SalaryDataTable extends DataTable
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
            ->editColumn('from',function(Salary $salary){
                return optional($salary->from)->toDateString();
            })
            ->editColumn('to',function(Salary $salary){
                return optional($salary->to)->toDateString();
            })
            ->addColumn('action', 'salary.actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\client $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Salary $model)
    {
        return $model
        ->select(
        'salaries.from',
        'salaries.to',
        'salaries.notes',
        'salaries.created_at',
        'salaries.id',
        'salaries.net',
        'reposites.name as reposite',
        'employees.name  as employee'
        )
        ->leftJoin('reposites','reposites.id','salaries.reposite_id')
        ->leftJoin('employees','employees.id','salaries.employee_id')
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
                    ->minifiedAjax()
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
                'name'=>'from',
                'data'=>'from',
                'title'=>'من',                
            ],
            [
                'name'=>'to',
                'data'=>'to',
                'title'=>'الي',                
            ], 
            [
                'name'=>'employees.name',
                'data'=>'employee',
                'title'=>'الموظف',                
            ],
            [
                'name'=>'reposites.name',
                'data'=>'reposite',
                'title'=>'الخزنة',                
            ],
            [
                'name'=>'net',
                'data'=>'net',
                'title'=>'الصافي',                
            ],
            [
                'name'=>'salaries.notes',
                'data'=>'notes',
                'title'=>'ملاحظات',                
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
            
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Salary_' . date('YmdHis');
    }
}
