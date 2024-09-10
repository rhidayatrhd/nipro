<?php

namespace App\DataTables;

use App\Models\SAPUserGuide;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class SAPUserGuideDataTable extends DataTable
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
                $action = '';
                $action = '<a type="button" href="/userguides/sap_userguide/' . $row->id . '" class="btn btn-light btn-sm"><i class="ti-eye"></i></a>';
                if (Gate::allows('update userguides/sap_userguide')) {
                    $action .= ' <button type="button" data-id=' . $row->id . ' data-jenis="update" class="btn btn-success btn-sm action"><i class="ti-pencil"></i></button>';
                }
                if (Gate::allows('delete userguides/sap_userguide')) {
                    $action .= ' <button type="button" data-id=' . $row->id . ' data-jenis="delete" class="btn btn-danger btn-sm action"><i class="ti-trash"></i></button>';
                }
                return $action;
            });
            
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\SAPUserGuide $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SAPUserGuide $model): QueryBuilder
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
                    -> parameters(['searchDelay' => 1000])
                    ->setTableId('sapuserguide-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(2, 'asc');
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
            Column::make('guideno'),
            Column::make('modulename'),
            Column::make('moduledesc'),
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
        return 'SAPUserGuide_' . date('YmdHis');
    }
}
