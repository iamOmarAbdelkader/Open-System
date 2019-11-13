<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
        ->addColumn('action', 'users.actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->select(
            'users.*',
            'roles.name as role_name'
        )
        ->leftJoin('role_user','users.id','=','role_user.user_id')
        ->leftJoin('roles','roles.id','=','role_user.role_id');    
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
                'name'=>'id',
                'data'=>'id',
                'title'=>'الكود',                
            ],
            [
                'name'=>'name',
                'data'=>'name',
                'title'=>'الاسم',                
            ],
            [
                'name'=>'user_name',
                'data'=>'user_name',
                'title'=>'اسم المستخدم',                
            ],
            [
                'name'=>'roles.name',
                'data'=>'role_name',
                'title'=>'مستوي الصلاحيات', 
            ], 
            //  [
            //     'name'=>'phone_1',
            //     'data'=>'phone_1',
            //     'title'=>'تليفون 1',                
            // ], 
            // [
            //     'name'=>'phone_2',
            //     'data'=>'phone_2',
            //     'title'=>'2 تليفون',                
            // ], 
            // [
            //     'name'=>'phone_3',
            //     'data'=>'phone_3',
            //     'title'=>'تليفون 3',                
            // ], 
            // [
            //     'name'=>'degree',
            //     'data'=>'degree',
            //     'title'=>'الدرجة العلمية',                
            // ], 
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
        return 'user\Users_' . date('YmdHis');
    }
}
