<?php

namespace App\DataTables;

use App\Models\productItem;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class productItemDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        // ->setRowId('id'); 
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $action = '';
            if (Gate::allows('read products/productitems')) {
                // $action = '<button type="button" data-id=' . $row->id . ' data-jenis="show" class="btn btn-light btn-sm action"><i class="ti-eye"></i></button>';
                $action = '<a type="button" href="/products/productitems/' . $row->id . '" class="btn btn-light btn-sm"><i class="ti-eye"></i></a>';
            }
            if (Gate::allows('update products/productitems')) {
                $action .= ' <button type="button" data-id=' . $row->id . ' data-jenis="update" class="btn btn-success btn-sm action"><i class="ti-pencil"></i></button>';
            }
            if (Gate::allows('delete products/productitems')) {
                $action .= ' <button type="button" data-id=' . $row->id . ' data-jenis="delete" class="btn btn-danger btn-sm action"><i class="ti-trash"></i></button>';
            }
            return $action;
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\productItem $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(productItem $model): QueryBuilder
    {
        // return $model->newQuery();
        $query = productItem::join('product_categories', 'product_categories.id', '=', 'product_items.category_id')
        ->join('users', 'users.id', '=', 'product_items.user_id')
        ->select([
            'product_items.id',
            'product_categories.name as category',
            'product_items.title',
            'product_items.slug',
            'users.name',
            'product_items.excerpt'
        ]);
        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->parameters(['searchDelay' => 1000])
                    ->setTableId('productitem-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')
                ->title('No')
                ->searchable(\false)
                ->orderable(\false),
            Column::make('category')->title('Categories')->searchable(\false),
            Column::make('title'),
            Column::make('name')->title('User Name'),
            Column::make('excerpt')->title('Excerpt of Product Category'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(120)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'productItem_' . date('YmdHis');
    }
}
