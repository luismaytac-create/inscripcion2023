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
                            <span class="caption-subject theme-font bold uppercase">CONFIRMAR FICHA</span>
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

                <h2>Puedes obtener la ficha de inscripción desde el 11 de enero de 2022.</h2>




            </div>
        </div>
    </div>

@stop
@section('js-scripts')



@stop
@section('title')
    Restriccion de ficha
@stop
