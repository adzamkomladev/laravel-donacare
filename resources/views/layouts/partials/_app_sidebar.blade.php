<div class="sidebar" data-color="orange">
    <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
-->
    <div class="logo">
        <a href="{{ url('/') }}" class="simple-text logo-mini">
            {{ config('app.name', 'Blood donor') }}
        </a>
        <a href="{{ route('home') }}" class="simple-text logo-normal">
            Dashboard
        </a>
    </div>
    <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
            <li class="@if('home' === Route::currentRouteName()) active @endif">
                <a href="{{ route('home') }}">
                    <x-nav-icon/>
                    <p>Home</p>
                </a>
            </li>
            @if (Auth::user()->role === 'admin')
                <li class="@if('users.index' === Route::currentRouteName()) active @endif">
                    <a href="{{ route('users.index') }}">
                        <x-nav-icon/>
                        <p>User Accounts</p>
                    </a>
                </li>
            @endif
            <li class="@if('services.index' === Route::currentRouteName()) active @endif">
                <a href="{{ route('services.index') }}">
                    <x-nav-icon/>
                    <p>Services</p>
                </a>
            </li>
            <li class="@if('complaints.index' === Route::currentRouteName()) active @endif">
                <a href="{{ route('complaints.index') }}">
                    <x-nav-icon/>
                    <p>Complaints</p>
                </a>
            </li>
            <li class="@if('service-requests.index' === Route::currentRouteName()) active @endif">
                <a href="{{ route('service-requests.index') }}">
                    <x-nav-icon/>
                    <p>Service requests</p>
                </a>
            </li>
            {{-- <li>
                <a href="./reports.html">
                    <x-nav-icon/>
                    <p>Reports</p>
                </a>
            </li>
            <li>
                <a href="./logs.html">
                    <x-nav-icon/>
                    <p>Logs</p>
                </a>
            </li> --}}
            @if (Auth::user()->role === 'patient')
                <li class="@if('service-requests.create.step-one' === Route::currentRouteName()) active @endif">
                    <a href="{{ route('service-requests.create.step-one') }}">
                        <x-nav-icon/>
                        <p>Make a request</p>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
