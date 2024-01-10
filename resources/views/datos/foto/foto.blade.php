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
                            Foto y DNI <strong></strong>
                        </h1>
                        <div class="actions">
                            {!!Form::back(route('home.index'))!!}
                        </div>
                        <h2 class="m-portlet__head-label m-portlet__head-label--danger">
                            <span>Foto y DNI</span>
                        </h2>
                    </div>
                </div>

            </div>
            <div class="m-portlet__body lead">




                <!--row-->
                <div class="row">
                    <div class="col-12">



                        @if($postulante->foto_estado!='SIN FOTO' )
                            <h1 class="text-danger">Estado de Edición de FOTO</h1>


                            @if($postulante->foto_estado =='CARGADO')

                                <h1>Estado: <span class="text-warning">FOTO CARGADA Y EN EDICIÓN</span></h1>
                            @else
                                <h1>Estado: <span class="text-warning">{{ $postulante->foto_estado }}</span></h1>
                            <h4>Observación: <span>{{ $obs }}</span></h4>
                            @endif


                        @endif

                    </div>




                </div>

                <!-- end row-->
                <hr>
                <div class="row">
                    <!--begin::Portlet-->
                    <div class="m-portlet m-portlet--rounded">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        <small> Sube el archivo digital proporcionada por el estudio fotográfico</small>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <div class="row">

                                <div class="file-loading">
                                    <input id="file" name="file" type="file" />
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-12">
                                    <h3>Nota:</h3>
                                    <p>Foto formato JPG tomada en estudio fotográfico (Art. 54°), tamaño pasaporte a color, a partir de los hombros, con
                                        fondo blanco, sin lentes, gorros, sin implementos que dificulten la identificación. No se permitirá otro tipo de imagen.</p>
                                    <h3 class="text-danger">Debes esperar 24 horas para la edición de tu foto.</h3>
                                </div><!--span-->
                            </div><!--row-->
                        </div>
                    </div>

                    <!--end::Portlet-->

                </div>
                <div class="row">

                    <!--begin::Portlet-->
                    <div class="m-portlet m-portlet--rounded">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        <small> Sube tu DNI</small>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <div class="row">
                                {!! csrf_field() !!}
                                <div class="file-loading">
                                    <input id="filedni" name="filedni" type="file"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <p>Escanea tu DNI .</p>
                                    <h4>Ejemplo de DNI escaneado (ambas caras en una misma imagen):</h4>
                                    <div class="col-md-12">

                                        <img class="img-fluid" style="border: 3px solid; color: black;" src="{{ asset('/storage/avatar/ejemplo.png') }}">


                                    </div>
                                </div><!--span-->
                            </div><!--row-->
                        </div>
                    </div>

                    <!--end::Portlet-->

                </div>

               <hr>

                <div class="row">


                    <div class="col-12">
                        <h4>Información!</h4>
                        <strong>Comprueba tus archivos subidos:</strong>
                        <div id="js-grid-full-width" class="cbp col-md-12">
                            @foreach($doctodos as $rs)

                                @if(substr($rs->archivo,strpos($rs->archivo,'.')) == '.pdf' || substr($rs->archivo,strpos($rs->archivo,'.'))=='.PDF')

                                @else
                                    <div class="cbp-item web-design col-md-4">





                                        <a href="{{ asset('/storage/'.$rs->archivo) }}" class="cbp-caption cbp-lightbox" data-title="VER">





                                            <div class="cbp-caption-defaultWrap">

                                                <div class="col-md-12">

                                                    @if(substr($rs->archivo,strpos($rs->archivo,'.')) == '.pdf' || substr($rs->archivo,strpos($rs->archivo,'.'))=='.PDF')



                                                    @else

                                                        <img  class="img-fluid" alt="" src="{{ asset('/storage/'.$rs->archivo) }}" />

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

                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            @foreach($doctodos as $rs)


                                @if(substr($rs->archivo,strpos($rs->archivo,'.')) == '.pdf' || substr($rs->archivo,strpos($rs->archivo,'.'))=='.PDF')



                                    <div class="row">
                                        <div class="col-12">

                                            <a href="#" class="cbp-caption cbp-lightbox">
                                                <iframe src="{{ asset('/storage/'.$rs->archivo) }}" width="300px"></iframe>

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

    <script src="{{asset('js/fileinput.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/es.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/fa/theme.js')}}" type="text/javascript"></script>


    <script>
        $("#file").fileinput({
            theme: 'fa',
            language: "es",
            uploadUrl: "{{ url("upload-foto") }}",
            uploadExtraData: function() {
                return {
                    _token: $("input[name='_token']").val(),
                };
            },

            allowedFileExtensions: ["jpg", "png", "jpeg",'JPG','PNG','JPEG'],
            initialPreview: [
                '<img class="img-fluid" src="{{ asset('/storage/'.$postulante->foto) }}" class="file-preview-image" >'
            ],
            slugCallback: function (filename) {

                return filename.replace('(', '_').replace(']', '_');
            }, maxFileSize: 10000
        });









        $("#filedni").fileinput({
            theme: 'fa',
            language: "es",
            uploadUrl: "{{ url("upload-dni") }}",

            uploadExtraData: function() {
                return {
                    _token: $("input[name='_token']").val(),
                };
            },


            allowedFileExtensions: ["jpg", "png", "jpeg","pdf",'JPG','PNG','JPEG'],
            slugCallback: function (filename) {
                return filename.replace('(', '_').replace(']', '_');
            },
            @if(isset($postulante->foto_dni))
            initialPreview: [
                '<img class="img-fluid" src="{{ asset('/storage/'.$postulante->foto_dni) }}" class="file-preview-image" >'
            ],
            @else

                    @endif


            maxFileSize: 10000
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

