@php
    $route = \Route::currentRouteName();
@endphp

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('site-setting')}}" class="brand-link">
        <img src="{{asset('assets/dist/img/AdminLTELogo.png')}}" alt="Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">{{config('app.name')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
{{--                <li class="nav-item {{$route === 'about' || $route === 'academics' || $route === 'admission'--}}
{{--                        || $route === 'student-life' || $route === 'giving' || $route === 'parents' ? 'menu-open' : ''}}">--}}
                <li class="nav-item {{$route === 'about' || $route === 'academics' || $route === 'admission'
                        || $route === 'media' || $route === 'home-page' || $route === 'facilities' ? 'menu-open' : ''}}">
                    <a href="" class="nav-link {{$route === 'about' || $route === 'academics' || $route === 'admission'
                        || $route === 'media' || $route === 'home-page' || $route === 'facilities' ? 'active' : ''}}">
                        <i class="nav-icon fas fa-print"></i>
                        <p>
                            Pages
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('home-page')}}" class="nav-link {{ $route === 'home-page' || $route === 'slide-create' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Home Page</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('about')}}" class="nav-link {{ $route === 'about' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>About</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('academics') }}"
                               class="nav-link {{ $route === 'academics' ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Academics</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admission') }}"
                               class="nav-link {{ $route === 'admission' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Admission</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('media') }}"
                               class="nav-link {{ $route === 'media' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Student Life</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('facilities') }}"
                               class="nav-link {{ $route === 'facilities' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Parents</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('news') }}"
                       class="nav-link {{ $route === 'news' || $route === 'news-create' ? 'active' : ''}}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            News
                            <span class="right badge badge-sm badge-secondary ml-2"> & articles...</span>
                        </p>
                    </a>
                </li>
                {{--
                <li class="nav-item">
                    <a href="javascript:void(0)"
                       class="nav-link">
                        <i class="fas fa-users nav-icon"></i>
                        <p>
                            Managment Staff
                            <span class="right badge badge-sm badge-secondary ml-2">Inactive</span>
                        </p>
                    </a>
                </li>
                --}}
                <li class="nav-item">
                    <a href="{{route('photo-splash')}}"
                       class="nav-link {{ $route === 'photo-splash' || $route === 'splash-create' ? 'active' : '' }}">
                        <i class="fas fa-upload nav-icon"></i>
                        <p>
                            Photo Splash
                            <span class="right badge badge-secondary">Media</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('testimonials')}}"
                       class="nav-link {{ $route === 'testimonials' || $route === 'testimonial-create' ? 'active' : '' }}">
                        <i class="fas fa-image nav-icon"></i>
                        <p>
                            Testimonials
{{--                            <span class="right badge badge-secondary">Media</span>--}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('questions-answer')}}"
                       class="nav-link {{ $route === 'questions-answer' || $route === 'questions-answer-create' ? 'active' : '' }}">
                        <i class="fas fa-image nav-icon"></i>
                        <p>
                            Question & Answers
{{--                            <span class="right badge badge-secondary">Media</span>--}}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('school-calendar')}}"
                       class="nav-link {{ $route === 'school-calendar' || $route === 'upcoming-event-create' ? 'active' : '' }}">
                        <i class="fas fa-image nav-icon"></i>
                        <p>
                            School Calendar
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('menu-submenu')}}"
                       class="nav-link {{ $route === 'menu-submenu' ? 'active' : '' }}">
                        <i class="fas fa-building nav-icon"></i>
                        <p>
                            Menu
                            <span class="right badge badge-secondary">& Submenus</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('site-setting')}}"
                       class="nav-link {{ $route === 'site-setting' ? 'active' : '' }}">
                        <i class="fas fa-cog nav-icon"></i>
                        <p>
                            Site Settings
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
