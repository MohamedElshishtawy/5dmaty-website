@props(['active' => 'home'])
<nav {{$attributes->merge(['class'=> "pb-0 navbar navbar-expand-lg glass-nav animate-nav overflow-hidden"])}} data-bs-theme="light">
    <div class="align-items-center d-flex justify-content-between p-2 w-100">
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
                    <a @class(["nav-link", "link-underline", "active" => $active=='market' ]) href="https://margar.5dmaty.com">{{__('general.market')}}</a>
                </li>
                <li class="nav-item">
                    <a @class(["nav-link", "link-underline", "active" => $active=='market' ]) href="https://edu.5dmaty.com">{{__('general.courses')}}</a>
                </li>

            </ul>
        </div>
        @guest
            <div class="d-none d-lg-flex">
                <a href="{{route('login')}}" class="btn btn-primary">
                    {{__('general.login')}}
                </a>
            </div>
        @endguest
    </div>
</nav>

<div class="offcanvas offcanvas-end glass-offcanvas" tabindex="-1" id="mobileOffcanvas" aria-labelledby="mobileOffcanvasLabel">
    <div class="offcanvas-header glass-offcanvas-header d-block">
        <div class="d-flex justify-content-between align-items-center ">
            <div>
                <h5 class="offcanvas-title text-dark" id="mobileOffcanvasLabel">
                    <img src="{{ \App\Support\Settings::imageUrl('site.logo', asset('images/white-5dmaty.svg')) }}" alt="5dmaty" class="nav-logo">
                </h5>
            </div>
            <div>
                <button type="button" class="btn-close"  aria-label="{{__('general.close')}}" data-bs-dismiss="offcanvas"></button>

            </div>
        </div>
    </div>
    <div class="offcanvas-body">
        <div class="mb-4">
            <ul class="list-unstyled glass-list">
                <li class="mb-2">
                    <a @class(['nav-link', '', 'active' => $active == 'home']) href="/" >
                        <i class="fas fa-home me-2"></i>
                        {{__('general.home')}}
                    </a>
                </li>
                @hasanyrole('superadmin|admin')
                <li class="mb-2">
                    <a @class(['nav-link', '', 'active' => $active == 'dashboard']) href="{{ route('admin.dashboard') }}" >
                        <i class="fas fa-tachometer-alt me-2"></i>
                        {{__('general.dashboard')}}
                    </a>
                </li>
                @endhasanyrole  {{-- Corrected: This closing directive was missing and caused the "unexpected end of file" error --}}
                <li class="mb-2">
                    <a @class(['nav-link', '', 'active' => $active == 'employment']) href="{{route('jobs.index')}}" >
                        <i class="fas fa-briefcase me-2"></i>
                        {{__('general.jobs')}}
                    </a>
                </li>
                <li class="mb-2">
                    <a @class(['nav-link', '', 'active' => $active == 'employee-profile']) href="{{route('employee-profile.upsert')}}" >
                        <i class="fas fa-user-tie me-2"></i>
                        {{__('general.employee_profile')}}
                    </a>
                </li>
                <li class="mb-2">
                    <a @class(['nav-link', '', 'active' => $active == 'real-state']) href="{{route('properties.index')}}" >
                        <i class="fas fa-building me-2"></i>
                        {{__('general.real-state')}}
                    </a>
                </li>
                <li class="mb-2">
                    <a @class(['nav-link', '', 'active' => $active == 'market']) href="https://margar.5dmaty.com" >
                        <i class="fas fa-store me-2"></i>
                        {{__('general.market')}}
                    </a>
                </li>
                <li class="mb-2">
                    <a @class(['nav-link', '', 'active' => $active == 'courses']) href="https://edu.5dmaty.com" >
                        <i class="fas fa-graduation-cap me-2"></i>
                        {{__('general.courses')}}
                    </a>
                </li>
            </ul>
        </div>

        @guest
            <div class="">
                <a href="{{route('login')}}" class="btn btn-primary">
                    {{__('general.login')}}
                </a>
            </div>
        @endguest

        @auth
            @hasanyrole('superadmin|admin')
            <hr class="text-muted">
            <h6 class="text-muted text-uppercase fw-bold mb-3">{{__('general.management')}}</h6>
            <ul class="list-unstyled glass-list">
                <li class="mb-2">
                    <a class="btn glass-btn w-100 text-end" href="#" >
                        <i class="fas fa-users me-2 "></i>
                        {{__('general.users-management')}}
                    </a>
                </li>
                <li class="mb-2">
                    <a class="btn glass-btn w-100 text-end" href="{{route('admin.jobs.index')}}" >
                        <i class="fas fa-briefcase me-2 "></i>
                        {{__('general.employment-management')}}
                    </a>
                </li>
                <li class="mb-2">
                    <a class="btn glass-btn w-100 text-end" href="{{route('admin.employees.index')}}" >
                        <i class="fas fa-user-tie me-2 "></i>
                        {{__('general.employee_management')}}
                    </a>
                </li>
                <li class="mb-2">
                    <a class="btn glass-btn w-100 text-end" href="{{route('admin.properties.index')}}" >
                        <i class="fas fa-home me-2 "></i>
                        {{__('general.real-state-management')}}
                    </a>
                </li>
                <li class="mb-2">
                    <a class="btn glass-btn w-100 text-end" href="{{route('admin.faqs.index')}}" >
                        <i class="fas fa-question-circle me-2 "></i>
                        {{__('general.faq_management')}}
                    </a>
                </li>
                <li class="mb-2">
                    <a class="btn glass-btn w-100 text-end" href="{{ route('admin.settings.index') }}" >
                        <i class="fas fa-cog me-2 "></i>
                        {{__('general.settings')}}
                    </a>
                </li>
                <li class="mb-2">
                    <a class="btn glass-btn w-100 text-end" href="{{route('admin.categories.index')}}" >
                        <i class="fas fa-tags me-2 "></i>
                        {{__('general.categories')}}
                    </a>
                </li>
            </ul>
            @endhasanyrole
        @endauth
    </div>
</div>
