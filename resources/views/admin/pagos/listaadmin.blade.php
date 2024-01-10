@extends('layouts.admin')

@section('content')


<div class="col-md-12">
    <!-- BEGIN PORTLET-->
    <div class="portlet light tasks-widget widget-comments">
        <div class="portlet-title margin-bottom-20">
            <div class="caption caption-md font-red-sunglo">
                <span class="caption-subject theme-font bold uppercase">FORMATOS DE PAGO DEL POSTULANTE</span>
            </div>
            <div class="actions">
                {!!Form::back(route('admin.listados.index'))!!}
            </div>
        </div>
        <div class="form-body ">
        
            <div class="list-group">
                <a href="{{ route('pagos.pdf',[$pagos['prospecto'],$id]) }}" target="_blank" class="list-group-item active">
                    <h4 class="list-group-item-heading">Prospecto de Admisión </h4>
               </a>
		
                @if (isset($pagos['examen']))
                <a href="{{ route('pagos.pdf',[$pagos['examen'],$id]) }} " target="_blank" class="list-group-item">
                    <h4 class="list-group-item-heading">Derecho de Examen</h4>
                  
                </a>
		                @endif
                @if (isset($pagos['examen2']))
                <a href="{{ route('pagos.pdf',[$pagos['examen2'],$id]) }}" target="_blank" class="list-group-item">
                    <h4 class="list-group-item-heading">Derecho de Examen por segunda modalidad</h4>
                 
                </a>
                @endif
                @if (isset($pagos['vocacepre']))
                    <a href="{{ route('pagos.pdf',[$pagos['vocacepre'],$id]) }}" target="_blank" class="list-group-item">
                        <h4 class="list-group-item-heading">Prueba de Aptitud Vocacional para arquitectura (CEPRE-UNI)</h4>
                       
                    </a>
                @endif
                @if (isset($pagos['voca']))
                <a href="{{ route('pagos.pdf',[$pagos['voca'],$id]) }}"  target="_blank" class="list-group-item">
                    <h4 class="list-group-item-heading">Prueba de Aptitud Vocacional para arquitectura</h4>
                 
                </a>
                @endif
             <!--@if (isset($pagos['extemporaneo']))
                <a href="{{ route('pagos.pdf',[$pagos['extemporaneo'],$id]) }}" target="_blank" class="list-group-item">
                    <h4 class="list-group-item-heading">Inscripción Extemporanea</h4>
                    
                </a>
                @endif -->
            </div>
	
        </div>
    </div>
    <!-- END PORTLET-->
</div>

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


@section('title')
Postulantes
@stop
@section('page-title')

@stop

@section('page-subtitle')
@stop
