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

                <!--
                <div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">
                    <div class="m-demo__preview">
                        <blockquote class="blockquote">

                            <p class="mb-1"><strong> Verifica los documentos requeridos según tu modalidad de ingreso en : </strong>

                                <a href="http://www.admision.uni.edu.pe/documentos-ingresantes" target="_blank"> DOCUMENTOS INGRESO</a>
                            </p>



                        </blockquote>

                    </div>
                </div>
                -->

                <hr>
                @if($postulante->idmodalidad == 1 || $postulante->idmodalidad == 2 || $postulante->idmodalidad == 16 || $postulante->idmodalidad == 11 || $postulante->idmodalidad == 4)



                    <div class="row">
                        <h1>CONSTANCIA DE LOGROS DE APRENDIZAJE</h1>

                        <form id="Frm7" style="width: 100%;">
                            {!! csrf_field() !!}
                            <input type="hidden"  name="nombre" value="2">
                            <div style="width: 100%;" class="form-group">
                                <div class="file-loading">
                                    <input id="carga7" name="carga7" type="file"  >
                                </div>

                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">CARGAR DOCUMENTO</button>
                            </div>

                            <p class="text-black-50">
                                <b>
                                    Nota: 20 archivos como máximo y tamaño máximo por archivo: 10 Mb, en caso el archivo sobrepasa el tamaño debe particionar con tamaño máximo de 10 Mb.
                                </b>
                            </p>




                        </form>




                    </div>
                @endif
                <div class="row">
                    <h1>FICHA DE INSCRIPCIÓN FIRMADA</h1>

                    <form id="Frm8" style="width: 100%;">
                        {!! csrf_field() !!}
                        <input type="hidden"  name="nombre" value="3">
                        <div style="width: 100%;" class="form-group">
                            <div class="file-loading">
                                <input id="carga8" name="carga8" type="file"  >
                            </div>

                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">CARGAR DOCUMENTO</button>
                        </div>

                        <p class="text-black-50">
                            <b>
                                Nota: 20 archivos como máxcimo y tamaño máximo por archivo: 10 Mb, en caso el archivo sobrepasa el tamaño debe particionar con tamaño máximo de 10 Mb.
                            </b>
                        </p>




                    </form>




                </div>
                <div class="row">
                    <h1>DNI</h1>

                    <form id="Frm9" style="width: 100%;">
                        {!! csrf_field() !!}
                        <input type="hidden"  name="nombre" value="4">
                        <div style="width: 100%;" class="form-group">
                            <div class="file-loading">
                                <input id="carga9" name="carga9" type="file"  >
                            </div>

                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">CARGAR DOCUMENTO</button>
                        </div>

                        <p class="text-black-50">
                            <b>
                                Nota: 20 archivos como máxcimo y tamaño máximo por archivo: 10 Mb, en caso el archivo sobrepasa el tamaño debe particionar con tamaño máximo de 10 Mb.
                            </b>
                        </p>




                    </form>




                </div>
                <div class="row">
                    <h1>OTRO DOCUMENTO SEGÚN LA MODALIDAD</h1>

                    <form id="Frm10" style="width: 100%;">
                        {!! csrf_field() !!}
                        <input type="hidden"  name="nombre" value="5">
                        <div style="width: 100%;" class="form-group">
                            <div class="file-loading">
                                <input id="carga10" name="carga10" type="file"  >
                            </div>

                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">CARGAR DOCUMENTO</button>
                        </div>

                        <p class="text-black-50">
                            <b>
                                Nota: 20 archivos como máxcimo y tamaño máximo por archivo: 10 Mb, en caso el archivo sobrepasa el tamaño debe particionar con tamaño máximo de 10 Mb.
                            </b>
                        </p>




                    </form>




                </div>
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

                                            <a href="{{ asset('delete-ingreso/'.$rs->id) }}" class="btn btn-danger"><span class="fa flaticon-delete"> ELIMINAR</span></a>

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
                                            <a href="{{ asset('delete-ingreso/'.$rs->id) }}" class="btn btn-danger"><span class="fa flaticon-delete"> ELIMINAR</span></a>
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

            $("#carga7").fileinput({
                theme: 'fas',
                language: "es",
                showUpload: false,
                allowedFileExtensions: ["jpg", "png", "jpeg","pdf",'JPG','PNG','JPEG','PDF'],
                maxFileCount: 30,

            });
            $("#carga8").fileinput({
                theme: 'fas',
                language: "es",
                showUpload: false,
                allowedFileExtensions: ["jpg", "png", "jpeg","pdf",'JPG','PNG','JPEG','PDF'],
                maxFileCount: 30,

            });
            $("#carga9").fileinput({
                theme: 'fas',
                language: "es",
                showUpload: false,
                allowedFileExtensions: ["jpg", "png", "jpeg","pdf",'JPG','PNG','JPEG','PDF'],
                maxFileCount: 30,

            });
            $("#carga10").fileinput({
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
                    url: "upload-ingreso",
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
        $("#Frm7").validate({
            rules :
                {
                    carga7 : { required : true }
                },
            messages: {
                carga7: {required:'DEBE CARGAR SU ARCHIVO'}
            },
            submitHandler : function(form)
            {
                $("#Frm7").block({
                    message: '<h1>SUBIENDO</h1>'

                });
                var data = new FormData(Frm7);
                $.ajax({
                    url: "upload-ingreso",
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
                        $("#Frm7").unblock();
                        alert("ERROR AL SUBIR SU ARCHIVO INTENTE NUEVAMENTE.")
                    }
                });
            }
        });
        $("#Frm8").validate({
            rules :
                {
                    carga8 : { required : true }
                },
            messages: {
                carga8: {required:'DEBE CARGAR SU ARCHIVO'}
            },
            submitHandler : function(form)
            {
                $("#Frm8").block({
                    message: '<h1>SUBIENDO</h1>'

                });
                var data = new FormData(Frm8);
                $.ajax({
                    url: "upload-ingreso",
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
                        $("#Frm8").unblock();
                        alert("ERROR AL SUBIR SU ARCHIVO INTENTE NUEVAMENTE.")
                    }
                });
            }
        });
        $("#Frm9").validate({
            rules :
                {
                    carga9 : { required : true }
                },
            messages: {
                carga9: {required:'DEBE CARGAR SU ARCHIVO'}
            },
            submitHandler : function(form)
            {
                $("#Frm9").block({
                    message: '<h1>SUBIENDO</h1>'

                });
                var data = new FormData(Frm9);
                $.ajax({
                    url: "upload-ingreso",
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
                        $("#Frm9").unblock();
                        alert("ERROR AL SUBIR SU ARCHIVO INTENTE NUEVAMENTE.")
                    }
                });
            }
        });
        $("#Frm10").validate({
            rules :
                {
                    carga10 : { required : true }
                },
            messages: {
                carga10: {required:'DEBE CARGAR SU ARCHIVO'}
            },
            submitHandler : function(form)
            {
                $("#Frm10").block({
                    message: '<h1>SUBIENDO</h1>'

                });
                var data = new FormData(Frm10);
                $.ajax({
                    url: "upload-ingreso",
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
                        $("#Frm10").unblock();
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
