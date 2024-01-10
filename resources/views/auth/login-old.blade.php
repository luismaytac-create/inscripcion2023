@extends('layouts.login')

@section('content')
@include('alerts.errors')
{!! Alert::render() !!}
    <div id="form-opcion">
    Bienvenido al Examen de admisión de la UNI, para ingresar debe crear una cuenta, si ya la creo haga click al botón ya tengo cuenta
    <p></p>
    {!!Form::boton('Crear cuenta','javascript:;','green','fa fa-plus','',['id'=>'registrar'])!!}
    {!!Form::boton('Ya tengo cuenta','javascript:;','green','fa fa-send','',['id'=>'logear'])!!}
    </div>

{!! Form::open(['url'=>'login','method'=>'POST','id'=>'form-login']) !!}
    <h3 class="form-title font-green">Iniciar Sesión</h3>
	<div class="form-group">
            {!! Form::label('lblDNI', 'Selecciona el tipo de documento ', ['class'=>'bold']) !!}
            <div class="input-icon right ">
           
			<div class="controls">
           
			{!! Form::select('tipo_documento_log', ['1' => 'DNI', '2' => 'OTRO DOCUMENTO'], null, ['class' => 'form-control','id'=>'tipo_documento_log']) !!}
			</div>
			
            </div>
    </div>
	
	
    <div class="form-group">
            <div class="input-icon right ">
            <i class="fa fa-envelope"></i>
            {!!Form::text('dni',old('dni'), ['class'=>'form-control','placeholder'=>'DNI','maxlength'=>'8','id'=>'dni_log'])!!}
            </div>
    </div>
    <div class="form-group">
        <div class="input-icon right ">
            <i class="fa fa-lock"></i>
            {!!Form::password('password', ['class'=>'form-control','placeholder'=>'Clave'])!!}
        </div>
    </div>
    <div class="form-actions">
        {!!Form::submit('Entrar',['class'=>'btn green uppercase btn-block'])!!}
    </div>
    <div class="create-account" >
    <p></p>
    {!!Form::boton('Regresar','javascript:;','default','fa fa-mail-reply','',['id'=>'back'])!!}
    {!!Form::boton('Olvidé mi Clave',url('/password/reset'),'green','fa fa-cog')!!}
    </div>
{!! Form::close() !!}

{!! Form::open(['url'=>'register','method'=>'POST','id'=>'form-register']) !!}
    <h3 class="form-title font-green">Crear Cuenta</h3>
	
	<div class="form-group">
            {!! Form::label('lblDNI', 'Selecciona el tipo de documento ', ['class'=>'bold']) !!}
            <div class="input-icon right ">
           
			<div class="controls">
           
			{!! Form::select('tipo_documento', ['1' => 'DNI', '2' => 'OTRO DOCUMENTO'], null, ['class' => 'form-control','id'=>'tipo_documento']) !!}
			</div>
			
            </div>
    </div>
	
	
    <div class="form-group">
            <strong>{!! Form::label('lblDNI', 'Ingresa tu número de DNI(no del apoderado)', ['class'=>'bold']) !!}</strong>
            <div class="input-icon right ">
            <i class="fa fa-envelope"></i>
            {!!Form::text('dni',old('dni'), ['class'=>'form-control','placeholder'=>'dni','maxlength'=>'8','id'=>'dni'])!!}
            </div>
    </div>
	<div class="form-group">
            {!! Form::label('lblEmail', 'Ingresa tu correo electrónico', []) !!}
            <div class="input-icon right ">
            <i class="fa fa-envelope"></i>
            {!!Form::email('email',null, ['class'=>'form-control','placeholder'=>'Email'])!!}
            </div>
    </div>
    <div class="form-group">
            {!! Form::label('lblPassword', 'Genere su Clave (mínimo de 6 dígitos)', []) !!}
        <div class="input-icon right ">
            <i class="fa fa-lock"></i>
            {!!Form::password('password', ['class'=>'form-control','placeholder'=>'Clave'])!!}
        </div>
            {!! Form::label('lblPassword2', 'Ingresa nuevamente su Clave', []) !!}
        <div class="input-icon right ">
            <i class="fa fa-lock"></i>
            {!!Form::password('password_confirmation', ['class'=>'form-control','placeholder'=>'Clave'])!!}
        </div>
    </div>
	<div class="form-group">
            {!! Form::label('captcha', 'Ingresa el texto de la Imagen', []) !!}
            <div class="captcha">
			<span > {!! captcha_img() !!}</span>
			<button type="button" class="btn btn-succes btn-refresh">Recargar</button>
            </div>
			<input type="text" id="captcha" class="form-control" placeholder="Ingresa texto de la Imagen"  name ="captcha"/>
    </div>
    <div class="form-actions">
        {!!Form::submit('Crear',['class'=>'btn green uppercase btn-block'])!!}
    </div>
    <div class="create-account">
    {!!Form::back(url('/'))!!}
    </div>
{!! Form::close() !!}
@stop

@section('js-scripts')
<script>

var p= $('#tipo_documento').val();
  
   if(p=="1"){
	 $("#dni").attr('maxlength','8');  
	 
	 var po=$("#dni").val().length;
	 if(po>8){
		 
		
		var res = $("#dni").val().substring(0, 8); 
		 $("#dni").val(res);
		 
		 
		 
	 }
	 
	
	   
   }else {
	   $("#dni").attr('maxlength','12'); 
   }





$('#tipo_documento').on('change', function() {
   
   var p= $('#tipo_documento').val();
  
   if(p=="1"){
	 $("#dni").attr('maxlength','8');  
	 
	 var po=$("#dni").val().length;
	 if(po>8){
		 
		
		var res = $("#dni").val().substring(0, 8); 
		 $("#dni").val(res);
		 
		 
		 
	 }
	 
	
	   
   }else {
	   $("#dni").attr('maxlength','12'); 
   }
   
});

$('#tipo_documento_log').on('change', function() {
   
   var p= $('#tipo_documento_log').val();
  
   if(p=="1"){
	 $("#dni_log").attr('maxlength','8');  
	 
	 var po=$("#dni_log").val().length;
	 if(po>8){
		 
		
		var res = $("#dni_log").val().substring(0, 8); 
		 $("#dni_log").val(res);
		 
		 
		 
	 }
	 
	
	   
   }else {
	   $("#dni_log").attr('maxlength','12'); 
   }
   
});

$('#form-register').hide();
$('#form-login').hide();
$('#registrar').click(function() {
    $('#form-opcion').hide();
    $('#form-register').show();

});
$('#back').click(function() {
    $('#form-opcion').show();
    $('#form-register').hide();
    $('#form-login').hide();

});
$('#logear').click(function() {
    $('#form-opcion').hide();
    $('#form-register').hide();
    $('#form-login').show();

});

$('.btn-refresh').click(function() {
	$.ajax({
	type: 'GET',
	url: 'refresh_captcha',
	success: function(data){
	$(".captcha span").html(data.captcha);
	}
	});
});
</script>
@stop

@section('copyright')
Oficina Central de Admisión. Universidad Nacional de Ingeniería
@stop