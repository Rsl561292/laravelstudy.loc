<?php

namespace App\DataTables\Module\Profile;

use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Services\DataTable;
use App\Article;

class ArticlesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', 'module/profile/articles.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\'App\Article'\Module/Profile/Article $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $query = Article::with([
            'category'
        ])
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc');
/*
        return $this->applyScopes($query);*/
        //return $model->newQuery()->select('id', 'title', 'updated_at', 'published_at', 'status');
        return $query;
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
                    ->addAction(['width' => '80px'])
                    ->parameters([
                        'dom'          => 'Bfrtip',
                        'buttons'      => ['export', 'print', 'reset', 'reload'],
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'title',
            'updated_at',
            'published_at',
            'status',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Articles_' . date('YmdHis');
    }
}
