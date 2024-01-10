
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
                            <span class="caption-subject theme-font bold uppercase">FORMATOS DE PAGO AL NOMBRE DEL POSTULANTE</span>
                        </h2>
                        <div class="actions">
                            {!!Form::back(route('home.index'))!!}
                        </div>
                        <h2 class="m-portlet__head-label m-portlet__head-label--danger">
                            <span>FORMATO DE PAGOS</span>
                        </h2>
                    </div>
                </div>

            </div>


            <div class="m-portlet__body lead">

                <div class="col-md-12">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light tasks-widget widget-comments">

                        <div class="form-body ">
                            <div class="Pulsear">
                                <h1>Una vez realizado el pago en el banco, espera a que sea validado por nuestro sistema. Este proceso puede durar 24 horas. <br>
                                </h1>
                            </div>
                            <p></p>
                            <iframe src="{{route('pagos.pdf',$servicio)}}" width="100%" height="600px" scrolling="auto"></iframe>
                        </div>





                    </div>
                    <!-- END PORTLET-->
                </div>
            </div>
        </div>
    </div>














@stop

