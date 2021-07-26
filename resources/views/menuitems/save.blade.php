<div class="modal-dialog">
    <form class="modal-content" wire:submit.prevent="save">
        <div class="modal-header">
            <h5 class="modal-title">
                {{ !$menuitem->exists ? __('Create Menuitem') : __('Update Menuitem') }} - {{ strtoupper($currentLocale) }}
            </h5>
            <x-bs::close dismiss="modal"/>
        </div>
        <div class="modal-body d-grid gap-3">
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
                        <x-bs::input :label="__('Name').' '.strtoupper($locale)" wire:model.defer="name.{{ $locale }}" class="shadow-none"/>
                        <x-bs::help :label="__('Slug').' '.$slug[$locale]" />
                    </div>
                @empty
                @endforelse
            </div>
            <x-bs::input :label="__('Position')" wire:model.defer="position" type="number" min="0" max="100"/>
        </div>
        <div class="modal-footer">
            <x-bs::button :label="__('Cancel')" color="light" dismiss="modal"/>
            <x-bs::button :label="__('Save')" type="submit"/>
        </div>
    </form>
</div>
