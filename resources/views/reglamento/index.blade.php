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
                            <span class="caption-subject theme-font bold uppercase">Descarga el Prospecto Virtual</span>
                        </h2>
                        <div class="actions">
                            {!!Form::back(route('home.index'))!!}
                        </div>
                        <h2 class="m-portlet__head-label m-portlet__head-label--danger">
                            <span>PROSPECTO VIRTUAL</span>
                        </h2>
                    </div>
                </div>

            </div>


            <div class="m-portlet__body lead">


                <div class="col-md-12">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light tasks-widget widget-comments">

                        <div class="form-body ">
                            <div class="row">
                                <div class="col-md-12">

                                    @if (PagoProspecto())
                                        <div class="list-group">




                                            <a href="{{ route('document.download','catalogo') }}" class="list-group-item"> Catálogo de Especialidades </a>

                                            <a href="{{ route('document.download','solucionario') }}" class="list-group-item"> Solucionario 2022-2</a>
                                            <a href="{{ route('document.download','solucionario23_1') }}" class="list-group-item"> Solucionario 2023-1</a>
                                            <a href="{{ route('document.download','reglamento') }}" class="list-group-item"> Reglamento de Admisión </a>
                                            <a href="{{ route('document.download','temario') }}" class="list-group-item"> Temario </a>
                                            @if(false)



                                            <a href="{{ route('document.download','guia') }}" class="list-group-item"> Guía de Inscripción </a>


                                                @endif
                                        </div>
                                    @else
                                        <div class="note note-danger">
                                            <h4 class="block">No Pago el Prospecto</h4>
                                            <p> Para poder descargar los documentos deberá cancelar el Prospecto de admisión en el banco bcp. <br>Puedes imprimir tu formato haciendo click <a href="{{ route('pagos.index') }}" target="blank">Aqui</a>  </p>
                                        </div>
                                    @endif
                                </div><!--span-->
                            </div><!--row-->

                        </div>
                    </div>
                    <!-- END PORTLET-->
                </div>
            </div>
        </div>
    </div>














@stop

