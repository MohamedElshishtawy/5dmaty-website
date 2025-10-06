@extends('layouts.admin-layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h1 class="h5 m-0">{{ __('تعديل مستخدم') }}</h1>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm">{{ __('رجوع') }}</a>
            </div>

            <div class="card">
                <form method="POST" action="{{ route('admin.users.update', $user) }}" class="card-body">
                    @csrf
                    @method('PUT')
                    @include('admin.users._form')
                    <div class="d-flex justify-content-between gap-2">
                        <button type="submit" class="btn btn-primary">{{ __('حفظ') }}</button>
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('{{ __('تأكيد الحذف؟') }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">{{ __('حذف') }}</button>
                        </form>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection



