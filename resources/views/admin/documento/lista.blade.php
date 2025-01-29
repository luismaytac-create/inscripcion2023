


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
                        Relacion de postulantes que presentaron Documentos vía web.
                    </h3>
                    <h2 class="m-portlet__head-label m-portlet__head-label--success">
                        <span>Postulantes con documentos</span>
                    </h2>
                </div>
            </div>

        </div>
        <div class="m-portlet__body">

            <table class="table table-striped- table-bordered table-hover" id="listados_s">

                <thead>
                <tr>
                    <th> PATERNO </th>
                    <th>  MATERNO </th>
                    <th> NOMBRES </th>
                    <th> DNI </th>
                    <th> Modalidad</th>
                    <th> ACTIVO </th>
                    <th> ULT HORA</th>
                    <th>Opciones </th>
                </tr>
                </thead>

                @foreach ($Lista as $item)
                    <tr>

                        <td> {{ $item->paterno }} </td>
                        <td> {{ $item->materno }} </td>
                        <td> {{ $item->nombres }} </td>
                        <td> {{ $item->dni }} </td>
                        <td> {{ $item-> modalidad }}</td>
                        <td>
                            @if ($item->estado == 'PENDIENTE')
                                <span class="m-badge m-badge--warning">PENDIENTE</span>
                            @elseif($item->estado == 'DENEGADO' )
                                <span class="m-badge m-badge--danger"> DENEGADO </span>
                            @elseif($item->estado == 'APROBADO' )
                                <span class="m-badge m-badge--success"> APROBADO </span>
                            @endif
                        </td>
                        <td> {{ $item->fecha }}</td>
                        <td>

                            <a href="evaluar-postulante/{!! $item->dni !!}" class="btn btn-outline-info m-btn m-btn--custom m-btn--outline-2x" >
                                VER DOCUMENTOS
                            </a>

                        </td>
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




        var table = $('#listados_s');

        // begin first table
        table.DataTable({
            responsive: true,

            //== DOM Layout settings


            lengthMenu: [5, 10, 25, 50],

            pageLength: 10,

            language: {
                'lengthMenu': 'Cantidad de Filas _MENU_',
                'search' : 'Buscar'
            },

            @if (str_contains(Auth::user()->codigo_rol,['admin','jefatura','root','sistemas']))

            dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
            buttons: [
                { extend: 'excel', className: 'btn yellow btn-outline ' }

            ],
            @endif
            //== Order settings
            order: [[5, 'desc']],



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
    Victimas Del Terrorismo
@stop

@section('breadcrumb')
@stop

@section('page-title')

@stop

@section('page-subtitle')
@stop




