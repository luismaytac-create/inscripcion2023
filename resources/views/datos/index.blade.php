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
                            Para realizar tu inscripción deberás seguir los siguientes pasos:
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
                <ol>
                    <li>Datos: Registra <strong>tus datos personales</strong> (no del apoderado): apellido paterno, apellido materno, nombres, facultad, especialidad a la que postulas  e institución educativa donde estudió el postulante</li>
                    <li>Pagos: Imprime los FORMATOS DE PAGO que el sistema genera, para que realices el pago en el banco BCP o agentes BCP.</li>
                    <li>Subir Documentos: Sube tu foto de estudio fotográfico y DNI (solo la parte delantera), que serán validados por la Dirección de Admisión.</li>
                    <li>Ficha: Imprime tu Ficha de Inscripción.</li>
                </ol>

               <!--  <ul>
                    <li>

                        Mira cómo inscribirte  <a target="_blank" href="https://youtu.be/fwVvM2J7xsM" class="btn btn-outline-danger m-btn btn-large  m-btn--icon">
															<span>
																<i class="fa flaticon-youtube"></i>
																<span>GUÍA DE INSCRIPCIÓN</span>
															</span>



                        </a>

                    </li>
                    <hr>
                    <li>

                        Descarga la guía de inscripción  <a target="_blank" href="http://bit.ly/2zYJXvf" class="btn btn-outline-success m-btn  m-btn--icon">
															<span>
																<i class="fa flaticon-book"></i>
																<span>GUÍA DE INSCRIPCIÓN</span>
															</span>



                        </a>

                    </li>

                </ul> -->


                <div class="m-pricing-table-1">
                    <div class="m-pricing-table-1__items row">
                        <div class="m-pricing-table-1__item col-lg-3">
                            <div class="m-pricing-table-1__visual">
                                <div class="m-pricing-table-1__hexagon1"></div>
                                <div class="m-pricing-table-1__hexagon2"></div>
                                <span class="m-pricing-table-1__icon " style="color: #761607;"><i class="fa flaticon-profile"></i></span>
                            </div>
                            <span class="m-pricing-table-1__price">Preinscripción</span>
                            <h2 class="m-pricing-table-1__subtitle"></h2>
                            <span class="m-pricing-table-1__description">

											</span>
                            <div class="m-pricing-table-1__btn">
                                <a class="btn m-btn m-btn--custom m-btn--pill m-btn--wide m-btn--uppercase m-btn--bolder m-btn--sm" style="background: #893230;color: white"  href="{{ route('datos.postulante.index') }}">
                                    Ingresar
                                </a>


                            </div>
                        </div>
                        @if ($swp)
                            <div class="m-pricing-table-1__item col-lg-3">
                                <div class="m-pricing-table-1__visual">
                                    <div class="m-pricing-table-1__hexagon1"></div>
                                    <div class="m-pricing-table-1__hexagon2"></div>
                                    <span class="m-pricing-table-1__icon " style="color: #761607;"><i class="fa flaticon-list-1"></i></span>
                                </div>
                                <span class="m-pricing-table-1__price">Datos Personales<span class="m-pricing-table-1__label"></span></span>
                                <h2 class="m-pricing-table-1__subtitle"></h2>
                                <span class="m-pricing-table-1__description">

											</span>
                                <div class="m-pricing-table-1__btn">
                                    <a href="{{ route('datos.secundarios.index') }}" class="btn m-btn--pill  m-btn--wide m-btn--uppercase m-btn--bolder m-btn--sm" style="background: #893230;color: white">Ingresar</a>
                                </div>
                            </div>
                            <div class="m-pricing-table-1__item col-lg-3">
                                <div class="m-pricing-table-1__visual">
                                    <div class="m-pricing-table-1__hexagon1"></div>
                                    <div class="m-pricing-table-1__hexagon2"></div>
                                    <span class="m-pricing-table-1__icon " style="color: #761607;"><i class="fa flaticon-users"></i></span>
                                </div>
                                <span class="m-pricing-table-1__price">Familiares<span class="m-pricing-table-1__label"></span></span>
                                <h2 class="m-pricing-table-1__subtitle"></h2>
                                <span class="m-pricing-table-1__description">

											</span>
                                <div class="m-pricing-table-1__btn">
                                    <a href="{{ route('datos.familiares.index') }}" class="btn m-btn--pill m-btn--wide m-btn--uppercase m-btn--bolder m-btn--sm" style="background: #893230;color: white">Ingresar</a>
                                </div>
                            </div>
                            <div class="m-pricing-table-1__item col-lg-3">
                                <div class="m-pricing-table-1__visual">
                                    <div class="m-pricing-table-1__hexagon1"></div>
                                    <div class="m-pricing-table-1__hexagon2"></div>
                                    <span class="m-pricing-table-1__icon " style="color: #761607;"><i class="fa flaticon-rotate"></i></span>
                                </div>
                                <h2 class="m-pricing-table-1__price" style="font-size: 30px;">Complementario</h2>
                                <h2 class="m-pricing-table-1__subtitle"></h2>
                                <span class="m-pricing-table-1__description">

											</span>
                                <div class="m-pricing-table-1__btn">
                                    <a href="{{ route('datos.complementarios.index') }}" class="btn m-btn--pill m-btn--wide m-btn--uppercase m-btn--bolder m-btn--sm" style="background: #893230;color: white">Ingresar</a>
                                </div>
                            </div>

                        @endif
                    </div>
                </div>









            </div>



        </div>
    </div>




@stop