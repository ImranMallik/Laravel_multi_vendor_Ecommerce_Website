<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
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
                $editBtn = "<a href='" . route('admin.products.edit', $query->id) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='" . route('admin.products.destroy', $query->id) . "' class='btn btn-danger ml-2 delet-item'><i class='fas fa-trash-alt'></i></a>";

                $newBtn = '<div class="dropleft d-inline ml-2">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cog"></i>
                </button>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -132px, 0px); top: 0px; left: 0px; will-change: transform;">
                  <a class="dropdown-item has-icon" href="#"><i class="far fa-heart"></i> Action</a>
                  <a class="dropdown-item has-icon" href="#"><i class="far fa-file"></i> Another action</a>
                  <a class="dropdown-item has-icon" href="#"><i class="far fa-clock"></i> Something else here</a>
                </div>
              </div>';

                return $editBtn . $deleteBtn . $newBtn;
            })
            ->addColumn('image', function ($query) {
                return $img = "<img width = '70px' src='" . asset($query->thumb_image) . "'></img>";
            })
            ->addColumn('product_type', function ($query) {
                switch ($query->product_type) {
                    case 'new_arrival':
                        return '<i class="badge badge-success">New Arrival</i>';
                        break;
                    case 'featured_product':
                        return '<i class="badge badge-warning">Featured Product</i>';
                        break;
                    case 'top_product':
                        return '<i class="badge badge-danger">Top Product</i>';
                        break;
                    case 'best_product':
                        return '<i class="badge badge-info">Best Product</i>';
                        break;

                    default:
                        return '<i class="badge badge-dark">None</i>';
                        break;
                }
            })
            ->addColumn('status', function ($query) {
                if ($query->status == 1) {
                    $button = '<label class="custom-switch mt-2">
                    <input type="checkbox" checked data-id="' . $query->id . '" name="custom-switch-checkbox" class="custom-switch-input change-status">
                    <span class="custom-switch-indicator"></span>
                  </label>';
                } else {

                    $button = '<label class="custom-switch mt-2">
                    <input type="checkbox" data-id="' . $query->id . '" name="custom-switch-checkbox" class="custom-switch-input change-status">
                    <span class="custom-switch-indicator"></span>
                  </label>';
                }
                return $button;
            })
            ->rawColumns(['image', 'product_type', 'status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('product-table')
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

            Column::make('id'),
            Column::make('image'),
            Column::make('name'),
            Column::make('price'),
            Column::make('product_type')->width(150),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(250)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Product_' . date('YmdHis');
    }
}
