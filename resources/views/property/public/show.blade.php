@extends('layouts.normal-layout')

@section('css')
    <style>
        .property-gallery {
            border-radius: 16px;
            overflow: hidden;
        }
        .property-gallery img {
            width: 100%;
            height: 500px;
            object-fit: cover;
        }
        .property-detail-card {
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .detail-item {
            padding: 1rem 0;
            border-bottom: 1px solid #eee;
        }
        .detail-item:last-child {
            border-bottom: none;
        }
        .price-display {
            background: linear-gradient(135deg, #FFD700, #FFA500);
            color: #000;
            font-size: 2rem;
            font-weight: bold;
            padding: 1.5rem;
            border-radius: 12px;
            text-align: center;
        }
        .whatsapp-btn {
            background-color: #25D366;
            color: white;
            font-size: 1.2rem;
            padding: 1rem 2rem;
            border-radius: 50px;
            border: none;
            transition: all 0.3s ease;
        }
        .whatsapp-btn:hover {
            background-color: #128C7E;
            color: white;
            transform: scale(1.05);
        }
        .thumbnail-gallery {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            margin-top: 10px;
        }
        .thumbnail {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            opacity: 0.6;
            transition: opacity 0.3s;
        }
        .thumbnail:hover, .thumbnail.active {
            opacity: 1;
        }
    </style>
@endsection

@section('content')
    <x-navbar active="real-state" class="shadow-sm sticky-top" />

    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <!-- Property Images -->
                <div class="col-lg-8">
                    @if($property->medias->count() > 0)
                        <div class="property-gallery mb-3">
                            <img id="mainImage" src="{{ asset('storage/' . $property->medias->first()->url) }}" alt="{{ $property->title }}">
                        </div>
                        
                        @if($property->medias->count() > 1)
                            <div class="thumbnail-gallery">
                                @foreach($property->medias as $index => $media)
                                    <img src="{{ asset('storage/' . $media->url) }}" 
                                         alt="{{ $property->title }}" 
                                         class="thumbnail {{ $index === 0 ? 'active' : '' }}"
                                         onclick="changeMainImage('{{ asset('storage/' . $media->url) }}', this)">
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="property-gallery bg-light d-flex align-items-center justify-content-center" style="height: 500px;">
                            <i class="fas fa-home fa-5x text-muted"></i>
                        </div>
                    @endif
                </div>

                <!-- Property Details -->
                <div class="col-lg-4">
                    <div class="property-detail-card bg-white p-4">
                        <h1 class="h3 fw-bold mb-3">{{ $property->title }}</h1>

                        @if($property->price)
                            <div class="price-display mb-4">
                                {{ number_format($property->price, 0) }} {{__('general.currency')}}
                            </div>
                        @endif

                        <div class="details-list">
                            @if($property->location)
                                <div class="detail-item">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-map-marker-alt text-primary me-3 fs-5"></i>
                                        <div>
                                            <small class="text-muted d-block">{{ __('general.location') }}</small>
                                            <strong>{{ $property->location }}</strong>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($property->description)
                                <div class="detail-item">
                                    <div>
                                        <small class="text-muted d-block mb-2">{{ __('general.property_description') }}</small>
                                        <p class="mb-0">{{ $property->description }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        @if($property->whatsapp_phone)
                            @php
                                $wa_number = preg_replace('/\D+/', '', $property->whatsapp_phone);
                                $wa_text = urlencode(__('general.whatsapp_message_template', ['title' => $property->title]));
                                $wa_url = "https://wa.me/{$wa_number}?text={$wa_text}";
                            @endphp
                            <div class="mt-4">
                                <a href="{{ $wa_url }}" target="_blank" class="btn whatsapp-btn w-100">
                                    <i class="fab fa-whatsapp me-2"></i>
                                    {{ __('general.contact_whatsapp') }}
                                </a>
                            </div>
                        @endif

                        <div class="mt-3">
                            <a href="{{ route('properties.index') }}" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-arrow-right me-2"></i>
                                {{ __('general.back_to_properties') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-footer/>

    <script>
        function changeMainImage(src, thumbnail) {
            document.getElementById('mainImage').src = src;
            document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
            thumbnail.classList.add('active');
        }
    </script>
@endsection



