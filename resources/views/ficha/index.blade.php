@extends('layouts.base')

@section('content')
{!! Alert::render() !!}


<div class="m-content">
    <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">


        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="flaticon-statistics"></i>
												</span>
                    <h2 class="lead">
                        <span class="caption-subject theme-font bold uppercase"></span>
                    </h2>
                    <div class="actions">
                        {!!Form::back(route('home.index'))!!}
                    </div>
                    <h2 class="m-portlet__head-label m-portlet__head-label--danger">
                        <span>FICHA DE INSCRIPCIÓN</span>
                    </h2>
                </div>
            </div>

        </div>

        <div class="m-portlet__body lead">
            @if(false)
                <h1>Estimado postulante, en caso de haber ingresado por la MODALIDAD INGRESO DIRECTO CEPRE usted quedará exonerado del pago por derecho de inscripción.
                </h1>
                <h1>En caso de no haber logrado una vacante, tendrá la opción de postular en el examen general, realizando el pago de inscripción de acuerdo a la modalidad seleccionada.

                    </h1>

            @else

                <h2>FICHA DE INSCRIPCIÓN CONCURSO DE ADMISIÓN</h2>

                <a  href="{{ route('ficha2025.pdf') }}" target="_blank">
                    <button type="button" class="btn m-btn--pill btn-info btn-lg m-btn m-btn--custom">FICHA CONCURSO DE ADMISIÓN
                    </button> </a>

            @endif



        </div>

    </div>

</div>


@stop


