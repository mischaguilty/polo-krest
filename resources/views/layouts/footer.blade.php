<footer class="small text-muted py-3 mt-auto">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-auto">
                &copy; {{ now()->format('Y') }}
                <x-bs::link :label="$company->name" url="{{ route('home') }}"/>
            </div>
        </div>
    </div>
</footer>
