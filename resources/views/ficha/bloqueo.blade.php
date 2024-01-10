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
                            Restricción:
                        </h2>
                        <div class="actions">
                            {!!Form::back(route('home.index'))!!}
                        </div>
                        <h2 class="m-portlet__head-label m-portlet__head-label--danger">
                            <span>FICHA DEL POSTULANTE</span>
                        </h2>
                    </div>
                </div>

            </div>


            <div class="m-portlet__body lead">


                <div class="col-md-12">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light tasks-widget widget-comments">

                        <div class="form-body ">
                            Se han detectado los siguientes inconvenientes
                            <p></p>
                            @if (isset($msj))
                                @foreach ($msj as $item)
                                    <div class="alert alert-danger">
                                        <h4 class="block">{{ $item['titulo'] }}</h4>
                                        <p> {{ $item['mensaje'] }}. </p>

                                        @if(isset($item['link']))

                                            <a href="{{ route($item['link']) }}" class="btn btn-sm m-btn m-btn--pill m-btn--wide"
                                               style="background: white; color: #761607">{{ $item['boton'] }}</a>

                                        @endif

                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <!-- END PORTLET-->
                </div>


            </div>
        </div>
    </div>












@stop

@section('title')
    Restriccion de ficha
@stop
