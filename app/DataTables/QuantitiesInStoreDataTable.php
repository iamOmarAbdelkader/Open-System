<?php

namespace App\DataTables;

use App\Models\Quantity;
use Yajra\DataTables\Services\DataTable;

class QuantitiesInStoreDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\client $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Quantity $model)
    {
        return $model
        ->select('items.name','quantities.quantity','quantities.created_at')
        ->leftJoin('items','items.id','=','quantities.item_id')
        ->where('quantities.store_id',optional($this->request()->store)->id)
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
                'name'=>'items.name',
                'data'=>'name',
                'title'=>'الاسم',                
            ],
             [
                'name'=>'quantities.quantity',
                'data'=>'quantity',
                'title'=>'الكمية',                
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
        return 'QuantitiesInStore_' . date('YmdHis');
    }
}
