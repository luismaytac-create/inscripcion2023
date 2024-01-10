@extends('layouts.base')

@section('content')





    <div class="m-content">

    @include('alerts.errors')
    {{ Alert::render() }}

    <!--begin::Portlet-->
        <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">

            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="flaticon-statistics"></i>
												</span>
                        <h2 class="lead">
                            Datos Familiares del <strong>POSTULANTE</strong>
                        </h2>
                        <div class="actions">
                            {!!Form::back(route('datos.index'))!!}
                        </div>
                        <h2 class="m-portlet__head-label m-portlet__head-label--danger">
                            <span>DATOS FAMILIARES</span>
                        </h2>
                    </div>
                </div>

            </div>

            <div class="m-portlet__body lead">



                {!! Form::open(['route'=>'datos.familiares.store','method'=>'POST','files'=>true]) !!}
                <div class="col-md-12">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light tasks-widget widget-comments">

                        <div class="form-body ">
                            Los nombres y apellidos deben coincidir con el DNI, los campos con (*) son obligatorios
                            <h3 class="text-error">Datos del Padre del Postulante</h3>
                            {!!Form::hidden('idpostulante', $postulante->id );!!}
                            {!!Form::hidden('parentesco[0]', 'Papá' );!!}
                            {!!Form::hidden('orden[0]', 0 );!!}
                            <div class="row">
                                <div class="col-md-4">
                                    {!!Field::text('paterno[0]', null , ['label'=>'Apellido Paterno del padre (*)','placeholder'=>'Apellido Paterno','maxlength'=>'25'])!!}
                                </div><!--span-->
                                <div class="col-md-4">
                                    {!!Field::text('materno[0]', null , ['label'=>'Apellido Materno del padre (*)','placeholder'=>'Apellido Materno','maxlength'=>'25'])!!}
                                </div><!--span-->
                                <div class="col-md-4">
                                    {!!Field::text('nombres[0]', null , ['label'=>'Nombres del padre (*)','placeholder'=>'Nombres del Padre','maxlength'=>'50'])!!}
                                </div><!--span-->
                            </div><!--row-->
                            <div class="row">
                                <div class="col-md-4">
                                    {!!Field::text('dni[0]', null , ['label'=>'DNI del padre (*)','placeholder'=>'DNI del Padre','maxlength'=>'8'])!!}
                                </div><!--span-->
                                <div class="col-md-4">
                                    {!!Field::text('direccion[0]', null , ['label'=>'Dirección del padre','placeholder'=>'Dirección del Padre'])!!}
                                </div><!--span-->
                                <div class="col-md-4">
                                    {!!Field::text('telefonos[0]', null , ['label'=>'Teléfonos del padre (celular/fijo/trabajo-anexo)','placeholder'=>'Teléfonos del Padre','maxlength'=>'50'])!!}
                                </div><!--span-->
                                <div class="col-md-4">
                                    {!!Field::text('email[0]', null , ['label'=>'Email del padre ','placeholder'=>'Email del Padre','maxlength'=>'90'])!!}
                                </div><!--span-->
                            </div><!--row-->
                            <h3 class="text-error">Datos de la Madre del Postulante</h3>
                            {!!Form::hidden('parentesco[1]', 'Mamá' );!!}
                            {!!Form::hidden('orden[1]', 1 );!!}
                            <div class="row">
                                <div class="col-md-4">
                                    {!!Field::text('paterno[1]', null , ['label'=>'Apellido Paterno de la Madre (*)','placeholder'=>'Apellido Paterno','maxlength'=>'25'])!!}
                                </div><!--span-->
                                <div class="col-md-4">
                                    {!!Field::text('materno[1]', null , ['label'=>'Apellido Materno de la Madre (*)','placeholder'=>'Apellido Materno','maxlength'=>'25'])!!}
                                </div><!--span-->
                                <div class="col-md-4">
                                    {!!Field::text('nombres[1]', null , ['label'=>'Nombres de la Madre (*)','placeholder'=>'Nombres de la Madre','maxlength'=>'50'])!!}
                                </div><!--span-->
                            </div><!--row-->
                            <div class="row">
                                <div class="col-md-4">
                                    {!!Field::text('dni[1]', null , ['label'=>'DNI de la Madre (*)','placeholder'=>'DNI de la Madre','maxlength'=>'8'])!!}
                                </div><!--span-->
                                <div class="col-md-4">
                                    {!!Field::text('direccion[1]', null , ['label'=>'Dirección de la Madre ','placeholder'=>'Dirección de la Madre'])!!}
                                </div><!--span-->
                                <div class="col-md-4">
                                    {!!Field::text('telefonos[1]', null , ['label'=>'Teléfonos de la Madre (celular/fijo/trabajo-anexo) ','placeholder'=>'Teléfonos de la Madre','maxlength'=>'50'])!!}
                                </div><!--span-->
                                <div class="col-md-4">
                                    {!!Field::text('email[1]', null , ['label'=>'Email de la Madre  ','placeholder'=>'Email del Padre','maxlength'=>'90'])!!}
                                </div><!--span-->
                            </div><!--row-->
                            <h3 class="text-error">Datos del apoderado</h3>


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
                               'OTRO' => 'OTRO'],['label'=>'Escoger Parentesco del apoderado (*)','empty'=>'Escoger parentesco']);!!}


                            {!!Form::hidden('orden[2]', 2 );!!}
                            <div class="row">


                                <div class="col-md-4">
                                    {!!Field::text('paterno[2]', null , ['label'=>'Apellido Paterno del apoderado (*)','placeholder'=>'Apellido Paterno del apoderado','maxlength'=>'25'])!!}
                                </div><!--span-->
                                <div class="col-md-4">
                                    {!!Field::text('materno[2]', null , ['label'=>'Apellido Materno del apoderado (*)','placeholder'=>'Apellido Materno del apoderado','maxlength'=>'25'])!!}
                                </div><!--span-->
                                <div class="col-md-4">
                                    {!!Field::text('nombres[2]', null , ['label'=>'Nombres del apoderado (*)','placeholder'=>'Nombres del apoderado','maxlength'=>'50'])!!}
                                </div><!--span-->
                            </div><!--row-->
                            <div class="row">
                                <div class="col-md-4">
                                    {!!Field::text('dni[2]', null , ['label'=>'DNI del apoderado (*)','placeholder'=>'DNI del apoderado','maxlength'=>'8'])!!}
                                </div><!--span-->
                                <div class="col-md-4">
                                    {!!Field::text('direccion[2]', null , ['label'=>'Dirección del apoderado ','placeholder'=>'Dirección del apoderado'])!!}
                                </div><!--span-->
                                <div class="col-md-4">
                                    {!!Field::text('telefonos[2]', null , ['label'=>'Teléfonos del apoderado (celular/fijo/trabajo-anexo)','placeholder'=>'Teléfonos del apoderado','maxlength'=>'50'])!!}
                                </div><!--span-->
                                <div class="col-md-4">
                                    {!!Field::text('email[2]', null , ['label'=>'Email del apoderado ','placeholder'=>'Email del apoderado','maxlength'=>'90'])!!}
                                </div><!--span-->
                            </div><!--row-->
                            {!!Form::enviar('Guardar')!!}
                        </div>
                    </div>
                    <!-- END PORTLET-->
                </div>
                {!! Form::close() !!}


            </div>

        </div>

    </div>






@stop

