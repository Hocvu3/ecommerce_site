<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $edit = "<a href='" . route('admin.category.edit', $query->id) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                //$delete = "<button data-url='".route('admin.slider.destroy', $query->id)."' class='btn btn-danger delete-item ml-2'><i class='fas fa-trash'></i></button>";
                $delete = "<a href='" . route('admin.category.destroy', $query->id) . "' class='btn btn-danger delete-item ml-2'><i class='fas fa-trash'></i></a>";
                return $edit . $delete;
            })
            ->addColumn('show_at_home', function ($query) {
                if ($query->show_at_home === 1) {
                    return  '<span class="badge badge-primary">Yes</span>';
                } else if ($query->show_at_home === 0) {
                    return '<span class="badge badge-secondary">No</span></span>';
                }
            })
            ->addColumn('status', function ($query) {
                if ($query->status === 1) {
                    return  '<span class="badge badge-primary">Active</span>';
                } else if ($query->status === 0) {
                    return '<span class="badge badge-secondary">InActive</span></span>';
                }
            })
            ->rawColumns(['show_at_home', 'action', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Category $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('category-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0)
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
            Column::make('id')->width(50),
            Column::make('name')->width(450),
            Column::make('show_at_home')->width(100),
            Column::make('status')->width(100),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Category_' . date('YmdHis');
    }
}
