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
                        Relación de postulantes con observaciones durante su inscripción
                    </h3>
                    <h2 class="m-portlet__head-label m-portlet__head-label--success">
                        <span>LISTADOS</span>
                    </h2>
                </div>
            </div>

        </div>
        <div class="m-portlet__body">
            <p>
                <a href="{{route('admin.listados.listado1')}}" class="btn btn-primary mb-10">Listado Postulantes que no finalizan inscripcion</a>
            </p>
            <p>
                <a href="{{route('admin.listados.listado2')}}" class="btn btn-primary ">Listado Declaraciones rechazadas</a>
            </p>
            <p>
                <a href="{{route('admin.listados.listado3')}}" class="btn btn-primary ">Listado Fotos rechazadas</a>
            </p>
            <p>
                <a href="{{route('admin.listados.listado4')}}" class="btn btn-primary ">Carteras enviadas</a>
            </p>
            <p>
                <a href="{{route('admin.listados.listado5')}}" class="btn btn-primary ">Validacion de Nombres</a>
            </p>
            <p>
                <a href="{{route('admin.listados.listado6')}}" class="btn btn-primary ">Deben DDJJ</a>
            </p>
            <p>
                <a href="{{route('admin.listados.listado7')}}" class="btn btn-primary ">Aprobado DDJJ y no pagan</a>
            </p>
            <p>
                <a href="{{route('admin.listados.listado8')}}" class="btn btn-primary ">No aptos Extraordinario</a>
            </p>
            <p>
                <a href="{{route('admin.listados.listado9')}}" class="btn btn-primary ">Aptos Extraordinario y no pagan</a>
            </p>
            <p>
                <a href="{{route('admin.listados.listado10')}}" class="btn btn-primary ">CEPRE no pre-inscrito</a>
            </p>
            <p>
                <a href="{{route('admin.listados.listado11')}}" class="btn btn-primary ">CEPRE pre-inscrito y no pagan</a>
            </p>

        </div>
    </div>

    <!--end::Portlet-->

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




