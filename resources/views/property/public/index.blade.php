@extends('layouts.normal-layout')

@section('css')
    <style>
        .property-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 16px;
            overflow: hidden;
        }
        .property-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.15) !important;
        }
        .property-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .price-badge {
            background: linear-gradient(135deg, #FFD700, #FFA500);
            color: #000;
            font-weight: bold;
            padding: 0.5rem 1rem;
            border-radius: 12px;
            display: inline-block;
        }
        .hero-properties {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 4rem 0 2rem;
        }
    </style>
@endsection

@section('content')
    <x-navbar active="real-state" class="shadow-sm sticky-top" />

    <section class="hero-properties">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="display-4 fw-bold text-dark mb-3">{{ __('general.properties') }}</h1>
                <p class="lead text-muted">{{ __('general.properties_subtitle') }}</p>
                @auth
                <div class="d-flex justify-end">
                    <button id="add-property-btn" class="btn btn-warning text-dark fw-semibold">
                        <i class="fas fa-plus ms-1"></i> {{ __('general.add_property') }}
                    </button>
                </div>
                @endauth
            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container">
            @if($properties->count() > 0)
                {{-- <form method="GET" action="{{ route('properties.index') }}" class="row g-2 align-items-end mb-4">
                    <div class="col-6 col-md-3">
                        <label for="property_type" class="form-label mb-1">{{ __('general.filter_by_type') }}</label>
                        <select id="property_type" name="property_type" class="form-select">
                            <option value="">{{ __('general.all_types') }}</option>
                            <option value="sale" @selected(request('property_type')==='sale')>{{ __('general.sale') }}</option>
                            <option value="rent" @selected(request('property_type')==='rent')>{{ __('general.rent') }}</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="property_status" class="form-label mb-1">{{ __('general.filter_by_status') }}</label>
                        <select id="property_status" name="property_status" class="form-select">
                            <option value="">{{ __('general.all') }}</option>
                            <option value="active" @selected(request('property_status')==='active')>{{ __('general.status_active') }}</option>
                            <option value="sold" @selected(request('property_status')==='sold')>{{ __('general.status_sold') }}</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-auto d-flex gap-2">
                        <button type="submit" class="btn btn-primary">{{ __('general.filter_by') }}</button>
                        <a href="{{ route('properties.index') }}" class="btn btn-outline-secondary">{{ __('general.clear_filters') }}</a>
                    </div>
                </form> --}}
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach($properties as $property)
                        @php
                            $media = $property->medias->first();
                            $mediaUrl = $media ? asset('storage/' . $media->url) : asset('images/black-5dmaty.svg');
                            $isVideo = $media && $media->type === 'video';
                        @endphp
                        <div class="col">
                            <div class="card property-card h-100 border-0 shadow-sm">
                                <div class="ratio ratio-4x3">
                                    @if($isVideo)
                                        <video src="{{ $mediaUrl }}" class="property-image" controls preload="metadata"></video>
                                    @else
                                        <img src="{{ $mediaUrl }}" alt="{{ $property->title }}" class="property-image">
                                    @endif
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h3 class="h5 card-title mb-2">{{ $property->title }}</h3>
                                    
                                    @if($property->location)
                                        <p class="text-muted mb-2">
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            {{ $property->location }}
                                        </p>
                                    @endif

                                    @if($property->price)
                                        <div class="mb-3 d-flex align-items-center gap-2 flex-wrap">
                                            <span class="price-badge">{{ number_format($property->price, 0) }} {{__('general.currency')}}</span>
                                            <x-property-badges :property="$property" />
                                        </div>
                                    @else
                                        <div class="mb-3">
                                            <x-property-badges :property="$property" />
                                        </div>
                                    @endif

                                    <div class="mt-auto">
                                        <a href="{{ route('properties.show', $property->slug) }}" class="btn btn-primary w-100">
                                            {{ __('general.view_details') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-5 d-flex justify-content-center">
                    {{ $properties->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-home fa-4x text-muted mb-3"></i>
                    <h3 class="text-muted">{{ __('general.no_properties') }}</h3>
                </div>
            @endif
        </div>
    </section>

    <x-footer/>
    @auth
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var btn = document.getElementById('add-property-btn');
            if (btn) {
                btn.addEventListener('click', function () {
                    if (window.Livewire && typeof window.Livewire.dispatch === 'function') {
                        window.Livewire.dispatch('openModal', { component: 'create-edit-property-modal' });
                    } else if (window.livewire && typeof window.livewire.emit === 'function') {
                        window.livewire.emit('openModal', 'create-edit-property-modal');
                    }
                });
            }
        });
    </script>
    @endauth
@endsection



