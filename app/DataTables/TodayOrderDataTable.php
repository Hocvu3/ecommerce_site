<?php

namespace App\DataTables;

use App\Models\Order;
use App\Models\TodayOrder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TodayOrderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('grand_total',function($query){
                return '$'.$query->grand_total;
            })
            ->addColumn('order_status',function($query){
                if ($query->order_status === 'pending') {
                    return  '<span class="badge badge-primary">Pending</span>';
                } else if ($query->order_status === 'delivered') {
                    return '<span class="badge badge-success">Delivered</span></span>';
                }else if ($query->order_status === 'declined') {
                    return '<span class="badge badge-warning">Declined</span></span>';
                }else if ($query->order_status === 'cancel') {
                    return '<span class="badge badge-danger">Cancelled</span></span>';
                }else{
                    '<span class="badge badge-warning">'.$query->status.'</span></span>';
                }
            })
            ->addColumn('payment_status',function($query){
                if ($query->payment_status === 'pending') {
                    return  '<span class="badge badge-primary">Pending</span>';
                }else if ($query->payment_status === 'completed') {
                    return '<span class="badge badge-warning">Completed</span></span>';
                }else{
                    '<span class="badge badge-warning">'.$query->status.'</span></span>';
                }
            })
            ->addColumn('user_name',function($query){
                return $query->user?->name;
            })
            ->addColumn('date',function($query){
                return date('d-m-Y',strtotime($query->created_at));
            })
            ->rawColumns(['order_status','payment_status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        return $model->whereDate('created_at', now()->format('Y-m-d'))->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('order-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('invoice_id'),
            Column::make('user_name'),
            Column::make('product_qty'),
            Column::make('grand_total'),
            Column::make('order_status'),
            Column::make('payment_status'),
            Column::make('date'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Order_' . date('YmdHis');
    }
}
