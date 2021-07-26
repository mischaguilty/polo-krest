<div>
    <div id="mainMenu">
        <div class="container">
            <nav>
                <ul>
                    @forelse($items as $item)
                        <li class="{{ $item->children_count ? 'dropdown' : '' }}">
                            <a href="{{ url($item->slug->name) }}">
                                {{ $item->name }}
                            </a>
                        </li>
                    @empty
                    @endforelse
                </ul>
            </nav>
        </div>
    </div>
</div>
