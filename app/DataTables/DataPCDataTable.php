<?php

namespace App\DataTables;

use App\Models\DataPC;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class DataPCDataTable extends DataTable
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
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $action= ''; 
                if (Gate::allows('update exportimport/datapc')) {
                    $action = '<button type="button" data-id=' . $row->id . ' data-jenis="edit" class="btn btn-primary btn-sm action"><i class="bi bi-pencil-square"></i></button>';
                }
                if (Gate::allows('delete exportimport/datapc')) {
                    $action .= ' <button type="button" data-id=' . $row->id . ' data-jenis="delete" class="btn btn-danger btn-sm action"><i class="bi bi-trash"></i></button>';
                }
                return $action; 
            }
        );
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\DataPC $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(DataPC $model): QueryBuilder
    {
        return $model->newQuery();
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
                    ->setTableId('datapc-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1, 'asc');
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('No')->searchable(\false)->orderable(false),
            Column::make('pchost'),
            Column::make('pctype'),
            Column::make('brand'),
            Column::make('processor'),
            Column::make('ipadrs'),
            Column::make('ram'),
            Column::make('hdd'),
            Column::make('osystem'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'DataPC_' . date('YmdHis');
    }
}
