@extends('layouts.admin')

@section('content')

    <div class="row">

        <div class="col-12">
            <div class="m-portlet m-portlet--creative m-portlet--bordered-semi">

                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="flaticon-statistics"></i>
												</span>
                            <h3 class="m-portlet__head-text">
                                Configurar Aula de Admisión
                            </h3>
                            <h2 class="m-portlet__head-label m-portlet__head-label--success">
                                <span>ASIGNACIÓN DE AULAS</span>
                            </h2>
                        </div>
                    </div>

                </div>
                <div class="m-portlet__body">
                    <h3>Facultad: {{ $sigla }}</h3>
                    <h4>Turno: {{ $turno }}</h4>
                    <h4>Cantidad de Postulantes: {{ $numpostulantes }}</h4>



                    <table class="table table-striped table-responsive table-bordered table-hover aulas">
                        <thead>
                        <th>SECTOR</th>
                        <th>CODIGO</th>

                        <th>DISPONIBLE 1</th>
                        <th>ASIGNADO 1</th>
                        <th>ASIGNADO REAL 1</th>

                        <th>DISPONIBLE 2</th>
                        <th>ASIGNADO 2</th>
                        <th>ASIGNADO REAL 2</th>

                        <th>DISPONIBLE 3</th>
                        <th>ASIGNADO 3</th>
                        <th>ASIGNADO REAL 3</th>


                        </thead>


                        <tbody>

                        @if($turno=='M')
                            @foreach ($aulasbyfacultad as $item)
                                <tr>
                                    <td>{{ $item->sector }}</td>
                                    <td>{{ $item->codigo }}</td>

                                    <td>{{ $item->disponible_01 }}</td>
                                    <td>{{ $item->asignado_01 }}</td>
                                    <td>{{ $item->asigando_1_real }}</td>

                                    <td>{{ $item->disponible_02 }}</td>
                                    <td>{{ $item->asignado_02 }}</td>
                                    <td>{{ $item->asigando_02_real }}</td>

                                    <td>{{ $item->disponible_03 }}</td>
                                    <td>{{ $item->asignado_03 }}</td>
                                    <td>{{ $item->asigando_03_real }}</td>


                                </tr>
                            @endforeach
                        @else

                            @foreach ($aulasbyfacultad as $item)
                                <tr>
                                    <td>{{ $item->sector }}</td>
                                    <td>{{ $item->codigo }}</td>

                                    <td>{{ $item->disponible_01_tarde }}</td>
                                    <td>{{ $item->asignado_01_tarde }}</td>
                                    <td>{{ $item->asigando_1_real }}</td>

                                    <td>{{ $item->disponible_02_tarde }}</td>
                                    <td>{{ $item->asignado_02_tarde }}</td>
                                    <td>{{ $item->asigando_02_real }}</td>

                                    <td>{{ $item->disponible_03_tarde }}</td>
                                    <td>{{ $item->asignado_03_tarde }}</td>
                                    <td>{{ $item->asigando_03_real }}</td>


                                </tr>
                            @endforeach
                        @endif



                        </tbody>



                    </table>













                </div>



            </div>
        </div>











    </div>






@stop

@section('js-scripts')

@stop



@section('plugins-styles')
    {!! Html::style('assets/global/plugins/datatables/datatables.min.css') !!}
    {!! Html::style('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!}
@stop

@section('plugins-js')
    {!! Html::script('assets/global/plugins/jquery-ui/jquery-ui.min.js') !!}
    {!! Html::script('assets/global/scripts/datatable.js') !!}
    {!! Html::script('assets/global/plugins/datatables/datatables.min.js') !!}
    {!! Html::script('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}
@stop

@section('menu-user')
    @include('menu.profile-admin')
@stop

@section('sidebar')
    @include(Auth::user()->menu)
@stop


@section('user-name')
    {!!Auth::user()->dni!!}
@stop

@section('breadcrumb')

@stop


@section('page-title')

@stop

@section('page-subtitle')
@stop



