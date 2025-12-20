@extends('layouts.normal-layout')

@section('css')
    <style>
        .service-card {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        .service-icon {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .price-badge {
            background: linear-gradient(135deg, #FFD700, #FFA500);
            color: #000;
            font-weight: bold;
            padding: .35rem .75rem;
            border-radius: 12px;
            display: inline-block;
            font-size: .95rem;
        }

        .whatsapp-btn {
            background-color: #25D366;
            color: white;
            border: none;
            border-radius: 50px;
            padding: .6rem 1rem;
            transition: all .2s ease;
        }

        .whatsapp-btn:hover {
            background-color: #128C7E;
            color: #fff;
            transform: scale(1.02);
        }
    </style>
@endsection

@section('content')
    <x-navbar class="shadow-sm sticky-top" />

    <section class="py-5" style="background-color: var(--gray)">
        <div class="container">
            <x-message :message="session('message')" />
            <div class="mb-4">
                <h1 class="h3 fw-bold mb-2 text-center">{{ $category->name }}</h1>
                @if($category->description)
                    <p class="text-muted mb-0">{{ $category->description }}</p>
                @endif
            </div>

            <hr class="my-4 ">

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 g-2">
                @forelse($category->services as $service)
                    @php
                        $icon = $service->icon_image ? asset('storage/' . $service->icon_image) : asset('images/black-5dmaty.svg');
                        $wa_number = config('constants.whatsapp_number');
                        $wa_text = urlencode(__('general.service_whatsapp_message', ['service' => $service->name, 'category' => $category->name]));
                        $wa_url = "https://wa.me/+2{$wa_number}?text={$wa_text}";
                    @endphp
                    <div class="col">
                        <div class="card service-card h-100 rounded-2">
                            <div class="card-body d-grid gap-2" style="grid-template-rows: auto 1fr auto;">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ $icon }}" alt="{{ $service->name }}" class="service-icon rounded">
                                    <div>
                                        <h3 class="h5 mb-1">{{ $service->name }}</h3>
                                        @if(!is_null($service->price) && (float) $service->price > 0)
                                            <span class="price-badge">{{ number_format($service->price, 0) }}
                                                {{ __('general.currency') }}</span>
                                        @endif
                                    </div>
                                </div>
                                @if($service->description)
                                    <p class="text-muted mb-0"
                                        style="display:-webkit-box;;-webkit-box-orient:vertical;overflow:hidden;">
                                        {{ $service->description }}
                                    </p>
                                @endif
                                <div class="d-grid">
                                    <a href="{{ $wa_url }}" target="_blank" class="btn whatsapp-btn">
                                        <i class="fab fa-whatsapp me-2"></i> {{ __('general.inquire_about_service') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-light border text-center text-muted mb-0">{{ __('general.no_services') }}</div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <x-footer />
@endsection