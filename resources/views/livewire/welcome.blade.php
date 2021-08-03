<div>
@section('title'){{ $seo['PageTitle'] }}@endsection
@section('description', $seo['PageDescription'])
@section('robots', $seo['robots'])
@section('googlebot', $seo['googlebot'])
@section('schema')@endsection

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
                            <h1 class="font-weight-400">
                                {!!  $seo['PageH1'] !!}
                            </h1>
                            <!-- end: Captions -->
                        </div>
                    </div>
                </div>
                <!-- end: Slide 1 -->
                @break
            @empty
            @endforelse
        </div>
@endsection
<!--end: Inspiro Slider -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="heading-text heading-section">
                        <h2>{{ __('Чому ми?') }}</h2>
                    </div>
                </div>
                <div class="col-lg-9">
                    <p class="lead">
                    {{ __('Надання ритуальних послуг вимагає певних знань і досвіду. Проводити покійного, оформити необхідні документи, визначити місце для поховання, провести панахиду і підібрати зал для прощання, допоможуть наші кваліфіковані агенти. Ми повністю знімемо з Вас метушню та нервові потрясіння, пов\'язані з похованням тіла покійного, близької та дорогої Вам людини, залишивши Вам час на останнє прощання з нею. Ми працюємо 24 години на добу, без вихідних. Наша спеціалізована служба - це організація ритуальних послуг на найвищому рівні якості. Компетентні співробітники нашого агентства розуміють всю складність та делікатність ситуації і зроблять все можливе, щоб похорон був проведений з дотриманням всіх етичних аспектів.') }}
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>
