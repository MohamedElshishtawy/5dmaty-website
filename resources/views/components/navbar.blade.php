<nav {{$attributes->merge(['class'=> "navbar navbar-expand-lg bg-warning"])}} data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}">
            <img src="{{asset('images/5dmaty-logo.svg')}}" alt="5dmaty" width="30" height="24">
        </a>
        
        <!-- Mobile offcanvas toggle button -->
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileOffcanvas" aria-controls="mobileOffcanvas">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Desktop navigation -->
        <div class="collapse navbar-collapse d-none d-lg-flex">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">{{__('general.home')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{__('general.employment')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{__('general.real-state')}}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Mobile Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="mobileOffcanvas" aria-labelledby="mobileOffcanvasLabel">
    <div class="offcanvas-header bg-warning">
        <h5 class="offcanvas-title text-dark" id="mobileOffcanvasLabel">
            <img src="{{asset('images/5dmaty-logo.svg')}}" alt="5dmaty" width="24" height="20" class="me-2">
            5dmaty
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="{{__('general.close')}}"></button>
    </div>
    <div class="offcanvas-body">
        <!-- Main Navigation -->
        <div class="mb-4">
            <ul class="list-unstyled">
                <li class="mb-2">
                    <a class="btn btn-outline-warning w-100 text-start" href="#" data-bs-dismiss="offcanvas">
                        <i class="fas fa-home me-2"></i>
                        {{__('general.home')}}
                    </a>
                </li>
                <li class="mb-2">
                    <a class="btn btn-outline-warning w-100 text-start" href="#" data-bs-dismiss="offcanvas">
                        <i class="fas fa-briefcase me-2"></i>
                        {{__('general.employment')}}
                    </a>
                </li>
                <li class="mb-2">
                    <a class="btn btn-outline-warning w-100 text-start" href="#" data-bs-dismiss="offcanvas">
                        <i class="fas fa-building me-2"></i>
                        {{__('general.real-state')}}
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Management Section -->
        <hr class="text-muted">
        <h6 class="text-muted text-uppercase fw-bold mb-3">{{__('general.management')}}</h6>
        <ul class="list-unstyled">
            <li class="mb-2">
                <a class="btn btn-light w-100 text-start" href="#" data-bs-dismiss="offcanvas">
                    <i class="fas fa-users me-2 text-warning"></i>
                    {{__('general.users-management')}}
                </a>
            </li>
            <li class="mb-2">
                <a class="btn btn-light w-100 text-start" href="#" data-bs-dismiss="offcanvas">
                    <i class="fas fa-user-tie me-2 text-warning"></i>
                    {{__('general.employment-management')}}
                </a>
            </li>
            <li class="mb-2">
                <a class="btn btn-light w-100 text-start" href="#" data-bs-dismiss="offcanvas">
                    <i class="fas fa-home me-2 text-warning"></i>
                    {{__('general.real-state-management')}}
                </a>
            </li>
            <li class="mb-2">
                <a class="btn btn-light w-100 text-start" href="#" data-bs-dismiss="offcanvas">
                    <i class="fas fa-cog me-2 text-warning"></i>
                    {{__('general.settings')}}
                </a>
            </li>
            <li class="mb-2">
                <a class="btn btn-light w-100 text-start" href="#" data-bs-dismiss="offcanvas">
                    <i class="fas fa-tags me-2 text-warning"></i>
                    {{__('general.categories')}}
                </a>
            </li>
        </ul>
    </div>
</div>
