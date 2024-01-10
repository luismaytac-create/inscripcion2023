@extends('layouts.admin')

@section('content')
    {!! Alert::render() !!}
    @include('alerts.errors')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-money"></i>POSTULANTES A SEMIBECA </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a class="reload actualizar"> </a>
                        <a href="" class="fullscreen"> </a>
                        <a href="javascript:;" class="remove"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <br>

                    <p></p>
                    <table class="table table-bordered table-hover Recaudacion">
                        <thead>
                        <tr>
                            <th> PATERNO </th>
                            <th> MATERNO </th>
                            <th> NOMBRES </th>
                            <th> DNI </th>
                            <th> MODALIDAD </th>
                            <th> CELULAR </th>
                            <th> COLEGIO </th>
                            <th> GESTION </th>
                            <th> ESTADO </th>
                            <th> DOCUMENTOS SUBIDOS</th>
                            <th> SEMIBECA </th>
                            <th> OBSERVACIONES</th>
                            <th> Opciones </th>
                            <th> Activación</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div><!--span-->
    </div><!--row-->
    <div class="modal fade" id="verfoto" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Foto</h4>
                </div>
                <div class="modal-body">
                    <img class="img-responsive" id="fotito" style="height: 400px" alt="" >
                </div>
                <div class="modal-footer">
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>




@stop

@section('js-scripts')
    <script>
        $('.Recaudacion').dataTable({
            "language": {
                "emptyTable": "No hay datos disponibles",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ filas",
                "search": "Buscar Postulante :",
                "lengthMenu": "_MENU_ registros"
            },
            dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
            buttons: [
                { extend: 'excel', className: 'btn yellow btn-outline ' }

            ],
            "bProcessing": true,
            "sAjaxSource": '{{ url('admin/semibeca-lista') }}',
            "pagingType": "bootstrap_full_number",
            "columnDefs": [
                {  // set default column settings
                    'orderable': true,
                    'targets': '_all'
                },
                /*{
                    'targets':7,
                    'render': function ( data, type, full, meta ) {

                        var d="";
                        for (var key in data) {
                            var obx = data[key];

                            if(obx.activo){
                                var obj=obx;
                                d= d+ '<a href="#verfoto" data-foto="{{ asset('/storage/') }}/'+obj.documento+'" data-toggle="modal"><img src="{{ asset('/storage/') }}/'+obj.documento+'"  width="25px" ></a>';

                            }


                        }



                        return d;
                    }
                },*/
                {
                    'targets':9,
                    'render': function ( data, type, full, meta ) {

                        var exav ='-Autovalúo (PU-HR) o título de propiedad. Si vive en casa alquilada, recibo de pago o el contrato de alquiler. En caso de vivir alojado presentar la constancia de alojamiento simple..<br>-Boletas de pago o recibos por honorarios del padre y de la madre, correspondiente a los dos últimos meses (Noviembre - Diciembre 2017).<br>-Certificado de estudios (1ero a 5to de secundaria).<br>-Documento Nacional de identidad (DNI).<br>-Formato de registro de datos que tiene que escanearlo enviar por internet según la guía de procedimientos.<br>-Partida de nacimiento del postulante.<br>-Recibo de agua, energía eléctrica y teléfono de la vivienda que ocupa el postulante en la ciudad de Lima, correspondiente a los dos últimos meses (Mayo-Junio 2017).';

                        console.log(data);

                        if(data == exav) {
                            return 'COMPLETO';
                        }else {
                            return data;
                        }



                    }




                },

                {
                    'targets':12,
                    'render': function ( data, type, full, meta ) {
                        return '<a href="/admin/semibeca/evaluar/'+data+'" title="EVALUAR"class="btn btn-icon-only green-haze" ><i class="fa fa-edit"></i></a>';
                    }
                },

                {
                    'targets':13,
                    'render': function ( data, type, full, meta ) {
                        return '<a href="/admin/semibeca/activar/'+data+'" class="btn  green-meadow"> <i class="fa fa-plus"></i> Activar </a><a href="/admin/semibeca/desactivar/'+data+'"  class="btn red"> <i class="fa fa-plus"></i> Desactivar </a>';

                    }

                }
            ],
            "columns": [
                { "data": "paterno","defaultContent": "" },
                { "data": "materno","defaultContent": "" },
                { "data": "nombres","defaultContent": "" },
                { "data": "dni","defaultContent": "" },
                { "data": "modalidad","defaultContent": "" },
                { "data": "celular","defaultContent": "" },
                { "data": "institucion","defaultContent": "" },
                { "data": "gestion","defaultContent": "" },
                { "data": "estado","defaultContent": "" },
                { "data": "tipos","defaultContent": "" },
                { "data": "otorga","defaultContent": "" },
                { "data": "observaciones","defaultContent": "" },
                { "data": "id","defaultContent": "" },
                { "data": "id","defaultContent": "" },
            ],
            "order": [0,"asc"],

        });

        $('#verfoto').on('show.bs.modal', function (e) {
            var foto = $(e.relatedTarget).data('foto');
            $(e.currentTarget).find('#fotito').attr("src",foto);
        });

        $('#SemibecaCreate').on('show.bs.modal', function (e) {
            var foto = $(e.relatedTarget).data('foto');
            $(e.currentTarget).find('#fotito').attr("src",foto);
        });

        function mostrarDescuento(sede , gestion , idpostulante){

        }
    </script>
@stop

@section('plugins-styles')
    {!! Html::style('assets/global/plugins/datatables/datatables.min.css') !!}
    {!! Html::style('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!}
    {!! Html::style('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') !!}

@stop

@section('plugins-js')
    {!! Html::script('assets/global/plugins/jquery-ui/jquery-ui.min.js') !!}
    {!! Html::script('assets/global/scripts/datatable.js') !!}
    {!! Html::script('assets/global/plugins/datatables/datatables.min.js') !!}
    {!! Html::script('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}
    {!! Html::script('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') !!}

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



