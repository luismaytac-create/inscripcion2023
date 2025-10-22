@extends('layouts.base')

@section('content')

    <div class="m-content">


        <!--begin::Portlet-->
        <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">

            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="flaticon-statistics"></i>
												</span>
                        <h2 class="lead">
                            Ingresa <u><strong>los datos del postulante</strong></u> (NO EL DE TU APODERADO).
                        </h2>
                        <div class="actions">
                            {!!Form::back(route('datos.index'))!!}
                        </div>
                        <h2 class="m-portlet__head-label m-portlet__head-label--danger">
                            <span>DATOS PERSONALES</span>
                        </h2>
                    </div>
                </div>

            </div>

            <div class="m-portlet__body lead">
                {!! Alert::render() !!}
                @include('alerts.errors')
                {!! Form::model($postulante,['route'=>['datos.postulante.update',$postulante],'method'=>'PUT']) !!}

                <dl>
                    <dt>Observación</dt>
                    <dd>Los nombres y apellidos deben coincidir de tu DNI, <strong>todos los campos con (*) son
                            obligatorios.</strong></dd>
                </dl>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!!Form::hidden('idtipoidentificacion', IdTCCodigo('IDENTIFICACION','DNI') );!!}
                            {!!Form::hidden('numero_identificacion',Auth::user()->dni, ['class'=> 'dni'] );!!}
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
                            {!!Field::text('nombres', null , ['label'=>'Nombres del postulante (*)','placeholder'=>'Nombres del postulante','maxlength'=>'60']);!!}
                        </div>
                    </div><!--span-->
                </div><!--row-->
                <h3>Modalidad de Postulación según el reglamento</h3>
                <div class="row">
                    <div class="col-md-6">
                        {!!Field::select('idmodalidad',$modalidad,['label'=>'Escoger Modalidad (*)','empty'=>'Escoger modalidad de postulación']);!!}
                    </div><!--span-->

                </div><!--row-->


                <h3 class="div0">Facultad a la que postulas</h3>

                <div class="row m--margin-top-15 m--margin-bottom-15 div0">
                    <div class="col-md-6 ">
                        <select class="form-control border-success" id="facultades" name="facultades">
                            <option value="">Escoger la Facultad de postulación</option>

                        </select>

                    </div>

                </div>
                <h3 class="div1" style="display: none;">Especialidad a la que postulas</h3>
                <dl class="div1" style="display: none;">
                    <dt>Observación</dt>
                    <dd>Puedes seleccionar hasta 2 especialidades de las que brinda la Facultad, en orden de
                        prioridad.<strong></strong></dd>
                </dl>


                <div id="div1" class="row m--margin-top-15 m--margin-bottom-15" style="display: none;">
                    <div class="col-md-6">
                        <select class="form-control" id="especialidad" name="especialidad">
                            <option value="">Escoger la Especialidad de postulación</option>

                        </select>

                    </div>
                    <div style="display: none;" class="col-md-6" id="pregunta1">
                        <h4>¿ Deseas agregar otra prioridad?</h4>
                        <button id="agregar1" type="button"
                                class="btn btn-info m-btn 	m-btn m-btn--icon m-btn--pill">
															<span>
																<i class="la la-plus"></i>
																<span>AGREGAR</span>
															</span>
                        </button>
                    </div>

                </div>
                <div id="div2" class="row m--margin-top-15 m--margin-bottom-15" style="display: none;">
                    <div class="col-md-6">
                        <select class="form-control" id="especialidad2" name="especialidad2">
                            <option value="">Escoger la segunda prioridad de postulación</option>

                        </select>

                    </div>

                    <div style="display: none;" class="col-md-3" id="quitarpregunta2">
                        <h4>¿ Deseas quitar la segunda prioridad?</h4>
                        <button id="quitar2" type="button"
                                class="btn btn-danger m-btn 	m-btn m-btn--icon m-btn--pill">
															<span>
																<i class="la la-trash"></i>
																<span>QUITAR</span>
															</span>
                        </button>
                    </div>

                </div>


                <div class="widget-thumb bordered bg-green cepreuni">
                    <hr>
                    <h3>Segunda Modalidad</h3>
                    <div class="row">
                        <div class="col-md-6 ">
                            {!!Field::text('codigo_verificacion',null,['label'=>'Ingresa tu código de CEPRE-UNI (últimos 6 dígitos). Ejemplo: 10021J','placeholder'=>'Ingresar código de CEPRE-UNI','maxlength'=>'12']);!!}
                        </div><!--span-->
                    </div><!--row-->
                    <div class="row">
                        <div class="col-md-6">
                            {!!Field::select('idmodalidad2',$segunda_modalidad_cepre,['label'=>'Escoger segunda Modalidad (Solo para alumnos de CEPRE-UNI)','empty'=>'Escoger segunda modalidad de postulación (Solo para alumnos de CEPRE-UNI)']);!!}
                        </div><!--span-->

                    </div><!--row-->

                    <h3 class="div0cepre">Facultad a la que postulas</h3>

                    <div class="row m--margin-top-15 m--margin-bottom-15 div0">
                        <div class="col-md-6 ">
                            <select class="form-control border-success" id="facultades2" name="facultades2">
                                <option value="">Escoger la Facultad de postulación</option>

                            </select>

                        </div>

                    </div>


                    <h3 class="div1cepre" style="display: none;">Especialidad a la que postulas</h3>
                    <dl class="div1cepre" style="display: none;">
                        <dt>Observación</dt>
                        <dd>Puedes seleccionar hasta 2 especialidades de las que brinda la Facultad, en orden de
                            prioridad.<strong></strong></dd>
                    </dl>


                    <div id="div1cepre" class="row m--margin-top-15 m--margin-bottom-15" style="display: none;">
                        <div class="col-md-6">
                            <select class="form-control" id="especialidad4" name="especialidad4">
                                <option value="">Escoger la Especialidad de postulación</option>

                            </select>

                        </div>
                        <div style="display: none;" class="col-md-6" id="pregunta1cepre">
                            <h4>¿ Deseas agregar otra prioridad?</h4>
                            <button id="agregar1cepre" type="button"
                                    class="btn btn-info m-btn 	m-btn m-btn--icon m-btn--pill">
															<span>
																<i class="la la-plus"></i>
																<span>AGREGAR</span>
															</span>
                            </button>
                        </div>

                    </div>
                    <div id="div2cepre" class="row m--margin-top-15 m--margin-bottom-15" style="display: none;">
                        <div class="col-md-6">
                            <select class="form-control" id="especialidad5" name="especialidad5">
                                <option value="">Escoger la segunda prioridad de postulación</option>

                            </select>

                        </div>

                        <div style="display: none;" class="col-md-3" id="quitarpregunta2cepre">
                            <h4>¿ Deseas quitar la segunda prioridad?</h4>
                            <button id="quitar2cepre" type="button"
                                    class="btn btn-danger m-btn 	m-btn m-btn--icon m-btn--pill">
															<span>
																<i class="la la-trash"></i>
																<span>QUITAR</span>
															</span>
                            </button>
                        </div>

                    </div>


                </div>


                <h3>Institución Educativa donde culminó la secundaria</h3>
                <dl>
                    <dt>Observación</dt>
                    <dd>Es tu responsabilidad seleccionar correctamente la Institución Educativa de donde procede.
                        <strong>El cambio de gestión de las instituciones Educativas (pública o privada) implica
                            realizar el pago correspondiente.</strong></dd>
                </dl>


                <div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">
                    <div class="m-demo__preview">
                        <blockquote class="blockquote">
                            <p class="mb-0"><strong></strong> Los pagos realizados a favor de la Universidad por los
                                conceptos establecidos en el Concurso de Admisión, se realizan en las entidades
                                financieras que la Universidad autorice. Los pagos efectuados no serán reembolsados.</p>
                            <footer class="blockquote-footer"><cite title="Source Title">Reglamento del Concurso de
                                    Admisión</cite></footer>
                        </blockquote>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 Colegio">
                        <div id="depacoldiv" class="col-md-12">

                            {!!Field::select('iddepacolegio',$depas,ColegioDepartamento($postulante->idcolegio) ,['label'=>'Escoger Departamento del colegio(*)','empty'=>'Escoger departamento del colegio']);!!}


                        </div>

                        <div id="colediv" class="col-md-12">


                            @if(Request::old('idcolegio') == NULL)

                                {!!Field::select('idcolegio',ColegioPersonal($postulante->idcolegio),['style'=>'width: 100%','label'=>'Escoger el colegio(*)']);!!}
                            @endif

                            @if(Request::old('idcolegio') != NULL)

                                {!!Field::select('idcolegio',ColegioPersonal(Request::old('idcolegio')),['style'=>'width: 100%','label'=>'Escoger el colegio']);!!}
                            @endif


                        </div>
                        <div id="colediv" class="col-md-12">
                            @if(Request::old('idsede') == NULL)
                                {!! Field::select(
                                        'idsede',
                                        $sedes,
                                        isset($postulante) ? $postulante->idsede : null, // o old('idsede')
                                        ['style' => 'width: 100%', 'label' => 'Escoger Sede(*)']
                                    ) !!}
                            @endif
                        </div>


                    </div><!--span-->
                    <div class="col-md-6 Universidad">


                        @if(Request::old('iduniversidad') == NULL)

                            {!!Field::select('iduniversidad',UniversidadPersonal($postulante->iduniversidad),['style'=>'width: 100%','label'=>'Escoger Universidad(*)']);!!}
                        @endif

                        @if(Request::old('iduniversidad') != NULL)

                            {!!Field::select('iduniversidad',UniversidadPersonal(Request::old('iduniversidad')),['style'=>'width: 100%','label'=>'Escoger Universidad']);!!}
                        @endif


                    </div><!--span-->
                </div><!--row-->

                <button id="guardar" type="button" class="btn btn-success m-btn 	m-btn m-btn--icon m-btn--pill">
															<span>
																<i class="la la-save"></i>
																<span>Guardar</span>
															</span>
                </button>


                <div class="modal fade" id="modal_confirmacion" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Confirmación de datos</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">


                                <div class="form-group">


                                    <h2 class="bold">¿Estas seguro que los siguientes datos son correctos? </h2>
                                </div>
                                <div class="invoice-content-2 bordered">
                                    <div class="row invoice-body">
                                        <div class="col-xs-12 table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th class="invoice-title uppercase"></th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr id="trtitu" style="display: none;" class="m--font-info">
                                                    <td>

                                                        <h3 id="txttitu"></h3>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>

                                                        <h3 id="txtdatos">Apellidos y Nombres : </h3>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td>

                                                        <h3 id="txtdni"></h3>
                                                    </td>

                                                </tr>
                                                <tr id="trmoda1" style="display: none;" class="m--font-success">
                                                    <td>
                                                        <h3 id="txtmoda1"></h3>
                                                    </td>
                                                </tr>
                                                <tr id="trop1" style="display: none;" class="m--font-success">
                                                    <td>

                                                        <h3 id="txtop1"></h3>
                                                    </td>

                                                </tr>
                                                <tr id="trop2" style="display: none;" class="m--font-success">
                                                    <td>

                                                        <h3 id="txtop2"></h3>
                                                    </td>

                                                </tr>


                                                <tr id="trmoda2" style="display: none;" class="m--font-info">
                                                    <td>
                                                        <h3 id="txtmoda2"></h3>
                                                    </td>
                                                </tr>
                                                <tr id="trop4" style="display: none;" class="m--font-info">
                                                    <td>

                                                        <h3 id="txtop4"></h3>
                                                    </td>

                                                </tr>
                                                <tr id="trop5" style="display: none;" class="m--font-info">
                                                    <td>

                                                        <h3 id="txtop5"></h3>
                                                    </td>

                                                </tr>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                </div>


                            </div>
                            <div class="modal-footer">

                                <div class="row" style="width: 100%;">
                                    <div class="col-md-6 text-left">

                                        <button type="submit"
                                                class="btn btn-success btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
                                            CONFIRMAR
                                        </button>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button type="button" data-dismiss="modal"
                                                class="btn btn-danger btn-focus m-btn m-btn--pill m-btn--custom m-btn--air"
                                                form="form-register">Corregir datos
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>


        </div>
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
                    <h3><strong id="parraf"> </strong></h3>
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
    <!-- Modal -->
    <div class="modal fade" id="modal_agregar_1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Agregar una prioridad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="form-group">


                        <label class="bold">¿Estas seguro de agregar la segunda prioridad de especialidad? </label>

                        <label><strong>Recuerda que la elección de una segunda prioridad no es
                                obligatoria.</strong></label>


                    </div>


                </div>
                <div class="modal-footer">

                    <div class="row" style="width: 100%;">
                        <div class="col-md-6 text-left">
                            <button type="button" id="confirma1"
                                    class="btn btn-success btn-focus m-btn m-btn--pill m-btn--custom m-btn--air"
                                    form="form-register">Agregar prioridad
                            </button>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" data-dismiss="modal"
                                    class="btn btn-danger btn-focus m-btn m-btn--pill m-btn--custom m-btn--air"
                                    form="form-register">Cancelar
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <!--end::Modal-->
    <!-- Modal -->
    <div class="modal fade" id="modal_agregar_2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Agregar una prioridad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="form-group">


                        <label class="bold">¿Estas seguro de agregar la tercera prioridad de especialidad? </label>

                        <label><strong>Recuerda que la elección de una tercera prioridad no es
                                obligatoria.</strong></label>


                    </div>


                </div>
                <div class="modal-footer">

                    <div class="row" style="width: 100%;">
                        <div class="col-md-6 text-left">
                            <button type="button" id="confirma2"
                                    class="btn btn-success btn-focus m-btn m-btn--pill m-btn--custom m-btn--air"
                                    form="form-register">Agregar prioridad
                            </button>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" data-dismiss="modal"
                                    class="btn btn-danger btn-focus m-btn m-btn--pill m-btn--custom m-btn--air"
                                    form="form-register">Cancelar
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--end::Modal-->



    <!-- Modal -->
    <div class="modal fade" id="modal_quitar_3" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Quitar una prioridad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="form-group">


                        <label class="bold">¿Estas seguro de quitar la tercera prioridad de especialidad? </label>

                        <label><strong>Recuerda que la elección de una tercera prioridad no es
                                obligatoria.</strong></label>


                    </div>


                </div>
                <div class="modal-footer">

                    <div class="row" style="width: 100%;">
                        <div class="col-md-6 text-left">
                            <button type="button" id="confirmaquitar3"
                                    class="btn btn-success btn-focus m-btn m-btn--pill m-btn--custom m-btn--air"
                                    form="form-register">Quitar prioridad
                            </button>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" data-dismiss="modal"
                                    class="btn btn-danger btn-focus m-btn m-btn--pill m-btn--custom m-btn--air"
                                    form="form-register">Cancelar
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--end::Modal-->

    <!-- Modal -->
    <div class="modal fade" id="modal_quitar_2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Quitar una prioridad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="form-group">


                        <label class="bold">¿Estas seguro de quitar la segunda prioridad de especialidad? </label>

                        <label><strong>Recuerda que la elección de una segunda prioridad no es
                                obligatoria.</strong></label>


                    </div>


                </div>
                <div class="modal-footer">

                    <div class="row" style="width: 100%;">
                        <div class="col-md-6 text-left">
                            <button type="button" id="confirmaquitar2"
                                    class="btn btn-success btn-focus m-btn m-btn--pill m-btn--custom m-btn--air"
                                    form="form-register">Quitar prioridad
                            </button>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" data-dismiss="modal"
                                    class="btn btn-danger btn-focus m-btn m-btn--pill m-btn--custom m-btn--air"
                                    form="form-register">Cancelar
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- CEPRE -->


    <div class="modal fade" id="modal_agregar_1cepre" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Agregar una prioridad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="form-group">


                        <label class="bold">¿Estas seguro de agregar la segunda prioridad de especialidad? </label>

                        <label><strong>Recuerda que la elección de una segunda prioridad no es
                                obligatoria.</strong></label>


                    </div>


                </div>
                <div class="modal-footer">

                    <div class="row" style="width: 100%;">
                        <div class="col-md-6 text-left">
                            <button type="button" id="confirma1cepre"
                                    class="btn btn-success btn-focus m-btn m-btn--pill m-btn--custom m-btn--air"
                                    form="form-register">Agregar prioridad
                            </button>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" data-dismiss="modal"
                                    class="btn btn-danger btn-focus m-btn m-btn--pill m-btn--custom m-btn--air"
                                    form="form-register">Cancelar
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--end::Modal-->
    <!-- Modal -->
    <div class="modal fade" id="modal_agregar_2cepre" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Agregar una prioridad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="form-group">


                        <label class="bold">¿Estas seguro de agregar la tercera prioridad de especialidad? </label>

                        <label><strong>Recuerda que la elección de una tercera prioridad no es
                                obligatoria.</strong></label>


                    </div>


                </div>
                <div class="modal-footer">

                    <div class="row" style="width: 100%;">
                        <div class="col-md-6 text-left">
                            <button type="button" id="confirma2cepre"
                                    class="btn btn-success btn-focus m-btn m-btn--pill m-btn--custom m-btn--air"
                                    form="form-register">Agregar prioridad
                            </button>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" data-dismiss="modal"
                                    class="btn btn-danger btn-focus m-btn m-btn--pill m-btn--custom m-btn--air"
                                    form="form-register">Cancelar
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--end::Modal-->



    <!-- Modal -->
    <div class="modal fade" id="modal_quitar_3cepre" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Quitar una prioridad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="form-group">


                        <label class="bold">¿Estas seguro de quitar la tercera prioridad de especialidad? </label>

                        <label><strong>Recuerda que la elección de una tercera prioridad no es
                                obligatoria.</strong></label>


                    </div>


                </div>
                <div class="modal-footer">

                    <div class="row" style="width: 100%;">
                        <div class="col-md-6 text-left">
                            <button type="button" id="confirmaquitar3cepre"
                                    class="btn btn-success btn-focus m-btn m-btn--pill m-btn--custom m-btn--air"
                                    form="form-register">Quitar prioridad
                            </button>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" data-dismiss="modal"
                                    class="btn btn-danger btn-focus m-btn m-btn--pill m-btn--custom m-btn--air"
                                    form="form-register">Cancelar
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--end::Modal-->

    <!-- Modal -->
    <div class="modal fade" id="modal_quitar_2cepre" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Quitar una prioridad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="form-group">


                        <label class="bold">¿Estas seguro de quitar la segunda prioridad de especialidad? </label>

                        <label><strong>Recuerda que la elección de una segunda prioridad no es
                                obligatoria.</strong></label>


                    </div>


                </div>
                <div class="modal-footer">

                    <div class="row" style="width: 100%;">
                        <div class="col-md-6 text-left">
                            <button type="button" id="confirmaquitar2cepre"
                                    class="btn btn-success btn-focus m-btn m-btn--pill m-btn--custom m-btn--air"
                                    form="form-register">Quitar prioridad
                            </button>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" data-dismiss="modal"
                                    class="btn btn-danger btn-focus m-btn m-btn--pill m-btn--custom m-btn--air"
                                    form="form-register">Cancelar
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@stop

@section('js-scripts')

    <script>


        var espes;
        var espesfacu = [];
        var opcion1;
        var opcion2;
        var opcion3;

        function iniciarnormal(a) {
            console.log('inicio');
            console.log(espes);
            espes = a;
            console.log(espes);
        }


        $("#facultades").change(function () {
            espesfacu = [];
            var id = $('#facultades').val();
            limpiarSelects();
            ocualtarOpciones();
            limpiarPasos();


            if (id != "") {
                cargarEspecialidad(id);
            } else {
                ocualtarOpciones();
            }


        });


        function ocualtarOpciones() {
            $('#div1').hide();
            $('#div2').hide();
            $('#div3').hide();
            $('#pregunta1').hide();
            $('#pregunta2').hide();
            $('.div1').hide();
        }

        function limpiarPasos() {
            opcion2 = false;
            opcion3 = false;

        }

        function limpiarSelects() {
            $('#especialidad')
                .empty()
                .append('<option selected="selected" value="">Escoger la especialidad de primera prioridad</option>')
            ;
            $('#especialidad2')
                .empty()
                .append('<option selected="selected" value="">Escoger la especialidad de segunda prioridad</option>')
            ;
            $('#especialidad3')
                .empty()
                .append('<option selected="selected" value="">Escoger la especialidad de tercera prioridad</option>')
            ;

        }

        function cargarEspecialidad(facultad) {

            $('#div1').show();
            $('.div1').show();

            $('#especialidad')
                .empty()
                .append('<option selected="selected" value="">Escoger la especialidad de primera prioridad</option>');

            var restringe_modalidad = [5, 6, 7, 10, 19];
            var restringe = [2, 7, 32, 33];
            var idmodalidad = $('#idmodalidad').val();

            $('#idmodalidad').change(function () {
                // Obtener el valor seleccionado
                idmodalidad = $(this).val();

                for (var key in espes.data) {
                    if (espes.data[key].idfacultad == facultad) {
                        //console.log(espes.data[key].idfacultad);
                        if (!restringe.includes(espes.data[key].id) && !restringe_modalidad.includes(idmodalidad)) {
                            espesfacu.push(espes.data[key]);
                            var nom = espes.data[key].nombre;
                            var id = espes.data[key].id;
                            $('#especialidad').append('<option value=' + id + '>' + nom + '</option>');
                        }
                    }
                }
            });

            for (var key in espes.data) {
                if (espes.data[key].idfacultad == facultad) {

                    espesfacu.push(espes.data[key]);
                    var nom = espes.data[key].nombre;
                    var id = espes.data[key].id;
                    $('#especialidad').append('<option value=' + id + '>' + nom + '</option>');

                }

            }


        }

        function validarCantidadEspecialidad() {


            switch (espesfacu.length) {
                case 1:
                    $('#pregunta1').hide();
                    break;

                case 2:
                    $('#pregunta1').show();
                    break;
                case 0 :
                    break;
                default:
                    $('#pregunta1').show();
                    break;
            }

        }

        function validarCantidadEspecialidad2(array) {


            switch (array.length) {
                case 1:
                    $('#pregunta2').hide();
                    break;

                case 2:
                    $('#pregunta2').show();
                    break;
                case 0 :
                    break;
                default:
                    $('#pregunta2').show();
                    break;
            }

        }


        function cargarEspecialidad2(facultad) {

            $('#especialidad2')
                .empty()
                .append('<option selected="selected" value="">Escoger la especialidad de segunda prioridad</option>')
            ;

            var datasx = quitarEspecialidad1();

            for (var key in datasx) {

                if (datasx[key].idfacultad == facultad) {
                    var nom = datasx[key].nombre;
                    var id = datasx[key].id;
                    $('#especialidad2').append('<option value=' + id + '>' + nom + '</option>');
                }

            }


        }

        function cargarEspecialidad3(facultad) {

            $('#especialidad3')
                .empty()
                .append('<option selected="selected" value="">Escoger la especialidad de tercera prioridad</option>')
            ;

            $('#quitarpregunta3').show();
            var datasx1 = quitarEspecialidad1();
            var datasx = quitarEspecialidad2(datasx1);
            for (var key in datasx) {

                if (datasx[key].idfacultad == facultad) {
                    var nom = datasx[key].nombre;
                    var id = datasx[key].id;
                    $('#especialidad3').append('<option value=' + id + '>' + nom + '</option>');
                }

            }


        }


        function quitarEspecialidad1() {

            var espe1 = $('#especialidad').val();
            var data = $.grep(espesfacu, function (e) {
                return e.id != espe1;
            });
            return data;

        }

        function quitarEspecialidad2(array) {

            var espe2 = $('#especialidad2').val();
            var data = $.grep(array, function (e) {
                return e.id != espe2;
            });
            return data;

        }

        function prepararEspecialidad() {
            $('#especialidad2')
                .empty()
                .append('<option selected="selected" value="">Escoger la especialidad de primera prioridad</option>')
            ;
            $('#especialidad3')
                .empty()
                .append('<option selected="selected" value="">Escoger la especialidad de primera prioridad</option>')
            ;
            $('#pregunta1').hide();
            $('#pregunta2').hide();
            $('#pregunta3').hide();
            $('#div2').hide();
            $('#div3').hide();

        }


        $("#especialidad").change(function () {
            if ($('#especialidad').val() != "") {
                validarCantidadEspecialidad();
            } else {

                prepararEspecialidad();
            }
            if (opcion2) {
                var id = $('#facultades').val();
                cargarEspecialidad2(id);

            }
            if (opcion3) {
                $('#especialidad3')
                    .empty()
                    .append('<option selected="selected" value="">Escoger la especialidad de tercera prioridad</option>')
                ;
            }


        });


        $("#especialidad2").change(function () {
            if ($('#especialidad2').val() != "") {
                var datasx = quitarEspecialidad1();
                validarCantidadEspecialidad2(datasx);
            } else {
                $('#pregunta2').hide();
            }
            if (opcion3) {
                var id = $('#facultades').val();
                cargarEspecialidad3(id);

            }


        });


        $('#confirma1').click(function () {
            $('#div2').show();

            $('#quitarpregunta2').show();
            $('#modal_agregar_1').modal('hide');
            var id = $('#facultades').val();
            cargarEspecialidad2(id);
            opcion2 = true;


            $('#pregunta2').hide();
            $('#pregunta1').hide();
        });

        $('#confirma2').click(function () {
            $('#div3').show();
            $('#modal_agregar_2').modal('hide');
            var id = $('#facultades').val();
            cargarEspecialidad3(id);
            opcion3 = true;

        });


        $('#confirmaquitar3').click(function () {
            $('#div3').hide();
            $('#modal_quitar_3').modal('hide');
            $('#especialidad3')
                .empty()
                .append('<option selected="selected" value="">Escoger la especialidad de tercera prioridad</option>')
            ;
            opcion3 = false;

        });


        $('#confirmaquitar2').click(function () {
            $('#div3').hide();
            $('#div2').hide();
            $('#modal_quitar_2').modal('hide');
            $('#especialidad3')
                .empty()
                .append('<option selected="selected" value="">Escoger la especialidad de tercera prioridad</option>')
            ;$('#especialidad2')
                .empty()
                .append('<option selected="selected" value="">Escoger la especialidad de segunda prioridad</option>')
            ;
            opcion3 = false;
            opcion2 = false;
            $('#pregunta1').show();

        });

        $('#agregar1').click(function () {
            $('#modal_agregar_1').modal({
                keyboard: false,
                backdrop: 'static'
            });
        });
        $('#agregar2').click(function () {
            $('#modal_agregar_2').modal({
                keyboard: false,
                backdrop: 'static'
            });
        });

        $('#quitar3').click(function () {
            $('#modal_quitar_3').modal({
                keyboard: false,
                backdrop: 'static'
            });
        });
        $('#quitar2').click(function () {
            $('#modal_quitar_2').modal({
                keyboard: false,
                backdrop: 'static'
            });
        });
    </script>





    <script>


        var espescepre;
        var espesfacucepre = [];
        var opcion1cepre;
        var opcion2cepre;
        var opcion3cepre;
        $.ajax({
            url: '{{ "especialidades" }}',
            success: function (respuesta) {

                espescepre = respuesta;

            },
            error: function () {
                console.log("No se ha podido obtener la información");
                location.reload();
            }
        });

        $("#facultades2").change(function () {
            espesfacucepre = [];
            var id = $('#facultades2').val();
            limpiarSelectscepre();
            ocualtarOpcionescepre();
            limpiarPasoscepre();


            if (id != "") {
                cargarEspecialidadcepre(id);
            } else {
                ocualtarOpcionescepre();
            }


        });


        function ocualtarOpcionescepre() {
            $('#div1cepre').hide();
            $('#div2cepre').hide();
            $('#div3cepre').hide();
            $('#pregunta1cepre').hide();
            $('#pregunta2cepre').hide();
            $('.div1cepre').hide();
        }

        function limpiarPasoscepre() {
            opcion2cepre = false;
            opcion3cepre = false;

        }

        function limpiarSelectscepre() {
            $('#especialidad4')
                .empty()
                .append('<option selected="selected" value="">Escoger la especialidad de primera prioridad</option>')
            ;
            $('#especialidad5')
                .empty()
                .append('<option selected="selected" value="">Escoger la especialidad de segunda prioridad</option>')
            ;
            $('#especialidad6')
                .empty()
                .append('<option selected="selected" value="">Escoger la especialidad de tercera prioridad</option>')
            ;

        }


        function cargarEspecialidadcepre(facultad) {

            $('#div1cepre').show();
            $('.div1cepre').show();

            $('#especialidad4')
                .empty()
                .append('<option selected="selected" value="">Escoger la especialidad de primera prioridad</option>');


            for (var key in espescepre.data) {

                if (espescepre.data[key].idfacultad == facultad) {
                    espesfacucepre.push(espescepre.data[key]);
                    var nom = espescepre.data[key].nombre;
                    var id = espescepre.data[key].id;
                    $('#especialidad4').append('<option value=' + id + '>' + nom + '</option>');
                }

            }


        }


        function validarCantidadEspecialidadcepre() {


            switch (espesfacucepre.length) {
                case 1:
                    $('#pregunta1cepre').hide();
                    break;

                case 2:
                    $('#pregunta1cepre').show();
                    break;
                case 0 :
                    break;
                default:
                    $('#pregunta1cepre').show();
                    break;
            }

        }


        function validarCantidadEspecialidad2cepre(array) {


            switch (array.length) {
                case 1:
                    $('#pregunta2cepre').hide();
                    break;

                case 2:
                    $('#pregunta2cepre').show();
                    break;
                case 0 :
                    break;
                default:
                    $('#pregunta2cepre').show();
                    break;
            }

        }


        function cargarEspecialidad2cepre(facultad) {

            $('#especialidad5')
                .empty()
                .append('<option selected="selected" value="">Escoger la especialidad de segunda prioridad</option>')
            ;

            var datasx = quitarEspecialidad1cepre();

            for (var key in datasx) {

                if (datasx[key].idfacultad == facultad) {
                    var nom = datasx[key].nombre;
                    var id = datasx[key].id;
                    $('#especialidad5').append('<option value=' + id + '>' + nom + '</option>');
                }

            }


        }

        function cargarEspecialidad3cepre(facultad) {

            $('#especialidad6')
                .empty()
                .append('<option selected="selected" value="">Escoger la especialidad de tercera prioridad</option>')
            ;

            $('#quitarpregunta3cepre').show();
            var datasx1 = quitarEspecialidad1cepre();
            var datasx = quitarEspecialidad2cepre(datasx1);
            for (var key in datasx) {

                if (datasx[key].idfacultad == facultad) {
                    var nom = datasx[key].nombre;
                    var id = datasx[key].id;
                    $('#especialidad6').append('<option value=' + id + '>' + nom + '</option>');
                }

            }


        }

        function quitarEspecialidad1cepre() {

            var espe1 = $('#especialidad4').val();
            var data = $.grep(espesfacucepre, function (e) {
                return e.id != espe1;
            });
            return data;

        }

        function quitarEspecialidad2cepre(array) {

            var espe2 = $('#especialidad5').val();
            var data = $.grep(array, function (e) {
                return e.id != espe2;
            });
            return data;

        }

        function prepararEspecialidadcepre() {
            $('#especialidad5')
                .empty()
                .append('<option selected="selected" value="">Escoger la especialidad de primera prioridad</option>')
            ;
            $('#especialidad6')
                .empty()
                .append('<option selected="selected" value="">Escoger la especialidad de primera prioridad</option>')
            ;
            $('#pregunta1cepre').hide();
            $('#pregunta2cepre').hide();
            $('#pregunta3cepre').hide();
            $('#div2cepre').hide();
            $('#div3cepre').hide();

        }


        $("#especialidad4").change(function () {
            if ($('#especialidad4').val() != "") {
                validarCantidadEspecialidadcepre();
            } else {

                prepararEspecialidadcepre();
            }
            if (opcion2cepre) {
                var id = $('#facultades2').val();
                cargarEspecialidad2cepre(id);

            }
            if (opcion3cepre) {
                $('#especialidad6')
                    .empty()
                    .append('<option selected="selected" value="">Escoger la especialidad de tercera prioridad</option>')
                ;
            }


        });


        $("#especialidad5").change(function () {
            if ($('#especialidad5').val() != "") {
                var datasx = quitarEspecialidad1cepre();
                validarCantidadEspecialidad2cepre(datasx);
            } else {
                $('#pregunta2cepre').hide();
            }
            if (opcion3cepre) {
                var id = $('#facultades2').val();
                cargarEspecialidad3cepre(id);

            }


        });


        $('#confirma1cepre').click(function () {
            $('#div2cepre').show();

            $('#quitarpregunta2cepre').show();
            $('#modal_agregar_1cepre').modal('hide');
            var id = $('#facultades2').val();
            cargarEspecialidad2cepre(id);
            opcion2cepre = true;


            $('#pregunta2cepre').hide();
            $('#pregunta1cepre').hide();
        });

        $('#confirma2cepre').click(function () {
            $('#div3cepre').show();
            $('#modal_agregar_2cepre').modal('hide');
            var id = $('#facultades2').val();
            cargarEspecialidad3cepre(id);
            opcion3cepre = true;

        });


        $('#confirmaquitar3cepre').click(function () {
            $('#div3cepre').hide();
            $('#modal_quitar_3cepre').modal('hide');
            $('#especialidad3cepre')
                .empty()
                .append('<option selected="selected" value="">Escoger la especialidad de tercera prioridad</option>')
            ;
            opcion3cepre = false;

        });


        $('#confirmaquitar2cepre').click(function () {
            $('#div3cepre').hide();
            $('#div2cepre').hide();
            $('#modal_quitar_2cepre').modal('hide');
            $('#especialidad6')
                .empty()
                .append('<option selected="selected" value="">Escoger la especialidad de tercera prioridad</option>')
            ;$('#especialidad5')
                .empty()
                .append('<option selected="selected" value="">Escoger la especialidad de segunda prioridad</option>')
            ;
            opcion3cepre = false;
            opcion2cepre = false;
            $('#pregunta1cepre').show();

        });

        $('#agregar1cepre').click(function () {
            $('#modal_agregar_1cepre').modal({
                keyboard: false,
                backdrop: 'static'
            });
        });
        $('#agregar2cepre').click(function () {
            $('#modal_agregar_2cepre').modal({
                keyboard: false,
                backdrop: 'static'
            });
        });

        $('#quitar3cepre').click(function () {
            $('#modal_quitar_3cepre').modal({
                keyboard: false,
                backdrop: 'static'
            });
        });
        $('#quitar2cepre').click(function () {
            $('#modal_quitar_2cepre').modal({
                keyboard: false,
                backdrop: 'static'
            });
        });
    </script>



    <script>

        function validarFormulario() {

            if (!$('#paterno').val()) {
                swal("INGRESA EL APELLIDO PATERNO", "Debes ingresar tu apellido paterno.", "error");
                return false;

            }
            if (!$('#materno').val()) {
                swal("INGRESA EL APELLIDO MATERNO", "Debes ingresar tu apellido materno.", "error");
                return false;

            }
            if (!$('#nombres').val()) {
                swal("INGRESA TU NOMBRE", "Debes ingresar tus nombres.", "error");
                return false;

            }
            if (!$('#idmodalidad').val()) {
                swal("SELECCIONA LA MODALIDAD", "Debes seleccionar tu modalidad.", "error");
                return false;

            }


            if ($('#idmodalidad').val() == 16) {


                if (!$('#codigo_verificacion').val()) {
                    swal("INGRESA TU CÓDIGO CEPRE-UNI", "Debes ingresar tu código CEPRE-UNI.", "error");
                    return false;

                }

                if (!$('#idmodalidad2').val()) {
                    swal("SELECCIONA LA SEGUNDA MODALIDAD", "Debes seleccionar tu segunda modalidad.", "error");
                    return false;

                }


                if (!$('#facultades').val()) {
                    swal("SELECCIONA LA FACULTAD", "Debes seleccionar la facultad.", "error");
                    return false;

                }

                if (!$('#especialidad').val()) {
                    swal("SELECCIONA LA ESPECIALIDAD", "Debes seleccionar la primera prioridad.", "error");
                    return false;

                }


                if (!$('#facultades2').val()) {
                    swal("SELECCIONA LA SEGUNDA FACULTAD", "Debes seleccionar la segunda facultad.", "error");
                    return false;

                }

                if (!$('#especialidad4').val()) {
                    swal("SELECCIONA LA ESPECIALIDAD DE TU SEGUNDA MODALIDAD", "Debes seleccionar la primera prioridad.", "error");
                    return false;

                }


                if ($('#idmodalidad2').val() == 15 || $('#idmodalidad2').val() == 14 || $('#idmodalidad2').val() == 12 || $('#idmodalidad2').val() == 10 || $('#idmodalidad2').val() == 7 || $('#idmodalidad2').val() == 6 || $('#idmodalidad2').val() == 5) {


                } else {
                    if (!$('#idcolegio').val()) {
                        swal("SELECCIONA EL COLEGIO", "Debes seleccionar tu colegio.", "error");
                        return false;

                    }
                }


            } else {

                if (!$('#facultades').val()) {
                    swal("SELECCIONA LA FACULTAD", "Debes seleccionar la facultad.", "error");
                    return false;

                }

                if (!$('#especialidad').val()) {
                    swal("SELECCIONA LA ESPECIALIDAD", "Debes seleccionar la primera prioridad.", "error");
                    return false;

                }

                if ($('#idmodalidad').val() == 19 || $('#idmodalidad').val() == 20 || $('#idmodalidad').val() == 15 || $('#idmodalidad').val() == 14 || $('#idmodalidad').val() == 12 || $('#idmodalidad').val() == 10 || $('#idmodalidad').val() == 7 || $('#idmodalidad').val() == 6 || $('#idmodalidad').val() == 5) {

                    if (!$("#iduniversidad").val()) {
                        swal("SELECCIONA LA UNIVERSIDAD", "Debes seleccionar tu universidad.", "error");
                        return false;

                    }

                } else {
                    if (!$('#idcolegio').val()) {
                        swal("SELECCIONA EL COLEGIO", "Debes seleccionar tu colegio.", "error");
                        return false;

                    }
                }
            }


            return true;

        }


        $('#guardar').click(function () {


            if (validarFormulario()) {

                $('#modal_confirmacion').modal({
                    keyboard: false,
                    backdrop: 'static'
                });

                var nomm = 'APELLIDO Y NOMBRES: ' + $('#paterno').val().toUpperCase() + ' ' + $('#materno').val().toUpperCase() + ' ' + $('#nombres').val().toUpperCase();
                $('#txtdatos').text(nomm);
                $('#txtdni').text('NÚMERO DE DNI: ' + $('.dni').val());


                if ($('#idmodalidad').val() == 16) {

                    if ($('#idmodalidad').val() != "") {
                        $('#trmoda1').show();
                        $('#txtmoda1').text('MODALIDAD: ' + $('#idmodalidad option:selected').text());


                    } else {
                        $('#trmoda1').hide();
                        $('#txtmoda1').text('');
                    }


                    if ($('#especialidad').val() != "") {
                        $('#trop1').show();
                        $('#txtop1').text('ESPECIALIDAD DE PRIMERA PRIORIDAD: ' + $('#especialidad option:selected').text());


                    } else {
                        $('#trop1').hide();
                        $('#txtop1').text('');
                    }


                    if ($('#especialidad2').val() != "") {
                        $('#trop2').show();
                        $('#txtop2').text('ESPECIALIDAD DE SEGUNDA PRIORIDAD: ' + $('#especialidad2 option:selected').text());
                    } else {
                        $('#trop2').hide();
                        $('#txtop2').text('');
                    }

                    if ($('#especialidad3').val() != "") {

                        $('#trop3').show();
                        $('#txtop3').text('ESPECIALIDAD DE TERCERA PRIORIDAD: ' + $('#especialidad3 option:selected').text());
                    } else {
                        $('#trop3').hide();
                        $('#txtop3').text('');
                    }


                    if ($('#idmodalidad2').val() != "") {
                        $('#trmoda2').show();
                        $('#txtmoda2').text('MODALIDAD 2: ' + $('#idmodalidad2 option:selected').text());


                    } else {
                        $('#trmoda2').hide();
                        $('#txtmoda2').text('');
                    }


                    if ($('#especialidad4').val() != "") {
                        $('#trop4').show();
                        $('#txtop4').text('ESPECIALIDAD DE PRIMERA PRIORIDAD: ' + $('#especialidad4 option:selected').text());


                    } else {
                        $('#trop4').hide();
                        $('#txtop4').text('');
                    }


                    if ($('#especialidad5').val() != "") {
                        $('#trop5').show();
                        $('#txtop5').text('ESPECIALIDAD DE SEGUNDA PRIORIDAD: ' + $('#especialidad5 option:selected').text());
                    } else {
                        $('#trop5').hide();
                        $('#txtop5').text('');
                    }

                    if ($('#especialidad6').val() != "") {

                        $('#trop6').show();
                        $('#txtop6').text('ESPECIALIDAD DE TERCERA PRIORIDAD: ' + $('#especialidad6 option:selected').text());
                    } else {
                        $('#trop6').hide();
                        $('#txtop6').text('');
                    }


                } else {


                    if ($('#idmodalidad').val() != "") {
                        $('#trmoda1').show();
                        $('#txtmoda1').text('MODALIDAD: ' + $('#idmodalidad option:selected').text());


                    } else {
                        $('#trmoda1').hide();
                        $('#txtmoda1').text('');
                    }


                    if ($('#especialidad').val() != "") {
                        $('#trop1').show();
                        $('#txtop1').text('ESPECIALIDAD DE PRIMERA PRIORIDAD: ' + $('#especialidad option:selected').text());


                    } else {
                        $('#trop1').hide();
                        $('#txtop1').text('');
                    }


                    if ($('#especialidad2').val() != "") {
                        $('#trop2').show();
                        $('#txtop2').text('ESPECIALIDAD DE SEGUNDA PRIORIDAD: ' + $('#especialidad2 option:selected').text());
                    } else {
                        $('#trop2').hide();
                        $('#txtop2').text('');
                    }

                    if ($('#especialidad3').val() != "") {

                        $('#trop3').show();
                        $('#txtop3').text('ESPECIALIDAD DE TERCERA PRIORIDAD: ' + $('#especialidad3 option:selected').text());
                    } else {
                        $('#trop3').hide();
                        $('#txtop3').text('');
                    }


                    if ($('#idmodalidad').val() == 6) {
                        var modaa;
                        $.ajax({
                            url: 'info-vacantesuni',
                            dataType: 'json',
                            data: {idmodalidad: 6}
                        })
                            .done(function (modalidad) {
                                /*Muestra Colegio o universidad segun la modalidad correspondiente*/
                                modaaa = modalidad;
                                var modd = $("#idmodalidad").val();
                                var espp = $("#especialidad").val();

                                var vacanup;
                                for (var key in modaaa) {
                                    if (modaaa.hasOwnProperty(key)) {
                                        if (modaaa[key].idespecialidad == espp) {
                                            vacanup = modaaa[key].vacantes;

                                        }

                                    }
                                }
                                var menjj = 0;
                                $.ajax({
                                    url: 'info-numerouni',
                                    dataType: 'json',
                                    data: {idespecialidad: espp}
                                })
                                    .done(function (especialidad) {
                                        /*Muestra Colegio o universidad segun la modalidad correspondiente*/

                                        menjj = JSON.stringify(especialidad);
                                        /*menjj=menjj+1;*/
                                        if (vacanup == 100) {
                                            vacanup = 'TODOS LOS INSCRITOS';
                                        }
                                        $("#trtitu").show();
                                        $("#txttitu").text("Existen " + menjj + " inscritos postulando a esta especialidad con " + vacanup + " vacante(s) disponible(s). La facultad evaluará el ingreso.");

                                    });


                            });
                    }


                }


            }

        });


    </script>










    <script>


        $("#iddepacolegio").click(function (event) {
            var dp = $('#iddepacolegio').val();
            if (dp > 0) {

                $('#colediv').show();

            } else {
                $('#colediv').hide();
            }


        });


        $(function () {


            var idmodal = $("#idmodalidad").val();

            if (idmodal > 0) {
                $.ajax({
                    url: 'info-modalidad',
                    dataType: 'json',
                    data: {idmodalidad: idmodal},
                })
                    .done(function (modalidad) {
                        /*Muestra Colegio o universidad segun la modalidad correspondiente*/
                        if (modalidad.colegio) {
                            $(".Colegio").show();
                            $('#colediv').hide();
                            $('#depacoldiv').show();
                            var dp = $('#iddepacolegio').val();
                            if (dp > 0) {

                                $('#colediv').show();

                            } else {
                                $('#colediv').hide();
                            }
                            $(".Universidad").hide();
                        } else {
                            $(".Colegio").hide();

                            $('#colediv').hide();
                            $('#depacoldiv').hide();
                            $(".Universidad").show();
                        }
                        /*Muestra la segunda opcion del cepre UNI*/
                        if (modalidad.codigo == 'ID-CEPRE') {
                            $(".cepreuni").show();
                        } else {
                            $(".cepreuni").hide();
                        }


                    });


            } else {
                $(".Colegio").hide();
                $(".Universidad").hide();
                $(".cepreuni").hide();
                $('#colediv').hide();
                $('#depacoldiv').hide();
            }


            $("#idmodalidad").change(function (event) {
                var idmodalidad = $(this).val();
                if (idmodalidad != "") {


                    $.ajax({
                        url: 'info-modalidad',
                        dataType: 'json',
                        data: {idmodalidad: idmodalidad},
                    })
                        .done(function (modalidad) {


                            /*Muestra Colegio o universidad segun la modalidad correspondiente*/
                            if (modalidad.colegio) {
                                $(".Colegio").show();
                                $('#colediv').hide();
                                $('#depacoldiv').show();
                                var dp = $('#iddepacolegio').val();
                                if (dp > 0) {

                                    $('#colediv').show();

                                } else {
                                    $('#colediv').hide();
                                }
                                $(".Universidad").hide();
                            } else {
                                $(".Colegio").hide();

                                $('#colediv').hide();
                                $('#depacoldiv').hide();
                                $(".Universidad").show();
                            }
                            /*Muestra la segunda opcion del cepre UNI*/
                            if (modalidad.codigo == 'ID-CEPRE') {
                                $(".cepreuni").show();
                            } else {

                                $("#idmodalidad2").val(null);

                                $("#codigo_verificacion").val(null);
                                $("#idespecialidad2").val(null);


                                $(".cepreuni").hide();
                            }


                        });//SAl

                } else {
                    $(".Colegio").hide();
                    $('#colediv').hide();
                    $('#depacoldiv').hide();
                    $(".Universidad").hide();
                }

            });

            $("#idmodalidad2").on('change', function () {
                var idmodalidad2 = $(this).val();
                if (idmodalidad2 > 0) {


                    $.ajax({
                        url: 'modalidad-especialidad',
                        dataType: 'json',
                        data: {idmodalidad: idmodalidad2},
                    })
                        .done(function (res) {
                            var json = {data: []};
                            json.data = res;
                            espescepre = json;

                            limpiarSelectscepre();
                            ocualtarOpcionescepre();
                            limpiarPasoscepre();
                            $('#facultades2 option:eq("")').prop('selected', true);

                        });
                }

            });


            $("#idmodalidad2").click(function (event) {
                var idmodalidad = $(this).val();
                $.ajax({
                    url: 'info-modalidad',
                    dataType: 'json',
                    data: {idmodalidad: idmodalidad},
                })
                    .done(function (modalidad) {
                        /*Muestra Colegio o universidad segun la modalidad correspondiente*/
                        if (modalidad.colegio) {

                            $(".Colegio").show();
                            $('#colediv').hide();
                            $('#depacoldiv').show();
                            $(".Universidad").hide();


                            var dp = $('#iddepacolegio').val();
                            if (dp > 0) {

                                $('#colediv').show();

                            } else {
                                $('#colediv').hide();
                            }


                        } else {

                            $(".Colegio").show();
                            $('#colediv').hide();
                            $('#depacoldiv').show();
                            $(".Universidad").hide();


                            var dp = $('#iddepacolegio').val();
                            if (dp > 0) {

                                $('#colediv').show();

                            } else {
                                $('#colediv').hide();
                            }


                        }

                    });

            });

            $("#idcolegio").select2({

                ajax: {
                    url: '{{ url("colegio") }}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        dep = $(iddepacolegio).val();
                        return {
                            varschool: params.term + "&depaBus=" + dep // search term
                        };
                    },
                    processResults: function (data) {
                        // parse the results into the format expected by Select2.
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                placeholder: 'Seleccione su colegio',
                minimumInputLength: 3,
                templateResult: formatSchool,
                templateSelection: formatSchoolSelection,
                escapeMarkup: function (markup) {
                    return markup;
                } // let our custom formatter work
            });

            $("#iduniversidad").select2({

                ajax: {
                    url: '{{ url("universidad") }}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        var idmodalidad = $('#idmodalidad').val();
                        return {
                            varuni: params.term, // search term
                            varidmodalidad: idmodalidad,
                        };
                    },
                    processResults: function (data) {
                        // parse the results into the format expected by Select2.
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                placeholder: 'Seleccione su universidad',
                minimumInputLength: 3,
                templateResult: formatUni,
                templateSelection: formatSchoolSelection,
                escapeMarkup: function (markup) {
                    return markup;
                } // let our custom formatter work
            });

            function formatSchool(school) {
                if (school.loading) return school.text; //Sin esta columna no carga los items dentro de los campo array

                var localidad = school.distrito;
                if (localidad != null) {
                    var lbl_ubigeo = 'Distrito';
                    var descripcion_ubigeo = localidad.descripcion;
                } else {
                    var lbl_ubigeo = 'Pais';
                    var descripcion_ubigeo = school.paises.nombre;
                }

                var markup = "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__title'>" + school.text + "</div>" +
                    "<div class='select2-result-repository__description'> " + lbl_ubigeo + " : " + descripcion_ubigeo + "</div>" +
                    "<div class='select2-result-repository__description'> Gestion : " + school.gestion + "</div>" +
                    "<div class='select2-result-repository__description'> Direccion : " + school.direccion + "</div>" +
                    "<div class='select2-result-repository__description'> Código Modular : " + school.codigo_modular + "</div>" +
                    "<div class='select2-result-repository__statistics'>" +
                    "</div>" +
                    "</div>";
                return markup;

            }

            function formatUni(school) {
                if (school.loading) return school.text; //Sin esta columna no carga los items dentro de los campo array

                var localidad = school.distrito;
                if (localidad != null) {
                    var lbl_ubigeo = 'Distrito';
                    var descripcion_ubigeo = localidad.descripcion;
                } else {
                    var lbl_ubigeo = 'Pais';
                    var descripcion_ubigeo = school.paises.nombre;
                }
                var markup = "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__title'>" + school.text + "</div>" +
                    "<div class='select2-result-repository__description'> " + lbl_ubigeo + " : " + descripcion_ubigeo + "</div>" +
                    "<div class='select2-result-repository__description'> Gestion : " + school.gestion + "</div>" +
                    "<div class='select2-result-repository__statistics'>" +
                    "</div>" +
                    "</div>";
                return markup;

            }

            function formatSchoolSelection(school) {
                var markup = school.text;
                return markup;
            }

        });

        $("#fecha_nacimiento").inputmask("d-m-y", {
            "placeholder": "dd-mm-yyyy"
        });

        var modaaa;


        $("#idmodalidad").on('change', function () {

            var idmodalidad = $(this).val();
            if (idmodalidad > 0) {


                $.ajax({
                    url: 'modalidad-especialidad',
                    dataType: 'json',
                    data: {idmodalidad: idmodalidad},
                })
                    .done(function (res) {
                        var json = {data: []};
                        json.data = res;
                        espes = json;

                        limpiarSelects();
                        ocualtarOpciones();
                        limpiarPasos();
                        $('#facultades option:eq("")').prop('selected', true);

                    });
            }


            if ($("#idmodalidad").val() == 6) {
                $("#btnchang").prop('type', 'button');
                var idmodalidad = $(this).val();
                $.ajax({
                    url: 'info-vacantesuni',
                    dataType: 'json',
                    data: {idmodalidad: idmodalidad}
                })
                    .done(function (modalidad) {
                        /*Muestra Colegio o universidad segun la modalidad correspondiente*/
                        modaaa = modalidad;


                    });


            }
        });
        $("#idespecialidad").on('change', function () {

            if ($("#idmodalidad").val() == 6) {

                $("#btnchang").prop('type', 'button');
                var idmodalidad = $("#idmodalidad").val();
                $.ajax({
                    url: 'info-vacantesuni',
                    dataType: 'json',
                    data: {idmodalidad: idmodalidad}
                })
                    .done(function (modalidad) {
                        /*Muestra Colegio o universidad segun la modalidad correspondiente*/
                        modaaa = modalidad;


                    });


            }
        });
        $("#btnchang").click(function () {
            var modd = $("#idmodalidad").val();
            var espp = $("#idespecialidad").val();

            if (modd == 6) {
                if (espp > 0) {

                    var vacanup;
                    for (var key in modaaa) {
                        if (modaaa.hasOwnProperty(key)) {
                            if (modaaa[key].idespecialidad == espp) {
                                vacanup = modaaa[key].vacantes;

                            }

                        }
                    }

                    var menjj = 0;
                    $.ajax({
                        url: 'info-numerouni',
                        dataType: 'json',
                        data: {idespecialidad: espp}
                    })
                        .done(function (especialidad) {
                            /*Muestra Colegio o universidad segun la modalidad correspondiente*/

                            menjj = JSON.stringify(especialidad);
                            /*menjj=menjj+1;*/
                            if (vacanup == 100) {
                                vacanup = 'TODOS LOS INSCRITOS';
                            }
                            $("#parraf").text("Existen " + menjj + " inscritos postulando a esta especialidad con " + vacanup + " vacante(s) disponible(s). La facultad evaluará el ingreso.");

                            $('#myModal').modal('toggle');

                        });


                } else {

                    alert("Escoja una Especialidad");

                }
            }
        });


        $("#idmodalidad").on('change', function () {

            if ($("#idmodalidad").val() == 16) {
                //    $("#idespecialidad option[value='1']").remove();
            } else {

                if ($("#idespecialidad option[value='1']").length > 0) {

                } else {
                    //     $("#idespecialidad").append('<option value="1">ARQUITECTURA</option>');
                }


            }

        });
    </script>

    <script>
        $(document).ready(function () {
            cargarDataAJax();


        });

        function cargarDataAJax() {
            $.ajax({
                url: '{{ "especialidades-seleccion" }}',
                success: function (respuesta) {

                    for (var key in respuesta.facus) {

                        var nom = "FACULTAD DE " + respuesta.facus[key].nombre;
                        var id = respuesta.facus[key].id;
                        $('#facultades').append('<option value=' + id + '>' + nom + '</option>');
                        $('#facultades2').append('<option value=' + id + '>' + nom + '</option>');
                    }


                    var jsontemp = {data: []};

                    jsontemp.data = respuesta.data;
                    espescepre = jsontemp;
                    espes = jsontemp;
                    if (!respuesta.datos[0].moda2) {

                    } else {


                        var idfacu2 = respuesta.datos[0].idfacultad2;
                        var idespe4 = respuesta.datos[0].idespecialidad4;
                        var idespe5 = respuesta.datos[0].idespecialidad5;
                        var idespe6 = respuesta.datos[0].idespecialidad6;


                        $("#facultades2").val(idfacu2);

                        $("#div1cepre").show();
                        $(".div1cepre").show();
                        $(".div0cepre").show();
                        cargarEspecialidadcepre(idfacu2);
                        $("#especialidad4").val(idespe4);


                        validarCantidadEspecialidadcepre();

                        if (idespe5) {
                            $("#pregunta1cepre").hide();
                            var datasx = quitarEspecialidad1cepre();
                            validarCantidadEspecialidad2cepre(datasx);
                            cargarEspecialidad2cepre(idfacu2);

                            $("#div2cepre").show();

                            $("#quitarpregunta2cepre").show();
                            $("#especialidad5").val(idespe5);
                            opcion2cepre = true;
                        }

                        if (idespe6) {
                            $("#pregunta2cepre").hide();
                            cargarEspecialidad3cepre(idfacu2);

                            $("#div3cepre").show();


                            $("#quitarpregunta3cepre").show();
                            $("#especialidad6").val(idespe6);
                            opcion3cepre = true;


                        }

                    }

                    var idfacu = respuesta.datos[0].idfacultad;
                    var idespe1 = respuesta.datos[0].idespecialidad;
                    var idespe2 = respuesta.datos[0].idespecialidad2;
                    var idespe3 = respuesta.datos[0].idespecialidad3;


                    $("#facultades").val(idfacu);

                    $("#div1").show();
                    $(".div1").show();
                    $(".div0").show();
                    cargarEspecialidad(idfacu);
                    $("#especialidad").val(idespe1);


                    validarCantidadEspecialidad();


                    if (idespe2) {
                        $("#pregunta1").hide();
                        var datasx = quitarEspecialidad1();
                        validarCantidadEspecialidad2(datasx);
                        cargarEspecialidad2(idfacu);

                        $("#div2").show();

                        $("#quitarpregunta2").show();
                        $("#especialidad2").val(idespe2);
                        opcion2 = true;
                    }

                    if (idespe3) {
                        $("#pregunta2").hide();
                        cargarEspecialidad3(idfacu);

                        $("#div3").show();


                        $("#quitarpregunta3").show();
                        $("#especialidad3").val(idespe3);
                        opcion3 = true;


                    }


                },
                error: function () {
                    console.log("No se ha podido obtener la información");
                    location.reload();
                }
            });

        }


    </script>
@stop

