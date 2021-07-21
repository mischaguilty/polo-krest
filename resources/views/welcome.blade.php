@extends('layouts.app')

@section('slider')
    <!-- Inspiro Slider -->
    <div id="slider" class="inspiro-slider slider-fullscreen dots-creative" data-height-xs="360">
        <!-- Slide 1 -->
        <div class="slide" data-bg-image="{{ url('bg.jpg') }}">
            <div class="bg-overlay"></div>
            <div class="container">
                <div class="text-center slide-captions text-light">
                    <!-- Captions -->
                    <span data-animate="fadeInUp" data-animate-delay="300" class="strong">
                        <a href="#" class="business">
                            <span class="business">
                                Let's Do This
                            </span>
                        </a>
                    </span>
                    <h1 data-animate="fadeInUp" data-animate-delay="600" class="h6">
                        {{-- {{ $page->h_one }} --}}
                    </h1>
                    <div>
                        <a data-animate="fadeInUp" data-animate-delay="900" class="btn btn-outline btn-light">
                            Discover More
                        </a>
                        <a data-animate="fadeInUp" data-animate-delay="1200" class="btn btn-outline btn-light">
                            Purchase
                        </a>
                    </div>
                    <!-- end: Captions -->
                </div>
            </div>
        </div>
        <!-- end: Slide 1 -->
    </div>
    <!--end: Inspiro Slider -->
@endsection
