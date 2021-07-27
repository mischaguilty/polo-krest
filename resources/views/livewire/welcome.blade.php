<div>
    @section('title', $company->name)
    @section('slider')
    <!-- Inspiro Slider -->
    <div id="slider" class="inspiro-slider dots-creative" data-height-xs="360">
    @forelse($slides as $slide)
        <!-- Slide 1 -->
            <div class="slide kenburns" style="background-image:url({{ url($slide['picture']) }});">
                <div class="bg-overlay"></div>
                <div class="container">
                    <div class="slide-captions text-center text-light">
                        <!-- Captions -->
                        {{--                            <span class="strong">WITH POLO TEMPLATE</span>--}}
                        <h2 class="text-dark">
                            {{ $slide['text'] }}
                        </h2>
                    {{--                            <a class="btn" href="#">Purchase Now</a>--}}
                    {{--                            <a class="btn btn-light">Purchase</a>--}}
                    <!-- end: Captions -->
                    </div>
                </div>
            </div>
        <!-- end: Slide 1 -->
    @empty
    @endforelse
    </div>
    @endsection
    <!--end: Inspiro Slider -->
</div>
