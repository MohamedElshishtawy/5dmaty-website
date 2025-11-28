@props(['active' => 'home', 'activeSidebar' => null])
<nav {{$attributes->merge(['class'=> "p-0 navbar navbar-expand-lg glass-nav animate-nav overflow-hidden"])}} data-bs-theme="light">
    <div class="align-items-center d-flex justify-content-between px-2 w-100">
        <a class="navbar-brand" href="{{route('home')}}">
            <img src="{{ \App\Support\Settings::imageUrl('site.logo', asset('images/white-5dmaty.svg')) }}" alt="5dmaty" class="nav-logo">
        </a>

        <button class="navbar-toggler d-lg-none border-0 shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileOffcanvas" aria-controls="mobileOffcanvas">
            <img src="{{asset('images/menu.png')}}" width="30" alt="menu" class="menu-icon">
        </button>

        <div class=" navbar-collapse d-none d-lg-flex">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a @class(["nav-link", "link-underline", "active" => $active=='home' ]) href="/">{{__('general.home')}}</a>
                </li>
                {{-- Corrected: Simple list item for desktop navigation --}}
                @hasanyrole('superadmin|admin')
                <li class="nav-item">
                    <a @class(["nav-link", "link-underline", "active" => $active=='dashboard' ]) href="{{route('admin.dashboard')}}">{{__('general.dashboard')}}</a>
                </li>
                @endhasanyrole
                <li class="nav-item">
                    <a @class(["nav-link", "link-underline", "active" => $active=='employment' ]) href="{{route('jobs.index')}}">{{__('general.jobs')}}</a>
                </li>
                <li class="nav-item">
                    <a @class(["nav-link", "link-underline", "active" => $active=='real-state' ]) href="{{route('properties.index')}}">{{__('general.real-state')}}</a>
                </li>
                <li class="nav-item">
                    <a @class(["nav-link", "link-underline", "active" => $active=='market' ]) href="https://mtgar.5dmaty.com">{{__('general.market')}}</a>
                </li>
                <li class="nav-item">
                    <a @class(["nav-link", "link-underline", "active" => $active=='market' ]) href="https://edu.5dmaty.com">{{__('general.courses')}}</a>
                </li>

            </ul>
        </div>
        @guest
            <div class="d-none d-lg-flex">
                <a href="{{route('login')}}" class="btn btn-primary btn-sm">
                    <i class="bi bi-door-open"></i>
                    {{__('general.login')}}
                </a>
            </div>
        @endguest
    </div>
</nav>

<div class="bg-white glass-offcanvas offcanvas offcanvas-end rounded-start-4" tabindex="-1" id="mobileOffcanvas" aria-labelledby="mobileOffcanvasLabel">
    <div class="offcanvas-header glass-offcanvas-header d-block">
        <div class="d-flex justify-content-between align-items-center ">
            <div>
                <h5 class="offcanvas-title text-dark" id="mobileOffcanvasLabel">
                    <img src="{{ \App\Support\Settings::imageUrl('site.logo', asset('images/white-5dmaty.svg')) }}" alt="5dmaty" class="nav-logo">
                </h5>
            </div>
            <div class="d-flex">
                <button type="button" class="btn-close"  aria-label="{{__('general.close')}}" data-bs-dismiss="offcanvas"></button>

            </div>
        </div>
    </div>
    <div class="offcanvas-body d-grid" style="grid-template-rows: 1fr auto;">
        <div class="mb-4">
            <ul class="list-unstyled glass-list">
                <li @class(["py-2 rounded", "bg-body-secondary" => $active == 'home']) >
                    <a @class(['nav-link']) href="/" >
                        <i class="bi bi-house me-2"></i>
                        {{__('general.home')}}
                    </a>
                </li>
                @hasanyrole('superadmin|admin')
                <li @class(["py-2 rounded", "bg-body-secondary" => $active == 'dashboard']) >
                    <a @class(['nav-link']) href="{{ route('admin.dashboard') }}" >
                        <i class="bi bi-speedometer2 me-2"></i>
                        {{__('general.dashboard')}}
                    </a>
                </li>
                @endhasanyrole  {{-- Corrected: This closing directive was missing and caused the "unexpected end of file" error --}}
                <li @class(["py-2 rounded", "bg-body-secondary" => $active == 'employment']) >
                    <a @class(['nav-link']) href="{{route('jobs.index')}}" >
                        <i class="bi bi-briefcase me-2"></i>
                        {{__('general.jobs')}}
                    </a>
                </li>
            
                <li @class(["py-2 rounded", "bg-body-secondary" => $active == 'real-state']) >
                    <a @class(['nav-link']) href="{{route('properties.index')}}" >
                        <i class="bi bi-building me-2"></i>
                        {{__('general.real-state')}}
                    </a>
                </li>
                <li @class(["py-2 rounded", "bg-body-secondary" => $active == 'market']) >
                    <a @class(['nav-link']) href="https://mtgar.5dmaty.com" >
                        <i class="bi bi-shop me-2"></i>
                        {{__('general.market')}}
                    </a>
                </li>
                <li @class(["py-2 rounded", "bg-body-secondary" => $active == 'courses']) >
                    <a @class(['nav-link']) href="https://edu.5dmaty.com" >
                        <i class="bi bi-mortarboard me-2"></i>
                        {{__('general.courses')}}
                    </a>
                </li>
            </ul>
        </div>

        @guest
            <div class="">
                <a href="{{route('login')}}" class="btn btn-primary w-100 rounded-5">
                    <i class="bi bi-door-open"></i>
                    {{__('general.login')}}
                </a>
            </div>
        @endguest

        @auth
            @hasanyrole('superadmin|admin')
            <hr class="text-muted">
            <h6 class="text-muted text-uppercase fw-bold mb-3">{{__('general.management')}}</h6>
            <ul class="list-unstyled glass-list">
                <li @class(["py-2", "rounded", "bg-body-secondary" => $activeSidebar == 'users'])>
                    <a class="nav-link" href="{{route('admin.users.index')}}" >
                        <i class="bi bi-people me-2 "></i>
                        {{__('general.users-management')}}
                    </a>
                </li>
                <li @class(["py-2", "rounded", "bg-body-secondary" => $activeSidebar == 'jobs'])>
                    <a class="nav-link" href="{{route('admin.jobs.index')}}" >
                        <i class="bi bi-briefcase me-2 "></i>
                        {{__('general.employment-management')}}
                    </a>
                </li>
                <li @class(["py-2", "rounded", "bg-body-secondary" => $activeSidebar == 'employees'])>
                    <a class="nav-link" href="{{route('admin.employees.index')}}" >
                        <i class="bi bi-person-lines-fill me-2 "></i>
                        {{__('general.employee_management')}}
                    </a>
                </li>
                <li @class(["py-2", "rounded", "bg-body-secondary" => $activeSidebar == 'properties'])>
                    <a class="nav-link" href="{{route('admin.properties.index')}}" >
                        <i class="bi bi-building me-2 "></i>
                        {{__('general.real-state-management')}}
                    </a>
                </li>
                <li @class(["py-2", "rounded", "bg-body-secondary" => $activeSidebar == 'faqs'])>
                    <a class="nav-link" href="{{route('admin.faqs.index')}}" >
                        <i class="bi bi-question-circle me-2 "></i>
                        {{__('general.faq_management')}}
                    </a>
                </li>
                <li @class(["py-2", "rounded", "bg-body-secondary" => $activeSidebar == 'settings'])>
                    <a class="nav-link" href="{{ route('admin.settings.index') }}" >
                        <i class="bi bi-gear me-2 "></i>
                        {{__('general.settings')}}
                    </a>
                </li>
                <li @class(["py-2", "rounded", "bg-body-secondary" => $activeSidebar == 'categories'])>
                    <a class="nav-link" href="{{route('admin.categories.index')}}" >
                        <i class="bi bi-tags me-2 "></i>
                        {{__('general.categories')}}
                    </a>
                </li>
            </ul>
            @endhasanyrole


            <div class="">
                <form method="post" action="{{route('logout')}}">
                    @csrf
                    <button class="btn bg-secondary-subtle rounded-5 w-100">
                        <i class="bi bi-box-arrow-right"></i>
                        {{__('general.logout')}}
                    </button>
                </form>
            </div>

        @endauth
    </div>
</div>
