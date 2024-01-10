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
                    {!! Alert::render() !!}
                    <p></p>
                    <div class="table-response">
                        <br>
                        <table class="table table-striped table-bordered table-hover Postulantes compact">
                            <thead>
                            <tr>
                                <th> FECHA</th>
                                <th> DNI </th>
                                <th> Paterno </th>
                                <th> Materno </th>
                                <th> Nombres </th>
                                <th>F.Nacimiento</th>

                                <th>DNI</th>
                                <th>ESTADO</th>

                                <th> ACCIONES </th>
                                <th>Teléfonos</th>
                                <th>VACUNAS</th>
                                <th>OBSERVACIÓN</th>
                                <th>PAGO</th>
                                <th>EMAIL</th>
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


                                        <div id="resultado">

                                        </div>





                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="m_modal_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ESTADO DE SUBIDA DE DNI</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">



                                        {!! Form::open(['url' => 'admin/verificador-save', 'method' => 'post', 'files'=>true]) !!}


                                            <div class="form-group">
                                                {!! Form::label('DNI') !!}
                                                <input type="text" class="form-control" readonly="readonly" name="dni" id="dni" value="" required="required">

                                            </div>


                                        <div class="form-group">

                                            {!! Form::label('EVALUACIÓN') !!}
                                            <select class="form-control" name="otorga" id="otorga" required="required">
                                                <option value="" >SELECCIONE UNA OPCIÓN</option>
                                                <option value="CORRECTO" >CORRECTO</option>
                                                <option value="INCORRECTO">INCORRECTO</option>
                                                <option value="FALTA VACUNA">FALTA VACUNA</option>

                                            </select>

                                        </div>


                                        <div class="form-group">
                                            <a class="btn btn-warning" href="https://carnetvacunacion.minsa.gob.pe" target="_blank"> VER CARNET MINSA</a>

                                        </div>
                                        <div class="form-group">
                                            {!!Form::label('lblEdicion', 'CANTIDAD DE DOSIS',['class'=>'control-label']);!!}


                                            <div class="input-group col-md-10">
                                                <div class="icheck-inline">
                                                    <label>
                                                        {!! Form::radio('vacuna', 0) !!}
                                                        0
                                                    </label>
                                                    <label>
                                                        {!! Form::radio('vacuna', 1) !!}
                                                        1
                                                    </label>
                                                    <label>
                                                        {!! Form::radio('vacuna', 2) !!}
                                                        2
                                                    </label>
                                                    <label>
                                                        {!! Form::radio('vacuna', 3) !!}
                                                        Otro
                                                    </label>


                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">

                                            {!! Form::label('SUBIR CARNET') !!}

                                            <img id="fotocarnet"  width="60%">

                                                {!!Form::file('file',['class'=>'form-control'])!!}

                                        </div>


                                        <div class="form-group">
                                            {!! Form::label('OBSERVACION') !!}
                                            <textarea class="form-control" name="observacion" id="observacion" value=""></textarea>

                                        </div>
                                        <hr>
                                        <h3>DNI CARGADO</h3>
                                        <div id="resultado3">

                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success" >GUARDAR</button>
                                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">CANCELAR</button>

                                    </div>

                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="m_modal_6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR DATOS</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">

                                            <div class="col-6">
                                                {!! Form::open(['url' => 'admin/verificador-datos-save', 'method' => 'post']) !!}


                                                <div class="form-group">
                                                    {!! Form::label('DNI') !!}
                                                    <input type="text" class="form-control" readonly="readonly" name="dnidatos" id="dnidatos" value="" required="required">

                                                </div>
                                                <div class="form-group">

                                                    {!! Form::label('EVALUACIÓN') !!}
                                                    <select class="form-control" name="otorga" id="otorga2" required="required">
                                                        <option value="" >SELECCIONE UNA OPCIÓN</option>
                                                        <option value="CORRECTO" >CORRECTO</option>
                                                        <option value="INCORRECTO">INCORRECTO</option>
                                                        <option value="FALTA VACUNA">FALTA VACUNA</option>

                                                    </select>

                                                </div>


                                                <div class="form-group">
                                                    {!! Form::label('PATERNO') !!}
                                                    <input type="text" class="form-control" name="paterno" id="paterno" value="" required="required">

                                                </div>

                                                <div class="form-group">
                                                    {!! Form::label('MATERNO') !!}
                                                    <input type="text" class="form-control" name="materno" id="materno" value="" required="required">

                                                </div>

                                                <div class="form-group">
                                                    {!! Form::label('NOMBRES') !!}
                                                    <input type="text" class="form-control" name="nombres" id="nombres" value="" required="required">

                                                </div>

                                                <div class="form-group">
                                                    {!! Form::label('FECHA NACIMIENTO FORMATO AÑO-MES-DIA') !!}
                                                    <input type="text" class="form-control"  name="fecha_nacimiento" id="fecha_nacimiento" value="" required="required">


                                                </div>
                                                <div class="form-group">
                                                    {!! Form::label('OBSERVACION') !!}
                                                    <textarea class="form-control" name="observacion" id="observacion2" value=""></textarea>

                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <h3>DNI CARGADO</h3>

                                                <div id="resultado2">

                                                </div>
                                            </div>

                                        </div>









                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success" >GUARDAR</button>
                                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">CANCELAR</button>

                                    </div>

                                    {!! Form::close() !!}
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

            processing: true,

            ajax: {
                url: '{{url('admin/padron-tablaverificador')}}',
                method: 'POST',
                'headers': {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },

            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todo"]],
            pageLength: 25,
            order: [[ 0, "desc" ]],
            columns: [
                { data: 'fecha_conformidad'},

                { data : 'numero_identificacion'},
                { data : 'paterno' },
                { data : 'materno' },
                { data : 'nombres'},
                { data : 'fecha_nacimiento'},

                {data: 'numero_identificacion'},
                { data : 'evaluar' },
                { data : 'numero_identificacion'},

                { data : 'telefono' },

                { data : 'vacuna' },
                { data : 'observacion' },
                { data : 'pago' },

                { data : 'email' },



            ],columnDefs: [
                {  // set default column settings
                    'orderable': true,
                    'targets': '_all'
                },{
                    'targets':6,
                    'render': function ( data, type, row, meta ) {

                        var e ="'";
                        var p = "'";

                        var f= e.concat(data);
                        var din=f.concat(p);

                        return '<a data-toggle="modal" data-target="#m_modal_4" onclick="modalFoto('+din+')" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="DNI"> <i class="flaticon-profile-1"></i> </a>';
                    }
                },{
                    'targets':8,
                    'render': function ( data, type, row, meta ) {

                        var e ="'";
                        var p = "'";

                        var f= e.concat(data);
                        var din=f.concat(p);


                        return '<button data-toggle="modal" data-target="#m_modal_5" onclick="modalEstado('+din+')" type="button" class="btn btn-primary"><i class="fa fa-credit-card"></i>ESTADO</button><button data-toggle="modal" data-target="#m_modal_6" onclick="modalDatos('+din+')" type="button" class="btn btn-success"><i class="fa fa-credit-card"></i>DATOS</button>';

                    }
                },{
                    'targets':7,
                    'render': function ( data, type, row ) {

                        if (data=='PENDIENTE') {
                            return '<span class="m-badge m-badge--warning">PENDIENTE</span>';
                        }
                        if (data=='CORRECTO') {
                            return '<span class="m-badge m-badge--success">CORRECTO</span>';
                        }
                        if (data=='INCORRECTO') {
                            return '<span class="m-badge m-badge--danger">INCORRECTO</span>';
                        }

                        if (data=='FALTA VACUNA') {
                            return '<span class="m-badge m-badge--info">FALTA VACUNA</span>';
                        }

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

        function obtenerfotos(e){
            $('#resultado').empty();
            $('#resultado2').empty();
            $('#resultado3').empty();
            $.ajax({
                type: "GET",
                url: '/admin/verificador-archivos',
                data: { dni : e},
                success: function(data)
                {
                    if(typeof data === 'object'){
                        var i;
                        for (i = 0; i < data.length; i++) {
                            var f = '/storage/'+data[i].archivo;
                            var len = data[i].archivo.length;
                            var res = data[i].archivo.substring(len-5);
                            if(res.includes(".pdf") || res.includes(".PDF") ){
                                $( "#resultado" ).append( "<iframe src='" + f + "' class='embed-responsive-item'  width='100%' height='600px'></iframe>");
                                $( "#resultado2" ).append( "<iframe src='" + f + "' class='embed-responsive-item' width='100%' height='600px'></iframe>");
                                $( "#resultado3" ).append( "<iframe src='" + f + "' class='embed-responsive-item' width='100%' height='600px'></iframe>");
                            }else {
                                $( "#resultado" ).append( " <img src='" + f + "' class='img-fluid'>");
                                $( "#resultado2" ).append( " <img src='" + f + "' class='img-fluid'>");
                                $( "#resultado3" ).append( " <img src='" + f + "' class='img-fluid'>");
                            }
                        }
                    }else {
                        var f = '/storage/'+data;
                        var len = data.length;
                        var res = data.substring(len-5);
                        if(res.includes(".pdf") || res.includes(".PDF") ){
                            $( "#resultado" ).append( "<iframe src='" + f + "' class='embed-responsive-item'  width='100%' height='600px'></iframe>");
                            $( "#resultado2" ).append( "<iframe src='" + f + "' class='embed-responsive-item'  width='100%' height='600px'></iframe>");
                            $( "#resultado3" ).append( "<iframe src='" + f + "'  class='embed-responsive-item' width='100%' height='600px'></iframe>");
                        }else {
                            $( "#resultado" ).append( " <img src='" + f + "' class='img-fluid'>");
                            $( "#resultado2" ).append( " <img src='" + f + "' class='img-fluid'>");
                            $( "#resultado3" ).append( " <img src='" + f + "' class='img-fluid'>");
                        }
                    }
                },
                error: function (data) {
                    $('#dnidatos').val("ERROR");
                    alert("ERROR EN CARGAR OBSERVACION");
                }
            });
        }

        function modalFoto(e) {


            obtenerfotos(e);

        }


        function modalEstado(e) {
            obtenerfotos(e);
            $('#dni').val(e);


            $.ajax({
                type: "GET",
                url: '/admin/verificador-observacion',
                data: { dni : e},
                success: function(data)
                {
                    console.log(data);
                    $('#observacion').val(data.obs);
                    $('#observacion').text(data.obs);
                    $("#fotocarnet").attr("src",'/storage/'+data.foto);
                    $('.vacuna').val(data.vacuna);
                    var $radios = $('input:radio[name=vacuna]');
                    if($radios.is(':checked') === false) {
                        $radios.filter('[value='+data.vacuna+']').prop('checked', true);
                    }
                    $('#otorga').val(data.otorga);
                },
                error: function (data) {
                    alert("ERROR EN CARGAR OBSERVACION");
                }
            });


        }
        
        function modalDatos(e) {

            $('#dnidatos').val(e);

            obtenerfotos(e);
            $('#paterno').val();
            $('#materno').val();
            $('#nombres').val();
            $('#fecha_nacimiento').val();


            $.ajax({
                type: "GET",
                url: '/admin/verificador-datos',
                data: { dni : e},
                success: function(data)
                {


                    $('#dnidatos').val(data.numero_identificacion);

                    $('#paterno').val(data.paterno);
                    $('#materno').val(data.materno);
                    $('#nombres').val(data.nombres);




                    var dateString = data.fecha_nacimiento;
                    var dateParts = dateString.split("-");

                    var fechh = dateParts[2]+"/"+dateParts[1]+"/"+dateParts[0];
                    $('#fecha_nacimiento').val(fechh);

                },
                error: function (data) {
                    $('#dnidatos').val("ERROR");
                    alert("ERROR EN CARGAR OBSERVACION");
                }
            });


            $.ajax({
                type: "GET",
                url: '/admin/verificador-observacion',
                data: { dni : e},
                success: function(data)
                {

                    $('#observacion2').val(data.obs);
                    $('#observacion2').text(data.obs);


                    $('#otorga2').val(data.otorga);
                },
                error: function (data) {
                    alert("ERROR EN CARGAR OBSERVACION");
                }
            });
            
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



