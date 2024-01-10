@extends('layouts.base')

@section('content')
@include('alerts.errors')
{!! Form::open(['route'=>'datos.postulante.store','method'=>'POST','files'=>true]) !!}
<div class="col-md-12">
    <!-- BEGIN PORTLET-->
    <div class="portlet light tasks-widget widget-comments">
        <div class="portlet-title margin-bottom-20">
            <div class="caption caption-md font-red-sunglo">
                <span class="caption-subject theme-font bold uppercase">DATOS PERSONALES DEL potulante (NO DEL APODERADO)</span>
            </div>
            <div class="actions">
                {!!Form::back(route('datos.index'))!!}
            </div>
        </div>
        <div class="form-body ">
            <dl>
                <dt>Observación</dt>
                <dd>Los nombres y apellidos deben coincidir con el DNI del postulante, los campos con asterisco (*) son obligatorios.</dd>
            </dl>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {!!Form::hidden('idtipoidentificacion', IdTCCodigo('IDENTIFICACION','DNI') );!!}
                        {!!Form::hidden('numero_identificacion', Auth::user()->dni );!!}
                        {!!Field::text('paterno', null , ['label'=>'Apellido Paterno del postulante (*)','placeholder'=>'Apellido Paterno del postulante','maxlength'=>'50']);!!}
                    </div>
                </div><!--span-->
                <div class="col-md-4">
                    <div class="form-group">
                        {!!Field::text('materno', null , ['label'=>'Apellido Materno del postulante (*)','placeholder'=>'Apellido Materno del postulante','maxlength'=>'50']);!!}
                    </div>
                </div><!--span-->
                <div class="col-md-4">
                    <div class="form-group">
                        {!!Field::text('nombres', null , ['label'=>'Nombres del postulante (*)','placeholder'=>'Nombre el postulante','maxlength'=>'60']);!!}
                    </div>
                </div><!--span-->
            </div><!--row-->
            <h3>Modalidad de Postulación según el reglamento</h3>
                <div class="row">
                    <div class="col-md-6">
                        {!!Field::select('idmodalidad',$modalidad,['label'=>'Escoger Modalidad (*)','empty'=>'Escoger modalidad de postulacion']);!!}
                    </div><!--span-->
                    <div class="col-md-6">
                        {!!Field::select('idespecialidad',$especialidad,['label'=>'Escoger Especialidad (*)','empty'=>'Escoger especialidad de postulación']);!!}
                    </div><!--span-->
                </div><!--row-->
                <div class="widget-thumb bordered bg-green cepreuni">
                    <div class="row">
                        <div class="col-md-6 ">
                            {!!Field::text('codigo_verificacion',null,['label'=>'Ingresar código de CEPRE-UNI(*)','placeholder'=>'Ingresar código de CEPRE-UNI','maxlength'=>'12']);!!}
                        </div><!--span-->
                    </div><!--row-->
                    <div class="row">
                        <div class="col-md-6">
                            {!!Field::select('idmodalidad2',$segunda_modalidad_cepre,['label'=>'Escoger segunda Modalidad (Solo para alumnos de CEPRE-UNI)(*)','empty'=>'Escoger segunda modalidad de postulación (Solo para alumnos de CEPRE-UNI)']);!!}
                        </div><!--span-->
                        <div class="col-md-6">
                            {!!Field::select('idespecialidad2',$especialidad,['label'=>'Escoger segunda Especialidad (Solo para alumnos de CEPRE-UNI)(*)','empty'=>'Escoger segunda especialidad de postulación (Solo para alumnos de CEPRE-UNI)']);!!}
                        </div><!--span-->
                    </div><!--row-->
                </div>
            <h3>Institución Educativa del postulante</h3>
                <dl>
                    <dt>Observación</dt>
                    <dd>Queda bajo responsabilidad del postulante seleccionar la Institución Educativa de donde procede, <strong>todo cambio de colegio incurrirá en un nuevo pago sin lugar a reembolso Art. 13 Reglamento de Admisión.</strong></dd>
                </dl>
                <div class="row">
				
					
				
                    <div class="col-md-12 Colegio">
                             <div id="depacoldiv" class="col-md-12">
				
				{!!Field::select('iddepacolegio',$depas,['label'=>'Escoger Departamento del colegio(*)','empty'=>'Escoger departamento del colegio']);!!}
				
				
				
				</div>
				
				<div id="colediv" class="col-md-12">
				 {!!Field::select('idcolegio',null,['label'=>'Escoger el colegio(*)']);!!}
				</div>
							
							
                    </div><!--span-->
                    <div class="col-md-6 Universidad">
                        {!!Field::select('iduniversidad',null,['label'=>'Escoger Universidad(*)']);!!}
                    </div><!--span-->
                </div><!--row-->
				
				
            {!!Form::enviar('Guardar')!!}
        </div>
    </div>
    <!-- END PORTLET-->
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ten en cuenta:</h4>
      </div>
      <div class="modal-body">
        <h3 ><strong id="parraf"> </strong></h3>
	<h3 class="text-info"><strong>Traer toda la información necesaria hasta el cierre de inscripciones
para su evaluación respectiva convocada por la facultad.</strong></h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">NO CONTINUAR</button>
       
	{!!Form::enviar('Guardar y Continuar')!!}
      </div>
    </div>

  </div>
</div>
{!! Form::close() !!}
@stop

@section('js-scripts')
<script>


 $("#iddepacolegio").click(function(event) {
	 var dp=$('#iddepacolegio').val();
	 if(dp>0){
		 
		 $('#colediv').show();
		 
	 }else {
		$('#colediv').hide();
	 }
	 
	 
 });






$(function() {


var idmodal = $("#idmodalidad").val();

if(idmodal>0){
	$.ajax({
            url: 'info-modalidad',
            dataType: 'json',
            data: {idmodalidad: idmodal},
        })
        .done(function(modalidad) {
            /*Muestra Colegio o universidad segun la modalidad correspondiente*/
            if (modalidad.colegio) {
                $(".Colegio").show();
				$('#colediv').hide();
				$('#depacoldiv').show();
				 var dp=$('#iddepacolegio').val();
	 if(dp>0){
		 
		 $('#colediv').show();
		 
	 }else { 
		$('#colediv').hide();
	 }
                $(".Universidad").hide();
            }else{
                $(".Colegio").hide();
				
				$('#colediv').hide();
				$('#depacoldiv').hide();
                $(".Universidad").show();
            }
            /*Muestra la segunda opcion del cepre UNI*/
            if (modalidad.codigo == 'ID-CEPRE') {
                $(".cepreuni").show();
            }else{
                $(".cepreuni").hide();
            }


        });
	
	
	
	
}else {
	$(".Colegio").hide();
$(".Universidad").hide();
$(".cepreuni").hide();
$('#colediv').hide();
$('#depacoldiv').hide();
}







    $("#idmodalidad").change(function(event) {
        var idmodalidad = $(this).val();
		if(idmodalidad!=""){
			
		
		
        $.ajax({
            url: 'info-modalidad',
            dataType: 'json',
            data: {idmodalidad: idmodalidad},
        })
        .done(function(modalidad) {
							
						
			
            /*Muestra Colegio o universidad segun la modalidad correspondiente*/
            if (modalidad.colegio) {
                $(".Colegio").show();
				$('#colediv').hide();
				$('#depacoldiv').show();
				 var dp=$('#iddepacolegio').val();
					 if(dp>0){
						 
						 $('#colediv').show();
						 
					 }else { 
						$('#colediv').hide();
					 }
                $(".Universidad").hide();
            }else{
                $(".Colegio").hide();
				
				$('#colediv').hide();
				$('#depacoldiv').hide();
                $(".Universidad").show();
            }
            /*Muestra la segunda opcion del cepre UNI*/
            if (modalidad.codigo == 'ID-CEPRE') {
                $(".cepreuni").show();
            }else{
				
				$("#idmodalidad2").val(null);
				
				$("#codigo_verificacion").val(null);
				$("#idespecialidad2").val(null);
				
				
				
                $(".cepreuni").hide();
            }


        });//SAl
		
		}else {
			$(".Colegio").hide();
				$('#colediv').hide();
				$('#depacoldiv').hide();
			$(".Universidad").hide();
		}

    });
    $("#idmodalidad2").click(function(event) {
        var idmodalidad = $(this).val();
        $.ajax({
            url: 'info-modalidad',
            dataType: 'json',
            data: {idmodalidad: idmodalidad},
        })
        .done(function(modalidad) {
            /*Muestra Colegio o universidad segun la modalidad correspondiente*/
            if (modalidad.colegio) {
                $(".Colegio").show();
				$('#colediv').hide();
				$('#depacoldiv').show();
                $(".Universidad").hide();
				
				
				 var dp=$('#iddepacolegio').val();
	 if(dp>0){
		 
		 $('#colediv').show();
		 
	 }else { 
		$('#colediv').hide();
	 }
            }else{
                $(".Colegio").hide();
				$('#colediv').hide();
				$('#depacoldiv').hide();
                $(".Universidad").show();
            }

        });

    });

    $("#idcolegio").select2({
        width:'auto',
        ajax: {
            url: '{{ url("colegio") }}',
            dataType: 'json',
            delay: 250,
            data: function(params) {
               dep=$(iddepacolegio).val();
                return {
                    varschool: params.term+"&depaBus="+dep // search term
                };
            },
            processResults: function(data) {
                // parse the results into the format expected by Select2.
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data
                return {
                    results: data
                };
            },
            cache: true
        },
        placeholder : 'Seleccione su colegio',
        minimumInputLength: 3,
        templateResult: formatSchool,
        templateSelection: formatSchoolSelection,
        escapeMarkup: function(markup) {
            return markup;
        } // let our custom formatter work
    });

    $("#iduniversidad").select2({
        width:'auto',
        ajax: {
            url: '{{ url("universidad") }}',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                var idmodalidad = $('#idmodalidad').val();
                return {
                    varuni: params.term, // search term
                    varidmodalidad: idmodalidad,
                };
            },
            processResults: function(data) {
                // parse the results into the format expected by Select2.
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data
                return {
                    results: data
                };
            },
            cache: true
        },
        placeholder : 'Seleccione su universidad',
        minimumInputLength: 3,
        templateResult: formatUni,
        templateSelection: formatSchoolSelection,
        escapeMarkup: function(markup) {
            return markup;
        } // let our custom formatter work
    });
    function formatSchool(school){
        if (school.loading) return school.text; //Sin esta columna no carga los items dentro de los campo array

        var localidad = school.distrito;
        if (localidad != null) {
            var lbl_ubigeo = 'Distrito';
            var descripcion_ubigeo = localidad.descripcion;
        }else{
            var lbl_ubigeo = 'Pais';
            var descripcion_ubigeo = school.paises.nombre;
        }

        var markup="<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__title'>" + school.text + "</div>" +
       "<div class='select2-result-repository__description'> " + lbl_ubigeo + " : " + descripcion_ubigeo + "</div>" +
        "<div class='select2-result-repository__description'> Gestion : " + school.gestion + "</div>" +
        "<div class='select2-result-repository__description'> Direccion : " + school.direccion + "</div>" +
        "<div class='select2-result-repository__statistics'>" +
        "</div>"+
        "</div>";
        return markup;

    }
    function formatUni(school){
        if (school.loading) return school.text; //Sin esta columna no carga los items dentro de los campo array

        var localidad = school.distrito;
        if (localidad != null) {
            var lbl_ubigeo = 'Distrito';
            var descripcion_ubigeo = localidad.descripcion;
        }else{
            var lbl_ubigeo = 'Pais';
            var descripcion_ubigeo = school.paises.nombre;
        }
        var markup="<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__title'>" + school.text + "</div>" +
        "<div class='select2-result-repository__description'> " + lbl_ubigeo + " : " + descripcion_ubigeo + "</div>" +
        "<div class='select2-result-repository__description'> Gestion : " + school.gestion + "</div>" +
        "<div class='select2-result-repository__statistics'>" +
        "</div>"+
        "</div>";
        return markup;

    }
    function formatSchoolSelection(school){
        var markup =  school.text;
        return markup;
    }

});

$("#fecha_nacimiento").inputmask("d-m-y", {
    "placeholder": "dd-mm-yyyy"
});

var modaaa;


$("#idmodalidad").on('change', function() {
	
	var idmodalidad = $(this).val();
	if(idmodalidad>0){
								
							
							$.ajax({
            url: 'modalidad-especialidad',
            dataType: 'json',
            data: {idmodalidad: idmodalidad},
        })
        .done(function(modalidad) {
			
			
		});
							}
	
	
	
	
if($("#idmodalidad").val()==6){
$("#btnchang").prop('type','button');
var idmodalidad = $(this).val();
        $.ajax({
            url: 'info-vacantesuni',
            dataType: 'json',
            data: {idmodalidad: idmodalidad}
        })
        .done(function(modalidad) {
            /*Muestra Colegio o universidad segun la modalidad correspondiente*/
		modaaa=modalidad;
           
					


        });






}
});
$("#idespecialidad").on('change', function() {

	if($("#idmodalidad").val()==6){
	
	$("#btnchang").prop('type','button');
var idmodalidad = $("#idmodalidad").val();
        $.ajax({
            url: 'info-vacantesuni',
            dataType: 'json',
            data: {idmodalidad: idmodalidad}
        })
        .done(function(modalidad) {
            /*Muestra Colegio o universidad segun la modalidad correspondiente*/
		modaaa=modalidad;
           
					


        });

	




	}
});
$("#btnchang").click(function() {
  var modd=$("#idmodalidad").val();
	var espp=$("#idespecialidad").val();

if(modd==6){
if(espp>0){

var vacanup;
			for (var key in modaaa) {
			  if (modaaa.hasOwnProperty(key)) {
				if(modaaa[key].idespecialidad==espp){
				vacanup=modaaa[key].vacantes;
				
				}
			    
			  }
			}

var menjj=0;
$.ajax({
            url: 'info-numerouni',
            dataType: 'json',
            data: {idespecialidad: espp}
        })
        .done(function(especialidad) {
            /*Muestra Colegio o universidad segun la modalidad correspondiente*/
		
         menjj=JSON.stringify(especialidad);
	/*menjj=menjj+1;*/
$("#parraf").text("Existen "+menjj+" inscritos postulando a esta especialidad con "+vacanup+" vacante(s) disponible(s). La facultad evaluará el ingreso.");

$('#myModal').modal('toggle');

        });




}else{

alert("Escoja una Especialidad");

}
}
});



</script>
@stop

@section('plugins-styles')
{!! Html::style(asset('assets/global/plugins/icheck/skins/all.css')) !!}
@stop
@section('plugins-js')
{!! Html::script(asset('assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')) !!}
@stop

