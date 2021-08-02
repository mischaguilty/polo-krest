<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                {{ __('Page') }}
            </h5>
            <x-bs::close dismiss="modal"/>
        </div>
        <div class="modal-body">
            <dl class="mb-n3">
                <dt>{{ __('ID') }}</dt>
                <dd>{{ $page->id }}</dd>

                <dt>{{ __('Name') }}</dt>
                <dd>{{ $page->name }}</dd>

                <dt>{{ __('Created At') }}</dt>
                <dd>@displayDate($page->created_at)</dd>

                <dt>{{ __('Updated At') }}</dt>
                <dd>@displayDate($page->updated_at)</dd>
            </dl>
        </div>
        <div class="modal-footer">
            <x-bs::button :label="__('Close')" color="light" dismiss="modal"/>
        </div>
    </div>
</div>
