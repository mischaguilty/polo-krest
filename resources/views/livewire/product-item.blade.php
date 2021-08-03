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
            @if($key === 'title')
    @section('title'){{$seo->get('PageTitle')}}@endsection
    @endif
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
                        @if(!$loop->last)
                            <li class="breadcrumb-item">
                                <a href="{{ url((app()->getLocale()).'/'.$segment) }}">
                                    {{ $segment }}
                                </a>
                            </li>
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
        <h1>{!! $seo->get('PageH1') !!}</h1>
    </header>
    <div class="row">
        <!-- Content-->
        <div class="content">
            <div class="product">
                <div class="row m-b-40">
                    <div class="col-lg-5">
                        <div class="product-image">
                            <!-- Carousel slider -->
                            <div class="carousel dots-inside dots-dark arrows-visible" data-items="1" data-loop="true"
                                 data-autoplay="true" data-animate-in="fadeIn" data-animate-out="fadeOut"
                                 data-autoplay="2500" data-lightbox="gallery">
                                @forelse($productGroup->getMedia('images') as $media)
                                    <a href="{{ $media->getFullUrl() }}" data-lightbox="image"
                                       title="{{ $productGroup->name }}">
                                        <img alt="{{ $media->name }}" src="{{ $media->getFullUrl() }}">
                                    </a>
                                @empty
                                    <a href="http://placehold.it/700x500.jpg" data-lightbox="image"
                                       title="{{ $productGroup->name }}">
                                        <img alt="{{ __('Image placeholder') }}" src="http://placehold.it/700x500.jpg"/>
                                    </a>
                                @endforelse
                            </div>
                            <!-- Carousel slider -->
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="product-description">
                            <div class="product-title">
                                <h3>
                                    <a href="{{ route('products.show', [slug($productGroup->name)]) }}">{{ $productGroup->name }}</a>
                                </h3>
                            </div>
                            <div class="seperator m-b-10"></div>
                            <p>
                                {{ $productGroup->description }}
                            </p>
                            <div class="seperator m-t-20 m-b-10"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget-shop">
                <div class="d-inline-flex justify-content-between">
                    @forelse(\App\Models\ProductGroup::query()->whereNotIn('id', [$productGroup->id])->inRandomOrder()->take(4)->get() as $product)
                        <div class="product">
                            <div class="product-image">
                                <a href="{{ route('products.show', [slug($product->name)]) }}">
                                    @if($media = $product->getFirstMedia('images'))
                                        <img src="{{ $media->getFullUrl()}}" alt="{{ $media->name }}">
                                    @else
                                        <img src="http://placehold.it/300x200.jpg" alt="placeholder"/>
                                    @endif
                                </a>
                            </div>
                            <div class="product-description">
                                <div class="product-title">
                                    <h3>
                                        <a href="{{ route('products.show', [slug($product->name)]) }}">
                                            {{ $product->name }}
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
        <!-- end: Content-->
    </div>
</div>
