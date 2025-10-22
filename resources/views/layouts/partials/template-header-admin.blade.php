
<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">

    <!-- BEGIN: Horizontal Menu -->
    <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
    <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark ">
<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">

    <!-- BEGIN: Horizontal Menu -->
    <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
    <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark ">

<form id="logout-form-header" action="{{ url('/logout') }}" method="POST" style="display: inline;">
    {{ csrf_field() }}
    <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
</form>


    </div>
    </div>

    <!-- END: Horizontal Menu -->

    <!-- BEGIN: Topbar -->
    <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general m-stack--fluid">
        <div class="m-stack__item m-topbar__nav-wrapper">
            <ul class="m-topbar__nav m-nav m-nav--inline">




                <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                    m-dropdown-toggle="click">
                    <a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-topbar__userpic">
													<img src="{{ asset('storage/'.Auth::user()->foto) }}" class="m--img-rounded m--marginless" alt="" />
												</span>
                        <span class="m-topbar__username m--hide">Nick</span>
                    </a>
                    <div class="m-dropdown__wrapper">
                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                        <div class="m-dropdown__inner">
                            <div class="m-dropdown__header m--align-center" style="background: url({{asset('assets1/app/media/img/misc/user_profile_bg.jpg')}}); background-size: cover;">
                                <div class="m-card-user m-card-user--skin-dark">
                                    <div class="m-card-user__pic">
                                        <img src="{{ asset('storage/'.Auth::user()->foto) }}" class="m--img-rounded m--marginless" alt="" />

                                        <!--
        <span class="m-type m-type--lg m--bg-danger"><span class="m--font-light">S<span><span>
        -->
                                    </div>
                                    <div class="m-card-user__details">
                                        <span class="m-card-user__name m--font-weight-500">@yield('user-name','Administrador') </span>
                                        <a href="" class="m-card-user__email m--font-weight-300 m-link">{{ Auth::user()->email }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="m-dropdown__body">
                                <div class="m-dropdown__content">
                                    <ul class="m-nav m-nav--skin-light">
                                        <li class="m-nav__section m--hide">
                                            <span class="m-nav__section-text">Section</span>
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="{{ route('users.index') }}" class="m-nav__link">
                                                <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                <span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				<span class="m-nav__link-text">Perfil</span>

																			</span>
																		</span>
                                            </a>
                                        </li>


                                        <li class="m-nav__separator m-nav__separator--fit">
                                        </li>


                                        <li class="m-nav__separator m-nav__separator--fit">
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="{{url('/logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Salir</a>
                                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

            </ul>
        </div>
    </div>

    <!-- END: Topbar -->
</div>




















































