@extends('layouts.admin')

@section('content')
    {!! Alert::render() !!}
    @include('alerts.errors')

    <!--begin::Portlet-->
    <div class="m-portlet m-portlet--creative m-portlet--bordered-semi">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="flaticon-statistics"></i>
												</span>
                    <h3 class="m-portlet__head-text">
                      Buscar postulante por DNI
                    </h3>
                    <h2 class="m-portlet__head-label m-portlet__head-label--success">
                        <span>BUSCAR POSTULANTE</span>
                    </h2>
                </div>
            </div>

        </div>
        <div class="m-portlet__body">
             @if($noexiste)
            <h2 class="text-danger">NO EXISTE USUARIOS REGISTRADOS CON ESE NÚMERO</h2>
            @endif
            <div class="search-page search-content-4">
                <div class="search-bar bordered">
                    {!! Form::open(['route'=>'admin.informe.buscar','method'=>'POST']) !!}
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Buscar POSTULANTE" name="dni">

                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-12 m--margin-top-10">
                            <button class="btn green-soft uppercase bold" type="submit">Buscar</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>


        </div>
    </div>

    <!--end::Portlet-->

















@stop

@section('js-scripts')
    <script>





    </script>
@stop

@section('plugins-styles')



    {!! Html::style('assets2/vendors/custom/datatables/datatables.bundle.css') !!}
@stop

@section('plugins-js')



    {!! Html::script('assets2/vendors/custom/datatables/datatables.bundle.js') !!}




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

@section('title')
    Listado
@stop

@section('breadcrumb')
@stop

@section('page-title')

@stop

@section('page-subtitle')
@stop



