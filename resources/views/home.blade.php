
@extends('layouts.normal-layout')

@section('css')
    <link rel="stylesheet" href="{{asset('css/home.css')}}?v=3">
    <link rel="stylesheet" href="{{asset('css/jobs.css')}}?v=3">
    <link rel="stylesheet" href="{{asset('css/accordion.css')}}">
@endsection

@section('content')
<script type="module" src="https://unpkg.com/@lottiefiles/dotlottie-wc@latest/dist/dotlottie-wc.js"></script>

    <x-navbar class="shadow-sm sticky-top" />

    <section class="hero-split py-3 py-md-6  min-vh-100 d-flex position-sticky overflow-hidden">
        <span class="hero-blob"></span>
        <span class="hero-blob" style="
    bottom: -139px;
    top: auto;
    right: 0px;
"></span>
        <span class="hero-orb"></span>
        {{-- <span class="hero-dots"></span> --}}
        <div class="container z-1">
            <div class="row align-items-center g-4">
                <div class="col-12 col-lg-6 order-2 order-lg-1">
                    <div class="text-center text-lg-start hero-glass p-3 p-md-4 rounded-4">
                        
                        <img class="hero-logo mb-3 mx-auto mx-lg-0" src="{{ \App\Support\Settings::imageUrl('home.hero.logo', asset('images/white-5dmaty.svg')) }}" alt="5dmaty"/>
                        
                        <h1 class="display-5 fw-bold mb-3  mx-auto mx-lg-0 text-center text-lg-end text-dark parastoo">{{ \App\Models\Setting::where('key', 'home.hero.title')->where('locale', app()->getLocale())->value('value') ?? __('خدماتي') }}</h1>
                        
                        <p style="font-style: italic;" class="mb-2 bold lead text-center text-lg-end text-dark hero-slogan">{{ \App\Models\Setting::where('key', 'home.hero.subtitle')->where('locale', app()->getLocale())->value('value') ?? __('general.slogen') }}</p>
                        <p class="lead mb-4  text-center text-lg-end text-dark">{{ \App\Models\Setting::where('key', 'seo.home.description')->value('value') ?? __('general.tagline_home') }}</p>
                        
                        <div class="d-flex gap-3 justify-content-center justify-content-lg-start">
                            <a href="#categories" class="btn btn-gradient px-4 py-2 rounded-pill">{{ __('general.categories') }}</a>
                            <a href="#why-us" class="btn btn-outline-dark px-4 py-2 rounded-pill">{{ __('general.why_us_title') }}</a>
                        </div>
                        
                    </div>
                </div>
                <div class="col-12 col-lg-6 order-1 order-lg-2 d-none d-lg-block position-relative">
                    <img src="{{ asset('storage/' . (\App\Models\Setting::where('key', 'home.hero.logo')->value('value') ?? 'images/globe2 (1).png')) }}" alt="mock" class="top-50 start-50 w-100 m-auto">
                </div>
            </div>
            
        </div>
    </section>


    


    <!-- Why Us Section -->
     <section id="why-us" class="why-us-section py-3 position-relative" style="background-color: #f2f3f6">
    <div class="container">
        <div class="text-center mb-3">
            <h2 class="section-title text-primary-gradient my-3">{{ __('general.why_us_title') }}</h2>
        </div>

        <div class="row justify-content-center">
            <!-- Item 1 -->
            <div class="col-6 col-lg-4 why-us-item mb-4">
                <div class="d-flex justify-content-center">
                    <div class="bg-white rounded-circle">
                        <dotlottie-wc
                        src="https://lottie.host/297013e0-5a76-428d-8df6-bef3928d3e93/aC3QDd6v8r.lottie"
                        style="width: 135px; height: 135px;"
                        autoplay
                        loop
                        ></dotlottie-wc>
                    </div>
                </div>
                <div class="d-flex align-items-center bg-white rounded-3 p-2 justify-content-center mt-2 why-us-text relative">
                    <h3 class="fw-bold mb-0 text-primary-gradient text-center" style="font-size: 0.9rem;">{{ __('general.why_us_item_1') }}</h3>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="col-6 col-lg-4 why-us-item mb-4">
                <div class="d-flex justify-content-center">
                    <div class="bg-white rounded-circle">
                        <dotlottie-wc
                        src="https://lottie.host/414509b7-99d1-41ce-bd05-904fafc0b54d/K0hRfZArJQ.lottie"
                        style="width: 135px; height: 135px;"
                        autoplay
                        loop
                        ></dotlottie-wc>
                    </div>
                </div>
                <div class="d-flex align-items-center bg-white rounded-3 p-2 justify-content-center mt-2 why-us-text relative">
                    <h3 class="fw-bold mb-0 text-primary-gradient text-center" style="font-size: 0.9rem;">{{ __('general.why_us_item_2') }}</h3>
                </div>
            </div>

            <!-- Item 3 -->
            <div class="col-6 col-lg-4 why-us-item mb-4">
                <div class="d-flex justify-content-center">
                    <div class="bg-white rounded-circle" style="width: 130px; height: 130px;">
                        <dotlottie-wc
                        src="https://lottie.host/d3866e36-19d1-41d0-8174-8c7d16766ab9/ZrUTybSmMm.lottie"
                        style="width: 135px; height: 135px;"
                        autoplay
                        loop
                        ></dotlottie-wc>
                    </div>
                </div>
                <div class="d-flex align-items-center bg-white rounded-3 p-2 justify-content-center mt-2 why-us-text relative">
                    <h3 class="fw-bold mb-0 text-primary-gradient text-center" style="font-size: 0.9rem;">{{ __('general.why_us_item_3') }}</h3>
                </div>
            </div>

            <!-- Item 4 -->
            <div class="col-6 col-lg-4 why-us-item mb-4">
                <div class="d-flex justify-content-center">
                    <div class="bg-white rounded-circle">
                        <dotlottie-wc
                        src="https://lottie.host/dbcdcb7a-0d97-49b3-ad45-4cf4986b36b1/Xooj10J5XJ.lottie"
                        style="width: 135px; height: 135px;"
                        autoplay
                        loop
                        ></dotlottie-wc>
                    </div>
                </div>
                <div class="d-flex align-items-center bg-white rounded-3 p-2 justify-content-center mt-2 why-us-text relative">
                    <h3 class="fw-bold mb-0 text-primary-gradient text-center" style="font-size: 0.9rem;">{{ __('general.why_us_item_4') }}</h3>
                </div>
            </div>

            <!-- Item 5 -->
            <div class="col-6 col-lg-4 why-us-item mb-4">
                <div class="d-flex justify-content-center">
                    <div class="bg-white rounded-circle">
                        <dotlottie-wc
                        src="https://lottie.host/5e71153a-d46d-41d6-a3af-7f5c1f5b6d15/L7jp4p0Mhb.lottie"
                        style="width: 135px; height: 135px;"
                        autoplay
                        loop
                        ></dotlottie-wc>
                    </div>
                </div>
                <div class="d-flex align-items-center bg-white rounded-3 p-2 justify-content-center mt-2 why-us-text relative">
                    <h3 class="fw-bold mb-0 text-primary-gradient text-center" style="font-size: 0.9rem;">{{ __('general.why_us_item_5') }}</h3>
                </div>
            </div>
        </div>
    </div>
</section> 

    @if(($services ?? collect())->count() > 0)
    <section id="services" class="services-slider-section py-5 bg-white position-relative">
        <div class="">
            <div class="container">
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <h2 class="section-title text-center m-0 text-primary-gradient bold">{{ \App\Support\Settings::get('home.sections.services.title', __('general.services')) }}</h2>
                </div>
                </div>
            <div class="swiper py-3  px-2" style="background-color: #f2f3f6" id="servicesSwiper">
                <div class="swiper-wrapper">
                    @foreach($services as $service)
                        @php
                            $icon = $service->icon_image ? asset('storage/' . $service->icon_image) : asset('images/black-5dmaty.svg');
                        @endphp
                        <div class="swiper-slide">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body d-grid gap-2 align-items-start" style="grid-template-rows: auto 1fr;">
                                    <div class="d-flex gap-3">
                                        <img src="{{ $icon }}" alt="{{ $service->name }}" style="width:60px;height:60px;object-fit:cover;" class="rounded">
                                        <div class="d-grid text-break">
                                            <strong class="small">{{ $service->name }}</strong>
                                            <small class="text-muted">{{ $service->category?->name }}</small>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        @if(!is_null(value: $service->price) && (float)$service->price > 0)
                                            <div>
                                                <span style="background: linear-gradient(135deg, #FFD700, #FFA500); color: #000; font-weight: bold; padding: 0.25rem 0.6rem; border-radius: 8px; font-size:.85rem;">
                                                    {{ number_format($service->price, 0) }} {{ __('general.currency') }}
                                                </span>
                                            </div>
                                        @else
                                            <span></span>
                                        @endif
                                        @php
                                            $wa_number = config('constants.whatsapp_number');
                                            $wa_text = urlencode(__('general.service_whatsapp_message', ['service' => $service->name, 'category' => $service->category?->name ?? '']));
                                            $wa_url = "https://wa.me/+2{$wa_number}?text={$wa_text}";
                                        @endphp
                                        <a href="{{ $wa_url }}" target="_blank" class="btn btn-sm btn-primary" title="{{ __('general.inquire_about_service') }}">
                                            
                                        {{ __('general.view_details') }}
                                        </a>
                                    </div>
                                    @php
                                        $categoryLink = null;
                                        if (!empty($service->category?->slug)) {
                                            $categoryLink = route('categories.show', ['category' => $service->category->slug]);
                                        } elseif (!empty($service->category?->id)) {
                                            $categoryLink = route('categories.showById', ['category' => $service->category->id]);
                                        }
                                    @endphp
                                    @if($categoryLink)
                                        <a class="stretched-link" href="{{ $categoryLink }}" aria-label="{{ $service->name }}"></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                new Swiper('#servicesSwiper', {
                    loop: true,
                    rtl: true,
                    speed: 600,
                    autoplay: { 
                        delay: 1500, // Increased to give enough time between slides
                        disableOnInteraction: false 
                    },
                    slidesPerView: 1.2,
                    spaceBetween: 12,
                    breakpoints: {
                        576: { slidesPerView: 1, spaceBetween: 12 },
                        768: { slidesPerView: 2, spaceBetween: 16 },
                        992: { slidesPerView: 2, spaceBetween: 18 },
                        1200: { slidesPerView: 3, spaceBetween: 20 }
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                });
            });
        </script>
    </section>
    @endif


    <section id="categories" class="categories-section  py-5 bg-white position-relative">
        <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h2 class="section-title m-0">{{ \App\Support\Settings::get('home.sections.categories.title', __('general.categories')) }}</h2>
        </div>

        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach(($categories ?? collect()) as $category)
                @php
                    $media = $category->medias->first();
                    $src =  $media?->url ? asset('storage/' . $media->url) : asset('images/black-5dmaty.svg');
                    $description = $category->description ?? '';
                    $short = \Illuminate\Support\Str::words(strip_tags($description), 15, '...');
                @endphp
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="" style="height: 216px;">
                            <img src="{{ $src }}" alt="{{ $category->name }}" class="w-100 h-100">
                        </div>
                        <div class="p-3" style="
                        display: grid;
                        height: 100%;
                        align-content: space-between;
                        grid-template-rows: auto 1fr auto;
                    ">
                            <h3 class="h5 card-title mb-2">{{ $category->name }}</h3>
                            <div class="card-text text-muted mb-0">
                                <p class="card-text text-muted mb-0">{{ $short }}</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-end mt-3">
                                @php
                                    $categoryLink = null;
                                    if (!empty($category->slug)) {
                                        $categoryLink = route('categories.show', ['category' => $category->slug]);
                                    } elseif (!empty($category->id)) {
                                        $categoryLink = route('categories.showById', ['category' => $category->id]);
                                    }
                                @endphp
                                @if($categoryLink)
                                    <a href="{{ $categoryLink }}" class="btn btn-sm btn-primary">
                                        {{ \App\Support\Settings::get('home.sections.categories.show_more_label', __('general.show_more')) }}
                                    </a>
                                @else
                                    <span class="btn btn-sm btn-secondary disabled">{{ \App\Support\Settings::get('home.sections.categories.show_more_label', __('general.show_more')) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        </div>
    </section>

    <!-- Properties Section -->
    @if($properties->count() > 0)
    <section id="properties" class="properties-section py-5 position-relative" style="background-color: #f2f3f6">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="section-title m-0">{{ \App\Support\Settings::get('home.sections.properties.title', __('general.properties')) }}</h2>
                <a href="{{ route('properties.index') }}" class="btn btn-outline-primary">
                    {{ \App\Support\Settings::get('home.sections.properties.see_more_label', __('general.see_more')) }}
                    <i class="fas fa-arrow-left ms-2"></i>
                </a>
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach($properties as $property)
                    @continue(method_exists($property, 'isPubliclyVisible') && !$property->isPubliclyVisible())
                    @php
                        $media = $property->medias->first();
                        $mediaUrl = $media ? asset('storage/' . $media->url) : asset('images/black-5dmaty.svg');
                        $isVideo = $media && $media->type === 'video';
                    @endphp
                    <div class="col">
                        <div class="card property-card h-100 border-0 shadow-sm">
                            <div class="ratio ratio-4x3">
                                @if($isVideo)
                                    <video src="{{ $mediaUrl }}" style="width: 100%; height: 100%; object-fit: cover;" controls preload="metadata"></video>
                                @else
                                    <img src="{{ $mediaUrl }}" alt="{{ $property->title }}" style="width: 100%; height: 100%; object-fit: cover;">
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

                                @if($property->price > 0)
                                    <div class="mb-3 d-flex align-items-center gap-2 flex-wrap">
                                        <span style="background: linear-gradient(135deg, #FFD700, #FFA500); color: #000; font-weight: bold; padding: 0.5rem 1rem; border-radius: 12px; display: inline-block;">
                                            {{ number_format($property->price, 0) }} {{__('general.currency')}}
                                        </span>
                                        <x-property-badges :property="$property" />
                                    </div>
                                @else
                                    <div class="mb-3">
                                        <x-property-badges :property="$property" />
                                    </div>
                                @endif

                                <div class="mt-auto">
                                    <a href="{{ route('properties.show', $property->slug) }}" class="btn btn-primary w-100">
                                        {{ \App\Support\Settings::get('home.sections.properties.view_details_label', __('general.view_details')) }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Jobs Section -->
    @if($jobs->count() > 0)
    <section id="jobs" class="jobs-section py-5 bg-white position-relative">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="section-title m-0">{{ \App\Support\Settings::get('home.sections.jobs.title', __('general.jobs')) }}</h2>
                <a href="{{ route('jobs.index') }}" class="btn btn-outline-primary">
                    {{ \App\Support\Settings::get('home.sections.jobs.see_more_label', __('general.see_more')) }}
                    <i class="fas fa-arrow-left ms-2"></i>
                </a>
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach($jobs as $job)
                    <div class="col">
                        <div class="card job-card h-100 border-0 shadow-sm">
                            <div class="card-body d-flex flex-column">
                                <h3 class="h5 card-title fw-bold mb-2">{{ $job->title }}</h3>
                                
                                @if($job->shop_name)
                                    <p class="text-muted mb-2">
                                        <i class="fas fa-store me-1"></i>
                                        {{ $job->shop_name }}
                                    </p>
                                @endif

                                @if($job->shop_address)
                                    <p class="text-muted mb-2">
                                        <i class="fas fa-map-marker-alt me-1"></i>
                                        {{ $job->shop_address }}
                                    </p>
                                @endif

                                @if($job->description)
                                    <p class="card-text text-muted mb-3">
                                        {{ Str::limit($job->description, 100) }}
                                    </p>
                                @endif

                                <div class="mt-auto">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('jobs.show', $job->slug) }}" class="btn btn-primary flex-grow-1">
                                            {{ \App\Support\Settings::get('home.sections.jobs.view_details_label', __('general.view_details')) }}
                                        </a>
                                        @if($job->whatsapp_phone)
                                            @php
                                                $wa_number = preg_replace('/\D+/', '', $job->whatsapp_phone);
                                                $wa_text = urlencode(__('general.job_whatsapp_message', ['title' => $job->title]));
                                                $wa_url = "https://wa.me/+2{$wa_number}?text={$wa_text}";
                                            @endphp
                                            <a href="{{ $wa_url }}" target="_blank" class="btn btn-success">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif


    <!-- FAQ Section -->
   
@if(($faqs ?? collect())->count() > 0)
<section id="faq" class="py-5 bg-white position-relative">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h2 class="section-title m-0">{{ __('general.faqs') }}</h2>
        </div>
        <div class="accordion" id="faqAccordion">
            @foreach($faqs as $index => $faq)
                @php
                    $collapseId = 'faqCollapse'.$index;
                @endphp
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#{{ $collapseId }}">
                            {{ $faq->question }}
                        </button>
                    </h2>
                    <div id="{{ $collapseId }}" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            {!! nl2br(e($faq->answer)) !!}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


@endif

    {{-- <section class="py-5 bg-white position-relative">
        <x-show-reviews />
    </section> --}}
    
    <x-footer/>
@endsection


@section('js')
<script src="https://cdn.jsdelivr.net/npm/animejs/dist/bundles/anime.umd.min.js"></script>
<script>
  const { animate } = anime;
</script>

<!-- GSAP & ScrollTrigger -->
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>

<!-- Lottie -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js" integrity="sha512-jEnuDt6jfecCjthQAJ+ed0MTVA++5ZKmlUcmDGBv2vUI/REn6FuIdixLNnQT+vKusE2hhTk2is3cFvv5wA+Sgg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Accordion Functionality -->
<script src="{{asset('js/accordion.js')}}"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Register ScrollTrigger plugin
    gsap.registerPlugin(ScrollTrigger);

    // Initialize Lottie animations
    const iconContainers = document.querySelectorAll('.why-us-icon');
    const lottieAnimations = [];

    iconContainers.forEach((container, index) => {
        const lottiePath = container.getAttribute('data-lottie-path');
        if (lottiePath) {
            const anim = lottie.loadAnimation({
                container: container,
                renderer: 'svg',
                loop: true,
                autoplay: false,
                path: lottiePath
            });
            lottieAnimations.push(anim);
        }
    });

    // GSAP ScrollTrigger animations for items
    const whyUsItems = document.querySelectorAll('.why-us-item');
    
    whyUsItems.forEach((item, index) => {
        const content = item.querySelector('.why-us-content');
        const icon = item.querySelector('.why-us-icon');
        
        // Set initial state
        gsap.set(item, { opacity: 0 });
        gsap.set(content, { 
            y: 30,
            opacity: 0 
        });
        gsap.set(icon, { 
            scale: 0.5,
            opacity: 0 
        });

        // Create timeline for this item
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: item,
                start: 'top 85%',
                end: 'bottom 15%',
                toggleActions: 'play none none reverse'
            }
        });

        // Animate item container
        tl.to(item, {
            opacity: 1,
            duration: 0.4,
            ease: 'power2.out'
        });

        // Animate content (slide up and fade in)
        tl.to(content, {
            y: 0,
            opacity: 1,
            duration: 0.6,
            ease: 'power3.out'
        }, '-=0.2');

        // Animate icon with scale and fade
        tl.to(icon, {
            scale: 1,
            opacity: 1,
            duration: 0.5,
            ease: 'back.out(1.5)'
        }, '-=0.4');

        // Play Lottie animation when icon is visible
        if (lottieAnimations[index]) {
            ScrollTrigger.create({
                trigger: item,
                start: 'top 80%',
                onEnter: () => {
                    lottieAnimations[index].play();
                },
                onLeave: () => {
                    lottieAnimations[index].pause();
                },
                onEnterBack: () => {
                    lottieAnimations[index].play();
                },
                onLeaveBack: () => {
                    lottieAnimations[index].pause();
                }
            });
        }
    });
});
</script>

@endsection