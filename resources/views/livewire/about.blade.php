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

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="heading-text heading-section">
                        <h2>{{ $company->name }}</h2>
                    </div>
                </div>
                <div class="col-lg-9">
                    {{ $company->description }}
                </div>
            </div>
        </div>
    </section>
</div>
