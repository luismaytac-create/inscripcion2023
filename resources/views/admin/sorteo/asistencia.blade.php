<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>OFICINA CENTRAL DE ADMISIÓN - UNI</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />

    <meta content="OFICINA CENTRAL DE ADMISION - OCAD" name="author" />

    {!! Html::style('assets/vendors/base/vendors.bundle.css') !!}
    {!! Html::style('assets/demo/default/base/style.bundle.css') !!}

    <link rel="shortcut icon" href="{!! asset('favicon.ico') !!}" /> </head>
<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
<script>
    WebFont.load({
        google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
        active: function() {
            sessionStorage.fonts = true;
        }
    });
</script>
<body  class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile m-login m-login--1 m-login--signin" id="m_login">
        <div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
            <div class="m-stack m-stack--hor m-stack--desktop">
                <div class="m-stack__item m-stack__item--fluid">
                    <div class="m-login__wrapper">
                        <div class="m-login__logo">
                            <a href="#">
                                <img class="img-fluid" src="{{ asset('assets/app/media/img//logos/OCAD-logo-granate.png') }}" >
                            </a>
                        </div>
                        <div class="m-login__signin">
                            <div class="m-login__head">
                                <h3 class="m-login__title">
                                    REGISTRO DE ASISTENCIA
                                </h3>
                            </div>
                            <div class="m-login__form m-form" action="">
                                <div class="form-group m-form__group">
                                    <input maxlength="15" class="form-control m-input" type="text" id="dnitext" placeholder="INGRESE NÚMERO DE DNI" name="dni" autocomplete="off" >
                                </div>

                                <div class="row m-login__form-sub">


                                </div>
                                <div class="m-login__form-action">
                                    <button type="button" id="registoasis" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
                                        REGISTRAR
                                    </button>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="m-stack__item m-stack__item--center">
                    <div class="m-login__account">
								<span class="m-login__account-msg">
									OFICINA CENTRAL DE ADMISIÓN
								</span>

                    </div>
                </div>
            </div>
        </div>

        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1	m-login__content" style="background-image: url({{ asset('assets/app/media/img//bg/bg-4.jpg') }})">
            <div class="m-grid__item m-grid__item--middle">
                <h3 class="m-login__welcome">
                    BIENVENIDO
                    <br>
                    <span style="color:#00bcd2;" id="dnisis"> </span>
                    <br>
                    A LA CEREMONIA DE BIENVENIDA Y PREMIACIÓN
                </h3>

            </div>
        </div>
    </div>
</div>
<!-- end:: Page -->
<!--begin::Base Scripts -->
{!! Html::script('assets/vendors/base/vendors.bundle.js') !!}
{!! Html::script('assets/demo/default/base/scripts.bundle.js') !!}

<!--end::Page Snippets -->

<script>
    $(document).keypress(function(e) {
        if(e.which == 13) {
            var dni = $("#dnitext").val();
            $("#dnisis").text(dni);
            $("#dnitext").val('');
            $("#dnitext").focus();



            $.ajax({
                type: "POST",
                url: 'save-asistencia',
                dataType: 'json',

                data: {dni: dni, "_token": "{{ csrf_token() }}"},
            })
                .done(function(resuls) {


                    $("#dnisis").text(resuls.data);


                }).fail(function() {
                alert( "ERROR EN EL SERVIDOR , VUELVA A INGRESAR EL DNI." );
            });





        }
    });



    $("#registoasis").click(function(event) {
        var dni = $("#dnitext").val();
        $("#dnisis").text(dni);
        $("#dnitext").val('');
        $("#dnitext").focus();



        $.ajax({
            type: "POST",
            url: 'save-asistencia',
            dataType: 'json',

            data: {dni: dni, "_token": "{{ csrf_token() }}"},
        })
            .done(function(resuls) {


                $("#dnisis").text(resuls.data);


            }).fail(function() {
            alert( "ERROR EN EL SERVIDOR , VUELVA A INGRESAR EL DNI." );
        });


    });
</script>
</body>

</html>