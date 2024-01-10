


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
                        Relacion de Victima del Terrorismo que presentaron Documentos.
                    </h3>
                    <h2 class="m-portlet__head-label m-portlet__head-label--success">
                        <span>Victimas del Terrorismo</span>
                    </h2>
                </div>
            </div>

        </div>
        <div class="m-portlet__body">
            {!!Form::botonmodal('Nuevo Victima','#VictimaCreate','green-meadow','fa fa-plus')!!}
            <table class="table table-striped- table-bordered table-hover" id="listados_s">

                <thead>
                <tr>
                    <th> PATERNO </th>
                    <th>  MATERNO </th>
                    <th> NOMBRES </th>
                    <th> DNI </th>
                    <th> ACTIVO </th>
                    <th>Opciones </th>
                </tr>
                </thead>

                @foreach ($Lista as $item)
                    <tr>

                        <td> {{ $item->paterno }} </td>
                        <td> {{ $item->materno }} </td>
                        <td> {{ $item->nombres }} </td>
                        <td> {{ $item->dni }} </td>
                        <td>
                            @if ($item->activo)


                                <span class="m-badge m-badge--success">SI</span>

                            @else
                                <span class="m-badge m-badge--danger"> NO </span>
                            @endif
                        </td>
                        <td>

                            <a href="activar-victima/{!! $item->dni !!}" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="ACTIVAR">
                                <i class="la la-check"></i>
                            </a>

                            <a href="desactivar-victima/{!! $item->dni !!}" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="DESACTIVAR">
                                <i class="la la-close"></i>
                            </a>

                        </td>
                    </tr>
                    @endforeach
                    </tbody>
            </table>



        </div>
    </div>

    <!--end::Portlet-->




    <div class="modal fade" id="VictimaCreate" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                </div>
                {!! Form::open(['route'=>'admin.victimas.store','method'=>'POST']) !!}
                <div class="modal-body">
                    {!! Field::text('dni',['label'=>'DNI DEL POSTULANTE','placeholder'=>'DNI']) !!}
                   <input type="hidden" id="activo" name="activo" value="1"/>
                </div>
                <div class="modal-footer">
                    {!!Form::enviar('Guardar')!!}
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>













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
            order: [[0, 'asc']],



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




