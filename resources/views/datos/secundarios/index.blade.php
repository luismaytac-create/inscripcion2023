@extends('layouts.base')

@section('content')
    @include('alerts.errors')


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
                            Datos personales del <strong>POSTULANTE</strong> (NO DEL APODERADO)
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


                {!! Form::model($postulante,['route'=>['datos.secundarios.update',$postulante],'method'=>'PUT','files'=>true]) !!}
                {!!Form::hidden('id', $postulante->id );!!}
                <dl>
                    <dt>Observación</dt>
                    <dd> <strong>Todos los campos con (*) son obligatorios.</strong></dd>
                </dl>
                <div class="row">


                    <div class="col-md-12">
                        <!--begin::Portlet-->
                        <div class="m-portlet m-portlet--rounded">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            <small>Datos Personales</small>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">

                                <div class="form-body ">
                                    <div class="row">
                                        <div class="col-md-6">
                                            {!!Field::text('tipo_identificacion',$postulante->tipo_identificacion,['label'=>'Tipo Identificación','placeholder'=>'Ingresar numero de identificación','readonly'=>'true']);!!}
                                        </div>


                                        <div class="col-md-6">
                                            {!!Field::text('numero_identificacion',null,['label'=>'Número de identificación (*)','placeholder'=>'Ingresar numero de identificación','readonly'=>'true']);!!}
                                        </div><!--span-->
                                    </div><!--row-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            {!!Field::email('email', $emailus, ['label'=>'Email del postulante (*)','placeholder'=>'Email del postulante','readonly'=>'readonly']);!!}
                                        </div><!--span-->
                                        <div class="col-md-6">
                                            {!!Field::select('idsexo', $sexo, ['label'=>'Sexo del postulante (*)','empty'=>'Sexo del postulante']);!!}

                                        </div><!--span-->
                                    </div><!--row-->

                                    <div class="row">
                                        <div class="col-md-6">
                                            {!!Field::number('talla', null, ['label'=>'Talla del postulante(en metros) (*)','placeholder'=>'Talla del postulante','step'=>'0.01']);!!}
                                        </div><!--span-->
                                        <div class="col-md-6">
                                            {!!Field::number('peso', null, ['label'=>'Peso del postulante (en kilogramos) (*)','placeholder'=>'Peso del postulante','step'=>'0.01']);!!}



                                        </div><!--span-->
                                    </div>


                                    <div class="row">

                                        <div class="col-md-6">
                                            {!!Field::text('telefono_celular', null, ['label'=>'Celular del postulante (*)','placeholder'=>'Teléfono celular del postulante','maxlength'=>'9','id'=>'telefono_celular']);!!}
                                        </div><!--span-->
                                        <div class="col-md-6">
                                            {!!Field::text('telefono_fijo', null, ['label'=>'Teléfono celular de apoderado o familiar (*)','placeholder'=>'Teléfono celular de apoderado o familiar','maxlength'=>'9','id'=>'telefono_fijo']);!!}
                                        </div><!--span-->
                                    </div><!--row-->
                                    <div class="row">

                                        @if($postulante->idpais != null )
                                            <div class="col-md-6">
                                                {!!Field::select('idpais', $pais, $postulante->idpais, ['label'=>'País donde vive el postulante (*)','empty'=>'País donde vive el postulante']);!!}
                                            </div><!--span-->
                                        @endif
                                        @if($postulante->idpais == null )
                                            <div class="col-md-6">
                                                {!!Field::select('idpais', $pais, 1, ['label'=>'País donde vive el postulante (*)','empty'=>'País donde vive el postulante']);!!}
                                            </div><!--span-->
                                        @endif


                                        <div class="col-md-6 Distrito">
                                            <div class="form-group">
                                                {!!Form::label('lblDistrito', 'Distrito donde vive el postulante');!!}





                                                @if(Request::old('idubigeo') == NULL)


                                                    {!!Form::select('idubigeo',UbigeoPersonal($postulante->idubigeo) ,null , ['style'=>'width: 100%','class'=>'form-control Ubigeo' ]);!!}
                                                @endif

                                                @if(Request::old('idubigeo') != NULL)


                                                    {!!Form::select('idubigeo',UbigeoPersonal(Request::old('idubigeo')) ,null , ['class'=>'form-control Ubigeo' ]);!!}
                                                @endif



                                            </div>
                                        </div><!--span-->

                                    </div><!--row-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            {!!Field::date('fecha_nacimiento', $postulante->fecha_nacimiento, ['class'=>'Fecha','label'=>'Fecha de nacimiento del postulante (día-mes-año)(*)','placeholder'=>'fecha de nacimiento del postulante','min'=>'1920-01-01',"max "=>'2011-01-01']);!!}






                                        </div><!--span-->
                                        <div class="col-md-6">
                                            {!!Field::text('telefono_varios', null, ['label'=>'Otros teléfonos de contacto (*)','placeholder'=>'Otros teléfonos de contacto','maxlength'=>'15']);!!}
                                        </div><!--span-->
                                    </div><!--row-->
                                    <div class="row Distrito">
                                        <div class="col-md-12">
                                            {!!Field::text('direccion', null, ['label'=>'Dirección donde vive el postulante (*)','placeholder'=>'Dirección donde vive el postulante','maxlength'=>'220']);!!}
                                        </div><!--span-->
                                    </div><!--row-->
                                    <div class="row ">
                                        <div class="col-md-6">
                                            {!!Field::select('inicio_estudios', null, ['label'=>'Año de inicio de la secundaria (*)','empty'=>'Inicio de la secundaria']);!!}
                                        </div><!--span-->

                                        <div class="col-md-6">

                                            {!!Field::select('fin_estudios', null, ['label'=>'Selecciona el año que culminas la secundaria (*)','empty'=>'Fin de la secundaria']);!!}

                                        </div>

                                    </div><!--row-->
                                    <div class="row">

                                        @if($postulante->idpaisnacimiento != null )
                                            <div class="col-md-6">
                                                {!!Field::select('idpaisnacimiento', $pais, $postulante->idpaisnacimiento, ['label'=>'País donde nació el postulante (*)','empty'=>'País donde nació el postulante']);!!}
                                            </div><!--span-->


                                        @endif

                                        @if($postulante->idpaisnacimiento == null )
                                            <div class="col-md-6">
                                                {!!Field::select('idpaisnacimiento', $pais, 1, ['label'=>'País donde nació el postulante (*)','empty'=>'País donde nació el postulante']);!!}
                                            </div><!--span-->

                                        @endif
                                        <div class="col-md-6 DistritoNacimiento">
                                            <div class="form-group">
                                                {!!Form::label('lblDistrito', 'Distrito donde nació el postulante (*) ');!!}





                                                @if(Request::old('idubigeonacimiento') == NULL)


                                                    {!!Form::select('idubigeonacimiento',UbigeoPersonal($postulante->idubigeonacimiento) ,null , ['style'=>'width: 100%','class'=>'form-control Ubigeo']);!!}
                                                @endif

                                                @if(Request::old('idubigeonacimiento') != NULL)


                                                    {!!Form::select('idubigeonacimiento',UbigeoPersonal(Request::old('idubigeonacimiento')) ,null , ['class'=>'form-control Ubigeo' ]);!!}
                                                @endif




                                            </div>
                                        </div><!--span-->
                                    </div><!--row-->
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label>Si tiene alguna discapacidad, ingrese el tipo de discapacidad y qué asistencia requiere para rendir el examen</label>
                                            {!! Form::textarea('discapacidad',$postulante->discapacidad,['class'=>'form-control','placeholder'=>'Si es discapacitado, ingrese que discpacidad y como podemos ayudarlo para rendir el examen']) !!}
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <p><strong>CUARTA DISPOSICIÓN FINAL DEL REGLAMENTO DE ADMISIÓN:</strong> Los interesados en participar en los Exámenes que convoque la Dirección de
                                                Admisión (a excepción de los estudiantes de la UNI) y que no cumplan los requisitos exigidos
                                                como postulante regular, podrán inscribirse y rendirlos en calidad de participante sin derecho
                                                a acceder a una vacante; sus notas serán enviadas directamente a su correo electrónico
                                                registrado en su inscripción.</p>
                                                {!!Field::select('cuarta_df', [
                                                    'participante_sin_derecho'=>'Participante sin derecho a vacante',
                                                    'postulante'=>'Postulante con derecho a vacante',
                                                    ], $postulante->cuarta_df, ['label'=>'Deseo inscribirme como:  (*)','empty'=>'Seleccionar']);!!}
                                        </div>

                                    </div>



                                    {!!Form::enviar('Guardar')!!}
                                </div>


                            </div>
                        </div>

                        <!--end::Portlet-->

                    </div>
                    {!! Form::close() !!}


                </div>
            </div>

        </div>
    </div>



@stop

@section('js-scripts')



    <script src="{{asset('js/fileinput.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/es.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/fa/theme.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
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


                maxFileSize: 3000
            });




            idpais = $("#idpais").val();
            idpaisNacimiento = $("#idpaisnacimiento").val();
            OcultaDistrito(idpais);
            OcultaDistritoNacimiento(idpaisNacimiento);

            $("#idpais").click(function () {
                var idpais = $(this).val();

                OcultaDistrito(idpais);

            });
            $("#idpaisnacimiento").click(function () {
                var idpais = $(this).val();

                OcultaDistritoNacimiento(idpais);

            });

            function OcultaDistrito(idpais) {
                $.ajax({
                    url: '{{ url("pais") }}',
                    dataType: 'json',
                    data: {varsearch: idpais}
                })
                    .done(function (pais) {
                        if (pais.codigo == 'PE') {
                            $('.Distrito').show();
                        } else {
                            $('.Distrito').hide();
                        }
                    })
                    .fail(function () {
                        console.log("error");
                    });
            }

            function OcultaDistritoNacimiento(idpais) {
                $.ajax({
                    url: '{{ url("pais") }}',
                    dataType: 'json',
                    data: {varsearch: idpais}
                })
                    .done(function (pais) {
                        if (pais.codigo == 'PE') {
                            $('.DistritoNacimiento').show();
                        } else {
                            $('.DistritoNacimiento').hide();
                        }
                    })
                    .fail(function () {
                        console.log("error");
                    });
            }

            $(".Ubigeo").select2({

                ajax: {
                    url: '{{ url("ubigeo") }}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            varsearch: params.term // search term
                        };
                    },
                    processResults: function (data) {
                        // parse the results into the format expected by Select2.
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                placeholder: 'Seleccione el distrito : ejemplo LIMA',
                minimumInputLength: 3,
                templateResult: format,
                templateSelection: format,
                escapeMarkup: function (markup) {
                    return markup;
                } // let our custom formatter work
            });

            function format(res) {
                var markup = res.text;
                return markup;

            }


        });


        $(".Fecha").inputmask("yyyy-mm-dd", {
            "placeholder": "*"
        });

        $('#telefono_celular').on('change', function() {

            var p = $('#telefono_celular').val().length;


            if(p>9){

                var res = $("#telefono_celular").val().substring(0, 9);
                $("#telefono_celular").val(res);
            }

        });

    </script>


@stop


