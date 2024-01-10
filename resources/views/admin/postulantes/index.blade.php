@extends('layouts.admin')


@section('content')



    <!--begin::Portlet-->
    <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">
        <div class="m-portlet__head">



            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="flaticon-statistics"></i>
												</span>
                    <h3 class="m-portlet__head-text">
                        Busqueda de postulantes.
                    </h3>
                    <h2 class="m-portlet__head-label m-portlet__head-label--info">
                        <span>Busqueda</span>
                    </h2>
                </div>
            </div>

        </div>
        <div class="m-portlet__body">
            {!! Alert::render() !!}
            <h1>Buscar Postulante</h1>
            <div class="row">

                {!! Form::open(['route'=>'admin.pos.buscar','method'=>'POST','class'=>'search-form search-form-expanded']) !!}
                <div class="input-group">
                    {!!Form::text('name', null , ['class'=>'form-control','placeholder'=>'INGRESE DNI O PATERNO....']);!!}
                    <span class="input-group-btn">
                    <a href="javascript:;" class="btn submit">
                        <i class="icon-magnifier"></i>
                    </a>
                </span>
                </div>
                {!! Form::close() !!}

            </div>

                <hr>








                <h2> Resultado de busqueda</h2>

            <table class="table table-bordered table-hover " id="listados_search">
                <thead>
                <tr>
                    <th> Codigo </th>
                    <th> Paterno </th>
                    <th> Materno </th>
                    <th> Nombres </th>
                    <th> Número de identificación </th>
                    <th> Opciones </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($postulantes as $item)
                    <tr>
                        <td> {{ $item->codigo }} </td>
                        <td> {{ $item->paterno }} </td>
                        <td> {{ $item->materno }} </td>
                        <td> {{ $item->nombres }} </td>
                        <td> {{ $item->identificacion }} </td>
                        <td>{!!Form::boton('Ver',route('admin.pos.show',$item->id),'green-dark','fa fa-eye','btn-xs')!!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <!--end::Portlet-->








@stop

@section('js-scripts')
<script>
$(function(){

    var table = $('#listados_search');


    table.DataTable({
        "language": {
            "emptyTable": "No hay datos disponibles",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ filas",
            "search": "Buscar Postulante :",
            "lengthMenu": "_MENU_ registros"
        },
        responsive:true


    });

});

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

@section('breadcrumb')

@stop


@section('page-title')

@stop

@section('page-subtitle')
@stop




