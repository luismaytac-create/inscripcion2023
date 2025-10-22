@extends('layouts.base')

@section('content')
    @include('alerts.errors')
    <!-- BEGIN: Subheader -->
    {!! Alert::render() !!}
    <!-- END: Subheader -->
    <div class="m-content">
        <!--begin::Portlet-->
        <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h2 class="m-portlet__head-label m-portlet__head-label--danger">
                            <span>Bienvenido</span>
                        </h2>
                    </div>
                </div>

            </div>
            <div class="m-portlet__body lead">
                @if (false)
                    <ol>
                        <li>Sube tus documentos según la modalidad de ingreso.</li>
                        <li>Ingresa a la entrevista virtual según el horario asignado.</li>
                    </ol>
                @endif
                Para realizar tu inscripción deberás seguir los siguientes pasos:
                <ol>
                    <li>Datos: Deberás registrar los datos del postulante (no del apoderado), donde ingresarás Apellido paterno, apellido materno, nombres, modalidad, facultad y especialidad e institución educativa donde estudió el postulante</li>
                    <li>Pagos: Imprimirás los FORMATOS DE PAGO que el sistema genera según la modalidad que haya escogido, y podrá realizar los pagos en el Banco BCP o Scotiabank</li>
                    <li>Ficha: Imprimirás tu ficha de inscripción después de realizar el pago y que la foto haya sido verificada por la Dirección de Admisión</li>
                </ol>
                Si tuviese alguna duda puedes hacer click al botón <span class="label label-danger"> Ayuda </span> que se encuentra a la derecha de la ventana y te aparecerán indicaciones para poder realizar la inscripción
    
                
                @if($meet)
                    <hr>
                    <h3>Ingresa a la entrevista virtual en el turno que te corresponde:</h3>
                    <h2 class="text-danger">Turno: {{ $datosmeet->turno }}</h2>
                    <br>

                    <a target="_blank" href="{{ $datosmeet->meet}}" class="btn btn-success m-btn  m-btn--icon">
                        <span>
                            <i class="fa flaticon-book"></i>
                            <span>VIDEOCONFERENCIA</span>
                        </span>
                    </a>
                    <hr>
                @else
                @endif
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
                               <div class="m-pricing-table-1 m-pricing-table-1--fixed">
                    <div class="m-pricing-table-1__items row">

                        <div class="m-pricing-table-1__item col-lg-4">
                            <div class="m-pricing-table-1__visual">
                                <div class="m-pricing-table-1__hexagon1"></div>
                                <div class="m-pricing-table-1__hexagon2"></div>
                                <span class="m-pricing-table-1__icon " style="color: #761607;"><i class="fa flaticon-list-1"></i></span>
                            </div>
                            <span class="m-pricing-table-1__price">DATOS</span>
                            <h2 class="m-pricing-table-1__subtitle">Datos Personales</h2>
                            <span class="m-pricing-table-1__description">
                                Registra tus datos<br>
                                personales
                            </span>
                            <div class="m-pricing-table-1__btn">
                                <a href="{{ route('datos.index') }}"><button type="button" class="btn m-btn--pill m-btn--wide m-btn--uppercase m-btn--bolder m-btn--sm" style="background: #893230;color: white">Ingresar</button></a>
                            </div>
                        </div>
                        <div class="m-pricing-table-1__item col-lg-4">
                            <div class="m-pricing-table-1__visual">
                                <div class="m-pricing-table-1__hexagon1"></div>
                                <div class="m-pricing-table-1__hexagon2"></div>
                                <span class="m-pricing-table-1__icon " style="color: #761607;"><i class="fa flaticon-list-1"></i></span>
                            </div>
                            <span class="m-pricing-table-1__price">PAGO</span>
                            <h2 class="m-pricing-table-1__subtitle">Formatos de pagos</h2>
                            <span class="m-pricing-table-1__description">
                                Descarga tus formatos<br>
                                de pago
                            </span>
                            <div class="m-pricing-table-1__btn">
                                <a href="{{ route('pagos.index') }}"><button type="button" class="btn m-btn--pill m-btn--wide m-btn--uppercase m-btn--bolder m-btn--sm" style="background: #893230;color: white">Ingresar</button></a>
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
                        <strong>Semibecas</strong> Solicita tu semibeca aquí.
                    </div>
                    <div class="m-alert__actions" style="width: 160px;">
                        <a href="{{ route('semibeca.index') }}" class="btn  btn-sm m-btn m-btn--pill m-btn--wide" style="background: white; color: #761607">SEMIBECA</a>
                    </div>
                </div>
            </div>
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