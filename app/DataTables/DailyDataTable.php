<?php

namespace App\DataTables;

use App\Models\Daily;
use Yajra\DataTables\Services\DataTable;

class DailyDataTable extends DataTable
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
            ->editColumn('date',function(Daily $loan){
                return optional($loan->date)->toDateString();
            })
            ->addColumn('action', 'daily.actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\client $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Daily $model)
    {
        return $model
        ->select(
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
                'name'=>'dailies.no',
                'data'=>'no',
                'title'=>'رقم السند',                
            ], 
            [
                'name'=>'dailies.date',
                'data'=>'date',
                'title'=>'التاريخ',                
            ], 
            [
                'name'=>'reposites.name',
                'data'=>'reposite',
                'title'=>'الخزنة',                
            ],
            [
                'name'=>'dailies.cost',
                'data'=>'cost',
                'title'=>'القيمة',                
            ],

            [
                'name'=>'trees.text',
                'data'=>'text',
                'title'=>'النوع',                
            ],
            [
                'name'=>'dailies.notes',
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
        return 'DailyDateTable_' . date('YmdHis');
    }
}
