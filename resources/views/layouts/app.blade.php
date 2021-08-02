<!doctype html>
<html lang="{{ app()->getLocale() }}" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@hasSection('title') @yield('title') | @endif {{ $company->name }}</title>

    <livewire:styles />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @if($logo = $company->getFirstMedia('logo'))
        <link rel="icon" href="{{ $logo->getFullUrl() }}">
        <link rel="apple-touch-icon" href="{{ $logo->getFullUrl() }}">
    @else
        <link rel="icon" href="{{ mix('images/icon-fav.png') }}">
        <link rel="apple-touch-icon" href="{{ mix('images/icon-touch.png') }}">
    @endif
    <link rel="manifest" href="{{ mix('json/manifest.json') }}">
    @stack('styles')
</head>
<body class="d-flex flex-column h-100">
    <livewire:layouts.nav/>
    <main class="flex-shrink-0">
        {{ $slot }}
    </main>

    <livewire:layouts.footer/>

    <livewire:loader/>
    <livewire:modals/>
    <livewire:toasts/>
    <livewire:scripts/>
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        window.addEventListener('logo:updated', function (e) {
            window.location = '{{ url()->current() }}';
        });
    </script>
    @stack('scripts')
</body>
</html>
