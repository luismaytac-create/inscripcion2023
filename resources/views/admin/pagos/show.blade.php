@extends('layouts.admin')

@section('content')
    {!! Alert::render() !!}
    @include('alerts.errors')
    <!--begin::Portlet-->
    <div class="m-portlet m-portlet--creative m-portlet--bordered-semi">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="flaticon-statistics"></i>
												</span>
                    <h3 class="m-portlet__head-text">
                        Lista de Pagos registrados en el sistema.
                    </h3>
                    <h2 class="m-portlet__head-label m-portlet__head-label--success">
                        <span>PAGOS</span>
                    </h2>
                </div>
            </div>

        </div>
        <div class="m-portlet__body">
            <table class="table table-striped- table-bordered table-hover Recaudacion">
                <thead>
                <tr>
                    <th> Recibo </th>
                    <th> Código de Servicio </th>
                    <th> Descripcion </th>
                    <th> Monto </th>
                    <th> Fecha </th>
                    <th> DNI </th>
                    <th> Postulante </th>

                    <th> Banco </th>
                    <th> Referencia </th>

                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>


@stop

@section('js-scripts')
    <script>
        var table = $('.Recaudacion');

        // begin first table
        table.DataTable({
            responsive: true,
            @if (str_contains(Auth::user()->codigo_rol,['admin','jefatura','root','sistemas']))
            buttons: [


                'excelHtml5',

            ],
            //== DOM Layout settings
            dom: `<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>
			<'row'<'col-sm-12'tr>>
			<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            @endif
            lengthMenu: [5, 10, 25, 50],

            pageLength: 10,

            language: {
                "emptyTable": "No hay datos disponibles",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ filas",
                "search": "Buscar Postulante :",
                "lengthMenu": "_MENU_ registros",

            },

            //== Order settings
            order: [[0, 'asc']],
            ajax: {
                url: '{{ url('admin/pagos-lista') }}'

            },columns: [
                { "data": "recibo","defaultContent": "" },
                { "data": "servicio","defaultContent": "" },
                { "data": "descripcion","defaultContent": "" },
                { "data": "monto","defaultContent": "" },
                { "data": "fecha","defaultContent": "" },
                { "data": "codigo","defaultContent": "" },
                { "data": "nombrecliente","defaultContent": "" },

                { "data": "banco","defaultContent": "" },
                { "data": "referencia","defaultContent": "" },

            ],



        });


    </script>
@stop

@section('plugins-styles')



    {!! Html::style('assets2/vendors/custom/datatables/datatables.bundle.css') !!}
@stop

@section('plugins-js')



    {!! Html::script('assets2/vendors/custom/datatables/datatables.bundle.js') !!}




@stop




@section('menu-user')
    @include('menu.profile-admin')
@stop

@section('sidebar')
    @include(Auth::user()->menu)
@stop


@section('user-name')
    {!!Auth::user()->dni!!}
@stop

@section('title')
    Listado
@stop

@section('breadcrumb')
@stop

@section('page-title')

@stop

@section('page-subtitle')
@stop




