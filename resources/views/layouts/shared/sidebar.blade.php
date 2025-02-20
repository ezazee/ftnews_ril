<div class="app-menu">

    <!-- Sidenav Brand Logo -->
    <a href="{{ route('dashboard.index') }}" class="logo-box">
        <!-- Light Brand Logo -->
        <div class="logo-light">
            <img src="{{ asset('/images/Logo-FTNews-New-dark3.png') }}" class="h-6 logo-lg" alt="Light logo">
            <img src="{{ asset('/images/icon-ftnews.png') }}" class="logo-sm" alt="Small logo">
        </div>

        <!-- Dark Brand Logo -->
        <div class="logo-dark">
            <img src="{{ asset('/images/Logo-FTNews-New-dark3.png') }}" class="h-6 logo-lg" alt="Dark logo">
            <img src="{{ asset('/images/icon-ftnews.png') }}" class="logo-sm" alt="Small logo">
        </div>
    </a>

    <!-- Sidenav Menu Toggle Button -->
    <button id="button-hover-toggle" class="absolute top-5 end-2 rounded-full p-1.5">
        <span class="sr-only">Menu Toggle Button</span>
        <i class="text-xl mgc_round_line"></i>
    </button>

    <!--- Menu -->
    <div class="srcollbar" data-simplebar>
        <ul class="menu" data-fc-type="accordion">
            <li class="menu-title">Menu</li>

            <li class="menu-item">
                <a href="{{ route('dashboard.index') }}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_home_3_line"></i></span>
                    <span class="menu-text"> Dashboard </span>
                </a>
            </li>

            <li class="menu-title">Apps</li>
            @if(auth()->user() && auth()->user()->hasRole('admin'))
            <li class="menu-item">
                <a href="{{ route('second', ['apps', 'categori']) }}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_list_check_3_line"></i></span>
                    <span class="menu-text"> Category </span>
                </a>
            </li>
            @endif
            <li class="menu-item">
                <a href="{{ route('second', ['apps', 'tags']) }}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_hashtag_line"></i></span>
                    <span class="menu-text"> Tags </span>
                </a>
            </li>

            <li class="menu-item">
                <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                    <span class="menu-icon"><i class="mgc_rocket_line"></i></span>
                    <span class="menu-text"> Post </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="hidden sub-menu">
                    <li class="menu-item">
                        <a href="{{ route('second', ['project', 'create']) }}" class="menu-link">
                            <span class="menu-text">Add Post</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('second', ['project', 'list']) }}" class="menu-link">
                            <span class="menu-text">List Post All</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('second', ['shedule', 'list']) }}" class="menu-link">
                            <span class="menu-text">List Post Schedule</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('post.private') }}" class="menu-link">
                            <span class="menu-text">List Post Private</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('post.mypost') }}" class="menu-link">
                            <span class="menu-text">My Post List</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('second', ['project', 'detail']) }}" class="menu-link">
                            <span class="menu-text">Detail Post</span>
                        </a>
                    </li>
                </ul>
            </li>
            @if(auth()->user() && auth()->user()->hasRole('admin'))
            <li class="menu-item">
                <a href="{{ route('user.index') }}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_user_3_line"></i></span>
                    <span class="menu-text"> Member </span>
                </a>
            </li>

            <li class="menu-title">Setting</li>

            <li class="menu-item">
                <a href="{{ route('second', ['setting', 'media']) }}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_camera_line"></i></span>
                    <span class="menu-text"> Media </span>
                </a>
            </li>

            {{-- <li class="menu-item">
                <a href="{{ route('second', ['settingColor', 'edit']) }}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_settings_1_line"></i></span>
                    <span class="menu-text"> Color Website </span>
                </a>
            </li> --}}
            @endif


            <li class="menu-title">Documentations</li>

            <li class="menu-item">
                <a href="{{ route('second', ['docs', 'documentations']) }}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_paper_line"></i></span>
                    <span class="menu-text"> Documentations </span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- Sidenav Menu End  -->
