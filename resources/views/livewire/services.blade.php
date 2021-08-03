<div>
    @forelse($seo as $key => $value)
        @php
            if ($key === 'PageTitle') {
                $key = 'title';
            } else if ($key === 'PageDescription') {
                $key = 'description';
            } else if ($key === 'PageH1') {
                $key = null;
            }
        @endphp
        @isset($key)
            @section($key, $value)
    @endisset
    @continue
    @empty
        @section('title', Route::currentRouteName())
    @endforelse
        <header class="dark mb-5">
            <div class="breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{ route('welcome') }}">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        @forelse(request()->segments() as $segment)
                            @if($loop->first)
                                @continue
                            @endif
                            @if($loop->last)
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ $segment }}
                                </li>
                            @endif
                        @empty
                        @endforelse
                    </ol>
                </nav>
            </div>
            <h1 class="my-0">{!! $seo->get('PageH1') !!}</h1>
        </header>
        <div id="blog" class="grid-layout post-3-columns m-b-30" data-item="post-item">
        @forelse($serviceGroups as $serviceGroup)
            <div class="post-item border">
                <div class="post-item-wrap">
                    @forelse($serviceGroup->getMedia('images') as $media)
                        @if($loop->first)
                            <div class="post-slider">
                                <div class="carousel dots-inside arrows-visible arrows-only" data-items="{{ $loop->count }}" data-loop="true" data-autoplay="true" data-lightbox="gallery">
                                    @endif
                                    <a href="{{ $media->getFullUrl() }}" data-lightbox="gallery-image">
                                        <img src="{{ $media->getFullUrl() }}" alt="{{ $media->name }}">
                                    </a>
                                    @if($loop->last)
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="post-image">
                            <a href="{{ route('services.show', [slug($serviceGroup->name)]) }}">
                                <img src="http://placehold.it/500x300.jpg" alt="{{ __('Product\'s image placeholder') }}" />
                            </a>
                        </div>
                    @endforelse
                    <div class="post-item-description">
                        <span class="post-meta-date">
                            <i class="fa fa-calendar-o"></i>
                            {{ $serviceGroup->updated_at }}
                        </span>
                        {{--                        <span class="post-meta-comments"><a href=""><i class="fa fa-comments-o"></i>33 Comments</a></span>--}}
                        <h2>
                            <a href="{{ route('services.show', [slug($serviceGroup->name, app()->getLocale())]) }}">
                                {{ $serviceGroup->name }}
                            </a>
                        </h2>
                        <p class="text-secondary">
                            {{ $serviceGroup->description }}
                        </p>
                        <a href="{{ route('services.show', [slug($serviceGroup->name)]) }}" class="item-link">
                            {{ __('Докладніше') }}
                            <i class="icon-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
        @endforelse</div>
</div>
