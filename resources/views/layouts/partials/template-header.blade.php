<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
    <div class="m-topbar  m-stack m-stack--ver m-stack--general">
        <ul class="m-topbar__nav m-nav m-nav--inline"></ul>
    </div>
    <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
        <div class="m-stack__item m-topbar__nav-wrapper">
            <span> <strong><h43>Concurso de Admisión 2026-1</h4></strong> </span>
            <ul class="m-topbar__nav m-nav m-nav--inline">
                <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                    m-dropdown-toggle="click">
                    <a href="#" class="m-nav__link m-dropdown__toggle">
                        <span class="m-topbar__welcome">Bienvenido,&nbsp;</span>
                        <span class="m-topbar__username">{{ Auth::user()->dni }}</span>
                        <span class="m-topbar__userpic">
														<img src="{{ Auth::user()->mostrar_foto }}" class="m--img-rounded m--marginless m--img-centered" alt="" />
													</span>
                    </a>
                    <div class="m-dropdown__wrapper">
                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                        <div class="m-dropdown__inner">
                            <div class="m-dropdown__header m--align-center" style="background: url({{asset('assets2/app/media/img/misc/user_profile_bg.jpg')}}); background-size: cover;">
                                <div class="m-card-user m-card-user--skin-dark">
                                    <div class="m-card-user__pic">
                                        <img src="{{ Auth::user()->mostrar_foto }}" class="m--img-rounded m--marginless" alt="" />
                                    </div>
                                    <div class="m-card-user__details">
                                        <span class="m-card-user__name m--font-weight-500">{{ Auth::user()->dni }}</span>
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




                                        <li class="m-nav__separator m-nav__separator--fit">
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="{{url('/logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Salir</a>




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
</div>
