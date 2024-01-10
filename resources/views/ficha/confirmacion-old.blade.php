@extends('layouts.base')

@section('content')
{!! Alert::render() !!}
<div class="col-md-12">
    <!-- BEGIN PORTLET-->
    <div class="portlet light tasks-widget widget-comments">
        <div class="portlet-title ">
            <div class="caption caption-md font-red-sunglo">
                <span class="caption-subject theme-font bold uppercase">INSCRIPCIÓN FINALIZADA</span>
            </div>
            <div class="actions">
                {!!Form::back(route('home.index'))!!}
            </div>
        </div>
        <div class="form-body ">
        <h1>Estimado postulante: ¿está seguro que la información y la fotografía ingresada es correcta?, </br> 
		Ingrese su clave y contraseña para generar tu ficha de inscripción.
		</h1>
		<div class="Pulsear">
		 {!! Form::open(['route'=>'ficha.confirmar','method'=>'POST']) !!}
            {!!Form::hidden('id', $id );!!}
            <div class="row">
                <div class="col-md-3">
                {!! Field::text('dni',null,['label'=>'Ingrese su DNI','maxlength'=>'12']) !!}
                </div><!--span-->
                <div class="col-md-3">
                {!! Field::password('password',['label'=>'Ingrese su Clave']) !!}
                </div><!--span-->
            </div><!--row-->
                {!!Form::enviar('Guardar')!!}
				<a href="{{ route('datos.index') }}">
				<button type="button" class="btn btn-danger">MIS DATOS SON INCORRECTOS , QUIERO EDITARLOS</button> </a>
				
				
				
        {!! Form::close() !!}
		
		
               <h1>CONFIRME SI SU INFORMACIÓN PERSONAL Y FOTOGRAFÍA ES CORRECTA.
</br>
			   Para poder mostrar su ficha necesitamos que ingrese su dni y su clave, de esta manera aparecera su ficha y no habrá oportunidad de modificar sus datos por el sistema.
			   </br>
			  
               </h1>
            </div>
		
		
		<strong>Verifique todos tus datos personales, si alguno no es correcto debes modificar este en la pestaña DATOS .</strong>
		<div class="col-md-12 ">
                                <!-- BEGIN Portlet PORTLET-->
                                <div class="portlet box red">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i>DATOS DEL POSTULANTE </div>
                                       
                                        
                                    </div>
                                    <div class="portlet-body" >
									<div class="invoice-content-2 bordered">
                            <div class="row invoice-head">
                                <div class="col-md-3 col-xs-3">
                                    <div class="invoice-logo">
                                        <img src="{{ $postulante->mostrar_foto_editada}}" class="img-responsive center" alt="">
                                        <h1 class="uppercase">DATOS DEL POSTULANTE</h1>
                                    </div>
                                </div>
                                 <div class="col-xs-3">
                                    <h2 class="invoice-title uppercase">APELLIDOS Y NOMBRES</h2>
                                    <p class="invoice-desc">{{ $postulante->nombre_completo}}</p>
                                </div>
                                <div class="col-xs-3">
                                    <h2 class="invoice-title uppercase">LUGAR DE NACIMIENTO</h2>
                                    <p class="invoice-desc">{{ $postulante->descripcion_ubigeo_nacimiento}}</p>
                                </div>
								<div class="col-xs-3">
                                    <h2 class="invoice-title uppercase">FECHA DE NACIMIENTO</h2>
                                    <p class="invoice-desc">{{ $postulante->fecha_nacimiento}}</p>
                                </div>
                                <div class="col-xs-3">
                                    <h2 class="invoice-title uppercase">DNI</h2>
                                    <p class="invoice-desc inv-address">{{ $postulante->identificacion}}</p>
                                </div>
								<div class="col-xs-3">
                                    <h2 class="invoice-title uppercase">DIRECCIÓN</h2>
                                    <p class="invoice-desc inv-address">{{ $postulante->direccion}} - {{ $postulante->descripcion_ubigeo}}</p>
                                </div>
								
								<div class="col-xs-3">
                                    <h2 class="invoice-title uppercase">TELEFONOS</h2>
                                    <p class="invoice-desc inv-address">{{ $postulante->telefonos}}</p>
                                </div>
								
								<div class="col-xs-3">
                                    <h2 class="invoice-title uppercase">EMAIL</h2>
                                    <p class="invoice-desc inv-address">{{ $postulante->email}}</p>
                                </div>
								<div class="col-xs-3">
                                    <h2 class="invoice-title uppercase">INSTITUCIÓN EDUCATIVA</h2>
                                    <p class="invoice-desc inv-address">
								{{ $postulante->institucion_educativa  }} - {{ $postulante->gestion_ie  }} -  {{ $postulante->institucion_educa->descripcion_ubigeo   }} </p>
                                </div>
								
                            </div>
                            
                            <div class="row invoice-body">
                                <div class="col-xs-12 table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="invoice-title uppercase"></th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <h3>Modalidad : {{ $postulante->nombre_modalidad}}</h3>
                                                    <h3>Especialidad : {{ $postulante->nombre_especialidad}}</h3>
                                                </td>
                                                
                                            </tr>
											
											@if ($postulante->codigo_modalidad == 'ID-CEPRE')
                                            <tr>
                                                <td>
                                                    <h3>Modalidad  2: {{ $postulante->nombre_modalidad2}}</h3>
                                                    <h3>Especialidad 2 : {{ $postulante->nombre_especialidad2}}</h3>
													
													
                                                </td>
                                                
                                            </tr>
											@endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                           
                            
                        </div>
									
									
									
									
                                  </div>
                                </div>
                                <!-- END Portlet PORTLET-->
                            </div>
		
		
		</br>
		
        <p></p>
       
        </div>
    </div>
    <!-- END PORTLET-->
</div>

@stop

@section('title')
Restriccion de ficha
@stop
