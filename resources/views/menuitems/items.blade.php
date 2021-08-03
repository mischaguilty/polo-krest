<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                {{ $menuitem->name.' '.__('Items') }}
            </h5>
            <x-bs::close dismiss="modal"/>
        </div>
        <div class="modal-body">
            @forelse($items as $item)
                <div class="list-group-item list-group-item-action d-inline-flex justify-content-start">
                    <div class="d-inline-flex align-items-center flex-shrink-1 p-1">
                        <x-bs::button color="primary" class="shadow-none" wire:click="positionUp({{ $item->id }})">
                            <x-bs::icon name="arrow-up" />
                        </x-bs::button>
                        <span class="text-primary mx-3 mt-auto mb-auto">{{ intval($item->position) }}</span>
                        <x-bs::button color="primary" class="shadow-none" wire:click="positionDown({{ $item->id }})">
                            <x-bs::icon name="arrow-down" />
                        </x-bs::button>
                    </div>
                    <div class="align-items-center flex-fill p-1 d-inline-flex justify-content-between">
                        <div class="mb-3 mb-lg-0">
                            <x-bs::link :label="$item->name" wire:click.prevent="$emit('showModal', 'menuitems.read', {{ $item->id }})"/>
                            <p class="small text-muted mb-0">@displayDate($item->created_at)</p>
                        </div>
                        <div class="d-flex gap-2">
                            <x-bs::button icon="eye" :title="__('Read')" color="outline-primary" size="sm"
                                          wire:click="$emit('showModal', 'menuitems.read', {{ $item->id }})"/>

                            <x-bs::button icon="pencil-alt" :title="__('Update')" color="outline-primary" size="sm"
                                          wire:click="$emit('showModal', 'menuitems.save', {{ $item->id }})"/>

                            <x-bs::button icon="trash-alt" :title="__('Delete')" color="outline-primary" size="sm"
                                          wire:click="delete({{ $item->id }})" confirm/>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
        <div class="modal-footer">
            <x-bs::button :label="__('Close')" color="light" dismiss="modal"/>
        </div>
    </div>
</div>
