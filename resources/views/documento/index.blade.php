@extends('layouts.base')

@section('content')
    @include('alerts.errors')
    <link href="{{ asset('assets/global/plugins/cubeportfolio/css/cubeportfolio.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/pages/css/portfolio.min.css') }}" rel="stylesheet" type="text/css" />

    <div class="m-content">


        <!--begin::Portlet-->
        <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">

            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="flaticon-statistics"></i>
                        </span>
                        <h1 class="lead">
                            Documentos <strong></strong>
                        </h1>
                        <div class="actions">
                            {!!Form::back(route('home.index'))!!}
                        </div>
                        <h2 class="m-portlet__head-label m-portlet__head-label--danger">
                            <span>DOCUMENTOS</span>
                        </h2>
                    </div>
                </div>

            </div>
            <div class="m-portlet__body lead">
           <!--row-->
           <div class="row">
               <div class="col-12">



                   @if($bloque)
                    <h1 class="text-danger">Estado de Aprobación</h1>
                   <h1>Estado: <span class="text-warning">{{ $estado }}</span></h1>
                   <h4>Observación: <span>{{ $observacion }}</span></h4>
                   <hr>
                   <h1>Sube tus documentos</h1>
                @endif
                    @if($postulante->idmodalidad == 2   || $postulante->idmodalidad2 == 2 )
                   <li>Acta que acredite haber obtenido uno de los cinco primeros puestos en sus estudios secundarios, emitida desde la plataforma de MINEDU y firmada por el director del plantel.
                   </li>
                   <li>Certificado de Estudios verificable, con cuadro de orden de mérito o Constancia de Logros de Aprendizaje, que acredite haber concluido la educación secundaria y acredite haber ocupado uno de los cinco primeros puestos de su promoción</li>
                    @endif

                   @if($postulante->idmodalidad ==3 || $postulante->idmodalidad2 == 3 )

                       <li>Carta u Oficio de presentación de deportistas calificados de alto nivel para su incorporación a universidades, expedido por el IPD con antigüedad no mayor de un año, presentando al solicitante, cuya participación deportiva haya ocurrido dentro de los tres últimos años (D.S. Nº 010-2009-ED TUPA/IPD, procedimiento Nº 19).</li>
                       <li>Carta de compromiso con firma legalizada notarialmente, de participar obligatoriamente, representando a la UNI, en las competencias deportivas en las que intervenga.</li>
                   @endif

                   @if($postulante->idmodalidad == 4 || $postulante->idmodalidad2 == 4)
                       <li>Copia autenticada notarialmente del Diploma de Bachillerato</li>
                       <li>Certificado de estudios con una nota promedio en Matemática y Ciencias mayor que 14 en escala vigesimal, o Diploma de Bachillerato con cursos y notas, en idioma español, que contenga al menos dos de las asignaturas: Matemática, Física, Química y Biología, y con un puntaje acumulado mínimo de 28 puntos.</li>

                   @endif

                   @if($postulante->idmodalidad == 5 || $postulante->idmodalidad2 == 5)
                       <li>Título Profesional o Grado de Bachiller registrado en SUNEDU</li>
                       <li>Certificado de Estudios Universitarios</li>
                       <li>sílabos de las asignaturas aprobadas en la universidad de origen visados por su escuela profesional</li>

                   @endif

                   @if($postulante->idmodalidad == 6 || $postulante->idmodalidad2 == 6)
                            <li>Declaración Jurada en la que afirma contar con Título o Grado de Bachiller.</li>
                         <li> Sílabos de las asignaturas aprobadas en la UNI, sellados por la Dirección de la Escuela Profesional correspondiente.</li>
                   @endif

                   @if($postulante->idmodalidad == 7 || $postulante->idmodalidad2 == 7)

                       <li>Certificado de Estudios que acredite haber aprobado por lo menos cuatro periodos lectivos semestrales, dos anuales o setenta y dos (72) créditos</li>
                       <li>sílabos de las asignaturas aprobadas y el Plan Curricular de la especialidad en la que está matriculado, sellados y firmados por el responsable de la universidad de origen</li>
                       <li>Constancia de no haber sido sometido a sanción disciplinaria ni haber sido retirado definitivamente por medidas académicas en cumplimiento de la Ley Universitaria N° 30220, expedida por su universidad de origen dentro de los seis (6) meses anteriores al momento de su postulación (para quienes deseen continuar estudios universitarios)</li>

                   @endif
                   @if($postulante->idmodalidad == 8 || $postulante->idmodalidad2 == 8)

                   <li>Fotocopia del carné de extranjería</li>
                       <li>Certificado de estudios universitarios con las asignaturas cursadas en la institución de origen, acompañado de los sílabos respectivos sellados por la universidad de origen</li>
                       <li>Carta de presentación del funcionario con derecho, emitida por la embajada</li>
                       <li>Solicitud de exoneración del examen presentada por el funcionario con derecho o tutor del postulante</li>
                   @endif
                   @if($postulante->idmodalidad == 9 || $postulante->idmodalidad2 == 9)

                    <li>Carné de extranjería o DNI (en el caso de peruanos que han estudiado en el extranjero)</li>
                       <li>Certificado consular que indique su permanencia regular en el país (no necesario en el caso de peruanos que han estudiado en el extranjero)</li>
                       <li>Certificado de estudios secundarios del 1º al 5º año o su equivalente, refrendado por el respectivo Consulado Peruano, en idioma español, con la Apostilla de La Haya (para quienes deseen iniciar estudios universitarios)</li>
                       <li>Certificado de estudios acompañado de los sílabos de las asignaturas aprobadas, sellados y visados por la universidad de origen (para quienes deseen continuar estudios universitarios)</li>

                   @endif
                   @if($postulante->idmodalidad == 10 || $postulante->idmodalidad2 == 10)

                       <li>Carné de extranjería o DNI (en el caso de peruanos que han estudiado en el extranjero)</li>
                       <li>Certificado consular que indique su permanencia regular en el país (no necesario en el caso de peruanos que han estudiado en el extranjero)</li>
                       <li>Certificado de estudios acompañado de los sílabos de las asignaturas aprobadas, sellados y visados por la universidad de origen (para quienes deseen continuar estudios universitarios)</li>
                        <li>Constancia de no haber sido sometido a sanción disciplinaria, expedida por su universidad de origen dentro de los seis (6) meses anteriores al momento de su postulación (para quienes deseen continuar estudios universitarios).</li>

                   @endif
                   @if($postulante->idmodalidad == 11 || $postulante->idmodalidad2 == 11)
                       <li>DNI</li>
                   <li>Certificado de Acreditación, otorgado por el Consejo de Reparaciones – RUV.</li>

                   @endif
                   @if($postulante->idmodalidad == 12 || $postulante->idmodalidad2 == 12)
                       <li>DNI</li>
                       <li>Certificado de Acreditación, otorgado por el Consejo de Reparaciones – RUV.</li>

                   @endif

                   @if($postulante->idmodalidad == 13 || $postulante->idmodalidad2 == 13)
                       <li> Certificado de Discapacidad que acredite su condición. Este debe ser otorgado por médicos certificadores registrados en las instituciones públicas, privadas o mixtas prestadoras de salud-IPRESS a nivel nacional.</li>

                   @endif

                   @if($postulante->idmodalidad == 14 || $postulante->idmodalidad2 == 14)
                       <li> Certificado de Discapacidad que acredite su condición. Este debe ser otorgado por médicos certificadores registrados en las instituciones públicas, privadas o mixtas prestadoras de salud-IPRESS a nivel nacional.</li>

                   @endif
                       @if($postulante->idmodalidad == 19)
                           <li>Certificado de Estudios que acredite haber aprobado por lo menos un periodo lectivo o diecinueve (19) créditos</li>
                           <li>sílabos de las asignaturas aprobadas y copia del Plan Curricular de la especialidad en que está matriculado, sellados por la universidad de origen o SUNEDU</li>
                           <li>Constancia de no haber sido sometido a sanción disciplinaria ni haber sido retirado definitivamente por medidas académicas en cumplimiento de la Ley Universitaria N° 30220 en su universidad de origen</li>

                       @endif
                       @if($postulante->idmodalidad == 18)
                           <li>Documento Nacional de Identidad</li>
                       @endif

                       @if($postulante->idmodalidad == 20 || $postulante->idmodalidad2 == 20)
                       <li>Carta u Oficio de Presentación de Deportistas Calificados de Alto Nivel para su incorporación a universidades, expedido por el IPD con antigüedad no mayor de un año que presente al solicitante, cuya participación deportiva haya ocurrido dentro de los tres últimos años (D.S. N 010-2009-ED TUPA/IPD, procedimiento N° 19)</li>
                       <li>Carta Notarial de Compromiso de representar a la UNI en las competencias deportivas en las se le solicite</li>
                       @endif
               </div>




           </div>

                <!-- end row-->
                <hr>
               <div class="row">


                   <form id="Frm6" style="width: 100%;">
                       {!! csrf_field() !!}
                       <div style="width: 100%;" class="form-group">
                           <div class="file-loading">
                               <input id="carga" name="carga" type="file"  >
                           </div>

                       </div>
                       <div class="form-group">
                           <button type="submit" class="btn btn-success">CARGAR DOCUMENTO</button>
                       </div>

                       <p class="text-black-50">
                           <b>
                           Nota: Tamaño máximo por archivo: 10 Mb, en caso el archivo sobrepasa el tamaño debe particionar con tamaño máximo de 10 Mb.
                           </b>
                       </p>




                   </form>




               </div>

                <hr>
                <div class="row">

                    <div class="col-12">
                        <h4>Información!</h4>
                        <strong>Comprueba tus documentos subidos:</strong>

                        <div id="js-grid-full-width" class="cbp col-md-12">
                            @foreach($doctodos as $rs)

                                @if(substr($rs->documento,strpos($rs->documento,'.')) == '.pdf' || substr($rs->documento,strpos($rs->documento,'.'))=='.PDF')

                                @else
                                <div class="cbp-item web-design col-md-4">


                                    @if(substr($rs->documento,strpos($rs->documento,'.')) == '.pdf' || substr($rs->documento,strpos($rs->documento,'.'))=='.PDF')



                                    @else

                                        <a href="{{ asset('delete-documento/'.$rs->id) }}" class="btn btn-danger"><span class="fa flaticon-delete"> ELIMINAR</span></a>

                                    @endif



                                    <a href="{{ asset('/storage/'.$rs->documento) }}" class="cbp-caption cbp-lightbox" data-title="VER">





                                        <div class="cbp-caption-defaultWrap">

                                            <div class="col-md-12">

                                                @if(substr($rs->documento,strpos($rs->documento,'.')) == '.pdf' || substr($rs->documento,strpos($rs->documento,'.'))=='.PDF')



                                                @else

                                                    <img  class="img-fluid" alt="" src="{{ asset('/storage/'.$rs->documento) }}" />

                                                @endif



                                            </div>
                                        </div>

                                        <div class="cbp-caption-activeWrap">
                                            <div class="cbp-l-caption-alignLeft">
                                                <div class="cbp-l-caption-body">
                                                    <div class="cbp-l-caption-title">VER</div>

                                                </div>
                                            </div>
                                        </div>
                                    </a>







                                </div>
                                @endif

                            @endforeach
                        </div>
                    </div>




                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                        @foreach($doctodos as $rs)


                            @if(substr($rs->documento,strpos($rs->documento,'.')) == '.pdf' || substr($rs->documento,strpos($rs->documento,'.'))=='.PDF')



                                    <div class="row">
                                        <div class="col-12">
                                            <a href="{{ asset('delete-documento/'.$rs->id) }}" class="btn btn-danger"><span class="fa flaticon-delete"> ELIMINAR</span></a>
                                            <a href="#" class="cbp-caption cbp-lightbox">
                                                <iframe src="{{ asset('/storage/'.$rs->documento) }}" width="300px"></iframe>

                                            </a>
                                        </div>

                                    </div>






                            @endif



                        @endforeach
                                </div>
                    </div>


                </div>





            </div>

        </div>
    </div>



@stop

@section('js-scripts')



    {!! Html::script('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') !!}
    {!! Html::script('assets/global/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js') !!}
    {!! Html::script('assets/pages/scripts/portfolio-4.js') !!}
    <script src={{asset("assets/global/plugins/jquery.pulsate.min.js")}} type="text/javascript"></script>

    {!! Html::script('assets/foto/jquery.blockUI.min.js') !!}




    {!! Html::script('assets/files/bootstrap.bundle.min.js') !!}
    {!! Html::script('assets/files/js/plugins/piexif.js') !!}
    {!! Html::script('assets/files/js/plugins/sortable.js') !!}
    {!! Html::script('assets/files/js/fileinput.js') !!}

    {!! Html::script('assets/files/js/locales/fr.js') !!}
    {!! Html::script('assets/files/js/locales/es.js') !!}
    {!! Html::script('assets/files/themes/fas/theme.js') !!}


    {!! Html::script('assets/files/themes/explorer-fas/theme.js') !!}




    <script>



        $(document).ready(function () {


            $("#carga").fileinput({
                theme: 'fas',
                language: "es",
                showUpload: false,
                allowedFileExtensions: ["jpg", "png", "jpeg","pdf",'JPG','PNG','JPEG','PDF'],
                maxFileCount: 30,

            });



        });

    </script>
    <script>
        $("#Frm6").validate({
            rules :
                {
                    carga : { required : true }
                },
            messages: {
                carga: {required:'DEBE CARGAR SU ARCHIVO'}
            },
            submitHandler : function(form)
            {
                $("#Frm6").block({
                    message: '<h1>SUBIENDO</h1>'

                });
                var data = new FormData(Frm6);
                $.ajax({
                    url: "upload-documento",
                    type: "post",
                    dataType: "html",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success : function(echo)
                    {
                        if(echo == 0)
                        {
                            $("#cargado").html('<div class="note note-danger"><h3>Formato incorrecto</h3><p> Debe cargar su documento en formato JPG o PNG. </p></div>').show(1000);
                        }else if(echo == 1)
                        {

                            alert("DOCUMENTO CARGADO");
                            location.reload();

                            //$("#cargado").html('<div class="note note-success"><h3>Documento cargado</h3><p>  </p></div>').show(1000);
                            //$("#cargado").hide(3000);
                        }

                        if( echo==2) {

                            alert("NO PUEDE SUBIR MÁS DOCUMENTOS.")

                        }
                    },
                    error: function (err) {
                        $("#Frm6").unblock();
                        alert("ERROR AL SUBIR SU ARCHIVO INTENTE NUEVAMENTE.")
                    }
                });
            }
        });
    </script>

@stop
@section('plugins-styles')




    {!! Html::style(asset('assets/files/bootstrap.min.css')) !!}
    {!! Html::style(asset('assets/files/css/fileinput.css')) !!}
    {!! Html::style(asset('assets/files/all.css')) !!}
    {!! Html::style(asset('assets/files/themes/explorer-fas/theme.css')) !!}



@stop
@section('plugins-js')
    {!! Html::script(asset('assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')) !!}
    {!! Html::script(asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')) !!}
    {!! Html::script(asset('assets/global/plugins/select2/js/select2.full.min.js')) !!}
    {!! Html::script(asset('assets/global/plugins/select2/js/i18n/es.js')) !!}
    {!! Html::script(asset('assets/global/plugins/icheck/icheck.min.js')) !!}
    {!! Html::script(asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')) !!}
@stop

