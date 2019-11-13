<?php

namespace App\DataTables;

use App\Models\Order;
use Yajra\DataTables\Services\DataTable;

class OrdersOutDataTable extends DataTable
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
            ->addColumn('action', function(Order $order){
                $canBeReturned = $order->canBeReturned();
                $id = $order->id;
                return view('orders-out.actions',compact('id','canBeReturned'))->render();
            });
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
        ->select('orders.id','orders.created_at','no','date','final_total','suppliers.name')
        // ->leftJoin('suppliers','suppliers.id','orders.ownerable_id')
        ->join('suppliers', function ($join) {
            $join->on('suppliers.id', '=', 'orders.ownerable_id')
            ->where('orders.ownerable_type','App\Models\Supplier');
        })
        ->where('type','out')
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
                'name'=>'date',
                'data'=>'date',
                'title'=>'التاريخ',                
            ],
           
            [
                'name'=>'suppliers.name',
                'data'=>'name',
                'title'=>'المورد',                
            ],
            [
                'name'=>'final_total',
                'data'=>'final_total',
                'title'=>'الاجمالي',                
            ], 
            [
                'name'=>'payed',
                'data'=>'payed',
                'title'=>'المدفوع من المصنع',                
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
        return 'OrdersIn_' . date('YmdHis');
    }
}
