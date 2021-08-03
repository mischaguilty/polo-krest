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

    <div class="content">
        @forelse(\App\Models\Cemetery::whereHas('address')->orderBy('position')->get() as $cemetery)
            <div class="d-block mb-5 w-100">
                <div class="d-inline-flex flex-wrap flex-md-nowrap flex-lg-nowrap w-100">
                    <div class="flex-grow-1 col-md-8 d-none pr-0 pr-md-3 pr-lg-3 pr-xl-3 pb-5 d-md-block d-lg-block">
                    @if($cemetery->address->latitude && $cemetery->address->longitude)
                        <!-- Embedded Google Map -->
                            <iframe style="width: 100%; height: 400px; border: 0;" class="shadow-sm" src="{{ $cemetery->address->google_maps }}" loading="lazy"></iframe>
                        @endif
                    </div>
                    <div class="flex-grow-1 flex-wrap-md">
                        <h2 class="text-primary">{{ $cemetery->name }}</h2>
                        <div class="justify-content-start d-inline-flex w-100 mb-2 align-items-center">
                            <div class="px-0 w-auto">
                                <i class="fa fa-2x fa-map-marker-alt text-primary pt-1"></i>
                            </div>
                            <div class="col">
                                <p class="font-weight-normal lead text-dark mb-0">
                                    {{ $cemetery->address->city_street_building }}
                                </p>
                            </div>
                        </div>
                        @if(!empty($cemetery->description))
                            <div class="justify-content-start d-inline-flex w-100">
                                <div class="px-0 w-auto">
                                    <i class="fa fa-2x fa-info-circle text-primary pt-1"></i>
                                </div>
                                <div class="col">
                                    <p class="font-weight-normal lead text-dark mb-0">
                                        {{ $cemetery->description }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div wire:loading="{{ __('Спробуйте пізніше') }}"></div>
        @endforelse
    </div>
</div>
