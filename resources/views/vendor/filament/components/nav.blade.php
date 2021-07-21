<nav aria-label="primary" {{ $attributes }}>
    <ol>
        @forelse($items as $item)
            <li>
                <x-filament::nav-link
                    :active-rule="$item->activeRule"
                    :icon="$item->icon"
                    :label="$item->label"
                    :url="$item->url"
                />
            </li>
        @empty

        @endforelse
    </ol>
</nav>
