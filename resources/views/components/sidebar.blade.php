<div {{$attributes->merge(['class'=>"sidebar"])}}>

    <div class="position-sticky sidebar bg-white  p-3" style="height: 100%; top: 0px;"> 
        <ul class="list-unstyled mb-0">
            <li class="mb-2">
                <a class="nav-link" href="#">
                    <i class="fas fa-users me-2 text-primary-gradient"></i>
                    {{__('general.users-management')}}
                </a>
            </li>
            <li class="mb-2">
                <a class="nav-link" href="{{route('admin.jobs.index')}}">
                    <i class="fas fa-briefcase me-2 text-primary-gradient"></i>
                    {{__('general.employment-management')}}
                </a>
            </li>
            <li class="mb-2">
                <a class="nav-link" href="{{route('admin.employees.index')}}">
                    <i class="fas fa-user-tie me-2 text-primary-gradient"></i>
                    {{__('general.employee_management')}}
                </a>
            </li>
            <li class="mb-2">
                <a class="nav-link" href="{{route('admin.properties.index')}}">
                    <i class="fas fa-home me-2 text-primary-gradient"></i>
                    {{__('general.real-state-management')}}
                </a>
            </li>
            <li class="mb-2">
                <a class="nav-link" href="#">
                    <i class="fas fa-cog me-2 text-primary-gradient"></i>
                    {{__('general.settings')}}
                </a>
            </li>
            <li class="mb-0">
                <a class="nav-link" href="{{route('admin.categories.index')}}">
                    <i class="fas fa-tags me-2 text-primary-gradient"></i>
                    {{__('general.categories')}}
                </a>
            </li>
        </ul>
    </div>
</div>
