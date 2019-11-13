<?php

namespace App\DataTables;

use App\Models\Order;
use Yajra\DataTables\Services\DataTable;

class ReturnOrdersInDataTable extends DataTable
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
            ->editColumn('date',function(Order $order){
                return optional($order->date)->toDateString();
            })
            ->addColumn('rest',function(Order $order){
                return $order->max;
            })
            ->addColumn('payed',function(Order $order){
                return $order->payed;
            })
            ->addColumn('original_no',function(Order $order){
                return optional($order->parent)->no;
            })
            ->addColumn('action', 'return-orders-in.actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\client $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
    {
        return $model
        ->select('orders.id','orders.order_id','orders.created_at','no','date','final_total','clients.name')
        ->join('clients', function ($join) {
            $join->on('clients.id', '=', 'orders.ownerable_id')
            ->where('orders.ownerable_type','App\Models\Client');
        })
        ->where('type','out')
        ->whereNotNull('order_id')
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
                'name'=>'no',
                'data'=>'no',
                'title'=>'رقم الفاتورة',                
            ],
            [
                'name'=>'original_no',
                'data'=>'original_no',
                'title'=>'عن الفاتورة',                
            ],
            
            [
                'name'=>'date',
                'data'=>'date',
                'title'=>'التاريخ',                
            ],
            [
                'name'=>'clients.name',
                'data'=>'name',
                'title'=>'العميل',                
            ],
            [
                'name'=>'final_total',
                'data'=>'final_total',
                'title'=>'الاجمالي',                
            ], 
            [
                'name'=>'payed',
                'data'=>'payed',
                'title'=>'المدفوع الي العميل',                
            ], 
            [
                'name'=>'rest',
                'data'=>'rest',
                'title'=>'الباقي',                
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
        return 'ReturnOrdersIn_' . date('YmdHis');
    }
}
