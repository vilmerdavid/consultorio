<?php

namespace App\DataTables;

use App\Models\Historiaclinica;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class HcDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('user_id',function($hc){
                return $hc->user_m->apellido.' '.$hc->user_m->nombre;
            })

            ->editColumn('created_at',function($hc){
                return $hc->created_at.' <small>'.$hc->created_at->diffForHumans().'</small>';
            })
            
            ->filterColumn('user_id',function($query, $keyword){
                $query->whereHas('user_m', function($query) use ($keyword) {
                    $query->whereRaw("concat(apellido,' ',nombre) like ?", ["%{$keyword}%"]);
                });            
            })



            ->editColumn('peso',function($hc){
                return $hc->user_m->cedula;
            })

            ->filterColumn('peso',function($query, $keyword){
                $query->whereHas('user_m', function($query) use ($keyword) {
                    $query->whereRaw("cedula like ?", ["%{$keyword}%"]);
                });            
            })


            ->editColumn('talla',function($hc){
                return $hc->user_m->historia_clinica;
            })


            ->filterColumn('talla',function($query, $keyword){
                $query->whereHas('user_m', function($query) use ($keyword) {
                    $query->whereRaw("historia_clinica like ?", ["%{$keyword}%"]);
                });            
            })


            ->addColumn('action', function($hc){
                return view('hc.accion',['hc'=>$hc])->render();
            })
            ->rawColumns(['action','created_at']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Hc $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Historiaclinica $model)
    {
        return $model->newQuery()->orderBy('id','desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('hc-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('Bfrtip')
                    // ->orderBy(1)
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
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->title('Acción')
                  ->addClass('text-center'),
            Column::make('id')->title('N° HC'),
            Column::make('user_id')->title('Paciente'),
            Column::make('peso')->title('Cédula'),
            Column::make('talla')->title('Historia de usuario'),
            Column::make('created_at')->title('Fecha de ingreso'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Hc_' . date('YmdHis');
    }
}
