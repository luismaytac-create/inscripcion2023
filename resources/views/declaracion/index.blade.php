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

                @endif

                   <h2>1. Descarga la declaración jurada:</h2>
                       <a target="_blank"
                          @if($postulante->idmodalidad == 16 )
                          href="{{ asset("DECLARACION_JURADA_25-1.pdf")  }}"
                          @else
                          href="{{ asset("DECLARACION_JURADA_25-1.pdf")  }}"
                                  @endif

                          class="btn btn-success m-btn  m-btn--icon">
                        <span>
                            <i class="fa flaticon-book"></i>
                            <span>DESCARGAR DECLARACIÓN</span>
                        </span>
                       </a>
                       <hr>
                    <h2>2. Llena la información y fírmala.</h2>
                    <h2>3. Escanea y sube tu declaración jurada en formato pdf o imagen</h2>
                       
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

                                        <a href="{{ asset('delete-declaracion/'.$rs->id) }}" class="btn btn-danger"><span class="fa flaticon-delete"> ELIMINAR</span></a>

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
                                            <a href="{{ asset('delete-declaracion/'.$rs->id) }}" class="btn btn-danger"><span class="fa flaticon-delete"> ELIMINAR</span></a>
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
                    url: "upload-declaracion",
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

