<?php

namespace App\DataTables;

use App\Models\Role;
use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class UserRoleDataTable extends DataTable
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
            // ->setRowId('id')
            /* ->addColumn('roles', function ($row) {
                $roled = DB::table('roles')
                    ->join('model_has_roles', 'model_has_roles.role_id', '=', 'roles.id')
                    ->select('roles.name')
                    ->where('model_has_roles.model_id', $row)
                    ->get();
                    return $roled;
            }) */
            ->addColumn('action', function ($row) { 
                $action = '';
                if (Gate::allows('delete accessmanagements/assignuserrole')) {
                    $action = '<button type="button" data-id=' . $row->id . ' data-jenis="update" class="btn btn-warning btn-sm action"><i class="ti-pencil"></i></button>';
                }
                return $action;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
        // $query = User::join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
        //          ->join('sections', 'sections.id', '=', 'users.sect_id')
        //          ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
        //          ->join('departments', 'departments.id', '=', 'sections.dept_id')
        //         ->select([
        //             'users.id',
        //             'users.name',
        //             'departments.name as dept',
        //             'roles.name as role'
        //         ]);
        // return $this->applyScopes($query);
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
            ->setTableId('userrole-table')
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
            Column::make('id')
                    ->width(10),
            Column::make('name'),
            Column::make('dept')
                ->title('Department'),
            Column::make('role')
                    ->title('Role Assigned')
                    ->searchable(false),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(70)
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
        return 'UserRole_' . date('YmdHis');
    }
}
