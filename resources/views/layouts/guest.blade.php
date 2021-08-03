<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('layouts.partials.head')

<body>
<!-- Body Inner -->
<div class="body-inner">
@include('layouts.partials.topbar')
<!-- Header -->
    <header id="header" data-transparent="true" class="dark">
        <div class="header-inner">
            <div class="container">
                <!--Logo-->
                <div id="logo">
                    <a href="{{ route('welcome') }}">
                        <span class="logo-default">
                            {{ $company->name }}
                        </span>
                        <span class="logo-dark">
                            {{ $company->name }}
                        </span>
                    </a>
                </div>
                <!--End: Logo-->
                <!--Header Extras-->
                <div class="header-extras">
                    <ul>
                        <li>
                            <div class="p-dropdown">
                                <a href="#">
                                    <i class="icon-globe"></i>
                                    <span>{{ app()->getLocale() }}</span>
                                </a>
                                <ul class="p-dropdown-content">
                                    @forelse(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $localeKey => $locale)
                                        <li>
                                            <a href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($localeKey) }}" class="{{ app()->getLocale() === $localeKey ? 'text-muted' : '' }}">
                                                {{ strtoupper($localeKey) }}
                                            </a>
                                        </li>
                                    @empty
                                    @endforelse
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <!--end: Header Extras-->
                <!--Navigation Resposnive Trigger-->
                <div id="mainMenu-trigger">
                    <a class="lines-button x"><span class="lines"></span></a>
                </div>
                <!--end: Navigation Resposnive Trigger-->
                <!--Navigation-->
                <div id="mainMenu">
                    <div class="container">
                        <nav>
                            <ul>
                                @forelse(\App\Models\Menuitem::topmenu()->get() as $item)
                                    <li class="{{ $item->children_count ? 'dropdown' : '' }}">
                                        <a href="{{ $item->children_count ? url('#') : route($item->route_name) }}">
                                            {{ $item->name }}
                                        </a>
                                        @if($item->children_count !== 0)
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="{{ route($item->route_name) }}">
                                                        {{ $item->name }}
                                                    </a>
                                                </li>
                                                @forelse($item->children() as $subItem)
                                                    <li>
                                                        <a href="{{ route($subItem->route_name, [slug($subItem->name)]) }}">
                                                            {{ $subItem->name }}
                                                        </a>
                                                    </li>
                                                @empty
                                            @endforelse
                                            </ul>
                                        @endif
                                    </li>
                                @empty
                                @endforelse
                            </ul>
                        </nav>
                    </div>
                </div>
                <!--end: Navigation-->
            </div>
        </div>
    </header>
<!-- end: Header -->
@hasSection('slider')
    @yield('slider')
@endif
<!-- Content -->
    <section id="page-content">
        <div class="container">
{{--            <div class="grid-system-demo-live">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-12 p-t-80 p-b-20">--}}
{{--                        <div class="heading-text heading-section">--}}
{{--                            <h2>Set your goals high, and don't stop till you get there.</h2>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-12">--}}
{{--                        Vitae adipiscing turpis. Aenean ligula nibh, molestie id viverra a, dapibus at dolor. In--}}
{{--                        iaculis viverra neque, ac ele molestie id viverra aifend ante lobortis id. In viverra ipsum--}}
{{--                        stie. Aenean ligula nibh, molestie id viverra a, dapibus at dolor. In iaculis viverra neque,--}}
{{--                        ac ele molestie id viverra aifend ante lobortis id. In viverra ipsum.--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-6">--}}
{{--                        <h5>1/2 Width (col-lg-6)</h5>Vitae adipiscing turpis. Aenean ligula nibh, molestie id--}}
{{--                        viverra a, dapibus at dolor. In iaculis viverra neque, ac ele molestie id viverra aifend--}}
{{--                        ante lobortis id. In viverra ipsum stie.--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6">--}}
{{--                        <h5>1/2 Width (col-lg-6)</h5>Vitae adipiscing turpis. Aenean ligula nibh, molestie id--}}
{{--                        viverra a, dapibus at dolor. In iaculis viverra neque, ac ele molestie id viverra aifend--}}
{{--                        ante lobortis id. In viverra ipsum stie.--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-4">--}}
{{--                        <h5>1/3 Width (col-lg-4)</h5>Vitae adipiscing turpis. Aenean ligula nibh, molestie id--}}
{{--                        viverra a, dapibus at dolor. In iaculis viverra neque, ac ele molestie id viverra aifend--}}
{{--                        ante lobortis id. In viverra ipsum stie.--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-4">--}}
{{--                        <h5>1/3 Width (col-lg-4)</h5>Vitae adipiscing turpis. Aenean ligula nibh, molestie id--}}
{{--                        viverra a, dapibus at dolor. In iaculis viverra neque, ac ele molestie id viverra aifend--}}
{{--                        ante lobortis id. In viverra ipsum stie.--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-4">--}}
{{--                        <h5>1/3 Width (col-lg-4)</h5>Vitae adipiscing turpis. Aenean ligula nibh, molestie id--}}
{{--                        viverra a, dapibus at dolor. In iaculis viverra neque, ac ele molestie id viverra aifend--}}
{{--                        ante lobortis id. In viverra ipsum stie.--}}
{{--                    </div>--}}
{{--                    r--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-lg-3">--}}
{{--                            <h5>1/4 Width (col-lg-3)</h5>Vitae adipiscing turpis. Aenean ligula nibh, molestie id--}}
{{--                            viverra a, dapibus at dolor. In iaculis viverra neque, ac ele molestie id viverra aifend--}}
{{--                            ante lobortis id. In viverra ipsum stie.--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-3">--}}
{{--                            <h5>1/4 Width (col-lg-3)</h5>Vitae adipiscing turpis. Aenean ligula nibh, molestie id--}}
{{--                            viverra a, dapibus at dolor. In iaculis viverra neque, ac ele molestie id viverra aifend--}}
{{--                            ante lobortis id. In viverra ipsum stie.--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-3">--}}
{{--                            <h5>1/4 Width (col-lg-3)</h5>Vitae adipiscing turpis. Aenean ligula nibh, molestie id--}}
{{--                            viverra a, dapibus at dolor. In iaculis viverra neque, ac ele molestie id viverra aifend--}}
{{--                            ante lobortis id. In viverra ipsum stie.--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-3">--}}
{{--                            <h5>1/4 Width (col-lg-3)</h5>Vitae adipiscing turpis. Aenean ligula nibh, molestie id--}}
{{--                            viverra a, dapibus at dolor. In iaculis viverra neque, ac ele molestie id viverra aifend--}}
{{--                            ante lobortis id. In viverra ipsum stie.--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-lg-4">--}}
{{--                            <h5>1/3 Width (col-lg-4)</h5>Vitae adipiscing turpis. Aenean ligula nibh, molestie id--}}
{{--                            viverra a, dapibus at dolor. In iaculis viverra neque, ac ele molestie id viverra aifend--}}
{{--                            ante lobortis id. In viverra ipsum stie.--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-8">--}}
{{--                            <h5>2/3 Width (col-lg-8)</h5>Vitae adipiscing turpis. Aenean ligula nibh, molestie id--}}
{{--                            viverra a, dapibus at dolor. In iaculis viverra neque, ac ele molestie id viverra aifend--}}
{{--                            ante lobortis id. In viverra ipsum stie.--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            {{ $slot }}
        </div>
    </section>
<!-- end: Content -->

<!-- Footer -->
@include('layouts.partials.footer')
<!-- end: Footer -->
</div>
<!-- end: Body Inner -->
<!-- Scroll top -->
<a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>
<!--Plugins-->
<script src="{{ url('js/jquery.js') }}"></script>
<script src="{{ url('js/plugins.js') }}"></script>
<!--Template functions-->
<script src="{{ url('js/functions.js') }}"></script>
</body>
</html>
