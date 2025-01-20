@extends('layouts.base')

@section('content')
    <div class="m-content">

        @include('alerts.errors')
        {!! Alert::render() !!}
        <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="flaticon-statistics"></i>
                        </span>
                        <h2 class="lead">
                            <span class="caption-subject theme-font bold uppercase">CONFIRMAR FICHA</span>
                        </h2>
                        <div class="actions">
                            {!!Form::back(route('home.index'))!!}
                        </div>
                        <h2 class="m-portlet__head-label m-portlet__head-label--danger">
                            <span>DATOS PERSONALES</span>
                        </h2>
                    </div>
                </div>

            </div>


            <div class="m-portlet__body lead">




                @if($postulante->idmodalidad==16)
                    <h1>Estimado postulante, en caso de haber ingresado por la MODALIDAD INGRESO DIRECTO CEPRE usted quedará exonerado del pago por derecho de inscripción.
                    </h1>
                        <h1>En caso de no haber logrado una vacante, tendrá la opción de postular en el examen general, realizando el pago de inscripción de acuerdo a la modalidad seleccionada.

                        El pago lo podrá realizar a partir del 03 de febrero al 07 de febrero de 2025</h1>

                @else
                    <h1>Ficha de inscripción disponible desde el 21 de enero</h1>
                @endif

                <div class="col-md-12" style="display:none;">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light tasks-widget widget-comments">
                        <div class="portlet-title ">
                            <div class="caption caption-md font-red-sunglo">

                            </div>

                        </div>
                        <div class="form-body ">

                            <div class="row" id="datosdiv">
                                <h3>CONFIRMA QUE TU INFORMACIÓN PERSONAL Y FOTOGRAFÍA SEAN LAS CORRECTAS.</h3>
                                <strong>Verifica todos tus datos personales, si alguno no es correcto debes modificar este, en la pestaña DATOS .</strong>
                                <div class="col-md-12">


                                    <div class="m-portlet m-portlet--danger m-portlet--head-solid-bg m-portlet--rounded">
                                        <div class="m-portlet__head">
                                            <div class="m-portlet__head-caption">
                                                <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon">
													<i class="la la-thumb-tack"></i>
												</span>
                                                    <h3 class="m-portlet__head-text">
                                                        DATOS DEL POSTULANTE
                                                    </h3>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="m-portlet__body">
                                            <div class="row">
                                                <div class="col-md-3 col-xs-3">
                                                    <div class="invoice-logo">

                                                        <img src="{{ $postulante->mostrar_foto_editada}}" class="img-fluid center" alt="">

                                                    </div>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h2 class="invoice-title uppercase">APELLIDOS Y NOMBRES</h2>
                                                            <p class="invoice-desc">{{ $postulante->nombre_completo}}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h2 class="invoice-title uppercase">DNI</h2>
                                                            <p class="invoice-desc inv-address">{{ $postulante->identificacion}}</p>
                                                        </div>


                                                    </div>

                                                    <div class="row">


                                                        <div class="col-md-6">
                                                            <h2 class="invoice-title uppercase">FECHA DE NACIMIENTO</h2>
                                                            <p class="invoice-desc">{{ $postulante->fecha_nacimiento}}</p>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <h2 class="invoice-title uppercase">LUGAR DE NACIMIENTO</h2>
                                                            <p class="invoice-desc">{{ $postulante->descripcion_ubigeo_nacimiento}}</p>
                                                        </div>

                                                    </div>
                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <h2 class="invoice-title uppercase">DIRECCIÓN</h2>
                                                            <p class="invoice-desc inv-address">{{ $postulante->direccion}} - {{ $postulante->descripcion_ubigeo}}</p>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <h2 class="invoice-title uppercase">TELÉFONOS</h2>
                                                            <p class="invoice-desc inv-address">{{ $postulante->telefonos}}</p>
                                                        </div>


                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <h2 class="invoice-title uppercase">EMAIL</h2>
                                                            <p class="invoice-desc inv-address">{{ $postulante->email}}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h2 class="invoice-title uppercase">INSTITUCIÓN EDUCATIVA</h2>
                                                            <p class="invoice-desc inv-address">
                                                                {{ $postulante->institucion_educativa  }} - {{ $postulante->gestion_ie  }} -  {{ $postulante->institucion_educa->descripcion_ubigeo   }} </p>
                                                        </div>



                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <h2 class="invoice-title uppercase">INICIO DE EDUCACIÓN SECUNDARIA</h2>
                                                            <p class="invoice-desc inv-address">{{ $postulante->inicio_estudios}} </p>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <h2 class="invoice-title uppercase">FIN DE EDUCACIÓN SECUNDARIA</h2>
                                                            <p class="invoice-desc inv-address">{{ $postulante->fin_estudios}}</p>
                                                        </div>


                                                    </div>
                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <h2 class="invoice-title uppercase">PESO</h2>
                                                            <p class="invoice-desc inv-address">{{ $postulante->peso}} </p>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <h2 class="invoice-title uppercase">TALLA</h2>
                                                            <p class="invoice-desc inv-address">{{ $postulante->talla}}</p>
                                                        </div>


                                                    </div>

                                                </div>
                                                <div class="invoice-content-2 bordered">
                                                    <div class="row invoice-body">
                                                        <div class="col-xs-12 table-responsive">
                                                            <table class="table table-hover">
                                                                <thead>
                                                                <tr>
                                                                    <th class="invoice-title uppercase"></th>

                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <h3>Modalidad : {{ $postulante->nombre_modalidad}}</h3>
                                                                    </td>
                                                                </tr>

                                                                @if($postulante->nombre_especialidad2 == "---" && $postulante->nombre_especialidad != "---")
                                                                    <tr>
                                                                        <td>
                                                                            <h3>Primera prioridad : {{ $postulante->nombre_especialidad}}</h3>
                                                                        </td>
                                                                    </tr>
                                                                @endif

                                                                @if($postulante->nombre_especialidad3 == "---" && $postulante->nombre_especialidad2 != "---")
                                                                    <tr>
                                                                        <td>
                                                                            <h3>Primera prioridad : {{ $postulante->nombre_especialidad}}</h3>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <h3>Segunda prioridad : {{ $postulante->nombre_especialidad2}}</h3>
                                                                        </td>
                                                                    </tr>
                                                                @endif

                                                                @if($postulante->nombre_especialidad != "---" && $postulante->nombre_especialidad2 != "---" && $postulante->nombre_especialidad3 != "---" )
                                                                    <tr>
                                                                        <td>
                                                                            <h3>Primera prioridad : {{ $postulante->nombre_especialidad}}</h3>
                                                                        </td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <h3>Segunda prioridad : {{ $postulante->nombre_especialidad2}}</h3>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <h3>Tercera prioridad : {{ $postulante->nombre_especialidad3}}</h3>
                                                                        </td>
                                                                    </tr>
                                                                @endif



                                                                @if ($postulante->codigo_modalidad == 'ID-CEPRE')
                                                                    <tr>
                                                                        <td>
                                                                            <h3>Modalidad  2: {{ $postulante->nombre_modalidad2}}</h3>
                                                                        </td>
                                                                    </tr>
                                                                    @if($postulante->nombre_especialidad5 == "---" && $postulante->nombre_especialidad4 != "---")
                                                                        <tr>
                                                                            <td>
                                                                                <h3>Primera prioridad : {{ $postulante->nombre_especialidad4}}</h3>
                                                                            </td>
                                                                        </tr>
                                                                    @endif

                                                                    @if($postulante->nombre_especialidad6 == "---" && $postulante->nombre_especialidad5 != "---")
                                                                        <tr>
                                                                            <td>
                                                                                <h3>Primera prioridad : {{ $postulante->nombre_especialidad4}}</h3>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <h3>Segunda prioridad : {{ $postulante->nombre_especialidad5}}</h3>
                                                                            </td>
                                                                        </tr>
                                                                    @endif

                                                                    @if($postulante->nombre_especialidad4 != "---" && $postulante->nombre_especialidad5 != "---" && $postulante->nombre_especialidad6 != "---" )
                                                                        <tr>
                                                                            <td>
                                                                                <h3>Primera prioridad : {{ $postulante->nombre_especialidad4}}</h3>
                                                                            </td>

                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <h3>Segunda prioridad : {{ $postulante->nombre_especialidad5}}</h3>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <h3>Tercera prioridad : {{ $postulante->nombre_especialidad6}}</h3>
                                                                            </td>
                                                                        </tr>
                                                                    @endif



                                                                @endif

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>


                                                </div>





                                            </div>

                                        </div>
                                    </div>

                                    <!--end::Portlet-->

                                </div>
                            </div>







                            <div id="divcnf1" class="col-md-12 ">
                                <div id="divresp1" class="row m--padding-10">
                                    <h2>¿Estás seguro(a) que la información es correcta? <br>
                                    </h2>
                                    <div class="col-12">
                                        {!! Form::open( ['route' => 'ficha.confirmarapi','method'=>'get']) !!}
                                        <button id="btndtcrLuis" type="submit" class="btn m-btn--pill btn-success btn-lg m-btn m-btn--custom">DATOS CORRECTOS</button>
                                        {!! Form::close() !!}
                                        <a href="{{ route('datos.postulante.index') }}">
                                            <button type="button" class="btn btn-danger">MIS DATOS O CELULAR SON INCORRECTOS
                                                <br>, QUIERO EDITARLOS</button> </a>
                                    </div>
                                </div>


                                <div style="display:none;" id="divmensj" class="row">

                                    {{-- @if($postulante->idmodalidad == 16) --}}
                                    @if(false)
                                    <div class="row">
                                        <div class="col-12">
                                            <h2>Turno Prueba Piloto para el Examen Final CEPRE-UNI</h2>
                                            <div class="m-form__group form-group">
                                                <label for="">Seleccionar turno</label>
                                                <div class="m-radio-list">
                                                    @foreach ($turnospiloto as $item)
                                                        <label class="m-radio">
                                                            <input value="{{$item->id}}" type="radio" name="turnopilot" id="turnopilot"> {{$item->turno}}
                                                            <span></span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-12">
                                            <div id="divcargui">
                                                <h3>Debes confirmar tu número de celular </h3>
                                                <h3 >Número de Celular:</h3>

                                                <h2 class="alert alert-info">{{$postulante->telefono_celular}}</h2>

                                                <hr>
                                                <h3>Presiona el botón para enviar un mensaje de texto con un código de verificación a este número</h3>
                                                <hr>

                                            </div>


                                            <button id="btnsendsms" type="button" class="btn m-btn--pill btn-success btn-lg m-btn m-btn--custom">ENVIAR MENSAJE</button>



                                            <button id="btncodigo" type="button" class="btn m-btn--pill btn-info btn-lg m-btn m-btn--custom">YA TENGO UN CÓDIGO</button>

                                            <hr/>


                                            <div style="display: none;" id="divverifbu" class="col-md-12">
                                                <h3>Ingresa el código de verificación </h3>
                                                <br/>
                                                <div id="fiel_codigo_verificacion" class="form-group m-form__group has-success ">
                                                    <label for="codigo_verificacion" class="control-label">
                                                        CÓDIGO DE VERIFICACIÓN
                                                    </label>


                                                    <div class="controls">
                                                        <input placeholder="INGRESA EL CÓDIGO DE VERIFICACIÓN" maxlength="12" class="form-control success" id="codigo_verificacion" name="codigo_verificacion" type="text">
                                                    </div>
                                                </div>

                                                <h4 style="display: none;"  id="clockespera" class="alert alert-warning">Verifica tu número de celular y espera unos minutos el mensaje de texto.Si no llega el mensaje presiona el botón enviar para volver a enviar el mensaje</h4>



                                                <button id="btnconfcod" type="button" class="btn m-btn--pill btn-info btn-lg m-btn m-btn--custom">CONFIRMAR</button>
                                            </div>

                                            <hr>
                                            <br>
                                            <button style="display:none;" id="btnnollega" type="button" class="btn m-btn--pill btn-warning btn-lg m-btn m-btn--custom">NO HE RECIBIDO EL MENSAJE DE TEXTO</button>
                                            <a href="{{ route('datos.postulante.index') }}">
                                                <button type="button" class="btn btn-danger">MIS DATOS O CELULAR SON INCORRECTOS <br>, QUIERO EDITARLOS</button> </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PORTLET-->
                </div>
            </div>
        </div>
    </div>

@stop
@section('js-scripts')


    <script>



        function validarwebcam() {

            if (  !$('#webcam').val() ){
                swal("SELECCIONA CÁMARA WEB", "Debes seleccionar una respuesta si posee cámara web.", "error");
                return false;

            }


            var checkedValue = null;
            var inputElements = document.getElementsByName('checkent');
            for(var i=0; inputElements[i]; ++i){
                if(inputElements[i].checked){
                    checkedValue = inputElements[i].value;
                    break;
                }
            }


            if (  !checkedValue ){
                swal("SELECCIONA UNA OPCIÓN", "Debes seleccionar una respuesta sobre comó te enteraste del simulacro virtual.", "error");
                return false;

            }






            return  true;
        }


        function validarenvio() {

            if (  !$('#codigo_verificacion').val() ){
                swal("FALTA CÓDIGO DE VERIFICACIÓN", "Debes ingresar el código de verificación.", "error");
                return false;

            }

            @if(false)
            if (  !$("input[name='turnopilot']:checked").val()){
                swal("FALTA TURNO PILOTO", "Debes seleccionar el turno de tu prueba piloto.", "error");
                return false;
            }
            @else
                return true;
            @endif
            


            return  true;

        }

        $( "#btndtcr" ).click(function() {

            $("#divresp1").hide();
            $("#divmensj").show();

            $("#datosdiv").hide();

        });


        $( "#btnnollega" ).click(function() {
            $("#clockespera").show();
        });
        $( "#btncodigo" ).click(function() {
            $("#divverifbu").show();
            $("#btnnollega").show();

        });

        $( "#btnconfcod" ).click(function() {


            var webcam =  $("#webcam").val();
            var codigo = $("#codigo_verificacion").val();
            var encuesta = [];
            var turno = $("input[name='turnopilot']:checked").val();
            var checkedValue = null;
            var inputElements = document.getElementsByName('checkent');
            for(var i=0; inputElements[i]; ++i){
                if(inputElements[i].checked){
                    checkedValue = inputElements[i].value;
                    encuesta.push(checkedValue);
                }
            }
            console.log(encuesta);

            if (validarenvio() ){

                $('#divmensj').block({
                    message: '<h1>Cargando ...</h1>',
                    css: { border: '3px solid #a00' }
                });
                $.ajax({
                    url: 'confirmar-ficha',
                    dataType: 'json',
                    type:'GET',
                    data: {webcam : webcam, codigo: codigo, encuesta: encuesta,turno: turno }
                })
                    .done(function(resp) {

                        console.log(resp);

                        if(resp.data=='OK'){
                            location.reload();
                            swal( "FICHA CONFIRMADA" , "", "success");
                        }else {

                            swal( resp.msj , "", "error");
                        }
                        $('#divmensj').unblock();

                    }).fail( function (err) {
                    $('#divmensj').unblock();

                    swal("UPS!!", "Ocurrió un error, intente nuevamente.", "error");

                });


            }




        });


        $( "#btnsendsms" ).click(function() {
            $("#divverifbu").show();
            $("#btnnollega").show();
            $('#divcargui').block({
                message: '<h1>Enviando ...</h1>',
                css: { border: '3px solid #a00' }
            });
            $.ajax({
                url: 'enviar-sms',
                dataType: 'json',
                type:'GET'
            })
                .done(function(resp) {
                    if( resp.data =='OK'){

                        if( resp.envio == 'OK'){
                            swal("MENSAJE ENVIADO", '', "success");
                        }else {
                            swal(resp.msj, '', "error");
                        }

                    }else {
                        swal( resp.msj , "", "error");
                    }

                    $('#divcargui').unblock();

                }).fail( function (err) {
                $('#divcargui').unblock();

                swal("UPS!!", "Ocurrió un error, intente nuevamente.", "error");

            });



        });




    </script>

@stop
@section('title')
    Restriccion de ficha
@stop
