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
                            Debes  <u><strong>confirmar</strong></u> tu correo electrónico.
                        </h2>
                        <div class="actions">
                            {!!Form::back(route('datos.index'))!!}
                        </div>
                        <h2 class="m-portlet__head-label m-portlet__head-label--danger">
                            <span>CONFIMARCIÓN DE EMAIL</span>
                        </h2>
                    </div>
                </div>

            </div>
            <div class="m-portlet__body lead" id="divsucc" style="display:none;">

                <h1 class="text-success"><strong>CORREO ELECTRÓNICO VERIFICADO CORRECTAMENTE.</strong></h1>
                <a href="{{ route('ficha.index') }}" class="btn  m-btn--wide btn-success"> CONFIRMA TU INSCRIPCIÓN AQUÍ</a>
            </div>


            <div class="m-portlet__body lead" id="enviando">
                {!! Alert::render() !!}
                @include('alerts.errors')


                <dl>
                    <dt>Observación</dt>
                    <dt><strong>Para confirmar tu correo primero debes verificar si el correo mostrado es el correcto, si no lo es presiona en <label class="text-danger">Cambiar correo.</label></strong></dt>
                    <dt><strong>Si el correo electrónico es correcto presiona en <label class="text-success">Confirmar Correo</label></strong></dt>
                    <dt><strong>Se te enviará un código de verificación a tu correo electrónico</strong></dt>
                    <dt><strong>Ingresa el código y presiona en <label class="text-success">Confirmar Correo</label> .</strong></dt>
                    <dt><strong>Si el código es correcto tu correo electrónico es válido.</strong></dt>

                </dl> <hr/>
                <div class="row" id="divorig">
                    <div class="col-md-12">
                        {!!Form::hidden('idtipoidentificacion', IdTCCodigo('IDENTIFICACION','DNI') );!!}
                        {!!Form::hidden('numero_identificacion',Auth::user()->dni, ['class'=> 'dni' ,'id'=>'dni'] );!!}

                        <div  class="form-group">
                            <label for="email" class="control-label">
                               Email
                            </label>

                            <h2 id="msjcambio" style="display:none;" class="text-danger">INGRESE EL NUEVO CORREO ELECTRÓNICO:</h2>


                            <div class="controls">
                                <input  readonly="readonly" value="  {{ Auth::user()->email }}" placeholder="Email" maxlength="100" class="form-control border-success" id="email" name="email" type="email" >
                            </div>
                        </div>
                    </div><!--span-->

                    <div class="col-md-12" id="divcodigo" style="display: none;">


                        <div  class="form-group" >
                            <label for="codigo" class="control-label">
                               <strong>INGRESAR CÓDIGO</strong>
                            </label>


                            <div class="controls">
                                <input  placeholder="Código" maxlength="6" class="form-control border-danger" id="codigo" name="codigo" type="text" >
                            </div>
                        </div>
                    </div><!--span-->

                </div>

                <hr/>
                <div class="row">

                    <div class="col-md-4">
                        <button id="cambiaremail" type="button" class="btn btn-danger m-btn m-btn m-btn--icon m-btn--pill">
															<span>
																<i class="la la-save"></i>
																<span>Cambiar Correo</span>
															</span>
                        </button>
                        <button id="actualizaremail" style="display:none;" type="button"
                                class="btn btn-warning m-btn m-btn m-btn--icon m-btn--pill">
															<span>
																<i class="la la-save"></i>
																<span>Actualizar Correo</span>
															</span>
                        </button>



                    </div>
                    <div class="col-md-4">
                        <button id="guardar" type="button" class="btn btn-success m-btn 	m-btn m-btn--icon m-btn--pill">
															<span>
																<i class="la la-save"></i>
																<span>Confirmar Correo</span>
															</span>
                        </button>
                        <button style="display: none;" id="guardarcodigo" type="button" class="btn btn-success m-btn 	m-btn m-btn--icon m-btn--pill">
															<span>
																<i class="la la-save"></i>
																<span>Confirmar Correo</span>
															</span>
                        </button>


                    </div>


                </div>


            </div><!--row-->
        </div>
    </div>

@stop

@section('js-scripts')




    <script>




        $('#guardar').click(function() {
            var idx =  $("#dni").val();
            $('#enviando').block({
                message: '<h1>Enviando ...</h1>',
                css: { border: '3px solid #a00' }
            });
            $.ajax({
                url: 'enviar-email',
                dataType: 'json',
                type:'GET',
                data: {id : idx}
            })
                .done(function(resp) {

                    $('#enviando').unblock();
                    if(resp.data =='OK') {
                        swal("ÉXITO!", "Se envío el código a su correo electrónico. Si no recibe el correo, por favor revise su bandeja de correo no deseado.", "success");

                        $('#divcodigo').show();
                        $('#cambiaremail').hide();
                        $('#guardarcodigo').show();
                        $('#guardar').hide();


                    }else {
                        swal("UPS!!", "Ocurrió un error, intente nuevamente.", "error");
                    }
                }).fail( function (
                    err
            ) {
                $('#enviando').unblock();

                swal("UPS!!", "Ocurrió un error, intente nuevamente.", "error");

            });

        });




        $('#guardarcodigo').click(function() {
            var idx =  $("#dni").val();
            var codd = $("#codigo").val();

            if( codd.length == 6) {
                $('#enviando').block({
                    message: '<h1>Comprobando ...</h1>',
                    css: { border: '3px solid #a00' }
                });

                $.ajax({
                    url: 'enviar-codigo',
                    dataType: 'json',
                    type:'GET',
                    data: {id : idx, codigo: codd}
                })
                    .done(function(resp) {

                        $('#enviando').unblock();
                        if(resp.data =='OK') {
                            swal("ÉXITO!", "SE VERIFICÓ EXITOSAMENTE SU CORREO ELECTRÓNICO", "success");

                            $('#divsucc').show();
                            $('#enviando').hide();



                        }else {
                            if( resp.data == "FALSE"){
                                swal("CÓDIGO INCORRECTO!!", "CÓDIGO INCORRECTO, INTENTE NUEVAMENTE.", "error");
                            }else {

                                swal("ERROR!!", "Ocurrió un error, intente nuevamente.", "error");
                            }

                        }
                    }).fail( function (
                    err
                ) {
                    $('#enviando').unblock();

                    swal("UPS!!", "Ocurrió un error, intente nuevamente.", "error");

                });
            }else {
                swal("CÓDIGO INCORRECTO", "DEBE INGRESAR UN CÓDIGO VÁLIDO.", "error");
            }






        });
        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }
        $('#cambiaremail').click(function() {
            $('#guardar').hide();
            $('#actualizaremail').show();

            $('#msjcambio').show();
            $('#cambiaremail').hide();
            $("#email").attr("readonly", false);



        });
        $('#actualizaremail').click(function() {
            var email = $("#email").val();



            if( isEmail(email) ){
                $('#enviando').block({
                    message: '<h1>Comprobando ...</h1>',
                    css: { border: '3px solid #a00' }
                });
                $.ajax({
                    url: 'check-email',
                    dataType: 'json',
                    type:'GET',
                    data: {email: email}
                })
                    .done(function(resp) {

                        $('#enviando').unblock();
                        if(resp.data =='OK') {
                            swal("ÉXITO!", "SE ACTUALIZÓ SU CORREO ELECTRÓNICO.", "success");

                            $('#guardar').show();
                            $('#actualizaremail').hide();

                            $('#msjcambio').hide();
                            $('#cambiaremail').show();
                            $("#email").attr("readonly", true);
                        }else {
                            if( resp.data == "FALSE"){
                                swal("NO PUEDE USAR ESTE EMAIL!", "EL CORREO ELECTRÓNICO INGRESADO YA EXISTE..", "error");
                            }else {

                                swal("ERROR!!", "Ocurrió un error, intente nuevamente.", "error");
                            }

                        }
                    }).fail( function (
                    err
                ) {
                    $('#enviando').unblock();

                    swal("UPS!!", "Ocurrió un error, intente nuevamente.", "error");

                });



            }else {
                swal("EMAIL INCORRECTO!", "Ingresó un correo electrónico incorrecto, intente nuevamente.", "error");
            }
        });


    </script>

@stop

