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

                        <h2 class="m-portlet__head-label m-portlet__head-label--danger">
                            <span>DATOS FAMILIARES</span>
                        </h2>
                    </div>
                </div>

            </div>

            <div class="m-portlet__body lead">




                {!! Form::open(['route'=>['datos.familiares.update'],'method'=>'POST','files'=>true]) !!}
                <div class="col-md-12">
                    <!-- BEGIN PORTLET-->
                    <div class="portlet light tasks-widget widget-comments">
                        <div class="portlet-title margin-bottom-20">
                            <div class="caption caption-md font-red-sunglo">
                                <span class="caption-subject theme-font bold uppercase">DATOS DE FAMILIARES DEL postulante</span>
                            </div>
                            <div class="actions">
                                {!!Form::back(route('datos.index'))!!}
                            </div>
                        </div>
                        <div class="form-body ">
                            Los nombres y apellidos deben coincidir con el DNI, los campos con asterisco son obligatorios
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

