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
            @if( false )
            <!--
                <h2>EXAMEN FINAL CEPRE-UNI</h2>
            <h3>El Examen Final CEPRE-UNI 2022-1 será en la modalidad virtual. Debe tener la ficha de Inscripción CEPRE-UNI.</h3>


                <a target="_blank" href="{{ route('ficha.pdfcepre') }}">
                    <button type="button" class="btn m-btn--pill btn-success btn-lg m-btn m-btn--custom">FICHA PARA EL EXAMEN FINAL CEPRE-UNI
                        </button> </a>

            -->
                <hr>


            @else

            @endif

                <h2>FICHA DE INSCRIPCIÓN CONCURSO DE ADMISIÓN</h2>

                <a target="_blank" href="{{ route('ficha.pdf') }}">
                    <button type="button" class="btn m-btn--pill btn-info btn-lg m-btn m-btn--custom">FICHA CONCURSO DE ADMISIÓN
                    </button> </a>

        </div>

    </div>

</div>


@stop


