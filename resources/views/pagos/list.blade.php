@extends('layouts.base')

@section('content')
    @include('alerts.errors')
    {!! Alert::render() !!}
    <div class="m-content">
    <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">

        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="flaticon-statistics"></i>
												</span>

                    <div class="actions">
                        {!!Form::back(route('home.index'))!!}
                    </div>
                    <h2 class="m-portlet__head-label m-portlet__head-label--danger">
                        <span>FORMATOS DE PAGO</span>
                    </h2>
                </div>
            </div>

        </div>

        <div class="m-portlet__body lead">
            <hr>


                <h4><b>Estos son los pagos que se deben realizar, 
                    debe imprimir todos los formatos de pago para que pueda ir a cancelar en el banco BCP o en el banco ScotiaBank.</b></h4>
                <p>
                    Si desea solicitar una factura, le invitamos a comunicarse al correo <strong>miriam.napan.p@admisionuni.edu.pe</strong>, proporcionando los detalles de su razón social, número de ruc y dirección. Estaremos encantados de atender su solicitud y brindarle la información necesaria.</p>

            <h3>Puedes pagar a partir del 18 de junio.</h3>
               <!-- <div class="list-group">
                    <a href="{{ route('pagos.formato',$pagos['prospecto']) }}" class="list-group-item active">
                        <h4 class="list-group-item-heading">Prospecto de Admisión virtual</h4>
                        <p class="list-group-item-text"> El prospecto de admisión virtual comprende los siguientes documentos (Reglamento, Solucionario del Examen de Admisión,Catálogo de Carreras, Guía de Inscripción). </p>
                    </a>
                    @if (isset($pagos['examen']))
                        <a href="{{ route('pagos.formato',$pagos['examen']) }}" class="list-group-item">
                            <h4 class="list-group-item-heading">Derecho de Examen</h4>
                            <p class="list-group-item-text"> Es el pago por derecho a rendir el examen. </p>
                        </a>
                    @endif
                    @if (isset($pagos['examen2']))
                        <a href="{{ route('pagos.formato',$pagos['examen2']) }}" class="list-group-item">
                            <h4 class="list-group-item-heading">Derecho de Examen por segunda modalidad</h4>
                            <p class="list-group-item-text"> Es el pago por derecho a rendir el examen. </p>
                        </a>
                    @endif
                    @if (isset($pagos['vocacepre']))
                        <a href="{{ route('pagos.formato',$pagos['vocacepre']) }}" class="list-group-item">
                            <h4 class="list-group-item-heading">Prueba de Aptitud Vocacional para arquitectura (CEPRE-UNI)</h4>
                            <p class="list-group-item-text"> Dirigido a los postulantes de CEPRE-UNI que desean ingresar a la especialidad de Arquitectura. </p>
                        </a>
                    @endif
                    @if (isset($pagos['voca']))
                        <a href="{{ route('pagos.formato',$pagos['voca']) }}" class="list-group-item">
                            <h4 class="list-group-item-heading">Prueba de Aptitud Vocacional para arquitectura</h4>
                            <p class="list-group-item-text"> Dirigido a los postulantes que desean ingresar a la especialidad de Arquitectura. </p>
                        </a>
                    @endif
                    @if (isset($pagos['extemporaneo']))
                        <a href="{{ route('pagos.formato',$pagos['extemporaneo']) }}" class="list-group-item">
                            <h4 class="list-group-item-heading">Inscripción Extemporánea</h4>
                            <p class="list-group-item-text">Este pago se realizá cuando la inscripción está fuera de la fecha del cronograma. </p>
                        </a>
                    @endif
                </div>
                -->


        </div>
    </div>

    </div>







@stop

