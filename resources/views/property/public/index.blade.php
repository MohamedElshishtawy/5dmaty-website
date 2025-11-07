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
            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container">
            @if($properties->count() > 0)
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach($properties as $property)
                        @php
                            $media = $property->medias->first();
                            $image = $media ? asset('storage/' . $media->url) : asset('images/black-5dmaty.svg');
                        @endphp
                        <div class="col">
                            <div class="card property-card h-100 border-0 shadow-sm">
                                <div class="ratio ratio-4x3">
                                    <img src="{{ $image }}" alt="{{ $property->title }}" class="property-image">
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
                                        <div class="mb-3">
                                            <span class="price-badge">{{ number_format($property->price, 0) }} {{__('general.currency')}}</span>
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
@endsection



