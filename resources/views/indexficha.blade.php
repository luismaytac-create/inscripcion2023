@extends('layouts.base')

@section('content')
    @include('alerts.errors')
    <!-- BEGIN: Subheader -->
    {!! Alert::render() !!}
    <!-- END: Subheader -->
    <div class="m-content">
        <!--begin::Portlet-->
        <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h2 class="m-portlet__head-label m-portlet__head-label--danger">
                            <span>Bienvenido</span>
                        </h2>
                    </div>
                </div>

            </div>
            <div class="m-portlet__body lead">

                <h2></h2>



            </div>
        </div>
        <!--end::Portlet-->
        <div class="row">

            <div class="col-md-4">
                <div class="m-alert m-alert--icon alert " role="alert" style="background: #761607; color:white">
                    <div class="m-alert__icon">
                        <i class="la la-facebook-official"></i>
                    </div>
                    <div class="m-alert__text">
                        <strong>Contáctanos</strong> Si tienes difilcultades con tu inscripción.
                    </div>
                    <div class="m-alert__actions" style="width: 160px;">
                        <a href="{{ route('contacto.index') }}" class="btn  btn-sm m-btn m-btn--pill m-btn--wide" style="background: white; color: #761607">CONTACTO</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop