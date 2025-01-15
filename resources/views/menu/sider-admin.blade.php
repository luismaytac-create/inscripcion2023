<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">

        <!-- TODOS -->

        {!!Form::menu('Escritorio',route('home.index'),'flaticon-line-graph','')!!}



        <!--ROOT-->
    @if (str_contains(Auth::user()->codigo_rol,['root']))

        <!-- ROOT -->

            <li class="m-menu__section ">
                <h4 class="m-menu__section-text">Modulos Root.</h4>
                <i class="m-menu__section-icon flaticon-more-v2"></i>
            </li>

            {!!Form::menu('Usuarios',route('admin.users.index'),'icon-users')!!}

            <li class="m-menu__section ">
                <h4 class="m-menu__section-text">Sistemas</h4>
                <i class="m-menu__section-icon flaticon-more-v2"></i>
            </li>


            {!!Form::menu('Descuento',route('admin.descuentos.index'),'fa fa-cut')!!}
            {!!Form::menu('Cartera',route('admin.carteras.index'),'fa fa-users')!!}
            {!!Form::menu('Pagos',route('admin.pagos.index'),'fa fa-money')!!}
            {!!Form::menu('BUSCAR POSTULANTE',route('admin.informe.index'),'icon-users')!!}
            {!!Form::menu('Buscar Postulante',route('admin.pos.index'),'fa fa-book')!!}

            {!!Form::menu('Colegio',route('admin.colegios.index'),'fa fa-bank')!!}
            {!!Form::menu('Universidad',route('admin.universidades.index'),'fa fa-bank')!!}
            {!!Form::menu('Aulas',route('admin.aulas.index'),'fa fa-cubes')!!}
            {!!Form::menu('Ubigeo',route('admin.ubigeo.index'),'fa fa-bank')!!}
            {!!Form::menu('Postulantes',route('admin.listados.todo'),'fa fa-users')!!}


            {!!Form::menu('Padron Verificador',route('admin.padron.verificador'),'fa fa-database')!!}




            <li class="m-menu__section ">
                <h4 class="m-menu__section-text">Modulos</h4>
                <i class="m-menu__section-icon flaticon-more-v2"></i>
            </li>

            {!!Form::menu('Declaración',route('admin.declaracion.index'),'fa fa-database')!!}
            {!!Form::menu('Semibeca',route('admin.semibeca.index'),'fa fa-cut')!!}
            {!!Form::menu('Estadistica',route('admin.estadisticas.index'),'fa fa-bar-chart')!!}
            {!!Form::menu('Usuarios',route('admin.usuarios.index'),'icon-users')!!}

            {!!Form::menu('Editar Fotos',route('admin.fotos.index'),'fa fa-file-image-o')!!}

            {!!Form::menu('Listados',route('admin.listados.index'),'fa fa-users')!!}

            {!!Form::menu('Padron',route('admin.padron.index'),'fa fa-database')!!}

            {!!Form::menu('Documentos',route('admin.documento.index'),'fa fa-database')!!}



        @endif
        <!--ADMIN -->
        <!-- INFORMES -->


        @if (str_contains(Auth::user()->codigo_rol,['informes']))

            {!!Form::menu('BUSCAR POSTULANTE',route('admin.informe.index'),'icon-users')!!}
<!--            {!!Form::menu('Buscar Postulante',route('admin.pos.index'),'fa fa-book')!!} -->
     <!--       {!!Form::menu('Estadistica',route('admin.estadisticas.index'),'fa fa-bar-chart')!!} -->
	<!--            {!!Form::menu('Editar Fotos',route('admin.fotos.index'),'fa fa-file-image-o')!!} -->
        <!--    {!!Form::menu('Listados',route('admin.listados.index'),'fa fa-file-image-o')!!} -->
	{!!Form::menu('Declaración',route('admin.declaracion.index'),'fa fa-dollar')!!}
            
            @if(Auth::user()->id == 1 || Auth::user()->id == 7 || Auth::user()->id == 19 || Auth::user()->id == 2172 || Auth::user()->id == 13 || Auth::user()->id == 12 || Auth::user()->id == 14
            || Auth::user()->id == 6205)
                {!!Form::menu('Declaración',route('admin.declaracion.index'),'fa fa-dollar')!!}
            @elseif(Auth::user()->id == 10)
                    {!!Form::menu('Buscar Postulante',route('admin.pos.index'),'fa fa-book')!!}
            @endif 
            
          
            
        @endif

        <!-- BECA-->



        @if (str_contains(Auth::user()->codigo_rol,['sistemas']))
            <!-- SISTEMAS -->
            <li class="m-menu__section ">
                <h4 class="m-menu__section-text">Sistemas</h4>
                <i class="m-menu__section-icon flaticon-more-v2"></i>
            </li>
            {!!Form::menu('Padron Verificador',route('admin.padron.verificador'),'fa fa-database')!!}
                {!!Form::menu('BUSCAR POSTULANTE',route('admin.informe.index'),'icon-users')!!}
            {!!Form::menu('Descuento',route('admin.descuentos.index'),'fa fa-cut')!!}

            {!!Form::menu('Pagos',route('admin.pagos.index'),'fa fa-money')!!}

            {!!Form::menu('Buscar Postulante',route('admin.pos.index'),'fa fa-book')!!}

            {!!Form::menu('Colegio',route('admin.colegios.index'),'fa fa-bank')!!}
            {!!Form::menu('Universidad',route('admin.universidades.index'),'fa fa-bank')!!}
                {!!Form::menu('Ubigeo',route('admin.ubigeo.index'),'fa fa-bank')!!}
            {!!Form::menu('Aulas',route('admin.aulas.index'),'fa fa-cubes')!!}

            {!!Form::menu('Postulantes',route('admin.listados.todo'),'fa fa-users')!!}



                <li class="m-menu__section ">
                    <h4 class="m-menu__section-text">Módulos</h4>
                    <i class="m-menu__section-icon flaticon-more-v2"></i>
                </li>
                {!!Form::menu('Declaración',route('admin.declaracion.index'),'fa fa-database')!!}

                {!!Form::menu('Semibeca',route('admin.semibeca.index'),'fa fa-cut')!!}
                {!!Form::menu('Estadistica',route('admin.estadisticas.index'),'fa fa-bar-chart')!!}
                {!!Form::menu('Usuarios',route('admin.usuarios.index'),'icon-users')!!}

                {!!Form::menu('Editar Fotos',route('admin.fotos.index'),'fa fa-file-image-o')!!}

                {!!Form::menu('Preinscritos',route('admin.listados.index'),'fa fa-users')!!}

                {!!Form::menu('Padron',route('admin.padron.index'),'fa fa-database')!!}
                {!!Form::menu('Documentos',route('admin.documento.index'),'fa fa-database')!!}
        @endif










        @if (str_contains(Auth::user()->codigo_rol,['semibeca']))
            <!-- Semibeca-->
            <li class="m-menu__section ">
                <h4 class="m-menu__section-text">Modulos</h4>
                <i class="m-menu__section-icon flaticon-more-v2"></i>
            </li>
            {!!Form::menu('Semibeca',route('admin.semibeca.index'),'fa fa-cut')!!}


        @endif


        @if (str_contains(Auth::user()->codigo_rol,['admin']) && !str_contains(Auth::user()->dni,['aromero']) )


        <!-- ADMIN -->
            <li class="m-menu__section ">
                <h4 class="m-menu__section-text">Modulos</h4>
                <i class="m-menu__section-icon flaticon-more-v2"></i>
            </li>
            {!!Form::menu('Pagos',route('admin.recaudacion'),'fa fa-money')!!}
            {!!Form::menu('Usuarios',route('admin.usuarios.index'),'icon-users')!!}
            {!!Form::menu('BUSCAR POSTULANTE',route('admin.informe.index'),'icon-users')!!}
            {!!Form::menu('Buscar Postulante',route('admin.pos.index'),'fa fa-book')!!}
            {!!Form::menu('Editar Fotos',route('admin.fotos.index'),'fa fa-file-image-o')!!}
            {!!Form::menu('Listados',route('admin.listados.index'),'fa fa-users')!!}
            {!!Form::menu('Padron',route('admin.padron.index'),'fa fa-database')!!}
            {!!Form::menu('Estadistica',route('admin.estadisticas.index'),'fa fa-bar-chart')!!}
            {!!Form::menu('Documentos',route('admin.documento.index'),'fa fa-database')!!}
        @endif






        @if (str_contains(Auth::user()->codigo_rol,['jefatura']))

            <!-- Jefatura -->


            {!!Form::menu('Estadistica',route('admin.estadisticas.index'),'fa fa-bar-chart')!!}
          <!--  {!!Form::menu('Postulantes',route('admin.listados.inscrito'),'fa fa-users')!!} -->


        @endif

        <!-- Jefatura -->

        @if (str_contains(Auth::user()->codigo_rol,['foto']))

          {!!Form::menu('Editar Fotos',route('admin.fotos.index'),'fa fa-file-image-o')!!}
          <!--  {!!Form::menu('Listados',route('admin.listados.index'),'fa fa-file-image-o')!!} -->
        <!--    {!!Form::menu('Buscar Postulante',route('admin.pos.index'),'fa fa-book')!!} -->
           {!!Form::menu('Padron Verificador',route('admin.padron.verificador'),'fa fa-database')!!}
        @endif







        @if (str_contains(Auth::user()->codigo_rol,['admin','root','sistemas']) && false)


            {!!Form::menu('Agregar Víctima del Terrorimo',route('admin.victimas.index'),'fa fa-users')!!}
            {!!Form::menu('Solicitantes de Víctima del Terrorimo',route('admin.victima.lista'),'fa fa-users')!!}

        @endif




        @if (str_contains(Auth::user()->codigo_rol,['semibeca']) && false)
            {!!Form::menu('Usuarios',route('admin.usuarios.index'),'icon-users')!!}
            {!!Form::menu('Preinscritos',route('admin.listados.index'),'fa fa-users')!!}

            {!!Form::menu('Padron',route('admin.padron.index'),'fa fa-database')!!}
            {!!Form::menu('Pagos',route('admin.recaudacion'),'fa fa-money')!!}


        @endif

        @if (str_contains(Auth::user()->codigo_rol,['verificador']))


            {!!Form::menu('Documentos',route('admin.documento.index'),'fa fa-database')!!}
{!!Form::menu('BUSCAR POSTULANTE',route('admin.informe.index'),'icon-users')!!}
        @endif




            @if (str_contains(Auth::user()->codigo_rol,['identificacion','sistemas','root']) && false)

                <li class="m-menu__section ">
                    <h4 class="m-menu__section-text">Módulos</h4>
                    <i class="m-menu__section-icon flaticon-more-v2"></i>
                </li>
            <!--{!!Form::menu('Constancias',route('admin.ingresantes.constancias'),'fa fa-file-pdf-o')!!}
                {!!Form::menu('Etiquetas',route('admin.ingresantes.etiquetas'),'fa fa-sticky-note-o')!!}-->
                {!!Form::menu('Ingresante',route('admin.ingresantes.index'),'fa fa-graduation-cap')!!}
                {{--            {!!Form::menu('Control entrega',route('admin.ingresantes.control.index'),'fa fa-check-square-o')!!}--}}
                {{--            {!!Form::menu('Listado General',route('admin.ingresantes.listadogeneral'),'fa fa-file-pdf-o')!!}--}}
                {{--            {!!Form::menu('Listado Firma',route('admin.ingresantes.listadofirma'),'fa fa-file-pdf-o')!!}--}}
            <!--{!!Form::menu('Listado Notas',route('admin.ingresantes.listadonotas'),'fa fa-file-pdf-o')!!}-->


            @endif
        @if (str_contains(Auth::user()->codigo_rol,['identificacion','sistemas','root','ingreso','admin']) )

            <li class="m-menu__section ">
                <h4 class="m-menu__section-text">Módulos</h4>
                <i class="m-menu__section-icon flaticon-more-v2"></i>
            </li>
        <!-- {!!Form::menu('Constancias',route('admin.ingresantes.constancias'),'fa fa-file-pdf-o')!!} -->
        <!-- {!!Form::menu('Etiquetas',route('admin.ingresantes.etiquetas'),'fa fa-sticky-note-o')!!} -->
         <!--   {!!Form::menu('Ingresante',route('admin.ingresantes.index'),'fa fa-graduation-cap')!!} -->


        <!-- {!!Form::menu('Listado General',route('admin.ingresantes.listadogeneral'),'fa fa-file-pdf-o')!!} -->
        <!-- {!!Form::menu('Listado Firma',route('admin.ingresantes.listadofirma'),'fa fa-file-pdf-o')!!} -->
        <!-- {!!Form::menu('Listado Notas',route('admin.ingresantes.listadonotas'),'fa fa-file-pdf-o')!!} -->


        @endif
        @if(str_contains(Auth::user()->dni,['uni15','uni16']))

            {!!Form::menu('Ingresante',route('admin.ingresantes.index'),'fa fa-graduation-cap')!!}
            {!!Form::menu('Listado Ingresantes',route('admin.ingresantes.control.index'),'fa fa-check-square-o')!!}

        @endif

        @if(str_contains(Auth::user()->dni,['uni001']))

            {!!Form::menu('Documentos',route('admin.documento.index'),'fa fa-database')!!}
        @endif
        @if(str_contains(Auth::user()->dni,['uni002']))

            {!!Form::menu('Documentos',route('admin.documento.index'),'fa fa-database')!!}
        @endif



        @if (str_contains(Auth::user()->codigo_rol,['identificacion','sistemas','root','admin']) )
      <!--  {!!Form::menu('Listado Ingresantes',route('admin.ingresantes.control.index'),'fa fa-check-square-o')!!} -->
       @endif
        @if (str_contains(Auth::user()->codigo_rol,['constancia']))

            {{--<li class="heading">--}}
            {{--<h3 class="uppercase">CONSTANCIAS</h3>--}}
            {{--</li>--}}
            {{--<!--{!!Form::menu('Constancias',route('admin.ingresantes.constancias'),'fa fa-file-pdf-o')!!}--}}
            {{--{!!Form::menu('Etiquetas',route('admin.ingresantes.etiquetas'),'fa fa-sticky-note-o')!!}-->--}}
            {{--{!!Form::menu('Ingresante',route('admin.ingresantes.index'),'fa fa-graduation-cap')!!}--}}

            {{--<!--{!!Form::menu('Listado Notas',route('admin.ingresantes.listadonotas'),'fa fa-file-pdf-o')!!}-->--}}


        @endif

      <!--  {!!Form::menu('Asitencia',route('admin.sorteo.index'),'fa fa-check-square-o')!!} -->
<!--        {!!Form::menu('Sorteo',route('admin.sorteo.sorteo'),'fa fa-check-square-o')!!} -->

    </ul>
</div>
