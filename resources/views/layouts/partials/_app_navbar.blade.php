<nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute" @if ('home' === Route::currentRouteName()) id="bgtop"
    style="background-image:url('{{ asset('img/bg.png') }}');" @endif>
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <div class="navbar-toggle">
                <button type="button" class="navbar-toggler">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            @if (Auth::user()->role === 'patient')
                <a class="navbar-brand" href="/home">
                    <lc class="now-ui-icons business_money-coins"></lc> GHs 100.00
                </a>
            @else
                <a class="navbar-brand" href="/home">Dashboard</a>
            @endif

        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
            aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            @if (Auth::user()->role === 'patient')
                <search-box></search-box>
            @endif
            <ul class="navbar-nav">
                <navbar-actions></navbar-actions>

                {{-- <li class="nav-item">
                    <a class="nav-link" href="#pablo">
                        <p>
                            <span class="d-lg-none d-md-block">Stats</span>
                        </p>
                    </a>
                </li> --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        @if (Auth::user()->role === 'admin')
                            <i class="now-ui-icons location_world"></i>
                        @else
                            <i class="now-ui-icons users_single-02"></i>
                        @endif
                        <p>
                            <span class="d-lg-none d-md-block">Account acitons</span>
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @if (Auth::user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.show', ['user' => Auth::id()]) }}">
                            <i class="now-ui-icons users_single-02"></i>
                            <p>
                                <span class="d-lg-none d-md-block">{{ Auth::user()->profile->full_name }}</span>
                            </p>
                        </a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>
