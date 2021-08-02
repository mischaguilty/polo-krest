@section('title', $company->name.' '.__('Dashboard'))
<div class="container my-3">
    <h1>
        @yield('title')
    </h1>
    <form wire:submit.prevent="save">
        <label class="d-block">{{ __('Logo') }}</label>
        @if($logo && method_exists($logo, 'temporaryUrl'))
            <x-bs::image :asset="$logo->temporaryUrl()" height="50" width="auto" wire:click="resetLogo"/>
        @elseif($logo && method_exists($logo, 'getFullUrl'))
            <x-bs::image :asset="$logo->getFullUrl()" height="50" width="auto" wire:click="resetLogo"/>
        @else
            <x-bs::input type="file" class="shadow-none" wire:model="logo" />
        @endif
        <livewire:loader wire:target="logo" />

        <nav class="my-3">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                @forelse(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLanguagesKeys() as $locale)
                    <button class="nav-link {{ $locale === $currentLocale ? 'active' : '' }}"
                            id="nav-{{ $locale }}-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#nav-{{ $locale }}"
                            type="button"
                            role="tab"
                            aria-controls="nav-{{ $locale }}"
                            aria-selected="{{ $currentLocale === $locale ? 'true' : 'false' }}"
                            wire:click="$set('currentLocale', '{{ $locale }}')">
                        {{ \Illuminate\Support\Str::upper($locale) }}
                    </button>
                @empty
                @endforelse
            </div>
        </nav>
        <div class="tab-content mt-3" id="nav-tabContent">
            @forelse(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLanguagesKeys() as $locale)
                <div class="tab-pane fade {{ $currentLocale === $locale ? 'show active' : '' }}"
                     id="nav-{{ $locale }}"
                     role="tabpanel"
                     aria-labelledby="nav-{{ $locale }}-tab">
                    <div class="my-3">
                        <x-bs::input :label="__('Name').' '.strtoupper($locale)" wire:model.defer="name.{{ $locale }}" class="shadow-none"/>
                        <x-bs::help label="{{ __('Назва компанії. Також додається до тексту тега title для унікалізації') }}"/>
                    </div>
                    <div class="my-3">
                        <x-bs::textarea label="{{ __('Description').' '.strtoupper($locale) }}" class="shadow-none" wire:model.defer="description.{{$locale}}"/>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
        <div class="d-inline-flex justify-content-between mt-5 w-100">
            <x-bs::button :label="__('Cancel')" color="light"/>
            <x-bs::button :label="__('Save')" type="submit"/>
        </div>
    </form>
</div>
