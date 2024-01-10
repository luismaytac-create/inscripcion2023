@extends('layouts.base')

@section('content')

<div class="col-md-12">
    <!-- BEGIN PORTLET-->
    <div class="portlet light tasks-widget widget-comments">
        <div class="portlet-title margin-bottom-20">
            <div class="caption caption-md font-red-sunglo">
                <span class="caption-subject theme-font bold uppercase">Resultados del simulacro</span>
            </div>
            <div class="actions">
                {!!Form::back(route('home.index'))!!}
            </div>
        </div>
        <div class="form-body ">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-hover" data-toggle="table" data-pagination="true">
                        <tbody>
                            <tr><td> <strong>Codigo</strong></td><td>{{ $postulante->codigo }}</td></tr>
                            <tr><td><strong>Postulante</strong></td><td>{{ $postulante->nombre_completo }}</td></tr>
                            <tr><td><strong>Puntaje</strong></td><td>
                                    @if (isset($postulante->resultados))
                                        {{ $postulante->resultados->puntaje }}
                                    @endif
                             </td></tr>
                            <tr><td><strong>Nota</strong></td><td>
                                    @if (isset($postulante->resultados))
                                        {{ $postulante->resultados->nota }}
                                    @endif
                            </td></tr>
                            <tr><td><strong>Merito</strong></td><td>
                                    @if (isset($postulante->resultados))
                                        {{ $postulante->resultados->merito }}
                                    @endif
                            </td></tr>
                            <tr><td><strong>Obervacion</strong></td><td>
                                    @if (isset($postulante->resultados))
                                        {{ $postulante->resultados->observacion }}
                                    @endif
                            </td></tr>
                        </tbody>
                    </table>
                </div><!--span-->
                <div class="col-md-6">
                    {{-- <div class="portlet light portlet-fit bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green bold uppercase">Resumen de rendimiento</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div id="gchart_pie_1" style="height:500px;"></div>
                        </div>
                    </div> --}}
                </div>
            </div><!--row-->
        </div>
    </div>
    <!-- END PORTLET-->
</div>

@stop

