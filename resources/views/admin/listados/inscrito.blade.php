


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
                        Relacion de postulantes
                    </h3>
                    <h2 class="m-portlet__head-label m-portlet__head-label--success">
                        <span>LISTADOS</span>
                    </h2>
                </div>
            </div>

        </div>
        <div class="m-portlet__body">

            <table class="table table-striped- table-bordered table-hover" id="listados_s">

                <thead>
                <tr>
                    <th> Código </th>
                    <th> Paterno </th>
                    <th> Materno </th>
                    <th> Nombres </th>
                    <th> DNI </th>


                    <th> Modalidad</th>
                    <th> Especialidad </th>
                    <th> Modalidad 2</th>
                    <th> Especialiad 2 </th>
                    <th> Institución Educativa </th>

                    <th> Gestión </th>
                    <th> Email </th>
                    <th> Celular </th>
                    <th> Telefono Fijo </th>
                    <th> Otro Telefono </th>



                    <th> Fecha Preinscripcion </th>
                    <th> Datos Personales </th>
                    <th> Datos Familiares </th>
                    <th> Datos Encuesta </th>
                    <th> Estado Foto  </th>

                    <th> Estado DNI</th>
                    <th> Pago </th>
                    <th> Inscrito </th>

                    <th>Opciones </th>

                    <th>DNI </th>
                </tr>
                </thead>

                    <tbody>
                    </tbody>
            </table>


            <!--begin::Modal-->
            <div class="modal fade" id="m_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">DNI SUBIDO</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <img class="img-fluid" id="foto_resp" >


                                <iframe id="frame_pdf" class="embed-responsive-item" width="100%" height="600px"></iframe>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                        </div>
                    </div>
                </div>
            </div>

            <!--end::Modal-->

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

            processing: true,

            ajax: '{{ url('admin/listado-inscrito-table') }}',
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todo"]],
            columns: [

                { data : 'codigo' },
                { data : 'paterno' },
                { data : 'materno' },
                { data : 'nombres'},
                { data : 'numero_identificacion'},
                { data : 'modalidad' },
                { data : 'especialidad' },
                { data : 'modalidad2' },
                { data : 'especialidad2' },
                { data : 'institucion'},
                { data : 'gestion'},
                { data : 'email' },
                { data : 'telefono_celular' },
                { data : 'telefono_fijo' },
                { data : 'telefono_varios' },
                { data : 'fecha_registro' },
                { data : 'datos_personales' },
                { data : 'datos_familiares' },
                { data : 'encuesta' },
                { data : 'foto_estado' },
                { data : 'estado_dni' },
                { data : 'pago' },
                { data : 'datos_ok' },
                { data : 'id' },
                {data: 'foto_dni'}



            ],columnDefs: [
                {  // set default column settings
                    'orderable': true,
                    'targets': '_all'
                },
                {
                    'targets':21,
                    'render': function ( data, type, row ) {

                        if (data) {
                            return '<span class="m-badge m-badge--success">SI</span>';
                        }else{
                            return '<span class="m-badge m-badge--danger"> NO </span>';



                        }
                    }
                },{
                    'targets':22,
                    'render': function ( data, type, row ) {

                        if (data) {
                            return '<span class="m-badge m-badge--success">SI</span>';
                        }else{
                            return '<span class="m-badge m-badge--danger"> NO </span>';



                        }
                    }
                },


                {
                    'targets':23,
                    'render': function ( data, type, row, meta ) {

                        @if (str_contains(Auth::user()->codigo_rol,['root','sistemas']))
                        return '<a href="postulantes-ficha/'+data+'" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Ficha del Postulante"> <i class="la la-file-text"></i> </a>'+
                            '<a href="pagos/'+data+'" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Formato De Pago"> <i class="la la-edit"></i> </a>';
                        @else
                            return '';
                        @endif
                    }
                },

                {
                    'targets':24,
                    'render': function ( data, type, row, meta ) {

                        var e ="'";
                        var p = "'";

                        var f= e.concat(data);
                        var din=f.concat(p);

                        return '<a data-toggle="modal" data-target="#m_modal_4" onclick="modalFoto('+din+')" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="DNI"> <i class="flaticon-profile-1"></i> </a>';
                    }
                }
            ],
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







        function modalFoto(e) {

            $('#foto_resp').hide();
            $('#frame_pdf').hide();
            var f = '/storage/'+e;
            var len = e.length;


            var res = e.substring(len-5);

            if(res.includes(".pdf") || res.includes(".PDF") ){

                $('#foto_resp').hide();
                $('#frame_pdf').show();


                $('#frame_pdf').attr('src', '');
                $('#frame_pdf').attr("src", f);

            } else {
                $('#foto_resp').show();
                $('#frame_pdf').hide();
                $('#foto_resp').attr('src', '');
                $('#foto_resp').attr("src", f);

            }






        }
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




