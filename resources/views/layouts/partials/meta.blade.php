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
@hasSection('base')
    <base href="@yield('base')">
@else
    <base href="{{ url('/') }}">
@endif
@hasSection('canonical')
    <link rel="canonical" href="@yield('canonical')">
@else
    <link rel="canonical" href="{{ url()->current() }}">
@endif
@hasSection('alternate_language')
    <link rel="alternate" href="@yield('alternate_language')" hreflang="x-default">
@else
    <link rel="alternate" href="{{ url()->current() }}" hreflang="x-default">
@endif
@hasSection('alternate_screen')
    <link rel="alternate" media="only screen and (max-width: 640px)" href="@yield('alternate_screen')">
@else
    <link rel="alternate" media="only screen and (max-width: 640px)" href="{{ url()->current() }}">
@endif
@hasSection('schema')
    @include('livewire.schema-org')
@endif
@hasSection('description')
    <meta name="description" content="@yield('description')">
@endif
@hasSection('og_locale')
    <meta property="og:locale" content="@yield('og_locale')">
@else
    <meta property="og:locale" content="{{ app()->getLocale() }}">
@endif
@hasSection('og_title')
    <meta property="og:title" content="@yield('og_title')">
@endif
@hasSection('og_description')
    <meta property="og:description" content="@yield('og_description')">
@endif

<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="website">
@isset($company)
<meta property="og:site_name" content="{{ $company->name }}">
@endisset
<meta name="twitter:card" content="summary_large_image">
@hasSection('og_description')
    <meta name="twitter:description" content="@yield('og_description')">
@endif
@hasSection('og_title')
    <meta name="twitter:title" content="@yield('og_title')">
@endif
{{--@forelse($company->pictures as $logo)--}}
{{--    <meta name="twitter:image" content="{{ $logo->img_src }}">--}}
{{--    <meta property="og:image" content="{{ $logo->img_src }}">--}}
{{--    @include('icons')--}}
{{--@break--}}
{{--@empty--}}
{{--@endforelse--}}

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
