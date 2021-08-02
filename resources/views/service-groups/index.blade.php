@section('title', __('Service Groups'))

<div class="container my-3">
    <h1>
        @yield('title')
    </h1>

    <div class="row justify-content-between">
        <div class="col-lg-4 mb-3">
            <x-bs::input icon="search" :placeholder="__('Search')" type="search" wire:model.debounce.500ms="search"/>
        </div>
        <div class="col-lg-auto d-flex gap-2 mb-3">
            <x-bs::button icon="plus" :title="__('Create')" wire:click="$emit('showModal', 'service-groups.save')"/>

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
        @forelse($serviceGroups as $serviceGroup)
            <div class="list-group-item list-group-item-action">
                <div class="row align-items-center">
                    <div class="col-lg mb-3 mb-lg-0">
                        <x-bs::link :label="$serviceGroup->name"
                            wire:click.prevent="$emit('showModal', 'service-groups.read', {{ $serviceGroup->id }})"/>

                        <p class="small text-muted mb-0">@displayDate($serviceGroup->created_at)</p>
                    </div>
                    <div class="col-lg-auto d-flex gap-2">
                        <x-bs::button icon="eye" :title="__('Read')" color="outline-primary" size="sm"
                            wire:click="$emit('showModal', 'service-groups.read', {{ $serviceGroup->id }})"/>

                        <x-bs::button icon="pencil-alt" :title="__('Update')" color="outline-primary" size="sm"
                            wire:click="$emit('showModal', 'service-groups.save', {{ $serviceGroup->id }})"/>

                        <x-bs::button icon="trash-alt" :title="__('Delete')" color="outline-primary" size="sm"
                            wire:click="delete({{ $serviceGroup->id }})" confirm/>
                    </div>
                </div>
            </div>
        @empty
            <div class="list-group-item">
                {{ __('No results to display.') }}
            </div>
        @endforelse
    </div>

    <x-bs::pagination :links="$serviceGroups"/>
</div>
