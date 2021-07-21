@isset($company)
@if($company->phones->count() || $company->socials->count())
<div id="topbar" class="dark topbar-colored topbar-fullwidth" style="background-color: #754747 !important;">
    <div class="container">
        <div class="row flex-nowrap" style="min-width: 400px">
            <div class="col-md-6">
                <ul class="top-menu">
                    @forelse($company->phones as $phone)
                        <li>
                            <a href="tel://{{ $phone->phone }}">
                                <i class="fa fa-phone"></i>
                                {{ $phone->spaced_phone }}
                            </a>
                        </li>
{{--                    <li><a href="#">About</a></li>--}}
{{--                    <li><a href="#">Features</a></li>--}}
{{--                    <li><a href="#">Pricing</a></li>--}}
{{--                    <li><a href="#">Terms</a></li>--}}
                    @empty
                    @endforelse
                </ul>
            </div>
            <div class="col-md-6 d-none d-sm-block">
                <div class="social-icons social-icons-colored-hover">
                    <ul>
                        @forelse($company->socials as $social)
                            <li class="social-{{ $social->name }}">
                                <a href="{{ $social->url }}">
                                    <i class="{{ $social->icon }}"></i>
                                </a>
                            </li>
                        @empty
                        @endforelse
{{--                        <li class="social-facebook"><a href="#"><i class="fab fa-facebook-f"></i></a></li>--}}
{{--                        <li class="social-twitter"><a href="#"><i class="fab fa-twitter"></i></a></li>--}}
{{--                        <li class="social-google"><a href="#"><i class="fab fa-google-plus-g"></i></a></li>--}}
{{--                        <li class="social-pinterest"><a href="#"><i class="fab fa-pinterest"></i></a></li>--}}
{{--                        <li class="social-vimeo"><a href="#"><i class="fab fa-vimeo"></i></a></li>--}}
{{--                        <li class="social-linkedin"><a href="#"><i class="fab fa-linkedin"></i></a></li>--}}
{{--                        <li class="social-dribbble"><a href="#"><i class="fab fa-dribbble"></i></a></li>--}}
{{--                        <li class="social-youtube"><a href="#"><i class="fab fa-youtube"></i></a></li>--}}
{{--                        <li class="social-rss"><a href="#"><i class="fa fa-rss"></i></a></li>--}}
                    </ul>
                </div>
            </div>
            <div class="col-md-6 d-sm-none d-block justify-content-end">
                <ul class="text-right top-menu w-100">
                    <li>
                        <a href="#">
                            {{ __('Цілодобово') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- end: Topbar -->
@endif
@endisset
