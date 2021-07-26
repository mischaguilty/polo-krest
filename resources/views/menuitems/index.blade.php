@section('title', __('Menuitems'))

<div class="container my-3">
    <h1>
        @yield('title')
    </h1>

    <div class="row justify-content-between">
        <div class="col-lg-4 mb-3">
            <x-bs::input icon="search" :placeholder="__('Search')" type="search" wire:model.debounce.500ms="search"/>
        </div>
        <div class="col-lg-auto d-flex gap-2 mb-3">
            <x-bs::button icon="plus" :title="__('Create')" wire:click="$emit('showModal', 'menuitems.save')"/>

            <x-bs::dropdown icon="sort" :label="__($sort)">
                @foreach($sorts as $sort)
                    <x-bs::dropdown-item :label="__($sort)" wire:click="$set('sort', '{{ $sort }}')"/>
                @endforeach
            </x-bs::dropdown>

            <x-bs::dropdown icon="filter" :label="__($filter)">
                @foreach($filters as $filter)
                    <x-bs::dropdown-item :label="__($filter)" wire:click="$set('filter', '{{ $filter }}')"/>
                @endforeach
            </x-bs::dropdown>
        </div>
    </div>

    <div class="list-group mb-3">
        @forelse($menuitems as $menuitem)
            <div class="list-group-item list-group-item-action d-inline-flex justify-content-start">
                <div class="d-inline-flex align-items-center flex-shrink-1 p-1">
                    <x-bs::button color="primary" class="shadow-none" wire:click="positionUp({{ $menuitem->id }})">
                        <x-bs::icon name="arrow-up" />
                    </x-bs::button>
                    <span class="text-primary mx-3 mt-auto mb-auto">{{ intval($menuitem->position) }}</span>
                    <x-bs::button color="primary" class="shadow-none" wire:click="positionDown({{ $menuitem->id }})">
                        <x-bs::icon name="arrow-down" />
                    </x-bs::button>
                </div>
                <div class="align-items-center flex-fill p-1 d-inline-flex justify-content-between">
                    <div class="mb-3 mb-lg-0">
                        <x-bs::link :label="$menuitem->name"
                            wire:click.prevent="$emit('showModal', 'menuitems.read', {{ $menuitem->id }})"/>

                        <p class="small text-muted mb-0">@displayDate($menuitem->created_at)</p>
                    </div>
                    <div class="d-flex gap-2">
                        <x-bs::button icon="eye" :title="__('Read')" color="outline-primary" size="sm"
                            wire:click="$emit('showModal', 'menuitems.read', {{ $menuitem->id }})"/>

                        <x-bs::button icon="pencil-alt" :title="__('Update')" color="outline-primary" size="sm"
                            wire:click="$emit('showModal', 'menuitems.save', {{ $menuitem->id }})"/>

                        <x-bs::button icon="trash-alt" :title="__('Delete')" color="outline-primary" size="sm"
                            wire:click="delete({{ $menuitem->id }})" confirm/>
                    </div>
                </div>
            </div>
        @empty
            <div class="list-group-item">
                {{ __('No results to display.') }}
            </div>
        @endforelse
    </div>

    <x-bs::pagination :links="$menuitems"/>
</div>
