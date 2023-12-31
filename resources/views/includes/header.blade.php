<header class="contact_header">
    <div class="container contact_cont_head">
        <div class="contact_nav">
            <nav class="nav">
                <ul class="nav-list">
                    <li><a href="#"><i class="fa-solid fa-check"></i>{{ __('home.made_in_germany') }}</a></li>
                    <li><a href="#"><i class="fa-solid fa-check"></i>{{ __('home.express_delivery_possible') }}</a>
                    </li>
                    <li><a href="#"><i class="fa-solid fa-check"></i>{{ __('home.firstin_firstout') }}</a></li>
                    <li><a href="#"><i class="fa-solid fa-check"></i>{{ __('home.hotline') }}</a></li>
                </ul>
            </nav>
            @php
                $currentLocale = app()->getLocale();
                $currentPath = Request::path();
                $languagePrefix = $currentLocale . '/';
                //echo $currentPath;
                // Remove existing language prefix if present
                $currentPathWithoutLang = preg_replace('/^(en|de)\//', '', $currentPath);
                
                if ($currentLocale === 'en') {
                    $currentLanguage = 'English';
                } elseif ($currentLocale === 'de') {
                    $currentLanguage = 'Deutsch';
                } else {
                    $currentLanguage = $currentLocale;
                }
                
                // Generate URLs for language switches
                $enUrl = 'en/';
                $deUrl = 'de/';
                // Handle case where URL already contains language prefix
                if (strpos($currentPath, $languagePrefix) === 0) {
                    $currentPathWithoutLang = substr($currentPath, strlen($languagePrefix));
                    $enUrl = 'en/' . $currentPathWithoutLang;
                    $deUrl = 'de/' . $currentPathWithoutLang;
                }
            @endphp
            <div class="dropdown">
                <div class="language_p">
                    <h4><a href="{{ __('routes.customer-register') }}"
                            style="text-decoration: none;color: #282828;"><strong>{{ __('home.header_reisteration_link') }}</strong></a>
                    </h4>
                </div>
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ $currentLanguage }} <i class="fa-solid fa-language"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ url($enUrl) }}">English</a></li>
                    <li><a class="dropdown-item" href="{{ url($deUrl) }}">Deutsch</a></li>
                </ul>
            </div>
        </div>
        <div>
</header>


<header class="lion_nav_wrap">
    <nav class="navbar navbar-expand-lg bg-body-tertiary nav_wrap_dv">
        <div class="container-fluid" style="width: 88%">
            <div class="lion_nav">
                <a class="logo_img" href="/"><img src="{{ asset('asset/images/lion_werbe_gmbh_logo.webp') }}"
                        alt="empty"></a>
                <div class="admin_btn">
                    <button class="navbar-toggler nav_menu_btn" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon menu_icon"><i class="fa-solid fa-bars"></i></span>
                    </button>
                    <div class="collapse navbar-collapse lion_list" id="navbarSupportedContent">
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            @auth
                                <li class="nav-item menu_list">
                                    @if (@auth()->user()->user_type == 'admin')
                                        <a class="nav-link active" aria-current="page"
                                            href="/">{{ __('home.home') }}</a>
                                    @elseif(@auth()->user()->user_type == 'freelancer')
                                        <a class="nav-link active" href="/">{{ __('home.home') }}</a>
                                    @elseif(@auth()->user()->user_type == 'customer')
                                        <a class="nav-link active" href="/">{{ __('home.home') }}</a>
                                    @endif
                                </li>
                                @if (@auth()->user()->user_type == 'customer')
                                    <li class="nav-item  menu_list">
                                        <a class="nav-link" href="#">{{ __('home.prices_embroidery') }}</a>
                                    </li>
                                    <li class="nav-item  menu_list">
                                        <a class="nav-link"
                                            href="{{ __('routes.customer-embroidery-program') }}">{{ __('home.information_embroidery') }}</a>
                                    </li>
                                    <li class="nav-item  menu_list">
                                        <a class="nav-link" href="#">{{ __('home.price_vector') }}</a>
                                    </li>
                                    <li class="nav-item menu_list">
                                        <a class="nav-link"
                                            href="{{ __('routes.customer-vector-program') }}">{{ __('home.information_vector') }}</a>
                                    </li>
                                @endif
                                @if (@auth()->user()->user_type == 'employer')
                                    <li class="nav-item  menu_list">
                                        <a class="nav-link" href="#">{{ __('home.prices_embroidery') }}</a>
                                    </li>
                                    <li class="nav-item  menu_list">
                                        <a class="nav-link"
                                            href="{{ __('routes.customer-embroidery-program') }}">{{ __('home.information_embroidery') }}</a>
                                    </li>
                                    <li class="nav-item  menu_list">
                                        <a class="nav-link" href="#">{{ __('home.price_vector') }}</a>
                                    </li>
                                    <li class="nav-item menu_list">
                                        <a class="nav-link"
                                            href="{{ __('routes.customer-vector-program') }}">{{ __('home.information_vector') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item  menu_list" style="padding: 0px 10px;">
                                    <a class="nav-link" style="font-size: 16px;"
                                        href="#">{{ __('home.information_embroidery') }}</a>
                                </li>
                                <li class="nav-item  menu_list" style="padding: 0px 10px;">
                                    <a class="nav-link" style="font-size: 16px;"
                                        href="#">{{ __('home.prices_embroidery') }}</a>
                                </li>
                                <li class="nav-item menu_list" style="padding: 0px 10px;">
                                    <a class="nav-link" style="font-size: 16px;"
                                        href="#">{{ __('home.information_vector') }}</a>
                                </li>
                                <li class="nav-item  menu_list" style="padding: 0px 10px;">
                                    <a class="nav-link" style="font-size: 16px;"
                                        href="#">{{ __('home.price_vector') }}</a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>

            <div class="action align-items-center d-flex position-relative float-end" onclick="menuToggle();">
                <div class="profile">
                    @auth
                        @if (Auth::user()->image)
                            <img src="{{ asset(Auth::user()->image) }}" alt="Profile Image" />
                        @else
                            <img src="{{ asset('asset/images/right-to-bracket-duotone.svg') }}" alt="" />
                        @endif
                    @else
                        <a href="{{ __('routes.customer-login') }}">
                            <img src="{{ asset('asset/images/right-to-bracket-duotone.svg') }}" alt="" />
                        </a>
                    @endauth

                </div>
                @auth
                    <div class="menu">
                        <ul>

                            <!-- <li>
                                                                        @if (@auth()->user()->user_type == 'admin')
    <a href="{{ __('routes.admin-profile') }}">My Profile</a>
@elseif(@auth()->user()->user_type == 'freelancer')
    <a href="{{ __('routes.freelancer-profile') }}">My Profile</a>
@elseif(@auth()->user()->user_type == 'customer')
    <a href="{{ __('routes.customer-profile') }}">My Profile</a>
    @endif
                                                                    </li> -->

                            <li>
                                <!-- <a href="#">Change Password</a> -->
                                @if (@auth()->user()->user_type == 'admin')
                                    <a
                                        href="{{ __('routes.admin-changepassword') }}">{{ __('home.change_password') }}</a>
                                @elseif(@auth()->user()->user_type == 'freelancer')
                                    <a
                                        href="{{ __('routes.freelancer-changepassword') }}">{{ __('home.change_password') }}</a>
                                @elseif(@auth()->user()->user_type == 'customer')
                                    <a
                                        href="{{ __('routes.customerchange-password') }}">{{ __('home.change_password') }}</a>
                                @elseif(@auth()->user()->user_type == 'employer')
                                    <a
                                        href="{{ __('routes.customerchange-password') }}">{{ __('home.change_password') }}</a>
                                @endif
                            </li>

                            <li>
                                @if (@auth()->user()->user_type == 'admin')
                                    <a href="{{ __('routes.admin-logout') }}">{{ __('home.logout') }}</a>
                                @elseif(@auth()->user()->user_type == 'freelancer')
                                    <a href="{{ __('routes.freelancerlogout') }}">{{ __('home.logout') }}</a>
                                @elseif(@auth()->user()->user_type == 'customer')
                                    <a href="{{ __('routes.customerlogout') }}">{{ __('home.logout') }}</a>
                                @elseif(@auth()->user()->user_type == 'employer')
                                    <a href="{{ __('routes.customerlogout') }}">{{ __('home.logout') }}</a>
                                @endif
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
    </nav>
</header>
