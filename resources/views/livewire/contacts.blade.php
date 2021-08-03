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
        @forelse($company->offices as $office)
            <div class="d-block mb-5 w-100">
                <div class="d-inline-flex flex-wrap flex-md-nowrap flex-lg-nowrap w-100">
                    <div class="flex-grow-1 col-md-8 d-none pr-0 pr-md-3 pr-lg-3 pr-xl-3 pb-5 d-md-block d-lg-block">
                        <!-- Embedded Google Map -->
                        <iframe style="width: 100%; height: 400px; border: 0;" class="shadow-sm"
                                src="{{ $office->address->google_maps }}">
                        </iframe>
                    </div>
                    <div class="flex-grow-1 flex-wrap-md">
                        @if($office->address)
                            <div class="justify-content-start d-inline-flex w-100">
                                <div class="px-0 w-auto">
                                    <i class="fa fa-2x fa-map-marker-alt text-primary pt-1"></i>
                                </div>
                                <div class="col">
                                    <p class="font-weight-normal h5 text-dark">
                                        {{ $office->address->city_street_building }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        @if($office->phones->count())
                            <div class="justify-content-start d-inline-flex w-100 mb-3">
                                <div class="px-0 w-auto">
                                    <i class="fa fa-2x fa-phone text-primary pt-1"></i>
                                </div>
                                <div class="col">
                                    @foreach($office->phones as $phone)
                                        <a href="{{ 'tel://'.$phone->phone }}"
                                           class="text-decoration-none font-weight-normal text-dark"
                                           style="font-size: 1.4rem" data-toggle="tooltip"
                                           title="{{ __('Зателефонувати') }}">
                                            {{ $phone->spaced_phone }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if($office->working_days->count())
                            <div class="justify-content-start d-inline-flex w-100 mb-3">
                                <div class="px-0 w-auto">
                                    <i class="fa fa-2x fa-clock text-primary pt-1"></i>
                                </div>
                                <div class="col h-100">
                                    <div class="d-block mb-5">
                                        @foreach($office->working_days as $index => $wDay)
                                            <div class="d-block">
                                                <div class="d-inline-flex flex-nowrap justify-content-between w-100">
                                                    <p class="h5 pr-2 {{ $loop->index === today()->weekday() ? 'text-primary' : 'font-weight-normal' }}">
                                                        {{ $wd[$wDay->weekday] ?? array_values($wd)[$index] }}:
                                                    </p>
                                                    <p class="font-weight-normal h5 text-nowrap d-flex justify-content-between {{ $loop->index === today()->weekday() ? 'text-primary' : 'text-dark' }}">
                                                        @forelse($wDay->workings as $working)
                                                            {{ $working->time_range->start()->format() }} - {{ $working->time_range->end()->format() }}
                                                        @empty
                                                            {{ __('Вихідний') }}
                                                        @endforelse
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="px-0 align-self-end">
                                        <button class="rounded-0 shadow-sm btn btn-primary mt-auto w-100"
                                                onclick="callMeHandler(event)">
                                            {{ __('Замовити дзвінок') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            {{ __('Щось пішло не так') }}
        @endforelse
        </div>
</div>
