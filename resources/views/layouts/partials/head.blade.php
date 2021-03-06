<head>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <title>@yield('title')</title>
    <link rel="dns-prefetch" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="https://fonts.googleapis.com" crossorigin>
    @stack('prefetch')

    @include('layouts.partials.meta', ['seo' => $seo])

    <link rel="preload" as="style" href="{{ url('css/plugins.css') }}"/>
    <link rel="preload" as="style" href="{{ url('css/style.css') }} "/>
    @stack('preloads')

    <link href="{{ url('css/plugins.css') }}" rel="stylesheet">
    <link href="{{ url('css/style.css') }}" rel="stylesheet">
    @stack('styles')
    @if($logo = $company->getFirstMedia('logo'))
    <link rel="icon" type="image/png" href="{{ $logo->getFullUrl() }}">
    @endif
</head>
