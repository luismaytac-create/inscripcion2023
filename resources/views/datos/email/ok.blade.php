@extends('layouts.base')

@section('content')



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

                        </h2>
                        <div class="actions">
                            {!!Form::back(route('home.index'))!!}
                        </div>
                        <h2 class="m-portlet__head-label m-portlet__head-label--danger">
                            <span>CONFIMARCIÓN DE EMAIL</span>
                        </h2>
                    </div>
                </div>

            </div>

            <div class="m-portlet__body lead" id="enviando">
                {!! Alert::render() !!}
                @include('alerts.errors')


                <h1 class="text-success"><strong>CORREO ELECTRÓNICO VERIFICADO CORRECTAMENTE.</strong></h1>



                <a href="{{ route('ficha.index') }}" class="btn  m-btn--wide btn-success"
                   > CONFIRMA TU INSCRIPCIÓN AQUÍ</a>


            </div><!--row-->









        </div>


    </div>






@stop

@section('js-scripts')




@stop

