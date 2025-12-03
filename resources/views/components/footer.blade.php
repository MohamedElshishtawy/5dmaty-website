
<footer class="site-footer py-5 position-relative">
    <div class="container">
        <div class="row g-4">

            <div class="col-12 col-lg-3">
                <div class="d-flex align-items-center gap-2 mb-2 justify-content-center justify-content-lg-start">
                    <a href="{{ '/' }}">
                        <img src="{{asset('images/white-5dmaty.svg')}}" width="50" alt="5dmaty Logo">
                    </a>
                    <strong class="text-white">{{ __('general.brand') }}</strong>
                </div>
                <p class="text-white small text-center text-lg-end">{{ __('general.slogen') }} ✨</p>
            </div>

            <div class="col-12 col-lg-3">
                <h5 class="text-dark-emphasis small fw-bold mb-2">{{ __('general.contact_us') }}</h5>
                <ul class="list-unstyled footer-links">
                    <li class="mb-2">
                        <a href="https://www.facebook.com/5damate" target="_blank" rel="noopener" aria-label="{{ __('general.facebook') }}" class="" >
                            <i class="fa-brands fa-facebook me-2" style="color:#1877F2"></i>
                            <span>{{ __('general.facebook') }}</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="https://wa.me/{{ config('constants.whatsapp_number') }}?text={{ urlencode(__('general.whatsapp_prefill')) }}" target="_blank" rel="noopener" aria-label="{{ __('general.whatsapp') }}"  >
                            <i class="fa-brands fa-whatsapp me-2" style="color:#25D366"></i>
                            <span>{{ __('general.cta_whatsapp') }}</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="tel:01065189050" aria-label="{{ __('general.phone') }}">
                            <i class="fa-solid fa-phone me-2"></i>
                            <span>{{ __('general.cta_call') }}: 01065189050</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-6 col-lg-3">
                <h5 class="text-dark-emphasis small fw-bold mb-2">{{ __('general.main_pages') }}</h5>
                <ul class="list-unstyled footer-links text-white">
                    <li><a href="{{ route('home') }}">{{ __('general.home') }}</a></li>
                    <li><a href="{{ route('jobs.index') }}">{{ __('general.employment') }}</a></li>
                    <li><a href="{{ route('properties.index') }}">{{ __('general.real-state') }}</a></li>
                    <li><a href="https://mtgar.5dmaty.com">{{ __('general.market') }}</a></li>
                </ul>
            </div>

            @auth
            <div class="col-6 col-lg-3">
                <h5 class="text-dark-emphasis small fw-bold mb-2">{{ __('general.management_links') }}</h5>
                <ul class="list-unstyled footer-links">
                @role('admin|superadmin')
                
                        <li><a href="{{ route('admin.users.index') }}">{{ __('general.users-management') }}</a></li>
                        <li><a href="{{ route('admin.jobs.index') }}">{{ __('general.employment-management') }}</a></li>
                        <li><a href="{{ route('admin.properties.index') }}">{{ __('general.real-state-management') }}</a></li>
                        <li><a href="{{ route('admin.settings.index') }}">{{ __('general.settings') }}</a></li>
                        <li><a href="{{ route('admin.categories.index') }}">{{ __('general.categories') }}</a></li>
                        
                @endrole
                <li>
                    <form method="post" action="{{route('logout')}}">
                        @csrf
                        
                        <button class="text-danger">{{ __('general.logout') }}</button>
                    </form>
                </li>

            </ul>
        </div>
            @endauth

            @guest
                <div class="col-6 col-lg-3">
                    <h5 class="text-dark-emphasis small fw-bold mb-2">{{ __('general.inter') }}</h5>
                    <ul class="list-unstyled footer-links">
                        <li><a href="{{ route('login') }}">{{ __('general.login') }}</a></li>
                        <li><a href="{{ route('register') }}">{{ __('general.register') }}</a></li>
                    </ul>
                </div>
            @endguest

            <div class="col-12">
                <h5 class="text-dark-emphasis small fw-bold mb-2">{{ __('general.accept_all_methods') }}</h5>
                <div class="d-flex flex-wrap gap-2 align-items-center">
                    <img src="{{ asset('images/payments/visa.png') }}" alt="Visa" width="30" height="30" class="object-fit-contain">
                    <img src="{{ asset('images/payments/visa-electron.png') }}" alt="Visa Electron" width="30" height="30" class="object-fit-contain">
                    <img src="{{ asset('images/payments/maestro.png') }}" alt="Maestro" width="30" height="30" class="object-fit-contain">
                    <img src="{{ asset('images/payments/american-express.png') }}" alt="American Express" width="30" height="30" class="object-fit-contain">
                    <img src="{{ asset('images/payments/paypal.png') }}" alt="PayPal" width="30" height="30" class="object-fit-contain">
                    <img src="{{ asset('images/payments/vodafon.png') }}" alt="Vodafone Cash" width="30" height="30" class="object-fit-contain">
                    <img src="{{ asset('images/payments/card.png') }}" alt="Card" width="30" height="30" class="object-fit-contain">
                </div>
            </div>

        </div>
        <hr class="my-4">
        <div class="d-flex justify-content-between flex-column flex-md-row gap-2">
            <small class="text-white">
                <span id="footer-year"></span> © {{ __('general.brand') }} — {{ __('general.all_rights_reserved') }}
            </small>
        </div>
    </div>
</footer>
<script>
    (function(){
        var yearElement = document.getElementById('footer-year');
        if (yearElement) {
            yearElement.textContent = new Date().getFullYear();
        }
    })();
</script>
