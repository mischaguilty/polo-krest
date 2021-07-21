<footer id="footer">
    <div class="footer-content">
        <div class="container">
            <div class="row">
                @isset($company)
                    <div class="col-lg-5">
                    <div class="widget">
                        <div class="widget-title">
                            {{ $company->name }}
                        </div>
                        <p class="mb-5">
                            {{ $company->description }}
                        </p>
                        <a href="{{ route('welcome', ['lang' => app()->getLocale(),]) }}" class="btn btn-inverted" target="_blank">
                            {{ __('call-to-action') }}
                        </a>
                    </div>
                </div>
                @endisset

                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="widget">
                                <div class="widget-title">Discover</div>
                                <ul class="list">
                                    <li><a href="#">Features</a></li>
                                    <li><a href="#">Layouts</a></li>
                                    <li><a href="#">Corporate</a></li>
                                    <li><a href="#">Updates</a></li>
                                    <li><a href="#">Pricing</a></li>
                                    <li><a href="#">Customers</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="widget">
                                <div class="widget-title">Features</div>
                                <ul class="list">
                                    <li><a href="#">Layouts</a></li>
                                    <li><a href="#">Headers</a></li>
                                    <li><a href="#">Widgets</a></li>
                                    <li><a href="#">Footers</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="widget">
                                <div class="widget-title">Pages</div>
                                <ul class="list">
                                    <li><a href="#">Portfolio</a></li>
                                    <li><a href="#">Blog</a></li>
                                    <li><a href="#">Shop</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="widget">
                                <div class="widget-title">Support</div>
                                <ul class="list">
                                    <li><a href="#">Help Desk</a></li>
                                    <li><a href="#">Documentation</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
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
