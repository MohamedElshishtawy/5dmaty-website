
@extends('layouts.normal-layout')

@section('css')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('content')
    <x-navbar class="shadow-sm sticky-top" />

    <section class="hero-split py-3 py-md-6  min-vh-100 d-flex position-sticky overflow-hidden">
        <span class="hero-blob"></span>
        <span class="hero-blob" style="
    bottom: -139px;
    top: auto;
    right: 0px;
"></span>
        <span class="hero-orb"></span>
        <span class="hero-dots"></span>
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-12 col-lg-6 order-2 order-lg-1">
                    <div class="text-center text-lg-start hero-glass p-3 p-md-4 rounded-4">
                        <img class="hero-logo mb-3 mx-auto mx-lg-0" src="{{asset('images/white-5dmaty.svg')}}" alt="5dmaty"/>
                        <h1 class="display-5 fw-bold mb-3  mx-auto mx-lg-0 text-center text-lg-end text-dark">{{ __('خدماتى') }}</h1>
                        <p class="lead mb-4  text-center text-lg-end text-dark">{{ __('general.tagline_home', ['company' => config('app.name')]) }}</p>
                        <div class="d-flex gap-3 justify-content-center justify-content-lg-start">
                            <a href="#categories" class="btn btn-gradient px-4 py-2 rounded-pill">{{ __('general.categories') }}</a>
                            <a href="#features" class="btn btn-outline-dark px-4 py-2 rounded-pill">{{ __('general.features') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 order-1 order-lg-2 d-none d-lg-block position-relative">
                    <img src="{{ asset('images/globe2 (1).png') }}" alt="mock" class="top-50 start-50 w-100 m-auto">
                </div>
            </div>
        </div>
    </section>


    <section id="categories" class="categories-section  py-5 bg-white position-relative">
        <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h2 class="section-title m-0">{{ __('general.categories') }}</h2>
        </div>

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-3 g-4">
            @foreach(($categories ?? collect()) as $category)
                @php
                    $media = $category->medias->first();
                    $src =  $media->url ? asset('storage/' . $media->url) : asset('images/black-5dmaty.svg');
                    $description = $category->description ?? '';
                    $short = \Illuminate\Support\Str::words(strip_tags($description), 15, '...');
                @endphp
                <div class="col">
                    <div class="card category-card h-100 border-0 shadow-sm">
                        <div class="ratio ratio-16x9">
                            <img src="{{ $src }}" alt="{{ $category->name }}" class="category-image">
                        </div>
                        <div class="card-body">
                            <h3 class="h5 card-title mb-2">{{ $category->name }}</h3>
                            <p class="card-text text-muted mb-0">{{ $short }}</p>
                            <div class="d-flex align-items-center justify-content-end mt-3">
                                <a href="https://wa.me/201065189050?text={{ urlencode(__('general.whatsapp_category_question', ['category' => $category->name])) }}" class="btn btn-sm btn-primary">
                                    <i class="fa-brands fa-whatsapp me-2" style="color:#25D366"></i>
                                    تواصل الآن
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        </div>
    </section>

{{--    <section id="features" class="features-section py-5 bg-white position-relative" style="background-color: rgba(0,0,0,0.02)">--}}
{{--        <div class="container">--}}
{{--            <h2 class="section-title text-center mb-4">{{ __('general.features') }}</h2>--}}
{{--            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3 g-lg-4">--}}
{{--                @foreach([1,2,3,4,5] as $i)--}}
{{--                    <div class="col">--}}
{{--                        <div class="card h-100 border-0 shadow-sm rounded-4 p-3">--}}
{{--                            <div class="icon-badge mb-2"><i class="fa-solid fa-star"></i></div>--}}
{{--                            <h3 class="h6 fw-bold mb-1">{{ __('general.feature_title') }} {{ $i }}</h3>--}}
{{--                            <p class="small text-muted mb-0">{{ __('general.feature_desc') }}</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

{{--    <section id="testimonials" class="testimonials-section py-5 bg-white position-relative">--}}
{{--        <div class="container">--}}
{{--            <div class="d-flex align-items-center justify-content-between mb-3">--}}
{{--                <h2 class="section-title m-0">{{ __('general.testimonials') }}</h2>--}}
{{--            </div>--}}
{{--            <div class="scroll-row">--}}
{{--                @foreach([1,2,3,4] as $t)--}}
{{--                    <div class="t-card card border-0 shadow-sm rounded-4">--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="quote-icon mb-2"><i class="fa-solid fa-quote-right"></i></div>--}}
{{--                            <p class="fst-italic mb-3">{{ __('general.testimonial_text') }}</p>--}}
{{--                            <div class="d-flex align-items-center gap-2">--}}
{{--                                <img src="https://i.pravatar.cc/40?img={{ $t }}" class="rounded-circle" width="40" height="40" alt="user">--}}
{{--                                <div>--}}
{{--                                    <div class="fw-bold small">{{ __('general.user_name') }}</div>--}}
{{--                                    <div class="text-muted small">{{ __('general.user_title') }}</div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

{{--    <section id="faq" class="faq-section py-5 bg-white position-relative" style="background-color: rgba(0,0,0,0.02)">--}}
{{--        <div class="container">--}}
{{--            <div class="row g-4 align-items-start">--}}
{{--                <div class="col-12 col-lg-5">--}}
{{--                    <div class="ratio ratio-4x3 bg-dark rounded-4 d-flex align-items-center justify-content-center">--}}
{{--                        <i class="fa-solid fa-circle-question text-white-50" style="font-size: 72px;"></i>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-12 col-lg-7">--}}
{{--                    <h2 class="section-title mb-3">{{ __('general.faq') }}</h2>--}}
{{--                    <div class="accordion" id="faqAccordion">--}}
{{--                        @foreach([1,2,3,4] as $q)--}}
{{--                        <div class="accordion-item border-0 shadow-sm rounded-3 mb-2 overflow-hidden">--}}
{{--                            <h2 class="accordion-header">--}}
{{--                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{$q}}" aria-expanded="{{ $q===1 ? 'true' : 'false' }}" aria-controls="faq{{$q}}">--}}
{{--                                    {{ __('general.faq_q') }} {{ $q }}--}}
{{--                                </button>--}}
{{--                            </h2>--}}
{{--                            <div id="faq{{$q}}" class="accordion-collapse collapse {{ $q===1 ? 'show' : '' }}" data-bs-parent="#faqAccordion">--}}
{{--                                <div class="accordion-body">{{ __('general.faq_a') }}</div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

    <section id="final-cta" class="final-cta-section py-5 bg-white position-relative">
        <div class="container">
            <div class="rounded-4 p-4 p-md-5 text-center text-white cta-bg">
                <h2 class="display-6 fw-bold mb-2">{{ __('general.cta_headline') }}</h2>
                <p class="mb-4">{{ __('general.cta_subtext') }}</p>
                <form class="d-flex gap-2 justify-content-center flex-column flex-sm-row">
                    <input type="email" class="form-control rounded-pill" placeholder="{{ __('general.email_placeholder') }}" required>
                    <button type="submit" class="btn btn-accent rounded-pill px-4">{{ __('general.submit') }}</button>
                </form>
            </div>
        </div>
    </section>

    <x-footer/>
@endsection
