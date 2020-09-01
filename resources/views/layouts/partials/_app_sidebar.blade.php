<div class="sidebar" data-color="orange">
    <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
-->
    <div class="logo">
        <a href="{{ url('/') }}" class="simple-text logo-mini">
            {{ config('app.name', '--') }}
        </a>
        <a href="{{ route('home') }}" class="simple-text logo-normal">
            {{ (Auth::user()->role === 'admin' ? 'ADMIN' : Auth::user()->role === 'donor') ? 'DONOR' : 'USER' }}
        </a>
    </div>
    <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ 'home' === Route::currentRouteName() ? 'active' : '' }}">
                <a href="{{ route('home') }}">
                    <x-nav-icon />
                    <p>Home</p>
                </a>
            </li>
            @if (Auth::user()->role === 'patient')
                <li class="{{ 'users.show' === Route::currentRouteName() ? 'active' : '' }}">
                    <a href="{{ route('users.show', ['user' => Auth::id()]) }}">
                        <x-nav-icon />
                        <p>Profile</p>
                    </a>
                </li>
                <li class="{{ 'users.show-donors' === Route::currentRouteName() ? 'active' : '' }}">
                    <a href="{{ route('users.show-donors') }}">
                        <x-nav-icon />
                        <p>Search Donors</p>
                    </a>
                </li>
                <li
                    class="{{ 'prescriptions.index' === Route::currentRouteName() || 'prescriptions.show' === Route::currentRouteName() ? 'active' : '' }}">
                    <a href="{{ route('prescriptions.index') }}">
                        <x-nav-icon />
                        <p>Prescriptions</p>
                    </a>
                </li>
                <li class="{{ 'donations.index' === Route::currentRouteName() ? 'active' : '' }}">
                    <a href="{{ route('donations.index') }}">
                        <x-nav-icon />
                        <p>Confirmations</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <x-nav-icon />
                        <p>History</p>
                    </a>
                </li>
            @elseif(Auth::user()->role === 'donor')
                <li class="{{ 'profiles.jurisdiction' === Route::currentRouteName() ? 'active' : '' }}">
                    <a href="{{ route('profiles.jurisdiction', ['profile' => Auth::user()->profile->id]) }}">
                        <x-nav-icon />
                        <p>Working Jurisdiction</p>
                    </a>
                </li>
                <li class="{{ 'donations.index' === Route::currentRouteName() ? 'active' : '' }}">
                    <a href="{{ route('donations.index') }}">
                        <x-nav-icon />
                        <p>Orders</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <x-nav-icon />
                        <p>Payments</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <x-nav-icon />
                        <p>Ratings</p>
                    </a>
                </li>
            @endif

            @if (Auth::user()->role === 'admin')
                <li class="{{ 'users.index' === Route::currentRouteName() ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}">
                        <x-nav-icon />
                        <p>User Accounts</p>
                    </a>
                </li>
                <li class="{{ 'services.index' === Route::currentRouteName() ? 'active' : '' }}">
                    <a href="{{ route('services.index') }}">
                        <x-nav-icon />
                        <p>Charges and prices</p>
                    </a>
                </li>
                <li class="{{ 'complaints.index' === Route::currentRouteName() ? 'active' : '' }}">
                    <a href="{{ route('complaints.index') }}">
                        <x-nav-icon />
                        <p>Complaints</p>
                    </a>
                </li>
                {{-- <li
                    class="{{ 'donations.index' === Route::currentRouteName() ? 'active' : '' }}">
                    <a href="{{ route('donations.index') }}">
                        <x-nav-icon />
                        <p>Service requests</p>
                    </a>
                </li> --}}
                <li>
                    <a href="#">
                        <x-nav-icon />
                        <p>Reports</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <x-nav-icon />
                        <p>Logs</p>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
