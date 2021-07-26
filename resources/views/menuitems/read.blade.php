<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                {{ __('Menuitem') }}
            </h5>
            <x-bs::close dismiss="modal"/>
        </div>
        <div class="modal-body">
            <nav>
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
            <div class="tab-content" id="nav-tabContent">
                @forelse(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLanguagesKeys() as $locale)
                    <div class="tab-pane fade {{ $currentLocale === $locale ? 'show active' : '' }}"
                         id="nav-{{ $locale }}"
                         role="tabpanel"
                         aria-labelledby="nav-{{ $locale }}-tab">
                        <dl class="my-3">
                            <dt>{{ __('Name') }}</dt>
                            <dd>{{ $menuitem->name }}</dd>
                            @isset($menuitem->slug)
                                <dt>{{ __('Slug') }}</dt>
                                <dd>{{ $menuitem->slug->name }}</dd>
                            @endisset
                        </dl>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
        <div class="modal-footer">
            <x-bs::button :label="__('Close')" color="light" dismiss="modal"/>
        </div>
    </div>
</div>
