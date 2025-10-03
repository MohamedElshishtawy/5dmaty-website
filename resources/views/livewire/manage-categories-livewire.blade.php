<div class="card">
    <div class="card-header">
        <h2 class="card-title">{{__('admin.categories.manage')}}</h2>
        <div>
            <button class="btn btn-primary" wire:click="$set('showCreateForm', true)">{{__('admin.categories.add_new')}}</button>
        </div>
    </div>
    <div class="card-body">
        <table class="table" >
            <thead>
            <th>الاسم </th>
            <th>الوصف</th>
            <th>الاجراءات</th>
            </thead>

            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->name}}</td>
                    <td>{{$category->description}}</td>
                    <td>
                        <button class="btn btn-sm btn-info" wire:click="$dispatch('openModal', {component: 'create-edit-category-modal', arguments: {category: {{$category->id}}}})">{{__('general.edit')}}</button>
                        <button class="btn btn-sm btn-danger" wire:confirm="{{__('admin.categories.confirm_delete')}}" wire:click="delete({{$category->id}})">{{__('general.delete')}}</button>
                    </td>

        </table>
    </div>
</div>
