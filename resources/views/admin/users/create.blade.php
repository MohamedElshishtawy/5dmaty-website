@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h1 class="h5 m-0">{{ __('إنشاء مستخدم') }}</h1>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm">{{ __('رجوع') }}</a>
            </div>

            <div class="card">
                <form method="POST" action="{{ route('admin.users.store') }}" class="card-body">
                    @csrf
                    @include('admin.users._form')
                    <div class="d-flex justify-content-end gap-2">
                        <button type="submit" class="btn btn-primary">{{ __('حفظ') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection



