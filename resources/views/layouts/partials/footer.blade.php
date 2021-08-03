<footer id="footer" class="dark">
    <div class="footer-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="widget">
                        <div class="widget-title">
                            {{ $company->name }}
                        </div>
                        <div class="col-10 text-sm-left text-muted">
                            {{ $company->description }}
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="row">
                        <div class="col">
                            <div class="widget">
                                <div class="widget-title">{{ trans('Services') }}</div>
                                <ul class="list">
                                    @forelse(\App\Models\ServiceGroup::all() as $serviceGroup)
                                        <li>
                                            <a href="{{ route('services.show', [slug($serviceGroup->name)]) }}">
                                                {{ $serviceGroup->name }}
                                            </a>
                                        </li>
                                    @empty
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        <div class="col">
                            <div class="widget">
                                <div class="widget-title">
                                    {{ trans('Products') }}
                                </div>
                                <ul class="list">
                                    @forelse(\App\Models\ProductGroup::all() as $productGroup)
                                        <li>
                                            <a href="{{ route('products.show', [slug($productGroup->name)]) }}">
                                                {{ $productGroup->name }}
                                            </a>
                                        </li>
                                    @empty
                                    @endforelse
                                </ul>
                            </div>
                        </div>
{{--                        <div class="col-lg-3">--}}
{{--                            <div class="widget">--}}
{{--                                <div class="widget-title">--}}
{{--                                    {{ trans('Contacts') }}--}}
{{--                                </div>--}}
{{--                                <ul class="list">--}}
{{--                                    @forelse($company->offices as $office)--}}
{{--                                    @empty--}}
{{--                                    @endforelse--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-3">--}}
{{--                            <div class="widget">--}}
{{--                                <div class="widget-title">Support</div>--}}
{{--                                <ul class="list">--}}
{{--                                    <li><a href="#">Help Desk</a></li>--}}
{{--                                    <li><a href="#">Documentation</a></li>--}}
{{--                                    <li><a href="#">Contact Us</a></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @isset($company)
    <div class="copyright-content">
        <div class="container">
            <div class="text-center copyright-text">
                &copy; {{ now()->format('Y') }}
                <a href="{{ url('/') }}" target="_blank" rel="noopener">
                    {{ $company->name }}
                </a>
            </div>
        </div>
    </div>
    @endisset
</footer>
