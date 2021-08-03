<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('layouts.partials.head', ['seo' => $seo])

<body>
<!-- Body Inner -->
<div class="body-inner">
@include('layouts.partials.topbar')
<!-- Header -->
    <header id="header" @hasSection('slider') data-transparent="true" @endif class="dark">
        <div class="header-inner">
            <div class="container">
                <!--Logo-->
                <div id="logo">
                    <a href="{{ route('welcome') }}">
                        @if($logo = $company->getFirstMedia('logo'))
                            <img src="{{ $logo->getFullUrl() }}" alt="{{ $logo->name }}">
                        @endif
                        <span class="logo-default font-weight-400">
                            {{ $company->name }}
                        </span>
                        <span class="logo-dark font-weight-400">
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
                                            <a href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($localeKey) }}">
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
                                            <ul class="dropdown-menu text-light">
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
