<div>
    @section('slider')
    <!-- Inspiro Slider -->
    <div id="slider" class="inspiro-slider dots-creative" data-height-xs="360">
        <!-- Slide 2 -->
        <div class="slide kenburns" style="background-image:url('images/about/parallax-1.jpg');">
            <div class="bg-overlay"></div>
            <div class="container">
                <div class="slide-captions text-center text-light">
                    <!-- Captions -->
                    <span class="strong">Who we are</span>
                    <h1>About our company</h1>
                    <!-- end: Captions -->
                </div>
            </div>
        </div>
        <!-- end: Slide 2 -->
    </div>
    <!--end: Inspiro Slider -->
    @endsection

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
