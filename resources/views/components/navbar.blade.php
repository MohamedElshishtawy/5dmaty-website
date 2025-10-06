<nav {{$attributes->merge(['class'=> "pb-0 navbar navbar-expand-lg glass-nav animate-nav overflow-hidden"])}} data-bs-theme="light">
    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}">
            <img src="{{asset('images/white-5dmaty.svg')}}" alt="5dmaty" class="nav-logo">
        </a>

        <!-- Mobile offcanvas toggle button -->
        <button class="navbar-toggler d-lg-none border-0 shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileOffcanvas" aria-controls="mobileOffcanvas">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Desktop navigation -->
        <div class=" navbar-collapse d-none d-lg-flex">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link link-underline active" href="#">{{__('general.home')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-underline" href="#">{{__('general.employment')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-underline" href="#">{{__('general.real-state')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-underline" href="#">{{__('general.market')}}</a>
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

<!-- Mobile Offcanvas -->
<div class="offcanvas offcanvas-end glass-offcanvas" tabindex="-1" id="mobileOffcanvas" aria-labelledby="mobileOffcanvasLabel">
    <div class="offcanvas-header glass-offcanvas-header d-block">
        <div class="d-flex justify-content-between align-items-center ">
            <div>
                <h5 class="offcanvas-title text-dark" id="mobileOffcanvasLabel">
                    <img src="{{asset('images/white-5dmaty.svg')}}" alt="5dmaty" class="nav-logo">
                </h5>
            </div>
            <div>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="{{__('general.close')}}"></button>

            </div>
        </div>
    </div>
    <div class="offcanvas-body">
        <!-- Main Navigation -->
        <div class="mb-4">
            <ul class="list-unstyled glass-list">
                <li class="mb-2">
                    <a class="nav-link link-underline active" href="#" data-bs-dismiss="offcanvas">
                        <i class="fas fa-home me-2"></i>
                        {{__('general.home')}}
                    </a>
                </li>
                <li class="mb-2">
                    <a class="nav-link link-underline" href="#" data-bs-dismiss="offcanvas">
                        <i class="fas fa-briefcase me-2"></i>
                        {{__('general.employment')}}
                    </a>
                </li>
                <li class="mb-2">
                    <a class="nav-link link-underline " href="#" data-bs-dismiss="offcanvas">
                        <i class="fas fa-building me-2"></i>
                        {{__('general.real-state')}}
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

        <!-- Management Section -->
        @auth
            @role('superadmin')
            <hr class="text-muted">
            <h6 class="text-muted text-uppercase fw-bold mb-3">{{__('general.management')}}</h6>
            <ul class="list-unstyled glass-list">
                <li class="mb-2">
                    <a class="btn glass-btn w-100 text-end" href="#" data-bs-dismiss="offcanvas">
                        <i class="fas fa-users me-2 "></i>
                        {{__('general.users-management')}}
                    </a>
                </li>
                <li class="mb-2">
                    <a class="btn glass-btn w-100 text-end" href="#" data-bs-dismiss="offcanvas">
                        <i class="fas fa-user-tie me-2 "></i>
                        {{__('general.employment-management')}}
                    </a>
                </li>
                <li class="mb-2">
                    <a class="btn glass-btn w-100 text-end" href="#" data-bs-dismiss="offcanvas">
                        <i class="fas fa-home me-2 "></i>
                        {{__('general.real-state-management')}}
                    </a>
                </li>
                <li class="mb-2">
                    <a class="btn glass-btn w-100 text-end" href="#" data-bs-dismiss="offcanvas">
                        <i class="fas fa-cog me-2 "></i>
                        {{__('general.settings')}}
                    </a>
                </li>
                <li class="mb-2">
                    <a class="btn glass-btn w-100 text-end" href="#" data-bs-dismiss="offcanvas">
                        <i class="fas fa-tags me-2 "></i>
                        {{__('general.categories')}}
                    </a>
                </li>
            </ul>
            @endrole
        @endauth
    </div>
</div>
