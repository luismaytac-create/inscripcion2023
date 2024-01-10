@extends('layouts.admin-new')


@section('content')
    {!! Alert::render() !!}
    @include('alerts.errors')
    @include('alerts.errors')
    <div class="row">
        <div class="col-md-12">




            <div>
                <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">
                    <div class="m-portlet__head">



                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="flaticon-statistics"></i>
												</span>
                                <h3 class="m-portlet__head-text">
                                    Busqueda de Ingresantes.
                                </h3>
                                <h2 class="m-portlet__head-label m-portlet__head-label--info">
                                    <span>Ingresante</span>
                                </h2>
                            </div>
                        </div>

                    </div>
                    <div class="m-portlet__body">

                        <div class="row">
                            <div class="col-md-12">
                                {!!Form::token();!!}
                                <div class="row">
                                    <div class="col-md-12">
                                        {!! Field::text('dni',$postulante->numero_identificacion,['label'=>'Número de DNI','placeholder'=>'DNI','readonly'=>'readonly','id'=>'txtdni']) !!}
                                    </div><!--span-->
                                </div><!--row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        {!! Field::select('estado',['NO VINO'=>'NO VINO','CONFORME'=>'CONFORME','CON OBSERVACIONES'=>'CON OBSERVACIONES','NO CONFORME'=>'NO CONFORME','CONFORME Y RESERVA'=>'CONFORME Y RESERVA','RENUNCIA'=>'RENUNCIA'],$ingresante->estado_constancia,['label'=>'Escoger Estado','empty'=>'Escoger Estado','class'=>'input-lg','id'=>'txtestado']) !!}
                                    </div><!--span-->
                                    <div class="col-md-6">
                                        {!! Field::textarea('observacion',$ingresante->observacion,['label'=>'Puede colocar alguna observacion','placeholder'=>'Observacion','id'=>'txtobs']) !!}
                                    </div><!--span-->
                                </div><!--row-->
                                <button class="btn green-soft uppercase bold" type="submit" id="Buscar">Guardar </button>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-8 profile-info">
                                <h1 class="font-green sbold uppercase">{{ $postulante->nombre_completo }}</h1>
                                <h1 class="font-green sbold uppercase">{{ $postulante->numero_identificacion }}</h1>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="thumbnail">
                                            <a href="#verimagen" data-toggle="modal" data-imagen="{{ $postulante->mostrar_foto_editada }}" >
                                                <img src="{{ $postulante->mostrar_foto_editada }}" alt="" style="width: 100%; height: 300px;">
                                            </a>
                                            <div class="caption">
                                                <h3>Foto Postulante</h3>
                                            </div>
                                        </div>
                                    </div><!--span-->



                                </div><!--row-->
                            </div>
                            <!--end col-md-8-->
                            <div class="col-md-4">
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
                            </div>
                            <!--end col-md-4-->
                        </div>
                    </div>
                </div>



            </div>


            <!--end row-->
            <div class="tabbable-line tabbable-custom-profile">
                <ul class="nav nav-tabs">

                    @if (str_contains(Auth::user()->codigo_rol,['ingreso','sistemas','root','admin']))
                        <li class="active">
                            <a href="#tab_1" data-toggle="tab" aria-expanded="true"> Datos del Ingresante </a>
                        </li>
                        <li >
                            <a href="#tab_11" data-toggle="tab" aria-expanded="true"> Documentos Subidos </a>
                        </li>


                        <li>
                            <a href="#tab_2" data-toggle="tab" aria-expanded="true"> Ficha </a>
                        </li>

                        <li>
                            <a href="#tab_5" data-toggle="tab" aria-expanded="true"> Editar Datos Ingresante </a>
                        </li>
                        <li>
                            <a href="#tab_10" data-toggle="tab" aria-expanded="true"> Editar Datos Ingresante LUGAR </a>
                        </li>
                        <li>
                            <a href="#tab_6" data-toggle="tab" aria-expanded="true"> Editar Talla y Peso </a>
                        </li>
                        <li>
                            <a href="#tab_7" data-toggle="tab" aria-expanded="true"> Editar Datos Complementarios </a>
                        </li>

                        <li>
                            <a href="#tab_8" data-toggle="tab" aria-expanded="true"> Editar Datos SISFOH</a>
                        </li>

                        <li>
                            <a href="#tab_9" data-toggle="tab" aria-expanded="true"> Editar Datos Familiares</a>
                        </li>
                        <li>
                            <a href="#tab_3" data-toggle="tab" aria-expanded="true"> CONTINUAR ESTUDIOS </a>
                        </li>


                    @endif
                    @if (str_contains(Auth::user()->codigo_rol,['constancia']))
                        <li>
                            <a href="#tab_3" data-toggle="tab" aria-expanded="true"> Foto Constancia </a>
                        </li>
                    @endif
                </ul>
                <div class="tab-content">


                    <div class="tab-pane active" id="tab_1">

                        @if (str_contains(Auth::user()->codigo_rol,['ingreso','sistemas','root','admin']))
                            <iframe src="{{route('admin.ingresantes.pdfdatos',$postulante->id)}}" width="100%" height="900px" scrolling="auto"></iframe>

                        @endif
                    </div>
                    <!--tab-pane-->
                    <div class="tab-pane" id="tab_2">
                        <iframe src="{{route('ficha.pdf',$postulante->id)}}" width="100%" height="900px" scrolling="auto"></iframe>
                    </div>
                    <!--tab-pane-->
                    <div class="tab-pane" id="tab_3">
                        @if (str_contains($ingresante->codigo_modalidad,['E1TE','E1TG','E1TGU','E1CABC']))
                            {!! Form::model($ingresante,['route'=>['admin.ingresantes.update',$ingresante],'method'=>'PUT']) !!}
                            <div class="row">
                                <div class="col-md-3">
                                    {!! Field::text('facultad_procedencia',['label'=>'Facultad de Procedencia','placeholder'=>'Facultad de Procedencia']) !!}
                                </div><!--span-->
                                @if (str_contains($ingresante->codigo_modalidad,['E1TE','E1CABC']))
                                    <div class="col-md-3">
                                        {!! Field::text('numero_creditos',['label'=>'Numero de Creditos','placeholder'=>'Numero de creditos']) !!}
                                    </div><!--span-->
                                @else
                                    <div class="col-md-3">
                                        {!! Field::text('titulo',['label'=>'Titulo Obtenido','placeholder'=>'Titulo Obtenido']) !!}
                                    </div><!--span-->
                                    <div class="col-md-3">
                                        {!! Field::text('grado',['label'=>'Grado Obtenido','placeholder'=>'Grado Obtenido']) !!}
                                    </div><!--span-->
                                @endif
                            </div><!--row-->
                            {!!Form::enviar('Actualzar')!!}
                            {!! Form::close() !!}
                            <p></p>
                        @endif
                        <iframe src="{{route('admin.ingresantes.pdfconstancia',$postulante->id)}}" width="100%" height="900px" scrolling="auto"></iframe>
                    </div>
                    <!--tab-pane-->
                    <div class="tab-pane" id="tab_4">
                        <div class="tab-pane active" id="tab_1_1_1">

                        </div>
                    </div>
                    <!--tab-pane-->
                    <div class="tab-pane" id="tab_5">
                        {!! Form::model($postulante,['route'=>['admin.pos.update',$postulante],'method'=>'PUT']) !!}
                        <div class="row">
                            <div class="col-md-4">
                                {!! Field::text('paterno',['label'=>'Apellido Paterno','placeholder'=>'Apellido Paterno']) !!}
                            </div><!--span-->
                            <div class="col-md-4">
                                {!! Field::text('materno',['label'=>'Apellido Materno','placeholder'=>'Apellido Materno']) !!}
                            </div><!--span-->
                            <div class="col-md-4">
                                {!! Field::text('nombres',['label'=>'Nombres','placeholder'=>'Nombres']) !!}


                            </div><!--span-->





                        </div><!--row-->



                        <div class="row">
                            <div class="col-md-6">
                                {!! Field::text('direccion',['label'=>'Direccion','placeholder'=>'Direccion']) !!}


                            </div><!--span-->
                            <div class="col-md-6">
                                {!! Field::text('fecha_nacimiento',['label'=>'Fecha de Nacimiento','placeholder'=>'Fecha de Nacimiento']) !!}
                            </div><!--span-->

                        </div><!--row-->




                        <div class="row">
                            <div class="col-md-3">
                                {!! Field::text('telefono_celular',['label'=>'Teléfono Celular','placeholder'=>'Teléfono Celular']) !!}
                            </div><!--span-->
                            <div class="col-md-3">
                                {!! Field::text('telefono_fijo',['label'=>'Teléfono Fijo','placeholder'=>'Teléfono Fijo']) !!}
                            </div><!--span-->
                            <div class="col-md-3">
                                {!! Field::text('telefono_varios',['label'=>'Otro Teléfono','placeholder'=>'Otro Teléfono']) !!}


                            </div><!--span-->





                        </div><!--row-->


                        <div class="row">
                            <div class="col-md-6">
                                {!! Field::text('email',['label'=>'Email','placeholder'=>'Email']) !!}
                            </div><!--span-->




                        </div><!--row-->


                        {!!Form::enviar('Actualizar')!!}
                        {!! Form::close() !!}
                    </div>
                    <!--tab-pane-->
                    <div class="tab-pane" id="tab_6">
                        {!! Form::model($postulante,['route'=>['admin.pos.update',$postulante],'method'=>'PUT']) !!}


                        <div class="row">
                            <div class="col-md-3">
                                {!!Field::number('talla', null, ['label'=>'Talla del postulante(en metros) (*)','placeholder'=>'Talla del postulante','step'=>'0.01']);!!}
                            </div><!--span-->
                            <div class="col-md-3">
                                {!!Field::number('peso', null, ['label'=>'Peso del postulante (en kilogramos) (*)','placeholder'=>'Peso del postulante','step'=>'0.01']);!!}
                            </div><!--span-->

                        </div><!--row-->





                        {!!Form::enviar('Actualizar')!!}
                        {!! Form::close() !!}
                    </div>

                    <div class="tab-pane" id="tab_7">
                        @if(isset($complementario))

                        {!! Form::model($complementario,['route'=>['admin.ingresantes.comple_actu',$complementario],'method'=>'POST']) !!}
                        <div class="row">

                            <input type="hidden" value="{!! $complementario->id !!}" name="id"/>

                            <div class="col-md-12">
                                {!!Field::select('idrazon',$razon, ['label'=>'¿Cual de las siguientes alternativas fue la razón principal en la elección de la especialidad de ingreso?','empty'=>'Selecionar']);!!}
                            </div><!--span-->
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!!Form::label('lblEnc2', 'Tipo de preparacion para postular a la Universidad Nacional de Ingeniería');!!}
                                    <div class="row">
                                        <div class="col-md-2">
                                            {!!Form::label('lblEnc2', 'Tipo de preparacion:',['class'=>'pull-right']);!!}
                                        </div><!--span-->
                                        <div class="col-md-2">
                                            {!!Form::select('idtipopreparacion',$preparacion, null , ['class'=>'form-control col-md-','placeholder'=>'Tipo de preparacion','id'=>'idtipopreparacion']);!!}
                                        </div><!--span-->
                                    </div><!--row-->
                                    <div class="row">
                                        <div class="col-md-2">
                                            {!!Form::label('lblEnc2', 'Tiempo Preparación (meses):',['class'=>'pull-right']);!!}
                                        </div><!--span-->
                                        <div class="col-md-2">
                                            {!!Form::text('mes', null , ['class'=>'form-control','placeholder'=>'Meses']);!!}
                                        </div><!--span-->
                                    </div><!--row-->
                                    <div class="row" id="divacad">
                                        <div class="col-md-2">
                                            {!!Form::label('lblEnc2', 'Academia:',['class'=>'pull-right']);!!}
                                        </div><!--span-->
                                        <div class="col-md-2">
                                            {!!Form::select('idacademia',$academia, null , ['class'=>'form-control col-md-','placeholder'=>'Selecionar Academia']);!!}
                                        </div><!--span-->
                                    </div><!--row-->
                                </div>
                            </div><!--span-->
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!!Form::label('lblEnc2', 'Número de veces que postula a la Universidad Nacional de Ingeniería incluido el 2021-1');!!}
                                    <div class="row">
                                        <div class="col-md-2">
                                            {!!Form::label('lblEnc2', 'Número de veces:',['class'=>'pull-right']);!!}
                                        </div><!--span-->
                                        <div class="col-md-2">
                                            {!!Form::select('numeroveces',$veces, null , ['class'=>'form-control col-md-','placeholder'=>'Numero de veces']);!!}
                                        </div><!--span-->
                                    </div><!--row-->


                                    {!!Form::label('lblEnc2', 'Si ingresó y renunció seleccione la especialidad  a la cual ingresó, de lo contrario no seleccione nada.');!!}
                                    <div class="row">
                                        <div class="col-md-2">
                                            {!!Form::label('lblEnc2', 'Ingresé y renuncié:',['class'=>'pull-right']);!!}
                                        </div><!--span-->
                                        <div class="col-md-2">
                                            {!!Form::select('idrenuncia',$especialidad_edit, null , ['class'=>'form-control col-md-','placeholder'=>'Especialidad']);!!}
                                        </div><!--span-->
                                    </div>
                                </div><!--span-->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!!Form::label('lblEnc2', 'Indique el ingreso económico familiar aproximadamente en nuevos soles');!!}
                                        {!!Form::select('idingresoeconomico',$ingreso, null , ['class'=>'form-control col-md-','placeholder'=>'Ingreso económico']);!!}
                                    </div>
                                </div><!--span-->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!!Form::label('lblEnc2', '¿Por qué medio se informó del Concurso de Admisión 2021-1?');!!}
                                        {!!Form::select('idpublicidad',$publicidad, null , ['class'=>'form-control col-md-','placeholder'=>'Publicidad']);!!}
                                    </div>
                                </div><!--span-->
                            </div><!--row-->


                        </div>

                        {!!Form::enviar('Actualzar')!!}
                        {!! Form::close() !!}
                        @endif
                    </div>


                    <div class="tab-pane" id="tab_8">
                        {!! Form::model($postulante,['route'=>['admin.pos.update',$postulante],'method'=>'PUT']) !!}


                        <div class="row">
                            <div class="col-md-3">
                                {!! Field::text('sisfoh',['label'=>'SISFOH','placeholder'=>'SISFOH']) !!}
                            </div><!--span-->
                            <div class="col-md-3">
                                {!! Field::text('magisterio',['label'=>'PADRE O MADRE MAGISTERIO','placeholder'=>'PADRE O MADRE MAGISTERIO']) !!}


                            </div><!--span-->
                        </div><!--row-->





                        {!!Form::enviar('Actualizar')!!}
                        {!! Form::close() !!}
                    </div>






                    <div class="tab-pane" id="tab_9">

                        @if( isset($familiar[0]) )

                        {!! Form::open(['route'=>['datos.familiares.update'],'method'=>'POST','files'=>true]) !!}
                        Tus nombres y apellidos deben coincidir con el de tu DNI, los campos con asterisco son obligatorios
                        <h3 class="text-error">Datos del Padre del Postulante</h3>
                        {!!Form::hidden('id[0]', $familiar[0]->id );!!}
                        {!!Form::hidden('parentesco[0]', 'Papá' );!!}
                        {!!Form::hidden('orden[0]', 0 );!!}
                        <div class="row">
                            <div class="col-md-4">
                                {!!Field::text('paterno[0]', $familiar[0]->paterno , ['label'=>'Apellido Paterno del padre (*)','placeholder'=>'Apellido Paterno','maxlength'=>'25'])!!}
                            </div><!--span-->
                            <div class="col-md-4">
                                {!!Field::text('materno[0]', $familiar[0]->materno , ['label'=>'Apellido Materno del padre (*)','placeholder'=>'Apellido Materno','maxlength'=>'25'])!!}
                            </div><!--span-->
                            <div class="col-md-4">
                                {!!Field::text('nombres[0]', $familiar[0]->nombres , ['label'=>'Nombres del padre (*)','placeholder'=>'Nombres del Padre','maxlength'=>'50'])!!}
                            </div><!--span-->
                        </div><!--row-->
                        <div class="row">
                            <div class="col-md-4">
                                {!!Field::text('dni[0]', $familiar[0]->dni , ['label'=>'DNI del padre','placeholder'=>'DNI del Padre (*)','maxlength'=>8])!!}
                            </div><!--span-->
                            <div class="col-md-4">
                                {!!Field::text('direccion[0]', $familiar[0]->direccion , ['label'=>'Direccion del padre ','placeholder'=>'Direccion del Padre'])!!}
                            </div><!--span-->
                            <div class="col-md-4">
                                {!!Field::text('telefonos[0]', $familiar[0]->telefonos , ['label'=>'Telefonos del padre (celular/fijo/trabajo-anexo) ','placeholder'=>'Telefonos del Padre','maxlength'=>'50'])!!}
                            </div><!--span-->
                            <div class="col-md-4">
                                {!!Field::text('email[0]', $familiar[0]->email , ['label'=>'Email del padre  ','placeholder'=>'Email del Padre','maxlength'=>'90'])!!}
                            </div><!--span-->
                        </div><!--row-->
                        <h3 class="text-error">Datos de la Madre del Postulante</h3>
                        {!!Form::hidden('parentesco[1]', 'Mamá' );!!}
                        {!!Form::hidden('id[1]', $familiar[1]->id );!!}
                        <div class="row">
                            <div class="col-md-4">
                                {!!Field::text('paterno[1]', $familiar[1]->paterno , ['label'=>'Apellido Paterno de la Madre (*)','placeholder'=>'Apellido Paterno','maxlength'=>'25'])!!}
                            </div><!--span-->
                            <div class="col-md-4">
                                {!!Field::text('materno[1]', $familiar[1]->materno , ['label'=>'Apellido Materno de la Madre (*)','placeholder'=>'Apellido Materno','maxlength'=>'25'])!!}
                            </div><!--span-->
                            <div class="col-md-4">
                                {!!Field::text('nombres[1]', $familiar[1]->nombres , ['label'=>'Nombres de la Madre (*)','placeholder'=>'Nombres de la Madre','maxlength'=>'50'])!!}
                            </div><!--span-->
                        </div><!--row-->
                        <div class="row">
                            <div class="col-md-4">
                                {!!Field::text('dni[1]', $familiar[1]->dni , ['label'=>'DNI de la Madre (*)','placeholder'=>'DNI de la Madre','maxlength'=>8])!!}
                            </div><!--span-->
                            <div class="col-md-4">
                                {!!Field::text('direccion[1]', $familiar[1]->direccion , ['label'=>'Direccion de la Madre (*)','placeholder'=>'Direccion de la Madre'])!!}
                            </div><!--span-->
                            <div class="col-md-4">
                                {!!Field::text('telefonos[1]', $familiar[1]->telefonos , ['label'=>'Telefonos de la Madre (celular/fijo/trabajo-anexo) (*)','placeholder'=>'Telefonos de la Madre','maxlength'=>'50'])!!}
                            </div><!--span-->
                            <div class="col-md-4">
                                {!!Field::text('email[1]', $familiar[1]->email , ['label'=>'Email de la Madre ','placeholder'=>'Email del Padre','maxlength'=>'90'])!!}
                            </div><!--span-->
                        </div><!--row-->
                        <h3 class="text-error">Datos del apoderado</h3>
                        {!!Form::hidden('id[2]', $familiar[2]->id );!!}

                        {!!Field::select('parentesco[2]',['PAPÁ' => 'PAPÁ',
                        'MAMÁ' => 'MAMÁ',
                        'TÍO' => 'TÍO',
                        'TÍA' => 'TÍA',
                        'ABUELO' => 'ABUELO',
                        'ABUELA' => 'ABUELA',
                        'HERMANO' => 'HERMANO',
                        'HERMANA' => 'HERMANA',

                        'PRIMO' => 'PRIMO',
                        'PRIMA' => 'PRIMA',
                        'TUTOR LEGAL' => 'TUTOR LEGAL',
                        'OTRO' => 'OTRO'],$familiar[2]->parentesco,['label'=>'Escoger Parentesco del apoderado (*)','empty'=>'Escoger parentesco']);!!}
                        <div class="row">
                            <div class="col-md-4">
                                {!!Field::text('paterno[2]', $familiar[2]->paterno , ['label'=>'Apellido Paterno del apoderado (*)','placeholder'=>'Apellido Paterno del apoderado','maxlength'=>'25'])!!}
                            </div><!--span-->
                            <div class="col-md-4">
                                {!!Field::text('materno[2]', $familiar[2]->materno , ['label'=>'Apellido Materno del apoderado (*)','placeholder'=>'Apellido Materno del apoderado','maxlength'=>'25'])!!}
                            </div><!--span-->
                            <div class="col-md-4">
                                {!!Field::text('nombres[2]', $familiar[2]->nombres , ['label'=>'Nombres del apoderado (*)','placeholder'=>'Nombres del apoderado','maxlength'=>'50'])!!}
                            </div><!--span-->
                        </div><!--row-->
                        <div class="row">
                            <div class="col-md-4">
                                {!!Field::text('dni[2]', $familiar[2]->dni , ['label'=>'DNI del apoderado (*)','placeholder'=>'DNI del apoderado','maxlength'=>8])!!}
                            </div><!--span-->
                            <div class="col-md-4">
                                {!!Field::text('direccion[2]', $familiar[2]->direccion , ['label'=>'Direccion del apoderado ','placeholder'=>'Direccion del apoderado'])!!}
                            </div><!--span-->
                            <div class="col-md-4">
                                {!!Field::text('telefonos[2]', $familiar[2]->telefonos , ['label'=>'Telefonos del apoderado (celular/fijo/trabajo-anexo) (*)','placeholder'=>'Telefonos del apoderado','maxlength'=>'50'])!!}
                            </div><!--span-->
                            <div class="col-md-4">
                                {!!Field::text('email[2]', $familiar[2]->email , ['label'=>'Email del apoderado ','placeholder'=>'Email del apoderado','maxlength'=>'90'])!!}
                            </div><!--span-->
                        </div><!--row-->


                        {!!Form::enviar('Actualizar')!!}
                        {!! Form::close() !!}

                            @endif
                    </div>
                    <div class="tab-pane" id="tab_10">
                        {!! Form::model($postulante,['route'=>['admin.pos.update',$postulante],'method'=>'PUT']) !!}



                        <div class="row">
                            <div class="col-md-4">
                                {!! Field::text('paterno',['label'=>'Apellido Paterno','placeholder'=>'Apellido Paterno']) !!}
                            </div><!--span-->
                            <div class="col-md-4">
                                {!! Field::text('materno',['label'=>'Apellido Materno','placeholder'=>'Apellido Materno']) !!}
                            </div><!--span-->
                            <div class="col-md-4">
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
                                {!! Field::text('fecha_nacimiento',['label'=>'Fecha de Nacimiento','placeholder'=>'Fecha de Nacimiento']) !!}
                            </div><!--span-->
                        </div><!--row-->


                        {!!Form::enviar('Actualizar')!!}
                        {!! Form::close() !!}
                    </div>

                    <div class="tab-pane" id="tab_11">
                        <div class="row">





                            <div class="col-md-12">
                                <h2><b>DOCUMENTOS CARGADOS</b></h2>





                                <div class="row">
                                    <div class="col-12">

                                        <h1>Certificado de estudios</h1>



                                        @foreach($documentos as $rs)
                                            @if($rs->tipo==2)

                                                <a class="" style="cursor: pointer;" target="_blank" href="{{ asset('/storage/'.$rs->documento) }}">
                                                    <div>
                                                        <iframe style="cursor: pointer;" src="{{ asset('/storage/'.$rs->documento) }}" width="auto;"></iframe>

                                                    </div>
                                                    <h1>VER</h1>
                                                </a>
                                                @if(substr($rs->documento,strpos($rs->documento,'.')) == '.pdf' || substr($rs->documento,strpos($rs->documento,'.'))=='.PDF' || substr($rs->documento,strpos($rs->documento,'.'))=='.bin')


                                                @else

                                                @endif
                                            @endif
                                        @endforeach

                                        <h3>Imágenes</h3>
                                        <div id="galley">
                                            <ul class="pictures">
                                                @foreach($documentos as $rs)
                                                    @if($rs->tipo==2)
                                                        @if(substr($rs->documento,strpos($rs->documento,'.')) == '.pdf' || substr($rs->documento,strpos($rs->documento,'.'))=='.PDF')


                                                        @else
                                                            <img style="cursor: pointer;"  class="img-responsive" alt="" src="{{ asset('/storage/'.$rs->documento) }}" />

                                                        @endif
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-12">

                                        <h1>Ficha de Inscripción firmada</h1>



                                        @foreach($documentos as $rs)
                                            @if($rs->tipo==3)
                                                @if(substr($rs->documento,strpos($rs->documento,'.')) == '.pdf' || substr($rs->documento,strpos($rs->documento,'.'))=='.PDF')
                                                    <a class="" style="cursor: pointer;" target="_blank" href="{{ asset('/storage/'.$rs->documento) }}">
                                                        <div>
                                                            <iframe style="cursor: pointer;" src="{{ asset('/storage/'.$rs->documento) }}" width="auto;"></iframe>

                                                        </div>
                                                        <h1>VER</h1>
                                                    </a>

                                                @else

                                                @endif
                                            @endif
                                        @endforeach

                                        <h3>Imágenes</h3>
                                        <div id="galley">
                                            <ul class="pictures">
                                                @foreach($documentos as $rs)
                                                    @if($rs->tipo==3)
                                                        @if(substr($rs->documento,strpos($rs->documento,'.')) == '.pdf' || substr($rs->documento,strpos($rs->documento,'.'))=='.PDF')


                                                        @else
                                                            <img style="cursor: pointer;"  class="img-responsive" alt="" src="{{ asset('/storage/'.$rs->documento) }}" />

                                                        @endif
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>

                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-12">

                                        <h1>DNI</h1>



                                        @foreach($documentos as $rs)
                                            @if($rs->tipo==4)
                                                @if(substr($rs->documento,strpos($rs->documento,'.')) == '.pdf' || substr($rs->documento,strpos($rs->documento,'.'))=='.PDF')
                                                    <a class="" style="cursor: pointer;" target="_blank" href="{{ asset('/storage/'.$rs->documento) }}">
                                                        <div>
                                                            <iframe style="cursor: pointer;" src="{{ asset('/storage/'.$rs->documento) }}" width="auto;"></iframe>

                                                        </div>
                                                        <h1>VER</h1>
                                                    </a>

                                                @else

                                                @endif
                                            @endif
                                        @endforeach

                                        <h3>Imágenes</h3>
                                        <div id="galley">
                                            <ul class="pictures">
                                                @foreach($documentos as $rs)
                                                    @if($rs->tipo==4)
                                                        @if(substr($rs->documento,strpos($rs->documento,'.')) == '.pdf' || substr($rs->documento,strpos($rs->documento,'.'))=='.PDF')


                                                        @else
                                                            <img style="cursor: pointer;"  class="img-responsive" alt="" src="{{ asset('/storage/'.$rs->documento) }}" />

                                                        @endif
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>

                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-12">

                                        <h1>OTROS DOCUMENTOS</h1>



                                        @foreach($documentos as $rs)
                                            @if($rs->tipo==5)
                                                @if(substr($rs->documento,strpos($rs->documento,'.')) == '.pdf' || substr($rs->documento,strpos($rs->documento,'.'))=='.PDF')
                                                    <a class="" style="cursor: pointer;" target="_blank" href="{{ asset('/storage/'.$rs->documento) }}">
                                                        <div>
                                                            <iframe style="cursor: pointer;" src="{{ asset('/storage/'.$rs->documento) }}" width="auto;"></iframe>

                                                        </div>
                                                        <h1>VER</h1>
                                                    </a>

                                                @else

                                                @endif
                                            @endif
                                        @endforeach

                                        <h3>Imágenes</h3>
                                        <div id="galley">
                                            <ul class="pictures">
                                                @foreach($documentos as $rs)
                                                    @if($rs->tipo==5)
                                                        @if(substr($rs->documento,strpos($rs->documento,'.')) == '.pdf' || substr($rs->documento,strpos($rs->documento,'.'))=='.PDF')


                                                        @else
                                                            <img style="cursor: pointer;"  class="img-responsive" alt="" src="{{ asset('/storage/'.$rs->documento) }}" />

                                                        @endif
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>

                                    </div>

                                </div>


                                @if($documentos->count() < 0)
                                    <div class="note note-danger">
                                        <h3>El solicitante aún no ha cargado sus documentos. </h3>
                                        <p> <b>DEBE CARGAR TODOS LOS DOCUMENTOS PARA QUE PUEDA SER EVALUADO. </b>  </p>
                                    </div>
                                @endif



                            </div>


                        </div>



                    </div>




                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="verimagen" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">IMAGEN</h4>
                </div>
                <div class="modal-body">
                    <img id="imagen" style="height: 400px" alt="" >
                </div>
                <div class="modal-footer">
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@stop
@section('js-scripts')
    <script src="{{asset('js/fileinput.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/es.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/fa/theme.js')}}" type="text/javascript"></script>
    <script>

        function convert( src){

        }

        $(window).on('load', function() {
            $('#verimagen').on('show.bs.modal', function (e) {
                var foto = $(e.relatedTarget).data('imagen');
                $(e.currentTarget).find('#imagen').attr("src",foto);
            });

            $(".Ubigeo").select2({
                width:'auto',
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


        });


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





    </script>

    <script>
        $("#Buscar").click(function() {


            var estado =  $('#txtestado').val();
            if (estado == '') {
                swal("SELECCIONE EL ESTADO", "DEBE SELECCIONAR EL ESTADO.", "warning");
                return false;
            }

            $.ajax({
                url: '{{ url('admin/registrar-asistencia') }}',
                type: 'GET',
                data: {

                    dni: $('#txtdni').val(),
                    estado:estado,
                    observacion: $('#txtobs').val()
                },
            })
                .done(function(data) {
                    swal("REGISTRO CORRECTO", "Registro correcto.", "success");
                    console.log(data);
                })
                .fail(function() {
                    swal("UPS!!", "Ocurrió un error, intente nuevamente.", "error");
                });
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
