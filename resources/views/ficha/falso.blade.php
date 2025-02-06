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
           <h1>FICHA DE INSCRIPCIÓN DISPONIBLE EL 07 DE FEBRERO</h1>



        </div>

    </div>

</div>


@stop


