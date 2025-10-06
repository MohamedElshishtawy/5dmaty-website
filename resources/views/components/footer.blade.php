
<footer class="site-footer py-5 position-relative">
    <div class="container">
        <div class="row g-4">

            <div class="col-12 col-lg-3">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <a href="{{ '/' }}">
                        <img src="{{asset('images/white-5dmaty.svg')}}" width="50" alt="5dmaty Logo">
                    </a>
                    <strong class="text-white">{{ __('general.brand') }}</strong>
                </div>
            </div>

            <div class="col-12 col-lg-3">
                <h6 class="text-light-emphasis small fw-bold mb-2">{{ __('general.contact_us') }}</h6>
                <ul class="list-unstyled footer-links">
                    <li class="mb-2">
                        <a href="https://www.facebook.com/5damate" target="_blank" rel="noopener" aria-label="{{ __('general.facebook') }}" class="" >
                            <i class="fa-brands fa-facebook me-2" style="color:#1877F2"></i>
                            <span>{{ __('general.facebook') }}</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="https://wa.me/201065189050?text={{ urlencode(__('general.whatsapp_prefill')) }}" target="_blank" rel="noopener" aria-label="{{ __('general.whatsapp') }}"  >
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
                <h6 class="text-light-emphasis small fw-bold mb-2">{{ __('general.main_pages') }}</h6>
                <ul class="list-unstyled footer-links text-white">
                    <li><a href="#">{{ __('general.home') }}</a></li>
                    <li><a href="#">{{ __('general.employment') }}</a></li>
                    <li><a href="#">{{ __('general.real-state') }}</a></li>
                    <li><a href="#">{{ __('general.market') }}</a></li>
                </ul>
            </div>

            @auth
                @role('admin|superadmin')
                <div class="col-6 col-lg-3">
                    <h6 class="text-light-emphasis small fw-bold mb-2">{{ __('general.management_links') }}</h6>
                    <ul class="list-unstyled footer-links">
                        <li><a href="#">{{ __('general.users-management') }}</a></li>
                        <li><a href="#">{{ __('general.employment-management') }}</a></li>
                        <li><a href="#">{{ __('general.real-state-management') }}</a></li>
                        <li><a href="#">{{ __('general.settings') }}</a></li>
                        <li><a href="#">{{ __('general.categories') }}</a></li>
                    </ul>
                </div>
                @endrole
            @endauth

            @guest
                <div class="col-6 col-lg-3">
                    <h6 class="text-light-emphasis small fw-bold mb-2">{{ __('general.manage') }}</h6>
                    <ul class="list-unstyled footer-links">
                        <li><a href="{{ route('login') }}">{{ __('general.login') }}</a></li>
                        <li><a href="{{ route('register') }}">{{ __('general.register') }}</a></li>
                    </ul>
                </div>
            @endguest


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
