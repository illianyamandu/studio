<?php

namespace App\DataTables;

use App\Models\Cliente;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;


class ClienteDataTable extends DataTable
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
           //->addColumn('action', 'cliente.action')
            ->editColumn('data_nascimento', function($object){
                return Carbon::parse($object->data_nascimento)->format('d-m-Y');
            })
            ->setRowId('cpf');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Cliente $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model): QueryBuilder
    {
        return $model->query()
        ->join('grupo_user', 'users.id', 'grupo_user.user_id')
        ->join('grupos', 'grupo_user.grupo_id', 'grupos.id')
        ->where('grupos.nome', '=', 'cliente')
        ->select([
            'grupos.*',
            'grupos.nome as nome_grupo',
            'users.id as user_id',
            'users.name as nome_usuario'
        ]);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('cliente-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->select(['*']);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('nome_grupo')->title('Nome grupo'),
            Column::make('nome_usuario')->title('Nome usuario'),
            // Column::make('cpf')->title('CPF'),
            // Column::make('data_nascimento')->title('Data de nascimento'),
            // Column::make('telefone')->title('Telefone'),
            // Column::make('email')->title('E-mail'),
            // Column::make('action')->title('Ações')->searchable(false)->orderable(false)
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Cliente_' . date('YmdHis');
    }
}
