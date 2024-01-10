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
                        Relación de postulantes cuya foto ha sido rechazada
                    </h3>
                    <h2 class="m-portlet__head-label m-portlet__head-label--success">
                        <span>LISTADOS</span>
                    </h2>
                </div>
            </div>

        </div>
        <div class="m-portlet__body">
            <table class="table table-striped- table-bordered table-hover" id="listado_2">
                <thead>
                    <tr>
                        <th> Codigo </th>
                        <th> DNI </th>
                        <th> Paterno </th>
                        <th> Materno </th>
                        <th> Nombres </th>
                        <th> Email </th>
                        <th> Telefono Fijo </th>
                        <th> Telefono Celular </th>
                        <th> Observacion </th>
                        <th> Fecha </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lista as $item)
                        <tr>
                            <td> {{$item->codigo}} </td>
                            <td> {{$item->numero_identificacion}} </td>
                            <td> {{$item->paterno}} </td>
                            <td> {{$item->materno}} </td>
                            <td> {{$item->nombres}} </td>
                            <td> {{$item->email}} </td>
                            <td> {{$item->telefono_fijo}} </td>
                            <td> {{$item->telefono_celular}} </td>
                            <td> {{$item->observacion}} </td>
                            <td> {{$item->foto_fecha_rechazo}} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!--end::Portlet-->
@stop

@section('js-scripts')
    <script>
        var table = $('#listado_2');
        // begin first table
        table.DataTable({
            responsive: true,
            processing: true,
            pageLength: 50,
            language: {
                'lengthMenu': 'Cantidad de Filas _MENU_',
                'search' : 'Buscar'
            },
            dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
            buttons: [
                { extend: 'excel', className: 'btn yellow btn-outline ' }

            ],
            order: [[0, 'asc']]



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




