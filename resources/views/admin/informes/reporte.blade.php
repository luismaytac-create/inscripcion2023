@extends('layouts.admin')

@section('content')
    {!! Alert::render() !!}
    @include('alerts.errors')

    <!--begin::Portlet-->
    <div class="m-portlet m-portlet--creative m-portlet--bordered-semi">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="flaticon-statistics"></i>
												</span>
                    <h3 class="m-portlet__head-text">
                        Buscar postulante por DNI
                    </h3>
                    <h2 class="m-portlet__head-label m-portlet__head-label--success">
                        <span>BUSCAR POSTULANTE</span>
                    </h2>
                </div>
            </div>

        </div>
        <div class="m-portlet__body">

            <div class="m-portlet m-portlet--tabs">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-tools">
                        <ul class="nav nav-tabs m-tabs-line m-tabs-line--success m-tabs-line--2x" role="tablist">
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_portlet_base_demo_1_1_tab_content" role="tab">
                                    <i class="la la-cog"></i> DATOS GENERALES
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_portlet_base_demo_1_2_tab_content" role="tab">
                                    <i class="la la-briefcase"></i> DATOS POSTULANTE
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link" target="_blank" href="{{ route('admin.usuarios.editar',$usuario_id) }}" r>
                                    <i class="la la-bell-o"></i> CAMBIAR CONTRASEÑA
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="tab-content ">
                        <div class="tab-pane active m-margin-top-20" id="m_portlet_base_demo_1_1_tab_content" role="tabpanel">

                            <table class="table table-bordered table-hover ">
                                <thead>
                                <tr>
                                    <th><i class="fa fa-briefcase"></i> Campo </th>
                                    <th class="hidden-xs"><i class="fa fa-edit"></i> Nombre </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>TIPO Y NÚMERO DE DOCUMENTO
                                    </td>
                                    <td>
                                        {{ $datos_doc }} - {{ $dni }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>HORA DE REGISTRO</td>
                                    <td>{{ $fecha_registro }}</td>
                                </tr>
                                <tr>
                                    <td>EMAIL</td>
                                    <td>{{ $email }}</td>
                                </tr>
                                <tr>
                                    <td>CELULAR</td>
                                    <td>{{ $celular }}</td>

                                </tr>
                                <tr>  <td> PRE-INSCRIPCIÓN </td>
                                    <td>
                                        @if($tiene_postulante)
                                            <span class="m-badge m-badge--success">SI</span>
                                        @else
                                            <span class="m-badge m-badge--danger"> NO </span>
                                        @endif
                                    </td></tr>


                                @if($tiene_postulante)

                                    <tr>
                                        <td>APELLIDOS Y NOMBRES</td>
                                        <td>{{ $postulante->paterno }} {{ $postulante->materno }} {{ $postulante->nombres }}</td>
                                    </tr>

                                    <tr>
                                        <td>COMPLETÓ DATOS PERSONALES</td>
                                        <td>
                                            @if($proceso->datos_personales)
                                                <span class="m-badge m-badge--success">SI</span>
                                            @else
                                                <span class="m-badge m-badge--danger"> NO </span>
                                            @endif
                                        </td>


                                    </tr>

                                    <tr>
                                        <td>COMPLETÓ DATOS FAMILIARES</td>
                                        <td>
                                            @if($proceso->datos_familiares)
                                                <span class="m-badge m-badge--success">SI</span>
                                            @else
                                                <span class="m-badge m-badge--danger"> NO </span>
                                            @endif
                                        </td>


                                    </tr>
                                    <tr>
                                        <td>COMPLETÓ DATOS COMPLEMENTARIOS</td>
                                        <td>
                                            @if($proceso->encuesta)
                                                <span class="m-badge m-badge--success">SI</span>
                                            @else
                                                <span class="m-badge m-badge--danger"> NO </span>
                                            @endif
                                        </td>


                                    </tr>
                                    <tr>
                                        <td>SOLICITUD DE SEMIBECA</td>
                                        <td>
                                            @if($contador_semibeca>0)
                                                <span class="m-badge m-badge--success">SI</span>
                                            @else
                                                <span class="m-badge m-badge--danger"> NO </span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>CONFIRMÓ EMAIL</td>
                                        <td>
                                            @if(isset($confirmo_email))
                                                @if($confirmo_email)
                                                <span class="m-badge m-badge--success">SI</span>
                                                @endif
                                            @else
                                                <span class="m-badge m-badge--danger"> NO </span>
                                            @endif
                                        </td>


                                    </tr>
                                    <tr>
                                        <td>FICHA</td>
                                        <td> @if($postulante->datos_ok)
                                                <span class="m-badge m-badge--success">SI</span>
                                            @else
                                                <span class="m-badge m-badge--danger"> NO </span>
                                            @endif</td>
                                    </tr>
                                    <tr>
                                        <td>FECHA DE CONFIRMACIÓN FICHA
                                        </td>
                                        <td>
                                            @if(isset($postulante->ficha_fecha))
                                                {{ \Carbon\Carbon::parse($postulante->ficha_fecha)->format('d/m/Y H:i:s') }}
                                            @endif
                                        </td>
                                    </tr>



                                    <tr>
                                        <td>
                                            DECLARACIÓN JURADA
                                        </td>
                                        <td>
                                            @if(isset($declaracion))
                                              {{ $declaracion->estado }}
                                            @else
                                                <span class="m-badge m-badge--danger"> NO SUBIÓ </span>
                                                @endif

                                        </td>
                                    </tr>
                                    @if(isset($declaracion))

                                        @if(isset($declaracion_archivo->created_at))
                                    <tr>
                                        <td>FECHA DE SUBIDA DECLARACIÓN</td>

                                        <td>  {{ \Carbon\Carbon::parse($declaracion_archivo->created_at)->format('d/m/Y H:i:s') }}</td>
                                    </tr>
                                        @else

                                            @if(isset($declaracion->updated))
                                            <tr>
                                                <td>FECHA DE SUBIDA DECLARACIÓN</td>

                                                <td>  {{ \Carbon\Carbon::parse($declaracion->updated)->subHour(2)->subMinutes(15)->subSeconds(23)->format('d/m/Y H:i:s') }}</td>
                                            </tr>
                                                @endif


                                    @endif



                                    @if($declaracion!= 'PENDIENTE')
                                        <tr>
                                            <td>FECHA DE APROBACIÓN/DENEGACIÓN
                                            </td>
                                            <td>
                                                @if(isset($declaracion->updated))
                                                {{ \Carbon\Carbon::parse($declaracion->updated)->format('d/m/Y H:i:s') }}
                                                @endif
                                            </td>
                                        </tr>
                                        @if(isset($declaracion->observaciones) )
                                            @if($declaracion->observaciones != '' && $declaracion->estado!='APROBADO')
                                        <tr>
                                            <td>OBSERVACIÓN DECLARACIÓN
                                            </td>
                                            <td>

                                                   {{ $declaracion->observaciones }}

                                            </td>
                                        </tr>
                                                @endif
                                        @endif
                                    @endif
                                    @endif

                                    <tr>
                                        <td>
                                            ESTADO FOTO
                                        </td>
                                        <td>
                                            {{ $postulante->foto_estado }}
                                        </td>
                                    </tr>
                                    @if( $postulante->foto_estado != 'SIN FOTO')
                                    <tr>
                                        <td>
                                            FECHA SUBIDA DE FOTO
                                        </td>
                                        <td>

                                            {{ \Carbon\Carbon::parse($postulante->foto_fecha_subida)->format('d/m/Y H:i:s') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>FECHA DE EDICION
                                        </td>
                                        <td>
                                            @if(isset($postulante->foto_fecha_editor))
                                            {{ \Carbon\Carbon::parse($postulante->foto_fecha_editor)->format('d/m/Y H:i:s') }}
                                            @endif
                                        </td>
                                    </tr>
                                    @endif

                                    @if($postulante->idmodalidad == 16)
                                        <tr>
                                            <td>Modalidad</td>
                                            <td>{{$postulante->nombre_modalidad}}</td>

                                        </tr>

                                        <tr>
                                            <td>Especialidad</td>
                                            <td>{{$postulante->nombre_especialidad}} - {{ $postulante->nombre_especialidad2 }} - {{$postulante->nombre_especialidad3}}</td>


                                        </tr>

                                        <tr>
                                            <td>Segunda Modalidad</td>
                                            <td>{{$postulante->nombre_modalidad2}}</td>

                                        </tr>

                                        <tr>
                                            <td>Especialidad Segunda Modalidad</td>
                                            <td>{{$postulante->nombre_especialidad4}} - {{ $postulante->nombre_especialidad5 }} - {{$postulante->nombre_especialidad6}}</td>


                                        </tr>
                                    @else
                                        <tr>
                                            <td>Modalidad</td>
                                            <td>{{$postulante->nombre_modalidad}}</td>

                                        </tr>

                                        <tr>
                                            <td>Especialidad</td>
                                            <td>{{$postulante->nombre_especialidad}} - {{ $postulante->nombre_especialidad2 }} - {{$postulante->nombre_especialidad3}}</td>


                                        </tr>

                                    @endif



                                    <tr>
                                        <td>Colegio</td>
                                        <td>{{$postulante->datos_colegio->nombre}}</td>
                                    </tr>
                                    <tr>
                                        <td>UBIGEO  - Colegio
                                        </td>
                                        <td>{{$postulante->datos_colegio->descripcion_ubigeo}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Formato de Pago
                                        </td>
                                        <td>
                                            <a target="_blank" href="pagos/{!! $postulante->id !!}" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Formato De Pago">
                                                <i class="la la-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>PAGOS</td>
                                        <td> <ul class="list-unstyled">
                                                @foreach ($postulante->recaudaciones as $item)
                                                    <li>
                                            <span class="sale-info"> {{ $item->fecha.' - '.$item->descripcion }}
                                                <i class="fa fa-img-up"></i>
                                            </span>
                                                        <span class="sale-num"> {{ $item->monto }} </span>
                                                    </li>
                                                @endforeach
                                            </ul></td>
                                    </tr>



                                @endif


                                </tbody>
                            </table>



                        </div>
                        @if($tiene_postulante)

                        <div class="tab-pane" id="m_portlet_base_demo_1_2_tab_content" role="tabpanel">
                           <h1>DNI</h1>
                           @if(count($dnis)>0)
                            @if (str_contains($dnis[0]->archivo, 'pdf'))
                                <p><a target="_blank" href="/storage/{{$dnis[0]->archivo}}" download> descarga </a> </p>
                            @else
                                <p> <img src="/storage/{{$dnis[0]->archivo}}" width="800px">  </p>
                            @endif
                           @endif
                           @if(count($dnis)>1)
                            @if (str_contains($dnis[1]->archivo, 'pdf'))
                                <p><a target="_blank" href="/storage/{{$dnis[1]->archivo}}" download> descarga </a> </p>
                            @else
                                <p> <img src="/storage/{{$dnis[1]->archivo}}" width="800px">  </p>
                            @endif
                           @endif
                        </div>
                        @endif

                        <div class="tab-pane" id="m_portlet_base_demo_1_3_tab_content" role="tabpanel">
                        </div>
                    </div>
                </div>
            </div>









        </div>
    </div>

    <!--end::Portlet-->

















@stop

@section('js-scripts')
    <script>





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

@section('title')
    Listado
@stop

@section('breadcrumb')
@stop

@section('page-title')

@stop

@section('page-subtitle')
@stop



