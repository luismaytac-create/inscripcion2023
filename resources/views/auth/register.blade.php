@extends('layouts.login')
@section('content')

    <div class="m-stack m-stack--hor m-stack--desktop">
        <div class="m-stack__item m-stack__item--fluid">
            <div class="m-login__wrapper">
                <div class="m-login__logo">
                    <a href="#">
                        <img class="img-fluid" src="{{asset('assets/images/logo-mod-inscripciones.png')}}">
                    </a>
                </div>
                @include('alerts.errors')
                <div class="m-login__signupx">
                    <div class="m-login__head">
                        <h3 class="m-login__title">REGISTRO</h3>
                        <div class="m-login__desc">Ingresa tus datos para crear tu cuenta</div>
                    </div>

                    {!! Form::open(['url'=>'register','method'=>'POST','id'=>'form-register']) !!}

                    <div class="form-group">
                        {!! Form::label('lblDNI', 'Selecciona el tipo de documento ', ['class'=>'bold']) !!}
                        <div class="input-icon right ">

                            <div class="controls">

                                {!! Form::select('tipo_documento', ['1' => 'DNI','3'=>'CARNÉ DE EXTRANJERÍA','4'=>'PTP','5'=>'PASAPORTE', '2' => 'OTRO DOCUMENTO'], null, ['class' => 'form-control','id'=>'tipo_documento']) !!}
                            </div>

                        </div>
                    </div>

                    <div class="form-group ">
                        <strong>{!! Form::label('lblDNI', 'Ingresa tu número de  DNI (no del apoderado)', ['class'=>'bold']) !!}</strong>
                        {!!Form::text('dni',old('dni'), ['class'=>'form-control','placeholder'=>'DNI del postulante','maxlength'=>'8','id'=>'dni'])!!}

                        <em>Este será tu usuario</em>
                    </div>
                    <div class="form-group">
                        {!! Form::label('lblEmail', 'Ingresa tu correo electrónico', []) !!}

                        {!!Form::email('email',null, ['class'=>'form-control','placeholder'=>'Email','id'=>'email'])!!}


                    </div>
                    <div class="form-group">
                        {!! Form::label('lblCelular', 'Ingresa un celular de contacto', []) !!}
                        {!!Form::text('celular',null, ['class'=>'form-control','placeholder'=>'Número de Celular','maxlength'=>'9','id'=>'celular'])!!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('lblPassword', 'Genera tu Clave (mínimo de 6 dígitos)', []) !!}
                        {!!Form::password('password', ['class'=>'form-control','placeholder'=>'Clave','id'=>'password'])!!}
                    </div>
                    <div class="form-group ">
                        {!! Form::label('lblPassword2', 'Ingresa nuevamente tu Clave', []) !!}
                        {!!Form::password('password_confirmation', ['class'=>'form-control','placeholder'=>'Repite tu Clave','id'=>'repassword'])!!}
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

                        <a href="{{url('/login')}}" class="btn m-btn--pill btn-danger m-btn--wide">Cancelar</a>
                    </div>


                    {!! Form::close() !!}
                </div>


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

                        <label><strong></strong> La participación de un postulante en el Concurso de Admisión, significa la total aceptación y sujeción al presente Reglamento. </label>
                        <label><strong></strong> Los pagos realizados a favor de la Universidad por los conceptos establecidos en el Concurso de Admisión, se realizan en las entidades financieras que la Universidad autorice. Los pagos efectuados no serán reembolsados.  </label>
                        <label>


                            <strong></strong> No se admitirá como postulante a quien haya sido sancionado por medida disciplinaria en alguna universidad del país o del extranjero.
                        </label>


                        <label>
                            <strong></strong>

                            El postulante que, en cualquier forma, atente contra el orden o el patrimonio de
                            la UNI, que falte a la verdad en la información registrada durante su inscripción o que
                            participe en la comisión del delito de suplantación o fraude o que se le detecte equipos
                            eléctronicos de almacenamiento, transmisión o recepción de datos, será separado del
                            Concurso de Admisión o perderá la vacante de ingreso obtenida y será inhabilitado
                            definitivamente para postular a la UNI en futuros Concursos de Admisión, sin perjuicio de
                            las acciones legales que pudieran corresponder.
                        </label>

                        <label>
                            <strong></strong>

                            Serán considerados postulantes en el Concurso de Admisión a la UNI quienes
                            cumplan con los siguientes requisitos:
                            Haber culminado los estudios secundarios (de Educación Básica Regular [EBR] o de
                            Educación Básica Alternativa [EBA]) en el país o su equivalente en el extranjero y
                            deseen iniciar o continuar estudios universitarios. También, quienes, habiendo culminado sus estudios
                            universitarios en la UNI o en otra universidad, y deseen estudiar otra carrera
                            profesional.

                        </label>
                        <label>
                            <strong> Acepto recibir información y publicidad en los medios de contacto registrados en mi inscripción.</strong>
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


        function validateTerminos() {

            var respuesta = $("#respuesta_postulante").val();

            if( respuesta == 'SI') {
                return true;
            }else {
                return false;
            }


        }


        function validateEmail() {
            var email = $("#email").val();
            if( email.length<1 ){
                swal("INGRESAR EMAIL ", "Debe Ingresar su correo electrónico.", "error");
                return false;
            }else {

                var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);

            }

        }

        function validateCelular() {
            var celular = $("#celular").val();

            if( celular.length == 9 ) {
                return true;
            }else {
                    if( celular.length>0) {
                        swal("CELULAR INVÁLIDO", "Ingresa un número celular válido.", "error");
                    }else {
                        swal("INGRESA TU CELULAR", "Ingresa tu número celular.", "error");
                    }




                return false;
            }


        }
        function  validateCaptcha() {

            var captcha = $("#captcha").val();

            if( captcha.length>0 ){
                return true;
            }else {
                swal("COMPLETAR CAPTCHA", "Debe completar el captcha.", "error");
            }

        }



        function validarRegister() {

            var valido = true;

             //Validar DNI


            if(!validateCaptcha()) {
                valido= false;
            }






            if( !checkPassword()) {
                valido= false;
            }

            if( !validateCelular()) {

                valido = false;
            }

            if(! validateEmail()) {
                swal("EMAIL INVÁLIDO", "Ingresa un correo electrónico válido.", "error");
                valido = false;
            }
            if(!validarDni() ) {



                valido = false;

            }

            if( valido ){
                $('#m_modal_6').modal({
                 keyboard: false,
                 backdrop: 'static'
             });


            }


            
        }

        function checkPassword() {
            password1 = $("#password").val();
            password2 = $("#repassword").val();


            if( password1.length >=6 ) {


                if (password1 == '') {
                    swal("CONTRASEÑA OBLIGATORIA", "Ingresa tu contraseña", "error");
                    return false;


                } else if (password2 == '') {

                    swal("CONTRASEÑA OBLIGATORIA", "Ingresa nuevamente tu contraseña.", "error");
                    return false;

                } if (password1 != password2) {
                    swal("ERROR EN CONTRASEÑA ", "LAS CONTRASEÑAS NO COINCIDEN, VUELVE A INGRESAR LA CONTRASEÑA.", "error");
                    return false;
                }


                else {

                    return true;
                }

            }else {
                swal("CONTRASEÑA OBLIGATORIA", "Ingresa como mínimo 6 dígitos.", "error");
                return false;

            }
        }
        function validarDni() {

            var tipoDoc= $('#tipo_documento').val();



            if( tipoDoc == "1" ) {
               var londni = $("#dni").val().length;

                if( londni == 8 ) {
                    return true;
                }else {

                    if( londni > 0 ) {
                        swal("DNI INVÁLIDO", "Ingresa tu Número de DNI válido.", "error");
                    }else {
                        swal("INGRESA TU DNI", "Ingresa tu Número de DNI.", "error");
                    }


                    return false;
                }

            }else {

                var londni2 = $("#dni").val().length;

                if( londni2 < 9 ) {

                    if( londni2 > 0 ) {
                        swal("DNI INVÁLIDO", "Ingresa tu Número de DNI válido.", "error");
                    }else {
                        swal("INGRESA TU DNI", "Ingresa tu Número de DNI.", "error");
                    }

                    return false;
                }else {
                    return true;
                }
            }

        }
        
        
        
        
        

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


            validarRegister();




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






        $('#form-register').on('submit',function(event){

            event.preventDefault();


            var value= $("#respuesta_postulante").val();

            if(value =="SI" ){


                $("#respuesta").val(value);
                event.currentTarget.submit();

            }else {
                swal("TÉRMINOS Y CONDICIONES", "Debe aceptar los términos y condiciones.", "error");
            }


        });




    </script>
@stop