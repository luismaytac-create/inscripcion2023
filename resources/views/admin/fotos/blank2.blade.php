@extends('layouts.admin')

@section('content')
{!! Alert::render() !!}
@include('alerts.errors')
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN Portlet PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-file-image-o"></i>Editor de Fotos </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a class="reload actualizar"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">

            <div class="row">
                <div class="col-md-12">

                </div>
            </div><!--row-->
            <p></p>
            <div class="row">

                <div id="tui-image-editor"></div>

            </div>


            <div class="row">
                <div class="col-md-3">
                    <a href="javascript:;" class="thumbnail">
                        <img src="{{ asset('/storage/avatar/nofoto.jpg') }}" style="height: 400px; width: 300px; display: block;"> </a>
                </div><!--span-->
                <div class="col-md-9">




                </div><!--span-->
            </div><!--row-->
        </div>
    </div>
    <!-- END Portlet PORTLET-->
	</div><!--span-->
</div><!--row-->

@stop


@section('js-scripts')

<script>


    window.onload = function () {

        var instance = new ImageEditor(document.querySelector('#tui-image-editor'), {
            cssMaxWidth: 700,
            cssMaxHeight: 500,
            selectionStyle: {
                cornerSize: 20,
                rotatingPointOffset: 70
            }
        });
    }

</script>

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



@section('plugins-js')

    <script src="https://uicdn.toast.com/tui-image-editor/latest/tui-image-editor.js"></script>

@stop
@section('plugins-styles')



    <link rel="stylesheet" href="https://uicdn.toast.com/tui-image-editor/latest/tui-image-editor.css">


@stop
