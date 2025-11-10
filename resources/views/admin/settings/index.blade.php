@extends('layouts.admin-layout')

@section('css')
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h4 m-0">{{ __('الإعدادات العامة') }}</h1>
    </div>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white d-flex align-items-center justify-content-between">
            <strong>{{ __('إدارة اللغات') }}</strong>
            <small class="text-muted">{{ __('أضِف لغة لتظهر تبويباتها أسفل') }}</small>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.languages.store') }}" method="post" class="row g-2 align-items-end">
                @csrf
                <div class="col-6 col-md-3">
                    <label class="form-label">{{ __('الكود') }}</label>
                    <input type="text" name="code" class="form-control" placeholder="ar / en">
                    @error('code')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="col-6 col-md-3">
                    <label class="form-label">{{ __('الاسم') }}</label>
                    <input type="text" name="name" class="form-control" placeholder="{{ __('العربية / English') }}">
                    @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="col-6 col-md-3">
                    <label class="form-label">{{ __('اتجاه الكتابة') }}</label>
                    <select name="is_rtl" class="form-select">
                        <option value="1">{{ __('من اليمين إلى اليسار (RTL)') }}</option>
                        <option value="0">{{ __('من اليسار إلى اليمين (LTR)') }}</option>
                    </select>
                </div>
                <div class="col-6 col-md-3">
                    <button type="submit" class="btn btn-dark w-100" style="background: linear-gradient(135deg, #FFD700, #FFA500); border: none; color:#000; font-weight:700;">
                        {{ __('إضافة لغة') }}
                    </button>
                </div>
            </form>
            <hr>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>{{ __('الكود') }}</th>
                            <th>{{ __('الاسم') }}</th>
                            <th>{{ __('نشطة؟') }}</th>
                            <th>{{ __('إجراءات') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(($languages ?? collect()) as $lang)
                            <tr>
                                <td>{{ $lang->code }}</td>
                                <td>{{ $lang->name }}</td>
                                <td>
                                    <span class="badge {{ $lang->is_active ? 'bg-success' : 'bg-secondary' }}">{{ $lang->is_active ? __('مفعلة') : __('معطلة') }}</span>
                                </td>
                                <td>
                                    <form action="{{ route('admin.languages.toggle', $lang) }}" method="post" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-dark">
                                            {{ $lang->is_active ? __('تعطيل') : __('تفعيل') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf

        <div class="row g-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <strong>{{ __('عام') }}</strong>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-12 col-md-4">
                                <label class="form-label">{{ __('شعار الموقع') }}</label>
                                <div class="mb-2">
                                    @php
                                        $navLogo = \App\Support\Settings::imageUrl('site.logo', asset('images/white-5dmaty.svg'));
                                    @endphp
                                    <img src="{{ $navLogo }}" alt="Logo" class="img-fluid rounded border" style="max-height: 80px; background:#fff;">
                                </div>
                                <input type="file" name="site_logo" class="form-control" accept=".png,.jpg,.jpeg,.webp,.svg">
                                @error('site_logo')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label">{{ __('أيقونة التبويب (Favicon)') }}</label>
                                <div class="mb-2">
                                    @php
                                        $favicon = \App\Support\Settings::imageUrl('site.favicon');
                                    @endphp
                                    @if($favicon)
                                        <img src="{{ $favicon }}" alt="Favicon" class="img-fluid rounded border" style="max-height: 40px; background:#fff;">
                                    @endif
                                </div>
                                <input type="file" name="site_favicon" class="form-control" accept=".ico,.png,.svg">
                                @error('site_favicon')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label">{{ __('شعار الهيرو (الصفحة الرئيسية)') }}</label>
                                <div class="mb-2">
                                    @php
                                        $heroLogo = \App\Support\Settings::imageUrl('home.hero.logo', asset('images/white-5dmaty.svg'));
                                    @endphp
                                    <img src="{{ $heroLogo }}" alt="Hero Logo" class="img-fluid rounded border" style="max-height: 80px; background:#fff;">
                                </div>
                                <input type="file" name="home_hero_logo" class="form-control" accept=".png,.jpg,.jpeg,.webp,.svg">
                                @error('home_hero_logo')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white d-flex align-items-center justify-content-between">
                        <strong>{{ __('النصوص متعددة اللغات') }}</strong>
                        <small class="text-muted">{{ __('تظهر تبويبات حسب اللغات المفعلة') }}</small>
                    </div>
                    <div class="card-body">
                        @php
                            $langs = $languages ?? collect();
                            $activeCode = $langs->first()->code ?? app()->getLocale();
                            $map = $settings ?? [];
                        @endphp

                        <ul class="nav nav-tabs" role="tablist">
                            @foreach($langs as $i => $lang)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link @if(($lang->code ?? '') === $activeCode) active @endif" id="tab-{{ $lang->code }}"
                                            data-bs-toggle="tab" data-bs-target="#pane-{{ $lang->code }}" type="button" role="tab"
                                            aria-controls="pane-{{ $lang->code }}" aria-selected="{{ ($lang->code ?? '') === $activeCode ? 'true' : 'false' }}">
                                        {{ $lang->name }} ({{ $lang->code }})
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content border border-top-0 rounded-bottom p-3">
                            @foreach($langs as $i => $lang)
                                @php $code = $lang->code; @endphp
                                <div class="tab-pane fade @if($code === $activeCode) show active @endif" id="pane-{{ $code }}" role="tabpanel" aria-labelledby="tab-{{ $code }}">
                                    <div class="row g-3">
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">{{ __('SEO - العنوان') }}</label>
                                            <input type="text" class="form-control" name="seo[{{ $code }}][title]"
                                                   value="{{ \Illuminate\Support\Arr::get($map, $code.'.seo.home.title') ?? '' }}"
                                                   placeholder="{{ __('مثال: خدماتي - منصتك للخدمات') }}">
                                            @error("seo.$code.title")<div class="text-danger small">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">{{ __('SEO - الكلمات المفتاحية') }}</label>
                                            <input type="text" class="form-control" name="seo[{{ $code }}][keywords]"
                                                   value="{{ \Illuminate\Support\Arr::get($map, $code.'.seo.home.keywords') ?? '' }}"
                                                   placeholder="{{ __('خدمات, وظائف, عقارات') }}">
                                            @error("seo.$code.keywords")<div class="text-danger small">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">{{ __('SEO - الوصف') }}</label>
                                            <textarea class="form-control" rows="2" name="seo[{{ $code }}][description]" placeholder="{{ __('وصف موجز يظهر في محركات البحث') }}">{{ \Illuminate\Support\Arr::get($map, $code.'.seo.home.description') ?? '' }}</textarea>
                                            @error("seo.$code.description")<div class="text-danger small">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label class="form-label">{{ __('نص الهيرو - العنوان') }}</label>
                                            <input type="text" class="form-control" name="hero[{{ $code }}][title]"
                                                   value="{{ \Illuminate\Support\Arr::get($map, $code.'.home.hero.title') ?? '' }}"
                                                   placeholder="{{ __('خدماتي') }}">
                                            @error("hero.$code.title")<div class="text-danger small">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">{{ __('نص الهيرو - الوصف القصير') }}</label>
                                            <input type="text" class="form-control" name="hero[{{ $code }}][subtitle]"
                                                   value="{{ \Illuminate\Support\Arr::get($map, $code.'.home.hero.subtitle') ?? '' }}"
                                                   placeholder="{{ __('سطر تعريفي قصير عن المنصة') }}">
                                            @error("hero.$code.subtitle")<div class="text-danger small">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-3">
            <button type="submit" class="btn btn-primary px-4" style="background: linear-gradient(135deg, #FFD700, #FFA500); border: none; color: #000; font-weight: 700;">
                {{ __('حفظ الإعدادات') }}
            </button>
        </div>
    </form>
@endsection


