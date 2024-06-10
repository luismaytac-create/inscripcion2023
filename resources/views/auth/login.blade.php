@extends('layouts.login')
@section('content')

    <div class="m-stack m-stack--hor m-stack--desktop ">
        <div class="m-stack__item m-stack__item--fluid">
            <div class="m-login__wrapper" style="padding: 30% 0rem 0rem 0rem">
                <div class="m-login__logo">

                        <img class="img-fluid m-lg-25"  src="{{asset('assets/images/logo-mod-inscripciones.png')}}">

                </div>
                <div class="m-login__signin">
                    <div class="m-login__head">
                        <h1 class="m-login__title ">CONCURSO DE ADMISIÓN 2024-2</h1>
                        <h3 class="m-login__title ">INGRESA A TU CUENTA</h3>
                    </div>
                    @include('alerts.errors')
                    {!! Alert::render() !!}
                    {!! Form::open(['url'=>'login','method'=>'POST','class'=>'m-login__form m-form']) !!}
                    <div class="form-group m-form__group">
                        {!! Form::label('lblDNI', 'Selecciona el tipo de documento ', ['class'=>'bold']) !!}
                        <div class="input-icon right ">

                            <div class="controls">

                                {!! Form::select('tipo_documento_log', ['1' => 'DNI','3'=>'CARNÉ DE EXTRANJERÍA','4'=>'PTP','5'=>'PASAPORTE', '2' => 'OTRO DOCUMENTO'], null, ['class' => 'form-control','id'=>'tipo_documento_log']) !!}
                            </div>

                        </div>
                    </div>


                    <div class="form-group m-form__group">
                         
                        <input class="form-control m-input" type="text" placeholder="Tu usuario (Nro. de documento)" name="dni" autocomplete="off" maxlength="8" id="dni_log">
                    </div>
                    <div class="form-group m-form__group">
                        
                        <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Contraseña" name="password">
                    </div>

                    <div class="m-login__form-action">
                        <button type="submit" id="m_login_signin_submit" style="background: #761607; color: #f0f1f6;" class="btn m-btn--pill btn-secondary m--icon-font-size-lg1">Ingresar</button>

                    </div>

                    {!! Form::close() !!}


<br>
                    <div class="m-stack__item m-stack__item--center">
                        <div class="m-login__account">
								<span class="m-login__account-msg m--icon-font-size-lg1">
									¿No tienes cuenta?
								</span>&nbsp;&nbsp;
                            <a href="{{url('/register')}}"  class="btn btn-outline-focus m-btn--pill btn-secondary m--icon-font-size-lg1" style="background: #761607; color: #f0f1f6;">REGÍSTRATE</a>
                        </div>
                    </div>



                    <br>
                    <br>

                    <div class="row m-login__form-sub">

                        <div class="col m--align-right">
                            <a href="{{url('/password/reset')}}"  class="m-link m--icon-font-size-lg2">¿Olvidaste tu contraseña?</a>
                        </div>
                    </div>
                </div>
                <div class="m-login__signup">
                    <div class="m-login__head">
                        <h3 class="m-login__title">REGISTRO</h3>
                        <div class="m-login__desc">Ingresa tus datos para ingresar al sistema</div>
                    </div>

                    {!! Form::open(['url'=>'register','method'=>'POST','id'=>'form-register']) !!}

                    <div class="form-group">
                        {!! Form::label('lblDNI', 'Selecciona el tipo de documento ', ['class'=>'bold']) !!}
                        <div class="input-icon right ">

                            <div class="controls">

                                {!! Form::select('tipo_documento', ['1' => 'DNI', '2' => 'OTRO DOCUMENTO'], null, ['class' => 'form-control','id'=>'tipo_documento']) !!}
                            </div>

                        </div>
                    </div>

                    <div class="form-group ">
                        <strong>{!! Form::label('lblDNI', 'Ingresa tu número de  DNI (no del apoderado)', ['class'=>'bold']) !!}</strong>
                        {!!Form::text('dni',old('dni'), ['class'=>'form-control','placeholder'=>'DNI del postulante','maxlength'=>'8','id'=>'dni'])!!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('lblEmail', 'Ingresa tu correo electrónico', []) !!}

                        {!!Form::email('email',null, ['class'=>'form-control','placeholder'=>'Email'])!!}


                    </div>
                    <div class="form-group">
                        {!! Form::label('lblEmail', 'Ingresa un celular de contacto', []) !!}
                        {!!Form::text('celular',null, ['class'=>'form-control','placeholder'=>'Número de Celular','maxlength'=>'9'])!!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('lblPassword', 'Genera tu Clave (mínimo de 6 dígitos)', []) !!}
                        {!!Form::password('password', ['class'=>'form-control','placeholder'=>'Clave'])!!}
                    </div>
                    <div class="form-group ">
                        {!! Form::label('lblPassword2', 'Ingresa nuevamente tu Clave', []) !!}
                        {!!Form::password('password_confirmation', ['class'=>'form-control','placeholder'=>'Repite tu Clave'])!!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('captcha', 'Ingresa el texto de la Imagen', []) !!}
                        <div class="captcha">
                            <span > {!! captcha_img() !!}</span>
                            <button type="button" class="btn btn-succes btn-refresh">Cambiar</button>
                        </div>
                        <input type="text" id="captcha" class="form-control" placeholder="Ingresa el texto de la Imagen"  name ="captcha"/>
                    </div>

                    <input type="hidden" id="respuesta" name="respuesta"/>


                    <div class="m-login__form-action">
                        <button type="button" id="show_modal" class="btn m-btn--pill btn-success m-btn--wide">Registrarme</button>
                        <button id="m_login_signup_cancel" class="btn m-btn--pill btn-danger m-btn--wide">Cancelar</button>
                    </div>







                    {!! Form::close() !!}
                </div>

                {!! Form::open(['url'=>'/password/email','method'=>'POST','id'=>'form-login']) !!}

                <div class="m-login__forget-password">
                    <div class="m-login__head">
                        <h3 class="m-login__title">¿Olvidastes tu Contraseña?</h3>
                        <div class="m-login__desc">Ingresa tu email registrado:</div>
                        <b class="text:"> Esta recuperación solo funciona si has registrado tu email .</b>
                    </div>
                    <form class="m-login__form m-form" action="">
                        <div class="form-group m-form__group">
                            <input id="email" type="email" class="form-control" placeholder="EMAIL" name="email" value="{{ old('email') }}" required>
                        </div>
                        @if ($errors->has('email'))
                            <span class="m--font-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                        @endif
                        <div class="m-login__form-action">
                            <button type="submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">Enviar EMAIL</button>
                            <button id="m_login_forget_password_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom">Cancelar</button>
                        </div>
                    </form>
                </div>

                {!! Form::close() !!}
            </div>
        </div>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="m_modal_6" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Términos y Condiciones</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="form-group">


                        <label class="bold">Declaro bajo juramento haber leído los siguientes enunciados, aceptándolos y sometiéndome a todo lo estipulado: </label>

                        <label><strong>Art. 4º.-</strong> La participación de un postulante en el Concurso de Admisión, significa la total aceptación y sujeción al presente Reglamento. </label>
                        <label><strong>Art. 13º.-</strong> Los pagos realizados a favor de la Universidad por los conceptos establecidos en el Concurso de Admisión, se realizan en las entidades financieras que la Universidad autorice. Los pagos efectuados no serán reembolsados.  </label>
                        <label>


                            <strong>Art. 18º.-</strong> No se admitirá como postulante a quien haya sido sancionado por medida disciplinaria en alguna universidad del país o del extranjero.
                        </label>


                        <label>
                            <strong>  Art. 19º.-</strong>

                            El postulante que, en cualquier forma, atente contra el orden o el patrimonio de
                            la UNI, que falte a la verdad en la información registrada durante su inscripción o que
                            participe en la comisión del delito de suplantación o fraude o que se le detecte equipos
                            eléctronicos de almacenamiento, transmisión o recepción de datos, será separado del
                            Concurso de Admisión o perderá la vacante de ingreso obtenida y será inhabilitado
                            definitivamente para postular a la UNI en futuros Concursos de Admisión, sin perjuicio de
                            las acciones legales que pudieran corresponder.
                        </label>

                        <label>
                            <strong>Art. 36°.-</strong>

                            Serán considerados postulantes en el Concurso de Admisión a la UNI quienes
                            cumplan con los siguientes requisitos:
                            Haber culminado los estudios secundarios (de Educación Básica Regular [EBR] o de
                            Educación Básica Alternativa [EBA]) en el país o su equivalente en el extranjero y
                            deseen iniciar o continuar estudios universitarios. Para el caso IEN-UNI, según lo
                            establecido en su modalidad. También, quienes, habiendo culminado sus estudios
                            universitarios en la UNI o en otra universidad, y deseen estudiar otra carrera
                            profesional.

                        </label>

                        <div class="input-icon right ">

                            <div class="controls">

                                {!! Form::select('respuesta_postulante', [''=>'¿Aceptas los términos y condiciones?','SI' => 'SÍ', 'NO' => 'NO'], null, ['class' => 'form-control','id'=>'respuesta_postulante', 'required'=>'required']) !!}
                            </div>

                        </div>





                    </div>




                </div>
                <div class="modal-footer">
                    <button type="submit" id="m_login_signup_submit" class="btn btn-primary btn-focus m-btn m-btn--pill m-btn--custom m-btn--air" form="form-register">Registrar</button>

                </div>
            </div>
        </div>
    </div>

    <!--end::Modal-->
@stop

@section('js-scripts')
    <script>

        var p= $('#tipo_documento').val();

        if(p=="1"){
            $("#dni").attr('maxlength','8');

            var po=$("#dni").val().length;
            if(po>8){


                var res = $("#dni").val().substring(0, 8);
                $("#dni").val(res);



            }



        }else {
            $("#dni").attr('maxlength','12');
        }





        $('#tipo_documento').on('change', function() {

            var p= $('#tipo_documento').val();

            if(p=="1"){
                $("#dni").attr('maxlength','8');

                var po=$("#dni").val().length;
                if(po>8){


                    var res = $("#dni").val().substring(0, 8);
                    $("#dni").val(res);



                }



            }else {
                $("#dni").attr('maxlength','12');
            }

        });

        $('#tipo_documento_log').on('change', function() {

            var p= $('#tipo_documento_log').val();

            if(p=="1"){
                $("#dni_log").attr('maxlength','8');

                var po=$("#dni_log").val().length;
                if(po>8){


                    var res = $("#dni_log").val().substring(0, 8);
                    $("#dni_log").val(res);



                }



            }else {
                $("#dni_log").attr('maxlength','12');
            }

        });

        $('#show_modal').click(function() {
            $('#m_modal_6').modal({
                keyboard: false,
                backdrop: 'static'
            });

        });



        $('.btn-refresh').click(function() {
            $.ajax({
                type: 'GET',
                url: 'refresh_captcha',
                success: function(data){
                    $(".captcha span").html(data.captcha);
                }
            });
        });


        $('#m_login_signup_submit').click(function(e) {
            // e.preventDefault();




        });



        $('#form-register').on('submit',function(event){

            event.preventDefault();


            var value= $("#respuesta_postulante").val();

            if(value =="SI" || value=="NO"){


                $("#respuesta").val(value);
                event.currentTarget.submit();

            }else {

            }


        });




    </script>
@stop