<!DOCTYPE html>
<html lang="es">

<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>@yield('title','Concurso de Admisión | Universidad Nacional de Ingenieria') </title>
    <meta name="description" content="Admisión UNI | Universidad Nacional de Ingeniería | Concurso de Admisión UNI ">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--end::Web font -->

    <!--begin:: Global Mandatory Vendors -->
    <link href="{{asset('vendors/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css" />

    <!--end:: Global Mandatory Vendors -->

    <!--begin:: Global Optional Vendors -->
    <link href="{{asset('vendors/tether/dist/css/tether.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/bootstrap-datetime-picker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/bootstrap-select/dist/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/select2/dist/css/select2.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/nouislider/distribute/nouislider.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/owl.carousel/dist/assets/owl.carousel.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/owl.carousel/dist/assets/owl.theme.default.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/ion-rangeslider/css/ion.rangeSlider.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/ion-rangeslider/css/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/dropzone/dist/dropzone.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/summernote/dist/summernote.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/bootstrap-markdown/css/bootstrap-markdown.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/animate.css/animate.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/toastr/build/toastr.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/jstree/dist/themes/default/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/morris.js/morris.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/chartist/dist/chartist.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/socicon/css/socicon.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/vendors/line-awesome/css/line-awesome.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/vendors/flaticon/css/flaticon.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/vendors/metronic/css/styles.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/vendors/fontawesome5/css/all.min.css')}}" rel="stylesheet" type="text/css" />

    <!--end:: Global Optional Vendors -->

    <!--begin::Global Theme Styles -->


    <link href="{{asset('assets5/assets/demo/base/style.bundle.css')}}" rel="stylesheet" type="text/css" />




    <!--RTL version:<link href="assets/demo/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

    <!--end::Global Theme Styles -->

    <!--begin::Page Vendors Styles -->

    <link href="{{asset('assets5/assets/vendors/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />


    <!--RTL version:<link href="assets/vendors/custom/fullcalendar/fullcalendar.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

    <link href="{{asset('js/fileinput.min.css')}}" rel="stylesheet" type="text/css" />



    <!--end::Page Vendors Styles -->
    <link rel="shortcut icon" href="favicon.ico" />
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="m-page--wide m-header--fixed m-header--fixed-mobile m-footer--push m-aside--offcanvas-default">

<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">

    <!-- begin::Header -->
    <header id="m_header" class="m-grid__item		m-header " m-minimize="minimize" m-minimize-offset="200" m-minimize-mobile-offset="200">
        <div class="m-header__top">
            <div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
                <div class="m-stack m-stack--ver m-stack--desktop">

                    <!-- begin::Brand -->
                    <div class="m-stack__item m-brand">
                        <div class="m-stack m-stack--ver m-stack--general m-stack--inline">
                            <div class="m-stack__item m-stack__item--middle m-brand__logo">
                                <a href="{{ url('/') }}" class="m-brand__logo-wrapper">
                                    <img alt="" src="{{asset('assets5/assets/demo/media/img/logo/logo-diad-8.png')}}" />
                                </a>
                            </div>
                            


                            <div class="m-stack__item m-stack__item--middle m-brand__tools">
                                <!-- begin::Responsive Header Menu Toggler-->
                                <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                                    <span></span>
                                </a>

                                <!-- end::Responsive Header Menu Toggler-->

                                <!-- begin::Topbar Toggler-->
                                <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                    <i class="flaticon-more"></i>
                                </a>

                                <!--end::Topbar Toggler-->


                            </div>
                        </div>
                    </div>

                    <!-- end::Brand -->
                    
                    <!-- begin::Topbar -->

                    @include('layouts.partials.template-header')
                    <!-- end::Topbar -->
                </div>
            </div>
        </div>
        <div class="m-header__bottom" style="background: #761607;">
            <div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
                <div class="m-stack m-stack--ver m-stack--desktop">

                    <!-- begin::Horizontal Menu -->
                    <div class="m-stack__item m-stack__item--middle m-stack__item--fluid">
                        <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light " id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
                        <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light ">
                            <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                                <li class="m-menu__item  m-menu__item--active " aria-haspopup="true"><a href="{{ url('/') }}" class="m-menu__link "><span class="m-menu__item-here"></span><span class="m-menu__link-text">Inicio</span></a></li>

                                <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link">
                                        <span class="m-menu__item-here"></span><span
                                                class="m-menu__link-text">Datos</span><i class="m-menu__hor-arrow la la-angle-down"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left"><span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                        <ul class="m-menu__subnav">
                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="{{ route('datos.postulante.index') }}" class="m-menu__link "><i class="m-menu__link-icon flaticon-users"></i><span class="m-menu__link-text">Pre Inscripción</span></a></li>
                                            @if ($swp)
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="{{ route('datos.secundarios.index') }}" class="m-menu__link "><i class="m-menu__link-icon flaticon-users"></i><span class="m-menu__link-text">Personales</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="{{ route('datos.familiares.index') }}" class="m-menu__link "><i class="m-menu__link-icon flaticon-users"></i><span class="m-menu__link-text">Familiares</span></a></li>

                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="{{ route('datos.complementarios.index') }}" class="m-menu__link "><i class="m-menu__link-icon flaticon-users"></i><span class="m-menu__link-text">Complementarios</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="{{ route('datos.foto.foto') }}" class="m-menu__link "><i class="m-menu__link-icon flaticon-users"></i><span class="m-menu__link-text">Foto y DNI</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="{{ route('declaracion.index') }}" class="m-menu__link "><i class="m-menu__link-icon flaticon-users"></i><span class="m-menu__link-text">Declaración Jurada</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="{{ route('documentos.index') }}" class="m-menu__link "><i class="m-menu__link-icon flaticon-users"></i><span class="m-menu__link-text">Documentos</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="{{ route('email.index') }}" class="m-menu__link "><i class="m-menu__link-icon flaticon-users"></i><span class="m-menu__link-text">Confirmar Email</span></a></li>

                                            @endif


                                        </ul>
                                    </div>
                                </li>
                                <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link"><span
                                                class="m-menu__item-here"></span><span class="m-menu__link-text">Prospecto</span><i class="m-menu__hor-arrow la la-angle-down"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="m-menu__submenu  m-menu__submenu--fixed m-menu__submenu--left" style="width:600px"><span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                        <div class="m-menu__subnav">
                                            <ul class="m-menu__content">
                                                <li class="m-menu__item">
                                                    <h3 class="m-menu__heading m-menu__toggle"><span class="m-menu__link-text">Prospecto</span><i class="m-menu__ver-arrow la la-angle-right"></i></h3>
                                                    <ul class="m-menu__inner">

                                                        <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="{{ route('reglamento.index') }}" class="m-menu__link "><i class="m-menu__link-icon flaticon-clipboard"></i><span class="m-menu__link-text">Descargar</span></a></li>

                                                    </ul>
                                                </li>
                                                <li class="m-menu__item">
                                                    <h3 class="m-menu__heading m-menu__toggle"><span class="m-menu__link-text">Contiene:</span><i class="m-menu__ver-arrow la la-angle-right"></i></h3>
                                                    <ul class="m-menu__inner">
                                                        <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">Reglamento</span></a></li>
                                                        <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">Guía de Carreras</span></a></li>
                                                        <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">Solucionario</span></a></li>
                                                        <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">Guía de Inscripción</span></a></li>
                                                        <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">Temario</span></a></li>

                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                    <a href="javascript:;" class="m-menu__link m-menu__toggle" title="Pagos"><span
                                                class="m-menu__item-here"></span><span class="m-menu__link-text">Pagos</span><i class="m-menu__hor-arrow la la-angle-down"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="m-menu__submenu  m-menu__submenu--fixed m-menu__submenu--left" style="width:600px"><span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                        <div class="m-menu__subnav">
                                            <ul class="m-menu__content">
                                                <li class="m-menu__item">
                                                    <h3 class="m-menu__heading m-menu__toggle"><span class="m-menu__link-text">Pagos</span><i class="m-menu__ver-arrow la la-angle-right"></i></h3>
                                                    <ul class="m-menu__inner">

                                                        <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="{{ route('pagos.index') }}" class="m-menu__link "><i class="m-menu__link-icon flaticon-piggy-bank"></i><span class="m-menu__link-text">Prospecto</span></a></li>
                                                        <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="{{ route('pagos.index') }}" class="m-menu__link "><i class="m-menu__link-icon flaticon-coins"></i><span class="m-menu__link-text">Derecho de inscripción</span></a></li>


                                                    </ul>
                                                </li>
                                                <li class="m-menu__item">
                                                    <h3 class="m-menu__heading m-menu__toggle"><span class="m-menu__link-text">Bancos:</span><i class="m-menu__ver-arrow la la-angle-right"></i></h3>
                                                    <ul class="m-menu__inner">
                                                        <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">BCP</span></a></li>
                                                        <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">Scotiabank</span></a></li>

                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="m-menu__item" aria-haspopup="true"><a href="{{ route('ficha.index') }}" class="m-menu__link "><span class="m-menu__item-here"></span><span class="m-menu__link-text">Ficha</span></a></li>


                            </ul>
                        </div>
                    </div>

                    <!-- end::Horizontal Menu -->


                </div>
            </div>
        </div>
    </header>

    <!-- end::Header -->

    <!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop 	m-container m-container--responsive m-container--xxl m-page__container m-body">
        <div class="m-grid__item m-grid__item--fluid m-wrapper">


            @yield('content')


        </div>
    </div>

    <!-- end::Body -->

    <!-- begin::Footer -->
    <footer class="m-grid__item m-footer ">
        <div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
            <div class="m-footer__wrapper">
                <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
                    <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
								<span class="m-footer__copyright">
									2023 &copy; Admisión - UNI |  <a target="_blank" href="http://www.admision.uni.edu.pe" class="m-link">Universidad Nacional de Ingeniería</a>
								</span>
                    </div>
                    <div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
                        <ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
                            <li class="m-nav__item">
                                <a target="_blank" href="http://www.admision.uni.edu.pe/" class="m-nav__link">
                                    <span class="m-nav__link-text">ADMISIÓN UNI</span>
                                </a>
                            </li>
                            <li class="m-nav__item">
                                <a target="_blank" href="http://admision.uni.edu.pe/" class="m-nav__link">
                                    <span class="m-nav__link-text">Tarifario</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- end::Footer -->
</div>

<!-- end:: Page -->


<!-- begin::Scroll Top -->
<div id="m_scroll_top" class="m-scroll-top">
    <i class="la la-arrow-up"></i>
</div>

<!-- end::Scroll Top -->



<!--begin:: Global Mandatory Vendors -->
<script src="{{asset('vendors/jquery/dist/jquery.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/popper.js/dist/umd/popper.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/js-cookie/src/js.cookie.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/moment/min/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/tooltip.js/dist/umd/tooltip.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/perfect-scrollbar/dist/perfect-scrollbar.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/wnumb/wNumb.js')}}" type="text/javascript"></script>


<!--end:: Global Mandatory Vendors -->

<!--begin:: Global Optional Vendors -->

<script src="{{asset('vendors/jquery.repeater/src/lib.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/jquery.repeater/src/jquery.input.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/jquery.repeater/src/repeater.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/jquery-form/dist/jquery.form.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/block-ui/jquery.blockUI.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/js/framework/components/plugins/forms/bootstrap-datepicker.init.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/js/framework/components/plugins/forms/bootstrap-timepicker.init.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/js/framework/components/plugins/forms/bootstrap-daterangepicker.init.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-maxlength/src/bootstrap-maxlength.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-switch/dist/js/bootstrap-switch.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/js/framework/components/plugins/forms/bootstrap-switch.init.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/vendors/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-select/dist/js/bootstrap-select.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/select2/dist/js/select2.full.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/typeahead.js/dist/typeahead.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/handlebars/dist/handlebars.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/inputmask/dist/jquery.inputmask.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/inputmask/dist/inputmask/inputmask.date.extensions.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/inputmask/dist/inputmask/inputmask.numeric.extensions.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/inputmask/dist/inputmask/inputmask.phone.extensions.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/nouislider/distribute/nouislider.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/owl.carousel/dist/owl.carousel.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/autosize/dist/autosize.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/clipboard/dist/clipboard.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/ion-rangeslider/js/ion.rangeSlider.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/dropzone/dist/dropzone.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/summernote/dist/summernote.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/markdown/lib/markdown.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-markdown/js/bootstrap-markdown.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/js/framework/components/plugins/forms/bootstrap-markdown.init.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/jquery-validation/dist/jquery.validate.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/jquery-validation/dist/additional-methods.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/js/framework/components/plugins/forms/jquery-validation.init.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-notify/bootstrap-notify.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/js/framework/components/plugins/base/bootstrap-notify.init.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/toastr/build/toastr.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/jstree/dist/jstree.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/raphael/raphael.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/morris.js/morris.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/chartist/dist/chartist.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/chart.js/dist/Chart.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/js/framework/components/plugins/charts/chart.init.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/vendors/jquery-idletimer/idle-timer.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/waypoints/lib/jquery.waypoints.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/counterup/jquery.counterup.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/es6-promise-polyfill/promise.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/sweetalert2/dist/sweetalert2.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/js/framework/components/plugins/base/sweetalert2.init.js')}}" type="text/javascript"></script>


<!--end:: Global Optional Vendors -->

<!--begin::Global Theme Bundle -->
<script src="{{asset('assets5/assets/demo/base/scripts.bundle.js')}}" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<!--begin::Page Vendors -->
<script src="{{asset('assets5/assets/vendors/custom/fullcalendar/fullcalendar.bundle.js')}}" type="text/javascript"></script>
<!--end::Page Vendors -->

<!--begin::Page Scripts -->
<script src="{{asset('assets5/assets/app/js/dashboard.js')}}" type="text/javascript"></script>
<!--end::Page Scripts -->

@yield('js-scripts')
</body>

<!-- end::Body -->
</html>