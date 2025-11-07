<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h2 class="card-title">{{__('admin.categories.manage')}}</h2>
        <div>
            <button class="btn btn-primary" wire:click="$dispatch('openModal', {'component': 'create-edit-category-modal'})">{{__('admin.categories.add_new')}}</button>
        </div>
    </div>
    <div class="card-body">
        <table class="table" >
            <thead>
            <th>الاسم </th>
            <th>الوصف</th>
            <th>الإجراءات</th>
            </thead>

            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->name}}</td>
                    <td>{{$category->description}}</td>
                    <td>
                        <div class="btn-group" style="direction: ltr">
                            <button class="btn btn-sm btn-info" wire:click="$dispatch('openModal', {'component': 'create-edit-category-modal', 'arguments': {'category': {{$category->id}}} })">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" wire:confirm="{{__('admin.categories.confirm_delete')}}" wire:click="delete({{$category->id}})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
