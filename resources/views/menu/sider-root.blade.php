<div class="page-sidebar-wrapper">
<div class="page-sidebar navbar-collapse collapse">
    <ul class="page-sidebar-menu page-sidebar-menu-hover-submenu page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        <li class="sidebar-toggler-wrapper hide">
            <div class="sidebar-toggler">
                <span></span>
            </div>
        </li>
        <!-- END SIDEBAR TOGGLER BUTTON -->
        {!!Form::menu('Escritorio',route('home.index'),'icon-home','start')!!}
        <li class="heading">
            <h3 class="uppercase">Sistema</h3>
        </li>
        {!!Form::menu('Usuarios',route('admin.users.index'),'icon-users')!!}
        <li class="nav-item  ">
            {!!Form::menulink('Configuracion','#','fa fa-cogs')!!}
            <ul class="sub-menu">
               
                
            </ul>
        </li>
        <li class="heading">
            <h3 class="uppercase">Modulos</h3>
        </li>
        {!!Form::menu('Postulantes',route('admin.pos.index'),'fa fa-users')!!}
        {!!Form::menu('Pagos',route('admin.pagos.index'),'fa fa-money')!!}
        {!!Form::menu('Editar Fotos',route('admin.fotos.index'),'fa fa-file-image-o')!!}
        {!!Form::menu('Aulas',route('admin.aulas.index'),'fa fa-cubes')!!}

    </ul>
    <!-- END SIDEBAR MENU -->
    <!-- END SIDEBAR MENU -->
</div>
<!-- END SIDEBAR -->
</div>
