@extends('layouts.admin-new')


@section('content')
{!! Alert::render() !!}
@include('alerts.errors')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-8 profile-info">
                <h1 class="font-green sbold uppercase">{{ $postulante->nombre_completo }}</h1>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="thumbnail">
                            <img src="{{ $postulante->mostrar_foto_cargada }}" alt="" style="width: 100%; height: 200px;">
                            <div class="caption">
                                <h3>Foto Cargada</h3>
                                <p>{{ $postulante->foto_fecha_carga }}</p>
                            </div>
                        </div>
                    </div><!--span-->
                    <div class="col-sm-3">
                        <div class="thumbnail">
                            <img src="{{ $postulante->mostrar_foto_editada }}" alt="" style="width: 100%; height: 200px;">
                            <div class="caption">
                                <h3>Foto Editada</h3>
                                <p>{{ $postulante->foto_fecha_edicion }}</p>
                            </div>
                        </div>
                    </div><!--span-->
                    <div class="col-sm-3">
                        <div class="thumbnail">
                            <img src="{{ $postulante->mostrar_foto_rechazada }}" alt="" style="width: 100%; height: 200px;">
                            <div class="caption">
                                <h3>Foto Rechazada</h3>
                                <p>{{ $postulante->foto_fecha_rechazo }}</p>
                            </div>
                        </div>
                    </div><!--span-->
                </div><!--row-->
            </div>
            <!--end col-md-8-->
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet sale-summary">
                            <div class="portlet-title">
                                <div class="caption font-red sbold"> Pagos Realizados </div>
                                <div class="tools">
                                    <a class="reload" href="javascript:;" data-original-title="" title=""> </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <ul class="list-unstyled">
                                    @foreach ($postulante->recaudaciones as $item)
                                        <li>
                                            <span class="sale-info"> {{ $item->fecha.' - '.$item->descripcion }}
                                                <i class="fa fa-img-up"></i>
                                            </span>
                                            <span class="sale-num"> {{ $item->monto }} </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div><!--span-->
                </div><!--row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet sale-summary">
                            <div class="portlet-title">
                                <div class="caption font-red sbold"> Verificacion de datos </div>
                                <div class="tools">
                                    <a class="reload" href="javascript:;" data-original-title="" title=""> </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <ul class="list-unstyled">
                                    <li>
                                        <span class="sale-info"> Lleno datos Personales
                                            <i class="fa fa-img-up"></i>
                                        </span>
                                        <span class="sale-num"> {!! $postulante->procesos->personal !!} </span>
                                    </li>
                                    <li>
                                        <span class="sale-info"> Lleno datos Familiares
                                            <i class="fa fa-img-up"></i>
                                        </span>
                                        <span class="sale-num"> {!! $postulante->procesos->familiar !!} </span>
                                    </li>
                                    <li>
                                        <span class="sale-info"> Lleno datos de Encuesta
                                            <i class="fa fa-img-up"></i>
                                        </span>
                                        <span class="sale-num"> {!! $postulante->procesos->datos_encuesta !!} </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!--span-->
                </div><!--row-->

            </div>
            <!--end col-md-4-->
            <p><h2><strong>Fecha de Registro :</strong> {{ $postulante->fecha_registro }}</h2></p>
        </div>
        <!--end row-->
        <div class="tabbable-line tabbable-custom-profile">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab_1" data-toggle="tab" aria-expanded="true"> Datos del Postulante </a>
                </li>
                <li>
                    <a href="#tab_3" data-toggle="tab" aria-expanded="true"> Editar Pre Inscripción </a>
                </li>

                <li>
                    <a href="#tab_5" data-toggle="tab" aria-expanded="true"> Editar Datos Personales </a>
                </li>

                <li>
                    <a href="#tab_8" data-toggle="tab" aria-expanded="true"> 4TA DISPOSICIÓN </a>
                </li>
                <li>
                    <a href="#tab_20" data-toggle="tab" aria-expanded="true"> SEGUNDA CONFIRMACIÓN </a>
                </li>

                <li>
                    <a href="#tab_2" data-toggle="tab" aria-expanded="true"> Ficha </a>
                </li>
                <li>
                    <a href="#tab_4" data-toggle="tab" aria-expanded="true"> Editar DNI </a>
                </li>
                <li>
                    <a href="#tab_6" data-toggle="tab" aria-expanded="true"> Editar Correo </a>
                </li>

                <li>
                    <a href="#tab_7" data-toggle="tab" aria-expanded="true"> Editar Modalidad </a>
                </li>





            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-advance table-hover">
                            <thead>
                                <tr>
                                    <th><i class="fa fa-briefcase"></i> Campo </th>
                                    <th class="hidden-xs"><i class="fa fa-edit"></i> Nombre </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Número de Inscripción
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->codigo }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Numero de Identificación
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->identificacion }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Paterno
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->paterno }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Materno
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->materno }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Nombres
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->nombres }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Modalidad
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->nombre_modalidad }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Especialidad
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->nombre_especialidad }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Aula Dia 1
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->datos_aula_uno->codigo }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Aula Dia 2
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->datos_aula_dos->codigo }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Aula Dia 3
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->datos_aula_tres->codigo }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Aula Vocacional
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->datos_aula_voca->codigo }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Email
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->email }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Telefonos
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->telefono_celular.' / '.$postulante->telefono_fijo.' / '.$postulante->telefono_varios }} </td>
                                </tr>
                                <tr>
                                    <td>
                                        Institucion Educativa
                                    </td>
                                    <td class="hidden-xs"> {{ $postulante->institucion_educativa }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--tab-pane-->
                <div class="tab-pane" id="tab_2">
                <iframe src="{{route('ficha.pdf',$postulante->id)}}" width="100%" height="900px" scrolling="auto"></iframe>
                </div>

                <div class="tab-pane" id="tab_8">
                    <div class="tab-pane active" id="tab_1_1_1">
                        {!! Form::open(['route'=>'admin.pos.cuarta','method'=>'POST']) !!}
                        <div class="col-md-6">

                            {!! Field::text('dni',$postulante->numero_identificacion,['label'=>'DNI ACTUAL','readonly'=>'readonly','class'=>'form-control']) !!}

                        </div>
                        <div class="col-md-12">

                            {!!Field::select('cuarta_df', [
                                'participante_sin_derecho'=>'Participante sin derecho a vacante',
                                'postulante'=>'Postulante con derecho a vacante',
                                ], $postulante->cuarta_df, ['label'=>'Deseo inscribirme como:  (*)','empty'=>'Seleccionar']);!!}
                        </div>

                        <div class="col-md-4">
                            {!!Form::hidden('idpostulante', $postulante->id );!!}






                            {!!Form::enviar('Actualizar')!!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>



                <div class="tab-pane" id="tab_20">
                    <div class="tab-pane active" id="tab_1_1_1">
                        {!! Form::open(['route'=>'admin.pos.otraconf','method'=>'POST']) !!}
                        <div class="col-md-6">

                            {!! Field::text('dni',$postulante->numero_identificacion,['label'=>'DNI ACTUAL','readonly'=>'readonly','class'=>'form-control']) !!}

                        </div>
                        <div class="col-md-12">


                        </div>

                        <div class="col-md-4">
                            {!!Form::hidden('idpostulante', $postulante->id );!!}






                            {!!Form::enviar('Actualizar')!!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>

                <div class="tab-pane" id="tab_4">
                    <div class="tab-pane active" id="tab_1_1_1">
                    {!! Form::open(['route'=>'admin.pos.cambiardni','method'=>'POST']) !!}
                        <div class="col-md-6">

                            {!! Field::text('dni',$postulante->numero_identificacion,['label'=>'DNI ACTUAL','readonly'=>'readonly','class'=>'form-control']) !!}

                        </div>
                        <div class="col-md-6">

                            {!! Field::text('dninuevo',null,['label'=>'INGRESAR DNI NUEVO','maxlength'=>'14']) !!}

                        </div>

                        <div class="col-md-4">
                        {!!Form::hidden('idpostulante', $postulante->id );!!}






                            {!!Form::enviar('Actualizar')!!}
                        </div>
                    {!! Form::close() !!}
                    </div>
                </div>

                <div class="tab-pane" id="tab_7">
                    {!! Form::model($postulante,['route'=>['admin.pos.cambiamoda'],'method'=>'POST']) !!}
                    {!!Form::hidden('idpostulante', $postulante->id );!!}
                    <h3>Modalidad de Postulación según el reglamento</h3>
                    <div class="row">
                        <div class="col-md-6">
                            {!!Field::select('idmodalidad',$modalidad,['label'=>'Escoger Modalidad (*)','empty'=>'Escoger modalidad de postulación']);!!}
                        </div><!--span-->

                        <div class="col-md-6">
                            {!!Field::select('idespecialidad',$especialidad,['label'=>'Escoger PRIMERA Especialidad (*)','empty'=>'Escoger PRIMERA especialidad de postulación']);!!}
                        </div><!--span-->
                        <div class="col-md-6">
                            {!!Field::select('idespecialidad2',$especialidad,['label'=>'Escoger SEGUNDA Especialidad (*)','empty'=>'Escoger SEGUNDA especialidad de postulación']);!!}
                        </div><!--span-->
                        <div class="col-md-6">
                            {!!Field::select('idespecialidad3',$especialidad,['label'=>'Escoger TERCERA Especialidad (*)','empty'=>'Escoger TERCERA especialidad de postulación']);!!}
                        </div><!--span-->


                    </div><!--row-->
                    <div class="row">
                        <div class="col-md-6 ">
                            {!!Field::text('codigo_verificacion',null,['label'=>'Ingresa tu código de CEPRE-UNI de 6 dígitos. Ejemplo: 10021J','placeholder'=>'Ingresar código de CEPRE-UNI','maxlength'=>'12']);!!}
                        </div><!--span-->
                    </div><!--row-->
                    <div class="row">
                        <div class="col-md-6">
                            {!!Field::select('idmodalidad2',$segunda_modalidad_cepre,['label'=>'Escoger segunda Modalidad (Solo para alumnos de CEPRE-UNI)','empty'=>'Escoger segunda modalidad de postulación (Solo para alumnos de CEPRE-UNI)']);!!}
                        </div><!--span-->
                        <div class="col-md-6">
                            {!!Field::select('idespecialidad4',$especialidad,['label'=>'Escoger PRIMERA Especialidad (*)','empty'=>'Escoger PRIMERA especialidad de postulación']);!!}
                        </div><!--span-->
                        <div class="col-md-6">
                            {!!Field::select('idespecialidad5',$especialidad,['label'=>'Escoger SEGUNDA Especialidad (*)','empty'=>'Escoger SEGUNDA especialidad de postulación']);!!}
                        </div><!--span-->
                        <div class="col-md-6">
                            {!!Field::select('idespecialidad6',$especialidad,['label'=>'Escoger TERCERA Especialidad (*)','empty'=>'Escoger TERCERA especialidad de postulación']);!!}
                        </div><!--span-->

                    </div><!--row-->
                    {!!Form::enviar('Actualizar')!!}
                    {!! Form::close() !!}
                </div>


                <div class="tab-pane" id="tab_5">
                    {!! Form::model($postulante,['route'=>['admin.pos.update',$postulante],'method'=>'PUT']) !!}

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!!Form::label('lblEdicion', 'Se puede modificar datos',['class'=>'control-label col-md-2']);!!}
                                    <div class="input-group col-md-10">
                                        <div class="icheck-inline">
                                            <label>
                                                {!! Form::radio('datos_ok', 1) !!}
                                                No
                                            </label>
                                            <label>
                                                {!! Form::radio('datos_ok', 0) !!}
                                                Si
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div><!--span-->
                        </div><!--row-->

                    <div class="row">
                        <div class="col-md-2">
                            {!! Field::text('paterno',['label'=>'Apellido Paterno','placeholder'=>'Apellido Paterno']) !!}
                        </div><!--span-->
                        <div class="col-md-2">
                            {!! Field::text('materno',['label'=>'Apellido Materno','placeholder'=>'Apellido Materno']) !!}
                        </div><!--span-->
                        <div class="col-md-2">
                            {!! Field::text('nombres',['label'=>'Nombres','placeholder'=>'Nombres']) !!}
                        </div><!--span-->
                    </div><!--row-->

                    <div class="row ">
                        <div class="col-md-6">
                            {!!Field::select('inicio_estudios', null, ['label'=>'Año de inicio de la secundaria (*)','empty'=>'Inicio de la secundaria']);!!}
                        </div><!--span-->

                        <div class="col-md-6">

                            {!!Field::select('fin_estudios', null, ['label'=>'Selecciona el año que culminas la secundaria (*)','empty'=>'Fin de la secundaria']);!!}






                        </div>

                    </div><!--row-->

                    <div class="row">
                        <div class="col-md-6 Distrito">
                            <div class="form-group">
                                {!!Form::label('lblDistrito', 'Distrito donde vive el postulante');!!}






                                {!!Form::select('idubigeo',UbigeoPersonal($postulante->idubigeo) ,null , ['style'=>'width: 100%','class'=>'form-control Ubigeo' ]);!!}



                            </div>
                        </div><!--span-->
                    </div>


                    <div class="row">

                        <div class="col-md-6 DistritoNacimiento">
                            <div class="form-group">
                                {!!Form::label('lblDistrito', 'Distrito donde nació el postulante (*) ');!!}


                                    {!!Form::select('idubigeonacimiento',UbigeoPersonal($postulante->idubigeonacimiento) ,null , ['style'=>'width: 100%','class'=>'form-control Ubigeo']);!!}





                            </div>
                        </div><!--span-->

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            {!!Field::number('telefono_celular', null, ['label'=>'Celular del postulante (*)','placeholder'=>'Teléfono celular del postulante','max '=>'99999999999','id'=>'telefono_celular']);!!}
                        </div><!--span-->
                        <div class="col-md-6">
                            {!!Field::text('telefono_fijo', null, ['label'=>'Teléfono fijo del postulante (*)','placeholder'=>'Teléfono fijo del postulante','maxlength'=>'15','id'=>'telefono_fijo']);!!}
                        </div><!--span-->
                    </div><!--row-->

                    <div class="row">
                        <div class="col-md-6">
                            {!!Field::email('email', null, ['label'=>'Email del postulante (*)','placeholder'=>'Email del postulante']);!!}
                        </div><!--span-->
                    </div>


                    <div class="row">
                        <div class="col-md-2">
                            {!! Field::text('fecha_nacimiento',['label'=>'Fecha de Nacimiento','placeholder'=>'Fecha de Nacimiento']) !!}
                        </div><!--span-->
                    </div><!--row-->


                    {!!Form::enviar('Actualizar')!!}
                    {!! Form::close() !!}
                </div>


                <div class="tab-pane" id="tab_3">
                    {!! Form::model($postulante,['route'=>['admin.pos.personal',$postulante],'method'=>'POST']) !!}


                        <div class="row">

                            <div class="col-md-12 Colegio">
                                <div id="depacoldiv" class="col-md-12">

                                    {!!Field::select('iddepacolegio',$depas,ColegioDepartamento($postulante->idcolegio) ,['label'=>'Escoger Departamento del colegio(*)','empty'=>'Escoger departamento del colegio']);!!}



                                </div>

                                <div id="colediv" class="col-md-12">



                                        {!!Field::select('idcolegio',ColegioPersonal($postulante->idcolegio),['style'=>'width: 100%','label'=>'Escoger el colegio']);!!}











                                </div>


                            </div><!--span-->
                        </div>

                    {!!Form::enviar('Actualizar')!!}
                    {!! Form::close() !!}

                </div>

                <div class="tab-pane" id="tab_6">
                    <div class="tab-pane active" id="tab_1_1_1">
                        {!! Form::open(['route'=>'admin.pos.cambiaremail','method'=>'POST']) !!}
                        <div class="col-md-6">

                            {!! Field::text('email',$postulante->email,['label'=>'EMAIL ACTUAL','readonly'=>'readonly','class'=>'form-control']) !!}

                        </div>
                        <div class="col-md-6">

                            {!! Field::email('emailnuevo',null,['label'=>'INGRESAR EMAIL NUEVO']) !!}

                        </div>

                        <div class="col-md-4">
                            {!!Form::hidden('idpostulante', $postulante->id );!!}






                            {!!Form::enviar('Actualizar')!!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@stop
@section('js-scripts')

    <script src="{{asset('js/fileinput.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/es.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/fa/theme.js')}}" type="text/javascript"></script>

<script>
    $(window).on('load', function() {

        $(".Ubigeo").select2({
            allowClear: true,
            ajax: {
                url: '{{ url("ubigeo") }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        varsearch: params.term // search term
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
            placeholder : 'Seleccione el distrito del participante: ejemplo LIMA',
            minimumInputLength: 3,
            templateResult: format,
            templateSelection: format,
            escapeMarkup: function(markup) {
                return markup;
            } // let our custom formatter work
        });
        function format(res){
            var markup=res.text;
            return markup;

        }


        $("#idcolegio").select2({

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
                "<div class='select2-result-repository__description'> Código Modular : " + school.codigo_modular + "</div>" +
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









$(".Fecha").inputmask("y-m-d", {
    "placeholder": "yyyy-mm-dd"
});
</script>
@stop

@section('plugins-styles')
{!! Html::style(asset('assets/pages/css/profile-2.min.css')) !!}
{!! Html::style(asset('assets/global/plugins/icheck/skins/all.css')) !!}
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




