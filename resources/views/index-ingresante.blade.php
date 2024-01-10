@extends('layouts.base')

@section('content')

    @include('alerts.errors')

    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">Bienvenido</h3>
            </div>

        </div>
    </div>
    {!! Alert::render() !!}
    <!-- END: Subheader -->
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
                            Deberás seguir los siguientes pasos:
                        </h2>
                        <h2 class="m-portlet__head-label m-portlet__head-label--danger">
                            <span>Bienvenido</span>
                        </h2>
                    </div>
                </div>

            </div>
            <div class="m-portlet__body lead">
                <ol>
                    <li>Sube tus documentos según la modalidad de ingreso.</li>
                    <li>Ingresa a la entrevista virtual según el horario asignado.</li>
                </ol>
                <hr>

                    @if($meet)
                        <h3>Ingresa a la entrevista virtual en el turno que te corresponde:</h3>
                        <h2 class="text-danger">Turno: {{ $datosmeet->turno }}</h2>
                        <br>

                        <a target="_blank" href="{{ $datosmeet->meet}}" class="btn btn-success m-btn  m-btn--icon">
                            <span>
                                <i class="fa flaticon-book"></i>
                                <span>VIDEOCONFERENCIA</span>
                            </span>
                        </a>
                    @else
                    @endif
                <hr>

                

                @if(isset($constancia))
                    <h2>CONSTANCIA DE INGRESO .</h2>
                    <h3>Documentos presentados: {{ $estadocons }}</h3>

                    @if($constancia)

                        <a target="_blank" href="{{route('constancia',Auth::user()->id)}}" class="btn btn-outline-danger m-btn btn-large  m-btn--icon">
															<span>
																<i class="fa flaticon-user-ok"></i>
																<span>DESCARGAR CONSTANCIA</span>
															</span>



                        </a>

                    @endif



                @endif
                <hr>
                <ul>
                    <li>
                        Mira cómo inscribirte  <a target="_blank" href="https://youtu.be/tImwlvqNbvY" class="btn btn-outline-danger m-btn btn-large  m-btn--icon">
                            <span>
                                <i class="fa flaticon-youtube"></i>
                                <span>GUÍA DE INSCRIPCIÓN</span>
                            </span>
                        </a>
                    </li>
                    <hr>
                    <li>
                        Descarga la guía de inscripción  <a target="_blank" href="http://bit.ly/2WcXxnb" class="btn btn-outline-success m-btn  m-btn--icon">
                        <span>
                            <i class="fa flaticon-book"></i>
                            <span>GUÍA DE INSCRIPCIÓN</span>
                        </span>
                        </a>
                    </li>
                </ul>
                <div class="m-pricing-table-1 m-pricing-table-1--fixed">
                    <div class="m-pricing-table-1__items row">

                        <div class="m-pricing-table-1__item col-lg-4">
                            <div class="m-pricing-table-1__visual">
                                <div class="m-pricing-table-1__hexagon1"></div>
                                <div class="m-pricing-table-1__hexagon2"></div>
                                <span class="m-pricing-table-1__icon " style="color: #761607;"><i class="fa flaticon-list-1"></i></span>
                            </div>
                            <span class="m-pricing-table-1__price">Documentos</span>
                            <h2 class="m-pricing-table-1__subtitle">Ingresantes</h2>
                            <span class="m-pricing-table-1__description">
												Carga tus documentos según<br>
												tu modalidad
											</span>
                            <div class="m-pricing-table-1__btn">
                                <a href="{{ route('ingreso.index') }}"><button type="button" class="btn m-btn--pill m-btn--wide m-btn--uppercase m-btn--bolder m-btn--sm" style="background: #893230;color: white">Ingresar</button></a>
                            </div>
                        </div>

                        <div class="m-pricing-table-1__item col-lg-4">
                            <div class="m-pricing-table-1__visual">
                                <div class="m-pricing-table-1__hexagon1"></div>
                                <div class="m-pricing-table-1__hexagon2"></div>
                                <span class="m-pricing-table-1__icon " style="color: #761607;"><i class="fa flaticon-profile"></i></span>
                            </div>
                            <span class="m-pricing-table-1__price">Ficha</span>
                            <h2 class="m-pricing-table-1__subtitle">Descarga tu ficha de inscripción</h2>
                            <span class="m-pricing-table-1__description">
								Ficha de Inscripción
							</span>
                            <div class="m-pricing-table-1__btn">
                                <a href="{{ route('ficha.index') }}">  <button type="button" class="btn m-btn--pill m-btn--wide m-btn--uppercase m-btn--bolder m-btn--sm" style="background: #893230;color: white">Ingresar</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Portlet-->
        <div class="row">
            <div class="col-md-4">
                <div class="m-alert m-alert--icon alert " role="alert" style="background: #761607; color:white">
                    <div class="m-alert__icon">
                        <i class="la la-facebook-official"></i>
                    </div>
                    <div class="m-alert__text">
                        <strong>Contáctanos</strong> Si tienes difilcultades con tu inscripción.
                    </div>
                    <div class="m-alert__actions" style="width: 160px;">
                        <a href="{{ route('contacto.index') }}" class="btn  btn-sm m-btn m-btn--pill m-btn--wide" style="background: white; color: #761607">CONTACTO</a>
                    </div>
                </div>


            </div>


        </div>
    </div>

@stop