@extends('layouts.admin')

@section('content')

    <div class="row">

        <div class="col-12">
            <div class="m-portlet m-portlet--creative m-portlet--bordered-semi">

                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="flaticon-statistics"></i>
												</span>
                            <h3 class="m-portlet__head-text">
                                Configurar Aula de Admisión
                            </h3>
                            <h2 class="m-portlet__head-label m-portlet__head-label--success">
                                <span>CONFIGURACIÓN DE AULAS</span>
                            </h2>
                        </div>
                    </div>

                </div>
                <div class="m-portlet__body">

                    <h3>POSTULANTES TURNO MAÑANA</h3>
                    <h3>{{ $cantidad_turno_m->cantidad }}</h3>

                    <h3>CAPACIDAD TURNO MAÑANA</h3>
                    <h3>{{ $capacidad_turno_m->capacidad }}</h3>

                    <hr>
                    <h3>POSTULANTES TURNO TARDE</h3>
                    <h3>{{ $cantidad_turno_t->cantidad }}</h3>



                    <h3>CAPACIDAD TURNO TARDE</h3>
                    <h3>{{ $capacidad_turno_t->capacidad }}</h3>

                    <hr>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <th>
                            FACULTAD
                        </th>
                        <th>POSTULANTES</th>
                        <th>ASIGNADOS</th>
                        <th>TURNO</th>
                        <th>SECTORES OCUPADOS</th>
                        <th>DISPONIBLE DIA 1</th>
                        <th>DISPONIBLE DIA 2</th>
                        <th>DISPONIBLE DIA 3</th>
                        <th>ACCIONES</th>

                        </thead>


                        <tbody>



                        @foreach ($lista_aulas as $item)
                            <tr>
                        <td>{{ $item->sigla }}</td>
                                <td>{{ $item->postulantes }}</td>
                                <td>{{ $item->asignado_1 }}</td>
                        <td>{{ $item->turno }}</td>
                        <td>{{ $item->sector }}</td>
                                <td>{{ $item->disponible_1 }}</td>
                                <td>{{ $item->disponible_2 }}</td>
                                <td>{{ $item->disponible_3 }}</td>

                        <td><a  href="asignar-aulas/{{$item->id}}" type="button" class="btn btn-primary">
                                <i class="fa fa-credit-card"></i>DETALLES</a></td>
                            </tr>
                        @endforeach

                        </tbody>



                    </table>





                </div>



            </div>
        </div>











    </div>


    <div class="row">
        <div class="col-12">
            <div class="m-portlet m-portlet--creative m-portlet--bordered-semi">

                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="flaticon-statistics"></i>
												</span>
                            <h3 class="m-portlet__head-text">
                                Listado de aulas turno mañana
                            </h3>
                            <h2 class="m-portlet__head-label m-portlet__head-label--danger">
                                <span>AULAS TURNO MAÑANA</span>
                            </h2>
                        </div>
                    </div>

                </div>
                <div class="m-portlet__body">

                    <table class="table table-striped table-bordered table-hover aulas">
                        <thead>
                        <th>SECTOR</th>
                        <th>CODIGO</th>

                        <th>DISPONIBLE 1</th>
                        <th>ASIGNADO 1</th>
                        <th>ASIGNADO REAL 1</th>

                        <th>DISPONIBLE 2</th>
                        <th>ASIGNADO 2</th>
                        <th>ASIGNADO REAL 2</th>

                        <th>DISPONIBLE 3</th>
                        <th>ASIGNADO 3</th>
                        <th>ASIGNADO REAL 3</th>


                        </thead>


                        <tbody>



                        @foreach ($lista_aula_m as $item)
                            <tr>
                                <td>{{ $item->sector }}</td>
                                <td>{{ $item->codigo }}</td>

                                <td>{{ $item->disponible_01 }}</td>
                                <td>{{ $item->asignado_01 }}</td>
                                <td>{{ $item->asigando_1_real }}</td>

                                <td>{{ $item->disponible_02 }}</td>
                                <td>{{ $item->asignado_02 }}</td>
                                <td>{{ $item->asigando_02_real }}</td>

                                <td>{{ $item->disponible_03 }}</td>
                                <td>{{ $item->asignado_03 }}</td>
                                <td>{{ $item->asigando_03_real }}</td>


                             </tr>
                        @endforeach

                        </tbody>



                    </table>


                </div>




            </div>

        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <div class="m-portlet m-portlet--creative m-portlet--bordered-semi">

                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="flaticon-statistics"></i>
												</span>
                            <h3 class="m-portlet__head-text">
                                Listado de aulas turno mañana
                            </h3>
                            <h2 class="m-portlet__head-label m-portlet__head-label--info">
                                <span>AULAS TURNO TARDE</span>
                            </h2>
                        </div>
                    </div>

                </div>
                <div class="m-portlet__body">

                    <table class="table table-striped table-bordered table-hover aulas">
                        <thead>
                        <th>SECTOR</th>
                        <th>CODIGO</th>
                        <th>DISPONIBLE 1</th>
                        <th>ASIGNADO 1</th>
                        <th>ASIGNADO REAL 1</th>

                        <th>DISPONIBLE 2</th>
                        <th>ASIGNADO 2</th>
                        <th>ASIGNADO REAL 2</th>

                        <th>DISPONIBLE 3</th>
                        <th>ASIGNADO 3</th>
                        <th>ASIGNADO REAL 3</th>


                        </thead>


                        <tbody>



                        @foreach ($lista_aula_t as $item)
                            <tr>
                                <td>{{ $item->sector }}</td>
                                <td>{{ $item->codigo }}</td>

                                <td>{{ $item->disponible_01_tarde }}</td>
                                <td>{{ $item->asignado_01_tarde }}</td>
                                <td>{{ $item->asigando_1_real }}</td>

                                <td>{{ $item->disponible_02_tarde }}</td>
                                <td>{{ $item->asignado_02_tarde }}</td>
                                <td>{{ $item->asigando_02_real }}</td>

                                <td>{{ $item->disponible_03_tarde }}</td>
                                <td>{{ $item->asignado_03_tarde }}</td>
                                <td>{{ $item->asigando_03_real }}</td>


                            </tr>
                        @endforeach

                        </tbody>



                    </table>


                </div>




            </div>

        </div>

    </div>



<div class="row">
    <div class="col-md-12">
    {!! Alert::render() !!}
    @include('alerts.errors')
        <!-- BEGIN Portlet PORTLET-->

        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cubes"></i>
                    Gestion de Aulas
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                    <a href="" class="fullscreen"> </a>
                    <a href="javascript:;" class="remove"> </a>
                </div>
            </div>
            <div class="portlet-body">
            
               
                {!!Form::boton('Aulas Activas','','blue','fa fa-check')!!}
               
           
            <p></p>
                <div class="row">
                    <div class="col-md-12">

                        <table class="table table-bordered table-hover" id="Aulas">
                            <thead>
                                <tr>
                                    
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                    <th colspan="2"> Día 01 </th>
                                    <th colspan="2"> Día 02 </th>
                                    <th colspan="2"> Día 03 </th>
                                    <th colspan="2"> Vocacional </th>
                                    <th>  </th>
                                   
                                </tr>
                                <tr>
                                    
                                    <th> Orden </th>
                                    <th> Sector </th>
                                    <th> Codigo </th>
                                    <th> Capacidad </th>
                                    <th> Disponible </th>
                                    <th> Asignado </th>
                                    <th> Disponible </th>
                                    <th> Asignado </th>
                                    <th> Disponible </th>
                                    <th> Asignado </th>
                                    <th> Disponible </th>
                                    <th> Asignado </th>
                                    <th> Activo </th>
                                    
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    
                                    <th> Orden </th>
                                    <th> Sector </th>
                                    <th> Codigo </th>
                                    <th> Capacidad </th>
                                    <th> Disponible </th>
                                    <th> Asignado </th>
                                    <th> Disponible </th>
                                    <th> Asignado </th>
                                    <th> Disponible </th>
                                    <th> Asignado </th>
                                    <th> Disponible </th>
                                    <th> Asignado </th>
                                    <th> Activo </th>
                                   
                                </tr>
                            </tfoot>
                            <tbody>
                            </tbody>
                        </table>
                    {!!Form::enviar('Activar')!!}
                    {!! Form::close() !!}
                    </div><!--span-->
                </div><!--row-->
            </div>
        </div>
        <!-- END Portlet PORTLET-->
    </div>
</div>
@stop

@section('js-scripts')
    <script>
        $('.aulas').dataTable({
            "language": {
                "emptyTable": "No hay datos disponibles",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ filas",
                "search": "Buscar :",
                "lengthMenu": "_MENU_ registros"
            },
            stateSave: true,

            dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
            buttons: [
                { extend: 'excel', className: 'btn yellow btn-outline ' }

            ],


        });
    </script>

<script>
var table = $('#Aulas');
table.dataTable({
    "language": {
        "emptyTable": "No hay datos disponibles",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ filas",
        "search": "Buscar Aulas :",
        "lengthMenu": "_MENU_ registros"
    },
    "bProcessing": true,
    "sAjaxSource": '{{ url('admin/lista-aulas') }}',
    "pagingType": "bootstrap_full_number",
    "columnDefs": [
                {  // set default column settings
                    'orderable': true,
                    'targets': '_all'
                },
                
                {
                    'targets':12,
                    'render': function ( data, type, row ) {
                        if (data) {
                            return '<a href="#" class="label label-sm label-info"> Activo </a>';
                        }else{
                            return '<a href="#" class="label label-sm label-danger"> Inactivo </a>';
                        }
                    }
                }
            ],
    "columns": [
           
            { "data": "orden","defaultContent": "" },
            { "data": "sector","defaultContent": "" },
            { "data": "codigo","defaultContent": "" },
            { "data": "capacidad","defaultContent": "" },
            { "data": "disponible_01","defaultContent": "" },
            { "data": "asignado_01","defaultContent": "" },
            { "data": "disponible_02","defaultContent": "" },
            { "data": "asignado_02","defaultContent": "" },
            { "data": "disponible_03","defaultContent": "" },
            { "data": "asignado_03","defaultContent": "" },
            { "data": "disponible_voca","defaultContent": "" },
            { "data": "asignado_voca","defaultContent": "" },
            { "data": "activo","defaultContent": "" }

        ],
        "order": [[12,"asc"],[1,"asc"],[2,"asc"]],
        stateSave: true,
        "initComplete": function() {
                // Sector
                this.api().column(1).every(function(){
                    var column = this;
                    var select = $('<select class="form-control input-sm"><option value="">Sector</option></select>')
                        .appendTo( $(column.footer()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                });
            },
    dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
    buttons: [
        { extend: 'excel', className: 'btn yellow btn-outline ' }

    ],


});




</script>
@stop



@section('plugins-styles')
{!! Html::style('assets/global/plugins/datatables/datatables.min.css') !!}
{!! Html::style('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!}
@stop

@section('plugins-js')
{!! Html::script('assets/global/plugins/jquery-ui/jquery-ui.min.js') !!}
{!! Html::script('assets/global/scripts/datatable.js') !!}
{!! Html::script('assets/global/plugins/datatables/datatables.min.js') !!}
{!! Html::script('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}
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

@section('breadcrumb')

@stop


@section('page-title')

@stop

@section('page-subtitle')
@stop



