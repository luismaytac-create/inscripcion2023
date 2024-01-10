@extends('layouts.base')

@section('content')



    <div class="m-content">



        <!--begin::Portlet-->
        <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">

            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="flaticon-statistics"></i>
												</span>
                        <h2 class="lead">
                                 Ingresa  <u><strong>los datos del postulante</strong></u> (NO EL DE TU APODERADO).
                        </h2>
                        <div class="actions">
                            {!!Form::back(route('datos.index'))!!}
                        </div>
                        <h2 class="m-portlet__head-label m-portlet__head-label--danger">
                            <span>DATOS PERSONALES</span>
                        </h2>
                    </div>
                </div>

            </div>

            <div class="m-portlet__body lead">
                {!! Alert::render() !!}
                @include('alerts.errors')
                {!! Form::model($postulante,['route'=>['datos.postulante.update',$postulante],'method'=>'PUT']) !!}

                <dl>
                    <dt>Observación</dt>
                    <dd>Los nombres y apellidos deben coincidir de tu DNI, <strong>todos los campos con (*) son obligatorios.</strong></dd>
                </dl>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!!Form::hidden('idtipoidentificacion', IdTCCodigo('IDENTIFICACION','DNI') );!!}
                            {!!Form::hidden('numero_identificacion', Auth::user()->dni );!!}
                            {!!Field::text('paterno', null , ['label'=>'Apellido Paterno del postulante (*)','placeholder'=>'Apellido Paterno del postulante','maxlength'=>'50']);!!}
                        </div>
                    </div><!--span-->
                    <div class="col-md-4">
                        <div class="form-group">
                            {!!Field::text('materno', null , ['label'=>'Apellido Materno del postulante (*)','placeholder'=>'Apellido Materno del postulante','maxlength'=>'50']);!!}
                        </div>
                    </div><!--span-->
                    <div class="col-md-4">
                        <div class="form-group">
                            {!!Field::text('nombres', null , ['label'=>'Nombres del postulante (*)','placeholder'=>'Nombres del postulante','maxlength'=>'60']);!!}
                        </div>
                    </div><!--span-->
                </div><!--row-->
                <h3>Modalidad de Postulación según el reglamento</h3>
                <div class="row">
                    <div class="col-md-6">
                        {!!Field::select('idmodalidad',$modalidad,['label'=>'Escoger Modalidad (*)','empty'=>'Escoger modalidad de postulación']);!!}
                    </div><!--span-->
                    <div class="col-md-6">
                        {!!Field::select('idespecialidad',$especialidad,['label'=>'Escoger Especialidad (*)','empty'=>'Escoger especialidad de postulación']);!!}
                    </div><!--span-->
                </div><!--row-->
                <div class="widget-thumb bordered bg-green cepreuni">
                    <div class="row">
                        <div class="col-md-6 ">
                            {!!Field::text('codigo_verificacion',null,['label'=>'Ingresa tu código de CEPRE-UNI de 6 dígitos.Ejemplo: 10021J(*).','placeholder'=>'Ingresar código de CEPRE-UNI','maxlength'=>'12']);!!}
                        </div><!--span-->
                    </div><!--row-->
                    <div class="row">
                        <div class="col-md-6">
                            {!!Field::select('idmodalidad2',$segunda_modalidad_cepre,['label'=>'Escoger segunda Modalidad (Solo para alumnos de CEPRE-UNI)(*)','empty'=>'Escoger segunda modalidad de postulación (Solo para alumnos de CEPRE-UNI)']);!!}
                        </div><!--span-->
                        <div class="col-md-6">
                            {!!Field::select('idespecialidad2',$especialidad,['label'=>'Escoger segunda Especialidad (Solo para alumnos de CEPRE-UNI)(*)','empty'=>'Escoger segunda especialidad de postulación (Solo para alumnos de CEPRE-UNI)']);!!}
                        </div><!--span-->
                    </div><!--row-->
                </div>


                <h3>Institución Educativa donde culminó la secundaria</h3>
                <dl>
                    <dt>Observación</dt>
                    <dd>Es tu responsabilidad seleccionar correctamente la Institución Educativa de donde procede. <strong>El cambio de gestión de las instituciones Educativas (pública o privada) implica realizar el pago correspondiente.</strong></dd>
                </dl>


                <div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">
                    <div class="m-demo__preview">
                        <blockquote class="blockquote">
                            <p class="mb-0"><strong></strong> Los pagos realizados a favor de la Universidad por los conceptos establecidos en el Concurso de Admisión, se realizan en las entidades financieras que la Universidad autorice. Los pagos efectuados no serán reembolsados.</p>
                            <footer class="blockquote-footer"><cite title="Source Title">Reglamento del  Concurso de Admisión</cite></footer>
                        </blockquote>

                    </div>
                </div>

                <div class="row">



                    <div class="col-md-12 Colegio">
                        <div id="depacoldiv" class="col-md-12">

                            {!!Field::select('iddepacolegio',$depas,ColegioDepartamento($postulante->idcolegio) ,['label'=>'Escoger Departamento del colegio(*)','empty'=>'Escoger departamento del colegio']);!!}



                        </div>

                        <div id="colediv" class="col-md-12">


                            @if(Request::old('idcolegio') == NULL)


                                {!!Field::select('idcolegio',ColegioPersonal($postulante->idcolegio),['style'=>'width: 100%','label'=>'Escoger el colegio(*)']);!!}
                            @endif

                            @if(Request::old('idcolegio') != NULL)


                                {!!Field::select('idcolegio',ColegioPersonal(Request::old('idcolegio')),['style'=>'width: 100%','label'=>'Escoger el colegio']);!!}
                            @endif









                        </div>


                    </div><!--span-->
                    <div class="col-md-6 Universidad">



                        @if(Request::old('iduniversidad') == NULL)


                            {!!Field::select('iduniversidad',UniversidadPersonal($postulante->iduniversidad),['style'=>'width: 100%','label'=>'Escoger Universidad(*)']);!!}
                        @endif

                        @if(Request::old('iduniversidad') != NULL)


                            {!!Field::select('iduniversidad',UniversidadPersonal(Request::old('iduniversidad')),['style'=>'width: 100%','label'=>'Escoger Universidad']);!!}
                        @endif




                    </div><!--span-->
                </div><!--row-->


                {!!Form::enviar('Guardar')!!}
            </div>


        </div>
    </div>


    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Ten en cuenta:</h4>
                </div>
                <div class="modal-body">
                    <h3 ><strong id="parraf"> </strong></h3>
                    <h3 class="text-info"><strong>Traer toda la información necesaria hasta el cierre de inscripciones
                            para su evaluación respectiva convocada por la facultad.</strong></h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">NO CONTINUAR</button>

                    {!!Form::enviar('Guardar y Continuar')!!}
                </div>
            </div>

        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('js-scripts')
    <script>


        $("#iddepacolegio").click(function(event) {
            var dp=$('#iddepacolegio').val();
            if(dp>0){

                $('#colediv').show();

            }else {
                $('#colediv').hide();
            }


        });






        $(function() {


            var idmodal = $("#idmodalidad").val();

            if(idmodal>0){
                $.ajax({
                    url: 'info-modalidad',
                    dataType: 'json',
                    data: {idmodalidad: idmodal},
                })
                    .done(function(modalidad) {
                        /*Muestra Colegio o universidad segun la modalidad correspondiente*/
                        if (modalidad.colegio) {
                            $(".Colegio").show();
                            $('#colediv').hide();
                            $('#depacoldiv').show();
                            var dp=$('#iddepacolegio').val();
                            if(dp>0){

                                $('#colediv').show();

                            }else {
                                $('#colediv').hide();
                            }
                            $(".Universidad").hide();
                        }else{
                            $(".Colegio").hide();

                            $('#colediv').hide();
                            $('#depacoldiv').hide();
                            $(".Universidad").show();
                        }
                        /*Muestra la segunda opcion del cepre UNI*/
                        if (modalidad.codigo == 'ID-CEPRE') {
                            $(".cepreuni").show();
                        }else{
                            $(".cepreuni").hide();
                        }


                    });




            }else {
                $(".Colegio").hide();
                $(".Universidad").hide();
                $(".cepreuni").hide();
                $('#colediv').hide();
                $('#depacoldiv').hide();
            }







            $("#idmodalidad").change(function(event) {
                var idmodalidad = $(this).val();
                if(idmodalidad!=""){



                    $.ajax({
                        url: 'info-modalidad',
                        dataType: 'json',
                        data: {idmodalidad: idmodalidad},
                    })
                        .done(function(modalidad) {



                            /*Muestra Colegio o universidad segun la modalidad correspondiente*/
                            if (modalidad.colegio) {
                                $(".Colegio").show();
                                $('#colediv').hide();
                                $('#depacoldiv').show();
                                var dp=$('#iddepacolegio').val();
                                if(dp>0){

                                    $('#colediv').show();

                                }else {
                                    $('#colediv').hide();
                                }
                                $(".Universidad").hide();
                            }else{
                                $(".Colegio").hide();

                                $('#colediv').hide();
                                $('#depacoldiv').hide();
                                $(".Universidad").show();
                            }
                            /*Muestra la segunda opcion del cepre UNI*/
                            if (modalidad.codigo == 'ID-CEPRE') {
                                $(".cepreuni").show();
                            }else{

                                $("#idmodalidad2").val(null);

                                $("#codigo_verificacion").val(null);
                                $("#idespecialidad2").val(null);



                                $(".cepreuni").hide();
                            }


                        });//SAl

                }else {
                    $(".Colegio").hide();
                    $('#colediv').hide();
                    $('#depacoldiv').hide();
                    $(".Universidad").hide();
                }

            });
            $("#idmodalidad2").click(function(event) {
                var idmodalidad = $(this).val();
                $.ajax({
                    url: 'info-modalidad',
                    dataType: 'json',
                    data: {idmodalidad: idmodalidad},
                })
                    .done(function(modalidad) {
                        /*Muestra Colegio o universidad segun la modalidad correspondiente*/
                        if (modalidad.colegio) {
                            $(".Colegio").show();
                            $('#colediv').hide();
                            $('#depacoldiv').show();
                            $(".Universidad").hide();


                            var dp=$('#iddepacolegio').val();
                            if(dp>0){

                                $('#colediv').show();

                            }else {
                                $('#colediv').hide();
                            }
                        }else{
                            $(".Colegio").hide();
                            $('#colediv').hide();
                            $('#depacoldiv').hide();
                            $(".Universidad").show();
                        }

                    });

            });

            $("#idcolegio").select2({

                ajax: {
                    url: '{{ url("colegio") }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        dep=$(iddepacolegio).val();
                        return {
                            varschool: params.term+"&depaBus="+dep // search term
                        };
                    },
                    processResults: function(data) {
                        // parse the results into the format expected by Select2.
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                placeholder : 'Seleccione su colegio',
                minimumInputLength: 3,
                templateResult: formatSchool,
                templateSelection: formatSchoolSelection,
                escapeMarkup: function(markup) {
                    return markup;
                } // let our custom formatter work
            });

            $("#iduniversidad").select2({

                ajax: {
                    url: '{{ url("universidad") }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        var idmodalidad = $('#idmodalidad').val();
                        return {
                            varuni: params.term, // search term
                            varidmodalidad: idmodalidad,
                        };
                    },
                    processResults: function(data) {
                        // parse the results into the format expected by Select2.
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                placeholder : 'Seleccione su universidad',
                minimumInputLength: 3,
                templateResult: formatUni,
                templateSelection: formatSchoolSelection,
                escapeMarkup: function(markup) {
                    return markup;
                } // let our custom formatter work
            });
            function formatSchool(school){
                if (school.loading) return school.text; //Sin esta columna no carga los items dentro de los campo array

                var localidad = school.distrito;
                if (localidad != null) {
                    var lbl_ubigeo = 'Distrito';
                    var descripcion_ubigeo = localidad.descripcion;
                }else{
                    var lbl_ubigeo = 'Pais';
                    var descripcion_ubigeo = school.paises.nombre;
                }

                var markup="<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__title'>" + school.text + "</div>" +
                    "<div class='select2-result-repository__description'> " + lbl_ubigeo + " : " + descripcion_ubigeo + "</div>" +
                    "<div class='select2-result-repository__description'> Gestion : " + school.gestion + "</div>" +
                    "<div class='select2-result-repository__description'> Direccion : " + school.direccion + "</div>" +
                    "<div class='select2-result-repository__description'> Código Modular : " + school.codigo_modular + "</div>" +
                    "<div class='select2-result-repository__statistics'>" +
                    "</div>"+
                    "</div>";
                return markup;

            }
            function formatUni(school){
                if (school.loading) return school.text; //Sin esta columna no carga los items dentro de los campo array

                var localidad = school.distrito;
                if (localidad != null) {
                    var lbl_ubigeo = 'Distrito';
                    var descripcion_ubigeo = localidad.descripcion;
                }else{
                    var lbl_ubigeo = 'Pais';
                    var descripcion_ubigeo = school.paises.nombre;
                }
                var markup="<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__title'>" + school.text + "</div>" +
                    "<div class='select2-result-repository__description'> " + lbl_ubigeo + " : " + descripcion_ubigeo + "</div>" +
                    "<div class='select2-result-repository__description'> Gestion : " + school.gestion + "</div>" +
                    "<div class='select2-result-repository__statistics'>" +
                    "</div>"+
                    "</div>";
                return markup;

            }
            function formatSchoolSelection(school){
                var markup =  school.text;
                return markup;
            }

        });

        $("#fecha_nacimiento").inputmask("d-m-y", {
            "placeholder": "dd-mm-yyyy"
        });

        var modaaa;


        $("#idmodalidad").on('change', function() {

            var idmodalidad = $(this).val();
            if(idmodalidad>0){


                $.ajax({
                    url: 'modalidad-especialidad',
                    dataType: 'json',
                    data: {idmodalidad: idmodalidad},
                })
                    .done(function(modalidad) {


                    });
            }




            if($("#idmodalidad").val()==6){
                $("#btnchang").prop('type','button');
                var idmodalidad = $(this).val();
                $.ajax({
                    url: 'info-vacantesuni',
                    dataType: 'json',
                    data: {idmodalidad: idmodalidad}
                })
                    .done(function(modalidad) {
                        /*Muestra Colegio o universidad segun la modalidad correspondiente*/
                        modaaa=modalidad;




                    });






            }
        });
        $("#idespecialidad").on('change', function() {

            if($("#idmodalidad").val()==6){

                $("#btnchang").prop('type','button');
                var idmodalidad = $("#idmodalidad").val();
                $.ajax({
                    url: 'info-vacantesuni',
                    dataType: 'json',
                    data: {idmodalidad: idmodalidad}
                })
                    .done(function(modalidad) {
                        /*Muestra Colegio o universidad segun la modalidad correspondiente*/
                        modaaa=modalidad;




                    });






            }
        });
        $("#btnchang").click(function() {
            var modd=$("#idmodalidad").val();
            var espp=$("#idespecialidad").val();

            if(modd==6){
                if(espp>0){

                    var vacanup;
                    for (var key in modaaa) {
                        if (modaaa.hasOwnProperty(key)) {
                            if(modaaa[key].idespecialidad==espp){
                                vacanup=modaaa[key].vacantes;

                            }

                        }
                    }

                    var menjj=0;
                    $.ajax({
                        url: 'info-numerouni',
                        dataType: 'json',
                        data: {idespecialidad: espp}
                    })
                        .done(function(especialidad) {
                            /*Muestra Colegio o universidad segun la modalidad correspondiente*/

                            menjj=JSON.stringify(especialidad);
                            /*menjj=menjj+1;*/
                            $("#parraf").text("Existen "+menjj+" inscritos postulando a esta especialidad con "+vacanup+" vacante(s) disponible(s). La facultad evaluará el ingreso.");

                            $('#myModal').modal('toggle');

                        });




                }else{

                    alert("Escoja una Especialidad");

                }
            }
        });


        $("#idmodalidad").on('change', function() {

            if($("#idmodalidad").val()==16){
                //    $("#idespecialidad option[value='1']").remove();
            }
            else {

                if($("#idespecialidad option[value='1']").length > 0) {

                }else {
                    //     $("#idespecialidad").append('<option value="1">ARQUITECTURA</option>');
                }





            }

        });
    </script>
@stop

