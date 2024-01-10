<!DOCTYPE html>

<html lang="en" >
<!-- begin::Head -->
<head>
	<meta charset="utf-8" />
	<title>
		OFICINA CENTRAL DE ADMISIÓN
	</title>
	<meta name="description" content="Latest updates and statistic charts">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!--begin::Web font -->
	<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700","Asap+Condensed:500"]},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	<!--end::Web font -->
	<!--begin::Base Styles -->
	<!--begin::Page Vendors -->




	<!--end::Page Vendors -->



{!! Html::style('assets/demo8/vendors/custom/fullcalendar/fullcalendar.bundle.css') !!}

{!! Html::style('assets/demo8/vendors/base/vendors.bundle.css') !!}
{!! Html::style('assets/demo8/demo/demo8/base/style.bundle.css') !!}



<!--end::Base Styles -->
	<link rel="shortcut icon" href="/assets/demo8/demo/media/img/logo/favicon.ico" />
</head>
<!-- end::Head -->
<!-- end::Body -->
<body  style="background-image: url(/assets/app/media/img/bg/bg-7.jpg)"  class="m-page--fluid m-page--loading-enabled m-page--loading m-header--fixed m-header--fixed-mobile m-footer--push m-aside--offcanvas-default"  >
<!-- begin::Page loader -->
<div class="m-page-loader m-page-loader--base">
	<div class="m-blockui">
				<span>
					Please wait...
				</span>
		<span>
					<div class="m-loader m-loader--brand"></div>
				</span>
	</div>
</div>
<!-- end::Page Loader -->
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
	<!-- begin::Header -->
	<header id="m_header" class="m-grid__item		m-header "  m-minimize="minimize" m-minimize-mobile="minimize" m-minimize-offset="10" m-minimize-mobile-offset="10" >
		<div class="m-header__top">
			<div class="m-container m-container--fluid m-container--full-height m-page__container">
				<div class="m-stack m-stack--ver m-stack--desktop">
					<!-- begin::Brand -->
					<div class="m-stack__item m-brand m-stack__item--left">
						<div class="m-stack m-stack--ver m-stack--general m-stack--inline">
							<div class="m-stack__item m-stack__item--middle m-brand__logo">
								<a href="index.html" class="m-brand__logo-wrapper">
									<img alt="" height="70"  src="{{ asset('assets/demo8/demo/demo8/media/img/logo/OCAD-logo-blanco.png') }}" src="" class="m-brand__logo-default"/>
									<img alt="" height="70" src="{{ asset('assets/demo8/demo/demo8/media/img/logo/OCAD-logo-granate.png') }}" class="m-brand__logo-inverse"/>
								</a>
							</div>

						</div>
					</div>
					<!-- end::Brand -->
					<!--begin::Search-->


				</div>
			</div>
		</div>
		<div class="m-header__bottom">
			<div class="m-container m-container--fluid m-container--full-height m-page__container">
				<div class="m-stack m-stack--ver m-stack--desktop">
					<!-- begin::Horizontal Menu -->
					<div class="m-stack__item m-stack__item--fluid m-header-menu-wrapper">
						<button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light " id="m_aside_header_menu_mobile_close_btn">
							<i class="la la-close"></i>
						</button>
						<div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light "  >
							<ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
								<li class="m-menu__item  m-menu__item--active  m-menu__item--active-tab  m-menu__item--submenu m-menu__item--tabs"  m-menu-submenu-toggle="tab" aria-haspopup="true">
									<a  href="index.html" class="m-menu__link m-menu__toggle">
												<span class="m-menu__link-text">
													SORTEO
												</span>
										<i class="m-menu__hor-arrow la la-angle-down"></i>
										<i class="m-menu__ver-arrow la la-angle-right"></i>
									</a>
									<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
										<span class="m-menu__arrow m-menu__arrow--adjust"></span>
										<ul class="m-menu__subnav">
											<li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
												<a  href="#" class="m-menu__link ">
													<i class="m-menu__link-icon flaticon-support"></i>
													<span class="m-menu__link-text">
																SORTEO
															</span>
												</a>
											</li>

										</ul>
									</div>
								</li>
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
	<div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop m-page__container m-body">
		<div class="m-grid__item m-grid__item--fluid m-wrapper">
			<!-- BEGIN: Subheader -->
			<div class="m-subheader ">
				<div class="d-flex align-items-center">
					<div class="mr-auto">
						<h3 class="m-subheader__title ">
							SORTEO DE PREMIOS
						</h3>
					</div>

				</div>
			</div>
			<!-- END: Subheader -->
			<div class="m-content">
				<div class="row">
					<div class="col-xl-12 col-lg-12">
						<div class="m-portlet m-portlet--full-height   m-portlet--rounded">
							<div class="m-portlet__body">
								<div class="m-card-profile">
									<div class="m-card-profile__title m--hide">
										Your Profile
									</div>
									<!--<div class="m-card-profile__pic">
                                        <div class="m-card-profile__pic-wrapper">
                                            <img src="assets/app/media/img/users/user4.jpg" alt=""/>
                                        </div>
                                    </div>-->
									<div id="numeros_ram" style="display: none" class="m-card-profile__details">
										<h1 id="messenger" class="m--font-info">

										</h1>
										<h1 id="messenger2" class="m--font-info">

										</h1>

									</div>
								</div>
								<div class="m-portlet__body-separator"></div>
								<div id="datos_sorteo" style="display: none"  class="m-widget1 m-widget1--paddingless">
									<div class="m-widget1__item">
										<div class="row m-row--no-padding align-items-center">
											<div class="col">
												<h3 class="m-widget1__title">
													APELLIDOS Y NOMBRES
												</h3>
												<span class="m-widget1__desc">

														</span>
											</div>
											<div class="col m--align-right">
														<span id="nomsort" class="m-widget1__number m--font-brand">

														</span>
											</div>
										</div>
									</div>
									<div class="m-widget1__item">
										<div class="row m-row--no-padding align-items-center">
											<div class="col">
												<h3 class="m-widget1__title">
													ESPECIALIDAD
												</h3>
												<span class="m-widget1__desc">

														</span>
											</div>
											<div class="col m--align-right">
														<span id="espcsort" class="m-widget1__number m--font-danger">

														</span>
											</div>
										</div>
									</div>

								</div>
								<div class="m-portlet__body-separator"></div>
								<div class="m-widget1 m-widget1--paddingless">
									<div class="m-widget1__item">
										<div class="row m-row--no-padding align-items-center">
											<div class="col">
												<h3 class="m-widget1__title">
													SORTEAR
												</h3>
												<span class="m-widget1__desc">

														</span>
											</div>
											<div class="col m--align-right">
												<button id="sorteobtn" type="button" class="btn btn-warning m-btn m-btn--air m-btn--custom">
													SORTEAR
												</button>
											</div>
										</div>
									</div>


								</div>


							</div>
						</div>
					</div>

					<div class="col-xl-12 col-lg-12">
						<div class="m-portlet m-portlet--full-height m-portlet--tabs   m-portlet--rounded">
							<div class="m-portlet__head">
								<div class="m-portlet__head-tools">
									<ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
										<li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1" role="tab">
												<i class="flaticon-share m--hide"></i>
												SORTEO
											</a>
										</li>

									</ul>
								</div>
							</div>
							<div class="tab-content">
								<div class="tab-pane active" id="m_user_profile_tab_1">
									<form class="m-form m-form--fit m-form--label-align-right">
										<div class="m-portlet__body">
											<div class="form-group m-form__group m--margin-top-10 m--hide">
												<div class="alert m-alert m-alert--default" role="alert">
													The example form below demonstrates common HTML form elements that receive updated styles from Bootstrap with additional classes.
												</div>
											</div>
											<div class="form-group m-form__group row">
												<div class="col-10 ml-auto">
													<h3 class="m-form__section">
														 GANADOR
													</h3>
												</div>
											</div>

											<!--<div class="form-group m-form__group row">
												<label for="example-text-input" class="col-2 col-form-label">
													PREMIO
												</label>
												<div class="col-7">
													<input id="premtext" class="form-control m-input" type="text" >
												</div>
											</div>-->


										</div>
										<div class="m-portlet__foot m-portlet__foot--fit">
											<div class="m-form__actions">
												<div class="row">
													<div class="col-2"></div>
													<hr>
													<div class="col-7">
														<button id="guardarpremio" type="button" class="btn btn-accent m-btn m-btn--air m-btn--custom">
															REGISTRAR GANADOR
														</button>
														&nbsp;&nbsp;

													</div>
												</div>

											</div>
										</div>
									</form>
								</div>

							</div>
						</div>
					</div>


				</div>

			</div>
		</div>
	</div>
	<!-- end::Body -->
	<!-- begin::Footer -->
	<footer class="m-grid__item m-footer ">
		<div class="m-container m-container--fluid m-container--full-height m-page__container">
			<div class="m-footer__wrapper">
				<div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
					<div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
								<span class="m-footer__copyright">
									2022 &copy; OFICINA CENTRAL DE ADMISIÓN
									<a href="http://www.admision.uni.edu.pe/" class="m-link">
										OCAD
									</a>
								</span>
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

<input type="hidden" id="hidddni"/>
<!-- end::Scroll Top -->			<!-- begin::Quick Nav -->

<!-- begin::Quick Nav -->
<!--begin::Base Scripts -->
{!! Html::script('assets/demo8/vendors/base/vendors.bundle.js') !!}

{!! Html::script('assets/demo8/demo/demo8/base/scripts.bundle.js') !!}

{!! Html::script('assets/demo8/vendors/custom/fullcalendar/fullcalendar.bundle.js') !!}
{!! Html::script('assets/demo8/app/js/dashboard.js') !!}


<!--end::Page Snippets -->
<!-- begin::Page Loader -->
<script>
	$(window).on('load', function() {
		$('body').removeClass('m-page--loading');
	});
</script>


<script>
	var Messenger = function(el,lop){
		'use strict';
		var m = this;




		m.init = function(){




			m.codeletters = "0123456789";
			m.message = 0;
			m.current_length = 7;
			m.fadeBuffer = false;
			m.messages = [
				lop
			];

			setTimeout(m.animateIn, 2);


		};

		m.generateRandomString = function(length){
			var random_text = '';
			while(random_text.length < length){

				random_text += m.codeletters.charAt(Math.floor(Math.random()*m.codeletters.length));

			}

			return random_text;
		};

		m.animateIn = function(){
			if(m.current_length < m.messages[m.message].length){
				m.current_length = m.current_length + 2;
				if(m.current_length > m.messages[m.message].length) {
					m.current_length = m.messages[m.message].length;
				}

				var message = m.generateRandomString(m.current_length);
				$(el).html(message);

				setTimeout(m.animateIn, 7);
			} else {
				setTimeout(m.animateFadeBuffer, 7);


			}
		};

		m.animateFadeBuffer = function(){

			if(m.fadeBuffer === false){
				m.fadeBuffer = [];
				for(var i = 0; i < m.messages[m.message].length; i++){
					m.fadeBuffer.push({c: (Math.floor(Math.random()*100))+1, l: m.messages[m.message].charAt(i)});
				}

			}

			var do_cycles = false;
			var message = '';

			for(var i = 0; i < m.fadeBuffer.length; i++){
				var fader = m.fadeBuffer[i];
				if(fader.c > 0){
					do_cycles = true;
					fader.c--;
					message += m.codeletters.charAt(Math.floor(Math.random()*m.codeletters.length));
				} else {
					message += fader.l;
				}


			}

			$(el).html(message);



			if(do_cycles === true){
				setTimeout(m.animateFadeBuffer, 10);

			} else {
				setTimeout(m.cycleText, 10);

			}
		};

		m.cycleText = function(){

			$("#datos_sorteo").show();

		};

		m.init();
	}

/*
	$("#sorteobtn").click(function(event) {
		$("#numeros_ram").show();
		var lop;
		var apes;
		lop1="1";
		lop2="333";

		var messenger = new Messenger($('#messenger'),lop1);
		var messenger2 = new Messenger($('#messenger2'),lop2);
	});
*/

    $("#sorteobtn").click(function(event) {
            $("#datos_sorteo").hide();
            $("#numeros_ram").show();
            $("#nomsort").text('');
                    $("#espcsort").text('');
            var lop;
            var apes;
             $.ajax({
                type: "GET",
                url: 'aleatorio'
            })
            .done(function(resuls) {
                                lop=resuls[0].numero_identificacion;

                    apes=	resuls[0].paterno+'  ' + resuls[0].materno+ ' ' + resuls[0].nombres;
                    espc=resuls[0].especialidad;
                        $("#nomsort").text(apes);
                    $("#espcsort").text(espc);

    $("#hidddni").val(lop);

                console.log(resuls[0]);
    var messenger = new Messenger($('#messenger'),lop);
            }).fail(function() {
        alert( "ACTUALIZAR." );
      });


        });


</script>

<script>
	$("#guardarpremio").click(function(event) {
		var dni=$("#hidddni").val();
		var premio=$("#premtext").val();

		$.ajax({
			type: "POST",
			url: 'save-premio',
			dataType: 'json',

			data: {dni: dni, "_token": "{{ csrf_token() }}"},
		})
				.done(function() {


					location.reload();


				}).fail(function() {
			alert( "ERROR EN EL SERVIDOR , VUELVA A INGRESAR EL DNI." );
		});
	});
</script>
<!-- end::Page Loader -->
</body>
<!-- end::Body -->
</html>
