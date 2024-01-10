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
                        <h2 class="lead">
                            <strong>Bienvenido al Módulo de Semibeca:    </strong>
                        </h2>
                        <div class="actions">
                            {!!Form::back(route('datos.index'))!!}
                        </div>
                        <h2 class="m-portlet__head-label m-portlet__head-label--danger">
                            <span>SEMIBECA</span>
                        </h2>
                    </div>
                </div>

            </div>

            <div class="m-portlet__body lead">

                <div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">
                    <div class="m-demo__preview">
                        <blockquote class="blockquote">

                            <p class="mb-1"><strong> Sí perteneces a SISFOH, solo adjunta tu documento de certificado SISFOH en el paso 7.</strong></p>

                        </blockquote>

                    </div>
                </div>

                <p><strong> Para que puedas participar en el proceso de SEMIBECA deberás seguir los siguientes pasos: </strong></p>
                <p> Paso 1 : Debes realizar la solicitud de SEMIBECA. </p>
                <p> Paso 2 : Descarga los documentos pedidos en la lista de abajo.</p>
                <p> Paso 3 : Completa los datos de todos los documentos con letra legible. </p>
                <p> Paso 4 : Escanea el documento en formato imagen JPG o PNG </p>
                <p> Paso 5: Selecciona el archivo presionando botón "Examinar"</p>
                <p> Paso 6: Presiona el botón "Cargar Documento" para subir tu documento en formato jpg, jpeg o png.</p>
                <p> Paso 7: Carga los demas documentos pedidos en la lista de abajo.</p>


                <p><strong> Para que puedas participar en el proceso de SEMIBECA deberás presentar los siguientes documentos:</strong> </p>
                <p> Documento 1: Partida de nacimiento del postulante. </p>
                <p> Documento 2: Documento Nacional de identidad (DNI). </p>

                <p> Documento 3: Certificado de Estudios  o Constancia de Logros de Aprendizaje. </p>

                <p> Documento 4: Boletas de pago o recibos por honorarios de tu padre y de tu madre, correspondiente a los dos últimos meses (Octubre - Noviembre 2023). </p>

                <p>Documento 5: Autovalúo (PU-HR) o título de propiedad. Si vives en casa alquilada, recibo de pago o el contrato de alquiler. En caso de vivir alojado presentar la constancia de alojamiento simple.</p>
                <p>Documento 6: Recibo de agua, energía eléctrica y teléfono de la vivienda que ocupas en la ciudad de Lima, correspondiente a los dos últimos meses (Octubre - Noviembre 2023).</p>
                <p>Documento 7: Descarga, completa y escanea los siguiente documentos .</p>


                <div class="row">

                    <div class="col-md-4">
                        <div class="m-alert m-alert--icon alert alert-primary" role="alert">
                            <div class="m-alert__icon">
                                <i class="la la-download"></i>
                            </div>
                            <div class="m-alert__text">
                                <strong>DECLARACIÓN JURADA SIMPLE DE INGRESO</strong>
                            </div>
                            <div class="m-alert__actions" style="width: 160px;">
                                <a href="{!! asset('DECLARACION_JURADA_SIMPLE_DE_INGRESOS.pdf') !!}" target="_lblank" class="btn btn-warning btn-sm m-btn m-btn--pill m-btn--wide"> DESCARGAR</a>
                            </div>
                        </div>


                    </div>




                    <div class="col-md-4">
                        <div class="m-alert m-alert--icon alert alert-primary" role="alert">
                            <div class="m-alert__icon">
                                <i class="la la-download"></i>
                            </div>
                            <div class="m-alert__text">
                                <strong>FICHA SOCIO ECONÓMICA</strong>
                            </div>
                            <div class="m-alert__actions" style="width: 160px;">
                                <a href="{!! asset('FICHA_SOCIO_ECONOMICA_SEMIBECA.pdf') !!}" target="_lblank" class="btn btn-warning btn-sm m-btn m-btn--pill m-btn--wide"> DESCARGAR</a>
                            </div>
                        </div>


                    </div>

                    <div class="col-md-4">
                        <div class="m-alert m-alert--icon alert alert-primary" role="alert">
                            <div class="m-alert__icon">
                                <i class="la la-download"></i>
                            </div>
                            <div class="m-alert__text">
                                <strong>FICHA SOCIO ECONÓMICA EGRESOS</strong>
                            </div>
                            <div class="m-alert__actions" style="width: 160px;">
                                <a href="{!! asset('INGRESOS_Y_EGRESOS_ECONOMICOS_SEMIBECA.pdf') !!}" target="_lblank" class="btn btn-warning btn-sm m-btn m-btn--pill m-btn--wide"> DESCARGAR</a>
                            </div>
                        </div>


                    </div>



                </div>

                @if($monst==2)
                    <hr/>
                    <div class="row">

                        <div class="col-md-12 center">
                            <div class="note note-info">
                                <h1 class="col-md-offset-4 center">¿Deseas solicitar semibeca ?</h1>

                                <div class="row">

                                    <div class="form-group col-md-3">
                                        <button id="confimButon"  type="button" class="btn btn-lg  btn-success col-md-offset-4" >SÍ </button>

                                    </div>

                                    <div class="form-group col-md-6">
                                        <a href="{{ route('home.index') }}"><button  type="button" class="btn btn-lg  btn-danger" >NO </button></a>
                                    </div>

                                </div>
                            </div>

                        </div>


                    </div>
                @endif




                @if($monst==1)
                    <div class="row">
                        <div class="col-md-12">





                            <div class="m-portlet m-portlet--bordered m-portlet--bordered-semi m-portlet--rounded">
                                <div class="m-portlet__head">
                                    <div class="m-portlet__head-caption">
                                        <div class="m-portlet__head-title">
                                            <h3 class="m-portlet__head-text">
                                                SUBIDA DE DOCUMENTOS
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet__body">
                                    <div  class="row">
                                        {!! Form::open(['id' => 'Frm1', 'class' => 'form-horizontal form-bordered']) !!}
                                        <div class="col-md-12">
                                            <div class="form-group m-form__group">
                                                <strong>1. Partida de nacimiento del postulante.</strong>

                                                <div class="file-loading">
                                                    <input id="carga1" name="carga1" type="file" />
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <button type="submit" class="btn btn-success">CARGAR DOCUMENTO</button>
                                            </div>
                                        </div>


                                        {!! Form::close() !!}
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        @foreach($documentos as $r)
                                            <div class="col-md-2 col-sm-2 col-xs-3 ">
                                                <img  class="img-fluid" alt="" src="{{ asset('/storage/'.$r->documento) }}" />
                                            </div>
                                        @endforeach
                                    </div>

                                    <hr/>

                                    <div  class="row">
                                        {!! Form::open(['id' => 'Frm2', 'class' => 'form-horizontal form-bordered']) !!}
                                        <div class="col-md-12">
                                            <div class="form-group m-form__group">
                                                <strong>2. Documento Nacional de identidad (DNI).</strong>

                                                <div class="file-loading">
                                                    <input id="carga2" name="carga2" type="file" />
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <button type="submit" class="btn btn-success">CARGAR DOCUMENTO</button>
                                            </div>
                                        </div>


                                        {!! Form::close() !!}
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        @foreach($documentos2 as $r)
                                            <div class="col-md-2 col-sm-2 col-xs-3 ">
                                                <img  class="img-fluid" alt="" src="{{ asset('/storage/'.$r->documento) }}" />
                                            </div>
                                        @endforeach
                                    </div>

                                    <hr/>




                                    <div  class="row">
                                        {!! Form::open(['id' => 'Frm3', 'class' => 'form-horizontal form-bordered']) !!}
                                        <div class="col-md-12">
                                            <div class="form-group m-form__group">
                                                <strong>3.Certificado de Estudios  o Constancia de Logros de Aprendizaje.</strong>

                                                <div class="file-loading">
                                                    <input id="carga3" name="carga3" type="file" />
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <button type="submit" class="btn btn-success">CARGAR DOCUMENTO</button>
                                            </div>
                                        </div>


                                        {!! Form::close() !!}
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        @foreach($documentos3 as $r)
                                            <div class="col-md-2 col-sm-2 col-xs-3 ">
                                                <img  class="img-fluid" alt="" src="{{ asset('/storage/'.$r->documento) }}" />
                                            </div>
                                        @endforeach
                                    </div>

                                    <hr/>


                                    <div  class="row">
                                        {!! Form::open(['id' => 'Frm4', 'class' => 'form-horizontal form-bordered']) !!}
                                        <div class="col-md-12">
                                            <div class="form-group m-form__group">
                                                <strong>4. Boletas de pago o recibos por honorarios de tu padre y de tu madre, correspondiente a los dos últimos meses (Octubre - Noviembre 2023).</strong>

                                                <div class="file-loading">
                                                    <input id="carga4" name="carga4" type="file" />
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <button type="submit" class="btn btn-success">CARGAR DOCUMENTO</button>
                                            </div>
                                        </div>


                                        {!! Form::close() !!}
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        @foreach($documentos4 as $r)
                                            <div class="col-md-2 col-sm-2 col-xs-3 ">
                                                <img  class="img-fluid" alt="" src="{{ asset('/storage/'.$r->documento) }}" />
                                            </div>
                                        @endforeach
                                    </div>

                                    <hr/>


                                    <div  class="row">
                                        {!! Form::open(['id' => 'Frm5', 'class' => 'form-horizontal form-bordered']) !!}
                                        <div class="col-md-12">
                                            <div class="form-group m-form__group">
                                                <strong>5. Autovalúo (PU-HR) o título de propiedad. Si vives en casa alquilada, recibo de pago o el contrato de alquiler. En caso de vivir alojado presentar la constancia de alojamiento simple, firmada por el dueño de la casa, adjuntando fotocopia del DNI del propietario.</strong>

                                                <div class="file-loading">
                                                    <input id="carga5" name="carga5" type="file" />
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <button type="submit" class="btn btn-success">CARGAR DOCUMENTO</button>
                                            </div>
                                        </div>


                                        {!! Form::close() !!}
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        @foreach($documentos5 as $r)
                                            <div class="col-md-2 col-sm-2 col-xs-3 ">
                                                <img  class="img-fluid" alt="" src="{{ asset('/storage/'.$r->documento) }}" />
                                            </div>
                                        @endforeach
                                    </div>

                                    <hr/>

                                    <div  class="row">
                                        {!! Form::open(['id' => 'Frm6', 'class' => 'form-horizontal form-bordered']) !!}
                                        <div class="col-md-12">
                                            <div class="form-group m-form__group">
                                                <strong>6. Recibo de agua, energía eléctrica y teléfono de la vivienda que ocupa el postulante en la ciudad de Lima, correspondiente a los dos últimos meses (Octubre - Noviembre 2023).</strong>

                                                <div class="file-loading">
                                                    <input id="carga6" name="carga6" type="file" />
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <button type="submit" class="btn btn-success">CARGAR DOCUMENTO</button>
                                            </div>
                                        </div>


                                        {!! Form::close() !!}
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        @foreach($documentos6 as $r)
                                            <div class="col-md-2 col-sm-2 col-xs-3 ">
                                                <img  class="img-fluid" alt="" src="{{ asset('/storage/'.$r->documento) }}" />
                                            </div>
                                        @endforeach
                                    </div>

                                    <hr/>

                                    <div  class="row">
                                        {!! Form::open(['id' => 'Frm7', 'class' => 'form-horizontal form-bordered']) !!}
                                        <div class="col-md-12">
                                            <div class="form-group m-form__group">
                                                <strong>7. Debes descargar los documentos, completar la información pedida y volver a cargarlos </strong>

                                                <div class="file-loading">
                                                    <input id="carga7" name="carga7" type="file" />
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <button type="submit" class="btn btn-success">CARGAR DOCUMENTO</button>
                                            </div>
                                        </div>


                                        {!! Form::close() !!}
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        @foreach($documentos7 as $r)
                                            <div class="col-md-2 col-sm-2 col-xs-3 ">
                                                <img  class="img-fluid" alt="" src="{{ asset('/storage/'.$r->documento) }}" />
                                            </div>
                                        @endforeach
                                    </div>

                                    <hr/>


                                    <div class="col-md-12">

                                        <h4>Información!</h4>
                                        <strong>Comprueba tus documentos subidos:</strong>

                                        <div id="js-grid-full-width" class="cbp col-md-12">
                                            @foreach($doctodos as $rs)
                                                <div class="cbp-item web-design col-md-4">
                                                    <a href="{{ asset('delete-document/'.$rs->id) }}" class="btn btn-danger"><span class="fa flaticon-delete"> ELIMINAR</span></a>
                                                    <a href="{{ asset('/storage/'.$rs->documento) }}" class="cbp-caption cbp-lightbox" data-title="VER">
                                                        <div class="cbp-caption-defaultWrap">

                                                            <div class="col-md-12">
                                                                <img  class="img-fluid" alt="" src="{{ asset('/storage/'.$rs->documento) }}" />
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


                                            @endforeach
                                        </div>








                                    </div>


                                </div>
                            </div>






                        </div>

                    </div>



                @endif

            </div>
        </div>
    </div>


















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
                    <h3 class="text-info"><strong>¿ Deseas confirmar tu solicitud  ?</strong></h3>



                </div>
                <div class="modal-footer">


                    <button id="btmmm" type="button" class="btn btn-success" >SÍ </button>


                    <a href="{{ route('home.index') }}"><button  type="button" class="btn btn-danger" >NO</button> </a>

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
    <script>
        $("#confimButon").click(function() {
            $('#myModal').modal('toggle');








        });
        $("#btmmm").click(function() {

            $.ajax({
                url: "regissol",
                type: "get",
                success : function()
                {
                    $('#myModal').modal('toggle');
                    location.reload();


                }
            });


        });





    </script>
    <script>
        $("#Frm1").validate({
            rules :
                {
                    carga1 : { required : true }
                },
            submitHandler : function(form)
            {
                var data = new FormData(Frm1);
                $.ajax({
                    url: "load1",
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
                    }
                });
            }
        });
    </script>
    <script>
        $("#Frm2").validate({
            rules :
                {
                    carga2 : { required : true }
                },
            submitHandler : function(form)
            {
                var data = new FormData(Frm2);
                $.ajax({
                    url: "load2",
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
                        }
                    }
                });
            }
        });
    </script>

    <script>
        $("#Frm3").validate({
            rules :
                {
                    carga3 : { required : true }
                },
            submitHandler : function(form)
            {
                var data = new FormData(Frm3);
                $.ajax({
                    url: "load3",
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
                    }
                });
            }
        });
    </script>

    <script>
        $("#Frm4").validate({
            rules :
                {
                    carga4 : { required : true }
                },
            submitHandler : function(form)
            {
                var data = new FormData(Frm4);
                $.ajax({
                    url: "load4",
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
                    }
                });
            }
        });
    </script>

    <script>
        $("#Frm5").validate({
            rules :
                {
                    carga5 : { required : true }
                },
            submitHandler : function(form)
            {
                var data = new FormData(Frm5);
                $.ajax({
                    url: "load5",
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
                    }
                });
            }
        });
    </script>

    <script>
        $("#Frm6").validate({
            rules :
                {
                    carga6 : { required : true }
                },
            submitHandler : function(form)
            {
                var data = new FormData(Frm6);
                $.ajax({
                    url: "load6",
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
                    }
                });
            }
        });
    </script>

    <script>
        $("#Frm7").validate({
            rules :
                {
                    carga7 : { required : true }
                },
            submitHandler : function(form)
            {
                var data = new FormData(Frm7);
                $.ajax({
                    url: "load7",
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
                    }
                });
            }
        });



    </script>
    <script src="{{asset('js/fileinput.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/es.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/fa/theme.js')}}" type="text/javascript"></script>

    <script>

        $("#carga1").fileinput({
            theme: 'fa',
            language: "es",
            showUpload: false,
            allowedFileExtensions: ["jpg", "png", "jpeg","JPG","PNG","JPEG"]
        });

        $("#carga2").fileinput({
            theme: 'fa',
            language: "es",
            showUpload: false,
            allowedFileExtensions: ["jpg", "png", "jpeg","JPG","PNG","JPEG"]
        });


        $("#carga3").fileinput({
            theme: 'fa',
            language: "es",
            showUpload: false,
            allowedFileExtensions: ["jpg", "png", "jpeg","JPG","PNG","JPEG"]
        });


        $("#carga4").fileinput({
            theme: 'fa',
            language: "es",
            showUpload: false,
            allowedFileExtensions: ["jpg", "png", "jpeg","JPG","PNG","JPEG"]
        });


        $("#carga5").fileinput({
            theme: 'fa',
            language: "es",
            showUpload: false,
            allowedFileExtensions: ["jpg", "png", "jpeg"]
        });

        $("#carga6").fileinput({
            theme: 'fa',
            language: "es",
            showUpload: false,
            allowedFileExtensions: ["jpg", "png", "jpeg"]
        });
        $("#carga7").fileinput({
            theme: 'fa',
            language: "es",
            showUpload: false,
            allowedFileExtensions: ["jpg", "png", "jpeg"]
        });

    </script>





@stop

@section('plugins-styles')
    {!! Html::style(asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')) !!}
    {!! Html::style(asset('assets/global/plugins/select2/css/select2.min.css')) !!}
    {!! Html::style(asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')) !!}
    {!! Html::style(asset('assets/global/plugins/icheck/skins/all.css')) !!}
    {!! Html::style(asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')) !!}
@stop
@section('plugins-js')
    {!! Html::script(asset('assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')) !!}
    {!! Html::script(asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')) !!}
    {!! Html::script(asset('assets/global/plugins/select2/js/select2.full.min.js')) !!}
    {!! Html::script(asset('assets/global/plugins/select2/js/i18n/es.js')) !!}
    {!! Html::script(asset('assets/global/plugins/icheck/icheck.min.js')) !!}
    {!! Html::script(asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')) !!}
@stop