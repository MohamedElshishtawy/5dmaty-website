@extends('layouts.admin-layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h1 class="h5 m-0">{{ __('إدارة المستخدمين') }}</h1>
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">{{ __('مستخدم جديد') }}</a>
            </div>

            <livewire:admin.users-table />
        </div>
    </div>
</div>
@endsection



