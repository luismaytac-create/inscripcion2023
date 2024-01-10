@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN Portlet PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Participante </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a class="reload actualizar"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
        <p></p>
            <div class="table-response">
            </br>
                <table class="table table-striped table-bordered table-hover Postulantes">
                    <thead>
                        <tr>
                            <th> Confirmación</th>
                            <th> Codigo </th>
                            <th> Codigo Verificación </th>
                            <th> Paterno </th>
                            <th> Materno </th>
                            <th> Nombres </th>
                            <th> Tipo Identificación </th>
                            <th> Numero identificación </th>
                            <th> Email </th>
                            <th> Talla </th>
                            <th> Peso </th>
                            <th> Sexo </th>
                            <th> Telefono Celular </th>
                            <th> Telefono Fijo </th>
                            <th> Telefono Varios </th>
                            <th> Modalidad </th>
                            <th> Especialidad </th>
                            <th> Segunda Modalidad </th>
                            <th> Segunda Especialidad </th>
                            <th> Ubigeo </th>
                            <th> Direccion </th>
                            <th> Institución Educativa</th>
                            <th> Tipo de Institución</th>
                            <th> Gestion del Colegio </th>
                            <th> Ubigeo de la Institución </th>
                            <th> Inicio de Estudios </th>
                            <th> Fin de Estudios </th>
                            <th> Fecha Nacimiento </th>
                            <th> Ubigeo Nacimiento </th>
                            <th> Sector 1 </th>
                            <th> Aula 1 </th>
                            <th> Sector 2 </th>
                            <th> Aula 2 </th>
                            <th> Sector 3 </th>
                            <th> Aula 3 </th>
                            <th> Sector voca </th>
                            <th> Aula voca </th>

                            <th> Tipo de preparacion</th>
                            <th> Tiempo de preparacion (meses)</th>
                            <th> Academia</th>
                            <th> Numero veces Postuló</th>

                            <th> Publicidad</th>

                            <th> Fecha Registro </th>
                            <th> Pago </th>
                            <th> Ficha </th>
                            <th> DNI </th>
                        </tr>
                    </thead>
                    <tbody></tbody>
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
    </div>
    <!-- END Portlet PORTLET-->
	</div><!--span-->
</div><!--row-->
<meta name="csrf-token" content="{{ csrf_token() }}" />
@stop

@section('js-scripts')
<script>

    $('.Postulantes').DataTable({
        "language": {
            "emptyTable": "No hay datos disponibles",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ filas",
            "search": "Buscar Postulante :",
            "lengthMenu": "_MENU_ registros"
        },
        responsive: true,
        processing: true,

            ajax: {
                url: '{{url('admin/padron-tabla')}}',
                method: 'POST',
                'headers': {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
        },

        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todo"]],
        pageLength: 10,
        order: [[ 0, "desc" ]],
        columns: [
            { data: 'fecha_conformidad'},
            { data : 'codigo' },
            { data : 'codigo_verificacion' },
            { data : 'paterno' },
            { data : 'materno' },
            { data : 'nombres'},

            { data : 'tipo_documento'},
            { data : 'numero_identificacion'},

            { data : 'email' },
            { data : 'talla' },
            { data : 'peso' },
            { data : 'sexo' },

            { data : 'telefono_celular' },
            { data : 'telefono_fijo' },
            { data : 'telefono_varios' },



            { data : 'modalidad' },
            { data : 'especialidad' },
            { data : 'modalidad2' },
            { data : 'especialidad2' },

            { data : 'ubigeo' },
            { data : 'direccion' },
            { data : 'institucion'},
            { data : 'tipo_institucion'},
            { data : 'gestion'},

            { data : 'ubigeo_institucion'},



            { data : 'inicio_estudios' },
            { data : 'fin_estudios' },
            { data : 'fecha_nacimiento' },
            { data : 'ubigeo_nacimiento' },

            { data : 'sector1' },
            { data : 'aula1' },

            { data : 'sector2' },
            { data : 'aula2' },

            { data : 'sector3' },
            { data : 'aula3' },

            { data : 'sectorvoca' },
            { data : 'aulavoca' },





            { data : 'preparacion' },
            { data : 'mes' },
            { data : 'academia' },

            { data : 'numeroveces' },





            { data : 'publicidad' },




            { data : 'fecha_registro' },

            { data : 'pago' },
            { data : 'id' },
            {data: 'foto_dni'}



        ],columnDefs: [
            {  // set default column settings
                'orderable': true,
                'targets': '_all'
            },{
                'targets':43,
                'render': function ( data, type, row ) {

                    if (data) {
                        return '<span class="m-badge m-badge--success">SI</span>';
                    }else{
                        return '<span class="m-badge m-badge--danger"> NO </span>';



                    }
                }
            },
            {
                'targets':44,
                'render': function ( data, type, row, meta ) {
                    return '<a href="postulantes-ficha/'+data+'" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Ficha del Postulante"> <i class="la la-file-text"></i> </a>'
                        ;
                }
            },
            {
                'targets':45,
                'render': function ( data, type, row, meta ) {

                    var e ="'";
                    var p = "'";

                    var f= e.concat(data);
                    var din=f.concat(p);

                    return '<a data-toggle="modal" data-target="#m_modal_4" onclick="modalFoto('+din+')" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="DNI"> <i class="flaticon-profile-1"></i> </a>';
                }
            }
        ],
        dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
        buttons: [
            { extend: 'excel', className: 'btn yellow btn-outline ' }

        ]


    });


</script>
    <script>
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

@section('breadcrumb')

@stop


@section('title')
Padron
@stop
@section('page-title')

@stop

@section('page-subtitle')
@stop



