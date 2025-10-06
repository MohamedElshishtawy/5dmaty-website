<div {{$attributes->merge(['class'=>"sidebar"])}}>

    <div class=" position-sticky top-0 sidebar">
        <ul class="list-unstyled mb-0">
            <li class="mb-2">
                <a class="nav-link" href="#">
                    <i class="fas fa-users me-2 text-warning"></i>
                    {{__('general.users-management')}}
                </a>
            </li>
            <li class="mb-2">
                <a class="nav-link" href="#">
                    <i class="fas fa-user-tie me-2 text-warning"></i>
                    {{__('general.employment-management')}}
                </a>
            </li>
            <li class="mb-2">
                <a class="nav-link" href="#">
                    <i class="fas fa-home me-2 text-warning"></i>
                    {{__('general.real-state-management')}}
                </a>
            </li>
            <li class="mb-2">
                <a class="nav-link" href="#">
                    <i class="fas fa-cog me-2 text-warning"></i>
                    {{__('general.settings')}}
                </a>
            </li>
            <li class="mb-0">
                <a class="nav-link" href="{{route('admin.categories.index')}}">
                    <i class="fas fa-tags me-2 text-warning"></i>
                    {{__('general.categories')}}
                </a>
            </li>
        </ul>
    </div>
</div>
