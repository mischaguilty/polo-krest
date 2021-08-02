<div class="modal-dialog">
    <form class="modal-content" wire:submit.prevent="save">
        <div class="modal-header">
            <h5 class="modal-title">
                {{ !$productGroup->exists ? __('Create Product Group') : __('Update Product Group') }}
            </h5>
            <x-bs::close dismiss="modal"/>
        </div>
        <div class="modal-body d-grid gap-3">
            <x-bs::input :label="__('Name')" wire:model.defer="name"/>
        </div>
        <div class="modal-footer">
            <x-bs::button :label="__('Cancel')" color="light" dismiss="modal"/>
            <x-bs::button :label="__('Save Product Group')" type="submit"/>
        </div>
    </form>
</div>
