<div>
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
</div>
<!-- end: Topbar -->
