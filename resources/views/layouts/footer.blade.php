<footer class="small text-muted py-3 mt-auto">
    <div class="container">
        <div class="row justify-content-center">
            {{--<div class="row justify-content-between">--}}
            <div class="col-auto">
                &copy; {{ now()->format('Y') }}
                <x-bs::link :label="$company->name" url="{{ route('home') }}"/>
            </div>
            {{--<div class="col-auto d-flex gap-3">--}}
            {{--    <x-bs::link :label="__('Contact')" href="#"/>--}}
            {{--    <x-bs::link :label="__('Terms')" href="#"/>--}}
            {{--    <x-bs::link :label="__('Privacy')" href="#"/>--}}
            {{--</div>--}}
        </div>
    </div>
</footer>
