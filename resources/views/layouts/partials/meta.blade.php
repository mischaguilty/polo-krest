@hasSection('robots')
    <meta name="robots" content="@yield('robots')">
@else
    <meta name="robots" content="no,all">
@endif
@hasSection('googlebot')
    <meta name="googlebot" content="@yield('googlebot')">
@else
    <meta name="googlebot" content="no,all">
@endif

<base href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getNonLocalizedURL('/') }}">
<link rel="canonical" href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getNonLocalizedURL() }}">
@forelse(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLanguagesKeys() as $localeKey)
    <link rel="alternate" hreflang="{{ $localeKey }}" href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($localeKey) }}">
@empty
@endforelse
<link rel="alternate" media="only screen and (max-width: 640px)" href="{{ url()->current() }}">

@hasSection('schema')
    @include('livewire.schema-org')
@endif
@hasSection('description')
    <meta name="description" content="@yield('description')">
    <meta property="og:description" content="@yield('description')">
    <meta name="twitter:description" content="@yield('description')">
@endif

<meta property="og:locale" content="{{ app()->getLocale() }}">
<meta property="og:title" content="@yield('title')">
<meta name="twitter:title" content="@yield('title')">

<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ $company->name }}">
<meta name="twitter:card" content="summary_large_image">

@if($logo = $company->getFirstMedia('logo'))
    <meta name="twitter:image" content="{{ $logo->getFullUrl() }}">
    <meta property="og:image" content="{{ $logo->getFullUrl() }}">
@endif

{{--@forelse($company->offices as $office)--}}
{{--    @if($address = $office->address)--}}
{{--    @isset($address->geo_region)--}}
{{--        <meta name="geo.region" content="{{ $address->geo_region }}">--}}
{{--    @endisset--}}
{{--    <meta name="geo.placename" content="{{ $address->geo_placename }}">--}}
{{--    <meta name="geo.position" content="{{ $address->geo_position }}">--}}
{{--    <meta name="ICBM" content="{{ $address->icmb_content }}">--}}
{{--    <meta name="DC.title" content="{{ $company->dc_title }}">--}}
{{--    @endif--}}
{{--    @break--}}
{{--    @empty--}}
{{--@endforelse--}}
